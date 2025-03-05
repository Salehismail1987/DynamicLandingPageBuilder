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
        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->text('post_title');
            $table->integer('font_family');
            $table->text('post_title_color');
            $table->text('post_title_size');
            $table->longText('post_desc');
            $table->longText('post_desc_1');
            $table->longText('post_desc_2');
            $table->longText('post_desc_3');
            $table->text('post_desc_font_size');
            $table->integer('desc_font_family');
            $table->text('post_desc_color');
            $table->text('image');
            $table->text('datetime');
            $table->integer('display_order');
            $table->tinyinteger('show_date');
            $table->tinyinteger('enable_timed_image');
            $table->string('timed_image');
            $table->integer('timed_image_duration');
            $table->text('timed_image_start_time')->nullable();
            $table->text('timed_image_end_time')->nullable();
            $table->text('timed_image_days');
            $table->enum('timed_image_type',['days','timer']);
            $table->tinyinteger('action_button_active');
            $table->string('action_button_discription');
            $table->string('action_button_discription_color');
            $table->string('action_button_bg_color');
            $table->string('action_button_link');
            $table->string('action_button_link_text')->nullable();
            $table->integer('action_button_customform');
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
        Schema::dropIfExists('news_posts');
    }
};
