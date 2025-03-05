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
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
            $table->text('action_button_map_address')->nullable()->after('action_button_address_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
            $table->dropColumn('action_button_map_address');
        });
    }
};
