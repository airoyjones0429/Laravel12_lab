<?php

namespace Database\Seeders;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //如果模型出現紅色的底線
        //只要確定有 Student 模型
        //重新輸入一次就可以把紅線消去
        //執行 php artisan db:seed  種下種子指令
        //會依照這裡的設定，產生出 10 筆資料        
        Student::factory(10)->create();

        //執行其他 Seeder 類別的 run()
        $this->call([            
            TeacherSeeder::class,
            // 其他 Seeder 類別
        ]);
    }
}
