@extends('admin.layout.dashboard')
@section('content')

<script>
    var sub_sections = ["audio_files", "header_text", "header_images", "newsfeed", "news_posts", "popup_alert",
        "alert_banner", "action_buttons"
    ];
</script>

<?php
$block = isset($_GET['block'])  ? $_GET['block'] : '';
?>
<div id="content">
    <div class="fixJumButtons mb-18">
        <div class="d-sm-flex justify-content-between align-items-center">
            <div class="title-1 text-color-blue2">Quick Editing</div>
            <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
                <div class="col-md-7 col-lg-7">
                    <div class="row d-flex justify-content-around">
                        <div class="col-4 title-2 mb-1" style="text-align: center;">Popup Alert</div>
                        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Tip Popups</div>
                        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Notifications</div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <label class="myswitchdiv popupTool">
                            <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
                            <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
                        </label>
                        <label class="myswitchdiv">
                            <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',subsections)">
                            <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
                        </label>
                        <label class="myswitchdiv switch_disabled">
                            <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
                            <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
                        </label>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-4 col-sm-4 title-2 mb-1 popupOnOffStatus" style="text-align: center;">&nbsp;</div>
                        <div class="col-4 col-sm-4 title-2 mb-1 tipOnOffStatus" style="text-align: center;">&nbsp;</div>
                        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Controls in Settings</div>
                    </div>
                </div>
                <div class="ml-17">
                    <div class="dropdown-list-main-div">
                        <div class="dropdown-list">
                            <div class="title-3 text-color-grey listtxt">Quick Settings</div>
                            <div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="10px">
                            </div>
                        </div>
                        <div class="dropdown-list-div">
                            <ul>
                                <?php if (check_auth_permission(['popup_alert', 'popup_active', 'popup_alert_title', 'popup_alert_message', 'popup_image', 'popup_timed_image'])) { ?>
                                    <li data-value="popup_alert_bluebar">Popup Alert</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['alert_banner', 'alert_banner_text'])) { ?>
                                    <li data-value="alert_banner_bluebar">Alert Banner</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['header_block', 'header_slider', 'header_logo', 'header_image_title', 'header_image', 'header_image_description', 'header_slider_upload_image', 'header_block_timed_images'])) { ?>
                                    <li data-value="header_images_bluebar">Header Images</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['header_action_buttons'])) { ?>
                                    <li data-value="action_btns_bluebar">Header Buttons</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['address_at_header', 'header_text', 'header_phone_text', 'header_address_street', 'header_address_location', 'header_address_comment', 'header_address_title'])) { ?>
                                    <li data-value="header_text_bluebar">Header Text</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['news_posts', 'add_news_post', 'news_post_actions'])) { ?>
                                    <li data-value="news_posts_bluebar">News Posts</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['news_feed'])) { ?>
                                    <li data-value="newsfeed_bluebar">News Feed</li>
                                <?php } ?>
                                <?php if (check_auth_permission(['audio_files', 'auto_play', 'audio_repeat', 'select_audio'])) { ?>
                                    <li data-value="audio_files_bluebar">Audio Files</li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (session()->get('email_message')) { ?>
        <div id="message" class="alert alert-primary alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <?= session()->get('email_message') ?>

        </div>
    <?php session()->forget('email_message');
    } ?>



    <?php if (check_auth_permission([
        'popup_alert',
        'popup_active',
        'popup_alert_title',
        'popup_alert_message',
        'popup_image',
        'popup_timed_image'
    ])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="popup_alert_bluebar" data-top="popup_alert_top" data-bottom="popup_alert_bottom" data-tip_section="popup_alert">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center titlediv d-flex">
                        <div class="title-1 text-color-blue ">Popup Alert</div>
                        <?php if (check_auth_permission(['popup_active'])) { ?>
                            <div class="position-relative switchoverhead">
                                <div class="switchbtns">
                                    <div class="form-group ml-20">
                                        <div class="title-2  mt-3">See Popup Icon above to Activate</div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="d-flex  align-items-center">
                        <div class="enable-disable-feature-div enable-feature-div" <?= $alert_popup_setting->popup_active ? 'style="display:block"' : 'style="display:none"' ?>>
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        <div class="enable-disable-feature-div disable-feature-div" <?= !$alert_popup_setting->popup_active ? 'style="display:block"' : 'style="display:none"' ?>>
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        <div class="ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>


            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'popup_alert_bluebar' ? 'display:block;' : '' ?>">
                <form class="data-form" action="{{ url('updatealertpopup') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="popup_alert_top"></div>

                    <div class="top-right">
                    </div>
                    <?php if (check_step_image('Popup Alert Image')) { ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow 1-Step
                                    Button to Expire</h5>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['popup_image'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="title-2">Popup Image</div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <div class="row">
                                    <?php if (check_auth_permission(['popup_alert', 'popup_image'])) { ?>
                                        <?php if (isset($popup_image->file_name) && $popup_image->file_name) { ?>
                                            <div class="col-md-3 popup_image_div">
                                                <div class="form-group mb-3">
                                                    <label for="headerlogo">Popup Image</label>
                                                    <img src="<?= url('assets/uploads/' . get_current_url() . $popup_image->file_name) ?>" width="100%">
                                                    <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $popup_image->file_name ?>','alert_popup_image','popup_image_div','images','0','true')">X</button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="uploadImageDiv">
                                                <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                    <div class="vertical-middle">
                                                        <div class="title-3 text-color-grey2 text-center">Upload Default Image</div>
                                                        <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                <input class="dataimage" type="hidden" name="popup_image">

                                                <div class="col-md-6 imgdiv" style="display:none">
                                                    <br>
                                                    <img src='' width="100%" class="imagefromgallerysrc">
                                                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row nopadding datetimediv_popup">
                                                <div class="col-md-6 nopadding">
                                                    <div class="form-group">
                                                        <label for="width">Width</label>
                                                        <input type="number" min="0" name="popup_image_width" class="myinput2" id="popup_image_width" placeholder="width in px" value="<?= $popup_image->max_width ?>" onblur="updateWidth(this.value)">
                                                        <input type="hidden" id="width_modified" name="width_modified" initial-width="{{ $popup_image->max_width }}" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['popup_timed_image'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="d-flex align-items-center">
                                            <div class="title-2">Timed Image Settings</div>
                                            <div class="form-group m-0 ml-3">
                                                <label class="switch m-0">
                                                    <input type="checkbox" class="notificationswitch timeimagesswitch" name="enable_timed_popup_image" <?= $timed_popup_image->enable ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <div class="timedimages <?php //echo $timed_popup_image->enable ? '' : 'hidden'
                                                        ?>">
                                    <?php
                                    $start_time = new DateTime($timed_popup_image->start_time, new DateTimeZone(getFrontDataTimeZone()));

                                    $end_time = new DateTime($timed_popup_image->end_time, new DateTimeZone(getFrontDataTimeZone()));

                                    $days = json_decode($timed_popup_image->days);
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4">

                                            <?php if (isset($timed_image->file_name) && $timed_image->file_name) { ?>
                                                <div class="timed_popup_image_div">
                                                    <img src='<?= url('assets/uploads/' . get_current_url() . $timed_image->file_name) ?>' width="100%">
                                                    <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_image->file_name ?>','timed_popup_image','timed_popup_image_div','images','0','true')">X</button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="uploadImageDiv">
                                                    <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                        <div class="vertical-middle">
                                                            <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                                            </div>
                                                            <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                    <input class="dataimage" type="hidden" name="timed_popup_image">

                                                    <div class="col-md-6 imgdiv" style="display:none">
                                                        <br>
                                                        <img src='' width="100%" class="imagefromgallerysrc">
                                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="timed_popup_image_type">Type</label>
                                                <select name="timed_popup_image_type" class="myinput2 timed_image_type" id="timed_popup_image_type">
                                                    <option value="days" <?= $timed_popup_image->type == 'days' ? 'selected' : '' ?>>By Days</option>
                                                    <option value="timer" <?= $timed_popup_image->type == 'timer' ? 'selected' : '' ?>>Timer</option>
                                                </select>
                                            </div>

                                            <div class="uploadImageDiv">
                                                <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload</button>

                                                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                <input class="dataimage" type="hidden" name="timed_popup_image">

                                                <div class="col-md-6 imgdiv" style="display:none">
                                                    <br>
                                                    <img src='' width="100%" class="imagefromgallerysrc">
                                                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="timed_type_divs timer_div" style="<?= $timed_popup_image->type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                                                <div class="form-group">
                                                    <label for="timed_popup_image_timer">Timer</label>
                                                    <select name="timed_popup_image_timer" class="myinput2" id="timed_popup_image_timer">
                                                        <option value="15" <?= $timed_popup_image->image_timer == '15' ? 'selected' : '' ?>>15 min</option>
                                                        <option value="30" <?= $timed_popup_image->image_timer == '30' ? 'selected' : '' ?>>30 min</option>
                                                        <option value="60" <?= $timed_popup_image->image_timer == '60' ? 'selected' : '' ?>>1 hour</option>
                                                        <option value="120" <?= $timed_popup_image->image_timer == '120' ? 'selected' : '' ?>>2 hour</option>
                                                        <option value="240" <?= $timed_popup_image->image_timer == '240' ? 'selected' : '' ?>>4 hour</option>
                                                        <option value="360" <?= $timed_popup_image->image_timer == '360' ? 'selected' : '' ?>>6 hour</option>
                                                        <option value="480" <?= $timed_popup_image->image_timer == '480' ? 'selected' : '' ?>>8 hour</option>
                                                        <option value="720" <?= $timed_popup_image->image_timer == '720' ? 'selected' : '' ?>>12 hour</option>
                                                        <option value="1440" <?= $timed_popup_image->image_timer == '1440' ? 'selected' : '' ?>>24 hour</option>
                                                        <option value="2880" <?= $timed_popup_image->image_timer == '2880' ? 'selected' : '' ?>>48 hour</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="timed_type_divs days_div" style="<?= $timed_popup_image->type == 'days' ? 'display:block;' : 'display:none;' ?>">
                                                <div class="form-group">
                                                    <label for="start_time">Start Time</label>
                                                    <input type="time" name="timed_popup_image_start_time" class="myinput2" id="start_time" value="<?php echo $start_time->format('H:i'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="end_time">End Time</label>
                                                    <input type="time" name="timed_popup_image_end_time" class="myinput2" id="end_time" value="<?php echo $end_time->format('H:i'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Select Days</label>
                                                    <select class="myinput2 multiselectlist h-auto" name="days[]" multiple>
                                                        <option value="mon" <?= is_array($days) && in_array('mon', $days) ? 'selected' : '' ?>>Monday
                                                        </option>
                                                        <option value="tue" <?= is_array($days) && in_array('tue', $days) ? 'selected' : '' ?>>Tuesday
                                                        </option>
                                                        <option value="wed" <?= is_array($days) && in_array('wed', $days) ? 'selected' : '' ?>>Wednesday
                                                        </option>
                                                        <option value="thu" <?= is_array($days) && in_array('thu', $days) ? 'selected' : '' ?>>Thursday
                                                        </option>
                                                        <option value="fri" <?= is_array($days) && in_array('fri', $days) ? 'selected' : '' ?>>Friday
                                                        </option>
                                                        <option value="sat" <?= is_array($days) && in_array('sat', $days) ? 'selected' : '' ?>>Saturday
                                                        </option>
                                                        <option value="sun" <?= is_array($days) && in_array('sun', $days) ? 'selected' : '' ?>>Sunday
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['popup_alert_title', 'popup_alert_message'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="title-2">Popup Alert Settings</div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">

                                <div class="form-group m2-20">
                                    <div class="title-2">Activate for Returning Visitors</div>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch updatepopup" name="popup_show_always" <?= $alert_popup_setting->popup_show_always ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <?php if (check_auth_permission('popup_alert_title')) { ?>
                                    <div class="row">
                                        <div class="col-md-3" id="popup_alert_title">
                                            <div class="form-group">
                                                <label for="popupalert">Popup Alert title</label>
                                                <textarea name="popupalerttitle" class="myinput2 h-auto" id="popupalert" cols="30" rows="4"><?= $popup_alert_title->text ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="popup_text_color2">Popup Alert Title Text Size</label><br>
                                                <input type="text" class="myinput2 width-50px" name="popup_title_fontsize" id="popup_text_color2" value="<?= $popup_alert_title->size_web ?>" placeholder="18px">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="popup_text_color">Popup Alert Title Text Color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $popup_alert_title->color ?>"></div>
                                                            <input type="color" class="colorinput" name="popup_title_color" id="bannertextcolor2" value="<?= $popup_alert_title->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="display:none">
                                            <div class="form-group">
                                                <label for="popup_background_color">Popup Alert Title Font</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $popup_alert_title->bg_color ?>"></div>
                                                            <input type="color" class="colorinput" name="popup_title_background_color" id="bannertextcolor2" value="<?= $popup_alert_title->bg_color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="title_font_size">Popup Alert Title Font</label>
                                                <select class="myinput2" name="popup_title_font_family">
                                                    <?php if (count($font_family) > 0) { ?>
                                                        <?php foreach ($font_family as $single) { ?>
                                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $popup_alert_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                                <?= $single->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <?php if (check_auth_permission('popup_alert_message')) { ?>
                                        <div class="col-md-7" id="popup_alert_message">
                                            <div class="form-group  quilleditor-div">
                                                <label for="popupalert1">Popup alert message</label>
                                                <textarea name="popupalert" class="myinput2 h-auto editordata hidden" id="popupalert1" cols="30" rows="4"><?= $popup_alert_text->text ?></textarea>
                                                <div class="quilleditor">
                                                    <?= $popup_alert_text->text ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if (check_auth_permission('popup_alert')) { ?>
                                        <div class="col-md-2 hidden">
                                            <div class="form-group">
                                                <label for="popup_text_color1">Popup text color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $popup_alert_text->color ?>"></div>
                                                            <input type="color" class="colorinput" name="popup_text_color" id="bannertextcolor2" value="<?= $popup_alert_text->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Override Background</label>
                                                <label class="switch ml-7">
                                                    <input type="checkbox" class="notificationswitch override_bg_enable popup_alert_override_bg" name="popup_alert_override_bg" data-slug="alert_popup_bg_picker" <?php echo  $alert_popup_setting->popup_alert_override_bg ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group alert_popup_bg_picker" style="display:  <?php echo  $alert_popup_setting->popup_alert_override_bg ? 'block' : 'none' ?>">
                                                <label for="popup_background_color">Popup background color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $popup_alert_text->bg_color ?>"></div>
                                                            <input type="color" class="colorinput" name="popup_background_color" id="bannertextcolor2" value="<?= $popup_alert_text->bg_color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['popup_alert'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="title-2">Popup Alert Action Buttons Settings</div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bannertext">Feature action button active</label><br>
                                            <label class="switch">
                                                <input type="checkbox" class="notificationswitch" name="featureActionButton" <?= (isset($alert_popup_feature_action_button->active) && $alert_popup_feature_action_button->active) ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="feature_action_button_desc">Feature Action Button Name</label>
                                            <input type="text" class="myinput2" name="feature_action_button_desc" id="feature_action_button_desc" value="<?= $alert_popup_feature_action_button_text->text ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="feature_action_button_desc_color">Feature Action Button Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_feature_action_button_text->color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="feature_action_button_desc_color" id="bannertextcolor2" value="<?= $alert_popup_feature_action_button_text->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="feature_action_button_background_desc_color">Feature Action Button
                                                Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_feature_action_button_text->bg_color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="feature_action_button_background_desc_color" id="bannertextcolor2" value="<?= $alert_popup_feature_action_button_text->bg_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="feature_action_button_link">Feature Action Button Application</label>
                                            <select class="myinput2 header_btn2_section action_button_selection" name="feature_action_button_link">
                                                <option value="link" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'link' ? 'selected' : '' ?>>Link to Outside Site</option>
                                                <option value="call" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'call' ? 'selected' : '' ?>>
                                                    Call</option>
                                                <option value="sms" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'sms' ? 'selected' : '' ?>>
                                                    SMS Text</option>
                                                <option value="email" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'email' ? 'selected' : '' ?>>
                                                    Email</option>
                                                <option value="address" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'address' ? 'selected' : '' ?>>
                                                    Business Address</option>
                                                <option value="customforms" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'customforms' ? 'selected' : '' ?>>
                                                    Link to Form</option>
                                                <option value="image_popup" <?= isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'image_popup' ? 'selected' : '' ?>>
                                                    Popup - Image</option>
                                                <option value="text_popup" <?= isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'text_popup' ? 'selected' : '' ?>>
                                                    Popup - Text</option>
                                                <option value="video" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'video' ? 'selected' : '' ?>>
                                                    Popup - Video</option>
                                                <option value="stripe" <?= $alert_banner_action->action_type == 'stripe' ? 'selected' : '' ?>>
                                                    Popup - Payment</option>
                                                <option value="audioiconfeature" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                                    Audio File with Icon</option>
                                                <option value="google_map" <?= isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'google_map' ? 'selected' : '' ?>>
                                                    Map</option>
                                                <?php foreach ($front_sections as $single) { ?>
                                                    <option value="<?= $single->slug ?>" <?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == $single->slug ? 'selected' : '' ?>>
                                                        <?= $single->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group action_fields phone_no_calls" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for calls</label>
                                            <input type="text" class="myinput2" name="feature_action_phone_no_calls" value="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_button_phone_no_calls ?>">
                                        </div>
                                        <div class="form-group action_fields phone_no_sms" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for sms</label>
                                            <input type="text" class="myinput2" name="feature_action_phone_no_sms" value="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_button_phone_no_sms ?>">
                                        </div>
                                        <div class="form-group action_fields action_email" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Email</label>
                                            <input type="text" class="myinput2" name="feature_action_email" value="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_button_action_email ?>">
                                        </div>
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="feature_action_button_textpopup"><?php isset($alert_popup_feature_action_button->action_button_textpopup) ? $alert_popup_feature_action_button->action_button_textpopup : '' ?></textarea>
                                            <div class="quilleditor">
                                                <?php echo isset($alert_popup_feature_action_button->action_button_textpopup) ? $alert_popup_feature_action_button->action_button_textpopup : ''; ?>

                                            </div>
                                        </div>
                                        <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= (isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'audiofeature') ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                        </div>
                                        <div class="form-group action_fields audio_icon_feature" name="alertp_audio_icon_feature" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="action_button_audio_icon_feature1" id="customFile" accept=".mp3">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>

                                            <div class="row">
                                                <?php if (isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'audioiconfeature' && $alert_popup_feature_action_button->action_button_audio_icon_feature) {

                                                ?>
                                                    <div class="col-md-10 imgdiv">
                                                        <h4><?= $alert_popup_feature_action_button->action_button_audio_icon_feature ?></h4>
                                                        <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_popup_btn" data-id="<?= $alert_popup_feature_action_button->id ?>" data-imgname="<?= $alert_popup_feature_action_button->action_button_audio_icon_feature ?>">X</button>
                                                    </div>
                                                <?php


                                                } ?>
                                            </div>
                                        </div>

                                        <div class="form-group action_fields video_upload" name="feature_action_video2" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Video</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="popup_action_video" id="customFile" accept=".mp4">
                                                <label class="custom-file-label" for="customFile">Upload Video</label>
                                            </div>
                                            @if(isset($alert_popup_feature_action_button->action_button_video) && $alert_popup_feature_action_button->action_button_video !='')
                                            <div class="position-relative d-flex alert_popup_action_video">
                                                <video height="80" controls>
                                                    <source src="<?= isset($alert_popup_feature_action_button->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($alert_popup_feature_action_button->action_button_video)) : '' ?>" type="video/mp4">
                                                </video>
                                                <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='alert_popup_action_video' data-id="{{$alert_popup_feature_action_button->slug}}" data-file="{{$alert_popup_feature_action_button->action_button_video}}">X
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Images</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                                <label class="custom-file-label" for="customFile">Choose files</label>
                                            </div>
                                            @if(isset($alert_popup_feature_action_button->action_button_video) && $alert_popup_feature_action_button->action_button_video !='')
                                            <div class="position-relative d-flex alert_popup_action_video">
                                                <video height="80" controls>
                                                    <source src="<?= isset($alert_popup_feature_action_button->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($alert_popup_feature_action_button->action_button_video)) : '' ?>" type="video/mp4">
                                                </video>
                                                <div class="remove_video_action btn btn-primary" title="Click to Remove" data-type='alert_popup_action_video' data-id="{{$alert_popup_feature_action_button->slug}}" data-file="{{$alert_popup_feature_action_button->action_button_video}}">X
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="clearfix">
                                            <div class="form-group action_fields action_link" style="<?= (isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'link') ? 'display:block' : 'display:none' ?>">
                                                <input type="text" class="myinput2 btn0link" name="feature_button_text_link" id="btn0link" value="<?= isset($alert_popup_feature_action_button->link) ? $alert_popup_feature_action_button->link : '' ?>" placeholder="http://google.com">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php if (isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'audiofeature' && $alert_banner_action->action_button_audio) {

                                            ?>
                                                <div class="col-md-10 imgdiv">
                                                    <h4><?= $alert_banner_action->action_button_audio ?></h4>
                                                    <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="alert_popup_feature_action_button" data-imgname="<?= $alert_banner_action->action_button_audio ?>">X</button>
                                                </div>
                                            <?php


                                            } ?>
                                        </div>
                                        <br>
                                        <div class="clearfix action_fields action_forms" id="feature_customforms" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'customforms' ?  'display:block' : 'display:none' ?>">
                                            <div class="form-group">
                                                <label for="">Feature Action Button Custom Forms</label>
                                                <select class="myinput2" name="feature_customforms" id="customforms">
                                                    <?php if (count($custom_forms) > 0) { ?>
                                                        <?php foreach ($custom_forms as $singlecf) { ?>
                                                            <option value="<?= $singlecf->id ?>" <?= isset($alert_popup_feature_action_button->custom_form_id) && $alert_popup_feature_action_button->custom_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                                <?= $singlecf->title ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                            <div class="form-group">
                                                <label for="">Feature Action Button Event Forms</label>
                                                <select class="myinput2" name="event_form_id" id="customforms">
                                                    <?php if (count($event_forms) > 0) { ?>
                                                        <?php foreach ($event_forms as $singlecf) { ?>
                                                            <option value="<?= $singlecf->id ?>" <?= isset($alert_popup_feature_action_button->event_form_id) && $alert_popup_feature_action_button->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                                <?= $singlecf->title ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class=" action_fields action_map" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                            <div class="form-group ">
                                                <label for="address">Enter Address</label>
                                                <input type="text" class="myinput2 " name="feature_action_button_map_address" value="<?= isset($alert_popup_feature_action_button->map_address) && $alert_popup_feature_action_button->map_address ? $alert_popup_feature_action_button->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                            </div>
                                        </div>
                                        <div class="clearfix action_fields action_address" id="address-list-alert-1" style="display:<?= isset($alert_popup_feature_action_button->address_id) && $alert_popup_feature_action_button->address_id == 'address' ? 'block' : 'none' ?>">
                                            <div class="form-group">
                                                <label for="addressbtn1">Select an Address</label>
                                                <select name="feature_action_button_address" class="myinput2">
                                                    <?php foreach ($addresses as $address) { ?>
                                                        <option value="<?= $address->id ?>" <?= isset($alert_popup_feature_action_button->address_id) && $alert_popup_feature_action_button->address_id == $address->id ? 'selected' : '' ?>>
                                                            <?= $address->address_title ?>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-divider-line mt-10px mb-10"></div> <!-- (Hassan) Adding divider -->

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bannertext">New action button active</label><br>
                                            <label class="switch">
                                                <input type="checkbox" class="notificationswitch" name="newactionbuttonactive" <?= $alert_popup_new_action_button->active ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="new_action_button_desc">New Action Button Name</label>
                                            <input type="text" class="myinput2" name="new_action_button_desc" id="new_action_button_desc" value="<?= $alert_popup_new_action_button_text->text ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="new_action_button_desc_color">New Action Button Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_new_action_button_text->color ?>"></div>
                                                        <input type="color" class="colorinput" name="new_action_button_desc_color" id="bannertextcolor2" value="<?= $alert_popup_new_action_button_text->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="new_action_button_background_desc_color">New Action Button Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_new_action_button_text->bg_color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="new_action_button_background_desc_color" id="bannertextcolor2" value="<?= $alert_popup_new_action_button_text->bg_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="new_action_button_link">New Action Button Application</label>
                                            <select class="myinput2 header_btn2_section action_button_selection" name="new_action_button_link">
                                                <option value="link" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'link' ? 'selected' : '' ?>>Link to Outside Site</option>
                                                <option value="call" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'call' ? 'selected' : '' ?>>
                                                    Call</option>
                                                <option value="sms" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'sms' ? 'selected' : '' ?>>
                                                    SMS Text</option>
                                                <option value="email" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'email' ? 'selected' : '' ?>>
                                                    Email</option>
                                                <option value="address" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'address' ? 'selected' : '' ?>>
                                                    Business Address</option>
                                                <option value="customforms" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'customforms' ? 'selected' : '' ?>>
                                                    Link to Form</option>
                                                <option value="image_popup" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'image_popup' ? 'selected' : '' ?>>
                                                    Popup - Image</option>
                                                <option value="text_popup" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'text_popup' ? 'selected' : '' ?>>
                                                    Popup - Text</option>
                                                <option value="video" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'video' ? 'selected' : '' ?>>
                                                    Popup - Video</option>
                                                <option value="stripe" <?= $alert_popup_new_action_button->action_type == 'stripe' ? 'selected' : '' ?>>
                                                    Popup - Payment</option>
                                                <option value="google_map" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'google_map' ? 'selected' : '' ?>>
                                                    Map</option>
                                                <option value="audioiconfeature" <?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                                    Audio File with Icon Feature</option>
                                                <?php foreach ($front_sections as $single) { ?>
                                                    <option value="<?= $single->slug ?>" <?= $alert_popup_new_action_button->action_type == $single->slug ? 'selected' : '' ?>>
                                                        <?= $single->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group action_fields phone_no_calls" style="<?= $alert_popup_new_action_button->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for calls</label>
                                            <input type="text" class="myinput2" name="new_action_phone_no_calls" value="<?= $alert_popup_new_action_button->action_button_phone_no_calls ?>">
                                        </div>
                                        <div class="form-group action_fields phone_no_sms" style="<?= $alert_popup_new_action_button->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for sms</label>
                                            <input type="text" class="myinput2" name="new_action_phone_no_sms" value="<?= $alert_popup_new_action_button->action_button_phone_no_sms ?>">
                                        </div>
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $alert_popup_new_action_button->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="new_action_button_textpopup"><?php echo $alert_popup_new_action_button->action_button_textpopup; ?></textarea>
                                            <div class="quilleditor">
                                                <?php echo $alert_popup_new_action_button->action_button_textpopup; ?>
                                            </div>
                                        </div>
                                        <div class="form-group action_fields action_email" style="<?= $alert_popup_new_action_button->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Email</label>
                                            <input type="text" class="myinput2" name="new_action_email" value="<?= $alert_popup_new_action_button->action_button_action_email ?>">
                                        </div>
                                        <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $alert_popup_new_action_button->action_type == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                        </div>
                                        <div class="form-group action_fields audio_icon_feature" name="alertp_new_audio_icon_feature" style="<?= $alert_popup_new_action_button->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="new_action_button_audio_icon_feature" id="customFile" accept=".mp3">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                            <div class="row">
                                                <?php if ($alert_popup_new_action_button->action_type == 'audioiconfeature' && $alert_popup_new_action_button->action_button_audio_icon_feature) {

                                                ?>
                                                    <div class="col-md-10 imgdiv">
                                                        <h4><?= $alert_popup_new_action_button->action_button_audio_icon_feature ?></h4>
                                                        <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_popup_btn" data-id="<?= $alert_popup_new_action_button->id ?>" data-imgname="<?= $alert_popup_new_action_button->action_button_audio_icon_feature ?>">X</button>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                        </div>

                                        <div class="form-group action_fields video_upload" name="feature_action_video3" style="<?= $alert_popup_new_action_button->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Video</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="new_popup_action_video" id="customFile" accept=".mp4">
                                                <label class="custom-file-label" for="customFile">Upload Video</label>
                                            </div>
                                            @if(isset($alert_popup_new_action_button->action_button_video) && $alert_popup_new_action_button->action_button_video !='')
                                            <div class=" position-relative d-flex new_popup_action_video">
                                                <video height="80" controls>
                                                    <source src="<?= isset($alert_popup_new_action_button->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($alert_popup_new_action_button->action_button_video)) : '' ?>" type="video/mp4">
                                                </video>
                                                <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='new_popup_action_video' data-id="" data-file="{{$alert_popup_new_action_button->action_button_video}}">X
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= isset($alert_popup_feature_action_button->action_type) && $alert_popup_feature_action_button->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Images</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="popup_feature_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                                <label class="custom-file-label" for="customFile">Choose files</label>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <div class="form-group action_fields action_link" style="<?= $alert_popup_new_action_button->action_type == 'link' ? 'display:block' : 'display:none' ?>"">
                                            <input type=" text" class="myinput2 btn0link" name="new_button_text_link" id="btn0link" value="<?= $alert_popup_new_action_button->link ?>" placeholder="http://google.com">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php if ($alert_popup_new_action_button->action_type == 'audiofeature' && $alert_popup_new_action_button->action_button_audio) {

                                            ?>
                                                <div class="col-md-10 imgdiv">
                                                    <h4><?= $alert_popup_new_action_button->action_button_audio ?></h4>
                                                    <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="alert_popup_new_action_button" data-imgname="<?= $alert_popup_new_action_button->action_button_audio ?>">X</button>
                                                </div>
                                            <?php


                                            } ?>
                                        </div>
                                        <br>
                                        <div class="clearfix action_fields action_forms" id="new_customforms" style="<?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'customforms' ?  'display:block' : 'display:none' ?>">
                                            <div class="form-group">
                                                <label for="">New Action Button Custom Forms</label>
                                                <select class="myinput2" name="new_customforms" id="customforms">
                                                    <?php if (count($custom_forms) > 0) { ?>
                                                        <?php foreach ($custom_forms as $singlecf) { ?>
                                                            <option value="<?= $singlecf->id ?>" <?= isset($alert_popup_new_action_button->custom_form_id) && $alert_popup_new_action_button->custom_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                                <?= $singlecf->title ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($alert_popup_new_action_button->action_type) && $alert_popup_new_action_button->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                            <div class="form-group">
                                                <label for="">Feature Action Button Event Forms</label>
                                                <select class="myinput2" name="feature_button_event_form_id" id="customforms">
                                                    <?php if (count($event_forms) > 0) { ?>
                                                        <?php foreach ($event_forms as $singlecf) { ?>
                                                            <option value="<?= $singlecf->id ?>" <?= isset($alert_popup_new_action_button->event_form_id) && $alert_popup_new_action_button->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                                <?= $singlecf->title ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" action_fields action_map" style="<?= $alert_popup_new_action_button->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                            <div class="form-group ">
                                                <label for="address">Enter Address</label>
                                                <input type="text" class="myinput2 " name="new_action_button_map_address" value="<?= isset($alert_popup_new_action_button->map_address) && $alert_popup_new_action_button->map_address ? $alert_popup_new_action_button->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                            </div>
                                        </div>
                                        <div class="clearfix action_fields action_address" id="address-list-alert-1" style="display:<?= $alert_popup_new_action_button->action_type == 'address'  ? 'block' : 'none' ?>">
                                            <div class="form-group">
                                                <label for="addressbtn1">Select an Address</label>
                                                <select name="new_action_button_address" class="myinput2">
                                                    <?php foreach ($addresses as $address) { ?>
                                                        <option value="<?= $address->id ?>" <?= $alert_popup_new_action_button->address_id == $address->id ? 'selected' : '' ?>>
                                                            <?= $address->address_title ?>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-divider-line mt-10px mb-10"></div> <!-- (Hassan) Adding divider -->

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bannertext">Proceed action button active</label><br>
                                            <label class="switch">
                                                <input type="checkbox" class="notificationswitch" name="proceedactionbuttonactive" <?= $alert_popup_proceed_action_button->active ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="proceed_action_button_desc">Proceed Action Button Name</label>
                                            <input type="text" class="myinput2" name="proceed_action_button_desc" id="proceed_action_button_desc" value="<?= $alert_popup_proceed_action_button_text->text ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="proceed_action_button_desc_color">Proceed Action Button Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_proceed_action_button_text->color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="proceed_action_button_desc_color" id="bannertextcolor2" value="<?= $alert_popup_proceed_action_button_text->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="proceed_action_button_background_desc_color">Proceed Action Button
                                                Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_proceed_action_button_text->bg_color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="proceed_action_button_background_desc_color" id="bannertextcolor2" value="<?= $alert_popup_proceed_action_button_text->bg_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blue-divider-line mt-10px mb-10"></div> <!-- (Hassan) Adding divider -->

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="bannertext">Terminate action button active</label><br>
                                            <label class="switch">
                                                <input type="checkbox" class="notificationswitch" name="terminate_action_button_activate" <?= $alert_popup_terminate_action_button->active ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="terminate_action_button_desc">Terminate Action Button Name</label>
                                            <input type="text" class="myinput2" name="terminate_action_button_desc" id="terminate_action_button_desc" value="<?= $alert_popup_terminate_action_button_text->text ?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="terminate_action_button_color">Terminate Action Button Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_terminate_action_button_text->color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="terminate_action_button_color" id="bannertextcolor2" value="<?= $alert_popup_terminate_action_button_text->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="popup_alert_bottom"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="terminate_action_button_background_color">Terminate Action Button Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $alert_popup_terminate_action_button_text->bg_color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="terminate_action_button_background_color" id="bannertextcolor2" value="<?= $alert_popup_terminate_action_button_text->bg_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <div class="row form-bottom make-sticky">
                        <div class="col-md-12">
                            <button type="submit" name="savepopupalert" class="btn btn-primary" value="save">Save</button>
                            <button type="submit" name="savepopupalert" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

    <!-- Alert Banner -->
    @if (check_auth_permission(['alert_banner', 'alert_banner_text']))
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="alert_banner_bluebar" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="alert_banner">

            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Alert Banner</div>
                </div>
                <div class="d-flex  align-items-center">
                    <div class="enable-disable-feature-div">
                        <div class="title-4-400 text-color-green">Enabled</div>
                    </div>
                    <div class=" ml-20">
                        <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                    </div>
                </div>
            </div>

        </div>
        <form class="data-form" action="{{ url('updatealertbanner') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="editcontent mb-13" style="<?= isset($_GET['block'])  && $_GET['block'] == 'alert_banner_bluebar' ? 'display:block;' : '' ?>">
                <div class="row mb-17">
                    <div class="col-md-3">
                        <div class="form-group d-flex">
                            <label>Override Background <br>Color in Settings, Theme</label>
                            <label class="switch ml-7">
                                <input type="checkbox" class="notificationswitch override_bg_enable alert_banner_override_bg" name="alert_banner_override_bg" data-slug="alert_banner_bg_picker" <?php echo  $alert_banner_setting->alert_banner_override_bg ? 'checked' : '' ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="form-group alert_banner_bg_picker" style="display:<?php echo  $alert_banner_setting->alert_banner_override_bg ? 'block' : 'none' ?>">

                            <label>Alert Banner Background Color</label>
                            <div class="d-flex align-items-center color-main-div">
                                <div>
                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                </div>
                                <div class="ml-10">
                                    <div class="inputcolordiv">
                                        <div class="inputcolor" style="background:<?= $banner_text->bg_color ?>"></div>
                                        <input type="color" class="colorinput" name="banner_background_color" id="bannerbackgroundcolor" value="<?= $banner_text->bg_color ?>" placeholder="#000000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myhr mb-16"></div>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                <div class="title-2">Alert Banner Settings</div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>
                    </div>
                    <div class="editcontent2">
                        <div class="row mb-22">
                            @if (check_auth_permission('alert_banner_text'))
                            <div class="col-md-4">
                                <label>Alert Banner Text</label>
                                <input type="text" class="myinput2" name="banner_text" id="bannertext" value="<?= $banner_text->text ?>" placeholder="Banner Text" maxlength="75">
                            </div>
                            @endif

                            @if (check_auth_permission('alert_banner'))
                            <div class="col-md-7">
                                <label>Alert Banner Text Color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $banner_text->color ?>"></div>
                                            <input type="color" class="colorinput" name="banner_color" id="bannertextcolor" value="<?= $banner_text->color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>
                        @if (check_auth_permission('alert_banner'))
                        <div class="row mb-22">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bannertext">Action button active</label><br>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="banner_action_enable" <?= $alert_banner_action->active ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Alert Banner Action Button Text</label>
                                <input type="text" class="myinput2" name="banner_text_2" id="bannertext2" value="<?= $banner_action_text->text ?>" placeholder="Banner Text">
                            </div>
                            <div class="col-md-2">
                                <label>Action Button Text Color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $banner_action_text->color ?>"></div>
                                            <input type="color" class="colorinput" name="banner_color_2" id="bannertextcolor2" value="<?= $banner_action_text->color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>Action Button Color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $banner_action_text->bg_color ?>"></div>
                                            <input type="color" class="colorinput" name="banner_background_color_2" id="bannertextcolor2" value="<?= $banner_action_text->bg_color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Alert Banner Action Button Applications</label>
                                    <select class="myinput2 action_button_selection" name="alert_banner_action_button_link">
                                        <option value="link">
                                            Link to Outside Site</option>
                                        <option value="call" <?= $alert_banner_action->action_type == 'call' ? 'selected' : '' ?>>Call</option>
                                        <option value="sms" <?= $alert_banner_action->action_type == 'sms' ? 'selected' : '' ?>>
                                            SMS Text<Textarea:rows></Textarea:rows>
                                        </option>
                                        <option value="email" <?= $alert_banner_action->action_type == 'email' ? 'selected' : '' ?>>
                                            Email</option>
                                        <option value="address" <?= $alert_banner_action->action_type == 'address' ? 'selected' : '' ?>>
                                            Business Address</option>
                                        <option value="customforms" <?= isset($alert_banner_action->action_type) && $alert_banner_action->action_type == 'customforms' ? 'selected' : '' ?>>
                                            Link to Form</option>
                                        <option value="image_popup" <?= $alert_banner_action->action_type == 'image_popup' ? 'selected' : '' ?>>
                                            Popup - Image</option>
                                        <option value="text_popup" <?= $alert_banner_action->action_type == 'text_popup' ? 'selected' : '' ?>>
                                            Popup - Text</option>
                                        <option value="video" <?= $alert_banner_action->action_type == 'video' ? 'selected' : '' ?>>
                                            Popup - Video</option>
                                        <option value="stripe" <?= $alert_banner_action->action_type == 'stripe' ? 'selected' : '' ?>>
                                            Popup - Payment</option>
                                        <option value="google_map" <?= $alert_banner_action->action_type == 'google_map' ? 'selected' : '' ?>>
                                            Map</option>


                                        <option value="audioiconfeature" <?= $alert_banner_action->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                            Audio File with Icon</option>

                                        <?php foreach ($front_sections as $single) { ?>
                                            <option value="<?= $single->slug ?>" <?= $alert_banner_action->action_type == $single->slug ? 'selected' : '' ?>>
                                                <?= $single->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group action_fields phone_no_calls" style="<?= $alert_banner_action->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for calls</label>
                                    <input type="text" class="myinput2" name="banner_action_phone_no_calls" value="<?= $alert_banner_action->action_button_phone_no_calls ?>">
                                </div>
                                <div class="form-group action_fields phone_no_sms" style="<?= $alert_banner_action->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for sms</label>
                                    <input type="text" class="myinput2" name="banner_action_phone_no_sms" value="<?= $alert_banner_action->action_button_phone_no_sms ?>">
                                </div>

                                <div class="form-group action_fields action_email" style="<?= $alert_banner_action->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Email</label>
                                    <input type="text" class="myinput2" name="banner_action_email" value="<?= $alert_banner_action->action_button_action_email ?>">
                                </div>
                                <div class="form-group action_fields audio_icon_feature" name="alertb_audio_icon_feature" style="<?= $alert_banner_action->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                </div>
                                <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= $alert_banner_action->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                        <label class="custom-file-label" for="customFile">Choose files</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($alert_banner_action->action_type == 'audioiconfeature' && $alert_banner_action->action_button_audio_icon_feature) {

                                    ?>
                                        <div class="col-md-10 imgdiv">
                                            <h4><?= $alert_banner_action->action_button_audio_icon_feature ?></h4>
                                            <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_banner_btn" data-id="<?= $alert_banner_action->id ?>" data-imgname="<?= $alert_banner_action->action_button_audio_icon_feature ?>">X</button>
                                        </div>
                                    <?php


                                    } ?>
                                </div>
                                <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $alert_banner_action->action_type == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                </div>
                                <div class="form-group action_fields video_upload" name="feature_action_video2" style="<?= $alert_banner_action->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Video</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="banner_action_video" id="customFile" accept=".mp4">
                                        <label class="custom-file-label" for="customFile">Upload Video</label>
                                    </div>
                                    @if(isset($alert_banner_action->action_button_video) && $alert_banner_action->action_button_video !='')
                                    <div class=" position-relative d-flex banner_action_video">
                                        <video height="80" controls>
                                            <source src="<?= isset($alert_banner_action->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($alert_banner_action->action_button_video)) : '' ?>" type="video/mp4">
                                        </video>
                                        <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='banner_action_video' data-id="" data-file="{{$alert_banner_action->action_button_video}}">X
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <?php if ($alert_banner_action->action_button_audio && $alert_banner_action->action_type == 'audiofeature') {

                                    ?>
                                        <div class="col-md-10 imgdiv">
                                            <h4><?= $alert_banner_action->action_button_audio ?></h4>
                                            <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="alert_banner_Action" data-imgname="<?= $alert_banner_action->action_button_audio ?>">X</button>
                                        </div>
                                    <?php


                                    } ?>
                                </div>
                                <br>
                                <div class="form-group action_fields action_link" style="<?= $alert_banner_action->action_type == 'link' ? 'display:block' : 'display:none' ?>">
                                    <label>Alert Banner Action Button Text Link</label>
                                    <input type="text" class="myinput2" name="banner_link_2" id="bannertextlink2" value="<?= $alert_banner_action->link ?>" placeholder="http://google.com">
                                </div>

                                <div class="form-group action_fields action_forms" style="<?= isset($alert_banner_action->action_type) && $alert_banner_action->action_type == 'customforms' ? 'display:block' : 'display:none' ?>">
                                    <label>Alert Banner Action Button Custom Forms</label>
                                    <select class="myinput2" name="banner_forms" id="customforms">
                                        <?php if (count($custom_forms) > 0) { ?>
                                            <?php foreach ($custom_forms as $singlecf) { ?>
                                                <option value="<?= $singlecf->id ?>" <?= isset($alert_banner_action->custom_form_id) && $alert_banner_action->custom_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                    <?= $singlecf->title ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($alert_banner_action->action_type) && $alert_banner_action->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                    <div class="form-group">
                                        <label for="">Feature Action Button Event Forms</label>
                                        <select class="myinput2" name="banner_eventforms" id="customforms">
                                            <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $singlecf) { ?>
                                                    <option value="<?= $singlecf->id ?>" <?= isset($alert_banner_action->event_form_id) && $alert_banner_action->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                        <?= $singlecf->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group action_fields action_map" style="<?= $alert_banner_action->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="alert_banner_action_button_map_address" value="<?= isset($alert_banner_action->map_address) && $alert_banner_action->map_address ? $alert_banner_action->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                </div>

                                <div class="form-group action_fields action_address" style="display:<?= $alert_banner_action->action_type == 'address'  ? 'block' : 'none' ?>">
                                    <label>Select an Address</label>
                                    <select name="alert_banner_action_button_address" class="myinput2">
                                        <?php
                                        foreach ($addresses as $address) {
                                        ?>
                                            <option value="<?= $address->id ?>" <?= $alert_banner_action->address_id == $address->id ? 'selected' : '' ?>>
                                                <?= $address->address_title ?>
                                                <?php
                                        }?>
                                    </select>
                                </div>
                           
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <div class="col-md-6 col-sm-12 p-0">
                                <div class="form-group">
                                    <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $alert_banner_action->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                        <label>Popup Text </label>
                                        <textarea class="myinput2 editordata hidden" name="banner_action_button_textpopup"><?php echo $alert_banner_action->action_button_textpopup; ?></textarea>
                                        <div class="quilleditor">
                                            <?php echo $alert_banner_action->action_button_textpopup; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">Mobile devices do not have the
                            width for a Button, Text & an
                            Image. When an Image is added,
                            mobile visitors will not see the
                            Alert Banner text</div>

                        <!-- Alert Banner Logo -->
                        <div class="row">
                            <?php if ($alert_banner_logo->file_name) { ?>
                                <div class="col-md-3 alert_banner_logo_div">
                                    <div class="form-group">
                                        <label for="headerlogo">Alert Banner Logo</label>
                                        <img src="{{ url('assets/uploads/' .get_current_url(). $alert_banner_logo->file_name) }}" width="100%">
                                        <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('{{ $alert_banner_logo->file_name }}','alert_banner_logo','alert_banner_logo_div','images','0','true')">X</button>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-md-4">
                                <div class="uploadImageDiv">
                                    <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                        <div class="vertical-middle">
                                            <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                            </div>
                                            <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                    <input class="dataimage" type="hidden" name="alert_banner_logo">

                                    <div class="col-md-6 imgdiv" style="display:none">
                                        <br>
                                        <img src='' width="100%" class="imagefromgallerysrc">
                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alert_banner_logo_min_width">Alert Banner Logo Width
                                        (Mobile)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="alert_banner_logo_min_width" id="alert_banner_logo_min_width" value="<?= $alert_banner_logo->min_width ?>" placeholder="100">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="alert_banner_logo_max_width">Alert Banner Logo Width (Web)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="alert_banner_logo_max_width" id="alert_banner_logo_max_width" value="<?= $alert_banner_logo->max_width ?>" placeholder="100">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                                
                </div>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                <div class="title-2">Menu Icon Text Settings</div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>
                    </div>
                    <div class="editcontent2">
                        <div class="row">
                            <div class="col-md-5" id="action_button-text">
                                <div class="form-group">
                                    <label for="bannertext">Menu Icon Text</label>
                                    <input type="text" class="myinput2" name="menu_icon_text" id="menu_icon_text" value="<?= $menu_icon_text->text ?>" placeholder="Menu Icon Text">
                                </div>
                            </div>

                            <!-- (Hassan) Switching (Begin) -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="popup_text_color2">Menu Icon Text Size (Web)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="menu_icon_text_size_web" id="menu_icon_text_size_web" value="<?= $menu_icon_text->size_web ?>" placeholder="18px">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="popup_text_color2">Menu Icon Text Size (Mobile)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="menu_icon_text_size_mobile" id="menu_icon_text_size_mobile" value="<?= $menu_icon_text->size_mobile ?>" placeholder="18px">
                                </div>
                            </div>
                            <!-- Switching (End) -->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bannertextcolor">Menu Icon Text color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $menu_icon_text->color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="menu_icon_text_color" id="bannertextcolor" value="<?= $menu_icon_text->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Menu Icon Text Font</label>
                                    <select class="myinput2" name="menu_icon_text_font">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $menu_icon_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertextcolor">Menu Icon color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $alert_banner_setting->menu_icon_color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="menu_icon_color" id="bannertextcolor" value="<?= $alert_banner_setting->menu_icon_color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" id="action_button-text">
                                <div class="form-group">
                                    <label for="bannertext">Blog Title</label>
                                    <input type="text" class="myinput2" name="blog_title" id="blog_title_text" value="<?= !empty($blog_title_text->text) ? $blog_title_text->text : 'Blog' ?>" placeholder="Blog Text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-bottom make-sticky">
                    <div class="col-md-12">
                        <button type="submit" name="savebanner" class="btn btn-primary" value="save">Save</button>
                        <button type="submit" name="savebanner" class="btn btn-primary" value="savereminders">Save & send
                            reminder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif

    <!-- Header Images -->
    <?php if (check_auth_permission(['header_block', 'header_logo', 'header_image_title', 'header_image', 'header_image_description', 'header_block_timed_images', 'header_slider', 'header_slider_upload_image'])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="header_images_bluebar" data-top="header_block_top" data-bottom="header_block_bottom" data-tip_section="header_images">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">Header Images</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('headersection'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class=" ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'header_images_bluebar' ? 'display:block;' : '' ?>">
                <form action="{{ url('updateheaderimages') }}" method="post" enctype="multipart/form-data" id="form_header_settings">
                    @csrf

                    <div class="row mb-17">
                        <div class="col-md-3">
                            <div class="form-group d-flex">
                                <label>Override Background <br>Color in Settings, Theme</label>
                                <label class="switch ml-7">
                                    <input type="checkbox" class="notificationswitch override_bg_enable header_block_override_bg" name="header_block_override_bg" data-slug="header_block_bg_picker" <?php echo  $header_images_settings->header_block_override_bg ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group header_block_bg_picker" style="display:<?php echo  $header_images_settings->header_block_override_bg ? 'block' : 'none' ?>">
                                <label>Header Background Color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $header_images_settings->header_background_color ?>">
                                            </div>
                                            <input type="color" class="colorinput" name="header_background_color" id="bannertextcolor" value="<?= $header_images_settings->header_background_color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="myhr mb-16"></div>
                    <div id="header_block_top"></div>

                    <?php if (check_auth_permission('header_logo')) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 header_logo_settings">
                                        <div class="title-2">Header Logo Settings</div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <?php if (check_step_image('Header Logo')) {  ?>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow 1-Step Button to Expire</h5>
                                        </div>
                                    </div>
                                <?php  } ?>
                                <div class="row" id="header_logo">
                                    <?php if ($header_images_settings->header_logo) { ?>
                                        <div class="col-md-3 header_block_logo_div">
                                            <div class="form-group">
                                                <label for="headerlogo">Header logo</label><br />
                                                <img src="<?= base_url('assets/uploads/' . get_current_url() . $header_images_settings->header_logo) ?>" width="150">
                                                <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $header_images_settings->header_logo ?>','header_logo','header_block_logo_div','header_images','<?= $header_images_settings->id ?>')">X</button>
                                            </div>
                                            <br>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-3">
                                        <div class="uploadImageDiv mt-2">
                                            <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                <div class="vertical-middle">
                                                    <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                                    </div>
                                                    <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                            <input class="dataimage" type="hidden" name="header_logo">

                                            <div class="col-md-6 imgdiv" style="display:none">
                                                <br>
                                                <img src='' width="100%" class="imagefromgallerysrc">
                                                <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="title_font_size">Font</label>
                                            <select class="myinput2" name="header_title_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_image_title_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="headerlogowidth"> Logo Size</label><br>
                                            <input type="text" class="myinput2 width-50px" name="header_logo_width" id="headerlogowidth" value="<?= $header_images_settings->header_logo_width ?>" placeholder="50px">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="headertitle">Header Logo Desc Below Image</label>
                                            <input type="text" class="myinput2" name="header_title" id="headertitle" value="<?= $header_image_title_text->text ?>" placeholder="Logo Title Text">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Text Size</label><br>
                                            <input type="text" class="myinput2 width-50px" name="header_title_fontsize" value="<?= $header_image_title_text->size_web ?>" placeholder="12px">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="headertitlecolor">Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $header_image_title_text->color ?>"></div>
                                                        <input type="color" class="colorinput" name="header_title_color" id="bannertextcolor" value="<?= $header_image_title_text->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission('header_block_timed_images')) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="d-flex align-items-center titlediv d-flex">
                                            <div class="title-2">Timed Header Logo Settings</div>
                                            <div class="form-group  switchoverhead2">
                                                <label class="switch m-0">
                                                    <input type="checkbox" name="enable_timed_header_logo" class="timeimagesswitch" <?= $timed_header_logo->enable ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            @if(show_timed_image($timed_header_logo->enable, $timed_header_logo_image->file_name, $timed_header_logo->start_time, $timed_header_logo->end_time,$timed_header_logo->days, 'enable_timed_header_logo', 'timed_images', 1,$timed_header_logo->type))
                                            <div class="ml-2 text-red ">
                                                Timed image is active
                                            </div>
                                            @endif
                                        </div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>

                                </div>
                            </div>
                            <div class="editcontent2">
                                <!-- Timed Header Logo Start -->
                                <div class="timedimagediv mb-3">
                                    <div id="timed_header_logo">
                                        <div class="timedimages <?php //echo $timed_header_logo->enable ? '' : 'hidden'
                                                                ?>">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php
                                                    $start_time = new DateTime($timed_header_logo->start_time, new DateTimeZone(getFrontDataTimeZone()));

                                                    $end_time = new DateTime($timed_header_logo->end_time, new DateTimeZone(getFrontDataTimeZone()));

                                                    $days = json_decode($timed_header_logo->days);
                                                    ?>
                                                    <div class="row nopadding datetimediv_popup">
                                                        <div class="col-md-6 nopadding">
                                                            <div class="form-group">
                                                                <label for="timed_header_logo_type">Type</label>
                                                                <select name="timed_header_logo_type" class="myinput2 timed_image_type" id="timed_header_logo_type">
                                                                    <option value="days" <?= $timed_header_logo->type == 'days' ? 'selected' : '' ?>>By Days</option>
                                                                    <option value="timer" <?= $timed_header_logo->type == 'timer' ? 'selected' : '' ?>>Timer</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 nopadding">
                                                            <div class="timed_type_divs timer_div" style="<?= $timed_header_logo->type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                                                                <div class="form-group">
                                                                    <label for="timed_header_logo_timer">Timer</label>
                                                                    <select name="timed_header_logo_timer" class="myinput2" id="timed_header_logo_timer">
                                                                        <option value="15" <?= $timed_header_logo->image_timer == '15' ? 'selected' : '' ?>>15 min</option>
                                                                        <option value="30" <?= $timed_header_logo->image_timer == '30' ? 'selected' : '' ?>>30 min</option>
                                                                        <option value="60" <?= $timed_header_logo->image_timer == '60' ? 'selected' : '' ?>>1 hour</option>
                                                                        <option value="120" <?= $timed_header_logo->image_timer == '120' ? 'selected' : '' ?>>2 hour</option>
                                                                        <option value="240" <?= $timed_header_logo->image_timer == '240' ? 'selected' : '' ?>>4 hour</option>
                                                                        <option value="360" <?= $timed_header_logo->image_timer == '360' ? 'selected' : '' ?>>6 hour</option>
                                                                        <option value="480" <?= $timed_header_logo->image_timer == '480' ? 'selected' : '' ?>>8 hour</option>
                                                                        <option value="720" <?= $timed_header_logo->image_timer == '720' ? 'selected' : '' ?>>12 hour</option>
                                                                        <option value="1440" <?= $timed_header_logo->image_timer == '1440' ? 'selected' : '' ?>>24 hour</option>
                                                                        <option value="2880" <?= $timed_header_logo->image_timer == '2880' ? 'selected' : '' ?>>48 hour</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="timed_type_divs days_div" style="<?= $timed_header_logo->type == 'days' ? 'display:block;' : 'display:none;' ?>">
                                                                <div class="form-group">
                                                                    <label for="start_time">Start Time</label>
                                                                    <input type="time" name="header_logo_start_time" class="myinput2" id="start_time" value="<?php echo $start_time->format('H:i'); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_time">End Time</label>
                                                                    <input type="time" name="header_logo_end_time" class="myinput2" id="end_time" value="<?php echo $end_time->format('H:i'); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Select Days</label>
                                                                    <select class="myinput2 multiselectlist" name="days[]" multiple>
                                                                        <option value="mon" <?= is_array($days) && in_array('mon', $days) ? 'selected' : '' ?>>
                                                                            Monday</option>
                                                                        <option value="tue" <?= is_array($days) && in_array('tue', $days) ? 'selected' : '' ?>>
                                                                            Tuesday</option>
                                                                        <option value="wed" <?= is_array($days) && in_array('wed', $days) ? 'selected' : '' ?>>
                                                                            Wednesday</option>
                                                                        <option value="thu" <?= is_array($days) && in_array('thu', $days) ? 'selected' : '' ?>>
                                                                            Thursday</option>
                                                                        <option value="fri" <?= is_array($days) && in_array('fri', $days) ? 'selected' : '' ?>>
                                                                            Friday</option>
                                                                        <option value="sat" <?= is_array($days) && in_array('sat', $days) ? 'selected' : '' ?>>
                                                                            Saturday</option>
                                                                        <option value="sun" <?= is_array($days) && in_array('sun', $days) ? 'selected' : '' ?>>
                                                                            Sunday</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="uploadImageDiv">
                                                        <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                            <div class="vertical-middle">
                                                                <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                                                </div>
                                                                <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                        <input class="dataimage" type="hidden" name="timed_header_logo">

                                                        <div class="col-md-6 imgdiv" style="display:none">
                                                            <br>
                                                            <img src='' width="100%" class="imagefromgallerysrc">
                                                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($timed_header_logo_image->file_name) { ?>
                                                    <div class="col-md-3 timed_header_block_logo_div">
                                                        <div class="form-group">
                                                            <label for="headerlogo">Timed Header logo</label>
                                                            <img src="<?= base_url('assets/uploads/' . get_current_url() . $timed_header_logo_image->file_name) ?>" width="100%">
                                                            <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_header_logo_image->file_name ?>','timed_header_logo','timed_header_block_logo_div','images','0','true')">X</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Timed Header Logo End -->
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission('header_image', 'header_image_title', 'header_image_description')) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 header_image_settings">
                                        <div class="d-flex align-items-center titlediv">
                                            <div class="title-2">Header Image Settings</div>
                                        </div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <?php if (check_auth_permission('header_image_title')) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="headertitle">Image Title Text - Above Image</label>
                                                <input type="text" class="myinput2" name="header_title2" id="headertitle2" value="<?= $header_text_2->text ?>" placeholder="Banner Text">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Text Size</label><br>
                                                <input type="text" class="myinput2 width-50px" name="header_title_fontsize2" value="<?= $header_text_2->size_web ?>" placeholder="12px">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="headertitlecolor">Text color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $header_text_2->color ?>">
                                                            </div>
                                                            <input type="color" class="colorinput" name="header_title_color2" id="bannertextcolor" value="<?= $header_text_2->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title_font_size">Image Title Font</label>
                                                <select class="myinput2" name="header_title_2_font_family">
                                                    <?php if (count($font_family) > 0) { ?>
                                                        <?php foreach ($font_family as $single) { ?>
                                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_text_2->fontfamily == $single->id ? 'selected' : '' ?>>
                                                                <?= $single->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (check_auth_permission('header_image')) { ?>
                                    <?php if (check_step_image('Header Image Title')) { ?>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow
                                                    1-Step Button to Expire</h5>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row" id="header_image">
                                        <?php if (check_auth_permission('header_image')) { ?>
                                            <?php if ($header_images_settings->header_img) { ?>
                                                <div class="col-md-3 header_block_image_div">
                                                    <div class="form-group">
                                                        <label for="headerlogo">Header Image</label>
                                                        <img src="<?= base_url('assets/uploads/' . get_current_url() . $header_images_settings->header_img) ?>" width="100%">
                                                        <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $header_images_settings->header_img ?>','header_img','header_block_image_div','header_images','<?= $header_images_settings->id ?>')">X</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-4">
                                                <div class="uploadImageDiv">
                                                    <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                        <div class="vertical-middle">
                                                            <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                                            </div>
                                                            <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                    <input class="dataimage" type="hidden" name="header_img">

                                                    <div class="col-md-6 imgdiv" style="display:none">
                                                        <br>
                                                        <img src='' width="100%" class="imagefromgallerysrc">
                                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="bannertextcolor">Header Image Width</label><br>
                                                    <input type="text" class="myinput2 width-50px" name="header_img_width" id="headerimgwidth" value="<?= $header_images_settings->header_img_width ?>" placeholder="50px">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if (check_auth_permission('header_image_title')) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="headertext2">Image Title Text - Below Image</label>
                                                <input type="text" name="header_img_desc" class="myinput2" id="headertext2" value="<?= $header_image_desc_text->text ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Text Size</label><br>
                                                <input type="text" class="myinput2 width-50px" name="header_img_desc_font_size" value="<?= $header_image_desc_text->size_web ?>" placeholder="12">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="headertext2color"> Text Color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $header_image_desc_text->color ?>"></div>
                                                            <input type="color" class="colorinput" name="header_img_desc_color" id="bannertextcolor" value="<?= $header_image_desc_text->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title_font_size">Image Title Font</label>
                                                <select class="myinput2" name="header_image_desc_font_family">
                                                    <?php if (count($font_family) > 0) { ?>
                                                        <?php foreach ($font_family as $single) { ?>
                                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_image_desc_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                                <?= $single->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (check_auth_permission('header_image_description')) { ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="image_title_text_below_text">Image Title Text - Below Text</label>
                                                <input type="text" name="image_title_text_below_text" class="myinput2" id="image_title_text_below_text" value="<?= $image_title_text_below_text->text ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Text Size</label><br>
                                                <input type="text" class="myinput2 width-50px" name="image_title_text_below_text_size" value="<?= $image_title_text_below_text->size_web ?>" placeholder="12">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="headertext2color"> Text Color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $image_title_text_below_text->color ?>"></div>
                                                            <input type="color" class="colorinput" name="image_title_text_below_text_color" id="bannertextcolor" value="<?= $image_title_text_below_text->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title_font_size">Image Title Font</label>
                                                <select class="myinput2" name="image_title_text_below_text_font_family">
                                                    <?php if (count($font_family) > 0) { ?>
                                                        <?php foreach ($font_family as $single) { ?>
                                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $image_title_text_below_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                                <?= $single->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['header_block'])) { ?>
                        <!-- Timed Header Image Start -->
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="d-flex align-items-center titlediv d-flex">
                                            <div class="title-2">Header Settings</div>
                                        </div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>

                                </div>
                            </div>
                            <div class="editcontent2">
                                <div class="timedimagediv mb-3">
                                    <div id="timed_header_image">
                                        <div class="timedimages <?= $timed_header_image_settings->enable ? '' : 'hidden' ?>">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <?php
                                                    $start_time = new DateTime($timed_header_image_settings->start_time, new DateTimeZone(getFrontDataTimeZone()));

                                                    $end_time = new DateTime($timed_header_image_settings->end_time, new DateTimeZone(getFrontDataTimeZone()));

                                                    $days = json_decode($timed_header_image_settings->days);
                                                    ?>
                                                    <div class="row nopadding datetimediv_popup">
                                                        <div class="col-md-6 nopadding">
                                                            <div class="form-group">
                                                                <label for="timed_header_image_type">Type</label>
                                                                <select name="timed_header_image_type" class="myinput2 timed_image_type" id="timed_header_image_type">
                                                                    <option value="days" <?= $timed_header_image_settings->type == 'days' ? 'selected' : '' ?>>By Days</option>
                                                                    <option value="timer" <?= $timed_header_image_settings->type == 'timer' ? 'selected' : '' ?>>Timer</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 nopadding">
                                                            <div class="timed_type_divs timer_div" style="<?= $timed_header_image_settings->type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                                                                <div class="form-group">
                                                                    <label for="timed_header_image_timer">Timer</label>
                                                                    <select name="timed_header_image_timer" class="myinput2" id="timed_header_image_timer">
                                                                        <option value="15" <?= $timed_header_image_settings->image_timer == '15' ? 'selected' : '' ?>>15 min</option>
                                                                        <option value="30" <?= $timed_header_image_settings->image_timer == '30' ? 'selected' : '' ?>>30 min</option>
                                                                        <option value="60" <?= $timed_header_image_settings->image_timer == '60' ? 'selected' : '' ?>>1 hour</option>
                                                                        <option value="120" <?= $timed_header_image_settings->image_timer == '120' ? 'selected' : '' ?>>2 hour</option>
                                                                        <option value="240" <?= $timed_header_image_settings->image_timer == '240' ? 'selected' : '' ?>>4 hour</option>
                                                                        <option value="360" <?= $timed_header_image_settings->image_timer == '360' ? 'selected' : '' ?>>6 hour</option>
                                                                        <option value="480" <?= $timed_header_image_settings->image_timer == '480' ? 'selected' : '' ?>>8 hour</option>
                                                                        <option value="720" <?= $timed_header_image_settings->image_timer == '720' ? 'selected' : '' ?>>12 hour</option>
                                                                        <option value="1440" <?= $timed_header_image_settings->image_timer == '1440' ? 'selected' : '' ?>>24 hour</option>
                                                                        <option value="2880" <?= $timed_header_image_settings->image_timer == '2880' ? 'selected' : '' ?>>48 hour</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="timed_type_divs days_div" style="<?= $timed_header_image_settings->type == 'days' ? 'display:block;' : 'display:none;' ?>">
                                                                <div class="form-group">
                                                                    <label for="start_time">Start Time</label>
                                                                    <input type="time" name="header_image_start_time" class="myinput2" id="start_time" value="<?php echo $start_time->format('H:i'); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_time">End Time</label>
                                                                    <input type="time" name="header_image_end_time" class="myinput2" id="end_time" value="<?php echo $end_time->format('H:i'); ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Select Days</label>
                                                                    <select class="myinput2 multiselectlist" name="header_image_days[]" multiple>
                                                                        <option value="mon" <?= is_array($days) && in_array('mon', $days) ? 'selected' : '' ?>>
                                                                            Monday</option>
                                                                        <option value="tue" <?= is_array($days) && in_array('tue', $days) ? 'selected' : '' ?>>
                                                                            Tuesday</option>
                                                                        <option value="wed" <?= is_array($days) && in_array('wed', $days) ? 'selected' : '' ?>>
                                                                            Wednesday</option>
                                                                        <option value="thu" <?= is_array($days) && in_array('thu', $days) ? 'selected' : '' ?>>
                                                                            Thursday</option>
                                                                        <option value="fri" <?= is_array($days) && in_array('fri', $days) ? 'selected' : '' ?>>
                                                                            Friday</option>
                                                                        <option value="sat" <?= is_array($days) && in_array('sat', $days) ? 'selected' : '' ?>>
                                                                            Saturday</option>
                                                                        <option value="sun" <?= is_array($days) && in_array('sun', $days) ? 'selected' : '' ?>>
                                                                            Sunday</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="uploadImageDiv">
                                                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload
                                                            image</button>
                                                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                        <input class="dataimage" type="hidden" name="timed_header_image">

                                                        <div class="col-md-6 imgdiv" style="display:none">
                                                            <br>
                                                            <img src='' width="100%" class="imagefromgallerysrc">
                                                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($timed_header_image->file_name) { ?>
                                                    <div class="col-md-3 timed_header_block_image_div">
                                                        <div class="form-group">
                                                            <label for="headerimage">Timed Header Image</label>
                                                            <img src="<?= base_url('assets/uploads/' . get_current_url() . $timed_header_image->file_name) ?>" width="100%">
                                                            <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_header_image->file_name ?>','timed_header_image','timed_header_block_image_div','images','0','true')">X</button>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Timed Header Logo End -->
                            <?php } ?>


                            <?php if (check_auth_permission('header_block')) { ?>


                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Header Scrollbar Width</label><br>
                                            <input type="text" class="myinput2 width-50px" name="header_scrollbar_width" value="<?= $header_images_settings->header_scrollbar_width ?>" placeholder="10">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Header Scrollbar Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $header_images_settings->header_scrollbar_color ?>">
                                                        </div>
                                                        <input type="color" class="colorinput" name="header_scrollbar_color" id="bannertextcolor" value="<?= $header_images_settings->header_scrollbar_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission(['header_slider'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 header_slider_settings">
                                        <div class="d-flex align-items-center titlediv">
                                            <div class="title-2">Header Slider</div>
                                            <div class="form-group ml-5 frontend">
                                                <label for="bannertext " style="margin-bottom:0px !important;">Image/Video</label><br>
                                                <label class="switch mb-2">
                                                    <input type="checkbox" name="is_video" class="is_video_toggle" <?= $header_images_settings->is_video ? 'checked' : '' ?>>
                                                    <span class="slider round "></span>
                                                </label>
                                            </div>
                                            <div class="form-group ml-5 ">
                                                <label for="bannertext " style="margin-bottom:0px !important;">Autoplay</label><br>
                                                <label class="switch mb-2">
                                                    <input type="checkbox" name="is_autoplay" class="is_autoplay_toggle" <?= $header_images_settings->is_autoplay ? 'checked' : '' ?>>
                                                    <span class="slider round "></span>
                                                </label>
                                            </div>
                                            <div class="form-group ml-5 d-none">
                                                <label for="bannertext " style="margin-bottom:0px !important;">Sound On</label><br>
                                                <label class="switch mb-2">
                                                    <input type="checkbox" name="is_sound_on_toggle" class="is_sound_on_toggle" <?= $header_images_settings->is_sound_on ? 'checked' : '' ?>>
                                                    <span class="slider round "></span>
                                                </label>
                                            </div>
                                        </div>

                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <div id="header_slider">
                                    <?php if (check_step_image("Header Slider")) { ?>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or
                                                    allow 1-Step Button to Expire</h5>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Background Color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $header_images_settings->header_slider_background ?>">
                                                            </div>
                                                            <input type="color" class="colorinput" name="header_slider_background" id="bannertextcolor" value="<?= $header_images_settings->header_slider_background ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bannertext">Slider on Mobile</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="slideronoff" <?= $header_images_settings->slideronoff ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bannertext">Slider on Top on Mobile</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="slider_top_mobile" <?= $header_images_settings->slider_top_mobile ? 'checked' : '' ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Slider Text</label>
                                                <input type="text" name="header_slider_text" class="myinput2" value="<?= $header_slider_text->text ?>" placeholder="Slider Text here..">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Slider Text Color</label>
                                                <div class="d-flex align-items-center color-main-div">
                                                    <div>
                                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                    </div>
                                                    <div class="ml-10">
                                                        <div class="inputcolordiv">
                                                            <div class="inputcolor" style="background:<?= $header_slider_text->color ?>"></div>
                                                            <input type="color" class="colorinput" name="header_slider_text_color" id="bannertextcolor" value="<?= $header_slider_text->color ?>" placeholder="#000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Slider Text Size (Web)</label><br>
                                                <input type="text" class="myinput2 width-50px" name="header_slider_text_font_size" value="<?= $header_slider_text->size_web ?>" placeholder="12">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Slider Text Size (Mobile)</label><br>
                                                <input type="text" class="myinput2 width-50px" name="header_slider_text_font_size_mobile" value="<?= $header_slider_text->size_mobile ?>" placeholder="12">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Slider Text Font Family</label>
                                                <select class="myinput2" name="header_slider_text_font_family">
                                                    <?php if (count($font_family) > 0) { ?>
                                                        <?php foreach ($font_family as $single) { ?>
                                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_slider_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                                <?= $single->name ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Slider Text Location</label>
                                                <select class="myinput2" name="header_slider_text_position">
                                                    <option value="centered-text" <?= $header_images_settings->header_slider_text_position == 'centered-text' ? 'selected' : '' ?>>
                                                        Centered</option>
                                                    <option value="top-center-text" <?= $header_images_settings->header_slider_text_position == 'top-center-text' ? 'selected' : '' ?>>
                                                        Top Center</option>
                                                    <option value="bottom-center-text" <?= $header_images_settings->header_slider_text_position == 'bottom-center-text' ? 'selected' : '' ?>>
                                                        Bottom Center</option>
                                                    <option value="top-left-text" <?= $header_images_settings->header_slider_text_position == 'top-left-text' ? 'selected' : '' ?>>
                                                        Top Left</option>
                                                    <option value="top-right-text" <?= $header_images_settings->header_slider_text_position == 'top-right-text' ? 'selected' : '' ?>>
                                                        Top Right</option>
                                                    <option value="bottom-right-text" <?= $header_images_settings->header_slider_text_position == 'bottom-right-text' ? 'selected' : '' ?>>
                                                        Bottom Right</option>
                                                    <option value="bottom-left-text" <?= $header_images_settings->header_slider_text_position == 'bottom-left-text' ? 'selected' : '' ?>>
                                                        Bottom Left</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="myhr mb-16"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Images are best taken with camera horizontal <span class="text-red ml-2"> Multiple Header Slider Images should be the same ratios</span></p>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if (count($header_slider) > 0) { ?>
                                            <?php foreach ($header_slider as $single) { ?>
                                                <?php if ($single->image) { ?>
                                                    <div class="col-md-3 imgdiv{{ $single->id }}" style="margin-bottom:10px;">
                                                        <img src="<?= base_url('assets/uploads/' . get_current_url() . $single->image) ?>" width="100%">
                                                        <?php if (check_auth_permission(['header_slider', 'header_slider_upload_image'])) { ?>
                                                            <button type="button" class="btn btn-primary btnimgdel delete-slider-image" onclick="delete_front_image('<?= $single->image ?>','image','imgdiv{{ $single->id }}','header_sliders',<?= $single->id ?>)">X</button>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>

                                    <br>

                                    <div class="row" id="header_block_bottom">
                                        <?php if (check_auth_permission(['header_slider', 'header_slider_upload_image'])) { ?>
                                            <div class="col-md-12" style="margin-bottom: 15px;">
                                                <div class="uploadImageDiv">
                                                    <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads" data-ratio="landscape_new,landscape">
                                                        <div class="vertical-middle">
                                                            <div class="title-3 text-color-grey2 text-center">Upload Default Image
                                                            </div>
                                                            <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                    <input class="dataimage" type="hidden" name="header_slider">

                                                    <div class="col-md-6 imgdiv" style="display:none">
                                                        <br>
                                                        <img src='' width="100%" class="imagefromgallerysrc">
                                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="myhr mb-16"></div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="customFile">Select Slider Video

                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="header_slider_video" id="header_slider_video" accept=".mp4">
                                                    <label class="custom-file-label" for="customFile">Select Video</label>
                                                </div>

                                                <div class="text-red title-3 ">Note: Please Upload Landscape Video like 4:3 Aspect Ratio.</div>
                                                <!--<p>Image Size has to be excat width 1000px and height 660px</p>-->
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="header_slider_video_container">
                                            @if($header_slider_video && isset($header_slider_video->video))

                                            <video width="inherit" style="width:inherit" controls>
                                                <source src="<?= base_url("assets/uploads/" . get_current_url() . $header_slider_video->video) ?>" type="video/mp4">
                                            </video>
                                            <button type="button" class="btn btn-primary btnimgdel " onclick="delete_header_slider_video('<?= $header_slider_video->id ?>')">X</button>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row form-bottom make-sticky">
                        <div class="col-md-12">
                            <button type="button" onclick="saveSettingHeader('save')" name="saveheader" class="btn btn-primary" value="save">Save</button>
                            <button type="button" onclick="saveSettingHeader('savereminders')" name="saveheader" class="btn btn-primary" value="savereminders">Save
                                & send reminder</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

    <!-- Header Buttons -->
    <?php if (check_auth_permission(['header_action_buttons'])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="action_btns_bluebar" data-tip_section="action_buttons">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">Header Buttons</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('headersection'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class=" ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'action_btns_bluebar' ? 'display:block;' : '' ?>">
                <form class="data-form" action="{{ url('updateheaderbuttons') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4" id="header_text">
                            <div class="form-group">
                                <label for="headertext2">Header text</label>
                                <input type="text" class="myinput2" name="header_text" id="headertext2" value="<?= $header_text->text ?>" placeholder="Banner Text">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="headertext2color">Header text color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $header_text->color ?>">
                                            </div>
                                            <input type="color" class="colorinput" name="header_text_color" id="bannertextcolor" value="<?= $header_text->color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Header text Size</label><br>
                                <input type="text" class="myinput2 width-50px" name="header_text_font_size" value="<?= $header_text->size_web ?>" placeholder="12">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_font_size">Header Text Font</label>
                                <select class="myinput2" name="header_text_font_family">
                                    <?php if (count($font_family) > 0) { ?>
                                        <?php foreach ($font_family as $single) { ?>
                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                <?= $single->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="blue-divider-line mt-10px mb-10"></div> <!-- (Hassan) Adding divider -->
                    <div class="row action-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="bannertext">Enable</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="header_btn1_enable" <?= $header_btn_1->active ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="btn1text">Button 1 Text</label>
                                <input type="text" class="myinput2" name="header_btn1_text" id="btn1text" value="<?= $header_btn_1->text ?>" placeholder="Leave blank to remove Button">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="btn1color">Button 1 Text color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $header_btn_1->text_color ?>">
                                            </div>
                                            <input type="color" class="colorinput" name="header_btn1_text_color" id="bannertextcolor" value="<?= $header_btn_1->text_color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="btn1link">Button 1 Link</label><br>
                                <select class="myinput2 header_btn1_section width-145px action_button_selection" name="header_btn1_section">
                                    <option value="link">Link to Outside Site</option>
                                    <option value="call" <?= $header_btn_1->action_type == 'call' ? 'selected' : '' ?>>Call
                                    </option>
                                    <option value="sms" <?= $header_btn_1->action_type == 'sms' ? 'selected' : '' ?>>SMS Text
                                    </option>
                                    <option value="email" <?= $header_btn_1->action_type == 'email' ? 'selected' : '' ?>>
                                        Email</option>
                                    <option value="address" <?= $header_btn_1->action_type == 'address' ? 'selected' : '' ?>>
                                        Business Address</option>
                                    <option value="customforms" <?= isset($header_btn_1->action_type) && $header_btn_1->action_type == 'customforms' ? 'selected' : '' ?>>
                                        Link to Form</option>
                                    <option value="image_popup" <?= $header_btn_1->action_type == 'image_popup' ? 'selected' : '' ?>>
                                        Popup - Image</option>
                                    <option value="text_popup" <?= $header_btn_1->action_type == 'text_popup' ? 'selected' : '' ?>>Popup - Text</option>
                                    <option value="video" <?= $header_btn_1->action_type == 'video' ? 'selected' : '' ?>>Popup - Video</option>
                                    <option value="stripe" <?= $header_btn_1->action_type == 'stripe' ? 'selected' : '' ?>>
                                        Popup - Payment</option>
                                    <option value="audioiconfeature" <?= $header_btn_1->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                        Audio File with Icon</option>
                                    <option value="google_map" <?= $header_btn_1->action_type == 'google_map' ? 'selected' : '' ?>>Map</option>

                                    <option value="customforms" <?= $header_btn_1->action_type == 'customforms' ? 'selected' : '' ?>>Forms</option>
                                    <?php foreach ($front_sections as $single) { ?>
                                        <option value="<?= $single->slug ?>" <?= $header_btn_1->action_type == $single->slug ? 'selected' : '' ?>>
                                            <?= $single->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields phone_no_calls" style="<?= $header_btn_1->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for calls</label>
                                <input type="text" class="myinput2" name="header_btn1_action_phone_no_calls" value="<?= $header_btn_1->action_button_phone_no_calls ?>">
                            </div>
                            <div class="form-group action_fields phone_no_sms" style="<?= $header_btn_1->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for sms</label>
                                <input type="text" class="myinput2" name="header_btn1_action_phone_no_sms" value="<?= $header_btn_1->action_button_phone_no_sms ?>">
                            </div>
                            <div class="form-group action_fields action_email" style="<?= $header_btn_1->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                <label for="">Email</label>
                                <input type="text" class="myinput2" name="header_btn1_action_email" value="<?= $header_btn_1->action_button_action_email ?>">
                            </div>
                            <div class="form-group action_fields action_link" <?= $header_btn_1->action_type != 'link' ? 'style="display:none;"' : '' ?>>
                                <input type="text" class="myinput2 btn1link " name="header_btn1_text_link" id="btn1link" value="<?= $header_btn_1->link ?>" placeholder="http://google.com">
                            </div>
                            <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $header_btn_1->action_type == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Select File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3">
                                    <label class="custom-file-label" for="customFile">Select File</label>
                                </div>
                            </div>
                            <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= $header_btn_1->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Upload Images</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="popup_action_images_1[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                    <label class="custom-file-label" for="customFile">Choose files</label>
                                </div>
                            </div>
                            <div class="form-group action_fields audio_icon_feature" name="headerbtn1_audio_icon_feature" style="<?= $header_btn_1->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Select File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="action_button_audio_icon_feature1" id="customFile" accept=".mp3">
                                    <label class="custom-file-label" for="customFile">Select File</label>
                                </div>
                            </div>
                            <div class="row">
                                <?php if ($header_btn_1->action_type == 'audioiconfeature' && $header_btn_1->action_button_audio_icon_feature) {

                                ?>
                                    <div class="col-md-10 imgdiv">
                                        <h4><?= $header_btn_1->action_button_audio_icon_feature ?></h4>
                                        <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_popup_btn" data-id="<?= $header_btn_1->id ?>" data-imgname="<?= $header_btn_1->action_button_audio_icon_feature ?>">X</button>
                                    </div>
                                <?php
                                } ?>
                            </div>
                            <div class="form-group action_fields video_upload" name="header_action_video1" style="<?= $header_btn_1->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Upload Video</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="headerbtn1_action_video" id="customFile" accept=".mp4">
                                    <label class="custom-file-label" for="customFile">Upload Video</label>
                                </div>
                                @if(isset($header_btn_1->action_button_video) && $header_btn_1->action_button_video !='')
                                <div class=" position-relative d-flex header_btn_1">
                                    <video height="80" controls>
                                        <source src="<?= isset($header_btn_1->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($header_btn_1->action_button_video)) : '' ?>" type="video/mp4">
                                    </video>
                                    <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='header_btn_1' data-id="" data-file="{{$header_btn_1->action_button_video}}">X
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <?php if ($header_btn_1->action_type == 'audiofeature' && $header_btn_1->action_button_audio) {

                                ?>
                                    <div class="col-md-10 imgdiv">
                                        <h4><?= $header_btn_1->action_button_audio ?></h4>
                                        <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="header_btn_1" data-imgname="<?= $header_btn_1->action_button_audio ?>">X</button>
                                    </div>
                                <?php


                                } ?>
                            </div>
                            <br>
                            <div class="form-group action_fields action_forms" <?= $header_btn_1->action_type != 'customforms' ? 'style="display:none;"' : '' ?>>
                                <select class="myinput2  width-145px" name="header_btn1_customforms" id="btn1customforms">
                                    <?php if (count($custom_forms) > 0) { ?>
                                        <?php foreach ($custom_forms as $single) { ?>
                                            <option value="<?= $single->id ?>" <?= $header_btn_1->custom_form_id == $single->id ? 'selected' : '' ?>>
                                                <?= $single->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($header_btn_1->action_type) && $header_btn_1->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                <div class="form-group">
                                    <label for="">Feature Action Button Event Forms</label>
                                    <select class="myinput2" name="header_btn1_eventforms" id="customforms">
                                        <?php if (count($event_forms) > 0) { ?>
                                            <?php foreach ($event_forms as $singlecf) { ?>
                                                <option value="<?= $singlecf->id ?>" <?= isset($header_btn_1->event_form_id) && $header_btn_1->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                    <?= $singlecf->title ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class=" action_fields action_map" style="<?= $header_btn_1->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                <div class="form-group ">
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="header_btn1_action_button_map_address" value="<?= isset($header_btn_1->map_address) && $header_btn_1->map_address ? $header_btn_1->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                </div>
                            </div>
                            <div class="form-group action_fields action_address" style="display:<?= $header_btn_1->address_id != '' && ($header_btn_1->action_type == 'address') ? 'block' : 'none' ?>">
                                <label for="addressbtn1">Select an Address</label>
                                <select name="header_btn1_address" class="myinput2">
                                    <?php foreach ($addresses as $address) { ?>
                                        <option value="<?= $address->id ?>" <?= $header_btn_1->address_id == $address->id ? 'selected' : '' ?>>
                                            <?= $address->address_title ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <div class="col-md-6 col-sm-12 p-0">
                                <div class="form-group">
                                    <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $header_btn_1->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                        <label>Popup Text </label>
                                        <textarea class="myinput2 editordata hidden" name="header_btn1_action_button_textpopup"><?php echo $header_btn_1->action_button_textpopup; ?></textarea>
                                        <div class="quilleditor">
                                            <?php echo $header_btn_1->action_button_textpopup; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="btn1color">Button 1 background color</label>
                                <div class="d-flex align-items-center color-main-div">
                                    <div>
                                        <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="ml-10">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor" style="background:<?= $header_btn_1->bg_color ?>"></div>
                                            <input type="color" class="colorinput" name="header_btn1_back_color" id="bannertextcolor" value="<?= $header_btn_1->bg_color ?>" placeholder="#000000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row action-2">
                        <?php if (check_auth_permission(['action_buttons', 'action_button_text'])) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bannertext">Enable</label><br>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="header_btn2_enable" <?= $header_btn_2->active ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Button 2 Text</label>
                                    <input type="text" class="myinput2" name="header_btn2_text" id="bannertext" value="<?= $header_btn_2->text ?>" placeholder="Leave blank to remove Button">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="btn2color">Button 2 Text color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_btn_2->text_color ?>"></div>
                                                <input type="color" class="colorinput" name="header_btn2_text_color" id="bannertextcolor" value="<?= $header_btn_2->text_color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission(['action_buttons', 'action_button_link'])) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2link">Button 2 Link</label><br>
                                    <select class="myinput2 header_btn2_section  width-145px action_button_selection" name="header_btn2_section">
                                        <option value="link">Link to Outside Site</option>
                                        <option value="call" <?= $header_btn_2->action_type == 'call' ? 'selected' : '' ?>>Call</option>
                                        <option value="sms" <?= $header_btn_2->action_type == 'sms' ? 'selected' : '' ?>>SMS Text</option>
                                        <option value="email" <?= $header_btn_2->action_type == 'email' ? 'selected' : '' ?>>Email
                                        </option>
                                        <option value="address" <?= $header_btn_2->action_type == 'address' ? 'selected' : '' ?>>Business Address
                                        </option>
                                        <option value="customforms" <?= $header_btn_2->action_type == 'customforms' ? 'selected' : '' ?>>
                                            Link to Form</option>
                                        <option value="image_popup" <?= $header_btn_2->action_type == 'image_popup' ? 'selected' : '' ?>>
                                            Popup - Image</option>
                                        <option value="text_popup" <?= $header_btn_2->action_type == 'text_popup' ? 'selected' : '' ?>>Popup - Text
                                        </option>
                                        <option value="video" <?= $header_btn_2->action_type == 'video' ? 'selected' : '' ?>>Popup - Video
                                        </option>
                                        <option value="stripe" <?= $header_btn_2->action_type == 'stripe' ? 'selected' : '' ?>>
                                            Popup - Payment</option>
                                        <option value="audioiconfeature" <?= $header_btn_2->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                            Audio File with Icon</option>
                                        <option value="google_map" <?= $header_btn_2->action_type == 'google_map' ? 'selected' : '' ?>>Map
                                        </option>
                                        <?php foreach ($front_sections as $single) { ?>
                                            <option value="<?= $single->slug ?>" <?= $header_btn_2->action_type == $single->slug ? 'selected' : '' ?>><?= $single->name ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group action_fields phone_no_calls" style="<?= $header_btn_2->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for calls</label>
                                    <input type="text" class="myinput2" name="header_btn2_action_phone_no_calls" value="<?= $header_btn_2->action_button_phone_no_calls ?>">
                                </div>
                                <div class="form-group action_fields phone_no_sms" style="<?= $header_btn_2->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for sms</label>
                                    <input type="text" class="myinput2" name="header_btn2_action_phone_no_sms" value="<?= $header_btn_2->action_button_phone_no_sms ?>">
                                </div>
                                <div class="form-group action_fields action_email" style="<?= $header_btn_2->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Email</label>
                                    <input type="text" class="myinput2" name="header_btn2_action_email" value="<?= $header_btn_2->action_button_action_email ?>">
                                </div>
                                <div class="form-group action_fields action_link">
                                    <input type="text" <?= $header_btn_2->action_type != 'link' ? 'style="display:none;"' : '' ?> class="myinput2 btn2link" name="header_btn2_text_link" id="btn2link" value="<?= $header_btn_2->link ?>" placeholder="http://google.com">
                                </div>
                                <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= $header_btn_2->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="popup_action_images_2[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                        <label class="custom-file-label" for="customFile">Choose files</label>
                                    </div>
                                </div>
                                <div class="form-group action_fields video_upload" name="header_action_video2" style="<?= $header_btn_2->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Video</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="headerbtn2_action_video" id="customFile" accept=".mp4">
                                        <label class="custom-file-label" for="customFile">Upload Video</label>
                                    </div>
                                    @if(isset($header_btn_2->action_button_video) && $header_btn_2->action_button_video !='')
                                    <div class=" position-relative d-flex header_btn_2">
                                        <video height="80" controls>
                                            <source src="<?= isset($header_btn_2->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($header_btn_2->action_button_video)) : '' ?>" type="video/mp4">
                                        </video>
                                        <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='header_btn_2' data-id="" data-file="{{$header_btn_2->action_button_video}}">X
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature" style="<?= $header_btn_2->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature2" id="customFile" accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                    <div class="row">
                                        <?php if ($header_btn_2->action_type == 'audioiconfeature' && $header_btn_2->action_button_audio_icon_feature) {

                                        ?>
                                            <div class="col-md-10 imgdiv">
                                                <h4><?= $header_btn_2->action_button_audio_icon_feature ?></h4>
                                                <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_popup_btn" data-id="<?= $header_btn_2->id ?>" data-imgname="<?= $header_btn_2->action_button_audio_icon_feature ?>">X</button>
                                            </div>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group action_fields audio_upload" name="feature_action_audio" style="display: none;">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($header_btn_2->action_type == 'audiofeature' && $header_btn_2->action_button_audio) {

                                    ?>
                                        <div class="col-md-10 imgdiv">
                                            <h4><?= $header_btn_2->action_button_audio ?></h4>
                                            <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="header_btn_2" data-imgname="<?= $header_btn_2->action_button_audio ?>">X</button>
                                        </div>
                                    <?php


                                    } ?>
                                </div>
                                <br>
                                <div class="form-group action_fields action_forms" <?= $header_btn_2->action_type != 'customforms' ? 'style="display:none;"' : '' ?>>
                                    <select class="myinput2  width-145px" name="header_btn2_customforms" id="btn2customforms">
                                        <?php if (count($custom_forms) > 0) { ?>
                                            <?php foreach ($custom_forms as $single) { ?>
                                                <option value="<?= $single->id ?>" <?= $header_btn_2->custom_form_id == $single->id ? 'selected' : '' ?>><?= $single->title ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($header_btn_2->action_type) && $header_btn_2->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                    <div class="form-group">
                                        <label for="">Feature Action Button Event Forms</label>
                                        <select class="myinput2" name="header_btn2_eventforms" id="customforms">
                                            <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $singlecf) { ?>
                                                    <option value="<?= $singlecf->id ?>" <?= isset($header_btn_2->event_form_id) && $header_btn_2->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                        <?= $singlecf->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class=" action_fields action_map" style="<?= $header_btn_2->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                    <div class="form-group ">
                                        <label for="address">Enter Address</label>
                                        <input type="text" class="myinput2 " name="header_btn2_action_button_map_address" value="<?= isset($header_btn_2->map_address) && $header_btn_2->map_address ? $header_btn_2->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                    </div>
                                </div>
                                <div class="form-group action_fields action_address" style="display:<?= $header_btn_2->address_id != '' && ($header_btn_2->action_type == 'address') ? 'block' : 'none' ?>">
                                    <label for="addressbtn1">Select an Address</label>
                                    <select name="header_btn2_address" class="myinput2">
                                        <?php foreach ($addresses as $address) { ?>
                                            <option value="<?= $address->id ?>" <?= $header_btn_2->address_id == $address->id ? 'selected' : '' ?>>
                                                <?= $address->address_title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <div class="col-md-6 col-sm-12 p-0">
                                    <div class="form-group">
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $header_btn_2->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="header_btn2_action_button_textpopup"><?php echo $header_btn_2->action_button_textpopup; ?></textarea>
                                            <div class="quilleditor">
                                                <?php echo $header_btn_2->action_button_textpopup; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission('action_buttons')) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="btn1color">Button 2 background color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_btn_2->bg_color ?>"></div>
                                                <input type="color" class="colorinput" name="header_btn2_back_color" id="bannertextcolor" value="<?= $header_btn_2->bg_color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row action-3">
                        <?php if (check_auth_permission(['action_buttons', 'action_button_text'])) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bannertext">Enable</label><br>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="header_btn3_enable" <?= (isset($header_btn_3->active) && $header_btn_3->active) ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn3text">Button 3 Text</label>
                                    <input type="text" class="myinput2" name="header_btn3_text" id="btn3text" value="<?= isset($header_btn_3->text) ? $header_btn_3->text : '' ?>" placeholder="Leave blank to remove Button">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="btn3color">Button 3 Text color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= isset($header_btn_3->text_color) ? $header_btn_3->text_color : '' ?>"></div>
                                                <input type="color" class="colorinput" name="header_btn3_text_color" id="bannertextcolor" value="<?= isset($header_btn_3->text_color) ? $header_btn_3->text_color : '' ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission(['action_buttons', 'action_button_link'])) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn3link">Button 3 Link</label><br>
                                    <select class="myinput2 header_btn3_section width-145px action_button_selection" name="header_btn3_section">
                                        <option value="link">Link to Outside Site</option>
                                        <option value="call" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'call' ? 'selected' : '' ?>>Call</option>
                                        <option value="sms" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'sms' ? 'selected' : '' ?>>SMS Text</option>
                                        <option value="email" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'email' ? 'selected' : '' ?>>Email</option>
                                        <option value="address" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'address' ? 'selected' : '' ?>>Business Address
                                        </option>
                                        <option value="customforms" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'customforms' ? 'selected' : '' ?>>
                                            Link to Form</option>
                                        <option value="image_popup" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'image_popup' ? 'selected' : '' ?>>
                                            Popup - Image</option>
                                        <option value="text_popup" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'text_popup' ? 'selected' : '' ?>>Popup - Text
                                        </option>
                                        <option value="video" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'video' ? 'selected' : '' ?>>Popup - Video
                                        </option>
                                        <option value="stripe" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'stripe' ? 'selected' : '' ?>>
                                            Popup - Payment</option>
                                        <option value="audioiconfeature" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'audioiconfeature' ? 'selected' : '' ?>>
                                            Audio File with Icon</option>

                                        <option value="google_map" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'google_map' ? 'selected' : '' ?>>Map
                                        </option>
                                        <?php foreach ($front_sections as $single) { ?>
                                            <option value="<?= $single->slug ?>" <?= isset($header_btn_3->action_type) && $header_btn_3->action_type == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                                <div class="form-group action_fields phone_no_calls" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'call' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for calls</label>
                                    <input type="text" class="myinput2" name="header_btn3_action_phone_no_calls" value="<?= isset($header_btn_3->action_button_phone_no_calls) ? $header_btn_3->action_button_phone_no_calls : '' ?>">
                                </div>
                                <div class="form-group action_fields phone_no_sms" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'sms' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Phone number for sms</label>
                                    <input type="text" class="myinput2" name="header_btn3_action_phone_no_sms" value="<?= isset($header_btn_3->action_button_phone_no_sms) ? $header_btn_3->action_button_phone_no_sms : '' ?>">
                                </div>
                                <div class="form-group action_fields action_email" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'email' ? 'display:block' : 'display:none' ?>">
                                    <label for="">Email</label>
                                    <input type="text" class="myinput2" name="header_btn3_action_email" value="<?= isset($header_btn_3->action_button_action_email) ? $header_btn_3->action_button_action_email : '' ?>">
                                </div>
                                <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Images</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="popup_action_images_3[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                        <label class="custom-file-label" for="customFile">Choose files</label>
                                    </div>
                                </div>
                                <div class=" action_fields action_link" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'link' ? 'display:block' : 'display:none' ?>">
                                <input type="text" class="myinput2 btn3link" name="header_btn3_text_link" id="btn3link" 
                                value="{{ old('header_btn3_text_link', $header_btn_3->link ?? '') }}" 
                                placeholder="http://google.com">                                </div>
                                <div class="form-group action_fields audio_upload" name="feature_action_audio" style="display: none;">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php if (isset($header_btn_3->action_type) && $header_btn_3->action_type == 'audiofeature' && $header_btn_3->action_button_audio) {

                                    ?>
                                        <div class="col-md-10 imgdiv">
                                            <h4><?= $header_btn_3->action_button_audio ?></h4>
                                            <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="header_btn_3" data-imgname="<?= $header_btn_3->action_button_audio ?>">X</button>
                                        </div>
                                    <?php


                                    } ?>
                                </div>
                                <br>
                                <div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature3" id="customFile" accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                    <div class="row">
                                        <?php if (isset($header_btn_3->action_type) && $header_btn_3->action_type == 'audioiconfeature' && $header_btn_3->action_button_audio_icon_feature) {

                                        ?>
                                            <div class="col-md-10 imgdiv">
                                                <h4><?= $header_btn_3->action_button_audio_icon_feature ?></h4>
                                                <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="alert_popup_btn" data-id="<?= $header_btn_3->id ?>" data-imgname="<?= $header_btn_3->action_button_audio_icon_feature ?>">X</button>
                                            </div>
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="form-group action_fields video_upload" name="header_action_video3" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'video' ? 'display:block' : 'display:none' ?>">
                                    <label for="customFile">Upload Video</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="headerbtn3_action_video" id="customFile" accept=".mp4">
                                        <label class="custom-file-label" for="customFile">Upload Video</label>
                                    </div>
                                    @if(isset($header_btn_3->action_button_video) && $header_btn_3->action_button_video !='')
                                    <div class=" position-relative d-flex header_btn_3">
                                        <video height="80" controls>
                                            <source src="<?= isset($header_btn_3->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($header_btn_3->action_button_video)) : '' ?>" type="video/mp4">
                                        </video>
                                        <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='header_btn_3' data-id="" data-file="{{$header_btn_3->action_button_video}}">X
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class=" action_fields action_forms" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'customforms' ? 'display:block' : 'display:none' ?>"">
                            <select 
                                class=" myinput2 width-145px" name="header_btn3_customforms" id="btn3customforms">
                                    <?php if (count($custom_forms) > 0) { ?>
                                        <?php foreach ($custom_forms as $single) { ?>
                                            <option value="<?= $single->id ?>" <?= isset($header_btn_3->custom_form_id) && $header_btn_3->custom_form_id == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    </select>
                                </div>
                                <div class="clearfix action_fields action_event_forms" id="feature_customforms" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'attendhub' ?  'display:block' : 'display:none' ?>">
                                    <div class="form-group">
                                        <label for="">Feature Action Button Event Forms</label>
                                        <select class="myinput2" name="header_btn3_eventforms" id="customforms">
                                            <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $singlecf) { ?>
                                                    <option value="<?= $singlecf->id ?>" <?= isset($header_btn_3->event_form_id) && $header_btn_3->event_form_id == $singlecf->id ? 'selected' : '' ?>>
                                                        <?= $singlecf->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class=" action_fields action_map" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                                    <div class="form-group ">
                                        <label for="address">Enter Address</label>
                                        <input type="text" class="myinput2 " name="header_btn3_action_button_map_address" value="<?= isset($header_btn_3->map_address) && $header_btn_3->map_address ? $header_btn_3->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                    </div>
                                </div>
                                <div class="form-group action_fields action_address" style="display:<?= isset($header_btn_3->address_id) && $header_btn_3->address_id != '' && ($header_btn_3->action_type == 'address') ? 'block' : 'none' ?>">
                                    <label for="addressbtn1">Select an Address</label>
                                    <select name="header_btn3_address" class="myinput2">
                                        <?php foreach ($addresses as $address) {  ?>
                                            <option value="<?= $address->id ?>" <?= isset($header_btn_3->address_id) && $header_btn_3->address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <div class="col-md-6 col-sm-12 p-0">
                                    <div class="form-group">
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= isset($header_btn_3->action_type) && $header_btn_3->action_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="header_btn3_action_button_textpopup"><?php echo isset($header_btn_3->action_button_textpopup) ? $header_btn_3->action_button_textpopup : ''; ?></textarea>
                                            <div class="quilleditor">
                                                <?php echo isset($header_btn_3->action_button_textpopup) ? $header_btn_3->action_button_textpopup : ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission('action_buttons')) { ?>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="btn1color">Button 3 background color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= isset($header_btn_3->bg_color) ? $header_btn_3->bg_color : '#000000' ?>"></div>
                                                <input type="color" class="colorinput" name="header_btn3_back_color" id="bannertextcolor" value="<?= isset($header_btn_3->bg_color) ? $header_btn_3->bg_color : '#000000' ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                    <div class="row form-bottom make-sticky">
                        <div class="col-md-12">
                            <button type="submit" name="saveactionbuuons" class="btn btn-primary" value="save">Save</button>
                            <button type="submit" name="saveactionbuuons" class="btn btn-primary" value="savereminders">Save & send
                                reminder</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>


    <!-- Header Text -->
    <?php if (check_auth_permission([
        'address_at_header',
        'header_phone_text',
        'header_text',
        'header_address_title',
        'header_address_street',
        'header_address_location',
        'header_address_comment'
    ])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="header_text_bluebar" data-tip_section="header_text">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">Header Text</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('headersection'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class=" ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'header_text_bluebar' ? 'display:block;' : '' ?>">
                <form action="{{ url('updateheadertext') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <?php if (check_auth_permission('address_at_header')) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Phone Title</label>
                                    <input type="text" class="myinput2" name="header_phone_title" id="bannertext" value="<?= $header_phone_title->text ?>" placeholder="Header phone Title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Phone Title Text Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_phone_title->color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="header_phone_title_color" id="bannertextcolor" value="<?= $header_phone_title->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Phone Title Text Font</label>
                                    <select class="myinput2" name="header_phone_title_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_phone_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Phone Title Text Size</label><br>
                                    <input type="number" class="myinput2 width-50px" name="current_header_phone_call_title_font_size" id="btn2color" value="<?= $header_phone_title->size_web ?>" placeholder="16">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission('header_phone_text')) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Phone Number</label>
                                    <input type="text" class="myinput2" name="header_text_7_phone" id="bannertext" value="<?= $header_phone_text->text ?>" placeholder="Header phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Phone Number Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_phone_text->color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="header_text_7_phone_color" id="bannertextcolor" value="<?= $header_phone_text->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Phone Number Font</label>
                                    <select class="myinput2" name="current_header_phone_call_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_phone_text->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Phone Number Size</label><br>
                                    <input type="number" class="myinput2 width-50px" name="current_header_phone_call_font_size" id="btn2color" value="<?= $header_phone_text->size_web ?>" placeholder="16">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (check_auth_permission('address_at_header')) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Text (SMS) Title</label>
                                    <input type="text" class="myinput2" name="header_phonr_text_title" id="bannertext" value="<?= $header_phonr_text_title->text ?>" placeholder="Header phone text Title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Text (SMS) Title Text Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_phonr_text_title->color ?>"></div>
                                                <input type="color" class="colorinput" name="header_phone_text_title_color" id="bannertextcolor" value="<?= $header_phonr_text_title->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Text (SMS) Title Font</label>
                                    <select class="myinput2" name="header_text_title_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_phonr_text_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Text (SMS) Title Text Size</label><br>
                                    <input type="number" class="myinput2 width-50px" name="current_header_phone_text_title_size" id="btn2color" value="<?= $header_phonr_text_title->size_web ?>" placeholder="16">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission('header_text')) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Text (SMS) Number</label>
                                    <input type="text" class="myinput2" name="header_phone_text" id="bannertext" value="<?= $header_phone_text_2->text ?>" placeholder="Header phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Text (SMS) Number Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_phone_text_2->color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="header_phone_text_color" id="bannertextcolor" value="<?= $header_phone_text_2->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Text (SMS) Number Font</label>
                                    <select class="myinput2" name="current_header_phone_text_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_phone_text_2->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Text (SMS) Number Text Size</label><br>
                                    <input type="number" class="myinput2 width-50px" name="current_header_phone_text_font_size" id="btn2color" value="<?= $header_phone_text_2->size_web ?>" placeholder="16">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (check_auth_permission('header_address_title')) { ?>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Address Title</label>
                                    <input type="text" class="myinput2" name="header_address_title" id="bannertext" value="<?= $header_address_title->text ?>" placeholder="Header text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Address Title color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_address_title->color ?>">
                                                </div>
                                                <input type="color" class="colorinput" name="header_address_title_color" id="bannertextcolor" value="<?= $header_address_title->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Address Title Text size</label><br>
                                    <input type="text" class="myinput2 width-50px" name="header_address_title_fontsize" id="btn2color" value="<?= $header_address_title->size_web ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Address Title Font</label>
                                    <select class="myinput2" name="header_address_title_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_address_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <?php if (check_auth_permission('header_address_street')) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Address street</label>
                                    <input type="text" class="myinput2" name="header_address2_street" id="bannertext" value="<?= $header_address2_street->text ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission('header_address_location')) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Address city, state, zipcode</label>
                                    <input type="text" class="myinput2" name="header_address2_citystatezipcode" id="bannertext" value="<?= $header_address2_citystatezipcode->text ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission('header_address_comment')) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Header Address comment</label>
                                    <input type="text" class="myinput2" name="header_address2_comment" id="bannertext" value="<?= $header_address2_comment->text ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission(['header_address_street', 'header_address_location', 'header_address_comment'])) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Address Text Size</label><br>
                                    <input type="text" class="myinput2 width-50px" name="header_address_text_size2" id="btn2color" value="<?= $header_address2_street->size_web ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="btn2color">Header Address Text Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $header_address2_street->color ?>"></div>
                                                <input type="color" class="colorinput" name="header_address_text_color2" id="bannertextcolor" value="<?= $header_address2_street->color ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title_font_size">Header Address Font</label>
                                    <select class="myinput2" name="current_header_address_font_family">
                                        <?php if (count($font_family) > 0) { ?>
                                            <?php foreach ($font_family as $single) { ?>
                                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $header_address2_street->fontfamily == $single->id ? 'selected' : '' ?>>
                                                    <?= $single->name ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                    <div class="row form-bottom make-sticky">
                        <div class="col-md-12">
                            <button type="submit" name="savebusniessinfo" class="btn btn-primary" value="save">Save</button>
                            <button type="submit" name="savebusniessinfo" class="btn btn-primary" value="savereminders">Save & send reminder</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

    <!-- News Post -->
    <?php if (check_auth_permission(['news_posts', 'add_news_post', 'news_post_actions'])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="news_posts_bluebar" data-tip_section="news_posts">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">News Posts</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('newspostsection'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class=" ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent " style="<?= isset($_GET['block'])  && $_GET['block'] == 'news_posts_bluebar' ? 'display:block;' : '' ?>">
                <?php if (check_auth_permission('news_posts')) { ?>
                    <form action="{{ url('updatenewspostsettings') }}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
                        @csrf
                        <?php if (check_auth_permission(['build_site_Content'])) { ?>
                            <div class="row mb-17">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Override Background</label>
                                        <label class="switch ml-7">
                                            <input type="checkbox" class="notificationswitch override_bg_enable " name="news_post_override_bg" data-slug="news_post_override_bg" <?php echo  $news_post_setting->news_post_override_bg ? 'checked' : '' ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group news_post_override_bg" style="display:<?= $news_post_setting->news_post_override_bg == '1' ? 'block' : 'none' ?>">
                                        <label for="popup_background_color">News Posts background color</label>
                                        <div class="d-flex align-items-center color-main-div">
                                            <div>
                                                <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                            </div>
                                            <div class="ml-10">
                                                <div class="inputcolordiv">
                                                    <div class="inputcolor" style="background:<?= $news_post_setting->news_post_background ?>"></div>
                                                    <input type="color" class="colorinput" name="news_post_background" id="bannertextcolor2" value="<?= $news_post_setting->news_post_background ?>" placeholder="#000000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-bottom make-sticky">
                                <div class="col-md-12">
                                    <button type="submit" name="save_generic_news_post_settings" class="btn btn-primary" value="save">Save</button>
                                </div>
                            </div>
                            <div class="myhr mb-16"></div>
                        <?php } ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                                        <div class="d-flex align-items-center">
                                            <div class="title-2">Use Generic</div>
                                            <label class="switch ml-3">
                                                <input type="checkbox" class="notificationswitch saveGeneric" data-table="newsPostSetting" data-column="use_generic_news_post_setting" name="use_generic_news_post_setting" <?= $news_post_setting->use_generic_news_post_setting ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bannertext">Show Date Post?</label><br>
                                            <label class="switch">
                                                <input type="checkbox" class="notificationswitch" name="generic_news_post_show_date" <?= $news_post_setting->generic_news_post_show_date ? 'checked' : '' ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Post Title Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $generic_news_post_title->color ?>"></div>
                                                        <input type="color" class="colorinput" name="generic_news_post_title_color" id="bannertextcolor" value="<?= $generic_news_post_title->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Post Title Text Size</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_news_post_title_size" value="<?php echo $generic_news_post_title->size_web; ?>" placeholder="18">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">Generic News Post Title Font</label>
                                            <select class="myinput2" name="generic_news_post_title_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_news_post_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Post Description Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $generic_news_post_desc->color ?>"></div>
                                                        <input type="color" class="colorinput" name="generic_news_post_desc_color" id="bannertextcolor" value="<?= $generic_news_post_desc->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Post Description Text Size</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_news_post_desc_size" value="<?php echo $generic_news_post_desc->size_web; ?>" placeholder="16">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">Generic News Post Description Text Font</label>
                                            <select class="myinput2" name="generic_news_post_desc_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_news_post_desc->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-bottom make-sticky">
                                    <div class="col-md-12">
                                        <button type="submit" name="save_generic_news_post_settings" class="btn btn-primary" value="save">Save</button>
                                        <button type="submit" name="save_generic_news_post_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                <?php } ?>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2 news_posts_list">
                                <div class="d-flex align-items-center">
                                    <div class="title-2">News Post</div>
                                </div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>
                    </div>
                    <div class="editcontent2">
                        <div class="row">
                            <?php if (check_auth_permission('add_news_post')) { ?>
                                <div class="col-sm-6">
                                    <a href="<?= base_url('addnewspost/') ?>"><button type="button" class="btn btn-sm btn-primary">Add News post</button></a>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6 enablesortingdiv" align="right">
                                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                            </div>
                        </div>
                        <br>

                        <div class="table-responsive" data-table="news_posts">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Post Title</th>
                                        <th class="hide-mobile">Desc</th>
                                        <?php if (check_auth_permission('news_post_actions')) { ?>
                                            <th> Action </th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody class="sortablenewstable">
                                    <?php if (count($news_posts) > 0) { ?>
                                        <?php $i = 0;
                                        foreach ($news_posts as $row) {
                                            $i++; ?>
                                            <tr class="newssections" data-sectionid="<?= $row->id ?>" onclick="showNewsActionModal(<?= $row->id ?>)">
                                                <td>
                                                    <?php if ($row->image) { ?>
                                                        <img src="<?= base_url('assets/uploads/' . get_current_url() . $row->image) ?>" class="table-images">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="limit-text"><?= $row->post_title ?></div>
                                                </td>

                                                <td class="hide-mobile">
                                                    <div class=" limit-text">
                                                        <?= substr(strip_tags($row->post_desc), 0, 200) ?> </div>
                                                </td>
                                                <td>
                                                    <?php if (check_auth_permission('news_post_actions')) { ?>
                                                        <div class="btn-group">
                                                            <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu" x-placement="bottom-start">
                                                                <a class="dropdown-item" href="<?php echo base_url('editnewspost/' . $row->id . '/'); ?>">Edit</a>
                                                                <a class="dropdown-item" href="<?php echo base_url('deletenewspost/' . $row->id . '/?sec=news_posts_bluebar'); ?>" onclick="return confirm('Are You Sure?');">Delete</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="modal  fade" id="newsPostModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">News Post Action
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <center>
                                                                        <?php if (check_auth_permission('news_post_actions')) { ?>
                                                                            <a href="<?php echo base_url('admin/newspost/edit/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <a href="<?php echo base_url('admin/newspost/delete/' . $row->id . '/?sec=news_posts_bluebar'); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');"><i class="fa fa-trash-o"></i> Delete</a>
                                                                        <?php } ?>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="3" class="text-center"> No record Found </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- News Feed -->
    <?php if (check_auth_permission(['news_feed'])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="newsfeed_bluebar" data-tip_section="newsfeed">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">News Feed</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('newsfeed'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class="ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'newsfeed_bluebar' ? 'display:block;' : '' ?>">
                <form action="{{ url('updatenewsfeedsettings') }}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
                    @csrf
                    <?php if (check_auth_permission(['build_site_Content'])) { ?>
                        <div class="row mb-17">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Override Background</label>
                                    <label class="switch ml-7">
                                        <input type="checkbox" class="notificationswitch override_bg_enable " name="news_feed_override_bg" data-slug="news_feed_override_bg" <?php echo  $news_feed_setting->news_feed_override_bg ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group news_feed_override_bg" style="display:<?= $news_feed_setting->news_feed_override_bg == '1' ? 'block' : 'none' ?>">
                                    <label for="popup_background_color">News Feed background color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:<?= $news_feed_setting->news_feed_bg ?>"></div>
                                                <input type="color" class="colorinput" name="news_feed_bg" id="bannertextcolor2" value="<?= $news_feed_setting->news_feed_bg ?>" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myhr mb-16"></div>
                        <div class="row mb-2 mt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Load More Button Text</label><br>
                                    <input type="text" class="myinput2" name="loadMore_btn_description"
                                        value="{{ $generic_newsfeed_loadMore->text ?? 'Load more' }}" placeholder="Enter description">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Load More Button Text Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets/admin2/img/dismiss-color.svg') }}" alt="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background: {{ $generic_newsfeed_loadMore->color ?? '#000000' }}"></div>
                                                <input type="color" class="colorinput" name="load_more_desc_color" id="bannertextcolor"
                                                    value="{{ $generic_newsfeed_loadMore->color ?? '#000000' }}" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Load More Button Text Size (Web)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="load_more_desc_size_web"
                                        value="{{ $generic_newsfeed_loadMore->size_web ?? '13' }}" placeholder="13">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Load More Button Text Size (Mobile)</label><br>
                                    <input type="text" class="myinput2 width-50px" name="load_more_desc_size_mobile"
                                        value="{{ $generic_newsfeed_loadMore->size_mobile ?? '11' }}" placeholder="16">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title_font_size">Load More Button Text Font</label>
                                    <select class="myinput2" name="load_more_desc_font_family">
                                        @if (!empty($font_family) && count($font_family) > 0)
                                        @foreach ($font_family as $single)
                                        <option style="font-family: {{ $single->value }};"
                                            value="{{ $single->id }}"
                                            {{ ($generic_newsfeed_loadMore->fontfamily ?? '') == $single->id ? 'selected' : '' }}>
                                            {{ $single->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Load More Button Background Color</label>
                                    <div class="d-flex align-items-center color-main-div">
                                        <div>
                                            <img src="{{ url('assets/admin2/img/dismiss-color.svg') }}" alt="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background: {{ $generic_newsfeed_loadMore->bg_color ?? '#ffffff' }}"></div>
                                                <input type="color" class="colorinput" name="load_more_bg_color" id="bannertextcolor"
                                                    value="{{ $generic_newsfeed_loadMore->bg_color ?? '#ffffff' }}" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (check_auth_permission(['news_feed'])) { ?>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="title-2">News Feed Email Settings</div>
                                        <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">

                                <div class="row">
                                    <?php if ($news_feed_logo->file_name && $news_feed_logo->file_name != "") { ?>
                                        <div class="col-md-3 nf_image_div">
                                            <div class="form-group">
                                                <label for="headerlogo">News Feed Email Logo</label>
                                                <img src="<?= url('assets/uploads/' . get_current_url() . $news_feed_logo->file_name) ?>" width="100%">
                                                <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('{{ $news_feed_logo->file_name }}','news_feed_logo','nf_image_div','images','0','true')">X</button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-4">
                                        <div class="uploadImageDiv">
                                            <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                                <div class="vertical-middle">
                                                    <div class="title-3 text-color-grey2 text-center">Upload Default Image</div>
                                                    <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                            <input class="dataimage" type="hidden" name="newsfeed_image">

                                            <div class="col-md-6 imgdiv" style="display:none">
                                                <br>
                                                <img src='' width="100%" class="imagefromgallerysrc">
                                                <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="newsfeed_from_name">From Name </label>
                                            <input type="text" class="myinput2" name="newsfeed_from_name" id="newsfeed_from_name" value="<?= $news_feed_setting->from_name ?>" placeholder="Sample Email ">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="newsfeed_from_email">From Email</label>
                                            <input type="text" class="myinput2" name="newsfeed_from_email" id="newsfeed_from_email" value="<?= $news_feed_setting->from_email ?>" placeholder="Sample Email ">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="newsfeed_reply_to">Reply To Email</label>
                                            <input type="email" class="myinput2" name="newsfeed_reply_to" id="newsfeed_reply_to" value="<?= $news_feed_setting->reply_to ?>" placeholder="Reply-to Email ">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="newsfeed_optout_email">Opt-Out Link Email Address</label>
                                            <input type="email" class="myinput2" name="newsfeed_optout_email" id="newsfeed_optout_email" value="<?= $news_feed_setting->optout_email ?>" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="preheader">Enter Preheader Text</label>
                                            <input type="text" class="myinput2" name="preheader" id="preheader" value="<?= $news_feed_setting->preheader ?>" placeholder="Preheader">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>News Feed Email Teaser Title Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $newsfeed_teaser_title->color ?>"></div>
                                                        <input type="color" class="colorinput" name="newsfeed_teaser_title_text_color" id="bannertextcolor" value="<?= $newsfeed_teaser_title->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>News Feed Email Teaser Title Text Size </label><br>
                                            <input type="text" class="myinput2 width-50px" name="newsfeed_teaser_title_text_size" value="<?php echo $newsfeed_teaser_title->size_web; ?>" placeholder="18">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">News Feed Email Teaser Title Font</label>
                                            <select class="myinput2" name="newsfeed_teaser_title_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $newsfeed_teaser_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row  make-sticky">
                                    <div class="col-md-12">
                                        <button type="submit" name="save_newsfeed_email_settings" class="btn btn-primary" value="save">Save</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  make-sticky">
                            <div class="col-md-12">
                                <button type="submit" name="save_newsfeed_email_settings" class="btn btn-primary" value="save">Save</button>

                            </div>
                        </div>
                </form>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                                <div class="d-flex align-items-center">
                                    <div class="title-2">News Feed Teaser Generic Settings</div>
                                    <label class="switch ml-3">
                                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="newsFeedSetting" data-column="use_generic_newsfeed_setting" name="use_generic_newsfeed_setting" <?= $news_feed_setting->use_generic_newsfeed_setting ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>
                    </div>
                    <div class="editcontent2">
                        <?php if (check_auth_permission('news_posts')) { ?>
                            <form action="{{ url('updatenewsfeedgenericsettings') }}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser SubTitle Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $generic_newsfeed_title->color ?>"></div>
                                                        <input type="color" class="colorinput" name="generic_newsfeed_title_color" id="bannertextcolor" value="<?= $generic_newsfeed_title->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser SubTitle Text Size (Web)</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_newsfeed_title_size" value="<?php echo $generic_newsfeed_title->size_web; ?>" placeholder="18">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser SubTitle Text Size (Mobile)</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_newsfeed_title_size_mobile" value="<?php echo $generic_newsfeed_title->size_mobile; ?>" placeholder="18">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">Generic News Feed Teaser SubTitle Font</label>
                                            <select class="myinput2" name="generic_newsfeed_title_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_newsfeed_title->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser Description Text Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $generic_newsfeed_desc->color ?>"></div>
                                                        <input type="color" class="colorinput" name="generic_newsfeed_desc_color" id="bannertextcolor" value="<?= $generic_newsfeed_desc->color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser Description Text Size (Web)</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_newsfeed_desc_size" value="<?php echo $generic_newsfeed_desc->size_web; ?>" placeholder="16">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generic News Feed Teaser Description Text Size (Mobile)</label><br>
                                            <input type="text" class="myinput2 width-50px" name="generic_newsfeed_desc_size_mobile" value="<?php echo $generic_newsfeed_desc->size_mobile; ?>" placeholder="16">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">Generic News Feed Teaser Description Text Font </label>
                                            <select class="myinput2" name="generic_newsfeed_desc_font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_newsfeed_desc->fontfamily == $single->id ? 'selected' : '' ?>>
                                                            <?= $single->name ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>News Feed Background Color</label>
                                            <div class="d-flex align-items-center color-main-div">
                                                <div>
                                                    <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                                </div>
                                                <div class="ml-10">
                                                    <div class="inputcolordiv">
                                                        <div class="inputcolor" style="background:<?= $news_feed_setting->newsfeed_bg_color ?>"></div>
                                                        <input type="color" class="colorinput" name="newsfeed_bg_color" id="bannertextcolor" value="<?= $news_feed_setting->newsfeed_bg_color ?>" placeholder="#000000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row  make-sticky">
                                    <div class="col-md-12">
                                        <button type="submit" name="save_generic_newsfeed_settings" class="btn btn-primary" value="save">Save</button>
                                        <button type="submit" name="save_generic_newsfeed_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>

                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (check_auth_permission(['news_feed'])) { ?>
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2 news_feed">
                                <div class="d-flex align-items-center">
                                    <div class="title-2">News Feeds</div>
                                </div>
                                <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>


                    </div>
                    <div class="editcontent2">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?= url('addnewsfeed') ?>"><button type="button" class="btn btn-sm btn-primary">Add News Feed</button></a>
                            </div>
                            <div class="col-md-3 ">
                                <div class="enablesortingdiv" align="right">
                                    <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" align="right">

                                    <label for="bannertext">Post date stamps</label><br>
                                    <label for="bannertext ">Off</label>
                                    <label class="switch ml-1 mr-1">
                                        <input type="checkbox" class="notificationswitch newsfeeddatestamps" name="show_dates" <?php echo $news_feed_setting->show_dates ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>

                                    <label for="bannertext">On</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive" data-table="news_feed">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Sub Title</th>
                                        <th class="hide-mobile">Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class='sort_news_feed'>
                                    <?php if (count($news_feeds) > 0) { ?>
                                        <?php $i = 0;
                                        foreach ($news_feeds as $row) {
                                            $i++; ?>
                                            <tr id="newsSectionDiv<?= $row->id ?>" class="newssections" data-sectionid="<?= $row->id ?>" onclick="showNewsFeedActionModal(<?= $row->id ?>)">
                                                <td> <?php if ($row->feed_image) { ?>
                                                        <img src="<?= url('assets/uploads/' . get_current_url() . $row->feed_image) ?>" class="table-images">
                                                    <?php  }  ?>
                                                </td>
                                                <td>
                                                    <div class="d-post-title limit-text"><?= $row->subtitle_text ?>
                                                    </div>
                                                </td>
                                                <td class="hide-mobile">
                                                    <div class="d-post-description  limit-text">
                                                        <?= substr($row->desc_text, 0, 200) ?> </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start">
                                                            <a href="<?php echo url('editnewsfeed/' . $row->id . '/'); ?>" class="dropdown-item">Edit</a>
                                                            <a href="<?php echo url('deletenewsfeed/' . $row->id . '/?sec=newsfeed_bluebar'); ?>" class="dropdown-item" onclick="return confirm('Are You Sure?');">Delete</a>
                                                            <a href="<?php echo url('send_notification/' . $row->id . '/'); ?>" class="dropdown-item">Teaser Notification</a>
                                                            {{-- <a href="<?php echo url('duplicatenewsfeed/' . $row->id . '/'); ?>" class="dropdown-item"> Duplicate</a> --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal  fade" id="newsFeedModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">News Feed Action
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <center>
                                                                        <?php if (check_auth_permission('news_posts') || check_auth_permission('news_post_actions')) { ?>
                                                                            <a href="<?php echo url('admin/newsfeed/edit/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            <a href="<?php echo url('admin/newsfeed/delete/' . $row->id . '/?sec=newsfeed_bluebar'); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');"><i class="fa fa-trash-o"></i> Delete</a>
                                                                            <br />
                                                                            <a href="<?php echo url('send_notification/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i> Teaser Notification</a>
                                                                        <?php } ?>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="3" class="text-center"> No record Found </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>

            </div>
        </div>
    <?php } ?>

    <!-- Audio Files -->
    <?php if (check_auth_permission([
        'audio_files',
        'select_audio',
        'auto_play',
        'audio_repeat'
    ])) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="audio_files_bluebar" data-tip_section="audio_files">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">Audio Files</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        @if(check_feature_enable_disable('audiofeature'))
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-green">Enabled</div>
                        </div>
                        @else
                        <div class="enable-disable-feature-div">
                            <div class="title-4-400 text-color-red2">Disabled</div>
                        </div>
                        @endif
                        <div class=" ml-20">
                            <img src="{{ url('assets') }}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= isset($_GET['block'])  && $_GET['block'] == 'audio_files_bluebar' ? 'display:block;' : '' ?>">
                <form action="{{ url('updateaudiofiles') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <?php if (check_auth_permission('auto_play')) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Auto play</label><br>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="audio_auto_play" <?= $audio_files->audio_auto_play ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (check_auth_permission('audio_repeat')) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bannertext">Audio repeat</label><br>
                                    <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="audio_repeat" <?= $audio_files->audio_repeat ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <?php if ($audio_files->audio_files && json_decode($audio_files->audio_files)) {
                            $audio_files = json_decode($audio_files->audio_files);
                        ?>
                            <?php foreach ($audio_files as $single) {
                                $single = (object)$single;
                                if (!empty($single->title)) { ?>
                                    <div class="col-md-6 imgdiv">
                                        <h4><?= $single->title ?></h4>
                                        <button type="button" class="btn btn-primary btnaudiofiledel" data-imgname="<?= $single->file ?>">X</button>
                                    </div>
                            <?php
                                }
                            } ?>
                        <?php } ?>
                    </div>
                    <br>
                    <?php if (check_auth_permission('select_audio')) { ?>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <div>Because of settings and rules that each
                                    device and the different browsers have,
                                    these audio files may not be h
                                    eard with some devices and browsers.
                                    Apple for example has strict guidelines
                                    for audio files that play automatically.
                                    Use this Feature with the understanding
                                    that not all users will hear this Feature.
                                    To alert visitors, the Popup & Banner
                                    Alerts are the most effective, as visitors
                                    will see the popup before entering the
                                    site and the Alert Banner is a sticky feature.
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php } ?>
                    <div class="row form-bottom make-sticky">
                        <div class="col-md-12">
                            <button type="submit" name="saveaudiosection" class="btn btn-primary" value="save">Save</button>
                            <button type="submit" name="saveaudiosection" class="btn btn-primary" value="savereminders">Save & send reminder</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

<script src="<?= url('assets/admin2/jquery.ui.touch-punch.min.js') ?>"></script>
<script>
    <?php if (isset($block) && $block != "") {  ?>
        var id = "<?= $block ?>";
        $('#' + id).closest('.content').find('.editcontent').show('slow');
        $('#' + id).closest('.content').find('.form-bottom').addClass('make-sticky');
        var section_start = $('#' + id).data('top');
        var section_end = $('#' + id).data('bottom');

        setTimeout(() => {
            $('html, body').animate({
                scrollTop: $('#' + id).offset().top - 60
            }, 100);
        }, 1000);
        $('#' + id).stop(true, true).addClass("locator-bg");
        setTimeout(() => {
            $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
        }, 2000);
        var tip_section = $('#' + id).data('tip_section');

        if (typeof(tip_section) != 'undefined') {
            openTip(tip_section);
        }
    <?php } ?>
    $(document).on('change', '.news_post_action_button', function() {
        if ($(this).val() == 'link') {
            $('.news_post_link').show();
        } else {
            $('.news_post_link').hide();
        }
    });

    function showNewsActionModal(id) {
        $("#actionNewsPostModal").html($('#newsPostModal' + id).html());
        $("#actionNewsPostModal").modal('show');

    }


    function showNewsFeedActionModal(id) {

        $("#actionNewsPostModal").html($('#newsFeedModal' + id).html());
        $("#actionNewsPostModal").modal('show');
    }



    function delete_header_slider_video(id) {
        $.ajax({
            url: '<?= url('delete_slider_video') ?>',
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                $("#header_slider_video_container").html("");
            }
        });
    }

    $(document).ready(function() {
        $("#header_slider_video").on("change", function() {
            const videoInput = this;

            if (videoInput.files.length > 0) {
                const file = videoInput.files[0];
                const video = document.createElement('video');

                video.onloadedmetadata = function() {
                    const width = video.videoWidth;
                    const height = video.videoHeight;
                    const aspectRatio = width / height;
                    const rat = Math.abs(aspectRatio - (4 / 3)) < 0.01;
                    const ratfinal = Math.abs(aspectRatio - (4 / 3))
                    console.log(`Width: ${width}px, Height: ${height}px, Aspect Ratio: ${aspectRatio.toFixed(2)} - ${4/3} = ${Math.abs(aspectRatio - (4 / 3))} Ratio: ${rat}`);
                    if (ratfinal > 0.5) {
                        cuteAlert({
                            type: "warning",
                            title: "",
                            message: "Please Upload Video of Aspect Ratio 4:3.",
                            buttonText: "Okay"
                        });
                        const toastContainer = document.querySelector(".alert-wrapper");

                        $("#header_slider_video").val(null);
                        setTimeout(() => {
                            toastContainer.remove();
                            resolve();
                        }, 1500);
                        return;
                    }
                };

                video.src = URL.createObjectURL(file);

            }
        });
    });

    function saveSettingHeader(btnvalue) {

        var value = $(".is_video_toggle").prop('checked') == true ? '1' : '0';
        if (value == '1' && $('#header_slider_video').get(0).files.length === 0 && $("#header_slider_video_container video").length < 1) {
            cuteAlert({
                type: "warning",
                title: "",
                message: "Header Slider Video is ON. Please Upload Video.",
                buttonText: "Okay"
            });
            const toastContainer = document.querySelector(".alert-wrapper");

            return;
        }
        $("#form_header_settings").append('<input type="hidden" name="saveheader" value="' + btnvalue + '">')

        $("#form_header_settings").submit();
    }

    function check_selection_alert(id, value) {
        if (value == "address" || value == "google_map") {
            $("#address-list-alert-" + id).show();
            $(".btn" + id + "link").hide();
            $("#feature_customforms").hide();
        } else if (value == "link") {
            $(".btn" + id + "link").show();
            $("#address-list-banner").hide();
            $("#feature_customforms").hide();
            $("#address-list-alert-" + id).hide();
        } else if (value == "customforms") {
            $(".btn" + id + "link").hide();
            $("#address-list-banner").hide();
            $("#feature_customforms").show();
            $("#address-list-alert-" + id).hide();
        } else {
            $(".btn" + id + "link").hide();
            $("#address-list-alert-" + id).hide();
            $("#address-list-alert-" + id).val('');
            $("#feature_customforms").hide();
        }
    }

    function check_selction(id, value) {

        if (value == "address" || value == "google_map") {

            $("#address-list-" + id).show();
            $("#btn" + id + "link").hide();
            $("#btn" + id + "customforms").hide();

        } else if (value == "link") {

            $("#btn" + id + "link").show();
            $("#address-list-" + id).hide();
            $("#btn" + id + "customforms").hide();

        } else if (value == "customforms") {

            $("#btn" + id + "customforms").show();
            $("#btn" + id + "link").hide();
            $("#address-list-" + id).hide();

        } else {

            $("#btn" + id + "link").hide();
            $("#address-list-" + id).hide();
            $("#btn" + id + "customforms").hide();
            $("#address-list-" + id).val('');
        }
    }

    $(document).on("click", ".remindertype_logo", function() {
        var thisval = $(this).val();
        if (thisval == '1') {
            $(".datetimediv_logo").hide();
            $(".timeinmin_logo").show();
        } else {
            $(".datetimediv_logo").show();
            $(".timeinmin_logo").hide();
        }
    });
    $(document).on("click", ".remindertype_image", function() {
        var thisval = $(this).val();
        if (thisval == '1') {
            $(".datetimediv_image").hide();
            $(".timeinmin_image").show();
        } else {
            $(".datetimediv_image").show();
            $(".timeinmin_image").hide();
        }
    });

    $('.sortablenewstable').sortable({
        cancel: ".btn-group",
        stop: function(event, ui) {
            var tableRows = $('.sortablenewstable').closest('.table-responsive').find('.newssections');
            console.log(tableRows);
            var table = $('.sortablenewstable').closest('.table-responsive').attr('data-table');
            if ((window.innerWidth <= 768)) {
                $(".sortablenewstable").sortable("disable");
                $('.sortablenewstable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
                $('.sortablenewstable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
        }
    });

    if ((window.innerWidth <= 768)) {
        $(".sortablenewstable").sortable("disable");
    }
</script>
<script>
    function getFile() {
        document.getElementById("headerimg").click();
    }

    function getFile2() {
        document.getElementById("headerimg2").click();
    }

    $(document).on('click', '.btnaudiofiledel', function() {
        var imgname = $(this).data('imgname');
        if ($(this).data('url')) {
            var url = $(this).data('url');
        } else {
            var url = null;
        }
        if ($(this).data('slug')) {
            var slug = $(this).data('slug');
        } else {
            var slug = null;
        }
        $(this).closest('.imgdiv').remove();
        $.ajax({
            url: '<?= url('frontend/delaudiofile') ?>',
            type: "POST",
            data: {
                slug: slug,
                imgname: imgname,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {}
        });
    });

    // function deleteAudio(button)
    // {
    //     console.log();
    //     var imgname = $(button).data('imgname');
    //     $(button).closest('.imgdiv').remove();
    //     var formAction = $(button).closest('form').attr('action');
    //     console.log($(button).closest('form'));
    //     $.ajax({
    //         url: '<?= url('frontend/delaudiofile') ?>',
    //         type: "POST",
    //         data: {
    //             imgname: imgname,
    //             _token: "{{ csrf_token() }}"
    //         },
    //         success: function(data) {}
    //     });
    // }
</script>


<script>
    $(document).ready(function() {
        checkSeeTips(sub_sections);
        popupStatus();
        var is_disabled = isTipsDisabled('quick_settings');

        if (is_disabled) {
            $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
            $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
            $("input[name='tippopups']").prop('checked', true);
        }

        $(document).on('change', '.alert_banner_action_button_link', function() {
            if ($(this).val() == 'link') {
                $('#banner_link_2').show();
            } else {
                $('#banner_link_2').hide();
            }
        });

    });
    $('.sort_news_feed').sortable({
        cancel: ".btn-group",
        stop: function(event, ui) {
            var tableRows = $('.sort_news_feed').closest('.table-responsive').find('.newssections');
            var table = $('.sort_news_feed').closest('.table-responsive').data('table');
            if ((window.innerWidth <= 768)) {
                $(".sort_news_feed").sortable("disable");
                $('.sort_news_feed').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
                $('.sort_news_feed').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
        }
    });
    if ((window.innerWidth <= 768)) {
        $(".sort_news_feed").sortable("disable");
    }

    // $(".sort_news_feed").on("mousedown", function () {
    //     console.log("#########mousedown");
    //     $(this).data("checkdown", setTimeout(function () {
    //         clearTimeout($(this).data("checkdown"));
    //         console.log("#######2 sec");
    //         $(".sort_news_feed").sortable("enable");
    //     }, 2000));
    // }).on("mouseup", function () {
    //     clearTimeout($(this).data("checkdown"));
    //     console.log("#######mouseup"); 
    //     $(".sort_news_feed").sortable("disable");
    // }).on("mouseout", function () {
    //     clearTimeout($(this).data("checkdown"));
    //     console.log("#######mouseout");
    //     $(".sort_news_feed").sortable("disable");
    // });
</script>

<script>
    function updateWidth(val) {
        let initialWidth = $("#width_modified").attr('initial-width');
        console.log(val, "value");
        if (val == initialWidth) {
            $("#width_modified").val(0)
        } else {
            $("#width_modified").val(1)
        }
    }
</script>
@endsection('content')