<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        // ===== FIRST SECTION (ABOUT US) =====
        'about_title',
        'about_description',

        // ===== SECOND SECTION (WHY CHOOSE US) =====
        'why_title_1',
        'why_description_1',

        'why_title_2',
        'why_description_2',

        'why_title_3',
        'why_description_3',

        // ===== THIRD SECTION (COLLABORATION) =====
        'collaboration_customer',
        'collaboration_customer_happy',

        // ===== STATUS =====
        'is_active',
    ];


    protected $casts = [
        'is_active' => 'boolean'
    ];
}
