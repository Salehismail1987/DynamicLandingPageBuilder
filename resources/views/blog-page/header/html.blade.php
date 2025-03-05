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
    if (isset($siteSettings->is_captcha_enable) && $siteSettings->is_captcha_enable && $siteSettings->is_captcha_enable != "") {
    ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    }

    ?>

</head>
<style>
    .business-svg {
        display: flex;
        justify-content: center;
    }

    .service-svg {
        display: flex;
        justify-content: center;
    }

    .website-svg {
        display: flex;
        justify-content: center;
    }

    .business-svgs {
        display: flex;
        justify-content: center;
    }

    .service-svgs {
        display: flex;
        justify-content: center;
    }

    .website-svgs {
        display: flex;
        justify-content: center;
    }

    .like-box {
        margin-bottom: 20px;
    }

    #likes-dialog {
        margin-left: 149px;
        margin-top: 68px;
        /* border: 2px solid; */
        border-radius: 9px;
        border-color: #545556;
    }

    .submit-like-btn {
        padding: 5px 20px !important;
        background: black !important;
        border: 0px !important;
    }

    .leave-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
    }

    .read-comments-btn {
        padding: 5px 20px !important;
        background: #A8AEB4 !important;
        border: 0px !important;
    }

    .comments-btn-div {
        margin-top: 20px;
    }

    .comments-no {
        display: flex;
        justify-content: end;
        padding-right: 41px;
    }

    .likes-modal-header {
        color: #626262 !important;
        font-weight: 600 !important;
        /* font-size: 12px; */
        line-height: 14.52px;
        line-height: 2;
    }

    .italic {
        font-style: italic;
    }

    .like-elements {
        align-items: center;
        flex-direction: column;
    }

    .engagement-fields {
        background: #F3F3F3;
        border: 0px;
    }

    #engagementCommentModalLabel {
        line-height: 19.36px;
        font-size: 16px;
        font-weight: 600;
    }

    #engagementCommentForm {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .like-comment-div {
        margin-bottom: 30px;
    }

    .custom-dialog {
        display: inline-block;
        /* Inline-block instead of flex */
        width: 450px;
        /* Custom width */
        max-width: 100%;
        /* Responsive */
        margin: 0 auto;
        /* Center horizontally */
        vertical-align: middle;
        /* Center vertically */
    }

    .modal-dialog-centered {
        display: table;
        /* Required for vertical centering */
        height: 100vh;
        margin: 12% auto;
    }

    .modal-dialog-centered:before {
        content: '';
        display: table-cell;
        vertical-align: middle;
    }

    .thank-you-popup .modal-dialog {
        max-width: 300px;
        /* Adjust based on your design */
    }

    .thank-you-popup svg {
        margin-bottom: 20px;
        /* Space between SVG and text */
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .thank-you-popup p {
        font-size: 18px;
        color: #333;
    }

    .modal-header {
        border-bottom: 0px;
    }

    #commentsModalLabel {
        text-align: center;
        font-size: 16px;
        color: black;
        line-height: 19.36px;
    }

    .comments-modal {
        width: 490px;
        margin: 0 auto;
    }

    .comment-item {
        margin-top: 16px;
    }

    .modal-footer {
        border-bottom: 0px;
        text-align: center;
    }

    .close-comment-list {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white !important;
    }

    .like-icon.selected {
        background-color: #f8d7da;
        border-radius: 10px;
    }

    .like-icon-hd {
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
    }

    .like-modal-header {
        padding-left: 29px;
        margin-top: 25px;
    }

    .submit-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white !important;
    }

    .modal-footer {
        border-radius: 0px;
    }

    .Website-txt {
        font-size: 11px;
        font-weight: 600;
    }

    .Service-text {
        font-size: 11px;
        font-weight: 600;
    }

    .Business-text {
        font-size: 11px;
        font-weight: 600;
    }

    @media (max-width: 1070px) {
        #likes-dialog {
            margin-left: 88px !important;
        }
    }

    @media (max-width: 981px) {
        .submit-comment-btn {
            font-size: 11px;
        }

        .submit-like-btn {
            font-size: 11px;
        }

        .leave-comment-btn {
            font-size: 11px;
        }

        .read-comments-btn {
            font-size: 11px;
        }
    }

    @media (max-width: 600px) {
        #likes-dialog {
            margin: 0 auto !important;
        }
    }

    @media (max-width: 597px) {
        #likes-dialog {
            top: 25%;
        }

        .submit-comment-btn {
            font-size: 11px;
            color: white;
        }

        .submit-like-btn {
            font-size: 11px;
        }

        .leave-comment-btn {
            font-size: 11px;
        }

        .read-comments-btn {
            font-size: 11px;
        }
    }

    @media (max-width: 430px) {
        .like-icon-hd svg {
            height: 11px;
            width: 11px;
        }

        .website-count {
            font-size: 11px;
            font-weight: 600;
        }

        .service-count {
            font-size: 11px;
            font-weight: 600;
        }

        .business-count {
            font-size: 11px;
            font-weight: 600;
        }

        .Website-txt {
            font-size: 9px;
            font-weight: 600;
        }

        .Service-text {
            font-size: 9px;
            font-weight: 600;
        }

        .Business-text {
            font-size: 9px;
            font-weight: 600;
        }

        .comments-modal {
            width: 353px;
            margin: 0 auto;
            top: 15%;
        }

        #likes-dialog {
            width: 353px !important;
            margin: 0 auto;
            top: 15%;
        }
    }

    .submit-like-btn {
        color: white !important;
    }

    .leave-comment-btn {
        color: white !important;
    }

    .read-comments-btn {
        color: white !important;
    }
</style>

<body>
    <!-- <div id="preloader">
        
        </div> -->
    @include('blog-page.header.styles')
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        @php
        $likes = getLikes();
        @endphp
        <div class="col-md-12 pl-0" align="center">
            <div class="row">
                <!-- Likes Banner -->
                <div class="custom-col-3 custom-sm-3 col-xs-3 p-0 likes-banner">
                    <div class="col-md-4 col-sm-4 hide-on-mob">
                        <text>What do you like?</text>
                    </div>
                    <div class="col-md-7 custom-sm-3 col-xs-12 likes-container p-0">
                        <div class="like-icon">
                            <div class="business-svgs">
                                <svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="business-count">{{$likes['business'] ?? '100'}}</div>
                            <text class="Business-text">Business</text>
                        </div>
                        <div class="like-icon">
                            <div class="service-svgs">
                                <svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="service-count">{{$likes['service'] ?? '50'}}</div>
                            <text class="Service-text">Service</text>
                        </div>
                        <div class="like-icon">
                            <div class="website-svgs">
                                <svg width="13" height="13" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg>
                            </div>
                            <div class="website-count">{{$likes['website'] ?? '40'}}</div>
                            <text class="Website-txt">Website</text>
                        </div>
                    </div>
                </div>

                <!-- Mobile Banner -->
                <div class="col-md-10 col-sm-10 col-xs-6 p-0 mobile-banner">
                    <?php if (0) { ?>
                        <div class="col-md-6 col-sm-5 col-xs-5 p-0">
                            @if ($menu_alert_logo->file_name)
                            <h3 style="margin-top: 8px;margin-bottom: 8px;">
                                <img class="alertbannerlogo" src="{{ url('assets/uploads/'.get_current_url().$menu_alert_logo->file_name) }}">
                            </h3>
                            @endif
                        </div>
                    <?php } ?>
                    <div class="col-md-6 col-sm-8 col-xs-12 p-0" style="text-align: left;">
                        @if ($alert_banner_action_button_text->text)
                        <h3 class="alertbannerbtn">
                            @include('sections.common.action_button', ['action_button' => $alert_banner_action, 'action_button_text' => $alert_banner_action_button_text])
                        </h3>
                        @endif
                    </div>
                </div>
                <div class="col-md-9 col-sm-7 col-xs-6  p-0 website-text">
                    <?php if ($alert_banner_text->text) { ?>
                        <h3 class="alertbannertext" style="text-align: left;">
                            <a><?= $alert_banner_text->text ?></a>
                        </h3>
                    <?php } ?>

                </div>

                <!-- Desktop Banner -->
                <div class="col-md-8 col-sm-6 col-xs-7 p-0 d-flex space-between desktop-banner position-relative   alert_banner_outline">
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
                                @include('sections.common.action_button', ['action_button' => $alert_banner_action, 'action_button_text' => $alert_banner_action_button_text])
                            </h3>
                        <?php } ?>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 p-0 display-table" align="right">
                    <div class="vertical-middle">
                        <div class="d-flex justify-content-end">
                            @php
                            $blog_status = false;
                            foreach ($frontSections as $single) {
                            if($single->slug=='blogsection' && $single->section_enabled=='1'){
                            $blog_status = true;
                            }
                            } @endphp
                            @if ($blog_status)
                            <a href="{{ url('/') }}" class="icon button mt-4 menu-icon-text">
                                <h4>Home</h4>
                            </a>
                            @endif
                            <a href="javascript:void(0);" class="icon button btnbars ml-15">
                                <i class="fa fa-bars icon" style="{{ optional($alertBannerSettings)->menu_icon_color ? 'color:'.optional($alertBannerSettings)->menu_icon_color.' !important;' : '' }}"></i>
                                @if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->text)
                                <span class="menu-icon-text {{ $alert_banner_menu_icon_text->slug }}">
                                    {{ $alert_banner_menu_icon_text->text }}
                                </span>
                                @endif
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
    <div id="myLinks" style="height: 65%;position: fixed; z-index: 10;margin-bottom: 100px">
        <?php if (count($menu) > 0) { ?>
            <?php foreach ($menu as $row) {
                if ($row->menu_enable == 0) {
                    continue;
                }
                $section = getSectionDetail($row->section);
                if (isset($section->name) && $section->section_enabled) {

            ?>
                    <a href="{{url('/')}}#<?= $section->slug ?>" class="menuitem"><?= $row->name ?></a>
                    <?php
                } elseif ($row->link_type != "") {
                    $menu_href = "";
                    $target = '';
                    $popupform = '';
                    $audioclass = '';
                    $data_toggle = '';
                    $data_target = '';
                    if ($row->link_type == 'link') {
                        $menu_href = $row->link_url;
                        $target = "_blank";
                    } elseif ($row->link_type == 'customforms') {
                        $input_link = '#';
                        $target = "";
                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms' . getCustomformEncodedID($row->custom_form) . '"';
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
                                $menu_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $header_phone_text_2->header_phone_text));
                                break;
                            case 'call':
                                $menu_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $header_phone_text->header_text_7_phone));
                                break;
                            case 'email':
                                $menu_href = 'mailto:' . $contactInfo->contact_email;
                                break;
                        }
                    } elseif ($row->link_type == 'text_popup') {

                        $menu_href = '#' . $row->link_type;
                    ?>
                        <div style="display:none" id="actMenuText<?= $row->id ?>">
                            <?php echo $row->action_button_textpopup; ?>
                        </div>
                    <?php
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
                            $audioclass = 'playaudiofile';
                        }
                    }
                    ?>
                    <a href="<?= $menu_href ?>"
                        id="<?= $row->id . 'menubutton' ?>"
                        <?php if ($row->link_type == 'text_popup') { ?>
                        onclick="openPopupText('actMenuText<?= $row->id ?>')"
                        <?php } ?>
                        <?php if ($row->link_type == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $row->id . 'menubutton' ?>')" <?php } ?>

                        target="<?= $target ?>" <?= $popupform ?> class="menuitem {{$audioclass}}">
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
    @if ($navBarSettings->enable=='1')

    <?php
    $backDashboard = '';
    if (isset($_GET['editwebsite'])) {
        $backDashboard = '
                    <div class="back-dashboard-div">
                        <a href="' . url('settings?block=nav_bar_bluebar') . '" target="_blank">
                            <div class="d-flex align-items-center">
                                <div class="title-2">Nav bar</div>
                            </div>
                            <img src="' . url('assets/uploads/' . get_current_url() . 'edit-round.png') . '" class="edit-icon">
                        </a>
                    </div>';
    }
    ?>
    <div class="position-relative nav_bar_outline my-nav-bar-div">

        <div class="container">
            <div class="h-40px ">
                <div class="my-nav-bar">
                    <?php echo $backDashboard; ?>
                    <ul>
                        @foreach ($navBarItems as $navBarItem)
                        <?php
                        $class = '';
                        $target = '';
                        $popupform = '';
                        $audioclass = '';
                        if ($navBarItem->link_type == 'link') {
                            $banner_input_href = $navBarItem->link_url;
                            $target = "_blank";
                        } elseif ($navBarItem->link_type == 'customforms') {
                            $banner_input_href = '#';
                            $target = "";
                            $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID($navBarItem->custom_form) . '"';
                        } elseif ($navBarItem->link_type == "google_map") {

                            $address_full = isset($navBarItem->map_address) ? $navBarItem->map_address : "";
                            $banner_input_href = "http://maps.google.com/maps?q=" . $address_full;
                            $target = "_blank";
                        } elseif ($navBarItem->link_type == "video") {


                            $banner_input_href = get_blog_image($navBarItem->action_button_video);
                            // $target = "_blank";
                            $data_target = "#video_modal";
                            $data_toggle = 'modal';
                        } elseif ($navBarItem->link_type == "address") {

                            $address =  getaddress_info($navBarItem->address_id);
                            $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                            $banner_input_href = "http://maps.google.com/maps?q=" . $address_full;
                            $target = "_blank";
                        } elseif ($navBarItem->link_type == 'call' || $navBarItem->link_type == 'sms' || $navBarItem->link_type == 'email') {
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
                        } elseif ($navBarItem->link_type == 'text_popup') {

                            $banner_input_href = '#' . $navBarItem->link_type;
                        ?>
                            <div style="display:none" id="actnavText<?= $navBarItem->id ?>">
                                <?php echo $navBarItem->action_button_textpopup; ?>
                            </div>
                        <?php
                        } elseif (is_numeric($navBarItem->section)) {
                            $section = getSectionDetail($navBarItem->section);
                            $banner_input_href = '#' . (isset($section->slug) ? $section->slug : '');
                            $class = 'menuitem';
                            if (isset($section->slug) && $section->slug == 'audiofeature') {
                                $audioclass = 'playaudiofile';
                            } else {
                                $banner_input_href = url('home') . $banner_input_href;
                            }
                        } else {
                            if ($navBarItem->link_type == 'audiofeature') {
                                $audioclass = 'playaudiofile';
                                $banner_input_href = '#' . $navBarItem->link_type;
                            } else {
                                $banner_input_href = '#' . $navBarItem->link_type;
                                $banner_input_href = url('home') . $banner_input_href;
                            }
                        }
                        ?>
                        <li>
                            <a
                                id="<?= $navBarItem->id . 'navbarItemBtn' ?>"
                                <?php if ($navBarItem->link_type == 'text_popup') { ?>
                                onclick="openPopupText('actnavText<?= $navBarItem->id ?>')"
                                <?php } ?>
                                <?php if ($navBarItem->link_type == "video") { ?> data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $navBarItem->id . 'navbarItemBtn' ?>')" <?php } ?>

                                href="<?= $banner_input_href ?>" target="<?= $target ?>" <?= $popupform ?> class="my-nav-bar-item-{{$navBarItem->id}} {{$class}} {{ $audioclass}}" style=''>
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
    <script>
        $(document).ready(function() {
            console.log('a234123sd')
            $.ajax({
                url: '/record-visitor',
                method: 'POST',
                data: JSON.stringify({
                    visitors: 1
                }), // Send 1 for each visit
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {},
                error: function(error) {}
            });
            let clickCount = 0;

            // Increment click count on each click
            $(document).on('click', function() {
                clickCount++;
            });

            // Send clicks to the server every 30 seconds
            setInterval(function() {
                if (clickCount > 0) {
                    $.ajax({
                        url: '/record-click',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({
                            clicks: clickCount
                        }),
                        success: function(response) {
                            clickCount = 0; // Reset after successful sync
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            }, 30000); // Sync every 30 seconds

            const selectedCategories = new Set();

            // Handle Like Category Selection
            $('.business-svg, .service-svg, .website-svg').on('click', function() {
                const category = $(this).data('category');

                // Skip if category is undefined or empty
                if (!category) return;

                // Check if the category is already selected
                if (selectedCategories.has(category)) {
                    selectedCategories.delete(category);
                    // Reset the SVG's fill color to white
                    $(this).find('svg path').css('fill', 'white');
                    $(this).find('svg path').css('stroke', 'black');
                } else {
                    selectedCategories.add(category);
                    // Set the SVG's fill color to red
                    $(this).find('svg path').css('fill', 'red');
                }
            });


            // Submit Likes Function
            function submitLikes(callback = null) {
                if (selectedCategories.size === 0) {
                    if (callback) callback(); // If no likes, directly trigger the callback
                    return;
                }
                $('#likesModal').modal('hide');
                $.ajax({
                    url: '/increment-likes',
                    type: 'POST',
                    data: {
                        categories: Array.from(selectedCategories), // Convert Set to Array
                        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function(response) {
                        // Clear selections and reset UI
                        selectedCategories.clear();
                        $('.business-svg, .service-svg, .website-svg').css('color', 'black');

                        if (callback) callback(); // Execute callback after success
                    },
                    error: function(xhr) {
                        alert('Failed to submit likes. Please try again.');
                    }
                });
            }

            // Handle Submit a Like Button Click
            $('.submit-like-btn').on('click', function() {
                if (selectedCategories.size === 0) {
                    alert('Please select at least one category!');
                    return;
                }

                submitLikes(() => {
                    // Show thank you modal after likes are submitted
                    $('#thankYouModal').modal('show');
                    setTimeout(() => {
                        $('#thankYouModal').modal('hide');
                        $('#likesModal').modal('hide');
                    }, 3000);
                });
            });
            $('.read-comments-btn').on('click', function() {
                // Show the modal
                $('#commentsModal').modal('show');

                // Clear existing comments
                $('.comments-list').html('<p>Loading comments...</p>');

                // Fetch comments via AJAX
                $.ajax({
                    url: '/comments', // Adjust URL as needed
                    method: 'GET',
                    success: function(response) {
                        // Clear the comments list
                        $('.comments-list').html('');

                        // Check if there are any comments (response is an object with properties)

                        // Convert the object into an array of values (the comment objects)
                        const comments = Object.values(response);
                        if (comments.length > 0) {
                            // Loop through the comments and render them
                            comments.forEach(function(comment) {
                                const commentHtml = `
                <div class="comment-item mb-3">
                    <p class="mb-1">${comment.comment}</p>
                    <small class="text-muted italic">
                    <i style="font-family:Arial;">
                        ${new Date(comment.created_at).toISOString().split('T')[0]} • Added by 
                        <strong>${comment.name || 'Not Disclosed'}</strong></i>
                    </small>
                </div>
            `;
                                $('.comments-list').append(commentHtml);
                            });
                        } else {
                            // If no comments, show a message
                            $('.comments-list').html('<p>No comments yet.</p>');
                        }
                    },

                    error: function(xhr, status, error) {
                        // Handle errors
                        $('#commentsList').html('<p>Failed to fetch comments. Please try again later.</p>');
                        console.error('Error fetching comments:', error);
                    }
                });
            });

            $('.submit-comment-btn').click(function() {
                // Submit the comment logic goes here...
                // (This is just a placeholder for your actual submit logic)

                // Close all modals
                // $('.modal').modal('hide');
                // $('.likesModal').modal('hide');

                // // Show the "Thank You" popup
                // $('#thankYouModal').modal('show');
            });

            // Close the "Thank You" popup when the user clicks outside the modal or on the close button
            $('#thankYouModal').on('hidden.bs.modal', function() {
                // Optionally, you can reset the SVG and message here if needed
            });

            $('#engagementCommentForm').on('submit', function(e) {
                e.preventDefault();
                if ($('#comment').val().trim() == '') {
                    alert('Comment field is empty');
                    return;
                }
                const formData = {
                    name: $('#user_name').val(),
                    comment: $('#comment').val(),
                };

                $.ajax({
                    url: '/engagement-comments',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        // $('.modal').modal('hide');
                        $('.likesModal').modal('hide');

                        // // Show the "Thank You" popup
                        $('#thankYouModal').modal('show');
                        $('#engagementCommentModal').modal('hide');
                        $('#engagementCommentForm')[0].reset();
                        setTimeout(function() {
                            $('#thankYouModal').modal('hide');
                        }, 3000); // 3000ms = 3 seconds
                    },
                    error: function(xhr) {
                        setTimeout(function() {
                            $('#thankYouModal').modal('hide');
                        }, 3000); // 3000ms = 3 seconds
                        // alert('An error occurred while submitting the comment.');
                    },
                });
            });
            $('#openCommentModal').on('click', function() {
                $('#likesModal').modal('hide');
                $('#engagementCommentModal').modal('show');
                $(this).off('hidden.bs.modal');
            });
            $('#openCommentModal').on('click', function() {
                // Submit likes if any before showing the comment modal
                submitLikes(() => {
                    $(this).off('hidden.bs.modal');
                    // Show the comment modal after likes are submitted
                    $('#engagementCommentModal').modal('show');
                });
            });
            $('.like-icon').on('click', function() {
                console.log('asdfasdfasdhf')
                if ($(this).find('svg').hasClass('ch-clr')) {
                    // Change the clicked SVG to red if it has the 'ch-clr' class
                    $(this).find('svg path').attr('fill', 'red').attr('stroke', 'red');
                }

                // $(this).find('svg path').attr('fill', 'red').attr('stroke', 'red');
            });
            $('.likes-banner').on('click', function() {
                $('#likesModal').modal('show');
            });

            $('.close-modal').on('click', function() {
                $('#likesModal').fadeOut();
            });

            $('#likesModal').on('click', function(e) {
                if ($(e.target).is('#likesModal')) {
                    $(this).fadeOut();
                }
            });
        });
    </script>
    @include('sections.common.video-modal-action')