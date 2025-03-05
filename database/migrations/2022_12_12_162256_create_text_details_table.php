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
        Schema::create('text_details', function (Blueprint $table) {
            $table->id();
            $table->text('slug');
            $table->text('text')->nullable();
            $table->text('size_web')->nullable();
            $table->text('size_mobile')->nullable();
            $table->text('color')->nullable();
            $table->text('bg_color')->nullable();
            $table->integer('fontfamily')->nullable();
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
        Schema::dropIfExists('text_details');
    }
};
