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
        Schema::create('nav_bar_items', function (Blueprint $table) {
            $table->id();
            $table->enum('enable',['0','1']);
            $table->text('text');
            $table->text('color');
            $table->integer('section');
            $table->text('link_type');
            $table->integer('address_id');
            $table->text('link_url');
            $table->integer('custom_form');
            $table->text('phone_no_call')->nullable();
            $table->text('phone_no_sms')->nullable();
            $table->text('email')->nullable();
            $table->enum('enable_banner',['0','1']);
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
        Schema::dropIfExists('nav_bar_items');
    }
};
