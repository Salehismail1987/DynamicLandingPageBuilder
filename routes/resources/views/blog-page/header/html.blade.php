<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title><?= $seoSettings->google_search_title ?></title>
        <meta name="title" content="<?= $seoSettings->google_search_title ?>">
        <meta name="description" content="<?= $seoSettings->google_search_description ?>">
        <meta name="keywords" content="<?= $seoSettings->meta_keywords ?>" >
        <meta name="author" content="<?= $seoSettings->meta_author ?>">
        <meta name="language" content="<?= $seoSettings->meta_language ?>">
        <?php 
        if(check_for_nofollow_meta()){
        ?>
            <meta name="robots" content="<?= $seoSettings->metatag_robots ?> ,noindex, follow " />
        <?php 
        }else{
        ?>    
            <meta name="robots" content="<?= $seoSettings->metatag_robots ?> " />
        <?php 
        }
        ?>
        <meta name="revisit-after" content="<?= $seoSettings->metatag_revisit_after ?>" />
        <link href='<?= url('assets/fonts/fonts.css'); ?>' rel='stylesheet'>
        <?php 
        check_for_nofollow_meta();
        ?>

        <meta name="apple-mobile-web-app-status-bar-style" content="white">
        <link rel="apple-touch-icon" href="<?= url('assets/uploads/'.get_current_url().'apple-touch-icon.png'); ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= url('assets/uploads/'.get_current_url().'apple-touch-icon.png'); ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/uploads/'.get_current_url().'apple-touch-icon.png'); ?>">
        <link rel="apple-touch-icon" sizes="167x167" href="<?= url('assets/uploads/'.get_current_url().'apple-touch-icon.png'); ?>">
        <link rel="apple-touch-startup-image" href="<?= url('assets/uploads/'.get_current_url().'apple-touch-icon.png'); ?>">

        <link href="<?= url('assets/uploads/'.get_current_url() . $siteSettings->favicon); ?>" rel="icon">
        <script src="<?= url('assets/front/'); ?>/vendor/jquery/jquery.min.js"></script>
        <link rel="stylesheet" href="<?= url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <link href="<?= url('assets/front/'); ?>/vendor/icofont/icofont.min.css" rel="stylesheet">
        <link href="<?= url('assets/front/'); ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="<?= url('assets/front/'); ?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
        <!--<link href="<?= url('assets/front/'); ?>vendor/venobox/venobox.css" rel="stylesheet">-->
        <link href="<?= url('assets/front/'); ?>/vendor/aos/aos.css" rel="stylesheet">
        <link href="<?= url('assets/'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick.css" rel="stylesheet">
        <link href="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick-theme.css" rel="stylesheet">
        <!-- Popp css -->
        <link rel="stylesheet" href="<?= url('assets/front/popup/'); ?>/css/modalanimate.css">
        <!-- Template Main CSS File -->
        <link href="<?= url('assets/front/'); ?>/css/style.css" rel="stylesheet">

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <?php 
            if(isset($siteSettings->is_captcha_enable) && $siteSettings->is_captcha_enable && $siteSettings->is_captcha_enable !=""){
                ?>
                <script src='https://www.google.com/recaptcha/api.js'></script>    
                <?php 
            }
         
        ?>

    </head>
    <body>
        <!-- <div id="preloader">
        
        </div> -->
        @include('blog-page.header.styles')
        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container pl-0" align="center">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-8 p-0 mobile-banner">
                            <div class="col-md-6 col-sm-5 col-xs-5 p-0 ">
                                <?php if ($menu_alert_logo->file_name) { ?>
                                    <h3 style="margin-top: 8px;margin-bottom: 8px;" >
                                        <img class="alertbannerlogo" <?php if ($menu_alert_logo->file_name) { ?>src='<?= url('assets/uploads/'.get_current_url().$menu_alert_logo->file_name) ?>' <?php } ?>>
                                    </h3>
                                <?php } ?>
                            </div>
                            <div class="col-md-6 col-sm-7 col-xs-7 p-0">
                                <?php if ($alert_banner_action_button_text->text) { ?>
                                    <h3  class="alertbannerbtn">    
                                        @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                                    </h3>
                                <?php } ?>
                            </div>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-8 p-0 desktop-banner">
                        <?php
                        $banner_class='col-md-6';
                        if ($menu_alert_logo->file_name) {
                            $banner_class='col-md-3';
                        }
                        ?>
                            <?php 
                            if ($menu_alert_logo->file_name) {
                                ?>
                                <div class="<?=$banner_class?>  p-0">
                                    <img class="alertbannerlogo" <?php if ($menu_alert_logo->file_name) { ?>src='<?= url('assets/uploads/').get_current_url().'/'.$menu_alert_logo->file_name ?>' <?php } ?>>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="<?=$banner_class?>  p-0">
                                <?php if ($alert_banner_text->text) { ?>
                                    <h3  class="alertbannertext">
                                        <a ><?= $alert_banner_text->text ?></a>
                                    </h3>
                                <?php } ?>
                            
                            </div>
                        
                            <div class="col-md-6  p-0">
                                <?php if ($alert_banner_action_button_text->text) { ?>
                                    <h3  class="alertbannerbtn">    
                                        @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                                    </h3>
                                <?php } ?>
                            </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-4 display-table" align="right">
                        <div class="vertical-middle">
                        <div class="d-flex justify-content-end">
                            <?php 
                                $blog_status = false;
                                foreach ($frontSections as $single) {
                                    if($single->slug=='blogsection' && $single->section_enabled=='1'){
                                        $blog_status = true;
                                    }
                                }
                            if($blog_status) { ?>
                            <a href="<?=url('/')?>" class="icon button mt-4 menu-icon-text">
                                <h4>Home</h4>
                            </a>
                            <?php } ?>
                            <a href="javascript:void(0);" class="icon button btnbars ml-15" >
                                <i class="fa fa-bars icon" style='<?php echo $alertBannerSettings->menu_icon_color? 'color:'.$alertBannerSettings->menu_icon_color.' !important;':""?>'></i>
                                <?php
                                if($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->text){
                                    ?>
                                    <span class="menu-icon-text {{$alert_banner_menu_icon_text->slug}}">
                                        <?=$alert_banner_menu_icon_text->text?>
                                    </span>
                                    <?php 
                                }
                                ?>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->
   <div class="main-content" ></div>
        <!-- Menu -->
        <div id="myLinks" style="height: 65%;position: fixed; z-index: 10;margin-bottom: 100px">
        <?php if (count($menu) > 0) { ?>
            <?php foreach ($menu as $row) {
                if($row->menu_enable == 0){
                    continue;
                }
                $section = getSectionDetail($row->section);
                if ( isset($section->name) && $section->section_enabled ) {
             
            ?>
                    <a href="{{url('/')}}#<?= $section->slug ?>" class="menuitem"><?= $row->name ?></a>
            <?php
                }elseif($row->link_type !=""){
                    $menu_href ="";
                    $target = '';
                    $popupform = '';
                    $audioclass='';
                    $data_toggle='';
                    $data_target='';
                    if ($row->link_type == 'link') {
                        $menu_href = $row->link_url;
                        $target = "_blank";
                    }elseif ($row->link_type == 'customforms') {
                        $input_link = '#';
                        $target = "";
                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($row->custom_form).'"';

                    }elseif( $row->link_type == "google_map"){

                        $address_full = isset($row->map_address ) ? $row->map_address: "";
                        $menu_href = "http://maps.google.com/maps?q=".$address_full;
                        $target = "_blank";
                    }elseif($row->link_type == "address"  ){
                        $address =  getaddress_info($row->address_id);
                     
                         $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                         $menu_href = "http://maps.google.com/maps?q=".$address_full;
                         $target = "_blank";
                     }elseif ($row->link_type == 'call' || $row->link_type == 'sms' || $row->link_type == 'email') {

                        switch ($row->link_type) {
                            case 'sms':
                                $menu_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $header_phone_text_2->header_phone_text));
                                break;
                            case 'call':
                                $menu_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $header_phone_text->header_text_7_phone));
                                break;
                            case 'email':
                                $menu_href = 'mailto:' . $contactInfo->contact_email;
                                break;
                        }
                   
                    }elseif($row->link_type == 'text_popup'){
                            
                        $menu_href = '#' . $row->link_type;
                        ?>
                        <div style="display:none" id="actMenuText<?=$row->id?>">
                            <?php echo $row->action_button_textpopup;?>
                        </div>
                        <?php 
                    }elseif($row->link_type == "video" ){
    
                      
                        $menu_href = get_blog_image($row->action_button_video);
                        // $target = "_blank";
                        $data_target="#video_modal";
                        $data_toggle='modal';
                    } elseif(is_numeric($row->section)) {
                        $section = getSectionDetail($row->section);
                        $menu_href = '#' . $section->slug;
                        if($section->slug=='audiofeature'){
                            $audioclass='playaudiofile';
                        }
                    } else {
                        $menu_href = '#' . $row->link_type;
                        if($row->link_type=='audiofeature'){
                            $audioclass='playaudiofile';
                        }
                    } 
                    ?>
                        <a href="<?= $menu_href ?>" 
                        id="<?= $row->id . 'menubutton' ?>"
                        <?php if($row->link_type == 'text_popup'){ ?> 
                        onclick="openPopupText('actMenuText<?=$row->id?>')" 
                        <?php }?>
                            <?php if($row->link_type == "video"){?>   data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $row->id . 'menubutton' ?>')" <?php }?>
                            
                        target="<?= $target ?>" <?=$popupform?> class="menuitem {{$audioclass}}" >
                            <?= $row->name ?>
                        </a>
                       
                    <?php 
                }
            } ?>
        <?php } ?>
        <?php if(false &&count($custom_forms)>0){ ?>
            <?php foreach($custom_forms as $single){ ?>
                    <a href="#" class="menuitem" data-toggle="modal" data-target="#modalcustomforms<?=getCustomformEncodedID($single->id)?>">
                        <?= $single->title ?>
                    </a>
            <?php } ?>
        <?php } ?>
    </div>
    @if ($navBarSettings->enable=='1')
    
    <?php 
        $backDashboard = '';
        if(isset($_GET['editwebsite'])){
            $backDashboard = '
                    <div class="back-dashboard-div">
                        <a href="'.url('settings?block=nav_bar_bluebar').'" target="_blank">
                            <div class="d-flex align-items-center">
                                <div class="title-2">Nav bar</div>
                            </div>
                            <img src="'.url('assets/uploads/'.get_current_url().'edit-round.png').'" class="edit-icon">
                        </a>
                    </div>';
        }
    ?>
    <div class="position-relative nav_bar_outline my-nav-bar-div" >
    
    <div class="container">
        <div class="h-40px ">
            <div class="my-nav-bar">
                <?php echo $backDashboard;?>
                <ul>
                    @foreach ($navBarItems as $navBarItem)
                        <?php 
                            $class = '';
                            $target = '';
                            $popupform = '';
                            $audioclass='';
                            if ($navBarItem->link_type == 'link') {
                                $banner_input_href = $navBarItem->link_url;
                                $target = "_blank";
                            } elseif ($navBarItem->link_type == 'customforms') {
                                $banner_input_href = '#';
                                $target = "";
                                $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($navBarItem->custom_form).'"';
                            } elseif( $navBarItem->link_type == "google_map"){
                        
                                    $address_full = isset($navBarItem->map_address ) ? $navBarItem->map_address: "";
                                    $banner_input_href = "http://maps.google.com/maps?q=".$address_full;
                                    $target = "_blank";
                                } elseif($navBarItem->link_type == "video" ){
    
                      
                                    $banner_input_href = get_blog_image($navBarItem->action_button_video);
                                    // $target = "_blank";
                                    $data_target="#video_modal";
                                    $data_toggle='modal';
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
                            }elseif($navBarItem->link_type == 'text_popup'){
                            
                                $banner_input_href = '#' . $navBarItem->link_type;
                                ?>
                                <div style="display:none" id="actnavText<?=$navBarItem->id?>">
                                    <?php echo $navBarItem->action_button_textpopup;?>
                                </div>
                                <?php 
                            } elseif(is_numeric($navBarItem->section)) {
                                $section = getSectionDetail($navBarItem->section);
                                $banner_input_href = '#' . (isset($section->slug)? $section->slug:'');
                                $class = 'menuitem';
                                if(isset($section->slug) && $section->slug=='audiofeature'){
                                    $audioclass='playaudiofile';
                                }else{
                                    $banner_input_href= url('home').$banner_input_href;
                                }
                            }  else {
                                if($navBarItem->link_type=='audiofeature'){
                                    $audioclass='playaudiofile';
                                    $banner_input_href = '#' . $navBarItem->link_type;
                                }else{
                                    $banner_input_href = '#' . $navBarItem->link_type;
                                    $banner_input_href= url('home').$banner_input_href;
                                }
                                
                            } 
                        ?>
                        <li>
                            <a 
                            id="<?= $navBarItem->id . 'navbarItemBtn' ?>"
                            <?php if($navBarItem->link_type == 'text_popup'){ ?> 
                                            onclick="openPopupText('actnavText<?=$navBarItem->id?>')" 
                                            <?php }?>
                            <?php if($navBarItem->link_type == "video"){?>   data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"  onclick="openVideo('<?= $navBarItem->id . 'navbarItemBtn' ?>')" <?php }?>
                            
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

@include('sections.common.video-modal-action')