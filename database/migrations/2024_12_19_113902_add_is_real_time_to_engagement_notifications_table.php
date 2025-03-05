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
        Schema::table('engagement_notifications', function (Blueprint $table) {
            $table->boolean('is_real_time')->default(true)->nullable(); // Replace 'last_column_name' with the name of the last column in your table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('engagement_notifications', function (Blueprint $table) {
            $table->dropColumn('is_real_time');
        });
    }
};
