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
        //
        Schema::table('seo_settings', function (Blueprint $table) {
            //
            $table->enum('seo_block_override_bg',['0','1'])->default('0')->after('seo_block_text');
            $table->string('seo_block_background',22)->nullable()->after('seo_block_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('seo_settings', function (Blueprint $table) {
            //
            $table->dropColumn('seo_block_override_bg');
            $table->dropColumn('seo_block_background');
        });
    }
};
