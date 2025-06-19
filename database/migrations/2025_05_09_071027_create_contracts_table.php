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
        //合約檔案
        //一個機具同一時間只能有一個合約
        //一個合約可以有多個機具
        Schema::create('contracts', function (Blueprint $table) {
            $table->string('mach_no',30)->primary()->comment('自訂編號');
            $table->string('mach_rentctmno',30)->comment('目前合約客戶編號');
            $table->string('mach_rentctmname',50)->commetn('目前合約客戶名稱');
            $table->string('mach_rentctmuno',30)->comment('目前合約客戶統一編號');
            $table->date('mach_rentdate1')->comment('目前合約開始日期');
            $table->date('mach_rentdate2')->comment('目前合約結束日期');
            $table->float('mach_rentdays')->comment('目前合約租賃天數');
            $table->string('mach_rentno',30)->comment('目前合約請款單號(租賃單號)');
            $table->mediumInteger('mach_rentamt')->comment('目前合約機具請款金額');
            $table->mediumInteger('mach_rentfee')->comment('目前合約機具運費');
            $table->date('mach_rentfdate')->comment('目前合約退租日期');
            $table->string('mach_contract_no',30)->comment('目前合約租賃編號');
            $table->string('mach_rentremark',255)->comment('目前合約備註');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
