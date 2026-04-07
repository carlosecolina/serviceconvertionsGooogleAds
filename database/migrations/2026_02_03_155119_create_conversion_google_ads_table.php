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
        Schema::create('conversion_google_ads', function (Blueprint $table) {
            $table->id();

            $table->string('orden_id');
            $table->string('gclid');
            $table->decimal('conversion_value', 10, 2);
            $table->string('currency_code', 3)->default('PEN');

            $table->string('conversion_action');
            $table->timestamp('conversion_time');
            $table->timestamp('closed_at');

            $table->enum('status', [
                'pending',
                'sent',
                'failed'
            ])->default('pending');

            $table->integer('attempts')->default(0);
            $table->text('error_message')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_google_ads');
    }
};
