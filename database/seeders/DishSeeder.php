<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dish::create([
            'name' => 'Burger',
            'description' => 'Juicy beef burger with cheese',
            'price' => 5.99,
            'image' => null
        ]);

        Dish::create([
            'name' => 'Pizza',
            'description' => 'Cheesy pizza with tomato sauce',
            'price' => 8.50,
            'image' => null
        ]);

        Dish::create([
            'name' => 'Coffee',
            'description' => 'Hot black coffee',
            'price' => 2.50,
            'image' => null
        ]);

        Dish::create([
            'name' => 'Tea',
            'description' => 'Fresh herbal tea',
            'price' => 1.50,
            'image' => null
        ]);
    }
}
