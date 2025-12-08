<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\CategoryPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryPositionSeeder extends Seeder
{
    public function run(): void
    {
        $category_positions = [
            'Vehicle',
            'Electric',
            'Smart Home',
            'Aksesoris & Suku Cadang EV',
        ];

        foreach ($category_positions as $cat) {
            CategoryPosition::create([
                'category_position' => $cat,
                'slug' => Str::slug($cat),
            ]);
        }
    }
}