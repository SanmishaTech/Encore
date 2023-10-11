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
        Schema::table('product_details', function (Blueprint $table) {
            $table->integer('avg_business_units')->unsigned()->nullable();
            $table->decimal('avg_business_value',10,2)->nullable();
            $table->decimal('exp_vol',10,2)->nullable();
            $table->decimal('exp_vol_1',10,2)->nullable();
            $table->decimal('exp_vol_2',10,2)->nullable();
            $table->decimal('exp_vol_3',10,2)->nullable();
            $table->decimal('exp_vol_4',10,2)->nullable();
            $table->decimal('exp_vol_5',10,2)->nullable();
            $table->decimal('exp_vol_6',10,2)->nullable();
            $table->decimal('total_exp_vol',10,2)->nullable();
            $table->decimal('total_exp_val',10,2)->nullable();
            $table->string('scheme',20)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
            //
        });
    }
};
