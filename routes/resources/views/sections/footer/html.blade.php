<?php if ($alertPopupSetting->popup_active == '1' && ($alertPopupSetting->popup_show_always || !session('firstarival')) || (isset($_GET['editwebsite']) && $_GET['editwebsite'] === 'true')) {
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
                            <x-tutorial-action-buttons title='Popup Alert' :buttons="isset($tutorial_action_buttons['popup_alert']) ? $tutorial_action_buttons['popup_alert']:'' " url='quicksettings?block=popup_alert_bluebar' />
                        </div>
                        <!-- <img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon"> -->
                        <!-- </a> -->
                    </div>
                    @endif
                    <div class="modal-body" style="text-align: center;">
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
                                                <img class="lazyload" data-src="<?= url('assets/uploads') . '/' . $step_image['image'] ?>" style="max-width: 100%; width:70%;" alt="<?= !empty($step_image['text']) ? $step_image['text'] : $popup_alert_title_text->text ?>">
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
                        if ($alert_popup_feature_action_button->active == '1') {
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
                                <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_feature_action_button->custom_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
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
                                    <span onclick="playPauseAudio('alertpop1Audio_<?= $alert_popup_feature_action_button->id ?>')" style="<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> ">
                                        <span>
                                            <i class="fa fa-volume-up" style="margin-top:6px;" aria-hidden="true"></i>
                                        </span>
                                        <a href="<?= $input_href ?>" onclick="playPauseAudio('alertpop1Audio_<?= $alert_popup_feature_action_button->id ?>')" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?></a><br>
                                        <div style="margin-top: -5px;">Click to hear Text</div>
                                        <br>
                                    </span>
                                <?php } else {
                                ?>
                                    <a href="<?= $input_href ?>" <?php if ($alert_popup_feature_action_button->action_type == 'text_popup') { ?> onclick="openPopupText('actPopupText<?= $alert_popup_feature_action_button->id ?>')" <?php } ?> onclick="closeModal()" class="btn btn-default text-bold {{$class}} {{$playaudio}}" style="margin-bottom: 10px;<?= $alert_popup_feature_action_button_text->color ? 'color:' . $alert_popup_feature_action_button_text->color . ';' : '' ?> <?= $alert_popup_feature_action_button_text->bg_color ? 'background:' . $alert_popup_feature_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_feature_action_button_text->text ?>
                                    </a><br>
                            <?php
                                }
                            }
                            ?>

                        <?php } ?>

                        <?php
                        if ($alert_popup_new_action_button->active == '1') {
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
                            if ($alert_popup_new_action_button->action_type == "address"  || $alert_popup_new_action_button->action_type == "google_map") {
                        ?>
                            <a href='<?= $input_href ?>' class="btn btn-default text-bold {{$class}}" target="<?= $target ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                            } elseif ($alert_popup_new_action_button->action_type == "customforms") {
                        ?>
                            <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-target="#modalcustomforms<?= getCustomformEncodedID($alert_popup_new_action_button->custom_form_id) ?>" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                            } elseif ($alert_popup_new_action_button->action_type == "video") { ?>
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
                                <span onclick="playPauseAudio('alertpop2Audio_<?= $alert_popup_new_action_button->id ?>')" style="<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> ">
                                    <span>
                                        <i class="fa fa-volume-up" style="margin-top:6px;" aria-hidden="true"></i>
                                    </span>
                                    <a href="<?= $input_href ?>" onclick="playPauseAudio('alertpop2Audio_<?= $alert_popup_new_action_button->id ?>')" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                                    <div style="margin-top: -5px;">Click to hear Text</div>
                                    <br>
                                </span>
                            <?php } else { ?>
                                <a href="<?= $input_href ?>" onclick="closeModal()" class="btn btn-default text-bold {{$class}} {{$playaudio}} {{$playactionaudio}}" style="margin-bottom: 10px;<?= $alert_popup_new_action_button_text->color ? 'color:' . $alert_popup_new_action_button_text->color . ';' : '' ?> <?= $alert_popup_new_action_button_text->bg_color ? 'background:' . $alert_popup_new_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_new_action_button_text->text ?></a><br>
                        <?php
                                }
                            }
                        ?>

                    <?php } ?>

                    <?php if ($alert_popup_terminate_action_button->active == '1') { ?>
                        <button type="button" onclick="location.href='https://google.com';" class="btn btn-default text-bold" style="<?= $alert_popup_terminate_action_button_text->color ? 'color:' . $alert_popup_terminate_action_button_text->color . ';' : '' ?> <?= $alert_popup_terminate_action_button_text->bg_color ? 'background:' . $alert_popup_terminate_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_terminate_action_button_text->text ?></button>
                    <?php } ?>
                    <?php if ($alert_popup_proceed_action_button->active == '1') { ?>
                        <button type="button" class="btn btn-default text-bold" onclick="closeModal()" style="<?= $alert_popup_proceed_action_button_text->color ? 'color:' . $alert_popup_proceed_action_button_text->color . ';' : '' ?> <?= $alert_popup_proceed_action_button_text->bg_color ? 'background:' . $alert_popup_proceed_action_button_text->bg_color . ';' : '' ?>"><?= $alert_popup_proceed_action_button_text->text ?></button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php }  ?>

<?php if (isset($_GET['editwebsite'])) { ?>
    <?php
    $showpopdes = false;
    foreach ($outlineSettings as $outlineSettingsSingel) {
        if ($outlineSettingsSingel->active == '1') {
            $showpopdes = true;
        }
    }
    if (!$showpopdes) { ?>
        <div class="modal fade" id="popupOutline" role="dialog">
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center">
                    <!-- Modal content-->
                    <div class="modal-content width-fit-content align-all-center">
                        <div class="modal-body p-0" style="text-align: center;">
                            <button type="button" class="close close2" data-dismiss="modal">×</button>
                            <div class="div-3">
                                <div class="title-1 text-color-red text-center">

                                    The Feature Outlines have been removed
                                    <br>
                                    Activate the Feature Outlines in the BuildSide feature in the Dashboard and Refresh website
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

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
@if(isset($_GET['editwebsite']))
<x-dashboard-guide :buttons="isset($toggle_and_outline) ? $toggle_and_outline:''" :audio_div="($audioFiles->audio_files && json_decode($audioFiles->audio_files))?'1':'0'" />
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
                                <a href="<?= $footerSettings->footre_text_link ? $footerSettings->footre_text_link : '#' ?>"><?= $footerSettings->footer_text . ' -' ?></a>
                                <?php } ?><?php echo $footerSettings->footer_text_2 ? $footerSettings->footer_text_2 : '' ?>
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
    <div class="audio-file-label">
        <div class="d-flex align-items-center">
            <x-tutorial-action-buttons title='Audio File' :buttons="isset($tutorial_action_buttons['footer_audio']) ? $tutorial_action_buttons['footer_audio']:'' " url='editfrontend?block=content_block_bluebar&sb=content-main-block-div' />
        </div>
    </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        var footerOutline = document.querySelector('.footer_outline');

        if (footerOutline) {
            console.log(footerOutline);
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

        // Get the background color of the header
        var headerBackgroundColor = getComputedStyle(headerDiv).backgroundColor;

        // Check if the background color is transparent
        if (headerBackgroundColor === 'rgba(0, 0, 0, 0)' || headerBackgroundColor === 'transparent') {
            // Get the background color of the body
            var headerBackgroundColor = getComputedStyle(document.body).backgroundColor;

            // Log or use the body's background color
            console.log('Header background is transparent. Body background color:', headerBackgroundColor);
        } else {
            // Log or use the header's background color
            console.log('Header background color:', headerBackgroundColor);
        }
        const alertBannerBackgroundColor = getComputedStyle(document.querySelector('#header')).backgroundColor;
        const headerPhoneNumberColor = getComputedStyle(document.querySelector('.header_phone_text')).color;

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

    function closeModal() {
        setTimeout(
            function() {
                $('#popupalert').modal('toggle');
            }, 1000);
    }
</script>