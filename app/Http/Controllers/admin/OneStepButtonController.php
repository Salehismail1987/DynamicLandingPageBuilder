<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\oneStepImages;
use App\Models\ImageGalleryCategory;
use App\Models\notifications;
use App\Models\NotificationSettings;
use App\Models\alertPopupSetting;
use DateTime;
use DateTimeZone;
use DB;

class OneStepButtonController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'onestepbutton';
        $this->data['controller_name'] = 'One Step Button';
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['font_family'] = get_font_family();
    }
    public function index(){
        $this->data['notificationSettings'] = NotificationSettings::first();
        if (!check_auth_permission('step_buttons')) {
            return  redirect('dashboard')->withError('Access Denied'); 
        }
        
        updateTimedImages();
        $this->data['one_step_images'] = oneStepImages::get();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['categories'] = oneStepImages::select('category')->groupBy('category')->get();
        $this->data['indicator'] = oneStepImages::where('status',1)->where('start_time', '!=',null)->first();
        return view('admin.onestepbutton')->with($this->data);
    }
    public function manageSteps(Request $request){
        $notificationSettings = NotificationSettings::first();
		$show_indicator = false;
		$step_id = $request->step_id;

		$first_image_text = $request->first_image_text;
		$second_image_text = $request->second_image_text;

		$duration = $request->duration;
		$category = $request->category;

        $indicator = oneStepImages::where('status','1')->where('start_time','!=',null)->first();
		if ($indicator) {
			$show_indicator = true;
		}

		$step = oneStepImages::find($step_id);
		if ($step) {
			if ($step->notification_status=='1') {
                $newData = new notifications();
                $newData->message = $step->name.' has been updated';
                $newData->save();
			}
			if ($step->status && $step->active_time == $duration) {
                $newData = oneStepImages::where('category',$category)->first();
                $newData->status = '0';
                $newData->active_time = '0';
                $newData->start_time = null;
                $newData->save();
                
                $message = $category." 1-Step Button Deactivated";
                checkSendNotification('1-Step Buttons',$message);
                
				echo json_encode(array('flag' => false,'show_indicator'=>$show_indicator));
				exit;
			}
            $newData = oneStepImages::where('category',$category)->first();
            $newData->status = '0';
            $newData->active_time = '0';
            $newData->start_time = null;
            $newData->save();
            
			$timezone = getFrontDataTimeZone();
			$dt = new DateTime();
			$dt->setTimezone(new DateTimeZone($timezone));
			$dt->setTimestamp(time());

            $newData = oneStepImages::where('id',$step_id)->first();
            $newData->status = '1';
            $newData->active_time = $duration;
            $newData->start_time = $dt->format('Y-m-d H:i:s');

			if ($step->text_enabled) {

                $textDet = (object)[];
                $textDet->text = $first_image_text;
                update_text_details("one_step_button_first_text_".$step_id,$textDet);

                $textDet = (object)[];
                $textDet->text = $second_image_text;
                update_text_details("one_step_button_second_text_".$step_id,$textDet);

			}
            
            $newData->save();

            $message =  $step->name." 1-Step Button Activated";
            checkSendNotification('1-Step Buttons',$message);
            
			echo json_encode(array('flag' => true,'show_indicator'=>$show_indicator));
			exit;
		}
		echo json_encode(array('flag' => false,'show_indicator'=>$show_indicator));
		exit;
    }

    public function deactivateAll(Request $request){
        $notificationSettings = NotificationSettings::first(); 
        
        $data = [
            'status' => 0,
            'active_time' => 0,
            'start_time' => null
        ];
        DB::table('one_step_images')->update($data);
        $message = "All 1-Step Buttons Deactivated";
        checkSendNotification('1-Step Buttons',$message);
        
        return redirect('onestepbutton')->withSuccess($message);

    }

    
	public function notificationUpdate(){
		$checked = $this->input->post('checked');
        $newData = NotificationSettings::find(1);
        $newData->id = $oldData->id;
        $newData->step_notifications = $checked;
        $newData->save();
	}

	// public function updatenotificationstatus() {
	// 	$step_id = $this->input->post('step_id');
	// 	$flag = $this->input->post('flag');

    //     $newData = oneStepImages::where('id',$step_id)->first();
    //     $newData->notification_status = $flag;
    //     $newData->save();
	// }

}
