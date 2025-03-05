
<style>
  #linkssection::before {
    content: '';
    display: block;
    height:  0px;
    
    visibility: hidden;
  }

  #formssection{
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

  .LSformslinks {
        line-height: 1;
        text-decoration: underline;
        padding: 10px;
        margin-bottom:10px;
        margin-right: 10px;
        <?php if ($form_section_text->color) { ?>color: <?= $form_section_text->color ?> !important;
    <?php } ?><?php if ($form_section_text->bg_color) { ?>background: <?= $form_section_text->bg_color ?> !important;
        <?php } ?><?php if ($form_section_text->size_web) { ?>font-size: <?= $form_section_text->size_web ?>px !important;
        <?php } ?><?php if ($form_section_text->fontfamily) { ?>font-family: <?= getfontfamily($form_section_text->fontfamily) ?> !important;
        <?php } ?>
    }

  .formstitle{
    padding:20px !important;
    text-align:center !important;
    line-height: 1;
    <?php if ($form_section_title->color) { ?>color: <?= $form_section_title->color ?> !important;
    <?php } ?><?php if ($form_section_title->bg_color) { ?>background: <?= $form_section_title->bg_color ?> !important;
    <?php } ?><?php if ($form_section_title->size_web) { ?>font-size: <?= $form_section_title->size_web ?>px !important;
    <?php } ?><?php if ($form_section_title->fontfamily) { ?>font-family: <?= getfontfamily($form_section_title->fontfamily) ?> !important;
    <?php } ?>
  }
  .form_desc{
    <?=$formsSettings->form_section_desc_width?'width:'.$formsSettings->form_section_desc_width.'px;':''?>
    max-width:100%;
    margin-left: auto;
    margin-right: auto;
  }
  <?php 
  if ($form_section_title->size_mobile) {
    ?>
    @media only screen and (max-width: 600px) {
      .formstitle {
        text-align:center !important;
          <?='font-size:' . ($form_section_title->size_mobile ? $form_section_title->size_mobile . 'px' : '18px') . ' !important;' ?>
      }
    }
    <?php
  }
  ?>

  .text-center{
    text-align: center;
  }

  .pt-30{
    padding-top:30px !important;
  }

  .forms_feature_bg{
     <?=$formsSettings->feature_background_color && $formsSettings->formlinks_override_bg=='1'?'background:'.$formsSettings->feature_background_color.';':''?>
 
  }
<?php 
if($form_section_title_setting->enable_theme_bg =='1'){
    ?>
    .formstitle{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
.form_desc img{
  width: 100%;
}
</style>