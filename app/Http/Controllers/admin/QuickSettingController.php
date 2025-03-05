<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FontFamily;
use App\Models\NotificationSettings;
use App\Models\HeaderVideo;
use App\Models\textDetails;
use App\Models\addresses;
use App\Models\customForms;
use App\Models\AlertBannerSetting;
use App\Models\actionButtons;
use App\Models\frontSections;
use App\Models\alertPopupSetting;
use App\Models\images;
use App\Models\timedImagesSetting;
use App\Models\oneStepImages;
use App\Models\ImageGalleryCategory;
use App\Models\newsFeed;
use App\Models\newsFeedSetting;
use App\Models\newsPostSettings;
use App\Models\newsPosts;
use App\Models\galleryPost;
use App\Models\galleryVideo;
use App\Models\headerImages;
use App\Models\headerSlider;
use App\Models\audioFiles;
use DateTime;
use DateTimeZone;

class QuickSettingController extends Controller
{
    public function __construct()
    {
        $this->data['controller'] = 'quicksettings';
        $this->data['controller_name'] = 'Quick Settings';
        $this->data['all_categories'] = ImageGalleryCategory::all();

        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['font_family'] = get_font_family();
    }

    //
    public function index()
    {

        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['addresses'] = addresses::get();
        $this->data['custom_forms'] = customForms::orderBy('title', 'ASC')->get();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
            ->orderBy('title', 'ASC')
            ->get();
        $this->data['alert_banner_action'] = actionButtons::where('slug', 'alert_banner_action')->first();
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['alert_banner_setting'] =  AlertBannerSetting::first();
        $this->data['news_feed_setting'] = newsFeedSetting::first();
        $this->data['news_post_setting'] = newsPostSettings::first();
        $this->data['header_images_settings'] = headerImages::first();
        $this->data['header_slider_video'] = HeaderVideo::first();
        $this->data['header_slider'] = headerSlider::get();
        $this->data['audio_files'] = audioFiles::first();

        $this->data['timed_header_logo'] = get_timed_image('timed_header_logo');
        $this->data['timed_header_image_settings'] = get_timed_image('timed_header_image');
        $this->data['timed_popup_image'] =  get_timed_image('timed_popup_image');

        $this->data['timed_header_logo_image'] = get_image('timed_header_logo');
        $this->data['timed_header_image'] = get_image('timed_header_image');
        $this->data['popup_image'] =  get_image('alert_popup_image');
        $this->data['alert_banner_logo'] =  get_image('alert_banner_logo');
        $this->data['timed_image'] = get_image('timed_popup_image');
        $this->data['news_feed_logo'] = get_image('news_feed_logo');

        updateTimedImages();
        $this->data['popup_alert_title'] = get_text_details('popup_alert_title_text');
        $this->data['menu_icon_text'] = get_text_details('alert_banner_menu_icon_text');
        $this->data['blog_title_text'] = get_text_details('alert_banner_blog_icon_text');
        $this->data['popup_alert_text'] = get_text_details('popup_alert_text');
        $this->data['newsfeed_teaser_title'] = get_text_details('newsfeed_teaser_title');
        $this->data['generic_newsfeed_title'] = get_text_details('generic_newsfeed_title');
        $this->data['generic_newsfeed_desc'] = get_text_details('generic_newsfeed_desc');
        $this->data['banner_text'] = get_text_details('alert_banner_text');
        $this->data['banner_action_text'] = get_text_details('alert_banner_action_button_text');
        $this->data['generic_news_post_title'] = get_text_details('generic_news_post_title');
        $this->data['generic_news_post_desc'] = get_text_details('generic_news_post_desc');
        $this->data['generic_newsfeed_loadMore'] = get_text_details('generic_newsfeed_loadMore');
        $this->data['header_image_title_text'] = get_text_details('header_image_title_text');
        $this->data['header_image_desc_text'] = get_text_details('header_image_desc_text');
        $this->data['image_title_text_below_text'] = get_text_details('image_title_text_below_text');

        $this->data['header_text'] = get_text_details('header_text');
        $this->data['header_text_2'] = get_text_details('header_text_2');
        $this->data['header_slider_text'] = get_text_details('header_slider_text');

        $this->data['header_phone_title'] = get_text_details('header_phone_title');
        $this->data['header_phonr_text_title'] = get_text_details('header_phonr_text_title');
        $this->data['header_phone_text_2'] = get_text_details('header_phone_text_2');
        $this->data['header_phone_text'] = get_text_details('header_phone_text');
        $this->data['header_address_title'] = get_text_details('header_address_title');
        $this->data['header_address2_street'] = get_text_details('header_address2_street');
        $this->data['header_address2_citystatezipcode'] = get_text_details('header_address2_citystatezipcode');
        $this->data['header_address2_comment'] = get_text_details('header_address2_comment');


        $this->data['alert_popup_feature_action_button'] = get_action_button('alert_popup_feature_action_button');
        $this->data['alert_popup_new_action_button'] = get_action_button('alert_popup_new_action_button');
        $this->data['alert_popup_proceed_action_button'] = get_action_button('alert_popup_proceed_action_button');
        $this->data['alert_popup_terminate_action_button'] = get_action_button('alert_popup_terminate_action_button');

        $this->data['header_btn_1'] = get_action_button('header_btn_1');
        $this->data['header_btn_2'] = get_action_button('header_btn_2');
        $this->data['header_btn_3'] = get_action_button('header_btn_3');

        $this->data['alert_popup_feature_action_button_text'] = get_text_details('alert_popup_feature_action_button_text');
        $this->data['alert_popup_new_action_button_text'] = get_text_details('alert_popup_new_action_button_text');
        $this->data['alert_popup_proceed_action_button_text'] = get_text_details('alert_popup_proceed_action_button_text');
        $this->data['alert_popup_terminate_action_button_text'] = get_text_details('alert_popup_terminate_action_button_text');

        $this->data['news_feeds'] = newsFeed::orderBy('display_order', 'ASC')->get();
        $this->data['news_posts'] = newsPosts::orderBy('display_order', 'ASC')->get();

        $this->data['block'] = "";

        if (isset($request->block) && $request->block != "") {
            $this->data['block'] = $request->block;
        }

        return view('admin.quicksettings')->with($this->data);
    }


    public function updateAlertBanner(Request $request)
    {
        $notificationSettings = NotificationSettings::first();
        $message = 'Alert banner has been updated';
        $block = 'alert_banner_bluebar';

        if (check_auth_permission(['alert_banner_text'])) {
            $data = (object)[];
            $data->slug = "alert_banner_text";
            $data->text = $request->banner_text;
            $data->size_web = "";
            $data->size_mobile = "";
            $data->color = $request->banner_color;
            $data->bg_color = $request->banner_background_color;
            $data->fontfamily = 0;
            update_text_details('alert_banner_text', $data);
        }
        if (check_auth_permission(['alert_banner_text'])) {
            $data = (object)[];
            $data->slug = "alert_banner_blog_icon_text";
            $data->text = $request->blog_title;
            $data->size_web = "";
            $data->size_mobile = "";
            $data->color = $request->banner_color;
            $data->bg_color = $request->banner_background_color;
            $data->fontfamily = 0;
            update_text_details('alert_banner_blog_icon_text', $data);
        }

        if (check_auth_permission(['alert_banner'])) {
            $data =  (object)[];
            $data->slug = "alert_banner_action_button_text";
            $data->text = $request->banner_text_2;
            $data->size_web = "";
            $data->size_mobile = "";
            $data->color = $request->banner_color_2;
            $data->bg_color = $request->banner_background_color_2;
            $data->fontfamily = 0;
            update_text_details('alert_banner_action_button_text', $data);

            $data = (object)[];
            $data->active = $request->banner_action_enable ? '1' : '0';
            $data->action_type = $request->alert_banner_action_button_link;
            $data->address_id = $request->alert_banner_action_button_address;
            $data->map_address = $request->alert_banner_action_button_map_address;
            $data->custom_form_id = $request->banner_forms;
            $data->event_form_id = $request->banner_eventforms;
            $data->link = $request->banner_link_2;
            $data->action_button_phone_no_sms = $request->banner_action_phone_no_sms;
            $data->action_button_phone_no_calls = $request->banner_action_phone_no_calls;
            $data->action_button_textpopup = $request->banner_action_button_textpopup;
            $data->action_button_action_email = $request->banner_action_email;
            if (isset($request->audio_file[0]))
                $data->audio_file = $request->audio_file[0];
            if (isset($request->popup_action_images)) {
                $data->popup_images = saveActionButtonImages($request->popup_action_images);
            }
            if (isset($request->action_button_audio_icon_feature[0])) {
                $file = $request->action_button_audio_icon_feature[0];
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->extension();
                $fileInfo = $request->action_button_audio_icon_feature[0]->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_audio_icon_feature = uploadimg($file, null);
            }

            if (isset($request->banner_action_video)) {
                $file = $request->banner_action_video;
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->banner_action_video->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_video  = uploadimg($file, null);
            }
            update_action_button('alert_banner_action', $data);

            $data =  (object)[];
            $data->text = $request->menu_icon_text;
            $data->size_web = $request->menu_icon_text_size_web;
            $data->size_mobile = $request->menu_icon_text_size_mobile;
            $data->color = $request->menu_icon_text_color;
            $data->bg_color = '';
            $data->fontfamily = $request->menu_icon_text_font;
            update_text_details("alert_banner_menu_icon_text", $data);

            $alertBannerSetting = AlertBannerSetting::first();
            $alertBannerSetting->menu_icon_color = $request->menu_icon_color;
            $alertBannerSetting->save();

            $filename = '';
            if ($request->alert_banner_logo) {
                $filename = saveimagefromdataimage($request->alert_banner_logo);
            }
            save_image('alert_banner_logo', $filename, $request->alert_banner_logo_max_width, $request->alert_banner_logo_min_width);
        }

        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');

        if ($request->savebanner != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }

    public function updateHeaderImages(Request $request)
    {
        $notificationSettings = NotificationSettings::first();

        $message = 'Header images has been updated';
        $block = 'header_images_bluebar';

        if (check_auth_permission(['header_logo'])) {
            $data = (object)[];
            $data->text = $request->header_title;
            $data->size_web = $request->header_title_fontsize;
            $data->size_mobile = "";
            $data->color = $request->header_title_color;
            $data->bg_color = "";
            $data->fontfamily = $request->header_title_font_family;
            update_text_details('header_image_title_text', $data);
        }

        if (check_auth_permission(['header_image_description'])) {
            $data = (object)[];
            $data->text = $request->image_title_text_below_text;
            $data->size_web = $request->image_title_text_below_text_size;
            $data->size_mobile = "";
            $data->color = $request->image_title_text_below_text_color;
            $data->bg_color = "";
            $data->fontfamily = $request->image_title_text_below_text_font_family;
            update_text_details('image_title_text_below_text', $data);
        }
        if (check_auth_permission(['header_image_title'])) {
            $data = (object)[];
            $data->text = $request->header_img_desc;
            $data->size_web = $request->header_img_desc_font_size;
            $data->size_mobile = "";
            $data->color = $request->header_img_desc_color;
            $data->bg_color = "";
            $data->fontfamily = $request->header_image_desc_font_family;
            update_text_details('header_image_desc_text', $data);
        }


        if (check_auth_permission(['header_image_title'])) {
            $data = (object)[];
            $data->text = $request->header_title2;
            $data->size_web = $request->header_title_fontsize2;
            $data->size_mobile = "";
            $data->color = $request->header_title_color2;
            $data->bg_color = "";
            $data->fontfamily = $request->header_title_2_font_family;
            update_text_details('header_text_2', $data);
        }

        if (check_auth_permission(['header_slider'])) {
            $data = (object)[];
            $data->text = $request->header_slider_text;
            $data->size_web = $request->header_slider_text_font_size;
            $data->size_mobile = $request->header_slider_text_font_size_mobile;
            $data->color = $request->header_slider_text_color;
            $data->bg_color = "";
            $data->fontfamily = $request->header_slider_text_font_family;
            update_text_details('header_slider_text', $data);
        }

        if (check_auth_permission(['header_block', 'header_logo', 'header_image', 'header_slider_text', 'header_slider'])) {
            $newData = headerImages::find(1);
            $newData->slideronoff = $request->slideronoff ? '1' : '0';
            $newData->slider_top_mobile = $request->slider_top_mobile ? '1' : '0';
            if (check_auth_permission(['header_block'])) {
                $newData->header_background_color = $request->header_background_color;
                $newData->header_scrollbar_width = $request->header_scrollbar_width;
                $newData->header_scrollbar_color = $request->header_scrollbar_color;
            }
            if (check_auth_permission(['header_logo'])) {
                $newData->header_logo_width = $request->header_logo_width;
                if ($request->header_logo) {
                    if (isset($newData->header_logo)) {
                        delimg($newData->header_logo);
                    }
                    $newData->header_logo = saveimagefromdataimage($request->header_logo);
                }
            }
            if (check_auth_permission(['header_image'])) {
                $newData->header_img_width = $request->header_img_width;
                if ($request->header_img) {
                    if (isset($newData->header_img)) {
                        delimg($newData->header_img);
                    }
                    $newData->header_img = saveimagefromdataimage($request->header_img);
                }
            }
            if (check_auth_permission(['header_slider_text'])) {
                $newData->header_slider_text_position = $request->header_slider_text_position;
            }
            if (check_auth_permission(['header_slider'])) {
                $newData->header_slider_background = $request->header_slider_background;
            }
            $newData->save();
        }

        if (check_auth_permission(['header_slider'])) {
            if ($request->header_slider) {
                $newData = new headerSlider();
                $newData->image = saveimagefromdataimage($request->header_slider);
                $newData->save();
            }

            if ($request->header_slider_video) {
                $newData = HeaderVideo::first();
                if (!$newData) {
                    $newData = new HeaderVideo();
                }

                if ($_FILES['header_slider_video']['name'] != '') {
                    if (isset($newData->video)) {
                        delimg($newData->video);
                    }
                    $newData->video = uploadimg($_FILES['header_slider_video'], null);
                    $newData->save();
                }
            }
        }

        if (check_auth_permission(['header_block_timed_images'])) {
            $newData = (object)[];
            $newData->enable = $request->enable_timed_header_logo ? '1' : '0';

            $newData->type = $request->timed_header_logo_type;
            $newData->days = json_encode($request->days);
            $newData->image_timer = $request->timed_header_logo_timer;
            if ($newData->type == 'days') {
                $newData->start_time = $request->header_logo_start_time;
                $newData->end_time = $request->header_logo_end_time;
            } else {
                $timer = $request->timed_header_logo_timer;

                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s', strtotime('+' . $timer . ' minutes', strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

                $newData->start_time = $start_time;
                $newData->end_time = $end_time;
            }
            update_timed_image_setting('timed_header_logo', $newData);

            if ($request->timed_header_logo) {
                $filename = saveimagefromdataimage($request->timed_header_logo);
                $oldimage = images::where('slug', 'timed_header_logo')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                save_image('timed_header_logo', $filename);
            }
        }

        if (check_auth_permission(['header_block'])) {
            $newData = (object)[];
            $newData->enable = $request->enable_timed_header_image ? '1' : '0';

            $newData->image_timer = $request->timed_header_image_timer;
            $newData->type = $request->timed_header_image_type;
            $newData->days = json_encode($request->header_image_days);
            if ($newData->type == 'days') {
                $newData->start_time = $request->header_image_start_time;
                $newData->end_time = $request->header_image_end_time;
            } else {
                $timer = $request->timed_header_image_timer;

                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s', strtotime('+' . $timer . ' minutes', strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

                $newData->start_time = $start_time;
                $newData->end_time = $end_time;
            }
            update_timed_image_setting('timed_header_image', $newData);

            if ($request->timed_header_image) {
                $filename = saveimagefromdataimage($request->timed_header_image);
                $oldimage = images::where('slug', 'timed_header_image')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                save_image('timed_header_image', $filename);
            }
        }

        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');


        if ($request->saveheader != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }

    public function updateHeaderText(Request $request)
    {
        $notificationSettings = NotificationSettings::first();

        $message = 'Header Text has been updated';
        $block = 'header_text_bluebar';

        if (check_auth_permission('address_at_header')) {
            $newData = (object)[];
            $newData->text = $request->header_phone_title;
            $newData->size_web = $request->current_header_phone_call_title_font_size;
            $newData->size_mobile = "";
            $newData->color = $request->header_phone_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $request->header_phone_title_font_family;
            update_text_details('header_phone_title', $newData);
        }

        if (check_auth_permission('address_at_header')) {
            $newData = (object)[];
            $newData->text = $request->header_phonr_text_title;
            $newData->size_web = $request->current_header_phone_text_title_size;
            $newData->size_mobile = "";
            $newData->color = $request->header_phone_text_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $request->header_text_title_font_family;
            update_text_details('header_phonr_text_title', $newData);
        }

        if (check_auth_permission('header_text')) {
            $newData = (object)[];
            $newData->text = $request->header_phone_text;
            $newData->size_web = $request->current_header_phone_text_font_size;
            $newData->size_mobile = "";
            $newData->color = $request->header_phone_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $request->current_header_phone_text_font_family;
            update_text_details('header_phone_text_2', $newData);
        }

        if (check_auth_permission('header_phone_text')) {
            $newData = (object)[];
            $newData->text = $request->header_text_7_phone;
            $newData->size_web = $request->current_header_phone_call_font_size;
            $newData->size_mobile = "";
            $newData->color = $request->header_text_7_phone_color;
            $newData->bg_color = "";
            $newData->fontfamily = $request->current_header_phone_call_font_family;
            update_text_details('header_phone_text', $newData);
        }

        if (check_auth_permission('header_address_title')) {
            $newData = (object)[];
            $newData->text = $request->header_address_title;
            $newData->size_web = $request->header_address_title_fontsize;
            $newData->size_mobile = "";
            $newData->color = $request->header_address_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $request->header_address_title_font_family;
            update_text_details('header_address_title', $newData);
        }

        if (check_auth_permission('header_address_street')) {
            $newData = (object)[];
            $newData->text = $request->header_address2_street;
            $newData->size_web = $request->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $request->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details('header_address2_street', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_citystatezipcode', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_comment', $newData);
        }

        if (check_auth_permission('header_address_location')) {
            $newData = (object)[];
            $newData->text = $request->header_address2_citystatezipcode;
            $newData->size_web = $request->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $request->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details('header_address2_citystatezipcode', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_street', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_comment', $newData);
        }

        if (check_auth_permission('header_address_comment')) {
            $newData = (object)[];
            $newData->text = $request->header_address2_comment;
            $newData->size_web = $request->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $request->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details('header_address2_comment', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_citystatezipcode', $newData);

            $newData = (object)[];
            $newData->size_web = $request->header_address_text_size2;
            $newData->color = $request->header_address_text_color2;
            $newData->fontfamily = $request->current_header_address_font_family;
            update_text_details2('header_address2_street', $newData);
        }


        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');

        if ($request->savebusniessinfo != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }
    public function updateHeaderButtons(Request $request)
    {
        // dd($request->all());
        if (!check_auth_permission('header_action_buttons')) {
            return  redirect('quicksettings')->withError('Access Denied');
        }
        $notificationSettings = NotificationSettings::first();

        $message = 'Header buttons has been updated';
        $block = 'action_btns_bluebar';
        $data = (object)[];
        $data->text = $request->header_text;
        $data->size_web = $request->header_text_font_size;
        $data->size_mobile = "";
        $data->color = $request->header_text_color;
        $data->bg_color = "";
        $data->fontfamily = $request->header_text_font_family;
        update_text_details('header_text', $data);

        $newData = (object)[];
        $newData->text = $request->header_btn1_text;
        $newData->text_color = $request->header_btn1_text_color;
        $newData->bg_color = $request->header_btn1_back_color;
        $newData->action_type = $request->header_btn1_section;
        $newData->active = $request->header_btn1_enable ? '1' : '0';
        $newData->link = $request->header_btn1_text_link;
        $newData->custom_form_id = $request->header_btn1_customforms;
        $newData->event_form_id = $request->header_btn1_eventforms;
        $newData->address_id = $request->header_btn1_address;
        $newData->map_address = $request->header_btn1_action_button_map_address;
        $newData->action_button_phone_no_calls = $request->header_btn1_action_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->header_btn1_action_phone_no_sms;

        $newData->action_button_textpopup = $request->header_btn1_action_button_textpopup;
        $newData->action_button_action_email = $request->header_btn1_action_email;
        if (isset($request->audio_file[0]))
            $newData->audio_file = $request->audio_file[0];

        if (isset($request->action_button_audio_icon_feature1)) {
            $file = $request->action_button_audio_icon_feature1;
            $file_name = $file->getClientOriginalName();

            $file_ext = $file->extension();
            $fileInfo = $request->action_button_audio_icon_feature1->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_audio_icon_feature = uploadimg($file, null);
        }
        if (isset($request->popup_action_images_1)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images_1);
        }
        if (isset($request->headerbtn1_action_video)) {
            $file = $request->headerbtn1_action_video;
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->extension();
            $fileInfo = $request->headerbtn1_action_video->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_video  = uploadimg($file, null);
        }

        update_action_button('header_btn_1', $newData);

        $newData = (object)[];
        $newData->text = $request->header_btn2_text;
        $newData->text_color = $request->header_btn2_text_color;
        $newData->bg_color = $request->header_btn2_back_color;
        $newData->action_type = $request->header_btn2_section;
        $newData->active = $request->header_btn2_enable ? '1' : '0';
        $newData->link = $request->header_btn2_text_link;
        $newData->custom_form_id = $request->header_btn2_customforms;
        $newData->event_form_id = $request->header_btn2_eventforms;
        $newData->address_id = $request->header_btn2_address;
        $newData->map_address = $request->header_btn2_action_button_map_address;
        $newData->action_button_phone_no_calls = $request->header_btn2_action_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->header_btn2_action_phone_no_sms;
        $newData->action_button_action_email = $request->header_btn2_action_email;

        $newData->action_button_textpopup = $request->header_btn2_action_button_textpopup;
        if (isset($request->popup_action_images_2)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images_2);
        }
        if (isset($request->audio_file[1]))
            $newData->audio_file = $request->audio_file[1];

        if (isset($request->action_button_audio_icon_feature2)) {
            $file = $request->action_button_audio_icon_feature2;
            $file_name = $file->getClientOriginalName();

            $file_ext = $file->extension();
            $fileInfo = $request->action_button_audio_icon_feature2->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_audio_icon_feature = uploadimg($file, null);
        }

        if (isset($request->headerbtn2_action_video)) {
            $file = $request->headerbtn2_action_video;
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->extension();
            $fileInfo = $request->headerbtn2_action_video->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_video  = uploadimg($file, null);
        }

        update_action_button('header_btn_2', $newData);

        $newData = (object)[];
        $newData->text = $request->header_btn3_text;
        $newData->text_color = $request->header_btn3_text_color;
        $newData->bg_color = $request->header_btn3_back_color;
        $newData->action_type = $request->header_btn3_section;
        $newData->active = $request->header_btn3_enable ? '1' : '0';
        $newData->link = $request->header_btn3_text_link;
        $newData->custom_form_id = $request->header_btn3_customforms;
        $newData->event_form_id = $request->header_btn3_eventforms;
        $newData->address_id = $request->header_btn3_address;
        $newData->map_address = $request->header_btn3_action_button_map_address;
        $newData->action_button_phone_no_calls = $request->header_btn3_action_phone_no_calls;
        $newData->action_button_phone_no_sms = $request->header_btn3_action_phone_no_sms;
        $newData->action_button_action_email = $request->header_btn3_action_email;

        $newData->action_button_textpopup = $request->header_btn3_action_button_textpopup;
        if (isset($request->audio_file[2]))
            $newData->audio_file = $request->audio_file[2];
        if (isset($request->popup_action_images_3)) {
            $newData->popup_images = saveActionButtonImages($request->popup_action_images_3);
        }
        if (isset($request->action_button_audio_icon_feature3)) {
            $file = $request->action_button_audio_icon_feature3;
            $file_name = $file->getClientOriginalName();

            $file_ext = $file->extension();
            $fileInfo = $request->action_button_audio_icon_feature3->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_audio_icon_feature = uploadimg($file, null);
        }
        if (isset($request->headerbtn3_action_video)) {
            $file = $request->headerbtn3_action_video;
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->extension();
            $fileInfo = $request->headerbtn3_action_video->path();
            $file = [
                "name" => $file_name,
                "type" => $file_ext,
                "tmp_name" => $fileInfo,
                "error" => 0,
                "size" => $file->getSize()
            ];
            $newData->action_button_video  = uploadimg($file, null);
        }

        update_action_button('header_btn_3', $newData);


        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');

        if ($request->saveactionbuuons != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }
    public function updateAudioFiles(Request $request)
    {
        $notificationSettings = NotificationSettings::first();

        $message = 'Audio files has been updated';
        $block = 'audio_files_bluebar';

        $newData = audioFiles::find('1');
        $images = json_decode($newData->audio_files, true);
        if (check_auth_permission('select_audio')) {
            $total = count($_FILES['audio_file']['name']);
            $i = 0;
            if ($total > 0 && $request->audio_file) {
                foreach ($request->audio_file as $file) {
                    $image = rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $_FILES['audio_file']['type'][$i])[1];
                    $file->move("assets/uploads/" . get_current_url(), $image);
                    $images[] = array('title' => $_FILES['audio_file']['name'][$i], 'file' => $image);
                    $i++;
                }
            }
        }
        if (check_auth_permission('auto_play')) {
            $newData->audio_auto_play = $request->audio_auto_play ? '1' : '0';
        }
        if (check_auth_permission('audio_repeat')) {
            $newData->audio_repeat = $request->audio_repeat ? '1' : '0';
        }
        $newData->audio_files = json_encode($images);
        $newData->save();

        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');

        if ($request->saveaudiosection != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }


    public function updatealertpopup(Request $request)
    {
        $notificationSettings = NotificationSettings::first();
        if (check_auth_permission('popup_alert_title')) {
            // Alert Popup Title
            $data =  (object)[];
            $data->slug = "popup_alert_title_text";
            $data->text = $request->popupalerttitle;
            $data->size_web = $request->popup_title_fontsize;
            $data->size_mobile = "";
            $data->color = $request->popup_title_color;
            $data->bg_color = $request->popup_title_background_color;
            $data->fontfamily = $request->popup_title_font_family;

            update_text_details('popup_alert_title_text', $data);
        }

        if (check_auth_permission('popup_alert_message')) {
            // Alert Popup Text
            $data =  (object)[];
            $data->slug = "popup_alert_text";
            $data->text = $request->popupalert;
            $data->size_web = '';
            $data->size_mobile = "";
            $data->color = $request->popup_text_color;
            $data->bg_color = $request->popup_background_color;
            $data->fontfamily = 0;

            update_text_details('popup_alert_text', $data);
        }
        // dd($request->audio_file[0]);

        if (check_auth_permission('popup_alert')) {
            //Action Feature Button
            $data = (object)[];
            $data->action_type = $request->feature_action_button_link;
            $data->active = $request->featureActionButton ? 1 : 0;
            $data->link = $request->feature_button_text_link;
            $data->custom_form_id = $request->feature_customforms;
            $data->event_form_id = $request->event_form_id;
            $data->address_id = $request->feature_action_button_address;
            $data->map_address = $request->feature_action_button_map_address;
            $data->action_button_phone_no_calls = $request->feature_action_phone_no_calls;
            $data->action_button_phone_no_sms = $request->feature_action_phone_no_sms;
            $data->action_button_textpopup = $request->feature_action_button_textpopup;
            $data->action_button_action_email = $request->feature_action_email;
            $data->audio_file = isset($request->audio_file[0]) ? $request->audio_file[0] : '';
            if (isset($request->popup_action_images)) {
                $data->popup_images = saveActionButtonImages($request->popup_action_images);
            }
            if (isset($request->popup_action_video)) {
                $file = $request->popup_action_video;
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->popup_action_video->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_video  = uploadimg($file, null);
            }

            if (isset($request->action_button_audio_icon_feature1)) {
                $file = $request->action_button_audio_icon_feature1;
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->extension();
                $fileInfo = $request->action_button_audio_icon_feature1->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_audio_icon_feature = uploadimg($file, null);
            }
            update_action_button('alert_popup_feature_action_button', $data);

            //New Action Button
            $data = (object)[];

            // $data->action_type = 'link';
            // $data->active = $request->newactionbuttonactive ? 1 :0;
            // $data->link = $request->new_action_button_link;
            // $data->address_id = null;
            // $data->custom_form_id= null;
            // update_action_button('alert_popup_new_action_button',$data);

            $data->action_type = $request->new_action_button_link;
            $data->active = $request->newactionbuttonactive ? 1 : 0;
            $data->link = $request->new_button_text_link;
            $data->custom_form_id = $request->new_customforms;
            $data->event_form_id = $request->feature_button_event_form_id;
            $data->address_id = $request->new_action_button_address;
            $data->map_address = $request->new_action_button_map_address;
            $data->action_button_phone_no_calls = $request->new_action_phone_no_calls;
            $data->action_button_phone_no_sms = $request->new_action_phone_no_sms;

            $data->action_button_textpopup = $request->new_action_button_textpopup;
            $data->action_button_action_email = $request->new_action_email;
            $data->audio_file = isset($request->audio_file[1]) ? $request->audio_file[1] : '';

            if (isset($request->popup_feature_action_images)) {
                $uploadedFileNames = [];

                foreach ($request->popup_feature_action_images as $img) {
                    $file = $img;
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->extension();
                    $fileInfo = $img->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $uploadedFileName = uploadimg($file, null);
                    if ($uploadedFileName) {
                        $uploadedFileNames[] = $uploadedFileName;
                    }
                }
                $jsonFileNames = json_encode($uploadedFileNames);
                $data->popup_images = $jsonFileNames;
                // dd($data->popup_images);
            }

            if (isset($request->new_action_button_audio_icon_feature)) {
                $file = $request->new_action_button_audio_icon_feature;
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->extension();
                $fileInfo = $request->new_action_button_audio_icon_feature->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_audio_icon_feature = uploadimg($file, null);
            }

            if (isset($request->new_popup_action_video)) {
                $file = $request->new_popup_action_video;
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->new_popup_action_video->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_video  = uploadimg($file, null);
            }
            update_action_button('alert_popup_new_action_button', $data);

            //Proceed Action Button
            $data = (object)[];
            $data->action_type = 'link';
            $data->active = $request->proceedactionbuttonactive ? 1 : 0;
            $data->link = null;
            $data->address_id = null;
            $data->custom_form_id = null;
            update_action_button('alert_popup_proceed_action_button', $data);

            //Terminate Action Button
            $data = (object)[];
            $data->action_type = 'link';
            $data->active = $request->terminate_action_button_activate ? 1 : 0;
            $data->link = null;
            $data->address_id = null;
            $data->custom_form_id = null;
            update_action_button('alert_popup_terminate_action_button', $data);

            $data =  (object)[];
            $data->slug = "alert_popup_feature_action_button_text";
            $data->text = $request->feature_action_button_desc;
            $data->size_web = '';
            $data->size_mobile = "";
            $data->color = $request->feature_action_button_desc_color;
            $data->bg_color = $request->feature_action_button_background_desc_color;
            $data->fontfamily = 0;
            update_text_details('alert_popup_feature_action_button_text', $data);

            $data =  (object)[];
            $data->slug = "alert_popup_new_action_button_text";
            $data->text = $request->new_action_button_desc;
            $data->size_web = '';
            $data->size_mobile = "";
            $data->color = $request->new_action_button_desc_color;
            $data->bg_color = $request->new_action_button_background_desc_color;
            $data->fontfamily = 0;
            update_text_details('alert_popup_new_action_button_text', $data);

            $data =  (object)[];
            $data->slug = "alert_popup_proceed_action_button_text";
            $data->text = $request->proceed_action_button_desc;
            $data->size_web = '';
            $data->size_mobile = "";
            $data->color = $request->proceed_action_button_desc_color;
            $data->bg_color = $request->proceed_action_button_background_desc_color;
            $data->fontfamily = 0;
            update_text_details('alert_popup_proceed_action_button_text', $data);

            $data =  (object)[];
            $data->slug = "alert_popup_terminate_action_button_text";
            $data->text = $request->terminate_action_button_desc;
            $data->size_web = '';
            $data->size_mobile = "";
            $data->color = $request->terminate_action_button_color;
            $data->bg_color = $request->terminate_action_button_background_color;
            $data->fontfamily = 0;
            update_text_details('alert_popup_terminate_action_button_text', $data);
        }

        // Timed Images
        if (check_auth_permission(['popup_timed_image'])) {

            $data =  (object)[];
            $data->enable = $request->enable_timed_popup_image ? '1' : '0';

            $data->image_timer = $request->timed_popup_image_timer;
            $data->type = $request->timed_popup_image_type;
            $data->days = $request->days;
            if ($data->type == 'days') {
                $data->start_time = $request->timed_popup_image_start_time;
                $data->end_time = $request->timed_popup_image_end_time;
            } else {
                $timer = $request->timed_popup_image_timer;

                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s', strtotime('+' . $timer . ' minutes', strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

                $data->start_time = $start_time;
                $data->end_time = $end_time;
            }

            update_timed_image_setting('timed_popup_image', $data);

            if ($request->timed_popup_image) {
                $oldimage = images::where('slug', 'timed_popup_image')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                $popup_timed_image = saveimagefromdataimage($request->timed_popup_image);

                save_image('timed_popup_image', $popup_timed_image);
            }
        }

        if (check_auth_permission(['popup_image'])) {
            if ($request->popup_image) {
                $oldimage = images::where('slug', 'alert_popup_image')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                $popup_image = saveimagefromdataimage($request->popup_image);
                save_image('alert_popup_image', $popup_image, $request->input('popup_image_width', null));
            } else if ($request->width_modified) {
                save_image('alert_popup_image', null, $request->input('popup_image_width'));
            }
        }


        $message = 'Alert popup has been updated';
        $block = 'popup_alert_bluebar';
        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');


        if ($request->savepopupalert != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }


    public function updateNewsFeedSettings(Request $request)
    {

        $message = 'Newsfeed Email Settings has been updated';
        $block = 'newsfeed_bluebar';
        if (check_auth_permission('news_feed')) {
            $notificationSettings = NotificationSettings::first();
            $reminders = false;
            $notifications = false;


            if ($request->newsfeed_image) {
                $oldimage = images::where('slug', 'news_feed_logo')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                $newsfeed_image = saveimagefromdataimage($request->newsfeed_image);
                save_image('news_feed_logo', $newsfeed_image);
            }

            $data = (object)[];
            $data->slug = "newsfeed_teaser_title";
            $data->text = "";
            $data->size_web = $request->newsfeed_teaser_title_text_size;
            $data->size_mobile = "";
            $data->color = $request->newsfeed_teaser_title_text_color;
            $data->bg_color = "";
            $data->fontfamily = $request->newsfeed_teaser_title_font_family;

            update_text_details('newsfeed_teaser_title', $data);

            $newData = newsFeedSetting::find(1);
            $newData->from_name = $request->newsfeed_from_name;
            $newData->from_email = $request->newsfeed_from_email;
            $newData->reply_to = $request->newsfeed_reply_to;
            $newData->optout_email = $request->newsfeed_optout_email;
            $newData->preheader = $request->preheader;
            $newData->news_feed_bg = $request->news_feed_bg;
            $newData->save();
            
            $data = (object)[];
            $data->slug = "generic_newsfeed_loadMore";
            $data->text = $request->loadMore_btn_description ?? "Load More";
            $data->size_web = $request->load_more_desc_size_web ?? "16"; // Default size for web
            $data->size_mobile = $request->load_more_desc_size_mobile ?? "14"; // Default size for mobile
            $data->color = $request->load_more_desc_color ?? "#000000"; // Default black color
            $data->bg_color = $request->load_more_bg_color ?? "#ffffff"; // Default white background
            $data->fontfamily = $request->load_more_desc_font_family ?? "Arial"; // Default font family

            update_text_details('generic_newsfeed_loadMore', $data);

            if ($_POST['save_newsfeed_email_settings'] == 'savereminders') {
                $reminders = true;
            }
            if ($_POST['save_newsfeed_email_settings'] == 'savenotifications') {
                $notifications = true;
            }

            checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');



            if ($request->save_newsfeed_email_settings != 'save') {
                return redirect('reminders')->withSuccess($message);
            } else {
                return redirect('quicksettings?block=' . $block)->withSuccess($message);
            }
        } else {
            return redirect('quicksettings?block=' . $block)->withError("Access denied");
        }
    }

    public function updateNewsPostSettings(Request $request)
    {
        $notificationSettings = NotificationSettings::first();
        $reminders = false;
        $notifications = false;

        $newData = newsPostSettings::find(1);
        $newData->news_post_background = $request->news_post_background;
        $newData->generic_news_post_show_date = $request->generic_news_post_show_date ? '1' : '0';
        $newData->use_generic_news_post_setting = $request->use_generic_news_post_setting ? '1' : '0';
        $newData->save();

        $data = (object)[];
        $data->slug = "generic_news_post_title";
        $data->text = "";
        $data->size_web = $request->generic_news_post_title_size;
        $data->size_mobile = "";
        $data->color = $request->generic_news_post_title_color;
        $data->bg_color = "";
        $data->fontfamily = $request->generic_news_post_title_font_family;
        update_text_details('generic_news_post_title', $data);

        $data = (object)[];
        $data->slug = "generic_news_post_desc";
        $data->text = "";
        $data->size_web = $request->generic_news_post_desc_size;
        $data->size_mobile = "";
        $data->color = $request->generic_news_post_desc_color;
        $data->bg_color = "";
        $data->fontfamily = $request->generic_news_post_desc_font_family;
        update_text_details('generic_news_post_desc', $data);

        if ($_POST['save_generic_news_post_settings'] == 'savereminders') {
            $reminders = true;
        }
        if ($_POST['save_generic_news_post_settings'] == 'savenotifications') {
            $notifications = true;
        }

        $message = 'Newspost Generic Settings has been updated';
        $block = 'news_posts_bluebar';

        checkSendNotification('Quick settings updated', $message, 'quick_settings_notifications', 'quick_settings_notification_email');


        if ($request->save_generic_news_post_settings != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            return redirect('quicksettings?block=' . $block)->withSuccess($message);
        }
    }



    public function updateNewsFeedGenericSettings(Request $request)
    {


        $message = 'NewsFeed Setting has been updated';
        $block = 'newsfeed_bluebar';
        if (check_auth_permission('news_feed')) {
            $notificationSettings = NotificationSettings::first();
            $reminders = false;
            $notifications = false;
            $newsfeed_setting = newsFeedSetting::find(1);
            $newsfeed_setting->newsfeed_bg_color = $request->newsfeed_bg_color;
            $newsfeed_setting->save();

            if ($request->newsfeed_image) {
                $oldimage = images::where('slug', 'news_feed_logo')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                $newsfeed_image = saveimagefromdataimage($request->newsfeed_image);
                save_image('news_feed_logo', $newsfeed_image);
            }

            $data = (object)[];
            $data->slug = "generic_newsfeed_title";
            $data->text = "";
            $data->size_web = $request->generic_newsfeed_title_size;
            $data->size_mobile = $request->generic_newsfeed_title_size_mobile;
            $data->color = $request->generic_newsfeed_title_color;
            $data->bg_color = "";
            $data->fontfamily = $request->generic_newsfeed_title_font_family;
            update_text_details('generic_newsfeed_title', $data);

            $data = (object)[];
            $data->slug = "generic_newsfeed_desc";
            $data->text = "";
            $data->size_web = $request->generic_newsfeed_desc_size;
            $data->size_mobile = $request->generic_newsfeed_desc_size_mobile;
            $data->color = $request->generic_newsfeed_desc_color;
            $data->bg_color = "";
            $data->fontfamily = $request->generic_newsfeed_desc_font_family;
            update_text_details('generic_newsfeed_desc', $data);

            // $newData = newsFeedSetting::find(1);
            // $newData->use_generic_newsfeed_setting = $request->use_generic_newsfeed_setting?'1':'0';
            // $newData->save();

            if ($_POST['save_generic_newsfeed_settings'] == 'savereminders') {
                $reminders = true;
            }
            if ($_POST['save_generic_newsfeed_settings'] == 'savenotifications') {
                $notifications = true;
            }

            checkSendNotification('Quick settings has been updated', $message);

            if ($request->save_generic_newsfeed_settings != 'save') {
                return redirect('reminders')->withSuccess($message);
            } else {
                return redirect('quicksettings?block=' . $block)->withSuccess($message);
            }
        } else {
            return redirect('quicksettings?block=' . $block)->withError("Access denied");
        }
    }

    public function updateisvideoslider(Request $request)
    {

        $checked = $request->value;
        $headerSettings = $data = headerImages::find(1);
        $headerSettings->is_video = $checked ? '1' : '0';
        $headerSettings->save();
    }

    public function updateisautoplayheaderslider(Request $request)
    {

        $checked = $request->value;
        $headerSettings = $data = headerImages::find(1);
        $headerSettings->is_autoplay = $checked ? '1' : '0';
        $headerSettings->save();
    }

    public function updateissoundheaderslider(Request $request)
    {

        $checked = $request->value;
        $headerSettings = $data = headerImages::find(1);
        $headerSettings->is_sound_on = $checked ? '1' : '0';
        $headerSettings->save();
    }


    public function newsfeeddatestamps(Request $request)
    {

        $checked = $request->value;
        $newsFeedSetting = $data = newsFeedSetting::first();
        $newsFeedSetting->show_dates = $checked ? '1' : '0';
        $newsFeedSetting->save();
    }



    public function delete_slider_video(Request $request)
    {
        if ($request->id) {

            $video = HeaderVideo::find($request->id);
            if ($video && file_exists("assets/uploads/" . get_current_url() . $video->video)) {
                unlink("assets/uploads/" . get_current_url() . $video->video);
            }
            $video->delete();
        }
    }

    public function deleteAudioFiles(Request $request)
    {
        if ($request->slug !== null) {
            if ($request->slug == 'news_feed') {
                $data = newsFeed::where('id', $request->id)->first();
                $data->action_button_action_audio = null;
                $data->save();
            } else if ($request->slug == 'news_post') {
                $data = newsPosts::where('id', $request->id)->first();
                $data->action_button_action_audio = null;
                $data->save();
            } else if ($request->slug == 'gallery_post') {
                $data = galleryPost::where('id', $request->id)->first();
                $data->action_button_action_audio = null;
                $data->save();
            } else if ($request->slug == 'gallery_video') {
                $data = galleryVideo::where('id', $request->id)->first();
                $data->action_button_action_audio = null;
                $data->save();
            } else {
                $data = actionButtons::where('slug', $request->slug)->first();
                $data->action_button_audio = null;
                $data->save();
            }
        } else {
            $newData = audioFiles::find('1');
            $audios = json_decode($newData->audio_files, true);
            $new_audios = [];
            foreach ($audios as $audio) {
                $audio = (object) $audio;
                if ($audio->file == $request->imgname) {
                    if ($request->imgname && file_exists("assets/uploads/" . get_current_url() . $request->imgname)) {
                        unlink("assets/uploads/" . get_current_url() . $request->imgname);
                    }
                } else {
                    $new_audios[] = $audio;
                }
            }
            $newData->audio_files = json_encode($new_audios);
            $newData->save();
        }
    }

    public function popupSwitch(Request $request)
    {
        $popup = alertPopupSetting::first();
        if ($popup) {
            $popup->popup_active = $request->value ? '0' : '1';
            $popup->save();
        }
    }
}
