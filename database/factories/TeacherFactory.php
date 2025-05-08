<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //產生資料的流程
        $randomName = "";
        do{
            //隨機字組，當作姓名，要大於 4 個字母
            $randomName = $randomName.$this->faker->word();
        }while( strlen( $randomName ) < 5 );

        //傳回資料
        return [
            'name'      =>  $randomName   ,
            'birthday'  =>  $this->faker->date('Y-m-d')
        ];
    }
}
