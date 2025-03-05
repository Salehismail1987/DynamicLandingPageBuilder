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
use App\Models\EngagementNotification;
use App\Models\EventPostImage;
use App\Models\LearningCenterActionButton;
use App\Models\TitleBannerSetting;
use App\Models\rotatingSchedule;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\newsPosts;
use App\Models\ReviewSiteLink;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


function get_current_url()
{
    if (request()->getHost() == '127.0.0.1') {
        return request()->getHost() . '/';
    } else {
        return  '/' . preg_replace('/^www\./', '', request()->getHost()) . '/';
    }
}

function base_url($string = '')
{
    return url($string);
}


function updateFormsCustomEncoding()
{

    $custom_forms = customForms::where('encoded_id', null)->get();
    foreach ($custom_forms as $cf) {
        $encryptedString = Crypt::encryptString($cf->id);
        $hash = md5($encryptedString);
        customForms::where('id', $cf->id)->update(['encoded_id' => $hash]);
    }
}

function getCustomformEncodedID($id)
{
    if ($id) {
        $cf = customForms::where('id', $id)->first();
        if ($cf) {
            $id = $cf->encoded_id;
        }
    }
    return $id;
}

function check_for_nofollow_meta()
{

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
    foreach ($sites_list as $list) {

        if (strpos($base_url, $list) !== false || strpos($path, '/admin/') !== false) {

            return true;
        } else {
            return false;
        }
    }
    return false;
}

function checkFormRequiredFields($request_data, $form_data)
{
    foreach ($request_data as $oldKey => $value) {
        $newKey = strtolower(str_replace('_', ' ', $oldKey));
        $newArray[$newKey] = $value;
    }
    foreach (json_decode($form_data->fields, true) as $field) {
        if ($field['required'] == '1') {
            if (!isset($newArray[strtolower($field['fieldname'])]) || empty($newArray[strtolower($field['fieldname'])])) {
                // dd()
                echo json_encode(array('message' => 'OK', 'captcha' => "Required field '{$field['fieldname']}' is missing"));
                exit;
            }
        }
    }
}

function check_feature_enable_disable($slug)
{
    $front_section = frontSections::where('slug', $slug)->first();
    if ($front_section) {
        if ($front_section->section_enabled == '1') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function isSuperAdmin()
{
    $user = Auth::user();

    if (!$user) {
        return false; // If no authenticated user, return false
    }

    // Extract the domain
    $domain = parse_url(config('app.url'), PHP_URL_HOST); // Get domain from app URL
    $prefix = substr($domain, 0, 3); // First 3 characters of the domain
    // Construct expected email format
    $expectedEmail = "admin.{$prefix}@gmail.com";
    
    // Check email and ID conditions
    $isEmailValid = $user->email === $expectedEmail;
    if($domain == 'localhost')
    {
        $domain = '127.0.0.1';
    }
    $isIdValid = User::where('id', '<', $user->id)->where('website',$domain)->count() === 0; // Ensure no users with smaller ID exist

    return $isEmailValid && $isIdValid;
}

function isSAOnly()
{

    if (Auth::user()->admin_type == '1') {
        return true;
    }
    return false;
}
function check_auth_permission($permission_slug)
{
    if (Auth::user()->admin_type == '1') {
        return true;
    }
    $permissions = null;
    // $permissions = rolePermissions::with('permission')->where('role_id',Auth::user()->user_role)->get();
    $permissions = DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id', Auth::user()->user_role)->where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();
    //print_r($permissions);
    if ($permissions && is_array($permissions->toArray()) && count($permissions->toArray()) > 0) {

        foreach ($permissions as $permission) {
            // $permission = $permission->permission;
            $permission = DB::connection('mysqlDashboard')->table('permissions')->where('id', $permission->permission_id)->where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->first();
            if (isset($permission->permission_slug)) {
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
function cleanString($string)
{
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
function get_messages()
{
    $superadminmessage_links = DB::connection('mysqlDashboard')->table('superadminmessage')->get();
    return $superadminmessage_links;
}

function get_links($id)
{
    $superadminmessage_links = DB::connection('mysqlDashboard')->table('links')->where(array('superadminmessage_id' => $id, 'link_type' => 'superadminmessage'))->get();
    //$superadminmessage_links = $dashboard_db->where(array('superadminmessage_id'=>$id,'link_type'=>'superadminmessage'))->get('links')->result();
    return $superadminmessage_links;
}

function update_outline_settings($slug, $data)
{
    $exist =  outlineSettings::where('slug', $slug)->first();
    if ($exist) {
        $newData = outlineSettings::find($exist->id);
    } else {
        $newData = new outlineSettings();
        $newData->slug = $slug;
    }
    if (isset($data->outline_color)) {
        $newData->outline_color = $data->outline_color;
    }
    if (isset($data->active)) {
        $newData->active = $data->active;
    }
    if ($data->active == '1') {
        OutlineSettings::where('active', '=', '1')->orWhere('time', '!=', null)
            ->update(['active' => '0', 'time' => null]);
        $newData->time = now()->format('H:i:s');
    }
    $newData->active = $data->active;

    $newData->save();
    OutlineSettings::where('id', '!=', $newData->id)
        ->update(['active' => '0']);
}

function updateOutlineActiveStatusIfNeeded()
{
    $hasTimeValue = OutlineSettings::whereNotNull('time')
        ->where('time', '<', now()->subMinutes(5))
        ->exists();

    if ($hasTimeValue) {
        OutlineSettings::query()->update(['active' => '1']);

        OutlineSettings::whereNotNull('time')->update(['time' => null]);

        return true; // or return any other status if needed
    }

    return false;
}

function get_outline_settings($slug)
{

    $data =  outlineSettings::where(array('slug' => $slug))->first();
    if ($data) {
        return $data;
    } else {
        $newData = new outlineSettings();
        $newData->slug = $slug;
        $newData->outline_color = '';
        $newData->active = '0';
        $newData->save();
        return $newData;
    }
}
function get_text_details($slug)
{

    $data =  textDetails::where(array('slug' => $slug))->first();
    if ($data) {
        return $data;
    } else {
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

function get_action_button($slug)
{

    $data =  actionButtons::where(array('slug' => $slug))->first();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function get_all_learning_center_buttons($feature = null)
{
    if ($feature) {
        $data =  LearningCenterActionButton::where('feature_slug', $feature)->get();
    } else {
        $data =  LearningCenterActionButton::all();
    }
    if ($data->count()) {
        return $data;
    } else {
        return false;
    }
}

function update_text_details($slug, $data)
{

    $exist =  textDetails::where('slug', $slug)->first();
    if ($exist) {
        $newData = textDetails::find($exist->id);
    } else {
        $newData = new textDetails();
        $newData->slug = $slug;
    }

    $newData->text = isset($data->text) ? $data->text : '';
    $newData->size_web = isset($data->size_web) ? $data->size_web : '';
    $newData->size_mobile = isset($data->size_mobile) ? $data->size_mobile : '';
    $newData->color = isset($data->color) ? $data->color : '';
    $newData->bg_color = isset($data->bg_color) ? $data->bg_color : '';
    $newData->fontfamily = isset($data->fontfamily) ? $data->fontfamily : '0';
    $newData->tag = isset($data->tag) ? $data->tag : 'h3';
    $newData->save();
}
function update_text_details2($slug, $data)
{
    $exist =  textDetails::where('slug', $slug)->first();
    if ($exist) {
        $newData = textDetails::find($exist->id);
    } else {
        $newData = new textDetails;
        $newData->slug = $slug;
    }
    if (isset($data->text)) {
        $newData->text = $data->text;
    }
    if (isset($data->size_web)) {
        $newData->size_web = $data->size_web;
    }
    if (isset($data->size_mobile)) {
        $newData->size_mobile = $data->size_mobile;
    }
    if (isset($data->color)) {
        $newData->color = $data->color;
    }
    if (isset($data->bg_color)) {
        $newData->bg_color = $data->bg_color;
    }
    if (isset($data->fontfamily)) {
        $newData->fontfamily = $data->fontfamily;
    }
    if (isset($data->tag)) {
        $newData->tag = $data->tag;
    }
    $newData->save();
}

function update_action_button($slug, $data)
{
    if (isset($data->id)) {
        $exist =  actionButtons::where('id', $data->id)->first();
    } else {
        $exist =  actionButtons::where('slug', $slug)->first();
    }
    if ($exist) {
        $newData = actionButtons::find($exist->id);
    } else {
        $newData = new actionButtons();
    }
    if (isset($data->active)) {
        $newData->active = $data->active;
    } else {
        $newData->active = '0';
    }
    $newData->link = $data->link;
    $newData->action_type = $data->action_type;
    $newData->address_id = isset($data->address_id) ? $data->address_id : '0';
    $newData->map_address = isset($data->map_address) ? $data->map_address : '';
    $newData->event_form_id = isset($data->event_form_id) ? $data->event_form_id : 0;
    $newData->custom_form_id = $data->custom_form_id;
    $newData->text = isset($data->text) ? $data->text : '';
    $newData->text_color = isset($data->text_color) ? $data->text_color : '';
    $newData->bg_color = isset($data->bg_color) ? $data->bg_color : '';
    $newData->action_button_textpopup = isset($data->action_button_textpopup) ? $data->action_button_textpopup : '';
    $newData->action_button_phone_no_calls = isset($data->action_button_phone_no_calls) ? $data->action_button_phone_no_calls : '';
    $newData->action_button_phone_no_sms = isset($data->action_button_phone_no_sms) ? $data->action_button_phone_no_sms : '';
    $newData->action_button_action_email = isset($data->action_button_action_email) ? $data->action_button_action_email : '';
    $newData->popup_images = isset($data->popup_images) ? $data->popup_images : $newData->popup_images;
    // dd($data->audio_file);
    if (isset($data->audio_file) && $data->audio_file !== '') {
        $filename = rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $data->audio_file->getClientMimeType())[1];
        $data->audio_file->move("assets/uploads/" . get_current_url(), $filename);
        $newData->action_button_audio = $filename;
    } else {
        $newData->action_button_audio = '';
    }
    if (isset($data->action_button_video)) {
        $newData->action_button_video = $data->action_button_video;
    } else {
        // $newData->action_button_video = '';
    }

    if (isset($data->action_button_audio_icon_feature)) {
        $newData->action_button_audio_icon_feature = $data->action_button_audio_icon_feature;
    } else {
        // $newData->action_button_audio_icon_feature='';
    }
    if (isset($slug)) {
        $newData->slug = $slug;
    }
    $newData->save();
}
function learning_center_update_action_button($feature_slug, $slug, $data)
{

    $exist =  LearningCenterActionButton::where(['feature_slug' => $feature_slug, 'slug' => $slug])->first();
    if ($exist) {
        $newData = $exist;
    } else {
        $newData = new LearningCenterActionButton();
    }
    if (isset($data->active)) {
        $newData->active = $data->active;
    } else {
        $newData->active = '0';
    }
    $newData->link = $data->link;
    $newData->feature_slug = $feature_slug;
    $newData->slug = $slug;
    $newData->action_type = $data->action_type;
    // if($data->action_type == 'audiofeature')
    // dd($data);
    $newData->address_id = isset($data->address_id) ? $data->address_id : '0';
    $newData->map_address = isset($data->map_address) ? $data->map_address : '';
    $newData->custom_form_id = $data->custom_form_id;
    $newData->text = isset($data->text) ? $data->text : '';
    $newData->text_color = isset($data->text_color) ? $data->text_color : '';
    $newData->bg_color = isset($data->bg_color) ? $data->bg_color : '';
    $newData->action_button_textpopup = isset($data->action_button_textpopup) ? $data->action_button_textpopup : '';
    $newData->action_button_phone_no_calls = isset($data->action_button_phone_no_calls) ? $data->action_button_phone_no_calls : '';
    $newData->action_button_phone_no_sms = isset($data->action_button_phone_no_sms) ? $data->action_button_phone_no_sms : '';
    $newData->action_button_action_email = isset($data->action_button_action_email) ? $data->action_button_action_email : '';
    $newData->action_button_audio = isset($data->action_button_audio) ? $data->action_button_audio : $newData->action_button_audio;
    // if(isset($data->audio_file) && $data->audio_file !== '')
    // {
    //     $filename = rand(9, 9999) . date('d-m-Y') . '.'. explode('/', $data->audio_file->getClientMimeType())[1];
    //     $data->audio_file->move("assets/uploads/".get_current_url(),$filename);
    //     $newData->action_button_audio = $filename;
    // } else{
    //     $newData->action_button_audio = '';
    // }
    if (isset($data->action_button_video)) {
        $newData->action_button_video = $data->action_button_video;
    } else {
        // $newData->action_button_video = '';
    }

    if (isset($data->action_button_audio_icon_feature)) {
        $newData->action_button_audio_icon_feature = $data->action_button_audio_icon_feature;
    } else {
        // $newData->action_button_audio_icon_feature='';
    }
    if (isset($slug)) {
        $newData->slug = $slug;
    }
    $newData->save();
}

function update_timed_image_setting($slug, $data)
{

    $exist =  timedImagesSetting::where('slug', $slug)->first();

    if ($exist) {
        $newData = timedImagesSetting::find($exist->id);
    } else {
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

function get_custom_form_data($id)
{
    $data =  customForms::where('id', $id)->first();
    return $data;
}

function get_custom_user_form_data($id, $perpage = null,$folder = null)
{

    if(is_null($folder))
    {
        $folder = 0;
    }
    $data = customUserForm::where('form_id', $id)->orderBy('display_order', 'asc')->where('in_folder',$folder)->orderBy('id', 'desc')->paginate(50, ['*'], 'formlist');
    return $data;
}

function get_custom_user_form_unseen($id)
{
    $data =  customUserForm::where('form_id', $id)->where('seen', '0')->first();

    return $data;
}

function get_opt_out_form_id()
{
    $data =  customForms::where('id', 8)->first('encoded_id');

    return $data;
}

function get_form_id($id = null)
{
    $data =  customForms::where('id', $id)->first('encoded_id');

    return $data;
}

function isJson($string)
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

function get_multiple_detail_custom_user_form_data($id)
{
    $data = DB::table('custom_user_forms')
        ->leftJoin('custom_forms', 'custom_forms.id', '=', 'custom_user_forms.form_id')
        ->select('custom_user_forms.fields_data', 'custom_forms.title as form_name')
        ->whereIn('custom_user_forms.id', $id)
        ->get();
    return $data;
}
function get_detail_custom_user_form_data($id)
{
    $data = DB::table('custom_user_forms')
        ->leftJoin('custom_forms', 'custom_forms.id', '=', 'custom_user_forms.form_id')
        ->select('custom_user_forms.*', 'custom_forms.title as form_name')
        ->where('custom_user_forms.id', $id)
        ->first();
    return $data;
}

function duplicateImage($imageName)
{
    $originalImagePath = 'assets/uploads/' . get_current_url() . $imageName;
    if (file_exists($originalImagePath)) {
        // Generate a unique name for the new image
        $newImageName = rand(9, 9999) . date('d-m-Y') . '.png';
        $newImagePath = 'assets/uploads/' . get_current_url() . $newImageName;

        // Copy the original image to the new path
        copy($originalImagePath, $newImagePath);

        return $newImageName;
    }
}

function saveimagefromdataimage($imagedata, $oldimage = null, $flag = false)
{

    $image = rand(9, 9999) . date('d-m-Y') . '.png';

    list($type, $imagedata) = explode(';', $imagedata);
    list(, $imagedata)      = explode(',', $imagedata);
    $imagedata = base64_decode($imagedata);

    file_put_contents('assets/uploads/' . get_current_url() . $image, $imagedata);

    // if($flag==false){
    //     // Image Compression
    // compress_image($image);
    // }

    if ($oldimage && file_exists("assets/uploads/" . get_current_url() . $oldimage)) {
        unlink("assets/uploads/" . get_current_url() . $oldimage);
    }

    return $image;
}

function save_image($slug, $file_name, $max_width = null, $min_width = null)
{

    $exist =  images::where('slug', $slug)->first();
    $file_to_delete = null;
    if ($exist) {
        $newData = images::find($exist->id);
        $file_to_delete = $exist->file_name;
    } else {
        $newData = new images();
        $newData->slug = $slug;
    }
    if ($file_name) {
        $newData->file_name = $file_name;
    }
    if ($max_width) {
        $newData->max_width = $max_width;
    }
    if ($min_width) {
        $newData->min_width = $min_width;
    }

    $newData->save();

    if ($file_name && $file_to_delete && file_exists("assets/uploads/" . get_current_url() . $file_to_delete)) {
        unlink("assets/uploads/" . get_current_url() . $file_to_delete);
    }
}
function delete_image($slug)
{
    $exist =  images::where('slug', $slug)->first();
    $file_to_delete = $exist->file_name;

    $exist->file_name = '';
    $exist->save();
}

function delimg($image)
{
    if ($image && file_exists("assets/uploads/" . get_current_url() . $image)) {
        unlink("assets/uploads/" . get_current_url() . $image);
    }
}

function get_permissions($id = null)
{

    // $permissions = permissions::orderBy('display_order', 'asc')->where('parent_id' , $id)->get();
    if ($id) {
        $permissions = DB::connection('mysqlDashboard')->table('permissions')->where('parent_id', $id)->where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->orderBy('display_order', 'asc')->get();
    } else {
        $permissions = DB::connection('mysqlDashboard')->table('permissions')->where('parent_id', '0')->where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->orderBy('display_order', 'asc')->get();
    }

    if ($permissions) {
        return $permissions;
    } else {
        return false;
    }
}

function get_timed_image($slug)
{
    $timed_image = timedImagesSetting::where('slug', $slug)->first();
    if ($timed_image) {
        return $timed_image;
    } else {
        return false;
    }
}

function get_image($slug)
{
    $image = images::where('slug', $slug)->first();
    if ($image) {
        return $image;
    } else {
        return false;
    }
}

function get_image_by_id($id)
{

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


function sendmail($email, $subject, $template, $body_data, $attachments = array(), $is_marketing = false)
{
    $business_info = BusinessInfo::first();
    $from_email = $business_info->busniess_contact_email &&  $business_info->busniess_contact_email  != "" ? $business_info->busniess_contact_email : (
        $business_info->contact_email &&  $business_info->contact_email != "" ? $business_info->contact_email : "admin@enfohub.com"
    );
    $from_name = $business_info->busniess_contact_name &&  $business_info->busniess_contact_name  != "" ? $business_info->busniess_contact_name : (
        $business_info->contact_name &&  $business_info->contact_name != "" ? $business_info->contact_name : "enfohub.com"
    );
    $reply_to = 'info@enfohub.com';

    $data = CrmSetting::first();
    if ($is_marketing || true) {
        $from_email = $data->email_marketing_from_email != "" ? $data->email_marketing_from_email  : $from_email;
        $from_name = $data->email_marketing_from_name != "" ? $data->email_marketing_from_name  : $from_name;
        $reply_to = $data->email_marketing_reply_to != "" ? $data->email_marketing_reply_to  : $reply_to;
    }
    $is_send = false;
    //$body = $message;

    //echo $from_email.' '.$reply_to.' '.$from_name.' '.$body; die();
    if ($email != '' && validateEmail($email)) {
        try {
            
            // Mail::to($email)->send(new MailNotify($from_email,$from_name,$reply_to,$subject,$body_data,$template));
            $hostName = $_SERVER['HTTP_HOST'];
            $currentConnection = DB::getDefaultConnection();

            // Get the domain for the current database connection

                $hostName = getDomainFromConnection($currentConnection);
            
            $body_data['note'] = 'Note: This email is generated by ' . $hostName;
            $html = view('emails.' . $template, $body_data)->render();
            $client = new Client();
            $headers = [
                'Authorization' => env('MAILGUN_AUTH_HEADER'),
                'Reply-To' => $reply_to
            ];
            $options = [
                'multipart' => [
                    [
                        'name' => 'from',
                        'contents' => $from_name . ' <' . env('MAIL_FROM_ADDRESS') . '>'
                    ],
                    [
                        'name' => 'to',
                        'contents' => $email
                    ],
                    [
                        'name' => 'subject',
                        'contents' => $subject
                    ],
                    [
                        'name' => 'html',
                        'contents' => $html
                    ]
                ]
            ];
            $request = new \GuzzleHttp\Psr7\Request('POST', env('MAILGUN_ENDPOINT'), $headers);
            $res = $client->sendAsync($request, $options)->wait();
            $res->getBody();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    return false;
}
function validateEmail($email)
{
    // SET INITIAL RETURN VARIABLE
    // ENSURE -> EMAIL ISN'T EMPTY | AN @ SYMBOL IS PRESENT 
    $emailIsValid = FALSE;
    if (!empty($email) && strpos($email, '@') !== FALSE) {
        // GET EMAIL PARTS
        $email  = explode('@', $email);
        $user   = $email[0];
        $domain = $email[1];
        // VALIDATE EMAIL ADDRESS
        if (
            count($email) === 2 &&
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
function get_total_emails_group($id)
{

    $total = ContactGroupEmail::where(array('contact_group_id' => $id))->count();
    return $total;
}

function get_blog_category($blog_id)
{

    $data =  blogCategories::where(array('id' => $blog_id))->first();
    if ($data) {
        return $data->title;
    } else {
        return '';
    }
}

function check_partial_permissions($role_id, $second_level_permissions)
{
    if ($second_level_permissions) {
        $permission_ids = array_column($second_level_permissions->toArray(), 'id');
        // $permissions = rolePermissions::where('role_id', $role_id)->whereIn('permission_id', $permission_ids)->get();
        $permissions = DB::connection('mysqlDashboard')->table('role_permissions')->where('role_id', $role_id)->where('website', preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']))->get();

        if (count($permissions->toArray()) > 0) {
            return true;
        }
    }
    return false;
}

function getAllCategories() {}

function getTimeZone($id)
{
    // Cache timezone data for each $id for 60 minutes
    return Cache::remember('timezone_' . $id, 60, function () use ($id) {
        $timezones = TimeZones::where('id', $id)->first();

        if ($timezones) {
            return $timezones->TimeZone;
        } else {
            return '0000';
        }
    });
}

function getUserRollRank()
{
    $data = userRolls::where('id', Auth::user()->user_role)->first();
    return $data->ranking;
}
function getFrontDataTimeZone()
{
    $cachedTimezone = Cache::get('front_data_timezone');

    if ($cachedTimezone === null) {
        // Fetch data from database
        $data = SiteSettings::first();
        $timezones = TimeZones::find($data->timezone);

        // Determine the timezone to use
        if ($timezones) {
            $timezone = $timezones->TimeZone;
        } else {
            $timezone = 'UTC';
        }

        // Cache the timezone data for 60 minutes
        Cache::put('front_data_timezone', $timezone, now()->addMinutes(60));
    } else {
        $timezone = $cachedTimezone;
    }

    return $timezone;
}

function get_blog_image($source_image)
{
    $image = base_url('assets/uploads/' . get_current_url() . 'default-blog.png');
    if ($source_image != '') {
        $image = base_url('assets/uploads/' . get_current_url() . $source_image);
    }
    return $image;
}
function uploadimg($files, $oldimage = null)
{
    if (strstr($files['type'], '/')) {
        $ima_name = rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $files['type'])[1];
    } else {
        $ima_name = rand(9, 9999) . date('d-m-Y') . '.' . $files['type'];
    }
    $sourcePath = $files['tmp_name'];
    $targetPath = "assets/uploads/" . get_current_url() . $ima_name;
    if (move_uploaded_file($sourcePath, $targetPath)) {
        if ($oldimage && file_exists("assets/uploads/" . get_current_url() . $oldimage)) {
            unlink("assets/uploads/" . get_current_url() . $oldimage);
        }
    }
    return $ima_name;
}

function sanitize($text)
{
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

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function show_timed_image($check, $image, $start_time, $end_time, $days, $enable_column = '', $table = '', $id = 0, $type = '')
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

        // if($enable_column=='enable_timed_popup_image'){
        //     echo 'start time: '; print_r($start_time);
        //     echo "<br>";
        //     echo 'end time: ';  print_r($end_time);
        //     echo "<br>";
        //     echo 'current time: '; print_r($current_time);
        //     echo "<br>";
        //     echo  'type: '; echo $type;  echo "<br>";
        //     print_r($days);
        //     // exit;
        // }

        if ($current_time < $end_time && $current_time >= $start_time && $type == 'timer') {
            return true;
        }
        if ($current_time < $end_time && $current_time >= $start_time && in_array($day, $days)) {
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
    $step_image = oneStepImages::where('status', 1)->whereNotNull('start_time')->where(function ($query) use ($image) {
        $query->where('first_image_location', $image);
        $query->orWhere('second_image_location', $image);
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
                    sendmail($notification->step_notification_email, '1-Step Buttons', 'string_template', $data);
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


function get_emailtemplate_data($id)
{

    $s_email = EmailPost::where(array('id' => $id))->first();
    return $s_email;
}

function  get_contact_group_by_id($id)
{


    $cg = ContactGroup::where(array('id' => $id))->first();
    return $cg;
}


function get_prehead_text($text)
{

    if ($text != "") {
        if (strlen($text) < 100) {
            $remaing = 120 - strlen($text);
            if ($remaing > 0) {
                for ($i = 0; $i <= $remaing; $i++) {
                    $text = $text . '.';
                }
            }
            return $text;
        } else {
            return $text;
        }
    }

    return $text;
}

function getaddress_info($id)
{
    $address = addresses::where(array('id' => $id))->first();
    if ($address) {
        return $address;
    } else {
        return '';
    }
}

function getNames($id)
{

    $font_family = icons::where(array('id' => $id))->first();
    if ($font_family) {
        return $font_family->name;
    } else {
        return '';
    }
}

function updateRotationalCalendar($data)
{
    $i = 0;
    $dataToMap = [];
    $toShiftAtEnd = [];
    $toShiftAtStart = [];
    foreach ($data as $single) {
        $newData = rotatingSchedule::find($single->id);
        $date = date("Y-m-d");
        if ($newData->date < $date) {
            $toShiftAtEnd[] = $single;
        }
        $newData->date = date('Y-m-d', strtotime("+" . $i . " day", strtotime($date)));
        $newData->day = date('D', strtotime("+" . $i . " day", strtotime($date)));

        $newData->start = $data[$i]->start;
        $newData->end = $data[$i]->end;
        $newData->comments = isset($data[$i + 1]->comments) ? $data[$i + 1]->comments : '';
        $newData->start = isset($data[$i + 1]->start) ? $data[$i + 1]->start : '';
        $newData->end = isset($data[$i + 1]->end) ? $data[$i + 1]->end : '';
        $newData->start_2 = isset($data[$i + 1]->start_2) ? $data[$i + 1]->start_2 : '';
        $newData->end_2 = isset($data[$i + 1]->end_2) ? $data[$i + 1]->end_2 : '';
        $newData->comments_2 = isset($data[$i + 1]->comments_2) ? $data[$i + 1]->comments_2 : '';
        $newData->image = isset($data[$i + 1]->image) ? $data[$i + 1]->image : '';
        $newData->image_description = isset($data[$i + 1]->image_description) ? $data[$i + 1]->image_description : '0';
        $newData->description_font_size = isset($data[$i + 1]->description_font_size) ? $data[$i + 1]->description_font_size : '';
        $newData->description_font_family = isset($data[$i + 1]->description_font_family) ? $data[$i + 1]->description_font_family : '';
        $newData->duplicate_for_next_week_day = (isset($data[$i + 1]->duplicate_for_next_week_day) && $data[$i + 1]->duplicate_for_next_week_day) ? '1' : '0';
        $newData->save();
        $i++;
    }
    $nextDay = 7;
    foreach ($toShiftAtEnd as $data) {
        $schedule = rotatingSchedule::where('date', date('Y-m-d', strtotime("+" . $nextDay . " day", strtotime($data->date))))->first();
        if ($schedule) {
            $schedule->start = $data->start;
            $schedule->end = $data->end;
            $schedule->comments = isset($data->comments) ? $data->comments : '';
            $schedule->start_2 = isset($data->start_2) ? $data->start_2 : '';
            $schedule->end_2 = isset($data->end_2) ? $data->end_2 : '';
            $schedule->comments_2 = isset($data[$i]->comments_2) ? $data->comments_2 : '';
            $schedule->image_description = isset($data->image_description) ? $data->image_description : '0';
            $schedule->description_font_size = isset($data->description_font_size) ? $data->description_font_size : '';
            $schedule->description_font_family = $data->description_font_family;
            $schedule->duplicate_for_next_week_day = (isset($data->duplicate_for_next_week_day) && $data->duplicate_for_next_week_day) ? '1' : '0';
            $schedule->image = isset($data->image) ? $data->image : '';
            $schedule->save();
        }
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

function checkSendNotification($subject, $message, $slug = null, $email_slug = null)
{
    $notificationSettings = NotificationSettings::first();
    $data = array();
    $data['message'] =  $message;
    if ($notificationSettings->notification_switch == '1' && $slug == null) {
        if (!strpos($notificationSettings->email_notification, ',')) {
            sendmail($notificationSettings->email_notification, $subject, 'string_template', $data);
        } else {
            $memails = explode(',', $notificationSettings->email_notification);
            if (is_array($memails) && count($memails) > 0) {
                foreach ($memails as $single) {
                    $data['message'] =  $message;
                    sendmail($single, $subject, 'string_template', $data);
                }
            }
        }
    } else if ($slug !== null && $notificationSettings->$slug && $email_slug) {
        if (!strpos($notificationSettings->$email_slug, ',')) {
            $a = sendmail($notificationSettings->$email_slug, $subject, 'string_template', $data);
        } else {
            $memails = explode(',', $notificationSettings->$email_slug);
            if (is_array($memails) && count($memails) > 0) {
                foreach ($memails as $single) {
                    $data['message'] =  $message;
                    $a = sendmail($single, $subject, 'string_template', $data);
                }
            }
        }
    }
}


function base64_encode_password($password)
{
    $password = base64_encode($password);
    $password = trim($password, '=');
    return $password;
}
function base64_decode_password($password)
{
    $password = $password . '==';
    $password = base64_decode($password);
    return $password;
}

function get_sa_email_settings()
{
    $settings = DB::connection('mysqlDashboard')->table('sa_email_settings')->where('id', 1)->first();
    $settings->email_info_link = 'https://learnabout.enfohub.com';
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


function geticons($id)
{

    $icon = icons::where(array('id' => $id))->first();
    if ($icon) {
        return $icon->value;
    } else {
        return '';
    }
}

function getHeaderDisplayName()
{
    $data = BusinessInfo::find('1');
    if ($data) {
        return $data->header_display_name;
    } else {
        return null;
    }
}

function getSectionDetail($section_id = null, $section_name = null)
{
    $query = frontSections::query();

    if (!is_null($section_id)) {
        $query->where('id', $section_id);
    }

    if (!is_null($section_name)) {
        $query->where('name', $section_name); // Adjust 'name' to match your column name
    }

    $section = $query->first();

    return $section ?: false;
}

function getSectionOrder($slug)
{

    $section = frontSections::where(array('slug' => $slug))->first();

    if ($section) {
        return $section->display_order;
    } else {

        return 100000000;
    }
}

function updateRotatingSchedule()
{
    // Cache rotating schedules if not already cached
    $rotatingSchedules = Cache::remember('rotating_schedules', 60, function () {
        return RotatingSchedule::get();
    });

    $rotatingSchedule = $rotatingSchedules->where('date', '<', date('Y-m-d'));

    if ($rotatingSchedule->count() > 0) {
        $maxDate = RotatingSchedule::max('date');
        $maxId = RotatingSchedule::max('id');
        $idsToDelete = [];

        foreach ($rotatingSchedule as $row) {
            $maxId++;
            $maxDate = date('Y-m-d', strtotime($maxDate . '+1 days'));

            $newSchedule = new RotatingSchedule;
            $newSchedule->id = $maxId;
            $newSchedule->day = $row->day;
            $newSchedule->date = $maxDate;
            $newSchedule->start = $row->start;
            $newSchedule->end = $row->end;
            $newSchedule->comments = $row->comments;
            $newSchedule->start_2 = $row->start_2;
            $newSchedule->end_2 = $row->end_2;
            $newSchedule->comments_2 = $row->comments_2;
            $newSchedule->image_description = $row->image_description;
            $newSchedule->description_font_size = $row->description_font_size;
            $newSchedule->description_font_family = $row->description_font_family;
            $newSchedule->image = $row->image;
            $newSchedule->duplicate_for_next_week_day = isset($row->duplicate_for_next_week_day) ? $row->duplicate_for_next_week_day : 0;
            $newSchedule->save();

            $idsToDelete[] = $row->id;
        }

        // Delete old records
        RotatingSchedule::whereIn('id', $idsToDelete)->delete();
    }

    // Check total count of schedules
    $totalCount = RotatingSchedule::count();

    // If total count is less than 14, add new schedule
    if ($totalCount < 14) {
        $maxId = RotatingSchedule::max('id') + 1;
        $maxDate = date('Y-m-d', strtotime(RotatingSchedule::max('date') . '+1 days'));

        $newSchedule = new RotatingSchedule;
        $newSchedule->id = $maxId;
        $newSchedule->day = date('D', strtotime($maxDate));
        $newSchedule->date = $maxDate;
        $newSchedule->duplicate_for_next_week_day = 1;
        $newSchedule->save();
    }

    // Reorder IDs starting from 1
    $minId = RotatingSchedule::min('id');
    $records = RotatingSchedule::all();
    foreach ($records as $record) {
        $record->id -= $minId - 1;
        $record->save();
    }
}

function updateTimedImages()
{
    // Update timedImagesSetting
    $timedImagesSettings = Cache::remember('timed_images_settings_cache', 60, function () {
        return TimedImagesSetting::get();
    });

    foreach ($timedImagesSettings as $timedImage) {
        try {
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $timedImage->end_time, getFrontDataTimeZone());
            $current_time = Carbon::now(getFrontDataTimeZone());

            if (($current_time->greaterThan($end_time) && $timedImage->type == 'timer') ||
                ($current_time->greaterThan($end_time) && $timedImage->type == 'days' && $timedImage->days && in_array(strtolower($current_time->format('D')), json_decode($timedImage->days)))
            ) {
                DB::table('timed_images_settings')->where('id', $timedImage->id)->update(['enable' => '0']);
            }
        } catch (\Exception $e) {
            Log::error('Error updating timedImagesSetting: ' . $e->getMessage());
        }
    }

    // Update newsPosts
    $newsPosts = Cache::remember('news_posts_cache', 60, function () {
        return newsPosts::where('enable_timed_image', true)->get();
    });

    foreach ($newsPosts as $newsPost) {
        try {
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $newsPost->timed_image_end_time, getFrontDataTimeZone());
            $current_time = Carbon::now(getFrontDataTimeZone());

            if (($current_time->greaterThan($end_time) && $newsPost->timed_image_type == 'timer') ||
                ($current_time->greaterThan($end_time) && $newsPost->timed_image_type == 'days' && $newsPost->timed_image_days && in_array(strtolower($current_time->format('D')), json_decode($newsPost->timed_image_days)))
            ) {
                newsPosts::where('id', $newsPost->id)->update(['enable_timed_image' => false]);
            }
        } catch (\Exception $e) {
            Log::error('Error updating newsPosts: ' . $e->getMessage());
        }
    }
}

function getpostimages($postid)
{

    return galleryPostImage::where(array('post_id' => $postid))->get();
}

function getEncodedId($id)
{
    return customForms::where('event_id', $id)->first('encoded_id');
}

function getEventImages($id)
{
    $images = EventPostImage::where('event_id', $id)->get();
    if ($images) {
        return $images;
    } else {
        return null;
    }
}

function getAttendence($id)
{
    $form = customForms::where('event_id', $id)->first(['id', 'fields']);


    if ($form) {
        $fieldsArray = json_decode($form->fields, true);
        $fieldsArray = array_map("unserialize", array_unique(array_map("serialize", $fieldsArray)));
        $fieldsArray = array_values($fieldsArray);

        $fieldsArray = array_values(array_filter($fieldsArray, function ($field) {
            return $field['fieldname'] !== 'hidden';
        }));
        $fieldsArray = array_values($fieldsArray);
        // Get the second field name
        $firstFieldName = $fieldsArray[0]['fieldname'] ?? 'Name';
        $secondFieldName = $fieldsArray[1]['fieldname'] ?? 'Business';
        $thirdFieldName = $fieldsArray[2]['fieldname'] ?? 'Yes/Maybe';
        $fourthFieldName = $fieldsArray[3]['fieldname'] ?? 'Guest No.';

        if (isset($fieldsArray[3]['options'])) {
            $options = $fieldsArray[3]['options'];
        }
        if (isset($fieldsArray[5]['column_label'])) {
            $fourthFieldName = $fieldsArray[5]['column_label'];
        } else if (isset($fieldsArray[5]) && $fieldsArray[5]['fieldname'] !== 'Will you bring guest(s), if so, indicate how many?') {
            $fourthFieldName = $fieldsArray[5]['fieldname'];
        } else {
            $fourthFieldName = 'Guest No.'; // Default value
        }
        if (isset($fieldsArray[3]['column_label'])) {
            $fifthFieldName = $fieldsArray[3]['column_label'];
        } elseif ($fieldsArray[3]['fieldname'] !== 'Will you be attending the event?') {
            $fifthFieldName = $fieldsArray[3]['fieldname'];
        } else {
            $fifthFieldName = 'Yes/Maybe'; // Default value
        }
        $records = CustomUserForm::where('form_id', $form->id)
            ->where('display', 1)
            ->get();

        $valueCount = [];

        foreach ($records as $key => $record) {
            // Decode the fields_data JSON and normalize the array
            $fieldsData = json_decode($record->fields_data, true);
            $data = array_values($fieldsData);
            // Check if index 4 (option) and index 5 (guests) exist
            if (isset($data[3])) {
                // Normalize the value at index 4
                $fieldValue = strip_tags($data[3]);

                // Initialize the count and guest count if not already set
                if (!isset($valueCount[$fieldValue])) {
                    $valueCount[$fieldValue] = [
                        'count' => 0,
                        'guests' => 0,
                    ];
                }

                // Increment the count for this option
                $valueCount[$fieldValue]['count']++;

                // Add to the guest count if index 5 exists and is numeric
                if (isset($data[5])) {
                    $valueCount[$fieldValue]['guests'] += (int)$data[5];
                }
            }
        }


        $valueCount = array_values($valueCount);
        // dd($valueCount);

        // dd($valueCount);
        $total_records = $records->count();
        $count_yes = $valueCount[0] ?? 0;
        $count_maybe = $valueCount[1] ?? 0;
        $firstFieldName = $fieldsArray[0]['column_label'] ?? $fieldsArray[0]['fieldname'] ?? 'Name';
        $secondFieldName = $fieldsArray[1]['column_label'] ?? $fieldsArray[1]['fieldname'] ?? 'Business';
        $thirdFieldName = $fieldsArray[2]['column_label'] ?? $fieldsArray[2]['fieldname'] ?? 'Yes/Maybe';
        $fourthFieldName = $fieldsArray[5]['column_label'] ?? $fieldsArray[5]['fieldname'] ?? 'Guest No.';

        return  [
            'options' => $options ?? '',
            'total_records' => $total_records,
            'count_maybe' => $count_maybe,
            'count_yes' => $count_yes,
            'second_field' => $secondFieldName,
            'third_field' => $thirdFieldName,
            'fourth_field' => $fourthFieldName,
            'fifth_field' => $fifthFieldName,
            'first_field' => $firstFieldName
        ];
    } else {
        return null;
    }
}



function getFormTitle($id)
{
    $data = customForms::where('id', $id)->first('title');
    return $data->title;
}
function getTitleBannerSetting($slug)
{
    return TitleBannerSetting::where(array('title_slug' => $slug))->first();
}

function BrTagExists($string)
{
    $pattern = '/<br\s*\/?>/';
    return $containsBreakTag = preg_match($pattern, $string);
}

function validateTime($testTime)
{
    $regExpPattern = '/^([01]?[0-9]|2[0-3])([:]?[0-5][0-9])?[ ]?([apAP][mM])?$/';


    return preg_match($regExpPattern, trim($testTime));
}

function outlinesActive()
{
    return outlineSettings::where('active', 1)->count() > 0 ? true : false;
}

function getAddresses()
{
    return  addresses::all();
}

function getCustomForms()
{
    return  customForms::orderBy('title', 'ASC')->get();
}

function getFrontSections()
{
    return  frontSections::orderBy('name', 'ASC')->get();
}

function getReviewSitesLinks()
{
    return ReviewSiteLink::get();
}

function saveActionButtonImages($popupImages)
{
    $uploadedFileNames = [];
    foreach ($popupImages as $img) {
        $file = $img;
        $file_name = $img->getClientOriginalName();

        $file_ext = $img->extension();
        $fileInfo = $img->path();
        $file = [
            "name" => $file_name,
            "type" => $file_ext,
            "tmp_name" => $fileInfo,
            "error" => 0,
            "size" => $img->getSize()
        ];
        $uploadedFileName = uploadimg($file, null);
        if ($uploadedFileName) {
            $uploadedFileNames[] = $uploadedFileName;
        }
    }
    return $jsonFileNames = json_encode($uploadedFileNames);
}

function getLikes($category = null)
{
    if ($category) {
        return DB::table('likes')->where('category', $category)->value('count');
    }

    return DB::table('likes')
            ->groupBy('category') // Group by category to get the sum for each category
            ->select('category', DB::raw('SUM(count) as total_likes'))
            ->pluck('total_likes', 'category')
            ->toArray();
}

function countComments()
{
    return DB::table('engagement_comments')->where('display',1)->count();
}

function notificationSend($real_time = null)
{
    $notification = EngagementNotification::first();
        if ($notification) {
            // Update the notification_sent to 0 if the record exists
            $notification->notification_sent = 0;
            if($real_time == true)
            {
                $notification->check_for_likes_and_comments = 0;
            }
            $notification->save(); // Save the changes
        }
}

function getDomainFromConnection($connectionName)
    {
        // Mapping of DB connections to domains
        $databaseDomainMapping = [
            'TEMP7' => 'temp7.enfohub.com',
            'TEMP5' => 'temp5.enfohub.com',
            'BROWSVV' => 'browsvv.com',
            'TRICITYAIR' => 'tri-cityair.com',
            'BRANDYSTRAVEL' => 'brandystravel.com',
            'VISIONTRAT' => 'visionztatts.com',
            'FREEYOURSELFFROM' => 'freeyourselffromchronicpain.com',
            'MARIACUISINE' => 'mariascuisine.com',
            'PERSONALTRAINER' => 'personaltraining-scv.com',
            'PEDROVALLEYLANDSCAPING' => 'pedrosvalleylandscaping.com',
            'DEMONICFABRICATION' => 'demonicfabrication.com',
            'TEMP8' => 'temp8.enfohub.com',
            'MARYKAYAV' => 'marykay-av.com',
            'STUFFETC' => 'stuffetc-av.com',
            'HIBACHIOSAKA' => 'hibachi-osaka.com',
            'TORTASFOODTRUCK' => 'tortasfoodtruck.com',
            'ELHAURACHONHD' => 'elhuarachonhd.com',
            'HDFAMILYEVENTS' => 'hdfamilyevents.com',
            'TESTSITE2' => 'testsite2.enfohub.com',
            'DEFAULTWEBSITE' => 'defaultwebsite.enfohub.com',
            'TESTSITE3' => 'testsite3.enfohub.com',
            'TESTSITE4' => 'testsite4.enfohub.com',
            'PROMO' =>   'promo24.enfohub.com',
            'GOOG' => 'goog.enfohub.com',
            'OFFICESPACE' => 'officespacevictorville.com',
            'INSURVV' => 'insurvv.com',
            //'MOBILENOTARY' => 'mobilenotaryvictorville.com',
            'CHINGONATACOS' => 'chingona-tacos.com',
            'CVSREALTOR' => 'cvs-realtor.com',
            'LACASITA' => 'lacasita.enfohub.com',
            'ELCOWBOYBOOTS' => 'elcowboyboots.enfohub.com',
            'TWEED' => 'tweed.enfohub.com',
            'YELLOWSTONE' => 'yellowstonehibachi.com',
            'DRIPPGANGFASHION' => 'drippgangfashion.com',
            'REST1' => 'rest1.enfohub.com',
            'GARDENERS' => 'gardeners.enfohub.com',
            'BAR' => 'bar.enfohub.com',
            'POOL' => 'pool.enfohub.com',
            'HANDYMAN' => 'handyman.enfohub.com',
            'HAIR' => 'hair.enfohub.com',
            'GROOMING' => 'grooming.enfohub.com',
            'FOODTRUCK' => 'foodtruck.enfohub.com',
            'FOODSTAND' => 'foodstand.enfohub.com',
            'DONUTS' => 'donuts.enfohub.com',
            'CONTRACTOR' => 'contractor.enfohub.com',
            'CLEANING' => 'cleaning.enfohub.com',
            'DASHBOARD' => 'dashboard.enfohub.com',
            'GARDENER' => 'gardener.enfohub.com',
            'STORE' => 'store.enfohub.com',
            'RESTAURANT' => 'restaurant.enfohub.com',
            'POPUPALERT' => 'popupalert.enfohub.com',
            'HEAVENLYANIHOMECARE' => 'heavenlyanihomecare.com',
            'LEARNABOUT' => 'learnabout.enfohub.com',
            'OLD' => '723westmountdr202.com',
            'NIAISMYGROOMER' => 'niaismygroomer.com',
            '6363CHRISTIEAVE' => '6363christieave-2601.com',
            '723WESTMOUNTDR202' => '723westmountdr202.com',
            '3281MANDEVILLE' => '3281mandevillecanyonrd.com',
            'AMERICANLIFESTYLEPROP' => 'americanlifestyleproperties.com',
            'BEMYREFERRAL_DATABASE' => 'bemyreferral.enfohub.com',
            '16118ANDOVERDR' => '16118andoverdr.com',
            'SAFETYCONSULTING' => 'hd-safetyconsulting.com',
            'SMALLBIZZ' => 'smallbizlessons.enfohub.com',
            'HUMBELBIRD' => 'humblebirdchicken.enfohub.com',
            'SMITTYS' => 'smittysjamaicanfryingbatter.com',
            'ATTEND' => 'attend.enfohub.com',
            'RECIPEAPP' => 'recipeapp.enfohub.com',
            'WORKOUT' => 'workout.enfohub.com',
            'TASK' => 'taskapp.enfohub.com',
            'MEETING' => 'themeetingroomvictorville.com',
            'ALLOUTNAILZ' => 'alloutnailzzz-av.com',
            'TEMP1' => 'temp1.enfohub.com',
            'TEMP2' => 'temp3.enfohub.com',
            'TRAINING' => 'training.enfohub.com',
            'TRAINING1' => 'training1.enfohub.com',
            'FOODTRUCK1' => 'foodtruck1.enfohub.com',
            'FOODTRUCK2' => 'foodtruck2.enfohub.com',
            'GRIPACADEMY' => 'thegripacademy.com',
            'enfohub_staging' => 'staging.enfohub.com',
            'NETWORK103' => 'scv-network103.enfohub.com',
            'AVNETWORK' => 'av-network102.enfohub.com',
            'VICTORVILLENETWORK' => 'victorville-network101.enfohub.com',
            'STORE2' => 'store2.enfohub.com',
            'SIMMONS' => 'simmonsphotobyphone.com',
            
        ];

        // Check if the connection name exists in the mapping and return the domain
        return $databaseDomainMapping[$connectionName] ?? null;
    }
