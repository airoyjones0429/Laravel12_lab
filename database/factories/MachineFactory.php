<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\machine>
 */
class MachineFactory extends Factory
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
            'Mach_No'=>  $this->faker->randomElement(['04','06','08','10','12','14','16','18','22','28']). 
                         $this->faker->randomElement(['X','S','G','P','R','Q','A','H','Z','M']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).                         
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9'])  ,
            
            'Mach_Model'=>  $this->faker->randomElement(['QA','WE','RT','YH','KU','VF']).
                            $this->faker->randomElement(['04','06','08','10','12','16']),

            'Mach_ModeNo'=> $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                            $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                            $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']),
            'Mach_Date1'=>  $this->faker->date( 'Y-m-d' ),
            'Mach_Date2'=>  $this->faker->date( 'Y-m-d' ),
            'Mach_ReMark'=> '',
            'Mach_Years'=>  $this->faker->randomElement( range(1990,2024) ) ,
        ];
    }
}
