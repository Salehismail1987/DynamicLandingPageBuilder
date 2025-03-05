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
        Schema::table('header_images', function (Blueprint $table) {
            //
            $table->enum('header_block_override_bg',['0','1'])->default('0')->after('header_scrollbar_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('header_images', function (Blueprint $table) {
            //
            $table->dropColumn('header_block_override_bg');
        });
    }
};
