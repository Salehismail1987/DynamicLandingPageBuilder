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
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('footer_text');
            $table->text('footre_text_link');
            $table->text('footre_back_color');
            $table->text('footre_text_color');
            $table->text('footer_text_1');
            $table->text('footer_text_2');
            $table->text('copy_right_text');
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
        Schema::dropIfExists('footer_settings');
    }
};
