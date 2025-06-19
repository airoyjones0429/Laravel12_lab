<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\contract>
 */
class ContractFactory extends Factory
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
            'mach_no' => '2', //手動指定機號
            'mach_rentctmno'    =>  $this->faker->randomElement( range(1001,9999)) ,
            'mach_rentctmname'  =>  $this->faker->randomElement(['GS','JLG']) . 
                                    $this->faker->randomElement(['1','2','3','4']),
            'mach_rentctmuno'   =>  $this->faker->randomElement(['GS','JLG']) . 
                                    $this->faker->randomElement(['1','2','3','4']),
            'mach_rentdate1'    =>  $this->faker->date('Y-m-d'),
            'mach_rentdate2'    =>  $this->faker->date('Y-m-d'),
            'mach_rentdays'     =>  $this->faker->randomElement(range(5,60)),
            'mach_rentno'       =>  $this->faker->randomElement(['GS','JLG']) . 
                                    $this->faker->randomElement(['1','2','3','4']),
            'mach_rentamt'      =>  $this->faker->randomElement(range(3000,100000)),
            'mach_rentfee'      =>  $this->faker->randomElement(range(3000,10000)),
            'mach_rentfdate'    =>  $this->faker->date('Y-m-d'),
            'mach_contract_no'  =>  $this->faker->randomElement(['23','45','84']) . 
                                    $this->faker->randomElement(['1','2','3','4']),
            'mach_rentremark'  =>   $this->faker->randomElement(['GS','JLG']) . 
                                    $this->faker->randomElement(['1','2','3','4']),                                    
        ];
    }
}
