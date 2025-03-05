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
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->text('google_search_title');
            $table->text('google_search_description');
            $table->text('metatag_inputs');
            $table->text('meta_language');
            $table->text('metatag_robots');
            $table->text('meta_keywords');
            $table->text('metatag_revisit_after');
            $table->text('meta_author');
            $table->longText('seo_block_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_settings');
    }
};
