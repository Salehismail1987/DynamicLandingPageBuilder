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
            $table->enum('news_feed_override_bg',['0','1'])->default('0')->after('use_generic_newsfeed_setting');
            $table->string('news_feed_bg',22)->nullable()->after('news_feed_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_feed_setting', function (Blueprint $table) {
            //
            $table->dropColumn('news_feed_override_bg');
            $table->dropColumn('news_feed_bg');
        });
    }
};
