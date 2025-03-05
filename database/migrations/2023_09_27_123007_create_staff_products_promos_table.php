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
        Schema::create('staff_products_promos', function (Blueprint $table) {
            $table->id();
            $table->text('image',255)->nullable();
            $table->text('text',255)->nullable();
            $table->string('text_size',10)->nullable();
            $table->string('text_color',20)->nullable();
            $table->integer('text_font');
            $table->enum('stars',['0','0.5','1','1.5','2','2.5','3','3.5','4','4.5','5']);
            $table->string('star_color',20);
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
        Schema::dropIfExists('staff_products_promos');
    }
};
