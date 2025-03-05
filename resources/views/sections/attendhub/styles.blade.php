<style>
    .table-container {
        /* Adjust height as needed */
        overflow-y: auto;
        /* Enable vertical scrolling */
        margin-left: -30px;
        --scrollbar-thumb: #888;
    --scrollbar-thumb-hover: #555;
    --scrollbar-track: #f1f1f1;
        /* For Firefox */
    }
/* Webkit browsers (Chrome, Safari, etc.) */
.table-container::-webkit-scrollbar {
    width: 8px;
}

.table-container::-webkit-scrollbar-track {
    background-color: var(--scrollbar-track);
}

.table-container::-webkit-scrollbar-thumb {
    background-color: var(--scrollbar-thumb);
    border-radius: 10px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background-color: var(--scrollbar-thumb-hover);
}

/* Firefox */
.table-container {
    scrollbar-color: var(--scrollbar-thumb) var(--scrollbar-track);
    scrollbar-width: thin;
}

    table,
    th,
    td,
    tr {
        border: none !important;
        border-bottom: none !important;
    }

    .attendance-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 8px;
        gap: 10px;
    }

    .attendance-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }



    .attendance-center {
        text-align: center;
    }

    .data-div{
        float: right;
    }



    /* Hide scrollbar for WebKit browsers */
    .table-container::-webkit-scrollbar {
        display: none;
        /* Hide scrollbar */
    }

    #data-table-1,
    #data-table-1 th,
    #data-table-1 td {
        border: none;
        /* Remove borders */
    }

    #data-table-1 {
        border-collapse: collapse;
        /* Optional: Prevent double borders */
        background-color: transparent;
        /* Optional: Set background color */
    }

    #data-table-1 th,
    #data-table-1 td {
        padding: 8px;
        /* Adjust padding as needed */
    }

    .carousel-control {
        top: 50% !important;
        bottom: unset;
    }

    .control-slider {
        top: 30% !important;
        bottom: unset;
    }

    .attendence_no {
        display: flex;
        justify-content: space-between;
    }

    .flex_start {
        display: flex;
        justify-content: start;
    }

    .flex_end {
        display: flex;
        justify-content: end;
    }
    thead {
    background-color: inherit; /* Inherit the background color from the parent */
}

/* Hide the gallery-mobile div on larger screens */
.gallery-mobile {
    display: none;
}

/* Show the gallery-mobile div on mobile screens */
@media screen and (max-width: 600px) {
    .gallery-mobile {
        display: block; /* or flex, depending on your layout */
    }
}
.gallery-web {
    display: block;
}

/* Show the gallery-mobile div on mobile screens */
@media screen and (max-width: 600px) {
    .gallery-web {
        display: none; /* or flex, depending on your layout */
    }
}

/* Make the table header sticky */


/* Style for tbody */

/* Optional: Style for table rows inside tbody */

    @media only screen and (max-width: 1200px) {

        /*Tablets [601px -> 1200px]*/
        .carousel-control {
            top: 20%;
        }
    }

    @media only screen and (max-width: 600px) {

        /*Big smartphones [426px -> 600px]*/
        .carousel-control {
            top: 20%;
        }
    }

    @media only screen and (max-width: 425px) {
        .carousel-control {
            top: 20%;
        }
    }

    .form-button-div {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-top: 13px;

    }
    
        @media only screen and (min-width: 1091px) {
        .form-button-div {
            margin-left: 1px;
        }
    }
    @media only screen and (min-width: 1246px) {
        .form-button-div {
            margin-left: 36px;
        }
    }
    @media only screen and (min-width: 1384px) {
        .form-button-div {
            margin-left: 62px;
        }
    }
    @media only screen and (min-width: 1421px) {
        .form-button-div {
            margin-left: 71px;
        }
    }
    @media only screen and (min-width: 1613px) {
        .form-button-div {
            margin-left: 92px;
        }
    }
    @media only screen and (min-width: 1657px) {
        .form-button-div {
            margin-left: 117px;
        }
    }
    @media only screen and (min-width: 1721px) {
        .form-button-div {
            margin-left: 130px;
        }
    }

    @media only screen and (max-width: 490px) {
        .form-button-div {
            margin-left: 7px;
        }
    }

    <?php
    foreach ($events as $single) {
        
        $post_iamges = getpostimages($single->id);
        if ($post_iamges && count($post_iamges) > 0) {
            foreach ($post_iamges as $singleimg) {
    ?>.post_image_<?= $singleimg->id ?> {
        <?php
                if (isset($single->post_image_size) && !empty($single->post_image_size)) {
        ?>width: <?= $single->post_image_size ?>px;
        height: <?= $single->post_image_size ?>px;
        <?php
                } else {
        ?>width: 100%;
        <?php
                }
        ?>
    }


    <?php
            }
        }
        if (isset($single->action_button_active) && $single->action_button_active == '1') {
    ?>.event-post-action-button-<?= $single->id ?> {
        width: fit-content;
        margin-bottom: 10px;
        <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . '!important;' : '' ?><?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
    }

    <?php
        }
    ?>.attendance-form-button-<?= $single->id ?> {
        margin-bottom: 10px;
        <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . '!important;' : '' ?><?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
    }

    <?php
    } ?>.eventpostdesc {
        text-align: justify;
    }

    .gallery_post_slider_image_right-<?= $single->id ?> {
        display: unset !important;
        max-width: 100%;
        <?= $single->image_size ? 'width:' . $single->image_size . ';' : '' ?>
    }

    .item-event {
        display: flex !important;
        justify-content: center;
    }

    /* .gallery_post_slider_image_right {
        display: unset !important;
    } */

    .gallery_post_slider_image_left {
        display: unset !important;
    }

    .gallery_post_slider_image_left-<?= $single->id ?> {
        display: unset !important;
        max-width: 100%;
        <?= $single->image_size ? 'width:' . $single->image_size . '!important;' : '' ?>
    }

    .gallerypoststitle {
        line-height: 1;
        padding: 20px !important;
        text-align: center !important;

    }

    @media only screen and (max-width: 600px) {
        .gallerypoststitle {
            text-align: center !important;

        }
    }

    <?php if ($events && count($events) > 0) {
        foreach ($events as $single) {

            if (isset($event_generic_settings) && $event_generic_settings->is_generic == 0) {
                $title_font_family = 'font-family:' . ($single->font_family ? getfontfamily($single->font_family) . ' !important;' : '');
                $title_color = 'color:' . ($single->post_title_color ? $single->post_title_color . ' !important;' : '#000;');
                $title_background = 'background:' . ($single->post_title_bg_color ? $single->post_title_bg_color . ' !important;' : '');
                $title_font_size = 'font-size:' . ($single->post_title_size_web ? $single->post_title_size_web . 'px !important;' : '');
                $title_font_size_mobile = 'font-size:' . ($single->post_title_size_mobile ? $single->post_title_size_mobile . 'px !important;' : '');

                $counter_date_time_fonts = 'font-family:' . ($single->counter_date_time_fonts ? getfontfamily($single->counter_date_time_fonts) . ' !important;' : '');
                $desc_font_family = 'font-family:' . ($single->fontfamily ? getfontfamily($single->fontfamily) . ' !important;' : '');
                $desc_color = 'color:' . ($single->description_text_color ? $single->description_text_color . ' !important;' : '');
                $desc_font_size = 'font-size:' . ($single->post_desc_font_size ? $single->post_desc_font_size . 'px !important;' : '');
                $counter_date_time_font_size = 'font-size:' . ($single->counter_date_time_font_size ? $single->counter_date_time_font_size . 'px !important;' : '');
    ?>.eventposttitle-<?= $single->id ?> {

        <?= $title_font_family ?><?= $title_color ?><?= $title_font_size ?>
    }
    
    .counter_date_time_fonts-<?= $single->id ?> {
        
        <?= $counter_date_time_fonts ?><?= $title_color ?><?= $title_font_size ?><?= $counter_date_time_font_size ?><?= 'margin-bottom: 25px;'?>
    }
    
    @media screen and (max-width: 600px) {
        .counter_date_time_fonts-<?= $single->id ?> {
            <?= $title_font_size_mobile ?> /* Mobile font size */
            <?= 'margin-bottom: 25px;'?>
        }
    }

    .attendance-container-<?= $single->id ?> {
        <?= $title_font_family ?><?= $title_color ?><?= $title_font_size ?>
    }

    #data-table-<?= $single->id ?> {
        <?= $desc_font_family ?><?= $desc_font_size ?><?= $desc_color ?>
    }

    .eventpostdesc-<?= $single->id ?> {
        border-radius: 10px;
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_color ?><?= $title_font_size ?>
    }

    .eventpostdesctxt {
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_color ?><?= $desc_font_size ?>
    }

    @media only screen and (max-width: 600px) {
        .eventposttitle {
            line-height: 1;
            <?= $title_font_size_mobile ?>
        }

        .gallery_post_slider_container img {
            object-fit: contain !important;
            height: auto !important;
        }
    }

    <?php
            } else {
                $title_font_family = 'font-family:' . (isset($event_generic_settings->sub_title_font) ? getfontfamily($event_generic_settings->sub_title_font) . ' !important;' : ';');
                $title_color = 'color:' . (isset($event_generic_settings->title_text_color) ? $event_generic_settings->title_text_color . ' !important;' : '#000;');
                $title_font_size = 'font-size:' . (isset($event_generic_settings->title_text_size_web) ? $event_generic_settings->title_text_size_web . 'px !important;' : ';');
                $counter_date_time_font_size = 'font-size:' . (isset($event_generic_settings->counter_date_time_font_size) ? $event_generic_settings->counter_date_time_font_size . 'px !important;' : ';');
                $title_font_size_mobile = 'font-size:' . (isset($event_generic_settings->title_text_size_mobile) ? $event_generic_settings->title_text_size_mobile . 'px !important;' : ';');
                $title_background = 'background:' . ($single->post_title_bg_color ? $single->post_title_bg_color . ' !important;' : '#000;');
                $counter_date_time_fonts = 'font-family:' . (isset($event_generic_settings->counter_date_time_fonts) ? getfontfamily($event_generic_settings->counter_date_time_fonts) . ' !important;' : ';');
                $desc_font_family = 'font-family:' . (isset($event_generic_settings->description_font) ? getfontfamily($event_generic_settings->description_font) . ' !important;' : ';');
                $desc_font_size = 'font-size:' . (isset($event_generic_settings->desc_size_web) ? $event_generic_settings->desc_size_web . 'px !important;' : ';');
                $desc_font_size_mobile = 'font-size:' . (isset($event_generic_settings->desc_text_size_mobile) ? $event_generic_settings->desc_text_size_mobile . 'px !important;' : ';');
                $desc_text_color = 'color:' . (isset($event_generic_settings->desc_text_color) ? $event_generic_settings->desc_text_color . ' !important;' : '#000;');
    ?>.eventposttitle-<?= $single->id ?> {

        <?= $title_font_family ?><?= $title_color ?><?= $title_font_size ?>
    }
    @media screen and (max-width: 600px) {
        .counter_date_time_fonts-<?= $single->id ?> {
            <?= $title_font_size_mobile ?> /* Mobile font size */
            <?= 'margin-bottom: 25px;'?>
        }
    }

    .counter_date_time_fonts-<?= $single->id ?> {

        <?= $counter_date_time_fonts ?><?= $title_color ?><?= $counter_date_time_font_size ?><?= 'margin-bottom: 25px;'?>
    }

    .eventpostdesc-<?= $single->id ?> {
        border-radius: 10px;
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_text_color ?><?= $desc_font_size ?>
    }
    
    .attendance-container-<?= $single->id ?> {
        <?= $title_font_family ?><?= $title_color ?><?= $title_font_size ?>
    }
    
    #data-table-<?= $single->id ?> {
        <?= $desc_font_family ?><?= $desc_font_size ?><?= $desc_text_color ?>
    }
    @media screen and (max-width: 600px) {
        .eventpostdesc-<?= $single->id ?> {
            <?= $desc_font_size_mobile ?> /* Mobile font size */
        }
        #data-table-<?= $single->id ?> {
        <?= $desc_font_size_mobile ?>
    }
    }

    #eventpostdesctxt<?= $single->id ?> {
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_font_size ?><?= $desc_text_color ?>
    }



    .descpostgall_icon_<?= $single->id ?> {
        <?= $desc_font_size ?><?= $title_color ?>
    }


    @media only screen and (max-width: 600px) {
        #galleryposttitle<?= $single->id ?> {
            <?= $title_font_size_mobile ?>
        }
    }
    
    <?php
            }
        }
    }
    
    ?>#gallerypostsection::before {
        content: '';
        display: block;
        visibility: hidden;
    }
    @media only screen and (max-width: 2000px) {
        .new-text-td{
            width: 6%;
        }
        .new_th{
            width: 7%;
            display: i;
        }
        .business{
            width: 29%;
        }
        .yes_maybe{
            width: 19%;
        }
        .guest_no{
            width: 18%;
        }
        .name{
            width: 29%;
        }
    }
    @media only screen and (max-width: 1140px) {
        .business{
            width: 34%;
        }
        .yes_maybe{
            width: 13%;
        }
        .guest_no{
            width: 18%;
        }
        .name{
            width: 31%;
        }
    }
    @media only screen and (max-width: 1100px) {
        .name{
            width: 25%;
        }
        .business{
            width: 27%;
        }
    }
    @media only screen and (max-width: 992px) {
        .event-post{
            /* margin-left: 46px; */
        }
    }

    /* (Hassan) Add margin bottom to gallery post desciption */
    .eventpostdesc {
        margin-bottom: 10px;
    }

    .attendhub_posts_bg {
        <?php
        if (isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1) {
            if ($siteSettings->site_background_theme == 0) {
                echo "background:white !important;";
            } else {
                echo "background:black !important;";
            } ?><?php
            } elseif ( isset($event_generic_settings) && $event_generic_settings->feature_bg_color && $event_generic_settings->is_generic == '1') {
                echo 'background:' . $event_generic_settings->feature_bg_color . ' !important';
            } else {
                echo 'background:transparent !important';
            }
                ?>
    }
    #sticky-header {
        <?php
        if (isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1) {
            if ($siteSettings->site_background_theme == 0) {
                echo "background:white ;";
            } else {
                echo "background:black ;";
            } ?><?php
            } elseif ( isset($event_generic_settings) && $event_generic_settings->feature_bg_color && $event_generic_settings->is_generic == '1') {
                echo 'background:' . $event_generic_settings->feature_bg_color . ' !important';
            } else {
                echo 'background:transparent ';
            }
                ?>
    }

    <?php
    if ($galleriesSettings->gallery_posts_arrow_color || $galleriesSettings->gallery_posts_arrow_bg_color) {
    ?>@if($galleriesSettings->gallery_posts_arrow_bg_color) #gallerypostsection .ccright, #gallerypostsection .ccleft {
        background: <?= $galleriesSettings->gallery_posts_arrow_bg_color; ?> !important;
    }

    @endif @if($galleriesSettings->gallery_posts_arrow_color) #gallerypostsection .ccright, #gallerypostsection .ccleft {
        color: <?= $galleriesSettings->gallery_posts_arrow_color; ?> !important;
    }

    @endif <?php
        }
        if ($gallery_posts_title_setting->enable_theme_bg == '1') {
            ?>.gallery_posts_title {
        background-color: transparent !important;
        background: transparent !important;
    }

    <?php
        }
    ?>.gallery_posts_bg img {
        max-width: 100%;
    }

    .read_more_link {
        text-decoration: underline;
        cursor: pointer;
    }

    .read_less_link {
        text-decoration: underline;
        cursor: pointer;
    }
    .margin-auto{
        margin: 0 auto;
    }
    .attendance-div-container{
        margin-top: 20px;
        display: flex;
        justify-content: end;
    }
    @media (max-width: 991px) {
    .data-div {
        float: none; /* Reset float */
    }
}
@media (max-width: 991px) {
    .attendance-div {
        /* Add your styles here */
        display: flex;
        justify-content: center;
    }
}
@media (max-width: 600px) {
    .attendance-div-container{
        margin-top: 10px;
        display: unset;
        justify-content: unset;
    }
}

/* Remove all styles above 991px */
@media (min-width: 992px) {
    .attendance-div {
        /* Reset or remove styles here */
        display: initial;
        justify-content: initial;

    }
}
    
</style>