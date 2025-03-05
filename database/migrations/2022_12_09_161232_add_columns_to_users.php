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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_role')->after('id')->default('0');
            $table->string('photo',255)->after('password')->default('');
            $table->enum('admin_type',['0','1'])->after('photo')->default('0');
        });

        DB::table('users')->insert(
            array(
                'name'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> '$2y$10$Xu9569BDqJqThUxQByla0u09sVag53y4MNPLsOU8nhNxG/ZvzGP.i',
                'user_role'=> '1',
                'admin_type' => '1'
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_role');
            $table->dropColumn('photo');
            $table->dropColumn('admin_type');
        });
        //DB::table('users')->delete();
    }
};
