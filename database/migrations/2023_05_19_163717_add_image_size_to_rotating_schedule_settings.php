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
            $table->integer('max_width')->default(100)->after('background');
            $table->integer('max_height')->default(100)->after('max_width');
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
            $table->dropColumn(['max_width', 'max_height']);
        });
    }
};
