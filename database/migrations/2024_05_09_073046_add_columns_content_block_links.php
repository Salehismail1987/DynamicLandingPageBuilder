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
        Schema::table('content_block_links', function (Blueprint $table) {
            $table->text('read_more_content_desc_color')->nullable()->after('content_desc_font_family');
            $table->text('read_more_content_desc_font_size')->nullable()->after('content_desc_font_family');
            $table->integer('read_more_content_desc_font_family')->nullable()->after('content_desc_font_family');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_block_links', function (Blueprint $table) {
            $table->dropColumn('read_more_content_desc_color')->after('content_desc_font_family');
            $table->dropColumn('read_more_content_desc_font_size')->after('read_more_content_desc_color');
            $table->dropColumn('read_more_content_desc_font_family')->after('read_more_content_desc_font_family');
        });
    }
};
