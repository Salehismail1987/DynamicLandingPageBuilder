<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;

use App\Models\ContactInfo;
use App\Models\frontSections;
use App\Models\icons;
use App\Models\timeZones;
use App\Models\siteSettings;
use App\Models\user;
use App\Models\userRolls;
use App\Models\addresses;
use App\Models\CrmSetting;

use App\Models\EmailPost;
use App\Models\EmailPostImage;
use App\Models\ScheduleEmail;
use App\Models\ScheduleEmailContact;
use App\Models\CustomScheduleEmail;
use App\Models\EmailPostStarter;
use App\Models\EmailPostStarterImage;
use App\Models\customForms;
use Session;

class EmailTemplateController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'CRM';
        $this->data['controller_name'] = 'CRM';
        $this->data['crm_settings'] = CrmSetting::first();
        $this->data['font_family'] = get_font_family();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['custom_forms'] = customForms::orderBy('title','ASC')->get();
        $siteSettings = siteSettings::find('1');
        $this->data['timezone']  = timeZones::find($siteSettings->timezone)->first();        
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['addresses'] = addresses::get();
        
    }
    public function new(Request $request){
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        return view('admin.emailtemplates.add',$this->data);
    }

    public function editview(Request $request){
        $data = EmailPostStarter::find($request->id);
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        if(!$data){
            return redirect('crmcontrols?block=email_management')->withError('Email Template not found');
        }
        $this->data['edit_id'] = $request->id;
        $this->data['detail_info'] = $data;
        return view('admin.emailtemplates.edit',$this->data);

    }
    public function duplicateView(Request $request){
        $data = EmailPostStarter::find($request->id);
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        $this->data['edit_id'] = $request->id;
        
        if(!$data){
            return redirect('crmcontrols?block=email_management')->withError('Email Template not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.emailtemplates.duplicate',$this->data);

    }
    public function save(Request $request){
        $request->validate([
            'description_text' => 'required',
        ]);

            $data_template = [];
            $data_template['teaser_title'] = $request->teaser_title;
            $data_template['content_title'] = $request->content_title;
            $data_template['logo_text'] = $request->logo_text;
            $data_template['description_text'] = $request->description_text;
            $data_template['preheader_text'] = $request->preheader_text;
            $data_template['subtitle'] = $request->subtitle;
            $data_template['notes'] = $request->note;
            
            $data_template['override_generic_settings'] = $request->override_generic_settings ? '1' : '0';
            
            if( $request->override_generic_settings){
                $data_template['content_title_font_family'] = $request->content_title_font_family;
                $data_template['content_title_text_size'] = $request->content_title_text_size;
                $data_template['content_title_text_color'] = $request->content_title_text_color;

                $data_template['logo_title_font_family'] = $request->logo_title_font_family;
                $data_template['logo_title_text_size'] = $request->logo_title_text_size;
                $data_template['logo_title_text_color'] = $request->logo_title_text_color;
                $data_template['email_image_desciption_font_family'] = $request->email_image_desciption_font_family;
                $data_template['email_image_desciption_text_size'] = $request->email_image_desciption_text_size;
                $data_template['email_image_desciption_text_color'] = $request->email_image_desciption_text_color;
                $data_template['subtitle_font_family'] = $request->subtitle_font_family;
                $data_template['subtitle_text_size'] = $request->subtitle_text_size;
                $data_template['subtitle_text_color'] = $request->subtitle_text_color;
            }         

            $data_template['is_email_description_center'] =  $request->is_email_description_center ? '1':'0';
            $data_template['is_content_title_justified_center'] =  $request->is_content_title_justified_center ? '1':'0';
            $data_template['is_sub_title_justified_center'] =  $request->is_sub_title_justified_center ? '1':'0';
            $data_template['link_social_media_icons'] =  $request->link_social_media_icons ? '1':'0';
           
           
            $data_template['action_button_active']= $request->action_button_active?'1':'0';
            $data_template['action_button_discription'] = $request->action_button_discription;
            $data_template['action_button_discription_color'] = $request->action_button_discription_color;
            $data_template['action_button_bg_color'] = $request->action_button_bg_color;
            $data_template['action_button_link'] = $request->action_button_link;
            $data_template['action_button_link_text'] = $request->action_button_link_text;
            $data_template['action_button_customform'] = $request->action_button_customform;
            $data_template['action_button_phone_no_calls'] = $request->action_button_phone_no_calls;
            $data_template['action_button_phone_no_sms'] = $request->action_button_phone_no_sms;
            $data_template['action_button_action_email'] = $request->action_button_action_email;
            $data_template['action_button_address_id'] = $request->action_button_address_id;
            $data_template['action_button_map_address'] = $request->action_button_map_address;

            $data_template['action_button_active_2']= $request->action_button_active_2?'1':'0';
            $data_template['action_button_discription_2'] = $request->action_button_discription_2;
            $data_template['action_button_discription_color_2'] = $request->action_button_discription_color_2;
            $data_template['action_button_bg_color_2'] = $request->action_button_bg_color_2;
            $data_template['action_button_link_2'] = $request->action_button_link_2;
            $data_template['action_button_link_text_2'] = $request->action_button_link_text_2;
            $data_template['action_button_customform_2'] = $request->action_button_customform_2;
            $data_template['action_button_phone_no_calls_2'] = $request->action_button_phone_no_calls_2;
            $data_template['action_button_phone_no_sms_2'] = $request->action_button_phone_no_sms_2;
            $data_template['action_button_action_email_2'] = $request->action_button_action_email_2;
            $data_template['action_button_address_id_2'] = $request->action_button_address_id_2;
            $data_template['action_button_map_address_2'] = $request->action_button_map_address_2;
            $data_template['action_button_event_form'] = $request->action_button_event_form;
            $data_template['action_button_event_form2'] = $request->action_button_event_form2;
            
            if($request->logo_image){
                $data_template['logo_image'] = saveimagefromdataimage($request->logo_image,TRUE);
            }

            if($request->email_image){
                $data_template['email_image'] = saveimagefromdataimage($request->email_image);
            }
            $post = EmailPostStarter::create($data_template);
            
            $post_id = $post->id;

            if ($request->userfile) {
                
                foreach($request->userfile as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            
                            EmailPostStarterImage::create(array('email_id' =>$post_id, 'image' =>  $name));
                        }
                    }
                }
            }
            return  redirect('crmcontrols?block=email_management')->withSuccess('Email Template has been added successfully'); 
       
    }


    public function update(Request $request){
        $request->validate([
            'description_text' => 'required',
        ]);

        $exist = EmailPostStarter::find($request->id);
        if(!$exist){
            return  redirect('crmcontrols?block=email_management')->withError('Email Template not found!'); 
        }
            $data_template = [];
            $data_template['teaser_title'] = $request->teaser_title;
            $data_template['content_title'] = $request->content_title;
            $data_template['logo_text'] = $request->logo_text;
            $data_template['description_text'] = $request->description_text;
            $data_template['preheader_text'] = $request->preheader_text;
            $data_template['subtitle'] = $request->subtitle;
            $data_template['notes'] = $request->notes;
            
            $data_template['override_generic_settings'] = $request->override_generic_settings ? '1' : '0';
            
            if( $request->override_generic_settings){
                $data_template['content_title_font_family'] = $request->content_title_font_family;
                $data_template['content_title_text_size'] = $request->content_title_text_size;
                $data_template['content_title_text_color'] = $request->content_title_text_color;

                $data_template['logo_title_font_family'] = $request->logo_title_font_family;
                $data_template['logo_title_text_size'] = $request->logo_title_text_size;
                $data_template['logo_title_text_color'] = $request->logo_title_text_color;
                $data_template['email_image_desciption_font_family'] = $request->email_image_desciption_font_family;
                $data_template['email_image_desciption_text_size'] = $request->email_image_desciption_text_size;
                $data_template['email_image_desciption_text_color'] = $request->email_image_desciption_text_color;
                $data_template['subtitle_font_family'] = $request->subtitle_font_family;
                $data_template['subtitle_text_size'] = $request->subtitle_text_size;
                $data_template['subtitle_text_color'] = $request->subtitle_text_color;
            }         

            $data_template['is_email_description_center'] =  $request->is_email_description_center ? '1':'0';
            $data_template['is_content_title_justified_center'] =  $request->is_content_title_justified_center ? '1':'0';
            $data_template['is_sub_title_justified_center'] =  $request->is_sub_title_justified_center ? '1':'0';
            $data_template['link_social_media_icons'] =  $request->link_social_media_icons ? '1':'0';
           
           
            $data_template['action_button_active']= $request->action_button_active?'1':'0';
            $data_template['action_button_discription'] = $request->action_button_discription;
            $data_template['action_button_discription_color'] = $request->action_button_discription_color;
            $data_template['action_button_bg_color'] = $request->action_button_bg_color;
            $data_template['action_button_link'] = $request->action_button_link;
            $data_template['action_button_link_text'] = $request->action_button_link_text;
            $data_template['action_button_customform'] = $request->action_button_customform;
            $data_template['action_button_phone_no_calls'] = $request->action_button_phone_no_calls;
            $data_template['action_button_phone_no_sms'] = $request->action_button_phone_no_sms;
            $data_template['action_button_action_email'] = $request->action_button_action_email;
            $data_template['action_button_address_id'] = $request->action_button_address_id;
            $data_template['action_button_map_address'] = $request->action_button_map_address;

            $data_template['action_button_active_2']= $request->action_button_active_2?'1':'0';
            $data_template['action_button_discription_2'] = $request->action_button_discription_2;
            $data_template['action_button_discription_color_2'] = $request->action_button_discription_color_2;
            $data_template['action_button_bg_color_2'] = $request->action_button_bg_color_2;
            $data_template['action_button_link_2'] = $request->action_button_link_2;
            $data_template['action_button_link_text_2'] = $request->action_button_link_text_2;
            $data_template['action_button_customform_2'] = $request->action_button_customform_2;
            $data_template['action_button_phone_no_calls_2'] = $request->action_button_phone_no_calls_2;
            $data_template['action_button_phone_no_sms_2'] = $request->action_button_phone_no_sms_2;
            $data_template['action_button_action_email_2'] = $request->action_button_action_email_2;
            $data_template['action_button_address_id_2'] = $request->action_button_address_id_2;
            $data_template['action_button_map_address_2'] = $request->action_button_map_address_2;
            $data_template['action_button_event_form'] = $request->action_button_event_form;
            $data_template['action_button_event_form2'] = $request->action_button_event_form2;
            $post_starter= EmailPostStarter::where('id',$request->id)->first();

            if($request->logo_image){
                if(isset($post_starter->logo_image)){
                    delimg($post_starter->logo_image);
                }
                $data_template['logo_image'] = saveimagefromdataimage($request->logo_image,TRUE);
            }

            if($request->email_image){
                if(isset($post_starter->email_image)){
                    delimg($post_starter->email_image);
                }
                $data_template['email_image'] = saveimagefromdataimage($request->email_image);
            }

            $post = EmailPostStarter::where('id',$request->id)->update($data_template);
           
            if ($request->userfile) {
                
                foreach($request->userfile as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            
                            EmailPostStarterImage::create(array('email_id' =>$request->id, 'image' =>  $name));
                        }
                    }
                }
            }
            checkSendNotification('CRM Updated','Email Template has been updated successfully','crm_notifications','crm_notification_email');

            return  redirect('crmcontrols?block=email_management')->withSuccess('Email Template has been updated successfully'); 
    }

    public function deleteMultipleEmailTemplate(Request $request) {
        
        EmailPostStarter::whereIn('id',$request->rows)->delete();
        $email_template_images = EmailPostStarterImage::whereIn('email_id',$request->rows)->get();
        if (is_array($email_template_images) && count($email_template_images) > 0) {
            foreach ($email_template_images as $image) {
                delimg($image->image);
            }
        }
        EmailPostStarterImage::whereIn('email_id',$request->rows)->delete();
        $message = 'Email Template has been deleted!';
        $block = 'email_management';
        Session::flash('success',$message);
    }  
    public function deleteEmailTemplate($id) {
        
        EmailPostStarter::where(array('id' => $id))->delete();
        $email_template_images = EmailPostStarterImage::where('email_id',$id)->get();
        if (is_array($email_template_images) && count($email_template_images) > 0) {
            foreach ($email_template_images as $image) {
                delimg($image->image);
            }
        }
        EmailPostStarterImage::where(array('email_id'=>$id))->delete();
        $message = 'Email Template has been deleted!';
        $block = 'email_management';

        return redirect('crmcontrols?block='.$block)->withSuccess($message);
    }  

    public function saveDuplicate(Request $request){
        $request->validate([
            'description_text' => 'required',
        ]);

        $data = EmailPostStarter::find($request->id);
        $data_template = [];
        $data_template['teaser_title'] = $request->teaser_title;
        $data_template['content_title'] = $request->content_title;
        $data_template['logo_text'] = $request->logo_text;
        $data_template['description_text'] = $request->description_text;
        $data_template['preheader_text'] = $request->preheader_text;
        $data_template['subtitle'] = $request->subtitle;
        $data_template['notes'] = $request->note;
        
        $data_template['override_generic_settings'] = $request->override_generic_settings ? '1' : '0';
        
        if( $request->override_generic_settings){
            $data_template['content_title_font_family'] = $request->content_title_font_family;
            $data_template['content_title_text_size'] = $request->content_title_text_size;
            $data_template['content_title_text_color'] = $request->content_title_text_color;

            $data_template['logo_title_font_family'] = $request->logo_title_font_family;
            $data_template['logo_title_text_size'] = $request->logo_title_text_size;
            $data_template['logo_title_text_color'] = $request->logo_title_text_color;
            $data_template['email_image_desciption_font_family'] = $request->email_image_desciption_font_family;
            $data_template['email_image_desciption_text_size'] = $request->email_image_desciption_text_size;
            $data_template['email_image_desciption_text_color'] = $request->email_image_desciption_text_color;
            $data_template['subtitle_font_family'] = $request->subtitle_font_family;
            $data_template['subtitle_text_size'] = $request->subtitle_text_size;
            $data_template['subtitle_text_color'] = $request->subtitle_text_color;
        }         

        $data_template['is_email_description_center'] =  $request->is_email_description_center ? '1':'0';
        $data_template['is_content_title_justified_center'] =  $request->is_content_title_justified_center ? '1':'0';
        $data_template['is_sub_title_justified_center'] =  $request->is_sub_title_justified_center ? '1':'0';
        $data_template['link_social_media_icons'] =  $request->link_social_media_icons ? '1':'0';
       
       
        $data_template['action_button_active']= $request->action_button_active?'1':'0';
        $data_template['action_button_discription'] = $request->action_button_discription;
        $data_template['action_button_discription_color'] = $request->action_button_discription_color;
        $data_template['action_button_bg_color'] = $request->action_button_bg_color;
        $data_template['action_button_link'] = $request->action_button_link;
        $data_template['action_button_link_text'] = $request->action_button_link_text;
        $data_template['action_button_customform'] = $request->action_button_customform;
        $data_template['action_button_phone_no_calls'] = $request->action_button_phone_no_calls;
        $data_template['action_button_phone_no_sms'] = $request->action_button_phone_no_sms;
        $data_template['action_button_action_email'] = $request->action_button_action_email;
        $data_template['action_button_address_id'] = $request->action_button_address_id;
        $data_template['action_button_map_address'] = $request->action_button_map_address;

        $data_template['action_button_active_2']= $request->action_button_active_2?'1':'0';
        $data_template['action_button_discription_2'] = $request->action_button_discription_2;
        $data_template['action_button_discription_color_2'] = $request->action_button_discription_color_2;
        $data_template['action_button_bg_color_2'] = $request->action_button_bg_color_2;
        $data_template['action_button_link_2'] = $request->action_button_link_2;
        $data_template['action_button_link_text_2'] = $request->action_button_link_text_2;
        $data_template['action_button_customform_2'] = $request->action_button_customform_2;
        $data_template['action_button_phone_no_calls_2'] = $request->action_button_phone_no_calls_2;
        $data_template['action_button_phone_no_sms_2'] = $request->action_button_phone_no_sms_2;
        $data_template['action_button_action_email_2'] = $request->action_button_action_email_2;
        $data_template['action_button_address_id_2'] = $request->action_button_address_id_2;
        $data_template['action_button_map_address_2'] = $request->action_button_map_address_2;
        $data_template['action_button_event_form2'] = $request->action_button_event_form2;
        $data_template['action_button_event_form'] = $request->action_button_event_form;

        if($request->logo_image){
            $data_template['logo_image'] = saveimagefromdataimage($request->logo_image,TRUE);
        }else{
            $data_template['logo_image'] = $data->logo_image;
        }
        if($request->email_image){
            $data_template['email_image'] = saveimagefromdataimage($request->email_image);
        }else{
            $data_template['email_image'] = $data->email_image;
        }
        $post = EmailPostStarter::create($data_template);
        $post_id = $post->id;
        if ($request->userfile) {
            foreach($request->userfile as $single_image){
                if($single_image!=''){
                    $name = "";
                    $name =  saveimagefromdataimage($single_image);
                    if($name){
                        
                        EmailPostStarterImage::create(array('email_id' =>$post_id, 'image' =>  $name));
                    }
                }
            }
        }
        return  redirect('crmcontrols?block=email_management')->withSuccess('Duplicate Email Template has been saved successfully'); 
    }
    public function deleteEmailPost($id) {
        EmailPostStarter::where(array('id' => $id))->delete();
        $email_template_images = EmailPostStarterImage::where('email_id',$id)->get();
        if (is_array($email_template_images) && count($email_template_images) > 0) {
            foreach ($email_template_images as $image) {
                delimg($image->image);
            }
        }
        EmailPostImage::where(array('email_id'=>$id))->delete();
        $message = 'Email Template has been deleted!';
        $block = 'email_management';
        return redirect('crmcontrols?block='.$block)->withSuccess($message);
    }  
}
