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
            $table->text('post_desc_font_size')->default(null);
            $table->text('description_text_color')->default(null);
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
            //
        });
    }
};
