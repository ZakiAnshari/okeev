<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            // ======================
            // CATEGORY ID = 1 (MOBIL LISTRIK)
            // ======================
            1 => [
                ['name_brand' => 'Tesla',          'image' => 'brands/tesla.png',          'wallpaper' => 'https://source.unsplash.com/1600x900/?tesla,electric-car'],
                ['name_brand' => 'BYD',            'image' => 'brands/byd.png',            'wallpaper' => 'https://source.unsplash.com/1600x900/?byd,electric-car'],
                ['name_brand' => 'Hyundai EV',     'image' => 'brands/hyundai-ev.png',     'wallpaper' => 'https://source.unsplash.com/1600x900/?hyundai,electric-car'],
                ['name_brand' => 'Wuling EV',      'image' => 'brands/wuling-ev.png',      'wallpaper' => 'https://source.unsplash.com/1600x900/?wuling,electric-car'],
                ['name_brand' => 'Nissan EV',      'image' => 'brands/nissan-ev.png',      'wallpaper' => 'https://source.unsplash.com/1600x900/?nissan,leaf'],
                ['name_brand' => 'BMW i',          'image' => 'brands/bmw-i.png',          'wallpaper' => 'https://source.unsplash.com/1600x900/?bmw,i-series'],
                ['name_brand' => 'Mercedes EQ',    'image' => 'brands/mercedes-eq.png',    'wallpaper' => 'https://source.unsplash.com/1600x900/?mercedes,electric-car'],
                ['name_brand' => 'Kia EV',          'image' => 'brands/kia-ev.png',          'wallpaper' => 'https://source.unsplash.com/1600x900/?kia,electric-car'],
                ['name_brand' => 'Volkswagen ID',  'image' => 'brands/vw-id.png',           'wallpaper' => 'https://source.unsplash.com/1600x900/?volkswagen,id'],
                ['name_brand' => 'Chery EV',       'image' => 'brands/chery-ev.png',        'wallpaper' => 'https://source.unsplash.com/1600x900/?chery,electric-car'],
            ],

            // ==========================
            // CATEGORY ID = 2 (MOTOR LISTRIK)
            // ==========================
            2 => [
                ['name_brand' => 'Gesits',          'image' => 'brands/gesits.png',          'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-scooter'],
                ['name_brand' => 'Alva',            'image' => 'brands/alva.png',            'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-motorcycle'],
                ['name_brand' => 'Polytron EV',     'image' => 'brands/polytron-ev.png',     'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-bike'],
                ['name_brand' => 'Viar EV',         'image' => 'brands/viar-ev.png',         'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-motorbike'],
                ['name_brand' => 'United E-Motor',  'image' => 'brands/united-ev.png',       'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-scooter,city'],
                ['name_brand' => 'Selis',           'image' => 'brands/selis.png',           'wallpaper' => 'https://source.unsplash.com/1600x900/?electric-bike,urban'],
                ['name_brand' => 'Yadea',           'image' => 'brands/yadea.png',           'wallpaper' => 'https://source.unsplash.com/1600x900/?yadea,electric-scooter'],
                ['name_brand' => 'NIU',             'image' => 'brands/niu.png',             'wallpaper' => 'https://source.unsplash.com/1600x900/?niu,electric-scooter'],
                ['name_brand' => 'Vmoto',           'image' => 'brands/vmoto.png',           'wallpaper' => 'https://source.unsplash.com/1600x900/?vmoto,electric-motorcycle'],
                ['name_brand' => 'Horwin',          'image' => 'brands/horwin.png',          'wallpaper' => 'https://source.unsplash.com/1600x900/?horwin,electric-motorcycle'],
            ],
        ];

        foreach ($categories as $categoryId => $brands) {
            foreach ($brands as $brand) {
                Brand::create([
                    'name_brand' => $brand['name_brand'],
                    'slug' => Str::slug($brand['name_brand']),
                    'image' => $brand['image'],
                    'wallpaper' => $brand['wallpaper'],
                    'category_id' => $categoryId,
                    'category_position_id' => 1,
                ]);
            }
        }
    }
}
