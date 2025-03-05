<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actionButtons extends Model
{
    use HasFactory;
    protected $guarded = [
    ];

    public function address(){
        return  $this->belongsTo(addresses::class,'address_id');
    }
}
