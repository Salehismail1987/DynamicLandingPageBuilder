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
        Schema::create('contact_form_titles', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('contact_form_titles');
    }
};
