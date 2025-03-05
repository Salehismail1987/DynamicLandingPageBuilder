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
        Schema::create('header_images', function (Blueprint $table) {
            $table->id();
            $table->enum('slideronoff',['0','1']);
            $table->string('header_background_color',10);
            $table->string('header_logo',255);
            $table->string('header_logo_width',10);
            $table->string('header_img',255);
            $table->string('header_img_width',10);
            $table->string('header_slider_text_position',20);
            $table->string('header_slider_background',10);
            $table->string('header_scrollbar_width',10);
            $table->string('header_scrollbar_color',10);
            
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
        Schema::dropIfExists('header_images');
    }
};
