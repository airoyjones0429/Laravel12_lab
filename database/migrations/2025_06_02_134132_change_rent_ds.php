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
        Schema::table('rent_ds', function (Blueprint $table) {
            //
            $table->string('RENT_DMODEL', 30)->nullable()->change();
            $table->date('RENT_DDATE')->nullable()->change();
            $table->string('RENT_DMSN', 80)->nullable()->change();
            $table->date('RENT_DDATE1')->nullable()->change();
            $table->date('RENT_DDATE2')->nullable()->change();
            $table->float('RENT_DAY')->nullable()->change();
            $table->float('RENT_AMT')->nullable()->change();
            $table->date('RENT_FDATE')->nullable()->change();
            $table->smallInteger('RENT_FEE')->nullable()->change();
            $table->string('RENT_Contract_No')->nullable()->change();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent_ds', function (Blueprint $table) {
            //
            $table->string('RENT_DMODEL', 30)->nullable(false)->change();
            $table->date('RENT_DDATE')->nullable(false)->change();
            $table->string('RENT_DMSN', 80)->nullable(false)->change();
            $table->date('RENT_DDATE1')->nullable(false)->change();
            $table->date('RENT_DDATE2')->nullable(false)->change();
            $table->float('RENT_DAY')->nullable(false)->change();
            $table->float('RENT_AMT')->nullable(false)->change();
            $table->date('RENT_FDATE')->nullable(false)->change();
            $table->smallInteger('RENT_FEE')->nullable(false)->change();
            $table->string('RENT_Contract_No')->nullable(false)->change();               
        });
    }
};
