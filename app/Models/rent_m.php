<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rent_m extends Model
{
    /** @use HasFactory<\Database\Factories\Rent_MFactory> */
    use HasFactory;


    // 指定資料表名稱
    protected $table = 'rent_ms'; 

    // 指定主鍵
    protected $primaryKey = 'RENT_NO';
    protected $keyType = 'string';

    // 禁用自動遞增
    public $incrementing = false;

    // 設定可批量賦值的屬性
    protected $fillable = [
        'RENT_NO',
        'RENT_PDATE',
        'RENT_UNO',
        'RENT_UNO_DAT',
        'RENT_CNO',
        'RENT_CNAME',
        'RENT_CTMUNO',
        'RENT_CTMADRS',
        'RENT_ADRS',
        'RENT_REMARK',
        'RENT_TOTAL1',
    ];

}
