@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ADD {{ $controller_name }}</h1>
    <a href="{{ url('quicksettings?block=news_posts_bluebar') }}" class="btn btn-info ">
      Back
    </a>
  </div>
  <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('createnewspost') }}">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>News Post Title</label>
            <input type="text" class="myinput2" name="post_title" value="<?php echo old('post_title'); ?>" placeholder="">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>News Post Title Text Color</label>
            <input type="color" class="myinput2" name="post_title_color" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?php echo old('post_title_color'); ?>" placeholder="#000000">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>News Post Title Text Size</label><br>
            <input type="text" class="myinput2 width-50px" name="post_title_size" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?php echo old('post_title_size'); ?>" placeholder="18">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="title_font_size">News Post Title Text Font</label>
            <select class="myinput2" name="font_family" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
              <?php if (count($font_family) > 0) { ?>
                <?php foreach ($font_family as $single) { ?>
                  <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Post Description Text Color</label>
            <input type="color" class="myinput2" name="post_desc_color" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?php echo old('post_desc_color'); ?>" placeholder="#000000">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Post Description Text Size</label><br>
            <input type="text" class="myinput2 width-50px" name="post_desc_font_size" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?php echo old('post_desc_font_size'); ?>" placeholder="16">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="title_font_size">Post Description Text Font</label>
            <select class="myinput2" name="desc_font_family" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
              <?php if (count($font_family) > 0) { ?>
                <?php foreach ($font_family as $single) { ?>
                  <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Description Read More Text Color</label>
            <input type="color" class="myinput2" name="read_more_content_color" 
            <?php if($is_generic_setting_on){?> disabled <?php } ?>
            value="<?= $single->read_more_content_color ?>" placeholder="">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Description Read More Text Size</label><br>
            <input type="text" class="myinput2 width-50px" name="read_more_content_font_size"  
            <?php if($is_generic_setting_on){?> disabled <?php } ?>
            value="<?= $single->read_more_content_font_size ?>" placeholder="">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="title_font_size">Description Read More Font</label>
            <select class="myinput2" name="read_more_content_font_font_family"
            <?php if($is_generic_setting_on){?> disabled <?php } ?>
            >
              <?php if (count($font_family) > 0) { ?>
                <?php foreach ($font_family as $singleff) { ?>
                  <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($single->read_more_content_font_font_family) && ($single->read_more_content_font_font_family == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="desc_div">
        <div class="row desc_content">
          <div class="col-md-12">
            <div class="form-group quilleditor-div">
              <label>Post Description Text</label>
              <textarea class="myinput2 editordata hidden" name="post_desc"><?php echo old('post_desc'); ?></textarea>
              <div class="quilleditor">
                <?php echo old('post_desc'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex mt-2">
            <div>
              <button type="button" class="btn btn-primary  show_read_more_block">Add Read More text block</button>
            </div>
            <div class="ml-2">
              <label>
                Reduce unwanted text, visitor can select the <br> text they wish to read by clicking on <u>Read More</u>.
              </label>
            </div>
          </div>
        </div>

      </div>
      <div class="read_more_content">
        <div class="row ">
          <div class="col-md-4">
            <div class="form-group">
              <label>Input text for a Read More option</label>
              <input type="text" class="myinput2" name="read_more_text" placeholder="Read More" value="<?= old('read_more_text') ? old('read_more_text') : 'Read more' ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group quilleditor-div">
              <label>Post Description Text</label>
              <textarea class="myinput2 editordata hidden" name="read_more_desc"><?php echo old('read_more_desc'); ?></textarea>
              <div class="quilleditor">
                <?php echo old('read_more_desc'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Input text for a Read Less option</label>
              <input type="text" class="myinput2" name="read_less_text" placeholder="Read Less" value="<?= old('read_less_text') ? old('read_less_text') : 'Read less' ?>">
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row" style="margin-bottom: 15px;">
        <div class="col-md-12">
          <div class="uploadImageDiv">
            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
            <input class="dataimage" type="hidden" name="userfile">

            <div class="col-md-6 imgdiv" style="display:none">
              <br>
              <img src='' width="100%" class="imagefromgallerysrc">
              <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
            </div>
          </div>
        </div>
      </div>
      <div class="content2">
        <div class="row">
          <div class="col-md-12">
            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
              <div class="d-flex align-items-center">
                <div class="title-2">Action Button Settings</div>
              </div>
              <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
            </div>
          </div>
        </div>
        <div class="editcontent2 ">
          <div class="action_button_container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="bannertext">Action button active</label><br>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch" name="action_button_active" checked>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="action_button_discription">Action Button Name</label>
                  <input type="text" class="myinput2" name="action_button_discription" id="action_button_discription" value="Find Out More" placeholder="Type here...">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="action_button_discription_color">Action Button Text Color</label>
                  <input type="color" class="myinput2" name="action_button_discription_color" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="action_button_bg_color">Action Button Color</label>
                  <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="#000000" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="action_button_link">Action Button Application</label>
                  <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="action_button_link">
                    <option value="link">Link</option>
                    <option value="call">Call</option>
                    <option value="sms">SMS</option>
                    <option value="email">Email</option>
                    <option value="video">Video</option>
                    <option value="audioiconfeature">Audio Icon Feature</option>
                    <option value="image_popup">Image Popup</option>
                    <option value="address">Address</option>
                    <option value="stripe">Stripe</option>
                    <option value="google_map">Map</option>
                    <option value="text_popup">Text Popup</option>
                    <option value="customforms">Forms</option>
                    <?php foreach ($front_sections as $single) { ?>
                      <option value="<?= $single->slug ?>"><?= $single->name ?></option>
                    <?php } ?>
                    <option value="eventForms">Event Forms</option>
                  </select>
                </div>


                <div class="form-group action_fields phone_no_calls" style="display:none;">
                  <label for="">Phone number for calls</label>
                  <input type="text" class="myinput2" name="action_button_phone_no_calls" value="">
                </div>
                <div class="form-group action_fields image_upload" style="display:none;" name="feature_action_video2">
                  <label for="customFile">Upload Images</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                      <label class="custom-file-label" for="customFile">Choose files</label>
                  </div>
                  </div>
                <div class="form-group action_fields phone_no_sms" style="display:none;">
                  <label for="">Phone number for sms</label>
                  <input type="text" class="myinput2" name="action_button_phone_no_sms" value="">
                </div>
                <div class="form-group action_fields action_email" style="display:none;">
                  <label for="">Email</label>
                  <input type="text" class="myinput2" name="action_button_action_email" value="">
                </div>
                <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature"  style="display:none">
                    <label for="customFile">Select File</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                            accept=".mp3">
                        <label class="custom-file-label" for="customFile">Select File</label>
                    </div>
                    
                </div>
                <div class="form-group action_fields action_link" style="display:block;">
                  <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                </div>
                <div class="form-group action_fields video_upload" name="action_button_video"  style="display:none">
                    <label for="customFile">Upload Video</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                            accept=".mp4">
                        <label class="custom-file-label" for="customFile">Upload Video</label>
                    </div>
                </div>
                <div class="form-group action_fields action_forms" style="display:none;">
                  <select class="myinput2 customforms" name="action_button_customform">
                    <?php if (count($custom_forms) > 0) { ?>
                      <?php foreach ($custom_forms as $single) { ?>
                        <option value="<?= $single->id ?>"><?= $single->title ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group action_fields action_event_forms" style="display:none;">
                  <select class="myinput2 customforms" name="action_button_eventform">
                    <?php if (count($event_forms) > 0) { ?>
                      <?php foreach ($event_forms as $single) { ?>
                        <option value="<?= $single->id ?>"><?= $single->title ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class=" action_fields action_map" style="display:none">
                  <div class="form-group ">
                    <label for="address">Enter Address</label>
                    <input type="text" class="myinput2 " name="action_button_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                  </div>
                </div>
                <div class="form-group action_fields action_address" style="display:none;">
                  <label for="addressbtn1">Select an Address</label>
                  <select name="action_button_address_id" class="myinput2">
                    <?php foreach ($addresses as $address) { ?>
                      <option value="<?= $address->id ?>"><?= $address->address_title ?></option>
                    <?php } ?>
                  </select>
                </div>

              </div>
              <div class="col-md-12 d-flex justify-content-end">
                  <div class="col-md-6 col-sm-12 p-0">
                    <div class="form-group">
                      <div class="form-group quilleditor-div action_fields  action_textpopup"  style="display:none">
                    <label>Popup Text </label>
                    <textarea class="myinput2 editordata hidden" name="action_button_textpopup"></textarea>
                    <div class="quilleditor"></div>
                </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn d-none btn-primary add_action_button" >Add Action Button</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Timed Image Settings -->
      <div class="content2">
        <div class="row">
          <div class="col-md-12">
            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
              <div class="d-flex align-items-center titlediv d-flex">
                <div class="title-2">Timed Image Settings</div>
                <div class="form-group  ml-3 switchoverhead2">
                  <label class="switch m-0">
                    <input type="checkbox" class="notificationswitch timeimagesswitch" name="enable_timed_image">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
            </div>

          </div>
        </div>
        <div class="editcontent2">
          <div class="row">
            <div class="col-md-6">
              <div class="row nopadding datetimediv_popup">
                <div class="col-md-6 nopadding">
                  <div class="form-group">
                    <label for="image_type">Type</label>
                    <select name="image_type" class="myinput2 timed_image_type" id="image_type">
                      <option value="days">By Days</option>
                      <option value="timer">Timer</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 nopadding">
                  <div class="timed_type_divs timer_div" style="display:none;">
                    <div class="form-group">
                      <label for="image_timer">Timer</label>
                      <select name="image_timer" class="myinput2" id="image_timer">
                        <option value="15">15 min</option>
                        <option value="30">30 min</option>
                        <option value="60">1 hour</option>
                        <option value="120">2 hour</option>
                        <option value="240">4 hour</option>
                        <option value="360">6 hour</option>
                        <option value="480">8 hour</option>
                        <option value="720">12 hour</option>
                        <option value="1440">24 hour</option>
                        <option value="2880">48 hour</option>
                      </select>
                    </div>
                  </div>
                  <div class="timed_type_divs days_div">
                    <div class="form-group">
                      <label for="end_time">End Time</label>
                      <input type="time" name="image_end_time" class="myinput2" id="end_time" value="">
                    </div>
                    <div class="form-group">
                      <label for="start_time">Start Time</label>
                      <input type="time" name="image_start_time" class="myinput2" id="start_time" value="">
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Select Days</label>
                <select class="myinput2 multiselectlist" name="days[]" multiple>
                  <option value="mon">Monday</option>
                  <option value="tue">Tuesday</option>
                  <option value="wed">Wednesday</option>
                  <option value="thu">Thursday</option>
                  <option value="fri">Friday</option>
                  <option value="sat">Saturday</option>
                  <option value="sun">Sunday</option>
                </select>
              </div>
              <br>
              <div class="uploadImageDiv">
                <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                <input class="dataimage" type="hidden" name="timed_image">

                <div class="col-md-6 imgdiv" style="display:none">
                  <br>
                  <img src='' width="100%" class="imagefromgallerysrc">
                  <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row make-sticky">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="<?= base_url('quicksettings?block=news_posts_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
        </div>
      </div>



    </div>
  </form>
</div>


<script>
  $(".read_more_content").hide();
  $(document).on('click', '.show_read_more_block', function() {
    $(".read_more_content").toggle();
  });
  
  // function check_selction(value){

  //   if(value =="address" || value == "google_map"){

  //     $("#address-list-"+id).show();
  //     $("#news_post_link").hide();
  //     $("#btncustomforms").hide();

  //   }else if(value == "link"){

  //     $("#news_post_link").show();
  //     $("#address-list-"+id).hide();
  //     $("#btncustomforms").hide();

  //   }else if(value == "customforms"){

  //     $("#btncustomforms").show();
  //     $("#news_post_link").hide();
  //     $("#address-list-"+id).hide();

  //   }else{

  //     $("#news_post_link").hide();
  //     $("#address-list-"+id).hide();
  //     $("#btncustomforms").hide();
  //     $("#address-list-"+id).val('');
  //   }
  // }
</script>
@endsection('content')