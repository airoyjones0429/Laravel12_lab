<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    //如果使用批次更新，這裡要設定，允許修改的欄位名稱
    //不然會出現 _token 錯誤
    protected $fillable = [
        'name',
        'birthday',
    ];

    // 下面是設定  只有 id  不允許批量更新
    // protected $guarded = ['id']; // 只不允許 id 欄位進行批量賦值
}
