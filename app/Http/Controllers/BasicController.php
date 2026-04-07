<?php


namespace App\Http\Controllers;

use App\Http\Classes\dxResponse;
use App\Models\Aboutus;
use App\Models\dxDataGrid;
use App\Models\Faq;
use App\Models\General;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use SoDe\Extend\Crypto;
use SoDe\Extend\Math;
use SoDe\Extend\Response;
use SoDe\Extend\Text;

class BasicController extends Controller
{
  public $model = Model::class;
  public $softDeletion = true;
  public $reactView = 'Home';
  public $reactRootView = 'admin';
  public $imageFields = [];
  public $prefix4filter = null;
  public $ignorePrefix = [];

  public function media(Request $request, string $uuid)
  {
    try {
      $content = Storage::get('images/' . $uuid . '.img');
      if (!$content) throw new Exception('Imagen no encontrado');
      return response($content, 200, [
        'Content-Type' => 'application/octet-stream'
      ]);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $content = Storage::get('utils/cover-404.svg');
      return response($content, 200, [
        'Content-Type' => 'image/svg+xml'
      ]);
    }
  }

  public function setPaginationInstance(string $model)
  {
    return $model::select();
  }

  public function setPaginationSummary(string $model, Builder $query)
  {
    return [];
  }

  public function setReactViewProperties(Request $request)
  {
    return [];
  }

  public function reactView(Request $request)
  {
    if (Auth::check()) Auth::user()->getAllPermissions();
    $properties = [
      'session' => Auth::user(),
      'global' => [
        'PUBLIC_RSA_KEY' => Controller::$PUBLIC_RSA_KEY,
        'APP_NAME' => env('APP_NAME'),
        'APP_URL' => env('APP_URL'),
        'APP_DOMAIN' => env('APP_DOMAIN'),
        'APP_PROTOCOL' => env('APP_PROTOCOL', 'https'),
      ],
    ];
    foreach ($this->setReactViewProperties($request) as $key => $value) {
      $properties[$key] = $value;
    }
    return Inertia::render($this->reactView, $properties)
      ->rootView($this->reactRootView);
  }

  public function paginate(Request $request): HttpResponse|ResponseFactory
  {
    $response =  new dxResponse();
    try {
      $instance = $this->setPaginationInstance($this->model);


      if ($request->group != null) {
        [$grouping] = $request->group;
        // $selector = str_replace('.', '__', $grouping['selector']);
        $selector = $grouping['selector'];


        if (!str_contains($selector, '.') && $this->prefix4filter && !Text::startsWith($selector, '!') && !in_array($selector, $this->ignorePrefix)) {
          $selector = "{$this->prefix4filter}.{$selector}";
        }
        // $instance = $this->model::select(DB::raw("{$selector} AS key"))
        $instance = $instance->select(DB::raw("{$selector} AS `key`"))
          ->groupBy(str_replace('!', '', $selector));
      }

      /*  if ($this->filterBusiness) {
        if ($this->prefix4filter) {
          $instance->where("{$this->prefix4filter}.business_id", Auth::user()->business_id);
        } else {
          $instance->where('business_id', Auth::user()->business_id);
        }
      } */

      if ($request->filter) {
        $instance->where(function ($query) use ($request) {
          dxDataGrid::filter($query, $request->filter ?? [], false, $this->prefix4filter, $this->ignorePrefix);
        });
      }

      if ($request->sort != null) {
        foreach ($request->sort as $sorting) {
          // $selector = \str_replace('.', '__', $sorting['selector']);
          $selector = $sorting['selector'];
          if (!str_contains($selector, '.') && $this->prefix4filter && !Text::startsWith($selector, '!') && !in_array($selector, $this->ignorePrefix)) {
            $selector = "{$this->prefix4filter}.{$selector}";
          }
          $instance->orderBy(
            str_replace('!', '', $selector),
            $sorting['desc'] ? 'DESC' : 'ASC'
          );
        }
      } else {
        if ($this->prefix4filter) {
          $instance->orderBy("{$this->prefix4filter}.id", 'DESC');
        } else {
          $instance->orderBy('id', 'DESC');
        }
      }

      $totalCount = 0;
      if ($request->requireTotalCount) {
        try {
          $instance4count = clone $instance;
          $instance4count->getQuery()->groups = null;
          // $totalCount = $instance->count();
          if ($this->prefix4filter) {
            $totalCount = $instance4count->select(DB::raw("COUNT(DISTINCT({$this->prefix4filter}.id)) as total_count"))->value('total_count');
          } else {
            $totalCount = $instance4count->select(DB::raw('COUNT(DISTINCT(id)) as total_count'))->value('total_count');
          }
        } catch (\Throwable $th) {
          Log::error($th->getMessage());
          //throw $th;
        }
      }

      $response->summary = $this->setPaginationSummary($this->model, clone $instance);

      $jpas = [];
      if ($request->requireData !== false) {
        $jpas = $request->isLoadingAll
          ? $instance->get()
          : $instance
          ->skip($request->skip ?? 0)
          ->take($request->take ?? 10)
          ->get();
      }

      $response->status = 200;
      $response->message = 'Operación correcta';
      $response->data = $jpas;
      $response->totalCount = $totalCount;
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $response->status = 400;
      $response->message = $th->getMessage() . ' Ln.' . $th->getLine();
    } finally {
      return response(
        $response->toArray(),
        $response->status
      );
    }
  }

  public function beforeSave(Request $request)
  {
    return $request->all();
  }

  public function save(Request $request): HttpResponse|ResponseFactory
  {
    $response = new Response();
    try {
      $body = $this->beforeSave($request);



      foreach ($this->imageFields as $field) {
        if (!$request->hasFile($field)) continue;
        $full = $request->file($field);
        $uuid = Crypto::randomUUID();
        $path = 'images/' . $uuid . '.img';
        Storage::put($path, file_get_contents($full));
        $body[$field] = $uuid;
      }

      $jpa = $this->model::find(isset($body['id']) ? $body['id'] : null);

      if ($jpa && $jpa->tipo_tarjeta == 'transferencia' && $jpa->puntos_calculados == 0) {

        $generals = General::select('point_equivalence')->first();



        $points2give = Math::floor(($jpa->monto + $jpa->precio_envio) / $generals->point_equivalence);
        $jpa->points = $points2give;

        $userJpa = User::find($jpa->usuario_id);
        $userJpa->points = $userJpa->points + ($points2give);
        $userJpa->save();

        $body['puntos_calculados'] = 1;
      }

      if (!$jpa) {
        $jpa = $this->model::create($body);
      } else {
        $jpa->update($body);
      }

      $data = $this->afterSave($request, $jpa);
      if ($data) {
        $response->data = $data;
      }


      $response->status = 200;
      $response->message = 'Operacion correcta';
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $response->status = 400;
      $response->message = $th->getMessage();
    } finally {
      return response(
        $response->toArray(),
        $response->status
      );
    }
  }

  public function afterSave(Request $request, object $jpa)
  {
    return null;
  }

  public function status(Request $request)
  {
    $response = new Response();
    try {
      $this->model::where('id', $request->id)
        ->update([
          'status' => $request->status ? 0 : 1
        ]);

      $response->status = 200;
      $response->message = 'Operacion correcta';
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $response->status = 400;
      $response->message = $th->getMessage();
    } finally {
      return response(
        $response->toArray(),
        $response->status
      );
    }
  }

  public function boolean(Request $request)
  {
    $response = new Response();
    try {
      $data = [];
      $data[$request->field] = $request->value;

      $this->model::where('id', $request->id)
        ->update($data);

      $response->status = 200;
      $response->message = 'Operacion correcta';
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $response->status = 400;
      $response->message = $th->getMessage();
    } finally {
      return response(
        $response->toArray(),
        $response->status
      );
    }
  }

  public function delete(Request $request, string $id)
  {
    $response = new Response();
    try {
      $deleted = $this->softDeletion
        ? $this->model::where('id', $id)
        ->update(['status' => null])
        : $this->model::where('id', $id)
        ->delete();

      if (!$deleted) throw new Exception('No se ha eliminado ningun registro');

      $response->status = 200;
      $response->message = 'Operacion correcta';
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      $response->status = 400;
      $response->message = $th->getMessage();
    } finally {
      return response(
        $response->toArray(),
        $response->status
      );
    }
  }
}
