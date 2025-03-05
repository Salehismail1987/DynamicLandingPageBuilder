<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\permissions;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            
            $permissions = new permissions();
            $permissions->permission_name = 'Build Site Content';
            $permissions->permission_slug = 'build_site_Content';
            $permissions->parent_id = '3';
            $permissions->display_order = '7';
            $permissions->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            permissions::query()->delete(['permission_slug' => 'build_site_Content']);
        });
    }
};
