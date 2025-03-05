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
        Schema::table('business_infos', function (Blueprint $table) {
            //
            $table->string('header_display_name')->nullable()->after('address_for_map');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_infos', function (Blueprint $table) {
            //
            $table->dropColumn('header_display_name');
        });
    }
};
