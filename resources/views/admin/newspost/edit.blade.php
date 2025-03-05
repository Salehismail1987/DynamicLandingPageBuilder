@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('quicksettings?block=news_posts_bluebar') }}" class="btn btn-info ">
          Back
        </a>
      </li>
    </ol>
  </div>
  <form class="data-form" id="editNewsForms" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updatenewspost/' . $detail_info->id) ?>">
    @csrf
    <div class="row">
      <div class="col-lg-8">
        <div class="card-body">
          <?php if ($news_posts && count($news_posts) > 0) {
            $count = 1;
            foreach ($news_posts as $single) {
              $check = $count < 4 ? true : false;
              if ($check && $single->id == $detail_info->id && check_step_image('News Post Image ' . $count)) {
          ?>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow 1-Step Button to Expire</h5>
                  </div>
                </div>
          <?php
              }
              $count++;
            }
          }
          ?>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>News Post Title</label>
                <input type="text" class="myinput2" name="post_title" value="<?php echo $detail_info->post_title; ?>" placeholder="Header text">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="bannertext">Show Post's Date Stamp?</label><br>
                <label class="switch">
                  <input type="checkbox" class="notificationswitch" name="show_date" <?= $detail_info->show_date ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>News Post Title Text Color</label>
                <input type="color" class="myinput2" name="post_title_color" value="<?php echo $detail_info->post_title_color; ?>" placeholder="#000000" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>News Post Title Text Size</label><br>
                <input type="text" class="myinput2 width-50px" name="post_title_size" value="<?php echo $detail_info->post_title_size; ?>" placeholder="18" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>

              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">News Post Title Text Font</label>
                <select class="myinput2" name="font_family" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
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
                <input type="color" class="myinput2" name="post_desc_color" value="<?php echo $detail_info->post_desc_color; ?>" placeholder="#000000" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Post Description Text Size</label><br>
                <input type="text" class="myinput2 width-50px" name="post_desc_font_size" value="<?php echo $detail_info->post_desc_font_size; ?>" placeholder="16" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">Post Description Text Font</label>
                <select class="myinput2" name="desc_font_family" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->desc_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
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
                <input type="color" class="myinput2" name="read_more_content_color" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?= $detail_info->read_more_content_color ?>" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Description Read More Text Size</label><br>
                <input type="text" class="myinput2 width-50px" name="read_more_content_font_size" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?> value="<?= $detail_info->read_more_content_font_size ?>" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">Description Read More Font</label>
                <select class="myinput2" name="read_more_content_font_font_family" <?php if ($is_generic_setting_on) { ?> disabled <?php } ?>>
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $singleff) { ?>
                      <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($detail_info->read_more_content_font_font_family) && ($detail_info->read_more_content_font_font_family == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
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
                  <textarea class="myinput2 editordata hidden" name="post_desc"><?php $detail_info->post_desc; ?></textarea>
                  <div class="quilleditor">
                    <?php echo $detail_info->post_desc; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- <?php if (!empty($detail_info->post_desc_1)) { ?>
              <div class="row desc_content">
                <div class="col-10"> 
                  <div class="form-group">
                    <label>Post Description Text</label>
                    <textarea class="myinput2" name="post_descs[]"><?= $detail_info->post_desc_1 ?></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <br><br>
                  <button type="button" class="btn btn-primary remove_desc">X</button>
                </div>
              </div>
            <?php } ?>
            <?php if (!empty($detail_info->post_desc_2)) { ?>
              <div class="row desc_content">
                <div class="col-10"> 
                  <div class="form-group">
                    <label>Post Description Text</label>
                    <textarea class="myinput2" name="post_descs[]"><?= $detail_info->post_desc_2 ?></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <br><br>
                  <button type="button" class="btn btn-primary remove_desc">X</button>
                </div>
              </div>
            <?php } ?>
            <?php if (!empty($detail_info->post_desc_3)) { ?>
              <div class="row desc_content">
                <div class="col-10"> 
                  <div class="form-group">
                    <label>Post Description Text</label>
                    <textarea class="myinput2" name="post_descs[]"><?= $detail_info->post_desc_3 ?></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <br><br>
                  <button type="button" class="btn btn-primary remove_desc">X</button>
                </div>
              </div>
            <?php } ?> -->
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
                  <input type="text" class="myinput2" name="read_more_text" placeholder="Read More" value="<?= $detail_info->read_more_text ? $detail_info->read_more_text : 'Read more' ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group quilleditor-div">
                  <label>Post Description Text</label>
                  <textarea class="myinput2 editordata hidden" name="read_more_desc"><?php echo $detail_info->read_more_desc; ?></textarea>
                  <div class="quilleditor">
                    <?php echo $detail_info->read_more_desc; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Input text for a Read Less option</label>
                  <input type="text" class="myinput2" name="read_less_text" placeholder="Read Less" value="<?= $detail_info->read_less_text ? $detail_info->read_less_text : 'Read less' ?>">
                </div>
              </div>
            </div>
          </div>
          <br>
          <div id="news_post_image_upload">
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
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Action button active</label><br>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch" name="action_button_active" <?= $detail_info->action_button_active ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <!-- <div class="row mt-2 mb-2">
                <div class="col-md-12">
                        <button type="button" id="add-action-button" class="btn btn-primary">Add New Action Button</button>
                </div>
              </div> -->
              <div class="row" id="replicate-action-button">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="action_button_discription">Action Button Name</label>
                    <input type="text" class="myinput2" name="action_button_discription" id="action_button_discription" value="<?= $detail_info->action_button_discription ?>" placeholder="Type here...">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="action_button_discription_color">Action Button Text Color</label>
                    <input type="color" class="myinput2" name="action_button_discription_color" id="action_button_discription_color" value="<?= $detail_info->action_button_discription_color ?>" placeholder="#ffffff">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="action_button_bg_color">Action Button Color</label>
                    <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="<?= $detail_info->action_button_bg_color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="action_button_link">Action Button Application</label>
                    <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" onchange="check_selction(this.value)" name="action_button_link">
                      <option value="link">Link</option>
                      <option value="call" <?= $detail_info->action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                      <option value="sms" <?= $detail_info->action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                      <option value="email" <?= $detail_info->action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                      <option value="video" <?= $detail_info->action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                      <option value="address" <?= $detail_info->action_button_link == 'address' ? 'selected' : '' ?>>Address</option>
                      <option value="stripe" <?= $detail_info->action_button_link == 'stripe' ? 'selected' : '' ?>>Stripe</option>
                      <option value="text_popup" <?= $detail_info->action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                      <option value="audioiconfeature" <?= $detail_info->action_button_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio Icon Feature</option>
                      <option value="google_map" <?= $detail_info->action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                      <option value="customforms" <?= $detail_info->action_button_link == "customforms" ? 'selected' : '' ?>>Forms</option>
                      <option value="image_popup" <?= $detail_info->action_button_link == "image_popup" ? 'selected' : '' ?>>Image Popup</option>
                      <?php foreach ($front_sections as $single) { ?>
                        <option value="<?= $single->slug ?>" <?= $detail_info->action_button_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                      <?php } ?>
                      <option value="eventForms" <?= $detail_info->action_button_link == "eventForms" ? 'selected' : '' ?>>Event Forms</option>
                    </select>
                  </div>
                  <div class="form-group action_fields video_upload" name="action_button_video1" style="<?= $detail_info->action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                    <label for="customFile">Upload Video</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="action_button_video" id="customFile" accept=".mp4">
                      <label class="custom-file-label" for="customFile">Upload Video</label>
                    </div>
                    @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                    <div class=" position-relative d-flex newspost_action_button">
                      <video height="80" controls>
                        <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($detail_info->action_button_video)) : '' ?>" type="video/mp4">
                      </video>
                      <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='newspost_action_button' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                      </div>
                    </div>
                    @endif
                  </div>
                  <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                    <label for="">Phone number for calls</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_calls1" value="<?= $detail_info->action_button_phone_no_calls ?>">
                  </div>
                  <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= $detail_info->action_type == 'image_popup' ? 'display:block' : 'display:none' ?>">
                            <label for="customFile">Upload Images</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                <label class="custom-file-label" for="customFile">Choose files</label>
                            </div>
                            </div>
                  <div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature" style="<?= $detail_info->action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                    <label for="customFile">Select File</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="action_button_audio_icon_feature1" id="customFile" accept=".mp3">
                      <label class="custom-file-label" for="customFile">Select File</label>
                    </div>
                    <div class="row">
                      <?php if ($detail_info->action_button_link == 'audioiconfeature' && $detail_info->action_button_audio_icon_feature) {

                      ?>
                        <div class="col-md-10 imgdiv">
                          <h4><?= $detail_info->action_button_audio_icon_feature ?></h4>
                          <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="blog_btn" data-id="<?= $detail_info->id ?>" data-imgname="<?= $detail_info->action_button_audio_icon_feature ?>">X</button>
                        </div>
                      <?php
                      } ?>
                    </div>
                  </div>
                  <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                    <label for="">Phone number for sms</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                  </div>
                  <div class="form-group action_fields action_email" style="<?= $detail_info->action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                    <label for="">Email</label>
                    <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                  </div>
                  <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $detail_info->action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                    <label for="customFile">Select File</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3,.mp4">
                      <label class="custom-file-label" for="customFile">Select File</label>
                    </div>
                  </div>
                  <div class="row">
                    <?php if ($detail_info->action_button_action_audio) {

                    ?>
                      <div class="col-md-10 imgdiv">
                        <h4><?= $detail_info->action_button_action_audio ?></h4>
                        <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="news_post" data-id="<?= $detail_info->id ?>" data-imgname="<?= $detail_info->action_button_action_audio ?>">X</button>
                      </div>
                    <?php


                    } ?>
                  </div>
                  <br>
                  <div class="form-group action_fields action_link" style="<?= $detail_info->action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                    <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="<?= $detail_info->action_button_link_text ?>" placeholder="http://google.com">
                  </div>
                  <div class="form-group action_fields action_forms" style="<?= $detail_info->action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                    <select class="myinput2 customforms" name="action_button_customform">
                      <?php if (count($custom_forms) > 0) { ?>
                        <?php foreach ($custom_forms as $single) { ?>
                          <option value="<?= $single->id ?>" <?= $detail_info->action_button_customform == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group action_fields action_forms" style="<?= $detail_info->action_button_link == 'eventForms' ? 'display:block' : 'display:none' ?>">
                    <select class="myinput2 customforms" name="action_button_eventform">
                      <?php if (count($event_forms) > 0) { ?>
                        <?php foreach ($event_forms as $single) { ?>
                          <option value="<?= $single->id ?>" <?= $detail_info->event_form_id == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class=" action_fields action_map" style="<?= $detail_info->btn_section == 'google_map' ? 'display:block' : 'display:none' ?>">
                    <div class="form-group ">
                      <label for="address">Enter Address</label>
                      <input type="text" class="myinput2 " name="action_button_map_address" value="<?= isset($detail_info->action_button_map_address) && $detail_info->action_button_map_address ? $detail_info->action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                    </div>
                  </div>
                  <div class="form-group action_fields action_address" style="<?= $detail_info->action_button_link == 'address' ? 'display:block' : 'display:none' ?>">
                    <label for="addressbtn1">Select an Address</label>
                    <select name="action_button_address_id" class="myinput2">
                      <?php foreach ($addresses as $address) { ?>
                        <option value="<?= $address->id ?>" <?= $detail_info->action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                  <div class="col-md-6 col-sm-12 p-0">
                    <div class="form-group">
                      <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $detail_info->action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                        <label>Popup Text </label>
                        <textarea class="myinput2 editordata hidden" name="action_button_textpopup"><?php echo $detail_info->action_button_textpopup; ?></textarea>
                        <div class="quilleditor">
                          <?php echo $detail_info->action_button_textpopup; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Timed Image Settings -->
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center titlediv">
                    <div class="title-2">Timed Image Settings</div>
                  </div>
                  <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
                <div class="form-group m-0 ml-3 switchoverhead2">
                  <label class="switch m-0">
                    <input type="checkbox" class="notificationswitch timeimagesswitch" name="enable_timed_image" <?= $detail_info->enable_timed_image ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-6">
                  <?php
                  $start_time = new DateTime($detail_info->timed_image_start_time, new DateTimeZone($timezone->TimeZone));
                  $end_time = new DateTime($detail_info->timed_image_end_time, new DateTimeZone($timezone->TimeZone));
                  $days = json_decode($detail_info->timed_image_days);
                  ?>
                  <div class="row nopadding datetimediv_logo" style="">
                    <div class="col-md-6 nopadding">
                      <div class="form-group">
                        <label for="image_type">Type</label>
                        <select name="image_type" class="myinput2 timed_image_type" id="image_type">
                          <option value="days" <?= $detail_info->timed_image_type == 'days' ? 'selected' : '' ?>>By Days</option>
                          <option value="timer" <?= $detail_info->timed_image_type == 'timer' ? 'selected' : '' ?>>Timer</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 nopadding">
                      <div class="timed_type_divs timer_div" style="<?= $detail_info->timed_image_type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                        <div class="form-group">
                          <label for="image_timer">Timer</label>
                          <select name="image_timer" class="myinput2" id="image_timer">
                            <option value="15" <?= $detail_info->timed_image_duration == '15' ? 'selected' : '' ?>>15 min</option>
                            <option value="30" <?= $detail_info->timed_image_duration == '30' ? 'selected' : '' ?>>30 min</option>
                            <option value="60" <?= $detail_info->timed_image_duration == '60' ? 'selected' : '' ?>>1 hour</option>
                            <option value="120" <?= $detail_info->timed_image_duration == '120' ? 'selected' : '' ?>>2 hour</option>
                            <option value="240" <?= $detail_info->timed_image_duration == '240' ? 'selected' : '' ?>>4 hour</option>
                            <option value="360" <?= $detail_info->timed_image_duration == '360' ? 'selected' : '' ?>>6 hour</option>
                            <option value="480" <?= $detail_info->timed_image_duration == '480' ? 'selected' : '' ?>>8 hour</option>
                            <option value="720" <?= $detail_info->timed_image_duration == '720' ? 'selected' : '' ?>>12 hour</option>
                            <option value="1440" <?= $detail_info->timed_image_duration == '1440' ? 'selected' : '' ?>>24 hour</option>
                            <option value="2880" <?= $detail_info->timed_image_duration == '2880' ? 'selected' : '' ?>>48 hour</option>
                          </select>
                        </div>
                      </div>
                      <div class="timed_type_divs days_div" style="<?= $detail_info->timed_image_type == 'days' ? 'display:block;' : 'display:none;' ?>">
                        <div class="form-group">
                          <label for="date">Date</label>
                          <input type="time" name="image_start_time" class="myinput2" id="date" value="<?php echo $start_time->format('H:i'); ?>">
                        </div>
                        <div class="form-group">
                          <label for="time">Time</label>
                          <input type="time" name="image_end_time" class="myinput2" id="time" value="<?php echo $end_time->format('H:i'); ?>">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">

                  <div class="form-group">
                    <label for="">Select Days</label>
                    <select class="myinput2 multiselectlist" name="days[]" multiple>
                      <option value="mon" <?= is_array($days) && in_array('mon', $days) ? 'selected' : '' ?>>Monday</option>
                      <option value="tue" <?= is_array($days) && in_array('tue', $days) ? 'selected' : '' ?>>Tuesday</option>
                      <option value="wed" <?= is_array($days) && in_array('wed', $days) ? 'selected' : '' ?>>Wednesday</option>
                      <option value="thu" <?= is_array($days) && in_array('thu', $days) ? 'selected' : '' ?>>Thursday</option>
                      <option value="fri" <?= is_array($days) && in_array('fri', $days) ? 'selected' : '' ?>>Friday</option>
                      <option value="sat" <?= is_array($days) && in_array('sat', $days) ? 'selected' : '' ?>>Saturday</option>
                      <option value="sun" <?= is_array($days) && in_array('sun', $days) ? 'selected' : '' ?>>Sunday</option>
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
              <input type="file" class="audioFileInput" style="display:none;" accept="audio/*">
              <!-- <input type="file" class="audioFileInput"  accept="audio/*"> -->
              <a href="<?= base_url('quicksettings?block=news_posts_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body">
            <?php if ($detail_info->image) { ?>
              <h4>Default Image</h4>
              <div class="col-md-12 news_post_image_div">
                <img src='<?= base_url("assets/uploads/" . get_current_url() . $detail_info->image) ?>' width="100%">
                <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->image ?>','image','news_post_image_div','news_posts',<?= $detail_info->id ?>)">X</button>
              </div>
              <br>
            <?php } else { ?>
              <h3>No Default Images Found </h3>
            <?php } ?>
            <hr>
            <?php if ($detail_info->timed_image) { ?>
              <h4>Timed Image</h4>
              <div class="col-md-12 timed_news_post_image_div">
                <img src='<?= base_url("assets/uploads/" . get_current_url() . $detail_info->timed_image) ?>' width="100%">
                <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->timed_image ?>','timed_image','timed_news_post_image_div','news_posts',<?= $detail_info->id ?>)">X</button>
              </div>
              <br>
            <?php } else { ?>
              <h3>No Timed Image Set </h3>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div>
<!--Row-->
</div>

<script>
document.getElementById('add-action-button').addEventListener('click', function() {
    // Get the container and the last action button row
    const container = document.querySelector('.action-buttons-container');
    const lastRow = container.querySelector('.action-button-row:last-child');
    const newRow = lastRow.cloneNode(true);
    
    // Increment the index
    const newIndex = container.children.length;
    
    // Update names and ids in the new row
    Array.from(newRow.querySelectorAll('input, select, textarea, label')).forEach((element) => {
        if (element.name) {
            element.name = element.name.replace(/\[\d*\]/, `[${newIndex}]`);
        }
        if (element.id) {
            element.id = element.id.replace(/\d+$/, newIndex);
        }
        if (element.htmlFor) {
            element.htmlFor = element.htmlFor.replace(/\d+$/, newIndex);
        }
        if (element.value) {
            element.value = '';
        }
    });
    
    // Append the new row to the container
    container.appendChild(newRow);
});
  @if($detail_info->read_more_text)
  $(".read_more_content").show();
  @else
  $(".read_more_content").hide();
  @endif

  $(document).on('click', '.show_read_more_block', function() {
    $(".read_more_content").toggle();
  });
  $(document).on('click', '.btnaudiofiledel', function() {
    var imgname = $(this).data('imgname');
    var id = $(this).data('id');
    if ($(this).data('slug')) {
      var slug = $(this).data('slug');
    } else {
      var slug = null;
    }
    $(this).closest('.imgdiv').remove();
    $.ajax({
      url: '<?= url('frontend/delaudiofile') ?>',
      type: "POST",
      data: {
        slug: slug,
        id: id,
        imgname: imgname,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });
  // function check_selction(value){

  //   if(value =="address" || value == "google_map"){

  //     $("#address-list").show();
  //     $("#news_post_link").hide();
  //     $("#btncustomforms").hide();

  //   }else if(value == "link"){

  //     $("#news_post_link").show();
  //     $("#address-list").hide();
  //     $("#btncustomforms").hide();

  //   }else if(value == "customforms"){

  //     $("#btncustomforms").show();
  //     $("#news_post_link").hide();
  //     $("#address-list").hide();

  //   }else{

  //     $("#news_post_link").hide();
  //     $("#address-list").hide();
  //     $("#btncustomforms").hide();
  //     $("#address-list").val('');
  //   }
  // }
</script>
@endsection('content')