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
        Schema::table('staff_products_promos_settings', function (Blueprint $table) {
            //
            $table->text('dot_color')->nullable()->after('arrow_hover_color');
            $table->text('dot_active_color')->nullable()->after('dot_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff_products_promos_settings', function (Blueprint $table) {
            //
            $table->dropColumn('dot_color');
            $table->dropColumn('dot_active_color');
        });
    }
};
