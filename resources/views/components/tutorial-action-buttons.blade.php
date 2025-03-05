@include('components.tutorial-action-buttons-style')
<div class="dropdown back-dashboard-div {{ $title == 'Rotating Schedule' ? 'rot_sched' : ''}} {{ $title == 'Title & Banners' ? 'Title_Banners' : ''}} {{ $title == 'Rotating Schedule' ? 'Contact Boxes' : 'ContactBoxes'}} {{ $title == 'Gallery Post' ? 'gal_post' : ''}} {{ $title == 'Gallery Video' ? 'gal_vid' : ''}} {{ $title == 'Header Logo' ? 'logo_top' : ''}} {{ $title == 'Social Media' ? 'social_media' : ''}} {{ $title == 'Header Text' ? 'header_textt' : ''}} {{ $title == 'Header Buttons' ? 'header_buttons' : ''}} {{ $title == 'Header Images' ? 'header_images' : ''}} {{ $title == 'Popup Alert' ? 'popup_alert' : ''}} {{ $title == 'Alert Banner' ? 'alert_banner' : ''}}
    {{ $title == 'Pulldown Menu' ? 'pulldownmenu_tut' : ($title == 'Header Slider' ? 'header_slider_m' :  ($title == 'Nav bar' ? 'nav_m' : '')) }}" style="{{ $title == 'Feature Toggle' ? 'margin-right: -17%;top:-55%' : '' }}">@if($url)<a href="{{ url($url) }}" target="_blank">@endif
        @if($title !== 'Feature Toggle' && $title !== 'Outlines & Features')<img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon">@endif
    </a>
    @if(isset($status) && $status == 0)
    <div class="title-2" style="color:red;">Disabled</div>
    @endif
    <button class="btn-secondary tutorial-action-button dropdown-toggle" style="color: #006DC1 !important;border:none;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span style="font-size: 14px;">{{$title}}</span>
        <img id="dropdownIcon" class="ml-2" style="width: 12px;" src="{{ url('assets/uploads/' . get_current_url() . 'Vector_down.svg') }}" alt="arrow" width="12px">
    </button>
    @if($title == 'Header Slider')
    @php
    $title = 'HeaderSlider';
    @endphp
    @elseif($title == 'Gallery Slider')
    @php
    $title = 'GallerySlider';
    @endphp
    @endif
    <div class="dropdown-menu {{ $title == 'Social Media' ? 'social_media_actions' : ''}} {{ $title == 'Nav bar' ? 'nav_tut' : ''}} tutorial-action-button dropdown-menu-left tutorial-menu " style="background-color: #E3F3FF;{{ $title == 'Audio File' ? 'z-index: 1050;position: absolute;top: -4px;transform: translateY(-100%);' : '' }} {{ $title == 'Popup Alert' ? 'margin-top: 40px;' : '' }}" aria-labelledby="dropdownMenuButton">
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
                <a class="btn btn-primary dropdown-item tutorial-item new-action-btn post-action-{{ $single->id }}" style="border-radius:5px !important; display: flex; align-items: center; justify-content: center; position: relative; padding-left: 30px;" href="<?= $input_link ?>">
                    <span style="position: absolute; left: 10px;">
                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                    </span>
                    {{ $single->text }}
                </a>
                <div style="margin-top: -5px;text-align:center">Click to hear Text</div>
                <br>
            </span>
            @else
            <a class="btn btn-primary dropdown-item tutorial-item" style="border-radius:5px !important;" href="<?= $input_link ?>" class="btn btn-primary no-radius modal-action-buttons mb-2" id="<?= $single->id . 'category_action_button' ?>" @if($single->action_type == 'text_popup')
                onclick="openPopupText('actNewsButtonText<?= $single->id ?>')"
                @endif
                <?php if ($single->action_type == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>

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
@if($title == 'Popup Alert')
<div class="dropdown back-dashboard-div form-group popup_switch_div" style="z-index:12;margin-top:53px;">
    <div class=" d-flex  text-center align-items-center" style="justify-content: space-evenly">
        <div class="vertical-middle col-md-4">
            <div class="label-sort label-sort-grey">On</div>
        </div>
        <div class="form-group frontend" style="margin-bottom:0px;">
            <label class="switch">
                <input type="checkbox" class="popup_switch enableswitch" name="popup_active" <?= $popup ? '' : 'checked' ?>>
                <span class="glider round"></span>
            </label>
        </div>
        <div class="vertical-middle col-md-4">
            <div class="label-sort label-sort-grey">Off</div>
        </div>
    </div>
</div>
@endif