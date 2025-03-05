<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontSections;
use App\Models\customForms;
use App\Models\addresses;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use App\Models\menu;

class MenuController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'menu';
        $this->data['controller_name'] = 'Menu';
        $this->data['font_family'] = get_font_family();
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
    }
    
    public function addMenu(){
        $this->data['custom_forms'] = customForms::all();
        $this->data['addresses'] = addresses::get();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        return view('admin.menu.add')->with($this->data);
    }
    public function add(Request $request){
        
        $request->validate([
            'name' => 'required'
        ]);
        
        $newData = new menu();
        $newData->name = $request->name;
        $newData->menu_order = 0;
        if(is_numeric($request->section)){
            $newData->section = $request->section;
            $newData->link_type =  '';
        }else{
            $newData->section = '0';
            $newData->link_type =  $request->section;
        }
        $newData->link_url = $request->link_url?$request->link_url:'';  
        $newData->address_id = $request->address_id?$request->address_id:'0';
        $newData->custom_form = $request->custom_form?$request->custom_form:'';
        $newData->map_address = $request->map_address?$request->map_address:'';
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls?$request->action_button_phone_no_calls:'';
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms?$request->action_button_phone_no_sms:'';
        $newData->action_button_action_email = $request->action_button_action_email?$request->action_button_action_email:'';
        $newData->action_button_textpopup = $request->action_button_textpopup?$request->action_button_textpopup:'';
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
        $newData->save();
        
        $message = 'Menu has been added successfully';
        checkSendNotification('Settings  has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message); 
    }
    public function editMenu(Request $request){
        $this->data['custom_forms'] = customForms::all();
        $this->data['addresses'] = addresses::get();
        $this->data['detail_info'] = menu::find($request->id);
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        return view('admin.menu.edit')->with($this->data);
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        
        $newData = menu::find($request->id);
        $newData->name = $request->name;
        if(is_numeric($request->section)){
            $newData->section = $request->section;
            $newData->link_type =  '';
        }else{
            $newData->section = '0';
            $newData->link_type =  $request->section;
        }
        $newData->link_url = $request->link_url?$request->link_url:'';  
        $newData->address_id = $request->address_id?$request->address_id:'0';
        $newData->custom_form = $request->custom_form?$request->custom_form:'';
        $newData->map_address = $request->map_address?$request->map_address:'';
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls?$request->action_button_phone_no_calls:'';
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms?$request->action_button_phone_no_sms:'';
        $newData->action_button_action_email = $request->action_button_action_email?$request->action_button_action_email:'';
        $newData->action_button_textpopup = $request->action_button_textpopup?$request->action_button_textpopup:'';
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
        $newData->save();

        $message = 'Menu has been updated successfully';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message); 
    }
    public function delete(Request $request){
        $newData = menu::find($request->id)->delete();

        $message = 'Menu has been deleted successfully';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message); 
    }

    public function disableMenu(Request $request){
        $newData = menu::find($request->id)->update(['menu_enable' => '0']);

        $message = 'Menu has been disabled successfully';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message); 
    }

    public function enableMenu(Request $request){
        $newData = menu::find($request->id)->update(['menu_enable' => '1']);

        $message = 'Menu has been enabled successfully';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message); 
    }

    public function saveMenuOrder(Request $request){
        $order = trim($request->order,',');
        $order = explode(',',$order);
        $i = 0;
        foreach($order as $single){
            menu::where(array('id'=>$single))->update(array('menu_order'=>$i));
            $i++;  
        }
        $message = 'Menu order has been updated ';
        checkSendNotification('Settings has been updated',$message,'settings_notifications','settings_notification_email');
        return  redirect('settings?block=pulldown_menu_bluebar')->withSuccess($message." successfully"); 
    }
}
