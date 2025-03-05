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
            $table->enum('show_dates',['0','1'])->default('0')->after('news_feed_bg');
      
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
            $table->dropColumn('show_dates');
        });
    }
};
