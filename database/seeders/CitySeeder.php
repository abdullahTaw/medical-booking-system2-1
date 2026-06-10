<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Riyadh', 'country_id' => 1],
            ['name' => 'Jeddah', 'country_id' => 1],
            ['name' => 'Cairo', 'country_id' => 2],
            ['name' => 'Alexandria', 'country_id' => 2],
            ['name' => 'New York', 'country_id' => 3],
            ['name' => 'Los Angeles', 'country_id' => 3],
        ]);
    }
}
