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
        Schema::table('rotating_schedule_settings', function (Blueprint $table) {
            //
            $table->string('day_tile_bg_color')->nullable()->after('arrow_bg_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rotating_schedule_settings', function (Blueprint $table) {
            //
            $table->dropColumn('day_tile_bg_color');
        });
    }
};
