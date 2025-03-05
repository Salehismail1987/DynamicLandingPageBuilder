<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FontFamily;
use App\Models\ImageGalleryCategory;
use App\Models\SuperAdminMessages;
use App\Models\NotificationSettings;
use App\Models\BusinessInfo;
use App\Models\ContactInfo;
use App\Models\socialMedia;
use App\Models\icons;
use App\Models\timeZones;
use App\Models\siteSettings;
use App\Models\User;
use App\Models\userRolls;
use App\Models\addresses;
use App\Models\textDetails;
use App\Models\permissions;
use App\Models\rolePermissions;
use App\Models\actionButtons;
use App\Models\customForms;
use App\Models\customUserForm;
use App\Models\frontSections;
use App\Models\oneStepImages;
use App\Models\images;
use App\Models\timedImagesSetting;
use App\Models\alertPopupSetting;
use App\Models\newsFeed;
use App\Models\imageGallery;
use App\Models\newsFeedSetting;
use App\Models\newsPosts;
use App\Models\newsPostSettings;
use App\Models\headerImages;
use App\Models\headerSlider;
use App\Models\audioFiles;
use App\Models\reviewSettings;
use App\Models\reviewStaff;
use App\Models\faqSettings;
use App\Models\faqs;
use App\Models\hyperLinksSettings;
use App\Models\hyperLinks;
use App\Models\formsSettings;
use App\Models\formsLinks;
use App\Models\downloadFiles;
use App\Models\contentBlockSettings;
use App\Models\contentBlockLinks;
use App\Models\contactFormTitle;
use App\Models\setHoursSettings;
use App\Models\setHours;
use App\Models\rotatingScheduleSettings;
use App\Models\rotatingSchedule;
use App\Models\notifications;
use App\Models\blogCategories;
use App\Models\Blog;
use App\Models\blogSettings;
use App\Models\galleriesSettings;
use App\Models\galleryPost;
use App\Models\galleryPostImage;
use App\Models\gallerySlider;
use App\Models\galleryVideo;
use App\Models\galleryTiles;
use App\Models\imageCategories;
use App\Models\CrmSetting;
use App\Models\EmailPost;
use App\Models\ScheduleEmail;
use App\Models\CustomScheduleEmail;
use App\Models\ScheduleEmailContact;
use App\Models\EmailList;
use App\Models\EmailListImage;
use App\Models\ContactGroup;
use App\Models\EmailPostImage;
use App\Models\EmailPostStarter;
use App\Models\EmailPostStarterImage;
use App\Models\ContactGroupEmail;
use App\Models\ContactDatabase;
use App\Models\UnsubscribeUserForm;
use App\Models\customFormsSettings;
use App\Models\contactForms;
use App\Models\contactBoxSettings;
use App\Models\seoSettings;
use App\Models\Reminder;
use App\Models\menu;
use App\Models\footerSettings;
use DB;
use Session;
use Hash;

class syncController extends Controller
{
    
    public function sync()
    {
        
        $OldfrontendData = DB::connection('mysqlOld')->table('frontend')->first();
        $OldDBDataExt = DB::connection('mysqlOld')->table('frontend_extended')->first();

        $reminders = User::all();
        if(!(count($reminders)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('admin')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new User();
                    $newData->id = $oldData->id;
                    $newData->user_role = $oldData->userrole;
                    $newData->email = $oldData->email;
                    $newData->password = Hash::make($oldData->password);
                    $newData->name = $oldData->first_name.' '.$oldData->last_name;
                    $newData->photo = $oldData->photo;
                    $newData->admin_type = $oldData->admin_type;
                    $newData->save();
                }
            }
        }

        $reminders = Reminder::all();
        if(!(count($reminders)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('reminders')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new Reminder();
                    $newData->id = $oldData->id;
                    $newData->title = $oldData->title;
                    $newData->message = $oldData->message;
                    $newData->type = $oldData->type;
                    $newData->datetime = $oldData->datetime;
                    $newData->status = $oldData->status;
                    $newData->save();
                }
            }
        }
        

        $textDetails = textDetails::all();
        if(!(count($textDetails)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('text_details')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new textDetails();
                    $newData->id = $oldData->id;
                    $newData->slug = $oldData->slug;
                    $newData->text = $oldData->text;
                    $newData->size_web = $oldData->size_web;
                    $newData->size_mobile = $oldData->size_mobile;
                    $newData->color = $oldData->color;
                    $newData->bg_color = $oldData->bg_color;
                    $newData->fontfamily = $oldData->fontfamily;
                    $newData->save();
                }
            }
            
            $newData = new textDetails();
            $newData->slug = "social_media_icon";
            $newData->text = "";
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->social_icon_color;
            $newData->bg_color = $OldfrontendData->social_icon_block_color;
            $newData->fontfamily = 0;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','seo_block_text_color')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "seo_block_text_color";
            $newData->text = $OldDBDataExt->seo_block_text;
            $newData->size_web = $OldDBDataExt->seo_block_text_font_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->seo_block_text_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->seo_block_text_font;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','menu_blog_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "menu_blog_title";
            $newData->text =$OldDBDataExt->blog_title_text;
            $newData->size_web = $OldDBDataExt->blog_title_font_size_web;
            $newData->size_mobile = $OldDBDataExt->blog_title_font_size_mobile;
            $newData->color = $OldDBDataExt->blog_title_color;
            $newData->bg_color = $OldDBDataExt->blog_title_background;
            $newData->fontfamily = $OldDBDataExt->blog_title_font;
            $newData->save();
        }
        $image = images::where('slug','alert_banner_logo')->get()->toArray();
       
        if(!(count($image)>0)){
         
            //if($OldDBData->timed_popup_image){
                $newImage = new images();
                $newImage->slug = "alert_banner_logo";
                $newImage->file_name = $OldDBDataExt->alert_banner_logo;
                $newImage->max_width = $OldDBDataExt->alert_banner_logo_width_web;
                $newImage->min_width = $OldDBDataExt->alert_banner_logo_width_mobile;
                
                $newImage->save();
            //}
        }

        

        $textDetails = textDetails::where('slug','header_address_title_2')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_address_title_2";
            $newData->text = $OldfrontendData->header_address_title_2;
            $newData->size_web = $OldfrontendData->header_address_title_size_2;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->header_address_title_color_2;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->header_address_2_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','popup_menu_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "popup_menu_text";
            $newData->text ="";
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->popup_menu_text_color;
            $newData->bg_color = $OldfrontendData->popup_menu_background_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_text_7_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_text_7_text";
            $newData->text =$OldfrontendData->header_text_7_text;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_text_7_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_text_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_text_title";
            $newData->text =$OldfrontendData->header_text_title;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_text_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','popup_menu_text_hover')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "popup_menu_text_hover";
            $newData->text ="";
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->popup_menu_text_hover_color;
            $newData->bg_color = "";
            $newData->fontfamily = 0;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','contact_address_title')->get()->toArray();
        $oldData = DB::connection('mysqlOld')->table('bisniessinfo')->first();
      
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "contact_address_title";
            $newData->text = $oldData->address_for_map;
            $newData->size_web =  '';
            $newData->size_mobile =  '';
            $newData->color = "";
            $newData->bg_color =  '';
            $newData->fontfamily =  0;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','blog_instruction')->get()->toArray();
        $oldData = DB::connection('mysqlOld')->table('text_details')->where('slug','blog_instruction')->first();
      
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "blog_instruction";
            $newData->text = $oldData->text;
            $newData->size_web =  $oldData->size_web;
            $newData->size_mobile =  $oldData->size_mobile;
            $newData->color = $oldData->color;
            $newData->bg_color =  $oldData->bg_color;
            $newData->fontfamily =  $oldData->fontfamily ? $oldData->fontfamily :0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','blog_page_instruction')->get()->toArray();
        $oldData = DB::connection('mysqlOld')->table('text_details')->where('slug','blog_page_instruction')->first();
      
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "blog_page_instruction";
            $newData->text = $oldData->text;
            $newData->size_web =  $oldData->size_web;
            $newData->size_mobile =  $oldData->size_mobile;
            $newData->color = $oldData->color;
            $newData->bg_color =  $oldData->bg_color;
            $newData->fontfamily =  $oldData->fontfamily ? $oldData->fontfamily :0;
            $newData->save();
        }
          
        $front_family = FontFamily::getAllFontFamily();
        if(!(count($front_family)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('font_family')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new FontFamily();
                    $newData->id = $oldData->id;
                    $newData->name = $oldData->name;
                    $newData->value = $oldData->value;
                    $newData->display_order = $oldData->display_order;
                    $newData->save();
                }
            }
        }

        
        $ImageCategories = ImageGalleryCategory::all();
        if(!(count($ImageCategories)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('image_gallery_category')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new ImageGalleryCategory();
                    $newData->id = $oldData->id;
                    $newData->name = $oldData->name;
                    $newData->save();
                }
            }
        }

        
        
        $SuperAdminMessages = SuperAdminMessages::all();
        if(!(count($SuperAdminMessages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('superadminmessage')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new SuperAdminMessages();
                    $newData->id = $oldData->id;
                    $newData->message = $oldData->message;
                    $newData->text_font_size = "";
                    $newData->font_size_mobile = "";
                    $newData->text_font_family = 0;
                    $newData->text_color = "";
                    $newData->save();
                }
            }
        }
        
        $NotificationSettings = NotificationSettings::all();
        
        if(!(count($NotificationSettings)>0)){
            if($OldfrontendData){
                $newData = new NotificationSettings();
                $newData->id = $OldfrontendData->id;
                $newData->email_notification = $OldfrontendData->email_notofication;
                $newData->step_notification_email = $OldDBDataExt->step_notification_email;
                $newData->step_notifications = $OldDBDataExt->step_notifications=='1'?'1':'0';
                $newData->notification_busniess_info = $OldfrontendData->notificationbusniessinfo=='1'?'1':'0';
                $newData->notification_busniess_hours = $OldfrontendData->notificationbusniesshours=='1'?'1':'0';
                $newData->notification_quick_setting = $OldfrontendData->notificationquicksetting=='1'?'1':'0';
                $newData->notification_front = $OldfrontendData->notificationfront=='1'?'1':'0';
                $newData->notification_galleries = $OldfrontendData->notificationgalleries=='1'?'1':'0';
                $newData->notification_settings = $OldfrontendData->notificationsettings=='1'?'1':'0';
                $newData->notification_switch = $OldfrontendData->notificationswitch=='1'?'1':'0';
                $newData->notification_crm_controls = '0';
                $newData->notification_form = $OldfrontendData->notificationform=='1'?'1':'0';
                $newData->save();
            }
        }
        
        $BusinessInfo = BusinessInfo::all();
        if(!(count($BusinessInfo)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('bisniessinfo')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new BusinessInfo();
                    $newData->id = $oldData->id;
                    $newData->business_name = $oldData->bisniess_name;
                    $newData->contact_name = $oldData->contact_name;
                    $newData->contact_title = $oldData->contact_title;
                    $newData->contact_email = $oldData->contact_email;
                    $newData->contact_phoneno = $oldData->contact_phoneno;
                    $newData->contact_address = $oldData->contact_address;
                    $newData->address_for_map = $oldData->address_for_map;
                    $newData->product_info = $oldData->product_info;
                    $newData->showcurrentaddressonheaderblock = $oldData->showcurrentaddressonheaderblock;
                    $newData->show_address_header = $oldData->show_address_header;
                    $newData->save();
                }
            }
        }
   
        $ContactInfo = ContactInfo::all();
        if(!(count($ContactInfo)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('bisniessinfo')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new ContactInfo();
                    $newData->id = $oldData->id;
                    $newData->contact_name = $oldData->busniess_contact_name;
                    $newData->contact_email = $oldData->busniess_contact_email;
                    $newData->contact_phoneno = $oldData->busniess_contact_phoneno;
                    $newData->save();
                }
            }
        }

        $socialMedia = socialMedia::all();
        if(!(count($socialMedia)>0)){
            if($OldfrontendData){
                $oldSocialmedia = json_decode($OldfrontendData->header_socialmedia);
                foreach($oldSocialmedia as $oldData){
                    $newData = new socialMedia();
                    $newData->icon_id = $oldData->social_media_icon;
                    $newData->link = $oldData->link;
                    $newData->save();
                }
            }
        }

        
        $icons = icons::all();
        if(!(count($icons)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('icons')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new icons();
                    $newData->id = $oldData->id;
                    $newData->name = $oldData->name;
                    if($oldData->name && $oldData->name=='Twitter'){
                        $newData->name = 'X.com';
                    }
                    $newData->value = $oldData->value;
                    $newData->save();
                }
            }
        }

        
        $timeZones = timeZones::all();
        if(!(count($timeZones)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timezones')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new timeZones();
                    $newData->id = $oldData->id;
                    $newData->name = $oldData->name;
                    $newData->TimeZone = $oldData->TimeZone;
                    $newData->UTC_offset = $oldData->UTC_offset;
                    $newData->UTC_DST_offset = $oldData->UTC_DST_offset;
                    $newData->save();
                }
            }
        }
        
        $siteSettings = siteSettings::all();
        if(!(count($siteSettings)>0)){
            if($OldfrontendData){
                $newData = new siteSettings();
                $newData->id = $OldfrontendData->id;
                $newData->timezone = $OldfrontendData->timezone;
                $newData->site_background_theme = $OldfrontendData->site_background_theme;
                $newData->site_background_color = $OldfrontendData->site_background_color;
                $newData->site_trim = $OldfrontendData->site_trim;
                $newData->is_captcha_enable = $OldDBDataExt->is_captcha_enable;
                $newData->home_scripts = $OldfrontendData->homescripts;
                $newData->favicon = $OldfrontendData->favicon;
                $newData->alternate_horizontal = $OldfrontendData->alternate_horizontal;
                $newData->save();
            }
        }
        
        $userRolls = userRolls::all();
        if(!(count($userRolls)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('usersroles')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new userRolls();
                    $newData->id = $oldData->id;
                    $newData->name = $oldData->name;
                    $newData->ranking = $oldData->ranking;
                    $newData->save();
                }
            }
        }
        
        $addresses = addresses::all();
        if(!(count($addresses)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('addresses')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new addresses();
                    $newData->id = $oldData->id;
                    $newData->address_title = $oldData->address_title;
                    $newData->street = $oldData->street;
                    $newData->city = $oldData->city;
                    $newData->zip_code = $oldData->zip_code;
                    $newData->state = $oldData->state;
                    $newData->country = $oldData->country;
                    $newData->save();
                }
            }
        }

        $permissions = permissions::all();
        if(!(count($permissions)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('permissions')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new permissions();
                    $newData->id = $oldData->id;
                    $newData->permission_name = $oldData->permission_name;
                    $newData->permission_slug = $oldData->permission_slug;
                    $newData->parent_id = $oldData->parent_id;
                    $newData->display_order = $oldData->display_order;
                    $newData->save();
                }
                $newData = new permissions();
                $newData->permission_name = 'Build Site Content';
                $newData->permission_slug = 'build_site_Content';
                $newData->parent_id = '3';
                $newData->display_order = '7';
                $newData->save();
                $newData = new permissions();
                $newData->permission_name = 'Nav Bar';
                $newData->permission_slug = 'nav_bar';
                $newData->parent_id = '5';
                $newData->display_order = '0';
                $newData->save();
            }
        }
        $role_permissions = rolePermissions::all();
        if(!(count($role_permissions)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('role_permissions')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new rolePermissions();
                    $newData->id = $oldData->id;
                    $newData->role_id = $oldData->role_id;
                    $newData->permission_id = $oldData->permission_id;
                    $newData->save();
                }
            }
        }

        $textDetails = textDetails::where('slug','master_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "master_title";
            $newData->text = '';
            $newData->size_web = $OldfrontendData->title_font_size_web;
            $newData->size_mobile = $OldfrontendData->title_font_size_mobile;
            $newData->color = $OldfrontendData->title_font_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->title_font_family?$OldfrontendData->title_font_family:'0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','master_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "master_subtitle";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->subtitle_text_size;
            $newData->size_mobile = $OldDBDataExt->subtitle_text_size_mobile;
            $newData->color = $OldDBDataExt->subtitle_text_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->subtitle_font_family?$OldDBDataExt->subtitle_font_family:'0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','master_other_font')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "master_other_font";
            $newData->text = '';
            $newData->size_web = $OldfrontendData->other_font_size_web;
            $newData->size_mobile = $OldfrontendData->other_font_size_mobile;
            $newData->color = $OldfrontendData->other_font_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->other_font_family?$OldfrontendData->other_font_family:'0';
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','alert_banner_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "alert_banner_text";
            $newData->text = $OldfrontendData->banner_text;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->banner_color;
            $newData->bg_color = $OldfrontendData->banner_background_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','popup_alert_title_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "popup_alert_title_text";
            $newData->text = $OldfrontendData->popupalerttitle;
            $newData->size_web = $OldfrontendData->popup_title_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->popup_title_color;
            $newData->bg_color = $OldfrontendData->popup_title_background_color;
            $newData->fontfamily = $OldfrontendData->popup_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_newsfeed_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_newsfeed_title";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_newsfeed_title_size;
            $newData->size_mobile = $OldDBDataExt->generic_newsfeed_title_size_mobile;
            $newData->color = $OldDBDataExt->generic_newsfeed_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_newsfeed_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_newsfeed_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_newsfeed_desc";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_newsfeed_desc_size;
            $newData->size_mobile = $OldDBDataExt->generic_newsfeed_desc_size_mobile;
            $newData->color = $OldDBDataExt->generic_newsfeed_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_newsfeed_desc_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','generic_news_post_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_news_post_title";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_news_post_title_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_news_post_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_news_post_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_news_post_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_news_post_desc";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_news_post_desc_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_news_post_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_news_post_desc_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','popup_alert_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "popup_alert_text";
            $newData->text = $OldfrontendData->popupalert;
            $newData->size_web = '';
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->popup_text_color;
            $newData->bg_color = $OldfrontendData->popup_background_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','alert_banner_action_button_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "alert_banner_action_button_text";
            $newData->text = $OldfrontendData->banner_text_2;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->banner_color_2;
            $newData->bg_color = $OldfrontendData->banner_background_color_2;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_image_title_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_image_title_text";
            $newData->text = $OldfrontendData->header_title;
            $newData->size_web = $OldfrontendData->header_title_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldfrontendData->header_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_image_desc_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_image_desc_text";
            $newData->text = $OldfrontendData->header_img_desc;
            $newData->size_web = $OldDBDataExt->header_img_desc_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_img_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->header_image_desc_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_text";
            $newData->text = $OldfrontendData->header_text;
            $newData->size_web = $OldDBDataExt->header_text_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->header_text_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_text_2')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_text_2";
            $newData->text = $OldfrontendData->header_title2;
            $newData->size_web = $OldfrontendData->header_title_fontsize2;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_title_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $OldfrontendData->header_title_2_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_slider_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_slider_text";
            $newData->text = $OldDBDataExt->header_slider_text;
            $newData->size_web = $OldDBDataExt->header_slider_text_font_size;
            $newData->size_mobile = $OldDBDataExt->header_slider_text_font_size_mobile;
            $newData->color = $OldDBDataExt->header_slider_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->header_slider_text_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','header_phone_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_phone_title";
            $newData->text = $OldfrontendData->header_phone_title;
            $newData->size_web = $OldDBDataExt->current_header_phone_call_title_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_phone_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldfrontendData->header_phone_title_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_phone_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_phone_text";
            $newData->text = $OldfrontendData->header_text_7_phone;
            $newData->size_web = $OldDBDataExt->current_header_phone_call_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_text_7_phone_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->current_header_phone_call_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_phonr_text_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_phonr_text_title";
            $newData->text = $OldfrontendData->header_phonr_text_title;
            $newData->size_web = $OldDBDataExt->current_header_phone_text_title_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_phone_text_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldfrontendData->header_text_title_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_phone_text_2')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_phone_text_2";
            $newData->text = $OldfrontendData->header_phone_text;
            $newData->size_web = $OldDBDataExt->current_header_phone_text_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_phone_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->current_header_phone_text_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_address_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_address_title";
            $newData->text = $OldfrontendData->header_address_title;
            $newData->size_web = $OldfrontendData->header_address_title_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_address_title_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldfrontendData->header_address_title_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_address2_street')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_address2_street";
            $newData->text = $OldfrontendData->header_address2_street;
            $newData->size_web = $OldfrontendData->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->current_header_address_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_address2_citystatezipcode')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_address2_citystatezipcode";
            $newData->text = $OldfrontendData->header_address2_citystatezipcode;
            $newData->size_web = $OldfrontendData->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->current_header_address_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','header_address2_comment')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "header_address2_comment";
            $newData->text = $OldfrontendData->header_address2_comment;
            $newData->size_web = $OldfrontendData->header_address_text_size2;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->header_address_text_color2;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->current_header_address_font_family;
            $newData->save();
        }


        
        $actionButtons = actionButtons::where('slug','alert_banner_action')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'alert_banner_action';
            $newData->link = $OldfrontendData->banner_link_2;
            $newData->custom_form_id = $OldfrontendData->banner_customforms;
            $newData->address_id = $OldDBDataExt->alert_banner_action_button_address;
            $newData->save();
        }


        $actionButtons = actionButtons::where('slug','alert_popup_feature_action_button')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'alert_popup_feature_action_button';
            $newData->action_type = $OldDBDataExt->feature_action_button_link;
            $newData->active = $OldDBDataExt->featureActionButton;
            $newData->link = '';
            $newData->custom_form_id = $OldDBDataExt->feature_customforms;
            $newData->address_id = $OldDBDataExt->feature_action_button_address;
            $newData->save();
        }

        $actionButtons = actionButtons::where('slug','alert_popup_new_action_button')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'alert_popup_new_action_button';
            $newData->action_type = '';
            $newData->active = $OldfrontendData->newactionbuttonactive;
            $newData->link = $OldfrontendData->new_action_button_link;
            $newData->custom_form_id = null;
            $newData->address_id = null;
            $newData->save();
        }

        $actionButtons = actionButtons::where('slug','alert_popup_proceed_action_button')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'alert_popup_proceed_action_button';
            $newData->action_type = '';
            $newData->active = $OldfrontendData->proceedactionbuttonactive;
            $newData->link = '';
            $newData->custom_form_id =null;
            $newData->address_id = null;
            $newData->save();
        }

        $actionButtons = actionButtons::where('slug','alert_popup_terminate_action_button')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'alert_popup_terminate_action_button';
            $newData->action_type = '';
            $newData->active = $OldfrontendData->terminate_action_button_activate;
            $newData->link = '';
            $newData->custom_form_id = null;
            $newData->address_id = null;
            $newData->save();
        }


        $actionButtons = actionButtons::where('slug','header_btn_1')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'header_btn_1';
            $newData->text = $OldfrontendData->header_btn1_text;
            $newData->text_color = $OldfrontendData->header_btn1_text_color;
            $newData->bg_color = $OldfrontendData->header_btn1_back_color;
            $newData->action_type = $OldfrontendData->header_btn1_section;
            $newData->active = '1';
            $newData->link = $OldfrontendData->header_btn1_text_link;
            $newData->custom_form_id = $OldfrontendData->header_btn1_customforms;
            $newData->address_id = $OldfrontendData->header_btn1_address;
            $newData->save();
        }

        $actionButtons = actionButtons::where('slug','header_btn_2')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'header_btn_2';
            $newData->text = $OldfrontendData->header_btn2_text;
            $newData->text_color = $OldfrontendData->header_btn2_text_color;
            $newData->bg_color = $OldfrontendData->header_btn2_back_color;
            $newData->action_type = $OldfrontendData->header_btn2_section;
            $newData->active = '1';
            $newData->link = $OldfrontendData->header_btn2_text_link;
            $newData->custom_form_id = $OldfrontendData->header_btn2_customforms;
            $newData->address_id = $OldfrontendData->header_btn2_address;
            $newData->save();
        }

        $actionButtons = actionButtons::where('slug','header_btn_3')->get()->toArray();
        if(!(count($actionButtons)>0)){
            $newData = new actionButtons();
            $newData->slug= 'header_btn_3';
            $newData->text = $OldfrontendData->header_btn3_text;
            $newData->text_color = $OldfrontendData->header_btn3_text_color;
            $newData->bg_color = $OldfrontendData->header_btn3_back_color;
            $newData->action_type = $OldfrontendData->header_btn3_section;
            $newData->active = '1';
            $newData->link = $OldfrontendData->header_btn3_text_link;
            $newData->custom_form_id = $OldfrontendData->header_btn3_customforms;
            $newData->address_id = $OldfrontendData->header_btn3_address;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','alert_popup_feature_action_button_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "alert_popup_feature_action_button_text";
            $newData->text = $OldDBDataExt->feature_action_button_desc;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->feature_action_button_desc_color;
            $newData->bg_color = $OldDBDataExt->feature_action_button_background_desc_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','alert_popup_new_action_button_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "alert_popup_new_action_button_text";
            $newData->text = $OldfrontendData->new_action_button_desc;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->new_action_button_desc_color;
            $newData->bg_color = $OldfrontendData->new_action_button_background_desc_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','alert_popup_proceed_action_button_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $proceedData = new textDetails();
            $newData->slug = "alert_popup_proceed_action_button_text";
            $newData->text = $OldfrontendData->proceed_action_button_desc;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->proceed_action_button_desc_color;
            $newData->bg_color = $OldfrontendData->proceed_action_button_background_desc_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','alert_popup_terminate_action_button_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "alert_popup_terminate_action_button_text";
            $newData->text = $OldfrontendData->terminate_action_button_desc;
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->terminate_action_button_color;
            $newData->bg_color = $OldfrontendData->terminate_action_button_background_color;
            $newData->fontfamily = 0;
            $newData->save();
        }

        $customForms = customForms::all();
        if(!(count($customForms)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('custom_forms')->get();
            if(count($OldDBData)){

                foreach($OldDBData as $oldData){
                    $newData = new customForms();
                    $newData->id = $oldData->id;
                    $newData->title = $oldData->title;
                    $newData->subtitle = $oldData->subtitle;
                    $newData->descriptive = $oldData->descriptive;
                    $newData->image = $oldData->image;
                    $newData->image_size = $oldData->image_size;
                    $newData->static_form = $oldData->static_form;
                    $newData->footer_text_1 = $oldData->footer_text_1;
                    $newData->footer_text_2 = $oldData->footer_text_2;
                    $newData->fields = $oldData->fields;
                    $newData->display_order = $oldData->display_order;
                    $newData->save();
                }
            }
        }   

        $customUserForm = customUserForm::all();
        if(!(count($customUserForm)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('custom_user_form')->get();
            if(count($OldDBData)){

                foreach($OldDBData as $oldData){
                    $newData = new customUserForm();
                    $newData->id = $oldData->id;
                    $newData->form_id = $oldData->form_id;
                    $newData->fields_data = $oldData->fields_data;
                    $newData->save();
                }
            }
        }

        $customFormsSettings = customFormsSettings::count();
        if(!($customFormsSettings>0)){
            $newData = new customFormsSettings();
            $newData->form_multiple_emails = $OldfrontendData->form_multiple_emails;
            $newData->save();
        }
        $frontSections = frontSections::all();
        if(!(count($frontSections)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('front_sections')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new frontSections();
                    $newData->id = $oldData->id;
                    if(strpos('a'.$oldData->name,'Rotating Schedule')){
                        $newData->name = 'Schedules - Rotating';
                    }else if(strpos('a'.$oldData->name,'Set Schedule')){
                        $newData->name = 'Schedules - Set';
                    }else{
                        $newData->name = $oldData->name;
                    }
                    $newData->slug = $oldData->slug;
                    $newData->section_order = $oldData->section_order;
                    $newData->section_enabled = $oldData->section_enabled;
                    $newData->save();
                }
            }
        }

        $menu = menu::all();
        if(!(count($menu)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('menu')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new menu();
                    $newData->name = $oldData->name?$oldData->name:'';
                    $newData->section = $oldData->section?$oldData->section:'0';
                    $newData->menu_order = $oldData->menu_order?$oldData->menu_order:'0';
                    $newData->link_type = $oldData->link_type?$oldData->link_type:'';
                    $newData->address_id = $oldData->address_id?$oldData->address_id:'0';
                    $newData->link_url = $oldData->link_url?$oldData->link_url:'';
                    $newData->custom_form = $oldData->customform?$oldData->customform:'0';
                    $newData->save();
                }
            }
        }

        $uploadDir = 'uploads/';
        
        $oneStepImages = oneStepImages::all();
        if(!(count($oneStepImages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('one_step_images')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new oneStepImages();
                    $newData->id = $oldData->id;
                    $newData->category = $oldData->category;
                    $newData->name = $oldData->name;
                    $newData->first_image_location = $oldData->first_image_location;
                    $newData->second_image_location = $oldData->second_image_location;
                    $newData->first_duration = $oldData->first_duration;
                    $newData->second_duration = $oldData->second_duration;
                    $newData->status = $oldData->status;
                    $newData->notification_status = $oldData->notification_status;
                    $newData->active_time = $oldData->active_time;
                    $newData->start_time = $oldData->start_time;
                    $newData->conditions = $oldData->conditions;
                    $newData->conditions_color = $oldData->conditions_color;
                    $newData->default_button_color = $oldData->default_button_color;
                    $newData->default_button_text_color = $oldData->default_button_text_color;
                    $newData->text_enabled = $oldData->text_enabled;
                    if($oldData->first_image && $oldData->first_image !=''){

                        $newImage = new images();
                        $newImage->slug = 'one_step_button_first_'.$newData->id;
                        $newImage->file_name =  $uploadDir.$oldData->first_image;
                        $newImage->save();

                        $newData->first_image_id = $newImage->id;

                    }

                    $textDet = new textDetails();
                    $textDet->slug = "one_step_button_first_text_".$newData->id;
                    $textDet->text = $oldData->first_image_text;
                    $textDet->size_web = $oldData->first_image_text_size ? $oldData->first_image_text_size : '22';
                    $textDet->size_mobile = "";
                    $textDet->color = $oldData->first_image_text_color ? $oldData->first_image_text_color:'#000000';
                    $textDet->bg_color = "";
                    $textDet->fontfamily = $oldData->first_image_text_font ? $oldData->first_image_text_font : 1;
                    $textDet->save();

                    $newData->first_image_text_id = $textDet->id;
                    $newData->save();


                    $textDet = new textDetails();
                    $textDet->slug = "one_step_button_second_text_".$newData->id;
                    $textDet->text = $oldData->second_image_text;
                    $textDet->size_web = $oldData->second_image_text_size ? $oldData->second_image_text_size : '22';
                    $textDet->size_mobile = "";
                    $textDet->color = $oldData->second_image_text_color ? $oldData->second_image_text_color:'#000000';
                    $textDet->bg_color = "";
                    $textDet->fontfamily = $oldData->second_image_text_font ? $oldData->second_image_text_font : 1;
                    $textDet->save();

                    $newData->second_image_text_id = $textDet->id;
                    $newData->save();


                    $actionButtons = actionButtons::where('slug','alert_popup_feature_action_button')->get()->toArray();
                    if(!(count($actionButtons)>0)){
                        $newData = new actionButtons();
                        $newData->slug= 'alert_popup_feature_action_button';
                        $newData->action_type = $OldDBDataExt->feature_action_button_link;
                        $newData->active = $OldDBDataExt->featureActionButton;
                        $newData->link = '';
                        $newData->custom_form_id = $OldDBDataExt->feature_customforms;
                        $newData->address_id = $OldDBDataExt->feature_action_button_address;
                        $newData->save();
                    }

                    if($oldData->second_image && $oldData->second_image !=''){

                        $newImage = new images();
                        $newImage->slug = 'one_step_button_second_'.$newData->id;
                        $newImage->file_name =  $uploadDir.$oldData->second_image;
                        $newImage->save();

                        $newData->second_image_id = $newImage->id;
                        $newData->save();

                    }
                }
            }
        }


        # Alert Popup Image
        $image = images::where('slug','alert_popup_image')->get()->toArray();
        if(!(count($image)>0)){
            $newImage = new images();
            $newImage->slug = "alert_popup_image";
            $newImage->file_name = $OldDBDataExt->popup_image;
            $newImage->save();
        }

        # Timed Images 
        $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
        $image = images::where('slug','timed_header_logo')->get()->toArray();
        if(!(count($image)>0)){
            //if($OldDBData->timed_header_logo){
                $newImage = new images();
                $newImage->slug = "timed_header_logo";
                $newImage->file_name = $OldDBData->timed_header_logo;
                $newImage->save();
            //}
        }

        $image = images::where('slug','timed_header_image')->get()->toArray();
        if(!(count($image)>0)){
            //if($OldDBData->timed_header_image){       
                $newImage = new images();
                $newImage->slug = "timed_header_image";         
                $newImage->file_name = $OldDBData->timed_header_image;
                $newImage->save();
            //}
        }
        
        $image = images::where('slug','timed_set_hour_image')->get()->toArray();
        if(!(count($image)>0)){
            //if($OldDBData->timed_set_hour_image){
                $newImage = new images();
                $newImage->slug = "timed_set_hour_image";
                $newImage->file_name = $OldDBData->timed_set_hour_image;
                $newImage->save();
            //}
        }
        
        $image = images::where('slug','timed_content_block_image')->get()->toArray();
        if(!(count($image)>0)){
            
            //if($OldDBData->timed_content_block_image){
                $newImage = new images();
                $newImage->slug = "timed_content_block_image";
                $newImage->file_name = $OldDBData->timed_content_block_image;
                $newImage->save();
            //}
        }

        $image = images::where('slug','timed_hyperlink_image')->get()->toArray();
        if(!(count($image)>0)){
            $newImage = new images();
            $newImage->slug = "timed_hyperlink_image";
            $newImage->file_name = $OldDBData->timed_hyperlink_image;
            $newImage->save();
        }

        $image = images::where('slug','timed_popup_image')->get()->toArray();
        if(!(count($image)>0)){
            //if($OldDBData->timed_popup_image){
                $newImage = new images();
                $newImage->slug = "timed_popup_image";
                $newImage->file_name = $OldDBData->timed_popup_image;
                $newImage->save();
            //}
        }

        $image = images::where('slug','form_section_img')->get()->toArray();
        if(!(count($image)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('section_images')->where('slug','form_section_img')->first();
            //if($OldDBData->timed_popup_image){
                $newImage = new images();
                $newImage->slug = "form_section_img";
                $newImage->file_name = $OldDBData->image;
                $newImage->max_width = $OldDBData->width;
                $newImage->save();
            //}
        }

      

        $image = images::where('slug','custom_form_logo')->get()->toArray();
        if(!(count($image)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('section_images')->where('slug','custom_form_logo')->first();
            //if($OldDBData->timed_popup_image){
                $newImage = new images();
                $newImage->slug = "custom_form_logo";
                $newImage->file_name = $OldDBData->image;
                $newImage->max_width = $OldDBData->maxwidth;
                $newImage->save();
            //}
        }
        #images

        $image =  images::where('slug','alert_banner_logo')->first();
        if(!$image){
            $newData = new images();
            $newData->slug = 'alert_banner_logo';
            $newData->file_name = $OldDBDataExt->alert_banner_logo;
            $newData->min_width = $OldDBDataExt->alert_banner_logo_width_mobile;
            $newData->max_width = $OldDBDataExt->alert_banner_logo_width_web;
            $newData->save();
        }

        $image =  images::where('slug','news_feed_logo')->first();
        if(!$image){
            $newData = new images();
            $newData->slug = 'news_feed_logo';
            $newData->file_name = $OldDBDataExt->newsfeed_image;
            $newData->save();
        }

        # Timed Images Settings
        $timeImage = timedImagesSetting::where('slug','timed_popup_image')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_popup_image";
            $newTimedImage->enable = $OldDBData->enable_timed_popup_image;
            $newTimedImage->start_time = $OldDBData->popup_image_start_time	;
            $newTimedImage->end_time = $OldDBData->popup_image_end_time;
            $newTimedImage->image_timer = '0';
            $newTimedImage->days = $OldDBData->popup_image_days?$OldDBData->popup_image_days:'';
            $newTimedImage->save();
        }

        $timeImage = timedImagesSetting::where('slug','timed_hyperlink_image')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_hyperlink_image";
            $newTimedImage->enable = $OldDBData->enable_timed_hyperlink_image;
            $newTimedImage->start_time = $OldDBData->hyperlink_image_start_time	;
            $newTimedImage->end_time = $OldDBData->hyperlink_image_end_time;
            $newTimedImage->days = $OldDBData->hyperlink_image_days;
            $newTimedImage->image_timer = '0';
            $newTimedImage->save();
        }

        $timeImage = timedImagesSetting::where('slug','timed_content_block_image')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_content_block_image";
            $newTimedImage->enable = $OldDBData->enable_timed_content_block_image;
            $newTimedImage->start_time = $OldDBData->content_block_image_start_time	;
            $newTimedImage->end_time = $OldDBData->content_block_image_end_time	;
            $newTimedImage->days = $OldDBData->content_block_image_days;
            $newTimedImage->image_timer = '0';
            $newTimedImage->save();
        }

        $timeImage = timedImagesSetting::where('slug','timed_set_hour_image')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_set_hour_image";
            $newTimedImage->enable = $OldDBData->enable_timed_set_hour_image;
            $newTimedImage->start_time = $OldDBData->set_hour_image_start_time	;
            $newTimedImage->end_time = $OldDBData->set_hour_image_end_time	;
            $newTimedImage->days = $OldDBData->set_hour_image_days;
            $newTimedImage->image_timer = '0';
            $newTimedImage->save();
        }

        $timeImage = timedImagesSetting::where('slug','timed_header_image')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_header_image";
            $newTimedImage->enable = $OldDBData->enable_timed_header_image;
            $newTimedImage->start_time = $OldDBData->header_image_start_time	;
            $newTimedImage->end_time = $OldDBData->header_image_end_time	;
            $newTimedImage->days = $OldDBData->header_image_days;
            $newTimedImage->image_timer = '0';
            $newTimedImage->save();
        }

        $timeImage = timedImagesSetting::where('slug','timed_header_logo')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_header_logo";
            $newTimedImage->enable = $OldDBData->enable_timed_header_logo;
            $newTimedImage->start_time = $OldDBData->header_logo_start_time	;
            $newTimedImage->end_time = $OldDBData->header_logo_end_time	;
            $newTimedImage->days = $OldDBData->header_logo_days;
            $newTimedImage->image_timer = '0';
            $newTimedImage->save();
        }
        
        # Alert Popup Settings
        $alertPopupSetting = alertPopupSetting::first();
        if(!$alertPopupSetting){
            $alertPopupSetting = new alertPopupSetting();
            $alertPopupSetting->popup_active = $OldfrontendData->popupactive;
            $alertPopupSetting->popup_show_always = $OldfrontendData->popupshowalways;
            $alertPopupSetting->save();
        }


        # News Feed
        $oneStepImages = newsFeed::all();
        if(!(count($oneStepImages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('news_feed')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new newsFeed();
                    $newData->subtitle_text = $oldData->subtitle_text?$oldData->subtitle_text:'';
                    $newData->subtitle_font_size_web = $oldData->subtitle_font_size_web?$oldData->subtitle_font_size_web:'';
                    $newData->subtitle_font_size_mobile = $oldData->subtitle_font_size_mobile?$oldData->subtitle_font_size_mobile:'';
                    $newData->subtitle_text_color = $oldData->subtitle_text_color?$oldData->subtitle_text_color:'';
                    $newData->subtitle_font_family = $oldData->subtitle_font_family?$oldData->subtitle_font_family:0;

                    $newData->desc_text = $oldData->desc_text?$oldData->desc_text:'';
                    $newData->desc_font_size_web = $oldData->desc_font_size_web?$oldData->desc_font_size_web:'';
                    $newData->desc_font_size_mobile = $oldData->desc_font_size_mobile?$oldData->desc_font_size_mobile:'';
                    $newData->desc_text_color = $oldData->desc_text_color?$oldData->desc_text_color:'';
                    $newData->desc_font_family = $oldData->desc_font_family?$oldData->desc_font_family:0;

                    $newData->btn_section = $oldData->btnsection?$oldData->btnsection:'';
                    $newData->btn_link = $oldData->btn_link?$oldData->btn_link:'';
                    $newData->btn_form = $oldData->btnform?$oldData->btnform:'';
                    $newData->btn_text = $oldData->btn_text?$oldData->btn_text:'';
                    $newData->btn_text_color = $oldData->btn_text_color?$oldData->btn_text_color:'';
                    $newData->btn_bg = $oldData->btn_bg?$oldData->btn_bg:'';
                    $newData->btn_text_font = $oldData->btn_text_font?$oldData->btn_text_font:0;

                    
                    $newData->feed_image = $oldData->feed_image?$oldData->feed_image:'';


                    $newData->display_order = $oldData->display_order;
                    $newData->link_social_media_icons = $oldData->link_social_media_icons;
                    $newData->save();
                    
                }
            }
        }
        
        # News Post
        $oneStepImages = newsPosts::all();
        if(!(count($oneStepImages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('news_posts')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new newsPosts();
                    $newData->post_title = $oldData->post_title?$oldData->post_title:'';
                    $newData->post_title_size = $oldData->post_title_size?$oldData->post_title_size:'';
                    $newData->post_title_color = $oldData->post_title_color?$oldData->post_title_color:'';
                    $newData->font_family = $oldData->font_family?$oldData->font_family:0;

                    $newData->post_desc = $oldData->post_desc?$oldData->post_desc:'';
                    $newData->post_desc_1 = $oldData->post_desc_1?$oldData->post_desc_1:'';
                    $newData->post_desc_2 = $oldData->post_desc_2?$oldData->post_desc_2:'';
                    $newData->post_desc_3 = $oldData->post_desc_3?$oldData->post_desc_3:'';
                    $newData->post_desc_font_size = $oldData->post_desc_font_size?$oldData->post_desc_font_size:'';
                    $newData->post_desc_color = $oldData->post_desc_color?$oldData->post_desc_color:'';
                    $newData->desc_font_family = $oldData->desc_font_family?$oldData->desc_font_family:0;

                    $newData->image = $oldData->image?$oldData->image:'';
                    $newData->datetime = $oldData->datetime?$oldData->datetime:'';
                    $newData->show_date = $oldData->show_date?$oldData->show_date:'0';
                    $newData->enable_timed_image = $oldData->enable_timed_image?$oldData->enable_timed_image:'0';
                    $newData->timed_image = $oldData->timed_image?$oldData->timed_image:'';
                    $newData->timed_image_duration = $oldData->timed_image_duration?$oldData->timed_image_duration:'0';
                    $newData->timed_image_start_time = $oldData->timed_image_start_time?$oldData->timed_image_start_time:"";
                    $newData->timed_image_end_time = $oldData->timed_image_end_time?$oldData->timed_image_end_time:0;

                    $newData->timed_image_days = $oldData->timed_image_days?$oldData->timed_image_days:'';
                    $newData->timed_image_type = $oldData->timed_image_type?$oldData->timed_image_type:'days';
                    $newData->action_button_active = $oldData->action_button_active?$oldData->action_button_active:'0';
                    $newData->action_button_discription = $oldData->action_button_discription?$oldData->action_button_discription:'';
                    $newData->action_button_discription_color = $oldData->action_button_discription_color?$oldData->action_button_discription_color:'';
                    $newData->action_button_bg_color = $oldData->action_button_bg_color?$oldData->action_button_bg_color:'';
                    $newData->action_button_link = $oldData->action_button_link?$oldData->action_button_link:'';
                    $newData->action_button_link_text = $oldData->action_button_link_text?$oldData->action_button_link_text:'';
                    $newData->action_button_customform = $oldData->action_button_customform?$oldData->action_button_customform:'0';


                    $newData->display_order = $oldData->display_order;
                    $newData->save();
                    
                }
            }
        }
        $imageGallery = imageGallery::get()->toArray();
        if(!(count($imageGallery)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('image_gallery')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new imageGallery();
                    $newData->id = $oldData->id;
                    $newData->category_id = $oldData->category_id;
                    $newData->image = $oldData->image;
                    $newData->save();
                }
            }
        }

        $image =  newsFeedSetting::first();
        if(!$image){
            $newData = new newsFeedSetting();
            $newData->from_name = $OldDBDataExt->newsfeed_from_name;
            $newData->from_email = $OldDBDataExt->newsfeed_from_email;
            $newData->reply_to = $OldDBDataExt->newsfeed_reply_to;
            $newData->optout_email = $OldDBDataExt->newsfeed_optout_email;
            $newData->preheader = $OldDBDataExt->news_feed_preheader;
            $newData->use_generic_newsfeed_setting = $OldDBDataExt->use_generic_newsfeed_setting ;
            $newData->save();
        }

        $newsPostSettings =  newsPostSettings::first();
        if(!$newsPostSettings){
            $newData = new newsPostSettings();
            $newData->use_generic_news_post_setting = $OldDBDataExt->use_generic_news_post_setting;
            $newData->generic_news_post_show_date = $OldDBDataExt->generic_news_post_show_date;
            $newData->save();
        }
        
        $headerImages = headerImages::all();
        if(!(count($headerImages)>0)){
            
            $newData = new headerImages();
            $newData->slideronoff = $OldfrontendData->slideronoff;
            $newData->header_background_color = $OldfrontendData->header_background_color;
            $newData->header_logo = $OldfrontendData->header_logo;
            $newData->header_logo_width = $OldfrontendData->header_logo_width;
            $newData->header_img = $OldfrontendData->header_img;
            $newData->header_img_width = $OldfrontendData->header_img_width;
            $newData->header_slider_text_position = $OldDBDataExt->header_slider_text_position?$OldDBDataExt->header_slider_text_position:'top-left-text';
            $newData->header_slider_background = $OldfrontendData->header_slider_background;
            $newData->header_scrollbar_width = $OldDBDataExt->header_scrollbar_width;
            $newData->header_scrollbar_color = $OldDBDataExt->header_scrollbar_color;
            $newData->save();
        }

        $headerSlider = headerSlider::all();
        if(!(count($headerSlider)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('header_slider')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new headerSlider();
                    $newData->image = $oldData->image;
                    $newData->save();
                }
            }
        }

        $headerSlider = audioFiles::all();
        if(!(count($headerSlider)>0)){
            $newData = new audioFiles();
            $newData->audio_auto_play = $OldfrontendData->audio_auto_play;
            $newData->audio_repeat = $OldfrontendData->audio_repeat;
            $newData->audio_files = $OldfrontendData->audio_files;
            $newData->save();
        }



        $timeImage = timedImagesSetting::where('slug','timed_header_logo')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_header_logo";
            $newTimedImage->enable = $OldDBData->enable_timed_header_logo;
            $newTimedImage->start_time = $OldDBData->header_logo_start_time	;
            $newTimedImage->end_time = $OldDBData->header_logo_end_time	;
            $newTimedImage->days = $OldDBData->header_logo_days;
            $newTimedImage->save();
        }
        
        $timeImage = timedImagesSetting::where('slug','timed_header_logo')->get()->toArray();
        if(!(count($timeImage)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('timed_images')->first();
            $newTimedImage = new timedImagesSetting();
            $newTimedImage->slug = "timed_header_logo";
            $newTimedImage->enable = $OldDBData->enable_timed_header_logo;
            $newTimedImage->start_time = $OldDBData->header_logo_start_time	;
            $newTimedImage->end_time = $OldDBData->header_logo_end_time	;
            $newTimedImage->days = $OldDBData->header_logo_days;
            $newTimedImage->save();
        }

        $reviewSettings =  reviewSettings::first();
        if(!$reviewSettings){
            $newData = new reviewSettings();
            $newData->review_background = $OldfrontendData->reviews_staff_background;
            $newData->enable_review_stars = $OldDBDataExt->enable_review_stars=='1'?'1':'0';
            $newData->use_generic = $OldDBDataExt->use_generic_review_staff_setting=='1'?'1':'0';
            $newData->save();
        }
        $textDetails = textDetails::where('slug','generic_review_staff')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_review_staff";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_review_staff_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_review_staff_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_review_staff_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_review_staff_star')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_review_staff_star";
            $newData->text = "";
            $newData->size_web = "";
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_review_staff_star_color;
            $newData->bg_color = "";
            $newData->fontfamily = 0;
            $newData->save();
        }

        
        $reviewStaff =  reviewStaff::first();
        if(!$reviewStaff){
            $OldDBData = DB::connection('mysqlOld')->table('reviews_staff')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    $newData = new reviewStaff();
                    $newData->image = $oldData->image;
                    $newData->text = $oldData->text;
                    $newData->text_size = $oldData->text_size;
                    $newData->text_color = $oldData->text_color;
                    $newData->text_font = $oldData->text_font;
                    $newData->stars = $oldData->stars;
                    $newData->star_color = $oldData->star_color;
                    $newData->text_size = $oldData->text_size;
                    $newData->text_size = $oldData->text_size;
                    $newData->save();
                }
            }
        }

        
        $faqSettings =  faqSettings::first();
        if(!$faqSettings){
            $newData = new faqSettings();
            $newData->background_color = $OldDBDataExt->generic_faq_background_color;
            $newData->use_generic = $OldDBDataExt->use_generic_faq_setting?'1':'0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_faq_question')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_faq_question";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_faq_question_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_faq_question_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_faq_question_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','generic_faq_answer')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_faq_answer";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_faq_answer_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_faq_answer_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_faq_answer_font_family;
            $newData->save();
        }
        
        $faqs = faqs::all();
        if(!(count($faqs)>0)){
            $faqs = json_decode($OldfrontendData->faqs);
            foreach($faqs as $faq){
                
                $newData = new faqs();
                $newData->question_text = $faq->faq_question;
                $newData->question_font_size = $faq->faq_question_font_size?$faq->faq_question_font_size:'';
                $newData->question_text_color = $faq->faq_question_text_color?$faq->faq_question_text_color:'';
                $newData->question_font_family = $faq->faq_question_font_family?$faq->faq_question_font_family:'0';

                $newData->answer_text = $faq->faq_answer;
                $newData->answer_font_size = $faq->faq_answer_font_size?$faq->faq_answer_font_size:'';
                $newData->answer_text_color = $faq->faq_answer_text_color?$faq->faq_answer_text_color:'0';
                $newData->answer_font_family = $faq->faq_answer_font_family?$faq->faq_answer_font_family:'0';

                // $newData->faq_background_color = $faq->faq_background_color?$faq->faq_background_color:'0';
                $newData->save();
            }
        }

        $hyperLinksSettings =  hyperLinksSettings::first();
        if(!$hyperLinksSettings){
            $newData = new hyperLinksSettings();
            $newData->show_links = $OldfrontendData->show_links?$OldfrontendData->show_links:'0';
            $newData->link_image = isset($OldfrontendData->linkimage)?$OldfrontendData->linkimage:'';
            $newData->link_image_size = $OldDBDataExt->link_image_size;
            $newData->save();
        }


        $textDetails = textDetails::where('slug','hyper_link_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "hyper_link_text";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->text_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->links_text_color;
            $newData->bg_color = $OldfrontendData->links_background_color;
            $newData->fontfamily = $OldfrontendData->link_text_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','hyper_link_link')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "hyper_link_link";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->text_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->links_text_color;
            $newData->bg_color = $OldfrontendData->links_background_color;
            $newData->fontfamily = $OldfrontendData->link_text_font_family;
            $newData->save();
        }

        $hyperLinks = hyperLinks::all();
        if(!(count($hyperLinks)>0)){
            $hyperLinks = json_decode($OldfrontendData->textlink);
            foreach($hyperLinks as $hyperLink){
                
                $newData = new hyperLinks();
                $newData->link_text = $hyperLink->linktext?$hyperLink->linktext:'';
                $newData->link = $hyperLink->link?$hyperLink->link:'';
                $newData->save();
            }
        }

        $formsSettings =  formsSettings::first();
        if(!$formsSettings){
            $newData = new formsSettings();
            $newData->form_section_desc = $OldfrontendData->form_section_desc?$OldfrontendData->form_section_desc:'';
            $newData->form_section_desc_width = $OldfrontendData->form_section_desc_width?$OldfrontendData->form_section_desc_width:'';
            $newData->form_column = $OldfrontendData->form_link_column;
            $newData->save();
        }


        $formsLinks = formsLinks::all();
        if(!(count($formsLinks)>0)){
            $formsLinks = json_decode($OldfrontendData->forms_links);
            if(is_array($formsLinks) && count($formsLinks)>0){
                foreach($formsLinks as $formsLink){
                    $newData = new formsLinks();
                    $newData->link_text = $formsLink->linktext?$formsLink->linktext:'';
                    $newData->link_forms = $formsLink->linkforms?$formsLink->linkforms:'';
                    $newData->save();
                }
            }
        }

        
        $textDetails = textDetails::where('slug','download_question_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_question_text";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->question_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->question_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->question_text_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','download_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_text";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->download_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldfrontendData->download_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->download_text_font_family;
            $newData->save();
        }



        $downloadFiles = downloadFiles::all();
        if(!(count($downloadFiles)>0)){
            $downloadFiles = json_decode($OldfrontendData->download_files);
            foreach($downloadFiles as $downloadFile){
                $newData = new downloadFiles();
                $newData->title = $downloadFile->title?$downloadFile->title:'';
                $newData->file = $downloadFile->file?$downloadFile->file:'';
                $newData->file_question = $downloadFile->file_question?$downloadFile->file_question:'';
                $newData->download_text = $downloadFile->download_text?$downloadFile->download_text:'';
                $newData->save();
            }
        }

        
        $contentBlockSettings =  contentBlockSettings::first();
        if(!$contentBlockSettings){
            $newData = new contentBlockSettings();
            $newData->block_image = $OldfrontendData->contentblockimage;
            $newData->block_image_size = $OldDBDataExt->content_block_image_size;
            $newData->block_subimage_size = $OldDBDataExt->content_block_subimage_size;
            $newData->use_generic = $OldDBDataExt->use_generic_content_block_setting?$OldDBDataExt->use_generic_content_block_setting:'0';
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','generic_content_block_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_subtitle";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_subtitle_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_subtitle_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_subtitle_fontfamily;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','generic_content_block_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_desc";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_desc_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_desc_fontfamily;
            $newData->save();
        }
        
        
        $faqs = faqs::all();
        if(!(count($faqs)>0)){
            $faqs = json_decode($OldfrontendData->faqs);
            foreach($faqs as $faq){
                
                
                $newData = new faqs();
                $newData->question_text = $faq->faq_question;
                $newData->question_font_size = $faq->faq_question_font_size?$faq->faq_question_font_size:'';
                $newData->question_text_color = $faq->faq_question_text_color?$faq->faq_question_text_color:'';
                $newData->question_font_family = $faq->faq_question_font_family?$faq->faq_question_font_family:'0';

                $newData = new faqs();
                $newData->question_text = $faq->faq_question;
                $newData->question_font_size = $faq->faq_question_font_size?$faq->faq_question_font_size:'';
                $newData->question_text_color = $faq->faq_question_text_color?$faq->faq_question_text_color:'';
                $newData->question_font_family = $faq->faq_question_font_family?$faq->faq_question_font_family:'0';
            }
        }

        $contentBlockLinks = contentBlockLinks::all();
        if(!(count($contentBlockLinks)>0)){
            $contentBlockLinks = json_decode($OldfrontendData->contentblocklink);
            foreach($contentBlockLinks as $contentBlockLink){
                $newData = new contentBlockLinks();
                
                $newData->title = $contentBlockLink->title?$contentBlockLink->title:'';
                $newData->description = $contentBlockLink->description?$contentBlockLink->description:'';
                $newData->description1 = isset($contentBlockLink->description1)?$contentBlockLink->description1:'';
                $newData->description2 = isset($contentBlockLink->description2)?$contentBlockLink->description2:'';
                $newData->description3 = isset($contentBlockLink->description3)?$contentBlockLink->description3:'';
                $newData->content_title_color = $contentBlockLink->content_title_color?$contentBlockLink->content_title_color:'';
                $newData->content_title_font_size = $contentBlockLink->content_title_font_size?$contentBlockLink->content_title_font_size:'';
                $newData->content_title_font_family = $contentBlockLink->content_title_font_family?$contentBlockLink->content_title_font_family:'0';
                $newData->content_desc_color = $contentBlockLink->content_desc_color?$contentBlockLink->content_desc_color:'';
                $newData->content_desc_font_size = $contentBlockLink->content_desc_font_size?$contentBlockLink->content_desc_font_size:'';
                $newData->content_desc_font_family = isset($contentBlockLink->content_desc_font_family) && is_numeric($contentBlockLink->content_desc_font_family)?$contentBlockLink->content_desc_font_family:'0';
                $newData->content_image = isset($contentBlockLink->content_image)?$contentBlockLink->content_image:'';
                $newData->content_image_size = isset($contentBlockLink->content_image_size)?$contentBlockLink->content_image_size:'';
                $newData->action_button_active = isset($contentBlockLink->action_button_active)?$contentBlockLink->action_button_active:'0';
                $newData->action_button_discription = isset($contentBlockLink->action_button_discription)?$contentBlockLink->action_button_discription:'';
                $newData->action_button_discription_color = isset($contentBlockLink->action_button_discription_color)?$contentBlockLink->action_button_discription_color:'';
                $newData->action_button_bg_color = isset($contentBlockLink->action_button_bg_color)?$contentBlockLink->action_button_bg_color:'';
                $newData->action_button_link = isset($contentBlockLink->action_button_link)?$contentBlockLink->action_button_link:'';
                $newData->action_button_link_text = isset($contentBlockLink->action_button_link_text)?$contentBlockLink->action_button_link_text:'';
                $newData->action_button_custom_forms = isset($contentBlockLink->action_button_customforms) && $contentBlockLink->action_button_customforms?$contentBlockLink->action_button_customforms:'';
                $newData->action_button_address_id = isset($contentBlockLink->action_button_address_id)?$contentBlockLink->action_button_address_id:'0';
                $newData->save();
            }
        }

        
        $textDetails = textDetails::where('slug','set_hours_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_title";
            $newData->text = $OldDBDataExt->set_hours_title_text;
            $newData->size_web = $OldDBDataExt->set_hours_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->set_hours_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->set_hours_title_color;
            $newData->bg_color = $OldDBDataExt->set_hours_title_block_color;
            $newData->fontfamily = $OldDBDataExt->set_hours_title_font_family;
            $newData->save();
        }
        
        
        $hyperLinksSettings =  hyperLinksSettings::first();
        if(!$hyperLinksSettings){
            $newData = new hyperLinksSettings();
            $newData->show_links = $OldDBData->show_links?$OldDBData->show_links:'0';
            $newData->link_image = $OldDBData->linkimage;
            $newData->link_image_size = $OldDBDataExt->link_image_size;
            $newData->save();
        }

        $hyperLinksSettings =  hyperLinksSettings::first();
        if(!$hyperLinksSettings){
            $newData = new hyperLinksSettings();
            $newData->show_links = $OldDBData->show_links?$OldDBData->show_links:'0';
            $newData->link_image = $OldDBData->linkimage;
            $newData->link_image_size = $OldDBDataExt->link_image_size;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','schedule_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "schedule_title";
            $newData->text = $OldfrontendData->schedule_title_text;
            $newData->size_web = $OldfrontendData->schedule_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->schedule_title_fontsize_mobile;
            $newData->color = $OldfrontendData->schedule_title_color;
            $newData->bg_color = $OldfrontendData->schedule_title_block_color;
            $newData->fontfamily = $OldfrontendData->schedule_title_font_family;
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','content_block_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "content_block_title";
            $newData->text = $OldfrontendData->contentblock_title;
            $newData->size_web = $OldfrontendData->contentblock_title_font_size;
            $newData->size_mobile = $OldDBDataExt->contentblock_title_font_size_mobile;
            $newData->color = $OldfrontendData->contentblock_title_color;
            $newData->bg_color = $OldfrontendData->contentblock_title_block_color;
            $newData->fontfamily = $OldfrontendData->contentblock_title_font_family;
            $newData->save();
        }


        
        $textDetails = textDetails::where('slug','download_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_title";
            $newData->text = $OldfrontendData->download_title;
            $newData->size_web = $OldfrontendData->download_title_font_size;
            $newData->size_mobile = $OldDBDataExt->download_title_font_size_mobile;
            $newData->color = $OldfrontendData->download_title_color;
            $newData->bg_color = $OldfrontendData->download_title_block_color;
            $newData->fontfamily = $OldfrontendData->download_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','download_question_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_question_text";
            $newData->text = "";
            $newData->size_web = $OldDBData->question_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBData->question_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->question_text_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','download_question_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_question_text";
            $newData->text = "";
            $newData->size_web = $OldDBData->question_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBData->question_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->question_text_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','faq_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "faq_title";
            $newData->text = $OldfrontendData->faq_title;
            $newData->size_web = $OldfrontendData->faq_title_font_size;
            $newData->size_mobile = $OldDBDataExt->faq_title_font_size_mobile;
            $newData->color = $OldfrontendData->faq_title_color;
            $newData->bg_color = $OldfrontendData->faq_title_back_color;
            $newData->fontfamily = $OldfrontendData->faq_title_font_family;
            $newData->save();
        }



        
        $textDetails = textDetails::where('slug','gallery_posts_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_posts_title";
            $newData->text = $OldDBDataExt->gallery_posts_title_text;
            $newData->size_web = $OldDBDataExt->gallery_posts_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->gallery_posts_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->gallery_posts_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_posts_title_block_color;
            $newData->fontfamily = $OldDBDataExt->gallery_posts_title_font_family;
            $newData->save();
        }
        
        
        $contentBlockSettings =  contentBlockSettings::first();
        if(!$contentBlockSettings){
            $newData = new contentBlockSettings();
            $newData->block_image = $OldDBData->contentblockimage;
            $newData->block_image_size = $OldDBDataExt->content_block_image_size;
            $newData->block_subimage_size = $OldDBDataExt->content_block_subimage_size;
            $newData->use_generic = $OldDBDataExt->use_generic_content_block_setting?$OldDBDataExt->use_generic_content_block_setting:'0';
            $newData->save();
        }

        $contentBlockSettings =  contentBlockSettings::first();
        if(!$contentBlockSettings){
            $newData = new contentBlockSettings();
            $newData->block_image = $OldDBData->contentblockimage;
            $newData->block_image_size = $OldDBDataExt->content_block_image_size;
            $newData->block_subimage_size = $OldDBDataExt->content_block_subimage_size;
            $newData->use_generic = $OldDBDataExt->use_generic_content_block_setting?$OldDBDataExt->use_generic_content_block_setting:'0';
            $newData->save();
        }

        
        
        $textDetails = textDetails::where('slug','generic_content_block_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_subtitle";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_subtitle_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_subtitle_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_subtitle_fontfamily;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_content_block_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_subtitle";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_subtitle_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_subtitle_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_subtitle_fontfamily;
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','gallery_slider_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_slider_title";
            $newData->text = $OldDBDataExt->gallery_slider_title_text;
            $newData->size_web = $OldDBDataExt->gallery_slider_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->gallery_slider_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->gallery_slider_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_slider_title_block_color;
            $newData->fontfamily = $OldDBDataExt->gallery_slider_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','generic_content_block_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_desc";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_desc_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_desc_fontfamily;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_content_block_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_content_block_desc";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->generic_cb_desc_fontsize;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->generic_cb_desc_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->generic_cb_desc_fontfamily;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','gallery_videos_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_videos_title";
            $newData->text = $OldDBDataExt->gallery_videos_title_text;
            $newData->size_web = $OldDBDataExt->gallery_videos_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->gallery_videos_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->gallery_videos_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_videos_title_block_color;
            $newData->fontfamily = $OldDBDataExt->gallery_videos_title_font_family;
            $newData->save();
        }


        
        $textDetails = textDetails::where('slug','gallery_tiles_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_tiles_title";
            $newData->text = $OldDBDataExt->gallery_tiles_title_text;
            $newData->size_web = $OldDBDataExt->gallery_tiles_title_font_size;
            $newData->size_mobile = $OldDBDataExt->gallery_tiles_title_font_size_mobile;
            $newData->color = $OldDBDataExt->gallery_tiles_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_tiles_title_background_color;
            $newData->fontfamily = $OldDBDataExt->gallery_tiles_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','set_hours_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_title";
            $newData->text = $OldDBDataExt->set_hours_title_text;
            $newData->size_web = $OldDBDataExt->set_hours_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->set_hours_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->set_hours_title_color;
            $newData->bg_color = $OldDBDataExt->set_hours_title_block_color;
            $newData->fontfamily = $OldDBDataExt->set_hours_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','set_hours_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_title";
            $newData->text = $OldDBDataExt->set_hours_title_text;
            $newData->size_web = $OldDBDataExt->set_hours_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->set_hours_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->set_hours_title_color;
            $newData->bg_color = $OldDBDataExt->set_hours_title_block_color;
            $newData->fontfamily = $OldDBDataExt->set_hours_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','links_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "links_title";
            $newData->text = $OldfrontendData->links_title;
            $newData->size_web = $OldfrontendData->links_title_font_size;
            $newData->size_mobile = $OldDBDataExt->links_title_font_size_mobile;
            $newData->color = $OldfrontendData->links_title_color;
            $newData->bg_color = $OldfrontendData->links_title_back_color;
            $newData->fontfamily = $OldfrontendData->links_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','schedule_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "schedule_title";
            $newData->text = $OldfrontendData->schedule_title_text;
            $newData->size_web = $OldfrontendData->schedule_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->schedule_title_fontsize_mobile;
            $newData->color = $OldfrontendData->schedule_title_color;
            $newData->bg_color = $OldfrontendData->schedule_title_block_color;
            $newData->fontfamily = $OldfrontendData->schedule_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','schedule_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "schedule_title";
            $newData->text = $OldDBData->schedule_title_text;
            $newData->size_web = $OldDBData->schedule_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->schedule_title_fontsize_mobile;
            $newData->color = $OldDBData->schedule_title_color;
            $newData->bg_color = $OldDBData->schedule_title_block_color;
            $newData->fontfamily = $OldDBData->schedule_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','news_posts_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "news_posts_title";
            $newData->text = $OldDBDataExt->news_posts_title_text;
            $newData->size_web = $OldDBDataExt->news_posts_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->news_posts_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->news_posts_title_color;
            $newData->bg_color = $OldDBDataExt->news_posts_title_block_color;
            $newData->fontfamily = $OldDBDataExt->news_posts_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','content_block_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "content_block_title";
            $newData->text = $OldDBData->contentblock_title;
            $newData->size_web = $OldDBData->contentblock_title_font_size;
            $newData->size_mobile = $OldDBDataExt->contentblock_title_font_size_mobile;
            $newData->color = $OldDBData->contentblock_title_color;
            $newData->bg_color = $OldDBData->contentblock_title_block_color;
            $newData->fontfamily = $OldDBData->contentblock_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','content_block_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "content_block_title";
            $newData->text = $OldDBData->contentblock_title;
            $newData->size_web = $OldDBData->contentblock_title_font_size;
            $newData->size_mobile = $OldDBDataExt->contentblock_title_font_size_mobile;
            $newData->color = $OldDBData->contentblock_title_color;
            $newData->bg_color = $OldDBData->contentblock_title_block_color;
            $newData->fontfamily = $OldDBData->contentblock_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','reviews_staff_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "reviews_staff_title";
            $newData->text = $OldDBDataExt->reviews_staff_title_text;
            $newData->size_web = $OldDBDataExt->reviews_staff_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->reviews_staff_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->reviews_staff_title_color;
            $newData->bg_color = $OldDBDataExt->reviews_staff_title_block_color;
            $newData->fontfamily = $OldDBDataExt->reviews_staff_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','download_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_title";
            $newData->text = $OldDBData->download_title;
            $newData->size_web = $OldDBData->download_title_font_size;
            $newData->size_mobile = $OldDBDataExt->download_title_font_size_mobile;
            $newData->color = $OldDBData->download_title_color;
            $newData->bg_color = $OldDBData->download_title_block_color;
            $newData->fontfamily = $OldDBData->download_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','download_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "download_title";
            $newData->text = $OldDBData->download_title;
            $newData->size_web = $OldDBData->download_title_font_size;
            $newData->size_mobile = $OldDBDataExt->download_title_font_size_mobile;
            $newData->color = $OldDBData->download_title_color;
            $newData->bg_color = $OldDBData->download_title_block_color;
            $newData->fontfamily = $OldDBData->download_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','news_feed_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "news_feed_title";
            $newData->text = $OldDBDataExt->news_feed_title_text;
            $newData->size_web = $OldDBDataExt->news_feed_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->news_feed_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->news_feed_title_color;
            $newData->bg_color = $OldDBDataExt->news_feed_title_background_color;
            $newData->fontfamily = $OldDBDataExt->news_feed_title_font_family;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','faq_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "faq_title";
            $newData->text = $OldDBData->faq_title;
            $newData->size_web = $OldDBData->faq_title_font_size;
            $newData->size_mobile = $OldDBDataExt->faq_title_font_size_mobile;
            $newData->color = $OldDBData->faq_title_color;
            $newData->bg_color = $OldDBData->faq_title_back_color;
            $newData->fontfamily = $OldDBData->faq_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','faq_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "faq_title";
            $newData->text = $OldDBData->faq_title;
            $newData->size_web = $OldDBData->faq_title_font_size;
            $newData->size_mobile = $OldDBDataExt->faq_title_font_size_mobile;
            $newData->color = $OldDBData->faq_title_color;
            $newData->bg_color = $OldDBData->faq_title_back_color;
            $newData->fontfamily = $OldDBData->faq_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','contact_info_block_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "contact_info_block_title";
            $newData->text = $OldDBDataExt->contact_info_blocks_title_text;
            $newData->size_web = $OldDBDataExt->contact_info_blocks_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->contact_info_blocks_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->contact_info_blocks_title_color;
            $newData->bg_color = $OldDBDataExt->contact_info_blocks_title_block_color;
            $newData->fontfamily = $OldDBDataExt->contact_info_blocks_title_font_family;
            $newData->save();
        }

        
        $textDetails = textDetails::where('slug','seo_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "seo_title";
            $newData->text = $OldDBDataExt->seo_title_text;
            $newData->size_web = $OldDBDataExt->seo_title_font_size_web;
            $newData->size_mobile = $OldDBDataExt->seo_title_font_size_mobile;
            $newData->color = $OldDBDataExt->seo_title_color;
            $newData->bg_color = $OldDBDataExt->seo_title_background;
            $newData->fontfamily = $OldDBDataExt->seo_title_font;
            $newData->save();
        }


        
        $textDetails = textDetails::where('slug','blog_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "blog_title";
            $newData->text = $OldDBDataExt->blog_title_text;
            $newData->size_web = $OldDBDataExt->blog_title_font_size_web;
            $newData->size_mobile = $OldDBDataExt->blog_title_font_size_mobile;
            $newData->color = $OldDBDataExt->blog_title_color;
            $newData->bg_color = $OldDBDataExt->blog_title_background;
            $newData->fontfamily = $OldDBDataExt->blog_title_font;
            $newData->save();
        }
        
        
        $textDetails = textDetails::where('slug','gallery_slider_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_slider_title";
            $newData->text = $OldDBDataExt->gallery_slider_title_text;
            $newData->size_web = $OldDBDataExt->gallery_slider_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->gallery_slider_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->gallery_slider_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_slider_title_block_color;
            $newData->fontfamily = $OldDBDataExt->gallery_slider_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','gallery_slider_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_slider_title";
            $newData->text = $OldDBDataExt->gallery_slider_title_text;
            $newData->size_web = $OldDBDataExt->gallery_slider_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->gallery_slider_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->gallery_slider_title_color;
            $newData->bg_color = $OldDBDataExt->gallery_slider_title_block_color;
            $newData->fontfamily = $OldDBDataExt->gallery_slider_title_font_family;
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','reset_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "reset_title";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->reset_title_fontsize;
            $newData->size_mobile = $OldDBDataExt->reset_title_fontsize_mobile;
            $newData->color = $OldDBDataExt->reset_title_color;
            $newData->bg_color = $OldDBDataExt->reset_title_block_color;
            $newData->fontfamily = $OldDBDataExt->reset_title_font_family;
            $newData->save();
        }

        $contactFormTitle = contactFormTitle::all();
        if(!(count($contactFormTitle)>0)){
            $contact_form_titles = json_decode($OldfrontendData->contact_form_title);
            foreach($contact_form_titles as $contact_form_title){
                $newData = new contactFormTitle();
                $newData->text = $contact_form_title->contacttitle;
                $newData->size_web = $contact_form_title->contacttitlefontsize;
                $newData->size_mobile = $contact_form_title->contacttitlefontsizemobile;
                $newData->color = $contact_form_title->contacttitlecolor;
                $newData->bg_color = $contact_form_title->contacttitleblockcolor;
                $newData->fontfamily = $contact_form_title->font_family;
                $newData->save();
            }
        }

        $setHoursSettings =  setHoursSettings::first();
        if(!$setHoursSettings){
            $newData = new setHoursSettings();
            $newData->set_hour_image = $OldDBDataExt->set_hour_image;
            $newData->set_hour_image_width = $OldDBDataExt->set_hour_image_width;
            $newData->background = $OldfrontendData->set_hours_background;
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','schedule_image_desc_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "schedule_image_desc_text";
            $newData->text = $OldDBDataExt->hour_image_desc_text;
            $newData->size_web = $OldDBDataExt->hour_image_desc_text_font_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->hour_image_desc_text_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->hour_image_desc_text_font;
            $newData->save();
        }

        $setHours = setHours::all();
        if(!(count($setHours)>0)){
            $sethours = json_decode($OldfrontendData->set_hours);
            foreach($sethours as $sethour){
                $newData = new setHours();
                $newData->start = $sethour->daily_hours_start;
                $newData->end = $sethour->daily_hours_end;
                $newData->comments = $sethour->daily_hours_comments;
                $newData->start_2 = $sethour->daily_hours_start2;
                $newData->end_2 = $sethour->daily_hours_end2;
                $newData->comments_2 = $sethour->daily_hours_comments2;
                $newData->hours_color = $sethour->daily_hours_color;
                $newData->day_color = isset($sethour->daily_hours_day_color)?$sethour->daily_hours_day_color:'';
                $newData->day_orveride_generic = '0';
                $newData->hours_orveride_generic = '0';
                $newData->save();

                $textDetails = textDetails::where('slug','daily_hours')->get()->toArray();
                if(!(count($textDetails)>0)){
                    $newData = new textDetails();
                    $newData->slug = "daily_hours";
                    $newData->text = "";
                    $newData->size_web = $sethour->daily_hours_fontsize;
                    $newData->size_mobile = $OldfrontendData->set_hours_hours_title_fontsize_mobile;
                    $newData->color = $OldfrontendData->set_hours_hour_color;
                    $newData->bg_color = '';
                    $newData->fontfamily = $OldDBDataExt->set_hour_font_family;
                    $newData->save();
                }
            }
        }

        
        $textDetails = textDetails::where('slug','set_hours_day')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_day";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->set_hours_date_font_size;
            $newData->size_mobile = $OldfrontendData->set_hours_date_font_size_mobile;
            $newData->color = $OldfrontendData->busniess_hours_date_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->set_hours_date_font_family;
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','set_hours_sub_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_sub_title";
            $newData->text = $OldfrontendData->set_hours_hours_title;
            $newData->size_web = $OldfrontendData->set_hours_hours_title_fontsize;
            $newData->size_mobile = $OldfrontendData->set_hours_hours_title_fontsize_mobile;
            $newData->color = $OldfrontendData->set_hours_hours_title_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->set_hours_title_font_family;
            $newData->save();
        }


        # CRM Controls

        $crmSetting =  CrmSetting::first();
        if(!$crmSetting){
            $newData = new CrmSetting();
            $newData->test_email_address = $OldDBDataExt->email_address;
            $newData->optout_email_address = $OldDBDataExt->optout_email_address;
            $newData->email_marketing_from_email = $OldDBDataExt->email_marketing_from_email;
            $newData->email_marketing_from_name = $OldDBDataExt->email_marketing_from_name;
            $newData->email_marketing_reply_to = $OldDBDataExt->email_marketing_reply_to;

            $newData->save();
        }


        # Email Posts
        $emailPosts = EmailPost::all();
        if(!(count($emailPosts)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('email_templates')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new EmailPost();
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->teaser_title = $oldData->teaser_title?$oldData->teaser_title:'';
                    $newData->content_title = $oldData->content_title?$oldData->content_title:'';
                    $newData->logo_image = $oldData->logo_image?$oldData->logo_image:'';
                    $newData->logo_text = $oldData->logo_text?$oldData->logo_text:'';
                    $newData->email_image = $oldData->email_image?$oldData->email_image:0;

                    $newData->description_text = $oldData->description_text?$oldData->description_text:'';
                    $newData->preheader_text = $oldData->preheader_text?$oldData->preheader_text:'';
                    $newData->logo_title_font_family = $oldData->logo_title_font_family?$oldData->logo_title_font_family:'';
                    $newData->logo_title_text_size = $oldData->logo_title_text_size?$oldData->logo_title_text_size:'';
                    $newData->logo_title_text_color = $oldData->logo_title_text_color?$oldData->logo_title_text_color:0;

                    $newData->email_image_description_font_family = $oldData->email_image_desciption_font_family?$oldData->email_image_desciption_font_family:'';
                  
                    $newData->email_image_desciption_text_size = $oldData->email_image_desciption_text_size?$oldData->email_image_desciption_text_size:'';
                    $newData->email_image_desciption_text_color = $oldData->email_image_desciption_text_color?$oldData->email_image_desciption_text_color:'';
                    $newData->action_button_active = $oldData->action_button_active?$oldData->action_button_active:'';
                    $newData->action_button_discription = $oldData->action_button_discription?$oldData->action_button_discription:'';
                    $newData->action_button_discription_color = $oldData->action_button_discription_color?$oldData->action_button_discription_color:0;
                    
                    $newData->action_button_bg_color = $oldData->action_button_bg_color?$oldData->action_button_bg_color:'';


                    $newData->action_button_link = $oldData->action_button_link;
                    $newData->action_button_link_text = $oldData->action_button_link_text;
                    $newData->action_button_customform = $oldData->action_button_customform;
                    $newData->action_button_address_id = $oldData->action_button_address_id;
                    $newData->subtitle = $oldData->subtitle;
                    $newData->subtitle_font_family = $oldData->subtitle_font_family;
                    $newData->subtitle_text_size = $oldData->subtitle_text_size;
                    $newData->subtitle_text_color = $oldData->subtitle_text_color;
                    $newData->override_generic_settings = $oldData->override_generic_settings;
                    $newData->content_title_text_size = $oldData->content_title_text_size;
                    $newData->content_title_text_color = $oldData->content_title_text_color;
                    $newData->content_title_font_family = $oldData->content_title_font_family;
                    $newData->is_email_description_center = $oldData->is_email_description_center;
                    $newData->is_content_title_justified_center = $oldData->is_content_title_justified_center;
                    $newData->is_sub_title_justified_center = $oldData->is_sub_title_justified_center;
                    $newData->display_order = $oldData->display_order;
                    $newData->notes = $oldData->notes;
                    $newData->link_social_media_icons = $oldData->link_social_media_icons;
                    $newData->action_button_active_2 = $oldData->action_button_active_2;
                    $newData->action_button_discription_2 = $oldData->action_button_discription_2;
                    $newData->action_button_discription_color_2 = $oldData->action_button_discription_color_2;
                    $newData->action_button_bg_color_2 = $oldData->action_button_bg_color_2;
                    $newData->action_button_link_2 = $oldData->action_button_link_2;
                    $newData->action_button_link_text_2 = $oldData->action_button_link_text_2;
                    $newData->action_button_customform_2 = $oldData->action_button_customform_2;
                    $newData->action_button_address_id_2 = $oldData->action_button_address_id_2;
                    $newData->save();
                    
                }
            }
        }

        # Schedule Emails
        $schedule_emails = ScheduleEmail::all();
        if(!(count($schedule_emails)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('schedule_emails')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new ScheduleEmail();
                    $newData->is_done = $oldData->is_done?$oldData->is_done:'';
                    $newData->non_subscribers = $oldData->non_subscribers;
                    $newData->email_template_id = $oldData->email_template_id;
                    $newData->schedule_datetime = $oldData->schedule_datetime?$oldData->schedule_datetime:'';
                    $newData->contact_group_id = $oldData->contact_group_id?$oldData->contact_group_id:'';
                    $newData->contact_type = $oldData->contact_type?$oldData->contact_type:'';
                    $newData->save();
                }
            }
        }

        # Custom Schedule Email
        $customScheduleEmails = CustomScheduleEmail::all();
        if(!(count($customScheduleEmails)>0)){
             $OldDBData = DB::connection('mysqlOld')->table('schedule_email_custom')->get();
             if(count($OldDBData)){
                 foreach($OldDBData as $oldData){
 
                     $newData = new CustomScheduleEmail();
                     $newData->email_template_id = $oldData->email_template_id?$oldData->email_template_id:'';
                     $newData->schedule_email = $oldData->schedule_email?$oldData->schedule_email:'';
                     $newData->is_done = $oldData->is_done;
                     $newData->schedule_datetime = $oldData->schedule_datetime?$oldData->schedule_datetime:'';
                     $newData->save();
                 }
             }
         }

        # Schedule Email Contacts
        $scheduleEmailContacts = ScheduleEmailContact::all();
        if(!(count($scheduleEmailContacts)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('schedule_email_contacts')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new ScheduleEmailContact();
                     
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->schedule_email_id = $oldData->schedule_email_id?$oldData->schedule_email_id:'';
                    $newData->email_list_id = $oldData->email_list_id?$oldData->email_list_id:'';
                    $newData->save();
                }
            }
        }

        
        # Email Lists
        $emailLists = EmailList::all();
        if(!(count($emailLists)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('email_lists')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new EmailList();
                     
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->email_address = $oldData->email_address?$oldData->email_address:'';
                    $newData->name = $oldData->name?$oldData->name:'';
                    $newData->subscribed = $oldData->subscribed;
                    $newData->fields = $oldData->fields?$oldData->fields:'';
                    $newData->save();
                }
            }
        }

        
        # Email list Images
        $emailListImages = EmailListImage::all();
        if(!(count($emailListImages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('email_list_images')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new EmailListImage();
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->email_id = $oldData->email_id?$oldData->email_id:'';
                    $newData->image = $oldData->image?$oldData->image:'';
                    $newData->save();
                }
            }
        }

        
        # Contact Groups
        $contactGroups = ContactGroup::all();
        if(!(count($contactGroups)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('contact_groups')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new ContactGroup();
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->group_name = $oldData->group_name?$oldData->group_name:'';
                    $newData->save();
                }
            }
        }

        # Email Post Images
        $emailPostImages = EmailPostImage::all();
        if(!(count($emailPostImages)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('email_template_images')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new EmailPostImage();
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->email_id = $oldData->email_id?$oldData->email_id:'';
                    $newData->image = $oldData->image?$oldData->image:'';
                    $newData->save();
                }
            }
        }

        # Email Posts Starter
        $emailPostsStarter = EmailPostStarter::all();
        if(!(count($emailPostsStarter)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('email_starter_templates')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){

                    $newData = new EmailPostStarter();
                    $newData->id = $oldData->id?$oldData->id:'';
                    $newData->teaser_title = $oldData->teaser_title?$oldData->teaser_title:'';
                    $newData->content_title = $oldData->content_title?$oldData->content_title:'';
                    $newData->logo_image = $oldData->logo_image?$oldData->logo_image:'';
                    $newData->logo_text = $oldData->logo_text?$oldData->logo_text:'';
                    $newData->email_image = $oldData->email_image?$oldData->email_image:0;

                    $newData->description_text = $oldData->description_text?$oldData->description_text:'';
                    $newData->preheader_text = $oldData->preheader_text?$oldData->preheader_text:'';
                    $newData->logo_title_font_family = $oldData->logo_title_font_family?$oldData->logo_title_font_family:'';
                    $newData->logo_title_text_size = $oldData->logo_title_text_size?$oldData->logo_title_text_size:'';
                    $newData->logo_title_text_color = $oldData->logo_title_text_color?$oldData->logo_title_text_color:0;

                    $newData->email_image_description_font_family = $oldData->email_image_desciption_font_family?$oldData->email_image_desciption_font_family:'';
                    
                    $newData->email_image_desciption_text_size = $oldData->email_image_desciption_text_size?$oldData->email_image_desciption_text_size:'';
                    $newData->email_image_desciption_text_color = $oldData->email_image_desciption_text_color?$oldData->email_image_desciption_text_color:'';
                    $newData->action_button_active = $oldData->action_button_active?$oldData->action_button_active:'';
                    $newData->action_button_discription = $oldData->action_button_discription?$oldData->action_button_discription:'';
                    $newData->action_button_discription_color = $oldData->action_button_discription_color?$oldData->action_button_discription_color:0;

                    
                    $newData->action_button_bg_color = $oldData->action_button_bg_color?$oldData->action_button_bg_color:'';


                    $newData->action_button_link = $oldData->action_button_link;
                    $newData->action_button_link_text = $oldData->action_button_link_text;
                    $newData->action_button_customform = $oldData->action_button_customform;
                    $newData->action_button_address_id = $oldData->action_button_address_id;
                    $newData->subtitle = $oldData->subtitle;
                    $newData->subtitle_font_family = $oldData->subtitle_font_family;
                    $newData->subtitle_text_size = $oldData->subtitle_text_size;
                    $newData->subtitle_text_color = $oldData->subtitle_text_color;
                    $newData->override_generic_settings = $oldData->override_generic_settings;
                    $newData->content_title_text_size = $oldData->content_title_text_size;
                    $newData->content_title_text_color = $oldData->content_title_text_color;
                    $newData->content_title_font_family = $oldData->content_title_font_family;
                    $newData->is_email_description_center = $oldData->is_email_description_center;
                    $newData->is_content_title_justified_center = $oldData->is_content_title_justified_center;
                    $newData->is_sub_title_justified_center = $oldData->is_sub_title_justified_center;
                    $newData->display_order = $oldData->display_order;
                    $newData->notes = $oldData->notes;
                    $newData->link_social_media_icons = $oldData->link_social_media_icons;
                    $newData->action_button_active_2 = $oldData->action_button_active_2;
                    $newData->action_button_discription_2 = $oldData->action_button_discription_2;
                    $newData->action_button_discription_color_2 = $oldData->action_button_discription_color_2;
                    $newData->action_button_bg_color_2 = $oldData->action_button_bg_color_2;
                    $newData->action_button_link_2 = $oldData->action_button_link_2;
                    $newData->action_button_link_text_2 = $oldData->action_button_link_text_2;
                    $newData->action_button_customform_2 = $oldData->action_button_customform_2;
                    $newData->action_button_address_id_2 = $oldData->action_button_address_id_2;
                    $newData->save();
                    
                }
            }
        }

         # Email Post Starter Images
         $emailPostStarterImages = EmailPostStarterImage::all();
         if(!(count($emailPostStarterImages)>0)){
             $OldDBData = DB::connection('mysqlOld')->table('email_starter_template_images')->get();
             if(count($OldDBData)){
                 foreach($OldDBData as $oldData){
 
                     $newData = new EmailPostStarterImage();
                     $newData->id = $oldData->id?$oldData->id:'';
                     $newData->email_id = $oldData->email_id?$oldData->email_id:'';
                     $newData->image = $oldData->image?$oldData->image:'';
                     $newData->save();
                 }
             }
         }


         # Contact Groups Email
         $contactGEmails = ContactGroupEmail::all();
         if(!(count($contactGEmails)>0)){
             $OldDBData = DB::connection('mysqlOld')->table('contact_group_emails')->get();
             if(count($OldDBData)){
                 foreach($OldDBData as $oldData){
 
                     $newData = new ContactGroupEmail();
                     $newData->id = $oldData->id?$oldData->id:'';
                     $newData->contact_group_id = $oldData->contact_group_id?$oldData->contact_group_id:'';
                     $newData->email_id = $oldData->email_id?$oldData->email_id:'';
                     $newData->save();
                 }
             }
         }


         #Generic Email Settings 
         #LogoTitle
        $textDetails = textDetails::where('slug','generic_email_post_logo_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_email_post_logo_title";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->logo_title_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->logo_title_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->logo_title_font_family;
            $newData->save();
        }
        $textDetails = textDetails::where('slug','set_hours_comment')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "set_hours_comment";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->set_hours_hours_comment_fontsize;
            $newData->size_mobile = $OldfrontendData->set_hours_hours_comment_fontsize_mobile;
            $newData->color = $OldfrontendData->set_hours_hours_comment_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->set_hours_hours_comment_fontfamily;
            $newData->save();
        }
        
        $rotatingScheduleSettings =  rotatingScheduleSettings::first();
        if(!$rotatingScheduleSettings){
            $newData = new rotatingScheduleSettings();
            $newData->apply_all_days = $OldDBDataExt->is_master_image_on?'1':'0';
            $newData->rotating_schedule_image = $OldDBDataExt->rotating_shift_image?$OldDBDataExt->rotating_shift_image:'';
            $newData->background = $OldfrontendData->busniess_hours_background?$OldfrontendData->busniess_hours_background:'';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','master_image_description')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "master_image_description";
            $newData->text = $OldDBDataExt->day_master_image_description_text;
            $newData->size_web = $OldDBDataExt->day_master_image_description_text_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->day_master_image_description_text_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->day_master_image_description_text_font;
            $newData->save();
        }

        $rotatingSchedule = rotatingSchedule::all();
        if(!(count($rotatingSchedule)>0)){
            $rotatingSchedule = json_decode($OldfrontendData->daily_hours);
            $duplications = isset($rotatingSchedule->duplications)?(array)$rotatingSchedule->duplications:array();
            unset($rotatingSchedule->duplications);
            
            foreach($rotatingSchedule as $single){
                $newData = new rotatingSchedule();
                $newData->day = $single->day;
                $newData->date = $single->date;
                $newData->start = $single->daily_hours_start;
                $newData->end = $single->daily_hours_end;
                $newData->comments = $single->daily_hours_comments;
                $newData->start_2 = $single->daily_hours_start2;
                $newData->end_2 = $single->daily_hours_end2;
                $newData->comments_2 = $single->daily_hours_comments2;
                $newData->image = isset($single->day_image)?$single->day_image:'';
                $newData->image_description = isset($single->day_image_description_text)?$single->day_image_description_text:'';
                $newData->description_font_size = isset($single->day_image_description_text_font_size)?$single->day_image_description_text_font_size:'';
                $newData->description_font_family = isset($single->day_image_description_text_font)?$single->day_image_description_text_font:'0';

                $newData->duplicate_for_next_week_day = in_array($single->day,$duplications)?'1':'0';
                
                $newData->save();
            }
        }

        
        $textDetails = textDetails::where('slug','daily_hours_today')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_today";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->today_font_size;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->today_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->today_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','daily_hours_future_day')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_future_day";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->non_today_font_size;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->today_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->today_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','daily_hours_day_block')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_day_block";
            $newData->text = "";
            $newData->size_web = $OldfrontendData->busniess_hours_date_font_size;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_date_color;
            $newData->bg_color = '';
            $newData->fontfamily = '0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','daily_hours_set_1')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_set_1";
            $newData->text = $OldfrontendData->busniess_hours_hours_title;
            $newData->size_web = $OldfrontendData->busniess_hours_hours_title_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_hours_title_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->busniess_hours_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','daily_hours_set_2')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_set_2";
            $newData->text = $OldfrontendData->busniess_hours_hours_title_2;
            $newData->size_web = $OldfrontendData->busniess_hours_hours_title_2_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_hours_title_2_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->busniess_hours_title_2_font_family;
            $newData->save();
        }


        $textDetails = textDetails::where('slug','daily_hours_start_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_start_title";
            $newData->text = $OldfrontendData->busniess_hours_hours_start_title;
            $newData->size_web = $OldfrontendData->busniess_hours_hours_start_title_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_hours_start_title_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->busniess_hours_hours_start_title_font_family;
            $newData->save();
        }


        $textDetails = textDetails::where('slug','daily_hours_end_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "daily_hours_end_title";
            $newData->text = $OldfrontendData->busniess_hours_hours_end_title;
            $newData->size_web = $OldfrontendData->busniess_hours_hours_end_title_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_hours_end_title_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->busniess_hours_hours_end_title_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','busniess_hours_times')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "busniess_hours_times";
            $newData->text = '';
            $newData->size_web = $OldfrontendData->busniess_hours_times_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_times_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldfrontendData->busniess_hours_times_font_family;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','busniess_hours_comments')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "busniess_hours_comments";
            $newData->text = '';
            $newData->size_web = $OldfrontendData->busniess_hours_hours_comment_fontsize;
            $newData->size_mobile = '';
            $newData->color = $OldfrontendData->busniess_hours_hours_comment_color;
            $newData->bg_color = '';
            $newData->fontfamily = '0';
            $newData->save();
        }

        $blogSettings = blogSettings::all();
        if(!(count($blogSettings)>0)){
            $Oldgenericsettings = DB::connection('mysqlOld')->table('genericsettings')->get();
            if(count($Oldgenericsettings)){
                foreach($Oldgenericsettings as $single){
                    $newData = new blogSettings();
                    $newData->blog_header_img = $OldfrontendData->blog_header_img;
                    $newData->use_generic = $single->use_generic_settings=='1'?'1':'0';
                    $newData->save();
                    $Oldgenericsettings = json_decode($single->section_values);

                    $textDetails = textDetails::where('slug','blog_title')->get()->toArray();
                    
                        $newData = new textDetails();
                        $newData->slug = "blog_title";
                        $newData->color = $Oldgenericsettings->blog_title_color;
                        $newData->fontfamily = $Oldgenericsettings->blog_title_font?$Oldgenericsettings->blog_title_font:'0';
                        $newData->save();

                    $textDetails = textDetails::where('slug','blog_desc')->get()->toArray();
                        $newData = new textDetails();
                        $newData->slug = "blog_desc";
                        $newData->color = $Oldgenericsettings->blog_desc_color;
                        $newData->fontfamily = $Oldgenericsettings->blog_desc_font?$Oldgenericsettings->blog_desc_font:'0';
                        $newData->save();
                        
                    $textDetails = textDetails::where('slug','blog_cate')->get()->toArray();
                        $newData = new textDetails();
                        $newData->slug = "blog_cate";
                        $newData->color = $Oldgenericsettings->blog_cate_color;
                        $newData->fontfamily = $Oldgenericsettings->blog_cate_font?$Oldgenericsettings->blog_cate_font:'0';
                        $newData->save();

                    $textDetails = textDetails::where('slug','blog_date')->get()->toArray();
                        $newData = new textDetails();
                        $newData->slug = "blog_date";
                        $newData->color = $Oldgenericsettings->blog_date_color;
                        $newData->fontfamily = $Oldgenericsettings->blog_date_font?$Oldgenericsettings->blog_date_font:'0';
                        $newData->save();

                }
            }
        }
        $blogCategories = blogCategories::all();
        if(!(count($blogCategories)>0)){
            $Oldblogcategory = DB::connection('mysqlOld')->table('blogcategory')->get();
            if(count($Oldblogcategory)){
                foreach($Oldblogcategory as $single){
                    $newData = new blogCategories();
                    $newData->title = $single->title;
                    $newData->save();
                }
            }
        }

        $blogs = Blog::all();
        if(!(count($blogs)>0)){
            $Oldblogs = DB::connection('mysqlOld')->table('blog')->get();
            if(count($Oldblogs)){
                foreach($Oldblogs as $single){
                    $newData = new Blog();
                    $newData->title = $single->title;
                    $newData->slug = $single->slug;
                    $newData->category = $single->category;
                    $newData->keywords = $single->keywords;
                    $newData->meta_desc = $single->meta_desc;
                    $newData->short_desc = $single->short_desc;
                    $newData->image = $single->image;
                    $newData->description = $single->description;
                    $newData->title_color = $single->title_color;
                    $newData->title_font = isset($single->title_font)?$single->title_font:'0';
                    $newData->desc_color = $single->desc_color;
                    $newData->desc_font = isset($single->desc_font)?$single->desc_font:'0';
                    $newData->category_color = $single->category_color;
                    $newData->date_color = $single->date_color;
                    $newData->date_font = isset($single->date_font)?$single->date_font:'0';
                    $newData->btn_text = isset($single->btn_text)?$single->btn_text:'';
                    $newData->btn_link = isset($single->btn_link)?$single->btn_link:'';
                    $newData->btn_text_color = isset($single->btn_text_color)?$single->btn_text_color:'';
                    $newData->btn_bg = isset($single->btn_bg)?$single->btn_bg:'';
                    $newData->btn_text_font = isset($single->btn_text_font)?$single->btn_text_font:'0';
                    $newData->category_font = isset($single->category_font)?$single->category_font:'0';
                    $newData->save();
                }
            }
        }
        
        $galleriesSettings =  galleriesSettings::first();
        if(!$galleriesSettings){
            $newData = new galleriesSettings();
            $newData->gallery_post_use_generic = $OldDBDataExt->use_generic_gallery_post_setting?'1':'0';
            $newData->gallery_slider_use_generic = $OldDBDataExt->use_generic_gallery_slider_setting?'1':'0';
            $newData->gallery_slider_background = $OldfrontendData->gallery_back_color;
            $newData->gallery_slider_autoplay = $OldDBDataExt->gallery_slider_autoplay?'1':'0';
            $newData->gallery_video_use_generic = $OldDBDataExt->use_generic_gallery_video_setting?'1':'0';
            $newData->gallery_video_background = $OldfrontendData->gallery_video_back_color;
            $newData->gallery_tiles_use_generic = $OldDBDataExt->use_generic_gallery_tiles_settings?'1':'0';
            $newData->gallery_tiles_background = $OldDBDataExt->gallery_tiles_background_color;
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_gallery_post_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_post_title";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->generic_gallery_post_title_font_size;
            $newData->size_mobile = $OldDBDataExt->generic_gallery_post_title_font_size_mobile;
            $newData->color = $OldDBDataExt->generic_gallery_post_title_color;
            $newData->bg_color = $OldDBDataExt->generic_gallery_post_title_bcakground;
            $newData->fontfamily = $OldDBDataExt->generic_gallery_post_title_font_family?$OldDBDataExt->generic_gallery_post_title_font_family:'0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','generic_gallery_post_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_post_desc";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->generic_gallery_post_desc_font_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->generic_gallery_post_description_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->generic_gallery_post_desc_font_family?$OldDBDataExt->generic_gallery_post_desc_font_family:'0';
            $newData->save();
        }


        $textDetails = textDetails::where('slug','generic_gallery_slider_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_slider_text";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->generic_gallery_slider_desc_fontsize;
            $newData->size_mobile = $OldDBDataExt->generic_gallery_slider_desc_fontsize_mobile;
            $newData->color = $OldDBDataExt->generic_gallery_slider_desc_color;
            $newData->bg_color = $OldDBDataExt->generic_gallery_slider_desc_background_color;
            $newData->fontfamily = $OldDBDataExt->generic_gallery_slider_desc_font_family?$OldDBDataExt->generic_gallery_slider_desc_font_family:'0';
            $newData->save();
        }



        $textDetails = textDetails::where('slug','generic_gallery_video_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_video_subtitle";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->generic_gallery_video_title_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->generic_gallery_video_title_color;
            $newData->bg_color = $OldDBDataExt->generic_gallery_video_title_background;
            $newData->fontfamily = $OldDBDataExt->generic_gallery_video_title_font_family?$OldDBDataExt->generic_gallery_video_title_font_family:'0';
            $newData->save();
        }


        $textDetails = textDetails::where('slug','generic_gallery_video_desc')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_video_desc";
            $newData->text = '';
            $newData->size_web = $OldDBDataExt->generic_gallery_video_desc_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->generic_gallery_video_desc_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->generic_gallery_video_desc_font_family?$OldDBDataExt->generic_gallery_video_desc_font_family:'0';
            $newData->save();
        }

        $textDetails = textDetails::where('slug','gallery_tiles_subtitle')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "gallery_tiles_subtitle";
            $newData->text = $OldDBDataExt->gallery_tiles_subtitle;
            $newData->size_web = $OldDBDataExt->gallery_tiles_subtitle_size;
            $newData->size_mobile = '';
            $newData->color = $OldDBDataExt->gallery_tiles_subtitle_color;
            $newData->bg_color = '';
            $newData->fontfamily = $OldDBDataExt->gallery_tiles_subtitle_font?$OldDBDataExt->gallery_tiles_subtitle_font:'0';
            $newData->save();
        }
        
        $textDetails = textDetails::where('slug','generic_gallery_tiles_text')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_gallery_tiles_text";
            $newData->size_web = $OldDBDataExt->generic_gallery_tiles_desc_size;
            $newData->size_mobile = $OldDBDataExt->generic_gallery_tiles_desc_size_mobile;
            $newData->color = $OldDBDataExt->generic_gallery_tiles_desc_color;
            $newData->fontfamily = $OldDBDataExt->generic_gallery_tiles_desc_font?$OldDBDataExt->generic_gallery_tiles_desc_font:'0';
            $newData->save();
        }

        $galleryPost = galleryPost::count();
        if(!($galleryPost>0)){
            $OldData = DB::connection('mysqlOld')->table('gallery_posts')->get();
            if(count($OldData)){
                foreach($OldData as $single){
                    $newData = new galleryPost();
                    $newData->post_title = $single->gallery_post_title;
                    $newData->post_font_family = $single->font_family?$single->font_family:'0';
                    $newData->post_title_color = $single->gallery_post_title_color;
                    $newData->post_title_bcakground = $single->gallery_post_title_bcakground;
                    $newData->post_title_left_right = $single->gallery_post_title_left_right?'1':'0';
                    $newData->post_desc = $single->gallery_post_desc;
                    $newData->post_desc_1 = $single->post_desc_1;
                    $newData->post_desc_2 = $single->post_desc_2;
                    $newData->post_desc_3 = $single->post_desc_3;
                    $newData->post_desc_font_size = $single->gallery_post_desc_font_size;
                    $newData->post_desc_font_family = $single->gallery_post_desc_font_family?$single->gallery_post_desc_font_family:'0';
                    $newData->post_title_font_size = $single->gallery_post_title_font_size?$single->gallery_post_title_font_size:'';
                    $newData->post_title_font_size_mobile = $single->gallery_post_title_font_size_mobile?$single->gallery_post_title_font_size_mobile:'';
                    $newData->action_button_active = $single->action_button_active?$single->action_button_active:'0';
                    $newData->action_button_discription = $single->action_button_discription;
                    $newData->action_button_discription_color = $single->action_button_discription_color;
                    $newData->action_button_bg_color = $single->action_button_bg_color;
                    $newData->action_button_link = $single->action_button_link;
                    $newData->action_button_link_text = $single->action_button_link_text;
                    $newData->action_button_customform = $single->action_button_customform?$single->action_button_customform:'0';
                    $newData->action_button_address_id = $single->action_button_address_id?$single->action_button_address_id:'0';
                    $newData->post_image_size = $single->post_image_size;
                    $newData->display_order = $single->display_order?$single->display_order:'0';
                    $newData->save();

                    $OldDataPostIamge = DB::connection('mysqlOld')->table('gallery_post_images')->where('post_id',$single->id)->get();
                    
                    if(count($OldDataPostIamge)){
                        foreach($OldDataPostIamge as $single2){
                            $newData2 = new galleryPostImage();
                            $newData2->post_id = $newData->id;
                            $newData2->image = $single2->image;
                            $newData2->save();
                        }
                    }
                }
            }
        }


        $gallerySlider = gallerySlider::count();
        if(!($gallerySlider>0)){
            $OldData = DB::connection('mysqlOld')->table('galleryslider')->get();
            if(count($OldData)){
                foreach($OldData as $single){
                    $newData = new gallerySlider();
                    $newData->image = $single->image;
                    $newData->text = $single->text;
                    $newData->font_family = $single->font_family?$single->font_family:'0';
                    $newData->text_color = $single->text_color;
                    $newData->back_color = $single->back_color;
                    $newData->text_fontsize = $single->text_fontsize;
                    $newData->text_fontsize_mobile = $single->text_fontsize_mobile;
                    $newData->display_order = $single->display_order;
                    $newData->save();
                }
            }
        }


        $galleryVideo = galleryVideo::count();
        if(!($galleryVideo>0)){
            $OldData = DB::connection('mysqlOld')->table('galleryvideos')->get();
            if(count($OldData)){
                foreach($OldData as $single){
                    $newData = new galleryVideo();
                    $newData->video = $single->video;
                    $newData->text = $single->text;
                    $newData->title_fontsize = $single->title_fontsize?$single->title_fontsize:'0';
                    $newData->text_color = $single->text_color;
                    $newData->back_color = $single->back_color;
                    $newData->font_family = $single->font_family?$single->font_family:'0';
                    $newData->desc = $single->desc;
                    $newData->description_color = $single->description_color;
                    $newData->desc_fontsize = $single->desc_fontsize;
                    $newData->font_family_desc = $single->font_family_desc?$single->font_family_desc:'0';
                    $newData->video_auto_play = $single->video_auto_play;
                    $newData->video_repeat = $single->video_repeat;
                    $newData->display_order = $single->display_order;
                    $newData->video_image = $single->video_image;
                    $newData->desc_2 = $single->gallery_slider_desc_2;
                    $newData->font_family_desc_2 = $single->font_family_desc_2?$single->font_family_desc_2:'0';
                    $newData->desc_2_fontsize = $single->gallery_slider_desc_2_fontsize;
                    $newData->description_2_color = $single->gallery_video_description_2_color;
                    $newData->save();
                }
            }
        }

        $galleryTiles = galleryTiles::count();
        if(!($galleryTiles>0)){
            $OldData = DB::connection('mysqlOld')->table('gallery_tiles')->get();
            if(count($OldData)){
                foreach($OldData as $single){
                    $newData = new galleryTiles();
                    $newData->image = $single->image;
                    $newData->description = $single->description;
                    $newData->description_color = $single->description_color?$single->description_color:'';
                    $newData->description_size = $single->description_size?$single->description_size:'';
                    $newData->description_font = $single->description_font?$single->description_font:'0';
                    $newData->enable_timed_image = $single->enable_timed_image?'1':'0';
                    $newData->timed_image = $single->timed_image;
                    $newData->timed_image_duration = $single->timed_image_duration;
                    $newData->timed_image_start_time = $single->timed_image_start_time;
                    $newData->timed_image_type = $single->timed_image_type=='1'?'days':'timer';
                    $newData->display_order = $single->display_order;
                    $newData->save();
                }
            }
        }

        $imageCategories = imageCategories::count();
        if(!($imageCategories>0)){
            $OldData = DB::connection('mysqlOld')->table('image_gallery_category')->get();
            if(count($OldData)){
                foreach($OldData as $single){
                    $newData = new imageCategories();
                    $newData->name = $single->name;
                    $newData->save();
                }
            }
        }

        #Content title
        $textDetails = textDetails::where('slug','generic_email_post_content_title')->get()->toArray();
        if(!(count($textDetails)>0)){
            $newData = new textDetails();
            $newData->slug = "generic_email_post_content_title";
            $newData->text = "";
            $newData->size_web = $OldDBDataExt->content_title_text_size;
            $newData->size_mobile = "";
            $newData->color = $OldDBDataExt->content_title_text_color;
            $newData->bg_color = "";
            $newData->fontfamily = $OldDBDataExt->content_title_font_family;
            $newData->save();
        }

         #Subtitle                        
         $textDetails = textDetails::where('slug','generic_email_post_subtitle')->get()->toArray();
         if(!(count($textDetails)>0)){
             $newData = new textDetails();
             $newData->slug = "generic_email_post_subtitle";
             $newData->text = "";
             $newData->size_web = $OldDBDataExt->subtitle_text_size;
             $newData->size_mobile = "";
             $newData->color = $OldDBDataExt->subtitle_text_color;
             $newData->bg_color = "";
             $newData->fontfamily = $OldDBDataExt->subtitle_font_family;
             $newData->save();
         }

          #Description                        
          $textDetails = textDetails::where('slug','generic_email_post_description')->get()->toArray();
          if(!(count($textDetails)>0)){
              $newData = new textDetails();
              $newData->slug = "generic_email_post_description";
              $newData->text = "";
              $newData->size_web = $OldDBDataExt->email_image_desciption_text_size;
              $newData->size_mobile = "";
              $newData->color = $OldDBDataExt->email_image_desciption_text_color;
              $newData->bg_color = "";
              $newData->fontfamily = $OldDBDataExt->email_image_desciption_font_family;
              $newData->save();
          }

           #Contact Database                        
           $contactDB = ContactDatabase::all();
           if(!(count($contactDB)>0)){
               $OldDBData = DB::connection('mysqlOld')->table('contact_database')->get();
               if(count($OldDBData)){
                   foreach($OldDBData as $oldData){
   
                       $newData = new ContactDatabase();
                       $newData->id = $oldData->id?$oldData->id:'';
                       $newData->fields = $oldData->fields?$oldData->fields:'';
                       $newData->save();
                   }
               }
           }

            # Unsubscribe Forms Data
            $unsubscribeData = UnsubscribeUserForm::all();
            if(!(count($unsubscribeData)>0)){
                $OldDBData = DB::connection('mysqlOld')->table('unsubscribe_user_form')->get();
                if(count($OldDBData)){
                    foreach($OldDBData as $oldData){

                        $newData = new UnsubscribeUserForm();
                        $newData->id = $oldData->id?$oldData->id:'';
                        $newData->form_id = $oldData->form_id?$oldData->form_id:'';
                        $newData->fields_data = $oldData->fields_data?$oldData->fields_data:'';
                        $newData->datetime = $oldData->datetime?$oldData->datetime:'';
                        $newData->save();
                    }
                }
            }
  
            $textDetails = textDetails::where('slug','newsfeed_teaser_title')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "newsfeed_teaser_title";
                $newData->size_web = $OldDBDataExt->newsfeed_teaser_title_text_size;
                $newData->size_mobile = '';
                $newData->color = $OldDBDataExt->newsfeed_teaser_title_text_color;
                $newData->fontfamily = $OldDBDataExt->newsfeed_teaser_title_font_family?$OldDBDataExt->newsfeed_teaser_title_font_family:'0';
                $newData->save();
            }

            $contactForms = contactForms::all();
            if(!(count($contactForms)>0)){
                $OldDBData = DB::connection('mysqlOld')->table('contact_forms')->get();
                if(count($OldDBData)){
                    foreach($OldDBData as $oldData){
                        $newData = new contactForms();
                        $newData->form_title = $oldData->form_title;
                        $newData->form_title_color = $oldData->form_title_color;
                        $newData->form_title_size = $oldData->form_title_size;
                        $newData->form_title_font_family = $oldData->form_title_font_family;
                        $newData->form_email = $oldData->form_email;
                        $newData->form_google_map = $oldData->form_google_map;
                        $newData->form_status = $oldData->form_status?'1':'0';
                        $newData->show_map = $oldData->show_map?'1':'0';
                        $newData->form_fields = $oldData->form_fields;
                        $newData->save();
                    }
                }
            }
            $contactBoxSettings = contactBoxSettings::count();
            if(!($contactBoxSettings>0)){
                $OldDBData = DB::connection('mysqlOld')->table('contact_forms')->get();
                if(count($OldDBData)){
                    $newData = new contactBoxSettings();
                    $newData->background_color = $OldDBDataExt->contact_box_background_color;
                    $newData->fontfamily = $OldDBDataExt->contact_form_box_font;
                    $newData->enable_texting_box = $OldDBDataExt->enable_texting_box?'1':'0';
                    $newData->enable_phone_box = $OldDBDataExt->enable_phone_box?'1':'0';
                    $newData->enable_email_box = $OldDBDataExt->enable_email_box?'1':'0';
                    $newData->enable_address_box = $OldDBDataExt->enable_address_box?'1':'0';
                    $newData->save();
                }
            }

            $textDetails = textDetails::where('slug','contact_box_sms_title')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_sms_title";
                $newData->text = $OldfrontendData->contact_form_phonr_text_title;
                $newData->size_web = $OldDBDataExt->contact_form_phone_text_title_size;
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_phone_text_title_color;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_sms_text')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_sms_text";
                $newData->text = $OldfrontendData->contact_form_phone_text;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_phone_text_color;
                $newData->fontfamily = '0';
                $newData->save();
            }

            $textDetails = textDetails::where('slug','contact_box_phone_title')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_phone_title";
                $newData->text = $OldfrontendData->contact_form_phone_title;
                $newData->size_web = $OldDBDataExt->contact_form_phone_title_size;
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_phone_title_color;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_phone_text')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_phone_text";
                $newData->text = $OldfrontendData->contact_form_text_7_phone;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_text_7_phone_color;
                $newData->fontfamily = '0';
                $newData->save();
            }

            $textDetails = textDetails::where('slug','contact_box_email_title')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_email_title";
                $newData->text = $OldDBDataExt->contact_form_email_title;
                $newData->size_web = $OldDBDataExt->contact_form_email_titlesize;
                $newData->size_mobile = '';
                $newData->color = $OldDBDataExt->contact_form_email_titlecolor;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_email_text')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_email_text";
                $newData->text = $OldfrontendData->contact_form_email;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_emailcolor;
                $newData->fontfamily = '0';
                $newData->save();
            }

            $textDetails = textDetails::where('slug','contact_box_address_title')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_address_title";
                $newData->text = $OldfrontendData->contact_form_address_title;
                $newData->size_web = $OldfrontendData->contact_form_address_title_fontsize;
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_address_title_color;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_address_text_1')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_address_text_1";
                $newData->text = $OldDBDataExt->contact_form_address1;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_address_text_color2;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_address_text_2')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_address_text_2";
                $newData->text = $OldDBDataExt->contact_form_address2;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_address_text_color2;
                $newData->fontfamily = '0';
                $newData->save();
            }
            $textDetails = textDetails::where('slug','contact_box_address_text_3')->get()->toArray();
            if(!(count($textDetails)>0)){
                $newData = new textDetails();
                $newData->slug = "contact_box_address_text_3";
                $newData->text = $OldDBDataExt->contact_form_address3;
                $newData->size_web = '';
                $newData->size_mobile = '';
                $newData->color = $OldfrontendData->contact_form_address_text_color2;
                $newData->fontfamily = '0';
                $newData->save();
            }
            
            $seoSettings = seoSettings::count();
            if(!($seoSettings>0)){
                $newData = new seoSettings();
                $newData->google_search_title = $OldfrontendData->google_search_title;
                $newData->google_search_description = $OldfrontendData->google_search_description;
                $newData->metatag_inputs = $OldfrontendData->metatag_inputs;
                $newData->meta_language = $OldfrontendData->meta_language;
                $newData->metatag_robots = $OldfrontendData->metatag_robots;
                $newData->meta_keywords = $OldfrontendData->meta_keywords;
                $newData->metatag_revisit_after = $OldfrontendData->metatag_revisit_after;
                $newData->meta_author = $OldfrontendData->meta_author;
                $newData->seo_block_text = $OldDBDataExt->seo_block_text;
                $newData->save();
            }

            $footerSettings = footerSettings::count();
            if(!($footerSettings>0)){
                $newData = new footerSettings();
                $newData->footer_text = $OldfrontendData->footertext;
                $newData->footre_text_link = $OldfrontendData->footretextlink;
                $newData->footre_back_color = $OldfrontendData->footrebackcolor;
                $newData->footre_text_color = $OldfrontendData->footretextcolor;
                $newData->footer_text_1 = $OldfrontendData->footer_text_1;
                $newData->footer_text_2 = $OldfrontendData->footer_text_3;
                $newData->copy_right_text = $OldfrontendData->copy_right_text;
                $newData->save();
            }


            

        $permissions = permissions::where('permission_slug','nav_bar')->first();
        if(!$permissions){
                $newData = new permissions();
                $newData->permission_name = 'Nav Bar';
                $newData->permission_slug = 'nav_bar';
                $newData->parent_id = '5';
                $newData->display_order = '0';
                $newData->save();
        }
    } 
    
    public function migrateUsers()
    {
        $userRolls = DB::connection('mysql')->table('user_rolls')->get();
        if(!(count($userRolls)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('usersroles')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    DB::connection('mysql')->table('user_rolls')->insert([
                        "id" => $oldData->id,
                        "name" => $oldData->name,
                        "ranking" => $oldData->ranking,
                    ]);
                }
            }
        }

        $permissions = DB::connection('mysql')->table('permissions')->get();
        if(!(count($permissions)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('permissions')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    DB::connection('mysql')->table('permissions')->insert([
                        "id" => $oldData->id,
                        "permission_name" => $oldData->permission_name,
                        "permission_slug" => $oldData->permission_slug,
                        "parent_id" => $oldData->parent_id,
                        "display_order" => $oldData->display_order,
                    ]);
                }
                
                    DB::connection('mysql')->table('permissions')->insert([
                        "permission_name" => 'Build Site Content',
                        "permission_slug" => 'build_site_Content',
                        "parent_id" => '3',
                        "display_order" => '7',
                    ]);
                    
                    DB::connection('mysql')->table('permissions')->insert([
                        "permission_name" => 'Nav Bar',
                        "permission_slug" => 'nav_bar',
                        "parent_id" => '5',
                        "display_order" => '0',
                    ]);
            }
        }
        
        $role_permissions = DB::connection('mysql')->table('role_permissions')->get();
        if(!(count($role_permissions)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('role_permissions')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    DB::connection('mysql')->table('role_permissions')->insert([
                        "id" => $oldData->id,
                        "role_id" => $oldData->role_id,
                        "permission_id" => $oldData->permission_id,
                        "role_id" => $oldData->role_id,
                        "role_id" => $oldData->role_id,
                    ]);
                }
            }
        }
        
        
        $user = DB::connection('mysql')->table('users')->get();
        if(!(count($user)>0)){
            $OldDBData = DB::connection('mysqlOld')->table('admin')->get();
            if(count($OldDBData)){
                foreach($OldDBData as $oldData){
                    DB::connection('mysql')->table('users')->insert([
                        "id" => $oldData->id,
                        "user_role" => $oldData->userrole,
                        "email" => $oldData->email,
                        "password" => Hash::make($oldData->password),
                        "name" => $oldData->first_name.' '.$oldData->last_name,
                        "photo" => $oldData->photo,
                        "admin_type" => $oldData->admin_type,
                        "kptoken" => base64_encode_password($oldData->admin_type),
                    ]);
                }
            }
        }
        
    }
}
