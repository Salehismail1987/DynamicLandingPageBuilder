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
            $table->text('gallery_video_size')->nullable()->after('gallery_slider_new_posts_top');
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
            $table->dropColumn('gallery_video_size');
        });
    }
};
