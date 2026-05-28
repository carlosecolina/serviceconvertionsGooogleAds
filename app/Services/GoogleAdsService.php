<?php

namespace App\Services;

use App\Models\ConversionGoogleAds;
use App\Models\User;
use Google\Ads\GoogleAds\Lib\V23\GoogleAdsClientBuilder;

use Google\Ads\GoogleAds\V23\Services\ClickConversion as ServicesClickConversion;
use Google\Ads\GoogleAds\V23\Services\UploadClickConversionsRequest as ServicesUploadClickConversionsRequest;
use Illuminate\Support\Facades\Log;
use Google\Auth\Credentials\UserRefreshCredentials;

use Google\Ads\GoogleAds\Lib\V23\GoogleAdsClient;
use Google\Ads\GoogleAds\V23\Common\UserIdentifier as CommonUserIdentifier;
use Google\Ads\GoogleAds\V23\Services\GoogleAdsRow;
use Google\Ads\GoogleAds\V23\Services\SearchGoogleAdsRequest;
use Google\Ads\GoogleAds\V23\Enums\CampaignStatusEnum\CampaignStatus;
use Google\Auth\Credentials\ServiceAccountCredentials;


use Google\Ads\GoogleAds\V23\Enums\UserIdentifierSourceEnum\UserIdentifierSource;

class GoogleAdsService
{


  public function sendConversion($data)
  {
    $oAuth2Credential = $this->getOautCredentials();

    $googleAdsClient = (new GoogleAdsClientBuilder())
      ->withOAuth2Credential($oAuth2Credential)
      ->withDeveloperToken(config('services.google_ads.developer_token'))
      ->withLoginCustomerId($data['customer_id'])
      ->build();


    $conversion = new ServicesClickConversion([
      'conversion_action' => 'customers/' . $data['customer_id'] . '/conversionActions/' . $data['conversion_action_id'],
      'gclid' => $data['gclid'],
      'conversion_date_time' =>  now()->format('Y-m-d H:i:sP'),
      'conversion_value' => $data['value'],
      'currency_code' => 'PEN',
    ]);


    $request = new ServicesUploadClickConversionsRequest([
      'customer_id' => $data['customer_id'],
      'conversions' => [$conversion],
      'validate_only' => true,
      'partial_failure' => true,
    ]);

    return $googleAdsClient
      ->getConversionUploadServiceClient()
      ->uploadClickConversions($request);
  }

  public function sendConversionAdvanced($data)
  {
    $oAuth2Credential = $this->getOautCredentials();


    $googleAdsClient = (new GoogleAdsClientBuilder())
      ->withOAuth2Credential($oAuth2Credential)
      ->withDeveloperToken(config('services.google_ads.developer_token'))
      ->withLoginCustomerId(config('google_ads.customer_id'))
      ->build();


    // 1. Preparamos los identificadores de usuario
    $userIdentifiers = [];
    // 1. Validar e insertar Email si existe
    if (!empty($data['email'])) {
      $userIdentifiers[] = new CommonUserIdentifier([
        'user_identifier_source' => UserIdentifierSource::FIRST_PARTY,
        'hashed_email' => hash('sha256', strtolower(trim($data['email'])))
      ]);
    }

    // 2. Validar e insertar Teléfono si existe
    if (!empty($data['phone'])) {
      // Tip: Google requiere que el teléfono tenga el formato internacional (ej: +51934788587)
      // Como GoHighLevel ya te lo manda con "+51", solo limpiamos espacios.
      $userIdentifiers[] = new CommonUserIdentifier([
        'user_identifier_source' => UserIdentifierSource::FIRST_PARTY,
        'hashed_phone_number' => hash('sha256', trim($data['phone']))
      ]);
    }

    $conversionData = [
      'conversion_action' => 'customers/' . $data['customer_id'] . '/conversionActions/' . $data['conversion_action_id'],
      'gclid' => $data['gclid'],
      'conversion_date_time' => $data['conversion_date_time'],
      'conversion_value' => $data['value'],
      'currency_code' => $data['currency_code'],
    ];

    if (!empty($userIdentifiers)) {
      $conversionData['user_identifiers'] = $userIdentifiers;
    }

    // 2. Integramos en tu objeto de conversión
    $conversion = new ServicesClickConversion($conversionData);


    $request = new ServicesUploadClickConversionsRequest([
      'customer_id' => $data['customer_id'],
      'conversions' => [$conversion],
      'validate_only' => false,
      'partial_failure' => true,
    ]);

    return $googleAdsClient
      ->getConversionUploadServiceClient()
      ->uploadClickConversions($request);
  }

  public function sendconversionOffline($data, $user)
  {

    $oAuth2Credential = new UserRefreshCredentials(
      null, // Scopes (normalmente no se requieren aquí si ya tienes el refresh_token)
      [
        'client_id'     => config('services.google.client_id'),
        'client_secret' => config('services.google.client_secret'),
        'refresh_token' => $user->google_refresh_token
      ]
    );

    $googleAdsClient = (new GoogleAdsClientBuilder())
      ->withOAuth2Credential($oAuth2Credential)
      ->withDeveloperToken(config('services.google_ads.developer_token'))
      ->withLoginCustomerId($data['customer_id'])
      ->build();


    $conversion = new ServicesClickConversion([
      'conversion_action' => 'customers/' . $data['customer_id'] . '/conversionActions/' . $data['conversion_action_id'],
      'gclid' => $data['gclid'],
      'conversion_date_time' =>  now()->format('Y-m-d H:i:sP'),
      'conversion_value' => $data['value'],
      'currency_code' => 'PEN',
    ]);


    $request = new ServicesUploadClickConversionsRequest([
      'customer_id' => $data['customer_id'],
      'conversions' => [$conversion],
      'validate_only' => true,
      'partial_failure' => true,
    ]);

    return $googleAdsClient
      ->getConversionUploadServiceClient()
      ->uploadClickConversions($request);
  }


  private function getOautCredentials()
  {
    $user = User::where('email', 'hola@sode.pe')->first();
    $oAuth2Credential = new UserRefreshCredentials(
      null,
      [
        'client_id'     => config('services.google.client_id'),
        'client_secret' => config('services.google.client_secret'),
        'refresh_token' => $user->google_refresh_token
      ]
    );

    return $oAuth2Credential;
  }





  public function getActiveConversionIds(int $customerId)
  {

    $oAuth2Credential = $this->getOautCredentials();

    $googleAdsClient = (new GoogleAdsClientBuilder())
      ->withOAuth2Credential($oAuth2Credential)
      ->withDeveloperToken(config('services.google_ads.developer_token'))
      ->withLoginCustomerId(config('google_ads.customer_id'))
      ->build();

    $googleAdsServiceClient = $googleAdsClient->getGoogleAdsServiceClient();

    // Query para traer solo las activas
    $query = "SELECT conversion_action.id, conversion_action.name 
              FROM conversion_action 
              WHERE conversion_action.status = 'ENABLED'";

    $request = SearchGoogleAdsRequest::build($customerId, $query);
    $stream = $googleAdsServiceClient->search($request);

    $map = [];

    foreach ($stream->iterateAllElements() as $googleAdsRow) {
      $con = $googleAdsRow->getConversionAction();
      $map[] = [
        "convertion_id" => $con->getId(),
        "name" => $con->getName()
      ];
    }

    return $map;
  }
}
