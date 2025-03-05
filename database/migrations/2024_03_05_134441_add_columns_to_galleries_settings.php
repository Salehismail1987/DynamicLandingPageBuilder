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
        Schema::table('galleries_settings', function (Blueprint $table) {
            //
            $table->string('gallery_posts_arrow_color')->after('gallery_video_size')->nullable();
            $table->string('gallery_posts_arrow_bg_color')->after('gallery_posts_arrow_color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries_settings', function (Blueprint $table) {
            //
            $table->string('gallery_posts_arrow_color')->nullable();
            $table->string('gallery_posts_arrow_bg_color')->nullable();
        });
    }
};
