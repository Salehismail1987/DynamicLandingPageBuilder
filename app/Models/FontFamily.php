<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontFamily extends Model
{
    use HasFactory;
    public static  function getAllFontFamily(){
        return FontFamily::orderBy('display_order', 'ASC')->get();
    }
}
