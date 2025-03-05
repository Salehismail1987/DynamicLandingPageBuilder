<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use Illuminate\Support\Facades\Http;
use App\Models\ContactInfo;
use App\Models\frontSections;
use App\Models\icons;
use App\Models\timeZones;
use App\Models\siteSettings;
use App\Models\user;
use App\Models\userRolls;
use App\Models\addresses;
use App\Models\CrmSetting;
use Illuminate\Support\Str;
use App\Models\EmailPost;
use App\Models\EmailPostImage;
use App\Models\ScheduleEmail;
use App\Models\ScheduleEmailContact;
use App\Models\CustomScheduleEmail;
use App\Models\EmailPostStarter;
use App\Models\EmailPostStarterImage;
use App\Models\customForms;
use Session;

class EmailPostController extends Controller
{
    //
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

    # Delete Schedule Email
    public function deleteSchedule($id) {
    
        ScheduleEmailContact::where(array('schedule_email_id' => $id))->delete();
        ScheduleEmail::where( array('id' => $id))->delete();
        $message = 'Schedule Emails has been deleted!';
        $block = 'email_management';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');

        return redirect('crmcontrols?block='.$block)->withSuccess($message);
    }  

    # (Hassan) Delete Multiple Schedules 
    public function deleteMultipleSchedules(Request $request){
        ScheduleEmailContact::whereIn('schedule_email_id', $request->rows)->delete();
        ScheduleEmail::whereIn('id', $request->rows)->delete();
        $message = 'Selected Schedule Emails has been deleted!';
        $block = 'email_management';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');

        Session::flash('success',$message);
    }  

    public function deleteMultipleEmailPost(Request $request) {
        
        EmailPost::whereIn('id',$request->rows)->delete();
        $email_template_images = EmailPostImage::whereIn('email_id',$request->rows)->get();
        if (is_array($email_template_images) && count($email_template_images) > 0) {
            foreach ($email_template_images as $image) {
                delimg($image->image);
            }
        }
        EmailPostImage::whereIn('email_id',$request->rows)->delete();
        $message = 'Email Post has been deleted!';
        $block = 'email_management';
        Session::flash('success',$message);
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');

    }  
    public function deleteEmailPost($id) {
        
        EmailPost::where(array('id' => $id))->delete();
        $email_template_images = EmailPostImage::where('email_id',$id)->get();
        if (is_array($email_template_images) && count($email_template_images) > 0) {
            foreach ($email_template_images as $image) {
                delimg($image->image);
            }
        }
        EmailPostImage::where(array('email_id'=>$id))->delete();
        $message = 'Email Post has been deleted!';
        $block = 'email_management';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block='.$block)->withSuccess($message);
    }  

    public function new(Request $request){
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        $this->data['email_stater_templates'] = EmailPostStarter::select('id','content_title')->orderBy('display_order','ASC')->get();
        return view('admin.emailpost.add',$this->data);
    }

    public function editview(Request $request){
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        $this->data['email_stater_templates'] = EmailPostStarter::select('id','content_title')->orderBy('display_order','ASC')->get();
        $data = EmailPost::find($request->id);
        $this->data['images'] = EmailPostImage::where('email_id',$request->id)->get();
        if(!$data){
            return redirect('crmcontrols?block=email_management')->withError('Email Post not found');
        }
        $this->data['edit_id'] = $request->id;
        $this->data['detail_info'] = $data;
        return view('admin.emailpost.edit',$this->data);

    }

    public function duplicateView(Request $request){
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
        $data = EmailPost::find($request->id);
        $this->data['edit_id'] = $request->id;
        
        if(!$data){
            return redirect('crmcontrols?block=email_management')->withError('Email Post not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.emailpost.duplicate',$this->data);

    }

    public function getEmailTemplate(Request $request){
        $temp_id = $request->temp_id;
        $detail_info = EmailPostStarter::find($temp_id);
        
		$detail_info->images  = EmailPostStarterImage::where(array('email_id'=>$temp_id))->get();
        echo json_encode($detail_info);
    }

    public function saveEmailPost(Request $request){

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
            $data_template['image_size'] = $request->image_size;
            
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
            if(isset($request->action_button_video)){
                $file = $request->action_button_video; 
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->action_button_video->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data_template['action_button_video'] = uploadimg($file,null);
            }

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
            $data_template['action_button_map_address_2'] = $request->action_button_map_address_2;
            $data_template['action_button_event_form'] = $request->action_button_event_form;
            $data_template['action_button_event_form2'] = $request->action_button_event_form2;
            
            if(isset($request->action_button_video_2)){
                $file = $request->action_button_video_2; 
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->action_button_video_2->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data_template['action_button_video_2'] = uploadimg($file,null);
            }

            if($request->logo_image){
                $data_template['logo_image'] = saveimagefromdataimage($request->logo_image,TRUE);
            }

            if($request->email_image){
                $data_template['email_image'] = saveimagefromdataimage($request->email_image);
            }
            $post = EmailPost::create($data_template);
            
            $post_id = $post->id;
      
            if ($request->userfileabovefooter) {
                
                foreach($request->userfileabovefooter as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            EmailPostImage::create(array('email_id' =>$post->id, 'image' =>  $name, 'placement' => 'above'));
                        }
                    }
                }
            }
            if ($request->userfilebelowfooter) {
                
                foreach($request->userfilebelowfooter as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            EmailPostImage::create(array('email_id' =>$post->id, 'image' =>  $name, 'placement' => 'below'));
                        }
                    }
                }
            }
            checkSendNotification('CRM has been updated','Email Post has been added','crm_notifications','crm_notification_email');

            return  redirect('crmcontrols?block=email_management')->withSuccess('Email Post has been added successfully'); 
       
    }


    public function updateEmailPost(Request $request){
        $request->validate([
            'description_text' => 'required',
        ]);

        $exist = EmailPost::find($request->id);
        if(!$exist){
            return  redirect('crmcontrols?block=email_management')->withError('Email Post not found!'); 
        }
            $data_template = [];
            $data_template['teaser_title'] = $request->teaser_title;
            $data_template['content_title'] = $request->content_title;
            $data_template['logo_text'] = $request->logo_text;
            $data_template['description_text'] = $request->description_text;
            $data_template['preheader_text'] = $request->preheader_text;
            $data_template['subtitle'] = $request->subtitle;
            $data_template['notes'] = $request->notes;
            $data_template['image_size'] = $request->image_size;
            
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

            if(isset($request->action_button_video)){
                $file = $request->action_button_video; 
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->action_button_video->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data_template['action_button_video'] = uploadimg($file,null);
            }

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
            if(isset($request->action_button_video_2)){
                $file = $request->action_button_video_2; 
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->action_button_video_2->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data_template['action_button_video_2'] = uploadimg($file,null);
            }

            $email_post= EmailPost::where('id',$request->id)->first();

            if($request->logo_image){
                if(isset($email_post->logo_image)){
                    delimg($email_post->logo_image);
                }
                $data_template['logo_image'] = saveimagefromdataimage($request->logo_image,TRUE);
            }

            if($request->email_image){
                if(isset($email_post->email_image)){
                    delimg($email_post->email_image);
                }
                $data_template['email_image'] = saveimagefromdataimage($request->email_image);
            }
            

            $post = EmailPost::where('id',$request->id)->update($data_template);
           
            if ($request->userfileabovefooter) {
                
                foreach($request->userfileabovefooter as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            EmailPostImage::create(array('email_id' =>$request->id, 'image' =>  $name, 'placement' => 'above'));
                        }
                    }
                }
            }
            if ($request->userfilebelowfooter) {
                
                foreach($request->userfilebelowfooter as $single_image){
                    if($single_image!=''){
                        $name = "";
                        $name =  saveimagefromdataimage($single_image);
                        if($name){
                            EmailPostImage::create(array('email_id' =>$request->id, 'image' =>  $name, 'placement' => 'below'));
                        }
                    }
                }
            }
            checkSendNotification('CRM has been updated','Email post updated','crm_notifications','crm_notification_email');

            return  redirect('crmcontrols?block=email_management')->withSuccess('Email Post has been updated successfully'); 
    }


    
	public function delimage(Request $request){
		$thisimg =  $request->imgid;
        $email_post = EmailPostImage::where(array('id' => $thisimg))->first();
        if(isset($email_post->image)){
            delimg($email_post->image);
        }
        EmailPostImage::where(array('id' => $thisimg))->delete();
	}


    public function saveDuplicateEmailPost(Request $request, $id = null){
        $request->validate([
            'description_text' => 'required',
        ]);
        if ($id) {
            $old_data = EmailPost::where('id', $id)->first();
            if ($old_data->logo_image) {
                $filePath = url("assets/uploads/" . get_current_url() . "{$old_data->logo_image}");
                $response = Http::timeout(60)->get($filePath);

                // // Generate a unique filename
                $filename = Str::uuid() . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                $filePath = "assets/uploads/" . get_current_url() . '/' . "{$filename}";
                file_put_contents($filePath, $response->body());

            }
            if ($old_data->email_image) {
                $filePath = url("assets/uploads/" . get_current_url() . "{$old_data->email_image}");
                $response = Http::timeout(120)->get($filePath);
    
                // // Generate a unique filename
                $filename_email = Str::uuid() . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                $filePath = "assets/uploads/" . get_current_url() . '/' . "{$filename_email}";
                file_put_contents($filePath, $response->body());
                
            }
        }
        
        $data_template = [];
        $data_template['logo_image'] = $filename ?? '';
        $data_template['email_image'] = $filename_email ?? '';
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
        
        if(isset($request->action_button_video)){

            $file = $request->action_button_video; 
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->extension();
            $fileInfo = $request->action_button_video->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $data_template['action_button_video'] = uploadimg($file,null);
        }

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

        if(isset($request->action_button_video_2)){
            
            $file = $request->action_button_video_2; 
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->extension();
            $fileInfo = $request->action_button_video_2->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $data_template['action_button_video_2'] = uploadimg($file,null);
        }


        if($request->email_image){
            $data_template['email_image'] = saveimagefromdataimage($request->email_image);
        }

        $post = EmailPost::create($data_template);
        $post_id = $post->id;
        $images = EmailPostImage::where('email_id',$id)->get();
        if($images)
        {
            foreach($images as $image)
            {
                if ($image->image) {
                    $filePath = url("assets/uploads/" . get_current_url() . "{$image->image}");
                    $response = Http::timeout(60)->get($filePath);
    
                    // // Generate a unique filename
                    $filename = Str::uuid() . '.' . pathinfo($filePath, PATHINFO_EXTENSION);
                    
                    // Save the file to the storage (e.g., 'public/uploads' directory)
                    // Storage::put("public/uploads/{$filename}", $fileContent);
                    // Storage::put("assets/uploads/".get_current_url().$filename, $fileContent);
                    $filePath = "assets/uploads/" . get_current_url() . '/' . "{$filename}";
                    file_put_contents($filePath, $response->body());
                    $newImage = new EmailPostImage();
                    $newImage->email_id = $post_id;
                    $newImage->image = $filename;
                    $newImage->placement = $image->placement;
                    $newImage->save();
    
                }
            }
        }
        if ($request->userfile) {
            
            foreach($request->userfile as $single_image){
                if($single_image!=''){
                    $name = "";
                    $name =  saveimagefromdataimage($single_image);
                    if($name){
                        
                        EmailPostImage::create(array('email_id' =>$post_id, 'image' =>  $name));
                    }
                }
            }
        }
        checkSendNotification('CRM has been updated','Duplicate Email Post has been saved','crm_notifications','crm_notification_email');

        return  redirect('crmcontrols?block=email_management')->withSuccess('Duplicate Email Post has been saved successfully'); 
    }


}