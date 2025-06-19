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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('ctm_no',30)->primary()->comment('客戶編號');
            $table->string('ctm_name',50)->comment('客戶名稱');
            $table->string('ctm_uno',20)->comment('統一編號');
            $table->string('ctm_tel',20)->comment('電話');
            $table->string('ctm_fax',20)->comment('傳真');
            $table->string('ctm_adrs1',255)->comment('公司地址');
            $table->string('ctm_adrs2',255)->comment('發票地址');
            $table->string('ctm_remark',255)->comment('備註');
            $table->string('ctm_rp',20)->comment('負責人');
            $table->string('ctm_rptel',20)->comment('負責人電話');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
