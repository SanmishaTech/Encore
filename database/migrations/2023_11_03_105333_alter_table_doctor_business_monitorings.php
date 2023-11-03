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
        Schema::table('doctor_business_monitorings', function (Blueprint $table) {
            $table->decimal('total_expected_value', 10, 2)->nullable();
            $table->decimal('total_business_value', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_business_monitorings', function (Blueprint $table) {
            //
        });
    }
};
