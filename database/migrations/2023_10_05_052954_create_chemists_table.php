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
        Schema::create('chemists', function (Blueprint $table) {
            $table->id();
            $table->string('chemist', 255)->nullable();
            $table->foreignId('employee_id', 11)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->foreignId('territory_id', 11)->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->string('contact_no_1', 255)->nullable();
            $table->string('contact_no_2', 255)->nullable();
            $table->string('email', 255)->nullable();
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
        Schema::dropIfExists('chemists');
    }
};
