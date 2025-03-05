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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('timezone');
            $table->text('site_background_theme');
            $table->text('site_background_color');
            $table->enum('site_trim',[0,1]);
            $table->enum('is_captcha_enable',[0,1]);
            $table->longText('home_scripts');
            $table->text('favicon');
            $table->enum('alternate_horizontal',[0,1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};
