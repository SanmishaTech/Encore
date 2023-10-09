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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name',255)->nullable();
            $table->string('email',255)->nullable();
            $table->string('contact_no_1',20)->nullable();
            $table->string('contact_no_2',20)->nullable();
            $table->string('address',255)->nullable();
            $table->string('designation',20)->nullable();
            $table->string('state_name',20)->nullable();
            $table->string('city',20)->nullable();
            $table->string('fieldforce_name',20)->nullable();
            $table->string('employee_code')->nullable();
            $table->string('password');
            $table->date('dob');
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
        Schema::dropIfExists('employees');
    }
};
