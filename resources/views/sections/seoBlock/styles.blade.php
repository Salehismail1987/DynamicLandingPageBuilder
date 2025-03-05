<style>
  #seoBlock::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }
  #seoBlock {
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

  .seoBlocktitle {
    padding: 20px !important;
    text-align: justify !important;
   
  }
  .seoTitle {
    padding: 20px !important;
    text-align: center !important;
   
  }
  <?php 
if($seo_title_setting->enable_theme_bg =='1'){
    ?>
    .seo_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}

?>
.seo_block_bg {
    background-color: 
    <?php 
    if ($setting->section_enabled == 1) {
        echo isset($seoSettings->seo_block_background) && $seoSettings->seo_block_override_bg == '1' 
            ? $seoSettings->seo_block_background 
            : 'transparent'; 
    } else {
        echo 'transparent'; // Default if section_enabled is not 1
    }
    ?>;
}
</style>