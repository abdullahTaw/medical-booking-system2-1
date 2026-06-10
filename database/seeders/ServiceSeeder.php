<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'center_id' => 1,
            'name' => 'استشارة طبية',
            'description' => 'استشارة طبية لمدة 30 دقيقة مع طبيب متخصص',
            'price' => 100.00,
            'duration' => 30,
            'is_active' => true,
        ]);

        Service::create([
            'center_id' => 1,
            'name' => 'فحص شامل',
            'description' => 'فحص طبي شامل لجميع أجزاء الجسم',
            'price' => 300.00,
            'duration' => 60,
            'is_active' => true,
        ]);
    }
}
