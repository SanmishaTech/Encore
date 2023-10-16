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
        Schema::create('roi_accoutability_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id_1')->unsigned()->nullable();
            $table->integer('employee_id_2')->unsigned()->nullable();
            $table->integer('employee_id_3')->unsigned()->nullable();
            $table->foreignId('grant_approval_id', 11)->nullable();  
            $table->foreignId('doctor_id', 11)->nullable();  
            $table->string('roi',20)->nullable();
            $table->date('rar_date')->nullable();
            $table->string('proposal_month',20)->nullable();
            $table->decimal('amount',10,2)->nullable();            
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
        Schema::dropIfExists('roi_accoutability_reports');
    }
};
