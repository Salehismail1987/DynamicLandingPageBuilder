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
            $table->string('left_action_button_audio')->nullable()->after('left_action_button_map_address');
            $table->string('right_action_button_audio')->nullable()->after('right_action_button_map_address');
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
            $table->dropColumn('left_action_button_audio');
            $table->dropColumn('right_action_button_audio');
        });
    }
};
