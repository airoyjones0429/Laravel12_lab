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
        Schema::table('machines', function (Blueprint $table) {
            //下面的寫法會新增這個欄位
            // $table->string('Mach_ReMark', 255)->nullable();

            //下面的寫法才是修改原本就有的欄位屬性，長度不可以省略
            //設定欄位接受 null 
            $table->string('Mach_ReMark', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            //還原異動的方法
            $table->string('Mach_ReMark', 255)->nullable(false)->change();
        });
    }
};
