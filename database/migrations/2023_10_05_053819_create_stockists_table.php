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
        Schema::create('stockists', function (Blueprint $table) {
            $table->id();
            $table->string('stockist', 255)->nullable();
            $table->foreignId('employee_id_1', 11)->nullable();          
            $table->foreignId('employee_id_2', 11)->nullable();          
            $table->foreignId('employee_id_3', 11)->nullable();          
            $table->foreignId('created_by', 11)->nullable();
            $table->foreignId('updated_by', 11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockists');
    }
};
