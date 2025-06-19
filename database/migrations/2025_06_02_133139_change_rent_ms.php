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
        Schema::table('rent_ms', function (Blueprint $table) {
            
            //修改原本就有的欄位屬性，長度不可以省略            
            $table->date('RENT_PDATE')->nullable()->change();
            $table->string('RENT_UNO', 20)->nullable()->change();
            $table->date('RENT_UNO_DAT')->nullable()->change();
            $table->string('RENT_CNO', 30)->nullable()->change();
            $table->string('RENT_CNAME', 50)->nullable()->change();
            $table->string('RENT_CTMUNO', 20)->nullable()->change();
            $table->text('RENT_CTMADRS')->nullable()->change();
            $table->string('RENT_ADRS')->nullable()->change();
            $table->text('RENT_REMARK')->nullable()->change();
            $table->mediumInteger('RENT_TOTAL1')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            //還原異動的方法
            //修改原本就有的欄位屬性，長度不可以省略            
            $table->date('RENT_PDATE')->nullable(false)->change();
            $table->string('RENT_UNO', 20)->nullable(false)->change();
            $table->date('RENT_UNO_DAT')->nullable(false)->change();
            $table->string('RENT_CNO', 30)->nullable(false)->change();
            $table->string('RENT_CNAME', 50)->nullable(false)->change();
            $table->string('RENT_CTMUNO', 20)->nullable(false)->change();
            $table->text('RENT_CTMADRS')->nullable(false)->change();
            $table->string('RENT_ADRS')->nullable(false)->change();
            $table->text('RENT_REMARK')->nullable(false)->change();
            $table->mediumInteger('RENT_TOTAL1')->nullable(false)->change();
        });
    }
};
