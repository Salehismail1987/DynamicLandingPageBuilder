<style>
  #gallerytilesection::before {
    content: '';
    display: block;
    visibility: hidden;
  }

  #gallerytilesection{
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

  .gallery-tiles-title {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
   
  }

  .gallery-tiles-subtitle {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    
  }
     <?php
    foreach ($gallery_tiles as $single) {
        if ($galleriesSettings->gallery_tiles_use_generic) {

            $desc_font_family = 'font-family:' . ($generic_gallery_tiles_text->fontfamily ? getfontfamily($generic_gallery_tiles_text->fontfamily) . ';' : ';');
            $desc_color = 'color:' . ($generic_gallery_tiles_text->color ? $generic_gallery_tiles_text->color . ';' : '#000;');
            $desc_font_size = 'font-size:' . ($generic_gallery_tiles_text->size_web ? $generic_gallery_tiles_text->size_web . 'px;' : ';');
        } else {

            $desc_font_family = 'font-family:' . ($single->description_font ? getfontfamily($single->description_font) . ';' : ';');
            $desc_color = 'color:' . ($single->description_color ? $single->description_color . ';' : '#000;');
            $desc_font_size = 'font-size:' . ($single->description_size ? $single->description_size . 'px;' : ';');
        }
        ?>
        #tileImage<?= $single->id ?>{
            width:100%;cursor:pointer;
        }
        .gallery_tiles_desc<?= $single->id?>{
            text-align: center;
            <?=$desc_font_family?>
            <?=$desc_color?>
            <?=$desc_font_size?>
        }
        <?php 
    }

    ?>

  .tile_modal {
    display: none;
    position: fixed;
    z-index:99999;
    padding-top: 20px;
    left: 0;
    top: 0px;
    width: 100%;
    max-height: auto;
    max-height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
  }

  .tile_modal-content {
    width: 80%;
    margin: auto;
    display: block;
    max-width: 100%;
    max-height: 80vh;
    height: 80vh;
    object-fit: contain;
  }

  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  .tile_modal-content,
  #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @keyframes zoom {
    from {
      transform: scale(0)
    }

    to {
      transform: scale(1)
    }
  }

  .close {
    position: absolute;
    top: 5px;
    right: 15px;
    color: #c7c7c7;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    opacity: 1;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  @media only screen and (max-width: 700px) {
    .tile_modal {
      padding-top: 50px;
      top: 0;
      height: auto;
    }
    .tile_modal-content {
      max-width: 100%;
      width: 100%;
      height: auto;
    }
  }

  .gallery_tiles_bg{
    background:<?= $galleriesSettings->gallery_tiles_background && $galleriesSettings->gallery_tiles_override_bg=='1' ? $galleriesSettings->gallery_tiles_background : 'transparent' ?>
  }
<?php 
if($gallery_tiles_title_setting->enable_theme_bg =='1'){
    ?>
    .gallery_tiles_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>


</style>