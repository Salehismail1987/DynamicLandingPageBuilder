<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            DB::statement("ALTER TABLE `engagement_notifications` MODIFY `emails` VARCHAR(255) NULL");
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
            //
        });
    }
};
