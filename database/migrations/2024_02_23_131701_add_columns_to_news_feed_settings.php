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
        Schema::table('news_feed_settings', function (Blueprint $table) {
            //
            $table->text('newsfeed_bg_color')->nullable()->after('show_dates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_feed_settings', function (Blueprint $table) {
            //
            $table->dropColumn('newsfeed_bg_color');
        });
    }
};
