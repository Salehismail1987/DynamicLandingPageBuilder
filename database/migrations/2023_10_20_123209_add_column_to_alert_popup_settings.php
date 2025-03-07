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
        Schema::table('alert_popup_settings', function (Blueprint $table) {
            //
            $table->enum('popup_alert_override_bg',['0','1'])->default('0')->after('popup_show_always');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alert_popup_settings', function (Blueprint $table) {
            //
            $table->dropColumn('popup_alert_override_bg');
        });
    }
};
