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
            $table->enum('action_button_active',['0','1']);
            $table->string('action_button_phone_no_calls')->nullable();
            $table->string('action_button_phone_no_sms')->nullable();
            $table->string('action_button_action_email')->nullable();
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
            $table->dropColumn('action_button_active');
            $table->dropColumn('action_button_phone_no_calls');
            $table->dropColumn('action_button_phone_no_sms');
            $table->dropColumn('action_button_action_email');
        });
    }
};
