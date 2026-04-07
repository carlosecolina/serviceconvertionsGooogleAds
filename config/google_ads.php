<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Google Ads Customer ID
    |--------------------------------------------------------------------------
    | ID de la cuenta de Google Ads (SIN guiones)
    | Ej: 1234567890
    */

  'customer_id' => env('GOOGLE_ADS_CUSTOMER_ID'),

  /*
    |--------------------------------------------------------------------------
    | Conversion Actions
    |--------------------------------------------------------------------------
    | IDs de objetivos de conversión
    */

  'conversions' => [
    'purchase' => env('GOOGLE_ADS_CONVERSION_PURCHASE'),
    'lead'     => env('GOOGLE_ADS_CONVERSION_LEAD'),
  ],

];
