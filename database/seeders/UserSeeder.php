<?php

namespace Database\Seeders;

use App\Models\ComfortCategory;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Алексей Менеджер',
                'position_id' => Position::where('name', 'Менеджер')->first()->id,
                'email' => 'manager@test.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Мария Директор',
                'position_id' => Position::where('name', 'Директор')->first()->id,
                'email' => 'director@test.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Олег Стажёр',
                'position_id' => Position::where('name', 'Стажёр')->first()->id,
                'email' => 'intern@test.com',
                'password' => Hash::make('password')
            ],
        ]);


        // Настройка связей: кто какую категорию может использовать
        $manager = Position::where('name', 'Менеджер')->first();
        $director = Position::where('name', 'Директор')->first();
        $intern = Position::where('name', 'Стажёр')->first();

        $first = ComfortCategory::where('name', 'Первая')->first();
        $second = ComfortCategory::where('name', 'Вторая')->first();
        $third = ComfortCategory::where('name', 'Третья')->first();

        $manager->comfortCategories()->sync([$second->id, $third->id]);
        $director->comfortCategories()->sync([$first->id, $second->id]);
        $intern->comfortCategories()->sync([$third->id]);
    }
}
