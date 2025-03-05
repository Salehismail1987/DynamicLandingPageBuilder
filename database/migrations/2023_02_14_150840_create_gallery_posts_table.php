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
        Schema::create('gallery_posts', function (Blueprint $table) {
            $table->id();
            $table->text('post_title')->nullable();
            $table->integer('post_font_family');
            $table->text('post_title_color')->nullable();
            $table->text('post_title_bcakground')->nullable();
            $table->enum('post_title_left_right',['0','1']);
            $table->longText('post_desc')->nullable();
            $table->longText('post_desc_1')->nullable();
            $table->longText('post_desc_2')->nullable();
            $table->longText('post_desc_3')->nullable();
            $table->text('post_desc_font_size')->nullable();
            $table->integer('post_desc_font_family');
            $table->text('post_title_font_size');
            $table->text('post_title_font_size_mobile');
            $table->tinyInteger('action_button_active');
            $table->text('action_button_discription')->nullable();
            $table->text('action_button_discription_color')->nullable();
            $table->text('action_button_bg_color')->nullable();
            $table->text('action_button_link')->nullable();
            $table->text('action_button_link_text')->nullable();
            $table->integer('action_button_customform');
            $table->integer('action_button_address_id');
            $table->text('post_image_size')->nullable();
            $table->integer('display_order');
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
        Schema::dropIfExists('gallery_posts');
    }
};
