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
        Schema::create('schedule_email_customs', function (Blueprint $table) {
            $table->id();
            $table->integer('email_template_id');
            $table->text('schedule_email');
            $table->enum('is_done',['0','1']);
            $table->dateTime('schedule_datetime')->nullable();
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
        Schema::dropIfExists('schedule_email_customs');
    }
};
