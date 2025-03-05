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
        Schema::table('alert_banner_settings', function (Blueprint $table) {
            //
            $table->text('menu_icon_color')->nullable()->after('alert_banner_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alert_banner_settings', function (Blueprint $table) {
            //
            $table->dropColumn('menu_icon_color');
        });
    }
};
