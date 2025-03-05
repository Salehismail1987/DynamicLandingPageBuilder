<style>
.copyright{
    color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;
}
.address_for_map{
    text-align: left;
}
.footer-audio{
    position: fixed;bottom: 0;left: 50%;
    /* transform: translate(-50%); */
}
.footer-links {
        height: max-content;
        display: flex;
        margin-top: -22px;
        /* left: 365px; */
        padding-left: 6px;
        /* height: 75px; */
    }
    .footer-links {
        <?php if(isset($siteSettings->site_background_color) && $siteSettings->site_background_color != 'null') { ?>
            background: <?= $siteSettings->site_background_color ?>;
        <?php } else if ($siteSettings->site_background_theme == '1') { ?>
            background: white;
        <?php } else if ($siteSettings->site_background_theme == '0') { ?>
            background: black;
        <?php } ?>

        <?php if(isset($social_media_icon)) { ?>
            <?php if ($social_media_icon->bg_color) { ?>
                color: <?= $social_media_icon->bg_color ?> !important;
                border: <?= $social_media_icon->bg_color ?> solid !important;
            <?php } ?>
        <?php } ?>
    }
.social_media_footer_container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        align-items: center;
    }

    .icons-container {
        padding: 20px 1px 0px 4px;
    }

    .social_media_footer_container a {
        height: 35px;
        width: 35px;
        text-align: center;
        margin-bottom: 2px;
    }
    .footer_logo_div {
        bottom: 37px;
        top: 0px;
        height: max-content;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .footer_div {
        height: max-content !important;
    }
    h4 {
        font-size: 14.5px;
    }
</style>