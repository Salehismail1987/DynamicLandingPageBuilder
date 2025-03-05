<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AttendhubPost;
use Illuminate\Http\Request;
use App\Models\newsFeed;
use App\Models\newsPosts;
use App\Models\galleryPost;
use App\Models\gallerySlider;
use App\Models\galleryVideo;
use App\Models\galleryTiles;
use App\Models\reviewSettings;
use App\Models\faqSettings;
use App\Models\blogSettings;
use App\Models\contentBlockSettings;
use App\Models\galleriesSettings;
use App\Models\newsFeedSetting;
use App\Models\newsPostSettings;
use App\Models\customForms;
use App\Models\textDetails;
use App\Models\formsSettings;
use App\Models\CrmSetting;
use App\Models\customUserForm;
use App\Models\outlineSettings;
use App\Models\reviewStaff;
use App\Models\StaffProductsPromos;
use App\Models\siteSettings;

class BaseController extends Controller
{
    public function saveDisplayOrder(Request $request){
        $table = $request->table;
        $column = $request->display_order_column;
        if(!$column){
            $column = 'display_order';
        }
        $order = trim($request->order,',');
        $order = explode(',',$order);
        $i = 1;
        foreach($order as $single){
            if($table=='news_feed'){
                newsFeed::where('id',$single)->update([$column => $i]);
            }else if($table=='news_posts'){
                newsPosts::where('id',$single)->update([$column => $i]);
            }else if($table=='gallery_posts'){
                galleryPost::where('id',$single)->update([$column => $i]);
            }else if($table=='gallery_sliders'){
                gallerySlider::where('id',$single)->update([$column => $i]);
            }else if($table=='gallery_videos'){
                galleryVideo::where('id',$single)->update([$column => $i]);
            }else if($table=='gallery_tiles'){
                galleryTiles::where('id',$single)->update([$column => $i]);
            }else if($table=='custom_forms'){
                customForms::where('id',$single)->update([$column => $i]);
            }else if($table=='custom_user_forms'){
                customUserForm::where('id',$single)->update([$column => $i]);
            }else if($table=='review_staff'){
                reviewStaff::where('id',$single)->update([$column => $i]);
            }else if($table=='staff_products_promos'){
                StaffProductsPromos::where('id',$single)->update([$column => $i]);
            }else if($table=='attendhub_posts'){
                AttendhubPost::where('id',$single)->update([$column => $i]);
            }
            $i++;   
        }
    }
    public function saveGenericSettings(Request $request){
        $table = $request->table;
        $column = $request->column;
        $value = $request->check_value;
        if($table=='reviewSettings'){
            $data = reviewSettings::find(1);
            $data->use_generic = $value?'1':'0';
            $data->save();
        }else if($table=='faqSettings'){
            $data = faqSettings::find(1);
            $data->use_generic= $value?'1':'0';
            $data->save();
        }else if($table=='blogSettings'){
            $data = blogSettings::find(1);
            $data->use_generic= $value?'1':'0';
            $data->save();
        }else if($table=='contentBlockSettings'){
            $data = contentBlockSettings::find(1);
            $data->use_generic= $value?'1':'0';
            $data->save();
        }else if($table=='galleriesSettings'){
            $data = galleriesSettings::find(1);
            $data->{$column} = $value?'1':'0';
            $data->save();
        }else if($table=='newsFeedSetting'){
            $data = newsFeedSetting::find(1);
            $data->{$column}= $value?'1':'0';
            $data->save();
        }else if($table=='newsPostSetting'){
            $data = newsPostSettings::find(1);
            $data->{$column}= $value?'1':'0';
            $data->save();
        }
    }
    public function updatetexttag(Request $request){
        $check_slug = $request->check_slug;
        $check_value = $request->check_value;
        if($check_slug=='formsSettings'){
            formsSettings::where('id', '1')
           ->update([
               'tag'=> $check_value=='1'?'h3':'h1'
            ]);
        }else{
            textDetails::where('slug', $check_slug)
           ->update([
               'tag'=> $check_value=='1'?'h3':'h1'
            ]);
        }
    }

    public function updateSubscribeToContact(Request $request){
        $check_value = $request->checked;
        CrmSetting::where('id', '1')->update([
           'subscribe_to_contact'=> $check_value
        ]);
    }
    public function updatetextenable(Request $request){
        $check_slug = $request->check_slug;
        $check_value = $request->check_value;
        if($check_slug=='formsSettings'){
            formsSettings::where('id', '1')
           ->update([
               'enable'=> $check_value
            ]);
        }else{
            textDetails::where('slug', $check_slug)
           ->update([
               'enable'=> $check_value
            ]);
        }
    }
    public function updateMasterOutlineColor(Request $request){
        $newData = (object)[];
        $newData->outline_color = $request->value;
        if($request->slug=='master_feature_settings'){
            outlineSettings::query()->update(['outline_color' => $request->value]);
        }else{
            update_outline_settings($request->slug,$newData);
        }
        return response()->json(['success' => true]);
    }

    public function updatemasterlabel(Request $request)
    {
        $newData = (object)[];
        $newData->outline_color = $request->value;
        if($request->slug=='label_color'){
            siteSettings::query()->update(['tutorial_label_color' => $request->value]);            
        }
    }

    public function updateMasterOutlineActive(Request $request){
        $newData = (object)[];
        $newData->active = $request->value;
        update_outline_settings($request->slug,$newData);
    }
    public function updateAllMasterOutlineActive(Request $request){
        if($request->value=='remove_outlines'){
            outlineSettings::query()->update(['active' => '0']);
        }else if($request->value=='activate_outlines'){
            outlineSettings::query()->update(['active' => '1']);
        }
        $message = 'Outlines updated';
        checkSendNotification('Frontend',$message,'frontend_notifications','frontend_notification_email');

    }
}
