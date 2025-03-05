<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsubscribeEmail extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'unsubscribe_email';

    // Specify which attributes are mass assignable
    protected $fillable = ['key', 'email'];

    // If you want to disable timestamps for this model
    // public $timestamps = false;
}
