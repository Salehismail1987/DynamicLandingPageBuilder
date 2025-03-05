<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FontFamily;
use App\Models\NotificationSettings;
use App\Models\textDetails;
use App\Models\addresses;
use App\Models\customForms;
use App\Models\actionButtons;
use App\Models\ImageGalleryCategory;
use App\Models\frontSections;
use App\Models\alertPopupSetting;
use App\Models\images;
use App\Models\timedImagesSetting;
use App\Models\oneStepImages;
use App\Models\newsFeedSetting;
use App\Models\newsFeed;
use App\Models\ContactInfo;
use App\Models\ContactGroup;
use App\Models\EmailList;
use App\Models\socialMedia;
use App\Models\ContactGroupEmail;
use App\Models\CrmSetting;
use App\Models\BusinessInfo;


class NewsFeedController extends Controller
{
    //
    public function __construct(){
        $this->data['controller'] = 'newsfeed';
        $this->data['controller_name'] = 'News Feed';
        $this->data['business_infos'] = BusinessInfo::first();
        $newsFeedSetting = newsFeedSetting::first();
        $this->data['contact_info'] = ContactInfo::whereNotNull('contact_name')->first();
        $this->data['newsFeedSetting'] = $newsFeedSetting;
        $this->data['is_generic_setting_on']  = $newsFeedSetting->use_generic_newsfeed_setting;
        $this->data['font_family'] = get_font_family();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['socialMedia'] = socialMedia::all();
        $this->data['addresses'] = addresses::get();
        $this->data['custom_forms']  = customForms::orderBy('title','ASC')->get();
        $this->data['all_categories'] = ImageGalleryCategory::all(); 
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
    }
    
    public function addview()
    {
        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        return view('admin.newsfeed.add',$this->data);
    }  

    public function create(Request $request)
    {  
        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $request->validate([
            'desc_text' => 'required',
        ]);
        
        $newData = new newsFeed();
        $newData->subtitle_text = $request->subtitle_text?$request->subtitle_text:'';
        $newData->subtitle_font_size_web = $request->subtitle_font_size_web?$request->subtitle_font_size_web:'';
        $newData->subtitle_font_size_mobile = $request->subtitle_font_size_mobile?$request->subtitle_font_size_mobile:'';
        $newData->subtitle_text_color = $request->subtitle_text_color?$request->subtitle_text_color:'';
        $newData->subtitle_font_family = $request->subtitle_font_family?$request->subtitle_font_family:0;

        $newData->desc_text = $request->desc_text?$request->desc_text:'';
        $newData->desc_font_size_web = $request->desc_font_size_web?$request->desc_font_size_web:'';
        $newData->desc_font_size_mobile = $request->desc_font_size_mobile?$request->desc_font_size_mobile:'';
        $newData->desc_text_color = $request->desc_text_color?$request->desc_text_color:'';
        $newData->desc_font_family = $request->desc_font_family?$request->desc_font_family:0;

        $newData->btn_section = $request->btnsection?$request->btnsection:'';
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->btn_link = $request->btn_link?$request->btn_link:'';
        $newData->btn_form = $request->btnform?$request->btnform:'';
        $newData->event_form_id = $request->event_form_id?$request->event_form_id:'';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'';
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

        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;

        $newData->btn_text = $request->btn_text?$request->btn_text:'';
        $newData->btn_text_color = $request->btn_text_color?$request->btn_text_color:'';
        $newData->btn_bg = $request->btn_bg?$request->btn_bg:'';
        $newData->btn_text_font = $request->btn_text_font?$request->btn_text_font:0;

        
        if($request->tile_image){
            $newData->feed_image = saveimagefromdataimage($request->tile_image);
        }else{
            $newData->feed_image = '';
        }


        $newData->link_social_media_icons = $request->link_social_media_icons?'1':'0';
        
       
        $newData->update_dates_on_saving = $request->update_dates_on_saving?'1':'0';
        $newData->newsfeed_date = date("Y-m-d H:i:s");
        $newData->save();
         
        $message = 'Newsfeed has been created';
        $block = 'news_posts_bluebar';

        checkSendNotification('Newsfeed has been updated',$message);
        
        return  redirect('quicksettings')->withSuccess($this->data['controller_name'].' has been added successfully'); 
    }

    public function editview(Request $request){

        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $data = newsFeed::find($request->id);
        
        if(!$data){
            return redirect('quicksettings?block=newsfeed_bluebar')->withError($this->data['controller_name'].' not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.newsfeed.edit',$this->data);

    }

    public function update(Request $request){

        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $newData = newsFeed::find($request->id);
        
        if(!$newData){
            return redirect('quicksettings?block=newsfeed_bluebar')->withError($this->data['controller_name'].' not found');
        }
        $update_data = [
            'desc_text' => 'required',
        ];
        $newData->subtitle_text = $request->subtitle_text?$request->subtitle_text:'';
        $newData->subtitle_font_size_web = $request->subtitle_font_size_web?$request->subtitle_font_size_web:'';
        $newData->subtitle_font_size_mobile = $request->subtitle_font_size_mobile?$request->subtitle_font_size_mobile:'';
        $newData->subtitle_text_color = $request->subtitle_text_color?$request->subtitle_text_color:'';
        $newData->subtitle_font_family = $request->subtitle_font_family?$request->subtitle_font_family:0;

        $newData->desc_text = $request->desc_text?$request->desc_text:'';
        $newData->desc_font_size_web = $request->desc_font_size_web?$request->desc_font_size_web:'';
        $newData->desc_font_size_mobile = $request->desc_font_size_mobile?$request->desc_font_size_mobile:'';
        $newData->desc_text_color = $request->desc_text_color?$request->desc_text_color:'';
        $newData->desc_font_family = $request->desc_font_family?$request->desc_font_family:0;
        $newData->btn_section = $request->btnsection?$request->btnsection:'';
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->btn_link = $request->btn_link?$request->btn_link:'';
        $newData->btn_form = $request->btnform?$request->btnform:'';
        $newData->event_form_id = $request->event_form_id?$request->event_form_id:'';
        $newData->btn_map_address = $request->btn_map_address?$request->btn_map_address:'';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'';
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

        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;

        $newData->btn_text = $request->btn_text?$request->btn_text:'';
        $newData->btn_text_color = $request->btn_text_color?$request->btn_text_color:'';
        $newData->btn_bg = $request->btn_bg?$request->btn_bg:'';
        $newData->btn_text_font = $request->btn_text_font?$request->btn_text_font:0;
        if(isset($request->audio_file[0]))
        {
            $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $request->audio_file[0]->getClientMimeType())[1];
            $request->audio_file[0]->move("assets/uploads/".get_current_url(),$filename);
            $newData->action_button_action_audio = $filename;
        } else{
            $newData->action_button_action_audio = '';
        }
        
        if($request->tile_image){
            if($newData->feed_image){
                delimg($newData->feed_image);
            }
            $newData->feed_image = saveimagefromdataimage($request->tile_image);
        }


        $newData->link_social_media_icons = $request->link_social_media_icons?'1':'0';
        $newData->update_dates_on_saving = $request->update_dates_on_saving?'1':'0';
        if($request->update_dates_on_saving){
            $newData->newsfeed_date = date("Y-m-d H:i:s");
        }
        // dd($newData);
        $newData->save();

        $message = 'Newsfeed has been updated';
        $block = 'news_posts_bluebar';
        checkSendNotification('Newsfeed has been updated',$message);
        return redirect('quicksettings')->withSuccess($this->data['controller_name'].' updated');
    }

    public function duplicateview(Request $request){

        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $data = newsFeed::find($request->id);
        
        if(!$data){
            return redirect('quicksettings?block=newsfeed_bluebar')->withError($this->data['controller_name'].' not found');
        }
       
        $this->data['detail_info'] = $data;
        return view('admin.newsfeed.edit',$this->data);

    }

    public function duplicate(Request $request){

        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $newData = newsFeed::find($request->id);
        
        if(!$newData){
            return redirect('quicksettings?block=newsfeed_bluebar')->withError($this->data['controller_name'].' not found');
        }
        $update_data = [
            'desc_text' => 'required',
        ];

        $newData->subtitle_text = $request->subtitle_text?$request->subtitle_text:'';
        $newData->subtitle_font_size_web = $request->subtitle_font_size_web?$request->subtitle_font_size_web:'';
        $newData->subtitle_font_size_mobile = $request->subtitle_font_size_mobile?$request->subtitle_font_size_mobile:'';
        $newData->subtitle_text_color = $request->subtitle_text_color?$request->subtitle_text_color:'';
        $newData->subtitle_font_family = $request->subtitle_font_family?$request->subtitle_font_family:0;

        $newData->desc_text = $request->desc_text?$request->desc_text:'';
        $newData->desc_font_size_web = $request->desc_font_size_web?$request->desc_font_size_web:'';
        $newData->desc_font_size_mobile = $request->desc_font_size_mobile?$request->desc_font_size_mobile:'';
        $newData->desc_text_color = $request->desc_text_color?$request->desc_text_color:'';
        $newData->desc_font_family = $request->desc_font_family?$request->desc_font_family:0;

        $newData->btn_section = $request->btnsection?$request->btnsection:'';
        $newData->action_button_active = $request->action_button_active?'1':'0';
        $newData->btn_link = $request->btn_link?$request->btn_link:'';
        $newData->btn_form = $request->btnform?$request->btnform:'';
        $newData->btn_map_address = $request->btn_map_address?$request->btn_map_address:'';
        $newData->action_button_address_id = $request->action_button_address_id?$request->action_button_address_id:'';
        
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
        
        $newData->action_button_textpopup = $request->action_button_textpopup;
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms;
        $newData->action_button_action_email = $request->action_button_action_email;
        
        $newData->btn_text = $request->btn_text?$request->btn_text:'';
        $newData->btn_text_color = $request->btn_text_color?$request->btn_text_color:'';
        $newData->btn_bg = $request->btn_bg?$request->btn_bg:'';
        $newData->btn_text_font = $request->btn_text_font?$request->btn_text_font:0;

        
        if($request->tile_image){
            $newData->feed_image = saveimagefromdataimage($request->tile_image);
        }


        $newData->link_social_media_icons = $request->link_social_media_icons?'1':'0';
        $newData->update_dates_on_saving = $request->update_dates_on_saving?'1':'0';
        
        if($request->update_dates_on_saving){
            $newData->newsfeed_date = date("Y-m-d H:i:s");
       
        }

        $newData->save();

        return redirect('quicksettings')->withSuccess($this->data['controller_name'].' updated');
    }
    public function delete(Request $request){
        
        if (!check_auth_permission('news_feed') ) {
            return  redirect('quicksettings')->withError('Access Denied'); 
        }
        $data = newsFeed::find($request->id);
        
        if(!$data){
            return redirect('quicksettings?block=newsfeed_bluebar')->withError($this->data['controller_name'].' not found');
        }

        newsFeed::where('id',$data->id)->delete();
        delimg($data->feed_image);
        return redirect('quicksettings?block=newsfeed_bluebar')->withSuccess($this->data['controller_name'].' deleted');
    }

    public function get_feed_data_ajax( Request $request){

        $newsfeed_teaser_title = get_text_details('newsfeed_teaser_title');
        $generic_newsfeed_title = get_text_details('generic_newsfeed_title');
        $generic_newsfeed_desc = get_text_details('generic_newsfeed_desc');
        $newsFeedSetting = newsFeedSetting::first();
        
		//$total = NewsFeed::count();
		$per_page = 5;
        
        $page = $request->page;
    	
		$start=$page * $per_page;

		$news_feeds = NewsFeed::orderBy('display_order', 'ASC')->offset($start)->limit($per_page)->get();
		
		if(count($news_feeds)<1){
			echo "";
			exit;
		}

		$html = '';
		
    
        foreach($news_feeds as $single){
                      
            if ($newsFeedSetting->use_generic_newsfeed_setting) {
                $desc_size_class = "newsfeed-desc-size_generic";
                $title_size_class = "title_size_class_generic";
                $newsfeed_title_font_family = 'font-family:' . ($generic_newsfeed_title->fontfamily ? getfontfamily($generic_newsfeed_title->fontfamily) . ';' : ';');
                $newsfeed_title_color = 'color:' . ($generic_newsfeed_title->color ? $generic_newsfeed_title->color . ';' : '#000;');
                $newsfeed_text_font_family = 'font-family:' . ($generic_newsfeed_desc->fontfamily ? getfontfamily($generic_newsfeed_desc->fontfamily) . ';' : ';');
                $newsfeed_text_color = 'color:' . ($generic_newsfeed_desc->color ? $generic_newsfeed_desc->color . ';' : '#000;');
            } else {
                
                $html.='
					<style>
						.title_size_class_'.$single->id.'{
							font-size: '.(isset($single->subtitle_font_size_web) && $single->subtitle_font_size_web ? $single->subtitle_font_size_web . 'px' : '18px') . ' ;
						}

						.desc_size_class_'.$single->id.'{
							font-size:' . (isset($single->desc_font_size_web) && $single->desc_font_size_web ? $single->desc_font_size_web . 'px' : '16px') . ' ;
						}

						@media only screen and (max-width: 600px) {
							.title_size_class_'.$single->id.'{
									font-size:' . (isset($single->subtitle_font_size_mobile) && $single->subtitle_font_size_mobile ? $single->subtitle_font_size_mobile . 'px' : '18px') . ' !important;
							}

							.desc_size_class_'.$single->id.'{
								font-size:' . (isset($single->desc_font_size_mobile) && $single->desc_font_size_mobile ? $single->desc_font_size_mobile . 'px' : '16px') . ' !important;
							}
						}
					</style>';
					
					$title_size_class = "title_size_class_".$single->id;
					$desc_size_class = "desc_size_class_".$single->id;
					$newsfeed_title_font_family = 'font-family:' . ($single->subtitle_font_family ? getfontfamily($single->subtitle_font_family) . ';' : ';');
					$newsfeed_title_color = 'color:' . ($single->subtitle_text_color ? $single->subtitle_text_color . ';' : '#000;');

					$newsfeed_text_font_family = 'font-family:' . ($single->desc_font_family ? getfontfamily($single->desc_font_family) . ';' : ';');
					$newsfeed_text_color = 'color:' . ($single->desc_text_color ? $single->desc_text_color . ';' : '#000;');
				}
                
				$html.='
				<div class="row container single-news" >
					';
							
					if ($single->feed_image) { 
								
						$html.='<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-12 " ><img id="'.$single->id.'" class="lazyload"
							src="'.url('assets/uploads/'.get_current_url() . $single->feed_image).'" 
							alt="" style="width:100%;" alt="'.$single->desc_text.'">
							</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 col-12 " style="padding:2rem;">';
					
					
					}else{
						$html.='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 " style="padding:2rem;">';
					}

                    if($newsFeedSetting->show_dates=='1'){

                        $date_show = $single->created_at;
                        if( $single->newsfeed_date ){

                            $date_show = $single->newsfeed_date;
                        }

                        $html.='
				
						<div class="col-md-12 ">
							<div style="float:left">

							</div>
							<div style="float:right;'. $newsfeed_text_color.'">
								'.date("F d, Y",strtotime($date_show)).'
							</div>
						</div>';
                    }
				
                $html.='
						<div class=" news-title '.$title_size_class.'" style="'.$newsfeed_title_font_family .' '. $newsfeed_title_color.'" style="padding-top: 10px;line-height:1">
							'.$single->subtitle_text.'
						</div>    
						<center>';
												
						
								
				$html.='</center>';
				$html.='<div class="news-desc"  style="text-align:justify !important;padding:0px">
							<p class="'.$desc_size_class.'" style="padding: 0px;line-height:initial; 
							'.$newsfeed_text_font_family.' '. $newsfeed_text_color.'">
							'.nl2br(($single->desc_text)).'
							</p>
							</div>';
							
							if($single->action_button_active=='1'){
								$link = '';
                                $target='';
                                $audioclass='';
                                $data_target="";
                                $class='';
                                $data_toggle='';
								if($single->btn_section=='link'){
									$link = 'href="'.$single->btn_link.'"';
								}else if($single->btn_section=='customforms'){
									$link = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->btn_form).'"';
								}else if($single->btn_section=='eventForms'){
									$link = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->event_form_id).'"';
								}else if($single->btn_section=='stripe'){
									$class = 'stripe';
								}
                                else if ($single->btn_section == 'call' || $single->btn_section == 'sms' || $single->btn_section == 'email') {
                            
                                    switch ($single->btn_section) {
                                        case 'sms':
                                            $link = 'href="sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms)).'"';
                                            break;
                                        case 'call':
                                            $link = 'href="tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_calls)).'"';
                                            break;
                                        case 'email':
                                            $link = 'href="mailto:' . $single->action_button_action_email.'"';
                                            break;
                                    }
                                }elseif($single->btn_section == "video" ){
    
                      
                                    $link = get_blog_image($single->action_button_video);
                                    $link = 'href="'.$link.'"';
                                    // $target = "_blank";
                                    $data_target="#video_modal";
                                    $data_toggle='modal';
                                }elseif($single->btn_section == "google_map"){

                                     $address_full = isset($single->btn_map_address ) ? $single->btn_map_address: "";
                                     $link = 'href="http://maps.google.com/maps?q='.$address_full.'"';
                                     $target = 'target="_blank"';
                                     
                                 }elseif($single->btn_section == "address"  ){

                                    $address =  getaddress_info($single->action_button_address_id);
        
                                     $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                     $link = 'href="http://maps.google.com/maps?q='.$address_full.'"';
                                     $target = 'target="_blank"';
                                     
                                 }else{
                                    if($single->btn_section=='audiofeature'){
                                        $audioclass='';
                                    }
                                    $class='menuitem2';
									$link = 'href="#'.$single->btn_section.'"';
								}
                                
                                $html_videeo ='id="'.$single->id . 'newsfeed" data-toggle="'.$data_toggle.'" data-target="'.$data_target.'"';

                                $html_video_label = '';
                                if($single->btn_section == "video"){
                                    $of = "'".$single->id . "newsfeed'";
                                    $html_videeo .= ' onclick="openVideo('.$of.')"';
                                    $html_video_label = '<div class="'.$desc_size_class.'" style="margin-top: -2px;'. $newsfeed_text_color.$newsfeed_text_font_family.'" >Click to watch video</div>';
                                }
                                $html_text_popup = '';
                                if($single->btn_section =='text_popup'){
                                    $of = "'".$single->id . "txtPopupNF'";
                                    $html_text_popup = 'onclick=openPopupText("'.$of.'")';
                                    $html .=  '<div style="display:none" id="'.$of.'">'.$single->action_button_textpopup.'</div>';
                                  
                                }
                                if($single->btn_section=='audioiconfeature'){

                                    if ( $single->action_button_audio_icon_feature && isset( $single->action_button_audio_icon_feature)) {
                                        $html.='<div class="action-audio" >                                  
                                              <audio class="hidden" id="newsfeedAudio_'.$single->id.'" controls>
                                                  <source src="'.url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature).'" type="audio/mp3">
                                                  <source src="'.url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature).'" type="audio/ogg">
                                                  <source src="'.url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature).'" type="audio/mpeg">
                                              </audio>
                                              </div>';
                                          
                                      }
                                      $input_link = '#' . $single->action_button_audio_icon_feature;
                                    //   <span class='.$desc_size_class.' onclick="playPauseAudio('."'newsfeedAudio_".$single->id."'".')" style="'. $newsfeed_text_color.$newsfeed_text_font_family.'">
                                 
                                    $html.='   
                                    
                                    <a href="#'.$single->action_button_audio_icon_feature.'" 
                                       onclick="playPauseAudio('."'newsfeedAudio_".$single->id."'".')" class="btn '.$audioclass.' btn-adjustable" style="width: max-content;color:'.($single->btn_text_color ? $single->btn_text_color . ";" : "#000;").'background:'.($single->btn_bg ? $single->btn_bg . ";" : "#fff;").'font-family: '.($single->btn_text_font ? getfontfamily($single->btn_text_font) . ";" : ";").'" '.$target.
                                       '><span style="position:absolute;left:10px;">
                                      <i class="fa fa-volume-up" aria-hidden="true"></i></span><span class="text">'.$single->btn_text.'
                                    </span>
                                       </a>
                                    <div style="margin-left: 33px;" class="info-text">Click to hear Text</div>
                                    <br>';
                                //   </span>';
                            } else {
                                $audiooo = '';
                                if ($single->btn_section == 'audiofeature') {
                                    $audiooo = 'onclick=playPauseAudio("myAudio-newsfeed")';
                                }
                            
                                $popupImages = json_encode($single->popup_images);
                            
                                $onclick = '';
                                if ($single->btn_section == "image_popup") {
                                    $onclick = 'onclick="openSlider(' . htmlspecialchars($single->popup_images) . ', \'' . url('assets/uploads/' . get_current_url()) . '\');"';
                                }
                            
                                $html .= '<a ' . $link . ' ' . $html_videeo . ' ' . $html_text_popup . ' ' . $onclick . ' ' . $audiooo . ' class="btn ' . $audioclass . ' ' . $class . '" style="color:' . ($single->btn_text_color ? $single->btn_text_color . ';' : '#000;') . 'background:' . ($single->btn_bg ? $single->btn_bg . ';' : '#fff;') . 'font-family: ' . ($single->btn_text_font ? getfontfamily($single->btn_text_font) . ';' : ';') . '" ' . $target . '>' . $single->btn_text . '</a>' . $html_video_label;
                            }
								
							}

                            if($single->btn_section=='audiofeature'){
                                $html .='<div class="hidden action-audio">
                                        <audio class="hidden"  id="myAudio-newsfeed" controls>
                                            <source src="'.url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) .'" type="audio/mp3">
                                            <source src="'.url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) .'" type="audio/ogg">
                                            <source src="'. url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) .'" type="audio/mpeg">
                                        </audio>
                                </div>';
                            }
                            
				$html.='
					</div>
				</div>
				<hr class="myhr" />
				';

        }

	

        echo $html;
        exit;
    }

    public function send_notification(Request $request){
       
        if(!$request->teaser_title_text && isset($_POST['send_email'])){
            return back()->withError('Teaser title is required.');
        }
        $newsfeed_id = $request->id; 
        $this->data['home_data'] = [];
        $this->data['news_feed'] = NewsFeed::where(array('id'=>$newsfeed_id))->first();
        $this->data['newsfeed_teaser_title'] =  get_text_details('newsfeed_teaser_title');
        $this->data['news_feed_logo'] = get_image('news_feed_logo');
        $this->data['frontend_extended'] = [];
        $this->data['email_lists_Subscribers'] =   EmailList::where('subscribed','1')->orderBy('name', 'ASC')->get();
        $this->data['email_lists'] =   EmailList::orderBy('name', 'ASC')->get();
        $business_info = BusinessInfo::first();
        $newsFeedSetting = newsFeedSetting::first();
        $this->data['business_info'] = $business_info;

        $sa_email_settings = get_sa_email_settings(); 
        $this->data['sa_email_settings'] = (!empty($sa_email_settings)) ? $sa_email_settings : [];
        $total = 0;
        
       
        if(isset($_POST['select_group'])){
           
            if($request->select_type != "all"){
            
                $contact_group_emails = ContactGroupEmail::where( array('contact_group_id' => $request->select_group))->get();
               
                $total = count($contact_group_emails->toArray());
                $sent = 0;
                $failed = 0;
              
                if(count($contact_group_emails)>0){
                    foreach($contact_group_emails as $email){
    
                        $email_data = EmailList::where( array('id'=>$email->email_id))->first();
                       
                        if( isset($email_data) && isset($email_data->email_address) && ($email_data->subscribed ||   ($request->non_subscribers !==null && $request->non_subscribers ))){
                            
                            $this->data['notification_data'] =  (Object)['teaser_title_text' => $request->teaser_title_text];  
                            $this->data['email_data'] = $email_data;  
                            $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&teaser_title='.$request->teaser_title_text;
                            
                            if(isset($newsFeedSetting->optout_email) && $newsFeedSetting->optout_email !=""){
                                $this->data['optout_link'] = env("OPTOUT_SITE_URL").'?pop=8&cust_site='.env("SITE_NAME").'&emailId='.$email_data->id.'&optoutmail='.$newsFeedSetting->optout_email.'&newsfeedid='.$newsfeed_id;
                            }

                            //$mail_body = view('emails.teaser_notification', $this->data)->render();
                           
                            $resp = sendmail($email_data->email_address, $request->teaser_title_text,'teaser_notification', $this->data, array(), true);
                            if($resp){
                                $sent++;
                            }else{
                                $failed++;
                                $failedEmails[]=$email_data;
                            }

                        }else{
                                
                            $failed++;
                            $failedEmails[]=$email_data;
                    }
                        
                    }
                } 

                $message = "Email Sending Completed!<br/><br/>";
                $message .=  "<b>Total</b>:".$total."<br>";
                $message .= "<b>Sent</b>:". $sent."<br/>";
                $message .= "<b>Failed</b>:". $failed."<br/>";
                if($failed>0){
                    foreach($failedEmails as $emails){
                        if($emails->subscribed == 0){
                            $message .= "<b>Non-Subscriber:</b><br/>";
                            $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }else{
                            $message .= "<b>Error while sending email to :</b><br/>";
                            $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }
                    }
                }
                session()->put('email_message',$message);
            }else{         
                $email_data_all = EmailList::where( array('id'=>$email->email_id))->orderBy('name', 'ASC')->get();
                $total = count($email_data_all->toArray());
                $sent = 0;
                $failed = 0;

                if(count($email_data_all)>0){
                    foreach($email_data_all as $email_data){
                                
                        if( isset($email_data) && isset($email_data->email_address) && $email_data->subscribed ){

                            $this->data['notification_data'] =  (Object)['teaser_title_text' => $request->teaser_title_text];     
                            $this->data['email_data'] = $email_data;  
                            $this->data['view_in_browser_link'] =  url('view_mail').'?emailId='.$email_data->id.'&teaser_title='.$request->teaser_title_text;
                            
                            if(isset($newsFeedSetting->optout_email) && $newsFeedSetting->optout_email !=""){


                                $this->data['optout_link'] = env("OPTOUT_SITE_URL").'?pop=8&cust_site='.env("SITE_NAME").'&emailId='.$email_data->id.'&optoutmail='.$newsFeedSetting->optout_email.'&newsfeedid='.$newsfeed_id;
                            }

                            //$mail_body = view('emails.teaser_notification', $this->data)->render();
                            
                            $resp = sendmail($email_data->email_address, $request->teaser_title_text,'teaser_notification', $this->data, array(), true);
                            if($resp){
                                $sent++;
                            }else{
                                $failed++;
                                $failedEmails[]=$email_data;
                            }
                        }else{
                                
                            $failed++;
                            $failedEmails[]=$email_data;
                    }
                    }
                } 
               
                $message = "Email Sending Completed!<br/><br/>";
                $message .=  "<b>Total</b>:".$total."<br>";
                $message .= "<b>Sent</b>:". $sent."<br/>";
                $message .= "<b>Failed</b>:". $failed."<br/>";
                if($failed>0){
                    foreach($failedEmails as $emails){
                        if($emails->subscribed == 0){
                            $message .= "<b>Non-Subscriber:</b><br/>";
                            $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }else{
                            $message .= "<b>Error while sending email to :</b><br/>";
                            $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }
                    }
                }
                session()->put('email_message',$message);
            }
            return redirect('quicksettings?block=newsfeed_bluebar');
        }elseif(isset($_POST['select_contact'])){
                
            $contacts = $request->select_contact;
            $sent = 0;
            $failed = 0;

            if($request->custom_email){
                $total++;
                $email_data['email'] = $request->custom_email;
                $this->data['notification_data'] =  (Object)['teaser_title_text' => $request->teaser_title_text];  
                $this->data['email_data'] = $email_data;  
                $this->data['view_in_browser_link'] = url('view_mail').'?customemail='.$request->custom_email.'&teaser_title='.$request->teaser_title_text;
                
                if(isset($newsFeedSetting->optout_email) && $newsFeedSetting->optout_email !=""){

                    $this->data['optout_link'] = env("OPTOUT_SITE_URL").'?pop=8&cust_site='.env("SITE_NAME").'&customemail='.$request->custom_email.'&optoutmail='.$newsFeedSetting->optout_email.'&newsfeedid='.$newsfeed_id;
                }

                //$mail_body = view('emails.teaser_notification', $this->data)->render();
                
                $resp = sendmail($request->custom_email, $request->teaser_title_text,'teaser_notification', $this->data, array(), true);
                if($resp){
                    $sent++;
                }else{
                    $failed++;
                    $failedEmails[]=$email_data;
                }

            }else if(count($contacts)>0){
                foreach($contacts as $contact){
                    if($contact == "test"){
                        $email_data_all = CrmSetting::get();
                    }else if($contact != "all"){
                        $email_data_all = EmailList::where( array('id'=>$contact))->get();
                    }else{
                        $email_data_all = EmailList::orderBy('name', 'ASC')->get();
                    }
                    $total = $total + count($email_data_all->toArray());
                    
                    if(count($email_data_all)>0){
                        foreach($email_data_all as $email_data){
                            if($contact == "test"){

                                $this->data['notification_data'] =  (Object)['teaser_title_text' => $request->teaser_title_text];  
                                $this->data['email_data'] = $email_data;  
                                $this->data['view_in_browser_link'] = base_url('view_mail').'?emailId='.$email_data->id.'&teaser_title='.$request->teaser_title_text;
                                
                                if(isset($newsFeedSetting->optout_email) && $newsFeedSetting->optout_email !=""){

                                    $this->data['optout_link'] = env("OPTOUT_SITE_URL").'?pop=8&cust_site='.env("SITE_NAME").'&emailId='.$email_data->id.'&optoutmail='.$newsFeedSetting->optout_email.'&newsfeedid='.$newsfeed_id;
                                }

                                //$mail_body = view('emails.teaser_notification', $this->data)->render();
                                
                                $resp = sendmail($email_data->email_address, $request->teaser_title_text,'teaser_notification', $this->data, array(), true);
                                if($resp){
                                    $sent++;
                                }else{
                                    $failed++;
                                    $failedEmails[]=$email_data;
                                }

                            }else if( isset($email_data) && isset($email_data->email_address) && ($email_data->subscribed ||   ($request->non_subscribers !==null && $request->non_subscribers )) ){

                                    $this->data['notification_data'] =  (Object)['teaser_title_text' => $request->teaser_title_text];  
                                    $this->data['email_data'] = $email_data;  
                                    $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&teaser_title='.$request->teaser_title_text;
                                    
                                    if(isset($newsFeedSetting->optout_email) && $newsFeedSetting->optout_email !=""){

                                        $this->data['optout_link'] = env("OPTOUT_SITE_URL").'?pop=8&cust_site='.env("SITE_NAME").'&emailId='.$email_data->id.'&optoutmail='.$newsFeedSetting->optout_email.'&newsfeedid='.$newsfeed_id;
                                    }

                                    //$mail_body = view('emails.teaser_notification', $this->data)->render();
                                    
                                    $resp = sendmail($email_data->email_address, $request->teaser_title_text,'teaser_notification', $this->data, array(), true);
                                    if($resp){
                                        $sent++;
                                    }else{
                                        $failed++;
                                        $failedEmails[]=$email_data;
                                    }

                                }else{
                                        
                                    $failed++;
                                    $failedEmails[]=$email_data;
                                }
                        }
                    }
                    
                }
            } 
            

            $message = "Email Sending Completed!<br/><br/>";
            $message .=  "<b>Total</b>:".$total."<br>";
            $message .= "<b>Sent</b>:". $sent."<br/>";
            $message .= "<b>Failed</b>:". $failed."<br/>";
            if($failed>0){
                foreach($failedEmails as $emails){
                    if($emails->subscribed == 0){
                        $message .= "<b>Non-Subscriber:</b><br/>";
                        $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                    }else{
                        $message .= "<b>Error while sending email to :</b><br/>";
                        $message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                    }
                }
            }
            session()->put('email_message',$message);
               
            return redirect('quicksettings?block=newsfeed_bluebar');
        }
        $this->data['newsfeed_id'] = $newsfeed_id;
        $this->data['contact_groups'] = ContactGroup::orderBy('group_name', 'ASC')->get();
		return view('admin.newsfeed.send_notifications')->with($this->data);
    }

}
