<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversion_actions_config', function (Blueprint $table) {
            $table->id();
            // Google Ads IDs pueden superar el límite de un integer estándar
            $table->bigInteger('google_conversion_id')->unsigned();
            $table->string('name'); // Ejemplo: "Ventas Web Oficial"
            $table->string('code'); // Ejemplo: "web" o "whatsapp"
            $table->boolean('is_active')->default(true);
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable(); // Para el histórico
            $table->timestamps();

            // Índice para búsquedas rápidas por código activo
            $table->index(['code', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_actions_config');
    }
};
