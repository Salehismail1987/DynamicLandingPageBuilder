<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Blog;
use App\Models\Otp;
use App\Models\faqs;
use App\Models\menu;
use App\Models\HeaderVideo;
use App\Models\icons;
use App\Models\images;
use App\Models\newsFeed;
use App\Models\setHours;
use App\Models\addresses;
use App\Models\EmailList;
use App\Models\EmailPost;
use App\Models\newsPosts;
use App\Models\timeZones;
use App\Models\userRolls;
use App\Models\audioFiles;
use App\Models\CrmSetting;
use App\Models\FontFamily;
use App\Models\formsLinks;
use App\Models\hyperLinks;
use App\Models\ContactInfo;
use App\Models\customForms;
use App\Models\faqSettings;
use App\Models\galleryPost;
use App\Models\navBarItems;
use App\Models\permissions;
use App\Models\reviewStaff;
use App\Models\StaffProductsPromos;
use App\Models\StaffProductsPromosSettings;
use App\Models\seoSettings;
use App\Models\socialMedia;
use App\Models\textDetails;
use App\Models\blogSettings;
use App\Models\BusinessInfo;
use App\Models\contactForms;
use App\Models\ContactGroup;
use App\Models\galleryTiles;
use App\Models\galleryVideo;
use App\Models\headerImages;
use App\Models\headerSlider;
use App\Models\imageGallery;
use App\Models\siteSettings;
use Illuminate\Http\Request;
use App\Models\actionButtons;
use App\Models\downloadFiles;
use App\Models\formsSettings;
use App\Models\frontSections;
use App\Models\gallerySlider;
use App\Models\notifications;
use App\Models\oneStepImages;
use App\Models\ScheduleEmail;
use App\Models\blogCategories;
use App\Models\customUserForm;
use App\Models\EmailListImage;
use App\Models\EmailPostImage;
use App\Models\footerSettings;
use App\Models\navBarSettings;
use App\Models\reviewSettings;
use App\Models\ContactDatabase;
use App\Models\frontendSetting;
use App\Models\imageCategories;
use App\Models\newsFeedSetting;
use App\Models\outlineSettings;
use App\Models\rolePermissions;
use App\Models\contactFormTitle;
use App\Models\EmailPostStarter;
use App\Models\galleryPostImage;
use App\Models\newsPostSettings;
use App\Models\rotatingSchedule;
use App\Models\setHoursSettings;
use App\Models\alertPopupSetting;
use App\Models\ContactGroupEmail;
use App\Models\contentBlockLinks;
use App\Models\galleriesSettings;
use App\Models\contactBoxSettings;
use App\Models\hyperLinksSettings;
use App\Models\SuperAdminMessages;
use App\Models\timedImagesSetting;
use App\Models\customFormsSettings;
use App\Models\CustomScheduleEmail;
use App\Models\UnsubscribeUserForm;
use App\Models\contentBlockSettings;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use App\Models\ScheduleEmailContact;
use App\Models\EmailPostStarterImage;
use App\Models\rotatingScheduleSettings;
use App\Models\TitleBannerSetting;
use App\Models\AlertBannerSetting;
use App\Models\AttendhubPost;
use App\Models\DownloadSetting;
use App\Models\EngagementNotification;
use App\Models\EventPostSetting;
use App\Models\LearningCenterActionButton;
use Illuminate\Support\Facades\Cache;
use DateTime;
use DateTimeZone;
use PhpParser\Node\Stmt\TryCatch;

class HomeController extends Controller
{
    
    public function home(Request $request)
    {
        if (!isset($_GET['pop'])) {

            // updateFormsCustomEncoding();
        }
        $siteSettings = SiteSettings::first();

        $utc = getTimeZone($siteSettings->timezone);
        date_default_timezone_set("$utc");
        $currentDateTime = date('Y-m-d H:i:s');
        $alert = alertPopupSetting::first();
        $currentDate = date('Y-m-d', strtotime($currentDateTime));
        $dbDate = date('Y-m-d', strtotime($alert->updated_at));

        $dbTime = date('H:i:s', strtotime($alert->updated_at));

        // if ($dbDate !== $currentDate || $dbTime === '00:00:00') {
        //    $alert->popup_active = '1';
        //    $alert->save();
        // }

        $data = [];
        updateTimedImages();
        updateRotatingSchedule();
        updateOutlineActiveStatusIfNeeded();
        $seoSettings = seoSettings::first();
        $frontSectionSetting = frontendSetting::first();
        if ($request->editwebsite) {
            $tutorial_action_buttons = [
                'popup_alert',
                'alert_banner',
                'header_Section',
                'set_schedule',
                'rotating_schedule',
                'gallery_posts',
                'gallery_video',
                'news_feed',
                'contact_box',
                'slider',
                'contact_forms',
                'hyperlinks',
                'reviews',
                'faqs',
                'seo',
                'download',
                'blog',
                'forms',
                'news_posts',
                'staff_promo',
                'tiles',
                'footer',
                'attenhub',
                'header_slider',
                'header_logo',
                'pull_down',
                'header_images',
                'header_buttons',
                'header_text',
                'social_media',
                'feature_toggle',
                'popup_alert',
                'content',
                'navbar',
                'footer_audio',
                'title_banner',
                'outline_feature',
                'guide_buttons'
            ];
            $data['tutorial_action_buttons'] = LearningCenterActionButton::whereIn('feature_slug', $tutorial_action_buttons)
                ->orderBy('display_order', 'asc')
                ->get()
                ->groupBy('feature_slug');
            // dd($data['tutorial_action_buttons']);
            if (isset($data['tutorial_action_buttons']['outline_feature'])) {
                foreach ($data['tutorial_action_buttons']['outline_feature'] as $btn) {
                    $data['toggle_and_outline'][] = $btn;
                }
            }
            if (isset($data['tutorial_action_buttons']['feature_toggle'])) {
                foreach ($data['tutorial_action_buttons']['feature_toggle'] as $btn) {
                    $data['toggle_and_outline'][] = $btn;
                }
            }
            if (isset($data['tutorial_action_buttons']['guide_buttons'])) {
                foreach ($data['tutorial_action_buttons']['guide_buttons'] as $btn) {
                    $data['toggle_and_outline'][] = $btn;
                }
            }
            if ($frontSectionSetting->all_feature_enable_on_edit == 1) {

                $frontSections = frontSections::orderBy('edit_section_order', 'ASC')->get();
            } else {
                $frontSections = frontSections::where('edit_section_enabled', 1)->orderBy('edit_section_order', 'ASC')->get();
            }
        }
        $data['engagement_notification'] = EngagementNotification::first();

        $data['frontSectionSetting'] = $frontSectionSetting;
        $data['iseditwebsite'] = $request->editwebsite;
        $data['downloads_settings'] = DownloadSetting::first();
        $data['issmsservice'] = $request->issmsservice;
        $data['iscallservice'] = $request->iscallservice;
        $data['smsno'] = $request->smsno;
        $data['callno'] = $request->callno;
        $data['front_section_settings'] = $frontSectionSetting;
        $frontSections = frontSections::orderBy('section_order', 'ASC')->get();
        $audioFiles = audioFiles::first();
        $socialMedias = socialMedia::all();
        $galleriesSettings =  galleriesSettings::first();
        $outlineSettings = outlineSettings::all();
        $outlineSettingsArray = array();
        foreach ($outlineSettings as $single) {
            $outlineSettingsArray[$single->slug] = $single;
        }
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        $num3 = rand(1, 9);
        $data['is_admin'] = true;
        $result = $num2 + $num3;
        Session::put('contdigicaptcha', $result);
        $data['num1'] = $num1;
        $data['num2'] = $num2;
        $data['num3'] = $num3;
        $data['contdigicaptcha'] = $result;
        $data['outlineSettings'] = $outlineSettingsArray;
        $data['contactForms'] = contactForms::all();
        $data['downloadFiles'] = downloadFiles::all();
        $data['contactFormsCount'] = contactForms::count();
        $data['contactFormTitle'] = contactFormTitle::all();
        $data['contactBoxSettings'] = contactBoxSettings::first();
        if ($galleriesSettings->gallery_slider_new_posts_top) {
            $data['gallerySlider'] = gallerySlider::orderBy('id', 'DESC')->get();
        } else {
            $data['gallerySlider'] = gallerySlider::orderBy('display_order')->get();
        }

        $data['gallerySliderCount'] = gallerySlider::count();

        $data['gallery_tiles'] = galleryTiles::orderBy('display_order')->get();
        $data['reviewSettings'] =  reviewSettings::first();
        $data['header_slider_video'] = HeaderVideo::first();
        $data['faqs'] = faqs::all();
        $data['hyperLinks'] = hyperLinks::all();
        $data['faqSettings'] =  faqSettings::first();
        //  $formSettings = Cache::remember('form_settings', 60, function () {
        //     return FormsSettings::first();
        // });
        $formSettings = FormsSettings::first();
        $data['formSettings'] =  $formSettings;
        $data['hyperLinksSettings'] =  hyperLinksSettings::first();
        $data['reviewStaff'] =  reviewStaff::get();
        $data['StaffProductsPromos'] =  StaffProductsPromos::get();
        $data['StaffProductsPromosSettings'] =  StaffProductsPromosSettings::first();
        $data['news_feeds'] = newsFeed::orderBy('display_order', 'ASC')->get();
        $data['feed_count'] = newsFeed::count();
        $data['siteSettings'] = $siteSettings;
        $data['galleriesSettings'] = $galleriesSettings;
        $data['alertBannerSettings'] = AlertBannerSetting::first();
        $data['seoSettings'] = $seoSettings;
        $data['frontSections'] = $frontSections;
        $data['audioFiles'] = $audioFiles;
        $data['socialMedias'] = $socialMedias;
        $data['blogCategories'] = blogCategories::all();
        $data['blogs'] = Blog::all();
        $data['newsPostSettings'] =  newsPostSettings::first();
        $data['newsFeedSetting'] = newsFeedSetting::first();
        $data['all_texts'] = textDetails::all();
        $data['home_data_gallery_posts'] = galleryPost::orderBy('display_order', 'ASC')->get();
        $data['events'] = AttendhubPost::where('display',1)->orderBy('display_order', 'ASC')->get();
        $data['event_generic_settings'] = EventPostSetting::first();
        $data['newsPosts'] = newsPosts::orderBy('display_order', 'ASC')->get();
        $data['newsPostsCount'] = newsPosts::count();
        $data['rotatingScheduleSettings'] = rotatingScheduleSettings::first();
        $data['contactInfo'] = ContactInfo::first();

        $data['navBarSettings'] =  navBarSettings::first();
        $data['navBarItems'] =  navBarItems::where('enable', '1')->get();

        $data['footerSettings'] = footerSettings::first();
        $data['businessInfo'] = BusinessInfo::first();
        $data['alertPopupSetting'] = alertPopupSetting::first();
        // dd($data['alertPopupSetting']);
        $data['headerImages'] = headerImages::first();
        $data['header_slider'] = headerSlider::all();
        $data['menu'] = menu::orderBy('menu_order', 'ASC')->get();
        $data['galleryvideos'] = galleryVideo::orderBy('display_order')->get();
        $data['actionButtons'] = actionButtons::all();
        
        // $data['setHours'] = setHours::all();
        // $data['setHours'] = SetHours::orderBy('id', 'asc')->get()->reverse()->values();
        $setHoursExceptLast = SetHours::where('id', '<', 7)->get();
        // Get the last record
        $lastSetHour = SetHours::orderBy('id', 'desc')->first();

        // Combine them, putting the last record first
        $data['setHours'] = $setHoursExceptLast->prepend($lastSetHour);
        $data['setHoursSettings'] =  setHoursSettings::first();
        $data['rotatingSchedule'] = RotatingSchedule::orderBy('date')->get();
        // dd($data['rotatingSchedule']);
        if ($data['rotatingSchedule']->first() && date('Y-m-d') !== $data['rotatingSchedule']->first()->date); {
            // updateRotationalCalendar($data['rotatingSchedule']);
        }
        $data['contentBlockSettings'] =  contentBlockSettings::first();
        $data['contentBlockLinks'] = contentBlockLinks::all();
        $data['is_app'] = false;
        $data['blogSettings'] = blogSettings::first();

        $data['customFormsAll'] = customForms::with('actionButtons')->where('active', true)->orderBy('title', 'ASC')->get();
        $data['customFormsSettings'] = customFormsSettings::first();
        $data['rotatingScheduleSettings'] =  rotatingScheduleSettings::first();
        foreach ($data['all_texts'] as $texti) {
            $data[$texti->slug] = $texti;
        }
        $data['formsSettings'] = $formSettings;
        $data['formsLinks'] = formsLinks::all();
        $data['frontSectionSetting'] = $frontSectionSetting;
        $data['generic_review_staff_star'] = get_text_details('generic_review_staff_star');
        $data['generic_newsfeed_loadMore'] = get_text_details('generic_newsfeed_loadMore');
        $data['banner_text'] = get_text_details('alert_banner_text');
        $data['banner_action_text'] = get_text_details('alert_banner_action_button_text');
        $data['alert_banner_menu_icon_text'] = get_text_details('alert_banner_menu_icon_text');
        $data['blog_title'] = get_text_details('blog_title');
        $data['blog_title_header'] = get_text_details('alert_banner_blog_icon_text');
        $data['master_image_description'] = get_text_details('master_image_description');
        // dd($data['blog_title_header']);
        $data['image_title_text_below_text'] = get_text_details('image_title_text_below_text');
        $data['generic_blog_title'] = get_text_details('generic_blog_title');
        $data['form_section_text'] = get_text_details('form_section_text');
        $data['form_section_title'] = get_text_details('form_section_title');
        $data['attenhub_title'] = get_text_details('attenhub_title');

        $data['blog_title_setting'] = getTitleBannerSetting('blog_title');
        $data['contact_info_blocks_title_setting'] = getTitleBannerSetting('contact_info_block_title');
        $data['content_block_title_setting'] = getTitleBannerSetting('content_block_title');
        $data['seo_title_setting'] = getTitleBannerSetting('seo_title');
        $data['download_title_setting'] = getTitleBannerSetting('download_title');
        $data['faq_title_setting'] = getTitleBannerSetting('faq_title');
        $data['set_hours_title_setting'] = getTitleBannerSetting('set_hours_title');
        $data['schedule_title_setting'] = getTitleBannerSetting('schedule_title');
        $data['staff_products_promos_title_setting'] = getTitleBannerSetting('staff_products_promos_title');
        $data['reviews_staff_title_setting'] = getTitleBannerSetting('reviews_staff_title');
        $data['news_posts_title_setting'] = getTitleBannerSetting('news_posts_title');
        $data['news_feed_title_setting'] = getTitleBannerSetting('news_feed_title');
        $data['links_title_setting'] = getTitleBannerSetting('links_title');
        $data['gallery_videos_title_setting'] = getTitleBannerSetting('gallery_videos_title');
        $data['gallery_tiles_title_setting'] = getTitleBannerSetting('gallery_tiles_title');
        $data['gallery_slider_title_setting'] = getTitleBannerSetting('gallery_slider_title');
        $data['gallery_posts_title_setting'] = getTitleBannerSetting('gallery_posts_title');
        $data['attenhub_title_setting'] = getTitleBannerSetting('attenhub_title');
        $data['form_section_title_setting'] = getTitleBannerSetting('form_section_title');


        # Images
        $data['timed_hyperlink_image_file'] = get_image('timed_hyperlink_image');
        $data['timed_content_block_image_file'] = get_image('timed_content_block_image');
        $data['menu_alert_logo'] = get_image('alert_banner_logo');
        $data['timed_header_logo'] = get_image('timed_header_logo');
        $data['timed_header_image'] = get_image('timed_header_image');
        $data['timed_set_hour_image'] = get_image('timed_set_hour_image');
        $data['timed_content_block_image'] = get_image('timed_content_block_image');
        $data['timed_hyperlink_image'] = get_image('timed_hyperlink_image');
        $data['timed_popup_image'] = get_image('timed_popup_image');
        $data['form_section_img'] = get_image('form_section_img');
        $data['custom_form_logo'] = get_image('custom_form_logo');
        $data['alert_banner_logo'] = get_image('alert_banner_logo');
        $data['news_feed_logo'] = get_image('news_feed_logo');
        $data['form_logo'] = get_image('custom_form_logo');

        $data['alert_popup_image'] = get_image('alert_popup_image');
        # Timed Images
        $data['timed_content_block_image'] = get_timed_image('timed_content_block_image');
        $data['timed_set_hour_image_setting'] = get_timed_image('timed_set_hour_image');
        $data['timed_popup_image_setting'] = get_timed_image('timed_popup_image');
        $data['timed_hyperlink_image_setting'] = get_timed_image('timed_hyperlink_image');
        $data['timed_content_block_image_setting'] = get_timed_image('timed_content_block_image');
        $data['timed_header_image_setting'] = get_timed_image('timed_header_image');
        $data['timed_header_logo_setting'] = get_timed_image('timed_header_logo');
        $data['timed_header_logo_setting'] = get_timed_image('timed_header_logo');

        # Action buttons
        $data['alert_banner_action'] = get_action_button('alert_banner_action');
        $data['header_btn_1'] = get_action_button('header_btn_1');
        $data['header_btn_2'] = get_action_button('header_btn_2');
        $data['alert_popup_feature_action_button'] = get_action_button('alert_popup_feature_action_button');
        $data['alert_popup_new_action_button'] = get_action_button('alert_popup_new_action_button');
        $data['alert_popup_terminate_action_button'] = get_action_button('alert_popup_terminate_action_button');
        $data['alert_popup_proceed_action_button'] = get_action_button('alert_popup_proceed_action_button');
        $data['header_btn_3'] = get_action_button('header_btn_3');
        $data['header_phone_text'] = get_text_details('header_phone_text');
        return view('home')->with($data);
    }

    public function contactform(Request $request)
    {
        if ($_POST) {
            // $first = Otp::where('email',$request->email)->first();
            // if(isset($request->otp))
            // {
            //     ;
            //     if(!($first && $first->otp == $request->otp))
            //     {
            //         echo json_encode(array('message'=>'OK', 'captcha'=>'Invalid OTP'));
            //         exit;
            //     }
            // } else
            // {
            //     echo json_encode(array('message'=>'OK', 'captcha'=>'Please provide OTP'));
            //     exit;
            // }
            // Captcha Checks

            // if($frontend_extended->is_captcha_enable && $frontend_extended->captcha_secret_key !=""){

            // 	$captcha_response = trim($input->post('g-recaptcha-response'));
            // 	$captcha = '';
            // 	if($captcha_response != '')
            // 	{
            // 		$keySecret = $frontend_extended->captcha_secret_key;

            // 		$check = array(
            // 			'secret'		=>	$keySecret,
            // 			'response'		=>	$input->post('g-recaptcha-response')
            // 		);

            // 		$startProcess = curl_init();

            // 		curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

            // 		curl_setopt($startProcess, CURLOPT_POST, true);

            // 		curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

            // 		curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

            // 		curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

            // 		$receiveData = curl_exec($startProcess);

            // 		$finalResponse = json_decode($receiveData, true);



            // 		if(!$finalResponse['success'])
            // 		{

            // 			$captcha = "Captcha is required.";
            // 			echo json_encode(array('message'=>'OK', 'captcha'=>$captcha));
            // 			exit;
            // 		}
            // 	}else{
            // 		$captcha = "Captcha is required";
            // 			echo json_encode(array('message'=>'OK', 'captcha'=>$captcha));
            // 			exit;
            // 	}

            // }
            unset($_POST['_token']);
            $siteSettings = siteSettings::first();
            if ($siteSettings->is_captcha_enable) {
                if (isset($request->captchares)) {
                    if ($request->captchares != $request->session()->get('contdigicaptcha')) {
                        $captcha = "Captcha is required.";
                        echo json_encode(array('message' => 'OK', 'captcha' => 'Invalid Captcha'));
                        exit;
                    }
                } else {
                    $captcha = "Captcha is required.";
                    echo json_encode(array('message' => 'OK', 'captcha' => 'Invalid Captcha'));
                    exit;
                }
                unset($request->captchares);
            }
            $email = '';
            $message = '';
            foreach ($_POST as $key => $value) {
                if ($key == 'formemail') {
                    $email = $value;
                } else {
                    $field_name = ltrim(stristr($key, '|'), '|');
                    try {
                        if ($key !== 'otp')
                            $message .= ucwords(str_replace('_', ' ', $field_name)) . ' : ' . $value . '<br>';
                    } catch (\Exception $e) {
                    }
                }
            }


            $files_array = array();
            foreach ($_FILES as $key => $value) {
                if (!empty($_FILES[$key]['name'])) {
                    $ima_name = rand(9, 9999) . date('d-m-Y') . $_FILES[$key]['name'];
                    $sourcePath = $_FILES[$key]['tmp_name'];
                    $targetPath = "assets/uploads/" . get_current_url() . $ima_name;
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $files_array[] = $ima_name;
                    }
                }
            }
            try {

                if ($email != "") {
                    // Split multiple emails by comma or semicolon
                    $email_array = preg_split('/[,;]+/', $email);
                    
                    foreach ($email_array as $recipient) {
                        // Trim whitespace in case of extra spaces around emails
                        $recipient = trim($recipient);
                        
                        // Check if the email is valid
                        if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                            $data['message'] = $message;
                            $sent = sendmail($recipient, 'New mail', 'string_template', $data, $files_array);
                            // Optionally, log or handle the result of $sent here
                        } 
                    }
                }

            } catch (Exception $exp) {
            }

            echo json_encode(array('message' => 'OK', 'captcha' => ''));
            exit;
        } else {
            redirect(url());
        }
    }

    public function blogPage(Request $request)
    {
        $data = [];
        $data = [];

        if (!isset($_GET['pop'])) {

            // updateFormsCustomEncoding();
        }
        updateTimedImages();
        if (isset($request['cate'])) {
            Session::put('blogcate', $request['cate']);
        }
        $data['page'] = 'list';
        $data['categories'] = blogCategories::get();
        $data['is_app'] = isset($_GET) && isset($_GET['view'])  && $_GET['view'] == 'app' ? true : false;
        $data['engagement_notification'] = EngagementNotification::first();
        $pageno = $request->pere1;
        $seachterm = '';
        $perpage = 10;
        if ($request->page != '' || !is_numeric($request->seachterm)) {
            $pageno = $request->page;
            $seachterm = $request->seachterm;
        } else {
        }
        $data['seachterm'] = $seachterm;

        $query = Blog::query();
        if ($seachterm) {

            $query->where('title', 'like', '%' . $seachterm . '%');
        }

        if ($request->cate) {

            $query->where('category', $request->cate);
        }

        $query->orderBy('id', 'desc');
        $query->limit($perpage, $pageno);
        $result =  $query->paginate($perpage);
        $data['blogs'] = $result->items();
        $data['pagination'] =   $result;
        $siteSettings = siteSettings::first();
        $seoSettings = seoSettings::first();
        $frontSections = frontSections::orderBy('section_order', 'ASC')->get();
        $audioFiles = audioFiles::first();
        $socialMedias = socialMedia::all();
        $galleriesSettings =  galleriesSettings::first();
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        $num3 = rand(1, 9);
        $data['is_admin'] = true;
        $result = $num2 + $num3;
        Session::put('contdigicaptcha', $result);
        $data['num1'] = $num1;
        $data['num2'] = $num2;
        $data['num3'] = $num3;
        $data['contdigicaptcha'] = $result;
        $data['seoSettings'] = $seoSettings;
        $data['contactForms'] = contactForms::all();
        $data['navBarSettings'] =  navBarSettings::first();
        $data['navBarItems'] =  navBarItems::where('enable', '1')->get();
        $data['alertBannerSettings'] = AlertBannerSetting::first();
        $data['contactFormsCount'] = contactForms::count();
        $data['contactFormTitle'] = contactFormTitle::all();
        $data['siteSettings'] = $siteSettings;
        $data['frontSections'] = $frontSections;
        $data['audioFiles'] = $audioFiles;
        $data['socialMedias'] = $socialMedias;
        $data['blogCategories'] = blogCategories::all();
        $data['all_texts'] = textDetails::all();

        $data['alertBannerSettings'] = AlertBannerSetting::first();
        $data['rotatingScheduleSettings'] =  rotatingScheduleSettings::first();
        foreach ($data['all_texts'] as $texti) {
            $data[$texti->slug] = $texti;
        }
        $data['contactInfo'] = ContactInfo::first();
        $data['footerSettings'] = footerSettings::first();
        $data['businessInfo'] = BusinessInfo::first();
        $data['alertPopupSetting'] = alertPopupSetting::first();
        $data['headerImages'] = headerImages::first();
        $data['header_slider'] = headerSlider::all();
        $data['menu'] = menu::all();
        $data['actionButtons'] = actionButtons::all();

        $data['is_app'] = false;
        $data['blogSettings'] = blogSettings::first();

        $data['customFormsAll'] = customForms::where('active', true)->orderBy('title', 'ASC')->get();
        $data['customFormsSettings'] = customFormsSettings::first();

        $data['formsSettings'] =  formsSettings::first();
        $data['formsLinks'] = formsLinks::all();
        $data['generic_review_staff_star'] = get_text_details('generic_review_staff_star');
        $data['banner_text'] = get_text_details('alert_banner_text');
        $data['banner_action_text'] = get_text_details('alert_banner_action_button_text');
        $data['header_phone_text'] = get_text_details('header_phone_text');

        $data['alert_banner_menu_icon_text'] = get_text_details('alert_banner_menu_icon_text');
        $data['daily_hours_day_block'] = get_text_details('daily_hours_day_block');
        $data['header_text_color'] = get_text_details('header_text');
        # Images
        $data['timed_hyperlink_image_file'] = get_image('timed_hyperlink_image');
        $data['timed_content_block_image_file'] = get_image('timed_content_block_image');
        $data['menu_alert_logo'] = get_image('alert_banner_logo');
        $data['timed_header_logo'] = get_image('timed_header_logo');
        $data['timed_header_image'] = get_image('timed_header_image');

        $data['timed_hyperlink_image'] = get_image('timed_hyperlink_image');
        $data['timed_popup_image'] = get_image('timed_popup_image');
        $data['form_section_img'] = get_image('form_section_img');
        $data['custom_form_logo'] = get_image('custom_form_logo');
        $data['alert_banner_logo'] = get_image('alert_banner_logo');
        $data['form_logo'] = get_image('custom_form_logo');
        $data['alert_popup_image'] = get_image('alert_popup_image');

        $data['blog_title_setting'] = getTitleBannerSetting('blog_title');

        # Timed Images
        $data['timed_popup_image_setting'] = get_timed_image('timed_popup_image');
        $data['timed_hyperlink_image_setting'] = get_timed_image('timed_hyperlink_image');
        $data['timed_header_image_setting'] = get_timed_image('timed_header_image');
        $data['timed_popup_image_setting'] = get_timed_image('timed_popup_image');

        # Action buttons
        $data['alert_banner_action'] = get_action_button('alert_banner_action');
        $data['header_btn_1'] = get_action_button('header_btn_1');
        $data['header_btn_2'] = get_action_button('header_btn_2');
        $data['header_btn_3'] = get_action_button('header_btn_3');

        $utc = getTimeZone($siteSettings->timezone);
        date_default_timezone_set("$utc");
        return view('blog-page.html')->with($data);
    }

    public function blogDetail(Request $request)
    {
        $data = [];
        if (!isset($_GET['pop'])) {

            // updateFormsCustomEncoding();
        }
        updateTimedImages();
        $siteSettings = siteSettings::first();
        $seoSettings = seoSettings::first();
        $data['navBarSettings'] =  navBarSettings::first();
        $data['navBarItems'] =  navBarItems::where('enable', '1')->get();

        $frontSections = frontSections::orderBy('section_order', 'ASC')->get();
        $audioFiles = audioFiles::first();
        $socialMedias = socialMedia::all();
        $galleriesSettings =  galleriesSettings::first();
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        $num3 = rand(1, 9);
        $data['is_admin'] = true;
        $result = $num2 + $num3;
        Session::put('contdigicaptcha', $result);
        $data['num1'] = $num1;
        $data['num2'] = $num2;
        $data['num3'] = $num3;
        $data['contdigicaptcha'] = $result;
        $data['seoSettings'] = $seoSettings;
        $data['contactForms'] = contactForms::all();
        $data['blog_title_setting'] = getTitleBannerSetting('blog_title');
        $data['contactFormsCount'] = contactForms::count();
        $data['contactFormTitle'] = contactFormTitle::all();
        $data['siteSettings'] = $siteSettings;
        $data['frontSections'] = $frontSections;
        $data['audioFiles'] = $audioFiles;
        $data['socialMedias'] = $socialMedias;
        $data['blogCategories'] = blogCategories::all();
        $data['all_texts'] = textDetails::all();
        $data['alertBannerSettings'] = AlertBannerSetting::first();

        $data['rotatingScheduleSettings'] =  rotatingScheduleSettings::first();
        foreach ($data['all_texts'] as $texti) {
            $data[$texti->slug] = $texti;
        }
        $data['contactInfo'] = ContactInfo::first();
        $data['footerSettings'] = footerSettings::first();
        $data['businessInfo'] = BusinessInfo::first();
        $data['alertPopupSetting'] = alertPopupSetting::first();
        $data['headerImages'] = headerImages::first();
        $data['header_slider'] = headerSlider::all();
        $data['menu'] = menu::all();
        $data['actionButtons'] = actionButtons::all();

        $data['is_app'] = false;
        $data['blogSettings'] = blogSettings::first();

        $data['customFormsAll'] = customForms::where('active', true)->orderBy('title', 'ASC')->get();
        $data['customFormsSettings'] = customFormsSettings::first();

        $data['formsSettings'] =  formsSettings::first();
        $data['formsLinks'] = formsLinks::all();
        $data['generic_review_staff_star'] = get_text_details('generic_review_staff_star');
        $data['banner_text'] = get_text_details('alert_banner_text');
        $data['banner_action_text'] = get_text_details('alert_banner_action_button_text');


        $data['alert_banner_menu_icon_text'] = get_text_details('alert_banner_menu_icon_text');
        $data['daily_hours_day_block'] = get_text_details('daily_hours_day_block');
        # Images
        $data['timed_hyperlink_image_file'] = get_image('timed_hyperlink_image');
        $data['timed_content_block_image_file'] = get_image('timed_content_block_image');
        $data['menu_alert_logo'] = get_image('alert_banner_logo');
        $data['timed_header_logo'] = get_image('timed_header_logo');
        $data['timed_header_image'] = get_image('timed_header_image');

        $data['timed_hyperlink_image'] = get_image('timed_hyperlink_image');
        $data['timed_popup_image'] = get_image('timed_popup_image');
        $data['form_section_img'] = get_image('form_section_img');
        $data['custom_form_logo'] = get_image('custom_form_logo');
        $data['alert_banner_logo'] = get_image('alert_banner_logo');
        $data['form_logo'] = get_image('custom_form_logo');

        # Timed Images
        $data['timed_popup_image_setting'] = get_timed_image('timed_popup_image');
        $data['timed_hyperlink_image_setting'] = get_timed_image('timed_hyperlink_image');
        $data['timed_header_image_setting'] = get_timed_image('timed_header_image');
        $data['timed_header_logo_setting'] = get_timed_image('timed_header_logo');

        # Action buttons
        $data['alert_banner_action'] = get_action_button('alert_banner_action');
        $data['header_btn_1'] = get_action_button('header_btn_1');
        $data['header_btn_2'] = get_action_button('header_btn_2');
        $data['header_btn_3'] = get_action_button('header_btn_3');
        $utc = getTimeZone($siteSettings->timezone);
        date_default_timezone_set("$utc");

        $data['page'] = 'detail';
        $data['is_app'] = isset($_GET) && isset($_GET['view'])  && $_GET['view'] == 'app' ? true : false;
        $data['blog'] = Blog::orderBy('id', 'desc')->where(array('slug' => $request->slug))->first();
        if ($data['blog']) {
            $data['latestblog'] = Blog::orderBy('id', 'desc')->limit(3)->get();

            return view('blog-detail.html')->with($data);
        } else {
            redirect('404');
        }
    }

    public function customformsAction(Request $request)
    {
     
        
        if ($_POST) {
            unset($_POST['_token']);
            // $first = Otp::where('phone_number',$request->phone_number)->first();
            // if(isset($request->otp))
            // {

            //     if(!($first && $first->otp == $request->otp))
            //     {
            //         echo json_encode(array('message'=>'OK', 'captcha'=>'Invalid OTP'));
            //         exit;
            //     }
            // } else
            // {
            //     echo json_encode(array('message'=>'OK', 'captcha'=>'Please provide OTP'));
            //     exit;
            // }
            $siteSettings = siteSettings::first();
            if ($siteSettings->is_captcha_enable) {
                if (isset($request->captchares)) {
                    if ($request->captchares !=  Cache::get('contdigicaptcha')) {
                        $captcha = "Captcha is required.";
                        echo json_encode(array('message' => 'OK', 'captcha' => 'Invalid Captcha'));
                        exit;
                    }
                } else {
                    $captcha = "Captcha is required.";
                    echo json_encode(array('message' => 'OK', 'captcha' => 'Invalid Captcha'));
                    exit;
                }
            }
            
            $eventForm = false;
            $crmSettings = CrmSetting::first();

            $formdata = array();
            $form_id = $request->formid;
            $form_data = customForms::find($form_id);
            // dd(json_decode($form_data->fields));
            unset($_POST['formid']);
            unset($_POST['captchares']);

            $request_data = $_POST;
            checkFormRequiredFields($request_data, $form_data);
            // dd('12');

            if ($form_id == '7') {
                foreach ($_POST as $key => $value) {
                    if (!strpos($key, 'txto')) {
                        $field_name = ucwords(str_replace('_', ' ', $key));
                        if (is_array($value)) {
                            $tempval = '';
                            foreach ($value as $ss) {
                                if (isset($request_data[$key . 'txto'])) {
                                    $tempval .= $ss . '<br>';
                                    $tempval .= $request_data[$key . 'txto'] . '<br>';
                                } else {
                                    $tempval .= $ss . '<br>';
                                }
                            }
                            $formdata[$field_name] = $tempval;
                        } else {
                            if (isset($request_data[$key . 'txto'])) {
                                $formdata[$field_name] = $request_data[$key . 'txto'];
                            } else {
                                $formdata[$field_name] = $value;
                            }
                        }
                    }
                }
                if ($crmSettings->subscribe_to_contact == '1') {

                    $form_feilds = $formdata;
                    $temp_feilds = array();
                    foreach ($form_feilds as $key => $value) {
                        $temp_feilds[trim($key)] = $value;
                    }
                    $form_feilds = $temp_feilds;
                    $insertData['email_address'] = $form_feilds['Email'];
                    $insertData['name'] = $form_feilds['Full Name'];
                    $insertData['subscribed'] = '1';
                    unset($form_feilds['Email']);
                    unset($form_feilds['Full Name']);
                    $formfeilds = array();
                    foreach ($form_feilds as $key => $value) {
                        $formfeilds[$key] = $value;
                    }
                    $insertData['fields'] = json_encode($formfeilds);
                    EmailList::create($insertData);
                    $message = "New User Subscribed<br>Name: " . $request->full_name . '<br>Email: ' . $request->email;
                } else {
                    date_default_timezone_set(getFrontDataTimeZone());
                    $custform = customUserForm::create(array('in_folder' => '0', 'form_id' => $form_id, 'date_time' => date('Y-m-d H:i:s'), 'fields_data' => json_encode($formdata)));
                    $message = "New User Subscribed<br>Name: " . $request->full_name . '<br>Email: ' . $request->email;
                    $msg_id = $custform->id;
                    $message = "<br> Click Link below to view Response<br>" . url('edituserform/' . $msg_id);
                }
            } else {

                unset($_POST['formid']);
                $request_data = $request->all();
                foreach ($_POST as $key => $value) {
                    if ($key == 'hidden') {
                        $eventForm = true;
                        $yes_no = array_values($_POST);
                        $yes_no = array_filter($yes_no, function ($value) {
                            return $value !== "event_form";
                        });
                        $yes_no = array_values($yes_no);
                        $yes_no = $yes_no[3][0];
                    }
                    if (!strpos($key, 'txto')) {
                        $field_name = ucwords(str_replace('_', ' ', $key));
                        if (is_array($value)) {
                            $tempval = '';
                            foreach ($value as $ss) {
                                if (isset($request_data[$key . 'txto'])) {
                                    $tempval .= $ss . '<br>';
                                    $tempval .= $request_data[$key . 'txto'] . '<br>';
                                } else {
                                    $tempval .= $ss . '<br>';
                                }
                            }

                            $formdata[$field_name] = $tempval;
                        } else {

                            if (isset($request_data[$key . 'txto'])) {
                                $formdata[$field_name] = $request_data[$key . 'txto'];
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
                    }
                }
                if ($eventForm) {
                    
                    $dataToiInsert = array('in_folder' => '0', 'form_id' => $form_id, 'date_time' => date('Y-m-d H:i:s'), $yes_no => 1, 'fields_data' => json_encode($formdata));
                } else {
                    $dataToiInsert = array('in_folder' => '0', 'form_id' => $form_id, 'date_time' => date('Y-m-d H:i:s'), 'fields_data' => json_encode($formdata));
                }
                if ($form_id == '8') {
                    if ($request->email) {
                        EmailList::where(array('email_address' => $request->email))->delete();
                    }
                    $form = UnsubscribeUserForm::create(array('form_id' => $form_id, 'datetime' => date("Y-m-d H:i:s"), 'fields_data' => json_encode($formdata)));
                    $message = "New User Opt’d Out<br>Name: " . $request->full_name . '<br>Email: ' . $request->email;
                } else {
                    date_default_timezone_set(getFrontDataTimeZone());
                    $form = customUserForm::create($dataToiInsert);
                    $msg_id = $form->id;
                    if($eventForm)
                    {
                        $message = "<br> Click Link below to view Response<br>" . url('editattenhubform/' . $msg_id);
                    }
                    else
                    {
                        $message = "<br> Click Link below to view Response<br>" . url('edituserform/' . $msg_id);
                    }
                }
            }

            // $NotificationSettings = NotificationSettings::first();
            // if($NotificationSettings->email_notification && $NotificationSettings->email_notification !=''){

            //     if(!strpos($NotificationSettings->email_notification,',')){

            //         $data['message'] =  $message;
            //         sendmail($NotificationSettings->email_notification, 'Forms', 'string_template',$data);
            //     }else{
            //         $memails = explode(',',$NotificationSettings->email_notification);
            //         if(is_array($memails) && count($memails)>0){
            //             foreach($memails as $single){
            //                 $data['message'] =  $message;
            //                 sendmail($single, 'Forms', 'string_template', $data);
            //             }
            //         }

            //     }
            // }

            // FOR OPTOUT EMAIL
            if ($form_id == '8') {
                if ($request->emailId || $request->customemail) {
                    $email_data = EmailList::where('id', $request->emailId)->first();
                    if (!$email_data) {
                        $email_data = EmailList::where('email_address', $request->customemail)->first();
                    }
                    if ($email_data) {

                        EmailList::where(array('email_address' => $email_data->email_address))->update(array('subscribed' => 0));
                        $this->data['email_data'] = $email_data;
                        //$mail_body = view('emails/optout_template', $this->data)->render();
                        $business_info = BusinessInfo::where(array('id' => '1'))->first();

                        $resp = sendmail($request->optoutmail, 'A User Unsubscribed From ' . $business_info->business_name, 'optout_template', $this->data, array(), false);
                    }
                }
            }

            $customFormsSettings = customFormsSettings::first();
            
            if ($customFormsSettings->form_multiple_emails) {
                if($eventForm)
                {
                $memails = explode(',', $customFormsSettings->attenhub_notification_emails);
                }else
                {
                    $memails = explode(',', $customFormsSettings->form_multiple_emails);
                }
                if (is_array($memails) && count($memails) > 0) {
                    foreach ($memails as $single) {
                        $data['message'] =  $message;
                        $res = sendmail($single, 'Forms', 'string_template', $data);
                    }
                }
            }
            echo json_encode(array('message' => 'OK', 'captcha' => ''));
            exit;
        } else {
            redirect(url());
        }
    }

    public function delete_frontend_image(Request $request)
    {

        $thisimg = $request->imgname;
        $column = $request->column;
        $table = $request->table;
        $id = $request->id;
        delimg($thisimg);
        images::where('slug', $request->column)->update(['file_name' => null]);
        echo true;
    }

    public function privacypolicy()
    {
        return view('privacypolicy');
    }
}
