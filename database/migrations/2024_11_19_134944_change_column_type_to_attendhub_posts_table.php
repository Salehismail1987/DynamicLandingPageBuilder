<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendhub_posts', function (Blueprint $table) {
            DB::statement('ALTER TABLE attendhub_posts MODIFY COLUMN action_button_textpopup LONGTEXT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendhub_posts_table', function (Blueprint $table) {
        });
    }
};
