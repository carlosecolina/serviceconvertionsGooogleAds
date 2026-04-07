<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConversionActionConfig extends Model
{
    use HasFactory;
    protected $table = 'conversion_actions_config';

    protected static function booted()
    {

        static::saving(function ($config) {

            if ($config->is_active) {


                static::where('code', $config->code)
                    ->where('is_active', true)
                    ->where('id', '!=', $config->id)
                    ->update([
                        'is_active' => false,
                        // Convertimos Carbon a string compatible con SQL (Y-m-d H:i:s)
                        'ended_at'  => now()->toDateTimeString()
                    ]);



                $config->started_at = $config->started_at ?? now();
                $config->ended_at = null;
            }
        });
    }

    protected $fillable = [
        'google_conversion_id',
        'name',
        'code',
        'is_active',
        'started_at',
        'ended_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'google_conversion_id' => 'integer',
    ];

    /**
     * Scope para obtener solo la configuración activa de un canal específico.
     * Uso: ConversionActionConfig::activeFor('whatsapp')->first();
     */
    public function scopeActiveFor($query, string $code)
    {
        return $query->where('code', $code)
            ->where('is_active', true);
    }


    /**
     * Relación con las órdenes
     */
}
