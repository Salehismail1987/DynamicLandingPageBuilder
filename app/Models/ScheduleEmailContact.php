<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleEmailContact extends Model
{
    use HasFactory;

    protected $fillable = ['email_list_id','schedule_email_id'];
}
