<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\addresses;
use Illuminate\Http\Request;
use App\Models\newsPostSettings;
use App\Models\newsPosts;
use App\Models\customForms;
use App\Models\ImageGalleryCategory;
use App\Models\frontSections;
use App\Models\siteSettings;
use App\Models\timeZones;
use App\Models\NotificationSettings;

use DateTime;
use DateTimeZone;

class NewsPostController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'newspost';
        $this->data['controller_name'] = 'News Post';
        $newsPostSetting = newsPostSettings::first();
        $this->data['is_generic_setting_on']  = $newsPostSetting->use_generic_newspost_setting;
        $this->data['font_family'] = get_font_family();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['news_posts'] = newsPosts::orderBy('display_order', 'ASC')->get();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
            ->orderBy('title', 'ASC')
            ->get();
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $siteSettings = siteSettings::find('1');
        $this->data['addresses'] = addresses::get();
        $this->data['timezone']  = timeZones::find($siteSettings->timezone)->first();
    }
    
    public function addview()
    {
        
        if (!check_auth_permission('news_posts') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        return view('admin.newspost.add',$this->data);
    }  

    public function create(Request $request)
    {  
        
        if (!check_auth_permission('news_posts') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $request->validate([
            'post_title' => 'required',
        ]);
        
        $newData = new newsPosts();
        $newData->post_title = $request->post_title?$request->post_title:'';
        $newData->post_title_size = $request->post_title_size?$request->post_title_size:'';
        $newData->post_title_color = $request->post_title_color?$request->post_title_color:'';
        $newData->font_family = $request->font_family?$request->font_family:0;

        $newData->post_desc = $request->post_desc?$request->post_desc:'';
        $newData->post_desc_1 = $request->post_desc_1?$request->post_desc_1:'';
        $newData->post_desc_2 = $request->post_desc_2?$request->post_desc_2:'';
        $newData->post_desc_3 = $request->post_desc_3?$request->post_desc_3:'';
        $newData->post_desc_font_size = $request->post_desc_font_size?$request->post_desc_font_size:'';
        $newData->post_desc_color = $request->post_desc_color?$request->post_desc_color:'';
        $newData->desc_font_family = $request->desc_font_family?$request->desc_font_family:0;
        $newData->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $newData->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $newData->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
        $newData->read_more_content_color = $request->read_more_content_color?$request->read_more_content_color:'';
        $newData->read_more_content_font_size = $request->read_more_content_font_size?$request->read_more_content_font_size:'';
        $newData->read_more_content_font_font_family = $request->read_more_content_font_font_family?$request->read_more_content_font_font_family:'';
       

        if($request->userfile){
            $newData->image = saveimagefromdataimage($request->userfile);
        }else{
            $newData->image = '';
        }
        if($request->timed_image){
            $newData->timed_image = saveimagefromdataimage($request->timed_image);
        }else{
            $newData->timed_image = '';
        }
        
        $newData->datetime = $request->datetime?$request->datetime:'';
        $newData->show_date = $request->show_date?'1':'0';
        $newData->enable_timed_image = $request->enable_timed_image?'1':'0';
        
        $newData->timed_image_duration = $request->image_timer?$request->image_timer:'0';

        $newData->timed_image_type = $request->image_type;
        if($newData->timed_image_type=='0'){
            $newData->timed_image_start_time= $request->image_start_time?$request->image_start_time:"00:00:00";
            $newData->timed_image_end_time = $request->image_end_time?$request->image_end_time:'00:00:00';
        }else{
            $timer = $request->image_timer;
           
            $start_time = new DateTime(date('Y-m-d H:i:s'));
            $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $end_time = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$timer.' minutes',strtotime(date('H:i:s')))));
            $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            
            $newData->timed_image_start_time= $start_time;
            $newData->timed_image_end_time =$end_time ;
        }
        $newData->timed_image_days = json_encode($request->days?$request->days:array());
        

        $newData->action_button_active = $request->action_button_active?1:0;
        $newData->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $newData->action_button_discription_color = $request->action_button_discription_color?$request->action_button_discription_color:'';
        $newData->action_button_bg_color = $request->action_button_bg_color?$request->action_button_bg_color:'';
        $newData->action_button_link = $request->action_button_link?$request->action_button_link:'';
        $newData->action_button_link_text = $request->action_button_link_text?$request->action_button_link_text:'';
        $newData->action_button_customform = $request->action_button_customform?$request->action_button_customform:'0';
        $newData->event_form_id = $request->action_button_eventform?$request->action_button_eventform:'0';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'0';
        $newData->action_button_map_address = $request->action_button_map_address?$request->action_button_map_address:'';
       
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;

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
            $newData->action_button_video = uploadimg($file,null);
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        if(isset($request->action_button_audio_icon_feature)){
            $file = $request->action_button_audio_icon_feature; 
            $file_name = $file->getClientOriginalName();
            
            $file_ext = $file->extension();
            $fileInfo = $request->action_button_audio_icon_feature->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_audio_icon_feature= uploadimg($file,null);
        }

        $newData->display_order = 0;
        $newData->save();
        $id = $newData->id;
    
        if($request->act_button_discription && is_array($request->act_button_discription)){
            $act_slug = 'news_post';
            $actionButton = "";
        }
        $newData = newsPosts::find($id);
        $newData->display_order = $id++;
        $newData->save();
         
        $message = 'Newspost has been created';
        $block = 'news_posts_bluebar';

        checkSendNotification('Newspost has been updated',$message);
        
        return  redirect('quicksettings?block=news_posts_bluebar')->withSuccess($this->data['controller_name'].' has been added successfully'); 
    }

    public function editview(Request $request){

        
        if (!check_auth_permission('news_posts') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $data = newsPosts::find($request->id);
        
        if(!$data){
            return redirect('quicksettings?block=news_posts_bluebar')->withError($this->data['controller_name'].' not found');
        }
        $this->data['detail_info'] = $data;
        return view('admin.newspost.edit',$this->data);

    }

    public function update(Request $request){
        if (!check_auth_permission('news_posts') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $newData = newsPosts::find($request->id);
        
        if(!$newData){
            return redirect('quicksettings?block=news_posts_bluebar')->withError($this->data['controller_name'].' not found');
        }
        $update_data = [
            'desc_text' => 'required',
        ];
        
        $newData->post_title = $request->post_title?$request->post_title:'';
        $newData->post_title_size = $request->post_title_size?$request->post_title_size:'';
        $newData->post_title_color = $request->post_title_color?$request->post_title_color:'';
        $newData->font_family = $request->font_family?$request->font_family:0;

        $newData->post_desc = $request->post_desc?$request->post_desc:'';
        $newData->post_desc_1 = $request->post_desc_1?$request->post_desc_1:'';
        $newData->post_desc_2 = $request->post_desc_2?$request->post_desc_2:'';
        $newData->post_desc_3 = $request->post_desc_3?$request->post_desc_3:'';
        $newData->post_desc_font_size = $request->post_desc_font_size?$request->post_desc_font_size:'';
        $newData->post_desc_color = $request->post_desc_color?$request->post_desc_color:'';
        $newData->desc_font_family = $request->desc_font_family?$request->desc_font_family:0;

        $newData->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $newData->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $newData->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
        $newData->read_more_content_color = $request->read_more_content_color?$request->read_more_content_color:'';
        $newData->read_more_content_font_size = $request->read_more_content_font_size?$request->read_more_content_font_size:'';
        $newData->read_more_content_font_font_family = $request->read_more_content_font_font_family?$request->read_more_content_font_font_family:'';
        if(isset($request->audio_file[0]))
        {
            if(isset($newData->action_button_action_audio)){
                delimg($newData->action_button_action_audio);
            }
            $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $request->audio_file[0]->getClientMimeType())[1];
            $request->audio_file[0]->move("assets/uploads/".get_current_url(),$filename);
            $newData->action_button_action_audio = $filename;
        } else{
            $newData->action_button_action_audio = '';
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        if($request->userfile){
            if(isset($newData->image)){
                delimg($newData->image);
            }
            $newData->image = saveimagefromdataimage($request->userfile);
        }
        if($request->timed_image){
            if(isset($newData->timed_image)){
                delimg($newData->timed_image);
            }
            $newData->timed_image = saveimagefromdataimage($request->timed_image);
        }
        
        $newData->datetime = $request->datetime?$request->datetime:'';
        $newData->show_date = $request->show_date?'1':'0';
        $newData->enable_timed_image = $request->enable_timed_image?'1':'0';
        
        $newData->timed_image_duration = $request->timed_image_duration?$request->timed_image_duration:'0';

        $newData->timed_image_days = json_encode($request->days?$request->days:array());
        
        $newData->timed_image_type = $request->image_type;
        if($newData->timed_image_type=='days'){
            $newData->timed_image_start_time= $request->image_start_time?$request->image_start_time:"00:00:00";
            $newData->timed_image_end_time = $request->image_end_time?$request->image_end_time:'00:00:00';
        }else{
            $timer = $request->image_timer;
            $newData->timed_image_duration = $timer;
          
            $start_time = new DateTime(date('Y-m-d H:i:s'));
            $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $end_time = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$timer.' minutes',strtotime(date('H:i:s')))));
            $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            
            $newData->timed_image_start_time= $start_time;
            $newData->timed_image_end_time = $end_time;
        
        }

        $newData->action_button_active = $request->action_button_active?1:0;
        $newData->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $newData->action_button_discription_color = $request->action_button_discription_color?$request->action_button_discription_color:'';
        $newData->action_button_bg_color = $request->action_button_bg_color?$request->action_button_bg_color:'';
        $newData->action_button_link = $request->action_button_link?$request->action_button_link:'';
        $newData->action_button_link_text = $request->action_button_link_text?$request->action_button_link_text:'';
        $newData->action_button_customform = $request->action_button_customform?$request->action_button_customform:'0';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'0';
        $newData->action_button_map_address = $request->action_button_map_address?$request->action_button_map_address:'';
        
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
            $newData->action_button_video = uploadimg($file,null);
        }

        if(isset($request->action_button_audio_icon_feature1)){
            $file = $request->action_button_audio_icon_feature1; 
            $file_name = $file->getClientOriginalName();
            
            $file_ext = $file->extension();
            $fileInfo = $request->action_button_audio_icon_feature1->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_audio_icon_feature= uploadimg($file,null);
        }
        
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;

        $newData->save();

        $message = 'Newspost has been updated';
        $block = 'news_posts_bluebar';
        checkSendNotification('Newspost has been updated',$message);
        return redirect('quicksettings?block=news_posts_bluebar')->withSuccess($this->data['controller_name'].' updated');
    }

    public function delete(Request $request){
        
        
        if (!check_auth_permission('news_posts') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $data = newsPosts::find($request->id);
        
        if(!$data){
            return redirect('quicksettings?block=news_posts_bluebar')->withError($this->data['controller_name'].' not found');
        }

        newsPosts::where('id',$data->id)->delete();
        delimg($data->image);
        delimg($data->timed_image);
        
        $message = 'Newspost has been deleted';
        $block = 'news_posts_bluebar';

        checkSendNotification('Newspost has been deleted',$message);
        return redirect('quicksettings?block=news_posts_bluebar')->withSuccess($this->data['controller_name'].' deleted');
    }

}
