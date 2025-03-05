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
        Schema::table('staff_products_promos', function (Blueprint $table) {
            //
            $table->string('left_action_button_active')->nullable()->after('star_color');
            $table->string('left_action_button_phone_no_calls')->nullable()->after('left_action_button_active');
            $table->string('left_action_button_phone_no_sms')->nullable()->after('left_action_button_phone_no_calls');
            $table->string('left_action_button_action_email')->nullable()->after('left_action_button_phone_no_sms');
            $table->string('left_action_button_link_text')->nullable()->after('left_action_button_action_email');
            $table->string('left_action_button_customform')->nullable()->after('left_action_button_link_text');
            $table->string('left_action_button_map_address')->nullable()->after('left_action_button_customform');
            $table->string('left_action_button_audio')->nullable()->after('left_action_button_map_address');
            $table->string('left_audio_icon_file')->nullable()->after('left_action_button_audio');
            $table->longText('left_action_button_textpopup')->nullable()->after('left_audio_icon_file');
            $table->string('left_action_button_address_id')->nullable()->after('left_action_button_textpopup');
            $table->string('left_action_button_video')->nullable()->after('left_action_button_address_id');
            $table->string('left_action_button_name')->nullable()->after('left_action_button_video');
            $table->string('left_action_button_text_color')->nullable()->after('left_action_button_name');
            $table->string('left_action_button_bg_color')->nullable()->after('left_action_button_text_color');
            $table->string('left_action_button_link')->nullable()->after('left_action_button_bg_color');

            $table->string('right_action_button_name')->nullable()->after('left_action_button_link');
            $table->string('right_action_button_text_color')->nullable()->after('right_action_button_name');
            $table->string('right_action_button_bg_color')->nullable()->after('right_action_button_text_color');
            $table->string('right_action_button_link')->nullable()->after('right_action_button_bg_color');
            $table->string('right_action_button_active')->nullable()->after('right_action_button_link');
            $table->string('right_action_button_phone_no_calls')->nullable()->after('right_action_button_active');
            $table->string('right_action_button_phone_no_sms')->nullable()->after('right_action_button_phone_no_calls');
            $table->string('right_action_button_action_email')->nullable()->after('right_action_button_phone_no_sms');
            $table->string('right_action_button_link_text')->nullable()->after('right_action_button_action_email');
            $table->string('right_action_button_customform')->nullable()->after('right_action_button_link_text');
            $table->string('right_action_button_map_address')->nullable()->after('right_action_button_customform');
            $table->string('right_action_button_audio')->nullable()->after('right_action_button_map_address');
            $table->string('right_audio_icon_file')->nullable()->after('right_action_button_audio');
            $table->string('right_action_button_address_id')->nullable()->after('right_audio_icon_file');
            $table->string('right_action_button_video')->nullable()->after('right_action_button_address_id');
            $table->longText('right_action_button_textpopup')->nullable()->after('right_action_button_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_products_promos', function (Blueprint $table) {
            //
        });
    }
};
