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
        Schema::table('review_staff', function (Blueprint $table) {
            //
            $table->string('left_action_button_active')->after('star_color')->nullable();
            $table->string('left_action_button_phone_no_calls')->after('left_action_button_active')->nullable();
            $table->string('left_action_button_phone_no_sms')->after('left_action_button_phone_no_calls')->nullable();
            $table->string('left_action_button_action_email')->after('left_action_button_phone_no_sms')->nullable();
            $table->string('left_action_button_link_text')->after('left_action_button_action_email')->nullable();            
            $table->string('left_action_button_customform')->after('left_action_button_link_text')->nullable();
            $table->string('left_action_button_map_address')->after('left_action_button_customform')->nullable();
            $table->string('left_action_button_address_id')->after('left_action_button_map_address')->nullable();
            $table->string('left_action_button_video')->after('left_action_button_address_id')->nullable();

            $table->string('right_action_button_active')->after('left_action_button_video')->nullable();
            $table->string('right_action_button_phone_no_calls')->after('right_action_button_active')->nullable();
            $table->string('right_action_button_phone_no_sms')->after('right_action_button_phone_no_calls')->nullable();
            $table->string('right_action_button_action_email')->after('right_action_button_phone_no_sms')->nullable();
            $table->string('right_action_button_link_text')->after('right_action_button_action_email')->nullable();            
            $table->string('right_action_button_customform')->after('right_action_button_link_text')->nullable();
            $table->string('right_action_button_map_address')->after('right_action_button_customform')->nullable();
            $table->string('right_action_button_address_id')->after('right_action_button_map_address')->nullable();
            $table->string('right_action_button_video')->after('right_action_button_address_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_staff', function (Blueprint $table) {
            //
            $table->dropColumn('left_action_button_active');
            $table->dropColumn('left_action_button_phone_no_calls');
            $table->dropColumn('left_action_button_phone_no_sms');
            $table->dropColumn('left_action_button_action_email');
            $table->dropColumn('left_action_button_link_text');            
            $table->dropColumn('left_action_button_customform');
            $table->dropColumn('left_action_button_map_address');
            $table->dropColumn('left_action_button_address_id');
            $table->dropColumn('left_action_button_video');

            $table->dropColumn('right_action_button_active');
            $table->dropColumn('right_action_button_phone_no_calls');
            $table->dropColumn('right_action_button_phone_no_sms');
            $table->dropColumn('right_action_button_action_email');
            $table->dropColumn('right_action_button_link_text');            
            $table->dropColumn('right_action_button_customform');
            $table->dropColumn('right_action_button_map_address');
            $table->dropColumn('right_action_button_address_id');
            $table->dropColumn('right_action_button_video');
        });
    }
};
