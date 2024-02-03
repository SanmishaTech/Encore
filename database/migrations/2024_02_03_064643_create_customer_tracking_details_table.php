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
        Schema::create('customer_tracking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_tracking_id', 11)->nullable();
            $table->foreignId('doctor_id', 11)->nullable();
            $table->string('speciality', 50)->nullable();
            $table->string('location', 50)->nullable();
            $table->foreignId('product_id', 11)->nullable();
            $table->decimal('nrv', 10,2)->nullable();
            $table->decimal('qty', 10,2)->nullable();
            $table->decimal('val',10,2)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_tracking_details');
    }
};
