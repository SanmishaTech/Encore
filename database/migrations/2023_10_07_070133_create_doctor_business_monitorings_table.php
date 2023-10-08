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
        Schema::create('doctor_business_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id_1',255)->nullable();
            $table->string('employee_id_2',255)->nullable();
            $table->string('employee_id_3',255)->nullable();
            $table->string('roi',20)->nullable();
            $table->date('date')->nullable();
            $table->string('product_id',255)->nullable();
            $table->decimal('nrv',10,2)->nullable();
            $table->string('doctor_id',255)->nullable();
            $table->integer('mpl_no')->unsigned();
            $table->string('speciality',20)->nullable();
            $table->string('location',20)->nullable();
            $table->string('month',20)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('code')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_business_monitorings');
    }
};
