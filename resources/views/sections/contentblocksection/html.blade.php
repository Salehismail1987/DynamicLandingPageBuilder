<?php
$setting = $frontSections->where('slug', 'contentblocksection')->first();
if ($content_block_title->enable == '1' || isset($_GET['editwebsite']) || ($contentBlockLinks && count($contentBlockLinks->toArray()))) { ?>
  @include('sections.contentblocksection.styles')

  <div id="contentblocksection">
    <?php if ($content_block_title->enable == '1') { ?>
      <div class="position-relative title_banners_outline">
        @if(isset($_GET['editwebsite']))
        <div class="">
          <div class="d-flex align-items-center">
            <x-tutorial-action-buttons title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=content_block_title' />
          </div>
        </div>
        @endif
        <<?= $content_block_title->tag ?> class="titlefontfamily conentblocktitle {{$content_block_title->slug}}"><?= $content_block_title->text ?></<?= $content_block_title->tag ?>>
      </div>
    <?php } ?>

    <div class="position-relative content_block_outline">
      @if(isset($_GET['editwebsite']))
      <div class="">
        <div class="d-flex align-items-center">
          <x-tutorial-action-buttons title='Content Block' :buttons="isset($tutorial_action_buttons['content']) ? $tutorial_action_buttons['content']:'' " url='editfrontend?block=content_block_bluebar&sb=content-main-block-div' :status="$setting->section_enabled" />
        </div>
      </div>
      @endif
      <div class="content_block_bg">
        <br>
        <div class="container-fluid">
          <div class="main-content-block">
            <?php
            if ($step_image = check_step_image('Content Block')) {
            ?>
              <div class="col-12 contentmainimage mb-10">
                <center>
                  <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $step_image['image']) ?>" alt="<?= $content_block_title->text ?>" width="<?= ($contentBlockSettings->block_image_size) ? $contentBlockSettings->block_image_size : '100%' ?>">
                </center>
                <?php
                if (!empty($step_image['text'])) {
                ?>
                  <p class="content-block-p" style="">
                    <?= nl2br($step_image['text']) ?>
                  </p>
                <?php
                }
                ?>
              </div>
            <?php
            } elseif (show_timed_image($timed_content_block_image->enable, $timed_content_block_image_file->file_name, $timed_content_block_image->start_time, $timed_content_block_image->end_time, $timed_content_block_image->days, 'enable_timed_content_block_image', 'timed_images', 1, $timed_content_block_image->type)) {

            ?>
              <div class="col-12 contentmainimage mb-10">
                <center>
                  <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $timed_content_block_image_file->file_name) ?>" alt="<?= $content_block_title->text ?>" width="<?= ($contentBlockSettings->block_image_size) ? $contentBlockSettings->block_image_size : '100%' ?>">
                </center>
              </div>
            <?php
            } elseif (show_timed_image($timed_content_block_image->enable, $timed_content_block_image_file->file_name, $timed_content_block_image->start_time, $timed_content_block_image->end_time, $timed_content_block_image->days, 'enable_timed_content_block_image', 'timed_images', 1, $timed_content_block_image->type)) {

            ?>
              <div class="col-12 contentmainimage mb-10">
                <center>
                  <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $timed_content_block_image_file->file_name) ?>" alt="<?= $content_block_title->text ?>" width="<?= ($contentBlockSettings->block_image_size) ? $contentBlockSettings->block_image_size : '100%' ?>">
                </center>
              </div>
              <?php
            } else {
              if ($contentBlockSettings->block_image) {
              ?>
                <div class="col-12 contentmainimage">
                  <center>
                    <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $contentBlockSettings->block_image) ?>" alt="<?= $content_block_title->text ?>" width="<?= ($contentBlockSettings->block_image_size) ? $contentBlockSettings->block_image_size . 'px' : '100%' ?>">
                  </center>
                </div>
            <?php
              }
            } ?>

            <div>
              <?php if ($contentBlockLinks && count($contentBlockLinks->toArray())) {
              ?>
                <?php $i = 1;
                foreach ($contentBlockLinks as $single) {
                ?>
                  <div>
                    <div class="">
                      <div class="content-subblock">
                        <?php
                        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                        ?>
                          <?php
                          if (isset($single->content_image) && !empty($single->content_image)) {
                          ?>
                            <div class="content-image-container" style="">
                              <center>
                                <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $single->content_image) ?>" alt="<?= $single->title ?>">
                              </center>
                            </div>
                          <?php
                          }
                          ?>
                        <?php } ?>
                        <?php
                        $contentcolumn = 'col-sm-12';
                        // if(isset($single->description1) && $single->description1!="") {
                        //   $contentcolumn = 'col-sm-6';
                        // }
                        // if(isset($single->description2) && $single->description2!="") {
                        //   $contentcolumn = 'col-sm-4';
                        // }
                        // if(isset($single->description3) && $single->description3!="") {
                        //   $contentcolumn = 'col-sm-3';
                        // }
                        ?>
                        <div class="" style="padding:0 15px;">
                          <div class="col-md-12">
                            <h3 class="content-block-subtitle" id="content-block-subtitle-<?= $i ?>"><?= $single->title ?></h3>
                          </div>
                          <div class="col-md-12">
                            <p style="" class="content-block-desc" id="content-block-desc-<?= $i ?>"><?= $single->description; ?></p>
                            @if($single->read_more_active=='1' && $single->read_more_desc && strip_tags($single->read_more_desc) !='')
                            <div class="content-block-desc">
                              <div class=" read_more_link read_more_link_<?= $single->id ?>" data-value="<?= $single->id ?>" id="content-block-desc-<?= $i ?>">
                                <div class="" style="color:<?= $single->content_desc_color ? $single->content_desc_color : '#000000' ?>;font-size:<?= $single->content_desc_font_size ? $single->content_desc_font_size . 'px' : '' ?>;<?= $single->content_desc_font_family ? 'font-family:' . getfontfamily($single->content_desc_font_family) . ';' : '' ?>">

                                  <?= $single->read_more_text ? $single->read_more_text : 'Read more' ?> <i class="fa fa-angle-down" style="font-size:<?= $single->content_desc_font_size ? $single->content_desc_font_size . 'px !important' : '' ?>"></i>
                                </div>
                              </div>
                              <div class="read_more_block_<?= $single->id ?> content-block-desc" style="display:none;<?= $single->content_desc_font_family ? 'font-family:' . getfontfamily($single->content_desc_font_family) . '!important;' : '' ?>">
                                <?= $single->read_more_desc ?>
                              </div>
                              <div class="read_less_link read_less_link_<?= $single->id ?>" data-value="<?= $single->id ?>" style="display:none" id="content-block-desc-<?= $i ?>">
                                <div class="" style="color:<?= $single->content_desc_color ? $single->content_desc_color : '#000000' ?>;font-size:<?= $single->content_desc_font_size ? $single->content_desc_font_size . 'px' : '' ?>;<?= $single->content_title_font_family ? 'font-family:' . getfontfamily($single->content_desc_font_family) . ';' : '' ?>">
                                  <?= $single->read_less_text ? $single->read_less_text : 'Read less' ?> <i class="fa fa-angle-up" style="font-size:<?= $single->content_desc_font_size ? $single->content_desc_font_size . 'px !important' : '' ?>"></i>
                                </div>
                              </div>
                            </div>
                            @endif
                          </div>


                          <!-- <?php if (isset($single->description1) && $single->description1 != "") { ?>
                                      <div class="<?= $contentcolumn ?>">
                                        <p style=""  class="content-block-desc" id="content-block-desc-<?= $i ?>"><?= $single->description1; ?></p>
                                      </div>
                                    <?php } ?>
                                    <?php if (isset($single->description2) && $single->description2 != "") { ?>
                                      <div class="<?= $contentcolumn ?>">
                                        <p style=""  class="content-block-desc" id="content-block-desc-<?= $i ?>"><?= $single->description2; ?></p>
                                      </div>
                                    <?php }  ?>
                                    <?php if (isset($single->description3) && $single->description3 != "") { ?>
                                      <div class="<?= $contentcolumn ?>">
                                        <p style=""  class="content-block-desc" id="content-block-desc-<?= $i ?>"><?= $single->description3; ?></p>
                                      </div>
                                    <?php } ?> -->


                          <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                          ?>
                            <div class="col-md-12 " style="margin-top:10px;">
                              <?php
                              $input_link = '#';
                              $target = '';
                              $popupform = '';
                              $audioclass = '';
                              $videoclass = '';
                              $data_target = '';
                              $data_toggle = '';
                              $class = '';
                              if ($single->action_button_link == 'link') {
                                $input_link = $single->action_button_link_text;
                                $target = "_blank";
                              } elseif ($single->action_button_link == 'stripe') {

                                $audioclass = 'stripe';
                              } 
                              elseif ($single->action_button_link == 'customforms') {

                                $input_link = '#';
                                $target = "";
                                $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->action_button_custom_forms) . '"';
                              }elseif ($single->action_button_link == 'eventForms') {

                                $input_link = '#';
                                $target = "";
                                $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($single->action_button_event) . '"';
                              }
                               elseif ($single->action_button_link == "address") {

                                $address =  getaddress_info($single->action_button_address_id);

                                $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                $target = "_blank";
                              } elseif ($single->action_button_link == "audioiconfeature") {

                                if ($single->action_button_audio_icon_feature) { ?>
                                  <div class="action-audio">
                                    <audio class="hidden" id="contentAudio_<?= $single->id ?>" controls>
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
                                <div style="display:none" id="actCBText<?= $single->id ?>">
                                  <?php echo $single->action_button_textpopup; ?>
                                </div>
                                <?php
                              } elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


                                switch ($single->action_button_link) {
                                  case 'sms':
                                    $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                                    break;
                                  case 'call':
                                    $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_calls));
                                    break;
                                  case 'email':
                                    $input_link = 'mailto:' . $single->action_button_action_email;
                                    break;
                                }
                              } elseif ($single->action_button_link == "video") {


                                $input_link = get_blog_image($single->cb_action_button_video);
                                // $target = "_blank";
                                $data_target = "#video_modal";
                                $data_toggle = 'modal';
                                $videoclass = 'videoclass';
                              } else {
                                if ($single->action_button_link == 'audiofeature') {
                                  $audioclass = '';
                                ?><div class="action-audio"> <?php
                                                                if ($single->action_button_action_audio) { ?>
                                      <audio class="hidden" id="contentAudio_<?= $single->id ?>" controls>
                                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mp3">
                                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/ogg">
                                        <source src="<?= url('assets/uploads/' . get_current_url() . $single->action_button_action_audio) ?>" type="audio/mpeg">
                                      </audio>
                                  </div>
                              <?php
                                                                }
                                                              }
                                                              $input_link = '#' . $single->action_button_link;
                                                              $class = 'menuitem';
                                                            }
                                                            if ($single->action_button_discription != "") {
                              ?>
                              <?php if ($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) { ?>
                                <span class="desc-text-font-<?= $single->id ?>">
                                
                                  <a @if($input_link !='#' )href="<?= $input_link ?>" @endif<?php if ($single->action_button_link == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" id="<?= $single->id . 'contentVideo' ?>" onclick="openVideo('<?= $single->id . 'contentVideo' ?>')" <?php } ?> <?= isset($single->action_button_action_audio) && $single->action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudio_' . $single->id . '")' : (isset($single->action_button_audio_icon_feature) && $single->action_button_link == 'audioiconfeature' ? 'onclick=playPauseAudio("contentAudio_' . $single->id . '")' : '') ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-adjustable btn-default text-bold new-action-btn action-button-content-{{$single->id}} {{$class}} {{$videoclass}} {{$audioclass}}" style="">
                                  <span style="position:absolute;left:10px;">
                          <i class="fa fa-volume-up" aria-hidden="true"></i></span>
                          <span class="text"><?= $single->action_button_discription ?></span></a>
                      <div  class="info-text">Click to hear Text</div>
                                 

                                  <br>
                                </span>
                              <?php } else { ?>

                                <a @if($input_link !='#' )href="<?= $input_link ?>" @endif id="<?= $single->id . 'contentVideo' ?>" <?php if ($single->action_button_link == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>  
                                 <?php if ($single->action_button_link == 'text_popup') { ?> onclick="openPopupText('actCBText<?= $single->id ?>')" <?php } ?> <?php if ($single->action_button_link == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $single->id . 'contentVideo' ?>')" <?php } ?> <?= isset($single->action_button_action_audio) && $single->action_button_link == "audiofeature" ? 'onclick=playPauseAudio("contentAudio_' . $single->id . '")' : '' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default text-bold new-action-btn action-button-content-{{$single->id}} {{$class}} {{$videoclass}} {{$audioclass}}" style=""><?= $single->action_button_discription ?></a>
                                @if($single->action_button_link == "video")
                                <div style="margin-top: -4px;" class="desc-text-font-<?= $single->id ?>">Click to watch video</div>
                                @endif

                            <?php }
                                                            }
                            ?>
                            </div>
                          <?php
                          } ?>
                        </div>

                        <?php
                        if (!(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android'))) {
                        ?>
                          <?php
                          if (isset($single->content_image) && !empty($single->content_image)) {

                          ?>
                            <div class="content-image-container">
                              <center>
                                <img class="lazyload" data-src="<?= url('assets/uploads/' . get_current_url() . $single->content_image) ?>" alt="<?= $single->title ?>">
                              </center>
                            </div>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>

                      </div>
                    </div>
                  </div>
                  <br>
                <?php $i++;
                } ?>
              <?php } ?>
            </div>
          </div>
        </div>

        <br>
      </div>
    </div>

  </div>
  </div>

  @include('sections.common.video-modal-action')
  @include('sections.contentblocksection.scripts')
<?php } ?>