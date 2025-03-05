<style>
  #schedulesection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  .schedule_hours_title {
    padding: 20px !important;
    text-align: center !important;
   
  }
  .singledailyhour2 .dailyhoursdae{
    padding:10px  !important;
  }

  .img-thumbnail{
      max-width: 100%;
      /* max-width: 150px;
      max-height: 90px;      */
    min-height: 35px;
    }


      /* Mobile Devices */
      @media (min-width: 320px) and (max-width: 424px) {
        .singledailyhour .img-thumbnail{
          /* max-width: 314px;
          max-height: 160px; */
        }
        .singledailyhour2 .img-thumbnail{
          max-width: 314px;
          max-height: 160px;
        }
      }
          
      /* low resolution  Tablets, Ipads */
      @media (min-width: 425px) and (max-width: 767px) {
       .singledailyhour  .img-thumbnail{
          /* max-width: 317px;
          max-height: 170px; */
        }

        .singledailyhour2  .img-thumbnail{
          max-width: 317px;
          max-height: 170px;
        }
      }
          
      /* Tablets Ipads portrait mode */
      @media (min-width: 768px) and (max-width: 1024px){
        .singledailyhour  .img-thumbnail{
          /* max-width: 382px;
          max-height: 140px; */
        }

        .singledailyhour2  .img-thumbnail{
          max-width: 382px;
          max-height: 140px;
        }
      }
        
.trending-ads-slide{
    display: grid;
  grid-auto-flow: column;
}

.todaytitle{
  margin: 10px;
}
.daily_hours_future_day{
  margin: 10px;
}

<?php $containerHeight='';
if(!empty($rotateSch->image)){
$containerHeight='400px !important';
} elseif((!empty($rotatingScheduleSettings->apply_all_days) && !empty($rotatingScheduleSettings->rotating_schedule_image))) {
$containerHeight='400px !important';
}?>

.singledailyhour{
    position:relative; 
    /* height:<?php echo $containerHeight?> */
} 

.hoursdetailtimes{
    font-weight: bold;
}

<?php      
    $step_image = [];          
    $step_image = check_step_image('Rotating Schedule (Master) Image');        
    if (!empty($step_image)) {
    ?>
    .rotate-master-image{
        color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;
        font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;
        <?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>
    }
    <?php 
    }
    
    foreach($rotatingSchedule as $rotateSch) {?>

        .image_text_{{$rotateSch->id}}{
          text-align:center;
            <?php
            echo 'color:' . (isset($busniess_hours_comments) && !empty($busniess_hours_comments->color) ?  $busniess_hours_comments->color  : '') . ' !important;';
            echo 'font-size:' . (isset($rotateSch) && !empty($rotateSch->description_font_size) ?  $rotateSch->description_font_size  : '14px') . ' !important;';
            echo 'font-family:' . (isset($rotateSch) && !empty($rotateSch->description_font_family) ? getfontfamily( $rotateSch->description_font_family) :'inherit') . ' !important;';
            ?>
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
.rotating_schedule_bg{
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
          } elseif($rotatingScheduleSettings->busniess_hours_override_bg=='1' && $rotatingScheduleSettings->background){
            echo 'background:'.$rotatingScheduleSettings->background.' !important';
          } 
          ?>   
}

#schedulesection .slick-prev {
    left: 0px !important;
}

@media (max-width:768px) {
  #schedulesection .slick-prev {
      left: -10px !important;
  }
}


<?php 
if($rotatingScheduleSettings->arrow_color || $rotatingScheduleSettings->arrow_bg_color ){
    ?>
  
    @if($rotatingScheduleSettings->arrow_color)
        #schedulesection    .slick-prev:before,  #schedulesection  .slick-next:before {
            color: <?=$rotatingScheduleSettings->arrow_color;?> !important;
        }
    @endif
    <?php 
}
?>
</style>