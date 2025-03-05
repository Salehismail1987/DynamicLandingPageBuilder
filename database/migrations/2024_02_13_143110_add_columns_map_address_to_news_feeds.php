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
        Schema::table('news_feeds', function (Blueprint $table) {
            //
            $table->text('btn_map_address')->nullable()->after('btn_form');
        });
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
            $table->dropColumn('btn_map_address');
        });
    }
};
