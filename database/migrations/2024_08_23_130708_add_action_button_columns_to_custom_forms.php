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
        Schema::table('custom_forms', function (Blueprint $table) {
            $table->text('action_button_description')->nullable();
            $table->text('action_button_description_color')->nullable();
            $table->text('action_button_bg_color')->nullable();
            $table->text('action_button_link')->nullable();
            $table->text('action_button_link_text')->nullable();
            $table->integer('action_button_customform');
            $table->integer('action_button_address_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_forms', function (Blueprint $table) {
            //
        });
    }
};
