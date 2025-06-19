<?php

namespace Database\Seeders;

use App\Models\contract;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //客戶模型工廠，產生 1 筆資料
        contract::factory(1)->create();
    }
}
