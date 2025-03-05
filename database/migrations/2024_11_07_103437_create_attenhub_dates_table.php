<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttenhubDatesTable extends Migration
{
    public function up()
    {
        Schema::create('attenhub_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attenhub_id')->constrained('attendhub_posts')->onDelete('cascade');
            $table->date('event_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attenhub_dates');
    }
};
