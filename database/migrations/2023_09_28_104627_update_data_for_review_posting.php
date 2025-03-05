<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        permissions::where('permission_slug','review_staff')->update(['permission_name'=>'Reviews Posting']);
        frontSections::where('slug','testimonials')->update(['name'=>'Reviews Posting Section']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        permissions::where('permission_slug','review_staff')->update(['permission_name'=>'Reviews & Staff']);
        frontSections::where('slug','testimonials')->update(['name'=>'Reviews & Staff Section']);
    }
};
