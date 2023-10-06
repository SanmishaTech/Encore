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
        Schema::create('grant_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id_1',255)->nullable();
            $table->string('employee_id_2',255)->nullable();
            $table->string('employee_id_3',20)->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->integer('mpl_no')->unsigned();
            $table->string('speciality',20)->nullable();
            $table->string('location',255)->nullable();
            $table->date('date');
            $table->date('proposal_date');
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->string('code')->nullable();
            $table->string('email',20)->nullable();
            $table->string('contact_no',20)->nullable();
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
        Schema::dropIfExists('grant_approvals');
    }
};
