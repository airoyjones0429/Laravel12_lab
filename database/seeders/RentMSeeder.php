<?php

namespace Database\Seeders;

use App\Models\rent_m ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        rent_m::factory(100)->create();
    }
}
