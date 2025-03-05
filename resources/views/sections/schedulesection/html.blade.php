<?php 
$setting = $frontSections->where('slug','schedulesection')->first();
if($schedule_title->enable=='1' || isset($_GET['editwebsite']) || ($rotatingSchedule && count($rotatingSchedule)>0)){ ?>
    @include('sections.schedulesection.styles')
    
    <div id="schedulesection">
      <?php if($schedule_title->enable=='1'){ ?>
        <div class="position-relative title_banners_outline" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=schedule_rotating_title'/>
                    </div>
            </div>
        @endif
            <?php if ($schedule_title->text) { ?>
              <<?= $schedule_title->tag ?> class="titlefontfamily schedule_hours_title {{$schedule_title->slug}}"><?= $schedule_title->text ?></<?= $schedule_title->tag ?>>
            <?php } ?>
        </div>
      <?php } ?>
      <div class="position-relative rotating_schedule_outline" >
        <div class="rotating_schedule_bg">      
          <div class="container-fluid" style="width:98%;margin:0;">
          
          @if(isset($_GET['editwebsite']))
              <div class="">
                      <div class="d-flex align-items-center">
                          <x-tutorial-action-buttons  title='Rotating Schedule' :buttons="isset($tutorial_action_buttons['rotating_schedule']) ? $tutorial_action_buttons['rotating_schedule']:'' " url='scheduling?block=rotating_schedule' :status="$setting->section_enabled"/>
                      </div>
              </div>
          @endif
            <div class="row nopadding">
              <div class="col-md-12 nopadding">
                <ul class="dailyhourslist trending-ads-slide" >
                  <?php $date = date('Y-m-d'); ?>
                  <?php
                  
                  $duplications = [];
                  foreach($rotatingSchedule as $rotateSch) {
                    if ($rotateSch->duplicate_for_next_week_day && !in_array($rotateSch->day,$duplications )) {
                      $duplications[] = $rotateSch->day;
                      $num = 7;
                      $d[date('Y-m-d', strtotime("+".$num." day", strtotime($rotateSch->date)))] = $rotateSch;
                    }else{
                      
                        $duplications[] ='';
                     
                    }
                  }
                  $duplication_array = (isset($duplications)) ? (array)$duplications : array();
                  $day_count = 0;
                  $check_count = 6;
                  $i=0;
                  foreach($rotatingSchedule as $rotateSch) {
                    // dd($rotatingSchedule);
                    $i++;
                    $index = $i;
                    // $show = false;
                    if (isset($rotateSch->day) && $rotateSch->day == date('D', strtotime($date))) {
                      if ($rotateSch->duplicate_for_next_week_day) {
                       
                        // $show = true;
                      } elseif ($date == date('Y-m-d', strtotime($rotateSch->date))) {
                        // $show = true;
                      }
                      $index2 = array_search(date('D', strtotime($date)), $duplication_array);
                      if(($index2 || $index2 == 0) && $index2 !== false){
                        $rotateSch = isset($rotatingSchedule[$index2])? $rotatingSchedule[$index2]:$rotateSch;
                      }
                    } else {

                      $check_count++;
                      if ($i >= count($rotatingSchedule)) {
                        break;
                      }
                      // echo "<pre>";
                      // pr_r($rotateSch);
                      // echo "<pre>";
                      // continue;
                    } ?>
                    <li>
                      <?php if ($date == date('Y-m-d')) { ?>
                        <h3 class="text-center todaytitle">Today </h3> 
                      <?php } elseif ($date == date('Y-m-d', strtotime("+1 day"))) { ?>
                        <h3 class="text-center futuredaytitle {{$daily_hours_future_day->slug}}" >Tomorrow</h3>
                      <?php } else {
                      ?>
                        <h3 class="text-center {{$daily_hours_future_day->slug}}" >in <?= $day_count; ?> Days</h3>
                      <?php
                      } ?>
                      <div class="singledailyhour singledailyhourheight">
                        <h4 class="dailyhoursdae text-center"><?= date('D, j M', strtotime($date)); ?></h4>
                        <div class="hoursdetaildiv">
                          <div class="d-flex justify-content-between mb-10">
                            <div class="titlefontfamily hours {{$daily_hours_set_1->slug}}"><?= $daily_hours_set_1->text; ?></div>
                            <div class="hoursdetail">
                              <table border="0">
                                <tr>
                                  <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_start_title->slug}}"><?= $daily_hours_start_title->text ?>: </span></td>
                                  <td class="text-right"><span class="titlefontfamily hoursdetailtimes" > <?= (isset($d[$date]))? $d[$date]->start : ((isset($rotateSch)) ? ltrim($rotateSch->start, '0') : '--') ?></span></td>
                                </tr>
                                <tr>
                                  <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_end_title->slug}}"><?= $daily_hours_end_title->text ?>: </span></td>
                                  <td class="text-right"><span class="titlefontfamily hoursdetailtimes" ><?= (isset($d[$date]))? $d[$date]->end : ((isset($rotateSch)) ? ltrim($rotateSch->end, '0') : '--') ?></span>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <?php if (isset($rotateSch) && !empty($rotateSch->comments)) { ?>
                            <div class=" {{$busniess_hours_comments->slug}} mb-5px" ><?= (isset($d[$date]))? $d[$date]->comments : ((isset($rotateSch) && !empty($rotateSch->comments)) ? $rotateSch->comments : '')  ?></div>
                          <?php } ?>
                        
                          <?php if (isset($rotateSch) && !empty($rotateSch->start_2)) { ?>
    
                            <div class="d-flex justify-content-between mb-10">
                              <div class="titlefontfamily hours2 {{$daily_hours_set_2->slug}}"><?= $daily_hours_set_2->text ?></div>
                              <div class="hoursdetail">
                                <table border="0">
                                  <tr>
                                    <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_start_title->slug}}"><?= $daily_hours_start_title->text ?>: </span></td>
                                    <td class="text-right"><span class="titlefontfamily hoursdetailtimes"><?= (isset($d[$date]))? $d[$date]->start2 : ((isset($rotateSch)) ? ltrim($rotateSch->start_2, '0') : '--') ?></span></td>
                                  </tr>
                                  <tr>
                                    <td><span class="titlefontfamily hoursdetailstart {{ $daily_hours_end_title->slug}}"><?= $daily_hours_end_title->text ?>: </span></td>
                                    <td class="text-right"><span class="titlefontfamily hoursdetailtimes"><?= (isset($d[$date]))? $d[$date]->end_2 : ((isset($rotateSch)) ? ltrim($rotateSch->end_2, '0') : '--') ?></span></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <div class="clearfix"></div>
                            <?php if ( isset($rotateSch) && !empty($rotateSch->comments_2)) { ?>
                              <div class=" {{$busniess_hours_comments->slug}}  mb-5px" ><?= (isset($rotateSch) && !empty($rotateSch->comments_2)) ? $rotateSch->comments_2 : '' ?></div>
                            <?php } ?>
                        <?php } ?>
                      </div>
                        
                        <div>
    
                      
                        <?php 
                          $text_image  = "";
                              if(!empty($rotateSch->image_description)){
                                ?> 
                                  <?php 
                                    $text_image = $rotateSch->image_description;
                                  ?>
                                <?php 
                              }
    
                            ?>
    
                            <div style="">
                              <?php 
                              if(!empty($rotateSch->image)){
                                  
                                /* (Hassan) Adding max width and height on the default image (Begin) */
                                $max_width = "";
                                if(!empty($rotatingScheduleSettings->apply_all_days) &&  !empty($rotatingScheduleSettings->rotating_schedule_image)){
                                  $max_width = $rotatingScheduleSettings->max_width;
                                }
                                /* Adding max width and height on the default image (End) */
    
                                $step_image=[];
                                $step_image = check_step_image('Rotating Schedule (Master) Image');
                                if (!empty($step_image) && $date == date('Y-m-d') ) {
                              
                                  ?>
                                  <div  align="center">
                                    <img data-src="<?=url("assets/uploads/".get_current_url().$step_image['image'])?>" class="lazyload img-thumbnail"  >
                                  </div>
                                  <?php
                                
                                  if (!empty($step_image['text'])) {
                                  ?>
                                    <div class="rotate-master-image">
                                      <?= nl2br($step_image['text']) ?>
                                  </div>
                                  <?php
                                  }
                                  ?>
                                <?php
                                }else{
                                ?>
                                  <div  align="center">
                                    
                                    <!-- (Hassan) Adding max width and height (Begin) -->
                                    <img data-src="<?=url("assets/uploads/".get_current_url().$rotateSch->image)?>" class="img-thumbnail lazyload"  style="max-width: <?= $max_width; ?>px;">
                                    <!-- Adding max width and height (End) -->
    
                                  </div>
                                    <div class="image_text_{{$rotateSch->id}}">
                                    <?= $text_image?>
                                    </div>
                                <?php 
                                }
                                ?>
    
                              <?php 
                              }elseif (!empty($rotatingScheduleSettings->apply_all_days) &&  !empty($rotatingScheduleSettings->rotating_schedule_image)) { ?>
                                
                                <?php      
                                $step_image = [];          
                                  $step_image = check_step_image('Rotating Schedule (Master) Image');        
                                  if (!empty($step_image)) {
                                  ?>
                                  <div  align="center">
                                    <img data-src="<?=url("assets/uploads/".get_current_url().$step_image['image'])?>" class="img-thumbnail lazyload"  >
                                  </div>
                            
                                    <?php
                                    if (!empty($step_image['text'])) {
                                    ?>
                                      <div class="rotate-master-image" >
                                        <?= nl2br($step_image['text']) ?>
                                    </div>
                                  <?php
                                  }
                                  ?>
                                <?php
                                }else{
                                ?>
                                  <div  align="center">
                                  
                                  <!-- (Hassan) Adding max width and height (Begin) -->
                                  <img data-src="<?=url("assets/uploads/".get_current_url().$rotatingScheduleSettings->rotating_schedule_image)?>" class="lazyload img-thumbnail" style="max-width: <?= $rotatingScheduleSettings->max_width; ?>px; max-height: <?= $rotatingScheduleSettings->max_height; ?>px;">
                                  <!-- Adding max width and height (End) -->
    
                                </div>
                                    <div class="day_master_image_text {{$master_image_description->slug}} text-center">
                                    <?= $master_image_description->text?>
                                    </div>
                                <?php 
                                }?>
    
                              <?php } ?>
                            
                          </div>
                    
    
                        </div>
                        <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
                      </div>
                    </li>
                    <?php
                    $day_count++;
                  } ?>
                </ul>
    
    
                <div class="daily-hours-div-to-calculate-height" >
                  <ul class="dailyhourslist1 d-flex" >
                    <?php $date = date('Y-m-d'); ?>
                    <?php
                    $duplication_array = (isset($duplications)) ? (array)$duplications : array();
                    
                    $day_count = 0;
                    $check_count = 6;
                    $i=0;
                    foreach($rotatingSchedule as $rotateSch) {
                      $i++;
                      $index = $i;
                      $show = false;
                      if (isset($rotateSch->day) && $rotateSch->day == date('D', strtotime($date))) {
                        if ($rotateSch->duplicate_for_next_week_day) {
                           $show = true;
                        } elseif ($date == date('Y-m-d', strtotime($rotateSch->date))) {
                          $show = true;
                        }
                        $index2 = array_search(date('D', strtotime($date)), $duplication_array);
                        if($index2){
                          $rotateSch = isset($rotatingSchedule[$index2])? $rotatingSchedule[$index2]:$rotateSch;
                        }
                      } else {
                        $check_count++;
                        if ($i >= count($rotatingSchedule)) {
                          break;
                        }
                        continue;
                      }
                    ?>
                      <li>
                      
                        <?php if ($date == date('Y-m-d')) { ?>
                          <h3 class="text-center todaytitle">Today </h3>
                        <?php } elseif ($date == date('Y-m-d', strtotime("+1 day"))) { ?>
                          <h3 class="text-center todaytitle {{$daily_hours_future_day->slug}}" >Tomorrow</h3>
                        <?php } else {
                        ?>
                          <h3 class="text-center todaytitle {{$daily_hours_future_day->slug}}" >in <?= $day_count; ?> Days</h3>
                        <?php
                        } ?>
                        <div class="singledailyhour2 p-3" >
                          <h4 class="dailyhoursdae text-center"><?= date('D, j M', strtotime($date)); ?></h4>
                          <p class="titlefontfamily hours {{$daily_hours_set_1->slug}}"><?= $daily_hours_set_1->text; ?>
                          <div class="hoursdetail">
                            <table border="0">
                              <tr>
                               
                                <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_start_title->slug}}"><?= $daily_hours_start_title->text ?>: </span></td>
                                <td class="text-right"><span class="titlefontfamily hoursdetailtimes" > <?= ($show && isset($rotateSch)) ? ltrim($rotateSch->start, '0') : '--' ?></span></td>
                              </tr>
                              <tr>
                                <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_end_title->slug}}"><?= $daily_hours_end_title->text ?>: </span></td>
                                <td class="text-right"><span class="titlefontfamily hoursdetailtimes" ><?= ($show && isset($rotateSch)) ? ltrim($rotateSch->end, '0') : '--' ?></span>
                              </tr>
                            </table>
                          </div>
                          </p>
                          <div class="clearfix"></div>
                          <?php if ($show && isset($rotateSch) && !empty($rotateSch->comments)) { ?>
                            <div class=" {{$busniess_hours_comments->slug}}  mb-5px" ><?= ($show && isset($rotateSch) && !empty($rotateSch->comments)) ? $rotateSch->comments : '' ?></div>
                          <?php } ?>
                          <?php if ($show && isset($rotateSch) && !empty($rotateSch->start_2)) { ?>
      
                            <p class="titlefontfamily hours2 {{$daily_hours_set_2->slug}}"><?= $daily_hours_set_2->text ?>
                            <div class="hoursdetail">
                              <table border="0">
                                <tr>
                                  <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_start_title->slug}}"><?= $daily_hours_start_title->text ?>: </span></td>
                                  <td class="text-right"><span class="titlefontfamily hoursdetailtimes"><?= ($show && isset($rotateSch)) ? ltrim($rotateSch->start_2, '0') : '--' ?></span></td>
                                </tr>
                                <tr>
                                  <td><span class="titlefontfamily hoursdetailstart {{$daily_hours_end_title->slug}}"><?= $daily_hours_end_title->text ?>: </span></td>
                                  <td class="text-right"><span class="titlefontfamily hoursdetailtimes"><?= ($show && isset($rotateSch)) ? ltrim($rotateSch->end_2, '0') : '--' ?></span></td>
                                </tr>
                              </table>
                            </div>
                            </p>
                            <div class="clearfix"></div>
                            <?php if ($show && isset($rotateSch) && !empty($rotateSch->comments_2)) { ?>
                              <p class="dailyhourscomment {{$busniess_hours_comments->slug}}  mb-5px" ><?= $rotateSch->comments_2 ?></p>
                            <?php } ?>
      
                            
                          <?php } ?>
                          
                          
                          <div style=" ">
                            
                            <?php 
                            $text_image  = "";
                                if(!empty($rotateSch->image_description)){
                                  ?>
                                    <?php 
                                      $text_image = $rotateSch->image_description;
                                    ?>
                                  <?php 
                                }
      
                              ?>
                          <?php 
                  
                            if(!empty($rotateSch->image)){
                              $step_image = [];
                              $step_image = check_step_image('Rotating Schedule (Master) Image');
                              if (!empty($step_image) && $date == date('Y-m-d') ) {
                                    
                                ?>
                                <img src="<?=url("assets/uploads/".get_current_url().$step_image['image'])?>" class="img-thumbnail "  >
                        
                                <?php
                                if (!empty($step_image['text'])) {
                                ?>
                                  <div class="rotate-master-image">
                                    <?= nl2br($step_image['text']) ?>
                                </div>
                                <?php
                                }
                                ?>
                              <?php
                              }else{
                              ?>
                              ?>
                                <img src="<?=url("assets/uploads/".get_current_url().$rotateSch->image)?>" class=" img-thumbnail mb-5px"  
                                <?php if($text_image  !=""){ ?>
                                style="position:relative !important;"  
                                <?php } ?>
                                >
                                  <div class="image_text_{{$rotateSch->id}}">
                                    <?=$text_image ?>
                                  </div>
                              <?php 
                              }?>
      
                              <?php 
                            }elseif (!empty($rotatingScheduleSettings->apply_all_days) && !empty($rotatingScheduleSettings->rotating_schedule_image)) { ?>
                              
                              <?php                        
                                    $step_image = [];
                                    $step_image = check_step_image('Rotating Schedule (Master) Image');
                                    if (!empty($step_image)) {
                                    ?>
                                      <img src="<?=url("assets/uploads/".get_current_url().$step_image['image'])?>" class="img-thumbnail lazyload"  >
                              
                                      <?php
                                      if (!empty($step_image['text'])) {
                                      ?>
                                        <div class="rotate-master-image">
                                          <?= nl2br($step_image['text']) ?>
                                      </div>
                                    <?php
                                    }
                                    ?>
                                  <?php
                                  }else{
                                  ?>
                                    <img src="<?=url("assets/uploads/".get_current_url().$rotatingScheduleSettings->rotating_schedule_image)?>" class="img-thumbnail lazyload" >
                                    <div class="day_master_image_text {{$master_image_description->slug}} text-center">
                                      <?= $master_image_description->text?>
                                    </div>
                                  <?php 
                                  }?>
                                  
                                
                            <?php } ?>
      
                              
                          </div>
                          
                          <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
                        </div>
                      </li>
                    <?php
                      $day_count++;
                    } ?>
                  </ul>
                </div>
              
    
    
    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('sections.schedulesection.scripts')
<?php } ?>