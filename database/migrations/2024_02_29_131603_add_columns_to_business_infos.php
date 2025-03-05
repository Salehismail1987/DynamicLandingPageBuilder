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
            //
            $table->text('business_text_sms')->nullable()->after('app_manager_recommendations');
            $table->text('business_owner_name')->nullable()->after('business_text_sms');
            $table->text('referral_customer_number')->nullable()->after('business_owner_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_infos', function (Blueprint $table) {
            //
            $table->dropColumn('business_text_sms');
            $table->dropColumn('business_owner_name');
            $table->dropColumn('referral_customer_number');
        });
    }
};
