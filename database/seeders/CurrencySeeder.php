<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $currencies = [
        ['code' => 'USD', 'name' => 'US Dollar',      'symbol' => '$',   'exchange_rate' => 1.0],
        ['code' => 'ILS', 'name' => 'Israeli Shekel', 'symbol' => '₪',  'exchange_rate' => 2.97],
        ['code' => 'EUR', 'name' => 'Euro',            'symbol' => '€',  'exchange_rate' => 0.87],
        ['code' => 'EGP', 'name' => 'Egyptian Pound', 'symbol' => 'ج.م', 'exchange_rate' => 52.13],
        ['code' => 'SAR', 'name' => 'Saudi Riyal',    'symbol' => '﷼',  'exchange_rate' => 3.75],
    ];

    DB::table('currencies')->upsert(
    array_map(fn($c) => array_merge($c, [
        'created_at' => now(),
        'updated_at' => now(),
    ]), $currencies),
    ['code'],
    ['name', 'symbol', 'exchange_rate', 'updated_at']
);
}
}
