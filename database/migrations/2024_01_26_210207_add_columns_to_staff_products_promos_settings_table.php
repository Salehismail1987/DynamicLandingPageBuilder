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
            $table->text('arrow_color')->nullable()->after('use_generic');
            $table->text('arrow_hover_color')->nullable()->after('arrow_color');
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
            $table->dropColumn('arrow_color');
            $table->dropColumn('arrow_hover_color');
        });
    }
};
