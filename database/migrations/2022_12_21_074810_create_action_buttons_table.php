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
        Schema::create('action_buttons', function (Blueprint $table) {
            $table->id();
            $table->text('slug'); 
            $table->text('text')->nullable(); 
            $table->text('text_color')->nullable(); 
            $table->text('bg_color')->nullable(); 
            $table->text('action_type')->nullable();            
            $table->integer('active')->default(1);
            $table->text('link')->nullable();  
            $table->integer('address_id')->nullable();
            $table->integer('custom_form_id')->nullable();
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
        Schema::dropIfExists('action_buttons');
    }
};
