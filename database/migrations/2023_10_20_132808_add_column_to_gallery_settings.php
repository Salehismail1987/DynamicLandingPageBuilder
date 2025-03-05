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
            $table->enum('gallery_slider_override_bg',['0','1'])->default('0')->after('gallery_tiles_background');
            $table->enum('gallery_posts_override_bg',['0','1'])->default('0')->after('gallery_slider_override_bg');
            $table->string('gallery_post_background',22)->nullable()->after('gallery_posts_override_bg');
            $table->enum('gallery_video_override_bg',['0','1'])->default('0')->after('gallery_post_background');
            $table->enum('gallery_tiles_override_bg',['0','1'])->default('0')->after('gallery_video_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_settings', function (Blueprint $table) {
            //
            $table->dropColumn('gallery_slider_override_bg');
            $table->dropColumn('gallery_posts_override_bg');
            $table->dropColumn('gallery_post_background');
            $table->dropColumn('gallery_video_override_bg');
            $table->dropColumn('gallery_tiles_override_bg');
        });
    }
};
