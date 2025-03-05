<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siteSettings extends Model
{
    use HasFactory;
    protected $attributes = [
        'tutorial_label_color' => '#E3F3FF',
    ];
}
