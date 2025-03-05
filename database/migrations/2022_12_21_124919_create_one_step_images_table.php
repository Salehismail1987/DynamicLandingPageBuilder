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
        Schema::create('one_step_images', function (Blueprint $table) {
            $table->id();
            $table->text('category');
            $table->text('name');
            $table->text('first_image_id');
            $table->text('first_image_location');
            $table->text('second_image_id')->nullable();
            $table->text('second_image_location')->nullable();
            $table->integer('first_duration');
            $table->integer('second_duration');
            $table->integer('status')->default(0);
            $table->enum('notification_status',['1','0']);
            $table->integer('active_time')->default(0);
            $table->datetime('start_time')->nullable();
            $table->text('conditions')->nullable();
            $table->text('conditions_color');
            $table->text('default_button_color');
            $table->text('default_button_text_color');
            $table->integer('text_enabled')->default(0);
            $table->integer('first_image_text_id')->nullable();
            $table->integer('second_image_text_id')->nullable();
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
        Schema::dropIfExists('one_step_images');
    }
};
