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
        Schema::create('timed_images_settings', function (Blueprint $table) {
            $table->id();
            $table->text('slug');
            $table->integer('enable')->default(0);
            $table->text('start_time')->nullable();
            $table->text('end_time');
            $table->text('days')->nullable();
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
        Schema::dropIfExists('timed_images_settings');
    }
};
