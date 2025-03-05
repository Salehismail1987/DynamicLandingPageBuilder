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
            $table->enum('busniess_hours_override_bg',['0','1'])->default('0')->after('apply_all_days');
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
            $table->dropColumn('busniess_hours_override_bg');
        });
    }
};
