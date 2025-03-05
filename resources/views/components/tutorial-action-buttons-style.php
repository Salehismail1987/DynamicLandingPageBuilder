<style>
    .blog {
        left: -53%;
    }

    .nav_tut {
        left: -26% !important;
    }

    .FAQs {
        left: -52px;
    }

    .tutorial-action-button {
        z-index: 99999;
    }
    .rot_sched{
        z-index: 2;
    }
    .gal_post{
        z-index: 2;
    }
    .gal_vid{
        z-index: 2;
    }
    .ContactBoxes{
        z-index: 2;
    }
    .Title_Banners{
     
        z-index: 999 !important;
          
    }
    .Outlines&Features {
        <?php if ($title == 'Outlines & Features') { ?>z-index: 1050;
        position: absolute !important;
        /* top: 48px; */
        left: 204px !important;
        transform: translateY(-100%) !important;
        <?php } ?>
    }

    .logo_top {
        <?php if ($title == 'Header Logo') { ?>top: 23px !important;
        <?php } ?>
    }

    .social_media_actions {
        <?php if ($title == 'Social Media') { ?>z-index: 1050;
        position: absolute;
        top: -4px;
        transform: translateY(-100%);
        <?php } ?>
    }

    .popup_alert {
        <?php if ($title == 'Popup Alert') { ?>z-index: 3;
        <?php } ?>
    }

    .alert_banner {
        <?php if ($title == 'Alert Banner') { ?>z-index: 7;
        <?php } ?>
    }

    .back-dashboard-div {
        padding: 1px;
        background-color: <?= isset($siteSettings->tutorial_label_color) ? $siteSettings->tutorial_label_color . ' !important;' : '#E3F3FF !important;' ?>;
    }

    .tutorial-action-button {
        padding: 15px;
        background-color: <?= isset($siteSettings->tutorial_label_color) ? $siteSettings->tutorial_label_color . ' !important;' : '#E3F3FF !important;' ?>;
    }
    .dropdown-menu{
        width: 200px;
        margin-left: -17%;
        min-width: 133px !important;
    }
    <?php if ($title == 'Popup Alert' && $popup == 0 ) {
    ?>.popup_alert {
        left: 46%;
        top: 26%;
        position: absolute;
    }

    

    .popup_switch_div {
        left: 46%;
        top: 29%;
        position: absolute;
        margin-top: 33px !important;
    }

    <?php
    } ?>
    @media only screen and (max-width: 1212px) {
        .logo_top {
            margin-right: 6px;
        }
        .social_media {
            margin-right: 6px;
        }
        .header_textt {
            margin-right: 6px;
        }
        .header_buttons {
            margin-right: 6px;
        }
        .header_images {
            margin-right: 6px;
        }
    }
    @media only screen and (max-width: 1178px) {
        .logo_top {
            margin-right: 15px;
        }
        .social_media {
            margin-right: 15px;
        }
        .header_textt {
            margin-right: 15px;
        }
        .header_buttons {
            margin-right: 15px;
        }
        .header_images {
            margin-right: 15px;
        }
    }
    @media only screen and (max-width: 1174px) {
        .logo_top {
            margin-right: 15px;
        }
        .social_media {
            margin-right: 15px;
        }
        .header_textt {
            margin-right: 15px;
        }
        .header_buttons {
            margin-right: 15px;
        }
        .header_images {
            margin-right: 15px;
        }
    }
    @media only screen and (max-width: 1154px) {
        .logo_top {
            margin-right: 20px;
        }
        .social_media {
            margin-right: 20px;
        }
        .header_textt {
            margin-right: 20px;
        }
        .header_buttons {
            margin-right: 20px;
        }
        .header_images {
            margin-right: 20px;
        }
    }
    @media only screen and (max-width: 1140px) {
        .logo_top {
            margin-right: 27px;
        }
        .social_media {
            margin-right: 27px;
        }
        .header_textt {
            margin-right: 27px;
        }
        .header_buttons {
            margin-right: 27px;
        }
        .header_images {
            margin-right: 27px;
        }
    }
    @media only screen and (max-width: 1106px) {
        .logo_top {
            margin-right: 35px;
        }
        .social_media {
            margin-right: 35px;
        }
        .header_textt {
            margin-right: 35px;
        }
        .header_buttons {
            margin-right: 35px;
        }
        .header_images {
            margin-right: 35px;
        }
    }
    @media only screen and (max-width: 1076px) {
        .logo_top {
            margin-right: 45px;
        }
        .social_media {
            margin-right: 45px;
        }
        .header_textt {
            margin-right: 45px;
        }
        .header_buttons {
            margin-right: 45px;
        }
        .header_images {
            margin-right: 45px;
        }
    }
    @media only screen and (max-width: 1034px) {
        .logo_top {
            margin-right: 55px;
        }
        .social_media {
            margin-right: 55px;
        }
        .header_textt {
            margin-right: 55px;
        }
        .header_buttons {
            margin-right: 55px;
        }
        .header_images {
            margin-right: 55px;
        }
    }
</style>