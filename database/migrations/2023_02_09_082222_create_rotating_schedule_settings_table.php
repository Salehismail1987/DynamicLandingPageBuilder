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
        Schema::create('rotating_schedule_settings', function (Blueprint $table) {
            $table->id();
            $table->text('rotating_schedule_image');
            $table->text('background');
            $table->enum('apply_all_days',[0,1]);
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
        Schema::dropIfExists('rotating_schedule_settings');
    }
};
