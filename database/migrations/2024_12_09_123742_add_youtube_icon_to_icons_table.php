<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\icons;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        icons::updateOrCreate(
            ['name' => "YouTube"], // Match the name
            ['value' => "fa fa-youtube"] // Set or update the value
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        icons::where('name', "YouTube")->delete();
    }
};
