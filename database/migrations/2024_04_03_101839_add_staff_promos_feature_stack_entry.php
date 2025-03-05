<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\frontSections;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $promos = frontSections::where('slug','staff_products_promos')->first();
        if(!$promos){
            DB::statement("INSERT INTO `front_sections` (`id`, `name`, `slug`, `section_order`, `section_enabled`, `edit_section_order`, `edit_section_enabled`, `created_at`, `updated_at`) VALUES (NULL, 'Staff, Products or Promos', 'staff_products_promos', '4', '0', '4', '0', NULL, NULL);
            ");
        }
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
