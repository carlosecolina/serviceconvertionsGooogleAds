<?php

namespace App\Http\Controllers;

use App\Models\ConversionGoogleAds;

use App\Models\User;
use App\Services\GoogleAdsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Google\Ads\GoogleAds\Lib\V23\GoogleAdsException;
use Google\ApiCore\ApiException;
use Illuminate\Support\Facades\Validator;

class GoogleAdsConversionController extends Controller
{
  //
  public function sync(Request $request, GoogleAdsService $service)
  {



    $validator = Validator::make($request->all(), [
      'id'                => 'required|integer',
      'gclid'             => 'required|string|min:10',
      'conversion_value'  => 'required|numeric|min:0',
      'currency_code'     => 'required|string|size:3',
      'conversion_action' => 'required|string',
      'conversion_time'   => 'required|date_format:Y-m-d H:i:s',
      'closed_at'         => 'nullable|date_format:Y-m-d H:i:s',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'status' => 'error',
        'message' => 'Validación fallida',
        'errors' => $validator->errors()
      ], 422);
    }
    $validated = $validator->validated();

    $googleLog = Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/google_ads_debug.log'),
    ]);


    $admin = User::where('email', 'hola@sode.pe')->first();

    $id = $request->id;

    $gclid = $request->gclid;
    $conversion_value = $request->conversion_value;
    $currency_code = $request->currency_code;
    $conversion_action = $request->conversion_action;
    $conversion_time = $request->conversion_time;
    $closed_at = $request->closed_at;

    if (!$gclid) {
      return response()->json(['ok' => false, 'message' => 'La orden no tiene GCLID'], 422);
    }

    dump('entrando here2');

    $conversion = ConversionGoogleAds::firstOrCreate(
      ['orden_id' => $id],
      [
        'gclid' => $gclid,
        'conversion_value' => $conversion_value,
        'currency_code' => $currency_code,
        'conversion_action' => $conversion_action,
        'conversion_time' => $conversion_time,
        'closed_at' => $closed_at,
        'status' => 'pending',
        'attempts' => 0
      ]
    );

    if ($conversion->status === 'sent') {
      return response()->json(['ok' => true, 'message' => 'Ya enviada anteriormente']);
    }

    try {
      // 4️⃣ Envío
      $response = $service->sendconversionOffline([
        'customer_id'          => config('google_ads.customer_id'),
        'refresh_token'        => $admin->google_ads_refresh_token,
        'conversion_action_id' => $conversion_action,
        'gclid'                => $gclid,
        'value'                => $conversion_value,
        'currency'             => $currency_code,

        'conversion_date_time' => $conversion->conversion_time->format('Y-m-d H:i:sP'),
      ], $admin);

      $googleLog->info("--- Intento de Envío: ID Local {$conversion->id} ---");

      // 5️⃣ VALIDACIÓN DE ERROR PARCIAL (El "silencioso")
      if ($response && method_exists($response, 'hasPartialFailureError') && $response->hasPartialFailureError()) {
        $errorMsg = $response->getPartialFailureError()->getMessage();

        $googleLog->error("RECHAZADO POR DATOS (Partial Failure): " . $errorMsg);

        $conversion->update([
          'status' => 'failed',
          'error_message' => $errorMsg,
          'attempts' => $conversion->attempts + 1,
        ]);

        return response()->json(['ok' => false, 'message' => 'Google rechazó los datos: ' . $errorMsg]);
      }

      // 6️⃣ ÉXITO REAL
      $googleLog->info("ACEPTADO: " . ($response->getResults()[0]->serializeToJsonString() ?? 'OK'));

      $conversion->update([
        'status'   => 'sent',
        'sent_at'  => now(),
        'attempts' => $conversion->attempts + 1,
        'error_message' => null
      ]);

      return response()->json(['ok' => true, 'message' => 'Conversión enviada correctamente']);
    } catch (GoogleAdsException $googleAdsException) {
      // Este atrapa errores de configuración/permisos/Login-Customer-Id
      $errors = [];
      foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
        $errors[] = $error->getErrorCode()->getErrorCode() . ": " . $error->getMessage();
      }
      $finalError = implode(" | ", $errors);

      $googleLog->critical("ERROR TÉCNICO GOOGLE ADS:", ['errores' => $errors]);

      $conversion->update([
        'status' => 'failed',
        'error_message' => $finalError,
        'attempts' => $conversion->attempts + 1,
      ]);

      return response()->json(['ok' => false, 'error' => $finalError], 500);
    } catch (ApiException $apiException) {
      // Errores de red/conexión
      $googleLog->emergency("ERROR API (RED): " . $apiException->getMessage());
      return response()->json(['ok' => false, 'error' => 'Error de conexión'], 500);
    } catch (\Throwable $e) {
      // ERROR GENERAL (Siempre al final)
      $googleLog->error("ERROR GENERAL: " . $e->getMessage());
      dump($e);

      $conversion->update([
        'status' => 'failed',
        'error_message' => $e->getMessage(),
        'attempts' => $conversion->attempts + 1,
      ]);

      return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
    }
  }
}
