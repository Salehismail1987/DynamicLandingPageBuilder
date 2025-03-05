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
        Schema::create('gallery_sliders', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->text('text')->nullable();
            $table->integer('font_family');
            $table->text('text_color')->nullable();
            $table->text('back_color')->nullable();
            $table->string('text_fontsize',10)->nullable();
            $table->string('text_fontsize_mobile',10)->nullable();
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
        Schema::dropIfExists('gallery_sliders');
    }
};
