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
        Schema::create('customer_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id',11)->nullable(); 
            $table->date('proposal_date')->nullable();
            $table->string('proposal_month',255)->nullable();
            $table->string('primary',20)->nullable();
            $table->string('secondary',20)->nullable();
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
        Schema::dropIfExists('customer_trackings');
    }
};
