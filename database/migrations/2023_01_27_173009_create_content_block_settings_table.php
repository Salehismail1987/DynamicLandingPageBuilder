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
        Schema::create('content_block_settings', function (Blueprint $table) {
            $table->id();
            $table->text('block_image');
            $table->text('block_image_size');
            $table->text('block_subimage_size');
            $table->enum('use_generic',[0,1]);
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
        Schema::dropIfExists('content_block_settings');
    }
};
