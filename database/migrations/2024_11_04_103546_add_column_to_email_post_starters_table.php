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
        Schema::table('email_post_starters', function (Blueprint $table) {
            $table->integer('action_button_event_form')->default(null);
            $table->integer('action_button_event_form2')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_post_starters', function (Blueprint $table) {
            //
        });
    }
};
