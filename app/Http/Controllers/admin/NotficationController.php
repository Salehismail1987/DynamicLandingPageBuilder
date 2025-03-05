<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageGalleryCategory;

use App\Models\NotificationSettings;

class NotficationController extends Controller
{
    //

    public function update(Request $request){
		$module = $request->module;
		$checked = $request->checked;
		NotificationSettings::where('id','1')->update(array($module=>$checked));
	}
}
