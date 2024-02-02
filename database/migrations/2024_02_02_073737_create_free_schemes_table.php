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
        Schema::create('free_schemes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id',11)->nullable();
            $table->foreignId('stockist_id',11)->nullable();
            $table->foreignId('chemist_id',11)->nullable();
            $table->foreignId('doctor_id',11)->nullable();
            $table->string('location',100)->nullable();
            $table->date('proposal_date')->nullable();
            $table->string('proposal_month',255)->nullable();
            $table->enum('open_scheme', ['Yes', 'No'])->nullable();
            $table->string('scheme',20)->nullable();
            $table->enum('crm_done', ['Yes', 'No'])->nullable();
            $table->enum('dr_own_counter', ['Yes', 'No'])->nullable();
            $table->decimal('amount',10,2)->nullable();
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
        Schema::dropIfExists('free_schemes');
    }
};
