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
            $table->enum('gallery_post_autoplay',['0','1'])->default('0')->after('gallery_slider_autoplay');
      
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
            $table->dropColumn('gallery_post_autoplay');
        });
    }
};
