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
        Schema::table('attendhub_posts', function (Blueprint $table) {
            $table->string('action_button_description')->nullable(); // Description field (nullable)
            $table->string('action_button_description_color', 7)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendhub_posts', function (Blueprint $table) {
            $table->dropColumn('action_button_description');
            $table->dropColumn('action_button_description_color');
        });
    }
};
