<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\siteSettings;
use DateTime;
use App\Models\ImageGalleryCategory;
use DateInterval;
use DateTimeZone;
class ReminderController extends Controller
{
    //
    public function __construct(){
        $this->data['controller'] = 'reminders';
        $this->data['controller_name'] = 'Reminders';
        $this->data['font_family'] = get_font_family();
        $this->data['siteSettings'] = siteSettings::first();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
    } 

    //
    public function index(Request $request) {
        //getPrint($this->data); exit;
        $this->data['page'] = $request->page;
       
        $totalrows = Reminder::count();
       // parent::pagination_conf($page, $url, $totalrows, $uriSegment = 4, 10);
        $this->data['listing'] = Reminder::paginate(10);
		$this->data['admin'] = true;
        
        return view('admin.reminders.list', $this->data);
    }
    public function add(Request $request) {
         
        if($_POST && isset($_POST['add-reminder'])){
            $insertData['title'] = $request->title;
            $insertData['message'] = $request->message;
            $insertData['type'] = $request->type;
	        $siteSetting = $this->data['siteSettings'];
            $utc = getTimeZone($siteSetting->timezone);
            if($insertData['type']=='1'){
                $minutes_to_add = $request->timeinmin;
                $time = new DateTime();
                $time->setTimezone(new DateTimeZone("$utc")); //GMT
                //echo $time->format('m-d H:i:s').' - ';
                $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $insertData['datetime'] = date('Y-').$time->format('m-d H:i:s');
            }else{
                $date = new DateTime($request->date.' '.$request->time);
                $date->setTimezone(new DateTimeZone("$utc")); //GMT
                $insertData['datetime'] =  date('Y-').$date->format('m-d H:i:s');
            }
            Reminder::create($insertData);
            return back(); 
        }
        return view('admin.reminders.add', $this->data);
    }
    public function edit(Request $request) {
         
        if($_POST  && isset($_POST['edit-reminder'])){
            $insertData['title'] = $request->title;
            $insertData['message'] = $request->message;
            $insertData['type'] = $request->type;
            $siteSetting = $this->data['siteSettings'];
            $utc = getTimeZone($siteSetting->timezone);
            if($insertData['type']=='1'){
                $minutes_to_add = $request->timeinmin;
                $time = new DateTime();
                $time->setTimezone(new DateTimeZone("$utc")); //GMT
                $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                $insertData['datetime'] = date('Y-').$time->format('m-d H:i:s');
            }else{
                $date = new DateTime($request->date.' '.$request->time);
                $date->setTimezone(new DateTimeZone("$utc")); //GMT
                $insertData['datetime'] =  date('Y-').$date->format('m-d H:i:s');
            }
            Reminder::where(array('id'=>$request->id))->update($insertData);
            return back(); 
        }
        $this->data['row_id'] = $request->id;
        $this->data['detail_info'] = Reminder::find($request->id);
        return view('admin.reminders.edit', $this->data);
    }


    //delete record
    public function delete(Request $request) {
        Reminder::where(array('id' => $request->catID))->delete();
    }
}
