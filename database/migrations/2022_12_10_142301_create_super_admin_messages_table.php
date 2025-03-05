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
        Schema::create('super_admin_messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('text_font_size','10');
            $table->string('font_size_mobile','10');
            $table->integer('text_font_family');
            $table->string('text_color','10');
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
        Schema::dropIfExists('super_admin_messages');
    }
};
