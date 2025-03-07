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
        DB::table('front_sections')->insert([
            [
                'name' => 'Attendhub',
                'slug' => 'attendhub',
                'section_order' => 25,
            ]
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
