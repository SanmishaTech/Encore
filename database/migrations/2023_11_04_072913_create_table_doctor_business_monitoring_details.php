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
        Schema::create('doctor_business_monitoring_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_business_monitoring_id', 11)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('reason', 255)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_business_monitoring_details');
    }
};
