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
            $table->string('right_action_button_link')->after('right_action_button_bg_color')->nullable();
            $table->string('left_action_button_link')->after('left_action_button_bg_color')->nullable();
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
            $table->dropColumn('right_action_button_link');
            $table->dropColumn('left_action_button_link');
        });
    }
};
