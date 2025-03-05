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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->text('email_notification');
            $table->text('step_notification_email')->nullable();
            $table->enum('step_notifications',['0','1']);
            $table->enum('notification_busniess_info',['0','1']);
            $table->enum('notification_busniess_hours',['0','1']);
            $table->enum('notification_quick_setting',['0','1']);
            $table->enum('notification_front',['0','1']);
            $table->enum('notification_galleries',['0','1']);
            $table->enum('notification_settings',['0','1']);
            $table->enum('notification_switch',['0','1']);
            $table->enum('notification_form',['0','1']);
            $table->enum('notification_blog',['0','1']);
            $table->enum('notification_crm_controls',['0','1']);
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
        Schema::dropIfExists('notification_settings');
    }
};
