<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        //
        $textDetails = textDetails::where('slug','hyper_link_link')->get()->toArray();
        $OldfrontendData = textDetails::where('slug','hyper_link_text')->first();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "hyper_link_link";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->size_web;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->size_web;
            $newData->bg_color = $OldfrontendData->bg_color;
            $newData->fontfamily = $OldfrontendData->fontfamily;
            $newData->save();
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
