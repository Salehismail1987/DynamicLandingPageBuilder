<style>
  #videosection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  .videostitle {
        padding: 20px !important;
        text-align: center !important;
        line-height: 1;
        
    }
    <?php foreach ($galleryvideos as $single) {
        if ($galleriesSettings->gallery_video_use_generic) {

        $video_title_font_family = 'font-family:' . ($generic_gallery_video_subtitle->fontfamily ? getfontfamily($generic_gallery_video_subtitle->fontfamily) . ';' : ';');
        $video_title_color = 'color:' . ($generic_gallery_video_subtitle->color ? $generic_gallery_video_subtitle->color . ';' : '#000;');
        $video_title_background = 'background:' . ($generic_gallery_video_subtitle->bg_color ? $generic_gallery_video_subtitle->bg_color . ';' : '#000;');
        $video_title_font_size = 'font-size:' . ($generic_gallery_video_subtitle->size_web ? $generic_gallery_video_subtitle->size_web . 'px;' : ';');

        $video_desc_font_family = 'font-family:' . ($generic_gallery_video_desc->fontfamily ? getfontfamily($generic_gallery_video_desc->fontfamily) . '!important;' : ';');
        $video_desc_font_size = 'font-size:' . ($generic_gallery_video_desc->size_web ? $generic_gallery_video_desc->size_web . 'px !important;' : ';');
        $video_desc_color = 'color:' . ($generic_gallery_video_desc->color ? $generic_gallery_video_desc->color . '!important;' : ';');
        
        $video_desc_2_font_family = 'font-family:' . ($generic_gallery_video_desc->fontfamily ? getfontfamily($generic_gallery_video_desc->fontfamily) . ';' : ';');
        $video_desc_2_font_size = 'font-size:' . ($generic_gallery_video_desc->size_web ? $generic_gallery_video_desc->size_web . 'px;' : ';');
        $video_desc_2_color = 'color:' . ($generic_gallery_video_desc->color ? $generic_gallery_video_desc->color . ';' : ';');
        

        }else{

        $video_title_font_family = 'font-family:' . ($single->font_family ? getfontfamily($single->font_family) . ';' : ';');
        $video_title_color = 'color:' . ($single->text_color ? $single->text_color . ';' : '#000;');
        $video_title_background = 'background:' . ($single->back_color ? $single->back_color . ';' : '#000;');
        $video_title_font_size = 'font-size:' . ($single->title_fontsize ? $single->title_fontsize . 'px;' : ';') ;

        $video_desc_font_family = 'font-family:' . ($single->font_family_desc ? getfontfamily($single->font_family_desc) . '!important;' : ';');
        $video_desc_font_size = 'font-size:' . ($single->desc_fontsize ? $single->desc_fontsize . 'px !important;' : ';');
        $video_desc_color = 'color:' . ($single->description_color ? $single->description_color . ';!important' : ';');

        
        $video_desc_2_font_family = 'font-family:' . ($single->font_family_desc_2 ? getfontfamily($single->font_family_desc_2) . ';' : ';');
        $video_desc_2_font_size = 'font-size:' . ($single->desc_2_fontsize ? $single->desc_2_fontsize . 'px;' : ';');
        $video_desc_2_color = 'color:' . ($single->description_2_color ? $single->description_2_color . ';' : ';');
        
        }

        ?>
        .video-action-<?=$single->id?>{
            margin-bottom: 10px;
            <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . ';' : '' ?>
                 <?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
        }
        .video_title_<?=$single->id?>{

            <?= $video_title_font_family?>
            <?= $video_title_color?>
            <?= $video_title_background?>
            <?= $video_title_font_size?>
           
        }
        .video_desc_<?=$single->id?>{
            text-align:justify;
            <?= $video_desc_font_family?>
            <?= $video_desc_color?>
            <?= $video_desc_font_size?>
        }
        .video_desc_<?=$single->id?> ~ p {
            text-align:justify;
            <?= $video_desc_font_family?>
            <?= $video_desc_color?>
            <?= $video_desc_font_size?>
        }
        .video_desc_icon_<?=$single->id?>{
            <?= $video_desc_color?>
            <?= $video_desc_font_size?>
        }
        
        .video_desc_2_<?=$single->id?>{
            text-align:justify;
            <?= $video_desc_2_font_family?>
            <?= $video_desc_2_font_size?>
            <?= $video_desc_2_color?>
        }
<?php 
    }
?>
.galleryvideotitle{
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 15px !important;
}

   .video-section-bg{
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
          } elseif($galleriesSettings->gallery_video_override_bg=='1' && $galleriesSettings->gallery_video_background){
            echo 'background:'.$galleriesSettings->gallery_video_background.' !important';
          } 
          ?> 
   }

   <?php 
if($gallery_videos_title_setting->enable_theme_bg =='1'){
    ?>
    .gallery_videos_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
.galleryvideodesc img{
    width: 100%;
}

@media only screen and (max-width: 768px) {
.video-item-feature{
    max-width:100% !important;
}
}
</style>