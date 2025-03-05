<style>
  #downloadsection::before {
    content: '';
    display: block;
    height:      0px;
    
    visibility: hidden;
  }

  .downloadtitle{
    padding:20px !important;
    text-align:center !important;
    line-height: 1;

  }
  #downloadsection img{ /* (Hassan) Add image properties */
    object-fit: cover;
    object-position: center;
  }

  .download-section{
    display: flex;
    flex-direction: row;
    align-content: stretch;
    justify-content: space-between;
  }

  .download-image {
    max-width:100%;
  }

  <?php 
if($download_title_setting->enable_theme_bg =='1'){
    ?>
    .download_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

  #downloadsection {
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
  .downloads_feature_bg{
    <?php
    if(!$setting->section_enabled == 0 )
    { ?>
        <?= isset($downloads_settings->bg_color) && $downloads_settings->override_bg=='1'?'background:'.$downloads_settings->bg_color.';':'';?>
    <?php }
    ?>
 
  }
@media screen and (max-width: 600px) {

  .download-image{
    max-width: 100%;
  }
}

</style>