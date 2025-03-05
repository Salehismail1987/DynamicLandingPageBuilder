<style>
  .newsposttitle{
    padding: 10px 0
  }
  .mtop-1{
      padding-top: 0.5rem !important;
  }
  #newspostsection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  #newspostsection{
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
           }
     
         }
         ?> 
  }

  .newspoststitle {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    
  }
  <?php  foreach ($newsPosts as $single) {
          if ($newsPostSettings->use_generic_news_post_setting) { 

            $title_font_family = 'font-family:' . ($generic_news_post_title->fontfamily ? getfontfamily($generic_news_post_title->fontfamily) . ';' : ';');
            $title_color = 'color:' . ($generic_news_post_title->color ? $generic_news_post_title->color . ';' : '#000;');
            $title_font_size = 'font-size:' . ($generic_news_post_title->size_web ? $generic_news_post_title->size_web . 'px;' : ';');

            $desc_font_family = 'font-family:' . ($generic_news_post_desc->fontfamily ? getfontfamily($generic_news_post_desc->fontfamily) . ';' : ';');
            $desc_color = 'color:' . ($generic_news_post_desc->color ? $generic_news_post_desc->color . ';' : '#000;');
            $desc_font_size = 'font-size:' . ($generic_news_post_desc->size_web ? $generic_news_post_desc->size_web . 'px;' : ';');
             } else { 

            $title_font_family = 'font-family:' . ($single->font_family ? getfontfamily($single->font_family) . ';' : ';');
            $title_color = 'color:' . ($single->post_title_color ? $single->post_title_color . ';' : '#000;');
            $title_font_size = 'font-size:' . ($single->post_title_size ? $single->post_title_size . 'px;' : ';');

            $desc_font_family = 'font-family:' . ($single->desc_font_family ? getfontfamily($single->desc_font_family) . ';' : ';');
            $desc_color = 'color:' . ($single->post_desc_color ? $single->post_desc_color . ';' : '#000;');
            $desc_font_size = 'font-size:' . ($single->post_desc_font_size ? $single->post_desc_font_size . 'px;' : ';');
            
          }
          ?>
        .news-post-title-div-<?=$single->id?>{
            text-align:center;
            <?=$title_font_family?>
            <?=$title_color?>
            <?=$title_font_size?>
            
        }
        .news-post-desc-div-<?=$single->id?>{
            text-align: justify;text-justify: inter-word;font-weight:300;
            <?=$desc_font_family?>
            <?=$desc_color?>
            <?=$desc_font_size?>
            
        }
        .post-action-<?=$single->id?>{
            margin-bottom: 10px;<?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . ';' : '' ?> <?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
        }
       <?php }
    ?>
    .post-image{
        width:100% !important;
    }

    <?php 
if($news_posts_title_setting->enable_theme_bg =='1'){
    ?>
    .news_posts_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

.read_more_link{
      text-decoration:underline;
      cursor: pointer;
    }
    .read_less_link{
      text-decoration:underline;
      cursor: pointer;
    }
  #newspostsection  img{
      max-width: 100%;
  }

  .news_post_bg{
        background:<?= $newsPostSettings->news_post_background && $newsPostSettings->news_post_override_bg=='1' ? $newsPostSettings->news_post_background : 'transparent' ?>
  }
</style>