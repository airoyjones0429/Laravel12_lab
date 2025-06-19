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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('emp_code',6)->primary()->comment('編號');
            $table->string('emp_name',20)->comment('姓名');
            $table->string('emp_pwd',60)->comment('密碼');  //密碼必須要用 HASH 加密，不然 Laravel 會出現錯誤 (強制性)
            $table->tinyInteger('emp_lv')->comment('權限');
            $table->string('emp_tel')->comment('分機號碼');
            $table->timestamps();// 這會自動添加 created_at 和 updated_at 欄位
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
