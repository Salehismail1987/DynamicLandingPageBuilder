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
        Schema::create('custom_forms', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();;
            $table->text('subtitle');
            $table->text('descriptive');
            $table->text('image')->nullable();
            $table->text('image_size')->nullable();
            $table->enum('static_form',['0','1']);
            $table->text('footer_text_1')->nullable();
            $table->text('footer_text_2')->nullable();
            $table->text('fields')->nullable();
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
        Schema::dropIfExists('custom_forms');
    }
};
