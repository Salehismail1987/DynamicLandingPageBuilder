<style>
  .review_staff_carosel_padding{
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

  .testimonial_action_button_left{
    /* margin-right:50px; */
  }
  .testimonial_action_button_right{
    /* margin-left:50px; */
  }  
  .testimonial_action_button_container{
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .testimonial_action_button{
    margin: 0 53px;
    flex-grow: 1;
    max-width: 150px; 
    width: auto;
  }
  @if($reviewSettings->arrow_color)
    .review_staff .nav-btn.next-slide i,.review_staff .nav-btn.prev-slide i{
      color: {{$reviewSettings->arrow_color}};
    }
  @endif
  @if($reviewSettings->arrow_hover_color)
    .review_staff .nav-btn.next-slide:hover i,.review_staff .nav-btn.prev-slide:hover i{
      color: {{$reviewSettings->arrow_hover_color}};
    }
  @endif
  <?php
  if ($reviews_staff_title->bg_color == "#FFFFFF" || $reviews_staff_title->bg_color == "#ffffff" || $reviews_staff_title->bg_color == "#fff" ) {
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

  .stars .star {
    font-size: 30px;
  }

  .stroke-transparent {
    -webkit-text-stroke: 1px #000;
  }

  .testimonials .testimonial-item .testimonial-img {
    height: 175px;
    object-fit: contain;
  }
</style>
<style>
  #testimonials::before {
    content: '';
    display: block !important;
    height: 00px !important;
    
    visibility: hidden !important;
  }

  .testimonials{
    padding-top: 0;
  }
  .testimonials{
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
          } elseif($reviewSettings->review_override_bg=='1' &&  $reviewSettings->review_background ){
            echo 'background:'.$reviewSettings->review_background.' !important';
          } else{ 
            if($siteSettings->site_background_color){ 
              echo 'background:'.$siteSettings->site_background_color.' !important';
            }
          } 
          ?> 
        }


  .review_and_staff_title {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    <?php
    echo 'color:' . ($reviews_staff_title->color ? $reviews_staff_title->color : '#000') . ' !important;';
    echo 'font-size:' . ($reviews_staff_title->size_web ? $reviews_staff_title->size_web . 'px' : '18px') . ' !important;';
    echo 'background:' . ($reviews_staff_title->bg_color ? $reviews_staff_title->bg_color : '#fff') . ' !important;';
    echo 'font-family:' . ($reviews_staff_title->fontfamily ? getfontfamily($reviews_staff_title->fontfamily) : '#fff') . ' !important;';
    ?>
  }

  <?php
  if ($reviews_staff_title->size_mobile) {
  ?>@media only screen and (max-width: 600px) {
    .review_and_staff_title {
      text-align: center !important;
      <?= 'font-size:' . ($reviews_staff_title->size_mobile ? $reviews_staff_title->size_mobile . 'px' : '18px') . ' !important;' ?>
    }
  }

  <?php
  }

?>

<?php   
  if ($reviewSettings->use_generic) {
    $review_staff_font_family = 'font-family:' . ($generic_review_staff->fontfamily ? getfontfamily($generic_review_staff->fontfamily) . ' !important;' : ';');
    $review_staff_color = 'color:' . ($generic_review_staff->color ? $generic_review_staff->color . ' !important;' : '#000;');
    $review_staff_font_size = 'font-size:' . ($generic_review_staff->size_web ? $generic_review_staff->size_web . 'px !important;' : ';');
  ?>.reviews_staff_text {
    <?= $review_staff_font_family ?><?= $review_staff_color ?><?= $review_staff_font_size ?>
  }

  .review_staff .star {
    color: <?= $generic_review_staff_star->color ? $generic_review_staff_star->color : '#FFFF00' ?> !important;
  }

  <?php
  } else {
    if (count($reviewStaff) > 0) {
      foreach ($reviewStaff as $single) {
        $review_staff_font_family = 'font-family:' . ($single->text_font ? getfontfamily($single->text_font) . ' !important;' : ';');
        $review_staff_color = 'color:' . ($single->text_color ? $single->text_color . ' !important;' : '#000;');
        $review_staff_font_size = 'font-size:' . ($single->text_size ? $single->text_size . 'px !important;' : ';');

  ?>#reviews_staff_text<?= $single->id ?> {
    <?= $review_staff_font_family ?><?= $review_staff_color ?><?= $review_staff_font_size ?>
  }

  .star-single<?= $single->id ?> {
    color: <?= $single->star_color ? $single->star_color : '#FFFF00' ?> !important;
  }

  <?php
      }
    }
  }
  ?>

 
  .review_and_staff_title{
    padding:20px;text-align:center;
          <?php
          echo 'color:' . ($reviews_staff_title->color ? $reviews_staff_title->color : '#000') . ';';
          echo 'font-size:' . ($reviews_staff_title->size_web ? $reviews_staff_title->size_web . 'px' : '18px') . ';';
          echo 'background:' . ($reviews_staff_title->bg_color ? $reviews_staff_title->bg_color : '#fff') . ';';
          echo 'font-family:' . ($reviews_staff_title->fontfamily ? getfontfamily($reviews_staff_title->fontfamily) : '#fff') . ';';
          ?>
  }

  
<?php 
if($reviews_staff_title_setting->enable_theme_bg =='1'){
    ?>
    .review_and_staff_title{
        background-color:transparent !important;
        background:transparent !important;
    }

    .reviews_staff_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

@media only screen and (max-width: 768px) {
  .review_staff_carosel_padding{
    padding: 0 ;
  }
}

.review_staff .owl-dot {
  background-color: <?=$reviewSettings->dot_color?$reviewSettings->dot_color:'rgba(255, 255, 255, 0.4)'?> !important;
}
.review_staff .owl-dot.active {
    background-color: <?=$reviewSettings->dot_active_color?$reviewSettings->dot_active_color:'#106eea'?> !important;
}


</style>