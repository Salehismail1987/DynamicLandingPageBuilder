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
        Schema::create('custom_schedule_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('email_template_id');
            $table->text('schedule_email');
            $table->integer('is_done');
            $table->dateTime('schedule_datetime');
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
        Schema::dropIfExists('custom_schedule_emails');
    }
};
