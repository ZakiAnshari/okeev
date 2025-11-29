<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Mobil',
            'Motor',
            'Laptop',
            'Smartphone'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name_category' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}
