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
        DB::table('front_sections')
            ->where('name', '!=', 'Header Section')
            ->whereNotNull('section_order')
            ->update(['section_order' => DB::raw('section_order + 1')]);

        // Get max id from the table
        $maxId = DB::table('front_sections')->max('id');

        // Insert new row
        DB::table('front_sections')->insert([
            'id' => $maxId + 1,
            'name' => 'Header Slider',
            'slug' => 'headerslider',
            'section_order' => 1,
            'section_enabled' => 1,
            'edit_section_order' => 0,
            'edit_section_enabled' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
