<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleEmail extends Model
{
    use HasFactory;

    protected $guarded = [
    ];

    public function schedule_email_contacts(){
        return  $this->hasMany(ScheduleEmailContact::class,'schedule_email_id');
    }

    public function email_template(){
        return  $this->belongsTo(EmailPost::class,'email_template_id');
    }
}
