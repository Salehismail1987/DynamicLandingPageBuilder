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
        Schema::create('attendhub_posts', function (Blueprint $table) {
            $table->id();
            $table->text('sub_title');
            $table->text('image');
            $table->longtext('post_description');
            $table->integer('font_family');
            $table->integer('image_size');
            $table->date('event_date');
            $table->time('from_time');
            $table->time('to_time'); 
            $table->text('post_title_color');
            $table->text('post_title_bg_color');
            $table->text('post_title_size_web');
            $table->text('post_title_size_mobile');
            $table->boolean('match_theme_bg');
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
        //
    }
};
