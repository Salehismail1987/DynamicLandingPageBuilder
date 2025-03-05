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
        Schema::create('galleries_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('gallery_post_use_generic',[0,1]);
            $table->enum('gallery_slider_use_generic',[0,1]);
            $table->text('gallery_slider_background')->nullable();
            $table->enum('gallery_slider_autoplay',[0,1]);
            $table->enum('gallery_video_use_generic',[0,1]);
            $table->text('gallery_video_background')->nullable();
            $table->enum('gallery_tiles_use_generic',[0,1]);
            $table->text('gallery_tiles_background')->nullable();
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
        Schema::dropIfExists('galleries_settings');
    }
};
