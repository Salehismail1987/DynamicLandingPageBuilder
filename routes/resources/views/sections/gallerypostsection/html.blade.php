<?php 
$setting = $frontSections->where('slug','gallerypostsection')->first();
if($gallery_posts_title->enable=='1' || isset($_GET['editwebsite']) || ($home_data_gallery_posts && count($home_data_gallery_posts->toArray()) > 0)){ ?>
@include('sections.gallerypostsection.styles')
<div id="gallerypostsection">
    
    <?php if($gallery_posts_title->enable=='1'){ ?>
        <div class="position-relative title_banners_outline" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=gallery_post_title'/>
                    </div>
            </div>
        @endif
            <<?= $gallery_posts_title->tag ?> class="titlefontfamily gallerypoststitle {{$gallery_posts_title->slug}}" style="">
                <?= $gallery_posts_title->text ?>
            </<?= $gallery_posts_title->tag ?>>
        </div>
    <?php } ?>
    <?php 

    ?>
    <div class="position-relative gallery_post_outline" >
    @if(isset($_GET['editwebsite']))
        <div class="">
            <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                <div class="d-flex align-items-center">
                    <!-- <div class="title-2">Alert Banner</div> -->
                    <x-tutorial-action-buttons  title='Gallery Post' :buttons="isset($tutorial_action_buttons['gallery_posts']) ? $tutorial_action_buttons['gallery_posts']:'' " url='galleries?block=gallery_post_bluebar' :status="$setting->section_enabled"/>
                </div>
                <!-- <img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon"> -->
            <!-- </a> -->
        </div>
    @endif
        <div class="gallery_posts_bg">

        <br>
            <div class="container">

                <?php $postscript = '';
                if ($home_data_gallery_posts && count($home_data_gallery_posts->toArray()) > 0) { ?>
                    <?php
                    $interval = 3000;
                    foreach ($home_data_gallery_posts as $single) {
                       
                                    
                                        
                                    
                                    
                                    
                        $post_iamges = getpostimages($single->id);

                        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                    ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 id="galleryposttitle<?= $single->id ?>" class="titlefontfamily galleryposttitle">
                                        <?= $single->post_title ?></h3>
                                        
                                    <?php 
                                    $contentcolumn = 'col-sm-12 pr-0';
                                    if(isset($single->post_desc_1) && $single->post_desc_1!="") {
                                        $contentcolumn = 'col-sm-6';
                                    }
                                    if(isset($single->post_desc_2) && $single->post_desc_2!="") {
                                        $contentcolumn = 'col-sm-4';
                                    }
                                    if(isset($single->post_desc_3) && $single->post_desc_3!="") {
                                        $contentcolumn = 'col-sm-3';
                                    }
                                    ?>  
                                    <div class="<?=$contentcolumn?> pl-0  pr-0">
                                        <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc)) ?>
                                            @if($single->read_more_desc && strip_tags($single->read_more_desc)!='')
                                                <div  class="gallery-post-desc-div-{{$single->id}}">
                                                <div class="read_more_link read_more_link_<?=$single->id?>" data-value="<?=$single->id?>">
                                                    <div class="">
                                                    <?=$single->read_more_text ? $single->read_more_text:'Read more' ?> <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>
                                                
                                                <div class="read_more_block_<?=$single->id?> gallery-post-desc-div-{{$single->id}}" style="display:none">
                                                <?= $single->read_more_desc ?>
                                                </div>
                                                <div class="read_less_link read_less_link_<?=$single->id?>" data-value="<?=$single->id?>" style="display:none">
                                                    <div class="gallery-post-desc-div-{{$single->id}}">           
                                                    <?=$single->read_less_text? $single->read_less_text:'Read less' ?> <i class="fa fa-angle-up"></i>
                                                    </div>
                                                </div>
                                                </div>
                                                <br>
                                            @endif
                                            <div style="text-align: left;padding-left:0.7rem;">
                                        <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                                            $input_link = '#';
                                            $popupform='';
                                            $target = '';
                                            $audioclass='';
                                            $data_target="";
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
                                            }elseif( $single->action_button_link == "google_map"){

                                                $address_full = isset($single->action_button_map_address ) ? $single->action_button_map_address: "";
                                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                $target = "_blank";
                                            
                                            }elseif($single->action_button_link == "audioiconfeature" ){
    
                                                if ( $single->action_button_audio_icon_feature) {?>  
                                                  <div class="action-audio" >                                  
                                                        <audio class="hidden" id="gallpostAudio_<?= $single->id ?>" controls>
                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                                        </audio>
                                                        </div>
                                                    <?php
                                                }
                                                $input_link = '#' . $single->action_button_audio_icon_feature;
                                          
                                              } elseif($single->action_button_link == "address"  ){

                                                $address =  getaddress_info($single->action_button_address_id);
                                        
                                                $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                                $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                $target = "_blank";
                                            
                                            }elseif($single->action_button_link == 'text_popup'){
                            
                                                $input_link = '#' . $single->action_button_link;
                                                ?>
                                                <div style="display:none" id="actPostPopupText<?=$single->id?>">
                                                    <?php echo $single->action_button_textpopup;?>
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
                                            } else {
                                                if($single->action_button_link=='audiofeature'){
                                                    $audioclass='';
                                                    ?><div class="action-audio" > <?php
                                                    if ( $single->action_button_action_audio) {?>                                    
                                                                    <audio class="hidden" id="galleryPostAudio" controls>
                                                                        <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/mp3">
                                                                        <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/ogg">
                                                                        <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_action_audio) ?>" type="audio/mpeg">
                                                                    </audio>
                                                                    </div>
                                                                <?php
                                                            }
                                                }else{
                                                    $class = 'menuitem';
                                                }
                                                
                                            $input_link = '#' . $single->action_button_link;
                                            }
                                        ?>
                                        @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) 
                                            <span class="descpostgall_icon_<?= $single->id ?>" onclick="playPauseAudio('gallpostAudio_<?=$single->id ?>')" >
                                                <span>
                                                <i   class="fa fa-volume-up descpostgall_icon_<?= $single->id ?>" style="margin-top:6px;"  aria-hidden="true"></i>
                                                </span>
                                                <a href="<?= $input_link ?>" 
                                                style="" class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$audioclass}} " style=""><?= $single->action_button_discription ?></a>
                                                <div style="margin-top: -5px;">Click to hear Text</div>
                                                <br>
                                            </span>
                                        @else 
                                            <a href="<?= $input_link ?>" 
                                            id="<?= $single->id . 'gallerypostbtn' ?>"
                                        
                                            <?php if($single->action_button_link == 'text_popup'){ ?> 
                                            onclick="openPopupText('actPostPopupText<?=$single->id?>')" 
                                            <?php }?>

                                            <?php if($single->action_button_link == "video"){?>  
                                                data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                                onclick="openVideo('<?= $single->id . 'gallerypostbtn' ?>')" <?php }?>
                                            
                                            
                                            <?= isset($single->action_button_action_audio)?'onclick=playPauseAudio("galleryPostAudio")':'' ?> target="<?= $target ?>" <?=$popupform?> class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$class}} {{$audioclass}}" ><?= $single->action_button_discription ?></a>
                                            @if($single->action_button_link == "video")
                                                <div style="margin-top: -4px;" class="descpostgall_icon_<?= $single->id ?>">Click to watch video</div>
                                            @endif
                                        @endif
                                        <?php } ?>
                                    </div>
                                        </div>
                                    </div>
                                    <?php if(isset($single->post_desc_1) && $single->post_desc_1!="") { ?>
                                        <div class="<?=$contentcolumn?> pr-0">
                                            <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_1)) ?></div>
                                        </div>
                                    <?php }  ?>
                                    <?php if(isset($single->post_desc_2) && $single->post_desc_2!="") { ?>
                                        <div class="<?=$contentcolumn?> pr-0">
                                            <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_2)) ?></div>
                                        </div>
                                    <?php }  ?>
                                    <?php if(isset($single->post_desc_3) && $single->post_desc_3!="") { ?>
                                            <div class="<?=$contentcolumn?> pr-0">
                                            <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_3)) ?></div>
                                            </div>
                                    <?php }  ?>
                                    
                                   
                                   
               
                                </div>
                                <div class="col-md-6">
                                    <?php if ($post_iamges && count($post_iamges) > 0) { ?>
                                        <div id="myCarouselpost<?= $single->id ?>" class="carousel slide gallery_post_slider_container" data-ride="carousel" <?php if($galleriesSettings->gallery_post_autoplay=='0'){ ?>data-interval="false"<?php }else{?> data-interval="<?= $interval ?>" <?php } ?>>
                                            <div class="carousel-inner">
                                                <?php $active = 'active'; ?>
                                                <?php foreach ($post_iamges as $singleimg) { ?>
                                                    <div class="item <?php if ($active) {
                                                                            echo $active;
                                                                            $active = '';
                                                                        } ?>">
                                                        <img class="lazyload post_image_{{$singleimg->id}}" data-src="<?= url('assets/uploads/'.get_current_url() . $singleimg->image) ?>" alt="<?= $single->post_title ?>" 
                                                        <?php 
                                                        if(isset($single->post_image_size) && !empty($single->post_image_size)){
                                                            ?>
                                                            
                                                                style="width:<?=$single->post_image_size?>px;height:<?=$single->post_image_size?>px"
                                                            <?php 
                                                        }else{
                                                            ?>
                                                            
                                                            style="width:100%;"
                                                            <?php 
                                                        }
                                                        ?>
                                                        
                                                        >
                                                    </div>
                                                    
                                                <?php } ?>
                                                @if($galleriesSettings->gallery_post_autoplay=='0')
                                                  <!-- Left and right controls -->
                                                <a class="left carousel-control" href="#myCarouselpost<?= $single->id ?>" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control " href="#myCarouselpost<?= $single->id ?>" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    <?php
                                        $postscript .= "<script>
                            $( document ).ready(function() {
                                $('#myCarouselpost" . $single->id . "').carousel({
                                pause: 'none'
                                });
                            });
                        </script>";
                                    } ?>

                                  

                                    @if($single->gallery_post_fixed_description)
                                        <div class="mt-4">
                                            <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc" >
                                                <?= nl2br(($single->gallery_post_fixed_description)) ?>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                        <?php
                        } else {
                            $gallery_post_slider_image_right="";
                        if ($single->post_title_left_right == '0') { 
                            $gallery_post_slider_image_right = "gallery_post_slider_image_right";
                        } else
                        {
                            $gallery_post_slider_image_right = "gallery_post_slider_image_left";
                        }
                        ?>
                            <div class="row">
                                <?php if ($single->post_title_left_right == '0') { ?>
                                    <div class="col-md-6">
                                        <h3 id="galleryposttitle<?= $single->id ?>" class="titlefontfamily galleryposttitle">
                                            <?= $single->post_title ?></h3>
                                            
                                                <?php 
                                                $contentcolumn = 'col-sm-12 pr-0';
                                                if(isset($single->post_desc_1) && $single->post_desc_1!="") {
                                                    $contentcolumn = 'col-sm-6';
                                                }
                                                if(isset($single->post_desc_2) && $single->post_desc_2!="") {
                                                    $contentcolumn = 'col-sm-4';
                                                }
                                                if(isset($single->post_desc_3) && $single->post_desc_3!="") {
                                                    $contentcolumn = 'col-sm-3';
                                                }
                                                ?>  
                                                <div class="<?=$contentcolumn?> pl-0  pr-0">
                                                    <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc)) ?>
                                                        @if($single->read_more_desc && strip_tags($single->read_more_desc)!='')
                                                            <div  class="gallery-post-desc-div-{{$single->id}}">
                                                            <div class="read_more_link read_more_link_<?=$single->id?>" data-value="<?=$single->id?>">
                                                                <div class="">
                                                                <?=$single->read_more_text ? $single->read_more_text:'Read more' ?> <i class="fa fa-angle-down"></i>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="read_more_block_<?=$single->id?> gallery-post-desc-div-{{$single->id}}" style="display:none">
                                                            <?= $single->read_more_desc ?>
                                                            </div>
                                                            <div class="read_less_link read_less_link_<?=$single->id?>" data-value="<?=$single->id?>" style="display:none">
                                                                <div class="gallery-post-desc-div-{{$single->id}}">           
                                                                <?=$single->read_less_text? $single->read_less_text:'Read less' ?> <i class="fa fa-angle-up"></i>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <br>
                                                        @endif
                                                        <div style="text-align: left; padding-left: 0.7rem;">
                                                <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                                                    $input_link = '#';
                                                    $popupform='';
                                                    $target = '';
                                                    $audioclass='';
                                                    $data_target="";
                                                    $data_toggle='';
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
                                                    }elseif($single->action_button_link == "audioiconfeature" ){
        
                                                        if ( $single->action_button_audio_icon_feature) {?>  
                                                        <div class="action-audio" >                                  
                                                                <audio class="hidden" id="gallpostAudio_<?= $single->id ?>" controls>
                                                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                                                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                                                </audio>
                                                                </div>
                                                            <?php
                                                        }
                                                        $input_link = '#' . $single->action_button_audio_icon_feature;
                                                
                                                    }elseif( $single->action_button_link == "google_map"){

                                                        $address_full = isset($single->action_button_map_address ) ? $single->action_button_map_address: "";
                                                        $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                        $target = "_blank";
                                                    
                                                    }elseif($single->action_button_link == 'text_popup'){
                            
                                                        $input_link = '#' . $single->action_button_link;
                                                        ?>
                                                        <div style="display:none" id="actPostPopupText<?=$single->id?>">
                                                            <?php echo $single->action_button_textpopup;?>
                                                        </div>
                                                        <?php 
                                                    }elseif($single->action_button_link == "address" ){

                                                        $address =  getaddress_info($single->action_button_address_id);
                                                
                                                        $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                                        $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                        $target = "_blank";
                                                    
                                                    }elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


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
                                                        if($single->action_button_link=='audiofeature'){
                                                            $audioclass='';
                                                            ?><div class="action-audio" > <?php
                                                        if ( $single->action_button_action_audio) {?>                                    
                                                                        <audio class="hidden" id="galleryPostAudio" controls>
                                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/mp3">
                                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/ogg">
                                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/mpeg">
                                                                        </audio>
                                                                        </div>
                                                                    <?php
                                                                }
                                                        }
                                                    $input_link = '#' . $single->action_button_link;
                                                    }
                                                ?>
                                                @if($single->action_button_link == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) 
                                                    <span class="descpostgall_icon_<?= $single->id ?>" onclick="playPauseAudio('gallpostAudio_<?=$single->id ?>')" >
                                                        <span>
                                                        <i   class="fa fa-volume-up descpostgall_icon_<?= $single->id ?>" style="margin-top:6px;"  aria-hidden="true"></i>
                                                        </span>
                                                        <a href="<?= $input_link ?>" 
                                                        style="" class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$audioclass}} " style=""><?= $single->action_button_discription ?></a>
                                                        <div style="margin-top: -5px;">Click to hear Text</div>
                                                        <br>
                                                    </span>
                                                @else 
                                                    <a href="<?= $input_link ?>" 
                                                    id="<?= $single->id . 'gallerypostbtn' ?>"
                                                
                                                    <?php if($single->action_button_link == 'text_popup'){ ?> 
                                                    onclick="openPopupText('actPostPopupText<?=$single->id?>')" 
                                                    <?php }?>
                                                    
                                                    <?php if($single->action_button_link == "video"){?>  
                                                        data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                                        onclick="openVideo('<?= $single->id . 'gallerypostbtn' ?>')" <?php }?>
                                                    
                                                    
                                                    <?= isset($single->action_button_action_audio)?'onclick=playPauseAudio("galleryPostAudio")':'' ?> target="<?= $target ?>" <?=$popupform?> class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$audioclass}}" ><?= $single->action_button_discription ?></a>
                                                    @if($single->action_button_link == "video")
                                                        <div style="margin-top: -4px;" class="descpostgall_icon_<?= $single->id ?>">Click to watch video</div>
                                                    @endif
                                                @endif
                                                <?php } ?>
                                            </div>
                                                    </div>
                                                </div>
                                                <?php if(isset($single->post_desc_1) && $single->post_desc_1!="") { ?>
                                                    <div class="<?=$contentcolumn?> pr-0">
                                                        <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_1)) ?></div>
                                                    </div>
                                                <?php }  ?>
                                                <?php if(isset($single->post_desc_2) && $single->post_desc_2!="") { ?>
                                                    <div class="<?=$contentcolumn?> pr-0">
                                                        <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_2)) ?></div>
                                                    </div>
                                                <?php }  ?>
                                                <?php if(isset($single->post_desc_3) && $single->post_desc_3!="") { ?>
                                                        <div class="<?=$contentcolumn?> pr-0">
                                                        <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_3)) ?></div>
                                                        </div>
                                                <?php }  ?>
                                               

                                           
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <?php if ($post_iamges && count($post_iamges) > 0) { ?>
                                        <div id="myCarouselpost<?= $single->id ?>" class="carousel slide gallery_post_slider_container" data-ride="carousel" <?php if($galleriesSettings->gallery_post_autoplay=='0'){ ?>data-interval="false"<?php }else{?> data-interval="<?= $interval ?>" <?php } ?>>
                                            <div class="carousel-inner">
                                                <?php $active = 'active'; ?>
                                                <?php foreach ($post_iamges as $singleimg) { ?>
                                                    <div class="item <?php if ($active) {
                                                                            echo $active;
                                                                            $active = '';
                                                                        } ?>">
                                                        <img class="lazyload <?=$gallery_post_slider_image_right ?>" data-src="<?= base_url('assets/uploads/'.get_current_url() . $singleimg->image) ?>" alt="<?= $single->gallery_post_title ?>" 
                                                        <?php 
                                                        if(isset($single->post_image_size) && !empty($single->post_image_size) && $single->post_image_size < 400){
                                                            ?>
                                                            
                                                                style="width:<?=$single->post_image_size?>px;"
                                                            <?php 
                                                        }else if(!isset($single->post_image_size) || empty($single->post_image_size) || $single->post_image_size > 400){
                                                            ?>
                                                            
                                                            style="width:83%;"
                                                            <?php 
                                                        }
                                                        ?>
                                                        
                                                        >
                                                    </div>
                                                <?php } ?>
                                                @if($galleriesSettings->gallery_post_autoplay=='0')
                                                  <!-- Left and right controls -->
                                                <a class="left carousel-control" href="#myCarouselpost<?= $single->id ?>" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control " href="#myCarouselpost<?= $single->id ?>" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    <?php
                                        $postscript .= "<script>
                            $( document ).ready(function() {
                                $('#myCarouselpost" . $single->id . "').carousel({
                                pause: 'none'
                                });
                            });
                        </script>";
                                    } ?>
                                    @if($single->gallery_post_fixed_description && $single->gallery_post_fixed_description != '')
                                        <div class="mt-4">
                                            <div id="gallerypostdesctxt<?= $single->id ?>" class="gallerypostdesctxt" >
                                                <?= nl2br(($single->gallery_post_fixed_description)) ?>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <?php if ($single->post_title_left_right == '1') { ?>
                                    <div class="col-md-6">
                                        <h3 id="galleryposttitle<?= $single->id ?>" class="titlefontfamily galleryposttitle">
                                            <?= $single->post_title ?></h3>
                                            
                                            <?php 
                                            $contentcolumn = 'col-sm-12 pr-0';
                                            if(isset($single->post_desc_1) && $single->post_desc_1!="") {
                                                $contentcolumn = 'col-sm-6';
                                            }
                                            if(isset($single->post_desc_2) && $single->post_desc_2!="") {
                                                $contentcolumn = 'col-sm-4';
                                            }
                                            if(isset($single->post_desc_3) && $single->post_desc_3!="") {
                                                $contentcolumn = 'col-sm-3';
                                            }
                                            ?>  
                                            <div class="<?=$contentcolumn?> pl-0  pr-0">
                                                <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc)) ?>
                                                @if($single->read_more_desc && strip_tags($single->read_more_desc)!='')
                                                    <div  class="gallery-post-desc-div-{{$single->id}}">
                                                    <div class="read_more_link read_more_link_<?=$single->id?>" data-value="<?=$single->id?>">
                                                        <div class="">
                                                        <?=$single->read_more_text ? $single->read_more_text:'Read more' ?> <i class="fa fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="read_more_block_<?=$single->id?> gallery-post-desc-div-{{$single->id}}" style="display:none">
                                                    <?= $single->read_more_desc ?>
                                                    </div>
                                                    <div class="read_less_link read_less_link_<?=$single->id?>" data-value="<?=$single->id?>" style="display:none">
                                                        <div class="gallery-post-desc-div-{{$single->id}}">           
                                                        <?=$single->read_less_text? $single->read_less_text:'Read less' ?> <i class="fa fa-angle-up"></i>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <br>
                                                @endif
                                                <div style="    padding-left: 0.7rem;padding-left:0.7rem;">
                                            <?php if (isset($single->action_button_active) && $single->action_button_active == '1') {
                                                $input_link = '#';
                                                $target = '';
                                                $popupform='';
                                                $audioclass='';
                                                $data_target="";
                                                $class='';
                                                $data_toggle='';
                                                if ($single->action_button_link == 'link') {
                                                    $input_link = $single->action_button_link_text;
                                                    $target = "_blank";
                                                
                                                }elseif ($single->action_button_link == 'customforms') {
                                                    $input_link = '#';
                                                    $target = "";
                                                    
                                                    $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($single->action_button_customform).'"';
                
                                                }elseif($single->action_button_link == "audioiconfeature" ){
        
                                                    if ( $single->action_button_audio_icon_feature) {?>  
                                                    <div class="action-audio" >                                  
                                                            <audio class="hidden" id="gallpostAudio_<?= $single->id ?>" controls>
                                                                <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                                                <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                                                <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                                            </audio>
                                                            </div>
                                                        <?php
                                                    }
                                                    $input_link = '#' . $single->action_button_audio_icon_feature;
                                            
                                                }elseif( $single->action_button_link == "google_map"){

                                                    $address_full = isset($single->action_button_map_address ) ? $single->action_button_map_address: "";
                                                    $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                    $target = "_blank";
                                                
                                                }elseif($single->action_button_link == 'text_popup'){
                            
                                                    $input_link = '#' . $single->action_button_link;
                                                    ?>
                                                    <div style="display:none" id="actPostPopupText<?=$single->id?>">
                                                        <?php echo $single->action_button_textpopup;?>
                                                    </div>
                                                    <?php 
                                                }elseif($single->action_button_link == "address" ){

                                                    $address =  getaddress_info($single->action_button_address_id);
                                            
                                                    $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                                    $input_link = "http://maps.google.com/maps?q=".$address_full;
                                                    $target = "_blank";
                                                
                                                }elseif($single->action_button_link == "video" ){
        
                        
                                                    $input_link = get_blog_image($single->action_button_video);
                                                    // $target = "_blank";
                                                    $data_target="#video_modal";
                                                    $data_toggle='modal';
                                                }elseif ($single->action_button_link == 'call' || $single->action_button_link == 'sms' || $single->action_button_link == 'email') {


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
                                                } else {
                                                    $input_link = '#' . $single->action_button_link;
                                                    if($single->action_button_link=='audiofeature'){
                                                        $audioclass='';
                                                        ?><div class="action-audio" > <?php
                                                        if ( $single->action_button_action_audio) {?>                                    
                                                                        <audio class="hidden" id="galleryPostAudio" controls>
                                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/mp3">
                                                                            <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_action_audio) ?>" type="audio/ogg">
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
                                                <span class="descpostgall_icon_<?= $single->id ?>" onclick="playPauseAudio('gallpostAudio_<?=$single->id ?>')" >
                                                    <span>
                                                    <i   class="fa fa-volume-up descpostgall_icon_<?= $single->id ?>" style="margin-top:6px;"  aria-hidden="true"></i>
                                                    </span>
                                                    <a href="<?= $input_link ?>" 
                                                    style="" class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$audioclass}} " style=""><?= $single->action_button_discription ?></a>
                                                    <div style="margin-top: -5px;">Click to hear Text</div>
                                                    <br>
                                                </span>
                                            @else 
                                                <a href="<?= $input_link ?>" 
                                                id="<?= $single->id . 'gallerypostbtn' ?>"
                                            
                                                <?php if($single->action_button_link == 'text_popup'){ ?> 
                                                onclick="openPopupText('actPostPopupText<?=$single->id?>')" 
                                                <?php }?>

                                                <?php if($single->action_button_link == "video"){?>  
                                                    data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                                    onclick="openVideo('<?= $single->id . 'gallerypostbtn' ?>')" <?php }?>
                                                
                                                
                                                <?= isset($single->action_button_action_audio)?'onclick=playPauseAudio("galleryPostAudio")':'' ?> target="<?= $target ?>" <?=$popupform?> class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$single->id}} {{$class}} {{$audioclass}}" ><?= $single->action_button_discription ?></a>
                                                @if($single->action_button_link == "video")
                                                    <div style="margin-top: -4px;" class="descpostgall_icon_<?= $single->id ?>">Click to watch video</div>
                                                @endif
                                            @endif
                                        <?php } ?>
                                        </div>
                                            </div>
                                            </div>
                                            <?php if(isset($single->post_desc_1) && $single->post_desc_1!="") { ?>
                                                <div class="<?=$contentcolumn?> pr-0">
                                                    <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_1)) ?></div>
                                                </div>
                                            <?php }  ?>
                                            <?php if(isset($single->post_desc_2) && $single->post_desc_2!="") { ?>
                                                <div class="<?=$contentcolumn?> pr-0">
                                                    <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_2)) ?></div>
                                                </div>
                                            <?php }  ?>
                                            <?php if(isset($single->post_desc_3) && $single->post_desc_3!="") { ?>
                                                    <div class="<?=$contentcolumn?> pr-0">
                                                    <div id="gallerypostdesc<?= $single->id ?>" class="gallerypostdesc"><?= nl2br(($single->post_desc_3)) ?></div>
                                                    </div>
                                            <?php }  ?>

                                          
                                       
                                    </div>
                                <?php } ?>
                            </div>
                        <?php
                        }
                        ?>

                        <br>
                    <?php
                        $interval = $interval + 500;
                    } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@include('sections.gallerypostsection.scripts')
                <?php } ?>