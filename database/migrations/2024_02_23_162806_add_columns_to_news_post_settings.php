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
        Schema::table('news_post_settings', function (Blueprint $table) {
            //
            $table->enum('news_post_override_bg',['0','1'])->default('0')->after('generic_news_post_show_date');
            $table->string('news_post_background',22)->nullable()->after('news_post_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_post_settings', function (Blueprint $table) {
            //
            $table->dropColumn('news_post_override_bg');
            $table->dropColumn('news_post_background');
        });
    }
};
