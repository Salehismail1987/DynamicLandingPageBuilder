<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\alertPopupSetting;
use App\Models\ImageGalleryCategory;

class PopupController extends Controller
{
    public function updatepopup(Request $request){
        alertPopupSetting::where('id',1)->update([$request->popup_name => $request->popup_value]);
    }
}
