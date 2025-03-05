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
        Schema::table('custom_forms', function (Blueprint $table) {
            // $table->string('action_button_phone_no_calls')->nullable();
            // $table->string('action_button_phone_no_sms')->nullable();
            // $table->string('action_button_action_email')->nullable();
            // $table->text('action_button_map_address')->nullable()->after('action_button_address_id');
            $table->string('action_button_action_audio')->nullable()->after('action_button_action_email');
            $table->string('action_button_video')->nullable()->after('action_button_address_id');
            $table->string('action_button_audio_icon_feature')->nullable()->after('action_button_address_id');
            // $table->longText('action_button_textpopup')->nullable()->after('action_button_address_id');
            // $table->text('popup_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_forms', function (Blueprint $table) {
            //
        });
    }
};
