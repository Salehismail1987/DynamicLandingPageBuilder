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
        Schema::table('engagement_notifications', function (Blueprint $table) {
            $table->boolean('check_for_likes_and_comments')->default(false)->after('is_real_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engagement_notifications', function (Blueprint $table) {
            $table->dropColumn('check_for_likes_and_comments');
        });
    }
};
