<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_category' => 'Electric Cars',
                'category_position_id' => 1,
            ],
            [
                'name_category' => 'Electric Motorcycles',
                'category_position_id' => 1,
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
