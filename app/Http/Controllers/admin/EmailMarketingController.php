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
use App\Models\BusinessInfo;

use App\Models\ContactGroup;
use App\Models\EmailPost;
use App\Models\EmailPostImage;
use App\Models\ScheduleEmail;
use App\Models\ScheduleEmailContact;
use App\Models\CustomScheduleEmail;
use App\Models\EmailPostStarter;
use App\Models\EmailList;
use App\Models\ContactGroupEmail;
use App\Models\EmailPostStarterImage;
use App\Models\customForms;
use App\Models\scheduleEmailCustom;
use App\Models\socialMedia;
use App\Models\UnsubscribeEmail;
use Illuminate\Support\Str;

class EmailMarketingController extends Controller
{
    //
    public function __construct(){
        $this->data['controller'] = 'CRM';
        $this->data['controller_name'] = 'CRM';
        $this->data['crm_settings'] = CrmSetting::first();
        $this->data['font_family'] = get_font_family();
        $this->data['business_infos'] = BusinessInfo::first();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $this->data['custom_forms'] = customForms::orderBy('title','ASC')->get();
        $siteSettings = siteSettings::find('1');
        $this->data['timezone']  = timeZones::find($siteSettings->timezone)->first();        
        $this->data['notificationSettings'] = NotificationSettings::first();
        
    }
    function getCurrentSiteURL() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
        // Get the current hostname
        $hostname = $_SERVER['HTTP_HOST'];
        
        // Get the current script name (path to the script)
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        
        // Combine protocol, hostname, and script name
        $baseURL = $protocol . $hostname . rtrim($scriptName, '/');
        
        return $baseURL;
    }

    public function emailMarketing(Request $request){
        // dd($request->all());
        $crm_settings =   $this->data['crm_settings'];
        $email_template_id = $request->id;
        if(!$email_template_id){
            redirect('crmcontrols?block=email_management');
        }
        
        $this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
        $this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
        $this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
        $this->data['generic_description'] = get_text_details('generic_email_post_description');
        $this->data['home_data'] = socialMedia::all();
        
        $this->data['email_lists_Subscribers'] =  EmailList::where('subscribed','1')->orderBy('name', 'ASC')->get();
        $this->data['email_images'] = EmailPostImage::where("email_id", $email_template_id)->get();
        $this->data['email_lists'] =  EmailList::orderBy('name', 'ASC')->get();
        $this->data['frontend_extended'] = [];
        $sa_email_settings = get_sa_email_settings();
        $this->data['sa_email_settings'] = (!empty($sa_email_settings)) ? $sa_email_settings : [];
  
        if(isset($_POST['select_group']) ){

            if($request->select_type == "Scheduled"){ 

                
                foreach($request->select_group as $group){
                    $insert_data = [];
                    $insert_data['email_template_id'] = $email_template_id;
                    $insert_data['contact_group_id'] = $group;
                    if($request->non_subscribers !==null && $request->non_subscribers){
                        $insert_data['non_subscribers'] = 1;
                    }
                    $date_time = strtotime($request->schedule_date.' '.$request->schedule_time);
                    $insert_data['schedule_datetime'] = date("Y-m-d H:i:s", $date_time);
                    $saved =  ScheduleEmail::create($insert_data);
                }
                
                return  redirect('crmcontrols?block=email_management')->withSuccess("Emails scheduled succesfully!"); 

            }else{
                $groups=[];
                $groups = $request->select_group;
                $sent = 0;
                $failed = 0;
                $total = 0;
                foreach($groups as $group){

                $email_template = EmailPost::find($email_template_id);
                $preheader_text = get_prehead_text($email_template->preheader_text);
                $this->data['preheader_text'] = $preheader_text;

               
                $contact_group_emails = [];
                if($group == "test"){
                    $contact_group_emails = CrmSetting::get();
                    $total = $total + count($contact_group_emails);

                    if(count($contact_group_emails)>0){
                        foreach($contact_group_emails as $email_data){
        
                                $this->data['template_data'] = $email_template;  
                                $this->data['email_data'] = $email_data;  
                                $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&tempId='.$email_template->id;
                                $rand = Str::random(32);
                                if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){
    
                                    $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                                }
    
                                //$mail_body =  view('emails.email_template',($this->data))->render();
                                $resp = sendmail($email_data->test_email_address, $email_template->teaser_title,'email_template',$this->data, array(), true);
                                $data = new UnsubscribeEmail;
                                $data->email = $email_data->test_email_address;
                                $data->key = $rand;
                                $data->save();
                                    $sent++;
                        }
                    } 

                }else if($group != "all"){
                    $contact_group_emails = ContactGroupEmail::where(array('contact_group_id' => $group))->get();

                    $total = $total + count($contact_group_emails);
                    
                    if(count($contact_group_emails)>0){
                        foreach($contact_group_emails as $email){
        
                            $email_data = EmailList::where( array('id'=>$email->email_id))->first();
                         
                            if( isset($email_data) && isset($email_data->email_address) && ($email_data->subscribed ||   ($request->non_subscribers !==null && $request->non_subscribers ))){
                            
                                $this->data['template_data'] = $email_template;  
                                $this->data['email_data'] = $email_data;  
                                $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&tempId='.$email_template->id;
                                $rand = Str::random(32);
                                if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){
    
                                    $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                                }
                              
                                //$mail_body =  view('emails.email_template',($this->data))->render();
                               
                                $resp = sendmail($email_data->email_address, $email_template->teaser_title,'email_template',$this->data, array(), true);
                                $data = new UnsubscribeEmail;
                                $data->email = $email_data->email_address;
                                $data->key = $rand;
                                $data->save();
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
                   
                }else{
                    $email_data_all = EmailList::orderBy('name', 'ASC')->get();
                    $total = $total + count($email_data_all);
    
                    if(count($email_data_all)>0){ 
                        foreach($email_data_all as $email_data){
                                   
                            if(isset($email_data) && isset($email_data->email_address) && ($email_data->subscribed ||   ($request->non_subscribers !==null && $request->non_subscribers ))){
    
                                $this->data['template_data'] = $email_template;  
                                $this->data['email_data'] = $email_data;  
                                $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&tempId='.$email_template->id;
                                $rand = Str::random(32);
                                if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){
    
                                    $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                                }
    
                                //$mail_body = view('emails.email_template',($this->data))->render();
                                $resp = sendmail($email_data->email_address, $email_template->teaser_title,'email_template',$this->data, array(), true);
                                $data = new UnsubscribeEmail;
                                $data->email = $email_data->email_address;
                                $data->key = $rand;
                                $data->save();
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
           
                $email_message = "Email Sending Report!<br/><br/>";
                $email_message .= "<b>Total</b>:".$total."<br>";
                $email_message .= "<b>Sent</b>:". $sent."<br/>";
                $email_message .= "<b>Failed</b>:". $failed."<br/>";
                if($failed>0){
                    foreach($failedEmails as $emails){
                    if($emails->subscribed == 0){
                        $email_message .= "<b>Non-Subscriber:</b><br/>";
                        $email_message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                    }else{
                        $email_message .= "<b>Not Sent Emails :</b><br/>";
                        $email_message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                    }
                }
                session()->put('email_message',$email_message);
            }
                
                checkSendNotification('CRM has been updated','Email sent','crm_notifications','crm_notification_email');

                return  redirect('crmcontrols?block=email_management')->withSuccess('Emails Sent!'); 
            
            }
        }
        if(isset($_POST['select_contact'])){
            if($request->select_type == "Scheduled"){
                if($request->custom_email){
                    $custom_emails_list = [];
                    if(strpos($request->select_contact,',')){
                        $custom_emails_list[] =explode(',',$request->select_contact);

                    }else{
                        $custom_emails_list[]= $request->select_contact;
                    }
                    foreach($custom_emails_list as $custom_email){
                        if($custom_email && (filter_var($custom_email, FILTER_VALIDATE_EMAIL))) {

                            $date_time = strtotime($request->schedule_date.' '.$request->schedule_time);
                            $insert_data['schedule_datetime'] = date("Y-m-d H:i:s", $date_time);
                            $insert_data['schedule_email'] = $custom_email;
                            $insert_data['email_template_id'] = $email_template_id;
                            scheduleEmailCustom::create($insert_data);
                        }
                    }
                 
                    
                }else{
                    $insert_data = [];
                    $insert_data['email_template_id'] = $email_template_id;
                    if($request->non_subscribers !==null && $request->non_subscribers){
                        $insert_data['non_subscribers'] = 1;
                    }

                    $date_time = strtotime($request->schedule_date.' '.$request->schedule_time);
                    $insert_data['schedule_datetime'] = date("Y-m-d H:i:s", $date_time);
                    
                    $post = ScheduleEmail::create($insert_data); 
                    $schedule_email_id  = $post->id;
                    
                    $contacts=[];
                    $contacts = $request->select_contact;
                    foreach($contacts as $contact){
                        if($contact == "test"){
                            
                            $email_data_all = CrmSetting::get();
                            foreach($email_data_all as $select_contact){
                                $insert_data = [];
                                $insert_data['email_list_id'] = $select_contact->id;
                                $insert_data['schedule_email_id'] = $schedule_email_id;
                                ScheduleEmailContact::create($insert_data);
                            }
                        }else 
                        if($contact != "all"){
                            $email_data_all =EmailList::where(array('id' => $contact))->get();
                            foreach($email_data_all as $select_contact){
                                $insert_data = [];
                                $insert_data['email_list_id'] = $select_contact->id;
                                $insert_data['schedule_email_id'] = $schedule_email_id;
                                ScheduleEmailContact::create($insert_data);
                            }
                        }else{
                            
                            $email_data_all = EmailList::orderBy('name', 'ASC')->get();
                            foreach($email_data_all as $select_contact){
                                $insert_data = [];
                                $insert_data['email_list_id'] = $select_contact->id;
                                $insert_data['schedule_email_id'] = $schedule_email_id;
                                ScheduleEmailContact::create($insert_data);
                            }
                            
                        }
                    }
                    
                }
                checkSendNotification('CRM has been updated','Email scheduled','crm_notifications','crm_notification_email');
                return  redirect('crmcontrols?block=email_management')->withSuccess("Emails scheduled succesfully!"); 

            }else{
                $email_template = EmailPost::find($email_template_id);
                $preheader_text = get_prehead_text($email_template->preheader_text);
                $this->data['preheader_text'] = $preheader_text;

                $email_data_all = [];

                $contacts=[];
                $contacts = $request->select_contact;
                $sent = 0;
                $failed = 0;
                $total = 0;

                if($request->custom_email){
                    $custom_emails_list = [];
                    if(strpos($request->select_contact,',')){
                        $custom_emails_list =explode(',',$request->select_contact);

                    }if(strpos($request->csv_emails,',')){
                        $custom_emails_list =explode(',',$request->csv_emails);

                    }else{
                        if($request->select_contact !== null)
                        {
                            $custom_emails_list[]= $request->select_contact;
                        }
                        else
                        {
                            $custom_emails_list[]= $request->csv_emails;
                        }
                    }
                    
                    foreach($custom_emails_list as $custom_email){
                        if($custom_email && (filter_var($custom_email, FILTER_VALIDATE_EMAIL))) {
                            $this->data['template_data'] = $email_template;  
                            $this->data['email_custom'] = $custom_email;
                            $this->data['home_data'] = socialMedia::all();
                            $this->data['view_in_browser_link'] = url('view_mail').'?customemail='.$custom_email.'&tempId='.$email_template->id;
                            $rand = Str::random(32);
                            if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){
                                $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                            }
                            
                            // $mail_body = view('emails.email_template',($this->data))->render();             
                            $resp = sendmail($custom_email, $email_template->teaser_title,'email_template',$this->data, array(), true);
                            $data = new UnsubscribeEmail;
                            $data->email = $custom_email;
                            $data->key = $rand;
                            $data->save();
                            $sent++;
                        }
                        if($custom_email!=''){

                            $total ++;
                        }
                    }
                    
                }else{
                    foreach($contacts as $contact){
                        if($contact == "test"){
                            $email_data_all = CrmSetting::get();
                        }else if($contact != "all"){
                            $email_data_all = EmailList::where( array('id' => $contact))->get();
                        }else{
                            $email_data_all = EmailList::orderBy('name', 'ASC')->get();
                        }
                        $total = $total + count($email_data_all);
                        if(count($email_data_all)>0){
                            foreach($email_data_all as $email_data){
                                if($contact == "test"){
                                    
                                    $this->data['template_data'] = $email_template;  
                                    $this->data['email_data'] = $email_data;  
                                    $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&tempId='.$email_template->id;
                                    $rand = Str::random(32);
                                    if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){

                                        $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                                    }

                                    //$mail_body = view('emails.email_template',($this->data))->render();
                                
                                    $resp = sendmail($email_data->email_address, $email_template->teaser_title,'email_template',$this->data, array(), true);
                                    $data = new UnsubscribeEmail;
                                    $data->email = $email_data->email_address;
                                    $data->key = $rand;
                                    $data->save();
                                        $sent++;

                                } else if(isset($email_data) && isset($email_data->email_address) && ($email_data->subscribed ||   ($request->non_subscribers !==null && $request->non_subscribers ))){

                                    $this->data['template_data'] = $email_template;  
                                    $this->data['email_data'] = $email_data;  
                                    $this->data['view_in_browser_link'] = url('view_mail').'?emailId='.$email_data->id.'&tempId='.$email_template->id;
                                    $rand = Str::random(32);
                                    if(isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address !=""){

                                        $this->data['optout_link'] =  $this->getCurrentSiteURL().'?popup=8&customemail='.$custom_email.'&optoutmail='.$crm_settings->optout_email_address.'&key='.$rand;
                                    }

                                    //$mail_body =view('emails.email_template',($this->data))->render();
                                
                                    $resp = sendmail($email_data->email_address, $email_template->teaser_title,'email_template',$this->data, array(), true);
                                    $data = new UnsubscribeEmail;
                                    $data->email = $email_data->email_address;
                                    $data->key = $rand;
                                    $data->save();
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
               
                $email_message = "Email Sending Report!<br/><br/>";
                $email_message .=  "<b>Total</b>:".$total."<br>";
                $email_message .= "<b>Sent</b>:". $sent."<br/>";
                $email_message .= "<b>Failed</b>:". $failed."<br/>";
                if($failed>0){
                    foreach($failedEmails as $emails){
                        if($emails->subscribed == 0){
                            $email_message .= "<b>Non-Subscriber:</b><br/>";
                            $email_message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }else{
                            $email_message .= "<b>Not Sent Emails :</b><br/>";
                            $email_message .= "<b>Name</b>: ". $emails->name."<b> Email Address</b>: ". $emails->email_address."<br/>";
                        }
                    }
                }
                session()->put('email_message',$email_message);
                checkSendNotification('CRM has been updated','Email Sent','crm_notifications','crm_notification_email');

                return  redirect('crmcontrols?block=email_management')->withSuccess('Emails sent!'); 
            }

        }
        $this->data['email_template_id'] = $email_template_id;
        $this->data['contact_groups'] = ContactGroup::orderBy('group_name', 'ASC')->get();
		return view('admin.emailpost.send_email')->with($this->data);
    }


    public function view_mail(Request $request){
	 
		if(isset($_GET['newsfeedid'])){
			$this->data['news_feed'] = newsFeed::where(array('id'=>$_GET['newsfeedid']))->first();
		}
		
		if(isset($_GET['tempId']) && EmailPost::find($request->tempId)){

			$template_data = EmailPost::find($request->tempId);
			if($request->customemail){
                $this->data['email_custom'] = $request->customemail; 
		        $this->data['view_in_browser_link'] = base_url('home/view_mail').'?email_custom='.$request->customemail.'&tempId='.$template_data->id;
			}else{
    			$email_data = EmailList::where( array('id'=>$request->emailId))->first();   
    			$this->data['email_data'] = $email_data;
			    $this->data['view_in_browser_link'] = base_url('home/view_mail').'?emailId='.$email_data->id.'&tempId='.$template_data->id;
			}		
			
			$sa_email_settings = get_sa_email_settings();
			$preheader_text = get_prehead_text($request->teaser_title);
	
			$this->data['template_data'] = $template_data;   
			
			$this->data['sa_email_settings'] = (!empty($sa_email_settings)) ? $sa_email_settings : [];
			$this->data['preheader_text'] = $preheader_text;
            $this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
            $this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
            $this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
            $this->data['generic_description'] = get_text_details('generic_email_post_description');
            $this->data['home_data'] = [];
            $this->data['email_lists_Subscribers'] =  EmailList::where('subscribed','1')->orderBy('name', 'ASC')->get();
            $this->data['email_images'] = EmailPostImage::where("email_id",$request->tempId)->get();
            $this->data['email_lists'] =  EmailList::orderBy('name', 'ASC')->get();
			echo  view('emails/email_template', $this->data)->render();
			exit;
		}

		if(isset($_GET['teaser_title'])){

			$email_data = EmailList::where(array('id'=>$request->emailId))->first();	
			$sa_email_settings = get_sa_email_settings();
			$preheader_text = get_prehead_text($request->teaser_title);
	
			$this->data['notification_data'] = (Object)['teaser_title_text' => $request->teaser_title];      
			$this->data['email_data'] = $email_data;
			$business_info = BusinessInfo::where(array('id' => '1'))->first();
			$this->data['business_info'] = $business_info;
			
			$this->data['sa_email_settings'] = (!empty($sa_email_settings)) ? $sa_email_settings : [];
			$this->data['preheader_text'] = $preheader_text;
			$this->data['view_in_browser_link'] = base_url('home/view_mail').'?emailId='.$email_data->id.'&tempId='.$template_data->id;
            $this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
            $this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
            $this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
            $this->data['generic_description'] = get_text_details('generic_email_post_description');
            $this->data['home_data'] = [];
            $this->data['email_lists_Subscribers'] =  EmailList::where('subscribed','1')->orderBy('name', 'ASC')->get();
            $this->data['email_images'] = EmailPostImage::where("email_id", $email_template_id)->get();
            $this->data['email_lists'] =  EmailList::orderBy('name', 'ASC')->get();
            $this->data['frontend_extended'] = [];
			echo  $this->load->view('emails/teaser_notification', $this->data, TRUE);
			exit;
		}
	
	}
	public function  optout(Request $request){
		if($request->emailId || $request->customemail){
			$email_data = EmailList::where('id',$request->emailId)->first();
			if(!$email_data){
                $email_data = EmailList::where('email_address',$request->customemail)->first();
            }
			if($email_data){

				EmailList::where(array('email_address' => $email_data->email_address))->update(array('subscribed'=> 0));
				$this->data['email_data'] = $email_data;
				//$mail_body = view('emails/optout_template', $this->data)->render();
				$business_info = BusinessInfo::where(array('id' => '1'))->first();
             
				$resp = sendmail($request->optoutmail, 'A User Unsubscribed From '.$business_info->business_name,'optout_template',$this->data,array(), false);
				$url = url('/');
				echo "<center style='margin-top:100px'><h1>You have successfully Unsubscribed!</h1>
				<br/><br/>
				<a href='".$url."'>Visit Website</a>
				</center>
				";
				exit;
			}
		}
        // return  redirect(''); 
	}

}