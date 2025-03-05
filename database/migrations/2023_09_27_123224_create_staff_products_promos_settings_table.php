<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StaffProductsPromosSettings;
use App\Models\permissions;
use App\Models\frontSections;
use App\Models\outlineSettings;
use App\Models\textDetails;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_products_promos_settings', function (Blueprint $table) {
            $table->id();
            $table->string('background',255);
            $table->enum('enable_stars',[0,1]);
            $table->enum('use_generic',[0,1]);
            $table->timestamps();
        });
        $staffProductsPromosSettings = new StaffProductsPromosSettings();
        $staffProductsPromosSettings->background = '#fff';
        $staffProductsPromosSettings->enable_stars = '0';
        $staffProductsPromosSettings->use_generic = '0';
        $staffProductsPromosSettings->save();
        
        $newData = new permissions();
        $newData->permission_name = 'Staff, Products or Promos';
        $newData->permission_slug = 'staff_products_promos';
        $newData->parent_id = '3';
        $newData->display_order = '1';
        $newData->save();
        
        $id = $newData->id;
        
        $newData = new permissions();
        $newData->permission_name = 'Text';
        $newData->permission_slug = 'staff_products_promos_text';
        $newData->parent_id = $id;
        $newData->display_order = '0';
        $newData->save();
        
        $newData = new permissions();
        $newData->permission_name = 'Add New';
        $newData->permission_slug = 'staff_products_promos_add_new';
        $newData->parent_id = $id;
        $newData->display_order = '0';
        $newData->save();
        
        $newData = new permissions();
        $newData->permission_name = 'Delete';
        $newData->permission_slug = 'staff_products_promos_delete';
        $newData->parent_id = $id;
        $newData->display_order = '0';
        $newData->save();
        
        $newData = new frontSections();
        $newData->name = 'Staff, Products or Promos';
        $newData->slug = 'staff_products_promos';
        $newData->section_order = '8';
        $newData->section_enabled = '1';
        $newData->section_order = '18';
        $newData->edit_section_enabled = '1';
        $newData->save();
        
        $newData = new outlineSettings();
        $newData->slug = 'staff_products_promos';
        $newData->active = '0';
        $newData->outline_color = '#000';
        $newData->save();
        
        $newData = new textDetails();
        $newData->slug = 'staff_products_promos_title';
        $newData->enable = '1';
        $newData->text = 'Staff, Products or Promos';
        $newData->size_web = '38';
        $newData->size_mobile = '26';
        $newData->color = '#ffffff';
        $newData->bg_color = '#000';
        $newData->fontfamily = '51';
        $newData->tag = 'h3';
        $newData->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_products_promos_settings');
        permissions::where('permission_slug','staff_products_promos')->delete();
        permissions::where('permission_slug','staff_products_promos_text')->delete();
        permissions::where('permission_slug','staff_products_promos_add_new')->delete();
        permissions::where('permission_slug','staff_products_promos_delete')->delete();
        frontSections::where('slug','staff_products_promos')->delete();
        outlineSettings::where('slug','staff_products_promos')->delete();
        textDetails::where('slug','staff_products_promos_title')->delete();
    }
};
