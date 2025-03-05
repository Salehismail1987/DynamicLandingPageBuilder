<style>

    .links-bg-color{
      text-align: center;
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
          } elseif($hyperLinksSettings->hyperlinks_override_bg=='1' &&  $hyper_link_text->bg_color ){
            echo 'background:'.$hyper_link_text->bg_color.' !important';
          } else{ 
            if($siteSettings->site_background_color){ 
              echo 'background:';
            }
          } 
          ?> 
        
    }
  #linkssection::before {
    content: '';
    display: block;
    height:  0px;
    
    visibility: hidden;
  }

  .linkstitle{
    padding:20px !important;
    text-align:center !important;
    line-height: 1;
   
  }
 

  <?php 
if($links_title_setting->enable_theme_bg =='1'){
    ?>
    .links_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
</style>