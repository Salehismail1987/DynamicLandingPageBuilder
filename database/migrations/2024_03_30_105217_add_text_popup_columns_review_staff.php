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
            $table->longText('left_action_button_textpopup')->nullable()->after('left_audio_icon_file');
            $table->longText('right_action_button_textpopup')->nullable()->after('right_audio_icon_file');
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
            $table->dropColumn('right_action_button_textpopup');
            $table->dropColumn('left_action_button_textpopup');
        });
    }
};
