<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EngagementNotification;

class SendEngagementNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifications = EngagementNotification::where('notification_sent', false)
            ->whereRaw("TIME(`time`) <= ?", [now()->format('H:i')])
            ->get();

        foreach ($notifications as $notification) {
            // Send emails
            foreach ($notification->emails as $email) {
                Mail::raw('Engagement notification message here.', function ($message) use ($email) {
                    $message->to($email)->subject('Engagement Notification');
                });
            }

            // Mark as sent
            $notification->update(['notification_sent' => true]);
        }
    }
}
