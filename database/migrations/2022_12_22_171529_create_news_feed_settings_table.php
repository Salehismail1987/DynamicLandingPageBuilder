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
        Schema::create('news_feed_settings', function (Blueprint $table) {
            $table->id();
            $table->text('from_name')->nullable();
            $table->text('from_email')->nullable();
            $table->text('reply_to')->nullable();
            $table->text('optout_email')->nullable();
            $table->text('preheader')->nullable();
            $table->integer('use_generic_newsfeed_setting')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_feed_settings');
    }
};
