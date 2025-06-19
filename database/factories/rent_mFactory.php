<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rent_m>
 */
class RentMFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rent_no =  
            $this->faker->randomElement(['A','B','C']) . 
            $this->faker->randomElement(range(10000 , 99999))
        ;

        return [
            //
            'RENT_NO' => $rent_no ,
            'RENT_PDATE' => $this->faker->date('Y-m-d'),
            'RENT_UNO' => $rent_no ,
            'RENT_UNO_DAT' => $this->faker->date('Y-m-d'),
            'RENT_CNO' => $this->faker->randomElement(range(1000,9999)),
            'RENT_CNAME' => $this->faker->word(),
            'RENT_CTMUNO' => $this->faker->word(),
            'RENT_CTMADRS' => $this->faker->word(),
            'RENT_ADRS' => $this->faker->words(),
            'RENT_REMARK' => $this->faker->words(),
            'RENT_TOTAL1' => $this->faker->randomElement(range(10000,1000000)),
        ];
    }
}
