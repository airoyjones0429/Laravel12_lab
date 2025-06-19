<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class machine extends Model
{
    /** @use HasFactory<\Database\Factories\MachineFactory> */
    use HasFactory;

    //當 PK 修改過後  要在模型修改  不然預設的模型操作  會用 id 去處理資料庫歐!!
    protected $primaryKey = 'Mach_No';
    protected $keyType = 'string';
    public $incrementing = false; // 如果主鍵不是自增型


}
