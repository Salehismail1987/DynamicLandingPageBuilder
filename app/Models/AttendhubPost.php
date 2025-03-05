<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendhubPost extends Model
{
    use HasFactory;

    protected $attributes = [
        'image_size' => '400',
        'font_family' => 51,
        'counter_date_time_fonts' => 1,
        'display_counter' => 1,
        'post_title_size_web' => '26',
        'counter_date_time_font_size' => '16',
        'post_title_size_mobile' => '12'
    ];

    public function attenhubDates()
    {
        return $this->hasMany(AttenhubDate::class, 'attenhub_id');
    }
}
