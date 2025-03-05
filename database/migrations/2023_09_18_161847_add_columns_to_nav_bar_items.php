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
        Schema::table('nav_bar_items', function (Blueprint $table) {
            $table->text('use_default_text_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nav_bar_items', function (Blueprint $table) {
            $table->dropColumn('use_default_text_color');
        });
    }
};
