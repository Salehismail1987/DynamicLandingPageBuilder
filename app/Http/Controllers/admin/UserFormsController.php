<?php

namespace App\Http\Controllers\admin;

use App\Models\customForms;
use Illuminate\Http\Request;
use App\Models\customUserForm;
use App\Http\Controllers\Controller;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use App\Models\EmailList;
use Illuminate\Support\Facades\Session;

class UserFormsController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'forms';
        $this->data['controller_name'] = 'Forms';
        $this->data['font_family'] = get_font_family();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['block'] = '';
    }

    public function editUserForm(Request $request){
        $this->data['formdata'] = get_detail_custom_user_form_data($request->id);
        $this->data['form_detail'] = customForms::find($this->data['formdata']->form_id);
        if(isset($_GET['block'])){
            $this->data['block'] = $_GET['block'];
        }
        return view('admin.userforms.edit')->with($this->data);
    }
    public function detailUserForm(Request $request){
        $this->data['formdata'] = get_detail_custom_user_form_data($request->id);
        $data = customUserForm::find($request->id);
        $data->seen = '1';
        $data->save();
        $this->data['form_detail'] = customForms::find($this->data['formdata']->form_id);
        if(isset($_GET['block'])){
            $this->data['block'] = $_GET['block'];
        }
        return view('admin.userforms.detail')->with($this->data);
    }
    public function deleteUserForm(Request $request){
        $this->data['form_detail'] = customUserForm::find($request->id)->delete();
        $message = 'Response has been deleted successfully';
        $block = 'custom_forms_responses_list';
        if(isset($_GET['block'])){
            $block = $_GET['block'];
        }
        return redirect('forms?block='.$block)->withSuccess($message);
    }
    public function deletemultipleuserform(Request $request){
        $request->validate([
            'rows'=>'required'
        ]);
        customUserForm::whereIn('id', $request->rows)->delete();
        $message = 'Responses has been deleted successfully';
        checkSendNotification('Form has been updated',$message,'form_notifications','form_notification_email');
        Session::flash('success',$message);
    }

    public function readmultipleuserform(Request $request){
        $request->validate([
            'rows'=>'required'
        ]);
        customUserForm::whereIn('id', $request->rows)->update(["seen" =>$request->seen]);
        $message = 'Responses has been changed successfully';
        checkSendNotification('Form has been updated',$message,'form_notifications','form_notification_email');
        Session::flash('success',$message);
    }

    public function readUserForm(Request $request){
        customUserForm::find($request->id)->update(['seen'=>'1']);
        $message = 'Response has been updated successfully';
        checkSendNotification('Form has been updated',$message,'form_notifications','form_notification_email');
        $block = 'custom_forms_responses_list';
        if(isset($_GET['block'])){
            $block = $_GET['block'];
        }
        return redirect('forms?block='.$block)->withSuccess($message);
    }
    public function unreaduserform(Request $request){
        customUserForm::find($request->id)->update(['seen'=>'0']);
        $message = 'Response has been updated successfully';
        $block = 'custom_forms_responses_list';
        if(isset($_GET['block'])){
            $block = $_GET['block'];
        }
        return redirect('forms?block='.$block)->withSuccess($message);
    }
    public function updateUserForm(Request $request){
        $formdata = array();
        unset($_POST['_token']);
        foreach($_POST as $key=>$value){
            if(!strpos($key,'txto')){
                $field_name = trim(ucwords(str_replace('_',' ',$key)));
                if(is_array($value)){
                    $tempval = '';
                    foreach($value as $ss){
                        if($ss=='other'){
                            $tempval .= $request->{$key.'txto'}.'<br>';
                        }else{
                            $tempval .= $ss.'<br>';
                        }
                    }
                    $formdata[$field_name] = $tempval;
                }else{
                    if($value=='other'){
                        $formdata[$field_name] = $request->{$key.'txto'};
                    }else{
                        $formdata[$field_name] = $value;
                    }
                }
            }
        }
        foreach($_FILES as $key=>$value){
            if(!empty($_FILES[$key]['name'])){
                $ima_name= rand(9,9999).date('d-m-Y').$_FILES[$key]['name'];
                $sourcePath = $_FILES[$key]['tmp_name'];
                $targetPath = "assets/uploads/".get_current_url(). $ima_name;
                if(move_uploaded_file($sourcePath,$targetPath)){
                    $formdata['files'][$key] = $ima_name;
                }
            }else if(isset($_POST['old_'.$key])){
                $formdata['files'][$key] = $_POST['old_'.$key];
            }else{
                $formdata['files'][$key] = '';
            }
        }
        $customUserForm = customUserForm::find($request->record_id);
        $customUserForm->fields_data = json_encode($formdata);
        $customUserForm->save();

        $message = 'Response has been updated successfully';
        checkSendNotification('Form has been updated',$message,'form_notifications','form_notification_email');
        $block = 'custom_forms_responses_list';
        if(isset($_GET['block'])){
            $block = $_GET['block'];
        }
        return redirect('forms?block='.$block)->withSuccess($message);
    }
    public function getUnreadResponses(Request $request){
        $data =  customUserForm::where('seen','0')->orderBy('display_order','asc')->orderBy('id','desc')->get();
        $total_res = count($data);
        $html = '';
        foreach($data as $single){
            $formdata =  customForms::where('id',$single->form_id)->first();
            $form_name = '';
            if($formdata){
                $form_name = $formdata->title;
            }
            $title = '';
            $formfields = json_decode($single->fields_data);
            if($formfields && (is_array($formfields) || is_object($formfields))){
                foreach($formfields as $singleheading){
                    $title = $singleheading;
                    break;
                }
            }
            $html .= '<tr class="openuserformedit" data-id="'.$single->id.'">
                        <th><small>'.$form_name.'</small><br>'.$title.'</th>
                        <td>'.$single->created_at.'</td>
                    </tr>';
        }
        echo json_encode(array('total_res'=>$total_res,'html'=>$html));
    }

	public function addToConnects(Request $request)
	{
        $formdata = customUserForm::find($request->id)->first();
        $form_feilds = json_decode($formdata->fields_data,'true');
        $temp_feilds = array();
        foreach($form_feilds as $key=>$value){
            $temp_feilds[trim($key)] = $value;
        }
        $form_feilds = $temp_feilds;
        $insertData['email_address'] = $form_feilds['Email'];
        $insertData['name'] = $form_feilds['Name'];
        if(isset($_GET['type'])){
            if($_GET['type'] == 'Subscriber'){

                $insertData['subscribed'] = '1';
            }elseif($_GET['type'] == 'Non-Subscriber'){

                $insertData['subscribed'] = '0';
            }
        }
        unset($form_feilds->Email);
        unset($form_feilds->Name);
        $formfeilds = array();
        foreach($form_feilds as $key=>$value){
            $formfeilds[$key] = $value;
        }
        $insertData['fields'] = json_encode($formfeilds);
        EmailList::create($insertData);
        $formdata = customUserForm::find($request->id)->delete();
        $message = 'Contact has been added successfully';
        checkSendNotification('Form has been updated',$message,'form_notifications','form_notification_email');
        $block = 'custom_forms_responses_list';
        if(isset($_GET['block'])){
            $block = $_GET['block'];
        }
        return redirect('forms?block='.$block)->withSuccess($message);
	}
}
