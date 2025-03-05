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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->integer('category');
            $table->text('keywords');
            $table->text('meta_desc');
            $table->text('short_desc');
            $table->text('image');
            $table->longText('description');
            $table->text('title_color');
            $table->integer('title_font');
            $table->text('desc_color');
            $table->integer('desc_font');
            $table->text('category_color');
            $table->integer('category_font');
            $table->text('date_color');
            $table->integer('date_font');
            $table->text('btn_text');
            $table->text('btn_link');
            $table->text('btn_text_color');
            $table->text('btn_bg');
            $table->integer('btn_text_font');
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
        Schema::dropIfExists('blogs');
    }
};
