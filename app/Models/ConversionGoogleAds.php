<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionGoogleAds extends Model
{
    use HasFactory;
    protected $table = 'conversion_google_ads';

    protected $casts = [
        'conversion_time' => 'datetime',
    ];

    protected $fillable = [

        'orden_id',
        'gclid',
        'conversion_value',
        'currency_code',
        'conversion_action',
        'conversion_time',
        'closed_at',
        'status',
        'attempts',
        'error_message',
        'sent_at',
        'email',
        'phone',
        'customer_id'
    ];
}
