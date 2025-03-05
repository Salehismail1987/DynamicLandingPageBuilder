<?php

if($action_button->active=='1'){
    $class = '';
    $target = '';
    $popupform = '';
    $audioclass='';
    $data_toggle='';
    $data_target='';
    $banner_input_href='';
    $uid = uniqid();
    if ($action_button->action_type == 'link') {
        $banner_input_href = $action_button->link;
        $target = "_blank";
    } elseif ($action_button->action_type == 'customforms') {
        $banner_input_href = '#';
        $target = "";
        $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($action_button->custom_form_id).'"';

    }elseif($action_button->action_type == "video" ){
    
                      
        $banner_input_href = get_blog_image($action_button->action_button_video);
        // $target = "_blank";
        $data_target="#video_modal";
        $data_toggle='modal';
      } elseif($action_button->action_type == "audioiconfeature" ){
    
        if ( $action_button->action_button_audio_icon_feature) {?>  
          <div class="action-audio" >                                  
                <audio class="hidden" id="actbtnAudio_<?= $action_button->id ?>" controls>
                    <source src="<?= url('assets/uploads/' .get_current_url(). $action_button->action_button_audio_icon_feature) ?>" type="audio/mp3">
                    <source src="<?= url('assets/uploads/' .get_current_url(). $action_button->action_button_audio_icon_feature) ?>" type="audio/ogg">
                    <source src="<?= url('assets/uploads/' .get_current_url(). $action_button->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                </audio>
                </div>
            <?php
        }
        $banner_input_href = '#';
  
    }elseif($action_button->action_type == 'text_popup'){
                            
        $banner_input_href = '#' . $action_button->action_type;
        ?>
        <div style="display:none" id="actButtonText<?=$action_button->id?>"><?php echo $action_button->action_button_textpopup;?></div>
        <?php 
    }elseif($action_button->action_type == "google_map"){
        
            $address_full = isset($action_button->map_address ) ? $action_button->map_address: "";
            $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
            $target = "_blank";
        }elseif($action_button->action_type == "address" ){

        $address =  getaddress_info($action_button->address_id);
        
            $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
            $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
            $target = "_blank";
        }elseif ($action_button->action_type == 'call' || $action_button->action_type == 'sms' || $action_button->action_type == 'email') {

        switch ($action_button->action_type) {
            case 'sms':
                $banner_input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $action_button->action_button_phone_no_sms));
                break;
            case 'call':
                $banner_input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $action_button->action_button_phone_no_calls));
                break;
            case 'email':
                $banner_input_href = 'mailto:' . $action_button->action_button_action_email;
                break;
        }
    } else {
        $banner_input_href = '#' . $action_button->action_type;
        if($action_button->action_type=='audiofeature'){
                $audioclass='';
               
                if ($action_button->action_button_audio) {?> 
                 <div class="action-audio" >                                   
                <audio class="hidden" id="<?= $action_button->slug.'-'.$uid ?>" controls>
                    <source src="<?= url('assets/uploads/' .get_current_url(). $action_button->action_button_audio) ?>" type="audio/mp3">
                    <source src="<?= url('assets/uploads/'.get_current_url() . $action_button->action_button_audio) ?>" type="audio/ogg">
                    <source src="<?= url('assets/uploads/'.get_current_url() . $action_button->action_button_audio) ?>" type="audio/mpeg">
                </audio>
                </div>
            <?php 
            } 
        }

        $class = 'menuitem';
    }
    ?>
   
   
    @if(isset($action_button_text->text))
        <!-- (Hassan) Add padding -->
        @if($action_button->action_type == "audioiconfeature" && isset($action_button->action_button_audio_icon_feature))
            <span  onclick="playPauseAudio('actbtnAudio_<?=$action_button->id ?>')" style="<?= $action_button_text->color ? 'color:' . $action_button_text->color . ';' : '' ?> ">
                <span>
                <i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i>
                </span>
                <a href="<?= $banner_input_href ?>"  class="mybtn-primary {{$action_button_text->slug}} mb-10 {{$class}} {{$audioclass}}"><?= $action_button_text->text ?></a><br>
                <div style="margin-top: -5px;">Click to hear Text</div>
                <br>
            </span>
        @else 
        <a href="<?= $banner_input_href ?>" target="<?= $target ?>" 
        id="<?=  $action_button->slug. 'actionBtn' ?>"
                    <?php if($action_button->action_type == 'text_popup'){ ?> onclick="openPopupText('actButtonText<?=$action_button->id?>')" <?php }?>
                                <?php if($action_button->action_type == "video"){?>  data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?=  $action_button->slug . 'actionBtn' ?>')" <?php }?>
        <?= isset($action_button->action_button_audio)?'onclick=playPauseAudio("'.$action_button->slug.'-'.$uid.'")':'' ?> <?=$popupform?> class="mybtn-primary {{$action_button_text->slug}} mb-10 {{$class}} {{$audioclass}}" style=''>
            <?= $action_button_text->text ?>  
        </a>
            @if($action_button->action_type == "video")
            <div style="margin-top: -4px;font-size: 14px;<?= $action_button_text->color ? 'color:' . $action_button_text->color . ';' : '' ?> " class="">Click to watch video</div>
            @endif
        @endif
    @else 
        @if(isset($action_button->text)) 
            @if($action_button->action_type == "audioiconfeature" && isset($action_button->action_button_audio_icon_feature))
                <span  onclick="playPauseAudio('actbtnAudio_<?=$action_button->id ?>')" >
                    <span>
                    <i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i>
                    </span>
                    <a href="<?= $banner_input_href ?>"  class="mybtn-primary {{$action_button->slug}} mb-10 {{$class}} {{$audioclass}}"><?= $action_button->text ?></a><br>
                    <div style="margin-top: -5px;">Click to hear Text</div>
                    <br>
                </span>
            @else 

                <!-- (Hassan) Add padding -->
                <a href="<?= $banner_input_href ?>" target="<?= $target ?>" 
                id="<?=  $action_button->slug. 'actionBtn' ?>"
                <?php if($action_button->action_type == 'text_popup'){ ?> onclick="openPopupText('actButtonText<?=$action_button->id?>')" <?php }?>
                                    <?php if($action_button->action_type == "video"){?>  data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?=  $action_button->slug. 'actionBtn' ?>')" <?php }?>
                <?= isset($action_button->action_button_audio)?'onclick=playPauseAudio("'.$action_button->slug.'-'.$uid.'")':'' ?> <?=$popupform?> class="mybtn-primary {{$action_button->slug}} mb-10 {{$class}} {{$audioclass}}" style=''>
                    <?= $action_button->text ?>        
                </a> 
                @if($action_button->action_type == "video")
                <div style="margin-top: -4px;font-size: 14px;" class="">Click to watch video</div>
                @endif
            @endif
        @endif
    @endif
<?php } ?>
      
   