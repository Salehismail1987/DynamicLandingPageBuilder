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
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->string('action_button_phone_no_calls')->after('btn_link')->nullable();
            $table->string('action_button_phone_no_sms')->after('action_button_phone_no_calls')->nullable();
            $table->string('action_button_action_email')->after('action_button_phone_no_sms')->nullable();
            $table->string('action_button_link_text')->after('action_button_action_email')->nullable();            
            $table->string('action_button_customform')->after('action_button_link_text')->nullable();
            $table->string('action_button_map_address')->after('action_button_customform')->nullable();
            $table->string('action_button_address_id')->after('action_button_map_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->dropColumn('action_button_phone_no_calls');
            $table->dropColumn('action_button_phone_no_sms');
            $table->dropColumn('action_button_action_email');
            $table->dropColumn('action_button_link_text');            
            $table->dropColumn('action_button_customform');
            $table->dropColumn('action_button_map_address');
            $table->dropColumn('action_button_address_id');
        });
    }
};
