<?php

namespace Database\Seeders;

use App\Models\ComfortCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComfortCategory::insert([
            ['name' => 'Первая'],
            ['name' => 'Вторая'],
            ['name' => 'Третья'],
        ]);
    }
}
