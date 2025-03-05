<?php 
$setting = $frontSections->where('slug','videosection')->first();
if($gallery_videos_title->enable=='1' || isset($_GET['editwebsite']) || ($galleryvideos && count($galleryvideos->toArray()) > 0)){ ?>
@include('sections.videosection.styles')

<div id="videosection">
  <?php if($gallery_videos_title->enable=='1'){ ?>
    <div class="position-relative title_banners_outline" >
    @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=gallery_videos_title'/>
                  </div>
          </div>
      @endif
      <<?= $gallery_videos_title->tag ?> class="titlefontfamily videostitle {{$gallery_videos_title->slug}}">
        <?= $gallery_videos_title->text ?>
      </<?= $gallery_videos_title->tag ?>>
    </div>
  <?php } ?>
  <div class="position-relative gallery_video_outline" >
  @if(isset($_GET['editwebsite']))
        <div class="">
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons  title='Gallery Video' :buttons="isset($tutorial_action_buttons['gallery_video']) ? $tutorial_action_buttons['gallery_video']:'' " url='galleries?block=gallery_video_bluebar' :status="$setting->section_enabled"/>
                </div>
        </div>
    @endif
    <div class="video-section-bg">
      <br>
      <div class="container">
        <?php
        if ($galleryvideos && count($galleryvideos->toArray()) > 0) { ?>
          <?php foreach ($galleryvideos as $single) {


          
            ?>
            <div class="row">
              <div class="col-md-6">
                <h3 class="titlefontfamily galleryvideotitle video_title_{{$single->id}}"><?= $single->text ?></h3>
                <p class="galleryvideodesc video_desc_{{$single->id}}"> <?= htmlspecialchars_decode($single->desc, ENT_QUOTES) ?></p>
                @if($single->read_more_desc && strip_tags($single->read_more_desc)!='')
                    <div  class="video_desc_{{$single->id}}">
                      <div class="read_more_link read_more_link_<?=$single->id?>" data-value="<?=$single->id?>" style="color:<?= $single->read_more_content_color && ($galleriesSettings->gallery_video_use_generic == '0') ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size && ($galleriesSettings->gallery_video_use_generic == '0')  ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_family && ($galleriesSettings->gallery_video_use_generic == '0')  ? 'font-family:' . getfontfamily($single->read_more_content_font_family). ';' : '' ?>">
                        <div class="" style="color:<?= $single->read_more_content_color ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_family). ';' : '' ?>">
                           <?=$single->read_more_text ? $single->read_more_text:'Read more' ?> <i class="fa fa-angle-down"></i>
                        </div>
                      </div>
                    
                      <div class="read_more_block_<?=$single->id?> video_desc_{{$single->id} }" style="display:none">
                       <?= $single->read_more_desc ?>
                      </div>
                      <div class="read_less_link read_less_link_<?=$single->id?>" data-value="<?=$single->id?>" style="display:none;color:<?= $single->read_more_content_color ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '' ?>;<?= $single->read_more_content_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_family). ';' : '' ?>">
                        <div class="video_desc_{{$single->id}}" >           
                          <div style="color:<?= $single->read_more_content_color ? $single->read_more_content_color : '' ?>;font-size:<?= $single->read_more_content_font_size ? $single->read_more_content_font_size . 'px' : '18px' ?>;<?= $single->read_more_content_font_family ? 'font-family:' . getfontfamily($single->read_more_content_font_family). ';' : '' ?>">
                            <?=$single->read_less_text? $single->read_less_text:'Read less' ?> <i class="fa fa-angle-up"></i>
                          </div>  
                        </div>
                      </div>
                    </div>
                    <br>
                  @endif
                <div >
                    <?php if ($single->action_button_active == '1') {
                      $input_link = '#';
                      $target = '';
                      $popupform = '';
                      $audioclass=''; $data_target="";
                      $data_toggle='';
                     $class='';
                      if ($single->action_button_link == 'link') {
                        $input_link = $single->action_button_link_text;
                        $target = "_blank";
                      }elseif ($single->action_button_link == 'customforms') {
                        $input_link = '#';
                        $target = "";
                        
                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($single->action_button_customform).'"';
    
                    }elseif($single->action_button_link == "video" ){
                      
                      $input_link = get_blog_image($single->action_button_video);
                      // $target = "_blank";
                      $data_target="#video_modal";
                      $data_toggle='modal';
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
                      }elseif($single->action_button_link == 'text_popup'){
                            
                        $input_link = '#' . $single->action_button_link;
                        ?>
                        <div style="display:none" id="actVidPopText<?=$single->id?>">
                            <?php echo $single->action_button_textpopup;?>
                        </div>
                        <?php 
                    }elseif($single->action_button_link == "google_map"){

                     
                        $address_full = isset($single->action_button_map_address ) ? $single->action_button_map_address: "";
                        $input_link = "http://maps.google.com/maps?q=".$address_full;
                        $target = "_blank";
                    
                    }elseif($single->action_button_link == "audioiconfeature" ){
    
                      if ( $single->action_button_audio_icon_feature) {?>  
                        <div class="action-audio" >                                  
                              <audio class="hidden" id="gallvidAudio_<?= $single->id ?>" controls>
                                  <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                  <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                  <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                              </audio>
                              </div>
                          <?php
                      }
                      $input_link = '#' . $single->action_button_audio_icon_feature;
                
                    }elseif($single->action_button_link == "address" ){

                      $address =  getaddress_info($single->action_button_address_id);
              
                      $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                      $input_link = "http://maps.google.com/maps?q=".$address_full;
                      $target = "_blank";
                  
                  }elseif(is_numeric($single->section)) {
                          $section = getSectionDetail($single->section);
                          $banner_input_href = '#' . $section->slug;
                          if($section->slug=='audiofeature'){
                            $audioclass='';
                        }
                      } else {
                        $input_link = '#' . $single->action_button_link;
                        if($single->action_button_link=='audiofeature'){
                          $audioclass='';
                          ?><div class="action-audio" > <?php

                          if ($single->action_button_action_audio) {?>   

                                    <audio class="hidden" id="galleryVideoAudio" controls>
                                        <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/mp3">
                                        <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/ogg">
                                        <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/mpeg">
                                    </audio>
                                    </div>
                                <?php
                            }
                        }else{
                          $class="menuitem";
                        }
                      }
                    ?>
                       @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) 
                          <span class="video_desc_icon_<?=$single->id?>" onclick="playPauseAudio('gallvidAudio_<?=$single->id ?>')" >
                              <span>
                              <i   class="fa fa-volume-up video_desc_icon_<?=$single->id?>" style="margin-top:6px;"  aria-hidden="true"></i>
                              </span>
                              <a href="<?= $input_link ?>" 
                              style="" class="btn btn-default mt-1 mb-1 text-bold new-action-btn video-action-{{$single->id}} {{$audioclass}}" style=""><?= $single->action_button_discription ?></a>
                              <div style="margin-top: -5px;">Click to hear Text</div>
                              <br>
                          </span>
                      @else 
                          <a href="<?= $input_link ?>" 
                          <?php if($single->action_button_link == 'text_popup'){ ?> 
                          onclick="openPopupText('actVidPopText<?=$single->id?>')" 
                          <?php }?>
                          id="<?= $single->id . 'videosect' ?>"
                          <?php if($single->action_button_link == "video"){?> 
                              data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                              onclick="openVideo('<?= $single->id . 'videosect' ?>')" 
                          <?php }?>
                            target="<?= $target ?>" <?= isset($single->action_button_action_audio)?'onclick=playPauseAudio("galleryVideoAudio")':'' ?> <?=$popupform?> class="btn btn-default mt-1 mb-1 text-bold new-action-btn video-action-{{$single->id}} {{$class}} {{$audioclass}}" style=""><?= $single->action_button_discription ?></a>
                            @if($single->action_button_link == "video")
                                <div style="margin-top: -4px;" class="video_desc_icon_<?=$single->id?>">Click to watch video</div>
                            @endif
                      @endif
                      
                    <?php } ?>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="item mb-10">
                  <video width='<?=  $galleriesSettings->gallery_video_size ? $galleriesSettings->gallery_video_size."px" :"100%"?>;' height="<?=  $galleriesSettings->gallery_video_size ? $galleriesSettings->gallery_video_size."px" :"400px"?>" class="videoplayer video-item-feature feature-video{{$single->id}}" muted controls <?php if ($single->video_auto_play == '1') {
                                                  echo 'autoplay';
                                                } ?>  <?php if ($single->video_repeat == '1') {
                                                  echo 'loop';
                                                } ?>  
                                                <?php if(!empty($single->video_image)){
                                                  ?>
                                                    poster="<?=url("assets/uploads/".get_current_url().$single->video_image)?>"
                                                  <?php 
                                                } ?>
                                                >
                    <source class="" src="<?= url("assets/uploads/".get_current_url().$single->video) ?>" type="video/mp4">
                    <source class="" src="movie.ogg" type="video/ogg">
                  </video>
                </div>
                <p class="galleryvideodesc video_desc_2_{{$single->id}}" ><?= nl2br(($single->desc_2)) ?></p>
                
               
    
              </div>
            </div>
            <br>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
@include('sections.videosection.scripts')
<?php } ?>