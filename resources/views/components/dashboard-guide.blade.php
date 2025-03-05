@props(['buttons', 'audio_div'])
<style>
.outline-color-action-btn{
    z-index:999;
    width:300px;
    top:0px;
    left:-153px !important;
    position:absolute
}
@media (max-width:942px) {
    .outline-color-action-btn{
        top: -75px;
        left: 110px !important;
    }
}
</style>
<div class="outline-color-action-btn dropup features-toggle" style="">
    <div class="d-flex align-items-center">
        <div class="dashboard-guide dropdown back-dashboard-div" style="width:262px;">
            <button class="btn-secondary tutorial-action-button dropdown-toggle" style="color: #006DC1 !important;border:none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src='<?= base_url('assets/admin2/img/book.svg') ?>' alt="info icon" style="width: 22px;">
                <div> <text class="bold" style="color:#636363;">Tutorial Website Guide</text>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.75 3.75053L2.25 3.75053C2.11331 3.75096 1.97934 3.78866 1.86249 3.85956C1.74564 3.93047 1.65034 4.0319 1.58685 4.15295C1.52336 4.27399 1.49408 4.41005 1.50217 4.54649C1.51026 4.68294 1.5554 4.81459 1.63275 4.92728L8.38275 14.6773C8.6625 15.0815 9.336 15.0815 9.6165 14.6773L16.3665 4.92728C16.4446 4.81483 16.4904 4.68311 16.499 4.54644C16.5075 4.40977 16.4784 4.27337 16.4149 4.15208C16.3513 4.03078 16.2557 3.92922 16.1385 3.85842C16.0213 3.78763 15.8869 3.75032 15.75 3.75053Z" fill="#6C6C6C" />
                    </svg>

                </div>
            </button>


            <div class="dropdown-menu tutorial-action-button dropdown-menu-left tutorial-menu Outlines&amp;Features" style="background-color: #E3F3FF;width:262px;" aria-labelledby="dropdownMenuButton">

                <div class="guide-content d-flex" style="flex-direction: column;">

                    <text style="text-align: center;color:black;font-weight:600">Dashboard Guide</text>
                    <br>
                    <text style="color:#636363;margin-bottom:6px;"><?php echo $dashboard_guide->text ?></text>

                </div>
                @if(isset($buttons) && $buttons != '')
                @foreach($buttons as $single)
                <?php
                $input_link = '#';
                $target = '';
                $audioclass = '';
                $popupform = '';
                $class = '';
                $data_target = "";
                $data_toggle = '';

                if ($single->active == '0') {
                    if ($single->action_type == 'link') {
                        $input_link = $single->link;
                        $target = "_blank";
                    } elseif ($single->action_type == 'customforms') {
                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->custom_form_id) . '"';
                    } elseif ($single->action_type == "address") {
                        $address = getaddress_info($single->address_id);
                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                    } elseif ($single->action_type == "audioiconfeature") {
                        if ($single->action_type == 'audioiconfeature') {
                            echo '<div class="action-audio"><audio class="hidden" id="newspostAudio_' . $single->id . '" controls>
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) . '" type="audio/mp3">
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) . '" type="audio/ogg">
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio_icon_feature) . '" type="audio/mpeg">
                              </audio></div>';
                        }
                        $input_link = '#' . $single->action_button_audio_icon_feature;
                    } elseif ($single->action_type == "video") {
                        $input_link = get_blog_image($single->action_button_video);
                        $data_target = "#video_modal";
                        $data_toggle = 'modal';
                    } elseif ($single->action_type == "google_map") {
                        $address_full = isset($single->map_address) ? $single->map_address : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                    } elseif ($single->action_type == 'text_popup') {
                        $input_link = '#' . $single->action_type;
                        echo '<div style="display:none" id="actNewsButtonText' . $single->id . '">' . $single->action_button_textpopup . '</div>';
                    } elseif (in_array($single->action_type, ['call', 'sms', 'email'])) {
                        switch ($single->action_type) {
                            case 'sms':
                                $input_link = 'sms:' . str_replace(['-', ' ', '(', ')', '_'], '', $single->action_button_phone_no_sms);
                                break;
                            case 'call':
                                $input_link = 'tel:' . str_replace(['-', ' ', '(', ')', '_'], '', $single->action_button_phone_no_calls);
                                break;
                            case 'email':
                                $input_link = 'mailto:' . $single->action_button_action_email;
                                break;
                        }
                    } elseif (is_numeric($single->section)) {
                        $section = getSectionDetail($single->section);
                        $banner_input_href = '#' . $section->slug;
                        if ($section->slug == 'audiofeature') {
                            $audioclass = '';
                        }
                    } else {
                        $input_link = '#' . $single->action_type;
                        if ($single->action_type == 'audiofeature') {
                            $audioclass = '';
                            echo '<div class="action-audio"><audio class="hidden" id="' . $single->id . '_modal_audio" controls>
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio) . '" type="audio/mp3">
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio) . '" type="audio/ogg">
                              <source src="' . url('assets/uploads/' . get_current_url() . $single->action_button_audio) . '" type="audio/mpeg">
                              </audio></div>';
                        } else {
                            $class = 'menuitem';
                        }
                    }
                ?>
                    @if($single->action_type == "audioiconfeature" && isset($single->action_button_audio_icon_feature))
                    <span onclick="playPauseAudio('newspostAudio_<?= $single->id ?>')" style="color: {{ $single->post_desc_color ?: '#000' }};">
                        <!-- <span>
                            <i class="fa fa-volume-up" style="margin-top:6px;" aria-hidden="true"></i>
                        </span> -->
                        <a class="btn btn-primary dropdown-item tutorial-item new-action-btn post-action-{{ $single->id }}" style="border-radius:5px !important; display: flex; align-items: center; justify-content: center; position: relative; padding-left: 30px;" href="<?= $input_link ?>">
                            <span style="position: absolute; left: 10px;">
                                <i class="fa fa-volume-up" aria-hidden="true"></i>
                            </span>
                            {{ $single->text }}
                        </a>
                        <div style="margin-top: -5px;text-align:center">Click to hear Text</div>
                    </span>
                    @else
                    <a class="btn btn-primary dropdown-item tutorial-item" <?php if ($single->action_type == "image_popup") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openSlider(<?= htmlspecialchars($single->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?> style="border-radius:5px !important;" href="<?= $input_link ?>" class="btn btn-primary no-radius modal-action-buttons mb-2" id="<?= $single->id . 'category_action_button' ?>" @if($single->action_type == 'text_popup')
                        onclick="openPopupText('actNewsButtonText<?= $single->id ?>')"
                        @endif
                        @if($single->action_type == "video")
                        data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $single->id . 'category_action_button' ?>')"
                        @endif
                        @if(isset($single->action_button_audio) && $single->action_button_audio != "")
                        onclick="playPauseAudio('{{ $single->id }}_modal_audio')"
                        @endif
                        target="{{ $target }}" {{ $popupform }} class="btn btn-default mb-1 text-bold new-action-btn post-action-{{$single->id}}" style="">{{ $single->text }}</a>
                    @if($single->action_type == "video")
                    <div style="margin-top: -4px; color: {{ $single->post_desc_color ?: '#000' }};"></div>
                    @endif
                    @endif
                <?php } ?>
                @endforeach
                @else
                <a class="btn btn-primary dropdown-item tutorial-item">No action button</a>
                @endif
            </div>
        </div>
    </div>
</div>