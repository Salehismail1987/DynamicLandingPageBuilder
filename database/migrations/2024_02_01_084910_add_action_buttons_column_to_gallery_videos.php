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
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
            $table->string('action_button_phone_no_calls')->nullable()->after('read_less_text');
            $table->string('action_button_phone_no_sms')->nullable()->after('action_button_phone_no_calls');
            $table->string('action_button_action_email')->nullable()->after('action_button_phone_no_sms');
            $table->enum('action_button_active',['0','1'])->nullable()->after('action_button_action_email');
            $table->string('action_button_discription')->nullable()->after('action_button_active');
            $table->string('action_button_discription_color')->nullable()->after('action_button_discription');
            $table->string('action_button_bg_color')->nullable()->after('action_button_discription_color');
            $table->string('action_button_link')->nullable()->after('action_button_bg_color');
            $table->string('action_button_link_text')->nullable()->nullable()->after('action_button_link');
            $table->integer('action_button_customform')->nullable()->after('action_button_link_text');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
        });
    }
};
