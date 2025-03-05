<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPostSetting extends Model
{
    use HasFactory;
    protected $table = 'event_post_settings';

    // Specify which columns are fillable via mass assignment
    protected $fillable = [
        'sub_title_font',
        'title_text_size_mobile',
        'title_text_size_web',
        'title_text_color',
        'title_text_bg_color',
        'description_font',
        'desc_text_size_mobile',
        'desc_size_web',
        'feature_bg_color',
        'desc_text_color',
    ];


}
