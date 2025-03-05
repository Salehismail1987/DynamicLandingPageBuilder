<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\newsFeed;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_feeds', function (Blueprint $table) {
            //
            $table->dateTime('newsfeed_date')->nullable()->after('update_dates_on_saving');
        });

        $feeds = newsFeed::whereNull('newsfeed_date')->get();

        foreach($feeds  as $feed){

            $feed->newsfeed_date = date("Y-m-d H:i:s", strtotime($feed->created_at));
            $feed->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_feeds', function (Blueprint $table) {
            //
            $table->dropColumn('newsfeed_date');
        });
    }
};
