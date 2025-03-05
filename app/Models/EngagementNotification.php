<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngagementNotification extends Model
{
    use HasFactory;

    protected $fillable = ['emails', 'notification_sent', 'time','check_for_likes_and_comments'];

    // Accessor to decode JSON emails
    protected $casts = [
        'emails' => 'array',
    ];
}
