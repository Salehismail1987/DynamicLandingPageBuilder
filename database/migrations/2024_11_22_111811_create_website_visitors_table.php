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
        Schema::create('website_visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(0); // Store the visitor count for a given date
            $table->date('date')->unique(); // Ensure only one record per date
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
        Schema::dropIfExists('website_visitors');
    }
};
