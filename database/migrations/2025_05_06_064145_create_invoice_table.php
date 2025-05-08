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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            //=== 以下是   有正負號   數值  整數  宣告方式
            // $table->tinyInteger('qty1');    //增加 qty1 欄位，1 byte (-128 ~ +127)
            // $table->smallInteger('qty2');   //增加 qty2 欄位，2 byte (-32768 ~ +32767)
            // $table->mediumInteger('qty3');  //增加 qty3 欄位，3 byte (-8388608 ~ +8388607)
            // $table->bigInteger('qty4');     //增加 qty4 欄位，8 byte (-9223372036854775808 ~ 9223372036854775807) 

            //=== 以下是   無正負號   數值  整數  宣告方式
            // $table->tinyInteger('qty12',false,true);    //增加 qty12 欄位，1 byte ( 0 ~ 255 )
            // $table->smallInteger('qty22',0,1);          //增加 qty22 欄位，2 byte ( 0 ~ 65535 )
            // $table->mediumInteger('qty32',0,1);         //增加 qty32 欄位，3 byte ( 0 ~ 16777215 )
            // $table->bigInteger('qty42',0,1);            //增加 qty42 欄位，4 byte ( 0 ~ 18446744073709551615)

            //=== 以下是字串宣告方式
            // $table->string('str1');//字串，預設長度為 255
            // $table->text('text');//長字串，最多可儲存 65,535 字元（約 64 KB）。
            // $table->mediumText('medtext');//中型長字串，最多可儲存 16,777,215 字元（約 16 MB）。
            // $table->longText('lngtext');//長長字串，最多可儲存 4,294,967,295 字元（約 4 GB）。

            //=== 以下是浮點數
            // $table->float('float1');//浮點數，比較不要求精度，可以使用
            // $table->double('double1');//雙精度浮點數，精度較高
            // $table->decimal('decimal1');//十進位數，通常用於金額

            // //=== 布林型
            // $table->boolean('bool1');//布林值（真或假），資料庫用 tinyInt 儲存

            //=== 日期和時間型
            // $table->date('date1');//日期 '2025-05-06'
            // $table->time('time1');//時間 '12:05:35'
            // $table->dateTime('dateTime1');//日期和時間 '2025-05-06 12:50:32'
            // $table->softDeletes();//用於軟刪除的時間戳記，自動產生 deleted_at 欄位
            $table->timestamps(); //自動產生 updated_at、created_at 欄位

            //=== 其他資料類型
            // $table->json('json1');//JSON 格式的資料
            // $table->jsonb('jsonb1');//二進位 JSON 格式的資料（在 PostgreSQL 中使用）。
            // $table->binary('binary1');//二進位資料

            //列舉型別，允許指定的值集合，建議用字串，
            //不符合條件的資料會產生錯誤，無法存進資料庫中
            // $table->enum('type', ['1','2','3','4','5','a','ab']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
