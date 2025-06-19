<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 

//認證使用的模型，就不是 Model 的延伸，是 User 的延伸
class employee extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    use Notifiable; //使用 Laravel Auth 驗證需要的設定

    //當 PK 修改過後  要在模型修改  不然預設的模型操作  會用 id 去處理資料庫歐!!
    protected $primaryKey = 'emp_code';
    protected $keyType = 'string';
    public $incrementing = false; // 如果主鍵不是自增型

    // 可批次填充屬性
    protected $fillable = [
        'emp_code',
        'emp_name',
        'emp_pwd',
        'emp_lv',
        'emp_tel',
        'emp_imgPath',
    ];

    //==============以下為 使用 Laravel Auth 驗證需要的設定
    // 指定資料表
    protected $table = 'employees';

    // 指定可用於身份驗證的欄位
    public function getAuthIdentifierName()
    {
        return 'emp_code'; // 假設您使用 emp_code 作為登入識別欄位
    }

    // 如果使用者模型的密碼欄位不是 'password'，可以重寫此方法，沒有改變一定要使用 password 的效果，但是可以提供驗證效果
    public function getAuthPassword()
    {
        return $this->emp_pwd; // 假設您使用 emp_pwd 作為密碼欄位
    }
}

