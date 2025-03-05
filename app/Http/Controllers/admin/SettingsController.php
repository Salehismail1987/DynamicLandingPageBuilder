<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Models\menu;
use App\Models\images;
use App\Models\addresses;
use App\Models\customForms;
use App\Models\navBarItems;
use App\Models\seoSettings;
use App\Models\textDetails;
use App\Models\contactForms;
use App\Models\siteSettings;
use Illuminate\Http\Request;
use App\Models\frontSections;
use App\Models\oneStepImages;
use App\Models\alertPopupSetting;
use App\Models\footerSettings;
use App\Models\navBarSettings;
use App\Models\frontEditSection;
use App\Models\contactBoxSettings;
use App\Http\Controllers\Controller;
use App\Models\ImageGalleryCategory;
use App\Models\frontendSetting;
use App\Models\NotificationSettings;
use App\Models\AlertBannerSetting;
use App\Models\contentBlockSettings;
use App\Models\newsFeedSetting;
use App\Models\galleriesSettings;
use App\Models\setHoursSettings;
use App\Models\rotatingScheduleSettings;
use App\Models\headerImages;
use App\Models\formsSettings;
use App\Models\hyperLinksSettings;
use App\Models\newsPostSettings;
use App\Models\reviewSettings;
use App\Models\StaffProductsPromosSettings;
use App\Models\outlineSettings;

class SettingsController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'settings';
        $this->data['controller_name'] = 'Settings';
        $this->data['font_family'] = get_font_family();
        $this->data['notificationSettings'] = NotificationSettings::first();
        
        $this->data["outlineSettings"] = outlineSettings::first();
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
    }

    public function index(){
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['formsSettings'] = formsSettings::first();
        $this->data['one_step_images'] = oneStepImages::all();
        $this->data['contact_forms'] = contactForms::all();
        $this->data['front_sections'] = frontSections::orderBy('section_order')->get();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        $this->data['front_edit_sections'] = frontSections::orderBy('edit_section_order')->get();
        $positions = array();
        $positions = $this->data['front_sections']->mapWithKeys(function ($object, $index) {
            return [$object->id => $index];
        });
        $this->data['front_edit_sections'] = $this->data['front_edit_sections']->sortBy(function ($object) use ($positions) {
            return $positions[$object->id] ?? PHP_INT_MAX;
        });
        $this->data['front_menu'] = menu::with('front_section')->orderBy('menu_order')->get();
        $this->data['siteSettings'] =  siteSettings::first();
        $this->data['contactBoxSettings'] =  contactBoxSettings::first();
        $this->data['seoSettings'] =  seoSettings::first();
        $this->data['footerSettings'] =  footerSettings::first();
        $this->data['navBarSettings'] =  navBarSettings::first();
        $this->data['master_feature_settings'] = get_outline_settings('master_feature_settings');

        updateTimedImages();
        $this->data['navBarItems'] =  navBarItems::get();
        $this->data['custom_forms'] = customForms::all();
        $this->data['addresses'] = addresses::get();
        $this->data['one_step_categories'] = oneStepImages::select('category')->groupBy('category')->get();
        $this->data['master_title'] = get_text_details('master_title');
        $this->data['master_subtitle'] = get_text_details('master_subtitle');
        $this->data['master_other_font'] = get_text_details('master_other_font');
        
        $this->data['contact_box_sms_title'] = get_text_details('contact_box_sms_title');
        $this->data['contact_box_sms_text'] = get_text_details('contact_box_sms_text');
        $this->data['contact_box_phone_title'] = get_text_details('contact_box_phone_title');
        $this->data['contact_box_phone_text'] = get_text_details('contact_box_phone_text');
        $this->data['contact_box_email_title'] = get_text_details('contact_box_email_title');
        $this->data['contact_box_email_text'] = get_text_details('contact_box_email_text');
        $this->data['contact_box_address_title'] = get_text_details('contact_box_address_title');
        $this->data['contact_box_address_text_1'] = get_text_details('contact_box_address_text_1');
        $this->data['contact_box_address_text_2'] = get_text_details('contact_box_address_text_2');
        $this->data['contact_box_address_text_3'] = get_text_details('contact_box_address_text_3');

        $this->data['front_section_settings'] = frontendSetting::first();

        return view('admin.settings',$this->data);
    }  

    public function saveOneStepImage(Request $request){
        if ($request->old_category) {
            foreach ($request->old_category as $key => $value) {
               
                $updateOneStepImageData = oneStepImages::find($key);
                if ($request->old_first_image[$key]) {
                    $newImage = images::where('slug','one_step_button_first_'.$key)->first();
                    if(!$newImage){
                        $newImage = new images();
                    }
                  
                    $newImage->slug = 'one_step_button_first_'.$key;
                    if(isset($newImage->file_name)){
                        delimg($newImage->file_name);
                    }
                    $newImage->file_name =  saveimagefromdataimage($request->old_first_image[$key]);
                    $newImage->save();
                    $updateOneStepImageData->first_image_id = $newImage->id;
                }
                $updateOneStepImageData->category = $request->old_category[$key];
                $updateOneStepImageData->name = $request->old_name[$key];
                $updateOneStepImageData->first_image_location = $request->old_first_image_location[$key];
                $updateOneStepImageData->second_image_location = $request->old_second_image_location[$key];
                $updateOneStepImageData->first_duration = $request->old_first_duration[$key];
                $updateOneStepImageData->second_duration = $request->old_second_duration[$key];
                $updateOneStepImageData->conditions = $request->old_conditions[$key];
                $updateOneStepImageData->conditions_color = $request->old_conditions_color[$key];
                $updateOneStepImageData->default_button_color = $request->old_default_button_color[$key];

                if ($request->old_text_enabled[$key] == 1) {
                    $textDet = (object)[];
                    $textDet->text = $request->old_first_image_text[$key];
                    $textDet->size_web = $request->old_first_image_text_size[$key]?$request->old_first_image_text_size[$key] : '22';
                    $textDet->size_mobile = "";
                    $textDet->color = $request->old_first_image_text_color[$key]?$request->old_first_image_text_color[$key]:'#000000';
                    $textDet->bg_color = "";
                    $textDet->fontfamily = $request->old_first_image_text_font[$key] ? $request->old_first_image_text_font[$key] : 1;
                    update_text_details("one_step_button_first_text_".$key,$textDet);
             
                    $textDet = (object)[];
                    $textDet->text = $request->old_second_image_text[$key];
                    $textDet->size_web = $request->old_second_image_text_size[$key] ? $request->old_second_image_text_size[$key] : '22';
                    $textDet->size_mobile = "";
                    $textDet->color = $request->old_second_image_text_color[$key] ? $request->old_second_image_text_color[$key]:'#000000';
                    $textDet->bg_color = "";
                    $textDet->fontfamily = $request->old_second_image_text_font[$key] ? $request->old_second_image_text_font[$key] : 1;
                    update_text_details("one_step_button_second_text_".$key,$textDet);
                }

                if ($request->old_second_image[$key]) {
                    $newImage = images::where('slug','one_step_button_second_'.$key)->first();
                    if(!$newImage){
                        $newImage = new images();
                    }
                        
                    $newImage->slug = 'one_step_button_second_'.$key;
                    if(isset($newImage->file_name)){
                        delimg($newImage->file_name);
                    }
                    $newImage->file_name =  saveimagefromdataimage($request->old_second_image[$key]);
                    $newImage->save();
                    $updateOneStepImageData->second_image_id = $newImage->id;

                }
                $updateOneStepImageData->save();
            }
        }
        $message = 'One Step Images are updated';
        $block = 'step_steup_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        
        if($request->saveOneStepImage!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveTheme(Request $request){
        $siteSettings = $data = siteSettings::find(1);
        $siteSettings->site_background_theme = $request->site_background_theme;
        
        if ($data->site_background_theme != $request->site_background_theme) {
            if ($request->site_background_theme == '0') {

                // $newData['popup_menu_background_color'] = '#000000';
                // $newData['popup_menu_text_color'] = '#ffffff';
                // $newData['popup_menu_text_hover_color'] = '#80808075';

                
                $newData =  (object)[];
                $newData->slug = "alert_banner_text";
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("alert_banner_text",$newData);

                $newData =  (object)[];
                $newData->slug = "alert_banner_text";
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                $update_text_details("alert_banner_text",$newData);


                // $newData['header_text_color2'] = '#ffffff';
                
                
                $newData = headerImages::find(1);
                $newData->header_background_color = '#000000';
                $newData->save();
                
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_image_title_text",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_image_desc_text",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_text",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_text_2",$newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->bg_color = '#000000';
                update_action_button('header_btn_1', $newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->bg_color = '#000000';
                update_action_button('header_btn_2', $newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->bg_color = '#000000';
                update_action_button('header_btn_3', $newData);


                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_phone_title",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_phone_text",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_address_title",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_address2_street",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_phonr_text_title",$newData);
                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("header_phone_text_2",$newData);

                // $newData['header_text_title_color'] = '#ffffff';
                // $newData['header_text_7_text_color'] = '#ffffff';
                // $newData['header_address_text_color'] = '#ffffff';
                // $newData['header_address_title_color_2'] = '#ffffff';

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("social_media_icon",$newData);


                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("schedule_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("content_block_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("faq_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("links_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("download_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("contact_box_email_text",$newData);

                $newData = reviewSettings::find(1);
                $newData->review_background = '#000000';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("popup_alert_title_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("popup_alert_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("alert_popup_proceed_action_button_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                $newData->bg_color = '#000000';
                update_text_details("alert_popup_terminate_action_button_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("master_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("download_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("download_question_text",$newData);

                
                $newData = new galleriesSettings();
                $newData->gallery_slider_background = '#000000';
                $newData->gallery_video_background = '#000000';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("set_hours_day",$newData);

                // $newData['set_hours_date_color'] = '#ffffff';

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("daily_hours_set_1",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("set_hours_sub_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("daily_hours_set_2",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("daily_hours_start_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("daily_hours_end_title",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("busniess_hours_times",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("busniess_hours_comments",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("set_hours_comment",$newData);
                
                $newData = rotatingScheduleSettings::find(1);
                $newData->background = '#000000';
                $newData->save();
                
                $newData = siteSettings::find(1);
                $newData->site_background_color = '#000000';
                $newData->save();

                $newData = setHoursSettings::find(1);
                $newData->background = #000000';
                $newData->save();

                $newData = new footerSettings();
                $newData->footre_back_color = '#000000';
                $newData->footre_text_color = '#ffffff';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("hyper_link_text",$newData);

                $newData =  (object)[];
                $newData->color = '#ffffff';
                update_text_details("hyper_link_link",$newData);
                
                // $newData['contact_info_address_text_color2'] = '#ffffff';
                // $bisniessinfo['contact_address_title_color'] = '#ffffff';
                // $bisniessinfo['contact_address_text_color'] = '#ffffff';

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->back_color = '#000000';
                DB::table('gallery_slider')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->back_color = '#000000';
                DB::table('gallery_videos')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->back_color = '#000000';
                DB::table('gallery_videos')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->back_color = '#000000';
                DB::table('gallery_posts')->update($newData);
                

                $newData =  (object)[];
                $newData->text_color = '#ffffff';
                $newData->back_color = '#000000';
                DB::table('news_posts')->update($newData);
                

                $newData =  (object)[];
                $newData->content_title_color = '#ffffff';
                $newData->content_desc_color = '#ffffff';
                DB::table('content_block_links')->update($newData);
                

                $newData =  (object)[];
                $newData->content_title_color = '#ffffff';
                $newData->bg_color = '#000000';
                DB::table('contact_form_titles')->update($newData);
                
                $newData =  (object)[];
                $newData->form_title_color = '#ffffff';
                DB::table('contact_forms')->update($newData);
                

                $form_title['form_title_color'] = '#ffffff';
                $this->db->update('contact_forms', $form_title);
                
            } else {


                // $newData['popup_menu_background_color'] = '#ffffff';
                // $newData['popup_menu_text_color'] = '#000000';
                // $newData['popup_menu_text_hover_color'] = '#80808075';

                
                $newData =  (object)[];
                $newData->slug = "alert_banner_text";
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("alert_banner_text",$newData);

                $newData =  (object)[];
                $newData->slug = "alert_banner_text";
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("alert_banner_text",$newData);


                // $newData['header_text_color2'] = '#000000';
                
                
                $newData = headerImages::find(1);
                $newData->header_background_color = '#ffffff';
                $newData->save();
                
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_image_title_text",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_image_desc_text",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_text",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_text_2",$newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->bg_color = '#ffffff';
                update_action_button('header_btn_1', $newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->bg_color = '#ffffff';
                update_action_button('header_btn_2', $newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->bg_color = '#ffffff';
                update_action_button('header_btn_3', $newData);


                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_phone_title",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_phone_text",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_address_title",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_address2_street",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_phonr_text_title",$newData);
                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("header_phone_text_2",$newData);

                // $newData['header_text_title_color'] = '#000000';
                // $newData['header_text_7_text_color'] = '#000000';
                // $newData['header_address_text_color'] = '#000000';
                // $newData['header_address_title_color_2'] = '#000000';

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("social_media_icon",$newData);


                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("schedule_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("content_block_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("faq_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("links_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("download_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("contact_box_email_text",$newData);

                $newData = reviewSettings::find(1);
                $newData->review_background = '#ffffff';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("popup_alert_title_text",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("popup_alert_text",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("alert_popup_proceed_action_button_text",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                $newData->bg_color = '#ffffff';
                update_text_details("alert_popup_terminate_action_button_text",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("master_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("download_text",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("download_question_text",$newData);

                
                $newData = new galleriesSettings();
                $newData->gallery_slider_background = '#ffffff';
                $newData->gallery_video_background = '#ffffff';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("set_hours_day",$newData);

                // $newData['set_hours_date_color'] = '#000000';

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("daily_hours_set_1",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("set_hours_sub_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("daily_hours_set_2",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("daily_hours_start_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("daily_hours_end_title",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("busniess_hours_times",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("busniess_hours_comments",$newData);

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("set_hours_comment",$newData);
                
                $newData = rotatingScheduleSettings::find(1);
                $newData->background = '#ffffff';
                $newData->save();
                
                $newData = siteSettings::find(1);
                $newData->site_background_color = '#ffffff';
                $newData->save();

                $newData = setHoursSettings::find(1);
                $newData->background = #ffffff';
                $newData->save();

                $newData = new footerSettings();
                $newData->footre_back_color = '#ffffff';
                $newData->footre_text_color = '#000000';
                $newData->save();

                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("hyper_link_text",$newData);


                $newData =  (object)[];
                $newData->color = '#000000';
                update_text_details("hyper_link_link",$newData);
                

                // $newData['contact_info_address_text_color2'] = '#000000';
                // $bisniessinfo['contact_address_title_color'] = '#000000';
                // $bisniessinfo['contact_address_text_color'] = '#000000';

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->back_color = '#ffffff';
                DB::table('gallery_slider')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->back_color = '#ffffff';
                DB::table('gallery_videos')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->back_color = '#ffffff';
                DB::table('gallery_videos')->update($newData);

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->back_color = '#ffffff';
                DB::table('gallery_posts')->update($newData);
                

                $newData =  (object)[];
                $newData->text_color = '#000000';
                $newData->back_color = '#ffffff';
                DB::table('news_posts')->update($newData);
                

                $newData =  (object)[];
                $newData->content_title_color = '#000000';
                $newData->content_desc_color = '#000000';
                DB::table('content_block_links')->update($newData);
                

                $newData =  (object)[];
                $newData->content_title_color = '#000000';
                $newData->bg_color = '#ffffff';
                DB::table('contact_form_titles')->update($newData);
                
                $newData =  (object)[];
                $newData->form_title_color = '#000000';
                DB::table('contact_forms')->update($newData);
                

                $form_title['form_title_color'] = '#000000';
                $this->db->update('contact_forms', $form_title);
                
            }
        } else {
            $siteSettings->site_background_color = $request->site_background_color;
        }
        $siteSettings->site_trim = $request->site_trim;
        $siteSettings->save();

        $message = 'Site Theme has been updated';
        $block = 'Theme_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savesitesetting!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }
    

    public function saveContactForm(Request $request){
        // dd($request->all());
        if(isset($request->terms_of_service))
        {
            $f_settings = formsSettings::first();
            $f_settings->terms_of_service = $request->terms_of_service;
            $f_settings->save();
        }
        $new_id=1;
        $cff1=  contactForms::where('id',1)->first();
        $cff2=  contactForms::where('id',2)->first();
        $cff3=  contactForms::where('id',3)->first();
        if(!$cff1){
            $new_id = 1;
        }
        if(!$cff2){
            $new_id = 2;
        }
        if(!$cff3){
            $new_id = 3;
        }
		$i = 0;
		if ($request->form_title && is_array($request->form_title) && count($request->form_title) > 0) {
			foreach ($request->form_title as $single) {
				if ($request->form_title[$i]) {
                   
                    $formsData = contactForms::find($request->formid[$i]);
                    if(!$formsData){
                      
                        $formsData = new contactForms();
                        $formsData->id = $new_id;
                        $formsData->form_title = $request->form_title[$i];
                        $formsData->form_title_color = isset($request->form_title_color[$i]) ? $request->form_title_color[$i] : '#000';
                        $formsData->form_title_size = isset($request->form_title_size[$i]) ? $request->form_title_size[$i] : '16';
                        $formsData->form_title_font_family = isset($request->form_title_font_family[$i]) ? $request->form_title_font_family[$i] : '1';
                        $formsData->form_email = isset($request->formemail[$i]) ? $request->formemail[$i] : '';
                        $formsData->form_google_map = isset($request->form_google_map[$i]) ? $request->form_google_map[$i] : '';
                        $formsData->form_status = isset($request->formstatus[$i]) ? '1' : '0';
                        $formsData->show_map = isset($request->showmap[$i]) ? '1' : '0';
                        $formsData->permission = isset($request->permission[$i]) ? '1' : '0';
                        $formsData->tos_chkbox_text = isset($request->tos_chkbox_text[$i]) ? $request->tos_chkbox_text[$i] : null;

                       
                    }else{
                        $formsData->form_title = $request->form_title[$i];
                        $formsData->form_title_color = isset($request->form_title_color[$i]) ? $request->form_title_color[$i] : '#000';
                        $formsData->form_title_size = isset($request->form_title_size[$i]) ? $request->form_title_size[$i] : '16';
                        $formsData->form_title_font_family = isset($request->form_title_font_family[$i]) ? $request->form_title_font_family[$i] : '1';
                        $formsData->form_email = isset($request->formemail[$i]) ? $request->formemail[$i] : '';
                        $formsData->form_google_map = isset($request->form_google_map[$i]) ? $request->form_google_map[$i] : '';
                        $formsData->form_status = isset($request->formstatus[$request->formid[$i]]) ? '1' : '0';
                        $formsData->show_map = isset($request->showmap[$request->formid[$i]]) ? '1' : '0';
                        $formsData->permission = isset($request->permission[$request->formid[$i]]) ? '1' : '0';
                        $formsData->tos_chkbox_text = isset($request->tos_chkbox_text[$i]) ? $request->tos_chkbox_text[$i] : null;                 
                    }
                    $form_fields = array();
                    $j = 0;
                    
                    if(isset($request->formid[$i]) && $request->formid[$i] !=''){
                        if (isset($request->fieldname[$request->formid[$i]]) && is_array($request->fieldname[$request->formid[$i]])) {
                            foreach ($request->fieldname[$request->formid[$i]] as $single) {
                                $form_fields[] = array(
                                    'fieldname' => $single,
                                    'fieldtype' => isset($request->fieldtype[$request->formid[$i]][$j]) ? $request->fieldtype[$request->formid[$i]][$j] : 'text',
                                    'required' => isset($request->required[$request->formid[$i]][$j]) ? "1" : "0"
                                );
                                $j++;
                            }
                            $formsData->form_fields = json_encode($form_fields);
                        }
                    }else{
                        $ii = $i+1;
                        if (isset($request->fieldname[$ii]) && is_array($request->fieldname[$ii])) {
                            foreach ($request->fieldname[$ii] as $single) {
                                $form_fields[] = array(
                                    'fieldname' => $single,
                                    'fieldtype' => isset($request->fieldtype[$ii][$j]) ? $request->fieldtype[$ii][$j] : 'text',
                                    'required' => isset($request->required[$ii][$j]) ? "1" : "0"
                                );
                                $j++;
                            }
                            $formsData->form_fields = json_encode($form_fields);
                        }
                    }

				
					
                    $formsData->save();
                    if(isset($request->formid[$i]) && $request->formid[$i] !=''){
                        $frontSections = frontSections::where('slug','contactForm' . $request->formid[$i])->first();
                        if($frontSections){
                            $frontSections->section_enabled = isset($request->formstatus[$request->formid[$i]]) ? '1' : '0';
                            $frontSections->save();
                        }
                       
                        
                    }else{
                        $ii=$i+1;
                        $frontSections = frontSections::where('slug','contactForm' . $ii)->first();
                        $frontSections->section_enabled = isset($request->formstatus[$i]) ? '1' : '0';
                        $frontSections->save();
                        
                    }
                    
				}
				$i++;
			}
		}
		$message = 'Contact Form has been updated';
		$block = 'contact_forms_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savecontactform!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveContactBox(Request $request){

        $contactBoxSettings =  contactBoxSettings::first();
        $contactBoxSettings->background_color = $request->contact_box_background_color;
        $contactBoxSettings->fontfamily = $request->contact_form_box_font;
        $contactBoxSettings->enable_texting_box = $request->enable_texting_box?'1':'0';
        $contactBoxSettings->enable_phone_box = $request->enable_phone_box?'1':'0';
        $contactBoxSettings->enable_email_box = $request->enable_email_box?'1':'0';
        $contactBoxSettings->enable_address_box = $request->enable_address_box?'1':'0';
        $contactBoxSettings->save();

        $data = (object)[];
        $data->text = $request->contact_form_phonr_text_title;
        $data->color = $request->contact_form_phone_text_title_color;
        $data->size_web = $request->contact_form_phone_text_title_size;
        update_text_details('contact_box_sms_title',$data);

        $data = (object)[];
        $data->text = $request->contact_form_phone_text;
        $data->color = $request->contact_form_phone_text_color;
        update_text_details('contact_box_sms_text',$data);

        $data = (object)[];
        $data->text = $request->contact_form_phone_title;
        $data->color = $request->contact_form_phone_title_color;
        $data->size_web = $request->contact_form_phone_title_size;
        update_text_details('contact_box_phone_title',$data);

        $data = (object)[];
        $data->text = $request->contact_form_text_7_phone;
        $data->color = $request->contact_form_text_7_phone_color;
        update_text_details('contact_box_phone_text',$data);


        $data = (object)[];
        $data->text = $request->contact_form_email_title;
        $data->color = $request->contact_form_email_titlecolor;
        $data->size_web = $request->contact_form_email_titlesize;
        update_text_details('contact_box_email_title',$data);

        $data = (object)[];
        $data->text = $request->contact_form_email;
        $data->color = $request->contact_form_emailcolor;
        update_text_details('contact_box_email_text',$data);


        $data = (object)[];
        $data->text = $request->contact_form_address_title;
        $data->color = $request->contact_form_address_title_color;
        $data->size_web = $request->contact_form_address_title_fontsize;
        update_text_details('contact_box_address_title',$data);

        $data = (object)[];
        $data->text = $request->contact_form_address1;
        $data->color = $request->contact_form_address_text_color2;
        update_text_details('contact_box_address_text_1',$data);

        $data = (object)[];
        $data->text = $request->contact_form_address2;
        $data->color = $request->contact_form_address_text_color2;
        update_text_details('contact_box_address_text_2',$data);

        $data = (object)[];
        $data->text = $request->contact_form_address3;
        $data->color = $request->contact_form_address_text_color2;
        update_text_details('contact_box_address_text_3',$data);

        
		$message = 'Contact Form Setting has been updated';
		$block = 'contact_boxes_bluebar';
        
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savecontactform_setting!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveMetaData(Request $request){
        $newData = seoSettings::first();
        $newData->google_search_title = $request->google_search_title?$request->google_search_title:'';
        $newData->google_search_description = $request->google_search_description?$request->google_search_description:'';
        $newData->metatag_inputs = $request->metatag_inputs?$request->metatag_inputs:'';
        $newData->meta_language = $request->meta_language ? strip_tags($request->meta_language) : '';
        // dd($metaLanguage);
        // $newData->meta_language = $request->meta_language?$request->meta_language:'';
        $newData->metatag_robots = $request->metatag_robots?$request->metatag_robots:'';
        $newData->meta_keywords = $request->meta_keywords?$request->meta_keywords:'';
        $newData->metatag_revisit_after = $request->metatag_revisit_after;
        $newData->meta_author = $request->meta_author?$request->meta_author:'';
        $newData->save();

        $message = 'Master Notification has been updated';
        $block = 'seo_settings_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savemetadata!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveSeoBlockSettings(Request $request){


        $newData = seoSettings::first();
        $newData->seo_block_text = $request->seo_block_text;
        $newData->seo_block_background = $request->seo_block_background;
        $newData->save();

        $message = 'SEO Block has been updated';
        $block = 'seo_block_bluebar';
        
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->saveSeoBlockSettings!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveNotification(Request $request){


        $newData = NotificationSettings::first();
        if (check_auth_permission('master_notifications')) {
            $newData->notification_switch = $request->notificationswitch ? '1' : '0';
        }
        if (check_auth_permission('email_notifications')) {
            $newData->email_notification = $request->email_notification;
        }
        if (check_auth_permission('step_notifications')) {
            $newData->step_notifications = $request->step_notifications ? '1' : '0';
        }
        if (check_auth_permission('step_notifications')) {
            $newData->step_notification_email = $request->step_notification_email;
        }
        if (check_auth_permission('quick_settings_notifications')) {
            $newData->quick_settings_notifications = $request->quick_settings_notifications ? '1' : '0';
        }
        if (check_auth_permission('quick_settings_email_notifications')) {
            $newData->quick_settings_notification_email = $request->quick_settings_notification_email;
        }
        if (check_auth_permission('scheduling_notifications')) {
            $newData->scheduling_notifications = $request->scheduling_notifications ? '1' : '0';
        }
        if (check_auth_permission('scheduling_email_notifications')) {
            $newData->scheduling_notification_email = $request->scheduling_notification_email;
        }
        if (check_auth_permission('galleries_notifications')) {
            $newData->galleries_notifications = $request->galleries_notifications ? '1' : '0';
        }
        if (check_auth_permission('scheduling_email_notifications')) {
            $newData->galleries_notification_email = $request->galleries_notification_email;
        }
        if (check_auth_permission('frontend_notifications')) {
            $newData->frontend_notifications = $request->frontend_notifications ? '1' : '0';
        }
        if (check_auth_permission('frontend_notification_email')) {
            $newData->frontend_notification_email = $request->frontend_notification_email;
        }
        if (check_auth_permission('blog_notifications')) {
            $newData->blog_notifications = $request->blog_notifications ? '1' : '0';
        }
        if (check_auth_permission('blog_notification_email')) {
            $newData->blog_notification_email = $request->blog_notification_email;
        }
        if (check_auth_permission('crm_notifications')) {
            $newData->crm_notifications = $request->crm_notifications ? '1' : '0';
        }
        if (check_auth_permission('crm_notification_email')) {
            $newData->crm_notification_email = $request->crm_notification_email;
        }
        if (check_auth_permission('form_notifications')) {
            $newData->form_notifications = $request->form_notifications ? '1' : '0';
        }
        if (check_auth_permission('form_notification_email')) {
            $newData->form_notification_email = $request->form_notification_email;
        }
        if (check_auth_permission('settings_business_notifications')) {
            $newData->settings_business_notifications = $request->settings_business_notifications ? '1' : '0';
        }
        if (check_auth_permission('settings_business_notification_email')) {
            $newData->settings_business_notification_email = $request->settings_business_notification_email;
        }
        if (check_auth_permission('settings_notifications')) {
            $newData->settings_notifications = $request->settings_notifications ? '1' : '0';
        }
        if (check_auth_permission('settings_notification_email')) {
            $newData->settings_notification_email = $request->settings_notification_email;
        }
        $newData->save();

        $message = 'Master Notification & Email Notification has been updated';
        $block = 'master_notifications_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savenotification!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveScripts(Request $request){

        $newData = siteSettings::first();
        $newData->home_scripts = $request->homescripts?$request->homescripts:''; 
        if ($request->favicon) {
            if(isset($newData->favicon)){
                delimg($newData->favicon);
            }
            $newData->favicon = saveimagefromdataimage($request->favicon);
        }
        $newData->save();

        $message = 'Scripts and favicon has been updated';
        $block = 'scripts_favicons_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');        
        if($request->savescripts!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }


    public function saveAlternate(Request $request){


        $newData = siteSettings::first();
        $newData->alternate_horizontal = $request->alternate_horizontal ? '1' : '0';
        $newData->save();
        $message = 'Alternate Horizontal has been updated';
        $block = 'alternate_wide_header_bluebar';
        
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savealternate!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }

    public function saveSectionOrder(Request $request){
        $sectionorder = trim($request->sectionorder,',');
        $sectionorder = explode(',',$sectionorder);
        $i = 0;
        foreach($sectionorder as $key => $single){
            $newData = frontSections::find($single);
            $newData->section_order = $i;
            $newData->save();
            $i++;  
        }
        // dd($request->enableorder);
        foreach($request->enableorder as $key => $single){
            $newData = frontSections::find($key);
            $newData->section_enabled = $single;
            $newData->save();
            $i++;  
        }
        
        $editsectionorder = trim($request->editsectionorder,',');
        $editsectionorder = explode(',',$editsectionorder);
        $i = 0;
        // foreach($editsectionorder as $key => $single){
        //     $newData = frontSections::find($single);
        //     $newData->edit_section_order = $i;
        //     $newData->save();
        //     $i++;  
        // }
        // foreach($request->editenableorder as $key => $single){
        //     $newData = frontSections::find($key);
        //     $newData->edit_section_enabled = $single;
        //     $newData->save();
        //     $i++;  
        // }
        $headerSectionOrder = frontSections::where('slug', 'headersection')->select('section_order','section_enabled')->first();
        if($headerSectionOrder->section_enabled)
        {
            $headerSliderOrder = $headerSectionOrder->section_order + 1;
            $headerSectionOrder = frontSections::where('section_order','>', $headerSectionOrder->section_order)->increment('section_order');
            $headerSectionOrder = frontSections::where('slug', 'headerslider')->update(['section_order' => $headerSliderOrder]);
        }
    }


    public function saveFooter(Request $request){
        $newData =  footerSettings::first();
        if (isSAOnly()) { 
            if ($request->footertext) {
                $newData->footer_text = $request->footertext;
            }
        }

        if (isSAOnly()) { 
            if ($request->footretextlink) {
                $newData->footre_text_link = $request->footretextlink;
            }
        }

        if (check_auth_permission('footer')) {
            $newData->footre_text_color = $request->footretextcolor;
            $newData->footre_back_color = $request->footrebackcolor;
        }
        if (isSAOnly()) { 
            $newData->footer_text_1 = $request->footer_text_1;
            $newData->copy_right_text = $request->copy_right_text;
            $newData->footer_text_2 = $request->footer_text_3;
        }
        $newData->save();

        $message = 'Footer has been updated';
        $block = 'footer_bluebar';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        if($request->savefooter!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            //return redirect('settings?block='.$block)->withSuccess($message);
            return redirect('settings')->withSuccess($message);
        }
    }
    
      public function saveFontMaster(Request $request){

        $block = 'master_title_fonts_bluebar';
        if (check_auth_permission('master_title_fonts')) {
            $data = (object)[];
            $data->fontfamily = $request->title_font_family;
            $data->color = $request->title_font_color;
            $data->size_web = $request->title_font_size_web;
            $data->size_mobile =  $request->title_font_size_mobile;
            update_text_details2('master_title',$data);
            update_text_details2('popup_alert_title_text',$data);
            update_text_details2('download_title',$data);
            update_text_details2('content_block_title',$data);
            update_text_details2('faq_title',$data);
            update_text_details2('links_title',$data);
            update_text_details2('reviews_staff_title',$data);
            update_text_details2('gallery_posts_title',$data);
            update_text_details2('gallery_videos_title',$data);
            update_text_details2('schedule_title',$data);
            update_text_details2('set_hours_title',$data);
            update_text_details2('gallery_slider_title',$data);
            update_text_details2('news_posts_title',$data);
            update_text_details2('newsfeed_teaser_title',$data);
            update_text_details2('gallery_tiles_title',$data);
            update_text_details2('news_feed_title',$data);
            update_text_details2('reset_title',$data);
            update_text_details2('seo_title',$data);
            update_text_details2('generic_blog_title',$data);
            update_text_details2('header_slider_text',$data);
            //update_text_details2('daily_hours_today',$data);
            update_text_details2('contact_info_block_title',$data);
            update_text_details2('blog_title',$data);
            update_text_details2('blog_cate',$data);
            update_text_details2('form_section_title',$data);
            update_text_details2('generic_email_post_logo_title',$data);
            update_text_details2('generic_email_post_content_title',$data);
            update_text_details2('contact_box_sms_title',$data);
            update_text_details2('contact_box_email_title',$data);
            update_text_details2('contact_box_address_title',$data);
            

            
            $newData =  (object)[];
            $newData->content_title_color = $request->title_font_color;
            $newData->content_title_font_size = $request->title_font_size_web;
            $newData->content_title_font_family = $request->title_font_family;
            DB::table('content_block_links')->update((array)$newData);

            $newData =  (object)[];
            $newData->color = $request->title_font_color;
            $newData->size_web = $request->title_font_size_web;
            $newData->size_mobile = $request->title_font_size_mobile;
            $newData->fontfamily = $request->title_font_family;
            DB::table('contact_form_titles')->update((array)$newData);

            
            $data = (object)[];
            $data->fontfamily = $request->subtitle_font_family;
            $data->color = $request->subtitle_text_color;
            $data->size_web = $request->subtitle_text_size_web;
            $data->size_mobile =  $request->subtitle_text_size_mobile;
            update_text_details2('master_subtitle',$data);
            update_text_details2('master_subtitle',$data);
            update_text_details2('gallery_tiles_subtitle',$data);
            update_text_details2('generic_content_block_subtitle',$data);
            update_text_details2('gallery_tiles_subtitle',$data);
            update_text_details2('gallery_tiles_subtitle',$data);
            update_text_details2('gallery_tiles_subtitle',$data);
            // update_text_details2('set_hours_sub_title',$data); /* (Hassan) Comment the code to not save the schedule subtitle color */
            //update_text_details2('daily_hours_set_1',$data);
            //update_text_details2('daily_hours_set_2',$data);
            //update_text_details2('busniess_hours_times',$data);
            update_text_details2('generic_gallery_video_subtitle',$data);
            update_text_details2('generic_faq_question',$data);
            update_text_details2('download_question_text',$data);
            update_text_details2('generic_email_post_subtitle',$data);
            update_text_details2('form_subtitle',$data);
            update_text_details2('generic_newsfeed_title',$data);
            update_text_details2('generic_news_post_title',$data);
            update_text_details2('generic_gallery_post_title',$data);
            update_text_details2('header_text_2',$data);
            update_text_details2('header_image_desc_text',$data);
            update_text_details2('image_title_text_below_text',$data);
            update_text_details2('form_title',$data);
            update_text_details2('header_phone_title',$data);
            update_text_details2('header_phonr_text_title',$data);
            update_text_details2('header_address_title',$data);
    
            $newData =  (object)[];
            $newData->question_text_color = $request->subtitle_text_color;
            $newData->question_font_size = $request->subtitle_text_size_web;
            $newData->question_font_family = $request->subtitle_font_family;
            DB::table('faqs')->update((array)$newData);
    
            $data = (object)[];
            $data->fontfamily = $request->other_font_family;
            $data->color = $request->other_font_color;
            $data->size_web = $request->other_font_size_web;
            $data->size_mobile =  $request->other_font_size_mobile;
            update_text_details2('master_other_font',$data);
            update_text_details2('generic_news_post_desc',$data);
            update_text_details2('generic_gallery_post_desc',$data);
            update_text_details2('generic_gallery_slider_text',$data);
            update_text_details2('generic_gallery_video_desc',$data);
            update_text_details2('generic_content_block_desc',$data);
            update_text_details2('generic_gallery_tiles_text',$data);
            update_text_details2('generic_newsfeed_desc',$data);
            update_text_details2('header_image_title_text',$data);
            update_text_details2('header_phone_text',$data);
            update_text_details2('header_address2_street',$data);
            update_text_details2('header_address2_citystatezipcode',$data);
            update_text_details2('header_address2_comment',$data);
            // update_text_details2('schedule_image_desc_text',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('daily_hours',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('set_hours_day',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('set_hours_comment',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('master_image_description',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('daily_hours_start_title',$data); /* (Hassan) Comment the code to not save the schedule color */
            // update_text_details2('daily_hours_end_title',$data); /* (Hassan) Comment the code to not save the schedule color */
            update_text_details2('generic_review_staff',$data);
            update_text_details2('generic_faq_answer',$data);
            update_text_details2('hyper_link_text',$data);
            update_text_details2('hyper_link_link',$data);
            update_text_details2('form_section_text',$data);
            update_text_details2('download_text',$data);
            update_text_details2('blog_desc',$data);
            update_text_details2('blog_date',$data);
            update_text_details2('blog_page_instruction',$data);
            update_text_details2('blog_instruction',$data);
            update_text_details2('generic_email_post_description',$data);
            update_text_details2('form_descriptive_text',$data);
            update_text_details2('custom_form_footer_text_1',$data);
            update_text_details2('custom_form_footer_text_2',$data);
            update_text_details2('contact_box_phone_text',$data);
            update_text_details2('contact_box_email_text',$data);
            update_text_details2('contact_box_address_text_1',$data);
            update_text_details2('contact_box_address_text_2',$data);
            update_text_details2('contact_box_address_text_3',$data);
            //update_text_details('alert_banner_text',$data);
            //update_text_details('alert_banner_action_button_text',$data);
    
    
            $newData =  (object)[];
            $newData->title_color = $request->title_font_color;
            $newData->title_font = $request->title_font_family;
            $newData->desc_color = $request->other_font_color;
            $newData->desc_font = $request->other_font_family;
            $newData->category_color = $request->subtitle_text_color;
            $newData->category_font = $request->subtitle_font_family;
            $newData->date_color = $request->other_font_color;
            $newData->date_font = $request->other_font_family;
            DB::table('blogs')->update((array)$newData);
    
    
            $newData =  (object)[];
            $newData->logo_title_text_color = $request->title_font_color;
            $newData->logo_title_text_size = $request->title_font_size_web;
            $newData->logo_title_font_family = $request->title_font_family;
            
            $newData->content_title_text_color = $request->title_font_color;
            $newData->content_title_text_size = $request->title_font_size_web;
            $newData->content_title_font_family = $request->title_font_family;
            
            $newData->email_image_desciption_text_color = $request->other_font_color;
            $newData->email_image_desciption_text_size = $request->other_font_size_web;
            $newData->email_image_description_font_family = $request->other_font_family;

            $newData->subtitle_text_color = $request->subtitle_text_color;
            $newData->subtitle_text_size = $request->subtitle_font_size_web;
            $newData->subtitle_font_family = $request->subtitle_font_family;

            DB::table('email_posts')->update((array)$newData);


            $newData =  (object)[];
            $newData->content_title_color = $request->title_font_color;
            $newData->content_title_font_size = $request->title_font_size_web;
            $newData->content_title_font_family = $request->title_font_family;

            $newData->content_desc_color = $request->other_font_color;
            $newData->content_desc_font_size = $request->other_font_size_web;
            $newData->content_desc_font_family = $request->other_font_family;
            DB::table('content_block_links')->update((array)$newData);

            $newData =  (object)[];
            $newData->form_title_color = $request->subtitle_text_color;
            $newData->form_title_size = $request->subtitle_text_size_web;
            $newData->form_title_font_family = $request->subtitle_font_family;
            DB::table('contact_forms')->update((array)$newData);
    
            $newData =  (object)[];
            $newData->answer_text_color = $request->other_font_color;
            $newData->answer_font_size = $request->other_font_size_web;
            $newData->answer_font_family = $request->other_font_family;
            DB::table('faqs')->update((array)$newData);

            $newData =  (object)[];
            $newData->text_color = $request->other_font_color;
            $newData->text_size = $request->other_font_size_web;
            $newData->text_font = $request->other_font_family;
            DB::table('review_staff')->update((array)$newData);
    
            $newData =  (object)[];
            $newData->content_title_color = $request->other_font_color;
            $newData->content_title_font_size = $request->other_font_size_web;
            $newData->content_title_font_family = $request->other_font_family;
            DB::table('content_block_links')->update((array)$newData);

            
            // $newData =  (object)[];
            // $newData->post_title_color = $request->title_font_color;
            // $newData->post_font_family = $request->title_font_family;
            // $newData->post_title_font_size = $request->title_font_size_web;
            // $newData->post_title_font_size_mobile = $request->title_font_size_mobile;

            // $newData->post_desc_font_size = $request->other_font_size_web;
            // $newData->post_desc_font_family = $request->other_font_family;
            // DB::table('gallery_posts')->update((array)$newData);

            
            $newData =  (object)[];
            $newData->post_title_color = $request->title_font_color;
            $newData->font_family = $request->title_font_family;
            $newData->post_title_size = $request->title_font_size_web;

            $newData->post_desc_font_size = $request->other_font_size_web;
            $newData->desc_font_family = $request->other_font_family;
            $newData->post_desc_color = $request->other_font_color;
            DB::table('news_posts')->update((array)$newData);
            
            $newData =  (object)[];
            $newData->subtitle_text_color = $request->subtitle_text_color;
            $newData->subtitle_font_family = $request->subtitle_font_family;
            $newData->subtitle_font_size_web = $request->subtitle_text_size_web;
            $newData->subtitle_font_size_mobile = $request->subtitle_text_size_mobile;

            // $newData->desc_font_size_web = $request->other_font_size_web;
            // $newData->desc_font_size_mobile = $request->other_font_size_mobile;
            // $newData->desc_font_family = $request->other_font_family;
            // $newData->desc_text_color = $request->other_font_color;
            // DB::table('news_feeds')->update((array)$newData);
            
            // $newData =  (object)[];
            // $newData->text_color = $request->title_font_color;
            // $newData->font_family = $request->title_font_family;
            // $newData->title_fontsize = $request->title_font_size_web;

            // $newData->description_color = $request->other_font_color;
            // $newData->desc_fontsize = $request->other_font_size_web;
            // $newData->font_family_desc = $request->other_font_family;

            // $newData->description_2_color = $request->other_font_color;
            // $newData->desc_2_fontsize = $request->other_font_size_web;
            // $newData->font_family_desc_2 = $request->other_font_family;
            // DB::table('gallery_videos')->update((array)$newData);


            
    
            $message = 'Fonts master setting saved!';
            checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
            if($request->savefontsettings!='save'){
                return redirect('reminders')->withSuccess($message);
            }else{
                //return redirect('settings?block='.$block)->withSuccess($message);
                return redirect('settings')->withSuccess($message);
            }
        }
        return redirect('settings?block='.$block);      
      
    }
    public function saveCaptcha(Request $request){
        $checked = $request->checked;
        $siteSettings = $data = siteSettings::find(1);
        $siteSettings->is_captcha_enable = $checked?'1':'0';
        $siteSettings->save();
    }

    public function update_override_bg(Request $request){
        $checked = $request->check_value;
        if($request->check_slug){
            switch ($request->check_slug) {
                case 'content_block_bg_picker':
                    $setting =  contentBlockSettings::first();
                    $setting->content_block_override_bg  = $checked?'1':'0';
                    $setting->save();
                    break;
                case 'news_post_override_bg':
                    $setting =  newsPostSettings::first();
                    $setting->news_post_override_bg  = $checked?'1':'0';
                    $setting->save();
                    break;
                case 'seo_block_bg_picker':
                    $setting =  seoSettings::first();
                    $setting->seo_block_override_bg  = $checked?'1':'0';
                    $setting->save();
                    break;
                case 'alert_popup_bg_picker':
                    $setting =  alertPopupSetting::first();
                    $setting->popup_alert_override_bg  = $checked?'1':'0';
                    $setting->save();
                    break;
                case 'alert_banner_bg_picker':
                    $setting =  AlertBannerSetting::first();
                    $setting->alert_banner_override_bg = $checked?'1':'0';
                    $setting->save();
                    break; 
                case 'news_feed_override_bg':
                    $setting =  newsFeedSetting::first();
                    $setting->news_feed_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;
                case 'header_block_bg_picker':
                    $setting =   headerImages::first();
                    $setting->header_block_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;   
                 case 'scheduling_bg_picker':
                    $setting =   setHoursSettings::first();
                    $setting->scheduling_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                case 'busniess_hours_bg_picker':
                    $setting =   rotatingScheduleSettings::first();
                    $setting->busniess_hours_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                case 'gallery_posts_bg_picker':
                    $setting =   galleriesSettings::first();
                    $setting->gallery_posts_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;         
                case 'gallery_slider_bg_picker':
                    $setting =   galleriesSettings::first();
                    $setting->gallery_slider_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                case 'gallery_video_bg_picker':
                    $setting =   galleriesSettings::first();
                    $setting->gallery_video_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;        
                case 'gallery_tiles_bg_picker':
                    $setting =   galleriesSettings::first();
                    $setting->gallery_tiles_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                case 'review_bg_picker':
                    $setting =   reviewSettings::find(1);
                    $setting->review_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                  case 'staff_promos_bg_picker':
                    $setting =   StaffProductsPromosSettings::first();
                    $setting->staff_promos_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;     
                case 'hyperlinks_bg_picker':
                    $setting =   hyperLinksSettings::first();
                    $setting->hyperlinks_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                case 'formlinks_bg_picker':
                    $setting =   formsSettings::first();
                    $setting->formlinks_override_bg = $checked?'1':'0';
                    $setting->save();
                    break;    
                    
                    

                    
            }
        }
    }

    public function remove_cf($id){
        $message = 'Contact Form has been deleted';
		$block = 'contact_forms_bluebar';
        
        if($id){
            $cf= contactForms::find($id);
            if($cf){
                $cf->delete();
            }
            return redirect('settings?block='.$block)->withSuccess($message);
        }
        return redirect('settings');
           
    }

    public function removeFavIcon(){
        $siteSettings = siteSettings::first();
        if($siteSettings->favicon){
            delimg($siteSettings->favicon);
        }
        
        $siteSettings->favicon = '';
        $siteSettings->save();
    }
}
