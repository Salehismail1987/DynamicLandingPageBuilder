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
            $table->enum('gallery_slider_new_posts_top',['0','1'])->default('0')->after('gallery_tiles_override_bg');
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
            $table->dropColumn('gallery_slider_new_posts_top');
        });
    }
};
