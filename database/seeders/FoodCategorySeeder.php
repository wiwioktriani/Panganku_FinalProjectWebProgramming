<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodCategory;

class FoodCategorySeeder extends Seeder
{
    public function run(): void
    {
        FoodCategory::insert([
            [
                'name' => 'Buah',
                'description' => 'Buah segar'
            ],
            [
                'name' => 'Sayur',
                'description' => 'Sayuran'
            ],
            [
                'name' => 'Makanan Siap Saji',
                'description' => 'Makanan matang'
            ],
        ]);
    }
}
