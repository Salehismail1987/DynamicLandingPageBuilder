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
        Schema::create('contact_box_settings', function (Blueprint $table) {
            $table->id();
            $table->text('background_color');
            $table->text('fontfamily');
            $table->enum('enable_texting_box',[0,1]);
            $table->enum('enable_phone_box',[0,1]);
            $table->enum('enable_email_box',[0,1]);
            $table->enum('enable_address_box',[0,1]);
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
        Schema::dropIfExists('contact_box_settings');
    }
};
