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
        Schema::create('gallery_videos', function (Blueprint $table) {
            $table->id();
            $table->text('video')->nullable();
            $table->text('text')->nullable();
            $table->string('title_fontsize',10)->nullable();
            $table->text('text_color')->nullable();
            $table->text('back_color')->nullable();
            $table->integer('font_family');
            $table->text('desc')->nullable();
            $table->string('description_color')->nullable();
            $table->string('desc_fontsize',10)->nullable();
            $table->integer('font_family_desc');
            $table->enum('video_auto_play',['0','1']);
            $table->enum('video_repeat',['0','1']);
            $table->integer('display_order');
            $table->text('video_image')->nullable();
            $table->text('desc_2')->nullable();
            $table->integer('font_family_desc_2');
            $table->string('desc_2_fontsize',10)->nullable();
            $table->string('description_2_color',100)->nullable();
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
        Schema::dropIfExists('gallery_videos');
    }
};
