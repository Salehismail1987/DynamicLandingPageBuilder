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
        
        Schema::table('business_infos', function (Blueprint $table) {
            $table->text('recommendations_for_website_marketing')->nullable()->after('business_text_sms');
            $table->text('recommendations_for_socialmedia_marketing')->nullable()->after('recommendations_for_website_marketing');
            $table->text('recommendations_for_marketing_and_business_exposure')->nullable()->after('recommendations_for_socialmedia_marketing');
            $table->text('manager_name')->nullable()->after('recommendations_for_marketing_and_business_exposure');
            $table->text('manager_email')->nullable()->after('manager_name');
            $table->text('manager_number')->nullable()->after('manager_email');
        });
        DB::statement("ALTER TABLE `business_infos` CHANGE `app_manager_recommendations` `recommendations_for_business_type` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
