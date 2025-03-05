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
        Schema::create('unsubscribe_email', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('key'); // Field for the key
            $table->string('email'); // Field for the email, with a unique constraint
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unsubscribe_email');
    }
};
