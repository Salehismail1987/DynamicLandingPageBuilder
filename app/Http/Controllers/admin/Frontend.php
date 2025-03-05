<?php

namespace App\Http\Controllers\admin;

use DB;
use Session;
use App\Models\faqs;
use App\Models\images;
use App\Models\addresses;
use App\Models\formsLinks;
use App\Models\hyperLinks;
use App\Models\customForms;
use App\Models\faqSettings;
use Illuminate\Http\Request;
use App\Models\downloadFiles;
use App\Models\formsSettings;
use App\Models\frontSections;
use App\Models\reviewSettings;
use App\Models\ReviewSiteLink;
use App\Models\reviewStaff;
use App\Models\alertPopupSetting;
use App\Models\StaffProductsPromosSettings;
use App\Models\StaffProductsPromos;
use App\Models\siteSettings;
use App\Models\frontendSetting;
use App\Models\contactFormTitle;
use App\Models\contentBlockLinks;
use App\Models\hyperLinksSettings;
use App\Http\Controllers\Controller;
use App\Models\actionButtons;
use App\Models\BusinessCategory;
use App\Models\contentBlockSettings;
use App\Models\ImageGalleryCategory;
use App\Models\NotificationSettings;
use App\Models\outlineSettings;
use App\Models\TitleBannerSetting;
use App\Models\DownloadSetting;
use App\Models\LearningCenterActionButton;
use App\Models\UnsubscribeEmail;
use Illuminate\Support\Facades\Cache;
use DateTime;
use DateTimeZone;

class Frontend extends Controller
{
    public function __construct()
    {
        $this->data['controller'] = 'frontend';
        $this->data['controller_name'] = 'Edit Frontend';
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['all_categories'] = ImageGalleryCategory::all();
        $this->data['addresses'] = addresses::get();
        $this->data['custom_forms']  = customForms::orderBy('title', 'ASC')->get();
        $this->data['imageCategories'] = ImageGalleryCategory::get();
        $this->data['font_family'] = get_font_family();
        $this->data['event_forms'] = customForms::whereNotNull('event_id')
        ->orderBy('title', 'ASC')
        ->get();
    }

    public function index()
    {
        $this->data['notificationSettings'] = NotificationSettings::first();
        $this->data['siteSettings'] = siteSettings::first();
        $this->data['reviewSettings'] = reviewSettings::first();
        $this->data['reviews_staff'] =  reviewStaff::orderBy('display_order', 'ASC')->get();
        $this->data['alert_popup_feature_action_button_text'] = get_text_details('alert_popup_feature_action_button_text');
        $this->data['StaffProductsPromosSettings'] = StaffProductsPromosSettings::first();
        $this->data['StaffProductsPromos'] =  StaffProductsPromos::orderBy('display_order', 'ASC')->get();
        $this->data['review_sites'] = ReviewSiteLink::get();
        $this->data['downloads_settings'] = DownloadSetting::first();
        updateTimedImages();
        $this->data['alert_popup_setting'] = alertPopupSetting::first();
        $this->data['faqs'] =  faqs::get();
        $this->data['hyperLinks'] =  hyperLinks::get();
        $this->data['categories'] =  BusinessCategory::all();
        // dd($this->data['categories']->pluck('name'));
        $this->data['categories_buttons'] = LearningCenterActionButton::whereIn('feature_slug', $this->data['categories']->pluck('name'))->get();
        // dd($this->data['categories']);
        $this->data['formsLinks'] =  formsLinks::get();
        $this->data['customForms'] =  customForms::orderBy('title', 'ASC')->where('active', true)->get();
        $this->data['downloadFiles'] =  downloadFiles::get();
        $this->data['contentBlockLinks'] =  contentBlockLinks::get();
        $this->data['front_sections'] = frontSections::orderBy('name', 'ASC')->get();
        $this->data['front_section_settings'] = frontendSetting::first();
        $this->data['addresses'] = addresses::get();
        $this->data['contactFormTitle'] = contactFormTitle::get();
        $this->data["outlineSettings"] = outlineSettings::first();
        $this->data['faqSettings'] = faqSettings::first();
        $this->data['hyperLinksSettings'] = hyperLinksSettings::first();
        $this->data['formsSettings'] = formsSettings::first();
        $this->data['contentBlockSettings'] = contentBlockSettings::first();
        $this->data['master_feature_settings'] = get_outline_settings('master_feature_settings');
        $this->data['popup_alert_buttons'] = get_all_learning_center_buttons('popup_alert');
        $this->data['gallery_video_buttons'] = get_all_learning_center_buttons('gallery_video');
        $this->data['popup_alert_buttons'] = get_all_learning_center_buttons('popup_alert');
        $this->data['pull_down_buttons'] = get_all_learning_center_buttons('pull_down');
        $this->data['news_feed_buttons'] = get_all_learning_center_buttons('news_feed');
        $this->data['alert_banner_buttons'] = get_all_learning_center_buttons('alert_banner');
        $this->data['header_Section_buttons'] = get_all_learning_center_buttons('header_Section');
        $this->data['set_schedule_buttons'] = get_all_learning_center_buttons('set_schedule');
        $this->data['rotating_schedule_buttons'] = get_all_learning_center_buttons('rotating_schedule');
        $this->data['content_buttons'] = get_all_learning_center_buttons('content');
        $this->data['slider_buttons'] = get_all_learning_center_buttons('slider');
        $this->data['gallery_posts_buttons'] = get_all_learning_center_buttons('gallery_posts');
        $this->data['contact_box_buttons'] = get_all_learning_center_buttons('contact_box');
        $this->data['contact_form_buttons'] = get_all_learning_center_buttons('contact_forms');
        $this->data['hyperlinks_buttons'] = get_all_learning_center_buttons('hyperlinks');
        $this->data['reviews_buttons'] = get_all_learning_center_buttons('reviews');
        $this->data['faq_buttons'] = get_all_learning_center_buttons('faqs');
        $this->data['seo_buttons'] = get_all_learning_center_buttons('seo');
        $this->data['header_image_buttons'] = get_all_learning_center_buttons('header_images');
        $this->data['header_buttons'] = get_all_learning_center_buttons('header_buttons');
        $this->data['download_buttons'] = get_all_learning_center_buttons('download');
        $this->data['blog_buttons'] = get_all_learning_center_buttons('blog');
        $this->data['forms_buttons'] = get_all_learning_center_buttons('forms');
        $this->data['news_posts_buttons'] = get_all_learning_center_buttons('news_posts');
        $this->data['title_banner_buttons'] = get_all_learning_center_buttons('title_banner');
        $this->data['staff_promo_buttons'] = get_all_learning_center_buttons('staff_promo');
        $this->data['tiles_buttons'] = get_all_learning_center_buttons('tiles');
        $this->data['footer_buttons'] = get_all_learning_center_buttons('footer');
        $this->data['header_slider_buttons'] = get_all_learning_center_buttons('header_slider');
        $this->data['header_logo_buttons'] = get_all_learning_center_buttons('header_logo');
        $this->data['outline_feature_buttons'] = get_all_learning_center_buttons('outline_feature');
        $this->data['audio_file_buttons'] = get_all_learning_center_buttons('footer_audio');
        $this->data['header_text_buttons'] = get_all_learning_center_buttons('header_text');
        $this->data['navbar_buttons'] = get_all_learning_center_buttons('navbar');
        $this->data['social_media_buttons'] = get_all_learning_center_buttons('social_media');
        $this->data['feature_toggle_buttons'] = get_all_learning_center_buttons('feature_toggle');
        $this->data['timed_hyperlink_image_file'] = get_image('timed_hyperlink_image');
        $this->data['timed_content_block_image_file'] = get_image('timed_content_block_image');

        $this->data['timed_hyperlink_image'] = get_timed_image('timed_hyperlink_image');
        $this->data['timed_content_block_image'] = get_timed_image('timed_content_block_image');

        $this->data['generic_review_staff'] = get_text_details('generic_review_staff');
        $this->data['generic_review_staff_star'] = get_text_details('generic_review_staff_star');
        $this->data['generic_faq_question'] = get_text_details('generic_faq_question');
        $this->data['generic_faq_answer'] = get_text_details('generic_faq_answer');
        $this->data['news'] = get_text_details('news');
        $this->data['welcome'] = get_text_details('welcome');
        $this->data['hyper_link_text'] = get_text_details('hyper_link_text');
        $this->data['hyper_link_link'] = get_text_details('hyper_link_link');
        $this->data['form_section_text'] = get_text_details('form_section_text');
        $this->data['download_question_text'] = get_text_details('download_question_text');
        $this->data['download_text'] = get_text_details('download_text');
        $this->data['generic_content_block_desc'] = get_text_details('generic_content_block_desc');
        $this->data['generic_content_block_subtitle'] = get_text_details('generic_content_block_subtitle');


        $this->data['generic_staff_products_promos'] = get_text_details('generic_staff_products_promos');
        $this->data['generic_staff_products_promos_star'] = get_text_details('generic_staff_products_promos_star');
        $this->data['generic_staff_products_promos_question'] = get_text_details('generic_staff_products_promos_question');
        $this->data['generic_staff_products_promos_answer'] = get_text_details('generic_staff_products_promos_answer');


        $this->data['set_hours_title'] = get_text_details('set_hours_title');
        $this->data['schedule_title'] = get_text_details('schedule_title');
        $this->data['content_block_title'] = get_text_details('content_block_title');
        $this->data['download_title'] = get_text_details('download_title');
        $this->data['faq_title'] = get_text_details('faq_title');
        $this->data['gallery_posts_title'] = get_text_details('gallery_posts_title');
        $this->data['gallery_slider_title'] = get_text_details('gallery_slider_title');
        $this->data['gallery_videos_title'] = get_text_details('gallery_videos_title');
        $this->data['gallery_tiles_title'] = get_text_details('gallery_tiles_title');
        $this->data['links_title'] = get_text_details('links_title');
        $this->data['news_posts_title'] = get_text_details('news_posts_title');
        $this->data['reviews_staff_title'] = get_text_details('reviews_staff_title');
        $this->data['staff_products_promos_title'] = get_text_details('staff_products_promos_title');
        $this->data['news_feed_title'] = get_text_details('news_feed_title');
        $this->data['contact_info_block_title'] = get_text_details('contact_info_block_title');
        $this->data['seo_title'] = get_text_details('seo_title');
        $this->data['blog_title'] = get_text_details('blog_title');
        $this->data['attenhub_title'] = get_text_details('attenhub_title');
        $this->data['reset_title'] = get_text_details('reset_title');


        $this->data['blog_title_setting'] = getTitleBannerSetting('blog_title');
        $this->data['attenhub_title_setting'] = getTitleBannerSetting('attenhub_title');
        $this->data['contact_info_blocks_title_setting'] = getTitleBannerSetting('contact_info_block_title');
        $this->data['content_block_title_setting'] = getTitleBannerSetting('content_block_title');
        $this->data['seo_title_setting'] = getTitleBannerSetting('seo_title');
        $this->data['download_title_setting'] = getTitleBannerSetting('download_title');
        $this->data['faq_title_setting'] = getTitleBannerSetting('faq_title');
        $this->data['set_hours_title_setting'] = getTitleBannerSetting('set_hours_title');
        $this->data['schedule_title_setting'] = getTitleBannerSetting('schedule_title');
        $this->data['staff_products_promos_title_setting'] = getTitleBannerSetting('staff_products_promos_title');
        $this->data['reviews_staff_title_setting'] = getTitleBannerSetting('reviews_staff_title');
        $this->data['news_posts_title_setting'] = getTitleBannerSetting('news_posts_title');
        $this->data['news_feed_title_setting'] = getTitleBannerSetting('news_feed_title');
        $this->data['links_title_setting'] = getTitleBannerSetting('links_title');
        $this->data['gallery_videos_title_setting'] = getTitleBannerSetting('gallery_videos_title');
        $this->data['gallery_tiles_title_setting'] = getTitleBannerSetting('gallery_tiles_title');
        $this->data['gallery_slider_title_setting'] = getTitleBannerSetting('gallery_slider_title');
        $this->data['gallery_posts_title_setting'] = getTitleBannerSetting('gallery_posts_title');
        $this->data['form_section_title_setting'] = getTitleBannerSetting('form_section_title');

        return view('admin.editfrontend')->with($this->data);
    }

    public function updateReviewSites(Request $request)
    {
        $message = 'Review Sites has been updated';
        $block = 'review_filter_bluebar';
        ReviewSiteLink::where('id', '>', 0)->delete();
        $i = 1;
        if (isset($request->review_site_name)) {
            foreach ($request->review_site_name as $review_site_name) {
                $reviewSiteLink =  new ReviewSiteLink();
                if (!isset($request->review_site_name[$i]) &&  !isset($request->review_site_link[$i])) {
                    continue;
                }
                $reviewSiteLink->review_site_name = ($request->review_site_name[$i] == 'Other') ? $request->other_site_name[$i] : $request->review_site_name[$i];
                $reviewSiteLink->review_site_link = isset($request->review_site_link[$i]) ? $request->review_site_link[$i] : '';
                $reviewSiteLink->save();
                $i++;
            }
        }
        if ($request->savereviewfilter != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend?block=' . $block)->withSuccess($message);
        }
    }

    public function updateReviewStaff(Request $request)
    {
        try {
            $message = 'Reviews Posting has been updated';
            $block = 'review_staff_bluebar';
            if (check_auth_permission(['review_staff_add_new'])) {
                $k = 0;
                foreach ($request->reviews_staff_text as $single) {
                    if ($request->reviews_staff_text[$k]) {

                        $reviewStaff = new reviewStaff();
                        $reviewStaff->text = $request->reviews_staff_text[$k];
                        $reviewStaff->text_size = $request->reviews_text_size[$k];
                        $reviewStaff->text_color = $request->reviews_text_color[$k];
                        $reviewStaff->text_font = $request->reviews_text_font[$k];
                        $reviewStaff->stars = $request->reviews_stars[$k];
                        $reviewStaff->star_color = $request->reviews_star_color[$k];
                        if ($request->userfile[$k]) {
                            $reviewStaff->image = saveimagefromdataimage($request->userfile[$k]);
                        }

                        // dd($reviewStaff);
                        // dd($single);
                        if (isset($request->left_popup_action_images[$k])) {

                            $reviewStaff->left_popup_images = saveActionButtonImages($request->left_popup_action_images[$k]);
                        }
                        if (isset($request->right_popup_action_images[$k])) {
                            $reviewStaff->right_popup_images = saveActionButtonImages($request->right_popup_action_images[$k]);
                        }

                        #Left Action Button
                        $reviewStaff->left_action_button_active = isset($request->left_action_button_active[$k]) && $request->left_action_button_active[$k] == "on" ? '1' : '0';
                        $reviewStaff->left_action_button_link_text = isset($request->left_action_button_link_text[$k]) && $request->left_action_button_link_text[$k] ? $request->left_action_button_link_text[$k] : '';
                        $reviewStaff->left_action_button_customform = isset($request->left_action_button_customform[$k]) && $request->left_action_button_customform[$k] ? $request->left_action_button_customform[$k] : '0';

                        $reviewStaff->left_action_button_address_id = isset($request->left_action_button_address_id[$k]) && $request->left_action_button_address_id[$k] ? $request->left_action_button_address_id[$k] : '0';
                        $reviewStaff->left_action_button_map_address = isset($request->left_action_button_map_address[$k]) && $request->left_action_button_map_address[$k] ? $request->left_action_button_map_address[$k] : '';
                        $reviewStaff->left_action_button_name = isset($request->left_action_button_name[$k]) && $request->left_action_button_name[$k] ? $request->left_action_button_name[$k] : '';

                        $reviewStaff->left_action_button_link = isset($request->left_action_button_link[$k]) && $request->left_action_button_link[$k] ? $request->left_action_button_link[$k] : '';
                        $reviewStaff->left_action_button_text_color = isset($request->left_action_button_text_color[$k]) && $request->left_action_button_text_color[$k] ? $request->left_action_button_text_color[$k] : '';
                        $reviewStaff->left_action_button_bg_color = isset($request->left_action_button_bg_color[$k]) && $request->left_action_button_bg_color[$k] ? $request->left_action_button_bg_color[$k] : '';

                        $reviewStaff->left_action_button_textpopup = isset($request->left_action_button_textpopup[$k]) && $request->left_action_button_textpopup[$k] ? $request->left_action_button_phone_no_calls[$k] : '';
                        $reviewStaff->left_action_button_phone_no_calls = isset($request->left_action_button_phone_no_calls[$k]) && $request->left_action_button_phone_no_calls[$k] ? $request->left_action_button_phone_no_calls[$k] : '';
                        $reviewStaff->left_action_button_phone_no_sms = isset($request->left_action_button_phone_no_sms[$k]) && $request->left_action_button_phone_no_sms[$k] ? $request->left_action_button_phone_no_sms[$k] : '';
                        $reviewStaff->left_action_button_action_email = isset($request->left_action_button_action_email[$k]) && $request->left_action_button_action_email[$k] ? $request->left_action_button_action_email[$k] : '';

                        #Right Action Button
                        $reviewStaff->right_action_button_active = isset($request->right_action_button_active[$k]) && $request->right_action_button_active[$k] == "on" ? '1' : '0';
                        $reviewStaff->right_action_button_link_text = isset($request->right_action_button_link_text[$k]) && $request->right_action_button_link_text[$k] ? $request->right_action_button_link_text[$k] : '';
                        $reviewStaff->right_action_button_customform = isset($request->right_action_button_customform[$k]) && $request->right_action_button_customform[$k] ? $request->right_action_button_customform[$k] : '0';
                        $reviewStaff->right_action_button_address_id = isset($request->right_action_button_address_id[$k]) && $request->right_action_button_address_id[$k] ? $request->right_action_button_address_id[$k] : '0';
                        $reviewStaff->right_action_button_map_address = isset($request->right_action_button_map_address[$k]) && $request->right_action_button_map_address[$k] ? $request->right_action_button_map_address[$k] : '';

                        $reviewStaff->right_action_button_link = isset($request->right_action_button_link[$k]) && $request->right_action_button_link[$k] ? $request->right_action_button_link[$k] : '';
                        $reviewStaff->right_action_button_text_color = isset($request->right_action_button_text_color[$k]) && $request->right_action_button_text_color[$k] ? $request->right_action_button_text_color[$k] : '';
                        $reviewStaff->right_action_button_bg_color = isset($request->right_action_button_bg_color[$k]) && $request->right_action_button_bg_color[$k] ? $request->right_action_button_bg_color[$k] : '';

                        $reviewStaff->right_action_button_textpopup = isset($request->right_action_button_textpopup[$k]) && $request->right_action_button_textpopup[$k] ? $request->right_action_button_phone_no_calls[$k] : '';
                        $reviewStaff->right_action_button_phone_no_calls = isset($request->right_action_button_phone_no_calls[$k]) && $request->right_action_button_phone_no_calls[$k] ? $request->right_action_button_phone_no_calls[$k] : '';
                        $reviewStaff->right_action_button_phone_no_sms = isset($request->right_action_button_phone_no_sms[$k]) && $request->right_action_button_phone_no_sms[$k] ? $request->right_action_button_phone_no_sms[$k] : '';
                        $reviewStaff->right_action_button_action_email = isset($request->right_action_button_action_email[$k]) && $request->right_action_button_action_email[$k] ? $request->right_action_button_action_email[$k] : '';
                        $reviewStaff->right_action_button_name = isset($request->right_action_button_name[$k]) && $request->right_action_button_name[$k] ? $request->right_action_button_name[$k] : '';

                        if (isset($request->right_audio_icon_file[$k])) {
                            $file = $request->right_audio_icon_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->right_audio_icon_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->right_audio_icon_file = uploadimg($file, null);
                        }
                        if (isset($request->left_audio_icon_file[$k])) {
                            $file = $request->left_audio_icon_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_audio_icon_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->left_audio_icon_file = uploadimg($file, null);
                        }
                        if (isset($request->right_audio_file[$k])) {
                            $file = $request->right_audio_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->right_audio_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->right_action_button_audio = uploadimg($file, null);
                        }

                        if (isset($request->left_audio_file[$k])) {
                            $file = $request->left_audio_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_audio_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->left_action_button_audio = uploadimg($file, null);
                        }

                        if (isset($request->right_video_file[$k])) {
                            $file = $request->right_video_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->right_video_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->right_action_button_video = uploadimg($file, null);
                        }

                        if (isset($request->left_video_file[$k])) {
                            $file = $request->left_video_file[$k];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_video_file[$k]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $reviewStaff->left_action_button_video = uploadimg($file, null);
                        }
                        $save = $reviewStaff->save();

                        $k++;
                    }
                }
                $i = 0;

                if (is_array($request->oldreviews_staff_text) && count($request->oldreviews_staff_text) > 0) {
                    if ($request->oldreviews_staff_text) {
                        foreach ($request->oldreviews_staff_text as $single) {
                            $update_data = reviewStaff::find($request->oldreviews_staff_id[$i]);

                            if ($update_data) {
                                if (check_auth_permission('review_staff')) {
                                    if (isset($request->left_popup_action_images[$request->oldreviews_staff_id[$i]])) {
                                        $update_data->left_popup_images = saveActionButtonImages($request->left_popup_action_images[$request->oldreviews_staff_id[$i]]);
                                    }
                                    if (isset($request->right_popup_action_images[$request->oldreviews_staff_id[$i]])) {
                                        $update_data->right_popup_images = saveActionButtonImages($request->right_popup_action_images[$request->oldreviews_staff_id[$i]]);
                                    }
                                    // dd($update_data);
                                    $update_data->text_size = isset($request->oldreviews_text_size[$i]) ?  $request->oldreviews_text_size[$i] : '';
                                    $update_data->text_color = isset($request->oldreviews_text_color[$i]) ? $request->oldreviews_text_color[$i] : '';
                                    $update_data->text_font = isset($request->oldreviews_text_font[$i]) ? $request->oldreviews_text_font[$i] : '0';
                                    $update_data->stars = isset($request->oldreviews_stars[$i]) ? $request->oldreviews_stars[$i] : '';
                                    $update_data->star_color = isset($request->oldreviews_star_color[$i]) ? $request->oldreviews_star_color[$i] : '';


                                    #Left Action Button
                                    $update_data->left_action_button_active = isset($request->left_action_button_active[$i]) && $request->left_action_button_active[$i] == "on" ? '1' : '0';
                                    $update_data->left_action_button_link_text = isset($request->left_action_button_link_text[$i]) && $request->left_action_button_link_text[$i] ? $request->left_action_button_link_text[$i] : '';
                                    $update_data->left_action_button_name =  isset($request->left_action_button_name[$i]) && $request->left_action_button_name[$i] ? $request->left_action_button_name[$i] : '';
                                    $update_data->left_action_button_customform =  isset($request->left_action_button_customform[$i]) && $request->left_action_button_customform[$i] ? $request->left_action_button_customform[$i] : '0';
                                    $update_data->left_action_button_event_form =  isset($request->left_action_button_event_form[$i]) && $request->left_action_button_event_form[$i] ? $request->left_action_button_event_form[$i] : '0';
                                    $update_data->left_action_button_address_id = isset($request->left_action_button_address_id[$i]) && $request->left_action_button_address_id[$i] ? $request->left_action_button_address_id[$i] : '0';
                                    $update_data->left_action_button_map_address = isset($request->left_action_button_map_address[$i]) && $request->left_action_button_map_address[$i] ? $request->left_action_button_map_address[$i] : '';

                                    $update_data->left_action_button_link = isset($request->left_action_button_link[$i]) && $request->left_action_button_link[$i] ? $request->left_action_button_link[$i] : '';
                                    $update_data->left_action_button_text_color = isset($request->left_action_button_text_color[$i]) && $request->left_action_button_text_color[$i] ? $request->left_action_button_text_color[$i] : '';
                                    $update_data->left_action_button_bg_color = $request->left_action_button_bg_color[$i] ? $request->left_action_button_bg_color[$i] : '';

                                    $update_data->left_action_button_textpopup = isset($request->left_action_button_textpopup) && $request->left_action_button_textpopup ? $request->left_action_button_textpopup[$i] : '';
                                    $update_data->left_action_button_phone_no_calls = isset($request->left_action_button_phone_no_calls) && $request->left_action_button_phone_no_calls ? $request->left_action_button_phone_no_calls[$i] : '';
                                    $update_data->left_action_button_phone_no_sms = isset($request->left_action_button_phone_no_sms[$i]) && $request->left_action_button_phone_no_sms[$i]  ? $request->left_action_button_phone_no_sms[$i] : '';
                                    $update_data->left_action_button_action_email = isset($request->left_action_button_action_email[$i]) && $request->left_action_button_action_email[$i]  ? $request->left_action_button_action_email[$i] : '';
                                    $update_data->left_action_button_audio = isset($request->left_audio_file[$i]) ? $request->left_audio_file[$i] : '';

                                    #Right Action Button
                                    $update_data->right_action_button_active = isset($request->right_action_button_active[$i]) && $request->right_action_button_active[$i] == "on" ? '1' : '0';
                                    $update_data->right_action_button_link_text = isset($request->right_action_button_link_text[$i]) ? $request->right_action_button_link_text[$i] : '';
                                    $update_data->right_action_button_name = isset($request->right_action_button_name[$i]) ? $request->right_action_button_name[$i] : '';
                                    $update_data->right_action_button_customform = isset($request->right_action_button_customform[$i]) && ($request->right_action_button_customform[$i]) ? $request->right_action_button_customform[$i] : '0';
                                    $update_data->right_action_button_event_form = isset($request->right_action_button_event_form[$i]) && ($request->right_action_button_event_form[$i]) ? $request->right_action_button_event_form[$i] : '0';
                                    $update_data->right_action_button_address_id = isset($request->right_action_button_address_id[$i]) && ($request->right_action_button_address_id[$i]) ? $request->right_action_button_address_id[$i] : '0';
                                    $update_data->right_action_button_map_address = isset($request->right_action_button_map_address[$i]) ? $request->right_action_button_map_address[$i] : '';

                                    $update_data->right_action_button_link = isset($request->right_action_button_link[$i]) ? $request->right_action_button_link[$i] : '';
                                    $update_data->right_action_button_text_color = isset($request->right_action_button_text_color[$i]) ? $request->right_action_button_text_color[$i] : '';
                                    $update_data->right_action_button_bg_color = isset($request->right_action_button_bg_color[$i]) ? $request->right_action_button_bg_color[$i] : '';

                                    $update_data->right_action_button_textpopup = isset($request->right_action_button_textpopup[$i]) ? $request->right_action_button_textpopup[$i] : '';
                                    $update_data->right_action_button_phone_no_calls = isset($request->right_action_button_phone_no_calls[$i]) ? $request->right_action_button_phone_no_calls[$i] : '';
                                    $update_data->right_action_button_phone_no_sms = isset($request->right_action_button_phone_no_sms[$i]) ? $request->right_action_button_phone_no_sms[$i] : '';
                                    $update_data->right_action_button_action_email = isset($request->right_action_button_action_email[$i]) ? $request->right_action_button_action_email[$i] : '';

                                    if (isset($request->right_audio_icon_file[$i])) {
                                        $file = $request->right_audio_icon_file[$i];
                                        $file_name = $file->getClientOriginalName();

                                        $file_ext = $file->extension();
                                        $fileInfo = $request->right_audio_icon_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->right_audio_icon_file = uploadimg($file, null);
                                    }
                                    if (isset($request->left_audio_icon_file[$i])) {
                                        $file = $request->left_audio_icon_file[$i];
                                        $file_name = $file->getClientOriginalName();
                                        $file_ext = $file->extension();
                                        $fileInfo = $request->left_audio_icon_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->left_audio_icon_file = uploadimg($file, null);
                                    }
                                    if (isset($request->right_audio_file[$i])) {
                                        $file = $request->right_audio_file[$i];
                                        $file_name = $file->getClientOriginalName();
                                        $file_ext = $file->extension();
                                        $fileInfo = $request->right_audio_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->right_action_button_audio = uploadimg($file, null);
                                    }

                                    if (isset($request->left_audio_file[$i])) {
                                        $file = $request->left_audio_file[$i];
                                        $file_name = $file->getClientOriginalName();
                                        $file_ext = $file->extension();
                                        $fileInfo = $request->left_audio_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->left_action_button_audio = uploadimg($file, null);
                                    }

                                    if (isset($request->right_video_file[$i])) {
                                        $file = $request->right_video_file[$i];
                                        $file_name = $file->getClientOriginalName();
                                        $file_ext = $file->extension();
                                        $fileInfo = $request->right_video_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->right_action_button_video = uploadimg($file, null);
                                    }

                                    if (isset($request->left_video_file[$i])) {
                                        $file = $request->left_video_file[$i];
                                        $file_name = $file->getClientOriginalName();
                                        $file_ext = $file->extension();
                                        $fileInfo = $request->left_video_file[$i]->path();
                                        $file = [
                                            "name" => $file_name,
                                            "type" => $file_ext,
                                            "tmp_name" => $fileInfo,
                                            "error" => 0,
                                            "size" => $file->getSize()
                                        ];
                                        $update_data->left_action_button_video = uploadimg($file, null);
                                    }
                                    if ($request->oldreview_staff_image[$i]) {
                                        if (isset($update_data->image)) {
                                            delimg($update_data->image);
                                        }
                                        $update_data->image = saveimagefromdataimage($request->oldreview_staff_image[$i]);
                                    }
                                }

                                if (check_auth_permission(['review_staff', 'reviews_staff_text'])) {
                                    if ($request->oldreviews_staff_text[$i]) {
                                        $update_data->text = $request->oldreviews_staff_text[$i];
                                    }
                                }
                                if ($request->oldreviews_staff_id[$i] > 0) {
                                    $update_data->save();
                                }
                            }

                            $i++;
                        }
                    }
                }
            }

            if (check_auth_permission('review_staff')) {
                $reviewSettings = reviewSettings::find(1);
                $reviewSettings->review_background = $request->reviews_staff_background;
                $reviewSettings->arrow_color = $request->arrow_color;
                $reviewSettings->arrow_hover_color = $request->arrow_hover_color;
                $reviewSettings->dot_color = $request->dot_color;
                $reviewSettings->dot_active_color = $request->dot_active_color;
                $reviewSettings->enable_review_stars = $request->enable_review_stars ? '1' : '0';
                $reviewSettings->use_generic = $request->use_generic_review_staff_setting ? '1' : '0';
                $reviewSettings->save();

                $data = (object)[];
                $data->fontfamily = $request->generic_review_staff_font_family;
                $data->size_web = $request->generic_review_staff_font_size;
                $data->color = $request->generic_review_staff_color;

                update_text_details2('generic_review_staff', $data);

                $data = (object)[];
                $data->color = $request->generic_review_staff_star_color;
                update_text_details2('generic_review_staff_star', $data);
            }

            $message = 'Reviews Posting has been updated';
            if ($_POST['savereviewsstaff'] != 'save') {
                $reminders = true;
            }

            checkSendNotification('Frontend', $message);
        } catch (\Throwable $e) {
            return redirect('editfrontend');
        }
        if ($request->savereviewsstaff != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }

    public function updateStaffProductsPromos(Request $request)
    {

        $message = 'Staff Products Promos has been updated';
        $block = 'staff_products_promos_bluebar';
        if (check_auth_permission(['staff_products_promos_add_new'])) {
            $k = 0;
            foreach ($request->staff_products_promos_text as $single) {
                if ($request->staff_products_promos_text[$k]) {
                    $StaffProductsPromos = new StaffProductsPromos();
                    $StaffProductsPromos->text = $request->staff_products_promos_text[$k];
                    $StaffProductsPromos->text_size = $request->staff_products_promos_text_size[$k];
                    $StaffProductsPromos->text_color = $request->staff_products_promos_text_color[$k];
                    $StaffProductsPromos->text_font = $request->staff_products_promos_text_font[$k];
                    $StaffProductsPromos->stars = $request->staff_products_promos_stars[$k];
                    $StaffProductsPromos->star_color = $request->staff_products_promos_text_star_color[$k];
                    if ($request->userfile[$k]) {
                        $StaffProductsPromos->image = saveimagefromdataimage($request->userfile[$k]);
                    }
                    // dd($request->all());
                    if (isset($request->left_popup_action_images[$k])) {

                        $StaffProductsPromos->left_popup_images = saveActionButtonImages($request->left_popup_action_images[$k]);
                    }
                    if (isset($request->right_popup_action_images[$k])) {
                        $StaffProductsPromos->right_popup_images = saveActionButtonImages($request->right_popup_action_images[$k]);
                    }
                    #Left Action Button
                    $StaffProductsPromos->left_action_button_active = isset($request->left_action_button_active[$k]) && $request->left_action_button_active[$k] == "on" ? '1' : '0';
                    $StaffProductsPromos->left_action_button_link_text = isset($request->left_action_button_link_text[$k]) && $request->left_action_button_link_text[$k] ? $request->left_action_button_link_text[$k] : '';
                    $StaffProductsPromos->left_action_button_customform = isset($request->left_action_button_customform[$k]) && $request->left_action_button_customform[$k] ? $request->left_action_button_customform[$k] : '0';
                    $StaffProductsPromos->left_action_button_event_form = isset($request->left_action_button_event_form[$k]) && $request->left_action_button_event_form[$k] ? $request->left_action_button_event_form[$k] : '0';

                    $StaffProductsPromos->left_action_button_address_id = isset($request->left_action_button_address_id[$k]) && $request->left_action_button_address_id[$k] ? $request->left_action_button_address_id[$k] : '0';
                    $StaffProductsPromos->left_action_button_map_address = isset($request->left_action_button_map_address[$k]) && $request->left_action_button_map_address[$k] ? $request->left_action_button_map_address[$k] : '';
                    $StaffProductsPromos->left_action_button_name = isset($request->left_action_button_name[$k]) && $request->left_action_button_name[$k] ? $request->left_action_button_name[$k] : '';

                    $StaffProductsPromos->left_action_button_link = isset($request->left_action_button_link[$k]) && $request->left_action_button_link[$k] ? $request->left_action_button_link[$k] : '';
                    $StaffProductsPromos->left_action_button_text_color = isset($request->left_action_button_text_color[$k]) && $request->left_action_button_text_color[$k] ? $request->left_action_button_text_color[$k] : '';
                    $StaffProductsPromos->left_action_button_bg_color = isset($request->left_action_button_bg_color[$k]) && $request->left_action_button_bg_color[$k] ? $request->left_action_button_bg_color[$k] : '';

                    $StaffProductsPromos->left_action_button_textpopup = isset($request->left_action_button_textpopup[$k]) && $request->left_action_button_textpopup[$k] ? $request->left_action_button_phone_no_calls[$k] : '';
                    $StaffProductsPromos->left_action_button_phone_no_calls = isset($request->left_action_button_phone_no_calls[$k]) && $request->left_action_button_phone_no_calls[$k] ? $request->left_action_button_phone_no_calls[$k] : '';
                    $StaffProductsPromos->left_action_button_phone_no_sms = isset($request->left_action_button_phone_no_sms[$k]) && $request->left_action_button_phone_no_sms[$k] ? $request->left_action_button_phone_no_sms[$k] : '';
                    $StaffProductsPromos->left_action_button_action_email = isset($request->left_action_button_action_email[$k]) && $request->left_action_button_action_email[$k] ? $request->left_action_button_action_email[$k] : '';

                    #Right Action Button
                    $StaffProductsPromos->right_action_button_active = isset($request->right_action_button_active[$k]) && $request->right_action_button_active[$k] == "on" ? '1' : '0';
                    $StaffProductsPromos->right_action_button_link_text = isset($request->right_action_button_link_text[$k]) && $request->right_action_button_link_text[$k] ? $request->right_action_button_link_text[$k] : '';
                    $StaffProductsPromos->right_action_button_customform = isset($request->right_action_button_customform[$k]) && $request->right_action_button_customform[$k] ? $request->right_action_button_customform[$k] : '0';
                    $StaffProductsPromos->right_action_button_event_form = isset($request->right_action_button_event_form[$k]) && $request->right_action_button_event_form[$k] ? $request->right_action_button_event_form[$k] : '0';
                    $StaffProductsPromos->right_action_button_address_id = isset($request->right_action_button_address_id[$k]) && $request->right_action_button_address_id[$k] ? $request->right_action_button_address_id[$k] : '0';
                    $StaffProductsPromos->right_action_button_map_address = isset($request->right_action_button_map_address[$k]) && $request->right_action_button_map_address[$k] ? $request->right_action_button_map_address[$k] : '';

                    $StaffProductsPromos->right_action_button_link = isset($request->right_action_button_link[$k]) && $request->right_action_button_link[$k] ? $request->right_action_button_link[$k] : '';
                    $StaffProductsPromos->right_action_button_text_color = isset($request->right_action_button_text_color[$k]) && $request->right_action_button_text_color[$k] ? $request->right_action_button_text_color[$k] : '';
                    $StaffProductsPromos->right_action_button_bg_color = isset($request->right_action_button_bg_color[$k]) && $request->right_action_button_bg_color[$k] ? $request->right_action_button_bg_color[$k] : '';

                    $StaffProductsPromos->right_action_button_textpopup = isset($request->right_action_button_textpopup[$k]) && $request->right_action_button_textpopup[$k] ? $request->right_action_button_phone_no_calls[$k] : '';
                    $StaffProductsPromos->right_action_button_phone_no_calls = isset($request->right_action_button_phone_no_calls[$k]) && $request->right_action_button_phone_no_calls[$k] ? $request->right_action_button_phone_no_calls[$k] : '';
                    $StaffProductsPromos->right_action_button_phone_no_sms = isset($request->right_action_button_phone_no_sms[$k]) && $request->right_action_button_phone_no_sms[$k] ? $request->right_action_button_phone_no_sms[$k] : '';
                    $StaffProductsPromos->right_action_button_action_email = isset($request->right_action_button_action_email[$k]) && $request->right_action_button_action_email[$k] ? $request->right_action_button_action_email[$k] : '';
                    $StaffProductsPromos->right_action_button_name = isset($request->right_action_button_name[$k]) && $request->right_action_button_name[$k] ? $request->right_action_button_name[$k] : '';

                    if (isset($request->right_audio_icon_file[$k])) {
                        $file = $request->right_audio_icon_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->right_audio_icon_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->right_audio_icon_file = uploadimg($file, null);
                    }
                    if (isset($request->left_audio_icon_file[$k])) {
                        $file = $request->left_audio_icon_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->left_audio_icon_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->left_audio_icon_file = uploadimg($file, null);
                    }
                    if (isset($request->right_audio_file[$k])) {
                        $file = $request->right_audio_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->right_audio_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->right_action_button_audio = uploadimg($file, null);
                    }

                    if (isset($request->left_audio_file[$k])) {
                        $file = $request->left_audio_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->left_audio_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->left_action_button_audio = uploadimg($file, null);
                    }

                    if (isset($request->right_video_file[$k])) {
                        $file = $request->right_video_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->right_video_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->right_action_button_video = uploadimg($file, null);
                    }

                    if (isset($request->left_video_file[$k])) {
                        $file = $request->left_video_file[$k];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->left_video_file[$k]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $StaffProductsPromos->left_action_button_video = uploadimg($file, null);
                    }
                    $StaffProductsPromos->save();

                    $k++;
                }
            }
            $i = 0;
            if (is_array($request->oldstaff_products_promos_text) && count($request->oldstaff_products_promos_text) > 0) {
                if ($request->oldstaff_products_promos_text) {
                    foreach ($request->oldstaff_products_promos_text as $single) {
                        $update_data = StaffProductsPromos::find($request->oldstaff_products_promos_id[$i]);

                        if (check_auth_permission('staff_products_promos')) {

                            if (isset($request->left_popup_action_images[$request->oldstaff_products_promos_id[$i]])) {
                                $update_data->left_popup_images = saveActionButtonImages($request->left_popup_action_images[$request->oldstaff_products_promos_id[$i]]);
                            }
                            if (isset($request->right_popup_action_images[$request->oldstaff_products_promos_id[$i]])) {
                                $update_data->right_popup_images = saveActionButtonImages($request->right_popup_action_images[$request->oldstaff_products_promos_id[$i]]);
                            }

                            $update_data->text_size = isset($request->oldstaff_products_promos_text_size[$i]) ?  $request->oldstaff_products_promos_text_size[$i] : '';
                            $update_data->text_color = isset($request->oldstaff_products_promos_text_color[$i]) ? $request->oldstaff_products_promos_text_color[$i] : '';
                            $update_data->text_font = isset($request->oldstaff_products_promos_text_font[$i]) ? $request->oldstaff_products_promos_text_font[$i] : '0';
                            $update_data->stars = isset($request->oldstaff_products_promos_stars[$i]) ? $request->oldstaff_products_promos_stars[$i] : '';
                            $update_data->star_color = isset($request->oldstaff_products_promos_text_star_color[$i]) ? $request->oldstaff_products_promos_text_star_color[$i] : '';

                            if ($request->oldstaff_products_promos_image[$i]) {
                                if (isset($update_data->image)) {
                                    delimg($update_data->image);
                                }
                                $update_data->image = saveimagefromdataimage($request->oldstaff_products_promos_image[$i]);
                            }
                        }

                        if (check_auth_permission(['staff_products_promos', 'staff_products_promos_text'])) {
                            if ($request->oldstaff_products_promos_text[$i]) {
                                $update_data->text = $request->oldstaff_products_promos_text[$i];
                            }
                        }

                        #Left Action Button
                        $update_data->left_action_button_active = isset($request->left_action_button_active[$i]) && $request->left_action_button_active[$i] == "on" ? '1' : '0';
                        $update_data->left_action_button_link_text = isset($request->left_action_button_link_text[$i]) && $request->left_action_button_link_text[$i] ? $request->left_action_button_link_text[$i] : '';
                        $update_data->left_action_button_name =  isset($request->left_action_button_name[$i]) && $request->left_action_button_name[$i] ? $request->left_action_button_name[$i] : '';
                        $update_data->left_action_button_customform =  isset($request->left_action_button_customform[$i]) && $request->left_action_button_customform[$i] ? $request->left_action_button_customform[$i] : '0';
                        $update_data->left_action_button_address_id = isset($request->left_action_button_address_id[$i]) && $request->left_action_button_address_id[$i] ? $request->left_action_button_address_id[$i] : '0';
                        $update_data->left_action_button_map_address = isset($request->left_action_button_map_address[$i]) && $request->left_action_button_map_address[$i] ? $request->left_action_button_map_address[$i] : '';

                        $update_data->left_action_button_link = isset($request->left_action_button_link[$i]) && $request->left_action_button_link[$i] ? $request->left_action_button_link[$i] : '';
                        $update_data->left_action_button_text_color = isset($request->left_action_button_text_color[$i]) && $request->left_action_button_text_color[$i] ? $request->left_action_button_text_color[$i] : '';
                        $update_data->left_action_button_bg_color = $request->left_action_button_bg_color[$i] ? $request->left_action_button_bg_color[$i] : '';

                        $update_data->left_action_button_textpopup = isset($request->left_action_button_textpopup) && $request->left_action_button_textpopup ? $request->left_action_button_textpopup[$i] : '';
                        $update_data->left_action_button_phone_no_calls = isset($request->left_action_button_phone_no_calls) && $request->left_action_button_phone_no_calls ? $request->left_action_button_phone_no_calls[$i] : '';
                        $update_data->left_action_button_phone_no_sms = isset($request->left_action_button_phone_no_sms[$i]) && $request->left_action_button_phone_no_sms[$i]  ? $request->left_action_button_phone_no_sms[$i] : '';
                        $update_data->left_action_button_action_email = isset($request->left_action_button_action_email[$i]) && $request->left_action_button_action_email[$i]  ? $request->left_action_button_action_email[$i] : '';
                        $update_data->left_action_button_audio = isset($request->left_audio_file[$i]) ? $request->left_audio_file[$i] : '';

                        #Right Action Button
                        $update_data->right_action_button_active = isset($request->right_action_button_active[$i]) && $request->right_action_button_active[$i] == "on" ? '1' : '0';
                        $update_data->right_action_button_link_text = isset($request->right_action_button_link_text[$i]) ? $request->right_action_button_link_text[$i] : '';
                        $update_data->right_action_button_name = isset($request->right_action_button_name[$i]) ? $request->right_action_button_name[$i] : '';
                        $update_data->right_action_button_customform = isset($request->right_action_button_customform[$i]) && ($request->right_action_button_customform[$i]) ? $request->right_action_button_customform[$i] : '0';
                        $update_data->right_action_button_address_id = isset($request->right_action_button_address_id[$i]) && ($request->right_action_button_address_id[$i]) ? $request->right_action_button_address_id[$i] : '0';
                        $update_data->right_action_button_map_address = isset($request->right_action_button_map_address[$i]) ? $request->right_action_button_map_address[$i] : '';

                        $update_data->right_action_button_link = isset($request->right_action_button_link[$i]) ? $request->right_action_button_link[$i] : '';
                        $update_data->right_action_button_text_color = isset($request->right_action_button_text_color[$i]) ? $request->right_action_button_text_color[$i] : '';
                        $update_data->right_action_button_bg_color = isset($request->right_action_button_bg_color[$i]) ? $request->right_action_button_bg_color[$i] : '';

                        $update_data->right_action_button_textpopup = isset($request->right_action_button_textpopup[$i]) ? $request->right_action_button_textpopup[$i] : '';
                        $update_data->right_action_button_phone_no_calls = isset($request->right_action_button_phone_no_calls[$i]) ? $request->right_action_button_phone_no_calls[$i] : '';
                        $update_data->right_action_button_phone_no_sms = isset($request->right_action_button_phone_no_sms[$i]) ? $request->right_action_button_phone_no_sms[$i] : '';
                        $update_data->right_action_button_action_email = isset($request->right_action_button_action_email[$i]) ? $request->right_action_button_action_email[$i] : '';

                        if (isset($request->right_audio_icon_file[$i])) {
                            $file = $request->right_audio_icon_file[$i];
                            $file_name = $file->getClientOriginalName();

                            $file_ext = $file->extension();
                            $fileInfo = $request->right_audio_icon_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->right_audio_icon_file = uploadimg($file, null);
                        }
                        if (isset($request->left_audio_icon_file[$i])) {
                            $file = $request->left_audio_icon_file[$i];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_audio_icon_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->left_audio_icon_file = uploadimg($file, null);
                        }
                        if (isset($request->right_audio_file[$i])) {
                            $file = $request->right_audio_file[$i];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->right_audio_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->right_action_button_audio = uploadimg($file, null);
                        }

                        if (isset($request->left_audio_file[$i])) {
                            $file = $request->left_audio_file[$i];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_audio_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->left_action_button_audio = uploadimg($file, null);
                        }

                        if (isset($request->right_video_file[$i])) {
                            $file = $request->right_video_file[$i];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->right_video_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->right_action_button_video = uploadimg($file, null);
                        }

                        if (isset($request->left_video_file[$i])) {
                            $file = $request->left_video_file[$i];
                            $file_name = $file->getClientOriginalName();
                            $file_ext = $file->extension();
                            $fileInfo = $request->left_video_file[$i]->path();
                            $file = [
                                "name" => $file_name,
                                "type" => $file_ext,
                                "tmp_name" => $fileInfo,
                                "error" => 0,
                                "size" => $file->getSize()
                            ];
                            $update_data->left_action_button_video = uploadimg($file, null);
                        }
                        if ($request->oldstaff_products_promos_id[$i] > 0) {
                            $update_data->save();
                        }
                        $i++;
                    }
                }
            }
        }

        if (check_auth_permission('staff_products_promos')) {
            $StaffProductsPromosSettings = StaffProductsPromosSettings::find(1);
            $StaffProductsPromosSettings->background = $request->staff_products_promos_background;
            $StaffProductsPromosSettings->arrow_color = $request->arrow_color;
            $StaffProductsPromosSettings->arrow_hover_color = $request->arrow_hover_color;
            $StaffProductsPromosSettings->dot_color = $request->dot_color;
            $StaffProductsPromosSettings->dot_active_color = $request->dot_active_color;
            $StaffProductsPromosSettings->enable_stars = $request->enable_stars ? '1' : '0';
            $StaffProductsPromosSettings->use_generic = $request->use_generic_staff_products_promos_setting ? '1' : '0';
            $StaffProductsPromosSettings->save();

            $data = (object)[];
            $data->fontfamily = $request->generic_staff_products_promos_font_family;
            $data->size_web = $request->generic_staff_products_promos_font_size;
            $data->color = $request->generic_staff_products_promos_color;

            update_text_details2('generic_staff_products_promos', $data);

            $data = (object)[];
            $data->color = $request->generic_staff_products_promos_star_color;
            update_text_details2('generic_staff_products_promos_star', $data);
        }

        $message = 'Staff products promos has been updated';
        $block = 'staff_products_promos_bluebar';
        if ($_POST['savestaffproductspromos'] != 'save') {
            $reminders = true;
        }
        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->savestaffproductspromos != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }
    public function updateFaq(Request $request)
    {
        if (check_auth_permission(['question_input', 'answer_input', 'faq_add_new'])) {
            $faqs = array();
            $i = 0;
            foreach ($request->old_faq_question as $single) {

                $newData = faqs::find($request->faq_id[$i]);

                if (check_auth_permission(['question_input'])) {
                    $newData->question_text = $single;
                    $newData->question_font_size = isset($request->old_faq_question_font_size[$i]) ? $request->old_faq_question_font_size[$i] : '';
                    $newData->question_text_color = isset($request->old_faq_question_text_color[$i]) ? $request->old_faq_question_text_color[$i] : '';
                    $newData->question_font_family = isset($request->old_faq_question_font_family[$i]) ? $request->old_faq_question_font_family[$i] : '0';
                }

                if (check_auth_permission(['answer_input'])) {
                    $newData->answer_text = isset($request->old_faq_answer[$i]) ? $request->old_faq_answer[$i] : '';
                    $newData->answer_font_size = isset($request->old_faq_answer_font_size[$i]) ? $request->old_faq_answer_font_size[$i] : '';
                    $newData->answer_text_color = isset($request->old_faq_answer_text_color[$i]) ? $request->old_faq_answer_text_color[$i] : '';
                    $newData->answer_font_family = isset($request->old_faq_answer_font_family[$i]) ? $request->old_faq_answer_font_family[$i] : '0';
                }
                $newData->save();
                $i++;
            }

            $i = 0;
            if (check_auth_permission(['faq_add_new'])) {
                if (isset($request->faq_question)) {

                    foreach ($request->faq_question as $single) {
                        if (isset($single) && $single != '') {
                            $newData = new faqs();
                            $newData->question_text = $single;
                            $newData->question_font_size = isset($request->faq_question_font_size[$i]) ? $request->faq_question_font_size[$i] : '';
                            $newData->question_text_color = isset($request->faq_question_text_color[$i]) ? $request->faq_question_text_color[$i] : '';
                            $newData->question_font_family = isset($request->faq_question_font_family[$i]) ? $request->faq_question_font_family[$i] : 0;
                            $newData->answer_text = isset($request->faq_answer[$i]) ? $request->faq_answer[$i] : '';
                            $newData->answer_font_size = isset($request->faq_answer_font_size[$i]) ? $request->faq_answer_font_size[$i] : '';
                            $newData->answer_text_color = isset($request->faq_answer_text_color[$i]) ? $request->faq_answer_text_color[$i] : '';
                            $newData->answer_font_family = isset($request->faq_answer_font_family[$i]) ? $request->faq_answer_font_family[$i] : 0;
                            $newData->save();
                        }
                        $i++;
                    }
                }
            }
        }

        if (check_auth_permission(['faqs', 'question_input', 'answer_input', 'faq_add_new'])) {

            $faqSettings = faqSettings::find(1);
            $faqSettings->use_generic = $request->use_generic_faq_setting ? '1' : '0';
            $faqSettings->background_color = $request->generic_faq_background_color;
            $faqSettings->override_bg = $request->override_bg == 'on' ? '1' : '0';

            $faqSettings->individual_background_color = $request->faq_individual_background_color;
            $faqSettings->save();

            $data = (object)[];
            $data->color = $request->generic_faq_question_color;
            $data->size_web = $request->generic_faq_question_font_size;
            $data->fontfamily = $request->generic_faq_question_font_family;
            update_text_details2('generic_faq_question', $data);


            $data = (object)[];
            $data->color = $request->generic_faq_answer_color;
            $data->size_web = $request->generic_faq_answer_font_size;
            $data->fontfamily = $request->generic_faq_answer_font_family;
            update_text_details2('generic_faq_answer', $data);


            $newData = (object)[];
            $newData->question_font_size = $request->generic_faq_question_font_size;
            $newData->question_text_color = $request->generic_faq_question_color;
            $newData->question_font_family = $request->generic_faq_question_font_family;

            $newData->answer_font_size = $request->generic_faq_answer_font_size;
            $newData->answer_text_color = $request->generic_faq_answer_color;
            $newData->answer_font_family = $request->generic_faq_answer_font_family;

            $newData = json_decode(json_encode($newData), true);
            faqs::query()->update($newData);
        }

        $message = 'Faqs has been updated';
        $block = 'faqs_bluebar';

        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->savefaqs != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }
    public function updatefaqgenericsettings(Request $request)
    {
        if (check_auth_permission(['faqs', 'question_input', 'answer_input', 'faq_add_new'])) {

            $faqSettings = faqSettings::find(1);
            $faqSettings->use_generic = $request->use_generic_faq_setting ? '1' : '0';
            $faqSettings->background_color = $request->generic_faq_background_color;
            $faqSettings->individual_background_color = $request->faq_individual_background_color;
            $faqSettings->save();

            $data = (object)[];
            $data->color = $request->generic_faq_question_color;
            $data->size_web = $request->generic_faq_question_font_size;
            $data->fontfamily = $request->generic_faq_question_font_family;
            update_text_details2('generic_faq_question', $data);


            $data = (object)[];
            $data->color = $request->generic_faq_answer_color;
            $data->size_web = $request->generic_faq_answer_font_size;
            $data->fontfamily = $request->generic_faq_answer_font_family;
            update_text_details2('generic_faq_answer', $data);


            $newData = (object)[];
            $newData->question_font_size = $request->generic_faq_question_font_size;
            $newData->question_text_color = $request->generic_faq_question_color;
            $newData->question_font_family = $request->generic_faq_question_font_family;

            $newData->answer_font_size = $request->generic_faq_answer_font_size;
            $newData->answer_text_color = $request->generic_faq_answer_color;
            $newData->answer_font_family = $request->generic_faq_answer_font_family;

            $newData = json_decode(json_encode($newData), true);
            faqs::query()->update($newData);
        }

        $message = 'Faqs has been updated';
        $block = 'faqs_bluebar';

        checkSendNotification('Frontend', $message);
        if ($request->savefaqs != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }
    public function delfaq(Request $request)
    {
        $faqid = $request->faqid;
        $res = faqs::where('id', $faqid)->delete();
    }

    public function delFormLink(Request $request)
    {
        $id = $request->id;
        $data = formsLinks::find($id);
        if ($data) {
            $data->delete();
        }
    }

    public function delReview(Request $request)
    {
        $reviewid = $request->reviewid;
        $res = reviewStaff::where('id', $reviewid)->delete();
    }
    public function delStaffProductsPromos(Request $request)
    {
        $id = $request->id;
        $res = StaffProductsPromos::where('id', $id)->delete();
    }

    public function updateHyperLinks(Request $request)
    {

        if (check_auth_permission(['hyperlinks', 'hyperlink_image'])) {
            if ($request->userfile) {
                $newData = hyperLinksSettings::find(1);
                $newData->link_image = saveimagefromdataimage($request->userfile);
                $newData->save();
            }

            $newData = hyperLinksSettings::find(1);
            $newData->link_image_size = $request->link_image_size;
            $newData->save();
        }
        if (check_auth_permission(['hyperlink_timed_image'])) {
            $data = (object)[];
            $data->enable = $request->enable_timed_hyperlink_image ? '1' : '0';
            $data->type = $request->timed_hyperlink_image_type;
            $data->image_timer = $request->timed_hyperlink_image_timer;
            $data->days = json_encode($request->days);
            if ($data->type == 'days') {
                $data->start_time = $request->hyperlink_image_start_time;
                $data->end_time = $request->hyperlink_image_end_time;
            } else {
                $timer = $request->timed_hyperlink_image_timer;
                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s', strtotime('+' . $timer . ' minutes', strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

                $data->start_time = $start_time;
                $data->end_time = $end_time;
            }
            update_timed_image_setting('timed_hyperlink_image', $data);

            if ($request->timed_hyperlink_image) {
                $data->timed_hyperlink_image = saveimagefromdataimage($request->timed_hyperlink_image);
                $newImage = images::where('slug', 'timed_hyperlink_image')->first();
                if (isset($newImage->file_name)) {
                    delimg($newImage->file_name);
                }
                $newImage->file_name = saveimagefromdataimage($request->timed_hyperlink_image);
                $newImage->save();
            }
        }
        if (check_auth_permission('hyperlink_text')) {

            $data = (object)[];
            $data->color = $request->links_text_color;
            $data->size_web = $request->text_size;
            $data->bg_color = $request->links_background_color;
            $data->fontfamily = $request->link_text_font_family;
            update_text_details2('hyper_link_text', $data);

            $data = (object)[];
            $data->color = $request->link_color;
            $data->size_web = $request->link_size;
            $data->bg_color = $request->links_background_color;
            $data->fontfamily = $request->link_font_family;
            update_text_details2('hyper_link_link', $data);
        }


        if (check_auth_permission(['hyperlink_text', 'hyperlink_link_option', 'hyperlink_add_new'])) {
            $i = 0;

            if ($request->linktextid) {
                foreach ($request->linktextid as $single) {

                    $newData = hyperLinks::find($single);
                    $newData->link_text = $request->old_linktext[$i] ? $request->old_linktext[$i] : '';
                    $newData->link = $request->old_link[$i] ? $request->old_link[$i] : '';
                    $newData->save();
                    $i++;
                }
            }
            $i = 0;
            if ($request->linktext) {
                foreach ($request->linktext as $single) {
                    $newData = new hyperLinks();
                    $newData->link_text = $request->linktext[$i] ? $request->linktext[$i] : '';
                    $newData->link = $request->link[$i] ? $request->link[$i] : '';
                    $newData->save();
                    $i++;
                }
            }
            if ($request->deleteLinkTextID) {
                $deleteLinkTextID = explode(',', trim($request->deleteLinkTextID, ','));
                foreach ($deleteLinkTextID as $single) {
                    $hyperLinks = hyperLinks::find($single);
                    if ($hyperLinks) {
                        $hyperLinks->delete();
                    }
                }
            }
        }

        $newData = hyperLinksSettings::find(1);
        $newData->show_links = $request->linkswitch ? '1' : '0';
        $newData->save();

        $message = 'Links section has been updated';
        $block = 'hyperlinks_bluebar';

        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->savelinksection != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }

    public function delHyperlink(Request $request)
    {

        if ($request->link_id) {
            $hyperLinks = hyperLinks::find($request->link_id);
            if ($hyperLinks) {
                $hyperLinks->delete();
            }
        }
    }

    public function updateForms(Request $request)
    {
        // dd($request->all());
        if (!check_auth_permission('formssection')) {
            return  redirect('quicksettings')->withError('Access Denied');
        }
        $update_image = (object)[];
        if ($request->userfile) {
            $old_image = images::where('slug', 'form_section_img')->first();
            if (isset($old_image->file_name)) {
                delimg($old_image->file_name);
            }
            $update_image->image = saveimagefromdataimage($request->userfile);
            save_image('form_section_img', $update_image->image);
        }
        save_image('form_section_img', '', $request->link_image_size);

        $form_title_data = (object)[];
        $form_title_data->size_web =  $request->text_size;
        $form_title_data->size_mobile =  $request->text_size;
        $form_title_data->color =  $request->links_text_color;
        $form_title_data->bg_color =  $request->links_background_color;
        $form_title_data->fontfamily =  $request->link_text_font_family;
        update_text_details2('form_section_text', $form_title_data);


        $i = 0;
        if (isset($request->formlinkid) && count($request->formlinkid) > 0) {
            foreach ($request->formlinkid as $single) {
                $newData = formsLinks::find($single);
                $newData->link_text = $request->old_linktext[$i] ? $request->old_linktext[$i] : '';
                $newData->link_forms = $request->old_linkforms[$i] ? $request->old_linkforms[$i] : '';
                // dd($newData);
                $newData->save();
                $i++;
            }
        }
        $i = 0;
        if ($request->linktext) {
            foreach ($request->linktext as $single) {
                if (isset($request->linktext[$i]) && $request->linktext[$i]) {
                    $newData = new formsLinks();
                    $newData->link_text = $request->linktext[$i] ? $request->linktext[$i] : '';
                    $newData->link_forms = $request->linkforms[$i] ? $request->linkforms[$i] : '';
                    $newData->save();
                }
                $i++;
            }
        }

        $formsSettings = formsSettings::find(1);
        $formsSettings->feature_background_color =  $request->feature_background_color;
        $formsSettings->form_section_desc =  $request->form_section_desc;
        // dd($request->form_section_desc);
        $formsSettings->form_section_desc_width =  $request->form_section_desc_width ? $request->form_section_desc_width : '';
        $formsSettings->form_column =  $request->form_link_column ? '1' : '0';
        $formsSettings->save();


        $message = 'Forms section has been updated';
        $block = 'forms_feature';


        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->saveforms_feature != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }

    public function updateDownloadFiles(Request $request)
    {

        if (check_auth_permission('download_text')) {
            $data = (object)[];
            $data->color = $request->download_text_color;
            $data->size_web = $request->download_text_size;
            $data->fontfamily = $request->download_text_font_family;
            update_text_details2('download_text', $data);
        }

        $data = DownloadSetting::first();
        if (!$data) {
            $data = new DownloadSetting;
        }
        $data->override_bg = $request->override_bg == 'on' ? '1' : '0';
        $data->bg_color = $request->bg_color;
        $data->save();

        if (check_auth_permission('downloads_file_question')) {
            $data = (object)[];
            $data->color = $request->question_text_color;
            $data->size_web = $request->question_text_size;
            $data->fontfamily = $request->question_text_font_family;
            update_text_details2('download_question_text', $data);
        }

        if (check_auth_permission(['downloads_file_question', 'download_text'])) {

            if ($_FILES) {
                $total = count($_FILES['download_files']['name']);
                if (!empty($_FILES['download_files']['name']) && count($_FILES['download_files']['name']) > 0) {
                    for ($i = 0; $i < $total; $i++) {
                        if (isset($_FILES['download_files']['name'][$i]) && !empty($_FILES['download_files']['name'][$i])) {
                            $image =  rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $_FILES['download_files']['type'][$i])[1];
                            $sourcePath = $_FILES['download_files']['tmp_name'][$i];
                            $targetPath = "assets/uploads/" . $image;
                            if (move_uploaded_file($sourcePath, $targetPath)) {

                                $newData = new downloadFiles();
                                $newData->title = $_FILES['download_files']['name'][$i];
                                $newData->file =  $image;
                                $newData->file_question = $request->file_question1;
                                $newData->download_text = $request->download_text1;
                                $newData->background_color = $request->$newData->override_bg_color = $request->
                                    /* (Hassan) Adding three more fields (Begin) */$newData->image_size = $request->image_size;
                                $newData->image_position = $request->image_position;
                                /* Adding three more fields (End) */

                                $newData->save();
                            }
                        }
                    }
                }
            }


            if (isset($request->file_id) && count($request->file_id) > 0) {

                $i = 0;
                foreach ($request->file_id as $file_id) {
                    $newData = downloadFiles::find($file_id);
                    if ($newData) {
                        if (isset($request->file_question[$i])) {
                            $newData->file_question = $request->file_question[$i];
                        }
                        if (isset($request->download_text[$i])) {
                            $newData->download_text = $request->download_text[$i];
                        }
                        /* (Hassan) Adding three more fields (Begin) */
                        if (isset($request->edit_image_size[$i])) {
                            $newData->image_size = $request->edit_image_size[$i];
                        }
                        if (isset($request->edit_image_position[$i])) {
                            $newData->image_position = $request->edit_image_position[$i];
                        }
                        /* Adding three more fields (End) */
                        $newData->save();
                    }

                    $i++;
                }
            }
        }
        $message = 'Download section has been updated';
        $block = 'download_files_bluebar';
        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');
        if ($request->savedownloadsection != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }


    public function updateContentBlock(Request $request)
    {
        if (check_auth_permission(['content_block', 'content_block_image'])) {
            if ($request->userfile) {
                $newData = contentBlockSettings::find('1');
                if (isset($newData->block_image)) {
                    delimg($newData->block_image);
                }
                $newData->block_image = saveimagefromdataimage($request->userfile);
                $newData->save();
            }
        }

        if (check_auth_permission(['content_block', 'content_block_subtitle_text_input', 'content_block_description', 'content_block_add_new'])) {
            $contentblocklink = array();
            $i = 0;
            contentBlockLinks::truncate();
            if ($request->title) {
                foreach ($request->title as $single) {
                    $content_image = '';
                    if ($request->new_content_image[$i]) {
                        $content_image = saveimagefromdataimage($request->new_content_image[$i]);
                    } else if (isset($request->content_image[$i]) && $request->content_image[$i]) {
                        $content_image = $request->content_image[$i];
                    }
                    $address_id = 0;
                    if ($request->action_button_link[$i] == "address") {
                        $address_id = $request->action_button_address_id[$i];
                    }
                    $map_address = '';
                    if ($request->action_button_link[$i] == "google_map") {
                        $map_address = $request->action_button_map_address[$i];
                    }
                    $content_image_size = '';
                    if (isset($request->content_image_size[$i]) && $request->content_image_size[$i] !== null) {
                        $content_image_size = $request->content_image_size[$i];
                    }
                    // if(isset($request->content_block_links_id[$i])){
                    //     $newData = contentBlockLinks::find($request->content_block_links_id[$i]);
                    // }else{
                    //     $newData = new contentBlockLinks();
                    // }
                    $newData = new contentBlockLinks();
                    if (isset($request->popup_action_images[$i])) {
                        $newData->popup_images = saveActionButtonImages($request->popup_action_images[$i]);
                    }
                    $newData->title = isset($request->title[$i]) ? $request->title[$i] : '';
                    $newData->description = isset($request->description[$i]) ? str_replace('<p><br></p>', '', $request->description[$i]) : '';
                    $newData->description1 = isset($request->description1[$i]) ? str_replace('<p><br></p>', '', $request->description1[$i]) : '';
                    $newData->description2 = isset($request->description2[$i]) ? str_replace('<p><br></p>', '', $request->description2[$i]) : '';
                    $newData->description3 = isset($request->description3[$i]) ? str_replace('<p><br></p>', '', $request->description3[$i]) : '';
                    $newData->read_more_text = isset($request->read_more_text[$i]) ? $request->read_more_text[$i] : '';
                    $newData->read_less_text = isset($request->read_less_text[$i]) ? $request->read_less_text[$i] : '';
                    $newData->read_more_desc = isset($request->read_more_desc[$i]) ? $request->read_more_desc[$i] : '';

                    $newData->content_title_color = isset($request->content_title_color[$i]) ? $request->content_title_color[$i] : '';
                    $newData->content_title_font_size = isset($request->content_title_font_size[$i]) ? $request->content_title_font_size[$i] : '';
                    $newData->content_title_font_family = isset($request->content_title_font_family[$i]) ? $request->content_title_font_family[$i] : '0';
                    $newData->content_desc_color = isset($request->content_desc_color[$i]) ? $request->content_desc_color[$i] : '';
                    $newData->content_desc_font_size = isset($request->content_desc_font_size[$i]) ? $request->content_desc_font_size[$i] : '';
                    $newData->content_desc_font_family = isset($request->content_desc_font_family[$i]) ? $request->content_desc_font_family[$i] : '0';
                    // $newData->read_more_content_desc_color = isset($request->read_more_content_desc_color[$i]) ? $request->read_more_content_desc_color[$i] : '';
                    // $newData->read_more_content_desc_font_size = isset($request->read_more_content_desc_font_size[$i]) ? $request->read_more_content_desc_font_size[$i] : '';
                    // $newData->read_more_content_desc_font_family = isset($request->read_more_content_desc_font_family[$i]) ? $request->read_more_content_desc_font_family[$i] : '0';
                    if (isset($content_image)) {
                        $newData->content_image = $content_image;
                    } else {
                        $newData->content_image = '';
                    }

                    $newData->content_image_size = $content_image_size;
                    $newData->action_button_active = isset($request->action_button_active[$i]) && $request->action_button_active[$i] == "on" ? '1' : '0';
                    $newData->read_more_active = isset($request->read_more_active[$i]) && $request->read_more_active[$i] == "on" ? '1' : '0';
                    $newData->action_button_discription = $request->action_button_discription[$i] ? $request->action_button_discription[$i] : '';
                    $newData->action_button_discription_color = $request->action_button_discription_color[$i] ? $request->action_button_discription_color[$i] : '';
                    $newData->action_button_bg_color = $request->action_button_bg_color[$i] ? $request->action_button_bg_color[$i] : '';
                    $newData->action_button_link = $request->action_button_link[$i] ? $request->action_button_link[$i] : '';
                    $newData->action_button_link_text = $request->action_button_link_text[$i] ? $request->action_button_link_text[$i] : '';
                    $newData->action_button_custom_forms = $request->action_button_customforms[$i] ? $request->action_button_customforms[$i] : '';
                    $newData->action_button_event = isset($request->action_button_event[$i]) ? $request->action_button_event[$i] : '';
                    $newData->action_button_phone_no_calls = $request->action_button_phone_no_calls[$i] ? $request->action_button_phone_no_calls[$i] : '';
                    $newData->action_button_phone_no_sms = $request->action_button_phone_no_sms[$i] ? $request->action_button_phone_no_sms[$i] : '';
                    $newData->action_button_textpopup = $request->action_button_textpopup[$i] ? $request->action_button_textpopup[$i] : '';
                    $newData->action_button_action_email = $request->action_button_action_email[$i] ? $request->action_button_action_email[$i] : '';
                    $newData->action_button_address_id = $address_id;
                    $newData->action_button_map_address = $map_address;
                    if (isset($request->audio_file[$i])) {
                        $filename = rand(9, 9999) . date('d-m-Y') . '.' . explode('/', $request->audio_file[$i]->getClientMimeType())[1];
                        $request->audio_file[$i]->move("assets/uploads/", $filename);
                        $newData->action_button_action_audio = $filename;
                    }
                    if (isset($request->action_button_audio_icon_feature[$i])) {
                        // dd($request->action_button_audio_icon_feature[$i]);
                        $file = $request->action_button_audio_icon_feature[$i];
                        $file_name = $file->getClientOriginalName();

                        $file_ext = $file->extension();
                        $fileInfo = $request->action_button_audio_icon_feature[$i]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $newData->action_button_audio_icon_feature = uploadimg($file, null);
                    }

                    if (isset($request->cb_video_file[$i])) {

                        $file = $request->cb_video_file[$i];
                        $file_name = $file->getClientOriginalName();
                        $file_ext = $file->extension();
                        $fileInfo = $request->cb_video_file[$i]->path();
                        $file = [
                            "name" => $file_name,
                            "type" => $file_ext,
                            "tmp_name" => $fileInfo,
                            "error" => 0,
                            "size" => $file->getSize()
                        ];
                        $newData->cb_action_button_video = uploadimg($file, null);
                    } else {
                        $newData->cb_action_button_video = '';
                    }
                    $newData->save();
                    $i++;
                }
            }
        }

        if (check_auth_permission(['content_block_timed_image'])) {
            $data = (object)[];
            $data->enable = $request->enable_timed_content_block_image ? '1' : '0';
            $data->type = $request->content_block_image_type;
            $data->image_timer = $request->content_block_image_timer;
            if ($data->type == 'days') {
                $data->start_time = $request->content_block_image_start_time;
                $data->end_time = $request->content_block_image_end_time;
            } else {
                $timer = $request->content_block_image_timer;
                $start_time = new DateTime(date('Y-m-d H:i:s'));
                $start_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime(date('Y-m-d H:i:s', strtotime('+' . $timer . ' minutes', strtotime(date('H:i:s')))));
                $end_time->setTimezone(new DateTimeZone(getFrontDataTimeZone()));

                $data->start_time = $start_time;
                $data->end_time = $end_time;
            }
            $data->days = json_encode($request->days);

            update_timed_image_setting('timed_content_block_image', $data);


            if ($request->timed_content_block_image) {
                $oldimage = images::where('slug', 'timed_content_block_image')->first();
                if (isset($oldimage->file_name)) {
                    delimg($oldimage->file_name);
                }
                save_image('timed_content_block_image', saveimagefromdataimage($request->timed_content_block_image));
            }
        }

        if (check_auth_permission('content_block_image')) {
            $newData = contentBlockSettings::find(1);
            if ($request->userfile) {
                if (isset($newData->block_image)) {
                    delimg($newData->block_image);
                }
                $newData->block_image = saveimagefromdataimage($request->userfile);
            }
            $newData->block_image_size = $request->content_block_image_size;
            $newData->block_subimage_size = $request->content_block_subimage_size ? $request->content_block_subimage_size : '';
            $newData->save();
        }
        if (check_auth_permission('content_block')) {
            $newData = contentBlockSettings::find(1);
            $newData->use_generic = $request->use_generic_content_block_setting ? '1' : '0';
            $newData->content_block_background = $request->content_block_background;
            $newData->save();
        }
        if (check_auth_permission('content_block_subtitle_text_input')) {
            $data = (object)[];
            $data->color = $request->generic_cb_subtitle_color;
            $data->size_web = $request->generic_cb_subtitle_fontsize;
            $data->fontfamily = $request->generic_cb_subtitle_fontfamily;
            update_text_details2('generic_content_block_subtitle', $data);
        }

        if (check_auth_permission('content_block_description')) {
            $data = (object)[];
            $data->color = $request->generic_cb_desc_color;
            $data->size_web = $request->generic_cb_desc_fontsize;
            $data->fontfamily = $request->generic_cb_desc_fontfamily;
            update_text_details2('generic_content_block_desc', $data);
        }

        $message = 'Content block has been updated';
        $block = 'content_block_bluebar';

        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->savecontentblock != 'save') {
            return redirect('reminders')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }
    public function updateTitleBanners(Request $request)
    {

        if (check_auth_permission(['title_banners', 'title_banner_text_input'])) {
            if (isset($_POST['reset_title_banners'])) {


                $newData = (object)[];
                $newData->text = $request->set_hours_title_text;
                $newData->color = $request->reset_title_color;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('set_hours_title', $newData);


                $newData = (object)[];
                $newData->text = $request->schedule_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('schedule_title', $newData);


                $newData = (object)[];
                $newData->text = $request->contentblock_title;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('content_block_title', $newData);


                $newData = (object)[];
                $newData->text = $request->download_title;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('download_title', $newData);


                $newData = (object)[];
                $newData->text = $request->faq_title;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('faq_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_posts_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('gallery_posts_title', $newData);

                $newData = (object)[];
                $newData->text = $request->attenhub_title_text;
                $newData->size_web = $request->attenhub_title_fontsize;
                $newData->size_mobile = $request->attenhub_title_fontsize_mobile;
                $newData->color = $request->attenhub_title_color;
                $newData->bg_color = $request->attenhub_title_block_color;
                $newData->fontfamily = $request->attenhub_title_font_family;
                update_text_details2('attenhub_title',$newData);


                $newData = (object)[];
                $newData->text = $request->gallery_slider_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('gallery_slider_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_videos_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('gallery_videos_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_tiles_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('gallery_tiles_title', $newData);


                $newData = (object)[];
                $newData->text = $request->links_title;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('links_title', $newData);


                $newData = (object)[];
                $newData->text = $request->news_posts_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('news_posts_title', $newData);


                $newData = (object)[];
                $newData->text = $request->reviews_staff_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('reviews_staff_title', $newData);

                $newData = (object)[];
                $newData->text = $request->staff_products_promos_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('staff_products_promos_title', $newData);


                $newData = (object)[];
                $newData->text = $request->news_feed_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('news_feed_title', $newData);


                $newData = (object)[];
                $newData->text = $request->contact_info_blocks_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('contact_info_block_title', $newData);


                $newData = (object)[];
                $newData->text = $request->seo_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('seo_title', $newData);


                $newData = (object)[];
                $newData->text = $request->blog_title_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('blog_title', $newData);


                $newData = (object)[];
                //$newData->text = $request->form_text;
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('form_section_title', $newData);

                $newData = (object)[];
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('reset_title', $newData);

                $i = 0;
                foreach ($request->contacttitleid as $single) {
                    $newData = contactFormTitle::find($single);
                    //$newData->text = $request->contacttitle[$i];
                    $newData->size_web = $request->reset_title_fontsize;
                    $newData->size_mobile = $request->reset_title_fontsize_mobile;
                    $newData->color = $request->reset_title_color;
                    $newData->bg_color = $request->reset_title_block_color;
                    $newData->fontfamily = $request->reset_title_font_family;
                    $newData->save();
                    $i++;
                }
            } else {
                $newData = (object)[];
                $newData->text = $request->set_hours_title_text;
                $newData->color = $request->set_hours_title_color;
                $newData->size_web = $request->set_hours_title_fontsize;
                $newData->size_mobile = $request->set_hours_title_fontsize_mobile;
                $newData->bg_color = $request->set_hours_title_block_color;
                $newData->fontfamily = $request->set_hours_title_font_family;
                update_text_details2('set_hours_title', $newData);


                $newData = (object)[];
                $newData->text = $request->schedule_title_text;
                $newData->size_web = $request->schedule_title_fontsize;
                $newData->size_mobile = $request->schedule_title_fontsize_mobile;
                $newData->color = $request->schedule_title_color;
                $newData->bg_color = $request->schedule_title_block_color;
                $newData->fontfamily = $request->schedule_title_font_family;
                update_text_details2('schedule_title', $newData);


                $newData = (object)[];
                $newData->text = $request->contentblock_title;
                $newData->size_web = $request->contentblock_title_font_size;
                $newData->size_mobile = $request->contentblock_title_font_size_mobile;
                $newData->color = $request->contentblock_title_color;
                $newData->bg_color = $request->contentblock_title_block_color;
                $newData->fontfamily = $request->contentblock_title_font_family;
                update_text_details2('content_block_title', $newData);


                $newData = (object)[];
                $newData->text = $request->download_title;
                $newData->size_web = $request->download_title_font_size;
                $newData->size_mobile = $request->download_title_font_size_mobile;
                $newData->color = $request->download_title_color;
                $newData->bg_color = $request->download_title_block_color;
                $newData->fontfamily = $request->download_title_font_family;
                update_text_details2('download_title', $newData);


                $newData = (object)[];
                $newData->text = $request->faq_title;
                $newData->size_web = $request->faq_title_font_size;
                $newData->size_mobile = $request->faq_title_font_size_mobile;
                $newData->color = $request->faq_title_color;
                $newData->bg_color = $request->faq_title_back_color;
                $newData->fontfamily = $request->faq_title_font_family;
                update_text_details2('faq_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_posts_title_text;
                $newData->size_web = $request->gallery_posts_title_fontsize;
                $newData->size_mobile = $request->gallery_posts_title_fontsize_mobile;
                $newData->color = $request->gallery_posts_title_color;
                $newData->bg_color = $request->gallery_posts_title_block_color;
                $newData->fontfamily = $request->gallery_posts_title_font_family;
                update_text_details2('gallery_posts_title', $newData);

                $newData = (object)[];
                $newData->text = $request->attenhub_title_text;
                $newData->size_web = $request->attenhub_title_font_size_web;
                $newData->size_mobile = $request->attenhub_title_font_size_mobile;
                $newData->color = $request->attenhub_title_color;
                $newData->bg_color = $request->attenhub_title_background;
                $newData->fontfamily = $request->attenhub_title_font;
                update_text_details2('attenhub_title',$newData);


                $newData = (object)[];
                $newData->text = $request->gallery_slider_title_text;
                $newData->size_web = $request->gallery_slider_title_fontsize;
                $newData->size_mobile = $request->gallery_slider_title_fontsize_mobile;
                $newData->color = $request->gallery_slider_title_color;
                $newData->bg_color = $request->gallery_slider_title_block_color;
                $newData->fontfamily = $request->gallery_slider_title_font_family;
                update_text_details2('gallery_slider_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_videos_title_text;
                $newData->size_web = $request->gallery_videos_title_fontsize;
                $newData->size_mobile = $request->gallery_videos_title_fontsize_mobile;
                $newData->color = $request->gallery_videos_title_color;
                $newData->bg_color = $request->gallery_videos_title_block_color;
                $newData->fontfamily = $request->gallery_videos_title_font_family;
                update_text_details2('gallery_videos_title', $newData);


                $newData = (object)[];
                $newData->text = $request->gallery_tiles_title_text;
                $newData->size_web = $request->gallery_tiles_title_font_size;
                $newData->size_mobile = $request->gallery_tiles_title_font_size_mobile;
                $newData->color = $request->gallery_tiles_title_color;
                $newData->bg_color = $request->gallery_tiles_title_background_color;
                $newData->fontfamily = $request->gallery_tiles_title_font_family;
                update_text_details2('gallery_tiles_title', $newData);


                $newData = (object)[];
                $newData->text = $request->links_title;
                $newData->size_web = $request->links_title_font_size;
                $newData->size_mobile = $request->links_title_font_size_mobile;
                $newData->color = $request->links_title_color;
                $newData->bg_color = $request->links_title_back_color;
                $newData->fontfamily = $request->links_title_font_family;
                update_text_details2('links_title', $newData);


                $newData = (object)[];
                $newData->text = $request->news_posts_title_text;
                $newData->size_web = $request->news_posts_title_fontsize;
                $newData->size_mobile = $request->news_posts_title_fontsize_mobile;
                $newData->color = $request->news_posts_title_color;
                $newData->bg_color = $request->news_posts_title_block_color;
                $newData->fontfamily = $request->news_posts_title_font_family;
                update_text_details2('news_posts_title', $newData);


                $newData = (object)[];
                $newData->text = $request->reviews_staff_title_text;
                $newData->size_web = $request->reviews_staff_title_fontsize;
                $newData->size_mobile = $request->reviews_staff_title_fontsize_mobile;
                $newData->color = $request->reviews_staff_title_color;
                $newData->bg_color = $request->reviews_staff_title_block_color;
                $newData->fontfamily = $request->reviews_staff_title_font_family;
                update_text_details2('reviews_staff_title', $newData);

                $newData = (object)[];
                $newData->text = $request->staff_products_promos_title_text;
                $newData->size_web = $request->staff_products_promos_title_fontsize;
                $newData->size_mobile = $request->staff_products_promos_title_fontsize_mobile;
                $newData->color = $request->staff_products_promos_title_color;
                $newData->bg_color = $request->staff_products_promos_title_block_color;
                $newData->fontfamily = $request->staff_products_promos_title_font_family;
                update_text_details2('staff_products_promos_title', $newData);


                $newData = (object)[];
                $newData->text = $request->news_feed_title_text;
                $newData->size_web = $request->news_feed_title_fontsize;
                $newData->size_mobile = $request->news_feed_title_fontsize_mobile;
                $newData->color = $request->news_feed_title_color;
                $newData->bg_color = $request->news_feed_title_background_color;
                $newData->fontfamily = $request->news_feed_title_font_family;
                update_text_details2('news_feed_title', $newData);


                $newData = (object)[];
                $newData->text = $request->contact_info_blocks_title_text;
                $newData->size_web = $request->contact_info_blocks_title_fontsize;
                $newData->size_mobile = $request->contact_info_blocks_title_fontsize_mobile;
                $newData->color = $request->contact_info_blocks_title_color;
                $newData->bg_color = $request->contact_info_blocks_title_block_color;
                $newData->fontfamily = $request->contact_info_blocks_title_font_family;
                update_text_details2('contact_info_block_title', $newData);


                $newData = (object)[];
                $newData->text = $request->seo_title_text;
                $newData->size_web = $request->seo_title_font_size_web;
                $newData->size_mobile = $request->seo_title_font_size_mobile;
                $newData->color = $request->seo_title_color;
                $newData->bg_color = $request->seo_title_background;
                $newData->fontfamily = $request->seo_title_font;
                update_text_details2('seo_title', $newData);


                $newData = (object)[];
                $newData->text = $request->blog_title_text;
                $newData->size_web = $request->blog_title_font_size_web;
                $newData->size_mobile = $request->blog_title_font_size_mobile;
                $newData->color = $request->blog_title_color;
                $newData->bg_color = $request->blog_title_background;
                $newData->fontfamily = $request->blog_title_font;
                update_text_details2('blog_title', $newData);


                $newData = (object)[];
                $newData->text = $request->form_text;
                $newData->size_web = $request->form_text_size;
                $newData->size_mobile = $request->form_size_mobile;
                $newData->color = $request->form_text_color;
                $newData->bg_color = $request->form_background_color;
                $newData->fontfamily = $request->form_text_font_family;
                update_text_details2('form_section_title', $newData);

                $newData = (object)[];
                $newData->size_web = $request->reset_title_fontsize;
                $newData->size_mobile = $request->reset_title_fontsize_mobile;
                $newData->color = $request->reset_title_color;
                $newData->bg_color = $request->reset_title_block_color;
                $newData->fontfamily = $request->reset_title_font_family;
                update_text_details2('reset_title', $newData);

                $i = 0;
                foreach ($request->contacttitleid as $single) {
                    $newData = contactFormTitle::find($single);
                    $newData->text = $request->contacttitle[$i];
                    $newData->size_web = $request->contacttitlefontsize[$i];
                    $newData->size_mobile = $request->contacttitlefontsizemobile[$i];
                    $newData->color = $request->contacttitlecolor[$i];
                    $newData->bg_color = $request->contacttitleblockcolor[$i];
                    $newData->fontfamily = $request->font_family[$i];
                    $newData->save();
                    $i++;
                }
            }
        }

        $message = 'Titles and banners has been updated';
        $block = 'title_banners_bluebar';

        checkSendNotification('Frontend', $message, 'frontend_notifications', 'frontend_notification_email');

        if ($request->save_titles_banners != 'save') {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        } else {
            //return redirect('editfrontend?block='.$block)->withSuccess($message);
            return redirect('editfrontend')->withSuccess($message);
        }
    }

    public function delfile(Request $request)
    {
        if ($request->imgname) {

            if (isset($request->imgname)) {
                delimg($request->imgname);
            }
            downloadFiles::where('file', $request->imgname)->delete();
        }
    }

    public function removeActionVideo(Request $request)
    {
        if ($request->data_id && $request->data_file && $request->data_type) {

            if (isset($request->data_file)) {
                delimg($request->data_file);
            }

            switch ($request->data_type) {
                case 'review_left_action_button_video':
                    reviewStaff::where('id', $request->data_id)->update(['left_action_button_video' => '']);
                    # code...
                    break;

                case 'review_right_action_button_video':
                    reviewStaff::where('id', $request->data_id)->update(['right_action_button_video' => '']);
                    # code...
                    break;
                case 'cb_action_button_video':
                    contentBlockLinks::where('id', $request->data_id)->update(['cb_action_button_video' => '']);
                    # code...
                    break;
            }
        }
    }

    public function frontSetting(Request $request)
    {
        $frontsetting = frontendSetting::first();
        if ($request->name == 'all_feature_enable_on_edit') {
            $frontsetting->all_feature_enable_on_edit = $request->value;
            $frontsetting->save();
        }

        if ($request->name == 'all_feature_for_edit_website') {
            $frontsetting->all_feature_for_edit_website = $request->value;
            $frontsetting->save();
        }
        if ($request->name == 'active_feature_enable_on_edit') {
            $frontsetting->active_feature_enable_on_edit = $request->value;
            $frontsetting->save();
        }
    }

    public function updateTitleSetting(Request $request)
    {

        if ($request->id && $request->slug == 'contact_forms') {
            $title = contactFormTitle::find($request->id);
            $title->enable_theme_bg = $request->value ? '1' : '0';
            $title->save();
        } else {
            $title = TitleBannerSetting::where('title_slug', $request->slug)->first();
            if ($title) {
                $title->enable_theme_bg = $request->value ? '1' : '0';
                $title->save();
            }
        }
    }

    public function removeActionButton(Request $request)
    {
        if ($request->id) {
            actionButtons::where('id', $request->id)->delete();
        }
    }

    public function deletereviewvideo(Request $request)
    {
        if (!check_auth_permission('review_staff') && isset($_GET['type'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        $newData = reviewStaff::find($request->id);
        if (isset($newData->video)) {
            delimg($newData->video);
        }
        if (isset($newData->video)) {
            delimg($newData->video);
        }
        if ($_GET['type'] == 'left') {
            $column = 'left_action_button_video';
        } else {
            $column = 'right_action_button_video';
        }
        $deleted = reviewStaff::find($request->id);
        $deleted->$column = null;
        // dd($deleted);
        $deleted->save();
        $message = 'Reviews Posting video has been deleted';

        checkSendNotification('Frontend', $message);

        return redirect('editfrontend')->withSuccess($message);
    }

    public function updateActionButton(Request $request)
    {
        $i = 0;
        foreach ($request->action_button_discription as $row) {
            $data = (object)[];
            $data->text = $request->action_button_discription[$i];
            $data->action_type = $request->action_button_link[$i];
            $data->address_id = $request->action_button_address_id[$i];
            $data->map_address = $request->action_button_map_address[$i];
            $data->custom_form_id = $request->action_button_customforms[$i];
            $data->link = $request->action_button_link_text[$i];
            $data->action_button_phone_no_sms = $request->action_button_phone_no_sms[$i];
            $data->action_button_phone_no_calls = $request->action_button_phone_no_calls[$i];
            $data->action_button_textpopup = $request->action_button_textpopup[$i];
            $data->action_button_action_email = $request->action_button_action_email[$i];
            if (empty($data->text) && empty($data->action_type) && empty($data->address_id) && empty($data->map_address) && empty($data->custom_form_id) && empty($data->link) && empty($data->phone_no_sms) && empty($data->phone_no_calls) && empty($data->textpopup) && empty($data->action_email)) {
                continue; // Skip to the next iteration
            }
            // if(isset($request->audio_file[$i]))
            // $data->audio_file = $request->audio_file[$i];
            if (isset($request->action_button_audio[$i])) {
                $file = $request->action_button_audio[$i];
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->extension();
                $fileInfo = $request->action_button_audio[$i]->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_audio = uploadimg($file, null);
            }
            if (isset($request->action_button_audio_icon_feature[$i])) {
                $file = $request->action_button_audio_icon_feature[$i];
                $file_name = $file->getClientOriginalName();

                $file_ext = $file->extension();
                $fileInfo = $request->action_button_audio_icon_feature[$i]->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_audio_icon_feature = uploadimg($file, null);
            }
            if (isset($request->action_video[$i])) {
                $file = $request->action_video[$i];
                $file_name = $file->getClientOriginalName();
                $file_ext = $file->extension();
                $fileInfo = $request->action_video[$i]->path();
                $file = [
                    "name" => $file_name,
                    "type" => $file_ext,
                    "tmp_name" => $fileInfo,
                    "error" => 0,
                    "size" => $file->getSize()
                ];
                $data->action_button_video  = uploadimg($file, null);
            }
            learning_center_update_action_button($request->featureSlug, $request->slug[$i], $data);
            $i++;
        }
        $message = 'Build Site Content Updated';

        checkSendNotification('Frontend', $message);

        return redirect('editfrontend')->withSuccess($message);
        exit;
    }

    public function addCategoryView()
    {
        if (!check_auth_permission(['blog-category'])) {
            return  redirect('dashboard')->withError('Access Denied');
        }
        return view('admin.businesscategory.add')->with($this->data);
    }

    public function saveBusinessCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $newCategory = new BusinessCategory;
        $newCategory->name = $request->name;
        $newCategory->save();
        $message = 'New Category added';

        checkSendNotification('Frontend', $message);

        return redirect('editfrontend')->withSuccess($message);
    }

    public function updateBusinessCoach(Request $request)
    {
        $data = (object)[];
        $data->text = $request->welcome_message;
        update_text_details2('welcome', $data);
        $data = (object)[];
        $data->text = $request->enfohub_news;
        update_text_details2('news', $data);
        $message = 'Business Coach updated';


        $i = 0;
        if (isset($request->action_button_discription)) {
            foreach ($request->action_button_discription as $row) {
                $data = (object)[];

                // $exist =  LearningCenterActionButton::where('slug' , $request->slug[$i])->first();
                $data->text = $request->action_button_discription[$i];
                $data->action_type = $request->action_button_link[$i];
                $data->address_id = $request->action_button_address_id[$i];
                $data->map_address = $request->action_button_map_address[$i];
                $data->custom_form_id = $request->action_button_link[$i] == 'customforms' ? $request->action_button_customforms[$i] : null;
                $data->link = $request->action_button_link_text[$i];
                $data->action_button_phone_no_sms = $request->action_button_phone_no_sms[$i];
                $data->action_button_phone_no_calls = $request->action_button_phone_no_calls[$i];
                $data->action_button_textpopup = $request->action_button_textpopup[$i];
                $data->action_button_action_email = $request->action_button_action_email[$i];
                if (empty($data->text) && empty($data->action_type) && empty($data->address_id) && empty($data->map_address) && empty($data->custom_form_id) && empty($data->link) && empty($data->phone_no_sms) && empty($data->phone_no_calls) && empty($data->textpopup) && empty($data->action_email)) {
                    continue; // Skip to the next iteration
                }

                if (isset($request->action_button_audio[$i])) {
                    $file = $request->action_button_audio[$i];
                    $file_name = $file->getClientOriginalName();

                    $file_ext = $file->extension();
                    $fileInfo = $request->action_button_audio[$i]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    // dd(uploadimg($file,null));
                    $data->action_button_audio = uploadimg($file, null);
                }


                if (isset($request->audio_file[$i]))
                    $data->audio_file = $request->audio_file[0];

                if (isset($request->action_button_audio_icon_feature)) {
                    $file = $request->action_button_audio_icon_feature;
                    $file_name = $file->getClientOriginalName();

                    $file_ext = $file->extension();
                    $fileInfo = $request->action_button_audio_icon_feature->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $data->action_button_audio_icon_feature = uploadimg($file, null);
                }
                if (isset($request->action_video[$i])) {
                    $file = $request->action_video[$i];
                    $file_name = $file->getClientOriginalName();
                    $file_ext = $file->extension();
                    $fileInfo = $request->action_video[$i]->path();
                    $file = [
                        "name" => $file_name,
                        "type" => $file_ext,
                        "tmp_name" => $fileInfo,
                        "error" => 0,
                        "size" => $file->getSize()
                    ];
                    $data->action_button_video  = uploadimg($file, null);
                }
                learning_center_update_action_button($request->featureSlug[0], $request->slug[$i], $data);
                $i++;
            }
        }
        checkSendNotification('Frontend', $message);

        return redirect('editfrontend')->withSuccess($message);
    }

    public function deleteActionButton($id)
    {
        $button = LearningCenterActionButton::findOrFail($id);
        if ($button->delete()) {
            return redirect()->back()->with('success', 'Button deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the button');
        }
    }
    public function editbusinesscoachcategory($id = null)
    {
        $category = BusinessCategory::where('id', $id)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        $this->data['category'] = $category;

        return view('admin.businesscategory.edit', $this->data);
    }

    public function openform(Request $request)
    {
        $num2 = rand(1,9);
        $num3 = rand(1,9);
        $result = $num2+$num3;
        // echo '<script>console.log("'.$result.'"); </script>'; 

        Session::put(['contdigicaptcha' => $result]);
        Cache::put('contdigicaptcha', $result, now()->addMinutes(10));
        $is_attendance = $request->is_attendance;
        $formData = customForms::with('actionButtons')->where('encoded_id', $request->id)->where('active', true)->first();
        if ($formData) {
            return response()->json([
                'modal' => view('components.form-modal', ['single' => $formData,'num2' => $num2, 'num3' => $num3, 'result' => $result, 'is_attendance' => $is_attendance])->render()
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function unsubscribeform(Request $request)
    {
         if (!isset($request->key) && !isset($request->email) && isset($request->id)) {
            $formData = customForms::with('actionButtons')->where('encoded_id', $request->id)->where('id','!=',8)->where('active', true)->first();
            if ($formData) {
                $num2 = rand(1, 9);
                $num3 = rand(1, 9);
                $result = $num2 + $num3;
                Session::put('contdigicaptcha', $result);
                return response()->json([
                    'modal' => view('components.form-modal', ['single' => $formData, 'num2' => $num2, 'num3' => $num3, 'result' => $result])->render()
                ]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            $data = UnsubscribeEmail::where(['key' => $request->key, 'email' => $request->email])->first();
            if ($data) {
                $num2 = rand(1, 9);
                $num3 = rand(1, 9);
                $result = $num2 + $num3;
                Session::put('contdigicaptcha', $result);
                $formData = customForms::with('actionButtons')->where('encoded_id', $request->id)->where('active', true)->first();
                if ($formData) {
                    return response()->json([
                        'modal' => view('components.form-modal', ['single' => $formData, 'num2' => $num2, 'num3' => $num3, 'result' => $result])->render()
                    ]);
                } else {
                    return response()->json(['success' => false]);
                }
            } else {
                return false;
            }
        }
    }
    
    public function removeFormBtn(Request $request)
    {
        if(isset($request->id))
        {
            $btn = actionButtons::where('id',$request->id)->first();
            if($btn)
            {
                $btn->delete();
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false]);
    }
}
