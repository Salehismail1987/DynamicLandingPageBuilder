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
        DB::statement("ALTER TABLE attendhub_posts MODIFY image_size INTEGER NULL;");
    }

    public function down()
    {
        DB::statement("ALTER TABLE attendhub_posts MODIFY image_size INTEGER NOT NULL;");
    }
};
