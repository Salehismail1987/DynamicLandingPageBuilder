<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scheduleEmailCustom extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_datetime','schedule_email','email_template_id'];
}
