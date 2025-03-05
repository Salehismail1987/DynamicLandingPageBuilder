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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');
            $table->string('question_font_size',10);
            $table->string('question_text_color',10);
            $table->integer('question_font_family');
            $table->text('answer_text');
            $table->string('answer_font_size',10);
            $table->string('answer_text_color',10);
            $table->integer('answer_font_family');
            $table->string('faq_background_color',10);
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
        Schema::dropIfExists('faqs');
    }
};
