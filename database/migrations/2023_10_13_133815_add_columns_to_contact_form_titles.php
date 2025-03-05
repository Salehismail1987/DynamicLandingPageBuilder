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
        Schema::table('contact_form_titles', function (Blueprint $table) {
            //            
            $table->enum('enable_theme_bg',['0','1'])->default('0')->after('fontfamily');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_form_titles', function (Blueprint $table) {
            //            
            $table->dropColumn('fontfamily');
        });
    }
};
