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
        Schema::table('gallery_posts', function (Blueprint $table) {
            //
            $table->string('action_button_audio_icon_feature')->nullable()->after('action_button_address_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_posts', function (Blueprint $table) {
            //
            $table->dropColumn('action_button_audio_icon_feature');
        });
    }
};
