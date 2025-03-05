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
        Schema::table('hyper_links_settings', function (Blueprint $table) {
            //
            $table->enum('hyperlinks_override_bg',['0','1'])->default('0')->after('link_image_size');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hyperlinks_settings', function (Blueprint $table) {
            //
            $table->dropColumn('hyperlinks_override_bg');
            
        });
    }
};
