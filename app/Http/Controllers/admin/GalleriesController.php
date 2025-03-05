<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationSettings;
use App\Models\galleriesSettings;
use App\Models\galleryPost;
use App\Models\gallerySlider;
use App\Models\galleryVideo;
use App\Models\galleryTiles;
use App\Models\imageCategories;
use App\Models\frontSections;
use App\Models\customForms;
use App\Models\addresses;
use App\Models\galleryPostImage;
use App\Models\ImageGalleryCategory;
use App\Models\alertPopupSetting;

class GalleriesController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'galleries';
        $this->data['controller_name'] = 'Galleries';
        $this->data['font_family'] = get_font_family();
        $this->data['all_categories'] = ImageGalleryCategory::all();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
    }

    public function index(){
        if (!check_auth_permission(['image_gallery_category','gallery_post','gallery_slider','gallery_tiles','image_gallery_category','stored_image_gallery'])) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['galleryPost'] = galleryPost::orderBy('display_order')->get();
        $this->data['gallerySlider'] = gallerySlider::orderBy('display_order')->get();
        $this->data['galleryVideo'] = galleryVideo::orderBy('display_order')->get();
        $this->data['galleryTiles'] = galleryTiles::orderBy('display_order')->get();
        $this->data['imageCategories'] = ImageGalleryCategory::get();

        updateTimedImages();
        $this->data['generic_gallery_post_title'] = get_text_details('generic_gallery_post_title');
        $this->data['generic_gallery_post_desc'] = get_text_details('generic_gallery_post_desc');
        $this->data['generic_gallery_slider_text'] = get_text_details('generic_gallery_slider_text');
        $this->data['generic_gallery_video_subtitle'] = get_text_details('generic_gallery_video_subtitle');
        $this->data['generic_gallery_video_desc'] = get_text_details('generic_gallery_video_desc');
        $this->data['generic_gallery_tiles_text'] = get_text_details('generic_gallery_tiles_text');
        $this->data['gallery_tiles_subtitle'] = get_text_details('gallery_tiles_subtitle');

        return view('admin.galleries')->with($this->data);
    }
    public function savegenericpostsettings(Request $request){
        if (!check_auth_permission('gallery_post')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $message = 'Gallery Post Setting has been updated';
        $block = 'gallery_post_bluebar';

        $data = (object)[];
        $data->slug = "generic_gallery_post_title";
        $data->text = '';
        $data->size_web = $request->generic_gallery_post_title_font_size;
        $data->size_mobile = $request->generic_gallery_post_title_font_size_mobile;
        $data->color = $request->generic_gallery_post_title_color;
        $data->bg_color = $request->generic_gallery_post_title_bcakground;
        $data->fontfamily = $request->generic_gallery_post_title_font_family?$request->generic_gallery_post_title_font_family:'0';
        update_text_details('generic_gallery_post_title',$data);

        $data = (object)[];
        $data->slug = "generic_gallery_post_desc";
        $data->text = '';
        $data->size_web = $request->generic_gallery_post_desc_font_size;
        $data->size_mobile = '';
        $data->color = $request->generic_gallery_post_description_color;
        $data->bg_color = '';
        $data->fontfamily = $request->generic_gallery_post_desc_font_family?$request->generic_gallery_post_desc_font_family:'0';
        update_text_details('generic_gallery_post_desc',$data);

        $newData = galleriesSettings::find(1);
        $newData->gallery_post_background = $request->gallery_post_background;
        // $newData->gallery_post_use_generic = $request->use_generic_gallery_post_setting?'1':'0';
        
        $newData->gallery_posts_arrow_color = $request->gallery_posts_arrow_color;
        $newData->gallery_posts_arrow_bg_color = $request->gallery_posts_arrow_bg_color;
        $newData->gallery_post_autoplay = $request->gallery_post_autoplay?'1':'0';
        $newData->save();
        
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        if($request->save_generic_gallery_post_settings!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('galleries?block='.$block)->withSuccess($message);
        }
    }

    public function addPostView(){
        if (!check_auth_permission('gallery_post_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['addresses'] = addresses::all();
        
        return view('admin.gallerypost.add')->with($this->data);
    }
    public function savePost(Request $request){
        if (!check_auth_permission('gallery_post_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_post_title' => 'required',
        ]);

        $message = 'Gallery post has been added successfully';
        $block = 'gallery_post_bluebar';

        $data = new galleryPost();
        $data->post_title = $request->gallery_post_title;
        $data->post_title_color = $request->gallery_post_title_color;
        $data->post_font_family = $request->font_family?$request->font_family:'0';
        $data->post_title_bcakground = $request->gallery_post_title_bcakground;
        $data->post_title_left_right = $request->gallery_post_title_left_right;
        $data->post_desc = $request->gallery_post_desc;
        $data->post_desc_1 = isset($request->post_descs[0])?$request->post_descs[0]:'';
        $data->post_desc_2 = isset($request->post_descs[1])?$request->post_descs[1]:'';
        $data->post_desc_3 = isset($request->post_descs[2])?$request->post_descs[2]:'';
        $data->post_desc_font_size = $request->gallery_post_desc_font_size;
        $data->post_desc_font_family = $request->gallery_post_desc_font_family?$request->gallery_post_desc_font_family:'0';
        $data->post_title_font_size = $request->gallery_post_title_font_size?$request->gallery_post_title_font_size:'';
        $data->post_title_font_size_mobile = $request->gallery_post_title_font_size_mobile?$request->gallery_post_title_font_size_mobile:'';
        $data->post_image_size = $request->post_image_size;
        $data->action_button_active = $request->action_button_active?'1':'0';
        $data->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $data->action_button_discription_color = $request->action_button_discription_color;
        $data->action_button_bg_color = $request->action_button_bg_color;
        $data->action_button_link = $request->action_button_link;
        $data->action_button_link_text = $request->action_button_link_text;
        $data->action_button_customform = $request->action_button_customform;
        $data->event_form_id = $request->event_form_id;
        $data->action_button_map_address = $request->action_button_map_address;
        $data->description_text_color = $request->description_text_color?$request->description_text_color:'';
        $data->action_button_textpopup = $request->action_button_textpopup;
        $data->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $data->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $data->action_button_action_email = $request->action_button_action_email;
        $data->read_more_content_color = $request->read_more_content_color;
        $data->read_more_content_font_size = $request->read_more_content_font_size;
        $data->read_more_content_font_font_family = $request->read_more_content_font_font_family;
        $data->event_form_id = $request->event_form_id ? $request->event_form_id : 0;
        //$data->event_form_id = $request->event_form_id? $request->event_form_id:null;
        if (isset($request->popup_action_images)) {
            $data->popup_images = saveActionButtonImages($request->popup_action_images);
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
            $data->action_button_audio_icon_feature  = uploadimg($file,null);
        }
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
            $data->action_button_video = uploadimg($file,null);
        }


        $data->display_order = '999';

        if($request->action_button_link == "google_map" || $request->action_button_link == "address"){
            $data->action_button_address_id = $request->action_button_address_id;
        }else{
            $data->action_button_address_id = '0';
        }

        $data->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $data->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $data->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
       
        $data->gallery_post_fixed_description = $request->gallery_post_fixed_description;

        $data->save();

        if ($request->userfile) {
            foreach($request->userfile as $request_image){
                if($request_image!=''){
                    $newData2 = new galleryPostImage();
                    $newData2->post_id = $data->id;
                    $newData2->image = saveimagefromdataimage($request_image);
                    $newData2->save();
                }
            }
        }
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }

    public function editPostView(Request $request){
        if (!check_auth_permission('gallery_post_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['addresses'] = addresses::all();
        $this->data['detail_info'] = galleryPost::find($request->id);
        $this->data['detail_info_images'] = galleryPostImage::where('post_id',$request->id)->get();
        
        return view('admin.gallerypost.edit')->with($this->data);
    }
    
    public function updatePost(Request $request){
        if (!check_auth_permission('gallery_post_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_post_title' => 'required',
        ]);

        $message = 'Gallery post has been updated successfully';
        $block = 'gallery_post_bluebar';
        $data =  galleryPost::find($request->record_id);
        $data->post_title = $request->gallery_post_title;
        $data->post_title_color = $request->gallery_post_title_color;
        $data->post_font_family = $request->font_family?$request->font_family:'0';
        $data->post_title_bcakground = $request->gallery_post_title_bcakground;
        $data->post_title_left_right = $request->gallery_post_title_left_right;
        $data->post_desc = $request->gallery_post_desc;
        $data->post_desc_1 = isset($request->post_descs[0])?$request->post_descs[0]:'';
        $data->post_desc_2 = isset($request->post_descs[1])?$request->post_descs[1]:'';
        $data->post_desc_3 = isset($request->post_descs[2])?$request->post_descs[2]:'';
        $data->post_desc_font_size = $request->gallery_post_desc_font_size;
        $data->post_desc_font_family = $request->gallery_post_desc_font_family?$request->gallery_post_desc_font_family:'0';
        $data->post_title_font_size = $request->gallery_post_title_font_size?$request->gallery_post_title_font_size:'';
        $data->post_title_font_size_mobile = $request->gallery_post_title_font_size_mobile?$request->gallery_post_title_font_size_mobile:'';
        $data->post_image_size = $request->post_image_size;
        $data->action_button_active = $request->action_button_active?'1':'0';
        $data->event_form_id = $request->event_form_id? $request->event_form_id:null;
        $data->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $data->action_button_discription_color = $request->action_button_discription_color;
        $data->action_button_bg_color = $request->action_button_bg_color;
        $data->action_button_link = $request->action_button_link;
        $data->action_button_link_text = $request->action_button_link_text;
        $data->action_button_customform = $request->action_button_customform;

        $data->action_button_textpopup = $request->action_button_textpopup;
        if (isset($request->popup_action_images)) {
            $data->popup_images = saveActionButtonImages($request->popup_action_images);
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
            $data->action_button_audio_icon_feature  = uploadimg($file,null);
        }

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
            $data->action_button_video = uploadimg($file,null);
        }


        $data->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $data->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $data->action_button_action_email = $request->action_button_action_email;
        if(isset($request->audio_file[0]))
        {
            $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $request->audio_file[0]->getClientMimeType())[1];
            $request->audio_file[0]->move("assets/uploads/".get_current_url(),$filename);
            $data->action_button_action_audio = $filename;
        } else{
            $data->action_button_action_audio = '';
        }
        
        if( $request->action_button_link == "address"){
            $data->action_button_address_id = $request->action_button_address_id;
        }else{
            $data->action_button_address_id = '0';
        }
        $data->action_button_map_address = $request->action_button_map_address;


        $data->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $data->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $data->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
        $data->gallery_post_fixed_description = $request->gallery_post_fixed_description?$request->gallery_post_fixed_description:'';
        $data->description_text_color = $request->description_text_color?$request->description_text_color:'';
        $data->read_more_content_color = $request->read_more_content_color;
        $data->read_more_content_font_size = $request->read_more_content_font_size;
        $data->read_more_content_font_font_family = $request->read_more_content_font_font_family;
        $data->save();

        if ($request->userfile) {
            foreach($request->userfile as $request_image){
                if($request_image!=''){
                    $newData2 = new galleryPostImage();
                    $newData2->post_id = $data->id;
                    $newData2->image = saveimagefromdataimage($request_image);
                    $newData2->save();
                }
            }
        }

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }

    public function deletePost(Request $request){
        if (!check_auth_permission('gallery_post_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['detail_info'] = galleryPost::find($request->id)->delete();
        $message = 'Gallery post has been deleted successfully';
        $block = 'gallery_post_bluebar';
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function deleteGalleryPostImage(Request $request){
		$thisimg = $request->imgid;
        $imge = galleryPostImage::where(array('id' => $thisimg))->first();
        if($imge && isset($imge->image)){
            delimg($imge->image);
        }
        galleryPostImage::where(array('id' => $thisimg))->delete();
	}

    public function saveGenericSliderSettings(Request $request){
        if (!check_auth_permission('gallery_slider')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $message = 'Gallery slider Setting has been updated';
        $block = 'gallery_slider_bluebar';
        // dd($request);
        $newData = (object)[];
        $newData->size_web = $request->generic_gallery_slider_desc_fontsize;
        $newData->size_mobile = $request->generic_gallery_slider_desc_fontsize_mobile;
        $newData->color = $request->generic_gallery_slider_desc_color;
        $newData->bg_color = $request->generic_gallery_slider_desc_background_color;
        $newData->fontfamily = $request->generic_gallery_slider_desc_font_family?$request->generic_gallery_slider_desc_font_family:'0';
        update_text_details('generic_gallery_slider_text',$newData);

        $newData = galleriesSettings::find(1);
        // $newData->gallery_slider_use_generic = $request->use_generic_gallery_slider_setting?'1':'0';
        $newData->gallery_slider_background = $request->gallery_slider_background;
        $newData->gallery_slider_autoplay = $request->gallery_slider_autoplay?'1':'0';
       
        $newData->save();
        
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        if($request->save_generic_gallery_slider_settings!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('galleries?block='.$block)->withSuccess($message);
        }
    }
    public function addSliderView(){
        if (!check_auth_permission('gallery_slider_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        
        return view('admin.galleryslider.add')->with($this->data);
    }
    public function saveSlider(Request $request){
        if (!check_auth_permission('gallery_slider_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_slider_text' => 'required',
        ]);

        $message = 'Gallery Slider has been added successfully';
        $block = 'gallery_slider_bluebar';

        $newData = new gallerySlider();
        if($request->userfile){
            $newData->image = saveimagefromdataimage($request->userfile);
        }
        $newData->text = $request->gallery_slider_text;
        $newData->font_family = $request->font_family?$request->font_family:'0';
        $newData->text_color = $request->gallery_slider_text_color;
        $newData->back_color = $request->gallery_slider_text_background_color;
        $newData->text_fontsize = $request->gallery_slider_text_fontsize;
        $newData->text_fontsize_mobile = $request->gallery_slider_text_fontsize_mobile;
        $newData->display_order = '999';
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function editSliderView(Request $request){
        if (!check_auth_permission('gallery_slider_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['detail_info'] = gallerySlider::find($request->id);
        
        return view('admin.galleryslider.edit')->with($this->data);
    }
    public function updateSlider(Request $request){
        if (!check_auth_permission('gallery_slider_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_slider_text' => 'required',
        ]);

        $message = 'Gallery Slider has been added successfully';
        $block = 'gallery_slider_bluebar';

        $newData = gallerySlider::find($request->record_id);
        if($request->userfile){
            if(isset($newData->image )){
                delimg($newData->image );
            }
            $newData->image = saveimagefromdataimage($request->userfile);
        }
        $newData->text = $request->gallery_slider_text;
        $newData->font_family = $request->font_family?$request->font_family:'0';
        $newData->text_color = $request->gallery_slider_text_color;
        $newData->back_color = $request->gallery_slider_text_background_color;
        $newData->text_fontsize = $request->gallery_slider_text_fontsize;
        $newData->text_fontsize_mobile = $request->gallery_slider_text_fontsize_mobile;
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function deleteSlider(Request $request){
        if (!check_auth_permission('gallery_slider_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $newData= gallerySlider::find($request->id);
        if(isset($newData->image )){
            delimg($newData->image );
        }
        $this->data['detail_info'] = gallerySlider::find($request->id)->delete();
        $message = 'Gallery Slider has been deleted successfully';
        $block = 'gallery_slider_bluebar';
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');


        return redirect('galleries?block='.$block)->withSuccess($message);
    }

    
    public function saveGenericVideoSettings(Request $request){
        if (!check_auth_permission('gallery_video')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $message = 'Gallery video Setting has been updated';
        $block = 'gallery_video_bluebar';

        $newData = (object)[];
        $newData->size_web = $request->generic_gallery_video_title_size;
        $newData->color = $request->generic_gallery_video_title_color;
        $newData->bg_color = $request->generic_gallery_video_title_background;
        $newData->fontfamily = $request->generic_gallery_video_title_font_family?$request->generic_gallery_video_title_font_family:'0';
        update_text_details('generic_gallery_video_subtitle',$newData);

        $newData = (object)[];
        $newData->size_web = $request->generic_gallery_video_desc_size;
        $newData->color = $request->generic_gallery_video_desc_color;
        $newData->fontfamily = $request->generic_gallery_video_desc_font_family?$request->generic_gallery_video_desc_font_family:'0';
        update_text_details('generic_gallery_video_desc',$newData);

        $newData = galleriesSettings::find(1);
        // $newData->gallery_video_use_generic = $request->use_generic_gallery_video_setting?'1':'0';
        $newData->gallery_video_background = $request->gallery_video_back_color;
        $newData->gallery_video_size = $request->gallery_video_size;
        $newData->save();
        
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        if($request->save_generic_gallery_video_settings!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('galleries?block='.$block)->withSuccess($message);
        }
    }
    public function addVideoView(){
        if (!check_auth_permission('gallery_video_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['addresses'] = addresses::all();
        
        return view('admin.galleryvideo.add')->with($this->data);
    }
    public function saveVideo(Request $request){
        if (!check_auth_permission('gallery_video_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_slider_text' => 'required',
        ]);

        $message = 'Gallery video has been added successfully';
        $block = 'gallery_video_bluebar';

        $newData = new galleryVideo();
        if($_FILES['userfile']['name']!=''){
            $newData->video = uploadimg($_FILES['userfile'],null);
        }
        if($request->video_image){
            $newData->video_image = saveimagefromdataimage($request->video_image);
        }
        $newData->text = $request->gallery_slider_text;
        $newData->title_fontsize = $request->gallery_slider_text_fontsize?$request->gallery_slider_text_fontsize:'';
        $newData->text_color = $request->gallery_slider_text_color;
        $newData->back_color = $request->gallery_slider_text_background_color;
        $newData->font_family = $request->font_family?$request->font_family:'0';
        $newData->desc = $request->gallery_slider_desc;
        $newData->description_color = $request->gallery_video_description_color;
        $newData->desc_fontsize = $request->gallery_slider_desc_fontsize;
        $newData->font_family_desc = $request->font_family_desc?$request->font_family_desc:'0';
        $newData->video_auto_play = $request->video_auto_play?'1':'0';
        $newData->video_repeat = $request->video_repeat?'1':'0';
        $newData->desc_2 = $request->gallery_slider_desc_2;
        $newData->font_family_desc_2 = $request->font_family_desc_2?$request->font_family_desc_2:'0';
        $newData->desc_2_fontsize = $request->gallery_slider_desc_2_fontsize?$request->gallery_slider_desc_2_fontsize:'';
        $newData->description_2_color = $request->gallery_video_description_2_color;
        $newData->display_order = '999';
        
        $newData->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $newData->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $newData->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
       
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $newData->action_button_discription_color = $request->action_button_discription_color;
        $newData->action_button_bg_color = $request->action_button_bg_color;
        $newData->action_button_link = $request->action_button_link;
        $newData->action_button_link_text = $request->action_button_link_text;
        $newData->action_button_customform = $request->action_button_customform;
        $newData->event_form_id = $request->event_form_id;
        $newData->action_button_address_id = $request->action_button_address_id;
        $newData->action_button_map_address = $request->action_button_map_address;
        
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
            // dd($newData->popup_images);
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
            $newData->action_button_audio_icon_feature  = uploadimg($file,null);
        }

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


        $newData->read_more_content_color = $request->read_more_content_color;
        $newData->read_more_content_font_size = $request->read_more_content_font_size;
        $newData->read_more_content_font_family = $request->read_more_content_font_family;

        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function editVideoView(Request $request){
        if (!check_auth_permission('gallery_video_eidt_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['detail_info'] = galleryVideo::find($request->id);
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['addresses'] = addresses::all();
        
        return view('admin.galleryvideo.edit')->with($this->data);
    }
    public function updateVideo(Request $request){
        if (!check_auth_permission('gallery_video_eidt_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'gallery_slider_text' => 'required',
        ]);

        $message = 'Gallery video has been added successfully';
        $block = 'gallery_video_bluebar';

        $newData = galleryVideo::find($request->record_id);
        if($_FILES['userfile']['name']!=''){
            if(isset($newData->video )){
                delimg($newData->video );
            }
            $newData->video = uploadimg($_FILES['userfile'],null);
        }
        if($request->video_image){
            if(isset($newData->video_image )){
                delimg($newData->video_image );
            }
            $newData->video_image = saveimagefromdataimage($request->video_image);
        }
        $newData->text = $request->gallery_slider_text;
        $newData->title_fontsize = $request->gallery_slider_text_fontsize?$request->gallery_slider_text_fontsize:'';
        $newData->text_color = $request->gallery_slider_text_color;
        $newData->back_color = $request->gallery_slider_text_background_color;
        $newData->font_family = $request->font_family?$request->font_family:'0';
        $newData->desc = $request->gallery_slider_desc;
        $newData->description_color = $request->gallery_video_description_color;
        $newData->desc_fontsize = $request->gallery_slider_desc_fontsize;
        $newData->font_family_desc = $request->font_family_desc?$request->font_family_desc:'0';
        $newData->video_auto_play = $request->video_auto_play?'1':'0';
        $newData->video_repeat = $request->video_repeat?'1':'0';
        $newData->desc_2 = $request->gallery_slider_desc_2;
        $newData->font_family_desc_2 = $request->font_family_desc_2?$request->font_family_desc_2:'0';
        $newData->desc_2_fontsize = $request->gallery_slider_desc_2_fontsize?$request->gallery_slider_desc_2_fontsize:'';
        $newData->description_2_color = $request->gallery_video_description_2_color;
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        $newData->read_more_text = $request->read_more_text?$request->read_more_text:'';
        $newData->read_less_text = $request->read_less_text?$request->read_less_text:'';
        $newData->read_more_desc = $request->read_more_desc?$request->read_more_desc:'';
   
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->action_button_discription = $request->action_button_discription?$request->action_button_discription:'';
        $newData->action_button_discription_color = $request->action_button_discription_color;
        $newData->action_button_bg_color = $request->action_button_bg_color;
        $newData->action_button_link = $request->action_button_link;
        $newData->action_button_link_text = $request->action_button_link_text;
        $newData->action_button_customform = $request->action_button_customform;
        $newData->action_button_address_id = $request->action_button_address_id;
        $newData->action_button_map_address = $request->action_button_map_address;
        
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;
        
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
            $newData->action_button_audio_icon_feature  = uploadimg($file,null);
        }
        
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

        $newData->read_more_content_color = $request->read_more_content_color;
        $newData->read_more_content_font_size = $request->read_more_content_font_size;
        $newData->read_more_content_font_family = $request->read_more_content_font_family;

        if(isset($request->audio_file[0]))
        {
            $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $request->audio_file[0]->getClientMimeType())[1];
            $request->audio_file[0]->move("assets/uploads/".get_current_url(),$filename);
            $newData->action_button_action_audio = $filename;
        } else{
            $newData->action_button_action_audio = '';
        }

        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function deleteVideo(Request $request){
        if (!check_auth_permission('gallery_video_eidt_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $newData= galleryVideo::find($request->id);
        if(isset($newData->video_image )){
            delimg($newData->video_image );
        }
        if(isset($newData->video )){
            delimg($newData->video );
        }
        $this->data['detail_info'] = galleryVideo::find($request->id)->delete();
        $message = 'Gallery video has been deleted successfully';
        $block = 'gallery_video_bluebar';
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }

    public function delvideoimage(Request $request){
       
        $galleryvideo = galleryVideo::find($request->imgid);
        if($galleryvideo){
            delimg($galleryvideo->video_image);
            $galleryvideo->video_image=null;
            $galleryvideo->save();
            print_r($galleryvideo);
               
        }    
    }
    
    public function saveGenericTileSettings(Request $request){
        if (!check_auth_permission('gallery_tiles')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $message = 'Gallery tiles Setting has been updated';
        $block = 'gallery_tiles_bluebar';

        $newData = galleriesSettings::find(1);
        $newData->gallery_tiles_use_generic = $request->use_generic_gallery_tiles_settings?'1':'0';
        $newData->gallery_tiles_background = $request->gallery_tiles_background_color;
        $newData->save();

        $newData = (object)[];
        $newData->text = $request->gallery_tiles_subtitle;
        $newData->size_web = $request->gallery_tiles_subtitle_size;
        $newData->color = $request->gallery_tiles_subtitle_color;
        $newData->fontfamily = $request->gallery_tiles_subtitle_font?$request->gallery_tiles_subtitle_font:'0';
        update_text_details('gallery_tiles_subtitle',$newData);

        
        $newData = (object)[];
        $newData->size_web = $request->generic_gallery_tiles_desc_size;
        $newData->size_mobile = $request->generic_gallery_tiles_desc_size_mobile;
        $newData->color = $request->generic_gallery_tiles_desc_color;
        $newData->fontfamily = $request->generic_gallery_tiles_desc_font?$request->generic_gallery_tiles_desc_font:'0';
        update_text_details('generic_gallery_tiles_text',$newData);


        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        if($request->saveGalleryTilesSetting!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('galleries?block='.$block)->withSuccess($message);
        }
    }
    public function addTileView(){
        if (!check_auth_permission('gallery_tile_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        
        return view('admin.gallerytile.add')->with($this->data);
    }
    public function saveTile(Request $request){
        if (!check_auth_permission('gallery_tile_add_new')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'description' => 'required',
        ]);

        $message = 'Gallery tiles has been added successfully';
        $block = 'gallery_tiles_bluebar';

        $newData = new galleryTiles();
        if($request->tile_image){
            $newData->image = saveimagefromdataimage($request->tile_image);
        }else{
            $newData->image = '';
        }
        $newData->description = $request->description;
        $newData->description_color = $request->description_color?$request->description_color:'';
        $newData->description_size = $request->description_size?$request->description_size:'';
        $newData->description_font = $request->description_font?$request->description_font:'0';
        $newData->enable_timed_image = '0';
        $newData->timed_image = '';
        $newData->timed_image_duration = '0';
        $newData->display_order = '999';
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function editTileView(Request $request){
        if (!check_auth_permission('gallery_tile_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['detail_info'] = galleryTiles::find($request->id);
        
        return view('admin.gallerytile.edit')->with($this->data);
    }
    public function updateTile(Request $request){
        if (!check_auth_permission('gallery_tile_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'description' => 'required',
        ]);

        $message = 'Gallery tiles has been added successfully';
        $block = 'gallery_tiles_bluebar';

        $newData = galleryTiles::find($request->record_id);
        if($request->tile_image){
            if(isset($newData->image )){
                delimg($newData->image );
            }
            $newData->image = saveimagefromdataimage($request->tile_image);
        }
        $newData->description = $request->description;
        $newData->description_color = $request->description_color?$request->description_color:'';
        $newData->description_size = $request->description_size?$request->description_size:'';
        $newData->description_font = $request->description_font?$request->description_font:'0';
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function deleteTile(Request $request){
        if (!check_auth_permission('gallery_tile_edit_delete')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $newData=galleryTiles::find($request->id);
        if(isset($newData->image )){
            delimg($newData->image );
        }
        $this->data['detail_info'] = galleryTiles::find($request->id)->delete();
        $message = 'Gallery tiles has been deleted successfully';
        $block = 'gallery_tiles_bluebar';
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }


    
    public function addCategoryView(){
        if (!check_auth_permission('image_gallery_category')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        
        return view('admin.gallerycategory.add')->with($this->data);
    }
    public function saveCategory(Request $request){
        if (!check_auth_permission('image_gallery_category')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'name' => 'required',
        ]);

        $message = 'Gallery category has been added successfully';
        $block = 'image_gallery_categories';

        $newData = new ImageGalleryCategory();
        $newData->name = $request->name;
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function editCategoryView(Request $request){
        if (!check_auth_permission('image_gallery_category')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['galleriesSettings'] = galleriesSettings::first();
        $this->data['detail_info'] = ImageGalleryCategory::find($request->id);
        
        return view('admin.gallerycategory.edit')->with($this->data);
    }
    public function updateCategory(Request $request){
        $notificationSettings = NotificationSettings::first();

        $request->validate([
            'name' => 'required',
        ]);

        $message = 'Gallery category has been added successfully';
        $block = 'image_gallery_categories';

        $newData = ImageGalleryCategory::find($request->record_id);
        $newData->name = $request->name;
        $newData->save();

        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }
    public function deleteCategory(Request $request){
        if (!check_auth_permission('image_gallery_category')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['detail_info'] = ImageGalleryCategory::find($request->id)->delete();
        $message = 'Gallery category has been deleted successfully';
        $block = 'image_gallery_categories';
        checkSendNotification('Galleries has been updated',$message,'galleries_notifications','galleries_notification_email');

        return redirect('galleries?block='.$block)->withSuccess($message);
    }

    public function updateGallerySliderNewPostsTop(Request $request){
        $gallery_settings= galleriesSettings::find(1);
        $gallery_settings->gallery_slider_new_posts_top = $request->value ? '1':'0';
        $gallery_settings->save();

    }
}
