<?php

use Carbon\Carbon;

$utc = getTimeZone($siteSettings->timezone);
date_default_timezone_set("$utc");
$updatedAt = Carbon::parse($alertPopupSetting->updated_at);

// Get the midnight after the day the popup was last updated
$midnightAfterUpdate = $updatedAt->copy()->endOfDay()->addSecond();

// Check if the current time is after that midnight
$midnightCrossedSinceUpdate = Carbon::now()->greaterThanOrEqualTo($midnightAfterUpdate);
?>
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="modal-product-name"></h4>
                <p id="modal-product-description"></p>
                <h4>Prices:</h4>
                <ul id="modal-product-prices"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade likesModal" id="likesModal" tabindex="-1" role="dialog" aria-labelledby="likesModal">
    <div class="modal-dialog" id="likes-dialog" role="document" style="width:450px">
        <div class="modal-content">
        <div class="modal-header likes-modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="likes-modal-header">You can give us a Like & leave a comment too</h5>
        </div>
            <div class="col-md-12 like-elements d-flex flex-column p-0">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 likes-container like-box p-0">
                        <div class="like-icon col-md-4">

                            <div class="business-svg text-center d-flex space-around" data-category="business"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Business</text>
                            </div>
                        </div>
                        <div class="like-icon col-md-4">

                            <div class="service-svg text-center" data-category="service"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Service</text>
                            </div>
                        </div>
                        <div class="like-icon col-md-4">

                            <div class="website-svg text-center" data-category="website"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Website</text>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 text-center">
                        <button type="button" class="mybtn-primary submit-like-btn">Submit a Like</button>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 comments-btn-div p-0">
                        <div class="col-md-6 col-xs-6 p-0 text-center"> <button type="button" id="openCommentModal" class="mybtn-primary leave-comment-btn">Leave a comment</button>
                        </div>
                        <div class="col-md-6 col-xs-6 p-0 text-center"> <button type="button" class="mybtn-primary read-comments-btn">Read Comments</button>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 comments-no">
                        {{ countComments() ?? 0 }} comments
                    </div>
                </div>
                <ul id="modal-product-prices"></ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="engagementCommentModal" tabindex="-1" role="dialog" aria-labelledby="engagementCommentModalLabel">
    <div class="modal-dialog custom-modal" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                
            </div> -->
            <div class="modal-body">
                <h5 class="modal-title text-center" id="engagementCommentModalLabel">Leave a Comment</h5>
                <form id="engagementCommentForm">
                    <div class="form-group">
                        <label for="name">Name (Optional)</label>
                        <input type="text" class="form-control engagement-fields" id="user_name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group like-comment-div">
                        <label for="comment">Comment</label>
                        <textarea class="form-control engagement-fields" id="comment" name="comment" rows="4" placeholder="Enter your comment" required></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="mybtn-primary submit-comment-btn">Submit Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="thank-you-popup modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <!-- Your SVG icon -->
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_13560_39402)">
                        <path d="M25.0307 0C24.183 0 23.3647 0.271988 22.6906 0.763969C22.0165 0.271988 21.1982 0 20.3505 0C18.1616 0 16.3809 1.78078 16.3809 3.96966C16.3809 8.3793 22.112 10.8862 22.3559 10.9907C22.5696 11.0823 22.8115 11.0823 23.0253 10.9907C23.2692 10.8862 29.0004 8.37936 29.0004 3.96966C29.0004 1.78078 27.2196 0 25.0307 0Z" fill="black" />
                        <path d="M20.5924 15.4718H16.3722L16.7107 12.765C16.9529 10.8221 15.4372 9.10156 13.476 9.10156C13.1642 9.10156 12.8775 9.27233 12.729 9.54653L8.53362 17.2918H7.15918V27.1812H7.7777L9.34891 28.7525C9.50818 28.9118 9.72432 29.0013 9.94964 29.0013H19.7524C21.3401 29.0013 22.6746 27.8119 22.8565 26.2346C22.8565 26.2346 23.6964 18.9544 23.6964 18.9543C23.91 17.0997 22.4583 15.4718 20.5924 15.4718Z" fill="black" />
                        <path d="M4.61055 16.3789H0.849609C0.380398 16.3789 0 16.7593 0 17.2285V27.2388C0 27.708 0.380398 28.0884 0.849609 28.0884H4.61055C5.07976 28.0884 5.46016 27.708 5.46016 27.2388V17.2285C5.46016 16.7593 5.07981 16.3789 4.61055 16.3789Z" fill="black" />
                    </g>
                    <defs>
                        <clipPath id="clip0_13560_39402">
                            <rect width="29" height="29" fill="white" />
                        </clipPath>
                    </defs>
                </svg>

                <p>Thank you for your input!</p>
            </div>
        </div>
    </div>
</div>
<!-- Comments Modal -->
<div id="commentsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel">
    <div class="modal-dialog modal-lg comments-modal" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="commentsModalLabel">All Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="comments-list" style="max-height: 400px; overflow-y: auto;">

                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="mybtn-primary close-comment-list" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
if (($alertPopupSetting->popup_active == '1' &&
        ($alertPopupSetting->popup_show_always || !session('firstarival'))) ||
    (isset($_GET['editwebsite']) && $_GET['editwebsite'] === 'true' && $alertPopupSetting->popup_active == 1) ||
    ($alertPopupSetting->popup_active == '0' && $midnightCrossedSinceUpdate)
) {
    Session::put('firstarival', '1'); ?>
    <div class="modal fade" id="popupalert" role="dialog">
        <div class="modal-dialog" style="height: max-content">
            <!-- Modal content-->
            <div class="modal-content " style="<?= $alertPopupSetting->popup_alert_override_bg == '1' && $popup_alert_text->bg_color ? 'background:' . $popup_alert_text->bg_color . ';' : '' ?>">
                <?php
                $backDashboard = '';
                if (isset($_GET['editwebsite'])) {
                    $backDashboard = '
                            <div class="back-dashboard-div">
                                <a href="' . url('quicksettings?block=popup_alert_bluebar') . '" target="_blank">
                                    <div class="d-flex align-items-center">
                                        <div class="title-2">Popup Alert</div>
                                    </div>
                                    <img src="' . url('assets/uploads/' . get_current_url() . 'edit-round.png') . '" class="edit-icon">
                                </a>
                            </div>';
                }
                ?>
                <div class="position-relative title_banners_outline">
                    @if(isset($_GET['editwebsite']))
                    <div class="">
                        <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                        <div class="d-flex align-items-center">
                            <!-- <div class="title-2">Alert Banner</div> -->
                            <x-tutorial-action-buttons title='Popup Alert' :buttons="isset($tutorial_action_buttons['popup_alert']) ? $tutorial_action_buttons['popup_alert']:'' " url='quicksettings?block=popup_alert_bluebar' :popup="isset($alertPopupSetting->popup_active)?$alertPopupSetting->popup_active:''" :midnightCrossedSinceUpdate="isset($midnightCrossedSinceUpdate)?$midnightCrossedSinceUpdate:''" />

                        </div>
                        <!-- <img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon"> -->
                        <!-- </a> -->
                    </div>
                    @endif
                    <div class="modal-body" style="text-align: center;z-index:1;">
                        <?php if ($popup_alert_title_text->enable == '1') { ?>
                            <<?= $popup_alert_title_text->tag ?> class="titlefontfamily text-bold " style="<?php if ($popup_alert_title_text->fontfamily) { ?>font-family:<?= getfontfamily($popup_alert_title_text->fontfamily) ?> <?php } ?>;<?= $popup_alert_title_text->color ? 'color:' . $popup_alert_title_text->color . ';' : '' ?><?= $popup_alert_title_text->size_web ? 'font-size:' . $popup_alert_title_text->size_web . 'px;' : '' ?>">
                                <?= nl2br($popup_alert_title_text->text) ?>
                            </<?= $popup_alert_title_text->tag ?>>
                        <?php } ?>
                        <div class="popup_image">

                            <?php
                            if ($step_image = check_step_image('Popup Alert Image')) {
                            ?>
                                <div class="vertical-center">
                                    <div class="outer">
                                        <div class="middle">
                                            <div class="inner">
                                                <img class="lazyload" data-src="<?= url('assets/uploads/') . get_current_url() . '/' . $step_image['image'] ?>" style="max-width: 100%; width:70%;" alt="<?= !empty($step_image['text']) ? $step_image['text'] : $popup_alert_title_text->text ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($step_image['text'])) {
                                ?>
                                    <p style="padding-bottom:0;color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;<?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>">
                                        <?= nl2br($step_image['text']) ?>
                                    </p>
                                <?php
                                }
                                ?>
                            <?php
                            } elseif (show_timed_image($timed_popup_image_setting->enable, $timed_popup_image->file_name, $timed_popup_image_setting->start_time, $timed_popup_image_setting->end_time, $timed_popup_image_setting->days,  'enable_timed_popup_image', 'timed_images', 1, $timed_popup_image_setting->type)) {
                            ?>
                                <div class="vertical-center">
                                    <div class="outer">
                                        <div class="middle">
                                            <div class="inner ">

                                                <img class="lazyload" data-src="<?= url('assets/uploads/') . get_current_url() . '/' . $timed_popup_image->file_name ?>" style="max-width: 100%; width:70%;" alt="<?= $popup_alert_title_text->text ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                if ($alert_popup_image->file_name) { ?>
                                    <div class="vertical-center">
                                        <div class="outer">
                                            <div class="middle">
                                                <div class="inner">
                                                    <img class="lazyload" data-src=" {{asset('assets/uploads/'.get_current_url().$alert_popup_image->file_name)}}" style="max-width: 100%; width:@if($alert_popup_image->max_width) {{$alert_popup_image->max_width}}px @else 70%; @endif" alt="<?= $popup_alert_title_text->text ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } ?>
                        </div>
                        <p class="alert-popup-desc" style="padding-bottom:0px;font-size: 18px;<?= $popup_alert_text->color ? 'color:' . $popup_alert_text->color . ';' : '' ?>"><?= nl2br($popup_alert_text->text) ?></p>
                    </div>
                    <div class="modal-footer" style="text-align: center;">

                        <?php
                        if (isset($alert_popup_feature_action_button->active) && $alert_popup_feature_action_button->active == '1') {
                            $class = '';
                            $playaudio = '';
                            $playactionaudio = '';
                            $data_target = '';
                            $data_toggle = '';
                            $input_href = '';
                            $target = '';
                            if ($alert_popup_feature_action_button->action_type == 'call' || $alert_popup_feature_action_button->action_type == 'sms' || $alert_popup_feature_action_button->action_type == 'email') {

                                switch ($alert_popup_feature_action_button->action_type) {
                                    case 'sms':
                                        $input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $alert_popup_feature_action_button->action_button_phone_no_sms));
                                        break;
                                    case 'call':
                                        $input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $alert_popup_feature_action_button->action_button_phone_no_calls));
                                        break;
                                    case 'email':
                                        $input_href = 'mailto:' . $alert_popup_feature_action_button->action_button_action_email;
                                        break;
                                }
                            } elseif ($alert_popup_feature_action_button->action_type == 'stripe') {
                                // Show Stripe button when action_type is 'stripe'
                                $class = 'stripe';
                            } elseif ($alert_popup_feature_action_button->action_type == 'text_popup') {

                                $input_href = '#' . $alert_popup_feature_action_button->action_type;
                        ?>
                                <div style="display:none" id="actPopupText<?= $alert_popup_feature_action_button->id ?>">
                                    <?php echo $alert_popup_feature_action_button->action_button_textpopup; ?>
                                </div>
                                <?php
                            } elseif ($alert_popup_feature_action_button->action_type == "video") {


                                $input_href = get_blog_image($alert_popup_feature_action_button->action_button_video);
                                // $target = "_blank";
                                $data_target = "#video_modal";
                                $data_toggle = 'modal';
                            } elseif ($alert_popup_feature_action_button->action_type == "audioiconfeature") {

                                if ($alert_popup_feature_action_button->action_button_audio_icon_feature) { ?>
                                    <div class="action-audio">
                                        <audio class="hidden" id="alertpop1Audio_<?= $alert_popup_feature_action_button->id ?>" controls>
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_feature_action_button->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_feature_action_button->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_feature_action_button->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                        </audio>
                                    </div>
                                    <?php
                                }
                                $input_href = '#' . $alert_popup_feature_action_button->action_button_audio_icon_feature;
                            } elseif ($alert_popup_feature_action_button->action_type == "address") {

                                $address =  getaddress_info($alert_popup_feature_action_button->address_id);

                                $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                $input_href = "http://maps.google.com/maps?q=" . $address_full;
                                $target = "_blank";
                            } elseif ($alert_popup_feature_action_button->action_type == "google_map") {

                                $address_full = isset($alert_popup_feature_action_button->map_address) ? $alert_popup_feature_action_button->map_address : "";
                                $input_href = "http://maps.google.com/maps?q=" . $address_full;
                                $target = "_blank";
                            } else {
                                if ($alert_popup_feature_action_button->action_type == "link") {
                                    $target = "_blank";
                                    $input_href =  $alert_popup_feature_action_button->link;
                                } else {
                                    $class = 'menuitem';
                                    if ($alert_popup_feature_action_button->action_type == 'audiofeature') {
                                        $playaudio = '';
                                        $playactionaudio = 'playactionaudio';
                                        $audio = 'myAudio-' . $alert_popup_feature_action_button->action_type;
                                        if ($alert_popup_new_action_button->action_button_audio) {
                                            $audio_file = $alert_popup_feature_action_button->action_button_audio;      ?>
                                            <audio class="hidden" id="myAudio-<?= $alert_popup_feature_action_button->action_type ?>-1" controls>
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/mp3">
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/ogg">
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/mpeg">
                                            </audio>
                                            <!-- <div class="bottomrightdiv"> -->
                                            <!-- </div> -->
                            <?php
                                        }
                                    }

                                    $input_href = '#' . $alert_popup_feature_action_button->action_type;
                                }
                            }
                            ?>

                            <?php
                            if ($alert_popup_feature_action_button->action_type == "address"  || $alert_popup_feature_action_button->action_type == "google_map") {
                            ?>
                                <a href='<?= $input_href ?>' class="btn btn-default text-bold {{$class}}" target="<?= $target ?>" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                            <?php
                            } elseif ($alert_popup_feature_action_button->action_type == "customforms") {
                            ?>
                                <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_feature_action_button->custom_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                            <?php
                            } elseif ($alert_popup_feature_action_button->action_type == "eventForms") {
                            ?>
                                <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_feature_action_button->event_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                                <?php
                            } else {
                                if ($alert_popup_feature_action_button->action_type == "link") {
                                ?>
                                    <a href="<?= $input_href ?>" class="btn btn-default text-bold {{$class}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>" target="<?= $target ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                                <?php
                                } else if ($alert_popup_feature_action_button->action_type == "audiofeature") {
                                ?>
                                    <a href="<?= $input_href ?>" onclick="playPauseAudio(1)" class="btn btn-default text-bold {{$class}} {{$playaudio}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                                <?php
                                } elseif ($alert_popup_feature_action_button->action_type == "video") { ?>
                                    <a id="alertPopupFeatBtn" href="<?= $input_href ?>" <?php if ($alert_popup_feature_action_button->action_type == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('alertPopupFeatBtn');" <?php } ?> class="btn btn-default text-bold {{$class}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>" target="<?= $target ?>">
                                        <?= $alert_popup_feature_action_button_text->text ?>
                                    </a>
                                    <div style="margin-top: -4px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> ">Click to watch video</div> <br>
                                <?php
                                } elseif ($alert_popup_feature_action_button->action_type == "image_popup") { ?>
                                    <a id="alertPopupFeatBtn" href="<?= $input_href ?>" <?php if ($alert_popup_feature_action_button->action_type == "image_popup") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openSlider(<?= htmlspecialchars($alert_popup_feature_action_button->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?> class="btn btn-default text-bold {{$class}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>" target="<?= $target ?>">
                                        <?= $alert_popup_feature_action_button_text->text ?>
                                    </a>
                                    <div style="margin-top: -4px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> "></div> <br>
                                <?php
                                } else if ($alert_popup_feature_action_button->action_type == "audioiconfeature" && isset($alert_popup_feature_action_button->action_button_audio_icon_feature)) { ?>
                                    <!-- <span onclick="playPauseAudio('alertpop1Audio_<?= $alert_popup_feature_action_button->id ?>')" style="<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> "> -->

                                    <a href="<?= $input_href ?>" onclick="playPauseAudio('alertpop1Audio_<?= $alert_popup_feature_action_button->id ?>')" class="btn btn-default btn-adjustable text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="position:relative;margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>">
                                        <span style="position:absolute;left:10px;">
                                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                                        </span><span class="text"><?= $alert_popup_feature_action_button_text->text ?></span></a><br>
                                    <div class="info-text">Click to hear Text</div>
                                    <br>
                                    <!-- </span> -->
                                <?php } else {
                                ?>
                                    <a @if($alert_popup_feature_action_button->action_type != 'stripe') href="<?= $input_href ?>" @endif <?php if ($alert_popup_feature_action_button->action_type == 'text_popup') { ?> onclick="openPopupText('actPopupText<?= $alert_popup_feature_action_button->id ?>')" <?php } ?> onclick="closeModal()" class="btn btn-default text-bold {{$class}} {{$playaudio}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?>
                                    </a><br>
                            <?php
                                }
                            }
                            ?>

                        <?php } ?>

                        <?php
                        if (isset($alert_popup_new_action_button->active) && $alert_popup_new_action_button->active == '1') {
                            $class = '';
                            $playaudio = '';
                            $playactionaudio = '';
                            $data_toggle = '';
                            $data_target = '';
                            if ($alert_popup_new_action_button->action_type == 'call' || $alert_popup_new_action_button->action_type == 'sms' || $alert_popup_new_action_button->action_type == 'email') {

                                switch ($alert_popup_new_action_button->action_type) {
                                    case 'sms':
                                        $input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $alert_popup_new_action_button->action_button_phone_no_sms));
                                        break;
                                    case 'call':
                                        $input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $alert_popup_new_action_button->action_button_phone_no_calls));
                                        break;
                                    case 'email':
                                        $input_href = 'mailto:' . $alert_popup_new_action_button->action_button_action_email;
                                        break;
                                }
                            } elseif ($alert_popup_new_action_button->action_type == 'stripe') {
                                // Show Stripe button when action_type is 'stripe'
                                $class = 'stripe';
                            } elseif ($alert_popup_new_action_button->action_type == "video") {


                                $input_href = get_blog_image($alert_popup_new_action_button->action_button_video);
                                // $target = "_blank";
                                $data_target = "#video_modal";
                                $data_toggle = 'modal';
                            } elseif ($alert_popup_new_action_button->action_type == "address") {

                                $address =  getaddress_info($alert_popup_new_action_button->address_id);

                                $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                $input_href = "http://maps.google.com/maps?q=" . $address_full;
                                $target = "_blank";
                            } elseif ($alert_popup_new_action_button->action_type == "audioiconfeature") {

                                if ($alert_popup_new_action_button->action_button_audio_icon_feature) { ?>
                                    <div class="action-audio">
                                        <audio class="hidden" id="alertpop2Audio_<?= $alert_popup_new_action_button->id ?>" controls>
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_new_action_button->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_new_action_button->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/' . get_current_url() . $alert_popup_new_action_button->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                        </audio>
                                    </div>
                                    <?php
                                }
                                $input_href = '#' . $alert_popup_new_action_button->action_button_audio_icon_feature;
                            } elseif ($alert_popup_new_action_button->action_type == "google_map") {

                                $address_full = isset($alert_popup_new_action_button->map_address) ? $alert_popup_new_action_button->map_address : "";
                                $input_href = "http://maps.google.com/maps?q=" . $address_full;
                                $target = "_blank";
                            } else {
                                if ($alert_popup_new_action_button->action_type == "link") {
                                    $target = "_blank";
                                    $input_href =  $alert_popup_new_action_button->link;
                                } else {
                                    $class = 'menuitem';
                                    // if($alert_popup_new_action_button->action_type =='audiofeature'){
                                    //     $playaudio='playaudiofile';
                                    // }
                                    if ($alert_popup_new_action_button->action_type == 'audiofeature') {
                                        $playaudio = '';
                                        $playactionaudio = 'playactionaudio';
                                        $audio = 'myAudio-' . $alert_popup_feature_action_button->action_type;
                                    ?><div class="action-audio"> <?php
                                                                    if ($alert_popup_new_action_button->action_button_audio) {
                                                                        $audio_file = $alert_popup_new_action_button->action_button_audio;      ?>
                                                <audio class="hidden" id="myAudio-<?= $alert_popup_new_action_button->action_type ?>-2" controls>
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/mp3">
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/ogg">
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $audio_file) ?>" type="audio/mpeg">
                                                </audio>
                                                <!-- <div class="bottomrightdiv"> -->
                                        </div>
                        <?php
                                                                    }
                                                                    $input_href = '#' . $alert_popup_new_action_button->action_type;
                                                                }
                                                                $input_href = '#' . $alert_popup_new_action_button->action_type;
                                                            }
                                                        }
                        ?>

                        <?php
                            if (isset($alert_popup_new_action_button->action_type) && ($alert_popup_new_action_button->action_type == "address"  || $alert_popup_new_action_button->action_type == "google_map")) {
                        ?>
                            <a href='<?= $input_href ?>' class="btn btn-default text-bold {{$class}}" target="<?= $target ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                            } elseif (isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == "customforms") {
                        ?>
                            <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_new_action_button->custom_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                            } elseif (isset($alert_popup_new_action_button->action_type) && $alert_popup_feature_action_button->action_type == "eventForms") {
                        ?>
                            <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_feature_action_button->event_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                            } elseif (isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == "video") { ?>
                            <a id="alertPopupFeatBtnNew" href="<?= $input_href ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" <?php if ($alert_popup_new_action_button->action_type == "video") { ?> onclick="openVideo('alertPopupFeatBtnNew');" <?php } ?> class="btn btn-default text-bold {{$class}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>" target="<?= $target ?>">
                                <?= $alert_popup_new_action_button_text->text ?>
                            </a>
                            <div style="margin-top: -5px;<?= $alert_popup_new_action_button->color ? 'color:' . $alert_popup_new_action_button->color . ';' : '' ?> ">Click to watch video</div> <br>
                        <?php
                            } elseif ($alert_popup_new_action_button_text->action_type == "image_popup") { ?>
                            <a id="alertPopupFeatBtn" href="<?= $input_href ?>" <?php if ($alert_popup_new_action_button_text->action_type == "image_popup") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openSlider(<?= htmlspecialchars($alert_popup_new_action_button_text->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?> class="btn btn-default text-bold {{$class}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>" target="<?= $target ?>">
                                <?= $alert_popup_feature_action_button_text->text ?>
                            </a>
                            <div style="margin-top: -4px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> ">Click to watch video</div> <br>
                            <?php
                            } else {
                                if ($alert_popup_new_action_button->action_type == "link") {
                            ?>
                                <a href="<?= $input_href ?>" class="btn btn-default text-bold {{$class}}" target="<?= $target ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                            <?php } else if ($alert_popup_new_action_button->action_type == "audiofeature") { ?>
                                <a href="<?= $input_href ?>" onclick="playPauseAudio(2)" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                            <?php
                                } else if ($alert_popup_new_action_button->action_type == "audioiconfeature" && isset($alert_popup_new_action_button->action_button_audio_icon_feature)) { ?>
                                <!-- <span onclick="playPauseAudio('alertpop2Audio_<?= $alert_popup_new_action_button->id ?>')" style="<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> "> -->
                                <!-- <span>
                                    <i class="fa fa-volume-up" style="margin-top:6px;" aria-hidden="true"></i>
                                </span>
                                <a href="<?= $input_href ?>" onclick="playPauseAudio('alertpop2Audio_<?= $alert_popup_new_action_button->id ?>')" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                                <div style="margin-top: -5px;">Click to hear Text</div>
                                <br> -->

                                <a href="<?= $input_href ?>" onclick="playPauseAudio('alertpop2Audio_<?= $alert_popup_new_action_button->id ?>')" class="btn btn-default btn-adjustable text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="position:relative;margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>">
                                    <span style="position:absolute;left:10px;">
                                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                                    </span><span class="text"><?= $alert_popup_new_action_button_text->text ?></span></a><br>
                                <div class="info-text">Click to hear Text</div>
                                <br>
                                <!-- </span> -->
                            <?php } else { ?>
                                <a @if($alert_popup_new_action_button->action_type != 'stripe') href="<?= $input_href ?>" @endif onclick="closeModal()" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                                }
                            }
                        ?>

                    <?php } ?>

                    <?php if (isset($alert_popup_terminate_action_button->active) && $alert_popup_terminate_action_button->active == '1') { ?>
                        <button type="button" onclick="location.href='https://google.com';" class="btn btn-default text-bold" style="<?= $alert_popup_terminate_action_button_text->color ? 'color:' . $alert_popup_terminate_action_button_text->color . ';' : '' ?> <?= $alert_popup_terminate_action_button_text->bg_color ? 'background:' . $alert_popup_terminate_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_terminate_action_button_text->text ?></button>
                    <?php } ?>
                    <?php if (isset($alert_popup_proceed_action_button->active) && $alert_popup_proceed_action_button->active == '1') { ?>
                        <button type="button" class="btn btn-default text-bold" onclick="closeModal()" style="<?= $alert_popup_proceed_action_button_text->color ? 'color:' . $alert_popup_proceed_action_button_text->color . ';' : '' ?> <?= $alert_popup_proceed_action_button_text->bg_color ? 'background:' . $alert_popup_proceed_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_proceed_action_button_text->text ?></button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php }  ?>
<?php if (isset($_GET['editwebsite']) && $_GET['editwebsite'] === 'true' && $alertPopupSetting->popup_active == 0) { ?>
    <div class="d-flex align-items-center">
        <!-- <div class="title-2">Alert Banner</div> -->
        <x-tutorial-action-buttons title='Popup Alert' :buttons="isset($tutorial_action_buttons['popup_alert']) ? $tutorial_action_buttons['popup_alert']:'' " url='quicksettings?block=popup_alert_bluebar' :popup="isset($alertPopupSetting->popup_active)?$alertPopupSetting->popup_active:''" :midnightCrossedSinceUpdate="isset($midnightCrossedSinceUpdate)?$midnightCrossedSinceUpdate:''" />

    </div>
<?php
}
?>
<?php if (isset($_GET['editwebsite'])) { ?>
<?php
    $showpopdes = false;
    foreach ($outlineSettings as $outlineSettingsSingel) {
        if (isset($outlineSettingsSingel->active) && $outlineSettingsSingel->active == '1') {
            $showpopdes = true;
        }
    }
} ?>

@include('sections.footer.styles')

<?php
$backDashboard = '';
if (isset($_GET['editwebsite'])) {
    $backDashboard = '
            <div class="back-dashboard-div back-dashboard-div-right-60">
                <a href="' . url('settings?block=footer_bluebar') . '" target="_blank">
                    <div class="d-flex align-items-center">
                        <div class="title-2">Footer</div>
                    </div>
                    <img src="' . url('assets/uploads/' . get_current_url() . 'edit-round.png') . '" class="edit-icon">
                </a>
            </div>';
}
?>
<!-- <div class="position-relative footer_outline">
    <footer id="footer" style="<?php if ($footerSettings->footre_back_color) { ?>background:<?= $footerSettings->footre_back_color ?><?php } ?>;">
</div> -->
<?php
$backDashboard = '';
if (isset($_GET['editwebsite'])) {

?>
    <div class="row">

        <div class="form-bottom make-sticky features-toggle header">
            <x-dashboard-guide :buttons="isset($toggle_and_outline) ? $toggle_and_outline:''" :audio_div="($audioFiles->audio_files && json_decode($audioFiles->audio_files))?'1':'0'" />
            <div class="">
                <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons title='Feature Toggle' :buttons="isset($tutorial_action_buttons['feature_toggle']) ? $tutorial_action_buttons['feature_toggle']:'' " />
                </div>
            </div>
            <div class="">
                <div class=" d-flex  text-center align-items-center" style="justify-content: space-evenly">
                    <div class="vertical-middle col-md-6">
                        <div class="label-sort label-sort-grey">Enabled Features Only</div>
                    </div>
                    <div class="form-group frontend" style="margin-bottom:0px;">
                        <label class="switch">
                            <input type="checkbox" class="enableswitch_all_features enableswitch" name="all_feature_for_edit_website" <?= $front_section_settings->all_feature_for_edit_website == 1 ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="vertical-middle col-md-6">
                        <div class="label-sort label-sort-grey">All Features<br>Visible</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex col-lg-6 col-md-5 col-sm-5 justify-content-center color-main-div" style="padding: 9px;flex-direction:column;">
                    <div class="row align-items-center d-flex justify-content-center color_div p-1">
                        <div>
                            <img src='<?= url('assets/admin2/img/yellow_line.svg') ?>' alt="" width="" class="dismiss-color">
                        </div>
                        <div class="">
                            <div class="inputcolordiv">
                                <div class="inputcolor header_input_color"></div>
                                <input type="color" class="colorinput" name="tutorial_background" id="bannerbackgroundcolor" value="" placeholder="#FFF500">
                            </div>
                        </div>
                    </div>
                    <div class="row label-sort label-sort-grey text-center">Outline Color</div>
                </div>
                <div class="d-flex col-lg-6 col-md-5 col-sm-5 justify-content-center color-main-div" style="padding: 9px;flex-direction:column;">
                    <div class="row align-items-center d-flex justify-content-center color_div p-1">
                        <div>
                            <img src='<?= url('assets/admin2/img/yellow_line.svg') ?>' alt="" width="" class="dismiss-color-label">
                        </div>
                        <div class="">
                            <div class="inputcolordiv">
                                <div class="inputcolor header_input_color_label"></div>
                                <input type="color" class="colorinput updateoutlinecolor" id="label_color" name="label_color" value="<?= isset($siteSettings->tutorial_label_color) ? $siteSettings->tutorial_label_color : '#000000' ?>" placeholder="#000000" data-slug="label_color" placeholder="#FFF500">
                            </div>
                        </div>
                    </div>
                    <div class="row label-sort label-sort-grey text-center">Label Color</div>
                </div>
            </div>
            <div class="audio-file-label">
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons title='Audio File' :buttons="isset($tutorial_action_buttons['footer_audio']) ? $tutorial_action_buttons['footer_audio']:'' " url='quicksettings?block=audio_files_bluebar' />
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
@if(isset($_GET['editwebsite']))
@endif
<div class="footer-top position-relative footer_outline" style="margin-top: -83px;">
    <div class="footer-box row" style="margin-top: 100px !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 col-sm-12 footer-links ">
                    <div class="col-md-5 col-sm-7 icons-container" style="max-width:max-content;">
                        <!-- <div class="row"> -->
                        <div class="col-md-12 col-sm-9 social_media_footer_container p-0">

                            <?php if ($socialMedias) {
                                $header_socialmedia = ($socialMedias); ?>
                                <?php foreach ($header_socialmedia as $single) { ?>

                                    <a target="_blank" href="<?= $single->link ?>" class="sicialmediaicon">
                                        @if(geticons($single->icon_id) == 'fa fa-twitter')
                                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" width="18px" viewBox="-30 -50 512 512" fill="<?php if ($social_media_icon->color) {
                                                                                                                                                echo $social_media_icon->color;
                                                                                                                                            } ?>">
                                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                        </svg>
                                        @else
                                        <i style="font-size:17px !important;" class="fa-icon <?= geticons($single->icon_id) ?>"></i>
                                        @endif
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- <div class="col-md-3 col-md-3 social-media" style="padding: 0px;">
                        <h4 href="https://enfohub.com/" style="color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><a href="https://enfohub.com/"><?= $footerSettings->footer_text_1 ? $footerSettings->footer_text_1 : '' ?></a></h4>
                                </h4>
                           
                        </div> -->
                    </div>

                    <div class="container other-text col-lg-7 col-sm-5 upper-footer-content p-0">
                        <!-- <div class="mt-2"> -->

                        <h4 href="https://enfohub.com/" id="copyright-text" style="margin-top:24px;color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><a href="https://enfohub.com/"><?php echo $footerSettings->copy_right_text ? $footerSettings->copy_right_text : '&copy; ' . date("Y") ?></a>
                            <?php if ($footerSettings->footer_text) { ?>
                                <a href="<?= $footerSettings->footre_text_link ? $footerSettings->footre_text_link : '#' ?>"><?= $footerSettings->footer_text ?></a>
                            <?php } ?><br><?php echo $footerSettings->footer_text_2 ? $footerSettings->footer_text_2 : '' ?>
                        </h4>
                        <?php if (false && $businessInfo->address_for_map) { ?>
                            <h4 class="address_for_map" style="color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><?= $businessInfo->address_for_map ?></h4>
                        <?php } ?>

                        <!-- </div> -->
                    </div>

                </div>
                <div class="row low">
                    <div class="col-md-4 col-sm-12 footer_logo_div">
                        <h4 style="color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><a style="color:#656262;" href="https://enfohub.com/">This website was built using the<br>
                                <span style="display:inline-block; height: 26px;"></span>
                                <strong style="font-weight: 900;font-size:15.5px">enfohub</strong>
                                Website Builder App</a></h4>
                    </div>
                    <div class="col-md-8 col-sm-12 footer_div">
                        <h4 style="text-align: justify;"><a style="color:#656262;" href="https://enfohub.com/">The enfohub Website Builder is designed specifically for Small Businesses. It offers an advanced, user-friendly platform with integrated business tools. New customers receive an App Manager for personalized coaching on Website usage, Marketing strategies, and other Small Business essentials. Our Learning Centers enable you to learn independently and at your own pace.
                                <br>
                                <br>
                                enfohub: It's more than just a website! Get our Free Task Manager from your App store. </a></h4>
                    </div>


                </div>
            </div>
            <div class="col-md-12 col-sm-12 footer_div_last">

            </div>
        </div>
    </div>
    <div class="container py-4 ">

    </div>
    </footer><!-- End Footer -->
</div>

<?php

if (audio_enabled($frontSections)) {

?>
    @if(isset($_GET['editwebsite']))

    @endif
    <div class="footer-audio">
        <?php if ($audioFiles->audio_files && json_decode($audioFiles->audio_files)) {
            $audio_files = json_decode($audioFiles->audio_files); ?>
            <?php foreach ($audio_files as $single) {

                if (isset($single->title) && !empty($single)) {

            ?>
                    <audio id="myAudio-footer" controls <?php if ($audioFiles->audio_auto_play == '1') {
                                                            echo 'autoplay';
                                                        } ?> <?php if ($audioFiles->audio_repeat == '1') {
                                                                    echo 'loop';
                                                                } ?>>
                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->file) ?>" type="audio/mp3">
                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->file) ?>" type="audio/ogg">
                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->file) ?>" type="audio/mpeg">
                    </audio>

            <?php break;
                }
            } ?>
        <?php } ?>

    </div>

    <div class="bottomrightdiv">
        <img class="playmuteaudio lazyload" onclick="playPauseAudio('myAudio-footer')" data-src="<?= ($audioFiles->audio_auto_play) ? url('assets/front/img/volumn.jpg') : url('assets/front/img/muted.jpg') ?>" width="40px" height="40px" alt="">
    </div>
<?php
}
?>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?= url('assets/front/'); ?>/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/php-email-form/validate.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/counterup/counterup.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/venobox/venobox.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/aos/aos.js"></script>

<script src="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= url('assets/front/'); ?>/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#popupalert').on('click', function(event) {
            if (!$(event.target).is('button')) {
                $('#popupalert').modal('hide');
            }
        });
        $.ajax({
            url: '/record-visitor',
            method: 'POST',
            data: JSON.stringify({
                visitors: 1
            }), // Send 1 for each visit
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data.message);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
        $(document).on('click', function() {
            // Send an AJAX request to the server for each click
            $.ajax({
                url: '/record-click',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                contentType: 'application/json',
                data: JSON.stringify({
                    click: 1 // Sending 1 for each click
                }),
                success: function(response) {
                    console.log('Click recorded successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error recording click:', error);
                }
            });
        });

        const selectedCategories = new Set();

        // Handle Like Category Selection
        $('.business-svg, .service-svg, .website-svg').on('click', function() {
            const category = $(this).data('category');

            // Skip if category is undefined or empty
            if (!category) return;

            // Check if the category is already selected
            if (selectedCategories.has(category)) {
                selectedCategories.delete(category);
                // Reset the SVG's fill color to white
                $(this).find('svg path').css('fill', 'white');
                $(this).find('svg path').css('stroke', 'black');
            } else {
                selectedCategories.add(category);
                // Set the SVG's fill color to red
                $(this).find('svg path').css('fill', 'red');
            }
        });


        // Submit Likes Function
        function submitLikes(callback = null) {
            if (selectedCategories.size === 0) {
                if (callback) callback(); // If no likes, directly trigger the callback
                return;
            }
            $('#likesModal').modal('hide');
            $.ajax({
                url: '/increment-likes',
                type: 'POST',
                data: {
                    categories: Array.from(selectedCategories), // Convert Set to Array
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    // Clear selections and reset UI
                    selectedCategories.clear();
                    $('.business-svg, .service-svg, .website-svg').css('color', 'black');

                    if (callback) callback(); // Execute callback after success
                },
                error: function(xhr) {
                    alert('Failed to submit likes. Please try again.');
                }
            });
        }

        // Handle Submit a Like Button Click
        $('.submit-like-btn').on('click', function() {
            if (selectedCategories.size === 0) {
                alert('Please select at least one category!');
                return;
            }

            submitLikes(() => {
                // Show thank you modal after likes are submitted
                $('#thankYouModal').modal('show');
                setTimeout(() => {
                    $('#thankYouModal').modal('hide');
                    $('#likesModal').modal('hide');
                }, 3000);
            });
        });
        $('.read-comments-btn').on('click', function() {
            // Show the modal
            $('#commentsModal').modal('show');

            // Clear existing comments
            $('.comments-list').html('<p>Loading comments...</p>');

            // Fetch comments via AJAX
            $.ajax({
                url: '/comments', // Adjust URL as needed
                method: 'GET',
                success: function(response) {
                    // Clear the comments list
                    $('.comments-list').html('');

                    // Check if there are any comments (response is an object with properties)

                    // Convert the object into an array of values (the comment objects)
                    const comments = Object.values(response);
                    if (comments.length > 0) {
                        // Loop through the comments and render them
                        comments.forEach(function(comment) {
                            const commentHtml = `
                <div class="comment-item mb-3">
                    <p class="mb-1">${comment.comment}</p>
                    <small class="text-muted italic">
                    <i style="font-family:Arial;">
                        ${new Date(comment.created_at).toISOString().split('T')[0]} • Added by 
                        <strong>${comment.name || 'Not Disclosed'}</strong></i>
                    </small>
                </div>
            `;
                            $('.comments-list').append(commentHtml);
                        });
                    } else {
                        // If no comments, show a message
                        $('.comments-list').html('<p>No comments yet.</p>');
                    }
                },

                error: function(xhr, status, error) {
                    // Handle errors
                    $('#commentsList').html('<p>Failed to fetch comments. Please try again later.</p>');
                    console.error('Error fetching comments:', error);
                }
            });
        });

        $('.submit-comment-btn').click(function() {
            // Submit the comment logic goes here...
            // (This is just a placeholder for your actual submit logic)

            // Close all modals
            // $('.modal').modal('hide');
            // $('.likesModal').modal('hide');

            // // Show the "Thank You" popup
            // $('#thankYouModal').modal('show');
        });

        // Close the "Thank You" popup when the user clicks outside the modal or on the close button
        $('#thankYouModal').on('hidden.bs.modal', function() {
            // Optionally, you can reset the SVG and message here if needed
        });

        $('#engagementCommentForm').on('submit', function(e) {
            e.preventDefault();
            if ($('#comment').val().trim() == '') {
                alert('Comment field is empty');
                return;
            }
            const formData = {
                name: $('#user_name').val(),
                comment: $('#comment').val(),
            };

            $.ajax({
                url: '/engagement-comments',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    // $('.modal').modal('hide');
                    $('.likesModal').modal('hide');

                    // // Show the "Thank You" popup
                    $('#thankYouModal').modal('show');
                    $('#engagementCommentModal').modal('hide');
                    $('#engagementCommentForm')[0].reset();
                    setTimeout(function() {
                        $('#thankYouModal').modal('hide');
                    }, 3000); // 3000ms = 3 seconds
                },
                error: function(xhr) {
                    setTimeout(function() {
                        $('#thankYouModal').modal('hide');
                    }, 3000); // 3000ms = 3 seconds
                    // alert('An error occurred while submitting the comment.');
                },
            });
        });
        $('#openCommentModal').on('click', function() {
            $('#likesModal').modal('hide');
            $('#engagementCommentModal').modal('show');
            $(this).off('hidden.bs.modal');
        });
        $('#openCommentModal').on('click', function() {
            // Submit likes if any before showing the comment modal
            submitLikes(() => {
                $(this).off('hidden.bs.modal');
                // Show the comment modal after likes are submitted
                $('#engagementCommentModal').modal('show');
            });
        });
        $('.like-icon').on('click', function() {
            if ($(this).find('svg').hasClass('ch-clr')) {
                // Change the clicked SVG to red if it has the 'ch-clr' class
                $(this).find('svg path').attr('fill', 'red').attr('stroke', 'red');
            }

            // $(this).find('svg path').attr('fill', 'red').attr('stroke', 'red');
        });
        // Check if the 'payment' parameter is in the URL
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('payment') === 'success') {
            // If payment is successful, show the modal
            $('#success-modal').modal('show');
        } else if (urlParams.get('payment') === 'failed') {
            $('#failed-stripe-modal').modal('show');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        var footerOutline = document.querySelector('.footer_outline');

        if (footerOutline) {
            // Traverse up the DOM to find the first parent with the class 'container'
            var parentElement = footerOutline;
            while (parentElement) {
                parentElement = parentElement.parentElement;
                if (parentElement && parentElement.classList.contains('container')) {
                    parentElement.style.marginBottom = '100px';
                    console.log(parentElement);
                    break;
                }
            }
        }
        // Get the background color of the header class
        var headerDiv = document.querySelector('.headerdiv');
        if (headerDiv) {
            // Get the background color of the header
            var headerBackgroundColor = getComputedStyle(headerDiv).backgroundColor;
        }

        // Check if the background color is transparent
        if ((headerBackgroundColor === 'rgba(0, 0, 0, 0)' || headerBackgroundColor === 'transparent') && headerDiv) {
            // Get the background color of the body
            var headerBackgroundColor = getComputedStyle(document.body).backgroundColor;

            // Log or use the body's background color
            // console.log('Header background is transparent. Body background color:', headerBackgroundColor);
        } else {
            // Log or use the header's background color
            // console.log('Header background color:', headerBackgroundColor);
            headerBackgroundColor = 'white';
        }
        const alertBannerBackgroundColor = getComputedStyle(document.querySelector('#header')).backgroundColor;
        let headerPhoneNumberColor;

        var header_phone_text = '<?php echo $header_phone_text->color; ?>';
        if (header_phone_text) {
            headerPhoneNumberColor = header_phone_text;
        } else {
            headerPhoneNumberColor = 'white';
        }
        // Apply the background color to the footer
        document.querySelector('.footer-links').style.backgroundColor = headerBackgroundColor;
        document.querySelector('.footer-box').style.backgroundColor = alertBannerBackgroundColor;
        const upper_footer = document.querySelector('.upper-footer-content');
        const h4Tags = upper_footer.querySelectorAll('h4');
        h4Tags.forEach(function(h4) {
            h4.style.setProperty('color', headerPhoneNumberColor, 'important');
            const aTags = h4.querySelectorAll('a');
            aTags.forEach(function(a) {
                a.style.setProperty('color', headerPhoneNumberColor, 'important');
            });
        });
        const alertBannerTextColor = getComputedStyle(document.querySelector('.alertbannertext > a')).color;
        document.querySelector('.footer_logo_div a').style.color = alertBannerTextColor;
        document.querySelector('.footer_div a').style.color = alertBannerTextColor;


    });
    $('.enableswitch_all_features').change(function() {
        var checkboxName = $(this).attr('name');
        var isChecked = $(this).prop('checked') ? 1 : 0;
        $.ajax({
            type: 'POST',
            url: '/frontSetting',
            data: {
                name: checkboxName,
                value: isChecked,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    $('.popup_switch').change(function() {
        var checkboxName = $(this).attr('name');
        var isChecked = $(this).prop('checked') ? 1 : 0;
        // return;
        $.ajax({
            type: 'POST',
            url: '/popupswitch',
            data: {
                name: checkboxName,
                value: isChecked,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    function closeModal() {
        setTimeout(
            function() {
                $('#popupalert').modal('toggle');
            }, 1000);
    }
</script>