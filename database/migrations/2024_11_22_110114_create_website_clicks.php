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
        Schema::create('website_clicks', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(0); // Click count
            $table->date('date'); // Add date column for tracking
            $table->timestamps();

            // Add unique constraint on 'date'
            $table->unique('date'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_clicks');
    }
};
