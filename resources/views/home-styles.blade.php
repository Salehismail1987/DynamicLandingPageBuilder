<style>
<?php foreach($all_texts as $text){ ?>
    .<?=$text->slug?>{
        <?php if ($text->fontfamily) { ?>
        font-family:<?= getfontfamily($text->fontfamily) ?>; 
        <?php } ?>
        <?php if ($text->color) { ?>
            color:<?= $text->color ?> ;
        <?php } ?>
        <?php if ($text->size_web) { ?>
            font-size:<?= $text->size_web . 'px' ?>; 
        <?php } ?>
        <?php if ($text->bg_color) { ?>
            background-color:<?= $text->bg_color ?>; 
        <?php } ?>
    }
   
<?php } ?>
<?php 
if($contact_info_blocks_title_setting->enable_theme_bg =='1'){
    ?>
    .contact_info_blocks_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>


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

<?php 
if($set_hours_title_setting->enable_theme_bg =='1'){
    ?>
    .set_hours_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>


<?php 
if($schedule_title_setting->enable_theme_bg =='1'){
    ?>
    .schedule_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>


<?php 
if($staff_products_promos_title_setting->enable_theme_bg =='1'){
    ?>
    .staff_products_promos_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

<?php 
if($reviews_staff_title_setting->enable_theme_bg =='1'){
    ?>
    .reviews_staff_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

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

<?php 
if($news_feed_title_setting->enable_theme_bg =='1'){
    ?>
    .news_feed_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

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


<?php 
if($gallery_slider_title_setting->enable_theme_bg =='1'){
    ?>
    .gallery_slider_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>


<?php 
if($gallery_posts_title_setting->enable_theme_bg =='1'){
    ?>
    .gallery_posts_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

<?php 
if($faq_title_setting->enable_theme_bg =='1'){
    ?>
    .faq_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

<?php 
if($form_section_title_setting->enable_theme_bg =='1'){
    ?>
    .form_section_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

<?php if(isset($_GET['editwebsite'])){ ?>
    <?php foreach($outlineSettings as $outlineSettingsSingel){
        ?>

        <?php
        if($frontSectionSetting->active_feature_enable_on_edit =='1'){
            if('1'=='1' ){ ?>
                .<?=$outlineSettingsSingel->slug?>{
                    margin-bottom:10px;
                    <?php if ($outlineSettingsSingel->outline_color) { ?>
                        border: 6px dashed <?= $outlineSettingsSingel->outline_color ?>; 
                    <?php } else if(isset($outlineSettings['master_feature_settings'])){ ?>
                        border: 6px dashed <?= $outlineSettings['master_feature_settings']->outline_color ?>; 
                    <?php } ?>
                }
                .header_input_color{
                    <?php if ($outlineSettingsSingel->outline_color) { ?>
                        background: <?= $outlineSettingsSingel->outline_color ?>; 
                    <?php } else if(isset($outlineSettings['master_feature_settings'])){ ?>
                        background: <?= $outlineSettings['master_feature_settings']->outline_color ?>; 
                    <?php } ?>
                }
                .header_input_color_label{
                    <?php if ($siteSettings->tutorial_label_color) { ?>
                        background: <?= $siteSettings->tutorial_label_color ?>; 
                    <?php } else if(isset($siteSettings['master_feature_settings'])){ ?>
                        background: <?= $siteSettings['master_feature_settings']->tutorial_label_color ?>; 
                    <?php } ?>
                }
            <?php }   
        }else{
            ?>
                .<?=$outlineSettingsSingel->slug?>{
                    margin-bottom:10px;
                    <?php if ($outlineSettingsSingel->outline_color) { ?>
                        border: 6px dashed <?= $outlineSettingsSingel->outline_color ?>; 
                    <?php } else if(isset($outlineSettings['master_feature_settings'])){ ?>
                        border: 6px dashed <?= $outlineSettings['master_feature_settings']->outline_color ?>; 
                    <?php } ?>
                }
            <?php
        }
       ?>
    <?php } ?>
<?php } ?>
<?php
    foreach($actionButtons as $action_btn){
        
?>
    .<?=$action_btn->slug?>{
        <?php if ($action_btn->text_color) { ?>
            color:<?= $action_btn->text_color ?> ;
        <?php } ?>
        <?php if ($action_btn->bg_color) { ?>
            background:<?= $action_btn->bg_color ?> ;
        <?php } ?>
    }
<?php 
    }
?>
@media only screen and (max-width: 600px) {
    <?php foreach($all_texts as $text){
    ?>
        .<?=$text->slug?>{
            <?php if ($text->size_mobile) { ?>
            font-size:<?= $text->size_mobile . 'px' ?>; 
            <?php } ?>
        }
    
    <?php 
    }
    ?>
}


.form-control{
    color:black;
}



.video_modal {
    display: none;
    position: fixed;
    z-index:99999;
    padding-top: 20px;
    left: 0;
    top: 50px;
    width: 100%;
    height: 100%;
    max-height: auto;
    max-height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
  }

  .video_modal-content {
    width: 80%;
    margin: auto;
    display: block;
    max-width: 100%;
    max-height: 80vh;
    height: 80vh;
    object-fit: contain;
  }
#myModalTile video{
  max-width: 100% !important;
  width: 100% !important;
}
</style>