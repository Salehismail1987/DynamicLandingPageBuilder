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
        Schema::create('event_post_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sub_title_font')->nullable();             // Font for the subtitle
            $table->integer('title_text_size_mobile')->nullable();          // Text size for mobile
            $table->integer('title_text_size_web')->nullable();             // Text size for web
            $table->string('title_text_color', 7)->nullable();              // Text color in hex format
            $table->string('title_text_bg_color', 7)->nullable();           // Background color for text
            $table->string('description_font')->nullable();           // Font for description
            $table->integer('desc_text_size_mobile')->nullable();     // Description text size for mobile
            $table->integer('desc_size_web')->nullable();             // Description text size for web
            $table->string('feature_bg_color', 7)->nullable();        // Background color for feature section
            $table->string('desc_text_color', 7)->nullable(); 
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
        Schema::dropIfExists('event_post_settings');
    }
};
