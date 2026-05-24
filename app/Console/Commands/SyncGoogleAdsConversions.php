<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ordenes;
use App\Models\ConversionGoogleAds;
use App\Services\GoogleAdsService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;

class SyncGoogleAdsConversions extends Command
{
  // El nombre con el que lo llamarás: php artisan ads:sync-conversions
  protected $signature = 'ads:sync-conversions';
  protected $description = 'Sincroniza las conversiones de órdenes pagadas con Google Ads';

  public function handle(GoogleAdsService $service)
  {
    $googleLog = Log::build([
      'driver' => 'single',
      'path' => storage_path('logs/google_ads_debug.log'),
    ]);

    $this->info('Iniciando sincronización masiva...');
    $puntoCorte = Carbon::now()->subHours(12);

    // NOTA: En consola no hay auth()->user(). 
    // Debes obtener al admin/usuario que tiene el token de la DB.

    // $admin = User::whereNotNull('google_refresh_token')->first();


    $admin = User::where('email', 'hola@sode.pe')->first();
    if (!$admin) {
      $this->error("Error: No se encontró al usuario administrador para sincronizar.");
      return self::FAILURE;
    }


    $conversiones = ConversionGoogleAds::where('status', '!=', 'sent')
      ->where('created_at', '<=', $puntoCorte)
      ->get();




    $this->info("Ordenes encontradas: " . $conversiones->count());
    $results = ['success' => 0, 'failed' => 0];


    foreach ($conversiones as $conversion) {

      if ($conversion->status === 'sent') continue;


      try {
        $response = $service->sendConversionAdvanced([
          // 'customer_id'          => config('google_ads.customer_id'),
          'customer_id'          => $conversion->customer_id,
          'refresh_token'        => $admin->google_ads_refresh_token,
          'conversion_action_id' => $conversion->conversion_action,
          'gclid'                => $conversion->gclid,
          'value'                => $conversion->conversion_value,
          'currency'             => $conversion->currency_code,
          'email' => $conversion->email,
          'phone'   => $conversion->phone,
          'conversion_date_time' => $conversion->conversion_time->format('Y-m-d H:i:sP'),
        ]);

        if ($response && method_exists($response, 'hasPartialFailureError') && $response->hasPartialFailureError()) {
          $errorMsg = $response->getPartialFailureError()->getMessage();
          $conversion->update([
            'status' => 'failed',
            'error_message' => $errorMsg,
            'attempts' => $conversion->attempts + 1
          ]);
          $results['failed']++;
          continue;
        }

        $conversion->update([
          'status' => 'sent',
          'sent_at' => now(),
          'attempts' => $conversion->attempts + 1,
          'error_message' => null
        ]);
        $results['success']++;
      } catch (\Exception $e) {

        $conversion->update([
          'status' => 'failed',
          'error_message' => $e->getMessage(),
          'attempts' => $conversion->attempts + 1
        ]);
        $results['failed']++;
        $googleLog->error("Error en GCLID {$conversion->gclid}: " . $e->getMessage());
      }
    }

    $this->table(['Estado', 'Cantidad'], [
      ['Exitosas', $results['success']],
      ['Fallidas', $results['failed']]
    ]);

    return self::SUCCESS;
  }
}
