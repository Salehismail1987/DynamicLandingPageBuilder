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
        Schema::table('notification_settings', function (Blueprint $table) {
            $table->enum('quick_settings_notifications', ['0', '1'])->nullable()->after('notification_crm_controls');
            $table->enum('scheduling_notifications', ['0', '1'])->nullable()->after('quick_settings_notifications');
            $table->enum('galleries_notifications', ['0', '1'])->nullable()->after('scheduling_notifications');
            $table->enum('frontend_notifications', ['0', '1'])->nullable()->after('galleries_notifications');
            $table->enum('blog_notifications', ['0', '1'])->nullable()->after('frontend_notifications');
            $table->enum('crm_notifications', ['0', '1'])->nullable()->after('blog_notifications');
            $table->enum('form_notifications', ['0', '1'])->nullable()->after('crm_notifications');
            $table->enum('settings_business_notifications', ['0', '1'])->nullable()->after('form_notifications');
            $table->enum('settings_notifications', ['0', '1'])->nullable()->after('settings_business_notifications');
            $table->string('quick_settings_notification_email')->nullable()->after('settings_notifications');
            $table->string('scheduling_notification_email')->nullable()->after('quick_settings_notification_email');
            $table->string('galleries_notification_email')->nullable()->after('scheduling_notification_email');
            $table->string('frontend_notification_email')->nullable()->after('galleries_notification_email');
            $table->string('blog_notification_email')->nullable()->after('frontend_notification_email');
            $table->string('settings_notification_email')->nullable()->after('blog_notification_email');
            $table->string('crm_notification_email')->nullable()->after('settings_notification_email');
            $table->string('form_notification_email')->nullable()->after('crm_notification_email');
            $table->string('settings_business_notification_email')->nullable()->after('form_notification_email');

        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
