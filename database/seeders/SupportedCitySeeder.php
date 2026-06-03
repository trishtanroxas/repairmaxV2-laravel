<?php

namespace Database\Seeders;

use App\Models\SupportedCity;
use Illuminate\Database\Seeder;

class SupportedCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Quezon City',
            'Manila',
            'Caloocan',
            'Las Piñas',
            'Makati',
            'Malabon',
            'Mandaluyong',
            'Marikina',
            'Muntinlupa',
            'Navotas',
            'Parañaque',
            'Pasay',
            'Pasig',
            'San Juan',
            'Taguig',
            'Valenzuela',
            'Pateros',
        ];

        foreach ($cities as $city) {
            SupportedCity::firstOrCreate([
                'name' => $city,
            ], [
                'is_active' => true,
            ]);
        }
    }
}
