<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttenhubDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'attenhub_id', 'event_date', 'from_time', 'to_time','event_day'
    ];

    public function attendhubPost()
    {
        return $this->belongsTo(AttendhubPost::class, 'attenhub_id');
    }
}
