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
        Schema::table('front_sections', function (Blueprint $table) {
            $table->integer('edit_section_order')->default(1)->after('section_enabled');
            $table->integer('edit_section_enabled')->default(1)->after('edit_section_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('front_sections', function (Blueprint $table) {
            $table->dropColumn('edit_section_order');
            $table->dropColumn('edit_section_enabled');
        });
    }
};
