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
        Schema::create('business_infos', function (Blueprint $table) {
            $table->id();
            $table->text('business_name');
            $table->text('contact_name');
            $table->text('contact_title');
            $table->text('contact_email');
            $table->text('contact_phoneno');
            $table->text('contact_address');
            $table->text('product_info');
            $table->text('address_for_map');
            $table->integer('showcurrentaddressonheaderblock');
            $table->integer('show_address_header');
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
        Schema::dropIfExists('business_infos');
    }
};
