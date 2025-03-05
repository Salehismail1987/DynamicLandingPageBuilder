<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationSettings;
use App\Models\customForms;
use App\Models\customFormsSettings;
use App\Models\responsesFolder;
use App\Models\alertPopupSetting;
use App\Models\frontSections;
use App\Models\customUserForm;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;
use Illuminate\Support\Facades\Crypt;
use App\Models\ImageGalleryCategory;
use App\Models\addresses;
use App\Models\AttendhubPost;
use App\Models\AttenhubDate;
use App\Models\EventPostImage;
use App\Models\EventPostSetting;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendhubController extends Controller
{
    public function __construct()
    {
        $this->data['controller'] = 'attendhub';
        $this->data['controller_name'] = 'Attendhub';
        $this->data['font_family'] = get_font_family();
        $this->data['notificationSettings'] = NotificationSettings::first();

        $this->data['all_categories'] = ImageGalleryCategory::all();
        $this->data['customForms'] = customForms::orderBy('response_display_order', 'ASC')->get();
        $this->data['response_folders'] = responsesFolder::get();
        $this->data['customFormsSettings'] = customFormsSettings::first();
        $this->data['imageCategories'] = ImageGalleryCategory::get();
    }
    public function index(Request $request)
    {

        $itemsPerPage = $request->input('event_list_per_page', 10); /* (Hassan) Adding dynamically changeable per page limiter */
        $formsPerPage = $request->input('form_list_per_page', 10); /* (Hassan) Adding dynamically changeable per page limiter */
        $responsesPerPage = $request->input('response_list_per_page', 10); /* (Hassan) Adding dynamically changeable per page limiter */
        $this->data['customForms'] = customForms::whereNotNull('event_id')
            ->where('event_id', '!=', '')
            ->orderBy('id', 'DESC')->paginate($formsPerPage, ['*'], 'formlist');
        $this->data['customFormsAll'] = customForms::orderBy('id', 'DESC')->get();
        $this->data['events'] = AttendhubPost::orderBy('id', 'DESC')->paginate($itemsPerPage, ['*'], 'formlist');
        // dd($this->data['events']);
        $this->data['customFormsSettings'] = customFormsSettings::first();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['form_logo'] = get_image('custom_form_logo');
        $this->data['form_title'] = get_text_details('form_title');
        $this->data['form_subtitle'] = get_text_details('form_subtitle');
        $this->data['form_descriptive_text'] = get_text_details('form_descriptive_text');
        $this->data['form_footer_text_1'] = get_text_details('custom_form_footer_text_1');
        $this->data['form_footer_text_2'] = get_text_details('custom_form_footer_text_2');
        $this->data['generic_settings'] = EventPostSetting::first();
        $this->data['form_ids'] = customForms::whereNotNull('event_id')->get('id');
        $form_ids = $this->data['form_ids']->pluck('id');
        $this->data['event_responses'] = customUserForm::orderBy('form_id', 'DESC')->whereIn('form_id', $form_ids)
            ->groupBy('form_id')
            ->paginate($responsesPerPage, ['*'], 'formlist');
        return view('admin.attendhub')->with($this->data);
    }

    public function addView()
    {
        $this->data['event_forms'] = AttendhubPost::orderBy('id', 'DESC')->get();
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        if (!check_auth_permission('attendhub_posts')) {
            return  redirect('quicksettings')->withError('Access Denied');
        }
        return view('admin.attendhubpost.add', $this->data);
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'sub_title' => 'required',
        ]);
        AttendhubPost::where('display_order', '>=', 0) // Select rows with display_order >= 0
            ->increment('display_order', 1);
        $newData = new AttendhubPost();
        $newData->sub_title = $request->sub_title ? $request->sub_title : '';
        $newData->post_title_size_web = $request->post_title_size_web ? $request->post_title_size_web : '26';
        $newData->post_title_size_mobile = $request->post_title_size_mobile ? $request->post_title_size_mobile : '12';
        $newData->post_title_color = $request->post_title_color ? $request->post_title_color : '';
        $newData->font_family = $request->font_family ? $request->font_family : 51;
        $newData->display_counter = $request->has('display_counter') ? 1 : 1;
        $newData->counter_date_time_fonts = $request->counter_date_time_fonts ? $request->counter_date_time_fonts : 1;
        $newData->counter_date_time_font_size = $request->counter_date_time_font_size ? $request->counter_date_time_font_size : '16';
        $newData->event_form_id = $request->event_form_id ? $request->event_form_id : '';

        $newData->post_description = $request->post_description ? $request->post_description : '';
        $newData->display = true;
        // $newData->post_desc_font_size = $request->post_desc_font_size?$request->post_desc_font_size:'';
        $newData->post_title_color = $request->post_title_color ? $request->post_title_color : '';
        $newData->action_button_active = $request->action_button_active ? 1 : 0;
        $newData->action_button_description = $request->action_button_description ? $request->action_button_description : '';
        $newData->action_button_description_color = $request->action_button_description_color ? $request->action_button_description_color : '#ffffff';
        $newData->action_button_bg_color = $request->action_button_bg_color ? $request->action_button_bg_color : '#000000';
        $newData->action_button_link = $request->action_button_link ? $request->action_button_link : '';
        $newData->action_button_link_text = $request->action_button_link_text ? $request->action_button_link_text : '';
        $newData->action_button_customform = $request->action_button_customform ? $request->action_button_customform : '';
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms ? $request->action_button_phone_no_sms : '';
        $newData->action_button_action_email = $request->action_button_action_email ? $request->action_button_action_email : '';
        $newData->action_button_map_address = $request->action_button_map_address ? $request->action_button_map_address : '';
        $newData->action_button_textpopup = $request->action_button_textpopup ? $request->action_button_textpopup : '';
        $newData->image_size = $request->image_size ? $request->image_size : 400;
        $img_name = '';
        $newData->display_order = 0;
        if (isset($request->action_button_video)) {
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
            $newData->action_button_video = uploadimg($file, null);
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        if (isset($request->action_button_audio_icon_feature)) {
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
            $newData->action_button_audio_icon_feature = uploadimg($file, null);
        }
        $newData->save();
        $event_id = $newData->id;

        $eventDates = $request->input('event_date');
        $fromTimes = $request->input('from_time');
        $toTimes = $request->input('to_time');
        $eventDay = $request->input('event_day');
        foreach ($eventDates as $index => $eventDate) {
            // You can validate or perform additional checks here if necessary

            // Create a new AttenhubDate record
            if (isset($eventDate) || $fromTimes[$index] || $toTimes[$index] || $eventDay[$index]) {
                // dD($eventDay[$index]);
                $res = AttenhubDate::create([
                    'attenhub_id' => $event_id,
                    'event_date' => $eventDate ?? null,
                    'from_time' => $fromTimes[$index] ?? null,
                    'to_time' => $toTimes[$index] ?? null,
                    'event_day' => $eventDay[$index] ?? null
                ]);
            }
        }

        if ($request->userfile) {
            foreach ($request->userfile as $request_image) {
                if ($request_image != '') {
                    $newData2 = new EventPostImage();
                    $newData2->event_id = $event_id;
                    $newData2->image = saveimagefromdataimage($request_image);
                    $img_name = $newData2->image;
                    $newData2->save();
                }
            }
        }
        $newForm = new customForms;
        $newForm->title = $request->sub_title;
        $newForm->event_id = $event_id;
        $newForm->descriptive = strip_tags($request->post_description);
        if (isset($img_name) && $img_name != '') {
            $newForm->image = duplicateImage($img_name);
        }
        $newForm->image_size = $request->image_size;
        $encryptedString = Crypt::encryptString(rand(9999, 9999999));
        $hash = md5($encryptedString);
        $newForm->encoded_id = $hash;
        $form_fields[] = array(
            'fieldname' => 'Your name',
            'fieldtype' => 'text',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "0",
            'column_label' => 'Name'
        );
        $form_fields[] = array(
            'fieldname' => 'Business name',
            'fieldtype' => 'text',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "0",
            'column_label' => 'Business Name'
        );
        $form_fields[] = array(
            'fieldname' => 'Phone number',
            'fieldtype' => 'text',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "1"
        );
        $form_fields[] = array(
            'fieldname' => 'Will you be attending the event?',
            'fieldtype' => 'radio',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "1",
            'column_label' => 'Yes/Maybe',
            'options' => array(
                array('option_name' => 'Yes', 'otherfield' => "0"),
                array('option_name' => 'Maybe', 'otherfield' => "0")
            )
        );
        $form_fields[] = array(
            'fieldname' => 'Are you new?',
            'fieldtype' => 'radio',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "0",
            'options' => array(
                array('option_name' => 'No', 'otherfield' => "0"),
                array('option_name' => 'Yes', 'otherfield' => "0"),
            )
        );
        $form_fields[] = array(
            'fieldname' => 'Bringing guests? Specify how many (numbers only)',
            'fieldtype' => 'text',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "0",
            'column_label' => 'Guests?'
        );
        $form_fields[] = array(
            'fieldname' => 'Comments',
            'fieldtype' => 'text',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "0"
        );
        $form_fields[] = array(
            'fieldname' => 'hidden',
            'fieldtype' => 'hidden',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "0"
        );
        $newForm->fields = json_encode($form_fields);
        $newForm->save();
        $message = 'Attendhub Post has been created';
        $block = '';

        checkSendNotification('Attendhub Post Post has been created', $message);
        return redirect()->route('editeventform', ['id' => $newForm->id])
        ->with('success', 'Set Column Titles in the Form Maker section to complete a new Event');
    
        }

    public function editEvent(Request $request, $id = null)
    {
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['event_forms'] = AttendhubPost::orderBy('id', 'DESC')->get();
        $this->data['event'] = AttendhubPost::where('id', $id)->first();
        $this->data['event_images'] = EventPostImage::where('event_id', $id)->get();

        return view('admin.attendhubpost.edit')->with($this->data);
    }

    public function updatePost(Request $request, $id = null)
    {
        // dd($request->action_button_textpopup);
        $newData = AttendhubPost::where('id', $id)->first();
        $newData->post_title_size_web = $request->post_title_size_web ? $request->post_title_size_web : '';
        $newData->post_title_size_mobile = $request->post_title_size_mobile ? $request->post_title_size_mobile : '';
        $newData->post_title_color = $request->post_title_color ? $request->post_title_color : '';
        $newData->font_family = $request->font_family ? $request->font_family : 51;
        $newData->counter_date_time_fonts = $request->counter_date_time_fonts ? $request->counter_date_time_fonts : 1;
        $newData->counter_date_time_font_size = $request->counter_date_time_font_size ? $request->counter_date_time_font_size : null;
        // $newData->from_time = $request->from_time ? $request->from_time : null;
        // $newData->to_time = $request->to_time ? $request->to_time : null;
        // $newData->event_date = $request->event_date ? $request->event_date : null;
        $newData->display_counter = $request->has('display_counter') ? 1 : 0;
        $newData->post_description = $request->post_description ? $request->post_description : '';
        $newData->post_title_color = $request->post_title_color ? $request->post_title_color : '';
        $newData->action_button_active = $request->action_button_active ? 1 : 0;
        $newData->action_button_description = $request->action_button_description ? $request->action_button_description : '';
        $newData->action_button_description_color = $request->action_button_description_color ? $request->action_button_description_color : '';
        $newData->action_button_bg_color = $request->action_button_bg_color ? $request->action_button_bg_color : '';
        $newData->action_button_link = $request->action_button_link ? $request->action_button_link : '';
        $newData->action_button_link_text = $request->action_button_link_text ? $request->action_button_link_text : '';
        $newData->action_button_customform = $request->action_button_customform ? $request->action_button_customform : '';
        $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls ? $request->action_button_phone_no_calls : '';
        $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms ? $request->action_button_phone_no_sms : '';
        $newData->action_button_action_email = $request->action_button_action_email ? $request->action_button_action_email : '';
        $newData->action_button_map_address = $request->action_button_map_address ? $request->action_button_map_address : '';
        $newData->action_button_textpopup = $request->action_button_textpopup ? $request->action_button_textpopup : '';
        $newData->image_size = $request->image_size ? $request->image_size : '';
        $newData->event_form_id = $request->event_form_id ? $request->event_form_id : '';
        $img_name = '';
        if ($request->userfile) {
            foreach ($request->userfile as $request_image) {
                if ($request_image != '') {
                    $newData2 = new EventPostImage();
                    $newData2->event_id = $newData->id;
                    $newData2->image = saveimagefromdataimage($request_image);
                    $newData2->save();
                }
            }
        }
        // if ($request->image) {
        //     $newData->image = saveimagefromdataimage($request->image);
        //     $img_name = $newData->image;
        // }
        if (isset($request->action_button_video)) {
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
            $newData->action_button_video = uploadimg($file, null);
        }
        if (isset($request->popup_action_images)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images);
        }
        if (isset($request->action_button_audio_icon_feature)) {
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
            $newData->action_button_audio_icon_feature = uploadimg($file, null);
        }
        // dd($newData);
        $newData->save();
        $newData->attenhubDates()->delete();

        // Insert the new dates
        foreach ($request->event_date as $index => $event_date) {
            if (isset($event_date) || $request->from_time[$index] || $request->to_time[$index] ||  $request->event_day[$index]) {
                $newData->attenhubDates()->create([
                    'event_date' => $event_date ?? null,
                    'from_time' => $request->from_time[$index] ?? null,
                    'to_time' => $request->to_time[$index] ?? null,
                    'event_day' => $request->event_day[$index] ?? null,
                ]);
            }
        }
        $event_id = $newData->id;
        $newForm = new customForms;
        $newForm->title = $request->sub_title;
        $newForm->descriptive = $request->post_description;
        if (isset($img_name) && $img_name != '') {
            $newForm->image = duplicateImage($img_name);
        }
        $newForm->image_size = $request->image_size;
        $encryptedString = Crypt::encryptString(rand(9999, 9999999));
        $hash = md5($encryptedString);
        $newForm->encoded_id = $hash;
        $form_fields[] = array(
            'fieldname' => 'Your name',
            'fieldtype' => 'text',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "0"
        );
        $form_fields[] = array(
            'fieldname' => 'Business name',
            'fieldtype' => 'text',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "0"
        );
        $form_fields[] = array(
            'fieldname' => 'Phone number',
            'fieldtype' => 'text',
            'required' => "0",
            'formenable' => "1",
            'show_response' => "1"
        );
        $form_fields[] = array(
            'fieldname' => 'Will you be attending the event?',
            'fieldtype' => 'radio',
            'required' => "1",
            'formenable' => "1",
            'show_response' => "1",
            'options' => array(
                array('option_name' => 'Yes', 'otherfield' => "0"),
                array('option_name' => 'No', 'otherfield' => "0"),
                array('option_name' => 'Maybe', 'otherfield' => "0")
            )
        );
        $newForm->fields = json_encode($form_fields);
        $newForm->save();
        $message = 'News Event Post has been created';
        $block = '';

        checkSendNotification('News Event Post has been created', $message);
        return  redirect('attendhub')->withSuccess($this->data['controller_name'] . ' has been added successfully');
    }

    public function saveAttendhubPostorder(Request $request)
    {
        $message = 'Attendhub Post order has been updated successfully';
        $block = 'custom_forms_list';
        $i = 1;
        foreach ($request->attendhubPosts as $single) {
            AttendhubPost::where('id', $single)->update(['display_order' => $i]);
            $i++;
        }
        checkSendNotification('Attendhub Post has been updated', $message);
        return redirect('attendhub?block=' . $block)->withSuccess($message);
    }

    public function saveGenericSettings(Request $request)
    {
        $block = 'attendhub_post_generic_settings';

        $messages = [
            'font_family.required' => 'Font family is required.',
            'title_text_size_mobile.required' => 'Title text size for mobile is required.',
            'title_text_size_web.required' => 'Title text size for web is required.',
            'title_text_color.required' => 'Title text color is required.',
            'description_font.required' => 'Description font is required.',
            'desc_text_size_mobile.required' => 'Description text size for mobile is required.',
            'desc_size_web.required' => 'Description size for web is required.',
            'feature_bg_color.required' => 'Feature background color is required.',
            'desc_text_color.required' => 'Description text color is required.',
        ];

        // Validate the incoming request with custom messages
        $validator = Validator::make($request->all(), [
            'font_family' => 'required|string',
            'title_text_size_mobile' => 'required|integer',
            'title_text_size_web' => 'required|integer',
            'title_text_color' => 'required|string',
            'description_font' => 'required|string',
            'desc_text_size_mobile' => 'required|integer',
            'desc_size_web' => 'required|integer',
            'feature_bg_color' => 'required|string',
            'desc_text_color' => 'required|string',
        ], $messages);
        if ($validator->fails()) {
            return redirect('attendhub?block=' . $block)
                ->withErrors($validator)
                ->withInput();
        }
        // Check if the record exists
        $eventPostSetting = EventPostSetting::first(); // Assuming you're checking for the record with id = 1
        $data = [
            'sub_title_font' => $request->input('font_family'),
            'counter_date_time_fonts' => $request->input('counter_date_time_fonts'),
            'counter_date_time_font_size' => $request->input('counter_date_time_font_size'),
            'title_text_size_mobile' => $request->input('title_text_size_mobile'),
            'title_text_size_web' => $request->input('title_text_size_web'),
            'title_text_color' => $request->input('title_text_color'),
            'description_font' => $request->input('description_font'),
            'desc_text_size_mobile' => $request->input('desc_text_size_mobile'),
            'desc_size_web' => $request->input('desc_size_web'),
            'feature_bg_color' => $request->input('feature_bg_color'),
            'desc_text_color' => $request->input('desc_text_color'),
        ];


        if ($eventPostSetting) {
            // Update the existing record
            $eventPostSetting->counter_date_time_fonts =  $request->input('counter_date_time_fonts');
            $eventPostSetting->counter_date_time_font_size =  $request->input('counter_date_time_font_size');

            $res = $eventPostSetting->update($data);
            // dd($res);
        } else {
            // Create a new record if it doesn't exist
            $eventPostSetting = EventPostSetting::create($data);
        }
        // }

        return  redirect('attendhub?block=' . $block)->withSuccess($this->data['controller_name'] . ' has been updated successfully');
    }

    public function fetchData(Request $request)
    {
        $data = [];
        $form_id = customForms::where('event_id', $request->post_id)->first('id');
        if ($form_id) {
            $responses = customUserForm::where('form_id', $form_id->id)->where('display', true)->get();
            if ($responses) {
                foreach ($responses as $response) {
                    $fieldsData = json_decode($response->fields_data, true);
                    $values = array_values($fieldsData);
                    $data[] = [
                        'id' => $response->id, // Include the response ID
                        'name' => $values[0] ?? '', // Access the decoded values safely
                        'business' => $values[1] ?? '',
                        'attendance' => ucfirst(explode('<br>', $values[3])[0] ?? ''),
                        'new' => (isset($values[4]) && strip_tags($values[4]) == 'yes') ? 1 : 0,
                        'guest' => !empty($values[5]) ? $values[5] : '',
                        'comment' => '
                        <svg ' . (isset($values[6]) && $values[6] != "" ?
                            'onclick="openPopupText(\'text_popup' . $response->id . '\')"' : '') . '
                                class="comment-svg" width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_13202_38862)">
                                            <ellipse cx="13.5" cy="8" rx="9.5" ry="8" fill="' . ((isset($values[6]) && $values[6] != '') ? '#3FA8F9' : '#ADADAD') . '" />
                                </g>
                                <path d="M13.5 13.5397C13.1517 13.5397 12.8536 13.4373 12.6057 13.2326C12.3575 13.0276 12.2333 12.7812 12.2333 12.4935H14.7667C14.7667 12.7812 14.6427 13.0276 14.3949 13.2326C14.1466 13.4373 13.8483 13.5397 13.5 13.5397ZM10.9667 11.9704V10.9243H16.0333V11.9704H10.9667ZM11.125 10.4012C10.3967 10.0438 9.81886 9.56428 9.39157 8.96274C8.96386 8.3612 8.75 7.70736 8.75 7.0012C8.75 5.91146 9.21191 4.98526 10.1357 4.22262C11.0591 3.45962 12.1806 3.07812 13.5 3.07812C14.8194 3.07812 15.9409 3.45962 16.8643 4.22262C17.7881 4.98526 18.25 5.91146 18.25 7.0012C18.25 7.70736 18.0364 8.3612 17.6091 8.96274C17.1814 9.56428 16.6033 10.0438 15.875 10.4012H11.125Z" fill="white" />
                                <defs>
                                    <filter id="filter0_d_13202_38862" x="0" y="0" width="27" height="24" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                        <feOffset dy="4" />
                                        <feGaussianBlur stdDeviation="2" />
                                        <feComposite in2="hardAlpha" operator="out" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13202_38862" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13202_38862" result="shape" />
                                    </filter>
                                </defs>
                            </svg>',
                        'text_popup' => isset($values[6]) && $values[6] != "" ? '
                        <div style="display:none" id="text_popup' . $response->id . '">
                            ' . htmlspecialchars($values[6]) . '
                        </div>
                    ' : ''


                    ];
                }
                return response()->json([
                    'status' => 'success',
                    'data' => $data,
                ]);
            } else {
                return false;
            }
        } else {
            return false;
        }


        return response()->json($data);
    }

    public function updateVisibility(Request $request)
    {
        // dd($request);
        $request->validate([
            'id' => 'required|integer', // Replace your_table_name with your actual table
            'display' => 'required|boolean',
        ]);

        $form = customUserForm::find($request->id);
        $form->display = $request->display;
        $form->save();
        return response()->json(['status' => 'success', 'message' => 'Display status updated successfully!']);
    }


    public function deleteItem(Request $request)
    {
        // Retrieve the item ID from the request
        $itemId = $request->input('id')[0]; // Assuming you're sending a single ID in an array

        // Find the item
        $item = customUserForm::find($itemId);

        // Check if the item exists
        if ($item) {
            $form = customForms::where('id', $item->form_id)->first();
            $event = AttendhubPost::where('id', $form->event_id)->first();
            if ($event) {
                return response()->json(['success' => false, 'message' => 'Please delete the Event Post first.']);
            }
            $item->delete(); // Delete the item
            return response()->json(['success' => true]);
        }

        // Item not found
        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

    public function deleteItems(Request $request)
    {
        // Fetch the 'ids' from the request
        $itemIds = $request->input('ids');

        if (!empty($itemIds)) {
            $response = customUserForm::where('id', $itemIds[0])->first();
            $form = customForms::where('id', $response->form_id)->first();
            AttendhubPost::where('id', $form->event_id)->delete();
            customForms::where('id', $response->form_id)->delete();
            $form->delete();
            return response()->json(['success' => true]);
        }



        // If no IDs provided or deletion fails
        return response()->json(['success' => false]);
    }

    public function deleteForms(Request $request)
    {
        // Fetch the 'ids' from the request
        $itemIds = $request->input('ids');

        if (!empty($itemIds)) {
            $failed = 0;
            $event_check = false;
            foreach ($itemIds as $itemId) {
                // Fetch the form for each itemId
                $form = customForms::where('id', $itemId)->first();

                if ($form) {
                    // Delete related custom user forms

                    // Delete the related attendhub post
                    $exists = AttendhubPost::where('id', $form->event_id)->first();
                    if ($exists) {
                        $failed++;
                        $event_check = true;
                        continue;
                    }

                    // Delete the form itself
                    $form->delete();
                }
            }
            if ($event_check && $failed > 0) {

                return response()->json(['success' => false, 'message' => $failed . ' Forms were not deleted, please delete their Event Posts first.']);
            }

            return response()->json(['success' => true]);
        }

        // If no IDs provided or deletion fails
        return response()->json(['success' => false]);
    }

    public function deleteSingleForm(Request $request)
    {
        // Fetch the 'ids' from the request
        $itemId = $request->input('id')[0];
        if (!empty($itemId)) {


            $form = customForms::where('id', $itemId)->first();

            if ($form) {

                $exist = AttendhubPost::where('id', $form->event_id)->first();
                if ($exist) {
                    return response()->json(['success' => false, 'message' => 'Please delete the Event Post first.']);
                }
                $form->delete();
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function deleteGroup(Request $request)
    {
        $groupId = $request->input('group');
        // Delete all items in the specified group
        $form = customForms::where('id', $groupId)->first();
        $exists = AttendhubPost::where('id', $form->event_id)->first();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Please delete the Event Post first.']);
        }
        customUserForm::where('form_id', $groupId)->delete();
        $form->delete();
        return response()->json(['success' => true]);
    }

    public function deleteEvent(Request $request)
    {
        $rows = $request->input('rows');
        $uniqueRows = array_unique($rows);
        if (!empty($uniqueRows)) {
            $forms = customForms::whereIn('event_id', $uniqueRows)->get();
            $form_ids = $forms->pluck('id');
            customUserForm::whereIn('form_id', $form_ids)->delete();
            AttendhubPost::whereIn('id', $uniqueRows)->delete();
            customForms::whereIn('event_id', $uniqueRows)->delete();
        }
        return response()->json(['success' => true]);
    }

    public function updateGenericSettings(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'is_generic' => 'required|boolean',
        ]);

        // Update the generic settings
        $genericSettings = EventPostSetting::first(); // Get the settings from the database

        if ($genericSettings) {
            $genericSettings->is_generic = $request->is_generic; // Update the setting
            $genericSettings->save(); // Save changes

            return response()->json(['message' => 'Settings updated successfully.']);
        }

        return response()->json(['message' => 'Settings not found.'], 404);
    }

    public function editForm(Request $request)
    {
        if (!check_auth_permission(['form-list'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $this->data['detail_info'] = customForms::with('actionButtons')->find($request->id);
        $this->data['formAction'] = 'edit';
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['custom_forms']  = customForms::with('actionButtons')->orderBy('title', 'ASC')->get();
        $this->data['addresses'] = addresses::all();
        // $this->data['disable_remove_button']
        $responses = customUserForm::where('form_id',$request->id)->count();
        if($responses > 0)
        {
            $this->data['disable_remove_button'] = true;
        }
        else
        {
            $this->data['disable_remove_button'] = false;
        }

        if (session()->has('success')) {
            $this->data['success'] = session('success'); // Retrieve the flash message
        } else {
            $this->data['success'] = null; // No message if not set
        }

        return view('admin.attendhubpost.addedit')->with($this->data);
    }

    public function enableMultipleEvents(Request $request)
    {

        // Get the IDs of the checked events
        $checkedIds = $request->input('data.ids', []);
        $selectAll = $request->input('data.selectAll', 0);

        // Set the display value based on the major switch
        $displayValue = ($selectAll != 'false') ? 1 : 0;
        // Update the display status for checked IDs based on the major switch value
        $res = AttendhubPost::whereIn('id', $checkedIds)->update(['display' => $displayValue]);

        return response()->json(['message' => 'Records updated successfully']);
    }


    public function enableMultipleResponses(Request $request)
    {
        $checkedIds = $request->input('data.ids', []);
        $selectAll = $request->input('data.selectAll', 0);

        // Set the display value based on the major switch
        $displayValue = ($selectAll != 'false') ? 1 : 0;
        // Update the display status for checked IDs based on the major switch value
        $res = customUserForm::whereIn('id', $checkedIds)->update(['display' => $displayValue]);

        return response()->json(['status' => 'success', 'message' => 'Display status updated successfully!']);
    }

    public function disableMultipleResponses(Request $request)
    {
        $checkedIds = $request->input('data.ids', []);
        $selectAll = $request->input('data.selectAll', 0);

        // Set the display value based on the major switch
        //    dd($selectAll);
        $displayValue = ($selectAll != 'false' && $selectAll != "0") ? 1 : 0;
        // Update the display status for checked IDs based on the major switch value
        $res = customUserForm::whereIn('id', $checkedIds)->update(['display' => $displayValue]);

        return response()->json(['status' => 'success', 'message' => 'Display status updated successfully!']);
    }

    public function enableSingleEvent(Request $request)
    {
        // Update the display status for the given event ID
        $event = AttendhubPost::find($request->id);
        $event->display = $request->display; // Update display value
        $event->save(); // Save changes

        return response()->json(['message' => 'Switch state updated successfully']);
    }

    public function enableSingleResponse(Request $request)
    {

        $response = customUserForm::find($request->id);

        if ($response) {
            // Set display to 1 (display the event)
            $response->display = 1;
            $response->save();

            return response()->json(['success' => true, 'message' => 'Response displayed on frontend.']);
        }

        return response()->json(['success' => false, 'message' => 'Response not found.'], 404);
    }

    public function disableSingleResponse(Request $request)
    {

        $response = customUserForm::find($request->id);

        if ($response) {
            // Set display to 1 (display the event)
            $response->display = 0;
            $response->save();

            return response()->json(['success' => true, 'message' => 'Response displayed on frontend.']);
        }

        return response()->json(['success' => false, 'message' => 'Response not found.'], 404);
    }

    public function updateAttenhubComment(Request $request)
    {
        $data = customUserForm::where('id', $request->attenhub_response_id)->first();
        if ($data) {
            $updated_field_data = json_decode($data->fields_data, true);
            $updated_field_data = array_values($updated_field_data);
            $updated_field_data[6] = $request->comment;
            $data->fields_data = json_encode($updated_field_data);
            $data->save();
            $message = 'Comment has been updated successfully';
            return redirect('attendhub')->withSuccess($message);
        } else {
            $message = 'Comment could not be updated';
            return redirect('attendhub')->withSuccess($message);
        }
    }

    public function updateNewStatus(Request $request)
    {
        $data = customUserForm::where('id', $request->id)->first();
        if ($data) {
            $updated_field_data = json_decode($data->fields_data, true);
            $updated_field_data['Are You New?'] = 'no';
            $data->fields_data = json_encode($updated_field_data);
            $data->save();
            return response()->json(['success' => true, 'message' => 'Response status has been updated successfully']);
        } else {
            $message = 'Response could not be updated';
            return response()->json(['success' => false, 'message' => $message], 404);
        }
    }

    public function saveMultipleEmails(Request  $request)
    {
        $settings = customFormsSettings::first();
        $settings->attenhub_notification_emails = $request->attenhub_notification_emails;
        $settings->save();
        $message = 'Emails for notifications updated successfully';
        return redirect('attendhub')->withSuccess($message);
    }

    public function editAttenhubForm(Request $request)
    {
        $this->data['formdata'] = get_detail_custom_user_form_data($request->id);
        $this->data['form_detail'] = customForms::find($this->data['formdata']->form_id);
        if (isset($_GET['block'])) {
            $this->data['block'] = $_GET['block'];
        }
        return view('admin.attenhubforms.edit')->with($this->data);
    }

    public function updateAttenhubForm(Request $request)
    {
        $formdata = array();
        unset($_POST['_token']);
        foreach ($_POST as $key => $value) {
            if($key == 'record_id')
            {
                continue;
            }
            if (!strpos($key, 'txto')) {
                $field_name = trim(ucwords(str_replace('_', ' ', $key)));
                if (is_array($value)) {
                    $tempval = '';
                    foreach ($value as $ss) {
                        if ($ss == 'other') {
                            $tempval .= $request->{$key . 'txto'} . '<br>';
                        } else {
                            $tempval .= $ss . '<br>';
                        }
                    }
                    $formdata[$field_name] = $tempval;
                } else {
                    if ($value == 'other') {
                        $formdata[$field_name] = $request->{$key . 'txto'};
                    } else {
                        $formdata[$field_name] = $value;
                    }
                }
            }
        }
        foreach ($_FILES as $key => $value) {
            if (!empty($_FILES[$key]['name'])) {
                $ima_name = rand(9, 9999) . date('d-m-Y') . $_FILES[$key]['name'];
                $sourcePath = $_FILES[$key]['tmp_name'];
                $targetPath = "assets/uploads/" . get_current_url() . $ima_name;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $formdata['files'][$key] = $ima_name;
                }
            } else if (isset($_POST['old_' . $key])) {
                $formdata['files'][$key] = $_POST['old_' . $key];
            } else {
                $formdata['files'][$key] = '';
            }
        }
        $customUserForm = customUserForm::find($request->record_id);
        $customUserForm->fields_data = json_encode($formdata);
        $customUserForm->save();

        $message = 'Event Response has been updated successfully';
        checkSendNotification('Event Form Response has been updated', $message, 'form_notifications', 'form_notification_email');
        $block = 'custom_forms_responses_list';
        if (isset($_GET['block'])) {
            $block = $_GET['block'];
        }
        return redirect('attendhub?block=' . $block)->withSuccess($message);
    }

    public function detailAttenhubForm(Request $request){
        $this->data['formdata'] = get_detail_custom_user_form_data($request->id);
        $data = customUserForm::find($request->id);
        $data->seen = '1';
        $data->save();
        $this->data['form_detail'] = customForms::find($this->data['formdata']->form_id);
        if(isset($_GET['block'])){
            $this->data['block'] = $_GET['block'];
        }
        return view('admin.attenhubforms.detail')->with($this->data);
    }
}
