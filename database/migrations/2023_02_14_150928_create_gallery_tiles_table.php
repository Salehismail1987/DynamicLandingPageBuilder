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
        Schema::create('gallery_tiles', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('description');
            $table->string('description_color')->default('#000000');
            $table->string('description_size',10);
            $table->integer('description_font');
            $table->tinyInteger('enable_timed_image');
            $table->string('timed_image');
            $table->integer('timed_image_duration');
            $table->timestamp('timed_image_start_time')->nullable(); 
            $table->enum('timed_image_type',['days','timer'])->default('days');
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
        Schema::dropIfExists('gallery_tiles');
    }
};
