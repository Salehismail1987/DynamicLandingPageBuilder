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
        Schema::create('email_post_starters', function (Blueprint $table) {
            $table->id();
            $table->text('teaser_title');
            $table->text('content_title');
            $table->text('logo_image')->nullable();
            $table->text('logo_text')->nullable();
            $table->text('email_image')->nullable();
            $table->text('description_text');
            $table->text('preheader_text')->nullable();
            $table->text('logo_title_font_family')->nullable();
            $table->text('logo_title_text_size')->nullable();
            $table->text('logo_title_text_color')->nullable();
            $table->text('email_image_description_font_family')->nullable();
            $table->text('email_image_desciption_text_size')->nullable();
            $table->text('email_image_desciption_text_color')->nullable();
            $table->text('action_button_active')->nullable();
            $table->text('action_button_discription')->nullable();
            $table->text('action_button_discription_color')->nullable();
            $table->text('action_button_bg_color')->nullable();
            $table->text('action_button_link')->nullable();
            $table->text('action_button_link_text')->nullable();
            $table->integer('action_button_customform');
            $table->text('action_button_address_id')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('subtitle_font_family')->nullable();            
            $table->text('subtitle_text_size')->nullable();
            $table->text('subtitle_text_color')->nullable();
            $table->integer('override_generic_settings')->default(1);
            $table->text('content_title_text_size')->nullable();
            $table->text('content_title_text_color')->nullable();
            $table->text('content_title_font_family')->nullable();
            $table->integer('is_email_description_center')->default(0);
            $table->integer('is_content_title_justified_center')->default(0);
            $table->integer('is_sub_title_justified_center')->default(0);
            $table->integer('display_order')->default(0);
            $table->text('notes')->nullable();
            $table->integer('link_social_media_icons')->default(0);
            $table->text('action_button_active_2')->nullable();
            $table->text('action_button_discription_2')->nullable();
            $table->text('action_button_discription_color_2')->nullable();
            $table->text('action_button_bg_color_2')->nullable();
            $table->text('action_button_link_2')->nullable();
            $table->text('action_button_link_text_2')->nullable();
            $table->integer('action_button_customform_2');
            $table->text('action_button_address_id_2')->nullable();
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
        Schema::dropIfExists('email_post_starters');
    }
};
