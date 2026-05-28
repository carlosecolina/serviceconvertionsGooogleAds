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
  //{
  public function setConvertionsValues(Request $request)
  {
    Log::info('GHL Webhook Recibido - setConvertionsValues', [
      'url'        => $request->fullUrl(),
      'method'     => $request->method(),
      'ip'         => $request->ip(),
      'headers'    => $request->headers->all(), // Útil para verificar tokens de autenticación de GHL
      'payload'    => $request->all()           // Captura todo el JSON o POST data
    ]);


    try {
      // 1. Validar apuntando a customData usando la notación de puntos
      $validator = Validator::make($request->all(), [
        'customData.gclid'             => 'required|string|min:10',
        'customData.conversion_value'  => 'required|numeric|min:0',
        'customData.currency_code'     => 'required|string|size:3',
        'customData.conversion_action' => 'required|string',
        'customData.customer_id'       => 'required|string',
      ]);

      if ($validator->fails()) {
        return response()->json([
          'status' => 'error',
          'message' => 'Validación fallida',
          'errors' => $validator->errors()
        ], 422);
      }

      // 2. Extraer los datos validados usando data_get de forma segura
      $gclid             = data_get($request, 'customData.gclid');
      $conversion_value  = data_get($request, 'customData.conversion_value');
      $currency_code     = data_get($request, 'customData.currency_code');
      $conversion_action = data_get($request, 'customData.conversion_action');
      $customer_id       = data_get($request, 'customData.customer_id');

      // Datos adicionales que vienen en la raíz o en otros nodos del JSON de GHL
      $email             = data_get($request, 'customData.email') ?? data_get($request, 'email');
      $phone             = data_get($request, 'phone'); // Viene directo en la raíz: +51934788587

      // 3. Setear las fechas con Carbon como lo necesitas
      $conversion_time   = Carbon::now();
      $closed_at         = Carbon::now();


      $conversion = ConversionGoogleAds::create(

        [
          'gclid' => $gclid,
          'conversion_value' => $conversion_value,
          'currency_code' => $currency_code,
          'conversion_action' => $conversion_action,
          'customer_id' => $customer_id,
          'conversion_time' => $conversion_time,
          'currency'             => $currency_code,

          'email' => $email,
          'phone' => $phone,
          'closed_at' => $closed_at,
          'status' => 'pending',
          'attempts' => 0
        ]
      );

      return response()->json(['ok' => true, 'message' => 'conversion guardada lista para ser enviada'], 200);
    } catch (\Throwable $th) {
      //throw $th;
      Log::error('Error al procesar la conversión', [
        'error_message' => $th->getMessage(),
        'file'          => $th->getFile(),
        'line'          => $th->getLine(),
        'request_data'  => $request->all() // Esto guarda TODO lo que venía en la petición
      ]);

      // 2. Retornamos la respuesta al cliente
      return response()->json([
        'ok' => false,
        'message' => 'No se guardaron los datos'
      ], 400);
    }
  }
  /* public function sync(Request $request, GoogleAdsService $service)
  {





    $googleLog = Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/google_ads_debug.log'),
    ]);


    $admin = User::where('email', 'hola@sode.pe')->first();

    

    try {


      // 4️⃣ Envío
      $response = $service->sendConversionAdvanced([
        // 'customer_id'          => config('google_ads.customer_id'),
        'customer_id'          => $customer_id,
        'refresh_token'        => $admin->google_ads_refresh_token,
        'conversion_action_id' => $conversion_action,
        'gclid'                => $gclid,
        'value'                => $conversion_value,
        'currency'             => $currency_code,
        'email' => $email,
        'phone'   => $phone,
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
      

      $googleLog->emergency("ERROR API (RED): " . $apiException->getMessage());
      return response()->json(['ok' => false, 'error' => 'Error de conexión'], 500);
    } catch (\Throwable $e) {
      
      $googleLog->error("ERROR GENERAL: " . $e->getMessage());


      $conversion->update([
        'status' => 'failed',
        'error_message' => $e->getMessage(),
        'attempts' => $conversion->attempts + 1,
      ]);

      return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
    }
  } */
}
