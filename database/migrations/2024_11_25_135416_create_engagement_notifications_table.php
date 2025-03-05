<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engagement_notifications', function (Blueprint $table) {
            $table->id();
            $table->json('emails'); // To store multiple emails as a JSON array
            $table->boolean('notification_sent')->default(false); // Toggle for notification status
            $table->timestamp('time')->nullable(); // Time column for scheduling
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engagement_notifications');
    }
};
