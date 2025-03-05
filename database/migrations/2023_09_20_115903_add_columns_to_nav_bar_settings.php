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
        Schema::table('nav_bar_settings', function (Blueprint $table) {
            $table->enum('reset_button_text_color_enable',['0','1']);
            $table->text('reset_button_text_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nav_bar_settings', function (Blueprint $table) {
            $table->dropColumn('reset_button_text_color_enable');
            $table->dropColumn('reset_button_text_color');
        });
    }
};
