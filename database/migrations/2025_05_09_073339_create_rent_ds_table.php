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
        // MySQL 只有主鍵可以設定成自動遞增...，這是在遷移時，出現的錯誤訊息
        // 如果直接操作 MySQL 尚不知，是否會錯誤 ，使用 phpMyAdmin 操作仍然是錯誤
        Schema::create('rent_ds', function (Blueprint $table) {
            $table->string('RENT_NO', 30)->comment('租賃單號');
            $table->tinyInteger('RENT_DNO')->comment('請款明細流水號'); //設定成自動遞增欄位
            $table->primary(['RENT_NO','RENT_DNO']); //設定複合主鍵
            $table->string('RENT_DMODEL', 30)->comment('請款機具型式');
            $table->date('RENT_DDATE')->comment('請款合約日期');
            $table->string('RENT_DMSN', 80)->comment('請款機具編號');
            $table->date('RENT_DDATE1')->comment('請款開始計算日期');
            $table->date('RENT_DDATE2')->comment('請款最後計算日期');
            $table->float('RENT_DAY')->comment('天數');
            $table->float('RENT_AMT')->comment('請款金額');
            $table->date('RENT_FDATE')->comment('退租日期');
            $table->smallInteger('RENT_FEE')->comment('運費');
            $table->string('RENT_Contract_No')->comment('租賃合約編號');
            $table->timestamps(); // 這會自動添加 created_at 和 updated_at 欄位
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_ds');
    }
};
