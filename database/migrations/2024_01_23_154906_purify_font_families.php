<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FontFamily;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fontfamilies = FontFamily::get();
        if($fontfamilies && count($fontfamilies)>0){
            foreach($fontfamilies as $fontfamily){
                $fontfamily->value = str_replace("'",'',$fontfamily->value);
                $fontfamily->value = str_replace(", sans-serif",'',$fontfamily->value);
                $fontfamily->value = str_replace(", monospace",'',$fontfamily->value);
                $fontfamily->value = str_replace(", cursive",'',$fontfamily->value);
                $fontfamily->save();
            }
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
