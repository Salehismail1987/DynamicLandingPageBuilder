<style>
  .staff_products_carosel_padding{
    padding: 0 8%;
  }
  .owl-carousel .nav-btn {
    height: 47px;
    position: absolute;
    width: 26px;
    cursor: pointer;
    top: 100px !important;
  }

  .owl-carousel .owl-prev.disabled,
  .owl-carousel .owl-next.disabled {
    pointer-events: none;
    opacity: 0.2;
  }
  .nav-btn.prev-slide {
    left: 0px;
  }
  .nav-btn.next-slide {
    right: 0px;
  }
  .nav-btn.prev-slide i{
    color: #000;
    font-size: 48px;
  }
  .nav-btn.next-slide i{
    color: #000;
    font-size: 48px;
  }

  @if($StaffProductsPromosSettings->arrow_color)
  .staff_products_promos .nav-btn.next-slide i,.staff_products_promos .nav-btn.prev-slide i{
      color: {{$StaffProductsPromosSettings->arrow_color}};
    }
  @endif
  @if($StaffProductsPromosSettings->arrow_hover_color)
  .staff_products_promos .nav-btn.next-slide:hover i,.staff_products_promos .nav-btn.prev-slide:hover i{
      color: {{$StaffProductsPromosSettings->arrow_hover_color}};
    }
  @endif

  <?php
  if ($staff_products_promos_title->bg_color == "#FFFFFF" || $staff_products_promos_title->bg_color == "#ffffff" || $staff_products_promos_title->bg_color == "#fff" ) {
  ?>
  /* .owl-carousel .prev-slide {
    background: url(<?= url('assets/front/img/navicon.gif') ?>) no-repeat scroll 0 -53px;
    left: 0px;
  } */
  /* .owl-carousel .next-slide {
    background: url(<?= url('assets/front/img/navicon.gif') ?>) no-repeat scroll -24px -53px;
    right: 0px;
  } */
  <?php } else {?>

  /* .owl-carousel .prev-slide {
    background: url(<?= url('assets/front/img/navicon.gif') ?>) no-repeat scroll 0 0;
    left: 0px;
  } */

  /* .owl-carousel .next-slide {
    background: url(<?= url('assets/front/img/navicon.gif') ?>) no-repeat scroll -24px 0px;
    right: 0px;
  } */
/* .owl-carousel .prev-slide:hover {
    background-position: 0px -53px;
  } */

  /* .owl-carousel .next-slide:hover {
    background-position: -24px -53px;
  } */
<?php } ?>
  .flex-column{
      flex-direction: column;
  }
  .stars .star {
    font-size: 30px;
  }

  .stroke-transparent {
    -webkit-text-stroke: 1px #000;
  }

  .staff_products_promos .testimonial-item .testimonial-img {
    height: 175px;
    object-fit: contain;
  }
</style>
<style>
  #staff_products_promos::before {
    content: '';
    display: block !important;
    height: 00px !important;
    
    visibility: hidden !important;
  }

  .staff_products_promos{
    padding-top: 0;
  }


  .staff_products_promos_title {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    <?php
    echo 'color:' . ($staff_products_promos_title->color ? $staff_products_promos_title->color : '#000') . ' !important;';
    echo 'font-size:' . ($staff_products_promos_title->size_web ? $staff_products_promos_title->size_web . 'px' : '18px') . ' !important;';
    echo 'background:' . ($staff_products_promos_title->bg_color ? $staff_products_promos_title->bg_color : '#fff') . ' !important;';
    echo 'font-family:' . ($staff_products_promos_title->fontfamily ? getfontfamily($staff_products_promos_title->fontfamily) : '#fff') . ' !important;';
    ?>
  }

  <?php
  if ($staff_products_promos_title->size_mobile) {
  ?>@media only screen and (max-width: 600px) {
    .staff_products_promos_title {
      text-align: center !important;
      <?= 'font-size:' . ($staff_products_promos_title->size_mobile ? $staff_products_promos_title->size_mobile . 'px' : '18px') . ' !important;' ?>
    }
  }

  <?php
  }

  if ($StaffProductsPromosSettings->use_generic) {
    $staff_products_promos_font_family = 'font-family:' . ($generic_staff_products_promos->fontfamily ? getfontfamily($generic_staff_products_promos->fontfamily) . ' !important;' : ';');
    $staff_products_promos_color = 'color:' . ($generic_staff_products_promos->color ? $generic_staff_products_promos->color . ' !important;' : '#000;');
    $staff_products_promos_font_size = 'font-size:' . ($generic_staff_products_promos->size_web ? $generic_staff_products_promos->size_web . 'px !important;' : ';');
  ?>.staff_products_promos_text {
    <?= $staff_products_promos_font_family ?><?= $staff_products_promos_color ?><?= $staff_products_promos_font_size ?>
  }

  .star {
    color: <?= $generic_staff_products_promos_star->color ? $generic_staff_products_promos_star->color : '#FFFF00' ?> !important;
  }

  <?php
  } else {
    if (count($StaffProductsPromos) > 0) {
      foreach ($StaffProductsPromos as $single) {
        $staff_products_promos_font_family = 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ' !important;' : ';');
        $staff_products_promos_color = 'color:' . ($single->text_color ? $single->text_color . ' !important;' : '#000;');
        $staff_products_promos_font_size = 'font-size:' . ($single->text_size ? $single->text_size . 'px !important;' : ';');

  ?>#staff_products_promos_text<?= $single->id ?> {
    <?= $staff_products_promos_font_family ?><?= $staff_products_promos_color ?><?= $staff_products_promos_font_size ?>
    <?php
    if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "color:black !important;";
           }
           else
           {
             echo "color:white !important;";
           }
     
         }
         ?>
  }

  .staff_products_promos_text<?= $single->id ?> {
    <?= $staff_products_promos_font_family ?><?= $staff_products_promos_color ?><?= $staff_products_promos_font_size ?>
    <?php
         if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "color:black !important;";
           }
           else
           {
             echo "color:white !important;";
           }
     
         }
    ?>
  }

  .star-single<?= $single->id ?> {
    color: <?= $single->star_color ? $single->star_color : '#FFFF00' ?> !important;
  }

  <?php
      }
    }
  }
  ?>
  .staff_products_promos {
<?php 

    if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
    {
      if($siteSettings->site_background_theme == 0)
      {
        echo "background:white !important;";
        echo "color:black !important;";
      }
      else
      {
        echo "background:black !important;";
        echo "color:white !important;";
      }

    }else if($StaffProductsPromosSettings->staff_promos_override_bg=='1' &&  $StaffProductsPromosSettings->background){
      echo 'background:'.$StaffProductsPromosSettings->background.' !important';
    }else{ 
       if($siteSettings->site_background_color){ 
        echo 'background:'.$siteSettings->site_background_color.' !important';
       }
    }
   ?>
  }
  .staff_products_promos_title{
    padding:20px;text-align:center;
          <?php
          echo 'color:' . ($staff_products_promos_title->color ? $staff_products_promos_title->color : '#000') . ';';
          echo 'font-size:' . ($staff_products_promos_title->size_web ? $staff_products_promos_title->size_web . 'px' : '18px') . ';';
          echo 'background:' . ($staff_products_promos_title->bg_color ? $staff_products_promos_title->bg_color : '#fff') . ';';
          echo 'font-family:' . ($staff_products_promos_title->fontfamily ? getfontfamily($staff_products_promos_title->fontfamily) : '#fff') . ';';
          ?>
  }


  
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
@media only screen and (max-width: 768px) {
  .staff_products_carosel_padding{
    padding: 0 ;
  }
}
.staff_products_promos .owl-dot {
  background-color: <?=$StaffProductsPromosSettings->dot_color?$StaffProductsPromosSettings->dot_color:'rgba(255, 255, 255, 0.4)'?> !important;
}
.staff_products_promos .owl-dot.active {
    background-color: <?=$StaffProductsPromosSettings->dot_active_color?$StaffProductsPromosSettings->dot_active_color:'#106eea'?> !important;
}

.testimonial_action_button_container{
    align-items: flex-start;
  }

</style>