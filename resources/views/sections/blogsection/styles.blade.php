
<style>
  .noblogfound{
    font-size: 20px;
    font-family: 'Gravitas One';
  }
  .blog-categories-div{
    display: flex;
    margin-top:30px;
  }
  .blog-categories{
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), rgba(62, 67, 83, 0.16);
    border-radius: 10px;
    padding: 10px 20px;
    width: fit-content;
    color: #fff;
    margin-right: 10px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
  }
  .blog-categories.active{
    background: #337ab7;
  }
  #blogsection::before {
    content: '';
    display: block;
    visibility: hidden;
  }
  #blogsection {
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
  .blog-instructions{
    text-align:center;
    font-size: <?= $blog_instruction->size_web?$blog_instruction->size_web.'px':'20px'; ?>;
    color: <?= $blog_instruction->color?$blog_instruction->color:'#000'; ?>;
    font-family: <?= $blog_instruction->fontfamily?getfontfamily($blog_instruction->fontfamily):''; ?>;
  }
  .blog-instructions-2{
    text-align:center;
    font-size: <?= $blog_page_instruction->size_web?$blog_page_instruction->size_web.'px':'20px'; ?>;
    color: <?= $blog_page_instruction->color?$blog_page_instruction->color:'#000'; ?>;
    font-family: <?= $blog_page_instruction->fontfamily?getfontfamily($blog_page_instruction->fontfamily):''; ?>;
  }
  .blog-title {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    font-size: 24px;
    <?php if ($blog_title->color) { ?>color: <?= $blog_title->color ?> !important;
    <?php } ?><?php if ($blog_title->bg_color && $blog_title_setting->enable_theme_bg!='1') { ?>background: <?= $blog_title->bg_color ?> !important;
    <?php } ?><?php if ($blog_title->fontfamily) { ?>font-family: <?= getfontfamily($blog_title->fontfamily) ?> !important;
    <?php } ?>
  }
  .blog-title-heading {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    font-size: 24px;
    <?php if ($blog_title->size_web) { ?>font-size: <?= $blog_title->size_web.'px' ?> !important;<?php } ?>
    <?php if ($blog_title->color) { ?>color: <?= $blog_title->color ?> !important;
    <?php } ?><?php if ($blog_title->bg_color && $blog_title_setting->enable_theme_bg!='1') { ?>background: <?= $blog_title->bg_color ?> !important;
    <?php } ?><?php if ($blog_title->fontfamily) { ?>font-family: <?= getfontfamily($blog_title->fontfamily) ?> !important;
    <?php } ?>
  }
  
  .blog-title-size {
    font-size:24px
  }
  .blog-bg {
    <?php if ($blogSettings->override_bg == '1') { ?>background: <?= $blogSettings->bg_color ?> !important;<?php } ?>
    
  }
  @media only screen and (max-width: 600px) {
    .blog-title-size {
      font-size:20px
    }
  .blog-title-heading {
    font-size: 24px;
    <?php if ($menu_blog_title->size_mobile) { ?>font-size: <?= $menu_blog_title->size_mobile.'px' ?> !important;<?php } ?>
    
  }
    .blog-instructions{
      font-size: <?=$blog_instruction->size_mobile?$blog_instruction->size_mobile.'px':'16px';?>
    }
    .blog-instructions-2{
      font-size: <?=$blog_page_instruction->size_mobile?$blog_page_instruction->size_mobile.'px':'16px';?>
    }
  }
  .blog-desc-size {
    font-size:16px
  }

  @media only screen and (max-width: 600px) {
    .blog-desc-size {
      font-size:14px;
    }
  }
  
    
    .blog-cate-size {
      font-size:12px
    }
    .blog-date-size {
      font-size:12px
    }
    
  @media only screen and (max-width: 600px) {
    .blog-title {
      text-align: center !important;
      font-size: 18px;
    }
    .blog-date-size {
      font-size:10px
    }
  }

  .blog-header-bg{
    background:url('<?=url('assets/uploads/'.get_current_url().$blogSettings->blog_header_img)?>');
    background-size: cover;
    text-align: center;
    padding-top: 10%;
    padding-bottom: 10%;
  }

  .bg-none{
    background:none!important;
  }

       
 <?php foreach ($blogs as $single) {
          if ($blogSettings->use_generic) {

            $desc_font_family = 'font-family:' . ($blog_desc->fontfamily ? getfontfamily($blog_desc->fontfamily) . ';' : ';');
            $desc_color = 'color:' . ($blog_desc->color ? $blog_desc->color . ';' : '#000;');
            $title_font_family = 'font-family:' . ($generic_blog_title->fontfamily ? getfontfamily($generic_blog_title->fontfamily) . ';' : ';');
            $title_color = 'color:' . ($blog_title->title_color ? $blog_title->title_color . ';' : '#000;');
            $title_size = 'font-size:' . ($blog_title->size_web ? $blog_title->size_web . ';' : '');
            $desc_size = 'font-size:' . ($blog_desc->size_web ? $blog_title->size_web . ';' : '');
            
            $cate_font_family = 'font-family:' . ($blog_cate->fontfamily ? getfontfamily($blog_cate->fontfamily) . ';' : ';');
            $cate_color = 'color:' . ($blog_cate->color ? $blog_cate->color . ';' : '#000;');
            
            $date_font_family = 'font-family:' . ($blog_date->fontfamily ? getfontfamily($blog_date->fontfamily) . ';' : ';');
            $date_color = 'color:' . ($blog_date->color ? $blog_date->color . ';' : '#000;');
            
          } else {

            $desc_font_family = 'font-family:' . ($single->desc_font ? getfontfamily($single->desc_font) . ';' : ';');
            $desc_color = 'color:' . ($single->desc_color ? $single->desc_color . ';' : '#000;');

            $title_font_family = 'font-family:' . ($single->title_font ? getfontfamily($single->title_font) . ';' : ';');
            $title_color = 'color:' . ($single->title_color ? $single->title_color . ';' : '#000;');

            $cate_font_family = 'font-family:' . ($single->category_font ? getfontfamily($single->category_font) . ';' : ';');
            $cate_color = 'color:' . ($single->category_color ? $single->category_color . ';' : '#000;');
            
            $date_font_family = 'font-family:' . ($single->date_font ? getfontfamily($single->date_font) . ';' : ';');
            $date_color = 'color:' . ($single->date_color ? $single->date_color . ';' : '#000;');
            $desc_size = 'font-size:' . ($single->size_web ? $single->size_web . ';' : '');

            
          }
          ?>
            .blog-desc-<?=$single->id?>{
                <?= $desc_font_family ?><?= $desc_color ?><?= $desc_size ?>
            }
            .blog-title-<?=$single->id?>{
                <?= $title_font_family ?><?= $title_color ?><?= $desc_size ?>
            }
            .blog-date-<?=$single->id?>{
                <?=$date_font_family?><?=$date_color?>
            }
            .blog-cate-<?=$single->id?>{
                <?=$cate_font_family?><?=$cate_color?>
            }
            .blog_readmore_btn_<?=$single->id?>{
              background:<?=$blogSettings->use_generic ? $blogSettings->read_more_button_bg_color.'!important;' : $single->read_more_button_bg_color.'!important;' ?>;
              color:<?=$blogSettings->use_generic ? $blogSettings->read_more_button_color.'!important;' : $single->read_more_button_color.'!important;'?>;
              text-decoration: none;
            }
            .blog_readmore_btn_<?=$single->id?>:hover {
              color:<?=$blogSettings->use_generic ? $blogSettings->read_more_button_color : $single->read_more_button_color?>;
            }
          <?php 
  }?>

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
  <?php if($blog_title_setting->enable_theme_bg=='1'){?>
    .blog-title-heading{
      background-color:transparent !important;
        background:transparent !important;
    }
      
  <?php }?>
</style>