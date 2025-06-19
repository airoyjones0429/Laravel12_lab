<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'emp_code'=> $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9'])  ,
            'emp_name'=> $this->faker->randomElement(['劉','關','張','夏侯','諸葛','司馬']).
                         $this->faker->randomElement(['尚','文','武','友','品','優']).
                         $this->faker->randomElement(['強','華','智','官','文','武']),
            'emp_pwd'=> Hash::make('1234'),
            'emp_lv'=>'9',
            'emp_tel'=>'019'
        ];
    }
}
