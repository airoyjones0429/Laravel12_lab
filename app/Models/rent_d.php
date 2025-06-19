<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rent_d extends Model
{
    /** @use HasFactory<\Database\Factories\RentDFactory> */
    use HasFactory;


    protected $table = 'rent_ds'; // 指定資料表名稱

    // 指定主鍵
    protected $primaryKey = ['RENT_NO', 'RENT_DNO'];

    // 禁用自動遞增
    public $incrementing = false;

    // 設定可批量賦值的屬性
    protected $fillable = [
        'RENT_NO',
        'RENT_DNO',
        'RENT_DMODEL',
        'RENT_DDATE',
        'RENT_DMSN',
        'RENT_DDATE1',
        'RENT_DDATE2',
        'RENT_DAY',
        'RENT_AMT',
        'RENT_FDATE',
        'RENT_FEE',
        'RENT_Contract_No',
    ];

}
