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
        Schema::table('set_hours_settings', function (Blueprint $table) {
            //
            $table->enum('scheduling_override_bg',['0','1'])->default('0')->after('background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('set_hours_settings', function (Blueprint $table) {
            //
            $table->dropColumn('scheduling_override_bg');
        });
    }
};
