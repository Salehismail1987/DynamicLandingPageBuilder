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
        Schema::table('forms_settings', function (Blueprint $table) {
            //
            $table->enum('formlinks_override_bg',['0','1'])->default('0')->after('feature_background_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms_settings', function (Blueprint $table) {
            //
            $table->dropColumn('formlinks_override_bg');
        });
    }
};
