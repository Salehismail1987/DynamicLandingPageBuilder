<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oneStepImages extends Model
{
    use HasFactory;

    protected $guarded = [
    ];

    public function first_image_text(){
        return  $this->belongsTo(textDetails::class,'first_image_text_id');
    }

    public function second_image_text(){
        return  $this->belongsTo(textDetails::class,'second_image_text_id');
    }
}
