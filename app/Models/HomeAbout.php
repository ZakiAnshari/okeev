<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeAbout extends Model
{
    protected $fillable = [
        'section_label',
        'title_main',
        'description_main',
        'tagline',
        'description_second',
        'visi_description',
        'visi_image', 'misi_image',
        'title_1','title_2','title_3','title_4',
        'fourth_title_1','fourth_title_2','fourth_title_3',
        'support_service_1','support_service_2','support_service_3','support_service_4'
    ];
}
