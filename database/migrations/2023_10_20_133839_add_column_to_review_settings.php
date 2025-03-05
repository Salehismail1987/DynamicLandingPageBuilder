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
        Schema::table('review_settings', function (Blueprint $table) {
            //
            $table->enum('review_override_bg',['0','1'])->default('0')->after('use_generic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('review_settings', function (Blueprint $table) {
            //            
            $table->dropColumn('review_override_bg');
        });
    }
};
