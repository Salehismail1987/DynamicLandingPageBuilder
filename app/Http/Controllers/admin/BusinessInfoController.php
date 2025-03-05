<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use App\Models\BusinessInfo;
use App\Models\alertPopupSetting;
use App\Models\ContactInfo;
use App\Models\socialMedia;
use App\Models\icons;
use App\Models\timeZones;
use App\Models\siteSettings;
use App\Models\user;
use App\Models\userRolls;
use App\Models\imageCategories;
use App\Models\addresses;
use Session;
use DB;

class BusinessInfoController extends Controller
{
    public function index(){
        if(!check_auth_permission([
            'user_types', 'permissions', 'business_contact_info',
            'addresses',
            'social_media',
            'business_info_section',
            'timezones',
        ])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $currentConnection = config('database.default');
        $this->data['controller'] = 'businessinfo';
        $this->data['controller_name'] = 'Business Info';
        $this->data['all_categories'] = ImageGalleryCategory::all(); 
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        updateTimedImages();
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['font_family'] = get_font_family();
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['businessInfo'] = BusinessInfo::first();
        $this->data['contactInfo'] = ContactInfo::first();
        $this->data['socialMedia'] = socialMedia::all();
        $this->data['icons'] = icons::all();
        $this->data['timeZones'] = timeZones::all();
        $this->data['siteSettings'] = siteSettings::first();
        $this->data['admin_users'] = user::where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->with('get_user_role')->get();
        $this->data['userRolls'] = userRolls::where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();
        $this->data['addresses'] = addresses::all();
        $this->data['sessionRank'] = Session::get('rank');
        
        
        return view('admin.businessinfo')->with($this->data);
    }
    public function updateBusinessInfo(Request $request){
        
        $notificationSettings = NotificationSettings::first();

        $data = BusinessInfo::find('1');
        $data->business_name = $request->business_name;
        $data->contact_name = $request->contact_name;
        // $data->contact_title = $request->contact_title;
        $data->contact_email = $request->business_email;
        $data->contact_phoneno = $request->business_phoneno;
        $data->contact_address = $request->contact_address;
        $data->product_info = $request->product_info;
        $data->header_display_name = $request->header_display_name;
        $data->business_owner_name = $request->business_owner_name;
        $data->referral_customer_number = $request->referral_customer_number;
        $data->business_text_sms = $request->business_text_sms;
        $data->save();

        $data = ContactInfo::find('1');
        $data->contact_name = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->contact_phoneno = $request->contact_phoneno;
        $data->save();
        
        $message = 'Business info has been updated';
        $block = 'business_info_section';

        checkSendNotification('Business info updated',$message);
        

        if($request->savebusniessinfo!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('businessinfo?block='.$block)->withSuccess($message);
        }

    }
    public function updateContactInfo(Request $request){
        
        $notificationSettings = NotificationSettings::first();

        $data = ContactInfo::find('1');
        $data->contact_name = $request->contact_name;
        $data->contact_email = $request->contact_email;
        $data->contact_phoneno = $request->contact_phoneno;
        $data->save();

        $message = 'Business contact info has been updated';
        $block = 'business_contact_info_section';

        checkSendNotification('Business info updated',$message);

        if($request->savebusniesscontactinfo!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('businessinfo?block='.$block)->withSuccess($message);
        }

    }

    public function updateSocialMedia(Request $request){
        
        $notificationSettings = NotificationSettings::first();
        
        $delids = $request->delids;
        $delids = explode(',',trim($delids,','));
        
        socialMedia::destroy($delids);
        
        
        if(is_array($request->header_socialmedia) && count($request->header_socialmedia)>0){
            $i=0;
            foreach($request->header_socialmedia as $single){
                if(isset($request->socialmediaid[$i])){
                    $data = socialMedia::find($request->socialmediaid[$i]);
                }else{
                    $data = new socialMedia();
                }
                $data->icon_id = $request->header_socialmedia[$i];
                $data->link = $request->header_socialmedia_link[$i];
                $data->save();
                $i++;
            }
        }

        $data= (object)[];
        $data->slug = "social_media_icon";
        $data->text = "";
        $data->size_web = "";
        $data->size_mobile = "";
        $data->color = $request->social_icon_color;
        $data->bg_color = $request->social_icon_block_color;
        $data->fontfamily = 0;

        update_text_details('social_media_icon',$data);


        $message = 'Social media has been updated';
        $block = 'social_media_section';

        checkSendNotification('Business info updated',$message);

        if($request->savesocialmedia!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('businessinfo?block='.$block)->withSuccess($message);
        }
    }

    public function updateAddress(Request $request){
        
        $notificationSettings = NotificationSettings::first();

        $k = 0;
        if($request->address_title && count($request->address_title)>0){
            foreach($request->address_title as $single){
                if($request->address_title[$k]){
                    $data = new addresses();
                    $data->address_title = $request->address_title[$k];
                    $data->street = $request->street[$k];
                    $data->city = $request->city[$k];
                    $data->zip_code = $request->zip_code[$k];
                    $data->state = $request->state[$k];
                    $data->country = $request->country[$k];
                    $data->save();
                    $k++;
                }
            }
        }
        $k = 0;
        if($request->old_address_title && count($request->old_address_title)>0){
            foreach($request->old_address_title as $single){
                if($request->old_address_title[$k]){
                    $data =  addresses::find($request->old_address_id[$k]);
                    $data->address_title = $request->old_address_title[$k];
                    $data->street = $request->old_street[$k];
                    $data->city = $request->old_city[$k];
                    $data->zip_code = $request->old_zip_code[$k];
                    $data->state = $request->old_state[$k];
                    $data->country = $request->old_country[$k];
                    $data->save();
                    $k++;
                }
            
            }
        }

        $delids = $request->delids;
        $delids = explode(',',trim($delids,','));
        addresses::destroy($delids);


        $message = 'Addresses has been updated';
        $block = 'addresses_bluebar';

        checkSendNotification('Business info updated',$message);

        if($request->save_addresses!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('businessinfo?block='.$block)->withSuccess($message);
        }

    }
    public function updateTimeZone(Request $request){
        
        $notificationSettings = NotificationSettings::first();

        $data = siteSettings::find('1');
        $data->timezone = $request->timezone;
        $data->save();

        $message = 'Timezone has been updated';
        $block = 'timezones_bluebar';

        checkSendNotification('Business info updated',$message);

        if($request->save_timezone!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('businessinfo?block='.$block)->withSuccess($message);
        }

    }

    public function updateRecommendation(Request $request){
        $data = BusinessInfo::find('1');
            $data->manager_name = $request->manager_name;
            $data->manager_email = $request->manager_email;
            $data->manager_number = $request->mobile_number;
            $data->recommendations_for_business_type = $request->recommendations_for_business_type;
            $data->recommendations_for_website_marketing = $request->recommendations_for_website_marketing;
            $data->recommendations_for_socialmedia_marketing = $request->recommendations_for_socialmedia_marketing;
            $data->recommendations_for_marketing_and_business_exposure = $request->recommendations_for_marketing_and_business_exposure;
            $data->save();
        
        $message = 'App manager recommendations has been updated';
        $block = 'manager_recommendations';
        return redirect('businessinfo?block='.$block)->withSuccess($message);
    }
}
