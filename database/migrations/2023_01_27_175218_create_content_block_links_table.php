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
        Schema::create('content_block_links', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->text('description1');
            $table->text('description2');
            $table->text('description3');
            $table->text('content_title_color');
            $table->text('content_title_font_size');
            $table->integer('content_title_font_family');
            $table->text('content_desc_color');
            $table->text('content_desc_font_size');
            $table->integer('content_desc_font_family');
            $table->text('content_image');
            $table->text('content_image_size');
            $table->enum('action_button_active',[0,1]);
            $table->text('action_button_discription');
            $table->text('action_button_discription_color');
            $table->text('action_button_bg_color');
            $table->text('action_button_link');
            $table->text('action_button_link_text');
            $table->text('action_button_custom_forms');
            $table->integer('action_button_address_id');
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
        Schema::dropIfExists('content_block_links');
    }
};
