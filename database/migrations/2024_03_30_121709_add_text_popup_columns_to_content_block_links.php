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
            //
            $table->longText('action_button_textpopup')->nullable()->after('action_button_action_audio');
            
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
            //
            $table->dropColumn('action_button_textpopup');
        });
    }
};
