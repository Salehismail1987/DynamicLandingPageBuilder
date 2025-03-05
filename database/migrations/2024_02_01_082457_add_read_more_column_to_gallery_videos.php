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
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
            $table->text('read_more_text')->nullable()->after('description_2_color');
            $table->text('read_less_text')->nullable()->after('read_more_text');
            $table->longText('read_more_desc')->nullable()->after('read_less_text');
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gallery_videos', function (Blueprint $table) {
            //
            $table->dropColumn('read_less_text');
            $table->dropColumn('read_more_text');
            $table->dropColumn('read_more_desc');
        });
    }
};
