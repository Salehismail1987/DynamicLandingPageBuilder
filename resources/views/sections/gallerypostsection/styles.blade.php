<style>
  .carousel-control{
        top: 50% !important;
        bottom: unset;
    }
  .control-slider{
        top: 30% !important;
        bottom: unset;
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
    <?php 
    foreach ($home_data_gallery_posts as $single) {
        $post_iamges = getpostimages($single->id);
        if ($post_iamges && count($post_iamges) > 0) {
            foreach ($post_iamges as $singleimg) { 
    ?>
                .post_image_<?=$singleimg->id?>{
                <?php 
                if(isset($single->post_image_size) && !empty($single->post_image_size)){
                    ?>
                    
                       width:<?=$single->post_image_size?>px;
                       height:<?=$single->post_image_size?>px;
                    <?php 
                }else{
                    ?>
                    
                   width:100%;
                    <?php 
                }
                    ?>
                }
    <?php 
            }
        }
        if (isset($single->action_button_active) && $single->action_button_active == '1') {
        ?>
            .gallery-post-action-button-<?=$single->id?>{
                margin-bottom: 10px;
                <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . '! important;' : '' ?>
                 <?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
            }
        <?php
        } 
    }?>
    .gallerypostdesc {
        text-align: justify;
    }

    .gallery_post_slider_image_right{
        display: unset !important;
    }

    .gallery_post_slider_image_left{
        display: unset !important;
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

   <?php if ($home_data_gallery_posts && count($home_data_gallery_posts) > 0) {
        foreach ($home_data_gallery_posts as $single) {
            if ($galleriesSettings->gallery_post_use_generic == '1') {

                $title_font_family = 'font-family:' . ($generic_gallery_post_title->fontfamily ? getfontfamily($generic_gallery_post_title->fontfamily) . ' !important;' : ';');
                $title_color = 'color:' . ($generic_gallery_post_title->color ? $generic_gallery_post_title->color . ' !important;' : '#000;');
                $title_background = 'background:' . ($generic_gallery_post_title->bg_color ? $generic_gallery_post_title->bg_color . ' !important;' : '#000;');
                $title_font_size = 'font-size:' . ($generic_gallery_post_title->size_web ? $generic_gallery_post_title->size_web . 'px !important;' : ';');
                $title_font_size_mobile = 'font-size:' . ($generic_gallery_post_title->size_mobile ? $generic_gallery_post_title->size_mobile . 'px !important;' : ';');

                $desc_font_family = 'font-family:' . ($generic_gallery_post_desc->fontfamily ? getfontfamily($generic_gallery_post_desc->fontfamily) . ' !important;' : ';');
                $desc_color = 'color:' . ($generic_gallery_post_desc->color ? $generic_gallery_post_desc->color . ' !important;' : '#000;');
                $desc_font_size = 'font-size:' . ($generic_gallery_post_desc->size_web ? $generic_gallery_post_desc->size_web . 'px !important;' : ';');

    ?>.galleryposttitle {
        <?= $title_font_family ?><?= $title_color ?><?= $title_background ?><?= $title_font_size ?>
    }

    .gallerypostdesc {
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_color ?><?= $desc_font_size ?><?= $title_background ?>
    }
    .gallerypostdesctxt {
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_color ?><?= $desc_font_size ?>
    }

    @media only screen and (max-width: 600px) {
        .galleryposttitle {
            line-height: 1;
            <?= $title_font_size_mobile ?>
        }

        .gallery_post_slider_container img{
            object-fit: contain !important;
            height: auto !important;
        }
    }

    <?php
            } else {

                $title_font_family = 'font-family:' . ($single->post_font_family ? getfontfamily($single->post_font_family) . ' !important;' : ';');
                $title_color = 'color:' . ($single->post_title_color ? $single->post_title_color . ' !important;' : '#000;');
                $title_font_size = 'font-size:' . ($single->post_title_font_size ? $single->post_title_font_size . 'px !important;' : ';');
                $title_font_size_mobile = 'font-size:' . ($single->post_title_font_size_mobile ? $single->post_title_font_size_mobile . 'px !important;' : ';');
                $title_background = 'background:' . ($single->post_title_bcakground ? $single->post_title_bcakground . ' !important;' : '#000;');

                $desc_font_family = 'font-family:' . ($single->post_desc_font_family ? getfontfamily($single->post_desc_font_family) . ' !important;' : ';');
                $desc_font_size = 'font-size:' . ($single->post_desc_font_size ? $single->post_desc_font_size . 'px !important;' : ';');
                $desc_text_color = 'color:' . ($single->description_text_color ? $single->description_text_color . ' !important;' : '#000;');


    ?>#galleryposttitle<?= $single->id ?> {
        <?= $title_font_family ?><?= $title_color ?><?= $title_background ?><?= $title_font_size ?>
    }
    #gallerypostdesctxt<?= $single->id ?> {
        text-align: justify;
        <?= $desc_font_family ?><?= $desc_font_size ?><?= $desc_text_color ?>
    }

    #gallerypostdesc<?= $single->id ?> {
        <?= $desc_font_size ?><?= $desc_font_family ?><?= $title_color ?><?= $title_background ?>
    }
    .descpostgall_icon_<?= $single->id ?>{
        <?= $desc_font_size ?><?= $title_color ?>
    }
    .gallery-post-desc-div-<?= $single->id ?>{
        <?= $desc_font_size ?><?= $desc_font_family ?><?= $title_color ?><?= $title_background ?>
    }

    <?php
            }
        }
    }

    ?>

    #gallerypostsection::before {
        content: '';
        display: block;
        
        
        visibility: hidden;
    }

    /* (Hassan) Add margin bottom to gallery post desciption */
    .gallerypostdesc{
        margin-bottom: 10px;
    }
.gallery_posts_bg{
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
          } elseif( $galleriesSettings->gallery_post_background && $galleriesSettings->gallery_posts_override_bg=='1'){
            echo 'background:'.$galleriesSettings->gallery_post_background.' !important';
          } else
          {
            echo 'background:transparent !important';
          }
          ?>   
}

<?php 
if($galleriesSettings->gallery_posts_arrow_color || $galleriesSettings->gallery_posts_arrow_bg_color ){
    ?>
    @if($galleriesSettings->gallery_posts_arrow_bg_color)
      #gallerypostsection  .ccright ,  #gallerypostsection  .ccleft {
            background: <?=$galleriesSettings->gallery_posts_arrow_bg_color;?> !important;
        }
    @endif
    @if($galleriesSettings->gallery_posts_arrow_color)
        #gallerypostsection    .ccright,  #gallerypostsection  .ccleft {
            color: <?=$galleriesSettings->gallery_posts_arrow_color;?> !important;
        }
    @endif
    <?php 
}
if($gallery_posts_title_setting->enable_theme_bg =='1'){
    ?>
    .gallery_posts_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
 .gallery_posts_bg  img{
      max-width: 100%;
  }
  .read_more_link{
      text-decoration:underline;
      cursor: pointer;
    }
    .read_less_link{
      text-decoration:underline;
      cursor: pointer;
    }
</style>