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
        Schema::create('crm_settings', function (Blueprint $table) {
            $table->id();
            $table->string('test_email_address')->nullable();
            $table->text('optout_email_address')->nullable();
            $table->text('email_marketing_from_email')->nullable();
            $table->text('email_marketing_from_name')->nullable();
            $table->text('email_marketing_reply_to')->nullable();
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
        Schema::dropIfExists('crm_settings');
    }
};
