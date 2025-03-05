<style>
  .d-flex{
    display:flex;
  }
  .main-content-block{
    display: flex;
  }
  .contentmainimage{
    padding:0 15px;
    <?= ($contentBlockSettings->block_image_size) ? 'width:'.($contentBlockSettings->block_image_size+30).'px !important;' : ''?>
  }
  p:has(em) {
      font-family: sans-serif; /* Override the font family */
  }
  <?php
    if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
  ?>
  /* .content-subblock{
    display: flex;
  } */
  <?php
    }else{
  ?>
  .content-subblock{
    display: flex;
    justify-content: space-between;
  }
  <?php
    }
  ?>
  .content-subblock img{
    width:<?=$contentBlockSettings->block_subimage_size?$contentBlockSettings->block_subimage_size.'px':'300px'?> !important;
  }
  @media screen and (max-width: 1150px) {
    .main-content-block  img{
      
    }
  }
  @media screen and (max-width: 990px) {
    .main-content-block{
      display: unset;
    }
    .contentmainimage{
      width:auto !important;
    }
    /* .content-subblock{
      display: unset;
    } */

  }
  @media screen and (min-width: 991px) {
 
    .content-subblock{
      display: flex;
      flex-direction: column;
    }

  }
  @media screen and (max-width: 600px) {
    .content-subblock{
      display: unset;
    }
    .content-subblock img{
      width:100% !important;
    }
  }
  @media screen and (max-width: 500px) {
    .main-content-block  img{
      width:100% !important;
    }
  }
  @media screen and (max-width: 767px) {
    .column {
      width: 50%;
    }
  }
  #contentblocksection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  .conentblocktitle {
    line-height: 1;
    padding: 20px !important;
    text-align: center !important;
    
  }

  #contentblocksection p{
    text-align:justify !important;
  }

  

  <?php
  

  if ($contentBlockSettings->use_generic) {
    $subtitle_fontfamily = 'font-family:' . ($generic_content_block_subtitle->fontfamily ? getfontfamily($generic_content_block_subtitle->fontfamily) . ' !important;' : ';');
    $subtitle_color = 'color:' . ($generic_content_block_subtitle->color ? $generic_content_block_subtitle->color . ' !important;' : '#000;');
    $subtitle_fontsize = 'font-size:' . ($generic_content_block_subtitle->size_web ? $generic_content_block_subtitle->size_web . 'px !important;' : ';');

    $desc_fontfamily = 'font-family:' . ($generic_content_block_desc->fontfamily ? getfontfamily($generic_content_block_desc->fontfamily) . ' !important;' : ';');
    $desc_color = 'color:' . ($generic_content_block_desc->color ? $generic_content_block_desc->color . ' !important;' : '#000;');
    $desc_fontsize = 'font-size:' . ($generic_content_block_desc->size_web ? $generic_content_block_desc->size_web . 'px !important;' : ';');
  ?>.content-block-subtitle {
    <?= $subtitle_fontfamily ?><?= $subtitle_color ?><?= $subtitle_fontsize ?>
  }

  
  .content-block-desc {
    <?= $desc_fontfamily ?><?= $desc_color ?><?= $desc_fontsize ?>;
    line-break: anywhere;
  }
  .content-block-desc ~ p ,
  .content-block-desc ~ h5 {
    <?= $desc_fontfamily ?><?= $desc_color ?><?= $desc_fontsize ?>;
    line-break: anywhere;
        }

  <?php
  } else {
    if ($contentBlockLinks && count($contentBlockLinks->toArray())) {
       $i = 1;
        foreach ($contentBlockLinks as $single) { 
        
        $subtitle_fontfamily = 'font-family:' . ($single->content_title_font_family ? getfontfamily($single->content_title_font_family) . ' !important;' : ';');
        $subtitle_color = 'color:' . ($single->content_title_color ? $single->content_title_color . ' !important;' : '#000;');
        $subtitle_fontsize = 'font-size:' . ($single->content_title_font_size ? $single->content_title_font_size . 'px !important;' : ';');

        $desc_fontfamily = 'font-family:' . ($single->content_desc_font_family ? getfontfamily($single->content_desc_font_family) . ' !important;' : ';');
        $desc_color = 'color:' . ($single->content_desc_color ? $single->content_desc_color . ' !important;' : '#000;');
        $desc_fontsize = 'font-size:' . ($single->content_desc_font_size ? $single->content_desc_font_size . 'px !important;' : ';');
        ?>
        .action-button-content-<?=$single->id?>{
          border:none;
            margin-bottom: 10px;
            <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . ';' : '' ?> 
            <?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
        }
        #content-block-subtitle-<?= $i ?> {
            <?= $subtitle_fontfamily ?><?= $subtitle_color ?><?= $subtitle_fontsize ?>
        }

        #content-block-desc-<?= $i ?>, .desc-text-font-<?=$single->id?> {
            <?= $desc_fontfamily ?><?= $desc_color ?><?= $desc_fontsize ?>
        }

  <?php
        $i++;

    }
  }
}
if ($contentBlockLinks && count($contentBlockLinks->toArray())) {
  $i = 1;
   foreach ($contentBlockLinks as $single) { 

    ?>
    .action-button-content-<?=$single->id?>{
        border:none;
        margin-bottom: 10px;
        <?= $single->action_button_discription_color ? 'color:' . $single->action_button_discription_color . ';' : '' ?> 
        <?= $single->action_button_bg_color ? 'background:' . $single->action_button_bg_color . ';' : '' ?>
    }
    <?php
   }
  }

  ?>

<?php
    if ($step_image = check_step_image('Content Block')) { 
    ?>
    .content-block-p{
        padding-bottom: 0;
        text-align:center;
        color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;
        font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;
        <?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>

    }
    <?php 
    }?>

    .content-image-container{
        padding:0 15px;padding-left:30px;
    }

    .content_block_bg{
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
          } elseif($contentBlockSettings->content_block_background && $contentBlockSettings->content_block_override_bg=='1'){
            echo 'background:'.$contentBlockSettings->content_block_background.' !important';
          } else{ 
              echo 'transparent:';
          } 
          ?> 
  }

    <?php 
if($content_block_title_setting->enable_theme_bg =='1'){
    ?>
    .content_block_title{
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
    .content-block-desc img{
      width: 100%;
    }
</style>
