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
        Schema::table('news_posts', function (Blueprint $table) {
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
        Schema::table('news_posts', function (Blueprint $table) {
            $table->dropColumn('action_button_phone_no_calls');
            $table->dropColumn('action_button_phone_no_sms');
            $table->dropColumn('action_button_action_email');
        });
    }
};
