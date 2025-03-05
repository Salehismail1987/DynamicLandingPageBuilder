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
        Schema::table('blog_settings', function (Blueprint $table) {
            //
            $table->text('read_more_button_color')->nullable()->after('use_generic');
            $table->text('read_more_button_bg_color')->nullable()->after('read_more_button_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_settings', function (Blueprint $table) {
            //
            $table->text('read_more_button_color');
            $table->text('read_more_button_bg_color');
        });
    }
};
