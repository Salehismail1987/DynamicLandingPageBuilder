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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('count')->default(0);
            $table->timestamps();
        });
        DB::table('likes')->insert([
            ['category' => 'business', 'count' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'service', 'count' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['category' => 'website', 'count' => 40, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
