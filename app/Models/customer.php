<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;



    //當 PK 修改過後  要在模型修改  不然預設的模型操作  會用 id 去處理資料庫歐!!
    protected $primaryKey = 'ctm_no';
    protected $keyType = 'string';
    public $incrementing = false; // 如果主鍵不是自增型


    // 如果想用下面指令，增加資料
    // customer::create( $新增資料的關聯式陣列名稱 );
    // 就要指定可批量賦值的屬性
    protected $fillable = [
        'ctm_no',
        'ctm_name',
        'ctm_uno',
        'ctm_tel',
        'ctm_fax',
        'ctm_adrs1',
        'ctm_adrs2',
        'ctm_rp',
        'ctm_rptel',
        'ctm_remark',
    ];

}
