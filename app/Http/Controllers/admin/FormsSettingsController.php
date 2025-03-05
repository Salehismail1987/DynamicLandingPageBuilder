<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\images;
use App\Models\customFormsSettings;

use App\Models\ImageGalleryCategory;
class FormsSettingsController extends Controller
{

    
    public function saveFormSettings(Request $request){
        $message = 'Forms settings has been updated successfully';
        $block = 'custom_forms_settings';

        
            $data = (object)[];
			$data->size_web = $request->form_title_size_web;
			$data->size_mobile = $request->form_title_size_mobile;
			$data->color = $request->form_title_color;
			$data->fontfamily = $request->form_title_font;
            update_text_details('form_title',$data);

            $data = (object)[];
			$data->size_web = $request->form_subtitle_size_web;
			$data->size_mobile = $request->form_subtitle_size_mobile;
			$data->color = $request->form_subtitle_color;
			$data->fontfamily = $request->form_subtitle_font;
            update_text_details('form_subtitle',$data);

            $data = (object)[];
			$data->size_web = $request->form_descriptive_size_web;
			$data->size_mobile = $request->form_descriptive_size_mobile;
			$data->color = $request->form_descriptive_color;
			$data->fontfamily = $request->form_descriptive_font;
            update_text_details('form_descriptive_text',$data);

			
            $data = (object)[];
			$data->size_web = $request->form_footer_text_1_size_web;
			$data->size_mobile = $request->form_footer_text_1_size_mobile;
			$data->color = $request->form_footer_text_1_color;
			$data->fontfamily = $request->form_footer_text_1_font;
            update_text_details('custom_form_footer_text_1',$data);
			
            $data = (object)[];
			$data->size_web = $request->form_footer_text_2_size_web;
			$data->size_mobile = $request->form_footer_text_2_size_mobile;
			$data->color = $request->form_footer_text_2_color;
			$data->fontfamily = $request->form_footer_text_2_font;
            update_text_details('custom_form_footer_text_2',$data);

            $data = customFormsSettings::find(1);
            $data->form_multiple_emails = $request->form_multiple_emails?$request->form_multiple_emails:'';
            $data->location = (isset($request->location) && $request->location === 'on') ? true : false;

            $data->save();

        $remaning_img = array();
        $i = 0;
        $form_logo = images::where('slug','custom_form_logo')->first();
        if(isJson($form_logo->file_name)){
            $image = json_decode($form_logo->file_name);
            foreach($image as $single){
                    $remaning_img[] = array('img'=>$single->img,'desc'=>$request->description[$i]); 
                    $i++;
            }
        }
        if($request->userfile && is_array($request->userfile) && count($request->userfile)>0){
            foreach($request->userfile as $single){
                if($single){
                    $remaning_img[] = array('img'=>saveimagefromdataimage($single),'desc'=>$request->description[$i]);
                }
                $i++;
            }
        }
        $form_logo->file_name = json_encode($remaning_img);
        $form_logo->max_width = $request->maxwidth;
        $form_logo->save();

        return redirect('forms?block='.$block)->withSuccess($message);
    }
}
