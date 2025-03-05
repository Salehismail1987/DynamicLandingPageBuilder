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
        Schema::create('hyper_links_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('show_links',[0,1]);
            $table->string('link_image',255);
            $table->string('link_image_size',255);
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
        Schema::dropIfExists('hyper_links_settings');
    }
};
