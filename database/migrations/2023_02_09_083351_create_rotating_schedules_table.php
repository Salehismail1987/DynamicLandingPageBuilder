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
        Schema::create('rotating_schedules', function (Blueprint $table) {
            $table->id();
            $table->text('day');
            $table->text('date');
            $table->text('start');
            $table->text('end');
            $table->text('comments');
            $table->text('start_2');
            $table->text('end_2');
            $table->text('comments_2');
            $table->text('image_description');
            $table->text('description_font_size');
            $table->text('description_font_family');
            $table->text('image');
            $table->enum('duplicate_for_next_week_day',[0,1]);
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
        Schema::dropIfExists('rotating_schedules');
    }
};
