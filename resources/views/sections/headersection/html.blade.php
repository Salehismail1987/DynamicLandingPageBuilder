@php
$slider_setting = $frontSections->where('slug','headerslider')->first();
$header_setting = $frontSections->where('slug','headersection')->first();
@endphp
@include('sections.headersection.styles')
<div id="headersection">
    <?php if ($siteSettings->alternate_horizontal == '1') { ?>
        <div class="">
            <section id="hero" class="d-flex0 align-items-center0 nopadding header-bg" >

                @if ($navBarSettings->enable=='1')
    
                    <div class="nav_bar_outline my-nav-bar-div" >
                    
                    <div class="container">
                        <div class="h-40px ">
                            <div class="my-nav-bar">
                            @if(isset($_GET['editwebsite']))
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons  title='Nav bar' :buttons="isset($tutorial_action_buttons['navbar']) ? $tutorial_action_buttons['navbar']:'' " url='settings?block=nav_bar_bluebar' :status="$navBarSettings->enable"/>
                                </div>
                            </div>
                            @endif
                                <ul>
                                    @foreach ($navBarItems as $navBarItem)
                                        <?php 
                                            $class = '';
                                            $target = '';
                                            $popupform = '';
                                            $audioclass='';
                                            $data_toggle='';
                                            $data_target='';
                                            if ($navBarItem->link_type == 'link') {
                                                $banner_input_href = $navBarItem->link_url;
                                                $target = "_blank";
                                            } elseif ($navBarItem->link_type == 'customforms') {
                                                $banner_input_href = '#';
                                                $target = "";
                                                $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($navBarItem->custom_form).'"';
                                            } elseif( $navBarItem->link_type == "google_map"){
                                        
                                                    $address_full = isset($navBarItem->map_address ) ? $navBarItem->map_address: "";
                                                    $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
                                                    $target = "_blank";
                                                }elseif($navBarItem->link_type == 'text_popup'){
                            
                                                    $banner_input_href = '#' . $navBarItem->link_type;
                                                    ?>
                                                    <div style="display:none" id="actnavText<?=$navBarItem->id?>">
                                                        <?php echo $navBarItem->action_button_textpopup;?>
                                                    </div>
                                                    <?php 
                                                }elseif($navBarItem->link_type == "address"  ){
                                        
                                                $address =  getaddress_info($navBarItem->address_id);
                                                    $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                                    $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
                                                    $target = "_blank";
                                                }elseif ($navBarItem->link_type == 'call' || $navBarItem->link_type == 'sms' || $navBarItem->link_type == 'email') {
                                                    switch ($navBarItem->link_type) {
                                                        case 'sms':
                                                            $banner_input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $navBarItem->phone_no_sms));
                                                            break;
                                                        case 'call':
                                                            $banner_input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $navBarItem->phone_no_call));
                                                            break;
                                                        case 'email':
                                                            $banner_input_href = 'mailto:' . $navBarItem->email;
                                                            break;
                                                }
                                            } elseif($navBarItem->link_type == "video" ){
    
                      
                                                $banner_input_href = get_blog_image($navBarItem->action_button_video);
                                                // $target = "_blank";
                                                $data_target="#video_modal";
                                                $data_toggle='modal';
                                              }elseif(getSectionDetail($navBarItem->section)) {
                                                $section = getSectionDetail($navBarItem->section);
                                                $banner_input_href = '#' . (isset($section->slug) ? $section->slug:'');
                                                $class = 'menuitem';
                                                if(isset($section->slug) && $section->slug=='audiofeature'){
                                                    $audioclass='playaudiofile';
                                                }
                                            }  else {
                                                if($navBarItem->link_type=='audiofeature'){
                                                    $audioclass='playaudiofile';
                                                }
                                                $banner_input_href = '#' . $navBarItem->link_type;
                                            } 
                                        ?>
                                        <li>
                                            <a 
                                            id="<?= $navBarItem->id . 'navbarItemBtn' ?>"
                                            <?php if($navBarItem->link_type == 'text_popup'){ ?> 
                                            onclick="openPopupText('actnavText<?=$navBarItem->id?>')" 
                                            <?php }?>
                                            <?php if($navBarItem->link_type == "video"){?>    data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $navBarItem->id . 'navbarItemBtn' ?>')" <?php }?>
                                            
                                            href="<?= $banner_input_href ?>" target="<?= $target ?>" <?=$popupform?> class="my-nav-bar-item-{{$navBarItem->id}} {{$class}} {{ $audioclass}}" style=''>
                                                {{$navBarItem->text}} 
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="container-fluid nopadding" data-aos="zoom-out" data-aos-delay="100">
                    <div class="headerdiv" >
                        <div class="header-alternative-content" >
                            <div class="">
                                <div class="frame0">
                                      
                                    
                                    <div class="position-relative header_images_outline" >
                                        @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center logo-padding">
                                        <x-tutorial-action-buttons  title='Header Logo' :buttons="isset($tutorial_action_buttons['header_logo']) ? $tutorial_action_buttons['header_logo']:'' " url='quicksettings?block=header_images_bluebar&sb=header_logo_settings'/>
                                    </div>
                                </div>
                                @endif
                                        <?php
                                        if ($step_image = check_step_image('Header Logo')) {
                                        ?>
                                            <div class="vertical-center">
                                                <div class="outer2">
                                                    <div class="middle">
                                                        <div class="inner">
                                                            <img src="<?= url('assets/uploads/').get_current_url() .'/'. $step_image['image'] ?>" width="<?= $headerImages->header_logo_width ?>" alt="<?=!empty($step_image['text']) ? $step_image['text'] : $header_image_title_text->text?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (!empty($step_image['text'])) {
                                            ?>
                                                <p class='header-logo-p'  >
                                                    <?= nl2br($step_image['text']) ?>
                                                </p>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        } elseif (show_timed_image($timed_header_logo_setting->enable, $timed_header_logo->file_name, $timed_header_logo_setting->start_time, $timed_header_logo_setting->end_time,$timed_header_logo_setting->days, 'enable_timed_header_logo', 'timed_images', 1,$timed_header_logo_setting->type)) {
                                        ?>
                                            <div class="vertical-center">
                                                <div class="outer2">
                                                    <div class="middle">
                                                        <div class="inner">
                                                       
                                                            <img src="<?= url('assets/uploads/') .get_current_url(). '/'.$timed_header_logo->file_name ?>" width="<?= $timed_header_logo->max_width 
                                                            ? 
                                                            $timed_header_logo->max_width
                                                            :
                                                            $headerImages->header_logo_width ?>" alt="<?=$header_image_title_text->text?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } else {
                                            if ($headerImages->header_logo) { ?>
                                                <div class="vertical-center">
                                                    <div class="outer2">
                                                        <div class="middle">
                                                            <div class="inner">
                                                                <img src="<?= url('assets/uploads/').get_current_url() .'/'. $headerImages->header_logo ?>" width="<?= $headerImages->header_logo_width ?>" alt="<?=$header_image_title_text->text?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class=" pl-50" style="padding-top:1rem">
                                <div class="position-relative header_images_outline" >
                                @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <x-tutorial-action-buttons  title='Header Images' :buttons="isset($tutorial_action_buttons['header_images']) ? $tutorial_action_buttons['header_images']:'' " url='quicksettings?block=header_images_bluebar&sb=header_image_settings'/>
                                    </div>
                                </div>
                                @endif
                                <?php if ($header_image_title_text->text) { ?>
                                    <div class="titlefontfamily headertitle text-bold header_image_title_text"><a class="header_image_title_text"><?= $header_image_title_text->text ?></a>
                                    </div>
                                <?php } ?>
                                <?php if ($header_text_2->text) { ?>
                                    <div class="titlefontfamily headertitle text-bold"><a class="header_text_2"><?= $header_text_2->text ?></a>
                                    </div>
                                <?php } ?>
                                <?php
                                if ($step_image = check_step_image('Header Image Title')) {
                                ?>
                                    <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/').get_current_url() .'/'. $step_image['image'] ?>" width="<?= $headerImages->header_img_width ?>" alt="<?=!empty($step_image['text']) ? $step_image['text'] : $header_image_desc_text->text?>" >
                                    <?php
                                    if (!empty($step_image['text'])) {
                                    ?>
                                        <p class="haeder-image-title-p">
                                            <?= nl2br($step_image['text']) ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                if (show_timed_image($timed_header_image_setting->enable, $timed_header_image->file_name, $timed_header_image_setting->start_time, $timed_header_image_setting->end_time,$timed_header_image_setting->days, 'enable_timed_header_image', 'timed_images', 1,$timed_header_image_setting->type)) {
                                ?>
                                    <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/').get_current_url() .'/'. $timed_header_image->file_name ?>" width="<?= $timed_header_image->max_width ?>" alt="<?=$header_image_desc_text->text?>">
                                    <?php
                                } else {
                                    if ($headerImages->header_img) { ?>
                                        <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/').get_current_url() .'/'. $headerImages->header_img ?>" width="<?= $headerImages->header_img_width ?>" alt="<?=$header_image_desc_text->text?>">
                                <?php
                                    }
                                } ?>
                                <br>
                                <?php if ($header_image_desc_text->text) { ?>
                                    <p class="titlefontfamily headertitle  mb-2 {{$header_image_desc_text->slug}}" >
                                        <a <?php if ($header_image_desc_text->color) { ?>class='{{$header_image_desc_text->slug}}' <?php } ?>><?= nl2br(($header_image_desc_text->text)) ?></a>
                                    </p>
                                <?php } ?>
                                <?php if ($image_title_text_below_text->text) { ?>
                                    <p class="titlefontfamily headertitle  mb-2 {{$image_title_text_below_text->slug}}" >
                                        <a <?php if ($image_title_text_below_text->color) { ?>class='{{$image_title_text_below_text->slug}}' <?php } ?>><?= nl2br(($image_title_text_below_text->text)) ?></a>
                                    </p>
                                <?php } ?>
                                <?php if ($header_text->text) { ?>
                                    <h3 class="titlefontfamily headertitle mb-2 {{$header_text->slug}}" >
                                        <a <?php if ($header_text->color) { ?>style='color:<?= $header_text->color ?>' <?php } ?>><?= $header_text->text ?></a>
                                    </h3>
                                <?php } ?>
                                </div>
                            <div class="position-relative header_buttons_outline" >
                            @if(isset($_GET['editwebsite']))
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons  title='Header Buttons' :buttons="isset($tutorial_action_buttons['header_buttons']) ? $tutorial_action_buttons['header_buttons']:'' " url='quicksettings?block=action_btns_bluebar'/>
                                </div>
                            </div>
                            @endif
                                <?php if ($header_btn_1->text) {
                                    $input_link = '#';
                                    $target = '';
                                    $popupform = '';
                                    $data_target='';
                                    $data_toggle='';
                                    ?>
                                     @include('sections.common.action_button',['action_button'=>$header_btn_1,'action_button_text'=>[]])
                              
                                <?php } ?>
                                <?php if ($header_btn_2->text) {
                                    $input_link = '#';
                                    $target = '';
                                    $popupform = '';
                                    $data_target='';
                                    $data_toggle='';
                                    
                                ?>
                                    @include('sections.common.action_button',['action_button'=>$header_btn_2,'action_button_text'=>[]])
                                <?php } ?>
                                <br>
                                <?php if ($header_btn_3->text) {
                                    $input_link = '#';
                                    $target = '';
                                    $popupform = '';
                                    $data_target='';
                                    $data_toggle='';
                                   
                                ?>
                                    @include('sections.common.action_button',['action_button'=>$header_btn_3,'action_button_text'=>[]])
                                <?php } ?>
                            </div>
                                <div class="position-relative header_text_outline" >
                                @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <x-tutorial-action-buttons  title='Header Text' :buttons="isset($tutorial_action_buttons['header_text']) ? $tutorial_action_buttons['header_text']:'' " url='quicksettings?block=header_text_bluebar'/>
                                    </div>
                                </div>
                                @endif
                                    <?php if (isset($header_phone_text->text) && $header_phone_text->text) { ?>
                                        <div class="titlefontfamily headertitle">
                                            <?php if (isset($header_phone_title->text)) { ?>
                                                <div class="mb-0 text-bold header-phone-text {{$header_phone_title->slug}}" ><?= ($header_phone_title->text)?$header_phone_title->text:'' ?></div>
                                            <?php } ?>
                                            <h4>
                                                <a href="tel:<?= $header_phone_text->text ?>" class="<?= ($header_phone_text->slug)?>"><?= $header_phone_text->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                    <?php if ($header_phone_text_2->text) { ?>
                                        <div class="titlefontfamily headertitle text-bold">
                                            <?php if ($header_phonr_text_title->text) { ?>
                                                <h2 class="mb-0 text-bold <?= ($header_phonr_text_title->slug)?>" ><?= $header_phonr_text_title->text ?></h2>
                                            <?php } ?>
                                            <h4>
                                                <a href="sms:<?= $header_phone_text_2->text ?>" class="<?= ($header_phone_text_2->slug)?>"><?= $header_phone_text_2->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                    <?php if ($header_text_7_text->text) { ?>
                                        <div class="titlefontfamily headertitle">
                                            <?php if ($header_text_title->text) { ?>
                                                <h2 class="mb-0 text-bold" <?php if ($header_text_title->color) { ?>class='<?=$header_text_title->slug?>' <?php } ?>><?= $header_text_title->text ?></h2>
                                            <?php } ?>
                                            <h4>
                                                <a href="sms:body=<?= $header_text_7_text->text ?>" <?php if ($header_text_7_text->color) { ?>class='<?= $header_text_7_text->slug ?>' <?php } ?>><?= $header_text_7_text->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                    <div class="titlefontfamily headertitle text-bold">
                                        <?php if ($header_address_title->text) { ?>
                                            <h2 class="mb-0 text-bold {{$header_address_title->slug}}" 
                                            ><?= $header_address_title->text ?></h2>
                                        <?php } ?>
                                    </div>

                                    <?php if ($businessInfo->showcurrentaddressonheaderblock == '1') { ?>
                                        <div class="titlefontfamily headertitle">
                                            <h4> <a class="<?= $header_address2_street->slug ?>" href="http://maps.google.com/maps?q=<?= $header_address2_citystatezipcode->text . ' ' . $header_address2_street->text ?>" target="_blank"><?= $header_address2_street->text . '<br>' . $header_address2_citystatezipcode->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } else { ?>
                                        <?php if ($header_address2_street->text) { ?>
                                            <div class="titlefontfamily headertitle ">
                                                <?php if (false && $header_address2_street->header_address_title_2) { ?>
                                                    <h2 class="mb-0 text-bold <?= $header_address2_street->slug ?>">
                                                        <?= $header_address2_street->text ?></h2>
                                                <?php } ?>
                                                <h4>
                                                    <a class="<?= $header_address2_street->slug  ?>" href="http://maps.google.com/maps?q=<?= $header_address2_citystatezipcode->text . ' ' . $header_address2_street->text ?>" target="_blank"><?= $header_address2_street->text . '<br>' . $header_address2_citystatezipcode->text . '<br>' . $header_address2_comment->text ?></a>
                                                </h4>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <div class="position-relative social_media_outline">
                                    <?php if ($socialMedias) {
                                        $header_socialmedia = ($socialMedias); ?>
                                        <h3 class="social-media-container">
                                            @if(isset($_GET['editwebsite']))
                                            <div class="">
                                                <div class="d-flex align-items-center">
                                                    <x-tutorial-action-buttons  title='Social Media' :buttons="isset($tutorial_action_buttons['social_media']) ? $tutorial_action_buttons['social_media']:'' " url='businessinfo?block=social_media'/>
                                                </div>
                                            </div>
                                            @endif
                                            <?php foreach ($header_socialmedia as $single) { ?>
                                                <a target="_blank" href="<?= $single->link ?>" class="sicialmediaicon ">
                                                    @if(geticons($single->icon_id) == 'fa fa-twitter')
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="-40 -30 512 512" fill="<?php if ($social_media_icon->color) { echo $social_media_icon->color; }?>"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                                    @else
                                                        <i class=" <?= geticons($single->icon_id) ?>" ></i>
                                                    @endif                                               
                                                </a>
                                            <?php } ?>
                                        </h3>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </section><!-- End Hero -->
        </div>
    <?php } else { ?>
        <div class="row myrow nopadding" style="margin-left: 0px">
            @if ($headersection || (isset($_GET['editwebsite']) && ($frontSectionSetting->all_feature_for_edit_website ==1)))
                <div class="col-md-3 col-xs-12 nopadding  @if ($headerImages->slider_top_mobile || ( getSectionOrder('headerslider') < getSectionOrder('headersection'))) order-lg-1 order-2 @endif">
                    <!-- ======= Hero Section ======= -->
                    <section id="hero" class="d-flex align-items-center nopadding header-bg-2" >
                        <div class="container-fluid" data-aos="zoom-out" data-aos-delay="100">
                            <div class="headerdiv" >
                                <div class="position-relative header_images_outline" >
                                @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center logo-padding">
                                        <x-tutorial-action-buttons  title='Header Logo' :buttons="isset($tutorial_action_buttons['header_logo']) ? $tutorial_action_buttons['header_logo']:'' " url='quicksettings?block=header_images_bluebar&sb=header_logo_settings'/>
                                    </div>
                                </div>
                                @endif
                                <?php 
                                if ($step_image = check_step_image('Header Logo')) {
                                ?>
                                    <img src="<?= url('assets/uploads/').get_current_url() .'/'. $step_image['image'] ?>" width="<?= $headerImages->header_logo_width ?>" alt="<?=!empty($step_image['text']) ? $step_image['text'] : ''?>">
                                    <?php
                                    if (!empty($step_image['text'])) { 
                                    ?>
                                        <p class="header-logo-p">
                                            <?= nl2br($step_image['text']) ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                <?php
                                } elseif (show_timed_image($timed_header_logo_setting->enable, $timed_header_logo->file_name, $timed_header_logo_setting->start_time, $timed_header_logo_setting->end_time,$timed_header_logo_setting->days, 'enable_timed_header_logo', 'timed_images', 1,$timed_header_logo_setting->type)) {
                                ?>
                                    <!-- (Hassan) Add padding -->
                                    <img src="<?= url('assets/uploads/') .get_current_url(). '/'.$timed_header_logo->file_name ?>" width="<?= $timed_header_logo->max_width? $timed_header_logo->max_width : $headerImages->header_logo_width ?>" alt="<?=$header_image_title_text->text?>" class="mb-10 mt-15">
                                    <?php
                                } else {
                                    if ($headerImages->header_logo) { ?>
                                        <!-- (Hassan) Add padding -->
                                        <img src="<?= url('assets/uploads/') .get_current_url().'/'. $headerImages->header_logo ?>" width="<?= $headerImages->header_logo_width ?>" alt="<?= $header_image_title_text->text?>" class="mb-10 mt-15">
                                <?php
                                    }
                                }
                                ?>
                            </div>
                                <div class="position-relative header_images_outline" >
                                @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <x-tutorial-action-buttons  title='Header Images' :buttons="isset($tutorial_action_buttons['header_images']) ? $tutorial_action_buttons['header_images']:'' " url='quicksettings?block=header_images_bluebar&sb=header_image_settings'/>
                                    </div>
                                </div>
                                @endif
                                <?php if ($header_image_title_text->text) { ?>
                                    <!-- (Hassan) Add padding -->
                                    <h3 class="titlefontfamily headertitle text-bold mb-10"><a class="<?php if ($header_image_title_text->slug) { ?>
                                        <?=$header_image_title_text->slug?>  <?php } ?>"><?= $header_image_title_text->text ?></a>
                                    </h3>
                                <?php } ?>
                                <?php if ($header_text_2->text) { ?>
                                    <!-- (Hassan) Add padding -->
                                    <h3 class="titlefontfamily headertitle text-bold mb-10"><a class="<?=$header_text_2->slug ?>"><?= $header_text_2->text ?></a>
                                    </h3>
                                <?php } ?>
                                <?php
                                if ($step_image = check_step_image('Header Image Title')) {
                                ?>
                                    <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/').get_current_url() .'/'. $step_image['image'] ?>" width="<?= $headerImages->header_img_width ?>" alt="<?=!empty($step_image['text']) ? $step_image['text'] : $header_image_desc_text->text?>">
                                    <?php
                                    if (!empty($step_image['text'])) {
                                    ?>
                                        <p class="haeder-image-title-p">
                                            <?= nl2br($step_image['text']) ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                <?php
                                } elseif (show_timed_image($timed_header_image_setting->enable, $timed_header_image->file_name, $timed_header_image_setting->start_time, $timed_header_image_setting->end_time,$timed_header_image_setting->days, 'enable_timed_header_image', 'timed_images', 1,$timed_header_image_setting->type)) {
                                ?>
                                    <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/').get_current_url() .'/'. $timed_header_image->file_name ?>" width="<?= $timed_header_image->max_width ?>" alt="<?= $header_image_desc_text->text?>">
                                    <?php
                                } else {
                                    if ($headerImages->header_img) { ?>
                                        <img class="main_header_second_image mb-10" src="<?= url('assets/uploads/') .get_current_url().'/'. $headerImages->header_img ?>" width="<?= $headerImages->header_img_width ?>" alt="<?= $header_image_desc_text->text?>">
                                <?php
                                    }
                                }

                                ?>
                                <?php if ($header_image_desc_text->text) { ?>
                                    <!-- (Hassan) Add padding -->
                                    <p class="titlefontfamily headertitle mb-10" class="<?= ($header_image_desc_text->slug)?>">
                                        <a <?php if ($header_image_desc_text->color) { ?>class='<?= $header_image_desc_text->slug ?>' <?php } ?>><?= nl2br(($header_image_desc_text->text)) ?></a>
                                    </p>
                                <?php } ?>
                                
                                <?php if ($image_title_text_below_text->text) { ?>
                                    <!-- (Hassan) Add padding -->
                                    <p class="titlefontfamily headertitle mb-10 {{$image_title_text_below_text->slug}}" >
                                        <a <?php if ($image_title_text_below_text->color) { ?>class='{{$image_title_text_below_text->slug}}' <?php } ?>><?= nl2br(($image_title_text_below_text->text)) ?></a>
                                    </p>
                                <?php } ?>
                                <?php if ($header_text->text) { ?>
                                    <!-- (Hassan) Add padding -->
                                    <h3 class="titlefontfamily headertitle text-bold mb-10 <?= ($header_text->slug) ?>">
                                        <a <?php if ($header_text->color) { ?>style='color:<?= $header_text->color ?>' <?php } ?>><?= $header_text->text ?></a>
                                    </h3>
                                <?php } ?>
                            </div>
                            <div class="position-relative header_buttons_outline" >
                            @if(isset($_GET['editwebsite']))
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons  title='Header Buttons' :buttons="isset($tutorial_action_buttons['header_buttons']) ? $tutorial_action_buttons['header_buttons']:'' " url='quicksettings?block=action_btns_bluebar'/>
                                </div>
                            </div>
                            @endif
                                <?php if (isset($header_btn_1) && isset($header_btn_1->text)) {
                                    $input_link = '#';
                                    $target = '';
                                    $popupform = '';
                                ?>
                                    @include('sections.common.action_button',['action_button'=>$header_btn_1,'action_button_text'=>[]])
                                
                                <?php } ?>
                                <?php if (isset($header_btn_2) && isset($header_btn_2->text)) {
                                    $input_link = '#';
                                    $target = '#';
                                    $popupform = '';
                                
                                ?>
                                    @include('sections.common.action_button',['action_button'=>$header_btn_2,'action_button_text'=>[]])
                                
                                <?php } ?>
                                <?php if (isset($header_btn_3) && isset($header_btn_3->text)) {
                                    $input_link = '#';
                                    $target = '#';
                                    $popupform = '';
                                ?>
                                    @include('sections.common.action_button',['action_button'=>$header_btn_3,'action_button_text'=>[]])
                                
                                <?php } ?>
                            </div>
                            <div class="position-relative header_text_outline" >
                            @if(isset($_GET['editwebsite']))
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons  title='Header Text' :buttons="isset($tutorial_action_buttons['header_text']) ? $tutorial_action_buttons['header_text']:'' " url='quicksettings?block=header_text_bluebar'/>
                                </div>
                            </div>
                            @endif

                                <?php if ($header_phone_text->text) { ?>
                                        <div class="titlefontfamily headertitle">
                                            <?php if ($header_phone_title->text) { ?>
                                                <h2 class="mb-0 text-bold header-phone-text <?= ($header_phone_title->slug)  ?>"><?= $header_phone_title->text ?></h2>
                                            <?php } ?>
                                            <h4>
                                                <a href="tel:<?= $header_phone_text->text ?>"  class="{{$header_phone_text->slug}}"><?= $header_phone_text->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                    <?php if ($header_phone_text_2->text) { ?>
                                        <div class="titlefontfamily headertitle text-bold">
                                            <?php if ($header_phonr_text_title->text) { ?>
                                                <h2 class="mb-0 text-bold <?= ($header_phonr_text_title->slug) ?>"><?= $header_phonr_text_title->text ?></h2>
                                            <?php } ?>
                                            <h4>
                                                <a href="sms:<?= $header_phone_text_2->text ?>" class="<?= ($header_phone_text_2->slug)  ?>"><?= $header_phone_text_2->text ?></a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                <?php if ($header_text_7_text->text) { ?>
                                    <div class="titlefontfamily headertitle">
                                        <?php if ($header_text_title->text) { ?>
                                            <h2 class="mb-0 text-bold <?php if ($header_text_title->slug) { ?> <?= $header_text_title->slug?> <?php } ?>" ><?= $header_text_title->text ?></h2>
                                        <?php } ?>
                                        <h4>
                                            <a href="sms:body=<?= $header_text_7_text->text ?>" <?php if ($header_text_7_text->slug) { ?>class='<?= $header_text_7_text->slug ?>' <?php } ?>><?= $header_text_7_text->text ?></a>
                                        </h4>
                                    </div>
                                <?php } ?>
                            
                                <div class="titlefontfamily headertitle  text-bold">
                                    <?php if ($header_address_title->text) { ?>
                                        <h2 class="mb-0 text-bold {{$header_address_title->slug}}"><?= $header_address_title->text ?></h2>
                                    <?php } ?>
                                </div>
                                <?php if ($header_address2_street->text) { ?>
                                    <div class="titlefontfamily headertitle ">
                                        <?php if (false && $header_address_title_2->text) { ?>
                                            <h2 class="mb-0 text-bold {{$header_address_title_2->slug}}">
                                                <?= $header_address_title_2->text ?></h2>
                                        <?php } ?>
                                        <h4>
                                            <a class="<?= $header_address2_street->slug?>" href="http://maps.google.com/maps?q=<?= $header_address2_citystatezipcode->text . ' ' . $header_address2_street->text ?>" target="_blank"><?= $header_address2_street->text . '<br>' . $header_address2_citystatezipcode->text . '<br>' . $header_address2_comment->text ?></a>
                                        </h4>
                                    </div>
                                <?php } ?>
                            </div>

                                <div class="position-relative social_media_outline">
                                @if(isset($_GET['editwebsite']))
                                <div class="">
                                    <div class="d-flex align-items-center">
                                        <x-tutorial-action-buttons  title='Social Media' :buttons="isset($tutorial_action_buttons['social_media']) ? $tutorial_action_buttons['social_media']:'' " url='businessinfo?block=social_media'/>
                                    </div>
                                </div>
                                @endif
                                    <?php if ($socialMedias) {
                                        $header_socialmedia = ($socialMedias); ?>
                                        <h3 class="social-media-container">
                                            <?php foreach ($header_socialmedia as $single) { ?>
                                                <a target="_blank" href="<?= $single->link ?>" class="sicialmediaicon">
                                                    
                                                @if(geticons($single->icon_id) == 'fa fa-twitter')
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="-40 -30 512 512" fill="<?php if ($social_media_icon->color) { echo $social_media_icon->color; }?>"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                                    @else
                                                        <i class=" <?= geticons($single->icon_id) ?>" ></i>
                                                    @endif     
                                            
                                                </a>
                                            <?php } ?>
                                        </h3>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </section><!-- End Hero -->
                </div>
            @endif
            <div class="header-slider-background @if ($headersection || (isset($_GET['editwebsite']) && ($frontSectionSetting->all_feature_for_edit_website ==1))) col-md-9 col-xs-12 @else col-md-12 @endif nopadding header-carousel @if ($headerImages->slider_top_mobile || ( getSectionOrder('headerslider') < getSectionOrder('headersection'))) order-lg-2 order-1 @endif">
                @if ($navBarSettings->enable=='1' || ($allFeatures && isset($_GET['editwebsite'])))
                <div class="position-relative  my-nav-bar-div" >
                {{-- <div class="@if ($headersection) container @endif position-relative"> --}}
                <div class="position-relative">
                    <div class="navbar2-absolute nav_bar_outline w-auto">
                        <div class="my-nav-bar">
                        @if(isset($_GET['editwebsite']))
                        <div class="">
                            <div class="d-flex align-items-center">
                                <x-tutorial-action-buttons  title='Nav bar' :buttons="isset($tutorial_action_buttons['navbar']) ? $tutorial_action_buttons['navbar']:'' " url='settings?block=nav_bar_bluebar' :status="$navBarSettings->enable"/>
                            </div>
                        </div>
                        @endif
                            <ul>
                                @foreach ($navBarItems as $navBarItem)
                                    <?php 
                                        $class = '';
                                        $target = '';
                                        $popupform = '';
                                        $audioclass='';
                                        $data_target="";
                                        $data_toggle='';
                                        if ($navBarItem->link_type == 'link') {
                                            $banner_input_href = $navBarItem->link_url;
                                            $target = "_blank";

                                        } elseif($navBarItem->link_type == "video" ){
                                            $banner_input_href = get_blog_image($navBarItem->action_button_video);
                                            // $target = "_blank";
                                            $data_target="#video_modal";
                                            $data_toggle='modal';
                                          } elseif ($navBarItem->link_type == 'customforms') {
                                            $banner_input_href = '#';
                                            $target = "";
                                            $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms'.getCustomformEncodedID($navBarItem->custom_form).'"';
                                        } elseif( $navBarItem->link_type == "google_map"){
                                            $address_full = isset($navBarItem->map_address ) ? $navBarItem->map_address: "";
                                            $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
                                            $target = "_blank";
                                        }
                                        elseif($navBarItem->link_type == 'text_popup'){
                                            $banner_input_href = '#' . $navBarItem->link_type;
                                            ?>
                                            <div style="display:none" id="actnavText<?=$navBarItem->id?>">
                                                <?php echo $navBarItem->action_button_textpopup;?>
                                            </div>
                                            <?php 
                                        }elseif($navBarItem->link_type == "address"  ){
                                            $address =  getaddress_info($navBarItem->address_id);
                                            $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                                            $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
                                            $target = "_blank";
                                        }elseif ($navBarItem->link_type == 'call' || $navBarItem->link_type == 'sms' || $navBarItem->link_type == 'email') {
                                            switch ($navBarItem->link_type) {
                                                case 'sms':
                                                    $banner_input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $navBarItem->phone_no_sms));
                                                    break;
                                                case 'call':
                                                    $banner_input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $navBarItem->phone_no_call));
                                                    break;
                                                case 'email':
                                                    $banner_input_href = 'mailto:' . $navBarItem->email;
                                                    break;
                                            }
                                        }
                                        elseif($navBarItem->link_type=='audiofeature'){
                                            $audioclass='playaudiofile';
                                            $banner_input_href = '#';
                                            ?><div class="action-audio hidden"> <?php
                                                        if ($navBarItem->action_button_audio) { ?>
                                            <audio class="hidden" id="{{$navBarItem->id}}_modal_audio" controls>
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $navBarItem->action_button_audio) ?>" type="audio/mp3">
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $navBarItem->action_button_audio) ?>" type="audio/ogg">
                                                <source src="<?= url('assets/uploads/' . get_current_url() . $navBarItem->action_button_audio) ?>" type="audio/mpeg">
                                            </audio>
                                        <?php
                                                        }       
                                        ?>
                                    </div> <?php
                                        }  
                                        elseif(is_numeric($navBarItem->section)) {
                                            $section = getSectionDetail($navBarItem->section);
                                            $banner_input_href = '#' . (isset($section->slug) ? $section->slug:'');
                                            $class = 'menuitem';
                                            if(isset($section->slug) && $section->slug=='audiofeature'){
                                                $audioclass='playaudiofile';
                                            }
                                        }
                                        
                                        else {
                                            
                                            $banner_input_href = '#' . $navBarItem->link_type;
                                        } 
                                    ?>
                                    <li>
                                        @if($banner_input_href == '#')
                                        @php
                                            $banner_input_href = $banner_input_href.$navBarItem->link_type;
                                        @endphp
                                        @endif
                                        <a href="<?= $banner_input_href ?>" 
                                        id="<?= $navBarItem->id . 'navbarItemBtn' ?>"
                                        <?php if($navBarItem->link_type == 'text_popup'){ ?> 
                                        onclick="openPopupText('actnavText<?=$navBarItem->id?>')" 
                                        <?php }?>
                                        <?php if ($navBarItem->link_type == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($navBarItem->popup_images) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>  

                                            <?php if($navBarItem->link_type == "video"){?>  data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $navBarItem->id . 'navbarItemBtn' ?>')" <?php }?>
                                            <?= ($navBarItem->link_type == 'audiofeature') && $navBarItem->action_button_audio != "" ? 'onclick=playPauseAudio("' . $navBarItem->id . '_modal_audio")' : '' ?>
                                        target="<?= $target ?>" <?=$popupform?> class="my-nav-bar-item-{{$navBarItem->id}} {{$class}} " style=''>
                                            {{$navBarItem->text}} 
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <?php 
            $slider = $frontSections->firstWhere('slug','headerslider');
                    if (count($header_slider->toArray()) > 0 && (isset($slider) && $slider->section_enabled == 1) || (isset($slider) && $slider->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1 && isset($_GET['editwebsite']))) {
                    $active = 'active'; 
                   
                    ?>
                            <div class="position-relative gallery_slider_outline mb-0" >
                            @if(isset($_GET['editwebsite']) && $slider->section_enabled == 1 || (isset($_GET['editwebsite']) && isset($slider) && $slider->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1))
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons  title='Header Slider' :buttons="isset($tutorial_action_buttons['header_slider']) ? $tutorial_action_buttons['header_slider']:'' " url='quicksettings?block=popup_alert_bluebar' :status="$slider_setting->section_enabled"/>
                                </div>
                            </div>
                            @endif
                                <?php $is_step = check_step_image('Header Slider');?>
                                @if(!$is_step && $headerImages->is_video =='1' && $header_slider_video && isset($header_slider_video->video))
                                    
                                    <div class="item  header-slider-video-container">
                                        <div class="toprightdivaudio">
                                            <img class="playmutevideo lazyload" data-src="<?= url('assets/front/img/muted.jpg') ?>" width="40px" height="40px" alt="">
                                        </div>
                                        <video width="inherit"   class="header-slider-video header-slider-img" @if($headerImages->is_autoplay)autoplay @endif muted @if($headerImages->is_autoplay)playsinline @endif  loop>
                                            <source src="<?=base_url("assets/uploads/".get_current_url().$header_slider_video->video)?>" type="video/mp4">
                                        </video>
                                        <?php 
                                        if($header_slider_text->text){
                                            ?>
                                            <div class="caption <?php echo $headerImages->header_slider_text_position; ?>" >
                                            <?=$header_slider_text->text?>
                                            </div>
                                            <?php 
                                        }
                                        ?>
                                    </div>
                                @else
                                        
                                    <div id="myCarousel" class="carousel slide headerslider <?= check_feature_enable_disable('headerslider')  || isset($_GET['editwebsite']) && $frontSectionSetting->all_feature_for_edit_website ==1 ? '' : 'hidden' ?>" data-ride="carousel" <?php if($headerImages->is_autoplay=='0'){ ?>data-interval="false"<?php } ?>>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">

                                            <?php
                                            if ($step_image = check_step_image('Header Slider')) {
                                            ?>
                                                <div class="item <?php if ($active) {
                                                                        echo $active;
                                                                        $active = '';
                                                                    } ?>">

                                                        
                                                    <img 
                                                    class="header-slider-img"
                                                    <?php 
                                                    if($is_app){
                                                        ?>

                                                            src="<?= url('assets/uploads/'.get_current_url().$step_image['image']) ?>" 
                                                        <?php 
                                                    }else{
                                                        ?>
                                                        src="<?= url('assets/uploads/'.get_current_url().$step_image['image']) ?>" 
                                                        <?php 
                                                    }
                                                    ?>
                                                    
                                                    alt=""  alt="<?=!empty($step_image['text']) ? $step_image['text'] : 'Header Slider Image'?>">
                                                    <?php
                                                    if (!empty($step_image['text'])) {
                                                    ?>
                                                        <p class="header-slider-p">
                                                            <?= nl2br($step_image['text']) ?>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            } else {
                                                foreach ($header_slider as $single) { ?>
                                            
                                                    <div class="item <?php if ($active) {
                                                                            echo $active;
                                                                            $active = '';
                                                                        } ?>">
                                                        <img 
                                                        <?php 
                                                        if($is_app){
                                                            ?>
                                                            src="<?= url('assets/uploads/' .get_current_url(). $single->image) ?>"
                                                        
                                                            <?php 
                                                        }else{?>
                                                            src="<?= url('assets/uploads/' .get_current_url(). $single->image) ?>"
                                                            
                                                    <?php } ?>
                                                        alt="Header Slider Image"  class="header-slider-img" >
                                                    
                                                        <?php 
                                                            if($header_slider_text->text){

                                                                ?>
                                                            
                                                                <div class="caption <?php echo $headerImages->header_slider_text_position; ?>" >
                                                                <?=$header_slider_text->text?>
                                                                </div>
                                                                <?php 
                                                            }
                                                        ?>
                                                        </div>
                                            <?php }
                                            }
                                            ?>
                                            @if(count($header_slider->toArray()) > 1)
                                                <!-- Left and right controls -->
                                                <a class="carousel-control" href="#myCarousel" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control " href="#myCarousel" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>


@include('sections.headersection.scripts')