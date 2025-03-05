<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blogCategories;
use App\Models\Blog;
use App\Models\NotificationSettings;
use App\Models\blogSettings;
use App\Models\addresses;
use App\Models\ImageGalleryCategory;
use App\Models\frontSections;
use App\Models\customForms;
use App\Models\alertPopupSetting;

class BlogController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'blog';
        $this->data['controller_name'] = 'Blog';
        $this->data['font_family'] = get_font_family();
        $this->data['blogSettings'] = blogSettings::first();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
       
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['blogcategory'] = blogCategories::get();
        $this->data['addresses'] = addresses::get();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
    }

    public function index(){
        if(!check_auth_permission(['blog', 'blog-category'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['blogs'] = Blog::get();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        updateTimedImages();
        $this->data['generic_blog_title'] = get_text_details('generic_blog_title');
        $this->data['blog_desc'] = get_text_details('blog_desc');
        $this->data['blog_cate'] = get_text_details('blog_cate');
        $this->data['blog_date'] = get_text_details('blog_date');
        $this->data['blog_title'] = get_text_details('blog_title');
        $this->data['blog_instruction_details'] = get_text_details('blog_instruction');
        $this->data['blog_page_instruction_details'] = get_text_details('blog_page_instruction');
        
        return view('admin.blog')->with($this->data);
    }
    public function blogSaveGeneric(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $newData = blogSettings::find(1);
        $newData->use_generic = $request->use_generic_blog_settings?'1':'0';
        $newData->read_more_button_color = $request->read_more_button_color;
        $newData->read_more_button_bg_color = $request->read_more_button_bg_color;
        $newData->bg_color = $request->bg_color;
        $newData->override_bg = $request->override_bg == 'on' ? '1':'0' ;
        $newData->save();
        
        $newData = (object)[];
        $newData->color = $request->blog_title_color;
        $newData->fontfamily = $request->blog_title_font?$request->blog_title_font:'0';
        update_text_details('generic_blog_title',$newData);

        $newData = (object)[];
        $newData->color = $request->blog_desc_color;
        $newData->fontfamily = $request->blog_desc_font?$request->blog_desc_font:'0';
        update_text_details('blog_desc',$newData);
        
        $newData = (object)[];
        $newData->color = $request->blog_cate_color;
        $newData->fontfamily = $request->blog_cate_font?$request->blog_cate_font:'0';
        update_text_details('blog_cate',$newData);

        $newData = (object)[];
        $newData->color = $request->blog_date_color;
        $newData->fontfamily = $request->blog_date_font?$request->blog_date_font:'0';
        update_text_details('blog_date',$newData);

        $message = 'Blog settings  has been added successfully';

        checkSendNotification('Blog has been updated',$message,'blog_notifications','blog_notification_email');

        return  redirect('blog?block=blog_list')->withSuccess($message); 
    }

    public function blogSaveSeting(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        if($request->blog_header_img){
            $newData = blogSettings::find(1);
            if($newData->blog_header_img){
                delimg($newData->blog_header_img);
            }
            $newData->blog_header_img = saveimagefromdataimage($request->blog_header_img);
            $newData->save();
        }
        
        $newData = (object)[];
        $newData->text = $request->blog_instruction;
        $newData->size_web = $request->blog_instructions_size_web;
        $newData->size_mobile = $request->blog_instructions_size_mobile;
        $newData->color = $request->blog_instructions_color;
        $newData->fontfamily = $request->blog_instructions_font?$request->blog_instructions_font:'0';
        update_text_details('blog_instruction',$newData);
        
        $newData = (object)[];
        $newData->text = $request->blog_page_instruction;
        $newData->size_web = $request->blog_page_instructions_size_web;
        $newData->size_mobile = $request->blog_page_instructions_size_mobile;
        $newData->color = $request->blog_page_instructions_color;
        $newData->fontfamily = $request->blog_page_instructions_font?$request->blog_page_instructions_font:'0';
        update_text_details('blog_page_instruction',$newData);
        
        $message = 'Blog settings has been added successfully';
        checkSendNotification('Blog has been updated',$message,'blog_notifications','blog_notification_email');

        return  redirect('blog?block=blog_list')->withSuccess($message); 
    }

    public function addBlogView(){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        return view('admin.blog.add')->with($this->data);
    }
    public function add(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $request->validate([
            'title' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        
        $newData = new Blog();
        $newData->title = $request->title;
        $newData->slug = sanitize($request->title);
        $newData->category = $request->category;
        $newData->keywords = $request->keywords;
        $newData->meta_desc = $request->meta_desc;
        $newData->short_desc = $request->short_desc;
        
        if($request->userfile){
            $newData->image = saveimagefromdataimage($request->userfile);
        }else{
            $newData->image = '';
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        $newData->description = $request->description;
        $newData->title_color = $request->title_color;
        $newData->title_font = isset($request->title_font)?$request->title_font:'0';
        $newData->desc_color = $request->desc_color;
        $newData->desc_font = isset($request->desc_font)?$request->desc_font:'0';
        $newData->category_color = $request->category_color;
        $newData->date_color = $request->date_color;
        $newData->date_font = isset($request->date_font)?$request->date_font:'0';
        $newData->btn_text = isset($request->btn_text)?$request->btn_text:'';
        $newData->btn_link = isset($request->btn_link)?$request->btn_link:'';
        $newData->btn_text_color = $request->btn_text_color;
        $newData->btn_bg = $request->btn_bg;
        $newData->btn_text_font = isset($request->btn_text_font)?$request->btn_text_font:'0';
        $newData->category_font = isset($request->category_font)?$request->category_font:'0';
        $newData->read_more_button_color = $request->read_more_button_color;
        $newData->read_more_button_bg_color = $request->read_more_button_bg_color;
        
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->action_button_link_text = $request->action_button_link_text?$request->action_button_link_text:'';
        $newData->action_button_customform = $request->action_button_customform?$request->action_button_customform:'0';
        $newData->action_button_eventform = $request->action_button_eventform?$request->action_button_eventform:'0';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'0';
        $newData->action_button_map_address = $request->action_button_map_address?$request->action_button_map_address:'';
       
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
            $newData->action_button_video  = uploadimg($file,null);
        }
        
        $newData->save();

        $message = 'Blog has been added successfully';
        checkSendNotification('Blog has been updated',$message,'blog_notifications','blog_notification_email');

        return  redirect('blog?block=blog_list')->withSuccess($message); 
    }

    public function editBlogView(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $this->data['record_id'] = $request->id;
        $data = Blog::find($request->id);
        
        if(!$data){
            return redirect('blog?block=blog_list')->withError('Data not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.blog.edit')->with($this->data);
    }

    public function update(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $request->validate([
            'title' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
            'short_desc' => 'required',
            'description' => 'required',
        ]);
        
        $newData = Blog::find($request->id);
        $newData->title = $request->title;
        $newData->slug = sanitize($request->title);
        $newData->category = $request->category;
        $newData->keywords = $request->keywords;
        $newData->meta_desc = $request->meta_desc;
        $newData->short_desc = $request->short_desc;
        
        if($request->userfile){
            if($newData->image){
                delimg($newData->image);
            }
            $newData->image = saveimagefromdataimage($request->userfile);
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        $newData->description = $request->description;
        $newData->title_color = $request->title_color;
        $newData->title_font = isset($request->title_font)?$request->title_font:'0';
        $newData->desc_color = $request->desc_color;
        $newData->desc_font = isset($request->desc_font)?$request->desc_font:'0';
        $newData->category_color = $request->category_color;
        $newData->date_color = $request->date_color;
        $newData->date_font = isset($request->date_font)?$request->date_font:'0';
        $newData->btn_text = isset($request->btn_text)?$request->btn_text:'';
        $newData->btn_link = isset($request->btn_link)?$request->btn_link:'';
        $newData->btn_text_color = $request->btn_text_color;
        $newData->btn_bg = $request->btn_bg;
        $newData->read_more_button_color = $request->read_more_button_color;
        $newData->read_more_button_bg_color = $request->read_more_button_bg_color;

        $newData->btn_text_font = isset($request->btn_text_font)?$request->btn_text_font:'0';
        $newData->category_font = isset($request->category_font)?$request->category_font:'0';
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->action_button_link_text = $request->action_button_link_text?$request->action_button_link_text:'';
        $newData->action_button_customform = $request->action_button_customform?$request->action_button_customform:'0';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'0';
        $newData->action_button_map_address = $request->action_button_map_address?$request->action_button_map_address:'';
       
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;
        $newData->action_button_eventform = $request->action_button_eventform?$request->action_button_eventform:null;

        if(isset($request->audio_file[0]))
        {
            $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $request->audio_file[0]->getClientMimeType())[1];
            $request->audio_file[0]->move("assets/uploads/".get_current_url(),$filename);
            $newData->action_button_action_audio = $filename;
        } else{
            $newData->action_button_action_audio = '';
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
            $newData->action_button_video  = uploadimg($file,null);
        }
        
        $newData->save();

        $message = 'Blog has been updated successfully';
        checkSendNotification('Blog has been updated',$message,'blog_notifications','blog_notification_email');

        return  redirect('blog?block=blog_list')->withSuccess($message); 
    }

    public function delete(Request $request){
        if(!check_auth_permission(['blog'])){
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        $data = Blog::find($request->id);
        if(!$data){
            return redirect('blog?block=blog_list')->withError('Data not found');
        }
        Blog::where('id',$data->id)->delete();
        $message = 'Blog has been deleted successfully';
        checkSendNotification('Blog has been updated',$message,'blog_notifications','blog_notification_email');

        return redirect('blog?block=blog_list')->withSuccess($message);
    }
}
