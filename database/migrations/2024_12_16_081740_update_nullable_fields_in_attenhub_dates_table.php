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
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `event_date` DATE NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `event_day` VARCHAR(255) NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `from_time` TIME NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `to_time` TIME NULL;');
    }

    public function down()
    {
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `event_date` DATE NOT NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `event_day` VARCHAR(255) NOT NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `from_time` TIME NOT NULL;');
        DB::statement('ALTER TABLE `attenhub_dates` MODIFY `to_time` TIME NOT NULL;');
    }
};
