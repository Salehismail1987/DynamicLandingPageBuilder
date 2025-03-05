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
        Schema::table('email_posts', function (Blueprint $table) {
            
            $table->string('action_button_phone_no_calls')->nullable();
            $table->string('action_button_phone_no_sms')->nullable();
            $table->string('action_button_action_email')->nullable();
             
            
            $table->string('action_button_phone_no_calls_2')->nullable();
            $table->string('action_button_phone_no_sms_2')->nullable();
            $table->string('action_button_action_email_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_posts', function (Blueprint $table) {
            
            $table->dropColumn('action_button_phone_no_calls');
            $table->dropColumn('action_button_phone_no_sms');
            $table->dropColumn('action_button_action_email');
            
            $table->dropColumn('action_button_phone_no_calls_2');
            $table->dropColumn('action_button_phone_no_sms_2');
            $table->dropColumn('action_button_action_email_2');
        });
    }
};
