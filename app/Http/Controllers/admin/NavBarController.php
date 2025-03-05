<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\navBarItems;
use App\Models\navBarSettings;
use App\Models\NotificationSettings;

use Illuminate\Http\Request;

class NavBarController extends Controller
{
    public function update(Request $request)
    {
       
        $newData = navBarSettings::find(1);
        // $newData->enable = $request->nav_bar_enable?'1':'0';
        $newData->stick_to_top = $request->nav_bar_stick_to_top ? '1' : '0';
        $newData->text_color = $request->nav_bar_text_color;
        $newData->font_family = $request->nav_bar_font_family;
        $newData->enable_banner = $request->nav_bar_enable_banner ? '1' : '0';
        $newData->banner_color = $request->nav_bar_banner_color;
        $newData->reset_button_text_color_enable = $request->reset_button_text_color_enable ? '1' : '0';
        $newData->reset_button_text_color = $request->reset_button_text_color;
        $newData->save();

        if (isset($request->nav_bar_item)) {
            foreach ($request->nav_bar_item as $item) {
                $newData = navBarItems::find($item);
                if (isset($request->popup_action_images[$item])) {
                    $newData->popup_images = saveActionButtonImages($request->popup_action_images[$item]);
                }
                $newData->enable = isset($request->nav_bar_btn_enable[$item]) ? '1' : '0';
                $newData->use_default_text_color = isset($request->nav_bar_use_default_text_color[$item]) ? '1' : '0';
                $newData->enable_banner = isset($request->nav_bar_items_enable_banner[$item]) ? '1' : '0';
                $newData->text = $request->nav_bar_btn_text[$item];
                if ($request->reset_button_text_color_enable) {
                    $newData->color = $request->reset_button_text_color;
                } else {
                    $newData->color = $request->nav_bar_btn_text_color[$item];
                }

                if (is_numeric($request->section[$item])) {
                    $newData->section = $request->section[$item];
                    $newData->link_type =  '';
                } else {
                    $newData->section = '0';
                    $newData->link_type =  $request->section[$item];
                }
              
                $newData->link_url = $request->link_url[$item];
                $newData->map_address = $request->map_address[$item];
                $newData->address_id = isset($request->address_id[$item]) ? $request->address_id[$item] : '0';
                $newData->custom_form = $request->custom_form[$item];
                $newData->phone_no_call = $request->action_button_phone_no_calls[$item];
                $newData->phone_no_sms = $request->action_button_phone_no_sms[$item];
                $newData->email = $request->action_button_action_email[$item];

                $newData->action_button_textpopup = $request->action_button_textpopup[$item];
                // if(isset($request->audio_file[$item]))
                // {
                //     $newData->action_button_audio = $request->audio_file[$item];
                // }

                if (isset($request->audio_file[$item])) {
                    $file = $request->audio_file[$item];
                    $file_name = $file->getClientOriginalName();
        
                    $file_ext = $file->extension();
                    $fileInfo = $request->audio_file[$item]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $newData->action_button_audio = uploadimg($file, null);
                }

                if (isset($request->navbar_action_video[$item])) {
                    $file = $request->navbar_action_video[$item];
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->extension();
                    $fileInfo = $request->navbar_action_video[$item]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $newData->action_button_video  = uploadimg($file, null);
                }
                $newData->save();
            }
        }

        $message = 'Navbar has been updated successfully';
        checkSendNotification('Settings has been updated', $message, 'settings_notifications', 'settings_notification_email');
        return  redirect('settings?block=nav_bar_bluebar')->withSuccess($message);
    }
    public function savenavbarenable(Request $request)
    {
        $newData = navBarSettings::find(1);
        $newData->enable = $request->nav_bar_enable == 'true' ? '1' : '0';
        $newData->save();
    }
}
