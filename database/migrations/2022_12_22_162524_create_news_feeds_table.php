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
        Schema::create('news_feeds', function (Blueprint $table) {
            $table->id();
            $table->text('subtitle_text');
            $table->integer('subtitle_font_family')->default(0);
            $table->text('subtitle_font_size_mobile');
            $table->text('subtitle_font_size_web');
            $table->text('subtitle_text_color');
            $table->text('feed_image');
            $table->text('desc_text');
            $table->integer('desc_font_family')->default(0);
            $table->text('desc_font_size_mobile');
            $table->text('desc_font_size_web');
            $table->text('desc_text_color');
            $table->text('btn_text');
            $table->text('btn_link');
            $table->text('btn_section');
            $table->text('btn_form');
            $table->text('btn_text_color');
            $table->text('btn_bg');
            $table->integer('btn_text_font')->default(0);
            $table->integer('display_order')->default(0);
            $table->integer('link_social_media_icons')->default(0);
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
        Schema::dropIfExists('news_feeds');
    }
};
