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
        Schema::create('engagement_comments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Name column, optional and nullable
            $table->text('comment'); // Comment column for storing the comment
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
        Schema::dropIfExists('engagement_comments');
    }
};
