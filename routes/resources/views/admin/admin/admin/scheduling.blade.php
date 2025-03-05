@extends('admin.layout.dashboard')
@section('content')
 
<script>
  var sub_sections = ["rotating_schedule","set_schedule"];
</script>


<?php 
$block = isset($_GET['block']) ? $_GET['block']:'';
?>

<div id="content">
<div class="fixJumButtons mb-18"> 
  <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2">Scheduling</div>
      <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
        <div class="d-flex justify-content-end align-items-center">
          @if (check_auth_permission('toggle_option'))
          <div>
            <div class="d-flex">
              <div class="form-group  text-center">
                <div class="title-2 mb-1 tipOnOffStatus">&nbsp;</div>
                <div class="title-2 mb-1">Tips</div>
                <label class="myswitchdiv">
                  <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('business_hours',sub_sections)">
                  <img src="{{url('assets/admin2/img/tips.png')}}" alt="">
                </label>
              </div>
              <div class="form-group text-center ml-4">
                <div class="title-2 mb-1">Controls in Settings</div>
                  <div class="title-2 mb-1">Notifications</div>
                <label class="myswitchdiv switch_disabled">
                  <input type="checkbox" class="myswitch" name="notificationswitch" data-module="notification_busniess_hours"
                  <?= $notificationSettings->notification_switch ? 'checked' : '' ?>>
                  <img src="{{url('assets/admin2/img/notification.png')}}" alt="">
                </label>
              </div>
            </div>
          </div>
            @endif
          </div>
          <div class="ml-4">
              <div class="dropdown-list-main-div">
                  <div class="dropdown-list">
                      <div class="title-3 text-color-grey listtxt">Feature Access</div>
                      <div>
                          <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
                      </div>
                  </div>
                  <div class="dropdown-list-div">
                      <ul>
                          <li data-value="set_schedule">Set Schedule</li>
                          <li data-value="rotating_schedule">Rotating Schedule</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="sticky">
    @if (check_auth_permission(['set_hours', 'set_hours_time_settings', 'set_hours_image', 'set_hours_timed_image']))
    <!-- <div class="dropdown-list-main-div mt-2">
      <div class="dropdown-list">
          <div class="title-3 text-color-grey listtxt">Set Schedule Options</div>
          <div>
              <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
          </div>
      </div>
      <div class="dropdown-list-div">
        <ul>    
        <?php $date = date('Y-m-d', strtotime("this week monday")); ?>
        <li data-value="set_schedule_<?= date('D', strtotime($date)) ?>"><?= date('l', strtotime($date)) ?> Settings </li>
            <?php for ($i = 1; $i <= 6; $i++) { ?>
              <li data-value="set_schedule_<?= date('D', strtotime($date.' +'.$i.' days')) ?>"><?= date('l', strtotime($date.' +'.$i.' days')) ?> Settings </li>
            <?php 
            }
            ?>
        </ul>
      </div>
    </div> -->
    @endif
    @if (check_auth_permission(['rotating_schedule', 'rotating_hours_time_settings']))
    <!-- <div class="dropdown-list-main-div mt-2">
      <div class="dropdown-list">
          <div class="title-3 text-color-grey listtxt">Rotating Schedule Options</div>
          <div>
              <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
          </div>
      </div>
      <div class="dropdown-list-div">
          <ul>    
          <?php $date = date("Y-m-d", strtotime('monday this week')) ?>
            <?php

            for ($i = 0; $i <= 13; $i++) { ?>

                <li data-value="rotat_<?= date('D_M_d_Y', strtotime($date)); ?>"> <?= date('D, M. d, Y', strtotime($date)); ?> </li>
                <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
            <?php
            }?>
          </ul>
      </div>
    </div> -->
    @endif
  </div>
  <?php if (check_auth_permission(['set_hours', 'set_hours_time_settings', 'set_hours_image', 'set_hours_timed_image'])) { ?>
    
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="set_schedule" data-top="set_schedule_top" data-bottom="set_schedule_bottom" data-tip_section="set_schedule">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Set Schedule</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('currenthourssection'))
                <div class="enable-disable-feature-div">
                    <div class="title-4-400 text-color-green">Enabled</div>
                </div>
            @else
                <div class="enable-disable-feature-div">
                    <div class="title-4-400 text-color-red2">Disabled</div>
                </div>
            @endif
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
              </div>
          </div>
        </div>
      </div>

      <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='set_schedule'?'display:block;':''?>">
        <form action="{{url('savesethours')}}" method="post" enctype="multipart/form-data">
        @csrf
           
          <?php if (check_auth_permission(['build_site_Content'])) { ?>
           <div class="row mb-17">
            <div class="col-md-3">
                <div class="form-group d-flex">
                    <label>Override Background <br>Color in Settings, Theme</label>
                    <label class="switch ml-7">
                        <input type="checkbox" class="notificationswitch override_bg_enable scheduling_override_bg" name="scheduling_override_bg" data-slug="scheduling_bg_picker"
                            <?php echo  $setHoursSettings->scheduling_override_bg ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group scheduling_bg_picker" style="display:<?php echo  $setHoursSettings->scheduling_override_bg ? 'block' : 'none' ?>">
                <label>Feature's Background Color</label>
                <input type="color" class="myinput2" name="busniess_hours_background" value="<?= $setHoursSettings->background ? $setHoursSettings->background : '#000000' ?>">
              </div>
            </div>
            <?php $set_schedule_outline = get_outline_settings('set_schedule_outline');?>
            <div class="col-md-6 text-right">
                <div class="align-all-right d-flex align-items-end">
                    <div class="form-group  d-flex align-items-center">
                        <div for="" class="title-9 text-black">Turn On Outline</div>
                        <label class="switch ml-7">
                            <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="set_schedule_outline"
                                <?php echo  $set_schedule_outline->active ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group ml-34">
                      <div for="" class="title-9 text-black">Color of outline</div>
                        <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $set_schedule_outline->outline_color ?>" placeholder="#000000" data-slug="set_schedule_outline">
                    </div>
                </div>
            </div>
        </div>
        <div class="myhr mb-16"></div>
        <?php } ?>
          <div class="row  p-2 sticky-buttons-list mb-2">
            <div class="col-12 pb-2  pt-2 mb-1 jump-to-buttons make-jumto-sticky" style="    background: #E3F3FF;" align="center">
              <?php if (check_auth_permission(['set_hours_time_settings'])) { ?>
                <?php $date = date('Y-m-d', strtotime("this week monday")); ?>
                <?php for ($i = 0; $i <= 6; $i++) { ?>
                  <button type="button" data-value="set_schedule_<?= date('D', strtotime($date.' +'.$i.' days')) ?>" class="btn ml-1 btn-jump  btn-primary btn-sm mb-1 mt-1  text-bold
                  ">
                    <?= strtoupper( date('l', strtotime($date.' +'.$i.' days'))) ?>
                  </button>
                <?php }  ?>
              <?php }  ?>
              <?php if (check_auth_permission(['set_hours_image'])) { ?>
                <button type="button" data-value="set_schedule_image" class="btn ml-1  btn-primary btn-sm  btn-jump text-bold">Default Image</button>
              <?php }  ?>
              <?php if (check_auth_permission(['set_hours_time_settings'])) { ?>
                <button type="button" data-value="set_schedule_style_settings" class="btn ml-1  btn-primary btn-jump btn-sm  text-bold">Generic Settings</button>
              <?php }  ?>
            </div>
          </div>
        
            <div id="set_schedule_top"></div>
            <?php if (check_auth_permission(['set_hours_image'])) { ?>
              <div id="set_schedule_image">
              <?php if (check_step_image('Set Hours Image')) { ?>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow 1-Step Button to Expire</h5>
                  </div>
                </div>
              <?php } ?>
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="title-2">Set Schedule Settings</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
              
                  <div class="row">
                      <?php if ($setHoursSettings->set_hour_image) { ?>
                        <div class="col-md-3 set_hour_image_div">
                          <div class="form-group">
                            <label for="headerlogo">Schedule Image</label>
                            <img src="<?= base_url('assets/uploads/'.get_current_url() . $setHoursSettings->set_hour_image) ?>" width="100%">
                            <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $setHoursSettings->set_hour_image ?>','set_hour_image','set_hour_image_div','set_hours_settings','<?= $setHoursSettings->id ?>')">X</button>
                          </div>
                        </div>
                      <?php } ?>
                      <div class="col-md-4">
                        <div class="uploadImageDiv">
                          <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                          <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                          <input class="dataimage" type="hidden" name="set_hour_image">

                          <div class="col-md-6 imgdiv" style="display:none">
                            <br>
                            <img src='' width="100%" class="imagefromgallerysrc">
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="bannertextcolor">Set Schedule Image Size</label><br>
                          <input type="text" class="myinput2 Set Schedule width-50px" name="set_hour_image_width" id="headerimgwidth" value="<?= $setHoursSettings->set_hour_image_width ?>" placeholder="50">
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Schedule Image Description Text </label>
                        <input type="text" class="myinput2" name="hour_image_desc_text" value="<?= isset($schedule_image_desc_text->text) ? $schedule_image_desc_text->text : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Schedule Image Description Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="hour_image_desc_text_font_size" 
                        value="<?= isset($schedule_image_desc_text->size_web) ? $schedule_image_desc_text->size_web : '' ?>"
                          placeholder="18">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Schedule Image Description Text Color</label>
                        <input type="color" class="myinput2" name="hour_image_desc_text_color" 
                        value="<?= isset($schedule_image_desc_text->color) ? $schedule_image_desc_text->color : '' ?>" placeholder="#FFFFF">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Schedule Image Description Font</label>
                        <select class="myinput2" name="hour_image_desc_text_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($schedule_image_desc_text->fontfamily) && $schedule_image_desc_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row form-bottom make-sticky z-index-11">
                    <div class="col-md-12">
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Settings</button>
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Settings & send reminder</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php if (check_auth_permission(['set_hours_timed_image'])) { ?>
            <!-- Timed Header Image Start -->
            <div class="timedimagediv">
              <div id="timed_set_schedule_image">
                <div class="content2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                        <div class="d-flex align-items-center titlediv d-flex">
                          <div class="title-2">Timed Set Hour Image Settings</div>
                          <div class="form-group  switchoverhead2" >
                            <label class="switch m-0">
                              <input type="checkbox" class="timeimagesswitch" name="enable_timed_set_hour_image" <?= $timed_set_hour_image->enable ? 'checked' : ''; ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <div>
                          <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                        </div>
                      </div>
                     
                    </div>
                  </div>
                  <div class="editcontent2">
                    <div class="timedimages <?php //echo  $timed_set_hour_image->enable ? '' : 'hidden' ?>">
                      <br>
                      <div class="row">
                        <div class="col-md-4">
                          <?php
                          $start_time = new DateTime($timed_set_hour_image->start_time	, new DateTimeZone(getFrontDataTimeZone()));

                          $end_time = new DateTime($timed_set_hour_image->end_time	, new DateTimeZone(getFrontDataTimeZone()));

                          $days = json_decode($timed_set_hour_image->days);
                          ?>
                          <div class="row nopadding datetimediv_popup">
                            <div class="col-md-6 nopadding">
                              <div class="form-group">
                                  <label for="set_hour_image_type">Type</label>
                                  <select name="set_hour_image_type" class="myinput2 timed_image_type" id="set_hour_image_type">
                                      <option value="days" <?=$timed_set_hour_image->type=='days'?'selected':''?>>By Days</option>
                                      <option value="timer" <?=$timed_set_hour_image->type=='timer'?'selected':''?>>Timer</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6 nopadding">
                              <div class="timed_type_divs timer_div" style="<?=$timed_set_hour_image->type=='timer'?'display:block;':'display:none;'?>">
                                  <div class="form-group">
                                      <label for="set_hour_image_timer">Timer</label>
                                      <select name="set_hour_image_timer" class="myinput2" id="set_hour_image_timer">
                                        <option value="15" <?=$timed_set_hour_image->image_timer=='15'?'selected':''?>>15 min</option>
                                        <option value="30" <?=$timed_set_hour_image->image_timer=='30'?'selected':''?>>30 min</option>
                                        <option value="60" <?=$timed_set_hour_image->image_timer=='60'?'selected':''?>>1 hour</option>
                                      
                                        <option value="120" <?=$timed_set_hour_image->image_timer=='120'?'selected':''?>>2 hour</option>
                                        <option value="240" <?=$timed_set_hour_image->image_timer=='240'?'selected':''?>>4 hour</option>
                                        <option value="360" <?=$timed_set_hour_image->image_timer=='360'?'selected':''?>>6 hour</option>
                                        <option value="480" <?=$timed_set_hour_image->image_timer=='480'?'selected':''?>>8 hour</option>
                                        <option value="720" <?=$timed_set_hour_image->image_timer=='720'?'selected':''?>>12 hour</option>
                                        <option value="1440" <?=$timed_set_hour_image->image_timer=='1440'?'selected':''?>>24 hour</option>
                                        <option value="2880" <?=$timed_set_hour_image->image_timer=='2880'?'selected':''?>>48 hour</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="timed_type_divs days_div" style="<?=$timed_set_hour_image->type=='days'?'display:block;':'display:none;'?>">
                                <div class="form-group">
                                  <label for="start_time">Start Time</label>
                                  <input type="time" name="set_hour_image_start_time" class="myinput2" id="start_time" value="<?php echo $start_time->format('H:i'); ?>">
                                </div>
                                <div class="form-group">
                                  <label for="end_time">End Time</label>
                                  <input type="time" name="set_hour_image_end_time" class="myinput2" id="end_time" value="<?php echo $end_time->format('H:i'); ?>">
                                </div>
                                <div class="form-group">
                                  <label for="">Select Days</label>
                                  <select class="myinput2 multiselectlist" name="days[]" multiple>
                                    <option value="mon" <?=is_array($days) && in_array('mon',$days)?'selected':''?>>Monday</option>
                                    <option value="tue" <?=is_array($days) && in_array('tue',$days)?'selected':''?>>Tuesday</option>
                                    <option value="wed" <?=is_array($days) && in_array('wed',$days)?'selected':''?>>Wednesday</option>
                                    <option value="thu" <?=is_array($days) && in_array('thu',$days)?'selected':''?>>Thursday</option>
                                    <option value="fri" <?=is_array($days) && in_array('fri',$days)?'selected':''?>>Friday</option>
                                    <option value="sat" <?=is_array($days) && in_array('sat',$days)?'selected':''?>>Saturday</option>
                                    <option value="sun" <?=is_array($days) && in_array('sun',$days)?'selected':''?>>Sunday</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="uploadImageDiv">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="timed_set_hour_image">

                            <div class="col-md-6 imgdiv" style="display:none">
                              <br>
                              <img src='' width="100%" class="imagefromgallerysrc">
                              <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                          </div>
                        </div>
                        <?php if ($timed_set_hour_image_file->file_name) { ?>
                          <div class="col-md-3 timed_set_hour_block_image_div">
                            <div class="form-group">
                              <label for="headerimage">Timed Set Schedule Image</label>
                              <img src="<?= base_url('assets/uploads/'.get_current_url() . $timed_set_hour_image_file->file_name) ?>" width="100%">
                              <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_set_hour_image_file->file_name ?>','timed_set_hour_image','timed_set_hour_block_image_div','images','0','true')">X</button>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="row form-bottom make-sticky z-index-11">
                      <div class="col-md-12">
                        <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Timed Images</button>
                        <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Timed Images & send reminder</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Timed Header Logo End -->
              </div>
            </div>
          <?php } ?>


          <?php
            if (check_auth_permission(['set_hours_time_settings'])) {
              $dailyhoursarray = array();
              date_default_timezone_set(getTimeZone($siteSettings->timezone));
              
              if (count($setHours)>0) {
                foreach ($setHours as $value) {
                  $dailyhoursarray[] = $value;
                }
              }
          ?>

             
            <?php $date = date('Y-m-d', strtotime("this week monday")); ?>
            <?php for ($i = 0; $i <= 6; $i++) { ?>
              <div id="set_schedule_<?= date('D', strtotime($date)) ?>">
                <div class="content2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                        <div class="title-2">
                          <span class="title-bold">
                            <?= date('l', strtotime($date)); ?></span>
                            Settings
                          </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                      </div>
                    </div>
                  </div>
                  <div class="editcontent2">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <h3 class="text-black"><?= date('l', strtotime($date)); ?></h3>
                          <input type="hidden" name="dailyhours[]" value="<?= $date ?>">
                          <input type="hidden" name="sethoursid[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->id : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">                      
                          <label for="bannertext">Override the Generic Settings</label>
                          <br/>
                          <label class="switch">
                            <input type="checkbox" class="hours_orveride_generic"  value="1" name="hours_orveride_generic[<?=$i?>]" <?php echo (isset($dailyhoursarray[$i]->hours_orveride_generic) && $dailyhoursarray[$i]->hours_orveride_generic == '1') ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="form-group">
                          <label>Hours Color</label>
                          <input type="color" class="myinput2" name="daily_hours_color[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->hours_color : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">                      
                          <label for="bannertext">Override the Generic Settings</label>
                          <br/>
                          <label class="switch">
                            <input type="checkbox" class="day_orveride_generic"  value="1" name="day_orveride_generic[<?=$i?>]" <?php echo (isset($dailyhoursarray[$i]->day_orveride_generic) &&  $dailyhoursarray[$i]->day_orveride_generic == '1') ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="form-group">
                          <label>Day Color </label><label style='color:red'>(Override Generic Settings Master Color)</label>
                          <input type="color" class="myinput2" name="daily_hours_day_color[]" value="<?= isset($dailyhoursarray[$i]) && isset( $dailyhoursarray[$i]->day_color ) ? $dailyhoursarray[$i]->day_color : '' ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Start/Sub-Title or Time</label>
                          <input type="text" class="myinput2" name="daily_hours_start[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->start : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>End/Sub-Title or Time</label>
                          <input type="text" class="myinput2" name="daily_hours_end[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->end : '' ?>">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Start & End/Sub-Title or Time Comments</label>
                          <input type="text" class="myinput2" name="daily_hours_comments[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->comments : '' ?>" placeholder="">
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <label>Enter data into the fields below to create a second set of times/comments</label>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Start Time</label>
                          <input type="text" class="myinput2" name="daily_hours_start2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->start_2 : '' ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>End Time</label>
                          <input type="text" class="myinput2" name="daily_hours_end2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->end_2 : '' ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Comments</label>
                          <input type="text" class="myinput2" name="daily_hours_comments2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->comments_2 : '' ?>" placeholder="">
                        </div>
                      </div>

                    </div>
                    <div class="row form-bottom make-sticky z-index-11">
                      <div class="col-md-12">
                        <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Hours</button>
                        <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Hours & send reminder</button>
                      </div>
                    </div>
                  </div>
                  <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
                </div>
              </div>
              <?php }
          }
          ?>

          <?php if (check_auth_permission('set_hours_time_settings')) { ?>
            <div id="set_schedule_style_settings">
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="title-2">Generic Settings</div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Hours Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="daily_hours_fontsize_gen" value="<?= $daily_hours->size_web?>" placeholder="e.g 18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Hours Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="daily_hours_fontsize_mobile_gen" value="<?= $daily_hours->size_mobile?>" placeholder="e.g 18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Hour Text Color</label>
                      <input type="color" class="myinput2" name="set_hours_hour_color" value="<?= $daily_hours->color ? $daily_hours->color : '#000000' ?>">
                      <input type="hidden" name="old_set_hours_hour_color" value="<?=$daily_hours->color ? $daily_hours->color : '#000000'?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Day Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_date_font_size" value="<?= $set_hours_day->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Day Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_date_font_size_mobile" value="<?= $set_hours_day->size_mobile ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Day Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_date_color" value="<?= $set_hours_day->color ? $set_hours_day->color : '#000000' ?>">
                      <input type="hidden" name="old_busniess_hours_date_color" value="<?= $set_hours_day->color ? $set_hours_day->color : '#000000' ?>">                      
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Day Font</label>
                      <select class="myinput2" name="set_hours_date_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $set_hours_day->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-3"> 
                    <div class="form-group">
                      <label>Sub-Title</label>
                      <input type="text" class="myinput2" name="busniess_hours_hours_title" value="<?= $set_hours_sub_title->text ?>" placeholder="Hours">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Sub-Title Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_hours_title_fontsize" value="<?= $set_hours_sub_title->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Sub-Title Text Size onMobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_hours_title_fontsize_mobile" value="<?= $set_hours_sub_title->size_mobile ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Sub-Title Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_title_color" value="<?= $set_hours_sub_title->color ? $set_hours_sub_title->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Sub-Title Font</label>
                      <select class="myinput2" name="busniess_hours_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $set_hours_sub_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Comment Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_hours_comment_fontsize" value="<?= $set_hours_comment->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Comment Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="set_hours_hours_comment_fontsize_mobile" value="<?= $set_hours_comment->size_mobile ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Comment Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_comment_color" value="<?= $set_hours_comment->color ? $set_hours_comment->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Comment Text Font</label>
                      <select class="myinput2" name="set_hours_hours_comment_fontfamily">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= ($set_hours_comment->fontfamily == $single->id) ? 'selected' : '' ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row form-bottom make-sticky z-index-11">
                  <div class="col-md-12">
                    <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Generic Settings</button>
                    <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Generic Settings & send reminder</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <div id="set_schedule_bottom"></div>
          <div class="row form-bottom make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  
  <?php if (check_auth_permission(['rotating_schedule', 'rotating_hours_time_settings'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="rotating_schedule" data-top="rotating_schedule_top" data-bottom="rotating_schedule_bottom" data-tip_section="rotating_schedule">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Rotating Schedule</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('schedulesection'))
                <div class="enable-disable-feature-div">
                    <div class="title-4-400 text-color-green">Enabled</div>
                </div>
            @else
                <div class="enable-disable-feature-div">
                    <div class="title-4-400 text-color-red2">Disabled</div>
                </div>
            @endif
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
              </div>
          </div>
        </div>
      </div>

      <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='rotating_schedule'?'display:block;':''?>">
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <form action="{{url('saverotatinghours')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-17">
            <div class="col-md-3">
                <div class="form-group d-flex">
                    <label>Override Background <br>Color in Settings, Theme</label>
                    <label class="switch ml-7">
                        <input type="checkbox" class="notificationswitch override_bg_enable busniess_hours_override_bg" name="busniess_hours_override_bg" data-slug="busniess_hours_bg_picker"
                            <?php echo  $rotatingScheduleSettings->busniess_hours_override_bg ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group busniess_hours_bg_picker" style="display:<?php echo  $rotatingScheduleSettings->scheduling_override_bg ? 'block' : 'none' ?>">
                <label>Feature's Background color</label>
                <input type="color" class="myinput2" name="busniess_hours_background" value="<?= $rotatingScheduleSettings->background ? $rotatingScheduleSettings->background : '#000000' ?>">
              </div>
            </div>
            <?php $rotating_schedule_outline = get_outline_settings('rotating_schedule_outline');?>
            <div class="col-md-6 text-right">
                <div class="align-all-right d-flex align-items-end">
                    <div class="form-group  d-flex align-items-center">
                        <div for="" class="title-9 text-black">Turn On Outline</div>
                        <label class="switch ml-7">
                            <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="rotating_schedule_outline"
                                <?php echo  $rotating_schedule_outline->active ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group ml-34">
                      <div for="" class="title-9 text-black">Color of outline</div>
                        <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $rotating_schedule_outline->outline_color ?>" placeholder="#000000" data-slug="rotating_schedule_outline">
                    </div>
                </div>
            </div>
        </div>
        <div class="myhr mb-16"></div>
        <?php } ?>
        <div class="row p-2 sticky-buttons-list mb-2">
          <div class="col-12 pb-2  pt-2 mb-1 jump-to-buttons make-jumto-sticky" style="    background: #E3F3FF;" align="center">
          <?php //$date = date("Y-m-d", strtotime('sunday this week')) ?>
          <?php $date = date("Y-m-d") ?>
            <?php

            for ($i = 0; $i <= 6; $i++) { ?>
              <button type="button" data-value2="rotating_schedule_<?= date('D', strtotime($date.' +'.$i.' days')) ?>" data-value="rotat_<?= date('D_M_d_Y', strtotime($date.' +'.$i.' days')) ?>" class="btn ml-1 btn-jump mb-1 mt-1 btn-primary btn-sm  text-bold
              ">
                <?= strtoupper( date('D', strtotime($date.' +'.$i.' days'))) ?>
                <span style="font-weight:normal">
                  <?= strtoupper( date('M-d', strtotime($date.' +'.$i.' days'))) ?>
                </span>
              </button>
            <?php 
            }
            ?>
            <button type="button" data-value="masterImageUpload" class="btn ml-1 btn-primary btn-sm btn-jump  text-bold
            ">
              Default Image
            </button>
          </div>
          <div class="col-12 pb-2  pt-2 jump-to-buttons make-jumto-sticky" style="    background: #E3F3FF;" align="center">
            <?php

              for ($i = 7; $i <= 13; $i++) { ?>
                <button type="button" data-value2="rotating_schedule_<?= date('D', strtotime($date.' +'.$i.' days')) ?>" data-value="rotat_<?= date('D_M_d_Y', strtotime($date.' +'.$i.' days')) ?>" class="btn ml-1 btn-jump mb-1 mt-1 btn-primary btn-sm  text-bold
                ">
                  <?= strtoupper( date('D', strtotime($date.' +'.$i.' days'))) ?>
                  <span style="font-weight:normal">
                    <?= strtoupper( date('M-d', strtotime($date.' +'.$i.' days'))) ?>
                  </span>
                </button>
              <?php 
              }
            ?>
            <button type="button" data-value="rotating_schedule_style_settings" class="btn ml-1 mb-1 btn-primary btn-jump btn-sm  text-bold
            ">
            Generic Settings
            </button>
          </div>
        </div>
       
          <div id="rotating_schedule_top"></div>
            <div  id="masterImageUpload">
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="title-2">Rotating Schedule Image</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row" >        

                    <?php if (check_auth_permission(['rotating_schedule', 'rotating_shift_image'])) { ?>
                    <div class="col-md-4" style="margin-bottom:15px;">
                      <div  class="uploadImageDiv">
                        <label for="headerlogo">Rotating Schedule's Master Image</label>
                        <br/>
                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="rotating_shift_image">
                        <br/>
                        <div class="col-md-6 imgdiv" style="display:none">
                          <br>
                          <img src='' width="100%" class="imagefromgallerysrc">
                          <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                        </div>
                      </div>
                    </div>                  
                    <?php } ?>

                    <?php if (check_auth_permission(['rotating_schedule', 'rotating_shift_image'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">                      
                        <label for="bannertext">Apply Master Image to All Days</label>
                        <br/>
                        <label class="switch">
                          <input type="checkbox" class="master_image_toggle"  value="yes" name="is_master_image_on" <?php echo $rotatingScheduleSettings->apply_all_days == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Master Image Size </label><br>
                        <input type="text" class="myinput2 width-50px" name="max_width"  max="175" min="1" value="<?= $rotatingScheduleSettings->max_width ?>" placeholder="175px">
                        <br><label class="text-color-red">Max width can be 175px</label>
                      </div>
                    </div>
                  </div>
                  
                  <?php if ($rotatingScheduleSettings->rotating_schedule_image) { ?>
                    <div class="row">
                      <div class="col-md-3 rotating_shift_image_div">
                        <div class="form-group">
                          <img src="<?= base_url('assets/uploads/' .get_current_url(). $rotatingScheduleSettings->rotating_schedule_image) ?>" width="100%">
                          <button type="button" class="btn btn-primary btnimgdel header_logo_delete" onclick="delete_front_image('<?= $rotatingScheduleSettings->rotating_schedule_image ?>','rotating_schedule_image','rotating_shift_image_div','rotating_schedule_settings','<?= $rotatingScheduleSettings->id ?>')">X</button>
                        </div>
                      </div>
                    </div>
                  <?php } ?>

                
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Master Image Description Text </label>
                        <input type="text" class="myinput2" name="day_master_image_description_text" value="<?= $master_image_description->text ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Master Image Description Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="day_master_image_description_text_size" 
                        value="<?= $master_image_description->size_web ?>"
                          placeholder="18">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Master Image Description Text Color</label>
                        <input type="color" class="myinput2" name="day_master_image_description_text_color" 
                        value="<?= $master_image_description->color ?>" placeholder="#FFFFF">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title_font_size">Master Image Description Font</label>
                        <select class="myinput2" name="day_master_image_description_text_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $master_image_description->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row form-bottom make-sticky z-index-11">
                    <div class="col-md-12">
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Image</button>
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Image & send reminder</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          <?php
          if (check_auth_permission(['rotating_schedule', 'rotating_hours_time_settings'])) {
            $dailyhoursarray = array();
            if (count($rotatingSchedule)) {
              foreach ($rotatingSchedule as $key => $value) {
                $dailyhoursarray[] = $value;
              }
            }
            //$duplications_array = isset($dailyhoursarray['duplications']) ? (array)$dailyhoursarray['duplications'] : array();
          ?>
            <?php $date = date("Y-m-d") ?>
            <?php //$date = date("Y-m-d", strtotime('monday this week')) ?>
            <?php

            $duplications = [];
            for ($i = 0; $i <= 13; $i++) { 
              if ($dailyhoursarray[$i]->duplicate_for_next_week_day && !in_array($dailyhoursarray[$i]->day,$duplications )) {
                $duplications[] = $dailyhoursarray[$i]->day;
              }else{
                  $duplications[] ='';
              }
            }

            $duplication_array = (isset($duplications)) ? (array)$duplications : array();
           
            for ($i = 0; $i <= 13; $i++) {
              $index2 = array_search(date('D', strtotime($date)), $duplication_array);
              if($index2){
                $dailyhoursarray[$i] = isset($dailyhoursarray[$index2])? $dailyhoursarray[$index2]: $dailyhoursarray[$i];
              }
              ?>
              <?php if ($i <= 6) {
              ?>
                <div id="rotating_schedule_<?= date('D', strtotime($date)) ?>">
                <?php
              } ?>
              <input type="hidden" name="rotatinghoursid[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->id : '' ?>">
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="title-2">
                        <span class="title-bold">
                          <?= date('l', strtotime($date)); ?>
                        </span>
                        <?= date(' M. d, Y', strtotime($date)); ?> </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2 rotat_<?= date('D_M_d_Y', strtotime($date)); ?>">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <h3 class="text-black">
                          <?= date('l M. d, Y', strtotime($date)); ?>
                        </h3>
                        <input type="hidden" name="dailyhours[]" value="<?= $dailyhoursarray[$i] ?>">
                        <input type="hidden" name="day[]" value="<?= date('D', strtotime($date)) ?>">
                        <input type="hidden" name="date[]" value="<?= date('Y-m-d', strtotime($date)) ?>">
                      </div>
                    </div>
                    <?php if ($i <= 6) {
                    ?>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="switch">
                            <input type="checkbox"  class="dailyhours repeat_hours" id="{{$dailyhoursarray[$i]->id}}" value="<?= date('D', strtotime($date)); ?>" name="duplications[<?= $i ?>]" <?= (isset($dailyhoursarray[$i]) && $dailyhoursarray[$i]->duplicate_for_next_week_day=='1') ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                          <label for="bannertext">Duplicate This <?= date('l', strtotime($date)); ?> for Next <?= date('l', strtotime($date)); ?></label>
                        </div>
                      </div>
                    <?php
                    } ?>
                  </div>
          
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Start/Sub-Title #1 or Time #1</label>
                        <input type="text" class="myinput2" name="daily_hours_start[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->start : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>End/Sub-Title #1 or Time #1</label>
                        <input type="text" class="myinput2" name="daily_hours_end[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->end : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>#1 Comments</label>
                        <input type="text" class="myinput2" name="daily_hours_comments[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->comments : '' ?>" placeholder="">
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Start/Sub-Title #2 or Time #2</label>
                        <input type="text" class="myinput2" name="daily_hours_start2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->start_2 : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>End/Sub-Title #2 or Time #2</label>
                        <input type="text" class="myinput2" name="daily_hours_end2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->end_2 : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>#2 Comments</label>
                        <input type="text" class="myinput2" name="daily_hours_comments2[]" value="<?= isset($dailyhoursarray[$i]) ? $dailyhoursarray[$i]->comments_2 : '' ?>" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="margin-bottom:15px;">
                      <div class="uploadImageDiv">
                      
                        <button type="button" class="btn btn-primary btnuploadimagenew day-image" data-toggle="modal"  data-target="#modalImagesforUploads">Upload image</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="day_image[<?=$i?>]">
                        <label for="headerlogo" style="margin-left:10px;"><?= date('l, d M', strtotime($date)); ?> Image</label>
                        <br/>
                        <div class="col-md-4 imgdiv" style="display:none">
                          <br>
                          <img src='' width="100%" class="imagefromgallerysrc">
                          <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                        </div>
                      </div>
                    </div>           
                  </div>
                  <?php if ( isset($dailyhoursarray[$i]) && !empty($dailyhoursarray[$i]->image))  { 
                  
                    ?>
                    <input type="hidden" name="old_day_image[<?=$i?>]" value="<?=$dailyhoursarray[$i]->image?>" >
                    <div class="row">
                      <div class="col-md-4 day_image_div<?= $dailyhoursarray[$i]->id?>">
                        <div class="form-group">
                          <img src="<?= base_url('assets/uploads/'.get_current_url() . $dailyhoursarray[$i]->image ) ?>" width="100%">
                          <button type="button" class="btn btn-primary btnimgdel header_logo_delete" onclick="delete_front_image('<?= $dailyhoursarray[$i]->image  ?>','image','day_image_div<?= $dailyhoursarray[$i]->id?>','rotating_schedules','<?= $dailyhoursarray[$i]->id?>')">X</button>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Day Image Description Text </label>
                        <input type="text" class="myinput2" name="day_image_description_text[]" value="<?= isset($dailyhoursarray[$i]) && isset($dailyhoursarray[$i]->image_description) ? $dailyhoursarray[$i ]->image_description : '' ?>" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Day Image Description Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="day_image_description_text_font_size[]" 
                        value="<?= isset($dailyhoursarray[$i]) && isset($dailyhoursarray[$i]->description_font_size) ? $dailyhoursarray[$i]->description_font_size : '' ?>"
                        placeholder="18">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Day Image Description Font</label>
                        <select class="myinput2" name="day_image_description_text_font[]">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($dailyhoursarray[$i]->description_font_family) && $dailyhoursarray[$i]->description_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row form-bottom make-sticky z-index-11">
                    <div class="col-md-12">
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Hours</button>
                      <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Hours & send reminder</button>
                    </div>
                  </div>
                  <?php if ($i <= 6) {
                  ?>
                  </div>
                <?php
                  } ?>
                <?php $date = date('Y-m-d', strtotime($date . '+1 days')); ?>
              </div>
            </div>
          <?php }
          }

          ?>
          <?php if (check_auth_permission('rotating_schedule')) {  ?> 
          <div id="rotating_schedule_style_settings">
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="title-2">Generic Settings</div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Override Background</label>
                          <label class="switch ml-7">
                              <input type="checkbox" class="notificationswitch override_bg_enable busniess_hours_override_bg" name="busniess_hours_override_bg" data-slug="busniess_hours_bg_picker"
                                  <?php echo  $rotatingScheduleSettings->busniess_hours_override_bg ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                          </label>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group busniess_hours_bg_picker" style="display:<?php echo  $rotatingScheduleSettings->scheduling_override_bg ? 'checked' : '' ?>">
                      <label>Feature's Background color</label>
                      <input type="color" class="myinput2" name="busniess_hours_background" value="<?= $rotatingScheduleSettings->background ? $rotatingScheduleSettings->background : '#000000' ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Today - Text Color</label>
                      <input type="color" class="myinput2" name="today_color" value="<?= $daily_hours_today->color ? $daily_hours_today->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Today - Text size</label><br>
                      <input type="text" class="myinput2 width-50px" name="today_font_size" value="<?= $daily_hours_today->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Future Days - Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="non_today_font_size" value="<?= $daily_hours_future_day->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Today & Future Days - Font</label>
                      <select class="myinput2" name="today_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_today->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date Block - Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_date_font_size" value="<?= $daily_hours_day_block->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date Block - Text Color</label><br>
                      <input type="color" class="myinput2 width-50px" name="busniess_hours_date_color" value="<?= $daily_hours_day_block->color ? $daily_hours_day_block->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date Block - Background Color</label><br>
                      <input type="color" class="myinput2 width-50px" name="busniess_hours_date_bg_color" value="<?= $daily_hours_day_block->bg_color ? $daily_hours_day_block->bg_color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Date Block - Font</label>
                      <select class="myinput2" name="busniess_hours_date_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_day_block->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #1 Title</label>
                      <input type="text" class="myinput2" name="busniess_hours_hours_title" value="<?= $daily_hours_set_1->text ?>" placeholder="Hours">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #1 Title Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_hours_title_fontsize" value="<?= $daily_hours_set_1->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #1 Title Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_title_color" value="<?= $daily_hours_set_1->color ? $daily_hours_set_1->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Set #1 Title Font</label>
                      <select class="myinput2" name="busniess_hours_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_set_1->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #2 Title</label>
                      <input type="text" class="myinput2" name="busniess_hours_hours_title_2" value="<?= $daily_hours_set_2->text ?>" placeholder="Hours">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #2 Title Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_hours_title_2_fontsize" value="<?= $daily_hours_set_2->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Set #2 Title Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_title_2_color" value="<?= $daily_hours_set_2->color ? $daily_hours_set_2->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Set #2 Title Font</label>
                      <select class="myinput2" name="busniess_hours_title_2_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_set_2->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Start Title</label>
                      <input type="text" class="myinput2" name="busniess_hours_hours_start_title" value="<?= $daily_hours_start_title->text ?>" placeholder="Hours">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Start Title Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_hours_start_title_fontsize" value="<?= $daily_hours_start_title->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Start Title Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_start_title_color" value="<?= $daily_hours_start_title->color ? $daily_hours_start_title->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Start Title Font</label>
                      <select class="myinput2" name="busniess_hours_hours_start_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_start_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>End Title</label>
                      <input type="text" class="myinput2" name="busniess_hours_hours_end_title" value="<?= $daily_hours_end_title->text ?>" placeholder="Hours">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>End Title Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_hours_end_title_fontsize" value="<?= $daily_hours_end_title->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>End Title Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_end_title_color" value="<?= $daily_hours_end_title->color ? $daily_hours_end_title->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">End Title Font</label>
                      <select class="myinput2" name="busniess_hours_hours_end_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $daily_hours_end_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Start/End Sub-Title or Times Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_times_fontsize" value="<?= $busniess_hours_times->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Start/End Sub-Title or Times Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_times_color" value="<?= $busniess_hours_times->color ? $busniess_hours_times->color : '#000000' ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Start/End Sub-Title or Times Text Font</label>
                      <select class="myinput2" name="busniess_hours_times_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $busniess_hours_times->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Comments Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="busniess_hours_hours_comment_fontsize" value="<?= $busniess_hours_comments->size_web ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Comments Text Color</label>
                      <input type="color" class="myinput2" name="busniess_hours_hours_comment_color" value="<?= $busniess_hours_comments->color ? $busniess_hours_comments->color : '#000000' ?>">
                    </div>
                  </div>
                </div>
              
            <div class="row form-bottom make-sticky z-index-11">
              <div class="col-md-12">
                <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save Generic Settings</button>
                <button type="submit" name="savedailyhours" class="btn btn-primary" value="savereminders">Save Generic Settings & send reminder</button>
              </div>
            </div>
            </div>
            </div>
          </div>
          <div id="rotating_schedule_bottom"></div>
          <?php  }  ?>
          <div class="row form-bottom make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savedailyhours" class="btn btn-primary" value="save">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  
<script>

<?php 
  
  if(isset($block) && $block !=""){
    ?>
  
  var id = "<?=$block?>";
      
      
        
          $('#'+id).closest('.content').find('.editcontent').show('slow');
          $('#'+id).closest('.content').find('.form-bottom').addClass('make-sticky');
          var section_start = $('#'+id).data('top');
          var section_end = $('#'+id).data('bottom');
          
          setTimeout(() => {
            $('html, body').animate({
          scrollTop: $('#' + id).offset().top - 60
        }, 100);
          }, 1000);
        
      
        $('#' + id).stop(true, true).addClass("locator-bg");
        setTimeout(() => {
          $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
        }, 5000);
          var tip_section = $('#'+id).data('tip_section');
         
          if (typeof(tip_section) != 'undefined') {
            openTip(tip_section);
          }
          <?php
    }
  ?>
  $(document).ready(function() {
    checkSeeTips(sub_sections);

    var is_disabled = isTipsDisabled('business_hours');
   
   if(is_disabled){
     $("input[name='tippopups']").prop('checked',true);
     $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
                $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
   }
 });

 <?php 
 if($rotatingScheduleSettings->apply_all_days && $rotatingScheduleSettings->apply_all_days !=""){
 ?>
  $(".day-image").html("Upload image to override Master Image");
 <?php 
 }
 ?>
 $(document).on("click", ".master_image_toggle", function() {
   
   
   if($("input[name='is_master_image_on']").prop('checked') == true){
     $(".day-image").html("Upload image to override Master Image");
   }else{
     $(".day-image").html("Upload image");      
   }
 });

 $(document).on('change',".repeat_hours",function(){
  var thisval = $(this).val();
  var repeat='NO';
  if($(this).prop('checked') == true){
    repeat = 'YES';
  }

  $.ajax({
    url: "<?php echo url('save_repeating_hours');?>",
    type: "POST",
    data: {
        id: $(this).prop('id'),
        day: thisval,
        is_repeat:repeat,
        '_token': $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(data) {
      window.location.reload();
    }
  });
      
 })

 $(document).on("click", ".remindertype_set_hour", function() {
   var thisval = $(this).val();
   if (thisval == '1') {
     $(".datetimediv_set_hour").hide();
     $(".timeinmin_set_hour").show();
   } else {
     $(".datetimediv_set_hour").show();
     $(".timeinmin_set_hour").hide();
   }
 });

$(document).on('keyup', 'input[name="max_width"], input[name="max_height"]', function(e) {
  var max = parseInt($(this).attr('max'));
    var min = parseInt($(this).attr('min'));
    if ($(this).val() > max) {
        $(this).val(max);
    }
    else if ($(this).val() < min) {
        $(this).val(min);
    }  
});

</script>
@endsection('content')