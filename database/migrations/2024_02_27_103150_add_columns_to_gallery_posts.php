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
        Schema::table('gallery_posts', function (Blueprint $table) {
            //
            $table->longText('gallery_post_fixed_description')->nullable()->after('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_posts', function (Blueprint $table) {
            //
            $table->dropColumn('gallery_post_fixed_description');
        });
    }
};
