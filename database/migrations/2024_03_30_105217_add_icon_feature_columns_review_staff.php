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
        //
        Schema::table('review_staff', function (Blueprint $table) {
            //
            $table->string('left_audio_icon_file')->nullable()->after('left_action_button_audio');
            $table->string('right_audio_icon_file')->nullable()->after('right_action_button_audio');
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
        Schema::table('review_staff', function (Blueprint $table) {
            //
            $table->dropColumn('right_audio_icon_file');
            $table->dropColumn('left_audio_icon_file');
        });
    }
};
