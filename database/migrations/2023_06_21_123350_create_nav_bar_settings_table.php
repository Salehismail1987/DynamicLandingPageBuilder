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
        Schema::create('nav_bar_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('enable',['0','1']);
            $table->enum('enable_banner',['0','1']);
            $table->enum('stick_to_top',['0','1']);
            $table->text('banner_color');
            $table->text('text_color');
            $table->integer('font_family');
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
        Schema::dropIfExists('nav_bar_settings');
    }
};
