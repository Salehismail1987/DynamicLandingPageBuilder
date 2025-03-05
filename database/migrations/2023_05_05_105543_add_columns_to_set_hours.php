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
        Schema::table('set_hours', function (Blueprint $table) {
            $table->enum('day_orveride_generic',['0','1']);
            $table->enum('hours_orveride_generic',['0','1']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('set_hours', function (Blueprint $table) {
            $table->dropColumn('day_orveride_generic');
            $table->dropColumn('hours_orveride_generic');
        });
    }
};
