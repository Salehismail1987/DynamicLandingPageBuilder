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
            $table->string('feature_background_color',20)->nullable()->after('form_column');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_settings', function (Blueprint $table) {
            //
            $table->dropColumn('feature_background_color');
        });
    }
};
