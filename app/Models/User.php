<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     // /**
//     //  * The attributes that are mass assignable.
//     //  *
//     //  * @var list<string>
//     //  */
//     // protected $fillable = [
//     //     'name',
//     //     'email',
//     //     'password',
//     // ];

//     // /**
//     //  * The attributes that should be hidden for serialization.
//     //  *
//     //  * @var list<string>
//     //  */
//     // protected $hidden = [
//     //     'password',
//     //     'remember_token',
//     // ];

//     // /**
//     //  * Get the attributes that should be cast.
//     //  *
//     //  * @return array<string, string>
//     //  */
//     // protected function casts(): array
//     // {
//     //     return [
//     //         'email_verified_at' => 'datetime',
//     //         'password' => 'hashed',
//     //     ];
//     // }
// }



class User extends Authenticatable
{
    protected $table = 'employees'; // 指定資料表名稱
    protected $primaryKey = 'EMP_CODE'; // 指定主鍵
    protected $fillable = ['EMP_CODE', 'EMP_NAME', 'EMP_PWD']; // 可批量賦值的屬性
    protected $hidden = ['EMP_PWD']; // 隱藏密碼欄位
}