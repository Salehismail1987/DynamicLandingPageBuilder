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
        Schema::create('learning_center_action_buttons', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('feature_slug');
            $table->string('link')->nullable();
            $table->string('action_type');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('map_address')->nullable();
            $table->unsignedBigInteger('custom_form_id')->nullable();
            $table->text('text')->nullable();
            $table->string('text_color')->nullable();
            $table->string('bg_color')->nullable();
            $table->text('action_button_textpopup')->nullable();
            $table->string('action_button_phone_no_calls')->nullable();
            $table->string('action_button_phone_no_sms')->nullable();
            $table->string('action_button_action_email')->nullable();
            $table->string('action_button_audio')->nullable();
            $table->string('action_button_video')->nullable();
            $table->string('action_button_audio_icon_feature')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('learning_center_action_buttons');
    }
};
