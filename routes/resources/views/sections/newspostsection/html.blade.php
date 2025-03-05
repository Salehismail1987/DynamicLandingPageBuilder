<?php 
  $setting = $frontSections->where('slug','newspostsection')->first();
if ($news_posts_title->enable == '1' || isset($_GET['editwebsite']) || ($newsPosts && $newsPostsCount > 0)) { ?>
  @include('sections.newspostsection.styles')
  <div id="newspostsection">
    <?php if ($news_posts_title->enable == '1') { ?>
      <div class="position-relative title_banners_outline">
      @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=news_post_title'/>
                  </div>
          </div>
      @endif
        <<?= $news_posts_title->tag ?> class="titlefontfamily newspoststitle {{$news_posts_title->slug}}">
          <?= $news_posts_title->text ?>
        </<?= $news_posts_title->tag ?>>
      </div>
    <?php } ?>
    <div class="position-relative news_post_outline">
    @if(isset($_GET['editwebsite']))
        <div class="">
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons  title='News Posts' :buttons="isset($tutorial_action_buttons['news_posts']) ? $tutorial_action_buttons['news_posts']:'' " url='quicksettings?block=news_posts_bluebar&sb=news_posts_list' :status="$setting->section_enabled"/>
                </div>
        </div>
    @endif
      <div class="news_post_bg">
        <div class="container">
          <div class="row equal" style="justify-content: center;">
            <?php if ($newsPosts && $newsPostsCount > 0) { ?>
              <?php $count = 1;
              foreach ($newsPosts as $single) {

              ?>
                <?php $mt_1rem = ''; ?>
                <div class="col-md-4">
                  <h3 class="titlefontfamily newsposttitle news-post-title-div-{{$single->id}}"><?= $single->post_title ?></h3>
                  <div class="news-post-desc-div-{{$single->id}}">
                    <?php
                    if ($newsPostSettings->use_generic_news_post_setting) {
                      if ($newsPostSettings->generic_news_post_show_date) {
                        echo date('F d, Y', strtotime($single->datetime));
                      }
                    } else {
                      if ($single->show_date) {
                        echo date('F d, Y', strtotime($single->datetime));
                      }
                    }

                    ?></div>
                  <?php
                  $check = $count < 4 ? true : false;
                  if ($check && $step_image = check_step_image('News Post Image ' . $count)) {
                  ?>
                    <img class="lazyload  post-image" data-src="<?= url('assets/uploads/'.get_current_url() . $step_image['image']) ?>" alt="<?= !empty($step_image['text']) ? $step_image['text'] : $single->post_title ?>">
                    <?php
                    if (!empty($step_image['text'])) {
                    ?>
                      <div style="padding-bottom: 0;text-align:center;color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;<?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>">
                        <?= nl2br($step_image['text']) ?>
                      </div>
                    <?php
                    }
                    ?>
                  <?php
                  } elseif (show_timed_image($single->enable_timed_image, $single->timed_image, $single->timed_image_start_time, $single->timed_image_end_time, $single->timed_image_days, 'enable_timed_image', 'news_posts', $single->id, $single->timed_image_type)) {
                  ?>
                    <img class="lazyload post-image" data-src="<?= url('assets/uploads/'.get_current_url() . $single->timed_image) ?>" alt="<?= $single->post_title ?>">
                    <?php
                  } else {
                    if ($single->image) { ?>
                      <img class="lazyload  post-image" data-src="<?= url('assets/uploads/'.get_current_url() . $single->image) ?>" alt="<?= $single->post_title ?>">
                  <?php
                    }
                  }
                  ?>
                  <?php
                  $contentcolumn = 'col-sm-12 pr-0';
                  if (isset($single->post_desc_1) && $single->post_desc_1 != "") {
                    $contentcolumn = 'col-sm-6';
                  }
                  if (isset($single->post_desc_2) && $single->post_desc_2 != "") {
                    $contentcolumn = 'col-sm-4';
                  }
                  if (isset($single->post_desc_3) && $single->post_desc_3 != "") {
                    $contentcolumn = 'col-sm-3';
                  }
                  ?>
                  <div class="<?= $contentcolumn ?>  pl-0 mtop-1">
                    <div class="news-post-desc-div-{{$single->id}}" style=""><?= $single->post_desc ?></div>
                  </div>
                  <?php if (isset($single->post_desc_1) && $single->post_desc_1 != "") { ?>
                    <div class="<?= $contentcolumn ?>  pr-0 mtop-1">
                      <div class="news-post-desc-div-{{$single->id}}" style=""><?= $single->post_desc_1 ?></div>
                    </div>
                  <?php }  ?>
                  <?php if (isset($single->post_desc_2) && $single->post_desc_2 != "") { ?>
                    <div class="<?= $contentcolumn ?> pr-0 mtop-1">
                      <div class="news-post-desc-div-{{$single->id}}" style=""><?= $single->post_desc_2 ?></div>
                    </div>
                  <?php }  ?>
                  <?php if (isset($single->post_desc_3) && $single->post_desc_3 != "") { ?>
                    <div class="<?= $contentcolumn ?> pr-0 mtop-1">
                      <div class="news-post-desc-div-{{$single->id}}" style=""><?= $single->post_desc_3 ?></div>
                    </div>
                  <?php }  ?>

                  @if($single->read_more_desc && strip_tags($single->read_more_desc)!='')
                  <?php $mt_1rem = 'mt-1rem'; ?>
                  <div class="news-post-desc-div-{{$single->id}}">
                    <div class="read_more_link read_more_link_<?= $single->id ?>" data-value="<?= $single->id ?>" class="" style="color:<?= $single->read_more_content_color ? $single->read_more_content_color : '#000000' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_font_family). ';' : '' ?>">
                      <div class="" style="color:<?= $single->read_more_content_color ? $single->read_more_content_color : '#000000' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_font_family). ';' : '' ?>">
                        <?= $single->read_more_text ? $single->read_more_text : 'Read more' ?> <i class="fa fa-angle-down"></i>
                      </div>
                    </div>

                    <div class="read_more_block_<?= $single->id ?> news-post-desc-div-{{$single->id}}" style="display:none">
                      <?= $single->read_more_desc ?>
                    </div>
                    <div class="read_less_link read_less_link_<?= $single->id ?>" data-value="<?= $single->id ?>" style="display:none;color:<?= $single->read_more_content_color ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '' ?>;<?= $single->read_more_content_font_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_font_family). ';' : '' ?>">
                      <div class="news-post-desc-div-{{$single->id}}" style="color:<?= $single->read_more_content_color ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_font_family). ';' : '' ?>">
                        <?= $single->read_less_text ? $single->read_less_text : 'Read less' ?> <i class="fa fa-angle-up"></i>
                      </div>
                    </div>
                  </div>
                  @endif

                  <div style="text-align: left;">
                    <?php if ($single->action_button_active == '1') {
                      $input_link = '#';
                      $target = '';
                      $audioclass = '';
                      $popupform = '';
                      $class='';
                      $data_target="";
                      $data_toggle='';
                      if ($single->action_button_link == 'link') {
                        $input_link = $single->action_button_link_text;
                        $target = "_blank";
                      } elseif ($single->action_button_link == 'customforms') {
                        $input_link = '#';
                        $target = "";

                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms' . getCustomformEncodedID($single->action_button_customform) . '"';
                      } elseif ($single->action_button_link == "address") {

                        $address =  getaddress_info($single->action_button_address_id);

                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif($single->action_button_link == "audioiconfeature" ){
    
                        if ( $single->action_button_audio_icon_feature) {?>  
                          <div class="action-audio" >                                  
                                <audio class="hidden" id="newspostAudio_<?= $single->id ?>" controls>
                                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                </audio>
                                </div>
                            <?php
                        }
                        $input_link = '#' . $single->action_button_audio_icon_feature;
                  
                      }elseif($single->action_button_link == "video" ){
                      
                        $input_link = get_blog_image($single->action_button_video);
                        // $target = "_blank";
                        $data_target="#video_modal";
                        $data_toggle='modal';
                      } elseif ($single->action_button_link == "google_map") {

                        $address_full = isset($single->action_button_map_address) ? $single->action_button_map_address : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      }elseif($single->action_button_link == 'text_popup'){
                            
                        $input_link = '#' . $single->action_button_link;
                        ?>
                        <div style="display:none" id="actNewsButtonText<?=$single->id?>">
                            <?php echo $single->action_button_textpopup;?>
                        </div>
                        <?php 
                    }
                     elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


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
                      } elseif (is_numeric($single->section)) {
                        $section = getSectionDetail($single->section);
                        $banner_input_href = '#' . $section->slug;
                        if ($section->slug == 'audiofeature') {
                          $audioclass = '';
                        }
                      } else {
                        $input_link = '#' . $single->action_button_link;
                        if ($single->action_button_link == 'audiofeature') {
                          $audioclass = '';
                          ?><div class="action-audio" > <?php
                          if ( $single->action_button_action_audio) {?>                                    
                                        <audio class="hidden" id="newsPostAudio" controls>
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/mpeg">
                                        </audio>
                                        <?php
                                }
                                ?></div> <?php
                        }else{
                          $class = 'menuitem';
                        }
                      }
                    ?>
                      @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) 
                          <span  onclick="playPauseAudio('newspostAudio_<?=$single->id ?>')" style="<?='color:' . ($single->post_desc_color ? $single->post_desc_color . ';' : '#000;');?>">
                            <span>
                              <i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i>
                            </span>
                            <a href="<?= $input_link ?>" 
                              style="" class="btn btn-default {{$mt_1rem}} mb-1 text-bold new-action-btn post-action-{{$single->id}} " style=""><?= $single->action_button_discription ?></a>
                            <div style="margin-top: -5px;">Click to hear Text</div>
                            <br>
                          </span>
                      @else 
                        <a href="<?= $input_link ?>" 
                          id="<?= $single->id . 'newspost' ?>"
                          <?php if($single->action_button_link == 'text_popup'){ ?> 
                          onclick="openPopupText('actNewsButtonText<?=$single->id?>')" 
                          <?php }?>

                          <?php if($single->action_button_link == "video"){?> 
                              data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                              onclick="openVideo('<?= $single->id . 'newspost' ?>')" 
                          <?php }?>
                          <?= isset($single->action_button_action_audio)?'onclick=playPauseAudio("newsPostAudio")':'' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default {{$class}} {{$mt_1rem}} mb-1 text-bold new-action-btn post-action-{{$single->id}} " style=""><?= $single->action_button_discription ?></a>
                          @if($single->action_button_link == "video")
                              <div style="margin-top: -4px;<?='color:' . ($single->post_desc_color ? $single->post_desc_color . ';' : '#000;');?>" class="">Click to watch video</div>
                          @endif
                      @endif
                      
                    <?php } ?>
                  </div>

                </div>
              <?php $count++;
              } ?>
            <?php } ?>
          </div>

          <br>
        </div>
      </div>
              
    </div>
  </div>
  @include('sections.newspostsection.scripts')
<?php } ?>