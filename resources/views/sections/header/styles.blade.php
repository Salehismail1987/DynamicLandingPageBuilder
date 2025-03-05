<style>
    html,
    body {
        height: 100%;
        width: 100%;
        position: relative;
        @if($siteSettings->site_background_color && isset($siteSettings->site_background_color) && $siteSettings->site_background_color !='null') background: <?= $siteSettings->site_background_color ?> !important;
        @endif
    }


    #myLinks {
        overflow: scroll;
        display: none;
        padding: 3% !important;
        background: <?= $popup_menu_text->bg_color ? $popup_menu_text->bg_color : '#fff' ?> !important;
    }

    #myLinks a {
        width: 100%;
        display: block;
        text-align: center;
        color: <?= $popup_menu_text->color ? $popup_menu_text->color : '#000' ?>;
        font-size: 22px;
        padding: 5px 0;
        font-weight: bold;
    }

    #myLinks a:hover {
        background: <?= isset($popup_menu_text_hover->color) ? $popup_menu_text_hover->color : '#e9e9e9' ?> !important;
    }


    .faqheading {
        padding: 10px 0;
        <?php if ($faq_title->bg_color) { ?>background: <?= $faq_title->bg_color ?>;
        <?php } ?>
    }

    .faqtitle {
        font-weight: bold;
        line-height: 1;
        padding: 20px;
        text-align: center;
        <?php if ($faq_title->size_web) { ?>font-size: <?= $faq_title->size_web ?>px;
        <?php } ?><?php if ($faq_title->color) { ?>color: <?= $faq_title->color ?>;
        <?php } ?><?php if ($faq_title->fontfamily) { ?>font-family: <?= getfontfamily($faq_title->fontfamily) ?> !important;
        <?php } ?>
    }

    .titlefontfamily {
        font-weight: bold;
        line-height: 1;
        <?php if ($master_title->fontfamily) { ?>font-family: <?= getfontfamily($master_title->fontfamily) ?>;
        <?php } ?>
    }

    .dailyhoursdae {
        <?php if ($daily_hours_day_block->size_web) { ?>font-size: <?= $daily_hours_day_block->size_web ?>px;
        <?php } ?><?php if ($daily_hours_day_block->color) { ?>color: <?= $daily_hours_day_block->color ?>;
        <?php } ?>;
        <?php if ($daily_hours_day_block->color) { ?>border: 1px solid<?= $daily_hours_day_block->color ?> <?php } ?>;
        <?php if ($daily_hours_day_block->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_day_block->fontfamily) ?>;
        <?php } ?><?php if ($daily_hours_day_block->bg_color) { ?>background: <?= $daily_hours_day_block->bg_color ?> <?php } ?>;
    }

    .tabledailyhoursdae {
        padding-right: 25px;
        <?php if ($set_hours_day->size_web) { ?>font-size: <?= $set_hours_day->size_web ?>px;
        <?php } ?><?php if ($set_hours_day->color) { ?>color: <?= $set_hours_day->color ?>;
        <?php } ?><?php if ($set_hours_day->fontfamily) { ?>font-family: <?= getfontfamily($set_hours_day->fontfamily) ?>;
        <?php } ?>
    }

    @media only screen and (max-width: 600px) {
        .tabledailyhoursdae {
            <?php if ($set_hours_day->size_mobile) { ?>font-size: <?= $set_hours_day->size_mobile . 'px' ?> <?php } ?>
        }
    }


    .tablehoursdetailstart {
        <?php if ($daily_hours_start_title->size_web) { ?>font-size: <?= $daily_hours_start_title->size_web ?>px;
        <?php } ?><?php if ($daily_hours_start_title->color) { ?>color: <?= $daily_hours_start_title->color ?>;
        <?php } ?><?php if ($daily_hours_start_title->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_start_title->fontfamily) ?> !important;
        <?php } ?>
    }

    .hoursdetailtimes {
        <?php if ($busniess_hours_times->size_web) { ?>font-size: <?= $busniess_hours_times->size_web ?>px;
        <?php } ?><?php if ($busniess_hours_times->color) { ?>color: <?= $busniess_hours_times->color ?>;
        <?php } ?><?php if ($busniess_hours_times->fontfamily) { ?>font-family: <?= getfontfamily($busniess_hours_times->fontfamily) ?> !important;
        <?php } ?>
    }

    .tablehoursdetailend {
        <?php if ($daily_hours_end_title->color) { ?>font-size: <?= $daily_hours_end_title->color ?>px;
        <?php } ?><?php if ($daily_hours_end_title->color) { ?>color: <?= $daily_hours_end_title->color ?>;
        <?php } ?><?php if ($daily_hours_end_title->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_end_title->fontfamily) ?> !important;
        <?php } ?>
    }

    .tabledailyhourscomment {
        <?php if ($set_hours_comment->size_web) { ?>font-size: <?= $set_hours_comment->size_web ?>px;
        <?php } ?><?php if ($set_hours_comment->color) { ?>color: <?= $set_hours_comment->color ?>;
        <?php } ?><?php if ($set_hours_comment->fontfamily) { ?>font-family: <?= getfontfamily($set_hours_comment->fontfamily) ?>;
        <?php } ?>
    }

    @media only screen and (max-width: 600px) {
        .tabledailyhourscomment {
            <?php if ($set_hours_comment->size_mobile) { ?>font-size: <?= $set_hours_comment->size_mobile . 'px' ?> <?php } ?>
        }
    }

    .hoursdetailstart {
        <?php if ($daily_hours_start_title->size_web) { ?>font-size: <?= $daily_hours_start_title->size_web ?>px;
        <?php } ?><?php if ($daily_hours_start_title->color) { ?>color: <?= $daily_hours_start_title->color ?>;
        <?php } ?><?php if ($daily_hours_start_title->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_start_title->fontfamily) ?> !important;
        <?php } ?>
    }

    .hoursdetailend {
        <?php if ($daily_hours_end_title->size_web) { ?>font-size: <?= $daily_hours_end_title->size_web ?>px;
        <?php } ?><?php if ($daily_hours_end_title->color) { ?>color: <?= $daily_hours_end_title->color ?>;
        <?php } ?><?php if ($daily_hours_end_title->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_end_title->fontfamily) ?> !important;
        <?php } ?>
    }

    .dailyhourscomment {
        <?php if ($busniess_hours_comments->size_web) { ?>font-size: <?= $busniess_hours_comments->size_web ?>px;
        <?php } ?><?php if ($busniess_hours_comments->color) { ?>color: <?= $busniess_hours_comments->color ?>;
        <?php } ?>;
        margin-bottom: 5px;
    }

    .dailyhourslist .singledailyhour {
        padding-bottom: 10px;
        <?php if ($rotatingScheduleSettings->day_tile_bg_color) { ?>background: <?= $rotatingScheduleSettings->day_tile_bg_color ?> !important;
        <?php } elseif ($rotatingScheduleSettings->background) { ?>background: <?= $rotatingScheduleSettings->background ?> !important;
        <?php } ?>
    }

    .features-toggle {
        <?php if ($audioFiles->audio_files && json_decode($audioFiles->audio_files)) { ?>bottom: 60px !important;
        <?php } else { ?>bottom: 0px !important;
        <?php } ?>left: 50% !important;
        transform: translate(-50%) !important;
    }

    .audio-file-label {
        bottom: -9px;
        left: 504px;
        transform: translate(-50%) !important;
        position: fixed;

    }

    .hours {
        <?php if ($daily_hours_set_1->color) { ?>color: <?= $daily_hours_set_1->color ?> !important;
        <?php } ?><?php if ($daily_hours_set_1->size_web) { ?>font-size: <?= $daily_hours_set_1->size_web ?>px !important;
        <?php } ?><?php if ($daily_hours_set_1->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_set_1->fontfamily) ?> !important;
        <?php } ?>
    }

    .hours2 {
        float: left;
        <?php if ($daily_hours_set_2->color) { ?>color: <?= $daily_hours_set_2->color ?> !important;
        <?php } ?><?php if ($daily_hours_set_2->size_web) { ?>font-size: <?= $daily_hours_set_2->size_web ?>px !important;
        <?php } ?><?php if ($daily_hours_set_2->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_set_2->fontfamily) ?> !important;
        <?php } ?>
    }

    .outline-color-action-btn {
        position: absolute;
        right: -56px;
        top: 110px;
    }

    #myLinks {
        left: 50% !important;
        transform: translate(-50%) !important;
        width: 48%
    }

    @media (max-width: 768px) {
        #myLinks {
            left: unset !important;
            transform: unset !important;
            width: 100% !important;
        }
    }

    .downlaodtext {
        text-decoration: none;
        <?php if ($download_text->color) { ?>color: <?= $download_text->color ?> !important;
        <?php } ?><?php if ($download_text->size_web) { ?>font-size: <?= $download_text->size_web ?>px !important;
        <?php } ?><?php if ($download_text->fontfamily) { ?>font-family: <?= getfontfamily($download_text->fontfamily) ?> !important;
        <?php } ?>
    }

    .downlaodquestion {
        text-decoration: none;
        margin-top: 0px;
        <?php if ($download_question_text->color) { ?>color: <?= $download_question_text->color ?> !important;
        <?php } ?><?php if ($download_question_text->size_web) { ?>font-size: <?= $download_question_text->size_web ?>px !important;
        <?php } ?><?php if ($download_question_text->fontfamily) { ?>font-family: <?= getfontfamily($download_question_text->fontfamily) ?> !important;
        <?php } ?>
    }


    .LSlinks {
        line-height: 1;
        text-decoration: underline;
        padding-bottom: 20px;
        <?php if ($hyper_link_text->color) { ?>color: <?= $hyper_link_text->color ?> !important;
        <?php } ?><?php if ($hyper_link_text->size_web) { ?>font-size: <?= $hyper_link_text->size_web ?>px !important;
        <?php } ?><?php if ($hyper_link_text->fontfamily) { ?>font-family: <?= getfontfamily($hyper_link_text->fontfamily) ?> !important;
        <?php } ?>
    }

    .LSlinksLinks {
        line-break: anywhere;
        line-height: 1;
        text-decoration: underline;
        padding-bottom: 20px;
        <?php if ($hyper_link_link->color) { ?>color: <?= $hyper_link_link->color ?> !important;
        <?php } ?><?php if ($hyper_link_link->size_web) { ?>font-size: <?= $hyper_link_link->size_web ?>px !important;
        <?php } ?><?php if ($hyper_link_link->fontfamily) { ?>font-family: <?= getfontfamily($hyper_link_link->fontfamily) ?> !important;
        <?php } ?>
    }

    .todaytitle {
        line-height: 1;
        <?php if ($daily_hours_today->size_web) { ?>font-size: <?= $daily_hours_today->size_web ?>px !important;
        <?php } ?><?php if ($daily_hours_today->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours_today->fontfamily) ?> !important;
        <?php } ?><?php if ($daily_hours_today->color) { ?>color: <?= $daily_hours_today->color   ?>;
        <?php } ?>
    }

    .sicialmediaicon {
        <?php if (isset($social_media_icon)) { ?><?php if ($social_media_icon->color) { ?>color: <?= $social_media_icon->color ?> !important;
        <?php } ?><?php if ($social_media_icon->bg_color) { ?>background: <?= $social_media_icon->bg_color ?> !important;
        <?php } ?><?php } ?>
    }

    .footer-links {
        <?php if (isset($social_media_icon)) { ?><?php if ($social_media_icon->bg_color) { ?>color: <?= $social_media_icon->bg_color ?> !important;
        <?php } ?><?php if ($social_media_icon->bg_color) { ?>border: <?= $social_media_icon->bg_color ?> solid !important;
        <?php } ?><?php } ?>
    }


    #header {
        position: relative;
        padding: 5px;
        <?php if ($alertBannerSettings->alert_banner_override_bg == '1' && $alert_banner_text->bg_color) {
            echo 'background:' . $alert_banner_text->bg_color;
        } else {
            echo 'background:#fff';
        } ?>
    }

    <?php if ($alert_banner_action_button_text->text) { ?>.alertbannerbtn {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    @media (max-width: 981px) {
        .alert_banner_action_button_text {
            font-size: 12px;
        }
    }

    <?php } ?>.alertbannertext {
        margin-top: 8px;
        margin-bottom: 8px;
    }

    <?php if ($alert_banner_text->color) { ?>.alertbannertext>a {
        color: <?= $alert_banner_text->color ?>
    }

    .likes-banner {
        color: <?= $alert_banner_text->color ?>
    }

    .business-svgs svg path {
        fill: <?= $alert_banner_text->color ?>;
        /* Change the color to red or any desired color */
    }

    .service-svgs svg path {
        fill: <?= $alert_banner_text->color ?>;
        /* Change the color to red or any desired color */
    }

    .website-svgs svg path {
        fill: <?= $alert_banner_text->color ?>;
        /* Change the color to red or any desired color */
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
 
    .submit-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white !important;
    }
    <?php } ?>.mybtn-primary {
        <?= ($alert_banner_action_button_text->bg_color) ? 'background:' . $alert_banner_action_button_text->bg_color . ';' : ''; ?><?= ($alert_banner_action_button_text->color) ? 'color:' . $alert_banner_action_button_text->color . ';' : ''; ?>
    }

    /* To handle app requests layouts */
    <?php
    if ($is_app) {
    ?>#myLinks {
        padding: 60px 0 !important;
    }

    #header {
        margin-top: 5% !important;
        padding-top: 10px !important;
    }

    .headerdiv {
        margin-top: 50px !important;
    }

    .barsbtn {
        right: 10px;
    }

    .slick-next {
        right: -10px !important;
        z-index: 100 !important;
    }

    .slick-previous {
        left: -10px !important;
        z-index: 100 !important;
    }

    .slick-prev {
        left: -10px !important;
        z-index: 100 !important;
    }

    .fa-bars {
        padding: 10px !important;
    }

    <?php

    }
    ?>.menu-icon-text {
        display: none;
    }


    .alertbannertext {
        display: block;
    }

    .mobile-banner {
        display: none;
    }

    .desktop-banner {
        display: block;
    }

    .alertbannerbtn {
        padding-right: 0px;
    }

    <?php
    if ($menu_alert_logo->file_name) {
    ?>.alertbannerlogo {
        display: block;
        width: <?= $menu_alert_logo->max_width ? $menu_alert_logo->max_width . 'px' : '100px' ?>;
    }

    <?php
    } else {
    ?>.alertbannerlogo {
        display: none;
    }

    <?php
    }
    ?>.btnbars {
        display: grid !important;
        text-align: center !important;
    }

    .btnbars.icon {
        font-size: 10px !important;
        text-decoration: none;
        margin-bottom: 3px;
    }

    .menu-icon-text {
        display: block;
        <?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->size_web) {
            echo 'font-size: ' . $alert_banner_menu_icon_text->size_web . 'px;';
        } ?><?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->color) {
                echo 'color: ' . $alert_banner_menu_icon_text->color . '!important;';
            } ?><?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->fontfamily) {
                    echo 'font-family: ' . getfontfamily($alert_banner_menu_icon_text->fontfamily) . ';';
                } ?>;
    }

    <?php
    if (isset($engagement_notification->engagement_toggle) && $engagement_notification->engagement_toggle) {
    ?>.likes-banner {
        display: none !important;
    }

    <?php } ?>@media only screen and (max-width: 600px) {
        .alertbannertext {
            /*display:none;*/
        }
        
        .desktop-banner {
            display: none !important;
        }
        <?php
        if ($menu_alert_logo->file_name) {
        ?>.alertbannerlogo {
            display: block;
            width: <?= $menu_alert_logo->min_width ? $menu_alert_logo->min_width . 'px' : '100px' ?>;
        }

        .alertbannerbtn {
            padding-right: 15px !important;
        }

        .mobile-banner {
            display: block;
        }

        <?php
        } else {
        ?>.alertbannerlogo {
            display: none;
        }

        .mobile-banner {
            display: none;
        }

        .desktop-banner {
            display: block;
        }

        .alertbannerbtn {
            padding-right: 0px;
        }

        <?php
        }
        ?>.menu-icon-text {
            display: block;
            <?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->size_mobile) {
                echo 'font-size: ' . $alert_banner_menu_icon_text->size_mobile . 'px;';
            } ?><?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->color) {
                    echo 'color: ' . $alert_banner_menu_icon_text->color . '!important;';
                } ?><?php if ($alert_banner_menu_icon_text && $alert_banner_menu_icon_text->fontfamily) {
                        echo 'font-family: ' . getfontfamily($alert_banner_menu_icon_text->fontfamily) . ';';
                    } ?>;
        }



    }

    .selectedimgdiv {
        border: 4px solid #00A4FF !important;
    }

    .alert_banner_action_button_text{
        margin-bottom: 0px !important;
    }

    .menu_icon_color {}

    .likes-banner {
        height: 58px;
        display: flex;
        align-items: center;
    }
    .burger-menu-txt{
        margin-top: 3px;
    }

    .likes-container {
        display: flex;
        justify-content: space-between;
        gap: 2px;
    }

    .Website-txt{
            font-size: 11px;
            font-weight: 600;
        }
        .Service-text{
            font-size: 11px;
            font-weight: 600;
        }
        .Business-text{
            font-size: 11px;
            font-weight: 600;
        }
    @media (max-width: 895px) {
        .hide-on-mob {
            display: none;

        }
    }

    @media (min-width: 992px) {
        .custom-col-3 {
            width: 23%;
        }
    }

    @media (max-width: 992px) {
        .custom-sm-3 {
            width: 27%;
        }
    }

    @media (max-width: 600px) {
        .custom-sm-3 {
            width: 80%;
        }
    }

    .space-between {
        justify-content: space-between;
    }

    .website-text {
        display: none;
    }

    @media (max-width: 600px) {
        .alertbannertext{
            font-size: 16px;
            font-weight:700;
        }
        .website-text {
            display: block;
            bottom: 54px;
        }

       .display-table {
            bottom: 56px;
            left: 85px;
        }

        .likes-banner {
            top: 42px;
            width: 160px;
            font-size: 13px;
        }

        .mobileimg {
            top: 42px;
            width: 177px;
        }

        .mobile-banner {
            top: 42px;
            height: 58px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #header {
            height: 111px;
        }

        .display-table {
            margin-left: 61px;
        }
    }

    @media (max-width: 430px) {
        .like-icon-hd svg{
            height: 11px;
            width: 11px;
        }
        .website-count{
            font-size: 11px;
            font-weight: 600;
        }
        .service-count{
            font-size: 11px;
            font-weight: 600;
        }
        .business-count{
            font-size: 11px;
            font-weight: 600;
        }
        .Website-txt{
            font-size: 9px;
            font-weight: 600;
        }
        .Service-text{
            font-size: 9px;
            font-weight: 600;
        }
        .Business-text{
            font-size: 9px;
            font-weight: 600;
        }
        .alertbannertext{
            font-size: 16px;
            font-weight:700;
        }
        .likes-banner {
            top: 50px;
            width: 150px;
        }

        .display-table {
            margin-left: unset;
            left: 120px;
        }
        .mobileimg {
            width: 150px;
            top: 50px;
        }
    }

    @media (max-width: 390px) {
        .display-table {
            margin-left: unset;
            left: 96px;
        }
    }
        @media (max-width: 324px) {
        .display-table {
            bottom: 105px;
        }
        .website-text{
            bottom: 111px;
        }
        .mobile-banner {
            top: -8px;
            left: 162px;
        }
    }
    
</style>