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
use App\Models\ContactGroup;

use App\Models\EmailList;
use App\Models\EmailListImage;
use App\Models\ContactGroupEmail;
use App\Models\CustomScheduleEmail;
use App\Models\ContactDatabase;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportEmailList;
use App\Imports\EmailListImport;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

use Str;

class ContactController extends Controller
{
    //
    public function __construct(){
        $this->data['controller'] = 'Contacts';
        $this->data['controller_name'] = 'Contacts';
        $this->data['crm_settings'] = CrmSetting::first();
        $this->data['font_family'] = get_font_family();
        $this->data['front_sections'] = frontSections::orderBy('name','ASC')->get();
        $siteSettings = siteSettings::find('1');
        $this->data['timezone']  = timeZones::find($siteSettings->timezone)->first();        
        $this->data['notificationSettings'] = NotificationSettings::first();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['contact_database'] = ContactDatabase::first();
    }


    public function  saveContactGroup(Request $request){
        $data_group = [];
        $data_group['group_name'] = $request->group_name;

        if(count($data_group)>0){
            ContactGroup::create($data_group);
       
        }
        checkSendNotification('CRM has been updated','Contact Group saved successfully','crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block=contact_groups')->withSuccess("Contact Group saved successfully");
    }

    public function deleteContactGroup(Request $request){
        ContactGroup::where( array('id' => $request->id))->delete();
        $message = 'Contact Group has been deleted successfully';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block=contact_groups')->withSuccess($message);
    }

    public function updateContactGroup(Request $request){
       
        $updateData=[];
        if($request->id && $request->id !=""){
            $updateData['group_name'] = $request->group_name;
    
            ContactGroup::where( array('id' => $request->id))->update($updateData);
            $message = 'Contact Group has been updated successfully';
        }
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block=contact_groups')->withSuccess($message);
    }

    public function getContacts(Request $request){
		$type = $request->type;
		$search_term = $request->search_term;
		$query = EmailList::query();

		if($type=="default"){
			$query->orderBy("id", "DESC");
		}elseif($type=="subscribed"){
			$query->orderBy("subscribed", "DESC");
		}elseif($type=="unsubscribed"){
			$query->orderBy("subscribed", "ASC");
		}else{
			$query->orderBy($type, "ASC");
		}
		if($search_term){
            $query->where(function($query) use($search_term){
                $query->orWhere('name','like', '%'.$search_term.'%');
                $query->orWhere('email_address','like',  '%'.$search_term.'%');
                // $query->orWhere('fields','like',  '%'.$search_term.'%');
            });
		}
        if($request->page){
            $perPage = $request->perPage? $request->perPage :5;
            $email_lists = $query->paginate($perPage);
        }else{
            $email_lists = $query->get();
        }
		

		if (count($email_lists->toArray()) > 0) {
		  $i = 0;
		  foreach ($email_lists as $row) {
			$i++; ?>
			<tr>
			  <td><input type="checkbox" value=" <?= $row->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
			  <td> <?= $row->name; ?></td>
			  <td> <?= $row->email_address; ?></td>
			  <td> 
				<div class="form-group">
				  <label class="switch">
					<input type="checkbox" class="notificationswitch subscribed_switch" name="notificationswitch" data-row-id="<?=$row->id?>" <?= $row->subscribed ? 'checked' : '' ?>>
					<span class="slider round"></span>
				  </label>
				</div>
			  </td>
			  <td>
                <?php if (check_auth_permission('email_posts') || check_auth_permission('email_post_actions')){  ?>
                <div class="btn-group">
                    <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                    <a href="<?php echo url('editContact/' . $row->id . '/'); ?>" class="dropdown-item"> Edit</a>
                    <a href="<?php echo url('deleteContact/' . $row->id . '/'); ?>" class="dropdown-item" onclick="return confirm('Are You Sure?');"></i> Delete</a>
                    <a href="<?php echo url('duplicateContact/' . $row->id . '/'); ?>" class="dropdown-item" onclick="return confirm('Are You Sure?');"></i> Duplicate</a> <!-- (Hassan) Adding duplicate row option -->
                    </div>
                </div>
                <?php } ?>     
				
			  </td>
			</tr>
		<?php  } 
		}
        if($request->page){
            
        echo '-------------';
            echo $email_lists->links();

        }
	}

    /* (Hassan) Here we export the selected contacts list to excel (Begin) */
	public function exportToExcel(Request $request){  
              
        $rows = explode(',', $request->input('rows'));
        // return Excel::download(new ExportEmailList($rows), 'Emaillists.xlsx');
        
        $emailList =  EmailList::whereIn('id', $rows)
            ->select('id', 'name', 'email_address', 'subscribed','fields')
            ->orderBy('fields')->get();
            $lists = [];
            $sheets = [];
            $i = 0;
            $sheet_index = 0;

            foreach( $emailList as $single){
                $i++;

                $new = [];
                $new['Sr#'] = $i;
                $new['EmailAddress']  = $single->email_address;
                $new['Name'] = $single->name;
                unset($new['id']);
                $new['Subscribed'] = $single->subscribed=='1'?'Yes':'No';
                $fields = json_decode($single->fields);

                if(!empty($fields)){
                    
                    $fields_keys = [];
                    foreach($fields as $key=>$value){
                      
                        if(is_array($value)  || is_object($value) ){
                            $filess = ($value); 
                                                 
                            foreach($filess as $key_f=>$value_f){
                                $slug = ($key_f);
                                $slug = ucfirst(str_replace('-',' ',$slug));
                                $fields_keys[] = $slug;
                                $new[$slug] = $value_f; 
                            }
                        }else{
                            $slug = ($key);
                            $slug = ucfirst(str_replace('-',' ',$slug));
                            $fields_keys[] = $slug;
                            $new[$slug] = $value;
                            unset($new['fields']);  
                        }
                                             
                    }
                    
                    $sheet_name = 'Sheet'.$sheet_index;
                    foreach($sheets as $sheet_k=>$sheet_v){
                        if($sheet_v['sheet_keys'] == $fields_keys){
                            $sheet_name = $sheet_k;
                            break;
                        }
                    }

                    if(!isset($sheets[$sheet_name])){
                        $sheets[$sheet_name] = [
                            'sheet_name' => 'Sheet'.$sheet_index,
                            'sheet_keys' => $fields_keys,
                            'sheet_data' => []
                        ];
                        $sheets[$sheet_name]['sheet_data'][] = $new;
                        $sheet_index++;
                    }else{
                        $sheets[$sheet_name]['sheet_data'][] = $new;
                    }

                }else{
                
                    $sheet_name = '';
                    foreach($sheets as $sheet_k=>$sheet_v){
                        if($sheet_v['sheet_keys'] == []){
                            $sheet_name = $sheet_k;
                            break;
                        }
                    }

                    if($sheet_name !=''){

                        $sheets[$sheet_name]['sheet_data'][] = $new;
                    }else{
                        $sheets['Sheet'.$sheet_index] = [
                            'sheet_name' => 'Sheet'.$sheet_index,
                            'sheet_keys' => [],
                            'sheet_data' => []
                        ];
                        $sheets['Sheet'.$sheet_index]['sheet_data'][] = $new;
                    
                        $sheet_index++;
                    }
                    
                }             
            }

        $sheets_data = [];
        foreach($sheets as $key=>$value){
            $sheets_data[] = $value['sheet_data'];
        } 

       
        $sheets = new SheetCollection(($sheets_data));
        
        $fastexcel = new FastExcel($sheets);
        $fastexcel->export(storage_path("Emaillists.xlsx"));
        return response()->download(storage_path("Emaillists.xlsx"), "Emaillists.xlsx")->deleteFileAfterSend(true);
	}
    /* Here we export the selected contacts list to excel (End) */

    public function importToDB(Request $request){
        Excel::import(new EmailListImport(), $request->file('file'));
        checkSendNotification('CRM has been updated','Contacts Imported','crm_notifications','crm_notification_email');

    // if(isset($_FILES["file"]["name"]))
    // {
    // $path = $_FILES["file"]["tmp_name"];
    // $object = PHPExcel_IOFactory::load($path);
    // 	foreach($object->getWorksheetIterator() as $worksheet)
    // 	{
    // 		$highestRow = $worksheet->getHighestRow();
    // 		$highestColumn = $worksheet->getHighestColumn();
    // 		$headings = array();
    // 		$i = 4;
    // 		while(true){
    // 			if($worksheet->getCellByColumnAndRow($i, 1)->getValue()){
    // 				$headings[] = $worksheet->getCellByColumnAndRow($i, 1)->getValue();
    // 			}else{
    // 				break;
    // 			}
    // 			$i++;
    // 		}
    // 		for($row=2; $row<=$highestRow; $row++){
    // 			$Name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    // 			$EmailAddress = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    // 			$Subscriber = strtolower($worksheet->getCellByColumnAndRow(3, $row)->getValue())=='yes'?'1':'0';
                
    // 			$i = 4;
    // 			$fieldsdata = array();
    // 			while(true){
    // 				if($worksheet->getCellByColumnAndRow($i, $row)->getValue()){
    // 					$optvalue = $worksheet->getCellByColumnAndRow($i, $row)->getValue();
    // 					if(strpos($optvalue,',')){
    // 						$optvalue = explode(',',$optvalue);
    // 						$optarray = array();
    // 						foreach($optvalue as $sngopt){
    // 							$optarray[] = $sngopt;
    // 						}
    // 						$fieldsdata[$headings[$i-4]] = $optarray;
    // 					}else{
    // 						$fieldsdata[$headings[$i-4]] = $optvalue;
    // 					}
    // 				}else{
    // 					break;
    // 				}
    // 				$i++;
    // 			}
    // 			$data[] = array(
    // 				'Name'  => $Name,
    // 				'Email_Address'   => $EmailAddress,
    // 				'Subscribed'   => $Subscriber,
    // 				'fields'   => json_encode($fieldsdata)
    // 			);
    // 		}
    // 	}
    // 	foreach($data as $emails){
    // 		$this->db->insert('email_lists', $emails);
    // 	}
    }

    public function deleteMultipleContacts(Request $request){ 
        EmailList::whereIn('id', $request->rows)->delete();
        checkSendNotification('CRM has been updated','multiple contacts deleted','crm_notifications','crm_notification_email');

	}
    public function contactsToSubscribe(Request $request){ 
        EmailList::whereIn('id', $request->rows)->update(['subscribed'=>'1']);
        checkSendNotification('CRM has been updated','contacts subscribed','crm_notifications','crm_notification_email');
	}
    public function contactsToUnSubscribe(Request $request){ 
        EmailList::whereIn('id', $request->rows)->update(['subscribed'=>'0']);
        checkSendNotification('CRM has been updated','contacts unsubscribed','crm_notifications','crm_notification_email');
	}
    public function delimage(Request $request){
		$thisimg = $request->imgid;
        EmailListImage::where(array('id' => $thisimg))->delete();
	}

	public function subscribedSwitch(Request $request){
		$id = $request->id;
		$checked = $request->checked;
        EmailList::where( array('id' => $id))->update(array('subscribed' => $checked));
	}

    
    public function deleteContact(Request $request) {
           
        $email_list_images = EmailListImage::where('email_id',$request->id)->get();
        if ( count($email_list_images->toArray()) > 0) {
            foreach ($email_list_images as $image) {
                $this->delimg($image->image);                
            }
        }
        EmailListImage::where(array('email_id' => $request->id))->delete();
        ContactGroupEmail::where(array('email_id' => $request->id))->delete();
        
        EmailList::where( array('id' => $request->id))->delete();
        $message = $this->data['controller_name'].' has been deleted successfully';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block=contacts')->withSuccess($message);
    }  
    
    public function add(Request $request) {
        $request->validate([
            'email' => 'required',
        ]);
        $insertData = [];
        $insertData['email_address'] = $request->email;
        $insertData['name'] = $request->full_name;
        $insertData['subscribed'] = $request->subscribed ? '1' : '0';

        unset($_POST['email']);
        unset($_POST['full_name']);
        unset($_POST['subscribed']);
        foreach($request->all() as $key=>$value){
            $field_name = ucwords(str_replace('_',' ',$key));
            $formdata[$field_name] = $value;
        }
        // dd($formdata);
        
        $insertData['fields'] = json_encode($formdata);

        EmailList::create($insertData);
        $message = $this->data['controller_name'].' has been added successfully';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
        return redirect('crmcontrols?block=contacts')->withSuccess($message);
             
       
    }

    public function editView(Request $request){
        $this->data['catID'] = $request->id;
        $this->data['page'] = $request->page;
        $this->data['detail_info'] = EmailList::find($request->id);
        if(!$this->data['detail_info']){
            return redirect('crmcontrols?block=contacts')->withError('Contact not found');
        }
        $this->data['detail_info_images'] = EmailList::where(array('id'=>$request->id))->get();
        return view('admin.emaillist.edit',$this->data);
    }

    /* (Hassan) Duplicate the existing contact (Begin) */
    public function duplicateContact(Request $request){
        $contact = EmailList::find($request->id);
        if ($contact) {
            $duplicateContact = $contact->replicate();
            $duplicateContact->save();
            checkSendNotification('CRM has been updated','Contact duplicated successfully','crm_notifications','crm_notification_email');
            return redirect('crmcontrols?block=contacts')->withSuccess('Contact duplicated successfully');
        } else {
            return redirect('crmcontrols?block=contacts')->withErrors('Contact not found');
        }
    }
    /* Duplicate the existing contact (End) */
    
    public function addView(Request $request){
      
        $this->data['page'] = $request->page;
        return view('admin.emaillist.add',$this->data);
    }

    //edit Email List
    public function edit(Request $request) {
        $request->validate([
            'email' => 'required',
        ]);

        $updateData['email_address'] = $request->email;
        $updateData['name'] = $request->name;
        $updateData['subscribed'] = $request->subscribed ? '1' : '0';

        unset($_POST['email']);
        unset($_POST['name']);
        unset($_POST['subscribed']);
        foreach($_POST as $key=>$value){
            $field_name = ucwords(str_replace('_',' ',$key));
            $formdata[$field_name] = $value;
        }
        $post_id = $request->id;
        $files_array = array();
        if ($_FILES && count($_FILES)>0) {
            foreach($_FILES as $key=>$value){
                if(!empty($_FILES[$key]['name'])){
                    $ext = pathinfo($_FILES[$key]['name'], PATHINFO_EXTENSION);
                    $ima_name= rand(9,9999).date('d-m-Y').$ext;
                    $sourcePath = $_FILES[$key]['tmp_name'];
                    $targetPath = "assets/uploads/".get_current_url(). $ima_name;
                    if(move_uploaded_file($sourcePath,$targetPath)){
                        $formdata['files'][$key] = $ima_name;
                    }
                }
            }
        }
        $updateData['fields'] = json_encode($formdata);
        EmailList::where(array('id' => $request->id))->update( $updateData);
        $message = $this->data['controller_name'].' has been updated successfully';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');

        return redirect('crmcontrols?block=contacts')->withSuccess($message);
             
        
    }
    

    public function assignEmails(Request $request){

        if($_POST){

            if(isset($_POST['assign_emails'])){

                $this->db->delete('contact_group_emails', array('contact_group_id' => $catID));
                foreach($this->input->post('rows') as $email_id){

                    $this->db->insert('contact_group_emails', array('contact_group_id' => $catID , 'email_id' => $email_id));
                }
                $message = 'Emails has been assigned successfully';
                checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');
                $this->session->set_flashdata('message', $message);

                redirect('admin/crmcontrols?sec=contact_groups');
            }
        }

        if($request->id && $request->id !=""){
            $this->data['email_lists'] = EmailList::orderBy('name')->get();
            $this->data['contact_group']= ContactGroup::where(array('id' => $request->id))->first();
            $this->data['catID'] = $request->id;
            return view('admin.emaillist.assign_emails', $this->data);

        }
    }

    public function assignEmailsAjax(Request $request){ 

       ContactGroupEmail::where(array('contact_group_id' => $request->id))->delete();
        
        foreach($request->rows as $email_id){

            ContactGroupEmail::create( array('contact_group_id' => $request->id , 'email_id' => $email_id));
        }
        $message = 'Emails has been assigned successfully';
        checkSendNotification('CRM has been updated',$message,'crm_notifications','crm_notification_email');

       return redirect('crmcontrols?block=contact_groups')->withSuccess($message); 
    }


    public function getDataFromDB(Request $request){
        $groupid = $request->groupid;
        $assugn_emails = ContactGroupEmail::where(array('contact_group_id' => $groupid ))->get();
        $assign_emails_ids = array();
        
        if(count($assugn_emails)>0){
            foreach($assugn_emails as $single){
                $assign_emails_ids[] = $single->email_id;
            }
        }
      
        $html = '';
        $email_lists = EmailList::orderBy('name')->get();
        if(count($email_lists)>0){
            foreach($email_lists as $single){
                $html .= '<tr>';
                $html .= '<td><input type="checkbox" value="'.$single->id.'" id="checkrow" name="checkrow" multiple="true" '.(in_array($single->id,$assign_emails_ids)?'checked':'').'/></td>';
                $html .= '<td>'.$single->name.'</td>';
                $html .= '<td>'.$single->email_address.'</td>';
                // $html .= '<td>'.$single->gender.'</td>';
                // $html .= '<td>'.$single->age.'</td>';
                // $html .= '<td>'.$single->city.'</td>';
                $html .= '</tr>';
            }
        }
        echo $html;
        //echo json_encode($email_lists);
    }
    public function getContactData(Request $request){
		$contact = $request->contact;
        $email_lists =EmailList::orderBy('name')->where("name",'like','%'.$contact.'%')->get();
        echo json_encode($email_lists);
    }
    public function getEmailData(Request $request){
		$email = $request->email;
        $email_lists =EmailList::orderBy('name')->where("email_address",$email)->get();
        echo json_encode($email_lists);
    }
    public function getCustomeSearchData(Request $request){
		$custome_search = $request->custome_search;
        $searchfields = array();
        $contact_database = ContactDatabase::first();
        $form_fields = json_decode($contact_database->fields);
        foreach ($form_fields as $sngl) {
            if(isset($sngl->search) && $sngl->search=='1'){
                $searchfields[] = $sngl->fieldname;
            }
        }
        $email_lists =EmailList::orderBy('name')->get();
        $email_data = array();
        foreach ($email_lists as $sngl) {
            $fields = json_decode($sngl->fields,true);
            if(is_array($fields) && count($fields)>0){
                foreach ($fields as $key=>$sngl_field) {
                    foreach ($searchfields as $sf) {
                        if(strtolower($key)==strtolower($sf)){
                            //echo strtolower($sngl_field).' '.strtolower($custome_search).', <br>';
                            if(strpos('a'.$sngl_field,$custome_search)){
                                $email_data[] = $sngl;
                                break;
                                break;
                            }
                        }
                    }
                }
            }
        }
        //echo $this->db->last_query();
        echo json_encode($email_data);
    }
}