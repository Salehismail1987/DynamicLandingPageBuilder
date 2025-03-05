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
        Schema::create('set_hours', function (Blueprint $table) {
            $table->id();
            $table->text('start');
            $table->text('end');
            $table->text('comments');
            $table->text('start_2');
            $table->text('end_2');
            $table->text('comments_2');
            $table->text('hours_color');
            $table->text('day_color');
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
        Schema::dropIfExists('set_hours');
    }
};
