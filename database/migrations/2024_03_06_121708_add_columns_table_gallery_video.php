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
            $table->text('read_more_content_color')->nullable()->after('read_more_desc');
            $table->text('read_more_content_font_size')->nullable()->after('read_more_content_color');
            $table->text('read_more_content_font_family')->nullable()->after('read_more_content_font_size');
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
    }
};
