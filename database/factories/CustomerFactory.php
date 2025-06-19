<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
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
            'ctm_no' => $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']),
            'ctm_name' =>   $this->faker->randomElement(['劉','關','張','夏侯','諸葛','司馬']).
                            $this->faker->randomElement(['尚','文','武','友','品','優']).
                            $this->faker->randomElement(['強','華','智','官','文','武']),
            'ctm_uno' => $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J']). 
                         $this->faker->randomElement(['K','L','M','N','O','P','Q','R','S','T']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).                         
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']),
            'ctm_tel' => $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J']). 
                         $this->faker->randomElement(['K','L','M','N','O','P','Q','R','S','T']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).                         
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']),
            'ctm_fax' => $this->faker->randomElement(['A','B','C','D','E','F','G','H','I','J']). 
                         $this->faker->randomElement(['K','L','M','N','O','P','Q','R','S','T']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).                         
                         $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']),
            'ctm_adrs1' => 
                        $this->faker->randomElement(['台北','新北','桃園','新竹','苗栗','台中','彰化','雲林','嘉義','台南','高雄','屏東']). 
                        $this->faker->randomElement(['禮','義','廉','恥','忠','孝','仁','愛','信','義','和','平']).
                        $this->faker->randomElement(['紅','橙','黃','綠','藍','靛','紫']). 
                        $this->faker->randomElement(['路','街','大道']).
                        $this->faker->randomElement( range(1,1000) ).
                        '號'.
                        $this->faker->randomElement( range(1,1000) ).
                        '樓',
            'ctm_adrs2' => 
                        $this->faker->randomElement(['台北','新北','桃園','新竹','苗栗','台中','彰化','雲林','嘉義','台南','高雄','屏東']). 
                        $this->faker->randomElement(['禮','義','廉','恥','忠','孝','仁','愛','信','義','和','平']).
                        $this->faker->randomElement(['紅','橙','黃','綠','藍','靛','紫']). 
                        $this->faker->randomElement(['路','街','大道']).
                        $this->faker->randomElement( range(1,1000) ).
                        '號'.
                        $this->faker->randomElement( range(1,1000) ).
                        '樓',
            'ctm_remark'=> '備註'   ,
            'ctm_rp' => $this->faker->randomElement(['劉','關','張','夏侯','諸葛','司馬']).
                        $this->faker->randomElement(['尚','文','武','友','品','優']).
                        $this->faker->randomElement(['強','華','智','官','文','武']),
            'ctm_rptel' => 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']). 
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9']).                         
                        $this->faker->randomElement(['0','1','2','3','4','5','6','7','8','9'])
        ];
    }
}
