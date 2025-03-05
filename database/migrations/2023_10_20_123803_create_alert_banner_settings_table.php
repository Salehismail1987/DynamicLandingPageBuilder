<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\AlertBannerSetting;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alert_banner_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('alert_banner_override_bg',['0','1'])->default('0');
            $table->timestamps();
        });
        AlertBannerSetting::create([
            'alert_banner_override_bg' => '0'
        ]);

    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alert_banner_settings');
    }
};
