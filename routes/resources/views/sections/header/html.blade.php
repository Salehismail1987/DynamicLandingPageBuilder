<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $seoSettings->google_search_title ?></title>
    <meta name="title" content="<?= $seoSettings->google_search_title ?>">
    <meta name="description" content="<?= $seoSettings->google_search_description ?>">
    <meta name="keywords" content="<?= $seoSettings->meta_keywords ?>">
    <meta name="author" content="<?= $seoSettings->meta_author ?>">
    <meta name="language" content="<?= $seoSettings->meta_language ?>">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<?php
    if (check_for_nofollow_meta()) {
    ?>
        <meta name="robots" content="<?= $seoSettings->metatag_robots ?> ,noindex, follow " />
    <?php
    } else {
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
    <link rel="apple-touch-icon" href="<?= url('assets/uploads/' . get_current_url() . 'apple-touch-icon.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= url('assets/uploads/' . get_current_url() . 'apple-touch-icon.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= url('assets/uploads/' . get_current_url() . 'apple-touch-icon.png'); ?>">
    <link rel="apple-touch-icon" sizes="167x167" href="<?= url('assets/uploads/' . get_current_url() . 'apple-touch-icon.png'); ?>">
    <link rel="apple-touch-startup-image" href="<?= url('assets/uploads/' . get_current_url() . 'apple-touch-icon.png'); ?>">

    <link href="<?= url('assets/uploads/' . get_current_url() . $siteSettings->favicon); ?>" rel="icon">
    <script src="<?= url('assets/front/'); ?>/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link href="<?= url('assets/front/'); ?>/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= url('assets/front/'); ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= url('assets/front/'); ?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!--<link href="<?= url('assets/front/'); ?>vendor/venobox/venobox.css" rel="stylesheet">-->
    <link href="<?= url('assets/front/'); ?>/vendor/aos/aos.css" rel="stylesheet">
    <!-- <link href="<?= url('assets/'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <!-- Popp css -->
    <link rel="stylesheet" href="<?= url('assets/front/popup/'); ?>/css/modalanimate.css">
    <!-- Template Main CSS File -->
    <link href="<?= url('assets/front/'); ?>/css/style.css" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    if (isset($siteSettings->is_captcha_enable) && $siteSettings->is_captcha_enable && $siteSettings->is_captcha_enable != "") {
    ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    }
    ?>

</head>
<style>
    .colorinput {
        width: 21px;
        overflow: hidden;
        opacity: 0;
        position: absolute;
        top: 0;
    }

    .inputcolor {
        width: 21px;
        height: 21px;
        background: #2E2E2E;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.25);
        border-radius: 100px;
    }

    .tutorial-action-button {
        background: #E3F3FF !important;
        color: #006DC1 !important;
        padding: 10px;
    }

    .tutorial-menu .tutorial-item {
        display: block;
        width: 100%;
        /* Optional: Set width as needed */
        white-space: normal;
        /* Optional: Allow text to wrap */
        background: #3FA8F9 !important;
        margin-bottom: 7px;
    }

    .pulldownmenu {
        margin: 33px -30px;
    }

    .header_slider_m {
        margin-top: 100px;
    }

    .nav_m {
        margin-top: 30px;
        margin-right: 10px;
    }
</style>

<body>
    <!-- <div id="preloader">
        
        </div> -->
    @include('sections.header.styles')
    <!-- ======= Header ======= -->
    <?php
    $backDashboard = '';
    $setting = $frontSections->where('slug', 'headersection')->first();
    ?>
    <header id="header" class="fixed-top">
        <div class="container pl-0" align="center">
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-8 p-0 mobile-banner">
                    <div class="col-md-6 col-sm-5 col-xs-5 p-0 ">
                        <?php if ($menu_alert_logo->file_name) { ?>
                            <h3 style="margin-top: 8px;margin-bottom: 8px;">
                                <img class="alertbannerlogo" <?php if ($menu_alert_logo->file_name) { ?>src='<?= url('assets/uploads/' . get_current_url() . $menu_alert_logo->file_name) ?>' <?php } ?>>
                            </h3>
                        <?php } ?>
                    </div>
                    <div class="col-md-6 col-sm-7 col-xs-7 p-0">
                        <?php if ($alert_banner_action_button_text->text) { ?>
                            <h3 class="alertbannerbtn">
                                @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                            </h3>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-8 p-0 desktop-banner position-relative   alert_banner_outline">
                    @if(isset($_GET['editwebsite']))
                    <div class="">
                        <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                        <div class="d-flex align-items-center">
                            <!-- <div class="title-2">Alert Banner</div> -->
                            <x-tutorial-action-buttons title='Alert Banner' :buttons="isset($tutorial_action_buttons['alert_banner']) ? $tutorial_action_buttons['alert_banner']:'' " url='quicksettings?block=alert_banner_bluebar' :status="$setting->section_enabled" />
                        </div>
                        <!-- <img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon"> -->
                        <!-- </a> -->
                    </div>
                    @endif
                    <?php
                    $banner_class = 'col-md-6';
                    if ($menu_alert_logo->file_name) {
                        $banner_class = 'col-md-3';
                    }
                    ?>
                    <?php
                    if ($menu_alert_logo->file_name) {
                    ?>
                        <div class="<?= $banner_class ?>  p-0">
                            <img class="alertbannerlogo" <?php if ($menu_alert_logo->file_name) { ?>src='<?= url('assets/uploads/') . get_current_url() . '/' . $menu_alert_logo->file_name ?>' <?php } ?>>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="<?= $banner_class ?>  p-0">
                        <?php if ($alert_banner_text->text) { ?>
                            <h3 class="alertbannertext">
                                <a><?= $alert_banner_text->text ?></a>
                            </h3>
                        <?php } ?>

                    </div>

                    <div class="col-md-6  p-0">
                        <?php if ($alert_banner_action_button_text->text) { ?>
                            <h3 class="alertbannerbtn">
                                @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                            </h3>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-4 display-table" align="right">
                    <?php
                    $backDashboard = '';
                    if (isset($_GET['editwebsite'])) {

                    ?>

                        <div class="form-bottom make-sticky features-toggle header">
                            <div class="">
                                <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                                <!-- <div class="d-flex align-items-center">
                                    <x-tutorial-action-buttons title='Feature Toggle' :buttons="isset($tutorial_action_buttons['feature_toggle']) ? $tutorial_action_buttons['feature_toggle']:'' " />
                                </div> -->
                            </div>
                            <div class="">
                                <div class=" d-flex  text-center align-items-center" style="justify-content: space-evenly">
                                    <div class="vertical-middle col-md-6">
                                        <div class="label-sort label-sort-grey">Enabled features only</div>
                                    </div>
                                    <div class="form-group frontend" style="margin-bottom:0px;">
                                        <label class="switch">
                                            <input type="checkbox" class="enableswitch_all_features enableswitch" name="all_feature_for_edit_website" <?= $front_section_settings->all_feature_for_edit_website == 1 ? 'checked' : '' ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="vertical-middle col-md-6">
                                        <div class="label-sort label-sort-grey">All Features Visible</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center color-main-div" style="padding: 9px 45px;">
                                <div class="col-lg-4 align-items-center d-flex color_div p-1">
                                    <div>
                                        <img src='<?= url('assets/admin2/img/yellow_line.svg')?>' alt="" width="" class="dismiss-color">
                                    </div>
                                    <div class="">
                                        <div class="inputcolordiv">
                                            <div class="inputcolor header_input_color"></div>
                                            <input type="color" class="colorinput" name="tutorial_background" id="bannerbackgroundcolor" value="" placeholder="#FFF500">
                                        </div>
                                    </div>
                                </div>
                                <div class="label-sort label-sort-grey">Outline Color</div>
                            </div>
                    
                                    
                        </div> 
                        <?php
                            }
                                ?>
                    <div class="vertical-middle position-relative  pulldown_menu_outline">
                        @if(isset($_GET['editwebsite']))
                        <div class="">
                            <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                            <div class="d-flex align-items-center">
                                <x-tutorial-action-buttons title='Pulldown Menu' :buttons="isset($tutorial_action_buttons['pull_down']) ? $tutorial_action_buttons['pull_down']:'' " url='settings?block=pulldown_menu_bluebar' />
                            </div>
                        </div>
                        @endif
                        <div class="d-flex justify-content-end">
                            <?php
                            $blog_status = false;
                            foreach ($frontSections as $single) {
                                if ($single->slug == 'blogsection' && $single->section_enabled == '1') {
                                    $blog_status = true;
                                }
                            }
                            if ($blog_status) { ?>
                                <a href="<?= url('blog-page') ?>" class="icon button mt-4 menu-icon-text">
                                    <h4>Blog</h4>
                                </a>
                            <?php } ?>
                            <a href="javascript:void(0);" class="icon button btnbars ml-15">
                                <i class=" fa fa-bars icon" style='<?php echo $alertBannerSettings->menu_icon_color ? 'color:' . $alertBannerSettings->menu_icon_color . ' !important;' : "" ?>'></i>
                                <?php
                                if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->text) {
                                ?>
                                    <span class="menu-icon-text {{$alert_banner_menu_icon_text->slug}}">
                                        <?= $alert_banner_menu_icon_text->text ?>
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
    <div class="main-content"></div>
    <!-- Menu -->

    <div id="myLinks" style="width: 48%;height: 70%;position: fixed; z-index: 999;margin-bottom: 100px;">
        <?php if (count($menu) > 0) { ?>
            <?php foreach ($menu as $row) {
                if ($row->menu_enable == 0) {
                    continue;
                }
                $section = getSectionDetail($row->section);
                if (isset($section->name) && $section->section_enabled) {

            ?>
                    <a href="#<?= $section->slug ?>" class="menuitem"><?= $row->name ?></a>
                    <?php
                } elseif ($row->link_type != "") {
                    $menu_href = "";
                    $target = '';
                    $audioclass = '';
                    $popupform = '';
                    $data_toggle = '';
                    $data_target = '';
                    if ($row->link_type == 'link') {
                        $menu_href = $row->link_url;
                        $target = "_blank";
                    } elseif ($row->link_type == 'customforms') {
                        $input_link = '#';
                        $target = "";
                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms' . getCustomformEncodedID($row->custom_form) . '"';
                    } elseif ($row->link_type == 'text_popup') {

                        $menu_href = '#' . $row->link_type;
                    ?>
                        <div style="display:none" id="actMenuText<?= $row->id ?>">
                            <?php echo $row->action_button_textpopup; ?>
                        </div>
                    <?php
                    } elseif ($row->link_type == "google_map") {

                        $address_full = isset($row->map_address) ? $row->map_address : "";
                        $menu_href = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                    } elseif ($row->link_type == "address") {

                        $address =  getaddress_info($row->address_id);

                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $menu_href = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                    } elseif ($row->link_type == 'call' || $row->link_type == 'sms' || $row->link_type == 'email') {

                        switch ($row->link_type) {
                            case 'sms':
                                $menu_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $row->action_button_phone_no_sms));
                                break;
                            case 'call':
                                $menu_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $row->action_button_phone_no_calls));
                                break;
                            case 'email':
                                $menu_href = 'mailto:' . $row->action_button_action_email;
                                break;
                        }
                    } elseif ($row->link_type == "video") {

                        $menu_href = get_blog_image($row->action_button_video);
                        // $target = "_blank";
                        $data_target = "#video_modal";
                        $data_toggle = 'modal';
                    } elseif (is_numeric($row->section)) {
                        $section = getSectionDetail($row->section);
                        $menu_href = '#' . $section->slug;
                        if ($section->slug == 'audiofeature') {
                            $audioclass = 'playaudiofile';
                        }
                    } else {

                        $menu_href = '#' . $row->link_type;
                        if ($row->link_type == 'audiofeature') {
                            $audioclass = '';
                        }
                    }
                    ?>
                    <a href="<?= $menu_href ?>" id="<?= $row->id . 'menubutton' ?>" <?php if ($row->link_type == 'text_popup') { ?> onclick="openPopupText('actMenuText<?= $row->id ?>')" <?php } ?> <?php if ($row->link_type == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $row->id . 'menubutton' ?>')" <?php } ?> target="<?= $target ?>" <?= $popupform ?> class="menuitem {{$audioclass}}">
                        <?= $row->name ?>
                    </a>
            <?php
                }
            } ?>
        <?php } ?>
        <?php if (false && count($custom_forms) > 0) { ?>
            <?php foreach ($custom_forms as $single) { ?>
                <a href="#" class="menuitem" data-toggle="modal" data-target="#modalcustomforms<?= getCustomformEncodedID($single->id) ?>">
                    <?= $single->title ?>
                </a>
            <?php } ?>
        <?php } ?>
    </div>

    @include('sections.common.video-modal-action')
    <script>
            $(document).on("click", ".inputcolor", function() {
        $(this).closest('.inputcolordiv').find('.colorinput').trigger('click');
    });

    $(document).on("change", ".colorinput", function() {
        $(this).closest('.inputcolordiv').find('.inputcolor').css('background-color', $(this).val());
        $(this).closest('.inputcolordiv').find('.inputcolor').trigger('change');
    });

    $(document).on("click", ".dismiss-color", function() {
        $(this).closest('.color-main-div').find('.colorinput').val('#FFF500');
        $(this).closest('.color-main-div').find('.inputcolor').css('background-color', '#FFF500');
        $('#bannerbackgroundcolor').val('#FFF500');
        $('#bannerbackgroundcolor').css('background-color', '#FFF500');
        $('#bannerbackgroundcolor').trigger('change');
    });
    $(document).ready(function() {
    $('#bannerbackgroundcolor').on('change', function() {
        var colorValue = $(this).val();
        $.ajax({
            url: '/updatemasteroutlinecolor',
            type: 'POST',
            data: {
                value: colorValue,
                slug: 'master_feature_settings' // Adjust this value as needed
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Assuming you're using Laravel's CSRF protection
            },
            success: function(response) {
                // Reload the page on success
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Failed to update the outline color.');
            }
        });
    });
});
    </script>