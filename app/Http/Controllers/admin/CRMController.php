<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use Illuminate\Support\Facades\Schema;
use App\Models\ContactInfo;
use App\Models\frontSections;
use App\Models\icons;
use App\Models\timeZones;
use App\Models\siteSettings;
use App\Models\user;
use App\Models\alertPopupSetting;
use App\Models\userRolls;
use App\Models\addresses;
use App\Models\CrmSetting;
use App\Models\UnsubscribeUserForm;
use App\Models\EmailPost;
use App\Models\EmailPostStarter;
use App\Models\ScheduleEmail;
use App\Models\ScheduleEmailContact;
use App\Models\ContactGroup;
use App\Models\CustomScheduleEmail;
use App\Models\customForms;
use App\Models\ContactDatabase;
use App\Models\EmailList;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class CRMController extends Controller
{
    //
    public function __construct()
    {
        $this->data['controller'] = 'CRM';
        $this->data['controller_name'] = 'CRM';
        $this->data['crm_settings'] = CrmSetting::first();
        $this->data['font_family'] = get_font_family();
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $siteSettings = siteSettings::find('1');

        $this->data['all_categories'] = ImageGalleryCategory::all();

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['timezone']  = timeZones::find($siteSettings->timezone)->first();
        $this->data['notificationSettings'] = NotificationSettings::first();
    }


    public function index(Request $request)
    {
        if (!check_auth_permission(['email_marketing', 'contacts', 'contact_groups', 'crm_settings', 'unsubscribed_contacts', 'contacts_fields'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $this->data['email_posts'] = EmailPost::get();
        $this->data['email_tempaltes'] = EmailPostStarter::get();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['scheduled_emails'] = ScheduleEmail::get();

        $this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
        $this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
        $this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
        $this->data['generic_description'] = get_text_details('generic_email_post_description');

        $this->data['unsubscontacts'] = UnsubscribeUserForm::orderBy('id', 'desc')->get();
        $this->data['contact_database'] = ContactDatabase::first();
        $this->data['contact_groups'] = ContactGroup::orderBy('id', 'DESC')->get();
        $this->data['block'] = "";

        if (isset($request->block) && $request->block != "") {
            $this->data['block'] = $request->block;
        }

        return view('admin.crm_controls')->with($this->data);
    }

    public function saveCRMSettings(Request $request)
    {

        $block = '';
        $message = '';
        $data = $request->all();
        if (!empty($data)) {

            if (isset($_POST['save_crm_settings'])) {
                $setting = CrmSetting::find(1);
                $setting->email_marketing_from_name = $request->email_marketing_from_name;
                $setting->email_marketing_from_email = $request->email_marketing_from_email;
                $setting->optout_email_address = $request->optout_email_address;
                $setting->email_marketing_reply_to = $request->email_marketing_reply_to;
                $setting->save();

                //Standard Inputs settings

                $data = (object) [];
                $data->text = "";
                $data->size_web =  $request->content_title_text_size;
                $data->size_mobile = "";
                $data->color = $request->content_title_text_color;
                $data->bg_color = "";
                $data->fontfamily = $request->content_title_font_family;

                update_text_details('generic_email_post_content_title', $data);

                $data = (object) [];
                $data->text = "";
                $data->size_web =  $request->logo_title_text_size;
                $data->size_mobile = "";
                $data->color = $request->logo_title_text_color;
                $data->bg_color = "";
                $data->fontfamily = $request->logo_title_font_family;
                update_text_details('generic_email_post_logo_title', $data);

                $data = (object) [];
                $data->text = "";
                $data->size_web =  $request->email_image_desciption_text_size;
                $data->size_mobile = "";
                $data->color = $request->email_image_desciption_text_color;
                $data->bg_color = "";
                $data->fontfamily = $request->email_image_desciption_font_family;
                update_text_details('generic_email_post_description', $data);


                $data = (object) [];
                $data->text = "";
                $data->size_web =  $request->subtitle_text_size;
                $data->size_mobile = "";
                $data->color = $request->subtitle_text_color;
                $data->bg_color = "";
                $data->fontfamily = $request->subtitle_font_family;
                update_text_details('generic_email_post_description', $data);

                $message = 'CRM Settings has been updated';
                $block = 'crm_settings';
            } else {
                $setting = CrmSetting::find(1);
                $setting->test_email_address = $data['testEmailAddress'];
                $setting->save();


                $message = 'CRM settings saved!';
                $block = 'email_management';
            }
        }

        checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');



        return redirect('crmcontrols?block=' . $block)->withSuccess($message);
    }


    public function deleteUnsub(Request $request)
    {

        UnsubscribeUserForm::where(array('id' => $request->id))->delete();
        $message = 'Unsubscribe user form has been Deleted successfully';

        checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
        return redirect('crmcontrols?block=unsubscontacts')->withSuccess($message);
    }

    # (Hassan) Delete Multiple Unsubs
    public function deleteMultipleUnsubs(Request $request)
    {
        UnsubscribeUserForm::whereIn('id', $request->rows)->delete();
        $message = 'Selected Unsubscribe user form has been deleted!';
        $block = 'unsubscontacts';
        checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
        return redirect('crmcontrols?block=' . $block)->withSuccess($message);
    }

    # (Hassan) Update OPTD Out
    public function updateOptdOut(Request $request)
    {
        if ($request->id && $request->id != "") {
            UnsubscribeUserForm::where('id', $request->id)
                ->update([
                    'fields_data' => DB::raw("JSON_SET(JSON_SET(fields_data, '$.\"Full Name\"', '$request->full_name'), '$.\"Email\"', '$request->email', '$.\"Phone Number\"', '$request->phone')"),
                    "datetime" => $request->datetime
                ]);
            $message = 'Opt\'d out has been updated successfully';
        }
        checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
        return redirect('crmcontrols?block=unsubscribe_contacts')->withSuccess($message);
    }

    # (Hassan) Move Multiple OPTD Back To In
    public function moveSingleOptdToIn(Request $request)
    {
        if ($request->id && $request->id != "") {
            $unsubscribed = UnsubscribeUserForm::where('id', $request->id)->first();
            $data = json_decode($unsubscribed->fields_data, true);
            if (isset($data['Email'])) {
                $emailExist = EmailList::where('email_address', $data['Email'])->get();
                if ($emailExist->isEmpty()) {
                    EmailList::create([
                        'email_address' => $data['Email'],
                        'name' => $data['Full Name'],
                        'subscribed' => 1,
                        'fields' => json_encode($data)
                    ]);
                } else {
                    foreach ($emailExist as $obj) {
                        $obj->subscribed = 1;
                        $obj->fields = json_encode($data);
                        $obj->save();
                    }
                }
                $unsubscribed->delete();
            }

            $message = "Select User Opt’d In Successfully";
            checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
        }
        return redirect('crmcontrols?block=unsubscribe_contacts')->withSuccess($message);
    }

    # (Hassan) Move Multiple OPTD Back To In
    public function moveMultipleOptdToIn(Request $request)
    {
        if ($request->rows && $request->rows != []) {
            $unsubscribed = UnsubscribeUserForm::whereIn('id', $request->rows)->get();
            if ($unsubscribed) {
                foreach ($unsubscribed as $unsub) {
                    $data = json_decode($unsub->fields_data, true);
                    if (isset($data['Email'])) {
                        $emailExist = EmailList::where('email_address', $data['Email'])->get();
                        if ($emailExist->isEmpty()) {
                            EmailList::create([
                                'email_address' => $data['Email'],
                                'name' => $data['Full Name'],
                                'subscribed' => 1,
                                'fields' => json_encode($data)
                            ]);
                        } else {
                            foreach ($emailExist as $obj) {
                                $obj->subscribed = 1;
                                $obj->fields = json_encode($data);
                                $obj->save();
                            }
                        }
                        $unsub->delete();
                    }
                }
            }

            $message = "Select User Opt’d In Successfully";
            checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
        }
        return redirect('crmcontrols?block=unsubscribe_contacts')->withSuccess($message);
    }

    public function saveContactField(Request $request)
    {

        if (isset($_POST['save_contact_database'])) {

            $form_fields = array();

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
            $j = 0;
            if (isset($_POST['fieldname'])) {
                foreach ($request->fieldname as $single) {
                    $temp_array = array(
                        'fieldname' => $single,
                        'fieldtype' => isset($request->fieldtype[$j]) ? $request->fieldtype[$j] : 'text',
                        'required' => isset($request->required[$j]) ? "1" : "0",
                        'search' => isset($request->search[$j]) ? "1" : "0",
                        'formenable' => isset($request->formenable[$j]) ? "1" : "0",
                        'show_response' => isset($request->show_response[$j]) ? "1" : "0"
                    );
                    if ($request->fieldtype[$j] == 'radio' || $request->fieldtype[$j] == 'checkbox' || $request->fieldtype[$j] == 'select' || $request->fieldtype[$j] == 'multiselect') {
                        $option_array = array();
                        if (isset($request->oprtionname[$j]) && $request->oprtionname[$j]) {
                            foreach ($request->oprtionname[$j] as $singleop) {
                                $option_array[] = $singleop;
                            }
                        }
                        $temp_array['options'] = $option_array;
                    } else if ($request->fieldtype[$j] == 'image') {
                        if (isset($request->qimg[$j]) && $request->qimg[$j]) {
                            $temp_array['image'] =  saveimagefromdataimage($request->qimg[$j]);
                        } else if (isset($request->image_name[$j]) && $request->image_name[$j]) {
                            $temp_array['image'] =  $request->image_name[$j];
                        }
                        $temp_array['image_desc'] = $request->image_desc[$j];
                    } else if ($request->fieldtype[$j] == 'comment_only') {
                        $temp_array['duedate'] = $request->comment_date[$j];
                    }
                    $form_fields[] = $temp_array;
                    $j++;
                }
            }
            $updateData['fields'] = json_encode($form_fields);
            ContactDatabase::where(array('id' => '1'))->update($updateData);
            customForms::where(array('id' => '7'))->update($updateData);

            $message = "Contact Database saved successfully";
            checkSendNotification('CRM has been updated', $message, 'crm_notifications', 'crm_notification_email');
            return redirect('crmcontrols?block=contact_fields')->withSuccess($message);
        }
    }

    public function generateSampleFile()
    {
        $fields = ContactDatabase::first();
        $form_fields = json_decode($fields->fields, true);

        // Extract the field names and create sample data
        $field_names = [];
        $sample_data = [];
        // dd($form_fields);
        foreach ($form_fields as $field) {
            if (isset($field['fieldname'])) {
                $field_names[] = $field['fieldname'];

                // Create sample data based on field type
                switch ($field['fieldtype']) {
                    case 'text':
                        if ($field['fieldname'] === 'Full name') {
                            $sample_data[] = 'John Doe';
                        } elseif ($field['fieldname'] === 'Email') {
                            $sample_data[] = 'johndoe@gmail.com';
                        } else
                        {
                            $sample_data[] = 'sample text';
                        }
                        break;
                    case 'email':
                        $sample_data[] = ($field['fieldname'] === 'Email') ? 'johndoe@gmail.com' : 'sample@example.com';
                        break;
                    case 'file':
                        $sample_data[] = 'file url';
                        break;
                    case 'image':
                        $sample_data[] = 'image url';
                        break;
                    case 'select':
                        $sample_data[] = isset($field['options']) ? implode('/', $field['options']) : 'Option 1';
                        break;
                    case 'radio':
                        $sample_data[] = isset($field['options']) ? implode('/', $field['options']) : 'Option 1';
                        break;
                    case 'radio':
                        $sample_data[] = isset($field['options']) ? implode('/', $field['options']) : 'Option 1';
                        break;
                        // Add more cases for other field types if needed
                    default:
                        $sample_data[] = 'Sample Data';
                }
            }
        }
        $field_names[] = 'subscribed';
        $sample_data[] = '1/0';

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Write the column names to the spreadsheet
        $sheet->fromArray($field_names, NULL, 'A1');

        // Write the sample data to the spreadsheet
        $sheet->fromArray($sample_data, NULL, 'A2');

        // Create a writer instance
        $writer = new Xlsx($spreadsheet);

        // Output the file to the browser
        $filename = 'columns.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($temp_file);

        return Response::download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
