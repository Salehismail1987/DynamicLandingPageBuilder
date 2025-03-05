<?php
$setting = $frontSections->where('slug', 'attendhub')->first();
if ($attenhub_title->enable == '1' || isset($_GET['editwebsite']) || ($home_data_gallery_posts && count($home_data_gallery_posts->toArray()) > 0)) { ?>
    @include('sections.attendhub.styles')
    <div id="attendhub">

        <?php if ($attenhub_title->enable == '1') { ?>
            <div class="position-relative title_banners_outline">
                @if(isset($_GET['editwebsite']))
                <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=gallery_post_title' />
                    </div>
                </div>
                @endif
                <<?= $attenhub_title->tag ?> class="titlefontfamily gallerypoststitle {{$attenhub_title->slug}}" style="">
                    <?= $attenhub_title->text ?>
                </<?= $attenhub_title->tag ?>>
            </div>
        <?php } ?>
        <?php

        ?>
        <div class="position-relative gallery_post_outline">
            @if(isset($_GET['editwebsite']))
            <div class="">
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons title='Attenhub' :buttons="isset($tutorial_action_buttons['attenhub']) ? $tutorial_action_buttons['attenhub']:'' " url='attendhub' :status="$setting->section_enabled" />
                </div>
            </div>
            @endif
            <div class="attendhub_posts_bg">

                <br>
                <div class="container" style="width: 100%;">

                    <?php $postscript = '';
                    if ($events && count($events->toArray()) > 0) { ?>
                        <?php
                        $interval = 3000;
                        foreach ($events as $single) {

                        ?><div class="row"><?php

                                            
                                            ?>

                                <?php
                                          
                                                $event_images = getEventImages($single->id);
                                                $gallery_post_slider_image_right = "";
                                                $gallery_post_slider_image_right = "gallery_post_slider_image_left-" . $single->id;
                                ?>
                                    <div class="col-md-5 gallery-web">
                                        <?php if (isset($event_images) && $event_images && count($event_images) > 0) { ?>
                                            <div id="myCarouselpost<?= $single->id ?>" data-interval="false" class="carousel slide gallery_post_slider_container">
                                                <div class="carousel-inner text-center">
                                                    <?php $active = 'active'; ?>
                                                    <?php foreach ($event_images as $key => $singleimg) { ?>
                                                        <div class="item <?php if ($key == 0) {
                                                                                echo $active;
                                                                                $active = '';
                                                                            } ?>">
                                                            <img class="lazyload margin-auto post_image_{{$singleimg->id}}" data-src="<?= url('assets/uploads/' . get_current_url() . $singleimg->image) ?>"
                                                                <?php
                                                                if (isset($single->image_size) && !empty($single->image_size) && $single->image_size <= 500 && $single->image_size != 0) {
                                                                ?>

                                                                style="width:<?= $single->image_size ?>px;"
                                                                <?php
                                                                } else if (!isset($single->image_size) || empty($single->image_size) || $single->image_size >= 500) {
                                                                ?>

                                                                style="width:83%;"
                                                                <?php
                                                                }
                                                                ?>>
                                                        </div>

                                                    <?php } ?>
                                                    <!-- Left and right controls -->
                                                    <?php if (isset($event_images) && $event_images && count($event_images) > 1) { ?>
                                                        <span class="eventpostdesc-{{$single->id}}" style="font-size: 14px !important;">Use the arrows to navigate to the next image</span>
                                                        <a class="left carousel-control" href="#myCarouselpost<?= $single->id ?>" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="right carousel-control " href="#myCarouselpost<?= $single->id ?>" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php

                                                } ?>
                                        @php
                                        $encoded_id = getEncodedId($single->id);
                                        @endphp
                                        <div class="col-md-12 form-button-div">
                                            <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                                                    $input_link = '#';
                                                    $popupform = '';
                                                    $target = '';
                                                    $audioclass = '';
                                                    $data_target = "";
                                                    $data_toggle = '';
                                                    if ($single->action_button_link == 'link') {
                                                        $input_link = $single->action_button_link_text;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'customforms') {
                                                        $input_link = '#';
                                                        $target = "";
                                                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->action_button_customform) . '"';
                                                    } elseif ($single->action_button_link == "video") {

                                                        $input_link = get_blog_image($single->action_button_video);
                                                        // $target = "_blank";
                                                        $data_target = "#video_modal";
                                                        $data_toggle = 'modal';
                                                    } elseif ($single->action_button_link == "audioiconfeature") {

                                                        if ($single->action_button_audio_icon_feature) { ?>
                                                        <div class="action-audio">
                                                            <audio class="hidden" id="gallpostAudio_<?= $single->id ?>" controls>
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                                            </audio>
                                                        </div>
                                                    <?php
                                                        }
                                                        $input_link = '#' . $single->action_button_audio_icon_feature;
                                                    } elseif ($single->action_button_link == "google_map") {

                                                        $address_full = isset($single->action_button_map_address) ? $single->action_button_map_address : "";
                                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'text_popup') {

                                                        $input_link = '#' . $single->action_button_link;
                                                    ?>
                                                    <div style="display:none" id="actPostPopupText<?= $single->id ?>">
                                                        <?php echo $single->action_button_textpopup; ?>
                                                    </div>
                                                    <?php
                                                    } elseif ($single->action_button_link == "address") {

                                                        $address =  getaddress_info($single->action_button_address_id);

                                                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


                                                        switch ($single->action_button_link) {

                                                            case 'sms':
                                                                $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                                                                break;
                                                            case 'call':
                                                                $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                                                                break;
                                                            case 'email':
                                                                $input_link = 'mailto:' . $single->action_button_action_email;
                                                                break;
                                                        }
                                                    } else {
                                                        if ($single->action_button_link == 'audiofeature') {
                                                            $audioclass = '';
                                                    ?><div class="action-audio"> <?php
                                                                                    if ($single->action_button_action_audio) { ?>
                                                                <audio class="hidden" id="galleryPostAudio" controls>
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mp3">
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/ogg">
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mpeg">
                                                                </audio>
                                                        </div>
                                            <?php
                                                                                    }
                                                                                }
                                                                                $input_link = '#' . $single->action_button_link;
                                                                            }
                                            ?>
                                            @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature))
                                            <span class="descpostgall_icon_<?= $single->id ?>" onclick="playPauseAudio('gallpostAudio_<?= $single->id ?>')">

                                                <a href="<?= $input_link ?>"
                                                    style="" class="btn btn-default btn-adjustable text-bold new-action-btn event-post-action-button-{{$single->id}} {{$audioclass}} " style=""><span style="position:absolute;left:10px;">
                                                        <i class="fa fa-volume-up" aria-hidden="true"></i></span>
                                                    <span class="text"><?= $single->action_button_description ?></span></a>
                                                <div class="info-text">Click to hear Text</div>
                                                <br>
                                            </span>
                                            @else
                                            <a href="<?= $input_link ?>"
                                                id="<?= $single->id . 'gallerypostbtn' ?>"

                                                <?php if ($single->action_button_link == 'text_popup') { ?>
                                                onclick="openPopupText('actPostPopupText<?= $single->id ?>')"
                                                <?php } ?>

                                                <?php if ($single->action_button_link == "video") { ?>
                                                data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                                onclick="openVideo('<?= $single->id . 'gallerypostbtn' ?>')" <?php } ?>
                                                <?php if ($single->action_button_link == "image_popup") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openSlider(<?= htmlspecialchars($single->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>


                                                <?= isset($single->action_button_action_audio) ? 'onclick=playPauseAudio("galleryPostAudio")' : '' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default text-bold new-action-btn event-post-action-button-{{$single->id}} {{$audioclass}}"><?= $single->action_button_description ?></a>
                                            @if($single->action_button_link == "video")
                                            <br>
                                            <div style="margin-top: -4px;" class="descpostgall_icon_<?= $single->id ?>">Click to watch video</div>
                                            @endif
                                            @endif
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    ?>
                                    <br>
                                <?php
                                                $interval = $interval + 500;
                                            
                                ?>
                                @php
                                $attendence = getAttendence($single->id);
                                @endphp
                                <div class="col-md-7 data-div" style="margin-top:-25px;">
                                    <div class="row">
                                        <div class="col-md-12 pl-0">
                                            <h3 id="eventposttitle<?= $single->id ?>" class="titlefontfamily eventposttitle-{{$single->id}}">
                                                <?= $single->sub_title ?></h3>
                                        </div>
                                        
                                        @if($single->display_counter )
                                        <div class="col-md-12 mt-4 attendance-div-container pl-0">
                                        <div class="attendance-div col-md-6 pl-0">
                                            <div class="col-xs-6 col-sm-5 col-md-12 col-lg-9 justify-content-center counter_date_time_fonts-{{$single->id}} pl-0">
                                                <div class="attendance-container">
                                                    <div class="attendance-item">
                                                        <span class="attendance-label">{{ ucfirst($attendence['options'][0]['option_name'] ?? 'Yes') }}</span>
                                                        <span class="attendance-number">{{ ($attendence['count_yes']['count'] ?? 0) + ($attendence['count_yes']['guests'] ?? 0) }}</span>
                                                    </div>
                                                    <div class="attendance-center">
                                                        <span class="attending-text">Attending</span>
                                                    </div>
                                                    <div class="attendance-item">
                                                        <span class="attendance-label">{{ ucfirst($attendence['options'][1]['option_name'] ?? 'Maybe') }}</span>
                                                        <span class="attendance-number">{{ ($attendence['count_maybe']['count'] ?? 0) + ($attendence['count_maybe']['guests'] ?? 0) }}</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @endif
                                        <?php $event_images = getEventImages($single->id); ?>
                                        <div class="col-md-6 gallery-mobile">
                                        <?php if (isset($event_images) && $event_images && count($event_images) > 0) { ?>
                                            <div id="myCarouselpost<?= $single->id ?>" data-interval="false" class="carousel slide gallery_post_slider_container">
                                                <div class="carousel-inner text-center">
                                                    <?php $active = 'active'; ?>
                                                    <?php foreach ($event_images as $key => $singleimg) { ?>
                                                        <div class="item <?php if ($key == 0) {
                                                                                echo $active;
                                                                                $active = '';
                                                                            } ?>">
                                                            <img class="lazyload margin-auto post_image_{{$singleimg->id}}" data-src="<?= url('assets/uploads/' . get_current_url() . $singleimg->image) ?>"
                                                                <?php
                                                                if (isset($single->image_size) && !empty($single->image_size) && $single->image_size <= 500 && $single->image_size != 0) {
                                                                ?>

                                                                style="width:<?= $single->image_size ?>px;"
                                                                <?php
                                                                } else if (!isset($single->image_size) || empty($single->image_size) || $single->image_size >= 500) {
                                                                ?>

                                                                style="width:83%;"
                                                                <?php
                                                                }
                                                                ?>>
                                                        </div>

                                                    <?php } ?>
                                                    <!-- Left and right controls -->
                                                    <?php if (isset($event_images) && $event_images && count($event_images) > 1) { ?>
                                                        <span class="eventpostdesc-{{$single->id}}" style="font-size: 14px !important;">Use the arrows to navigate to the next image</span>
                                                        <a class="left carousel-control" href="#myCarouselpost<?= $single->id ?>" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="right carousel-control " href="#myCarouselpost<?= $single->id ?>" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php

                                                } ?>
                                        @php
                                        $encoded_id = getEncodedId($single->id);
                                        @endphp
                                        <div class="col-md-12 form-button-div">
                                            <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                                                    $input_link = '#';
                                                    $popupform = '';
                                                    $target = '';
                                                    $audioclass = '';
                                                    $data_target = "";
                                                    $data_toggle = '';
                                                    if ($single->action_button_link == 'link') {
                                                        $input_link = $single->action_button_link_text;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'customforms') {
                                                        $input_link = '#';
                                                        $target = "";
                                                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->action_button_customform) . '"';
                                                    } elseif ($single->action_button_link == "video") {

                                                        $input_link = get_blog_image($single->action_button_video);
                                                        // $target = "_blank";
                                                        $data_target = "#video_modal";
                                                        $data_toggle = 'modal';
                                                    } elseif ($single->action_button_link == "audioiconfeature") {

                                                        if ($single->action_button_audio_icon_feature) { ?>
                                                        <div class="action-audio">
                                                            <audio class="hidden" id="gallpostAudio_<?= $single->id ?>" controls>
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                                            </audio>
                                                        </div>
                                                    <?php
                                                        }
                                                        $input_link = '#' . $single->action_button_audio_icon_feature;
                                                    } elseif ($single->action_button_link == "google_map") {

                                                        $address_full = isset($single->action_button_map_address) ? $single->action_button_map_address : "";
                                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'text_popup') {

                                                        $input_link = '#' . $single->action_button_link;
                                                    ?>
                                                    <div style="display:none" id="actPostPopupText<?= $single->id ?>">
                                                        <?php echo $single->action_button_textpopup; ?>
                                                    </div>
                                                    <?php
                                                    } elseif ($single->action_button_link == "address") {

                                                        $address =  getaddress_info($single->action_button_address_id);

                                                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                                        $target = "_blank";
                                                    } elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


                                                        switch ($single->action_button_link) {

                                                            case 'sms':
                                                                $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                                                                break;
                                                            case 'call':
                                                                $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                                                                break;
                                                            case 'email':
                                                                $input_link = 'mailto:' . $single->action_button_action_email;
                                                                break;
                                                        }
                                                    } else {
                                                        if ($single->action_button_link == 'audiofeature') {
                                                            $audioclass = '';
                                                    ?><div class="action-audio"> <?php
                                                                                    if ($single->action_button_action_audio) { ?>
                                                                <audio class="hidden" id="galleryPostAudio" controls>
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mp3">
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/ogg">
                                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mpeg">
                                                                </audio>
                                                        </div>
                                            <?php
                                                                                    }
                                                                                }
                                                                                $input_link = '#' . $single->action_button_link;
                                                                            }
                                            ?>
                                            @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature))
                                            <span class="descpostgall_icon_<?= $single->id ?>" onclick="playPauseAudio('gallpostAudio_<?= $single->id ?>')">

                                                <a href="<?= $input_link ?>"
                                                    style="" class="btn btn-default btn-adjustable text-bold new-action-btn event-post-action-button-{{$single->id}} {{$audioclass}} " style=""><span style="position:absolute;left:10px;">
                                                        <i class="fa fa-volume-up" aria-hidden="true"></i></span>
                                                    <span class="text"><?= $single->action_button_description ?></span></a>
                                                <div class="info-text">Click to hear Text</div>
                                                <br>
                                            </span>
                                            @else
                                            <a href="<?= $input_link ?>"
                                                id="<?= $single->id . 'gallerypostbtn' ?>"

                                                <?php if ($single->action_button_link == 'text_popup') { ?>
                                                onclick="openPopupText('actPostPopupText<?= $single->id ?>')"
                                                <?php } ?>

                                                <?php if ($single->action_button_link == "video") { ?>
                                                data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                                onclick="openVideo('<?= $single->id . 'gallerypostbtn' ?>')" <?php } ?>
                                                <?php if ($single->action_button_link == "image_popup") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openSlider(<?= htmlspecialchars($single->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>


                                                <?= isset($single->action_button_action_audio) ? 'onclick=playPauseAudio("galleryPostAudio")' : '' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default text-bold new-action-btn event-post-action-button-{{$single->id}} {{$audioclass}}"><?= $single->action_button_description ?></a>
                                            @if($single->action_button_link == "video")
                                            <br>
                                            <div style="margin-top: -4px;" class="descpostgall_icon_<?= $single->id ?>">Click to watch video</div>
                                            @endif
                                            @endif
                                        <?php } ?>
                                        </div>
                                    </div>
                                    </div>

                                    <?php
                                    $contentcolumn = 'col-sm-12 pr-0';

                                    ?>

                                    <div class="<?= $contentcolumn ?> pl-0  pr-0">
                                        <div id="eventpostdesc<?= $single->id ?>" class="eventpostdesc-{{$single->id}}">
                                            <div class="row">
                                                <div class="col-md-12 counter_date_time_fonts-{{$single->id}} pl-0">
                                                    @foreach($single->attenhubDates as $row)
                                                    <div class="row mb-3">
                                                        <div class="col-xs-4 col-sm-4 col-md-3 pl-0 pr-0">
                                                            @if($row->event_date)
                                                            <span class="event-details">
                                                                Date: {{ (new DateTime($row->event_date))->format('m/d/Y') }}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4 col-md-3 ">
                                                            @if($row->event_day)
                                                            <span class="event-details">
                                                                Day: {{ $row->event_day}}
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                                            <span class="event-details">
                                                                Time: {{ (new DateTime($row->from_time))->format('g:i a') }} to {{ (new DateTime($row->to_time))->format('g:i a') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="col-md-11 p-0">
                                                <?= nl2br(($single->post_description)) ?>
                                            </div>
                                            <input type="text" id="search-input" data-table-id="{{ $single->id }}" style="width: 50%;" placeholder="Search..." class="form-control mb-3 search-input">

                                            <div>Attendee List</div>
                                            <div class="event-post col-md-11 p-0" data-post-id="{{ $single->id }}">
                                                <div class="table-container">
                                                    <table class="table" id="data-table-{{ $single->id }}" style="position: relative;">
                                                        <colgroup>
                                                            <col style="width: 6%;">
                                                            <col style="width: 27%;">
                                                            <col style="width: 28%;">
                                                            <col style="width: 22%;">
                                                            <col style="width: 17%;">
                                                        </colgroup>
                                                        <thead id="sticky-header" style="position: sticky;top: 0;z-index: 1;">
                                                            <tr>
                                                                <th></th>
                                                                <th>{{ $attendence['first_field'] ?? 'Name' }}</th>
                                                                <th>{{ $attendence['second_field'] ?? 'Business Name' }}</th>
                                                                <th>{{ $attendence['fifth_field'] ?? 'Yes/Maybe' }}</th>
                                                                <th>{{ $attendence['fourth_field'] ?? 'Guest No.' }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table-body-{{ $single->id }}">
                                                            <!-- Table rows go here -->
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- <div id="scrollable-container" style="max-height: 200px; overflow-y: auto;">
                                                    <table id="data-table-{{ $single->id }}" class="table">
                                                        <tbody style="overflow-y: auto;" id="table-body-{{ $single->id }}">
                                                        </tbody>
                                                    </table>
                                                </div> -->
                                                <div id="searchResults" class="mt-3"></div>
                                                <div style="text-align: left;margin-top:25px;margin-bottom:25px; padding-left: 0.7rem;">
                                                    <a style="" type="button" data-toggle="modal" data-is_custom_modal="YES" data-is_attendence="YES" data-target="#modalcustomforms<?= isset($encoded_id->encoded_id) ? $encoded_id->encoded_id : '' ?>" class="btn btn-default attendance-form-button-{{$single->id}}" value="">Attending Form</a>

                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        <?php
                        } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('sections.attendhub.scripts')
<?php } ?>