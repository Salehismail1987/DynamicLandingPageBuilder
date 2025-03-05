@extends('admin.layout.dashboard')
@section('content')

<script>
  var sub_sections = ["step-buttons"];
</script>

<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>


<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2"><?= $controller_name ?></div>
      <div class="col-md-7 col-lg-5">
      <div class="row d-flex justify-content-around">
        <div class="col-4 title-2 mb-1" style="text-align: center;">Popup Alert</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Tip Popups</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Notifications</div>
    </div>
      <div class="row d-flex justify-content-around">
      <label class="myswitchdiv popupTool">
            <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
          </label>
          <label class="myswitchdiv">
            <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',subsections)">
            <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
          </label>
          <label class="myswitchdiv switch_disabled">
            <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
          </label>
      </div>
      <div class="row d-flex justify-content-around"> 
        <div class="col-4 col-sm-4 title-2 mb-1 popupOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1 tipOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Controls in Settings</div>
      </div>
    </div>
    </div>
  </div>

  <div class="text-center" id="indicator" style="display: <?= $indicator ? 'block' : 'none' ?>;">
    <div class="oneStepIndecator">A 1-Step Button is currently active</div>
  </div>
  <?php
  if (count($categories) > 0) {

    $extra_times = array(
      '120' => '2h',
      '240' => '4h',
      '360' => '6h',
      '480' => '8h',
      '1440' => '24h',
      '2880' => '48h',
    );
    $i = 0;
    $active = 'active';
    foreach ($categories as $category) {
  ?>
      <div class="contentdiv step-category <?= $active ?>" href="#category<?= str_replace(' ', '', $category->category) ?>">
        <div class="btnedit openEditContent" id="">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue "><?= $category->category ?></div>
            </div>
            <div class="d-flex  align-items-center">
              <div class=" ml-20">
                <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
              </div>
            </div>
          </div>
        </div>
        <div class="editcontent mb-13" style="<?= isset($_GET['block']) && $_GET['block'] == str_replace(' ', '', $category->category) ? 'display:block;' : '' ?>">

          <!-- (Hassan) Adding note for instruction (Begin) -->
          <div class="col-12 p-0">
            <div class="mb-10 step-btn-alert">
              Selecting Active buttons will Deactivate it
            </div>
          </div>
          <!-- Adding note for instruction (Begin) -->

          <div class="<?= !$i++ ? 'active' : '' ?> <?= 'category' . str_replace(' ', '', $category->category) ?>" id="<?= 'category' . str_replace(' ', '', $category->category) ?>" role="tabpanel">
            <?php foreach ($one_step_images as $step) {
              if ($step->category == $category->category) {  ?>
                <style>
                  .btn-custom-color<?= $step->id ?> {
                    background-color: <?= $step->default_button_color ?> !important;
                    color: <?= $step->default_button_text_color ?> !important;
                  }
                </style>

                <!-- (Hassan) Change the layout to make it responsive (Begin) -->
                <div class="d-lg-flex d-md-block justify-content-between flex-wrap step-container-<?= $step->id ?>" data-id="<?= $step->id ?>" data-name="<?= $step->name ?>">

                  <div class="w-100 mb-10 text-left">
                    <?php if (!empty($step->conditions)) { ?>
                      <div class="onestepcondition" style="border: 1px solid <?= $step->conditions_color ?>;color:<?= $step->conditions_color ?>;"><?= nl2br($step->conditions) ?></div>
                    <?php } ?>
                  </div>
                  {{-- <div class="col">
                      <div class="d-flex">
                        <div class="form-group pb-3">
                          <label for="bannertext">Send Notification</label><br>
                          <label class="switch">
                            <input type="checkbox" class="sendnotification" name="sendnotification" data-step_id="<?= $step->id ?>" <?= $step->notification_status == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div> 
                      </div>
                    </div> --}}
                  <div class="col">
                    <p class="nopadd">Default Image</p>
                    <button data-duration="0" data-category="<?= $step->category ?>" data-text_enabled="<?= $step->text_enabled ?>" data-custom='0' data-step_id="<?= $step->id ?>" data-step_name="<?= $step->name ?>" class="btn action-btn mb-10 <?= ($step->status && !$step->active_time) ? 'btn-active' : 'btn-custom-color' . $step->id ?>"><?= ($step->status && !$step->active_time) ? 'ACTIVE' : $step->name ?></button>
                    <p class="nopadd"><?= $step->first_image_location ?></p>
                  </div>
                  <div class="col">
                    <p class="nopadd">Timed <?= $step->first_duration > 60 ? $step->first_duration / 20 . " Hours" : $step->first_duration . " Minutes" ?></p>
                    <?php if ($step->status == '1') { ?>
                      <p>
                        <?php

                        $start_time = date('Y-m-d H:i:s', strtotime($step->start_time));

                        $timezone = getFrontDataTimeZone();
                        $start_time = new DateTime($start_time);
                        $minutesToAdd = 5;
                        $start_time->modify("+{$step->active_time} minutes");

                        $dt = new DateTime(date('Y-m-d H:i:s'));
                        $dt->setTimestamp(time());
                        $dt->modify("-7 hour");
                        $interval = $start_time->diff($dt);
                        if ($start_time > $dt) {
                          if ($interval->format('%h') > 0) {
                            echo $interval->format('%h') . " Hours ";
                          }
                          if ($interval->format('%i') > 0) {
                            echo $interval->format('%i') . " Minutes Remaining";
                          }
                        }
                        ?>
                      </p>
                    <?php } ?>
                    <button data-duration="<?= $step->first_duration ?>" data-category="<?= $step->category ?>" data-text_enabled="<?= $step->text_enabled ?>" data-custom='0' data-step_id="<?= $step->id ?>" data-step_name="<?= $step->name ?>" class="btn action-btn mb-10 <?= ($step->status && $step->active_time == $step->first_duration) ? 'btn-active' : 'btn-custom-color' . $step->id ?>"><?= ($step->status && $step->active_time == $step->first_duration) ? 'ACTIVE' : $step->name ?></button>
                    <p class="nopadd"><?= $step->first_image_location ?></p>
                  </div>
                  <div class="col">
                    <p class="nopadd">Timed <?= $step->second_duration > 60 ? $step->second_duration / 20 . " Hours" : $step->second_duration . " Minutes" ?></p>
                    <button data-duration="<?= $step->second_duration ?>" data-category="<?= $step->category ?>" data-text_enabled="<?= $step->text_enabled ?>" data-custom='0' data-step_id="<?= $step->id ?>" data-step_name="<?= $step->name ?>" class="btn action-btn mb-10 <?= ($step->status && $step->active_time == $step->second_duration) ? 'btn-active' : 'btn-custom-color' . $step->id ?>"><?= ($step->status && $step->active_time == $step->second_duration) ? 'ACTIVE' : $step->name ?></button>
                  </div>
                  <div class="col custom-column">
                    <p class="nopadd">Custom Time</p>
                    <button data-duration="0" data-category="<?= $step->category ?>" data-text_enabled="<?= $step->text_enabled ?>" data-custom='1' data-step_id="<?= $step->id ?>" data-step_name="<?= $step->name ?>" class="btn action-btn <?= ($step->status && $step->active_time && $step->active_time != $step->first_duration && $step->active_time != $step->second_duration) ? 'btn-active' : 'btn-custom-color' . $step->id ?>"><?= ($step->status && $step->active_time && $step->active_time != $step->first_duration && $step->active_time != $step->second_duration) ? 'ACTIVE' : $step->name ?></button>
                    <div class="hidden-items mt-2" style="display: none;">
                      <select class="myinput2 custom_time" data-category="<?= $step->category ?>" data-text_enabled="<?= $step->text_enabled ?>" data-step_id="<?= $step->id ?>" data-step_name="<?= $step->name ?>" name="custom_time">
                        <option value="">Select Time</option>
                        <?php
                        for ($duration = 5; $duration <= 60; $duration += 5) {
                        ?>
                          <option value="<?= $duration ?>"><?= $duration ?></option>
                        <?php
                        }
                        foreach ($extra_times as $min => $hour) {
                        ?>
                          <option value="<?= $min ?>"><?= $hour ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <span class="text-danger duration-error" style="display: none;">Please provide valid duration.</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <?php
                  if ($step->text_enabled) {
                    $one_step_button_first_text = get_text_details('one_step_button_first_text_' . $step->id);
                    $one_step_button_second_text = get_text_details('one_step_button_second_text_' . $step->id);

                    $one_step_button_first_image = get_image_by_id($step->first_image_id);

                    $one_step_button_second_image = get_image_by_id($step->second_image_id);

                  ?>
                    <div class="col-12">
                      <hr class="nopadd" style="border-top: 3px dashed rgba(0,0,0,.1);width:90%;">
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <label>Enter text for Image A</label>
                      <input type="text" class="myinput2" id="first_image_text<?= $step->id ?>" placeholder="Text for Image A" value="<?= $one_step_button_first_text->text ?>">
                    </div>
                    <div class="col-md-2 col-xs-12">
                      @if($one_step_button_first_image)
                      <img class="lazyload" src="<?= url('assets/uploads/') . get_current_url() . '/' . $one_step_button_first_image->file_name ?>" width="<?= ($one_step_button_first_image->max_width) ? $one_step_button_first_image->max_width . 'px' : '100%' ?>" style="max-width: <?= ($one_step_button_first_image->max_width) ? $one_step_button_first_image->max_width . 'px' : '100%' ?>;" alt="<?= $one_step_button_first_text->text ?>">
                      @endif
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <label>Enter text for Image B</label>
                      <input type="text" class="myinput2" id="second_image_text<?= $step->id ?>" placeholder="Text for Image B" value="<?= $one_step_button_second_text->text ?>">
                    </div>
                    <div class="col-md-2 col-xs-12">
                      @if($one_step_button_second_image)
                      <img class="lazyload" src="<?= url('assets/uploads/') . get_current_url() . '/' . $one_step_button_second_image->file_name ?>" width="<?= ($one_step_button_second_image->max_width) ? $one_step_button_second_image->max_width . 'px' : '100%' ?>" style="max-width: <?= ($one_step_button_second_image->max_width) ? $one_step_button_second_image->max_width . 'px' : '100%' ?>;" alt="<?= $one_step_button_first_text->text ?>">
                      @endif
                    </div>
                  <?php
                  }
                  ?>
                </div>
                <!-- Change the layout to make it responsive (End) -->

                <hr class="nopadd" style="border-top: 5px solid rgba(0,0,0,.1)">
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php $active = '';
    } ?>
  <?php
  } else {
  ?>
    <h3>No 1-Step Buttons configured</h3>
  <?php
  }
  ?>
  <!-- End Tabs on plain Card -->
  <div class="row make-sticky">
    <div class="col-md-12">
      <form action="{{ url('deactivateall') }}" method="POST">
        @csrf
        <input type="submit" class="btn action-btn btn-primary deactivate-all" name="deactivate-all" value="Deactivate All" />
      </form>
    </div>
  </div>
  <script>
    <?php

    if (isset($block) && $block != "") {
    ?>

      var id = "<?= $block ?>";



      $('#' + id).closest('.content').find('.editcontent').show('slow');
      $('#' + id).closest('.content').find('.form-bottom').addClass('make-sticky');
      var section_start = $('#' + id).data('top');
      var section_end = $('#' + id).data('bottom');

      setTimeout(() => {
        $('html, body').animate({
          scrollTop: $('#' + id).offset().top - 60
        }, 100);
      }, 1000);


      $('#' + id).stop(true, true).addClass("locator-bg");
      setTimeout(() => {
        $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
      }, 5000);
      var tip_section = $('#' + id).data('tip_section');

      if (typeof(tip_section) != 'undefined') {
        openTip(tip_section);
      }
    <?php
    }
    ?>

    function checkIndicator() {
      var selected_category = $('.step-category.active').attr('href').replace('#', '');
      if ($('.' + selected_category).find('.btn-active').length) {
        $('#indicator').show();
      } else {
        $('#indicator').hide();
      }
    }
    $(document).ready(function() {
      var is_disabled = isTipsDisabled('onestep_images');

      if (is_disabled) {
        $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
        $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
        $("input[name='tippopups']").prop('checked', true);
      }
      checkSeeTips(sub_sections);
      popupStatus();
      activityWatcher();
      checkIndicator();
      openTip('step-buttons');

      $('.step-category').on('click', function() {
        var selected_category = $(this).attr('href').replace('#', '');
        if ($('.' + selected_category).find('.btn-active').length) {
          $('#indicator').show();
        } else {
          $('#indicator').hide();
        }
      });





      // $('.sendnotification').on('change', function() {
      //   var step_id = $(this).data('step_id');
      //   var flag = '0';
      //   if($(this).prop('checked')==true){ 
      //     flag = '1';
      //   }
      //     $.ajax({
      //       url: '<?= base_url('updatenotificationstatus'); ?>',
      //       type: "POST",
      //       dataType: 'JSON',
      //       data: {
      //         'step_id': step_id,
      //         'flag': flag,
      //         _token: "{{ csrf_token() }}"
      //       },
      //       success: function(data) {

      //       },
      //       complete: function() {

      //       }
      //     });
      // });

      $('.action-btn').on('click', function() {
        var step_id = $(this).data('step_id');
        var text_enabled = $(this).data('text_enabled');
        if (text_enabled) {
          var first_image_text = $('#first_image_text' + step_id).val();
          var second_image_text = $('#second_image_text' + step_id).val();
        } else {
          var first_image_text = '';
          var second_image_text = '';
        }
        var first_image_text = $('#first_image_text' + step_id).val();
        var second_image_text = $('#second_image_text' + step_id).val();
        var step_name = $(this).data('step_name');
        var duration = $(this).data('duration');
        var custom = $(this).data('custom');
        var category = $(this).data('category');
        var min_category = category.replace(/\s+/g, '-').toLowerCase();
        var elem = this;

        if (custom) {
          $(this).parent().find('.hidden-items').show();
        } else {
          $('.loadingdiv').show();
          $.ajax({
            url: '<?= base_url('managesteps'); ?>',
            type: "POST",
            dataType: 'JSON',
            data: {
              'step_id': step_id,
              'first_image_text': first_image_text,
              'second_image_text': second_image_text,
              'duration': duration,
              'category': category,
              _token: "{{ csrf_token() }}"
            },
            success: function(data) {
              console.log(data);
              $('.step-container-' + step_id).find('.action-btn').removeClass('btn-active').addClass('btn-custom-color' + step_id).text(step_name);
              $('.step-category-' + min_category).each(function(i, obj) {
                let step_div_id = $(obj).data('id');
                let step_div_name = $(obj).data('name');
                $('.step-container-' + step_div_id).find('.action-btn').removeClass('btn-active').addClass('btn-custom-color' + step_div_id).text(step_div_name);
              });
              if (data.flag) {
                $(elem).removeClass('btn-custom-color' + step_id).addClass('btn-active').text('ACTIVE');
                Swal.fire({
                  icon: 'success',
                  title: 'Changes Implemented',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  window.open('<?= base_url(); ?>', '_blank');
                })
              }
              if (data.show_indicator) {
                $('#indicator').show();
              } else {
                $('#indicator').hide();
              }
              checkIndicator();
            },
            complete: function() {
              $('.loadingdiv').hide();
            }
          });
        }
      });

      $('.custom_time').on('change', function() {
        $('.duration-error').hide();
        var step_id = $(this).data('step_id');
        var text_enabled = $(this).data('text_enabled');
        if (text_enabled) {
          var first_image_text = $('#first_image_text' + step_id).val();
          var second_image_text = $('#second_image_text' + step_id).val();
        } else {
          var first_image_text = '';
          var second_image_text = '';
        }
        var step_name = $(this).data('step_name');
        var duration = $(this).val();
        var category = $(this).data('category');
        var min_category = category.replace(/\s+/g, '-').toLowerCase();
        var elem = this;
        // return;
        if (duration == '' || typeof(duration) == 'undefined') {
          $('.duration-error').show();
        } else {
          // return;
          $('.loadingdiv').show();
          $.ajax({
            url: '<?= base_url('admin/OneStepImages/manage_steps'); ?>',
            type: "POST",
            dataType: 'JSON',
            data: {
              'step_id': step_id,
              'first_image_text': first_image_text,
              'second_image_text': second_image_text,
              'duration': duration,
              'category': category,
              _token: "{{ csrf_token() }}"
            },
            success: function(data) {
              $(elem).closest('.hidden-items').hide();
              $('.step-container-' + step_id).find('.action-btn').removeClass('btn-active').addClass('btn-custom-color' + step_id).text(step_name);
              $('.step-category-' + min_category).each(function(i, obj) {
                let step_div_id = $(obj).data('id');
                let step_div_name = $(obj).data('name');
                $('.step-container-' + step_div_id).find('.action-btn').removeClass('btn-active').addClass('btn-custom-color' + step_div_id).text(step_div_name);
              });
              if (data.flag) {
                $(elem)
                  .closest(".custom-column")
                  .find(".action-btn")
                  .removeClass('btn-custom-color' + step_id)
                  .addClass('btn-active').text('ACTIVE');
                Swal.fire({
                  icon: 'success',
                  title: 'Changes Implemented',
                  showConfirmButton: false,
                  timer: 1500
                }).then((result) => {
                  window.open('<?= base_url(); ?>', '_blank');
                })
              }
              $(elem).val('');
              if (data.show_indicator) {
                $('#indicator').show();
              } else {
                $('#indicator').hide();
              }
              checkIndicator();
            },
            complete: function() {
              $('.loadingdiv').hide();
            }
          });
        }
      })
    });

    function activityWatcher() {
      var secondsSinceLastActivity = 0;
      var maxInactivity = (60 * 1);
      setInterval(function() {
        secondsSinceLastActivity++;
        if (secondsSinceLastActivity > maxInactivity) {
          window.location.reload(true);
        }
      }, 1000);

      function activity() {
        secondsSinceLastActivity = 0;
      }
      var activityEvents = [
        'mousedown', 'mousemove', 'keydown',
        'scroll', 'touchstart'
      ];
      activityEvents.forEach(function(eventName) {
        document.addEventListener(eventName, activity, true);
      });


    }
  </script>
  @endsection('content')