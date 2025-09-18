<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::insert([
            ['model' => 'Toyota Camry', 'comfort_category_id' => 1, 'driver_id' => 1],
            ['model' => 'BMW 5 Series', 'comfort_category_id' => 2, 'driver_id' => 2],
            ['model' => 'Hyundai Solaris', 'comfort_category_id' => 3, 'driver_id' => 3],
        ]);
    }
}
