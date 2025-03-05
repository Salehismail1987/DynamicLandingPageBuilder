<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationSettings;
use App\Models\setHoursSettings;
use App\Models\siteSettings;
use App\Models\setHours;
use App\Models\ImageGalleryCategory;
use App\Models\rotatingScheduleSettings;
use App\Models\rotatingSchedule;
use App\Models\images;
use App\Models\alertPopupSetting;
use Illuminate\Support\Facades\Log;


use DateTime;
use DateTimeZone;
use Throwable;

class SchedulingController extends Controller
{
    public function __construct(){
        $this->data['controller'] = 'scheduling';
        $this->data['controller_name'] = 'Scheduling Features & Business Hours';
        $this->data['font_family'] = get_font_family();
        
        $this->data['all_categories'] = ImageGalleryCategory::all(); 

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        
    }
    public function index(){
        $siteSettings = siteSettings::first();
        $utc = getTimeZone($siteSettings->timezone);
        date_default_timezone_set("$utc");
        updateRotatingSchedule();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['setHoursSettings'] = setHoursSettings::first();
        $this->data['siteSettings'] = siteSettings::first();
        $this->data['rotatingScheduleSettings'] = rotatingScheduleSettings::first();

        updateTimedImages();
        // $this->data['setHours'] = setHours::get();
        $setHoursExceptLast = SetHours::where('id','<', 7)->get();
        // Get the last record
        $lastSetHour = SetHours::orderBy('id', 'desc')->first();
        
        // Combine them, putting the last record first
        $this->data['setHours'] = $setHoursExceptLast->prepend($lastSetHour);
        // dd($this->data['setHours']);
        $this->data['rotatingSchedule'] = rotatingSchedule::get();
        // dd(rotatingSchedule::get());
        $this->data['timed_set_hour_image_file'] = get_image('timed_set_hour_image'); 
        
        $this->data['schedule_image_desc_text'] = get_text_details('schedule_image_desc_text');
        $this->data['daily_hours'] = get_text_details('daily_hours');
       
        $this->data['set_hours_day'] = get_text_details('set_hours_day');
        $this->data['set_hours_sub_title'] = get_text_details('set_hours_sub_title');
        $this->data['set_hours_comment'] = get_text_details('set_hours_comment');
        $this->data['master_image_description'] = get_text_details('master_image_description');
        
        $this->data['daily_hours_today'] = get_text_details('daily_hours_today');
        $this->data['daily_hours_future_day'] = get_text_details('daily_hours_future_day');
        $this->data['daily_hours_day_block'] = get_text_details('daily_hours_day_block');
        $this->data['daily_hours_set_1'] = get_text_details('daily_hours_set_1');
        $this->data['daily_hours_set_2'] = get_text_details('daily_hours_set_2');
        $this->data['daily_hours_start_title'] = get_text_details('daily_hours_start_title');
        $this->data['daily_hours_end_title'] = get_text_details('daily_hours_end_title');
        $this->data['busniess_hours_times'] = get_text_details('busniess_hours_times');
        $this->data['busniess_hours_comments'] = get_text_details('busniess_hours_comments');

        $this->data['timed_set_hour_image'] = get_timed_image('timed_set_hour_image');

        return view('admin.scheduling')->with($this->data);
    }
    public function saveSetHours(Request $request){
        $notificationSettings = NotificationSettings::first();
        $message = 'Set Hours has been updated';
        $block = 'set_schedule';

        if (check_auth_permission(['set_hours'])) {
            $newData = setHoursSettings::find(1);
            $newData->background = $request->busniess_hours_background;
            $newData->day_settings = $request->day_settings == 'on'?'1':'0';
            $newData->save();
        }
        if (check_auth_permission(['set_hours_image'])) {
            $newData = setHoursSettings::find(1);
            if($request->set_hour_image){
                if(isset($newData->set_hour_image)){
                    delimg($newData->set_hour_image);
                }
                $newData->set_hour_image = saveimagefromdataimage($request->set_hour_image);
            }
            $newData->set_hour_image_width =  $request->set_hour_image_width;
            $newData->save();

            
            $data = (object)[];
            $data->text = $request->hour_image_desc_text;
            $data->color = $request->hour_image_desc_text_color;
            $data->size_web = $request->hour_image_desc_text_font_size;
            $data->fontfamily = $request->hour_image_desc_text_font;
            update_text_details('schedule_image_desc_text',$data);

        }
        if (check_auth_permission('set_hours_time_settings')) { 
            $data = (object)[];
            $data->color = $request->set_hours_hour_color;
            $data->size_web = $request->daily_hours_fontsize_gen;
            $data->size_mobile = $request->daily_hours_fontsize_mobile_gen;
            update_text_details('daily_hours',$data);
            
            $data = (object)[];
            $data->color = $request->busniess_hours_date_color;
            $data->size_web = $request->set_hours_date_font_size;
            $data->size_mobile = $request->set_hours_date_font_size_mobile;
            $data->fontfamily = $request->set_hours_date_font_family;
            update_text_details('set_hours_day',$data);

            $data = (object)[];
            $data->text = $request->busniess_hours_hours_title;
            $data->color = $request->busniess_hours_hours_title_color;
            $data->size_web = $request->set_hours_hours_title_fontsize;
            $data->size_mobile = $request->set_hours_hours_title_fontsize_mobile;
            $data->fontfamily = $request->busniess_hours_title_font_family;
            update_text_details('set_hours_sub_title',$data);

            $data = (object)[];
            $data->color = $request->busniess_hours_hours_comment_color;
            $data->size_web = $request->set_hours_hours_comment_fontsize;
            $data->size_mobile = $request->set_hours_hours_comment_fontsize_mobile;
            $data->fontfamily = $request->set_hours_hours_comment_fontfamily;
            update_text_details('set_hours_comment',$data);
        }
        
        if (check_auth_permission('set_hours_time_settings')) { 
            $i = 0;
            foreach($request->sethoursid as $setHrId){
                $newData = setHours::find($setHrId);
                $newData->start = isset($request->daily_hours_start[$i])?$request->daily_hours_start[$i]:'';
                $newData->end = isset($request->daily_hours_end[$i])?$request->daily_hours_end[$i]:'';
                $newData->comments = isset($request->daily_hours_comments[$i])?$request->daily_hours_comments[$i]:'';
                $newData->start_2 = isset($request->daily_hours_start2[$i])?$request->daily_hours_start2[$i]:'';
                $newData->end_2 = isset($request->daily_hours_end2[$i])?$request->daily_hours_end2[$i]:'';
                $newData->comments_2 = isset($request->daily_hours_comments2[$i])?$request->daily_hours_comments2[$i]:'';
                $newData->hours_color = isset($request->daily_hours_color[$i])?$request->daily_hours_color[$i]:'';
                $newData->day_color = isset($request->daily_hours_day_color[$i])?$request->daily_hours_day_color[$i]:'';
                $newData->day_orveride_generic = isset($request->day_orveride_generic[$i]) && $request->day_orveride_generic[$i]?'1':'0';
                $newData->hours_orveride_generic = isset($request->hours_orveride_generic[$i]) && $request->hours_orveride_generic[$i] ? '1':'0';
                $newData->save();
                $i++;
            }
        }

        if (check_auth_permission('set_hours_timed_image')) { 
            if($request->timed_set_hour_image){
                $newImage = images::where('slug','timed_set_hour_image')->first();
                if(isset($newImage->file_name)){
                    delimg($newImage->file_name);
                }
                $newImage->file_name = saveimagefromdataimage($request->timed_set_hour_image);
                $newImage->save(); 
            }
            $data = (object)[];
            $data->enable = $request->enable_timed_set_hour_image?'1':'0';

            $data->type = $request->set_hour_image_type;
            $data->image_timer = $request->set_hour_image_timer;
            $data->days = json_encode($request->days);
            if($data->type=='days'){
                $data->start_time= $request->set_hour_image_start_time;
                $data->end_time = $request->set_hour_image_end_time;
            }else{
                $timer = $request->set_hour_image_timer;
                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s',strtotime('+'.$timer.' minutes',strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $data->start_time= $start_time;
                $data->end_time = $end_time;
            }
            update_timed_image_setting('timed_set_hour_image', $data);
        }
        checkSendNotification('Scheduling has been updated',$message,'scheduling_notifications','scheduling_notification_email');

        if($request->savedailyhours!='save'){
            return redirect('reminders')->withSuccess($message);
        }else{
            return redirect('scheduling?block='.$block)->withSuccess($message);
        }
    }
    
    public function saveRotatingHours(Request $request){
        try
        {
            if (!check_auth_permission(['rotating_schedule', 'rotating_hours_time_settings'])) { 
                return  redirect('dashboard')->withError('Access Denied'); 
            }
            $notificationSettings = NotificationSettings::first();
            $message = 'Rotating Hours has been updated';
            $block = 'rotating_schedule';
            $newData = rotatingScheduleSettings::find(1);
            $newData->apply_all_days = $request->is_master_image_on?'1':'0';
            $newData->arrow_color = $request->arrow_color;
            $newData->day_tile_bg_color = $request->day_tile_bg_color;
            
            $newData->arrow_bg_color = $request->arrow_bg_color;
            /* (Hassan) Saving both parameters for image size (Begin) */
            $newData->max_width = $request->max_width;
            /* Saving both parameters for image size (End) */   
    
            if($request->rotating_shift_image){
                if(isset($newData->rotating_schedule_image)){
                    delimg($newData->rotating_schedule_image);
                }
                $newData->rotating_schedule_image = saveimagefromdataimage($request->rotating_shift_image);
            }
           
            $newData->background = $request->rotating_hours_background?$request->rotating_hours_background:'';
            $newData->save();
            $duplicate = [];
            $i = 0;
            foreach($request->rotatinghoursid as $single){
                if(!isset($single))
                {
                    continue;
                }
                $newData = rotatingSchedule::find($single);
                $date = date("Y-m-d");
                $newData->date = date('Y-m-d', strtotime("+".$i." day", strtotime($date)));
                if(!isset($request->day[$newData->date]))
                {
                    continue;
                }
                $newData->day = $request->day[$newData->date];
                $newData->start = $request->daily_hours_start[$newData->date];
                $newData->end = $request->daily_hours_end[$newData->date];
                $newData->comments = isset($request->daily_hours_comments[$newData->date])?$request->daily_hours_comments[$newData->date]:'';
                $newData->start_2 = isset($request->daily_hours_start2[$newData->date])?$request->daily_hours_start2[$newData->date]:'';
                $newData->end_2 = isset($request->daily_hours_end2[$newData->date])?$request->daily_hours_end2[$newData->date]:'';
                $newData->comments_2 = isset($request->daily_hours_comments2[$newData->date])?$request->daily_hours_comments2[$newData->date]:'';
                // dd($request->day_image_description_text_font);
                if(isset($request->day_image[$newData->date])){
                    if(isset($newData->image)){
                        delimg($newData->image);
                    }
                    $newData->image = isset($request->day_image[$newData->date])?  saveimagefromdataimage($request->day_image[$newData->date]):'';
                }
                $newData->image_description = isset($request->day_image_description_text[$newData->date])?$request->day_image_description_text[$newData->date]:'';
                $newData->description_font_size = isset($request->day_image_description_text_font_size[$newData->date])?$request->day_image_description_text_font_size[$newData->date]:'';
                $newData->description_font_family = isset($request->description_font_family[$newData->date])?$request->description_font_family[$newData->date]:'';
                $newData->duplicate_for_next_week_day = (isset($request->duplications[$newData->date]) && $request->duplications[$newData->date])?'1':'0';
                $newData->save();
             
                $i++;
            }
           
            $newData = (object)[];
            $newData->text = $request->day_master_image_description_text;
            $newData->size_web = $request->day_master_image_description_text_size;
            $newData->color = $request->day_master_image_description_text_color;
            $newData->fontfamily = $request->day_master_image_description_text_font;
            update_text_details('master_image_description',$newData);
    
            $newData = (object)[];
            $newData->size_web = $request->today_font_size;
            $newData->color = $request->today_color;
            $newData->fontfamily = $request->today_font_family;
            update_text_details('daily_hours_today',$newData);
    
            
            $newData = (object)[];
            $newData->size_web = $request->non_today_font_size;
            $newData->color = $request->today_color;
            $newData->fontfamily = $request->today_font_family;
            update_text_details('daily_hours_future_day',$newData);
    
            
            $newData = (object)[];
            $newData->size_web = $request->busniess_hours_date_font_size;
            $newData->color = $request->busniess_hours_date_color;
            $newData->bg_color = $request->busniess_hours_date_bg_color;
            $newData->fontfamily = $request->busniess_hours_date_font_family;
            update_text_details('daily_hours_day_block',$newData);
    
    
            
            $newData = (object)[];
            $newData->text = $request->busniess_hours_hours_title;
            $newData->size_web = $request->busniess_hours_hours_title_fontsize;
            $newData->color = $request->busniess_hours_hours_title_color;
            $newData->fontfamily = $request->busniess_hours_title_font_family;
            update_text_details('daily_hours_set_1',$newData);
    
            
            $newData = (object)[];
            $newData->text = $request->busniess_hours_hours_title_2;
            $newData->size_web = $request->busniess_hours_hours_title_2_fontsize;
            $newData->color = $request->busniess_hours_hours_title_2_color;
            $newData->fontfamily = $request->busniess_hours_title_2_font_family;
            update_text_details('daily_hours_set_2',$newData);
            
            
            $newData = (object)[];
            $newData->text = $request->busniess_hours_hours_start_title;
            $newData->size_web = $request->busniess_hours_hours_start_title_fontsize;
            $newData->color = $request->busniess_hours_hours_start_title_color;
            $newData->fontfamily = $request->busniess_hours_hours_start_title_font_family;
            update_text_details('daily_hours_start_title',$newData);
    
            
            $newData = (object)[];
            $newData->text = $request->busniess_hours_hours_end_title;
            $newData->size_web = $request->busniess_hours_hours_end_title_fontsize;
            $newData->color = $request->busniess_hours_hours_end_title_color;
            $newData->fontfamily = $request->busniess_hours_hours_end_title_font_family;
            update_text_details('daily_hours_end_title',$newData);
    
            
            $newData = (object)[];
            $newData->size_web = $request->busniess_hours_times_fontsize;
            $newData->color = $request->busniess_hours_times_color;
            $newData->fontfamily = $request->busniess_hours_times_font_family;
            update_text_details('busniess_hours_times',$newData);
    
            
            $newData = (object)[];
            $newData->size_web = $request->busniess_hours_hours_comment_fontsize;
            $newData->color = $request->busniess_hours_hours_comment_color;
            update_text_details('busniess_hours_comments',$newData);
    
            $notificationSettings = NotificationSettings::first();
            checkSendNotification('Scheduling has been updated',$message,'scheduling_notifications','scheduling_notification_email');
    
            if($request->savedailyhours!='save'){
                return redirect('reminders')->withSuccess($message);
            }else{
                return redirect('scheduling?block='.$block)->withSuccess($message);
            }
        }
        catch(Throwable $e)
        {
            return redirect('scheduling?block='.$block)->withSuccess('Error: Rotating hours could not be saved');
        }
       
    }

    public function saveRepeatingHours(Request $request){
        if($request->is_repeat && $request->id){
            $is_duplication = $request->is_repeat == 'YES'?'1':'0'; 
            rotatingSchedule::where('id',$request->id)->update(['duplicate_for_next_week_day' => $is_duplication]);
            checkSendNotification('Scheduling has been updated','Schedule duplicated','scheduling_notifications','scheduling_notification_email');
        }
    }
}
