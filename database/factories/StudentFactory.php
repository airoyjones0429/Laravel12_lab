<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        // 資料欄位名稱  => 產生資料指令 $thid->faker->{各種資料格式} 
            'name'      => $this->faker->word() , //取回英文拼字
            'aid'       => $this->faker->randomElement(['A', 'B', 'C']) . 
                           $this->faker->numberBetween(1000, 9999),
            'height'    => $this->faker->numberBetween(140,210)     ,
            'weight'    => $this->faker->numberBetween(40,300)      ,
            'birthday'  => $this->faker->date('Y-m-d') , //取回日期格式
            'gender'    => $this->faker->randomElement(['m','f'])
        ];
    }
}
