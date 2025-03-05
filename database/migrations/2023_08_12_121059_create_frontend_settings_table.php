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
        Schema::create('frontend_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('all_feature_enable_on_edit')->default(1);
            $table->boolean('active_feature_enable_on_edit')->default(0);
            $table->timestamps();
        });

        \App\Models\frontendSetting::create([
            'all_feature_enable_on_edit' => 1,
            'active_feature_enable_on_edit' => 0,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frontend_settings');
    }
};
