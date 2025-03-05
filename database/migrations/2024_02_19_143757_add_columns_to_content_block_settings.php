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
        Schema::table('content_block_settings', function (Blueprint $table) {
            //
            $table->enum('content_block_override_bg',['0','1'])->default('0')->after('use_generic');
            $table->string('content_block_background',22)->nullable()->after('content_block_override_bg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_block_settings', function (Blueprint $table) {
            //
            $table->dropColumn('content_block_override_bg');
            $table->dropColumn('content_block_background');
        });
    }
};
