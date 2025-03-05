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

    .pulldownmenu_tut {
        margin: 33px -30px;
    }

    .header_slider_m {
        margin-top: 100px;
        z-index: 999;
    }

    .nav_m {
        margin-top: 30px;
        margin-right: 10px;
    }

    .like-elements {
        align-items: center;
        flex-direction: column;
    }

    .submit-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white !important;
    }
</style>

<body>
    <!-- <div id="preloader">
        
        </div> -->
    @include('sections.header.styles')
    <!-- ======= Header ======= -->
    <?php
    $backDashboard = '';
    $setting = 1;

    ?>
    <header id="header" class="fixed-top">
        @php
        $likes = getLikes();
        @endphp
        <div class=" col-md-12 pl-0" align="center">
            <div class="row">
                <div class="custom-col-3 custom-sm-3 col-xs-3 p-0 likes-banner">
                    <div class="col-md-4 col-sm-4 hide-on-mob">
                        <text>What do you like?</text>
                    </div>
                    <div class="col-md-7 custom-sm-3 col-xs-12 likes-container p-0">
                        <div class="like-icon">
                            <div class="business-svgs"><svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="business-count">{{$likes['business'] ?? '100'}}</div>
                            <text class="Business-text">Business</text>
                        </div>
                        <div class="like-icon">
                            <div class="service-svgs"><svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="service-count">{{$likes['service'] ?? '50'}}</div>
                            <text class="Service-text">Service</text>
                        </div>
                        <div class="like-icon">
                            <div class="website-svgs"><svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="website-count">{{$likes['website'] ?? '40'}}</div>
                            <text class="Website-txt">Website</text>
                        </div>
                    </div>

                </div>
                <?php
                $banner_class = 'custom-col-3 custom-sm-3 mobileimg col-xs-3';
                if ($menu_alert_logo->file_name) {
                    $banner_class = 'custom-col-3 custom-sm-3 mobileimg col-xs-3';
                }
                ?>
                <?php
                if (isset($engagement_notification->engagement_toggle) && ($engagement_notification->engagement_toggle === null
                    || $engagement_notification->engagement_toggle === 1)) {
                ?>
                    <div class="<?= $banner_class ?>  p-0">
                        <img class="alertbannerlogo" <?php if ($menu_alert_logo->file_name) { ?>src='<?= url('assets/uploads/') . get_current_url() . '/' . $menu_alert_logo->file_name ?>' <?php } ?>>
                    </div>
                <?php
                }
                ?>
                <div class="col-md-10 col-sm-10 col-xs-6 p-0 mobile-banner">
                    <?php if (0) { ?>
                        <div class="col-md-6 col-sm-5 col-xs-5 p-0 ">
                            <?php if ($menu_alert_logo->file_name) { ?>
                                <h3 style="margin-top: 8px;margin-bottom: 8px;">
                                    <img class="alertbannerlogo" <?php if (0) { ?>src='<?= url('assets/uploads/' . get_current_url() . $menu_alert_logo->file_name) ?>' <?php } ?>>
                                </h3>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div class="col-md-6 col-sm-8 col-xs-12 p-0" style="text-align: left;">
                        <?php if ($alert_banner_action_button_text->text) { ?>
                            <h3 class="alertbannerbtn">
                                @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                            </h3>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-9 col-sm-7 col-xs-6  p-0 website-text">
                    <?php if ($alert_banner_text->text) { ?>
                        <h3 class="alertbannertext" style="text-align: left;">
                            <a><?= $alert_banner_text->text ?></a>
                        </h3>
                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-7 p-0 d-flex space-between desktop-banner position-relative   alert_banner_outline">
                    @if(isset($_GET['editwebsite']))
                    <div class="">
                        <div class="d-flex align-items-center">
                            <x-tutorial-action-buttons title='Alert Banner' :buttons="isset($tutorial_action_buttons['alert_banner']) ? $tutorial_action_buttons['alert_banner']:'' " url='quicksettings?block=alert_banner_bluebar' :status="$setting" />
                        </div>
                    </div>
                    @endif
                    <div class="col-md-9 col-sm-8 col-xs-6  p-0">
                        <?php if ($alert_banner_text->text) { ?>
                            <h3 class="alertbannertext" style="text-align: left;padding-left:10px;">
                                <a><?= $alert_banner_text->text ?></a>
                            </h3>
                        <?php } ?>

                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-5  p-0">
                        <?php if ($alert_banner_action_button_text->text) { ?>
                            <h3 class="alertbannerbtn">
                                @include('sections.common.action_button',['action_button'=>$alert_banner_action,'action_button_text'=>$alert_banner_action_button_text])
                            </h3>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 p-0 display-table" align="right">

                    <div class="vertical-middle position-relative  pulldown_menu_outline">
                        @if(isset($_GET['editwebsite']))
                        <div class="">
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
                                <a href="<?= url('blog-page') ?>" class="icon button menu-icon-text">
                                    <h4 class="burger-menu-txt"><?= !empty($blog_title_header->text) ? $blog_title_header->text : 'Blog' ?></h4>
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
                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($row->custom_form) . '"';
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
                <a href="#" class="menuitem" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($single->id) ?>">
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
        $(document).on("click", ".dismiss-color-label", function() {
            $(this).closest('.color-main-div').find('.colorinput').val('#FFF500');
            $(this).closest('.color-main-div').find('.inputcolor').css('background-color', '#FFF500');
            $('#label_color').val('#FFF500');
            $('#label_color').css('background-color', '#FFF500');
            $('#label_color').trigger('change');
        });
        $(document).ready(function() {
            $('#bannerbackgroundcolor').on('change', function() {
                console.log('change11')
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
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('#label_color').on('change', function() {
                var value = $(this).val();
                var slug = $(this).data('slug');
                $.ajax({
                    url: '/updatemasterlabel',
                    type: "POST",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'slug': slug,
                        'value': value
                    },
                    success: function(data) {
                        if (slug == 'master_feature_settings') {
                            $(".updateoutlinecolor").siblings('.inputcolor').css('background', value);
                            $(".updateoutlinecolor").val(value);
                        }
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