<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //當想使用工廠產生資料時，要設定這個引用
    //才能在 database\seeders\DatabaseSeeder.php 中
    //產生假的學生資料 ( Student 模型 )
    use HasFactory ; 
}
