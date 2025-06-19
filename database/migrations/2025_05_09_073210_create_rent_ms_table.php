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
        Schema::create('rent_ms', function (Blueprint $table) {
            $table->string('RENT_NO', 30)->primary()->comment('租賃單號');
            $table->date('RENT_PDATE')->comment('列表日期');
            $table->string('RENT_UNO', 20)->comment('發票編號');
            $table->date('RENT_UNO_DAT')->comment('發票日期');
            $table->string('RENT_CNO', 30)->comment('請款客戶編號');
            $table->string('RENT_CNAME', 50)->comment('請款客戶名稱');
            $table->string('RENT_CTMUNO', 20)->comment('請款客戶統編');
            $table->text('RENT_CTMADRS')->comment('請款客戶帳單地址');
            $table->string('RENT_ADRS')->comment('請款工地');
            $table->text('RENT_REMARK')->comment('請款備註');
            $table->mediumInteger('RENT_TOTAL1')->comment('未稅總金額');
            $table->timestamps(); // 這會自動添加 created_at 和 updated_at 欄位
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_ms');
    }
};
