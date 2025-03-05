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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->text('form_title');
            $table->text('form_title_color');
            $table->text('form_title_size');
            $table->integer('form_title_font_family');
            $table->text('form_email');
            $table->text('form_google_map');
            $table->enum('form_status',[0,1]);
            $table->enum('show_map',[0,1]);
            $table->text('form_fields');
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
        Schema::dropIfExists('contact_forms');
    }
};
