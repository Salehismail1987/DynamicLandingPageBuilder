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
            $table->string('left_action_button_name')->after('left_action_button_video')->nullable();
            $table->string('left_action_button_text_color')->after('left_action_button_name')->nullable();
            $table->string('left_action_button_bg_color')->after('left_action_button_text_color')->nullable();

            $table->string('right_action_button_name')->after('left_action_button_bg_color')->nullable();
            $table->string('right_action_button_text_color')->after('right_action_button_name')->nullable();
            $table->string('right_action_button_bg_color')->after('right_action_button_text_color')->nullable();
           
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
            $table->dropColumn('left_action_button_name');
            $table->dropColumn('left_action_button_text_color');
            $table->dropColumn('left_action_button_bg_color');

            $table->dropColumn('right_action_button_name');
            $table->dropColumn('right_action_button_text_color');
            $table->dropColumn('right_action_button_bg_color');
        });
    }
};
