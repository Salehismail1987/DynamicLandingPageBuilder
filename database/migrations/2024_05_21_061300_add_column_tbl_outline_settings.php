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
        Schema::table('outline_settings', function (Blueprint $table) {
            $table->time('time')->nullable(); // Adjust the column type and options as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outline_settings', function (Blueprint $table) {
            $table->dropColumn('time');
        });
    }
};
