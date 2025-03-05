<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\timedImagesSetting;
use App\Models\scheduleEmailCustom;
use Illuminate\Support\Facades\File;
use App\Models\ScheduleEmail;
use App\Models\CrmSetting;
use App\Models\EmailList;
use App\Models\ContactGroupEmail;
use App\Models\EngagementNotification;
use App\Models\ScheduleEmailContact;
use App\Models\newsPosts;
use DateTime;
use DateTimeZone;
use DB;
use Illuminate\Support\Facades\Config;


use Carbon\Carbon;

class CronJobController extends Controller
{
	public function index()
	{
		$timedImagesSetting = timedImagesSetting::get();

		foreach ($timedImagesSetting as $timedImage) {
			try {
				$start_time = $timedImage->start_time;
				$days = $timedImage->days;
				$end_time = $timedImage->end_time;
				// $end_time = new DateTime($timedImage->end_time);

				// $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

				$end_time = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", strtotime($timedImage->end_time)), getFrontDataTimeZone());
				$current_time = new DateTime(date('H:i:s'));
				$current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

				// $current_time = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'), getFrontDataTimeZone());
				// $start_time = new DateTime($start_time);

				// $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

				$start_time = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", strtotime($timedImage->start_time)), getFrontDataTimeZone());
				$days = json_decode($days);
				$day = strtolower($start_time->format('D'));

				// if($timedImage->slug == 'timed_popup_image'){
				//     print_r($current_time->format('Y-m-d H:i:s') );
				//     echo "<br>";
				//     print_r( $end_time->toDateTimeString() );
				// }

				if ((strtotime($current_time->format('Y-m-d H:i:s')) > strtotime($end_time->toDateTimeString())  && $timedImage->type == 'timer') || (strtotime($current_time->format('Y-m-d H:i:s')) > strtotime($end_time->toDateTimeString())  && $timedImage->type == 'days' && $days &&  is_array($days) &&  !in_array($day, $days))) {
					DB::table('timed_images_settings')->where('id', $timedImage->id)->update(array('enable' => '0'));
				}
			} catch (Exception $e) {
				// dd($e->getMessage());
			}
		}

		$news_posts = newsPosts::get();
		foreach ($news_posts as $newsPost) {

			try {
				if ($newsPost->enable_timed_image) {

					$start_time = $newsPost->timed_image_start_time;
					$days = $newsPost->timed_image_days;
					$end_time = $newsPost->timed_image_end_time;
					// $end_time = new DateTime($newsPost->timed_image_end_time);

					// $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
					$end_time = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", strtotime($newsPost->timed_image_end_time)), getFrontDataTimeZone());
					$current_time = new DateTime(date('H:i:s'));
					$current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
					// $current_time = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'), getFrontDataTimeZone());
					// $start_time = new DateTime($start_time);

					// $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
					$end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
					$start_time = Carbon::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", strtotime($newsPost->timed_image_start_time)), getFrontDataTimeZone());
					$days = json_decode($days);
					$day = strtolower($start_time->format('D'));

					if ((strtotime($current_time->format('Y-m-d H:i:s')) > strtotime($end_time->toDateTimeString())  && $newsPost->timed_image_type == 'timer') || (strtotime($current_time->format('Y-m-d H:i:s')) > strtotime($end_time->toDateTimeString())  && $newsPost->timed_image_type == 'days' && $days &&  is_array($days) &&  !in_array($day, $days))) {
						// if($newsPost->id == 3){
						//     print_r($current_time->format('Y-m-d H:i:s') );
						//     echo "<br>";
						//     print_r( $end_time->toDateTimeString() );
						//     echo "<br>".$start_time->format('D');

						// }   
						newsPosts::where('id', $newsPost->id)->update(array('enable_timed_image' => 0));
					}
				}
			} catch (Exception $e) {
				// dd($e->getMessage());
			}
		}
	}
	function scheduleEmailsCustom()
	{

		$pending_schedules = scheduleEmailCustom::where('is_done', "0")->get();
		$this->data['home_data'] = [];
		$this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
		$this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
		$this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
		$this->data['generic_description'] = get_text_details('generic_email_post_description');
		$crm_settings = CrmSetting::first();
		if (count($pending_schedules) > 0) {
			foreach ($pending_schedules as $schedule) {
				$schedule_datetime = $schedule->schedule_datetime;
				$current_time = new DateTime();
				$current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
				$current_time->setTimestamp(time());

				$end_time = new DateTime($schedule_datetime, new DateTimeZone(getFrontDataTimeZone()));
				if ($current_time >= $end_time) {
					$email_template = get_emailtemplate_data($schedule->email_template_id);

					$preheader_text = get_prehead_text($email_template->preheader_text);
					$this->data['preheader_text'] = $preheader_text;

					$this->data['template_data'] = $email_template;
					$this->data['email_custom'] = $schedule->schedule_email;
					$this->data['view_in_browser_link'] = base_url('home/view_mail') . '?customemail=' . $schedule->schedule_email . '&tempId=' . $email_template->id;

					if (isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address != "") {
						$this->data['optout_link'] = env("OPTOUT_SITE_URL") . '?pop=8&cust_site=' . env("SITE_NAME") . '&customemail=' . $schedule->schedule_email . '&optoutmail=' . $crm_settings->optout_email_address;
					}
					sendmail($schedule->schedule_email, $email_template->teaser_title, 'email_template', $this->data, array(), true);
					$schedule->is_done = '1';
					$schedule->save();
				}
			}
		}
	}
	function scheduleEngagementNotification()
	{
	    $databaseMappings = [
             'DEFAULTWEBSITE','START','PEDROVALLEYLANDSCAPING','PERSONALTRAINER','MARIACUISINE','FREEYOURSELFFROM','VISIONTRAT','BRANDYSTRAVEL','TRICITYAIR','BROWSVV','TEMP5','TEMP7','DEMONICFABRICATION',
             'TEMP8','MARYKAYAV','STUFFETC','HIBACHIOSAKA','TORTASFOODTRUCK','ELHAURACHONHD','HDFAMILYEVENTS','TESTSITE2','TESTSITE3','TESTSITE4','TUTORIAL','PROMO',
             'GOOG','OFFICESPACE','INSURVV','CHINGONATACOS','CVSREALTOR','LACASITA','ELCOWBOYBOOTS','TWEED','YELLOWSTONE','DRIPPGANGFASHION','REST1','GARDENERS','APARTMENTS',
             'BAR','POOL','HANDYMAN','HAIR','GROOMING','FOODTRUCK','FOODSTAND','DONUTS','CONTRACTOR','CLEANING','GARDENER','STORE','RESTAURANT','POPUPALERT','HEAVENLYANIHOMECARE',
             'LEARNABOUT','NIAISMYGROOMER','6363CHRISTIEAVE','723WESTMOUNTDR202','3281MANDEVILLE','AMERICANLIFESTYLEPROP','BEMYREFERRAL_DATABASE','16118ANDOVERDR','SAFETYCONSULTING','SMALLBIZZ',
             'HUMBELBIRD','SMITTYS','ATTEND','RECIPEAPP','WORKOUT','TASK','MEETING','ALLOUTNAILZ','TEMP1','TEMP2','TEMP3','TRAINING','TRAINING1','enfohub_staging','FOODTRUCK1','FOODTRUCK2','GRIPACADEMY','SIMMONS',
             'STORE2','VICTORVILLENETWORK','AVNETWORK','NETWORK103','BUTTERCUP','NETWORKING',
        ];
        foreach ($databaseMappings as $dbAlias) {
            if ($dbAlias === 'enfohub_staging') {
                // For staging, use DB_DATABASE
                $database = env('DB_DATABASE');
                $username = env('DB_USERNAME');
                $password = env('DB_PASSWORD');
            } else {

                // For other databases, use the specific env values for each database
                $database = env("DB_{$dbAlias}_DATABASE");
                $username = env("DB_{$dbAlias}_USERNAME");
                $password = env("DB_{$dbAlias}_PASSWORD");
                
            }
            if ($database && $username && $password) {
                // Dynamically set the database connection for each mapped DB
                Config::set("database.connections.$dbAlias", [
                    "driver" => "mysql",
                    "host" => "127.0.0.1",
                    "port" => "3306",
                    "database" => $database,
                    "username" => $username,
                    "password" => $password,
                ]);
        
                // Optionally: Set as default connection to perform operations
                DB::setDefaultConnection($dbAlias);

                
                	$currentTime = Carbon::now()->toTimeString();

        		$notifications = EngagementNotification::where('notification_sent', false)
        			->first();
        				$base_url = url('/');
        		$currentConnection = DB::getDefaultConnection();
                $hostName = getDomainFromConnection($currentConnection);
        		$full_url = $hostName . '/dashboard?open_modal=true';
        		
        			         // if ($notifications && $notifications->is_real_time && $notifications->check_for_likes_and_comments == 0) {
                            //     if (isset($notifications->emails) && is_array($notifications->emails)) {
                            //         foreach ($notifications->emails as $email) {
                            //             $data['message'] = 'Click to view New Engagements: "' . $full_url . '"';
                            //             sendmail($email, 'You Have New Engagements', 'string_template', $data, false);
                            //         }
                            
                            //         $notifications->update(['check_for_likes_and_comments' => 1]);
                            //     }
                            // }
        			
        		if(isset($notifications->time))
        		{
        		    $savedTime = Carbon::parse($notifications->time)->format('h:i A'); // Parse the saved time and extract "H:i" (hour and minute)
        		}
        		else
        		{
        		    $savedTime = false;
        		}
        		$current_time = new DateTime();
				$current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
				$current_time->setTimestamp(time());
				$current_time = $current_time->format('h:i A');
        		if (!$savedTime) {
                    if ($current_time !== '08:00 PM') {
                        continue;
                    }
                } else {
                    if ($savedTime != $current_time) {
                        continue;
                    }
                }
        	

        		if(isset($notifications->emails))
        		{
        		    foreach ($notifications->emails as $email) {
        
        				$data['message'] = 'Click to view New Engagements: "' . $full_url . '"';
        				sendmail($email, 'You Have New Engagements', 'string_template', $data, false);
        			}
        
        			$notifications->update(['notification_sent' => true]);
        		}
        			
            }
        }
		exit;
	}
	public function scheduleEmails()
	{
		$pending_schedules = ScheduleEmail::where('is_done', "0")->get();
		$crm_settings = CrmSetting::first();
		$this->data['home_data'] = [];
		$this->data['generic_title'] = get_text_details('generic_email_post_logo_title');
		$this->data['generic_content_title'] = get_text_details('generic_email_post_content_title');
		$this->data['generic_subtitle'] = get_text_details('generic_email_post_subtitle');
		$this->data['generic_description'] = get_text_details('generic_email_post_description');
		$total_schedules = 0;
		$sent = 0;
		$failed = 0;
		$total = 0;
		if (count($pending_schedules) > 0) {
			foreach ($pending_schedules as $schedule) {
				$schedule_datetime = $schedule->schedule_datetime;
				$current_time = new DateTime();
				$current_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
				$current_time->setTimestamp(time());
				$end_time = new DateTime($schedule_datetime, new DateTimeZone(getFrontDataTimeZone()));
				//echo '<pre>';
				// print_r($current_time);
				// print_r($end_time);
				if ($current_time >= $end_time) {
					$total_schedules++;
					$template_data = get_emailtemplate_data($schedule->email_template_id);
					$contact_group_emails = [];
					if ($schedule->contact_type && $schedule->contact_type == 'Group') {
						if ($schedule->contact_group_id != "all") {
							$contact_group_emails = ContactGroupEmail::where('contact_group_id', $schedule->contact_group_id)->get();
							$total += count($contact_group_emails);
							if (count($contact_group_emails) > 0) {
								foreach ($contact_group_emails as $email) {
									$email_data = EmailList::where('id', $email->email_id)->orderBy('email_address')->first();
									if (
										isset($email_data) && isset($email_data->email_address) &&
										($email_data->subscribed ||   ($schedule->non_subscribers !== null && $schedule->non_subscribers))
									) {
										$this->data['template_data'] = $template_data;
										$this->data['email_data'] = $email_data;
										$preheader_text = get_prehead_text($template_data->preheader_text);
										$this->data['preheader_text'] = $preheader_text;
										if (isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address != "") {

											$this->data['optout_link'] = env("OPTOUT_SITE_URL") . '?pop=8&cust_site=' . env("SITE_NAME") . '&emailId=' . $email_data->id . '&optoutmail=' . $crm_settings->optout_email_address;
										}
										$this->data['view_in_browser_link'] = base_url('home/view_mail') . '?emailId=' . $email_data->id . '&tempId=' . $template_data->id;
										sendmail($email_data->email_address, $template_data->teaser_title, 'email_template', $this->data, array(), true);
										$sent++;
									}
								}
							}
						} else {
							$email_data_all = EmailList::orderBy('name', 'asc')->get();
							$total += count($email_data_all);
							if (count($email_data_all) > 0) {
								foreach ($email_data_all as $email_data) {
									if (
										isset($email_data) && isset($email_data->email_address) &&
										($email_data->subscribed ||   ($schedule->non_subscribers !== null && $schedule->non_subscribers))
									) {
										$this->data['template_data'] = $template_data;
										$this->data['email_data'] = $email_data;
										$preheader_text = get_prehead_text($template_data->preheader_text);
										$this->data['preheader_text'] = $preheader_text;
										if (isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address != "") {

											$this->data['optout_link'] = env("OPTOUT_SITE_URL") . '?pop=8&cust_site=' . env("SITE_NAME") . '&emailId=' . $email_data->id . '&optoutmail=' . $crm_settings->optout_email_address;
										}
										$this->data['view_in_browser_link'] = base_url('home/view_mail') . '?emailId=' . $email_data->id . '&tempId=' . $template_data->id;
										sendmail($email_data->email_address, $template_data->teaser_title, 'email_template', $this->data, array(), true);
										$sent++;
									}
								}
							}
						}
					}
					if ($schedule->contact_type && $schedule->contact_type == 'Contact') {
						$schedules_emails = ScheduleEmailContact::where('schedule_email_id', $schedule->id)->get();
						if (isset($schedules_emails) && count($schedules_emails)) {
							foreach ($schedules_emails as $schedule_email) {
								$email_data = EmailList::where('id', $schedule_email->email_list_id)->orderBy('email_address')->first();
								if (
									isset($email_data) && isset($email_data->email_address) &&
									($email_data->subscribed ||   ($schedule->non_subscribers !== null && $schedule->non_subscribers))
								) {
									$this->data['template_data'] = $template_data;
									$this->data['email_data'] = $email_data;
									$preheader_text = get_prehead_text($template_data->preheader_text);
									$this->data['preheader_text'] = $preheader_text;
									if (isset($crm_settings->optout_email_address) && $crm_settings->optout_email_address != "") {
										$this->data['optout_link'] = env("OPTOUT_SITE_URL") . '?pop=8&cust_site=' . env("SITE_NAME") . '&emailId=' . $email_data->id . '&optoutmail=' . $crm_settings->optout_email_address;
									}
									$this->data['view_in_browser_link'] = base_url('home/view_mail') . '?emailId=' . $email_data->id . '&tempId=' . $template_data->id;
									sendmail($email_data->email_address, $template_data->teaser_title, 'email_template', $this->data, array(), true);
									$sent++;
								}
							}
						}
					}
					$schedule->is_done = '1';
					$schedule->save();
				}
			}
		}

		exit;
	}


	public function clearLogs()
	{
		// Specify the path to the error log file
		$logFilePath = storage_path('logs/laravel.log');
		$errorLogPath = base_path('error_log');
		$errorLogPath2 = $_SERVER['DOCUMENT_ROOT'] . '/' . 'error_log';

		// Check if the file exists before attempting to delete it
		if (File::exists($logFilePath)) {
			// Delete the error log file
			File::delete($logFilePath);

			// Optionally, you can create a new empty log file
			File::put($logFilePath, '');

			if (File::exists($errorLogPath)) {
				// Delete the error log file
				File::delete($errorLogPath);

				// Optionally, you can create a new empty log file
				File::put($errorLogPath, '');
			}

			if (File::exists($errorLogPath2)) {

				//   echo File::exists($errorLogPath2)?'yes':'no';
				// Delete the error log file
				File::delete($errorLogPath2);

				// Optionally, you can create a new empty log file
				File::put($errorLogPath2, '');
			}
			// You can also log a message or perform any other action after the file is deleted
			echo ('Laravel error log file has been deleted.');
		} else {
			// Log a message if the file does not exist
			echo ('Laravel error log file not found.');
		}
	}
}
