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
        Schema::table('staff_products_promos', function (Blueprint $table) {
            $table->integer('left_action_button_event_form')->default(null); 
            $table->integer('right_action_button_event_form')->default(null); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_product_promos', function (Blueprint $table) {
            //
        });
    }
};
