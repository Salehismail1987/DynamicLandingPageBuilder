<style>
    .gallary_slider_description_text {
        text-align: justify;
        padding: 1rem;
        padding-bottom: 0;
        margin: 0 auto;
        width: 88%;
    }

    .galleryslidertitle {
        padding: 20px !important;
        text-align: center !important;
        line-height: 1;
        <?php if ($gallery_slider_title->color) { ?>color: <?= $gallery_slider_title->color ?> !important;
        <?php } ?><?php if ($gallery_slider_title->bg_color) { ?>background: <?= $gallery_slider_title->bg_color ?> !important;
        <?php } ?><?php if ($gallery_slider_title->size_web) { ?>font-size: <?= $gallery_slider_title->size_web ?>px !important;
        <?php } ?><?php if ($gallery_slider_title->fontfamily) { ?>font-family: <?= getfontfamily($gallery_slider_title->fontfamily) ?> !important;
        <?php } ?>
    }

    <?php
    if ($gallery_slider_title->size_mobile) {
    ?>@media only screen and (max-width: 600px) {
        .galleryslidertitle {
            text-align: center !important;
            <?= 'font-size:' . ($gallery_slider_title->size_mobile ? $gallery_slider_title->size_mobile . 'px' : '18px') . ' !important;' ?>
        }
    }

    <?php
    }
    ?>
    <?php if ($gallerySlider && count($gallerySlider) > 0) {
        foreach ($gallerySlider as $single) {

            if ($galleriesSettings->gallery_slider_use_generic) {

                $gallery_slider_desc_font_family = 'font-family:' . ($generic_gallery_slider_text->fontfamily ? getfontfamily($generic_gallery_slider_text->fontfamily) . ' !important;' : ';');
                $gallery_slider_desc_color = 'color:' . ($generic_gallery_slider_text->color ? $generic_gallery_slider_text->color . ' !important;' : '#000;');
                $gallery_slider_desc_background = 'background:' . ($generic_gallery_slider_text->bg_color ? $generic_gallery_slider_text->bg_color . ' !important;' : '#000;');
                $gallery_slider_desc_font_size = 'font-size:' . ($generic_gallery_slider_text->size_web ? $generic_gallery_slider_text->size_web . 'px !important;' : ';');
                $gallery_slider_desc_font_size_mobile = 'font-size:' . ($generic_gallery_slider_text->size_mobile ? $generic_gallery_slider_text->size_mobile . 'px !important;' : ';');


    ?>.gallary_slider_description_text {
        <?= $gallery_slider_desc_font_family ?><?= $gallery_slider_desc_color ?><?= $gallery_slider_desc_background ?><?= $gallery_slider_desc_font_size ?>
    }

    @media only screen and (max-width: 600px) {
        .gallary_slider_description_text {
            text-align: justify;
            <?= $gallery_slider_desc_font_size_mobile ?>
        }
    }

    <?php
            } else {

                $gallery_slider_desc_font_family = 'font-family:' . ($single->font_family ? getfontfamily($single->font_family) . ' !important;' : ';');
                $gallery_slider_desc_color = 'color:' . ($single->text_color ? $single->text_color . ' !important;' : '#000;');
                $gallery_slider_desc_font_size = 'font-size:' . ($single->text_fontsize ? $single->text_fontsize . 'px !important;' : ';');
                $gallery_slider_desc_font_size_mobile = 'font-size:' . ($single->text_fontsize_mobile ? $single->text_fontsize_mobile . 'px !important;' : ';');
                $gallery_slider_desc_background = 'background:' . ($single->back_color ? $single->back_color . ' !important;' : '#000;');


    ?>#gallary_slider_description_text<?= $single->id ?> {
        <?= $gallery_slider_desc_font_family ?><?= $gallery_slider_desc_color ?><?= $gallery_slider_desc_background ?><?= $gallery_slider_desc_font_size ?>
    }


    @media only screen and (max-width: 600px) {
        #gallary_slider_description_text<?= $single->id ?> {
            <?= $gallery_slider_desc_font_size_mobile ?>
        }
    }

    <?php
            }
        }
    }

    ?>

    #galleryslider::before {
        content: '';
        display: block;
        height: 0px;
        
        visibility: hidden;
    }
    .carousel-control{
        top: 30%;
        bottom: unset;
    }
    .carousel-imgdiv{
        min-height: 80px;
    }
    @media only screen and (max-width: 1200px){
        /*Tablets [601px -> 1200px]*/
        .carousel-control{
            top: 20%;
        }
    }
    @media only screen and (max-width: 600px){
        /*Big smartphones [426px -> 600px]*/
        .carousel-control{
            top: 20%;
        }
    }
    @media only screen and (max-width: 425px){
        .carousel-control{
            top: 20%;
        }
    }
    .gallery-slider-bg{
        <?php
    if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }?>
         <?php 
          } elseif($galleriesSettings->gallery_slider_override_bg=='1' && $galleriesSettings->gallery_slider_background){
            echo 'background:'.$galleriesSettings->gallery_slider_background.' !important';
          } else{ 
              echo 'background:';
          } 
          ?> 
    }

    .slider-container{
        width: 83%;
    }

    .carousel-caption
    {
        padding-top: 0;padding-bottom: 0px;
    }
    
    .img-slider{
        width:88% !important;
    }
    /* (Hassan) Adding padding bottom */
    #galleryslider .slider-container{
        padding-bottom: 20px !important;
    }

    

<?php 
if($gallery_slider_title_setting->enable_theme_bg =='1'){
    ?>
    .galleryslidertitle{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
</style>