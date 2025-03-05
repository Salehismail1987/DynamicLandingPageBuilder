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
        Schema::create('schedule_emails', function (Blueprint $table) {
            $table->id();
            $table->integer('is_done')->default(0);
            $table->integer('non_subscribers')->default(0);
            $table->integer('email_template_id');
            $table->dateTime('schedule_datetime')->nullable();
            $table->text('contact_group_id')->nullable();
            $table->enum('contact_type',['Contact','Group'])->default('Group');
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
        Schema::dropIfExists('schedule_emails');
    }
};
