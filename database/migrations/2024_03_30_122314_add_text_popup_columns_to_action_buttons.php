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
        Schema::table('action_buttons', function (Blueprint $table) {
            //
            $table->longText('action_button_textpopup')->nullable()->after('action_button_video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_buttons', function (Blueprint $table) {
            //
            $table->dropColumn('action_button_textpopup');
        });
    }
};
