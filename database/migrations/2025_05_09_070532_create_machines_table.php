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
        Schema::create('machines', function (Blueprint $table) {
            $table->string('Mach_No', 30)->primary()->comment('自訂編號');
            $table->string('Mach_Model', 30)->comment('機具型式');
            $table->string('Mach_ModeNo', 50)->comment('機具編號');
            $table->date('Mach_Date1')->comment('進貨日期');
            $table->date('Mach_Date2')->comment('除役日期');
            $table->string('Mach_ReMark', 255)->comment('備註');
            $table->smallInteger('Mach_Years')->comment('機具年分');
            $table->timestamps(); // 這會自動添加 created_at 和 updated_at 欄位
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
