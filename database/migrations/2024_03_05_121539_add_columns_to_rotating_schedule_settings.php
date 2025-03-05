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
            $table->string('arrow_color')->after('busniess_hours_override_bg')->nullable();
            $table->string('arrow_bg_color')->after('arrow_color')->nullable();
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
            $table->dropColumn('arrow_color');
            $table->dropColumn('arrow_bg_color');
        });
    }
};
