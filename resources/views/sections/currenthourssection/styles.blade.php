<style>
  #currenthourssection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  .set_hours_title {
    padding: 20px !important;
    text-align: center !important;
 
  }

  .set_hour_image_desc{
  
    text-align:center;
    padding-bottom: 0;width:100%;text-align:center;
  }

  .current-hour-container{
    text-align: center;border: 3px solid ;
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
          } elseif($setHoursSettings->scheduling_override_bg=='1' && $setHoursSettings->background){
            echo 'background:'. $setHoursSettings->background.' !important';
          } 
          ?> 
  }
  #currenthourssection .outer2{
  height: max-content !important
}
  <?php
    if ($step_image = check_step_image('Set Hours Image')) {
    ?>
        .set-hours-image-p{
            padding-bottom: 0;
            width:100%;
            text-align:center;
            color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;
            font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;
            <?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>
        }

        .set-hours-image{
            max-width: 100%;
        }
    <?php 
    }
    ?>

    .max-width-100{
        max-width: 100%;
    }
    @media only screen and (max-width: 600px) {
      .tabledailyhourscomment{
          margin-left: 0px
      }
    }

    .set_hours_sub_title{
        width: 80%;
        padding-top: 10px;
    }

    .daily_hours_time_main {
          <?php if ($daily_hours->fontfamily) { ?>font-family: <?= getfontfamily($daily_hours->fontfamily) ?> !important; <?php } ?>
          <?php if (isset($daily_hours->color)) { ?>color: <?= $daily_hours->color ?> !important; <?php } ?>
        }
        <?php
          $i=0;
          foreach ($setHours as $setHour) {
            $i++;
         
          if (isset($setHour) && !empty($setHour->start)) {
        ?>.daily_hours_time<?= $setHour->id ?> {
          text-align: left;
          font-weight: bold;
          <?php if (isset($daily_hours->size_web)) { ?>font-size: <?= $daily_hours->size_web . 'px' ?>;<?php } ?>
          <?php if (isset($setHour->hours_orveride_generic) && $setHour->hours_orveride_generic=='1'){
             if(isset($setHour->hours_color)) { ?>
                color: <?= $setHour->hours_color ?> !important;
            <?php } ?>
          <?php } ?>
        }

        @media only screen and (max-width: 600px) {
          .daily_hours_time<?= $setHour->id ?> {
            <?php if (isset($daily_hours->size_mobile)) { ?>font-size: <?= $daily_hours->size_mobile . 'px;' ?> <?php } ?>
          }
        }

        <?php
          }
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
</style>