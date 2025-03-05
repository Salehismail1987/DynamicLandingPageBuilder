<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthUserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\BusinessInfoController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\UsersRollsController;
use App\Http\Controllers\admin\QuickSettingController;
use App\Http\Controllers\admin\PopupController;
use App\Http\Controllers\admin\ImageGalleryController;
use App\Http\Controllers\admin\ImageController;
use App\Http\Controllers\admin\TipController;
use App\Http\Controllers\admin\BaseController;
use App\Http\Controllers\admin\NewsFeedController;
use App\Http\Controllers\admin\NewsPostController;
use App\Http\Controllers\admin\Frontend;
use App\Http\Controllers\admin\SchedulingController;
use App\Http\Controllers\admin\CRMController;
use App\Http\Controllers\admin\EmailPostController;
use App\Http\Controllers\admin\EmailTemplateController;
use App\Http\Controllers\admin\EmailMarketingController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\GalleriesController;
use App\Http\Controllers\admin\FormsController;
use App\Http\Controllers\admin\UserFormsController;
use App\Http\Controllers\admin\FormsSettingsController;
use App\Http\Controllers\admin\OneStepButtonController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\ReminderController;
use App\Http\Controllers\admin\ResponseFolderController;
use App\Http\Controllers\admin\NavBarController;
use App\Http\Controllers\admin\NotficationController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\syncController;
use App\Http\Controllers\syncUsersController;
use App\Http\Controllers\admin\StripeController;
use App\Http\Controllers\admin\AttendhubController;
use GrahamCampbell\ResultType\Success;
use App\Http\Controllers\EngagementCommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\WebsiteClickController;
use App\Http\Controllers\WebsiteVisitorController;
use App\Models\EngagementComment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/get-captcha-session', function () {
    return response()->json(['captcha' => session('contdigicaptcha')]);
});
Route::post('popupswitch',[QuickSettingController::class,'popupSwitch']);
Route::post('frontSetting', [Frontend::class, 'frontSetting']);
Route::post('openform', [Frontend::class,'openform']);
Route::post('unsubscribeform', [Frontend::class,'unsubscribeform']);
Route::get('attendhubtabledata', [AttendhubController::class, 'fetchData'])->name('fetch.data.table'); 
Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/privacypolicy', [HomeController::class, 'privacypolicy']);
Route::get('/checktimed', [CronJobController::class, 'index']);
Route::get('/scheduleemailscustom', [CronJobController::class, 'scheduleEmailsCustom']);
Route::get('/engagementnotification', [CronJobController::class, 'scheduleEngagementNotification']);
Route::get('/scheduleemails', [CronJobController::class, 'scheduleEmails']);
Route::get('view_mail',[EmailMarketingController::class,'view_mail']);
Route::post('popupswitch',[QuickSettingController::class,'popupSwitch']);

Route::get('optout',[EmailMarketingController::class,'optout']);
Route::post('updatemasteroutlinecolor', [BaseController::class,'updateMasterOutlineColor']);
Route::post('updatemasterlabel', [BaseController::class,'updatemasterlabel']);
Route::get('/stripe/products', [StripeController::class, 'getProducts']);
Route::get('/stripe/products', [StripeController::class, 'getProducts']);
Route::get('/checkout-success', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/checkout-cancel', [StripeController::class, 'cancel'])->name('checkout.cancel');
Route::post('/create-checkout-session', [StripeController::class, 'createCheckoutSession']);
Route::get('/get-stripe-products', [StripeController::class, 'getStripeProducts']);
Route::get('/run-migrations', function () {
    try {
        return Artisan::call('migrate', ["--force" => true ]);
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
});

Route::get('/migrate-rollback', function () {
    return Artisan::call('migrate:rollback', ["--force" => true ]);
});

Route::post('sendotp',[OtpController::class,'sendOtp']);
Route::post('sendotpemail',[OtpController::class,'sendOtpEmail']);
Route::post('verifyotp',[OtpController::class,'verifyOtp']);
Route::post('/engagement-comments', [EngagementCommentController::class, 'store'])->name('engagement-comments.store');
Route::get('/comments', [EngagementCommentController::class, 'fetchComments'])->name('comments.fetch');
Route::post('/increment-likes', [LikeController::class, 'incrementLike'])->name('increment.like');
Route::post('/record-click', [WebsiteClickController::class, 'recordClick']);
Route::post('/record-visitor', [WebsiteVisitorController::class, 'recordVisitor']);
Route::post('/comments/update-display', [EngagementCommentController::class, 'updateDisplay'])->name('comments.updateDisplay');
Route::delete('/comments/{id}', [EngagementCommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/comments/{id}/toggle-pin', [EngagementCommentController::class, 'togglePin'])->name('comments.togglePin');


Route::group(['middleware' => ['authcheck']], function() {
    
    // Route::post('notificationupdate', [NotficationController::class, 'update']); 
    //Route::post('deleteaddress', [NotficationController::class, 'update']); 

    Route::get('dashboard', [DashboardController::class, 'index']); 

    //Ajax 
    Route::post('updatepopup', [PopupController::class, 'updatepopup']); 
    Route::post('getcateimages', [ImageGalleryController::class, 'getCateImages']); 
    Route::post('deletefrontendimage', [ImageController::class, 'delete_frontend_image']);  
    Route::post('deleteemailpostimage', [ImageController::class, 'deleteEmailPostImage']);  
    Route::post('deleteeventpostimage', [ImageController::class, 'deleteEventPostmage']);  
    Route::post('delimage', [ImageController::class, 'delimage']); 
    Route::post('delgalleryimage', [ImageGalleryController::class, 'delete_gallery_image']); 
    Route::post('gettip', [TipController::class, 'getTipData']); 
    Route::post('save_display_order', [BaseController::class, 'saveDisplayOrder']);  
    Route::post('save_generic_settings', [BaseController::class, 'saveGenericSettings']); 
    Route::post('updatetexttag', [BaseController::class, 'updatetexttag']);
    Route::post('updatetextenable', [BaseController::class, 'updatetextenable']);
    Route::post('updatemasteroutlineactive', [BaseController::class,'updateMasterOutlineActive']);
    Route::post('updateallmasteroutlineactive', [BaseController::class,'updateAllMasterOutlineActive']);
    Route::post('updatesubscribetocontact', [BaseController::class,'updateSubscribeToContact']);

    # Business Info
    Route::get('businessinfo', [BusinessInfoController::class, 'index']); 
    Route::post('updatebusinessinfo', [BusinessInfoController::class, 'updateBusinessInfo']); 
    Route::post('updatecontactinfo', [BusinessInfoController::class, 'updateContactInfo']); 
    Route::post('updatesocialmedia', [BusinessInfoController::class, 'updateSocialMedia']); 
    Route::post('updateaddress', [BusinessInfoController::class, 'updateAddress']); 
    Route::post('updatetimezone', [BusinessInfoController::class, 'updateTimeZone']); 
    Route::post('updaterecommendations', [BusinessInfoController::class, 'updateRecommendation']); 
    Route::post('updateButtonOrder', [Frontend::class, 'updateButtonOrder'])->name('updateButtonOrder'); 
    

    Route::get('adduser', [UsersController::class, 'addview']); 
    Route::post('createuser', [UsersController::class, 'create']); 
    Route::get('edituser/{id}', [UsersController::class, 'editview']); 
    Route::get('deleteuser/{id}', [UsersController::class, 'delete']); 
    Route::post('updateuser/{id}', [UsersController::class, 'update']);

    
    Route::get('addusersrole', [UsersRollsController::class, 'addview']); 
    Route::post('createrole', [UsersRollsController::class, 'create']); 
    Route::get('editusersrole/{id}', [UsersRollsController::class, 'editview']); 
    Route::post('updaterole/{id}', [UsersRollsController::class, 'update']); 
    Route::get('deleteusersrole/{id}', [UsersRollsController::class, 'delete']); 
    Route::get('editpermissions/{id}', [UsersRollsController::class, 'editpermissionview']); 
    Route::post('updatepermissions/{id}', [UsersRollsController::class, 'updatepermissions']); 
    Route::post('change_permission', [UsersRollsController::class, 'change_permission']); 
    Route::post('toggle_all_permissions', [UsersRollsController::class, 'toggle_all_permissions']);


    #Quick Settings
    Route::get('quicksettings', [QuickSettingController::class, 'index']); 
    Route::post('updatealertbanner', [QuickSettingController::class,'updateAlertBanner']);
    Route::post('updatealertpopup', [QuickSettingController::class, 'updatealertpopup']);
    Route::post('updatenewsfeedsettings', [QuickSettingController::class, 'updateNewsFeedSettings']);
    Route::post('updatenewspostsettings', [QuickSettingController::class, 'updateNewsPostSettings']);
    Route::post('updatenewsfeedgenericsettings', [QuickSettingController::class, 'updateNewsFeedGenericSettings']);
    Route::post('updateheaderimages', [QuickSettingController::class,'updateHeaderImages']);
    Route::post('updateheadertext', [QuickSettingController::class,'updateHeaderText']);
    Route::post('updateheaderbuttons', [QuickSettingController::class,'updateHeaderButtons']);
    Route::post('updateaudiofiles', [QuickSettingController::class,'updateAudioFiles']);
    Route::post('updateisvideoslider', [QuickSettingController::class,'updateisvideoslider']);
    Route::post('updateisautoplayheaderslider', [QuickSettingController::class,'updateisautoplayheaderslider']);
    Route::post('updateissoundheaderslider',  [QuickSettingController::class,'updateissoundheaderslider']);
    Route::post('delete_slider_video', [QuickSettingController::class,'delete_slider_video']);
    Route::post('newsfeeddatestamps', [QuickSettingController::class,'newsfeeddatestamps']);
    Route::post('frontend/delaudiofile',[QuickSettingController::class,'deleteAudioFiles']);
    Route::post('admin/frontend/delaudiofile',[QuickSettingController::class,'deleteAudioFiles']);
    
    #news feed
    Route::get('addnewsfeed', [NewsFeedController::class, 'addview']); 
    Route::post('createnewsfeed', [NewsFeedController::class, 'create']); 
    Route::get('editnewsfeed/{id}', [NewsFeedController::class, 'editview']); 
    Route::post('updatenewsfeed/{id}', [NewsFeedController::class, 'update']);
    // Route::get('duplicatenewsfeed/{id}', [NewsFeedController::class, 'duplicateview']); 
    // Route::post('duplicatenewsfeed/{id}', [NewsFeedController::class, 'duplicate']);
    Route::get('deletenewsfeed/{id}', [NewsFeedController::class, 'delete']); 
    Route::any('send_notification/{id}', [NewsFeedController::class,'send_notification']);

    
    #news feed
    Route::get('addnewspost', [NewsPostController::class, 'addview']); 
    Route::post('createnewspost', [NewsPostController::class, 'create']); 
    Route::get('editnewspost/{id}', [NewsPostController::class, 'editview']); 
    Route::post('updatenewspost/{id}', [NewsPostController::class, 'update']);
    Route::get('deletenewspost/{id}', [NewsPostController::class, 'delete']); 

    #images
    Route::post('admin/frontend/delete_frontend_image',[HomeController::class, 'delete_frontend_image']);

    
    #Edit Frontend
    Route::get('editfrontend', [Frontend::class, 'index']); 
    
    Route::post('updatereviewstaff', [Frontend::class,'updateReviewStaff']);
    Route::get('deletereviewvideo/{id}', [Frontend::class,'deletereviewvideo']);
    Route::post('delreview', [Frontend::class,'delReview']);
    
    Route::post('delformlink', [Frontend::class,'delFormLink']);
    
    Route::post('updatestaffproductspromos', [Frontend::class,'updateStaffProductsPromos']);
    Route::post('delrestaffproductspromos', [Frontend::class,'delStaffProductsPromos']);
    
    Route::post('updatefaq', [Frontend::class,'updateFaq']); 
    Route::post('updatefaqgenericsettings', [Frontend::class,'updatefaqgenericsettings']); 
    Route::post('delfaq', [Frontend::class,'delfaq']);
    Route::post('updatehyperlinks', [Frontend::class,'updateHyperLinks']);
    Route::post('delHyperlink', [Frontend::class,'delHyperlink']);
    
    Route::post('updateforms', [Frontend::class,'updateForms']);

    Route::post('updatedownloadfiles', [Frontend::class,'updateDownloadFiles']);
    Route::post('updatecontentblock', [Frontend::class,'updateContentBlock']);
    Route::post('updatetitlebanners', [Frontend::class,'updateTitleBanners']);
    Route::post('deletedownloadfile', [Frontend::class, 'delfile']);
    // Route::post('frontSetting', [Frontend::class, 'frontSetting']);
    Route::post('updateTitleSetting',[Frontend::class, 'updateTitleSetting']);

    Route::post('updateReviewSites', [Frontend::class, 'updateReviewSites']);
   
    Route::post('removeActionVideo', [Frontend::class, 'removeActionVideo']);
    Route::post('removeformbtn', [Frontend::class, 'removeFormBtn']);
    Route::post('updateActionButton', [Frontend::class, 'updateActionButton']);
    Route::post('savebusinesscategory', [Frontend::class, 'saveBusinessCategory']);
    Route::get('addbusinesscoachcategory', [Frontend::class, 'addCategoryView']); 
    Route::post('updateBusinessCoach', [Frontend::class, 'updateBusinessCoach']); 
    Route::get('/delete-button/{id}', [Frontend::class, 'deleteActionButton'])->name('deleteActionButton');

    #Business Hours
    Route::get('scheduling', [SchedulingController::class, 'index']); 
    Route::post('savesethours', [SchedulingController::class, 'saveSetHours']); 
    Route::post('saverotatinghours', [SchedulingController::class, 'saveRotatingHours']); 
    Route::post('save_repeating_hours', [SchedulingController::class, 'saveRepeatingHours']);
    #one step button
    Route::get('onestepbutton', [OneStepButtonController::class, 'index']); 
    Route::post('deactivateall', [OneStepButtonController::class, 'deactivateAll']); 
    Route::post('managesteps', [OneStepButtonController::class, 'manageSteps']); 
    // Route::post('updatenotificationstatus', [OneStepButtonController::class, 'updatenotificationstatus']); 

    #Blog
    Route::get('blog', [BlogController::class, 'index']); 
    Route::post('blogsavegeneric', [BlogController::class, 'blogSaveGeneric']); 
    Route::post('blogsavesettings', [BlogController::class, 'blogSaveSeting']); 
    Route::get('addblog', [BlogController::class, 'addBlogView']); 
    Route::post('saveblog', [BlogController::class, 'add']); 
    Route::get('editblog/{id}', [BlogController::class, 'editBlogView']);  
    Route::post('updateblog/{id}', [BlogController::class, 'update']); 
    Route::get('deleteblog/{id}', [BlogController::class, 'delete']); 

    #Blog Category
    Route::get('addblogcategory', [BlogCategoryController::class, 'addView']); 
    Route::post('saveblogcategory', [BlogCategoryController::class, 'add']); 
    Route::get('editblogcategory/{id}', [BlogCategoryController::class, 'editView']); 
    Route::post('updateblogcategory/{id}', [BlogCategoryController::class, 'update']); 
    Route::get('deleteblogcategory/{id}', [BlogCategoryController::class, 'delete']); 

    #Galleries
    Route::get('galleries', [GalleriesController::class, 'index']); 
    Route::post('savegenericpostsettings', [GalleriesController::class, 'saveGenericPostSettings']); 
    Route::get('addgallerypost', [GalleriesController::class, 'addPostView']); 
    Route::post('savegallerypost', [GalleriesController::class, 'savePost']); 
    Route::get('editgallerypost/{id}', [GalleriesController::class, 'editPostView']); 
    Route::post('updategallerypost', [GalleriesController::class, 'updatePost']); 
    Route::get('deletegallerypost/{id}', [GalleriesController::class, 'deletePost']); 
    Route::post('deletegallerypostimage', [GalleriesController::class, 'deleteGalleryPostImage']); 
    
    
    Route::post('savegenericslidersettings', [GalleriesController::class, 'saveGenericSliderSettings']); 
    Route::get('addgalleryslider', [GalleriesController::class, 'addSliderView']); 
    Route::post('savegalleryslider', [GalleriesController::class, 'saveSlider']); 
    Route::get('editgalleryslider/{id}', [GalleriesController::class, 'editSliderView']); 
    Route::post('updategalleryslider', [GalleriesController::class, 'updateSlider']); 
    Route::get('deletegalleryslider/{id}', [GalleriesController::class, 'deleteSlider']); 
    
    Route::post('savegenericvideosettings', [GalleriesController::class, 'saveGenericVideoSettings']); 
    Route::get('addgalleryvideo', [GalleriesController::class, 'addVideoView']); 
    Route::post('savegalleryvideo', [GalleriesController::class, 'saveVideo']); 
    Route::get('editgalleryvideo/{id}', [GalleriesController::class, 'editVideoView']); 
    Route::post('updategalleryvideo', [GalleriesController::class, 'updateVideo']); 
    Route::get('deletegalleryvideo/{id}', [GalleriesController::class, 'deleteVideo']); 

    Route::post('savegenerictilesettings', [GalleriesController::class, 'saveGenericTileSettings']); 
    Route::get('addgallerytile', [GalleriesController::class, 'addTileView']); 
    Route::post('savegallerytile', [GalleriesController::class, 'saveTile']); 
    Route::get('editgallerytile/{id}', [GalleriesController::class, 'editTileView']); 
    Route::post('updategallerytile', [GalleriesController::class, 'updateTile']); 
    Route::get('deletegallerytile/{id}', [GalleriesController::class, 'deleteTile']); 
    
    Route::get('addgallerycategory', [GalleriesController::class, 'addCategoryView']); 
    Route::post('savegallerycategory', [GalleriesController::class, 'saveCategory']); 
    Route::get('editgallerycategory/{id}', [GalleriesController::class, 'editCategoryView']); 
    Route::post('updategallerycategory', [GalleriesController::class, 'updateCategory']); 
    Route::get('deletegallerycategory/{id}', [GalleriesController::class, 'deleteCategory']); 

    Route::post('imageUpload', [ImageController::class, 'imageUpload']); 
    Route::post('delvideoimage', [GalleriesController::class, 'delvideoimage']); 
    Route::post('remove_action_button',[Frontend::class,'removeActionButton']);
    Route::post('update_gallery_slider_new_posts_top',[GalleriesController::class,'updateGallerySliderNewPostsTop']);
    
    
    #CRM Controls
    Route::get('crmcontrols',[CRMController::class,'index']);
    Route::post('contacts/importToDB',[ContactController::class,'importToDB']);
    Route::post('saveCRMSettings', [CRMController::class,'saveCRMSettings']);
    Route::get('generatesamplefile', [CRMController::class,'generateSampleFile'])->name('generate.sample.file');

    Route::any('emailMarketing/', [EmailPostController::class,'emailMarketing']);
    Route::get('deleteSchedule/{id}', [EmailPostController::class,'deleteSchedule']);
    Route::post('deleteMultipleEmailPost', [EmailPostController::class, 'deleteMultipleEmailPost']);
    Route::post('deleteMultipleSchedules', [EmailPostController::class, 'deleteMultipleSchedules']); /* (Hassan) Delete multiple schedule */
    Route::get('newEmailPost', [EmailPostController::class,'new']);
    Route::get('editEmailPost/{id}', [EmailPostController::class,'editView']);
    Route::get('duplicateEmailPost/{id}',[EmailPostController::class,'duplicateView']);
    Route::get('deleteEmailPost/{id}', [EmailPostController::class,'deleteEmailPost']);
    Route::post('getEmailTemplate',[EmailPostController::class,'getEmailTemplate']);
    Route::post('createNewEmailPost',[EmailPostController::class,'saveEmailPost']);
    Route::post('updateEmailPost/{id}',[EmailPostController::class,'updateEmailPost']);
    Route::post('admin/emailpost/delimage', [EmailPostController::class,'delimage']);
    Route::post('saveDuplicateEmailPost/{id}',[EmailPostController::class,'saveDuplicateEmailPost']);
    Route::any('emailMarketing/{id}',[EmailMarketingController::class,'emailMarketing']);

    Route::get('newEmailTemplate', [EmailTemplateController::class,'new']);
    Route::post('createNewEmailTemplate',[EmailTemplateController::class,'save']);
    Route::get('editEmailTemplate/{id}', [EmailTemplateController::class,'editView']);
    Route::post('updateEmailTemplate/{id}',[EmailTemplateController::class,'update']);
    Route::get('duplicateEmailTemplate/{id}',[EmailTemplateController::class,'duplicateView']);
    Route::post('saveDuplicateEmailTemplate/{id}',[EmailTemplateController::class,'saveDuplicate']);
    Route::get('deleteEmailTemplate/{id}', [EmailTemplateController::class,'deleteEmailTemplate']);
    Route::post('deleteMultipleEmailTemplate', [EmailTemplateController::class, 'deleteMultipleEmailTemplate']);

    

    Route::get('runScheduleMails',[EmailMarketingController::class,'runScheduleMails']);
    Route::post('getContacts',[ContactController::class, 'getContacts']);
    Route::get('deleteContact/{id}',[ContactController::class, 'deleteContact']);
    Route::get('editContact/{id}',[ContactController::class, 'editView']);
    Route::get('duplicateContact/{id}',[ContactController::class, 'duplicateContact']); /* (Hassan) Duplicate the existing row */
    Route::post('subscribedSwitch',[ContactController::class ,'subscribedSwitch']);
    Route::get('exportContactToExcel',[ContactController::class, 'exportToExcel']); /* (Hassan) Change from post to get */
    
    Route::get('addViewContact',[ContactController::class, 'addView']);
    
    Route::post('updateContact/{id}',[ContactController::class, 'edit']);
    Route::post('createContact',[ContactController::class, 'add']);

    Route::post('delContactimage',[ContactController::class,'delimage']);
    Route::get('deleteUnsub/{id}', [CRMController::class,'deleteUnsub']);
    Route::post('deleteMultipleContacts', [ContactController::class, 'deleteMultipleContacts']);
    Route::post('contactsToSubscribe', [ContactController::class, 'contactsToSubscribe']);
    Route::post('contactsToUnSubscribe', [ContactController::class, 'contactsToUnSubscribe']);
    Route::post('deleteMultipleUnsubs', [CRMController::class, 'deleteMultipleUnsubs']); /* (Hassan) Delete multiple unsubs */
    Route::post('updateOptdOut/{id}', [CRMController::class, 'updateOptdOut']); /* (Hassan) Update OPTD Out */
    Route::get('moveSingleOptdToIn/{id}', [CRMController::class, 'moveSingleOptdToIn']); /* (Hassan) Move Single opt'd To In */
    Route::post('moveMultipleOptdToIn', [CRMController::class, 'moveMultipleOptdToIn']); /* (Hassan) Move Multiple opt'd To In */

    Route::post('saveContactGroup',[ContactController::class,'saveContactGroup']);
    Route::get('deleteContactGroup/{id}',[ContactController::class,'deleteContactGroup']);
    Route::post('updateContactGroup/{id}',[ContactController::class,'updateContactGroup']);
    Route::any('assignEmails/{id}',[ContactController::class,'assignEmails']);

    Route::post('getDataFromDB',[ContactController::class,'getDataFromDB']);
    Route::post('assignEmailsAjax/{id}',[ContactController::class,'assignEmailsAjax']);
    Route::post('getContactData',[ContactController::class,'getContactData']);
    Route::post('getCustomeSearchData',[ContactController::class,'getCustomeSearchData']);
    Route::post('getEmailData',[ContactController::class,'getEmailData']);
    Route::post('saveContactField', [CRMController::class,'saveContactField']);

    Route::get('attendhub', [AttendhubController::class, 'index']); 
    Route::get('addattendhubpost', [AttendhubController::class, 'addview']); 
    Route::post('saveeventpostgenericsettings', [AttendhubController::class, 'saveGenericSettings']); 
    Route::post('createattendhubpost', [AttendhubController::class, 'createPost']); 
    Route::post('editattendhubpost/{id}', [AttendhubController::class, 'updatePost']); 
    Route::post('update-form-visibility', [AttendhubController::class, 'updateVisibility']); 
    Route::post('delete-group-response', [AttendhubController::class, 'deleteGroup']); 
    Route::post('deleteMultipleEventPosts', [AttendhubController::class, 'deleteEvent']); 
    Route::post('delete-individual-response', [AttendhubController::class, 'deleteItem']); 
    Route::post('delete-event-forms', [AttendhubController::class, 'deleteForms']); 
    Route::post('delete-individual-form', [AttendhubController::class, 'deleteSingleForm']); 
    Route::post('delete-multiple-responses', [AttendhubController::class, 'deleteItems']); 
    Route::post('is-generic', [AttendhubController::class, 'updateGenericSettings']); 
    Route::post('saveattenhubemails', [AttendhubController::class, 'saveMultipleEmails']); 
    Route::get('editevent/{id}', [AttendhubController::class, 'editEvent']); 
    Route::get('editeventform/{id}', [AttendhubController::class, 'editForm'])->name('editeventform');  
    Route::post('enable-multiple-events', [AttendhubController::class, 'enableMultipleEvents']);
    Route::post('enable-multiple-responses', [AttendhubController::class, 'enableMultipleResponses']);
    Route::post('disable-multiple-responses', [AttendhubController::class, 'disableMultipleResponses']);
    Route::post('enable-single-event', [AttendhubController::class, 'enableSingleEvent']);
    Route::post('enable-single-response', [AttendhubController::class, 'enableSingleResponse']);
    Route::post('disable-single-response', [AttendhubController::class, 'disableSingleResponse']);
    Route::post('update-new-status', [AttendhubController::class, 'updateNewStatus']);
    Route::post('update-attenhub-form-response-comment', [AttendhubController::class, 'updateAttenhubComment']);
    Route::get('editattenhubform/{id}', [AttendhubController::class, 'editAttenhubForm']); 
    Route::post('updateeventresponse', [AttendhubController::class,'updateAttenhubForm']);
    Route::get('detailattenhubform/{id}', [AttendhubController::class,'detailAttenhubForm']);

    Route::post('/update-engagements-data', [LikeController::class, 'saveEngagementsData']);
    Route::post('/update-engagement-toggle', [EngagementCommentController::class, 'updateToggle'])->name('engagement.updateToggle');
    Route::post('/update-real-time-engagement-toggle', [EngagementCommentController::class, 'updateRealTimeToggle'])->name('engagement.updateRealTimeToggle');
    Route::get('/get-engagement-data', [DashboardController::class, 'getEngagementData']);
    #Forms
    Route::get('forms', [FormsController::class, 'index']); 
    Route::post('saveform', [FormsController::class,'saveForm']);
    Route::post('toggleForm', [FormsController::class,'toggleForm']);
    Route::get('addform', [FormsController::class, 'addForm']); 
    Route::get('editform/{id}', [FormsController::class, 'editForm']); 
    Route::get('duplicateform/{id}', [FormsController::class, 'duplicateForm']); 
    Route::get('deleteform/{id}', [FormsController::class, 'deleteForm']); 
    Route::post('movetofolder', [FormsController::class,'moveToFolder']);
    Route::post('deletemultipleform', [FormsController::class, 'deletemultipleform']); 
    Route::post('saveformorder', [FormsController::class, 'saveFormOrder']);  
    Route::get('exportformresponse', [FormsController::class, 'exportFormResponseToExcel']);  
    Route::post('save-sorted-order', [FormsController::class, 'saveOrder']);  

    #Responses Folders
    Route::get('addfolder', [ResponseFolderController::class, 'add']); 
    Route::get('editfolder/{id}', [ResponseFolderController::class, 'edit']); 
    Route::get('duplicatefolder/{id}', [ResponseFolderController::class, 'duplicate']); 
    Route::get('deletefolder/{id}', [ResponseFolderController::class, 'delete']); 
    Route::post('saveresponsefolder', [ResponseFolderController::class,'save']);

    #User Forms
    Route::get('edituserform/{id}', [UserFormsController::class, 'editUserForm']); 
    Route::post('updateresponse', [UserFormsController::class,'updateUserForm']);
    Route::get('detailuserform/{id}', [UserFormsController::class,'detailUserForm']);
    Route::get('deleteuserform/{id}', [UserFormsController::class, 'deleteUserForm']); 
    Route::post('deletemultipleuserform', [UserFormsController::class, 'deletemultipleuserform']); 
    Route::post('readmultipleuserform', [UserFormsController::class, 'readmultipleuserform']); 
    Route::get('addtocontacts/{id}', [UserFormsController::class, 'addToConnects']); 
    Route::get('readuserform/{id}', [UserFormsController::class, 'readUserForm']); 
    Route::get('unreaduserform/{id}', [UserFormsController::class, 'unreadUserForm']); 
    Route::get('getunreadresponses', [UserFormsController::class, 'getUnreadResponses']); 

    Route::post('saveformsettings', [FormsSettingsController::class,'saveFormSettings']);

    #Settings
    Route::get('settings', [SettingsController::class, 'index']); 
    Route::post('saveonestepimage', [SettingsController::class, 'saveOneStepImage']); 
    Route::post('savetheme', [SettingsController::class, 'saveTheme']); 
    Route::post('savefontmaster', [SettingsController::class, 'saveFontMaster']); 
    Route::post('savecontactform', [SettingsController::class, 'saveContactForm']); 
    Route::post('savecontactbox', [SettingsController::class, 'saveContactBox']); 
    Route::post('savemetadata', [SettingsController::class, 'saveMetaData']); 
    Route::post('saveSeoBlockSettings', [SettingsController::class, 'saveSeoBlockSettings']); 
    Route::post('savenotification', [SettingsController::class, 'saveNotification']); 
    Route::post('savescripts', [SettingsController::class, 'saveScripts']); 
    Route::post('savealternate', [SettingsController::class, 'saveAlternate']); 
    Route::post('savesectionorder', [SettingsController::class, 'saveSectionOrder']); 
    Route::post('savefooter', [SettingsController::class, 'saveFooter']); 
    Route::post('savecaptcha', [SettingsController::class, 'saveCaptcha']);  
    Route::get('settings/remove_cf/{id}', [SettingsController::class, 'remove_cf']);  
    Route::post('removeFavIcon', [SettingsController::class, 'removeFavIcon']);      
    
    #Settings
    Route::get('addmenu', [MenuController::class, 'addMenu']); 
    Route::post('savemenu', [MenuController::class, 'add']); 
    Route::get('editmenu/{id}', [MenuController::class, 'editMenu']); 
    Route::post('updatemenu/{id}', [MenuController::class, 'update']); 
    Route::get('deletemenu/{id}', [MenuController::class, 'delete']); 
    Route::get('enablemenu/{id}', [MenuController::class, 'enableMenu']); 
    Route::get('disablemenu/{id}', [MenuController::class, 'disableMenu']); 
    Route::post('savemenuorder',[MenuController::class,'saveMenuOrder']);
    Route::post('savenavbar', [NavBarController::class, 'update']); 
    Route::post('savenavbarenable', [NavBarController::class, 'savenavbarenable']); 


    #reminders
    Route::get('reminders',[ReminderController::class,'index']);
    Route::any('reminders/edit/{id}',[ReminderController::class,'edit']);
    Route::any('reminders/add',[ReminderController::class,'add']);
    Route::any('reminders/delete/{id}',[ReminderController::class,'delete']);

    #General
    Route::post('update_override_bg', [SettingsController::class, 'update_override_bg']); 
    
});

Route::get('sync', [syncController::class, 'sync']);
Route::get('migrateUsers', [syncController::class, 'migrateUsers']);
Route::get('syncusers', [syncUsersController::class, 'sync']);
Route::get('clearLogs', [CronJobController::class,'clearLogs']);

Route::get('login', [AuthUserController::class, 'index'])->name('login');
Route::get('logout', [AuthUserController::class, 'index'])->name('sync');
Route::post('custom-login', [AuthUserController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthUserController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthUserController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthUserController::class, 'logout'])->name('signout');
#Front Site APIS
Route::get('get_feed_data_ajax', [NewsFeedController::class, 'get_feed_data_ajax']); 
Route::post('contactform', [HomeController::class, 'contactform']); 
Route::post('customformsAction', [HomeController::class, 'customformsAction']); 
Route::any('blog-page', [HomeController::class, 'blogPage']); 
Route::any('blog-detail/{slug}', [HomeController::class, 'blogDetail']); 