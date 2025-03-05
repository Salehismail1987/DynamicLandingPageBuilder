<?php
$setting = $frontSections->where('slug', 'staff_products_promos')->first();

if ($staff_products_promos_title->enable == '1' || isset($_GET['editwebsite']) || (count($StaffProductsPromos) > 0)) { ?>
  @include('sections.staff_products_promos.styles')
  <style></style>
  <div id="staff_products_promos" style="width:100%">
    <!-- ======= Testimonials Section ======= -->

    <section id="" class=" staff_products_promos" @if(!isset($_GET['editwebsite']) && $StaffProductsPromosSettings->staff_promos_override_bg=='1' && $StaffProductsPromosSettings->background )
      style="background:<?= $StaffProductsPromosSettings->background; ?>"
      @endif>
      <?php if ($staff_products_promos_title->enable == '1') { ?>
        <div class="position-relative title_banners_outline">
          @if(isset($_GET['editwebsite']))
          <div class="">
            <div class="d-flex align-items-center">
              <x-tutorial-action-buttons title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=staff_products_promos_title' />
            </div>
          </div>
          @endif
          <?php if ($staff_products_promos_title->text) { ?>
            <<?= $staff_products_promos_title->tag ?> class="titlefontfamily staff_products_promos_title" style=""><?= $staff_products_promos_title->text ?></<?= $staff_products_promos_title->tag ?>>
          <?php } ?>
        </div>
      <?php } ?>
      <div class="position-relative staff_products_promos_outline tutorial_background py-15">
        @if(isset($_GET['editwebsite']))
        <div class="">
          <div class="d-flex align-items-center">
            <x-tutorial-action-buttons title='Staff Products Promo' :buttons="isset($tutorial_action_buttons['staff_promo']) ? $tutorial_action_buttons['staff_promo']:'' " url='editfrontend?block=staff_products_promos_bluebar' :status="$setting->section_enabled" />
          </div>
        </div>
        @endif
        <div class="container staff_products_carosel_padding" data-aos="zoom-in">

          <div class="owl-carousel testimonials-carousel">
            <?php if (count($StaffProductsPromos) > 0) {  ?>
              <?php foreach ($StaffProductsPromos as $single) {
              ?>
                <div class="testimonial-item">


                  <img
                    <?php
                    if ($is_app) {
                    ?>
                    src="<?= url('assets/uploads/' . get_current_url() . $single->image); ?>"
                    class="testimonial-img mb-15"
                    <?php
                    } else {

                    ?>
                    data-src="<?= url('assets/uploads/' . get_current_url() . $single->image); ?>"
                    class="testimonial-img lazyload mb-15"
                    <?php
                    } ?>
                    alt="<?= $single->text ?>">
                  <h3 class="staff_products_promos_text mb-15" id="staff_products_promos_text<?= $single->id ?>">
                    <?= nl2br(($single->text)) ?>
                  </h3>
                  <?php
                  if ($StaffProductsPromosSettings->enable_stars) {
                  ?>
                    <div class="stars mb-5px">
                      <?php
                      for ($i = 1; $i <= 5; $i++) {
                        if (floatval($single->stars) == floatval($i)) {
                          $class_name = 'fa-star';
                        } elseif (floatval($single->stars) == floatVal($i - 0.5)) {
                          $class_name = 'fa-star-half-full';
                        } elseif (floatval($single->stars) < floatval($i)) {
                          $class_name = 'fa-star-o';
                        } elseif (floatval($single->stars) > floatval($i)) {
                          $class_name = 'fa-star';
                        }
                      ?>
                        <i class="fa <?= $class_name ?> star stroke-transparent star-single<?= $single->id ?>"></i>
                      <?php
                      }
                      ?>
                    </div>
                  <?php
                  }
                  ?>

                  <div class="stars mb-5px testimonial_action_button_container">
                    <?php
                    if ($single->left_action_button_active == '1' && $single->left_action_button_name != '') {
                      $input_link = '#';
                      $target = '';
                      $popupform = '';
                      $audioclass = '';
                      $data_target = '';
                      $data_toggle = '';
                      $class = '';
                      if ($single->left_action_button_link == 'link') {
                        $input_link = $single->left_action_button_link_text;
                        $target = "_blank";
                      } elseif ($single->left_action_button_link == 'customforms') {
                        $input_link = '#';
                        $target = "";

                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->left_action_button_customform) . '"';
                      } elseif ($single->left_action_button_link == 'stripe') {
                        $audioclass = 'stripe';
                      } elseif ($single->left_action_button_link == "google_map") {

                        $address_full = isset($single->left_action_button_map_address) ? $single->left_action_button_map_address : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif ($single->left_action_button_link == "address") {

                        $address =  getaddress_info($single->left_action_button_address_id);

                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif ($single->left_action_button_link == "audioiconfeature") {

                        if ($single->left_audio_icon_file) { ?>
                          <div class="action-audio">
                            <audio class="hidden" id="contentAudioleftSP_<?= $single->id ?>" controls>
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_audio_icon_file) ?>" type="audio/mp3">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_audio_icon_file) ?>" type="audio/ogg">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_audio_icon_file) ?>" type="audio/mpeg">
                            </audio>
                          </div>
                        <?php
                        }
                        $input_link = '#' . $single->left_audio_icon_file;
                      } elseif ($single->left_action_button_link == 'text_popup') {

                        $input_link = '#' . $single->left_action_button_link;
                        ?>
                        <div style="display:none" id="leftactButtonTextSP<?= $single->id ?>">
                          <?php echo $single->left_action_button_textpopup; ?>
                        </div>
                      <?php
                      } elseif ($single->left_action_button_link == "video") {
                        $input_link = get_blog_image($single->left_action_button_video);
                        // $target = "_blank";
                        $data_target = "#video_modal";
                        $data_toggle = 'modal';
                      } elseif ($single->left_action_button_link == 'text_popup') {

                        $input_link = '#' . $single->left_action_button_link;
                      ?>
                        <div style="display:none" id="leftactButtonTextSP<?= $single->id ?>">
                          <?php echo $single->left_action_button_textpopup; ?>
                        </div>
                        <?php
                      } elseif ($single->left_action_button_link == 'call' || $single->left_action_button_link == 'sms' || $single->left_action_button_link == 'email') {


                        switch ($single->left_action_button_link) {

                          case 'sms':
                            $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->left_action_button_phone_no_sms));
                            break;
                          case 'call':
                            $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->left_action_button_phone_no_calls));
                            break;
                          case 'email':
                            $input_link = 'mailto:' . $single->action_button_action_email;
                            break;
                        }
                      } else {

                        if ($single->left_action_button_link == 'audiofeature') {
                          $audioclass = '';
                        ?> <?php
                                    if ($single->left_action_button_audio) { ?>
                            <div class="action-audio">
                              <audio class="hidden" id="contentAudio_<?= $single->id ?>" controls>
                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_action_button_audio) ?>" type="audio/mp3">
                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_action_button_audio) ?>" type="audio/ogg">
                                <source src="<?= url('assets/uploads/' . get_current_url() . $single->left_action_button_audio) ?>" type="audio/mpeg">
                              </audio>
                            </div>
                      <?php
                                    }
                                  } else {
                                    $class = "menuitem";
                                  }
                                  $input_link = '#' . $single->left_action_button_link;
                                }
                      ?>
                      <?php if (isset($single->left_audio_icon_file)) { ?>
                        <!-- <div class="staff_products_promos_text<?= $single->id ?>" onclick="playPauseAudio('contentAudioleftSP_'+<?= $single->id ?>)" style="margin-top:6px;">
                                <span><i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i></span>
                                <br><text class="staff_products_promos_text<?= $single->id ?>" style="margin-top:10px;">Click to hear Text</text>
                              </div> -->

                        <!-- <div class="col-md-3" style="display:flex;flex-direction: column;align-items: flex-end;">
                              <a href="<?= $input_link ?>" class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>"  <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="min-width:164px;font-weight:bold;position:relative;display:flex;align-items:center;justify-content:center;<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"
                                                                                                                                            
                              <?= (isset($single->left_audio_icon_file) && $single->left_action_button_link == 'audioiconfeature' ? 'onclick=playPauseAudio("contentAudioleftSP_' . $single->id . '")' : '') ?>
                              ><?php if (isset($single->left_audio_icon_file) && $single->left_action_button_link == "audioiconfeature") { ?>
                                <span style="position:absolute;left:10px;">
                                  <i class="fa fa-volume-up" aria-hidden="true"></i>
                                </span>
                                <?= $single->left_action_button_name; ?>
                               
                                <?php }


                                ?></a>
                                <?php if (isset($single->left_audio_icon_file)  && $single->left_action_button_link == "audioiconfeature") { ?>
                                  <div style="margin-right:78px;text-align:center;position:relative">Click to hear Text</div>
                                  <?php } ?>
                                </div> -->
                      <?php } ?>

                      @if($single->left_action_button_link == "video")
                      <div>
                        <a @if($input_link !='#' )href="<?= $input_link ?>" @endif class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>" <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"
                          <?= isset($single->left_action_button_audio) && $single->left_action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudio_' . $single->id . '")' : (isset($single->left_audio_icon_file) && $single->left_action_button_link == 'leftaudioiconfeature' ? 'onclick=playPauseAudio("contentAudioleftSP_' . $single->id . '")' : '') ?>
                          <?php if ($single->left_action_button_link == "video") { ?> onclick="openVideo('<?= $single->id . 'video' ?>')" <?php } ?>><?= $single->left_action_button_name ?></a>
                        <div style="margin-top: -4px;" class="staff_products_promos_text<?= $single->id ?> ">Click to watch video</div>
                      </div>
                      @else
                      <a @if($input_link !='#' )href="<?= $input_link ?>" @endif class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>" <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"
                        <?php if ($single->left_action_button_link == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->left_popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>
                        <?php if ($single->left_action_button_link == 'text_popup') { ?>
                        onclick="openPopupText('leftactButtonTextSP<?= $single->id ?>')"
                        <?php } ?>
                        <?= isset($single->left_action_button_audio) && $single->left_action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudio_' . $single->id . '")' : (isset($single->left_audio_icon_file) && $single->left_action_button_link == 'leftaudioiconfeature' ? 'onclick=playPauseAudio("contentAudioleftSP_' . $single->id . '")' : '') ?>
                        <?php if ($single->left_action_button_link == "video") { ?> onclick="openVideo('<?= $single->id . 'video' ?>')" <?php } ?>><?= $single->left_action_button_name ?></a>
                      @endif
                    <?php } ?>
                    <?php
                    if ($single->right_action_button_active == '1' && $single->right_action_button_name != '') {
                      $input_link = '#';
                      $target = '';
                      $popupform = '';
                      $audioclass = '';
                      $data_target = '';
                      $data_toggle = '';
                      $videoclass = '';
                      $class = '';
                      if ($single->right_action_button_link == 'link') {
                        $input_link = $single->right_action_button_link_text;
                        $target = "_blank";
                      } elseif ($single->right_action_button_link == 'customforms') {
                        $input_link = '#';
                        $target = "";

                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->right_action_button_customform) . '"';
                      } elseif ($single->right_action_button_link == 'stripe') {
                        $audioclass = 'stripe';
                      } elseif ($single->right_action_button_link == "google_map") {

                        $address_full = isset($single->right_action_button_map_address) ? $single->right_action_button_map_address : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif ($single->right_action_button_link == 'text_popup') {

                        $input_link = '#' . $single->right_action_button_link;
                    ?>
                        <div style="display:none" id="rightactButtonTextSP<?= $single->id ?>">
                          <?php echo $single->right_action_button_textpopup; ?>
                        </div>
                        <?php
                      } elseif ($single->right_action_button_link == "address") {

                        $address =  getaddress_info($single->right_action_button_address_id);

                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif ($single->right_action_button_link == "video") {
                        $input_link = get_blog_image($single->right_action_button_video);
                        // $target = "_blank";
                        $data_target = "#video_modal";
                        $data_toggle = 'modal';
                      } elseif ($single->right_action_button_link == "audioiconfeature") {

                        if ($single->right_audio_icon_file) { ?>
                          <div class="action-audio">
                            <audio class="hidden" id="contentAudiorightSP_<?= $single->id ?>" controls>
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_audio_icon_file) ?>" type="audio/mp3">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_audio_icon_file) ?>" type="audio/ogg">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_audio_icon_file) ?>" type="audio/mpeg">
                            </audio>
                          </div>
                          <?php
                        }
                        $input_link = '#' . $single->right_audio_icon_file;
                      } elseif ($single->right_action_button_link == 'call' || $single->right_action_button_link == 'sms' || $single->right_action_button_link == 'email') {


                        switch ($single->right_action_button_link) {

                          case 'sms':
                            $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->right_action_button_phone_no_sms));
                            break;
                          case 'call':
                            $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->right_action_button_phone_no_calls));
                            break;
                          case 'email':
                            $input_link = 'mailto:' . $single->right_action_button_action_email;
                            break;
                        }
                      } else {

                        if ($single->right_action_button_link == 'audiofeature') {
                          $audioclass = '';
                          ?><?php
                                          if ($single->right_action_button_audio) { ?>
                          <div class="action-audio">
                            <audio class="hidden" id="contentAudiorightSP_<?= $single->id ?>" controls>
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_action_button_audio) ?>" type="audio/mp3">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_action_button_audio) ?>" type="audio/ogg">
                              <source src="<?= url('assets/uploads/' . get_current_url() . $single->right_action_button_audio) ?>" type="audio/mpeg">
                            </audio>
                          </div>
                    <?php
                                          }
                                        } else {
                                          $class = 'menuitem';
                                        }
                                        $input_link = '#' . $single->right_action_button_link;
                                      }
                    ?>
                    <?php if (isset($single->right_audio_icon_file) && $single->left_action_button_link == 'audioiconfeature') { ?>
                      <!-- <div onclick="playPauseAudio('contentAudiorightSP_<?= $single->id ?>')">
                                    <span><i  style="margin-top:6px;" class="fa fa-volume-up staff_products_promos_text<?= $single->id ?>" aria-hidden="true"></i></span>
                                    <br><text class="staff_products_promos_text<?= $single->id ?>" style="margin-top:10px;">Click to hear Text</text>
                                </div> -->

                      <div class="col-md-3" style="display:flex;flex-direction: column;align-items: flex-end;">
                        <a @if($input_link !='#' )href="<?= $input_link ?>" @endif class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>" <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="min-width:164px;font-weight:bold;position:relative;display:flex;align-items:center;justify-content:center;<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"

                          <?= (isset($single->right_audio_icon_file) && $single->right_action_button_link == 'audioiconfeature' ? 'onclick=playPauseAudio("contentAudioleft_' . $single->id . '")' : '') ?>><?php if (isset($single->right_audio_icon_file) && $single->right_action_button_link == "audioiconfeature") { ?>
                            <span style="position:absolute;left:10px;">
                              <i class="fa fa-volume-up" aria-hidden="true"></i>
                            </span>
                            <?= $single->right_action_button_name; ?>

                          <?php }


                          ?></a>
                        <?php if (isset($single->right_audio_icon_file)  && $single->right_action_button_link == "audioiconfeature") { ?>
                          <div style="margin-right:78px;text-align:center;position:relative">Click to hear Text</div>
                        <?php } ?>
                      </div>
                    <?php } ?>

                    @if($single->right_action_button_link == "video")
                    <div>
                      <a class="btn testimonial_action_button {{$audioclass }} {{ $single->right_action_button_active ? 'testimonial_action_button_right' : '' }} " id="<?= $single->id . 'videorightSP' ?>" <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="<?php echo $single->right_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->right_action_button_bg_color ? $single->right_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"
                        <?= isset($single->right_action_button_audio) && $single->right_action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudiorightSP_' . $single->id . '")' : (isset($single->right_audio_icon_file) && $single->right_action_button_link == 'audioiconfeature' ? 'onclick=playPauseAudio("contentAudiorightSP_' . $single->id . '")' : '') ?>
                        <?php if ($single->right_action_button_link == "video") { ?> onclick="openVideo('<?= $single->id . 'videorightSP' ?>')" <?php } ?> @if($input_link !='#' )href="<?= $input_link ?>" @endif>
                        <?= $single->right_action_button_name ?>
                      </a>
                      <div style="margin-top: -4px;" class="staff_products_promos_text<?= $single->id ?>">Click to watch video</div>
                    </div>

                    @else
                    <a class="btn testimonial_action_button {{$audioclass }} {{$class}} {{ $single->right_action_button_active ? 'testimonial_action_button_right' : '' }} " id="<?= $single->id . 'videorightSP' ?>" <?= $popupform ?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="<?php echo $single->right_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;' : '' ?><?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->right_action_button_bg_color ? $single->right_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ';' : ';'); ?>"
                      <?php if ($single->right_action_button_link == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->right_popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>
                      <?= isset($single->right_action_button_audio) && $single->right_action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudiorightSP_' . $single->id . '")' : (isset($single->right_audio_icon_file) && $single->right_audio_icon_file == 'audioiconfeature' ? 'onclick=playPauseAudio("contentAudiorightSP_' . $single->id . '")' : '') ?>
                      <?php if ($single->right_action_button_link == 'text_popup') { ?>
                      onclick="openPopupText('rightactButtonTextSP<?= $single->id ?>')"
                      <?php } ?>
                      <?php if ($single->right_action_button_link == "video") { ?> onclick="openVideo('<?= $single->id . 'videorightSP' ?>')" <?php } ?> href="<?= $input_link ?>">
                      <?= $single->right_action_button_name ?>
                    </a>
                    @endif
                  <?php } ?>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>

          </div>

        </div>
      </div>
    </section><!-- End Testimonials Section -->
  </div>

  @include('sections.staff_products_promos.scripts')

<?php } ?>