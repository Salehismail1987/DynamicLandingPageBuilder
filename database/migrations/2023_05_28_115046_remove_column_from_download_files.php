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
        Schema::table('download_files', function (Blueprint $table) {
            $table->dropColumn(['max_width', 'max_height']);
            $table->integer('image_size')->after('download_text')->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('download_files', function (Blueprint $table) {
            $table->dropColumn('image_size');
            $table->integer('max_width')->default(250)->after('download_text');
            $table->integer('max_height')->default(250)->after('max_width');
        });
    }
};
