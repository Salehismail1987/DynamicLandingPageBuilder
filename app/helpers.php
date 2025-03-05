<?php

use App\Models\textDetails;
use App\Models\permissions;
use App\Models\rolePermissions;
use App\Models\actionButtons;
use App\Models\NotificationSettings;
use App\Models\oneStepImages;
use App\Models\images;
use App\Models\timedImagesSetting;
use App\Models\siteSettings;
use App\Models\timeZones;
use App\Models\addresses;
use App\Models\FontFamily;
use App\Models\icons;
use App\Models\EmailPost;
use App\Models\BusinessInfo;
use App\Models\CrmSetting;
use App\Models\ContactGroupEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactGroup;
use App\Models\customForms;
use App\Models\customUserForm;
use App\Models\blogCategories;
use App\Models\frontSections;
use App\Models\galleryPostImage;
use App\Models\outlineSettings;
use App\Models\userRolls;
use App\Mail\MailNotify;
use App\Models\TitleBannerSetting;


function base_url($string=''){
    return url($string);
}

function check_for_nofollow_meta(){

    $base_url =  url('');
    $path = url()->current();

    $sites_list = [
        'demo.webhound.tech',
        'training.webhound.tech',
        'training1.webhound.tech',
        'training2.webhound.tech',
        'training3.webhound.tech',
        'training4.webhound.tech',
        'tutorial.webhound.tech',
        'wiki.webhound.tech',
        'dashboard.webhound.tech',
    ];
    foreach($sites_list as $list){

        if (strpos($base_url, $list) !== false || strpos($path, '/admin/') !== false ) {

            return true;
        }else{
            return false;
        }
    }
    return false;
}


function check_feature_enable_disable($slug){
    $front_section = frontSections::where('slug',$slug)->first();
    if($front_section){
        if($front_section->section_enabled=='1'){
            return true;
        }else{
            return false;
        }
    }
    return false;
}

function check_auth_permission($permission_slug){
  
    if (Auth::user()->admin_type=='1') {
        return true;
    }
    $permissions = null;
    // $permissions = rolePermissions::with('permission')->where('role_id',Auth::user()->user_role)->get();
    $permissions = DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id',Auth::user()->user_role)->where('website',$_SERVER['SERVER_NAME'])->get();
    //print_r($permissions);
    if ($permissions && is_array($permissions->toArray()) && count($permissions->toArray()) > 0) {
      
        foreach ($permissions as $permission) {
            // $permission = $permission->permission;
            $permission = DB::connection('mysqlDashboard')->table('permissions')->where('id',$permission->permission_id)->where('website',$_SERVER['SERVER_NAME'])->first();
            if(isset($permission->permission_slug)){
                if (is_array($permission_slug)) {
                    $search_result = array_search($permission->permission_slug, $permission_slug);
                    if (false !== $search_result) {
                        return true;
                    }
                } else {
                    if ($permission->permission_slug == $permission_slug) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}
function cleanString($string) {
    $string = str_replace(' ', '-', $string);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
function check_section_enabled_by_slug($front_sections = array(), $slug = '')
{
    foreach ($front_sections as $section) {
        if ($slug == $section->slug && $section->section_enabled) {
            return true;
        }
    }
    return false;
}
function get_messages(){
    $superadminmessage_links = DB::connection('mysqlDashboard')->table('superadminmessage')->get();
    return $superadminmessage_links;
}

function get_links($id){
    $superadminmessage_links = DB::connection('mysqlDashboard')->table('links')->where(array('superadminmessage_id'=>$id,'link_type'=>'superadminmessage'))->get();
    //$superadminmessage_links = $dashboard_db->where(array('superadminmessage_id'=>$id,'link_type'=>'superadminmessage'))->get('links')->result();
    return $superadminmessage_links;
}

function update_outline_settings($slug,$data){

    $exist =  outlineSettings::where('slug',$slug)->first();
    if($exist){
        $newData = outlineSettings::find($exist->id);
    }else{
        $newData = new outlineSettings();
        $newData->slug = $slug;
    }
    if(isset($data->outline_color)){
        $newData->outline_color = $data->outline_color;
    }
    if(isset($data->active)){
        $newData->active = $data->active;
    }
    $newData->save();
}
function get_outline_settings($slug){

    $data =  outlineSettings::where(array('slug'=>$slug))->first();
    if($data){
        return $data;
    }else{
        $newData = new outlineSettings();
        $newData->slug = $slug;
        $newData->outline_color = '';
        $newData->active = '0';
        $newData->save();
        return $newData;
    }
}
function get_text_details($slug){

    $data =  textDetails::where(array('slug'=>$slug))->first();
    if($data){
        return $data;
    }else{
        $newData = new textDetails();
        $newData->slug = $slug;
        $newData->text = '';
        $newData->size_web = '';
        $newData->size_mobile = '';
        $newData->color = '';
        $newData->bg_color = '';
        $newData->fontfamily = '0';
        $newData->tag = 'h3';
        $newData->save();

        return $newData;
    }
}

function get_action_button($slug){

    $data =  actionButtons::where(array('slug'=>$slug))->first();
    if($data){
        return $data;
    }else{
        return false;
    }
}

function update_text_details($slug,$data){

    $exist =  textDetails::where('slug',$slug)->first();
    if($exist){
        $newData = textDetails::find($exist->id);
    }else{
        $newData = new textDetails();
        $newData->slug = $slug;
    }

    $newData->text = isset($data->text)?$data->text:'';
    $newData->size_web = isset($data->size_web)?$data->size_web:'';
    $newData->size_mobile = isset($data->size_mobile)?$data->size_mobile:'';
    $newData->color = isset($data->color)?$data->color:'';
    $newData->bg_color = isset($data->bg_color)?$data->bg_color:'';
    $newData->fontfamily = isset($data->fontfamily)?$data->fontfamily:'0';
    $newData->tag = isset($data->tag)?$data->tag:'h3';
    $newData->save();
}
function update_text_details2($slug,$data){

    $exist =  textDetails::where('slug',$slug)->first();
    if($exist){
        $newData = textDetails::find($exist->id);
    }
    if(isset($data->text)){
        $newData->text = $data->text;
    }
    if(isset($data->size_web)){
        $newData->size_web = $data->size_web;
    }
    if(isset($data->size_mobile)){
        $newData->size_mobile = $data->size_mobile;
    }
    if(isset($data->color)){
        $newData->color = $data->color;
    }
    if(isset($data->bg_color)){
        $newData->bg_color = $data->bg_color;
    }
    if(isset($data->fontfamily)){
        $newData->fontfamily = $data->fontfamily;
    }
    if(isset($data->tag)){
        $newData->tag = $data->tag;
    }
    $newData->save();
}

function update_action_button($slug, $data){

    $exist =  actionButtons::where('slug',$slug)->first();

    if($exist){
        $newData = actionButtons::find($exist->id);
    }else{
        $newData = new actionButtons();
    }
    if(isset($data->active)){
        $newData->active = $data->active;
    }else{
        $newData->active = '0';
    }
    $newData->link = $data->link;
    $newData->action_type = $data->action_type;
    $newData->address_id = isset($data->address_id)?$data->address_id:'0';
    $newData->map_address = isset($data->map_address)?$data->map_address:'';
    $newData->custom_form_id = $data->custom_form_id;
    $newData->text = isset($data->text)?$data->text:'';
    $newData->text_color = isset($data->text_color)?$data->text_color:'';
    $newData->bg_color = isset($data->bg_color)?$data->bg_color:'';
    $newData->action_button_phone_no_calls = isset($data->action_button_phone_no_calls)?$data->action_button_phone_no_calls:'';
    $newData->action_button_phone_no_sms = isset($data->action_button_phone_no_sms)?$data->action_button_phone_no_sms:'';
    $newData->action_button_action_email = isset($data->action_button_action_email)?$data->action_button_action_email:'';

    $newData->save();
}

function update_timed_image_setting($slug, $data){

    $exist =  timedImagesSetting::where('slug',$slug)->first();

    if($exist){
        $newData = timedImagesSetting::find($exist->id);
    }else{
        $newData = new timedImagesSetting();
    }
    $newData->slug = $slug;
    $newData->enable = $data->enable;
    $newData->start_time = $data->start_time;
    $newData->end_time = $data->end_time;
    $newData->days = $data->days;
    $newData->type = $data->type;
    $newData->image_timer = $data->image_timer;
    $newData->save();
}

function get_custom_form_data($id){
    $data =  customForms::where('id',$id)->first();
    return $data;
}

function get_custom_user_form_data($id, $folder_id=null){
    if(is_null($folder_id)){
        $folder_id=0;
    }
    $data =  customUserForm::where([['form_id',$id],['in_folder',$folder_id]])->orderBy('display_order','asc')->orderBy('id','desc')->get();
    return $data;
}

function get_custom_user_form_unseen($id){
    $data =  customUserForm::where('form_id',$id)->where('seen','0')->first();
    return $data;
}

function getFormTitle($id)
{
    $data = customForms::where('id',$id)->first('title');
    return $data->title;
}

function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
 }

function get_detail_custom_user_form_data($id){
    $data =DB::table('custom_user_forms')
                ->leftJoin('custom_forms','custom_forms.id', '=', 'custom_user_forms.form_id')
                ->select('custom_user_forms.*', 'custom_forms.title as form_name')
                ->where('custom_user_forms.id',$id)
                ->first();
    return $data;
}

function saveimagefromdataimage($imagedata, $oldimage = null, $flag=false)
{
    
    $image = rand(9, 9999) . date('d-m-Y') . '.png';

    list($type, $imagedata) = explode(';', $imagedata);
    list(, $imagedata)      = explode(',', $imagedata);
    $imagedata = base64_decode($imagedata);

    file_put_contents('assets/uploads/' .get_current_url(). $image, $imagedata);

    // if($flag==false){
    //     // Image Compression
        // compress_image($image);
    // }

    if ($oldimage && file_exists("assets/uploads/".get_current_url().$oldimage)) {
        unlink("assets/uploads/".get_current_url().$oldimage);
    }

    return $image;
}

function save_image($slug,$file_name, $max_width=null, $min_width=null){

    $exist =  images::where('slug',$slug)->first();
    $file_to_delete = null;
    if($exist){
        $newData = images::find($exist->id);
        $file_to_delete = $exist->file_name;

    }else{
        $newData = new images();
        $newData->slug = $slug;
    }
    if($file_name){
        $newData->file_name = $file_name;
    }
    if($max_width){
        $newData->max_width = $max_width;
    }
    if($min_width){
        $newData->min_width = $min_width;
    }

    $newData->save();

    if($file_name && $file_to_delete && file_exists("assets/uploads/".get_current_url().$file_to_delete)){
        unlink("assets/uploads/".get_current_url().$file_to_delete);
    }
}
function delete_image($slug){

    $exist =  images::where('slug',$slug)->first();
    $file_to_delete = $exist->file_name;

    $exist->file_name = '';
    $exist->save();
}

function delimg($image){
    if ($image && file_exists("assets/uploads/".get_current_url().$image)) {
        unlink("assets/uploads/".get_current_url().$image);
    }
}

function get_permissions($id = null)
{
    
    // $permissions = permissions::orderBy('display_order', 'asc')->where('parent_id' , $id)->get();
    if($id){
        $permissions = DB::connection('mysqlDashboard')->table('permissions')->where('parent_id',$id)->where('website',$_SERVER['SERVER_NAME'])->orderBy('display_order', 'asc')->get();
    }else{
        $permissions = DB::connection('mysqlDashboard')->table('permissions')->where('parent_id','0')->where('website',$_SERVER['SERVER_NAME'])->orderBy('display_order', 'asc')->get();
    }
    
    if ($permissions) {
        return $permissions;
    } else {
        return false;
    }
}

function get_timed_image($slug){
    $timed_image = timedImagesSetting::where('slug', $slug)->first();
    if ($timed_image) {
        return $timed_image;
    } else {
        return false;
    }
}

function get_image($slug){
    $image = images::where('slug', $slug)->first();
    if ($image) {
        return $image;
    } else {
        return false;
    }
}

function get_image_by_id($id){
    
    $image = images::where('id', $id)->first();
    if ($image) {
        return $image;
    } else {
        return false;
    }
}

function isDate($value) 
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function check_permission($role_permissions, $permission_slug)
{


    if ($role_permissions) {
        foreach ($role_permissions as $permission) {

            if ($permission->permission_slug == $permission_slug) {
                return true;
            }
        }
    }

    return false;
}


function sendmail($email, $subject, $template,$body_data, $attachments = array(),$is_marketing = false)
{
        $business_info = BusinessInfo::first();

        $from_email = $business_info->busniess_contact_email &&  $business_info->busniess_contact_email  !="" ? $business_info->busniess_contact_email : (
            $business_info->contact_email &&  $business_info->contact_email !="" ? $business_info->contact_email : "admin@enfohub.com"
        );
        $from_name = $business_info->busniess_contact_name &&  $business_info->busniess_contact_name  !="" ? $business_info->busniess_contact_name : (
            $business_info->contact_name &&  $business_info->contact_name !="" ? $business_info->contact_name : "enfohub.com"
        );
        $reply_to ='info@enfohub.com';
    
        $data = CrmSetting::first();
        if($is_marketing || true){
            $from_email = $data->email_marketing_from_email !="" ? $data->email_marketing_from_email  :$from_email;
            $from_name = $data->email_marketing_from_name !="" ? $data->email_marketing_from_name  : $from_name;
            $reply_to = $data->email_marketing_reply_to !="" ? $data->email_marketing_reply_to  : $reply_to;
        }
        $is_send=false;
        //$body = $message;
        
        //echo $from_email.' '.$reply_to.' '.$from_name.' '.$body; die();
        if($email !='' && validateEmail($email)){
            try{
                Mail::to($email)->send(new MailNotify($from_email,$from_name,$reply_to,$subject,$body_data,$template));
                return true;
            }catch(Exception $e){
                return false;
            }
            
            // $is_send = Mail::html($body,  function ($message) use ($from_email,$reply_to,$from_name,$body,$subject,$email,$attachments) {
            //     $message->to($email, '');
            //     //if($from_email !='' && filter_var($from_email, FILTER_VALIDATE_EMAIL)){
            //     if($from_email !=''){
    
            //         $message->from($from_email,$from_name ? $from_name:'');
            //     }else{
    
            //         $message->from("info@enfohub.com",$from_name ? $from_name:'');
            //     }
            //     if($reply_to !=''){
            //     //if($reply_to !='' && filter_var($reply_to, FILTER_VALIDATE_EMAIL)){
    
            //         $message->replyTo($reply_to, $from_name ? $from_name:'');
            //     }
            //     $message->subject($subject);
            //     if (count($attachments)) {
            //         foreach ($attachments as $filename) {
            //             if (file_exists("assets/uploads/" . $filename)) {
            //                 $message->attachData( 'public/assets/uploads/' . $filename, $filename);
            //             }
            //         }
            //     }
            // });
            
        }
        return false;
        // if ($is_send) {
        //         return true;
        // } else {
        //         return false;
        // }
}
function validateEmail($email) {
    // SET INITIAL RETURN VARIABLE
    // ENSURE -> EMAIL ISN'T EMPTY | AN @ SYMBOL IS PRESENT 
        $emailIsValid = FALSE;
        if ( !empty($email) && strpos($email, '@') !== FALSE ) {
            // GET EMAIL PARTS
                $email  = explode('@', $email);
                $user   = $email[0];
                $domain = $email[1];
            // VALIDATE EMAIL ADDRESS
                if (count($email) === 2 &&
                    !empty($user) &&
                    !empty($domain) &&
                    checkdnsrr($domain)
                ) {
                    $emailIsValid = TRUE;
                }
        }
    // RETURN RESULT
        return $emailIsValid;
}
function get_total_emails_group($id){

    $total = ContactGroupEmail::where( array('contact_group_id' => $id))->count();
    return $total;
}

function get_blog_category($blog_id){

    $data =  blogCategories::where(array('id'=>$blog_id))->first();
    if($data){
        return $data->title;
    }else{
        return '';
    }
}

function check_partial_permissions($role_id, $second_level_permissions)
{
    if ($second_level_permissions) {
        $permission_ids = array_column($second_level_permissions->toArray(), 'id');
        // $permissions = rolePermissions::where('role_id', $role_id)->whereIn('permission_id', $permission_ids)->get();
        $permissions = DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id',$role_id)->where('website',$_SERVER['SERVER_NAME'])->get();

        if (count($permissions->toArray()) > 0) {
            return true;
        }
    }
    return false;
}

function getAllCategories(){
    
}

function getTimeZone($id)
{
    $timezones = timeZones::where('id' , $id)->first();
    if ($timezones) {
        return $timezones->TimeZone;
    } else {
        return '0000';
    }
}

function getUserRollRank()
{
    $data = userRolls::where('id',Auth::user()->user_role)->first();
    return $data->ranking;
}
function getFrontDataTimeZone()
{
    $data = siteSettings::first();
    $timezones = timeZones::find($data->timezone);
    if ($timezones) {
        return $timezones->TimeZone;
    } else {
        return 'UTC';
    }
}

function get_blog_image($source_image){
    $image = base_url('assets/uploads/'.get_current_url().'default-blog.png');
    if ($source_image != '') {
        $image = base_url('assets/uploads/'.get_current_url().$source_image);
    }
    return $image;
}
function uploadimg($files, $oldimage = null)
{

    if(strstr($files['type'], '/')){
        $ima_name = rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $files['type'])[1];
    }
    else
    {
        $ima_name = rand(9, 9999) . date('d-m-Y') . '.' . $files['type'];

    }
    $sourcePath = $files['tmp_name'];
    $targetPath = "assets/uploads/" .get_current_url(). $ima_name;
    if (move_uploaded_file($sourcePath, $targetPath)) {
        if ($oldimage && file_exists("assets/uploads/".get_current_url().$oldimage)) {
            unlink("assets/uploads/".get_current_url().$oldimage);
        }
    }
    return $ima_name;
}

function sanitize($text) {
    $text = str_replace("'", '', $text);
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text))
    {
      return 'n-a';
    }

    return $text;
  }

  function show_timed_image($check, $image, $start_time, $end_time,$days, $enable_column = '', $table = '', $id = 0,$type='')
  {

   
      if ($check && !empty($image)) {
    
            $current_time = new DateTime(date('H:i:s'));
            $current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $start_time = new DateTime($start_time);

            $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $end_time = new DateTime($end_time);
            
            $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $days = json_decode($days);
            $day = strtolower($start_time->format('D'));
            // if($enable_column=='enable_timed_hyperlink_image'){
            //     print_r($start_time);
            //     echo "<br>";
            //     print_r($end_time);
            //     echo "<br>";
            //     print_r($current_time);
            //     echo "<br>";
            //     echo $type;  echo "<br>";
            //     print_r($days);
            // }
            if ($current_time < $end_time && $current_time >= $start_time && $type=='timer') {
                return true;
            }
            if ($current_time < $end_time && $current_time >= $start_time && in_array($day,$days)) {
                return true;
            }
      }

      if (!empty($table) && !empty($enable_column) && $id) {

          //$CI->db->update($table, array($enable_column => 0), array('id' => $id));
      }

      return false;
  }
function check_step_image($image)
{
    $notification = NotificationSettings::first();
    $step_image = oneStepImages::where('status',1)->whereNotNull('start_time')->where(function($query) use($image){
        $query->where('first_image_location', $image);
        $query->orWhere('second_image_location',$image);
    })->first();
    
    if ($step_image) {

        if ($step_image->active_time > 0) {
            $current_time = new DateTime();
            $current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
            $current_time->setTimestamp(time());

            $end_time = new DateTime($step_image->start_time, new DateTimeZone(getFrontDataTimeZone()));
            $end_time->add(new DateInterval('PT' . $step_image->active_time . 'M'));

            if ($current_time < $end_time) {
                return get_step_image($step_image, $image);
            } else {
                oneStepImages::where(array('id' => $step_image->id))->update(array('status' => 0, 'active_time' => 0, 'start_time' => null));
                if ($step_image && $step_image->notification_status) {
                    $data['message'] =  $step_image->name . " 1-Step Button Deactivated";
                    sendmail($notification->step_notification_email, '1-Step Buttons','string_template',$data);
                }
                return check_step_image($image);
            }
        } else {
            return get_step_image($step_image, $image);
        }
    }
    return false;
}

function get_font_family()
{
    return FontFamily::getAllFontFamily();
}

function get_step_image($step_image, $image)
{
    if ($step_image->first_image_location == $image) {
        if ($step_image->text_enabled) {
            $first_image = images::find($step_image->first_image_id);
            $textDet = textDetails::find($step_image->first_image_text_id);
            $data = array(
                'image' => $first_image->file_name,
                'text' => $textDet->text,
                'color' => $textDet->color,
                'size' => $textDet->size_web,
                'font' => $textDet->fontfamily,
            );
        } else {
            $first_image = images::find($step_image->first_image_id);
            $data = array(
                'image' => $first_image->file_name,
                'text' => '',
                'color' => '',
                'size' => '',
                'font' => '',
            );
        }
        return $data;
    } elseif ($step_image->second_image_location == $image) {
        if ($step_image->text_enabled) {

            $second_image = images::find($step_image->second_image_id);
            $textDet = textDetails::find($step_image->second_image_text_id);
            $data = array(
                'image' => $second_image->file_name,
                'text' => $textDet->text,
                'color' => $textDet->color,
                'size' => $textDet->size_web,
                'font' => $textDet->fontfamily,
            );
        } else {
            $second_image = images::find($step_image->second_image_id);
            $data = array(
                'image' => $second_image->file_name,
                'text' => '',
                'color' => '',
                'size' => '',
                'font' => '',
            );
        }
        return $data;
    } else {
        return false;
    }
}


function get_emailtemplate_data($id){

    $s_email = EmailPost::where(array('id' => $id))->first();
    return $s_email;

}

function  get_contact_group_by_id($id){


    $cg = ContactGroup::where(array('id' => $id))->first();
    return $cg;
}


function get_prehead_text($text){

    if($text !=""){
        if(strlen($text) < 100){
            $remaing = 120 - strlen($text);
            if($remaing>0){
                for($i =0; $i <=$remaing; $i++){
                    $text = $text.'.';
                }
            }
            return $text;
        }else{
            return $text;
        }
    }

    return $text;
}

function getaddress_info($id){
    $address = addresses::where( array('id' => $id))->first();
    if ($address) {
        return $address;
    } else {
        return '';
    }

}

function getNames($id)
{

    $font_family =icons::where( array('id' => $id))->first();
    if ($font_family) {
        return $font_family->name;
    } else {
        return '';
    }
}


function get_enum_values($table, $field)
{
    $sql = "SHOW COLUMNS FROM " . $table . " LIKE '$field'";
    $result = DB::select($sql);
    $row = $result[0];
    $type = $row->Type;
    preg_match('/enum\((.*)\)$/', $type, $matches);
    $matches[1] = str_replace("'", '', $matches[1]);
    $vals = explode(',', $matches[1]);
    return $vals;
}

function checkSendNotification($subject,$message){
    $notificationSettings = NotificationSettings::first();
    if($notificationSettings->notification_switch=='1'){
        $data = array();
        $data['message'] =  $message;
        if(!strpos($notificationSettings->email_notification,',')){
            sendmail($notificationSettings->email_notification, $subject, 'string_template',$data);
        }else{
            $memails = explode(',',$notificationSettings->email_notification);
            if(is_array($memails) && count($memails)>0){
                foreach($memails as $single){
                    $data['message'] =  $message;
                    sendmail($single, $subject, 'string_template', $data);
                }
            }
        }
    }
}


function base64_encode_password($password){
    $password = base64_encode($password);
    $password = trim($password,'=');
    return $password;
}
function base64_decode_password($password){
    $password = $password.'==';
    $password = base64_decode($password);
    return $password;
}

function get_sa_email_settings(){
    $settings = DB::connection('mysqlDashboard')->table('sa_email_settings')->where('id',1)->first();
    return $settings;
}

function getfontfamily($id)
{

    $font_family = FontFamily::where(array('id' => $id))->first();
    if ($font_family) {
        return $font_family->value;
    } else {
        return '';
    }
}

function audio_enabled($front_section = array())
{
    $enabled = false;
    foreach ($front_section as $section) {
        if ($section->name == 'Audio Feature' && $section->section_enabled) {
            return $section;
            $enabled = true;
            break;
        }
    }
    return $enabled;
}


function geticons($id){

    $icon = icons::where(array('id' => $id))->first();
    if ($icon) {
        return $icon->value;
    } else {
        return '';
    }
}

function getHeaderDisplayName(){
    $data = BusinessInfo::find('1');
    if($data){
        return $data->header_display_name;
    }else{
        return null;
    }
}

function getSectionDetail($section_id){

    $section = frontSections::where(array('id' => $section_id))->first();

    if ($section) {
        return $section;
    } else {

        return '';
    }
}

function getpostimages($postid)
{

    return galleryPostImage::where(array('post_id' => $postid))->get();
}


function getTitleBannerSetting($slug)
{
    return TitleBannerSetting::where(array('title_slug' => $slug))->first();
}

function BrTagExists ($string)
{
    $pattern = '/<br\s*\/?>/';
    return $containsBreakTag = preg_match($pattern, $string);

}

function validateTime ($testTime)
{
    $regExpPattern='/^([01]?[0-9]|2[0-3])([:]?[0-5][0-9])?[ ]?([apAP][mM])?$/';


    return preg_match ($regExpPattern, trim ($testTime));
}

function outlinesActive(){
    return outlineSettings::where('active',1)->count() >0 ? true:false;
}

function getAddresses(){
    return  addresses::all();
}

function getCustomForms(){
    return  customForms::orderBy('title','ASC')->get();
}

function getFrontSections(){
    return  frontSections::orderBy('name','ASC')->get();
}