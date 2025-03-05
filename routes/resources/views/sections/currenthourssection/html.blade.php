<?php 
$setting = $frontSections->where('slug','currenthourssection')->first();
if($set_hours_title->enable=='1' || isset($_GET['editwebsite']) || ($setHours && count($setHours)>0)){ ?>
    @include('sections.currenthourssection.styles')
    
    <div id="currenthourssection">
      
      <div class="container-fluid current-hour-container" style="">
        <?php if($set_hours_title->enable=='1'){ ?>
          <div class="position-relative title_banners_outline" >
          @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=schedule_set_title'/>
                    </div>
            </div>
        @endif
            <?php if ($set_hours_title->text) { ?>
              <<?= $set_hours_title->tag ?> class="titlefontfamily set_hours_title {{$set_hours_title->slug}}"><?= $set_hours_title->text ?></<?= $set_hours_title->tag ?>>
            <?php } ?>
          </div>
        <?php } ?>
        
        <?php 
            $backDashboard = '';
            if(isset($_GET['editwebsite'])){
                $backDashboard = '
                <div class="back-dashboard-div">
                <a href="'.url('scheduling?block=set_schedule').'" target="_blank">
                    <div class="col-md-12 d-flex flex-column">
                        <div class="col-md-12 title-2">Set Schedule</div>';
                        if($setting->section_enabled == 0)
                            $backDashboard .= '<div class="col-md-12 title-2" style="color:red;">Disabled</div>';
                        $backDashboard .= '
                                    </div>
                                    <img src="'.url('assets/uploads/'.get_current_url().'edit-round.png').'" class="edit-icon">
                                </a>
                            </div>';
            }
        ?>
        <div class="position-relative set_schedule_outline">
        @if(isset($_GET['editwebsite']))
            <div class="">
                <!-- <a href="{{ url('quicksettings?block=alert_banner_bluebar') }}" target="_blank"> -->
                    <div class="d-flex align-items-center">
                        <!-- <div class="title-2">Alert Banner</div> -->
                        <x-tutorial-action-buttons  title='Set Schedule' :buttons="isset($tutorial_action_buttons['set_schedule']) ? $tutorial_action_buttons['set_schedule']:'' " url='scheduling?block=set_schedule' :status="$setting->section_enabled"/>
                    </div>
                    <!-- <img src="{{ url('assets/uploads/' . get_current_url() . 'edit-round.png') }}" class="edit-icon"> -->
                <!-- </a> -->
            </div>
        @endif
          <div class="row nopadding">
            <div class="col-lg-1 col-md-1 col-sm-1 nopadding">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 nopadding">
              <?php
              if ($step_image = check_step_image('Set Hours Image')) {
              ?>
                <div class="vertical-center">
                  <div class="outer2">
                    <div class="middle">
                      <div class="inner">
                        <img class="set-hours-image" data-src="<?= url('assets/uploads/'.get_current_url().$step_image['image'])  ?>" src="<?= url('assets/uploads/'.get_current_url().$step_image['image'])  ?>" class="lazyload" alt="<?=$set_hours_title->text?>" width="<?= $setHoursSettings->set_hour_image_width ?>" style="">
                        <?php
                        if (!empty($step_image['text'])) {
                        ?>
                          <p class="set-hours-image-p" style="">
                            <?= nl2br($step_image['text']) ?>
                          </p>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } elseif (show_timed_image($timed_set_hour_image_setting->enable, $timed_set_hour_image->file_name, $timed_set_hour_image_setting->start_time, $timed_set_hour_image_setting->end_time,$timed_set_hour_image_setting->days, 'enable_timed_set_hour_image', 'timed_images', 1,$timed_set_hour_image_setting->type)) {
              ?>
                <div class="vertical-center">
                  <div class="outer2" >
                    <div class="middle">
                      <div class="inner">
                        <img class="max-width-100" data-src="<?= url('assets/uploads/'.get_current_url().$timed_set_hour_image->file_name)  ?>" src="<?= url('assets/uploads/'.get_current_url().$timed_set_hour_image->file_name)  ?>" class="lazyload" width="<?= $setHoursSettings->set_hour_image_width ?>" style="" alt="<?=$setHoursSettings->set_hours_title_text?>">
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              } else {
                if ($setHoursSettings->set_hour_image) { ?>
                  <div class="vertical-center">
                    <div class="outer2">
                      <div class="middle">
                        <div class="inner">
                          <img  class="max-width-100" data-src="<?= url('assets/uploads/'.get_current_url(). $setHoursSettings->set_hour_image)  ?>" src="<?= url('assets/uploads/'.get_current_url(). $setHoursSettings->set_hour_image)  ?>" class="lazyload" width="<?= $setHoursSettings->set_hour_image_width ?>" style="" alt="<?=$setHoursSettings->set_hours_title_text?>">
                      
                          <?php
                          if (!empty( $schedule_image_desc_text->text)) {
                          ?>
                            <p style="" class="set_hour_image_desc {{$schedule_image_desc_text->slug}}">
                              <?= nl2br( $schedule_image_desc_text->text) ?>
                            </p>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php
                }
              } ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 nopadding">
              <h3 class="set_hour_title {{$set_hours_sub_title->slug}}"><?= $set_hours_sub_title->text ?></h3>
              <table class="dailyhousertable">
                <?php $date = date('Y-m-d', strtotime("this week sunday"));
                ?>
    
                <?php
                $i=0;
                foreach ($setHours as $setHour) {
                  $i++;
                ?>
                  <?php if (isset($setHour) && !empty($setHour->start)) { ?>
                    <tr>
                      <td>
                        <div class="tabledailyhoursdae" 
                        <?php 
                          if(isset($setHour->day_orveride_generic) && $setHour->day_orveride_generic=='1' && isset($setHour->day_color) && !empty($setHour->day_color)){
                          ?>
                          style="color: <?= $setHour->day_color?> !important"
                          <?php  
                          }
                          if ($setHoursSettings->day_settings == '1') {
                            
                            $day_format = 'l'; 
                        } else {
                            
                            $day_format = 'D'; 
                        }
                        ?>
                        ><?= date($day_format, strtotime($date)); ?></div>
                      </td>
                      <td>
                        <div class="daily_hours_time_main daily_hours_time<?= $setHour->id ?>"><?= isset($setHour) ? ltrim($setHour->start, '0') : '--' ?></div>
                      </td>
                      <td>
                        <div class="daily_hours_time_main daily_hours_time<?= $setHour->id ?>"><?= isset($setHour) ? ltrim($setHour->end, '0') : '--' ?></div>
                      </td>
                      <td>
                        <div class="tabledailyhourscomment"><?= (isset($setHour) && !empty($setHour->comments)) ? $setHour->comments : '' ?></div>
                     
                      </td>
                    </tr>
                    <?php if (isset($setHour) && (!empty($setHour->start_2) || !empty($setHour->end_2) || !empty($setHour->comments_2))) { ?>
                      <tr>
                        <td></td>
                        <td>
                          <div class="daily_hours_time_main daily_hours_time<?= $setHour->id ?>"><?= isset($setHour) ? ltrim($setHour->start_2, '0') : '--' ?></div>
                        </td>
                        <td>
                          <div class="daily_hours_time_main daily_hours_time<?= $setHour->id ?>"><?= isset($setHour) ? ltrim($setHour->end_2, '0') : '--' ?></div>
                        </td>
                        <td>
                          <div class="tabledailyhourscomment"><?= (isset($setHour) && !empty($setHour->comments_2)) ? $setHour->comments_2 : '' ?></div>
                        </td>
                      </tr>
                    <?php  } ?>
                  <?php  } ?>
                  <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
                <?php } ?>
              </table>
              <br>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 nopadding">
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('sections.currenthourssection.scripts')
<?php } ?>