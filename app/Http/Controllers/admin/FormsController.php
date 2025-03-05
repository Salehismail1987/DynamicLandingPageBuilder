<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\actionButtons;
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
use PhpParser\Node\Expr\Cast\Object_;

class FormsController extends Controller
{
    public function __construct()
    {
        $this->data['controller'] = 'forms';
        $this->data['controller_name'] = 'Forms';
        $this->data['font_family'] = get_font_family();
        $this->data['notificationSettings'] = NotificationSettings::first();

        $this->data['all_categories'] = ImageGalleryCategory::all();

        $this->data['imageCategories'] = ImageGalleryCategory::get();
    }
    public function index(Request $request)
    {
        if (!check_auth_permission(['form-list', 'form-reports', 'form-settings'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $itemsPerPage = $request->input('form_list_per_page', 10); /* (Hassan) Adding dynamically changeable per page limiter */
        $this->data['customForms'] = customForms::where('event_id',null)->orderBy('display_order', 'ASC')->paginate($itemsPerPage, ['*'], 'formlist');
        $this->data['customFormsAll'] = customForms::where('event_id',null)->orderBy('response_display_order', 'ASC')->get();
        $this->data['response_folders'] = responsesFolder::get();
        $this->data['customFormsSettings'] = customFormsSettings::first();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['form_logo'] = get_image('custom_form_logo');
        $this->data['form_title'] = get_text_details('form_title');
        $this->data['form_subtitle'] = get_text_details('form_subtitle');
        $this->data['form_descriptive_text'] = get_text_details('form_descriptive_text');
        $this->data['form_footer_text_1'] = get_text_details('custom_form_footer_text_1');
        $this->data['form_footer_text_2'] = get_text_details('custom_form_footer_text_2');

        return view('admin.forms')->with($this->data);
    }
    public function saveFormOrder(Request $request)
    {
        $message = 'Forms order has been updated successfully';
        $block = 'custom_forms_list';
        $i = 1;
        foreach ($request->forms as $single) {
            customForms::where('id', $single)->update(['display_order' => $i]);
            $i++;
        }
        checkSendNotification('Form has been updated', $message, 'form_notifications', 'form_notification_email');
        return redirect('forms?block=' . $block)->withSuccess($message);
    }
    public function addForm(Request $request)
    {
        if (!check_auth_permission(['form-list'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['custom_forms']  = customForms::with('actionButtons')->orderBy('title', 'ASC')->get();
        $this->data['formAction'] = 'add';
        $this->data['addresses'] = addresses::all();
        return view('admin.forms.addedit')->with($this->data);
    }
    public function saveForm(Request $request)
    {
        if (!check_auth_permission(['form-list'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }

        $route = $request->route();

        // Get the route name
        $routeName = $route->getName();

        // Get the action (controller method)
        $routeAction = $route->getActionName();

        // Print the route details (for debugging purposes)
        $action = $request->formAction;
        $message = 'Forms has been ' . ($action == 'edit' ? 'updated' : 'added') . ' successfully';
        $block = 'custom_forms_list';
        if ($action == 'edit') {
            $newData = customForms::find($request->formid);
        } else {
            $newData = new customForms();
        }
        if ($request->formAction == 'duplicate' && isset($request->duplicateImge)) {
            $newData->image = duplicateImage($request->duplicateImge);
        }
        if ($request->userfile) {
            if (isset($newData) && isset($newData->image)) {
                delimg($newData->image);
            }
            $newData->image = saveimagefromdataimage($request->userfile);
        }
        $newData->title = $request->title;
        $newData->subtitle = $request->subtitle;
        $newData->descriptive = $request->descriptive;
        $newData->footer_text_1 = $request->footer_text_1;
        $newData->footer_text_2 = $request->footer_text_2;
        $newData->image_size = $request->image_size;
        $encryptedString = Crypt::encryptString(rand(9999, 9999999));
        $hash = md5($encryptedString);
        $newData->encoded_id = $hash;
        if ($action != 'edit') {
            $newData->display_order = 0;
            $newData->response_display_order = 0;
        }

        $form_fields = array();
        if (isset($request->field_id)) {

            if ($request->formid == '8') {
                $form_fields[] = array(
                    'fieldname' => 'Full name',
                    'fieldtype' => 'text',
                    'required' => "1",
                    'formenable' => "1",
                    'show_response' => "1"
                );
                $form_fields[] = array(
                    'fieldname' => 'Email',
                    'fieldtype' => 'text',
                    'required' => "1",
                    'formenable' => "1",
                    'show_response' => "1"
                );
                $form_fields[] = array(
                    'fieldname' => 'Phone number',
                    'fieldtype' => 'text',
                    'required' => "0",
                    'formenable' => "1",
                    'show_response' => "1"
                );
            }

            if ($request->formid == '7') {
                $form_fields[] = array(
                    'fieldname' => 'Full name',
                    'fieldtype' => 'text',
                    'required' => "1",
                    'formenable' => "1",
                    'show_response' => "1"
                );
                $form_fields[] = array(
                    'fieldname' => 'Email',
                    'fieldtype' => 'text',
                    'required' => "1",
                    'formenable' => "1",
                    'show_response' => "1"
                );
                $form_fields[] = array(
                    'fieldname' => 'Phone number',
                    'fieldtype' => 'text',
                    'required' => "0",
                    'formenable' => "1",
                    'show_response' => "1"
                );
            }
            if(isset($request->hidden) && $request->hidden == 'event_form')
            {
                $form_fields[] = array(
                    'fieldname' => 'hidden',
                    'fieldtype' => 'hidden',
                    'required' => "0",
                    'formenable' => "0",
                    'show_response' => "0",
                    'column_label' => null,
                    'value' => 'event_form',
                );
            }
            foreach ($request->field_id as $single) {
                // if($single || $request->fieldtype[$single]=='image'){

                if (isset($request->fieldname[$single]) && ($request->fieldname[$single] || $request->fieldtype[$single] == 'image')) {
   

                    $temp_array = array(
                        'fieldname' => $request->fieldname[$single],
                        'fieldtype' => isset($request->fieldtype[$single]) ? $request->fieldtype[$single] : 'text',
                        'required' => isset($request->required[$single]) ? "1" : "0",
                        'formenable' => isset($request->formenable[$single]) ? "1" : "0",
                        'show_response' => isset($request->show_response[$single]) ? "1" : "0",
                        'column_label' => isset($request->columnLabel[$single]) ? $request->columnLabel[$single] : null,
                    );

                    if ($request->fieldtype[$single] == 'radio' || $request->fieldtype[$single] == 'checkbox' || $request->fieldtype[$single] == 'select' || $request->fieldtype[$single] == 'multiselect') {
                        $option_array = array();
                        if (isset($request->oprtionname[$single]) && $request->oprtionname[$single]) {
                            $op = 0;
                            foreach ($request->oprtionname[$single] as $singleop) {
                                if ($singleop) {
                                    $option_array[] = array('option_name' => $singleop, 'otherfield' => (isset($request->otherfield[$single][$op]) ? "1" : "0"));
                                }
                                $op++;
                            }
                        }
                        $temp_array['options'] = $option_array;
                    } else if ($request->fieldtype[$single] == 'image') {
                        if (isset($request->qimg[$single]) && $request->qimg[$single]) {
                            $temp_array['image'] =  saveimagefromdataimage($request->qimg[$single]);
                        } else if (isset($request->image_name[$single]) && $request->image_name[$single]) {
                            $temp_array['image'] =  $request->image_name[$single];
                        }
                        $temp_array['image_desc'] = $request->image_desc[$single];
                    } else if ($request->fieldtype[$single] == 'comment_only') {
                        $temp_array['comment_desc'] = $request->comment_desc[$single];
                    }
                    $form_fields[] = $temp_array;
                }
            }
        }
        $show_response_count = 0;

        
        // Iterate over the array
        foreach ($form_fields as $item) {
            if ($item["show_response"] == "1") {
                $show_response_count++;
            }
        }
        if ($show_response_count > 4) {
            return redirect('forms?block=' . $block)->withError('More than 4 responses can not be activated');
        }
        $newData->fields = json_encode($form_fields);
        $newData->save();
        $insertedId = $newData->id;
        // dd($request->all());
        $i = 0;
        $rules = [];
        if(isset($request->slug))
        {
            $buttonCount = count($request->slug);
        for ($a = 0; $a < $buttonCount; $a++) {
            $rules["action_button_description.$a"] = 'required|string|max:255';
        }
        // dd($request->all());
        $request->validate($rules);
        }
        
        if (isset($request->action_button_description)) {
            foreach ($request->action_button_description as $key => $data) {

                $data =  (object)[];
                // $key = $key-1;
                $data->active = '1';
                $data->id = isset($request->btn_id[$i]) ? $request->btn_id[$i] : null;
                $data->slug = $request->slug[$i];
                // dd($request->action_button_description);
                $data->text = $request->action_button_description[$key] ? $request->action_button_description[$key] : '';
                $data->text_color = $request->action_button_description_color[$key];
                $data->bg_color = $request->action_button_bg_color[$key];
                $data->action_type = isset($request->action_button_link[$key]) ? $request->action_button_link[$key] : '';
                $data->link = isset($request->action_button_link_text[$key]) ? $request->action_button_link_text[$key] : null;
                $data->custom_form_id = $insertedId ? $insertedId : '';
                $data->map_address = isset($request->action_button_map_address[$key]) ? $request->action_button_map_address[$key] : '';
                // $newData->description_text_color = isset($request->description_text_color)? $request->description_text_color[$key] : '';
                $data->action_button_textpopup = isset($request->action_button_textpopup[$key]) ? $request->action_button_textpopup[$key] : '';
                $data->action_button_phone_no_calls = isset($request->action_button_phone_no_calls[$key]) ? $request->action_button_phone_no_calls[$key] : '';
                $data->action_button_phone_no_sms = isset($request->action_button_phone_no_sms[$key]) ? $request->action_button_phone_no_sms[$key] : '';
                $data->action_button_action_email = isset($request->action_button_action_email[$key]) ? $request->action_button_action_email[$key] : '';
                // dd($request->all());
                if (isset($request->popup_action_images[$key])) {
                    $file_name = $request->popup_action_images[$key][0]->getClientOriginalName();

                    $file_ext = $request->popup_action_images[$key][0]->extension();
                    $fileInfo = $request->popup_action_images[$key][0]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $request->popup_action_images[$key][0]->getSize()
                    ];
                    $uploadedFileNames[] = uploadimg($file, null);
                    $data->popup_images = json_encode($uploadedFileNames);
                }
                // dd($request->all());
                if (isset($request->audio_file[0]))
                    $data->audio_file = $request->audio_file[0];

                if (isset($request->action_button_audio_icon_feature[$key])) {
                    $file = $request->action_button_audio_icon_feature[$key];
                    $file_name = $file->getClientOriginalName();

                    $file_ext = $file->extension();
                    $fileInfo = $request->action_button_audio_icon_feature[$key]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $data->action_button_audio_icon_feature = uploadimg($file, null);
                }
                // dd($data);
                if (isset($request->popup_action_images_1)) {
                    $data->popup_images = saveActionButtonImages($request->popup_action_images_1);
                }
                if (isset($request->action_button_video[$key])) {
                    $file = $request->action_button_video[$key];
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->extension();
                    $fileInfo = $request->action_button_video[$key]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $data->action_button_video  = uploadimg($file, null);
                }
                // dd($data);
                update_action_button($request->slug[$i], $data);
                $i++;
            }
        }

        checkSendNotification('Form has been updated', $message, 'form_notifications', 'form_notification_email');
        $source = $request->input('source');
        if ($source === 'attendhub') {
            return redirect('attendhub?block=event_forms_list')->withSuccess($message);
        } 
        return redirect('forms?block=' . $block)->withSuccess($message);
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
        return view('admin.forms.addedit')->with($this->data);
    }
    public function duplicateForm(Request $request)
    {
        if (!check_auth_permission(['form-list'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $this->data['addresses'] = addresses::all();
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['detail_info'] = customForms::find($request->id);
        $this->data['formAction'] = 'duplicate';
        return view('admin.forms.addedit')->with($this->data);
    }
    public function moveToFolder(Request $request)
    {
        if (count($request->response_ids) > 0 and isset($request->response_ids[0])) {
            $ids = explode(',', $request->response_ids[0]);
            $newDatas = customUserForm::whereIn('id', $ids)->get();
            if (count($newDatas) > 0) {
                foreach ($newDatas as $newData) {
                    $newData->in_folder = $request->response_folders;
                    $newData->save();
                }
            }
            $message = 'Responses has been moved successfully';
        } else {
            $request->validate(
                [
                    'response_id' => 'required'
                ],
                [
                    'response_id.required' => 'Select atleast one response',
                ]
            );
            $newData = customUserForm::find($request->response_id);
            $newData->in_folder = $request->response_folders;
            $newData->save();
            $message = 'Response has been moved successfully';
        }

        $block = 'custom_forms_responses_list';
        checkSendNotification('Form has been updated', $message, 'form_notifications', 'form_notification_email');
        $form_fields = array();
        return redirect('forms?block=' . $block)->withSuccess($message);
    }
    public function deleteForm(Request $request)
    {
        if (!check_auth_permission(['form-list'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }


        $data = customForms::find($request->id);
        if (!$data) {
            return redirect('forms?block=custom_forms_list')->withError('Data not found');
        }

        if ($data->id != 7 &&  $data->id != 8) {
            customForms::where('id', $data->id)->delete();
            $message = 'Data deleted successfully';
            checkSendNotification('Form has been updated', $message, 'form_notifications', 'form_notification_email');
        } else {
            $message = 'Cannot delete Subscribe or Optd Out forms.';
        }


        return redirect('forms?block=custom_forms_list')->withSuccess($message);
    }
    public function deletemultipleform(Request $request)
    {
        $request->validate([
            'rows' => 'required'
        ]);
        $rows = [];
        foreach ($request->rows as $row) {
            if ($row != 7 && $row != 8) {
                $rows[] = $row;
            }
        }
        customForms::whereIn('id', $rows)->delete();
        $message = 'Responses has been deleted successfully';
        checkSendNotification('Form has been updated', $message, 'form_notifications', 'form_notification_email');
    }

    public function exportFormResponseToExcel(Request $request)
    {
        try {
            $rows = explode(',', $request->input('rows'));
            $this->data['formdata'] = get_multiple_detail_custom_user_form_data($rows);
            $excelArray = [];
            foreach ($this->data['formdata'] as $data) {
                // dd($this->data['formdata']);
                $excelArray[] = $data;
            }

            $lists = [];
            $sheets = [];
            $i = 0;
            $sheet_index = 0;
            $newArrays = [];
            foreach ($excelArray as $index => $array) {
                $i++;
                $newArray = (array) $array;
                $fields = json_decode($array->fields_data);

                $sheet_name = '';
                if (!empty($fields)) {
                    $fields_keys = [];
                    foreach ($fields as $key => $value) {
                        // Sanitize the key
                        $slug = ucfirst(str_replace(['-', ' '], '_', $key));
                        $fields_keys[] = $slug;
                        if (is_array($value) || is_object($value)) {
                            $filess = ($value);
                            foreach ($filess as $key_f => $value_f) {
                                $sub_slug = ucfirst(str_replace(['-', ' '], '_', $key_f));
                                $newArray[$sub_slug] = $value_f;
                            }
                        } else {
                            $newArray[$slug] = $value;
                        }
                    }

                    unset($newArray['fields_data']);

                    $sheet_name = 'Sheet' . $sheet_index;
                    foreach ($sheets as $sheet_k => $sheet_v) {
                        if ($sheet_v['sheet_keys'] == $fields_keys) {
                            $sheet_name = $sheet_k;
                            break;
                        }
                    }

                    if (!isset($sheets[$sheet_name])) {
                        $sheets[$sheet_name] = [
                            'sheet_name' => 'Sheet' . $sheet_index,
                            'sheet_keys' => $fields_keys,
                            'sheet_data' => []
                        ];
                        $sheet_index++;
                    }
                    $sheets[$sheet_name]['sheet_data'][] = $newArray;
                } else {
                    unset($newArray['fields_data']);
                    foreach ($sheets as $sheet_k => $sheet_v) {
                        if ($sheet_v['sheet_keys'] == []) {
                            $sheet_name = $sheet_k;
                            break;
                        }
                    }

                    if ($sheet_name == '') {
                        $sheet_name = 'Sheet' . $sheet_index;
                        $sheets[$sheet_name] = [
                            'sheet_name' => 'Sheet' . $sheet_index,
                            'sheet_keys' => [],
                            'sheet_data' => []
                        ];
                        $sheet_index++;
                    }
                    $sheets[$sheet_name]['sheet_data'][] = $newArray;
                }
            }

            $sheets_data = [];
            foreach ($sheets as $key => $value) {
                $sheets_data[] = $value['sheet_data'];
            }

            $sheets = new SheetCollection($sheets_data);
            // dd($sheets);
            $fastexcel->export(storage_path("FormResponse.xlsx"));
            return response()->download(storage_path("FormResponse.xlsx"), "FormResponse.xlsx")->deleteFileAfterSend(true);
        } catch (\Throwable $e) {
        }
    }

    public function saveOrder(Request $request)
    {
        $sortedItems = $request->input('sortedItems');
        $fieldItems = array_filter($sortedItems, fn($item) => $item['type'] === 'field');
        $fieldId = $fieldItems ? $fieldItems[array_key_first($fieldItems)]['id'] : null;
        $newData = customForms::find($fieldId);
        if ($newData) {
            $fields = json_decode($newData->fields);
        }
        // dd($fields);
        foreach ($sortedItems as $item) {
            if ($item['type'] === 'field') {
                foreach ($fields as $field) {
                    if (isset($fields) && $fields) {
                        if ($item['fieldtype'] == $field->fieldtype && $item['fieldname'] == $field->fieldname) {
                            $field->order = $item['order'];
                        }
                    }
                }
                // Update the field order in JSON
                // You may need to rebuild and save the updated JSON structure
            } elseif ($item['type'] === 'button') {
                // Update the button order in the database
                $button = actionButtons::find($item['id']);
                $button->order = $item['order'];
                $button->save();
            }
        }
        $newData->fields = json_encode($fields);
        $newData->save();
        // dd(json_encode($fields));

        return response()->json(['status' => 'success']);
    }

    public function toggleForm(Request $request)
    {
        $form = customForms::where('id',$request->id)->first();
        $form->active = $request->check_value;
        $form->save();
        return redirect()->back()->with('success', 'Form updated successfully');
    }
}
