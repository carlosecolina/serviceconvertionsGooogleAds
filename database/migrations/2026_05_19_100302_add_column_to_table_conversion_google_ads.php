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
        Schema::table('conversion_google_ads', function (Blueprint $table) {
            //
            $table->string('customer_id')->after('conversion_action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('conversion_google_ads', function (Blueprint $table) {
            //
            $table->dropColumn('customer_id');
        });
    }
};
