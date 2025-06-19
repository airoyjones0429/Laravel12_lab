<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    /** @use HasFactory<\Database\Factories\ContractFactory> */
    use HasFactory;

    //當 PK 修改過後  要在模型修改  不然預設的模型操作  會用 id 去處理資料庫歐!!
    protected $primaryKey = 'mach_no';
    protected $keyType = 'string';
    public $incrementing = false; // 如果主鍵不是自增型

    // 如果想用下面指令，增加資料
    // contract::create( $新增資料的關聯式陣列名稱 );
    //設定可以批次更新的欄位
    protected $fillable =[
        'mach_no'   ,
        'mach_rentctmno'   ,
        'mach_rentctmname'   ,
        'mach_rentctmuno'   ,
        'mach_rentdate1'   ,
        'mach_rentdate2'   ,
        'mach_rentdays'   ,
        'mach_rentno'   ,
        'mach_rentamt'   ,
        'mach_rentfee'   ,
        'mach_rentfdate'   ,
        'mach_contract_no'   ,
        'mach_rentremark'   ,
    ];

}
