
<?php 
$setting = $frontSections->where('slug','testimonials')->first();
if($reviews_staff_title->enable=='1' || count($reviewStaff) > 0 || isset($_GET['editwebsite'])){ ?>
    @include('sections.testimonials.styles')
    <style>
  .testimonial_action_button_container{
    align-items: flex-start;
  }
    </style>
    <div id="testimonials" style="width:100%">
      <!-- ======= Testimonials Section ======= -->
      <section class="testimonials review_staff">
        <?php if($reviews_staff_title->enable=='1'){ ?>
          <div class="position-relative title_banners_outline" >
          @if(isset($_GET['editwebsite']))
              <div class="">
                      <div class="d-flex align-items-center">
                          <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=reviews_staff_title'/>
                      </div>
              </div>
          @endif
            <?php if ($reviews_staff_title->text) { ?>
              <<?= $reviews_staff_title->tag ?> class="titlefontfamily review_and_staff_title" style=""><?= $reviews_staff_title->text ?></<?= $reviews_staff_title->tag ?>>
            <?php } ?>
          </div>
        <?php } ?>
        <div class="position-relative review_staff_outline py-15" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Review Posting' :buttons="isset($tutorial_action_buttons['reviews']) ? $tutorial_action_buttons['reviews']:'' " url='editfrontend?block=review_staff_bluebar' :status="$setting->section_enabled"/>
                    </div>
            </div>
        @endif
          <div class="container review_staff_carosel_padding" data-aos="zoom-in">
   
            <div class="owl-carousel testimonials-carousel">
    
              <?php if (count($reviewStaff) > 0) {  ?>
                <?php foreach ($reviewStaff as $single) {
                ?>
                  <div class="testimonial-item">
    
    
                    <img 
                    <?php 
                    if($is_app){
                      ?>
                    src="<?= url('assets/uploads/'.get_current_url().$single->image); ?>"              
                    class="testimonial-img mb-15"
                      <?php
                    }else{
                      
                    ?>
                    data-src="<?= url('assets/uploads/'.get_current_url(). $single->image); ?>"              
                    class="testimonial-img lazyload mb-15"
                    <?php 
                    }?>
                    alt="<?=$single->text?>">
                    <h3 class="reviews_staff_text mb-15" id="reviews_staff_text<?= $single->id ?>">
                      <?= nl2br(($single->text)) ?>
                    </h3>
                    <?php
                    if ($reviewSettings->enable_review_stars) {
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
                        if ($single->left_action_button_active == '1' && $single->left_action_button_name!='') {
                            $input_link = '#';
                            $target = '';
                            $popupform='';
                            $audioclass='';
                            $data_target = '';
                            $data_toggle='';
                            $class='';
                            if ($single->left_action_button_link == 'link') {
                                $input_link = $single->left_action_button_link_text;
                                $target = "_blank";
                            
                            }elseif ($single->left_action_button_link == 'customforms') {
                                $input_link = '#';
                                $target = "";
                                
                                $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->left_action_button_customform).'"';
    
                            }elseif ($single->left_action_button_link == 'eventForms') {
                              $input_link = '#';
                              $target = "";
                              
                              $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->left_action_button_event_form).'"';
  
                          }
                            elseif( $single->left_action_button_link == "stripe"){
    
                              $audioclass = 'stripe';
                          
                            }
                            elseif( $single->left_action_button_link == "google_map"){
    
                                $address_full = isset($single->left_action_button_map_address ) ? $single->left_action_button_map_address: "";
                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                $target = "_blank";
                            
                            }elseif($single->left_action_button_link == "address" ){
    
                                $address =  getaddress_info($single->left_action_button_address_id);
                        
                                $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                $target = "_blank";
                            
                            }elseif($single->left_action_button_link == "audioiconfeature" ){
    
                                if ( $single->left_audio_icon_file) {?>  
                                  <div class="action-audio" >                                  
                                        <audio class="hidden" id="contentAudioleft_<?= $single->id ?>" controls>
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_audio_icon_file) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_audio_icon_file) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_audio_icon_file) ?>" type="audio/mpeg">
                                        </audio>
                                        </div>
                                    <?php
                                }
                                $input_link = '#' . $single->left_audio_icon_file;
                          
                          } elseif($single->left_action_button_link == 'text_popup'){
                            
                            $input_link = '#' . $single->left_action_button_link;
                            ?>
                            <div style="display:none" id="leftactButtonText<?=$single->id?>">
                                <?php echo $single->left_action_button_textpopup;?>
                            </div>
                            <?php 
                        }elseif($single->left_action_button_link == "video" ){
                              $input_link = get_blog_image($single->left_action_button_video);
                              // $target = "_blank";
                              $data_target="#video_modal";
                              $data_toggle='modal';
                          
                            }elseif($single->left_action_button_link == 'text_popup'){
                            
                              $input_link = '#' . $single->left_action_button_link;
                              ?>
                              <div style="display:none" id="leftactButtonText<?=$single->id?>">
                                  <?php echo $single->left_action_button_textpopup;?>
                              </div>
                              <?php 
                          }elseif ($single->left_action_button_link == 'call' || $single->left_action_button_link == 'sms' || $single->left_action_button_link == 'email') {
    
    
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
                                if ( $single->left_action_button_audio) {?>  
                                  <div class="action-audio" >                                  
                                        <audio class="hidden" id="contentAudio_<?= $single->id ?>" controls>
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_action_button_audio) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_action_button_audio) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->left_action_button_audio) ?>" type="audio/mpeg">
                                        </audio>
                                        </div>
                                    <?php
                                }
                              }else{
                                $class="menuitem";
                              }
                                $input_link = '#' . $single->left_action_button_link;
                                
                            }
                        ?>
                        <?php if(isset($single->left_audio_icon_file)) { ?>
                          <div onclick="playPauseAudio('contentAudioleft_'+<?=$single->id ?>)" style="<?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . '!important;margin-top:6px;' : '#000;'); ?>">
                                <!-- <span><i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i></span>
                                <br><text style="margin-top:10px;">Click to hear Text</text> -->
                              </div>
                                <?php } ?>
                          
                            @if($single->left_action_button_link == "video")
                              <div> 
                                <a @if($input_link != '#')href="<?= $input_link ?>" @endif class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>"  <?=$popupform?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="font-weight:bold;<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;':''?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . '!important;' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->	text_font) . ';' : ';'); ?>"
                                  <?= isset($single->left_action_button_audio) && $single->left_action_button_link == "audiofeature" ?'onclick=playPauseAudio("contentAudio_'.$single->id.'")': (isset($single->left_audio_icon_file) && $single->left_action_button_link == 'leftaudioiconfeature'? 'onclick=playPauseAudio("contentAudioleft_'.$single->id.'")':'') ?>
                                  <?php if($single->left_action_button_link == "video"){?>  onclick="openVideo('<?= $single->id . 'video' ?>')" <?php }?> 
                                ><?=$single->left_action_button_name ?></a>
                                  <div style="margin-top: 7px;" class="reviews_staff_text ">Click to watch video</div>
                              </div>
                            @else 
                            <div class="<?php echo (empty($single->right_action_button_active)) ? 'col-md-4' : 'col-md-3'; ?>" style="display:flex; flex-direction: column; align-items: flex-end;">

                              <a  @if($input_link != '#')href="<?= $input_link ?>" @endif class="btn testimonial_action_button {{$audioclass}} {{ $single->left_action_button_active ? 'testimonial_action_button_left' : '' }}" id="<?= $single->id . 'video' ?>"  <?=$popupform?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="min-width:164px;font-weight:bold;position:relative;display:flex;align-items:center;justify-content:center;<?php echo $single->left_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;':''?><?php echo 'color:' . ($single->left_action_button_text_color ? $single->left_action_button_text_color . '!important;' : '#000;'); ?><?php echo 'background:' . ($single->left_action_button_bg_color ? $single->left_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->	text_font) . ';' : ';'); ?>"
                              <?php if ($single->left_action_button_link == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->left_popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>
                              <?php if($single->left_action_button_link == 'text_popup'){ ?> 
                              onclick="openPopupText('leftactButtonText<?=$single->id?>')" 
                              <?php }?>  
                              <?= isset($single->left_action_button_audio) && $single->left_action_button_link == "audiofeature" ?'onclick=playPauseAudio("contentAudio_'.$single->id.'")': (isset($single->left_audio_icon_file) && $single->left_action_button_link == 'leftaudioiconfeature'? 'onclick=playPauseAudio("contentAudioleft_'.$single->id.'")':'') ?>
                                <?php if($single->left_action_button_link == "video"){?>  onclick="openVideo('<?= $single->id . 'video' ?>')" <?php }?> 
                              ><?php if(isset($single->left_audio_icon_file) && $single->left_action_button_link == "leftaudioiconfeature"){ ?>
                                <span style="position:absolute;left:10px;">
                                  <i class="fa fa-volume-up" aria-hidden="true"></i>
                                </span>
                                <?= $single->left_action_button_name; ?>
                               
                                <?php } 
                                else{
                                  echo $single->left_action_button_name;
                                }
                                
                                ?></a>
                                <?php  if(isset($single->left_audio_icon_file)  && $single->left_action_button_link == "leftaudioiconfeature"){ ?>
                                  <div style="margin-right:78px;text-align:center;position:relative">Click to hear Text</div>
                                  <?php } ?>
                                </div>
                            @endif
                        <?php } ?>
                      <?php 
                        if ($single->right_action_button_active == '1' && $single->right_action_button_name!='') {
                            $input_link = '#';
                            $target = '';
                            $popupform='';
                            $audioclass='';
                            $data_target = '';
                            $data_toggle='';
                            $videoclass = '';
                            $class='';
                            if ($single->right_action_button_link == 'link') {
                                $input_link = $single->right_action_button_link_text;
                                $target = "_blank";
                            
                            } elseif ($single->right_action_button_link == 'stripe') {
                              $audioclass = 'stripe';
  
                            }
                            elseif ($single->right_action_button_link == 'customforms') {
                                $input_link = '#';
                                $target = "";
                                
                                $popupform = 'data-toggle="modal" test data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->right_action_button_event_form).'"';
    
                              }elseif ($single->right_action_button_link == 'eventForms') {
                                $input_link = '#';
                                $target = "";
                                
                                $popupform = 'data-toggle="modal" test data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($single->right_action_button_event_form).'"';
    
                              }
                              elseif( $single->right_action_button_link == "google_map"){
    
                                $address_full = isset($single->right_action_button_map_address ) ? $single->right_action_button_map_address: "";
                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                $target = "_blank";
                            
                              }elseif($single->right_action_button_link == 'text_popup'){
                              
                                $input_link = '#' . $single->right_action_button_link;
                                ?>
                                <div style="display:none" id="rightactButtonText<?=$single->id?>">
                                    <?php echo $single->right_action_button_textpopup;?>
                                </div>
                                <?php 
                              }elseif($single->right_action_button_link == "address" ){
    
                                $address =  getaddress_info($single->right_action_button_address_id);
                        
                                $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                $target = "_blank";
                            
                              }elseif($single->right_action_button_link == "video" ){
                                $input_link = get_blog_image($single->right_action_button_video);
                                // $target = "_blank";
                                $data_target="#video_modal";
                                $data_toggle='modal';
                              } elseif($single->right_action_button_link == "audioiconfeature" ){
      
                                  if ( $single->right_audio_icon_file) {?>  
                                    <div class="action-audio" >                                  
                                      <audio class="hidden" id="contentAudioright_<?= $single->id ?>" controls>
                                          <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_audio_icon_file) ?>" type="audio/mp3">
                                          <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_audio_icon_file) ?>" type="audio/ogg">
                                          <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_audio_icon_file) ?>" type="audio/mpeg">
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
                                        if ( $single->right_action_button_audio) {?>   
                                              <div class="action-audio" >                                  
                                                <audio class="hidden" id="contentAudioright_<?= $single->id ?>" controls>
                                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_action_button_audio) ?>" type="audio/mp3">
                                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_action_button_audio) ?>" type="audio/ogg">
                                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->right_action_button_audio) ?>" type="audio/mpeg">
                                                </audio>
                                              </div>
                                            <?php
                                        }
                                      }else{
                                        $class='menuitem';
                                      }
                                        $input_link = '#' . $single->right_action_button_link;
                                        
                                    }
                                ?>
                                <!-- <?php if(isset($single->right_audio_icon_file) && $single->right_action_button_link == 'audioiconfeature') {?>
                                  <div onclick="playPauseAudio('contentAudioright_<?=$single->id ?>')">
                                    <span><i  style="<?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . ';margin-top:6px;' : '#000;margin-top:6px;');?>" class="fa fa-volume-up" aria-hidden="true"></i></span>
                                    <br><text style="margin-top:10px;">Click to hear Text</text>
                                </div>
                                <?php } ?> -->
                           
                                @if($single->right_action_button_link == "video")
                                <div>
                                  <a class="btn btntestimonial_action_button {{$audioclass }} {{ $single->right_action_button_active ? 'testimonial_action_button_right' : '' }} " id="<?= $single->id . 'videoright' ?>"  <?=$popupform?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="font-weight:bold;<?php echo $single->right_action_button_link == 'audioiconfeature' ?  'margin-left:10px !important;':''?><?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($single->right_action_button_bg_color ? $single->right_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->	text_font) . ';' : ';'); ?>"
                                  <?= isset($single->right_action_button_audio) && $single->right_action_button_link == "audiofeature" ?'onclick=playPauseAudio("contentAudioright_'.$single->id.'")':(isset($single->right_audio_icon_file) && $single->right_action_button_link == 'audioiconfeature'? 'onclick=playPauseAudio("contentAudioright_'.$single->id.'")':'') ?>
                                  <?php if($single->right_action_button_link == "video"){?>  onclick="openVideo('<?= $single->id . 'videoright' ?>')" <?php }?> @if($input_link != '#')href="<?= $input_link ?>" @endif>
                                    <?=$single->right_action_button_name ?>
                                  </a>
                                  <div style="margin-top: 7px;<?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . ';' : '#000;'); ?>" class="reviews_staff_text">Click to watch video</div>
                                </div>
                                  
                                @else
                                
                                <div class="<?php echo (empty($single->left_action_button_active)) ? 'col-md-4' : 'col-md-3'; ?>" style="flex-direction: column;align-items:center;align-items: flex-start;">
                                  <a <?= isset($popupform)? $popupform : '' ?>  class="btn testimonial_action_button {{$audioclass }} {{$class}} {{ $single->right_action_button_active ? 'testimonial_action_button_right' : '' }}" id="<?= $single->id . 'videoright' ?>"  <?=$popupform?> target="<?= $target ?>" data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" style="font-weight:bold;min-width:164px;<?php echo $single->right_action_button_link == 'audioiconfeature' ?  'font-weight:bold;position:relative;display:flex;align-items:center;justify-content:center;':''?><?php echo 'color:' . ($single->right_action_button_text_color ? $single->right_action_button_text_color . '!important;' : '#000;'); ?><?php echo 'background:' . ($single->right_action_button_bg_color ? $single->right_action_button_bg_color . ';' : '#fff;'); ?><?php echo 'font-family:' . ($single->text_font ? getfontfamily($single->	text_font) . ';' : ';'); ?>"
                                    <?= isset($single->right_action_button_audio) && $single->right_action_button_link == "audiofeature" ?'onclick=playPauseAudio("contentAudioright_'.$single->id.'")':(isset($single->right_audio_icon_file) && $single->right_audio_icon_file == 'audioiconfeature'? 'onclick=playPauseAudio("contentAudioright_'.$single->id.'")':'') ?>
                                    <?php if($single->right_action_button_link == 'text_popup'){ ?> 
                                    onclick="openPopupText('rightactButtonText<?=$single->id?>')" 
                                    <?php }?> 
                                    <?php if($single->right_action_button_link == "video"){?>  onclick="openVideo('<?= $single->id . 'videoright' ?>')" <?php }?> @if($input_link != '#')href="<?= $input_link ?>"@endif
                                    <?php if ($single->right_action_button_link == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($single->right_popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>
                                    >
                                    <?php if($single->right_action_button_link == 'audioiconfeature'){ ?>
                                <span style="position:absolute;left:10px;">
                                  <i class="fa fa-volume-up" aria-hidden="true"></i>
                                </span>
                                <?= $single->right_action_button_name; ?>
                               
                                <?php } 
                                
                                else{
                                 echo $single->right_action_button_name;
                                }
                                
                                ?>
                                      <!-- <?=$single->right_action_button_name ?> -->
                                  </a>
                                  <?php  if($single->right_action_button_link == 'audioiconfeature'){ ?>
                                    <div style="text-align:center;position:relative;margin-left:61px">Click to hear Text</div>
                                    <?php } ?>
                                  </div>
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
 
    @include('sections.common.video-modal-action')
    @include('sections.testimonials.scripts')
<?php } ?>