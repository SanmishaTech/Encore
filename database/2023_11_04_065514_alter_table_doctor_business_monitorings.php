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
        Schema::table('doctor_business_monitorings', function (Blueprint $table) {
            $table->string('status', 30)->nullable();
            $table->integer('approval_level_1')->unsigned()->nullable();
            $table->integer('approval_level_2')->unsigned()->nullable();
            $table->date('approved_on')->nullable();
            $table->decimal('approved_amount', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_business_monitorings', function (Blueprint $table) {
            //
        });
    }
};
