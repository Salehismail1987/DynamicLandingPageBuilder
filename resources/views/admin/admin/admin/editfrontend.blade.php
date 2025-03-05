@extends('admin.layout.dashboard')
@section('content')
<script>
  var sub_sections = ["title_and_banners", "content_block", "download_files", "custom_forms", "hyperlinks", "faqs", "review_and_staff"];
</script>
<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>
<style>
  input:checked+.slider-active:before {
    background-color: white !important;
  }

  input:checked+.slider-inactive:before {
    background-color: gray !important;
  }
</style>
<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2">Edit Frontend</div>
      <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
        <div>
          <div class="d-flex align-items-center">
            <div class="mr-4 mt-4">
              <div class="form-group m-0 text-center">
                <div class="title-2 mb-1">Popup Alert</div>
                <label class="myswitchdiv popupTool">
                  <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
                  <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
                </label>
                <div class="title-2 mb-1 popupOnOffStatus">&nbsp;</div>
              </div>
            </div>
            <div class="mt-1">
              <div class="form-group m-0 text-center">
                <div class="title-2 mb-1 tipOnOffStatus">&nbsp;</div>
                <div class="title-2 mb-1"></div>
                <label class="myswitchdiv">
                  <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',sub_sections)">
                  <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
                </label>
              </div>
            </div>

            <div class="ml-4 mb-3">
              <div class="form-group m-0 text-center">
                <div class="title-2 mb-1">Controls in Settings</div>
                <div class="title-2 mb-1">Notifications</div>
                <label class="myswitchdiv switch_disabled">
                  <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
                  <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="ml-17 ">
          <div class="dropdown-list-main-div">
            <div class="dropdown-list">
              <div class="title-3 text-color-grey listtxt">Feature Access</div>
              <div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
              </div>
            </div>
            <div class="dropdown-list-div">
              <ul>
                <?php if (check_auth_permission(['review_staff', 'reviews_staff_text', 'review_staff_add_new', 'review_staff_delete'])) { ?>
                  <li data-value="review_staff_bluebar">Reviews Posting</li>
                <?php } ?>
                <li data-value="review_filter_bluebar">Reviews Filter</li>
                <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_text', 'staff_products_promos_add_new', 'staff_products_promos_delete'])) { ?>
                  <li data-value="review_staff_bluebar">Staff, Products or Promos</li>
                <?php } ?>
                <?php if (check_auth_permission(['faqs', 'question_input', 'answer_input', 'faq_add_new'])) { ?>
                  <li data-value="faqs_bluebar">FAQs</li>
                <?php } ?>
                <?php if (check_auth_permission(['hyperlinks', 'hyperlink_image', 'hyperlink_text', 'hyperlink_link_option', 'hyperlink_add_new', 'hyperlink_timed_image'])) { ?>
                  <li data-value="hyperlinks_bluebar">Hyperlinks</li>
                <?php } ?>
                <?php if (check_auth_permission(['formssection'])) { ?>
                  <li data-value="forms_feature">Forms</li>
                <?php } ?>
                <?php if (check_auth_permission(['download_files', 'downloads_file_question', 'download_text', 'downloads_add_new'])) { ?>
                  <li data-value="download_files_bluebar">Download Files</li>
                <?php } ?>
                <?php if (check_auth_permission(['content_block', 'content_block_image', 'content_block_subtitle_text_input', 'content_block_add_new', 'content_block_description', 'content_block_timed_image'])) { ?>
                  <li data-value="content_block_bluebar">Content Block</li>
                <?php } ?>
                <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                  <li data-value="title_banners_bluebar">Title & Banners</li>
                <?php } ?>
                <?php if (check_auth_permission(['build_site_Content'])) { ?>
                  <li data-value="build_site_content_bluebar">Build Site Content</li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (check_auth_permission(['review_staff', 'reviews_staff_text', 'review_staff_add_new', 'review_staff_delete'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="review_staff_bluebar" data-tip_section="review_and_staff">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Reviews Posting</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('testimonials'))
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
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'review_staff_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('updatereviewstaff')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-17">
            <div class="col-md-3">
              <div class="form-group d-flex">
                <label class="">Override Background <br>Color in Settings, Theme</label>
                <label class="switch ml-7">
                  <input type="checkbox" class="notificationswitch override_bg_enable review_override_bg" name="review_override_bg" data-slug="review_bg_picker" <?php echo  $reviewSettings->review_override_bg ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group review_bg_picker" style="display:<?php echo  $reviewSettings->review_override_bg ? 'block' : 'none' ?>">
                <label>Feature's Background Color</label>
                <input type="color" class="myinput2" name="reviews_staff_background" value="<?= $reviewSettings->review_background ?>">
              </div>
            </div>
            <?php if (check_auth_permission(['build_site_Content'])) { ?>

              <?php $review_staff_outline = get_outline_settings('review_staff_outline'); ?>
              <div class="col-md-6 text-right">
                <div class="mr-6vi">
                  <label class="title-5 text-black">Tutorial Website Controls</label>
                </div>
                <div class="align-all-right d-flex align-items-end">
                  <div class="form-group  d-flex align-items-center">
                    <div for="" class="title-9 text-black">Turn On Outline</div>
                    <label class="switch ml-7">
                      <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="review_staff_outline" <?php echo $review_staff_outline->time != null ? 'checked' : ''; ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="form-group ml-34">
                    <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                    <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $review_staff_outline->outline_color ?>" placeholder="#000000" data-slug="review_staff_outline">
                  </div>
                </div>
              </div>

            <?php } ?>
          </div>
          <div class="myhr mb-16"></div>
          <div class="reviews_staff">
            <?php if (check_auth_permission('review_staff')) { ?>
              <div class="row mb-3">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Enable Stars?</label><br>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch" name="enable_review_stars" <?= $reviewSettings->enable_review_stars ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Arrow Color</label>
                    <input type="color" class="myinput2" name="arrow_color" value="<?php echo $reviewSettings->arrow_color; ?>" placeholder="#000000">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Arrow Hover Color</label>
                    <input type="color" class="myinput2" name="arrow_hover_color" value="<?php echo $reviewSettings->arrow_hover_color; ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Indicator Color</label>
                    <input type="color" class="myinput2" name="dot_color" value="<?php echo $reviewSettings->dot_color; ?>" placeholder="#000000">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Active Indicator Color</label>
                    <input type="color" class="myinput2" name="dot_active_color" value="<?php echo $reviewSettings->dot_active_color; ?>" placeholder="#000000">
                  </div>
                </div>

              </div>
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                      <div class="d-flex align-items-center">
                        <div class="title-2">Generic Settings</div>
                        <label class="switch ml-3">
                          <input type="checkbox" class="notificationswitch saveGeneric" data-table="reviewSettings" name="use_generic_review_staff_setting" <?= $reviewSettings->use_generic ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Select Font</label>
                        <select class="myinput2" name="generic_review_staff_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_review_staff->fontfamily == $single->id ? 'selected' : ''; ?>>
                                <?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Description Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="generic_review_staff_font_size" value="<?php echo $generic_review_staff->size_web; ?>" placeholder="16px">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Description Text Color</label>
                        <input type="color" class="myinput2" name="generic_review_staff_color" value="<?php echo $generic_review_staff->color; ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Star Color</label>
                        <input type="color" class="myinput2" name="generic_review_staff_star_color" value="<?php echo $generic_review_staff_star->color; ?>" placeholder="#FFFF00">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php if (check_auth_permission('reviews_staff_text')) { ?>
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="title-2">Individual Settings</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2 sortablenewstable">
                  <?php
                  $stars = get_enum_values('review_staff', 'stars');
                  if (count($reviews_staff) > 0) {
                    $i = 0; ?>
                    <?php foreach ($reviews_staff as $single) { ?>
                      <tr class="review_rows">
                        <input type="hidden" name="oldreviews_staff_id[]" value="<?= $single->id ?>">
                        <div class="row reviewdiv" data-sectionid="<?= $single->id ?>">
                          @if ($single->image)
                          <div class="col-md-3 col-xs-12 review_staff_image_div<?= $single->id ?>">
                            <img src='<?= base_url('assets/uploads/' . get_current_url() . $single->image) ?>' width="100%">
                            <?php if (check_auth_permission(['review_staff_delete'])) { ?>
                              <button type="button" class="btn btn-primary btn-delete-image review_Staff_delete_btn" onclick="delete_front_image('<?= $single->image ?>','image','review_staff_image_div<?= $single->id ?>','review_staff',<?= $single->id ?>,'false')">X</button>
                            <?php } ?>
                          </div>
                          @endif

                          <div class="col-md-3" style="@if ($single->image) display: none; @endif">
                            <div class="col-md-12 col-xs-12 review_staff_image_upload_btn" style="@if ($single->image) display: none; @endif">
                              <div class="uploadImageDiv">
                                <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                <input class="dataimage" type="hidden" name="oldreview_staff_image[]">

                                <div class="col-md-6 imgdiv" style="display:none">
                                  <br>
                                  <img src='' width="100%" class="imagefromgallerysrc">
                                  <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-md-9 wrap">
                            <?php if (check_auth_permission(['review_staff', 'reviews_staff_text'])) {
                            ?>
                              <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                  <label>Description Text</label>
                                  <textarea name="oldreviews_staff_text[]" class="myinput2" id="" cols="30" rows="4"><?= $single->text ?></textarea>
                                </div>
                              </div>
                            <?php
                            } ?>
                            <?php if (check_auth_permission('review_staff')) { ?>
                              <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                  <label>Description Text size</label><br>

                                  <input type="text" class="myinput2 width-50px" name="oldreviews_text_size[]" <?php if ($reviewSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->text_size ?>" placeholder="16">
                                </div>
                              </div>
                              <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                  <label>Description Text color</label>
                                  <input type="color" class="myinput2" name="oldreviews_text_color[]" <?php if ($reviewSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->text_color ?>">
                                </div>
                              </div>
                              <?php if (check_auth_permission(['review_staff', 'review_staff_delete'])) { ?>
                                <div class="col-md-3 col-xs-4">
                                  <br>
                                  <button type="button" class="btn btn-primary btnremovereview" data-reviewid="<?= $single->id ?>">Delete Review</button>
                                </div>
                              <?php } ?>
                              <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                  <label>Select Font</label>
                                  <select class="myinput2" name="oldreviews_text_font[]" <?php if ($reviewSettings->use_generic) { ?> disabled <?php } ?>>
                                    <?php if (count($font_family) > 0) { ?>
                                      <?php foreach ($font_family as $singlef) { ?>
                                        <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>" <?= (isset($single->text_font) && $single->text_font == $singlef->id) ? 'selected' : ''; ?>><?= $singlef->name ?></option>
                                      <?php } ?>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                  <label>Number of Stars/Ratig</label><br>
                                  <select class="myinput2 width-60px" name="oldreviews_stars[]">
                                    <?php

                                    if (count($stars) > 0) { ?>
                                      <?php foreach ($stars as $star) { ?>
                                        <option value="<?= $star ?>" <?= (isset($single->stars) && $single->stars == $star) ? 'selected' : ''; ?>><?= $star ?></option>
                                      <?php } ?>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-4 col-xs-8">
                                <div class="form-group">
                                  <label>Star color</label>
                                  <input type="color" class="myinput2" name="oldreviews_star_color[]" <?php if ($reviewSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->star_color ?>">
                                </div>
                              </div>
                          </div>
                          <div class="col-md-12"><br /></div>
                          <div class="col-md-12">
                            <div class="content3">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="grey-div d-flex justify-content-between align-items-center editbtn3">
                                    <div class="title-2 openEditContent">Review Action Buttons Settings</div>
                                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                  </div>
                                </div>
                              </div>
                              <div class="editcontent3">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label for="bannertext">Left Side Action button active</label><br>
                                          <label class="switch">
                                            <input type="checkbox" class="notificationswitch" name="left_action_button_active[{{$i}}]" <?= isset($single->left_action_button_active) && $single->left_action_button_active ? 'checked' : '' ?>>
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                      <br>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="action_button_discription">Action Button Name</label>
                                          <input type="text" class="myinput2" name="left_action_button_name[]" id="left_action_button_name" value="<?= isset($single->left_action_button_name) && $single->left_action_button_name ?  $single->left_action_button_name : '' ?>" placeholder="Type here...">
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="action_button_text_color">Action Button Text Color</label>
                                          <input type="color" class="myinput2" name="left_action_button_text_color[]" id="left_action_button_text_color" value="<?= isset($single->left_action_button_text_color) &&  $single->left_action_button_text_color ? $single->left_action_button_text_color : '' ?>" placeholder="#ffffff">
                                        </div>
                                      </div>
                                      <div class="col-md-2">
                                        <div class="form-group">
                                          <label for="action_button_bg_color">Action Button Color</label>
                                          <input type="color" class="myinput2" name="left_action_button_bg_color[]" id="left_action_button_bg_color" value="<?= isset($single->left_action_button_bg_color) && $single->left_action_button_bg_color ? $single->left_action_button_bg_color : '' ?>" placeholder="#000000">
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="action_button_link">Action Button Application</label>
                                          <select class="myinput2 news_post_action_button action_button_selection" id="left_action_button_link" name="left_action_button_link[]">
                                            <option value="link">Link</option>
                                            <option value="call" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                            <option value="sms" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                                            <option value="email" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                            <option value="video" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                                            <option value="google_map" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                            <option value="text_popup" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                            <option value="address" <?= isset($single->left_action_button_link) && $single->left_action_button_link == "address" ? 'selected' : '' ?>>Address</option>
                                            <option value="audioiconfeature" <?= isset($single->left_action_button_link) && $single->left_action_button_link == "audioiconfeature" ? 'selected' : '' ?>>Audio Icon Feature</option>
                                            <option value="customforms" <?= isset($single->left_action_button_link) && $single->left_action_button_link ==  "customforms" ? 'selected' : '' ?>>Forms</option>
                                            <?php foreach ($front_sections as $single2) { ?>
                                              <option value="<?= $single2->slug ?>" <?= isset($single->left_action_button_link) && $single->left_action_button_link == $single2->slug ? 'selected' : '' ?>><?= $single2->name ?></option>
                                            <?php } ?>
                                          </select>
                                          <div class="form-group action_fields phone_no_calls" style="<?= $single->left_action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for calls</label>
                                            <input type="text" class="myinput2" name="left_action_button_phone_no_calls[]" value="<?= $single->left_action_button_phone_no_calls ?>">
                                          </div>
                                          <div class="form-group action_fields phone_no_sms" style="<?= $single->left_action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for sms</label>
                                            <input type="text" class="myinput2" name="left_action_button_phone_no_sms[]" value="<?= $single->left_action_button_phone_no_sms ?>">
                                          </div>
                                          <div class="form-group action_fields action_email" style="<?= $single->left_action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Email</label>
                                            <input type="text" class="myinput2" name="left_action_button_action_email[]" value="<?= $single->left_action_button_action_email ?>">
                                          </div>
                                          <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $single->left_action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="left_action_button_textpopup[]"><?php echo $single->left_action_button_textpopup; ?></textarea>
                                            <div class="quilleditor">
                                              <?php echo $single->left_action_button_textpopup; ?>
                                            </div>
                                          </div>
                                          <div class="form-group action_fields action_link" style="<?= $single->left_action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                            <input type="text" class="myinput2 news_post_link" name="left_action_button_link_text[]" id="news_post_link" value="<?= isset($single->left_action_button_link_text) && $single->left_action_button_link_text ? $single->left_action_button_link_text : '' ?>" placeholder="http://google.com">
                                          </div>
                                          <div class="form-group action_fields audio_upload" name="left_feature_action_audio" style="<?= $single->left_action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" name="left_audio_file[]" id="customFile" accept=".mp3">
                                              <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                          </div>
                                          <div class="form-group action_fields audio_icon_feature" name="left_audio_icon_feature" style="<?= $single->left_action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" name="left_audio_icon_file[]" id="customFile" accept=".mp3">
                                              <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <?php if ($single->left_action_button_link == 'audioiconfeature' && $single->left_audio_icon_file) {

                                            ?>
                                              <div class="col-md-10 imgdiv">
                                                <h4><?= $single->left_audio_icon_file ?></h4>
                                                <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="review_post_left" data-id="<?= $single->id ?>" data-imgname="<?= $single->left_audio_icon_file ?>">X</button>
                                              </div>
                                            <?php


                                            } ?>
                                          </div>
                                          <div class="form-group action_fields video_upload" name="feature_action_video" style="<?= $single->left_action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Video</label>

                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" name="left_video_file[]" id="customFile" accept=".mp4">
                                              <label class="custom-file-label" for="customFile">Upload Video</label>
                                            </div>
                                            @if(isset($single->left_action_button_video) && $single->left_action_button_video !='')
                                            <div class=" position-relative d-flex review_left_action_button_video_{{$single->id}}">
                                              <video height="80" controls>
                                                <source src="<?= isset($single->left_action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($single->left_action_button_video)) : '' ?>" type="video/mp4">
                                              </video>
                                              <a class="remove_video_action btn btn-primary" href="<?php echo base_url('deletereviewvideo/' . $single->id . '/?type=left'); ?>" onclick="return confirm('Are You Sure?');" title="Click to Remove" data-type='review_left_action_button_video' data-id="{{$single->id}}" data-file="{{$single->left_action_button_video}}">X
                                              </a>
                                            </div>

                                            @endif
                                          </div>
                                          <div class="form-group action_fields action_forms" style="<?= $single->left_action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                            <select class="myinput2" name="left_action_button_customform[]" id="customforms">
                                              <?php if (count($customForms) > 0) { ?>
                                                <?php foreach ($customForms as $singlecf) { ?>
                                                  <option value="<?= $singlecf->id ?>" <?= isset($single->left_action_button_customform) && $single->left_action_button_customform == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                                <?php } ?>
                                              <?php } ?>
                                            </select>
                                          </div>
                                          <div class="form-group action_fields action_address" style="display:<?= isset($single->left_action_button_link) &&  $single->left_action_button_link  == "address"  ? 'block' : 'none' ?>">
                                            <label for="addressbtn1">Select an Address</label>
                                            <select name="left_action_button_address_id[]" class="myinput2">
                                              <?php
                                              foreach ($addresses as $address) {
                                              ?>
                                                <option value="<?= $address->id ?>" <?= isset($single->left_action_button_address_id) && $single->left_action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?>
                                          </div>
                                        <?php
                                              }
                                        ?>
                                        </select>
                                        </div>
                                        <div class="form-group action_fields action_map" style="<?= $single->left_action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                          <label for="address">Enter Address</label>
                                          <input type="text" class="myinput2 " name="left_action_button_map_address[]" value="<?= isset($single->left_action_button_map_address) && $single->left_action_button_map_address ? $single->left_action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-12"><br /></div>
                                <div class="col-md-12">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="bannertext">Right Side Action button active</label><br>
                                        <label class="switch">
                                          <input type="checkbox" class="notificationswitch" name="right_action_button_active[{{$i}}]" <?= isset($single->right_action_button_active) && $single->right_action_button_active ? 'checked' : '' ?>>
                                          <span class="slider round"></span>
                                        </label>
                                      </div>
                                    </div>
                                    <br>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="right_action_button_name">Action Button Name</label>
                                        <input type="text" class="myinput2" name="right_action_button_name[]" id="right_action_button_name" value="<?= isset($single->right_action_button_name) && $single->right_action_button_name ?  $single->right_action_button_name : '' ?>" placeholder="Type here...">
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="right_action_button_text_color">Action Button Text Color</label>
                                        <input type="color" class="myinput2" name="right_action_button_text_color[]" id="right_action_button_text_color" value="<?= isset($single->right_action_button_text_color) &&  $single->right_action_button_text_color ? $single->right_action_button_text_color : '' ?>" placeholder="#ffffff">
                                      </div>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="right_action_button_bg_color">Action Button Color</label>
                                        <input type="color" class="myinput2" name="right_action_button_bg_color[]" id="right_action_button_bg_color" value="<?= isset($single->right_action_button_bg_color) && $single->right_action_button_bg_color ? $single->right_action_button_bg_color : '' ?>" placeholder="#000000">
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="right_action_button_link">Action Button Application</label>
                                        <select class="myinput2 news_post_action_button action_button_selection" id="right_action_button_link" name="right_action_button_link[]">
                                          <option value="link">Link</option>
                                          <option value="call" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                          <option value="sms" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                                          <option value="email" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                          <option value="video" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                                          <option value="text_popup" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                          <option value="google_map" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                          <option value="address" <?= isset($single->right_action_button_link) && $single->right_action_button_link == "address" ? 'selected' : '' ?>>Address</option>
                                          <option value="audioiconfeature" <?= isset($single->right_action_button_link) && $single->right_action_button_link == "audioiconfeature" ? 'selected' : '' ?>>Audio Icon Feature</option>
                                          <option value="customforms" <?= isset($single->right_action_button_link) && $single->right_action_button_link ==  "customforms" ? 'selected' : '' ?>>Forms</option>
                                          <?php foreach ($front_sections as $single2) { ?>
                                            <option value="<?= $single2->slug ?>" <?= isset($single->right_action_button_link) && $single->right_action_button_link == $single2->slug ? 'selected' : '' ?>><?= $single2->name ?></option>
                                          <?php } ?>
                                        </select>
                                        <div class="form-group action_fields phone_no_calls" style="<?= $single->right_action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                          <label for="">Phone number for calls</label>
                                          <input type="text" class="myinput2" name="right_action_button_phone_no_calls[]" value="<?= $single->right_action_button_phone_no_calls ?>">
                                        </div>
                                        <div class="form-group action_fields phone_no_sms" style="<?= $single->right_action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                          <label for="">Phone number for sms</label>
                                          <input type="text" class="myinput2" name="right_action_button_phone_no_sms[]" value="<?= $single->right_action_button_phone_no_sms ?>">
                                        </div>
                                        <div class="form-group action_fields action_email" style="<?= $single->right_action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                          <label for="">Email</label>
                                          <input type="text" class="myinput2" name="right_action_button_action_email[]" value="<?= $single->right_action_button_action_email ?>">
                                        </div>
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $single->right_action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                          <label>Popup Text </label>
                                          <textarea class="myinput2 editordata hidden" name="right_action_button_textpopup[]"><?php echo $single->right_action_button_textpopup; ?></textarea>
                                          <div class="quilleditor">
                                            <?php echo $single->right_action_button_textpopup; ?>
                                          </div>
                                        </div>
                                        <div class="form-group action_fields action_link" style="<?= $single->right_action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                          <input type="text" class="myinput2 news_post_link" name="right_action_button_link_text[]" id="news_post_link" value="<?= isset($single->right_action_button_link_text) && $single->right_action_button_link_text ? $single->right_action_button_link_text : '' ?>" placeholder="http://google.com">
                                        </div>
                                        <div class="form-group action_fields audio_upload" name="right_feature_action_audio" style="<?= $single->right_action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                          <label for="customFile">Select File</label>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="right_audio_file[]" id="customFile" accept=".mp3">
                                            <label class="custom-file-label" for="customFile">Select File</label>
                                          </div>
                                        </div>
                                        <div class="form-group action_fields audio_icon_feature" name="right_audio_icon_feature" style="<?= $single->right_action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                          <label for="customFile">Select File</label>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="right_audio_icon_file[]" id="customFile" accept=".mp3">
                                            <label class="custom-file-label" for="customFile">Select File</label>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <?php if ($single->right_action_button_link == 'audioiconfeature' && $single->right_audio_icon_file) {

                                          ?>
                                            <div class="col-md-10 imgdiv">
                                              <h4><?= $single->right_audio_icon_file ?></h4>
                                              <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="review_post_right" data-id="<?= $single->id ?>" data-imgname="<?= $single->right_audio_icon_file ?>">X</button>
                                            </div>
                                          <?php


                                          } ?>
                                        </div>
                                        <div class="form-group action_fields video_upload" name="feature_action_video" style="<?= $single->right_action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                          <label for="customFile">Upload Video</label>
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="right_video_file[]" id="customFile" accept=".mp4">
                                            <label class="custom-file-label" for="customFile">Upload Video</label>
                                          </div>
                                          @if(isset($single->right_action_button_video) && $single->right_action_button_video !='')
                                          <div class=" position-relative d-flex review_right_action_button_video_{{$single->id}}">
                                            <video height="80" controls>
                                              <source src="<?= isset($single->right_action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($single->right_action_button_video)) : '' ?>" type="video/mp4">
                                            </video>
                                            <a class="remove_video_action btn btn-primary" href="<?php echo base_url('deletereviewvideo/' . $single->id . '/?type=right'); ?>" onclick="return confirm('Are You Sure?');" title="Click to Remove" data-type='review_right_action_button_video' data-id="{{$single->id}}" data-file="{{$single->right_action_button_video}}">X
                                            </a>
                                          </div>
                                          @endif
                                        </div>
                                        <div class="form-group action_fields action_forms" style="<?= $single->right_action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                          <select class="myinput2" name="right_action_button_customform[]" id="customforms">
                                            <?php if (count($customForms) > 0) { ?>
                                              <?php foreach ($customForms as $singlecf) { ?>
                                                <option value="<?= $singlecf->id ?>" <?= isset($single->right_action_button_customform) && $single->right_action_button_customform == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                              <?php } ?>
                                            <?php } ?>
                                          </select>
                                        </div>
                                        <div class="form-group action_fields action_address" style="display:<?= isset($single->right_action_button_link) &&  $single->right_action_button_link  == "address"  ? 'block' : 'none' ?>">
                                          <label for="addressbtn1">Select an Address</label>
                                          <select name="right_action_button_address_id[]" class="myinput2">
                                            <?php
                                            foreach ($addresses as $address) {
                                            ?>
                                              <option value="<?= $address->id ?>" <?= isset($single->action_button_address_id) && $single->action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?>
                                        </div>
                                      <?php
                                            }
                                      ?>
                                      </select>
                                      </div>
                                      <div class="form-group action_fields action_map" style="<?= $single->right_action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                        <label for="address">Enter Address</label>
                                        <input type="text" class="myinput2 " name="right_action_button_map_address[]" value="<?= isset($single->right_action_button_map_address) && $single->right_action_button_map_address ? $single->right_action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
              <?php
                            } ?>

              </div>
              <br>
              <hr style="border-top: 5px solid rgba(0,0,0,.1)">
              </tr>
            <?php $i++;
                    }  ?>
            </tbody>
          <?php }  ?>
          <?php if (check_auth_permission(['review_staff', 'review_staff_add_new'])) { ?>
            <div class="row">
              <div class="col-md-3">
                <div class="uploadImageDiv">
                  <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                  <input type="hidden" name="imagefromgallery[]" class="imagefromgallery">
                  <input class="dataimage" type="hidden" name="userfile[]">

                  <div class="col-md-6 imgdiv" style="display:none">
                    <br>
                    <img src='' width="100%" class="imagefromgallerysrc">
                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description Text</label>
                  <textarea class="myinput2" name="reviews_staff_text[]" id="" cols="30" rows="4"></textarea>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Description Text size</label><br>
                  <input type="text" class="myinput2 width-50px" name="reviews_text_size[]" placeholder="16">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Description Text color</label>
                  <input type="color" class="myinput2" name="reviews_text_color[]">
                </div>
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Select Font</label>
                  <select class="myinput2" name="reviews_text_font[]">
                    <?php if (count($font_family) > 0) { ?>
                      <?php foreach ($font_family as $singlef) { ?>
                        <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Number of Stars/Rating</label>
                  <select class="myinput2  width-60px" name="reviews_stars[]">
                    <?php if (count($stars) > 0) { ?>
                      <?php foreach ($stars as $star) { ?>
                        <option value="<?= $star ?>"><?= $star ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Star color</label>
                  <input type="color" class="myinput2" name="reviews_star_color[]" value="#FFFF00">
                </div>
              </div>
            </div>
            <div class="col-md-12"><br /></div>
            <div class="col-md-12">
              <div class="content3">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn3">
                      <div class="title-2">Review Action Buttons Settings</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent3">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="bannertext">Left Side Action button active</label><br>
                            <label class="switch">
                              <input type="checkbox" class="notificationswitch" name="left_action_button_active[]">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <br>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="action_button_discription">Action Button Name</label>
                            <input type="text" class="myinput2" name="left_action_button_name[]" id="left_action_button_name" value="" placeholder="Type here...">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="action_button_text_color">Action Button Text Color</label>
                            <input type="color" class="myinput2" name="left_action_button_text_color[]" id="left_action_button_text_color" value="" placeholder="#ffffff">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="action_button_bg_color">Action Button Color</label>
                            <input type="color" class="myinput2" name="left_action_button_bg_color[]" id="left_action_button_bg_color" value="" placeholder="#000000">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="action_button_link">Action Button Application</label>
                            <select class="myinput2 news_post_action_button action_button_selection" id="left_action_button_link" name="left_action_button_link[]">
                              <option value="link">Link</option>
                              <option value="call">Call</option>
                              <option value="sms">SMS</option>
                              <option value="email">Email</option>
                              <option value="video">Video</option>
                              <option value="google_map">Map</option>
                              <option value="text_popup">Text Popup</option>
                              <option value="audioiconfeature">Audio Icon Feature</option>
                              <option value="address">Address</option>
                              <option value="customforms">Forms</option>
                              <?php foreach ($front_sections as $single2) { ?>
                                <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
                              <?php } ?>
                            </select>
                            <div class="form-group action_fields phone_no_calls" style="display:none">
                              <label for="">Phone number for calls</label>
                              <input type="text" class="myinput2" name="left_action_button_phone_no_calls[]" value="">
                            </div>
                            <div class="form-group action_fields phone_no_sms" style="display:none">
                              <label for="">Phone number for sms</label>
                              <input type="text" class="myinput2" name="left_action_button_phone_no_sms[]" value="">
                            </div>
                            <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                              <label>Popup Text </label>
                              <textarea class="myinput2 editordata hidden" name="left_action_button_textpopup[]"></textarea>
                              <div class="quilleditor"></div>
                            </div>
                            <div class="form-group action_fields action_email" style="display:none">
                              <label for="">Email</label>
                              <input type="text" class="myinput2" name="left_action_button_action_email[]" value="">
                            </div>
                            <div class="form-group action_fields action_link" style="display:none">
                              <input type="text" class="myinput2 news_post_link" name="left_action_button_link_text[]" id="news_post_link" value="" placeholder="http://google.com">
                            </div>
                            <div class="form-group action_fields audio_upload" name="left_feature_action_audio" style="display:none">
                              <label for="customFile">Select File</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="left_audio_file[]" id="customFile" accept=".mp3">
                                <label class="custom-file-label" for="customFile">Select File</label>
                              </div>
                            </div>
                            <div class="form-group action_fields audio_icon_feature" name="left_audio_icon_feature" style="display:none">
                              <label for="customFile">Select File</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="left_audio_icon_file[]" id="customFile" accept=".mp3">
                                <label class="custom-file-label" for="customFile">Select File</label>
                              </div>
                            </div>
                            <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                              <label for="customFile">Upload Video</label>

                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="left_video_file[]" id="customFile" accept=".mp4">
                                <label class="custom-file-label" for="customFile">Upload Video</label>
                              </div>
                            </div>
                            <div class="form-group action_fields action_forms" style="display:none">
                              <select class="myinput2" name="left_action_button_customform[]" id="customforms">
                                <?php if (count($customForms) > 0) { ?>
                                  <?php foreach ($customForms as $singlecf) { ?>
                                    <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                                  <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group action_fields action_address" style="display:none">
                              <label for="addressbtn1">Select an Address</label>
                              <select name="left_action_button_address_id[]" class="myinput2">
                                <?php
                                foreach ($addresses as $address) {
                                ?>
                                  <option value="<?= $address->id ?>"><?= $address->address_title ?>
                            </div>
                          <?php
                                }
                          ?>
                          </select>
                          </div>
                          <div class="form-group action_fields action_map" style="display:none">
                            <label for="address">Enter Address</label>
                            <input type="text" class="myinput2 " name="left_action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12"><br /></div>
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="bannertext">Right Side Action button active</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="right_action_button_active[]">
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                      <br>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="right_action_button_name">Action Button Name</label>
                          <input type="text" class="myinput2" name="right_action_button_name[]" id="right_action_button_name" value="" placeholder="Type here...">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="right_action_button_text_color">Action Button Text Color</label>
                          <input type="color" class="myinput2" name="right_action_button_text_color[]" id="right_action_button_text_color" value="" placeholder="#ffffff">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="right_action_button_bg_color">Action Button Color</label>
                          <input type="color" class="myinput2" name="right_action_button_bg_color[]" id="right_action_button_bg_color" value="" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="right_action_button_link">Action Button Application</label>
                          <select class="myinput2 news_post_action_button action_button_selection" id="right_action_button_link" name="right_action_button_link[]">
                            <option value="link">Link</option>
                            <option value="call">Call</option>
                            <option value="sms">SMS</option>
                            <option value="email">Email</option>
                            <option value="video">Video</option>
                            <option value="audioiconfeature">Audio Icon Feature</option>
                            <option value="google_map">Map</option>
                            <option value="text_popup">Text Popup</option>
                            <option value="address">Address</option>
                            <option value="customforms">Forms</option>
                            <?php foreach ($front_sections as $single2) { ?>
                              <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
                            <?php } ?>
                          </select>
                          <div class="form-group action_fields phone_no_calls" style="display:none">
                            <label for="">Phone number for calls</label>
                            <input type="text" class="myinput2" name="right_action_button_phone_no_calls[]" value="">
                          </div>
                          <div class="form-group action_fields phone_no_sms" style="display:none">
                            <label for="">Phone number for sms</label>
                            <input type="text" class="myinput2" name="right_action_button_phone_no_sms[]" value="">
                          </div>
                          <div class="form-group action_fields action_email" style="display:none">
                            <label for="">Email</label>
                            <input type="text" class="myinput2" name="right_action_button_action_email[]" value="">
                          </div>
                          <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                            <label>Popup Text </label>
                            <textarea class="myinput2 editordata hidden" name="right_action_button_textpopup[]"></textarea>
                            <div class="quilleditor"></div>
                          </div>
                          <div class="form-group action_fields action_link" style="display:none">
                            <input type="text" class="myinput2 news_post_link" name="right_action_button_link_text[]" id="news_post_link" value="" placeholder="http://google.com">
                          </div>
                          <div class="form-group action_fields audio_upload" name="right_feature_action_audio" style="display:none">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="right_audio_file[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="form-group action_fields audio_icon_feature" name="right_audio_icon_feature" style="display:none">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="right_audio_icon_file[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                            <label for="customFile">Upload Video</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="right_video_file[]" id="customFile" accept=".mp4">
                              <label class="custom-file-label" for="customFile">Upload Video</label>
                            </div>

                          </div>
                          <div class="form-group action_fields action_forms" style="display:none">
                            <select class="myinput2" name="right_action_button_customform[]" id="customforms">
                              <?php if (count($customForms) > 0) { ?>
                                <?php foreach ($customForms as $singlecf) { ?>
                                  <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group action_fields action_address" style="display:none">
                            <label for="addressbtn1">Select an Address</label>
                            <select name="right_action_button_address_id[]" class="myinput2">
                              <?php
                              foreach ($addresses as $address) {
                              ?>
                                <option value="<?= $address->id ?>"><?= $address->address_title ?>
                          </div>
                        <?php
                              }
                        ?>
                        </select>
                        </div>
                        <div class="form-group action_fields action_map" style="display:none">
                          <label for="address">Enter Address</label>
                          <input type="text" class="myinput2 " name="right_action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary" onclick="add_div()">
            + Add More</button>
        </div>
      </div>
    <?php }  ?>
    </div>
</div>
<?php } ?>
</div>
<div class="row form-bottom make-sticky">
  <div class="col-md-12">
    <button type="submit" name="savereviewsstaff" class="btn btn-primary" value="save">Save</button>
    <button type="submit" name="savereviewsstaff" class="btn btn-primary" value="savereminders">Save & send reminder</button>
  </div>
</div>
</form>
</div>
</div>
<?php } ?>

<!-- Reviews Filter -->

<div class="contentdiv ">
  <div class="btnedit openEditContent" id="review_filter_bluebar" data-tip_section="review_filter">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex  align-items-center">
        <div class="title-1 text-color-blue ">Reviews Filter</div>

      </div>
      <div class=" ">
        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
      </div>
    </div>
  </div>

  <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'review_filter_bluebar' ? 'display:block;' : '' ?>">
    <label>
      Our review filter feature is designed to encourage customer and client reviews. It automatically filters reviews, separating positive ones from negative ones.
      <br><br>
      When a customer submits a highly rated review, a new form immediately appears, providing links to external review sites and the option to copy their review to their device's clipboard. This simplifies the review process on review sites, as they can be easily pasted into external review sites.
      <br><br>
      If a negative review is submitted, the additional form with links to external review sites will not appear. These reviews should be addressed appropriately by the business to resolve any issues and satisfy the customer. There is no encouragement for customers to copy and repost the reviews anywhere else.
      <br><br>
      An additional aspect of this feature is providing unhappy customers a way to express their dissatisfaction. This allows them to vent and hopefully feel they have addressed the issue, not realizing the review is only for your website and will not be posted on external review sites.
      <br><br>
      It's a great way to get more positive reviews and relieve unhappy customers of their desire to post multiple negative reviews.
      <br><br>
      The Form Maker feature in Tools includes a standard review request Form. All Forms include the two review rating options, which can be used on all Forms.
      <br><br><br>
      Below, please enter the names of the review sites you want customers to place their reviews in and the URL link that opens a new tab for customers with positive reviews to paste their review.

    </label>

    <form action="{{url('updateReviewSites')}}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary" onclick="add_links_div()">
            Add New Site</button>
        </div>
      </div>
      @php $review_site_i = 0;@endphp
      <div class="dynamic_review_sites">
        <div class="row static_review_1">
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site name</label>
              <select class="myinput2 siteNamefield" name="review_site_name[1]">
                <?php if (count($review_sites) == 0) { ?>
                  <option value="Yelp" selected>Yelp</option>
                  <option value="Google">Google</option>
                <?php } ?>
                <option value="Other">Other</option>
                <?php foreach ($review_sites as $review_site) { ?>
                  <option value="<?= $review_site->review_site_name ?>" <?= (isset($review_sites[0])) ? (($review_sites[0]->review_site_name == $review_site->review_site_name) ? 'selected' : '') : (($review_site->review_site_name == 'Google Business Reviews' && !isset($review_sites[0])) ? 'selected' : '') ?>>
                    <?= $review_site->review_site_name ?></option> <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site link</label><br>
              <input type="text" class="myinput2 " name="review_site_link[1]" value="{{ isset($review_sites[0]) ? $review_sites[0]->review_site_link : 'yelp.com' }}" placeholder="Review Site link">
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <button type="button" class="btn btn-primary" style="margin-top:1.9rem;" onclick="delete_review('static_review_1')">X</button>
          </div>
        </div>
        @php
        if(isset($review_sites[1]) || !isset($review_sites[0]))
        {
        @endphp
        <div class="row static_review_2">
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site name</label>
              <select class="myinput2 siteNamefield" name="review_site_name[2]">
                <?php if (count($review_sites) == 0) { ?>
                  <option value="Yelp">Yelp</option>
                  <option value="Google Business Reviews" selected>Google Business Reviews</option>
                <?php } ?>
                <option value="Other">Other</option>
                <?php foreach ($review_sites as $review_site) { ?>
                  <option value="<?= $review_site->review_site_name ?>" <?= (isset($review_sites[1])) ? (($review_sites[1]->review_site_name == $review_site->review_site_name) ? 'selected' : '') : (($review_site->review_site_name == 'Google Business Reviews' && !isset($review_sites[1])) ? 'selected' : '') ?>>
                    <?= $review_site->review_site_name ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site link</label><br>
              <input type="text" class="myinput2 " name="review_site_link[2]" value="{{ isset($review_sites[1]) ? $review_sites[1]->review_site_link : 'https://www.google.com/business' }}" placeholder="Review Site link">
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <button type="button" class="btn btn-primary" style="margin-top:1.9rem;" onclick="delete_review('static_review_2')">X</button>
          </div>
        </div>
        @php
        }
        $counter = 0;
        @endphp

        @foreach($review_sites as $site)
        @php
        $counter++;
        @endphp

        @if($counter > 2)
        <div class="row review_counter_{{$counter}}">
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site name</label>
              <select class="myinput2 siteNamefield" name="review_site_name[3]">
                <option value="Other">Other</option>
                <?php foreach ($review_sites as $review_site) { ?>
                  <option value="<?php echo $review_site->review_site_name ?>" <?= (isset($review_site) && $review_site->review_site_name == $site->review_site_name) ? 'selected' : '' ?>><?php echo $review_site->review_site_name ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="form-group">
              <label>Review site link</label><br>
              <input type="text" class="myinput2 " name="review_site_link[3]" value="<?php echo $site->review_site_link ?>" placeholder="Review Site link">
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <button type="button" class="btn btn-primary" style="margin-top:1.9rem;" onclick="delete_review('{{ 'review_counter_'.$counter}}')">X</button>
          </div>
        </div>
        @endif
        @endforeach
      </div>

      <div class="row mt-2 review_sites_container">
        <!-- @foreach($review_sites as $review_site) -->
        <!-- <div class="review_site_{{$review_site_i}} col-md-12">
                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>External review site name</label><br>
                      <input type="text" class="myinput2 " name="review_site_name[]" value="<?php echo $review_site->review_site_name; ?>" placeholder="External review site name">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Review site link</label><br>
                      <input type="text" class="myinput2 " name="review_site_link[]" value="<?php echo $review_site->review_site_link; ?>" placeholder="Review Site link">
                    </div>
                  </div>

                </div>
              </div>
              @php 
              $review_site_i++;
              @endphp
              @endforeach -->

      </div>

      <div class="row form-bottom make-sticky">
        <div class="col-md-12">
          <button type="submit" name="savereviewfilter" class="btn btn-primary" value="save">Save</button>
          <button type="submit" name="savereviewfilter" class="btn btn-primary" value="savereminders">Save & send reminder</button>
        </div>
      </div>
    </form>

  </div>
</div>

<?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_text', 'staff_products_promos_add_new', 'staff_products_promos_delete'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="staff_products_promos_bluebar" data-tip_section="staff_products_promos">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Staff, Products or Promos</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('staff_products_promos'))
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
    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'staff_products_promos_bluebar' ? 'display:block;' : '' ?>">
      <form action="{{url('updatestaffproductspromos')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-17">
          <div class="col-md-3">
            <div class="form-group d-flex">
              <label>Override Background <br>Color in Settings, Theme</label>
              <label class="switch ml-7">
                <input type="checkbox" class="notificationswitch override_bg_enable staff_promos_override_bg" name="staff_promos_override_bg" data-slug="staff_promos_bg_picker" <?php echo  $StaffProductsPromosSettings->staff_promos_override_bg ? 'checked' : '' ?>>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="staff_promos_bg_picker" style="display:<?= $StaffProductsPromosSettings->staff_promos_override_bg ? 'block' : 'none' ?>;">
              <div class="form-group ">
                <label>Feature's Background Color</label>
                <input type="color" class="myinput2" name="staff_products_promos_background" value="<?= $StaffProductsPromosSettings->background ?>">
              </div>
            </div>
          </div>
          <?php if (check_auth_permission(['build_site_Content'])) { ?>

            <?php $staff_products_promos_outline = get_outline_settings('staff_products_promos_outline'); ?>
            <div class="col-md-6 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="staff_products_promos_outline" <?php echo  $staff_products_promos_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $staff_products_promos_outline->outline_color ?>" placeholder="#000000" data-slug="staff_products_promos_outline">
                </div>
              </div>
            </div>

          <?php } ?>
        </div>

        <div class="myhr mb-16"></div>
        <div class="staff_products_promos">
          <?php if (check_auth_permission('staff_products_promos')) { ?>
            <div class="row mb-3">

              <div class="col-md-3">
                <div class="form-group">
                  <label>Enable Stars?</label><br>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch" name="enable_stars" <?= $StaffProductsPromosSettings->enable_stars ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>


              <div class="col-md-3">
                <div class="form-group">
                  <label>Arrow Color</label>
                  <input type="color" class="myinput2" name="arrow_color" value="<?php echo $StaffProductsPromosSettings->arrow_color; ?>" placeholder="#000000">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Arrow Hover Color</label>
                  <input type="color" class="myinput2" name="arrow_hover_color" value="<?php echo $StaffProductsPromosSettings->arrow_hover_color; ?>" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Indicator Color</label>
                  <input type="color" class="myinput2" name="dot_color" value="<?php echo $StaffProductsPromosSettings->dot_color; ?>" placeholder="#000000">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Active Indicator Color</label>
                  <input type="color" class="myinput2" name="dot_active_color" value="<?php echo $StaffProductsPromosSettings->dot_active_color; ?>" placeholder="#000000">
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Generic Settings</div>
                      <label class="switch ml-3">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="StaffProductsPromosSettings" name="use_generic_staff_products_promos_setting" <?= $StaffProductsPromosSettings->use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Select Font</label>
                      <select class="myinput2" name="generic_staff_products_promos_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_staff_products_promos->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Description Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_staff_products_promos_font_size" value="<?php echo $generic_staff_products_promos->size_web; ?>" placeholder="16px">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Description Text Color</label>
                      <input type="color" class="myinput2" name="generic_staff_products_promos_color" value="<?php echo $generic_staff_products_promos->color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Star Color</label>
                      <input type="color" class="myinput2" name="generic_staff_products_promos_star_color" value="<?php echo $generic_staff_products_promos_star->color; ?>" placeholder="#FFFF00">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <?php if (check_auth_permission('staff_products_promos_text')) { ?>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="title-2">Individual Settings</div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2 staff_promo_sortable">
                <?php
                $stars = get_enum_values('staff_products_promos', 'stars');
                if (count($StaffProductsPromos) > 0) {
                  $i = 0;
                ?>
                  <?php foreach ($StaffProductsPromos as $single) { ?>
                    <input type="hidden" name="oldstaff_products_promos_id[]" value="<?= $single->id ?>">
                    <div class="staff_products_promos_div">
                      <div class="row staff_div" data-sectionid="<?= $single->id ?>">
                        @if ($single->image)
                        <div class="col-md-3 col-xs-12 staff_products_promos_image_div<?= $single->id ?>">
                          <img src='<?= base_url('assets/uploads/' . get_current_url() . $single->image) ?>' width="100%">
                          <?php if (check_auth_permission(['staff_products_promos_delete'])) { ?>
                            <button type="button" class="btn btn-primary btn-delete-image staff_products_promos_delete_btn" onclick="delete_front_image('<?= $single->image ?>','image','staff_products_promos_image_div<?= $single->id ?>','staff_products_promos',<?= $single->id ?>,'false')">X</button>
                          <?php } ?>
                        </div>
                        @endif
                        <div class="col-md-3 col-xs-12 staff_products_promos_image_upload_btn" style="@if ($single->image) display: none; @endif">
                          <div class="uploadImageDiv">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="oldstaff_products_promos_image[]">

                            <div class="col-md-6 imgdiv" style="display:none">
                              <br>
                              <img src='' width="100%" class="imagefromgallerysrc">
                              <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-9 wrap">
                          <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_text'])) {
                          ?>
                            <div class="col-md-3 col-xs-12">
                              <div class="form-group">
                                <label>Description Text</label>
                                <textarea name="oldstaff_products_promos_text[]" class="myinput2" id="" cols="30" rows="4"><?= $single->text ?></textarea>
                              </div>
                            </div>
                          <?php
                          } ?>
                          <?php if (check_auth_permission('staff_products_promos')) { ?>
                            <div class="col-md-3 col-xs-12">
                              <div class="form-group">
                                <label>Description Text size</label><br>

                                <input type="text" class="myinput2 width-50px" name="oldstaff_products_promos_text_size[]" <?php if ($StaffProductsPromosSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->text_size ?>" placeholder="16">
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                              <div class="form-group">
                                <label>Description Text color</label>
                                <input type="color" class="myinput2" name="oldstaff_products_promos_text_color[]" <?php if ($StaffProductsPromosSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->text_color ?>">
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                              <div class="form-group">
                                <label>Select Font</label>
                                <select class="myinput2" name="oldstaff_products_promos_text_font[]" <?php if ($StaffProductsPromosSettings->use_generic) { ?> disabled <?php } ?>>
                                  <?php if (count($font_family) > 0) { ?>
                                    <?php foreach ($font_family as $singlef) { ?>
                                      <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>" <?= (isset($single->text_font) && $single->text_font == $singlef->id) ? 'selected' : ''; ?>><?= $singlef->name ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                              <div class="form-group">
                                <label>Number of Stars/Ratig</label><br>
                                <select class="myinput2 width-60px" name="oldstaff_products_promos_stars[]">
                                  <?php

                                  if (count($stars) > 0) { ?>
                                    <?php foreach ($stars as $star) { ?>
                                      <option value="<?= $star ?>" <?= (isset($single->stars) && $single->stars == $star) ? 'selected' : ''; ?>><?= $star ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3 col-xs-8">
                              <div class="form-group">
                                <label>Star color</label>
                                <input type="color" class="myinput2" name="oldstaff_products_promos_text_star_color[]" <?php if ($StaffProductsPromosSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->star_color ?>">
                              </div>
                            </div>
                          <?php
                          } ?>
                          <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_delete'])) { ?>
                            <div class="col-md-3 col-xs-4">
                              <br>
                              <button type="button" class="btn btn-primary btnremovestaffproductspromos" data-staff_products_promos_id="<?= $single->id ?>">Delete Staff Products Promos</button>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                      <br>
                      <div class="col-md-12"><br /></div>
                      <div class="col-md-12">
                        <div class="content3">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="grey-div d-flex justify-content-between align-items-center editbtn3">
                                <div class="title-2"> Action Buttons Settings</div>
                                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                              </div>
                            </div>
                          </div>
                          <div class="editcontent3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="bannertext">Left Side Action button active</label><br>
                                      <label class="switch">
                                        <input type="checkbox" class="notificationswitch" name="left_action_button_active[{{$i}}]" <?= isset($single->left_action_button_active) && $single->left_action_button_active ? 'checked' : '' ?>>
                                        <span class="slider round"></span>
                                      </label>
                                    </div>
                                  </div>
                                  <br>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="action_button_discription">Action Button Name</label>
                                      <input type="text" class="myinput2" name="left_action_button_name[]" id="left_action_button_name" value="<?= isset($single->left_action_button_name) && $single->left_action_button_name ?  $single->left_action_button_name : '' ?>" placeholder="Type here...">
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="action_button_text_color">Action Button Text Color</label>
                                      <input type="color" class="myinput2" name="left_action_button_text_color[]" id="left_action_button_text_color" value="<?= isset($single->left_action_button_text_color) &&  $single->left_action_button_text_color ? $single->left_action_button_text_color : '' ?>" placeholder="#ffffff">
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="action_button_bg_color">Action Button Color</label>
                                      <input type="color" class="myinput2" name="left_action_button_bg_color[]" id="left_action_button_bg_color" value="<?= isset($single->left_action_button_bg_color) && $single->left_action_button_bg_color ? $single->left_action_button_bg_color : '' ?>" placeholder="#000000">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="action_button_link">Action Button Application</label>
                                      <select class="myinput2 news_post_action_button action_button_selection" id="left_action_button_link" name="left_action_button_link[]">
                                        <option value="link">Link</option>
                                        <option value="call" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                        <option value="sms" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                                        <option value="email" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                        <option value="video" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                                        <option value="google_map" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                        <option value="text_popup" <?= isset($single->left_action_button_link) && $single->left_action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                        <option value="address" <?= isset($single->left_action_button_link) && $single->left_action_button_link == "address" ? 'selected' : '' ?>>Address</option>
                                        <option value="audioiconfeature" <?= isset($single->left_action_button_link) && $single->left_action_button_link == "audioiconfeature" ? 'selected' : '' ?>>Audio Icon Feature</option>
                                        <option value="customforms" <?= isset($single->left_action_button_link) && $single->left_action_button_link ==  "customforms" ? 'selected' : '' ?>>Forms</option>
                                        <?php foreach ($front_sections as $single2) { ?>
                                          <option value="<?= $single2->slug ?>" <?= isset($single->left_action_button_link) && $single->left_action_button_link == $single2->slug ? 'selected' : '' ?>><?= $single2->name ?></option>
                                        <?php } ?>
                                      </select>
                                      <div class="form-group action_fields phone_no_calls" style="<?= $single->left_action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Phone number for calls</label>
                                        <input type="text" class="myinput2" name="left_action_button_phone_no_calls[]" value="<?= $single->left_action_button_phone_no_calls ?>">
                                      </div>
                                      <div class="form-group action_fields phone_no_sms" style="<?= $single->left_action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Phone number for sms</label>
                                        <input type="text" class="myinput2" name="left_action_button_phone_no_sms[]" value="<?= $single->left_action_button_phone_no_sms ?>">
                                      </div>
                                      <div class="form-group action_fields action_email" style="<?= $single->left_action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Email</label>
                                        <input type="text" class="myinput2" name="left_action_button_action_email[]" value="<?= $single->left_action_button_action_email ?>">
                                      </div>
                                      <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $single->left_action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                        <label>Popup Text </label>
                                        <textarea class="myinput2 editordata hidden" name="left_action_button_textpopup[]"><?php echo $single->left_action_button_textpopup; ?></textarea>
                                        <div class="quilleditor">
                                          <?php echo $single->left_action_button_textpopup; ?>
                                        </div>
                                      </div>
                                      <div class="form-group action_fields action_link" style="<?= $single->left_action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                        <input type="text" class="myinput2 news_post_link" name="left_action_button_link_text[]" id="news_post_link" value="<?= isset($single->left_action_button_link_text) && $single->left_action_button_link_text ? $single->left_action_button_link_text : '' ?>" placeholder="http://google.com">
                                      </div>
                                      <div class="form-group action_fields audio_upload" name="left_feature_action_audio" style="<?= $single->left_action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                        <label for="customFile">Select File</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="left_audio_file[]" id="customFile" accept=".mp3">
                                          <label class="custom-file-label" for="customFile">Select File</label>
                                        </div>
                                      </div>
                                      <div class="form-group action_fields audio_icon_feature" name="left_audio_icon_feature" style="<?= $single->left_action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                        <label for="customFile">Select File</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="left_audio_icon_file[]" id="customFile" accept=".mp3">
                                          <label class="custom-file-label" for="customFile">Select File</label>
                                        </div>
                                      </div>

                                      <div class="row">
                                        <?php if ($single->left_action_button_link == 'audioiconfeature' && $single->left_audio_icon_file) {

                                        ?>
                                          <div class="col-md-10 imgdiv">
                                            <h4><?= $single->left_audio_icon_file ?></h4>
                                            <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="review_post_left" data-id="<?= $single->id ?>" data-imgname="<?= $single->left_audio_icon_file ?>">X</button>
                                          </div>
                                        <?php


                                        } ?>
                                      </div>
                                      <div class="form-group action_fields video_upload" name="feature_action_video" style="<?= $single->left_action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                        <label for="customFile">Upload Video</label>

                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="left_video_file[]" id="customFile" accept=".mp4">
                                          <label class="custom-file-label" for="customFile">Upload Video</label>
                                        </div>
                                        @if(isset($single->left_action_button_video) && $single->left_action_button_video !='')
                                        <div class=" position-relative d-flex review_left_action_button_video_{{$single->id}}">
                                          <video height="80" controls>
                                            <source src="<?= isset($single->left_action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($single->left_action_button_video)) : '' ?>" type="video/mp4">
                                          </video>
                                          <div class="remove_video_action btn btn-primary  " onclick="delete_front_image('<?= $single->left_action_button_video ?>','image','review_left_action_button_video_{{$single->id}}','custom_forms',1)" title="Click to Remove" data-type='review_left_action_button_video' data-id="{{$single->id}}" data-file="{{$single->left_action_button_video}}">X
                                          </div>
                                        </div>

                                        @endif
                                      </div>
                                      <div class="form-group action_fields action_forms" style="<?= $single->left_action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                        <select class="myinput2" name="left_action_button_customform[]" id="customforms">
                                          <?php if (count($customForms) > 0) { ?>
                                            <?php foreach ($customForms as $singlecf) { ?>
                                              <option value="<?= $singlecf->id ?>" <?= isset($single->left_action_button_customform) && $single->left_action_button_customform == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                            <?php } ?>
                                          <?php } ?>
                                        </select>
                                      </div>
                                      <div class="form-group action_fields action_address" style="display:<?= isset($single->left_action_button_link) &&  $single->left_action_button_link  == "address"  ? 'block' : 'none' ?>">
                                        <label for="addressbtn1">Select an Address</label>
                                        <select name="left_action_button_address_id[]" class="myinput2">
                                          <?php
                                          foreach ($addresses as $address) {
                                          ?>
                                            <option value="<?= $address->id ?>" <?= isset($single->left_action_button_address_id) && $single->left_action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?>
                                      </div>
                                    <?php
                                          }
                                    ?>
                                    </select>
                                    </div>
                                    <div class="form-group action_fields action_map" style="<?= $single->left_action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                      <label for="address">Enter Address</label>
                                      <input type="text" class="myinput2 " name="left_action_button_map_address[]" value="<?= isset($single->left_action_button_map_address) && $single->left_action_button_map_address ? $single->left_action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12"><br /></div>
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="bannertext">Right Side Action button active</label><br>
                                    <label class="switch">
                                      <input type="checkbox" class="notificationswitch" name="right_action_button_active[{{$i}}]" <?= isset($single->right_action_button_active) && $single->right_action_button_active ? 'checked' : '' ?>>
                                      <span class="slider round"></span>
                                    </label>
                                  </div>
                                </div>
                                <br>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="right_action_button_name">Action Button Name</label>
                                    <input type="text" class="myinput2" name="right_action_button_name[]" id="right_action_button_name" value="<?= isset($single->right_action_button_name) && $single->right_action_button_name ?  $single->right_action_button_name : '' ?>" placeholder="Type here...">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="right_action_button_text_color">Action Button Text Color</label>
                                    <input type="color" class="myinput2" name="right_action_button_text_color[]" id="right_action_button_text_color" value="<?= isset($single->right_action_button_text_color) &&  $single->right_action_button_text_color ? $single->right_action_button_text_color : '' ?>" placeholder="#ffffff">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                    <label for="right_action_button_bg_color">Action Button Color</label>
                                    <input type="color" class="myinput2" name="right_action_button_bg_color[]" id="right_action_button_bg_color" value="<?= isset($single->right_action_button_bg_color) && $single->right_action_button_bg_color ? $single->right_action_button_bg_color : '' ?>" placeholder="#000000">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="right_action_button_link">Action Button Application</label>
                                    <select class="myinput2 news_post_action_button action_button_selection" id="right_action_button_link" name="right_action_button_link[]">
                                      <option value="link">Link</option>
                                      <option value="call" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                      <option value="sms" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                                      <option value="email" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                      <option value="video" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                                      <option value="text_popup" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                      <option value="google_map" <?= isset($single->right_action_button_link) && $single->right_action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                      <option value="address" <?= isset($single->right_action_button_link) && $single->right_action_button_link == "address" ? 'selected' : '' ?>>Address</option>
                                      <option value="audioiconfeature" <?= isset($single->right_action_button_link) && $single->right_action_button_link == "audioiconfeature" ? 'selected' : '' ?>>Audio Icon Feature</option>
                                      <option value="customforms" <?= isset($single->right_action_button_link) && $single->right_action_button_link ==  "customforms" ? 'selected' : '' ?>>Forms</option>
                                      <?php foreach ($front_sections as $single2) { ?>
                                        <option value="<?= $single2->slug ?>" <?= isset($single->right_action_button_link) && $single->right_action_button_link == $single2->slug ? 'selected' : '' ?>><?= $single2->name ?></option>
                                      <?php } ?>
                                    </select>
                                    <div class="form-group action_fields phone_no_calls" style="<?= $single->right_action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                      <label for="">Phone number for calls</label>
                                      <input type="text" class="myinput2" name="right_action_button_phone_no_calls[]" value="<?= $single->right_action_button_phone_no_calls ?>">
                                    </div>
                                    <div class="form-group action_fields phone_no_sms" style="<?= $single->right_action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                      <label for="">Phone number for sms</label>
                                      <input type="text" class="myinput2" name="right_action_button_phone_no_sms[]" value="<?= $single->right_action_button_phone_no_sms ?>">
                                    </div>
                                    <div class="form-group action_fields action_email" style="<?= $single->right_action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                      <label for="">Email</label>
                                      <input type="text" class="myinput2" name="right_action_button_action_email[]" value="<?= $single->right_action_button_action_email ?>">
                                    </div>
                                    <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $single->right_action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                      <label>Popup Text </label>
                                      <textarea class="myinput2 editordata hidden" name="right_action_button_textpopup[]"><?php echo $single->right_action_button_textpopup; ?></textarea>
                                      <div class="quilleditor">
                                        <?php echo $single->right_action_button_textpopup; ?>
                                      </div>
                                    </div>
                                    <div class="form-group action_fields action_link" style="<?= $single->right_action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                      <input type="text" class="myinput2 news_post_link" name="right_action_button_link_text[]" id="news_post_link" value="<?= isset($single->right_action_button_link_text) && $single->right_action_button_link_text ? $single->right_action_button_link_text : '' ?>" placeholder="http://google.com">
                                    </div>
                                    <div class="form-group action_fields audio_upload" name="right_feature_action_audio" style="<?= $single->right_action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                      <label for="customFile">Select File</label>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="right_audio_file[]" id="customFile" accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                      </div>
                                    </div>
                                    <div class="form-group action_fields audio_icon_feature" name="right_audio_icon_feature" style="<?= $single->right_action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                      <label for="customFile">Select File</label>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="right_audio_icon_file[]" id="customFile" accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <?php if ($single->right_action_button_link == 'audioiconfeature' && $single->right_audio_icon_file) {

                                      ?>
                                        <div class="col-md-10 imgdiv">
                                          <h4><?= $single->right_audio_icon_file ?></h4>
                                          <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="review_post_right" data-id="<?= $single->id ?>" data-imgname="<?= $single->right_audio_icon_file ?>">X</button>
                                        </div>
                                      <?php


                                      } ?>
                                    </div>
                                    <div class="form-group action_fields video_upload" name="feature_action_video" style="<?= $single->right_action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                      <label for="customFile">Upload Video</label>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="right_video_file[]" id="customFile" accept=".mp4">
                                        <label class="custom-file-label" for="customFile">Upload Video</label>
                                      </div>
                                      @if(isset($single->right_action_button_video) && $single->right_action_button_video !='')
                                      <div class=" position-relative d-flex review_right_action_button_video_{{$single->id}}">
                                        <video height="80" controls>
                                          <source src="<?= isset($single->right_action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($single->right_action_button_video)) : '' ?>" type="video/mp4">
                                        </video>
                                        <a class="remove_video_action btn btn-primary" href="<?php echo base_url('deletereviewvideo/' . $single->id . '/?type=right'); ?>" onclick="return confirm('Are You Sure?');" title="Click to Remove" data-type='review_right_action_button_video' data-id="{{$single->id}}" data-file="{{$single->right_action_button_video}}">X
                                        </a>
                                      </div>
                                      @endif
                                    </div>
                                    <div class="form-group action_fields action_forms" style="<?= $single->right_action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                      <select class="myinput2" name="right_action_button_customform[]" id="customforms">
                                        <?php if (count($customForms) > 0) { ?>
                                          <?php foreach ($customForms as $singlecf) { ?>
                                            <option value="<?= $singlecf->id ?>" <?= isset($single->right_action_button_customform) && $single->right_action_button_customform == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                          <?php } ?>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="form-group action_fields action_address" style="display:<?= isset($single->right_action_button_link) &&  $single->right_action_button_link  == "address"  ? 'block' : 'none' ?>">
                                      <label for="addressbtn1">Select an Address</label>
                                      <select name="right_action_button_address_id[]" class="myinput2">
                                        <?php
                                        foreach ($addresses as $address) {
                                        ?>
                                          <option value="<?= $address->id ?>" <?= isset($single->action_button_address_id) && $single->action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?>
                                    </div>
                                  <?php
                                        }
                                  ?>
                                  </select>
                                  </div>
                                  <div class="form-group action_fields action_map" style="<?= $single->right_action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="right_action_button_map_address[]" value="<?= isset($single->right_action_button_map_address) && $single->right_action_button_map_address ? $single->right_action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              <hr style="border-top: 5px solid rgba(0,0,0,.1)">
            </div>
          <?php
                    $i++;
                  }  ?>
        <?php }  ?>
        <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_add_new'])) { ?>
          <div class="row">
            <div class="col-md-3">
              <div class="uploadImageDiv">
                <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                <input type="hidden" name="imagefromgallery[]" class="imagefromgallery">
                <input class="dataimage" type="hidden" name="userfile[]">

                <div class="col-md-6 imgdiv" style="display:none">
                  <br>
                  <img src='' width="100%" class="imagefromgallerysrc">
                  <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Text</label>
                <textarea class="myinput2" name="staff_products_promos_text[]" id="" cols="30" rows="4"></textarea>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Text size</label><br>
                <input type="text" class="myinput2 width-50px" name="staff_products_promos_text_size[]" placeholder="16">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Text color</label>
                <input type="color" class="myinput2" name="staff_products_promos_text_color[]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Text Font</label>
                <select class="myinput2" name="staff_products_promos_text_font[]">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $singlef) { ?>
                      <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Stars</label>
                <select class="myinput2" name="staff_products_promos_stars[]">
                  <?php if (count($stars) > 0) { ?>
                    <?php foreach ($stars as $star) { ?>
                      <option value="<?= $star ?>"><?= $star ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Star color</label>
                <input type="color" class="myinput2" name="staff_products_promos_text_star_color[]" value="#FFFF00">
              </div>
            </div>
          </div>
          <div class="col-md-12"><br /></div>
          <div class="col-md-12">
            <div class="content3">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn3">
                    <div class="title-2"> Action Buttons Settings</div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent3">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="bannertext">Left Side Action button active</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="left_action_button_active[]">
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                      <br>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_discription">Action Button Name</label>
                          <input type="text" class="myinput2" name="left_action_button_name[]" id="left_action_button_name" value="" placeholder="Type here...">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="action_button_text_color">Action Button Text Color</label>
                          <input type="color" class="myinput2" name="left_action_button_text_color[]" id="left_action_button_text_color" value="" placeholder="#ffffff">
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="action_button_bg_color">Action Button Color</label>
                          <input type="color" class="myinput2" name="left_action_button_bg_color[]" id="left_action_button_bg_color" value="" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_link">Action Button Application</label>
                          <select class="myinput2 news_post_action_button action_button_selection" id="left_action_button_link" name="left_action_button_link[]">
                            <option value="link">Link</option>
                            <option value="call">Call</option>
                            <option value="sms">SMS</option>
                            <option value="email">Email</option>
                            <option value="video">Video</option>
                            <option value="google_map">Map</option>
                            <option value="text_popup">Text Popup</option>
                            <option value="audioiconfeature">Audio Icon Feature</option>
                            <option value="address">Address</option>
                            <option value="customforms">Forms</option>
                            <?php foreach ($front_sections as $single2) { ?>
                              <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
                            <?php } ?>
                          </select>
                          <div class="form-group action_fields phone_no_calls" style="display:none">
                            <label for="">Phone number for calls</label>
                            <input type="text" class="myinput2" name="left_action_button_phone_no_calls[]" value="">
                          </div>
                          <div class="form-group action_fields phone_no_sms" style="display:none">
                            <label for="">Phone number for sms</label>
                            <input type="text" class="myinput2" name="left_action_button_phone_no_sms[]" value="">
                          </div>
                          <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                            <label>Popup Text </label>
                            <textarea class="myinput2 editordata hidden" name="left_action_button_textpopup[]"></textarea>
                            <div class="quilleditor"></div>
                          </div>
                          <div class="form-group action_fields action_email" style="display:none">
                            <label for="">Email</label>
                            <input type="text" class="myinput2" name="left_action_button_action_email[]" value="">
                          </div>
                          <div class="form-group action_fields action_link" style="display:none">
                            <input type="text" class="myinput2 news_post_link" name="left_action_button_link_text[]" id="news_post_link" value="" placeholder="http://google.com">
                          </div>
                          <div class="form-group action_fields audio_upload" name="left_feature_action_audio" style="display:none">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="left_audio_file[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="form-group action_fields audio_icon_feature" name="left_audio_icon_feature" style="display:none">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="left_audio_icon_file[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                            <label for="customFile">Upload Video</label>

                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="left_video_file[]" id="customFile" accept=".mp4">
                              <label class="custom-file-label" for="customFile">Upload Video</label>
                            </div>
                          </div>
                          <div class="form-group action_fields action_forms" style="display:none">
                            <select class="myinput2" name="left_action_button_customform[]" id="customforms">
                              <?php if (count($customForms) > 0) { ?>
                                <?php foreach ($customForms as $singlecf) { ?>
                                  <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group action_fields action_address" style="display:none">
                            <label for="addressbtn1">Select an Address</label>
                            <select name="left_action_button_address_id[]" class="myinput2">
                              <?php
                              foreach ($addresses as $address) {
                              ?>
                                <option value="<?= $address->id ?>"><?= $address->address_title ?>
                          </div>
                        <?php
                              }
                        ?>
                        </select>
                        </div>
                        <div class="form-group action_fields action_map" style="display:none">
                          <label for="address">Enter Address</label>
                          <input type="text" class="myinput2 " name="left_action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12"><br /></div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="bannertext">Right Side Action button active</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch" name="right_action_button_active[]">
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    <br>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="right_action_button_name">Action Button Name</label>
                        <input type="text" class="myinput2" name="right_action_button_name[]" id="right_action_button_name" value="" placeholder="Type here...">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="right_action_button_text_color">Action Button Text Color</label>
                        <input type="color" class="myinput2" name="right_action_button_text_color[]" id="right_action_button_text_color" value="" placeholder="#ffffff">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="right_action_button_bg_color">Action Button Color</label>
                        <input type="color" class="myinput2" name="right_action_button_bg_color[]" id="right_action_button_bg_color" value="" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="right_action_button_link">Action Button Application</label>
                        <select class="myinput2 news_post_action_button action_button_selection" id="right_action_button_link" name="right_action_button_link[]">
                          <option value="link">Link</option>
                          <option value="call">Call</option>
                          <option value="sms">SMS</option>
                          <option value="email">Email</option>
                          <option value="video">Video</option>
                          <option value="audioiconfeature">Audio Icon Feature</option>
                          <option value="google_map">Map</option>
                          <option value="text_popup">Text Popup</option>
                          <option value="address">Address</option>
                          <option value="customforms">Forms</option>
                          <?php foreach ($front_sections as $single2) { ?>
                            <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
                          <?php } ?>
                        </select>
                        <div class="form-group action_fields phone_no_calls" style="display:none">
                          <label for="">Phone number for calls</label>
                          <input type="text" class="myinput2" name="right_action_button_phone_no_calls[]" value="">
                        </div>
                        <div class="form-group action_fields phone_no_sms" style="display:none">
                          <label for="">Phone number for sms</label>
                          <input type="text" class="myinput2" name="right_action_button_phone_no_sms[]" value="">
                        </div>
                        <div class="form-group action_fields action_email" style="display:none">
                          <label for="">Email</label>
                          <input type="text" class="myinput2" name="right_action_button_action_email[]" value="">
                        </div>
                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                          <label>Popup Text </label>
                          <textarea class="myinput2 editordata hidden" name="right_action_button_textpopup[]"></textarea>
                          <div class="quilleditor"></div>
                        </div>
                        <div class="form-group action_fields action_link" style="display:none">
                          <input type="text" class="myinput2 news_post_link" name="right_action_button_link_text[]" id="news_post_link" value="" placeholder="http://google.com">
                        </div>
                        <div class="form-group action_fields audio_upload" name="right_feature_action_audio" style="display:none">
                          <label for="customFile">Select File</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="right_audio_file[]" id="customFile" accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                          </div>
                        </div>
                        <div class="form-group action_fields audio_icon_feature" name="right_audio_icon_feature" style="display:none">
                          <label for="customFile">Select File</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="right_audio_icon_file[]" id="customFile" accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                          </div>
                        </div>
                        <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                          <label for="customFile">Upload Video</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="right_video_file[]" id="customFile" accept=".mp4">
                            <label class="custom-file-label" for="customFile">Upload Video</label>
                          </div>

                        </div>
                        <div class="form-group action_fields action_forms" style="display:none">
                          <select class="myinput2" name="right_action_button_customform[]" id="customforms">
                            <?php if (count($customForms) > 0) { ?>
                              <?php foreach ($customForms as $singlecf) { ?>
                                <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group action_fields action_address" style="display:none">
                          <label for="addressbtn1">Select an Address</label>
                          <select name="right_action_button_address_id[]" class="myinput2">
                            <?php
                            foreach ($addresses as $address) {
                            ?>
                              <option value="<?= $address->id ?>"><?= $address->address_title ?>
                        </div>
                      <?php
                            }
                      ?>
                      </select>
                      </div>
                      <div class="form-group action_fields action_map" style="display:none">
                        <label for="address">Enter Address</label>
                        <input type="text" class="myinput2 " name="right_action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12">
        <button type="button" class="btn btn-primary" onclick="add_staff_product_div()">
          + Add More</button>
      </div>
    </div>
  <?php }  ?>
  </div>
  </div>
<?php } ?>
</div>
<div class="row form-bottom make-sticky">
  <div class="col-md-12">
    <button type="submit" name="savestaffproductspromos" class="btn btn-primary" value="save">Save</button>
    <button type="submit" name="savestaffproductspromos" class="btn btn-primary" value="savereminders">Save & send reminder</button>
  </div>
</div>
</form>
</div>
</div>
<?php } ?>

<?php if (check_auth_permission(['faqs', 'question_input', 'answer_input', 'faq_add_new'])) { ?>

  <div class="contentdiv">
    <div class="btnedit openEditContent" id="faqs_bluebar" data-tip_section="faqs">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">FAQs</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('faqsection'))
          <div class="enable-disable-feature-div">
            <div class="title-4-400 text-color-green">Enabled</div>
          </div>
          @else
          <div class="enable-disable-feature-div">
            <div class="title-4-400 text-color-red2">Disabled</div>
          </div>
          @endif
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'faqs_bluebar' ? 'display:block;' : '' ?>">
      <?php if (check_auth_permission('faqs')) { ?>
        <form action="{{url('updatefaq')}}" method="post" enctype="multipart/form-data">
          @csrf
          <?php if (check_auth_permission(['build_site_Content'])) { ?>
            <div class="row mb-17">
              <?php $faq_outline = get_outline_settings('faq_outline'); ?>
              <div class="col-md-3">
                <div class="form-group d-flex">
                  <label>Override Background <br>Color in Settings, Theme</label>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch override_bg_enable override_bg generic_faq_background_color" name="override_bg" data-slug="generic_faq_background_color" <?php echo  $faqSettings->override_bg ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="generic_faq_background_color" style="display:<?= $faqSettings->override_bg ? 'block' : 'none' ?>;">
                  <div class="form-group width-fit-content">
                    <label>Feature's Background Color</label>
                    <input type="color" class="myinput2" name="generic_faq_background_color" value="<?php echo $faqSettings->background_color; ?>" placeholder="#000000">
                  </div>
                </div>
              </div>
              <div class="row form-bottom make-sticky">
                <div class="col-md-12">
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="save">Save</button>
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                </div>
              </div>
              <div class="col-md-6 text-right">
                <div class="mr-6vi">
                  <label class="title-5 text-black">Tutorial Website Controls</label>
                </div>
                <div class="align-all-right d-flex align-items-end">
                  <div class="form-group  d-flex align-items-center">
                    <div for="" class="title-9 text-black">Turn On Outline</div>
                    <label class="switch ml-7">
                      <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="faq_outline" <?php echo  $faq_outline->time != null ? 'checked' : ''; ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="form-group ml-34">
                    <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                    <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $faq_outline->outline_color ?>" placeholder="#000000" data-slug="faq_outline">
                  </div>
                </div>
              </div>
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                  <div class="d-flex align-items-center titlediv d-flex">
                    <div class="title-2">Background Color </div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group width-fit-content">
                    <label>Individual FAQ Background Color</label>
                    <input type="color" class="myinput2" name="faq_individual_background_color" value="<?php echo $faqSettings->individual_background_color; ?>" placeholder="#000000">
                  </div>
                </div>

              </div>

              <div class="row form-bottom make-sticky">
                <div class="col-md-12">
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="save">Save</button>
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                </div>
              </div>
            </div>
          </div>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                  <div class="d-flex align-items-center titlediv d-flex">
                    <div class="title-2">Generic Settings</div>
                    <div class="form-group  switchoverhead2">
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="faqSettings" name="use_generic_faq_setting" <?= $faqSettings->use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>

              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Question Font</label>
                    <select class="myinput2" name="generic_faq_question_font_family">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_faq_question->fontfamily == $single->id ? 'selected' : ''; ?>>
                            <?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Question Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="generic_faq_question_font_size" value="<?php echo $generic_faq_question->size_web; ?>" placeholder="16px">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Question Text Color</label>
                    <input type="color" class="myinput2" name="generic_faq_question_color" value="<?php echo $generic_faq_question->color; ?>" placeholder="#000000">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Answer Font</label>
                    <select class="myinput2" name="generic_faq_answer_font_family">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_faq_answer->fontfamily == $single->id ? 'selected' : ''; ?>>
                            <?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Answer Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="generic_faq_answer_font_size" value="<?php echo $generic_faq_answer->size_web; ?>" placeholder="16px">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Answer Text Color</label>
                    <input type="color" class="myinput2" name="generic_faq_answer_color" value="<?php echo $generic_faq_answer->color; ?>" placeholder="#000000">
                  </div>
                </div>
              </div>

              <div class="row form-bottom make-sticky">
                <div class="col-md-12">
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="save">Save</button>
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if (check_auth_permission(['question_input', 'answer_input', 'faq_add_new'])) { ?>

          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="title-2">Individual Settings</div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="faqdiv">
                <?php if (count($faqs) > 0) { ?>
                  <?php foreach ($faqs as $single) { ?>
                    <div class="singlefadiv">
                      <input type="hidden" name="faq_id[]" value="<?= $single->id ?>">
                      <div class="row">
                        <?php if (check_auth_permission(['question_input'])) { ?>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Question</label>
                              <textarea class="myinput2" name="old_faq_question[]" cols="30" rows="3"><?= $single->question_text ?></textarea>
                            </div>
                          </div>
                        <?php } else { ?>
                          <input type="hidden" name="old_faq_question[]" value="<?= $single->question_text ?>">
                        <?php } ?>
                        <?php if (check_auth_permission(['question_input'])) { ?>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Question Text Size</label><br>
                              <input type="text" class="myinput2 width-50px" name="old_faq_question_font_size[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="<?= ($single->question_font_size) ? $single->question_font_size : '18' ?>" placeholder="fa fa-facebook">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Question Text Color</label>
                              <input type="color" class="myinput2" name="old_faq_question_text_color[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="<?= isset($single->question_text_color) ? $single->question_text_color : '#000' ?>" placeholder="#000">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Question Font</label>
                              <select class="myinput2" name="old_faq_question_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
                                <?php if (count($font_family) > 0) { ?>
                                  <?php foreach ($font_family as $singlef) { ?>
                                    <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>" <?= $single->question_font_family == $singlef->id ? 'selected' : ''; ?>><?= $singlef->name ?></option>
                                  <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        <?php } else {
                        ?>
                          <input type="hidden" name="old_faq_question_font_size[]" value="<?= $single->question_font_size ?>">
                          <input type="hidden" name="old_faq_question_text_color[]" value="<?= $single->question_text_color ?>">
                          <input type="hidden" name="old_faq_question_font_family[]" value="<?= $single->question_font_family ?>">
                        <?php
                        } ?>
                        <?php if (check_auth_permission('faqs')) { ?>
                          <div class="col-md-2">
                            <br>
                            <button type="button" class="btn btn-primary btnremovefaq" data-faqid="<?= $single->id ?>">X</button>
                          </div>
                        <?php } ?>
                        <?php if (check_auth_permission(['answer_input'])) { ?>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Answer</label>
                              <textarea class="myinput2" name="old_faq_answer[]" id="" cols="30" rows="3"><?= $single->answer_text ?></textarea>
                            </div>
                          </div>
                        <?php } else {
                        ?>
                          <input type="hidden" name="old_faq_answer[]" value="<?= $single->answer_text ?>">
                        <?php
                        }  ?>
                        <?php if (check_auth_permission(['answer_input'])) { ?>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Answer Text Size</label><br>
                              <input type="text" class="myinput2 width-50px" name="old_faq_answer_font_size[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="<?= ($single->answer_font_size) ? $single->answer_font_size : '18' ?>" placeholder="">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Answer Text Color</label>
                              <input type="color" class="myinput2" name="old_faq_answer_text_color[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="<?= isset($single->answer_text_color) ? $single->answer_text_color : '#000' ?>" placeholder="#000">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Answer Font</label>
                              <select class="myinput2" name="old_faq_answer_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
                                <?php if (count($font_family) > 0) { ?>
                                  <?php foreach ($font_family as $singlef) { ?>
                                    <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>" <?= $single->answer_font_family == $singlef->id ? 'selected' : ''; ?>><?= $singlef->name ?></option>
                                  <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        <?php } else {
                        ?>
                          <input type="hidden" name="old_faq_answer_font_size[]" value="<?= $single->answer_font_size ?>">
                          <input type="hidden" name="old_faq_answer_text_color[]" value="<?= $single->answer_text_color ?>">
                          <input type="hidden" name="old_faq_answer_font_family[]" value="<?= $single->answer_font_family ?>">
                          <input type="hidden" name="old_faq_background_color[]" value="<?= $single->faq_background_color ?>">
                        <?php
                        } ?>
                      </div>
                      <hr style="border-top: 5px solid rgba(0,0,0,.1)">
                    </div>
                  <?php }  ?>
                <?php } else {  ?>
                  <?php if (check_auth_permission(['faq_add_new'])) { ?>
                    <div class="row">
                      <?php if (check_auth_permission(['question_input'])) { ?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Question</label>
                            <textarea class="myinput2" name="faq_question[]" cols="30" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Question Text Size</label><br>
                            <input type="text" class="myinput2 width-50px" name="faq_question_font_size[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Question Text Color</label>
                            <input type="text" class="myinput2" name="faq_question_text_color[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Question Font</label>
                            <select class="myinput2" name="faq_question_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singlef) { ?>
                                  <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if (check_auth_permission(['answer_input'])) { ?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Answer</label>
                            <textarea class="myinput2" name="faq_answer[]" id="" cols="30" rows="3"></textarea>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Answer Text Size</label><br>
                            <input type="text" class="myinput2 width-50px" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_answer_font_size[]" value="" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Answer Text Color</label>
                            <input type="text" class="myinput2" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_answer_text_color[]" value="" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Answer Font</label>
                            <select class="myinput2" name="faq_answer_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singlef) { ?>
                                  <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  <?php }  ?>
                <?php }  ?>
              </div>
              <?php if (check_auth_permission(['faq_add_new'])) { ?>
                <div class="row">
                  <div class="col-md-2">
                    <button type="button" class="btn btn-primary btnaddnew">Add New</button>
                  </div>
                </div>
              <?php }  ?>
              <div class="row form-bottom make-sticky">
                <div class="col-md-12">
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="save">Save</button>
                  <button type="submit" name="savefaqs" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </form>
    </div>
  </div>


<?php } ?>

<?php if (check_auth_permission(['hyperlinks', 'hyperlink_image', 'hyperlink_text', 'hyperlink_link_option', 'hyperlink_add_new', 'hyperlink_timed_image'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="hyperlinks_bluebar" data-tip_section="hyperlinks">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Hyperlinks</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('linkssection'))
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

    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'hyperlinks_bluebar' ? 'display:block;' : '' ?>">
      <form action="{{url('updatehyperlinks')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-17">
          <div class="col-md-3">
            <div class="form-group  d-flex">
              <label>Override Background <br>Color in Settings, Theme</label>
              <label class="switch ml-7">
                <input type="checkbox" class="notificationswitch override_bg_enable hyperlinks_override_bg" name="hyperlinks_override_bg" data-slug="hyperlinks_bg_picker" <?php echo  $hyperLinksSettings->hyperlinks_override_bg ? 'checked' : '' ?>>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group hyperlinks_bg_picker" style="display:<?php echo  $hyperLinksSettings->hyperlinks_override_bg ? 'block' : 'none' ?>">
              <label>Background color</label>
              <input type="color" class="myinput2" name="links_background_color" value="<?= $hyper_link_text->bg_color ?>" placeholder="">
            </div>
          </div>

          <?php if (check_auth_permission(['build_site_Content'])) { ?>
            <?php $hyperlinks_outline = get_outline_settings('hyperlinks_outline'); ?>
            <div class="col-md-6 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="hyperlinks_outline" <?php echo  $hyperlinks_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $hyperlinks_outline->outline_color ?>" placeholder="#000000" data-slug="hyperlinks_outline">
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="myhr mb-16"></div>
        <?php if (check_auth_permission(['hyperlink_image'])) { ?>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="title-2">Hyperlinks Settings</div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <?php if (check_auth_permission('hyperlinks')) { ?>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group mb-2">
                      <label for="bannertext" class="">Show the URL</label><br>
                      <label class="switch">
                        <input type="checkbox" class="linkswitch" name="linkswitch" <?= $hyperLinksSettings->show_links ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <?php if (check_auth_permission(['hyperlink_image'])) { ?>
                <div class="row">
                  <div class="col-md-4">
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
                  <?php if ($hyperLinksSettings->link_image) {
                    $randimg = rand(9999, 99999999); ?>
                    <div class="col-md-2 imgdiv{{$randimg}}">
                      <img src='<?= base_url('assets/uploads/' . get_current_url() . $hyperLinksSettings->link_image) ?>' width="100%">
                      <button type="button" class="btn btn-primary btn-delete-image" onclick="delete_front_image('<?= $hyperLinksSettings->link_image ?>','link_image','imgdiv{{$randimg}}','hyper_links_settings',{{$hyperLinksSettings->id}})">X</button>
                    </div>
                  <?php } ?>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Link Image Size</label><br>
                      <input type="number" class="myinput2 width-60px" name="link_image_size" value="<?= $hyperLinksSettings->link_image_size ?>" placeholder="e.g 275">
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
        <?php if (check_auth_permission(['hyperlink_timed_image'])) { ?>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center titlediv d-flex">
                    <div class="title-2">Timed Image Settings</div>
                    <div class="form-group  switchoverhead2">
                      <label class="switch m-0">
                        <input type="checkbox" class="notificationswitch timeimagesswitch" name="enable_timed_hyperlink_image" <?= $timed_hyperlink_image->enable ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="timedimagediv">
                <div class="timedimages <?php //echo $timed_hyperlink_image->enable_timed_hyperlink_image ? '' : 'hidden'; 
                                        ?>">
                  <br>
                  <div class="row">
                    <div class="col-md-4">
                      <?php
                      //print_r($timed_hyperlink_image);die();
                      $start_time = new DateTime($timed_hyperlink_image->start_time, new DateTimeZone(getFrontDataTimeZone()));
                      $end_time = new DateTime($timed_hyperlink_image->end_time, new DateTimeZone(getFrontDataTimeZone()));

                      $days = json_decode($timed_hyperlink_image->days, true);
                      ?>
                      <div class="row nopadding datetimediv_hyperlink">
                        <div class="col-md-6 nopadding">
                          <div class="form-group">
                            <label for="timed_hyperlink_image_type">Type</label>
                            <select name="timed_hyperlink_image_type" class="myinput2 timed_image_type" id="timed_hyperlink_image_type">
                              <option value="days" <?= $timed_hyperlink_image->type == 'days' ? 'selected' : '' ?>>By Days</option>
                              <option value="timer" <?= $timed_hyperlink_image->type == 'timer' ? 'selected' : '' ?>>Timer</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 nopadding">
                          <div class="timed_type_divs timer_div" style="<?= $timed_hyperlink_image->type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                            <div class="form-group">
                              <label for="timed_hyperlink_image_timer">Timer</label>
                              <select name="timed_hyperlink_image_timer" class="myinput2" id="timed_hyperlink_image_timer">
                                <option value="15" <?= $timed_hyperlink_image->image_timer == '15' ? 'selected' : '' ?>>15 min</option>
                                <option value="30" <?= $timed_hyperlink_image->image_timer == '30' ? 'selected' : '' ?>>30 min</option>
                                <option value="60" <?= $timed_hyperlink_image->image_timer == '60' ? 'selected' : '' ?>>1 hour</option>

                                <option value="120" <?= $timed_hyperlink_image->image_timer == '120' ? 'selected' : '' ?>>2 hour</option>
                                <option value="240" <?= $timed_hyperlink_image->image_timer == '240' ? 'selected' : '' ?>>4 hour</option>
                                <option value="360" <?= $timed_hyperlink_image->image_timer == '360' ? 'selected' : '' ?>>6 hour</option>
                                <option value="480" <?= $timed_hyperlink_image->image_timer == '480' ? 'selected' : '' ?>>8 hour</option>
                                <option value="720" <?= $timed_hyperlink_image->image_timer == '720' ? 'selected' : '' ?>>12 hour</option>
                                <option value="1440" <?= $timed_hyperlink_image->image_timer == '1440' ? 'selected' : '' ?>>24 hour</option>
                                <option value="2880" <?= $timed_hyperlink_image->image_timer == '2880' ? 'selected' : '' ?>>48 hour</option>
                              </select>
                            </div>
                          </div>
                          <div class="timed_type_divs days_div" style="<?= $timed_hyperlink_image->type == 'days' ? 'display:block;' : 'display:none;' ?>">
                            <div class="form-group">
                              <label for="start_time">Start Time</label>
                              <input type="time" name="hyperlink_image_start_time" class="myinput2" id="date" value="<?php echo $start_time->format('H:i'); ?>">
                            </div>
                            <div class="form-group">
                              <label for="end_time">End Time</label>
                              <input type="time" name="hyperlink_image_end_time" class="myinput2" id="time" value="<?php echo $end_time->format('H:i'); ?>">
                            </div>
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
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="uploadImageDiv">
                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="timed_hyperlink_image">

                        <div class="col-md-6 imgdiv" style="display:none">
                          <br>
                          <img src='' width="100%" class="imagefromgallerysrc">
                          <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                        </div>
                      </div>
                    </div>
                    <?php if ($timed_hyperlink_image_file->file_name) { ?>
                      <div class="col-md-2 timed_hyperlink_image_div">
                        <img src='<?= base_url('assets/uploads/' . get_current_url() . $timed_hyperlink_image_file->file_name) ?>' width="100%">
                        <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_hyperlink_image_file->file_name ?>','timed_hyperlink_image','timed_hyperlink_image_div','images','0','true')">X</button>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if (check_auth_permission(['hyperlink_text', 'hyperlink_link_option'])) { ?>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2">Hyperlinks Text Settings</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Text size</label><br>
                    <input type="text" class="myinput2 width-50px" name="text_size" value="<?= $hyper_link_text->size_web ?>" placeholder="16">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Text color</label>
                    <input type="color" class="myinput2" name="links_text_color" value="<?= $hyper_link_text->color ?>" placeholder="">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title_font_size">Text Font</label>
                    <select class="myinput2" name="link_text_font_family">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $hyper_link_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Link size</label><br>
                    <input type="text" class="myinput2 width-50px" name="link_size" value="<?= $hyper_link_link->size_web ?>" placeholder="16">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Link color</label>
                    <input type="color" class="myinput2" name="link_color" value="<?= $hyper_link_link->color ?>" placeholder="">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title_font_size">Link Font</label>
                    <select class="myinput2" name="link_font_family">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $hyper_link_link->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="sectionlinksdiv">
                <input type="hidden" name="deleteLinkTextID" value="" class="deleteLinkTextID">
                <?php if (count($hyperLinks) > 0) { ?>
                  <?php foreach ($hyperLinks as $single) { ?>
                    <div class="row">
                      <input type="hidden" name="linktextid[]" value="<?= $single->id ?>">
                      <?php if (check_auth_permission(['hyperlink_text'])) { ?>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label>Link text</label>
                            <input type="text" class="myinput2" name="old_linktext[]" value="<?= $single->link_text ?>" placeholder="fa fa-facebook">
                          </div>
                        </div>
                      <?php } else {
                      ?>
                        <input type="hidden" name="old_linktext[]" value="<?= $single->link_text ?>">
                      <?php }  ?>
                      <?php if (check_auth_permission(['hyperlink_link_option'])) { ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Link</label>
                            <input type="text" class="myinput2" name="old_link[]" value="<?= isset($single->link) ? $single->link : '' ?>" placeholder="">
                          </div>
                        </div>
                      <?php } else {
                      ?>
                        <input type="hidden" name="old_link[]" value="<?= isset($single->link) ? $single->link : '' ?>">
                      <?php
                      }  ?>
                      <?php if (check_auth_permission('hyperlink_add_new')) { ?>
                        <div class="col-md-2">
                          <br>
                          <button type="button" class="btn btn-primary btnRemoveHyperLink" data-id="{{$single->id}}">X</button>
                        </div>
                      <?php } ?>
                    </div>
                  <?php }  ?>
                <?php } else {  ?>
                  <?php if (check_auth_permission(['hyperlink_add_new'])) {
                  ?>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Link text</label>
                          <input type="text" class="myinput2" name="linktext[]" value="" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Link</label>
                          <input type="text" class="myinput2" name="link[]" value="" placeholder="">
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
              <?php if (check_auth_permission(['hyperlink_add_new'])) { ?>
                <div class="row">
                  <div class="col-md-2">
                    <button type="button" class="btn btn-primary btnaddnewlinksection">Add New Link</button>
                  </div>
                </div>
              <?php
              } ?>
            </div>
          </div>
        <?php } ?>

        <br>
        <div class="row form-bottom make-sticky">
          <div class="col-md-12">
            <button type="submit" name="savelinksection" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="savelinksection" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
    </div>
  </div>


<?php } ?>

<?php if (check_auth_permission(['formssection'])) { ?>

  <div class="contentdiv">
    <div class="btnedit openEditContent" id="forms_feature" data-tip_section="custom_forms">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Forms Links</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('formssection'))
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

    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'forms_feature' ? 'display:block;' : '' ?>">
      <form class="data-form" action="{{url('updateforms')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-17">
          <div class="col-md-3">
            <div class="form-group  d-flex">
              <label>Override Background <br>Color in Settings, Theme</label>
              <label class="switch ml-7">
                <input type="checkbox" class="notificationswitch override_bg_enable formlinks_override_bg" name="formlinks_override_bg" data-slug="formlinks_bg_picker" <?php echo  $formsSettings->formlinks_override_bg ? 'checked' : '' ?>>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group formlinks_bg_picker" style="display:<?php echo  $formsSettings->formlinks_override_bg ? 'checked' : '' ?>">
              <label>Feature Background Color</label>
              <input type="color" class="myinput2" name="feature_background_color" value="<?= $formsSettings ? $formsSettings->feature_background_color : '' ?>" placeholder="">
            </div>
          </div>
          <?php if (check_auth_permission(['build_site_Content'])) { ?>

            <?php $forms_outline = get_outline_settings('forms_outline'); ?>
            <div class="col-md-6 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="forms_outline" <?php echo  $forms_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $forms_outline->outline_color ?>" placeholder="#000000" data-slug="forms_outline">
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="myhr mb-16"></div>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Form Settings</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <?php $formsectionimage = get_image('form_section_img'); ?>
            <div class="row">
              <div class="col-md-4">
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
              <?php if ($formsectionimage && $formsectionimage->image) { ?>
                <div class="col-md-2 imgdiv">
                  <img src='<?= base_url('assets/uploads/' . get_current_url() . $formsectionimage->image) ?>' width="100%">
                  <button type="button" class="btn btn-primary btnlinkimgdel" data-imgname="<?= $formsectionimage->image ?>">X</button>
                </div>
              <?php } ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Image Size</label><br>
                  <input type="number" class="myinput2 width-60px" name="link_image_size" value="<?= $formsectionimage->max_width ?>" placeholder="e.g 275">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group quilleditor-div">
                  <label>Description</label>
                  <textarea class="myinput2 editordata hidden" id='' name="form_section_desc" placeholder="" rows="5"><?= isset($single->description) ? $single->description : 'defaultt' ?></textarea>
                  <div class="quilleditor">
                    <?= isset($formsSettings->form_section_desc) ? $formsSettings->form_section_desc : "" ?>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description Width</label><br>
                  <input type="text" class="myinput2 width-50px" name="form_section_desc_width" value="<?= $formsSettings->form_section_desc_width ? $formsSettings->form_section_desc_width : '' ?>" placeholder="200">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Text size</label><br>
                  <input type="text" class="myinput2 width-50px" name="text_size" value="<?= $form_section_text ? $form_section_text->size_web : '' ?>" placeholder="16">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Text color</label>
                  <input type="color" class="myinput2" name="links_text_color" value="<?= $form_section_text ? $form_section_text->color : '' ?>" placeholder="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="title_font_size">Text Font</label>
                  <select class="myinput2" name="link_text_font_family">
                    <?php if (count($font_family) > 0) { ?>
                      <?php foreach ($font_family as $single) { ?>
                        <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_section_text && $form_section_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Link Background Color</label>
                  <input type="color" class="myinput2" name="links_background_color" value="<?= $form_section_text ? $form_section_text->bg_color : '' ?>" placeholder="">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="bannertext">2 Column</label><br>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch form_link_column" name="form_link_column" <?= $formsSettings->form_column ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
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
                  <div class="title-2">Form Links</div> <!-- (Hassan) Change name -->
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="sectionformsdiv">
              <?php if (count($formsLinks) > 0) { ?>
                <?php foreach ($formsLinks as $single) { ?>
                  <div class="row">
                    <input type="hidden" name="formlinkid[]" value="<?= $single->id ?>">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Link text</label>
                        <input type="text" class="myinput2" name="old_linktext[]" value="<?= $single->link_text ?>" placeholder="fa fa-facebook">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Forms</label>
                        <select class="myinput2" name="old_linkforms[]">

                          <?php if (count($customForms) > 0) { ?>
                            <?php foreach ($customForms as $singleform) { ?>
                              <option value="<?= $singleform->id ?>" <?= $singleform->id == $single->link_forms ? 'selected' : '' ?>><?= $singleform->title ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <br>
                      <button type="button" class="btn btn-primary btnRemoveFormLink" data-id="<?= $single->id ?>">X</button>
                    </div>
                  </div>
                <?php }  ?>
              <?php } else {  ?>
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Link text</label>
                      <input type="text" class="myinput2" name="linktext[]" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Forms</label>
                      <select class="myinput2" name="linkforms[]">
                        <?php if (count($customForms) > 0) { ?>
                          <?php foreach ($customForms as $single) { ?>
                            <option value="<?= $single->id ?>"><?= $single->title ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-md-2">
                <button type="button" class="btn btn-primary btnaddnewformsection">Add New</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row form-bottom make-sticky">
          <div class="col-md-12">
            <button type="submit" name="saveforms_feature" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="saveforms_feature" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
      <div class="formslink_temp hidden">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Link text</label>
              <input type="text" class="myinput2" name="linktext[]" value="" placeholder="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Forms</label>
              <select class="myinput2" name="linkforms[]">
                <?php if (count($customForms) > 0) { ?>
                  <?php foreach ($customForms as $single) { ?>
                    <option value="<?= $single->id ?>"><?= $single->title ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php } ?>


<?php if (check_auth_permission(['download_files', 'downloads_file_question', 'download_text', 'downloads_add_new'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="download_files_bluebar" data-tip_section="download_files">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Download Files</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('downloadsection'))
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

    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'download_files_bluebar' ? 'display:block;' : '' ?>">
      <form action="{{url('updatedownloadfiles')}}" method="post" enctype="multipart/form-data" id="updateDownloadForm">
        @csrf
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <div class="row mb-17">
            <div class="col-md-3">
              <div class="form-group  d-flex">
                <label>Override Background <br>Color in Settings, Theme</label>
                <label class="switch ml-7">
                  <input type="checkbox" class="notificationswitch override_bg_enable formlinks_override_bg" name="override_bg" data-slug="formlinks_bg_picker" <?php echo  isset($downloads_settings->override_bg) && $downloads_settings->override_bg == '1' ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group formlinks_bg_picker" style="display:<?php echo  isset($downloads_settings->bg_color) ? 'checked' : '' ?>">
                <label>Feature Background Color</label>
                <input type="color" class="myinput2" name="bg_color" value="<?= isset($downloads_settings->bg_color) ? $downloads_settings->bg_color : '' ?>" placeholder="">
              </div>
            </div>
            <?php $download_files_outline = get_outline_settings('download_files_outline'); ?>
            <div class="col-md-6 text-right">

              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="download_files_outline" <?php echo  $download_files_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $download_files_outline->outline_color ?>" placeholder="#000000" data-slug="download_files_outline">
                </div>
              </div>
            </div>
          </div>
          <div class="myhr mb-16"></div>
        <?php } ?>
        <div class="row">
          <?php if (check_auth_permission('downloads_file_question')) { ?>
            <div class="col-md-4">
              <div class="form-group">
                <label>Question Text size</label><br>
                <input type="text" class="myinput2 width-50px" name="question_text_size" value="<?= $download_question_text->size_web ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Question Text color</label>
                <input type="color" class="myinput2" name="question_text_color" value="<?= $download_question_text->color ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">Question Font</label>
                <select class="myinput2" name="question_text_font_family">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $download_question_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          <?php } ?>
          <?php if (check_auth_permission('download_text')) { ?>
            <div class="col-md-4">
              <div class="form-group">
                <label>Download File Text size</label><br>
                <input type="text" class="myinput2 width-50px" name="download_text_size" value="<?= $download_text->size_web ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Download File Text color</label>
                <input type="color" class="myinput2" name="download_text_color" value="<?= $download_text->color ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">Download File Font</label>
                <select class="myinput2" name="download_text_font_family">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $download_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          <?php } ?>
        </div>

        <?php if (count($downloadFiles) > 0) { ?>
          <?php foreach ($downloadFiles as $key => $single) { ?>
            <input type="hidden" name="file_id[]" value="<?= isset($single->id) ? $single->id : '' ?>">
            <div class="row imgdiv">

              <!-- (Hassan) Adding Image to display (Begin) -->
              <?php if (check_auth_permission('download_files')) { ?>
                <div class="col-md-2 mt-auto">
                  <div class="form-group">
                    <img src="<?= base_url('assets/uploads/' . get_current_url() . $single->file) ?>" width="100%">
                  </div>
                </div>
              <?php } ?>
              <!-- Adding Image to display (End) -->


              <?php if (check_auth_permission(['downloads_file_question'])) { ?>
                <div class="col-md-3">
                  <div class="form-group"> <!-- (Hassan) Correct the layout -->
                    <label>Question</label>
                    <textarea class="myinput2" name="file_question[]" placeholder="File Question" cols="30" rows="4"><?= isset($single->file_question) ? $single->file_question : '' ?></textarea>
                  </div>
                </div>
              <?php } else {
              ?>
                <input type="hidden" name="file_question[]" value="<?= isset($single->file_question) ? $single->file_question : '' ?>">
              <?php
              } ?>
              <?php if (check_auth_permission(['download_text'])) { ?>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Download Text</label>
                    <textarea class="myinput2" name="download_text[]" cols="30" rows="4"><?= isset($single->download_text) ? $single->download_text : '' ?></textarea>
                  </div>
                </div>
              <?php } else {
              ?>
                <input type="hidden" name="download_text[]" value="<?= isset($single->download_text) ? $single->download_text : '' ?>">
              <?php
              } ?>

              <!-- (Hassan) Adding image size and position fields (Begin) -->
              <?php if (check_auth_permission('download_files')) { ?>
                <div class="col-md-2">
                  <div>
                    <label>Image Size </label><br>
                    <input type="text" class="myinput2 width-145px" name="edit_image_size[]" value="<?= isset($single->image_size) ? $single->image_size : '' ?>" placeholder="e.g 100px">
                  </div>
                  <div>
                    <label>Image Position </label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="edit_image_position[<?= $key ?>]" id="left" value="left" <?= (isset($single->image_position) && $single->image_position == 'left') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="left">
                        Left
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="edit_image_position[<?= $key ?>]" id="right" value="right" <?= (isset($single->image_position) && $single->image_position == 'right') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="right">
                        Right
                      </label>
                    </div>
                  </div>
                </div>
              <?php }
              ?>
              <!-- Adding image size and position fields (End) -->

              <!-- (Hassan) Modifying input to display image (Begin) -->
              <?php if (check_auth_permission('download_files')) { ?>
                <div class="col-md-1 mt-10px">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary btnfiledel" data-imgname="<?= $single->file ?>">X</button>
                  </div>
                </div>
              <?php } ?>
              <!-- Modifying input to display image (End) -->

            </div>
          <?php } ?>
        <?php } ?>
        <br>
        <?php if (check_auth_permission(['download_files', 'downloads_add_new'])) { ?>
          <div class="row">
            <div class="col-md-12">
              <h5>You can add multiple download files</h5>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="customFile">Select Files</label>
                <div class="custom-file mb-10">
                  <input type="file" class="custom-file-input download-files-add" name="download_files[]" id="customFile" accept="*" onchange="updateFileName(this)">
                  <label class="custom-file-label" for="customFile" id="fileLabel">Select Files</label>
                </div>

                <!-- (Hassan) Adding image size and position fields (Begin) -->
                <div>
                  <div>
                    <label>Image Size </label><br>
                    <input type="number" class="myinput2 width-145px" name="image_size" placeholder="e.g 100px">
                  </div>
                  <div>
                    <label>Image Position </label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="image_position" id="left" value="left">
                      <label class="form-check-label" for="left">
                        Left
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="image_position" id="right" value="right" checked>
                      <label class="form-check-label" for="right">
                        Right
                      </label>
                    </div>
                  </div>
                </div>
                <!-- Adding image size and position fields (End) -->

              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Question</label>
                <textarea class="myinput2" name="file_question1" cols="30" rows="3"></textarea>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Download File Text</label>
                <textarea class="myinput2" name="download_text1" cols="30" rows="3"></textarea>
              </div>
            </div>
          </div>
        <?php } ?>
        <br>
        <div class="row form-bottom make-sticky">
          <div class="col-md-12">
            <button type="submit" name="savedownloadsection" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="savedownloadsection" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
    </div>
  </div>


<?php } ?>



<?php
$content_count = 1;
$description_count = 0;
if (check_auth_permission(['content_block', 'content_block_image', 'content_block_subtitle_text_input', 'content_block_description', 'content_block_add_new', 'content_block_timed_image'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="content_block_bluebar" data-tip_section="content_block">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Content Block</div>
        </div>
        <div class="d-flex  align-items-center">
          @if(check_feature_enable_disable('contentblocksection'))
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

    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'content_block_bluebar' ? 'display:block;' : '' ?>">
      <form class="data-form" action="{{url('updatecontentblock')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-17">
          <div class="col-md-3">
            <div class="form-group d-flex">
              <label class="">Override Background <br>Color in Settings, Theme</label>
              <label class="switch ml-7">
                <input type="checkbox" class="notificationswitch override_bg_enable content_block_override_bg" name="content_block_override_bg" data-slug="content_block_bg_picker" <?php echo  $contentBlockSettings->content_block_override_bg ? 'checked' : '' ?>>
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group content_block_bg_picker" style="display:<?php echo  $contentBlockSettings->content_block_override_bg ? 'block' : 'none' ?>">
              <label>Feature's Background Color</label>
              <input type="color" class="myinput2" name="content_block_background" value="<?= $contentBlockSettings->content_block_background ?>">
            </div>
          </div>


          <?php if (check_auth_permission(['build_site_Content'])) { ?>

            <?php $content_block_outline = get_outline_settings('content_block_outline'); ?>
            <div class="col-md-6 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="content_block_outline" <?php echo  $content_block_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $content_block_outline->outline_color ?>" placeholder="#000000" data-slug="content_block_outline">
                </div>
              </div>
            </div>
        </div>
        <div class="myhr mb-16"></div>
      <?php } ?>
      <?php
      if (check_step_image('Content Block')) {
      ?>
        <div class="row">
          <div class="col-md-12 text-center">
            <h5 style="background: red;padding:10px;color:white">To edit Feature Deactivate or allow 1-Step Button to Expire</h5>
          </div>
        </div>
      <?php } ?>
      <?php if (check_auth_permission(['content_block_subtitle_text_input', 'content_block_description'])) { ?>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                <div class="d-flex align-items-center titlediv d-flex">
                  <div class="title-2">Generic Settings</div>
                  <div class="switchoverhead2">
                    <label class="switch ml-3">
                      <input type="checkbox" class="use_generic_content_block_setting saveGeneric" data-table="contentBlockSettings" name="use_generic_content_block_setting" <?= $contentBlockSettings->use_generic ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>

            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <?php if (check_auth_permission('content_block_subtitle_text_input')) { ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub-Title Text Color</label>
                    <input type="color" class="myinput2" name="generic_cb_subtitle_color" value="<?= isset($generic_content_block_subtitle->color) ? $generic_content_block_subtitle->color : '' ?>" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub-Title Text size</label><br>
                    <input type="text" class="myinput2 width-50px" name="generic_cb_subtitle_fontsize" value="<?= isset($generic_content_block_subtitle->size_web) ? $generic_content_block_subtitle->size_web : '' ?>" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Sub-Title Text Font</label>
                    <select class="myinput2" name="generic_cb_subtitle_fontfamily">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $singleff) { ?>
                          <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= isset($generic_content_block_subtitle->fontfamily) ? ($generic_content_block_subtitle->fontfamily == $singleff->id ? 'selected' : '') : ''; ?>><?= $singleff->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              <?php } ?>
              <div class="clearfix"></div>
              <?php if (check_auth_permission('content_block_description')) { ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Text Color</label>
                    <input type="color" class="myinput2" name="generic_cb_desc_color" value="<?= $generic_content_block_desc->color ?>" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="generic_cb_desc_fontsize" value="<?= $generic_content_block_desc->size_web ?>" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Description Text Font</label>
                    <select class="myinput2" name="generic_cb_desc_fontfamily">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $singleff) { ?>
                          <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($generic_content_block_desc->fontfamily) && ($generic_content_block_desc->fontfamily == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php if (check_auth_permission('content_block')) { ?>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2 content-main-block-div">
                <div class="title-2">Content Main Block</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="allcontentblockdiv">
              <?php if (count($contentBlockLinks) > 0) { ?> <?php
                                                            $content_count = 1;
                                                            $description_count = 0;
                                                            foreach ($contentBlockLinks as $single) { ?>
                  <input type="hidden" name="content_block_links_id[]" value="<?= $single->id ?>">
                  <div class="single-cb">
                    <div class="row">
                      <?php if (check_auth_permission(['content_block', 'content_block_subtitle_text_input'])) { ?>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Sub-Title</label>
                            <input type="text" class="myinput2" name="title[]" value="<?= $single->title ?>" placeholder="">
                          </div>
                        </div>

                      <?php } else { ?>
                        <input type="hidden" name="title[]" value="<?= $single->title ?>">
                      <?php } ?>

                      <input type="hidden" class="myinput2" name="content_block_inputs[]" value="<?= $content_count ?>">

                      <?php if (check_auth_permission(['content_block', 'content_block_delete'])) { ?>
                        <div class="col-md-1 text-right">
                          <br>
                          <button type="button" class="btn btn-primary btnremoverow">X</button>
                        </div>
                      <?php } ?>

                    </div>
                    <div class="row">
                      <?php if (check_auth_permission(['content_block', 'content_block_description'])) { ?>

                        <div class="col-md-6" id="descriptionDiv-<?= $description_count ?>">
                          <div class="form-group quilleditor-div">
                            <label>Description</label>
                            <textarea class="myinput2 editordata hidden" id='' name="description[]" placeholder="" rows="5"><?= isset($single->description) ? $single->description : "" ?></textarea>
                            <div class="quilleditor">
                              <?= isset($single->description) ? $single->description : "" ?>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <div class=" mt-2">
                                <div>
                                  <button type="button" class="btn btn-primary  show_read_more_block_{{$content_count}}">Add Read More text block</button>
                                </div>
                                <div class="pt-1 pb-1">
                                  <label>
                                    Reduce unwanted text, visitor can select the text they wish to read by clicking on <u>Read More</u>.
                                  </label>
                                </div>
                                <div class="pt-1 pb-1">
                                  <label for="bannertext">Read more active</label><br>
                                  <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="read_more_active[<?= $content_count - 1 ?>]" <?= isset($single->read_more_active) && $single->read_more_active ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="read_more_content_{{$content_count}}">
                            <div class="row ">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Input text for a Read More option</label>
                                  <input type="text" class="myinput2" name="read_more_text[]" placeholder="Read More" value="<?= $single->read_more_text ? $single->read_more_text : 'Read more' ?>">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group quilleditor-div">
                                  <label>Post Description Text</label>
                                  <textarea class="myinput2 editordata hidden" name="read_more_desc[]"><?php echo $single->read_more_desc; ?></textarea>
                                  <div class="quilleditor">
                                    <?php echo $single->read_more_desc; ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Input text for a Read Less option</label>
                                  <input type="text" class="myinput2" name="read_less_text[]" placeholder="Read Less" value="<?= $single->read_less_text ? $single->read_less_text : 'Read less' ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- 
                          <div class="col-md-4" id="descriptionDiv1-<?= $description_count ?>" style="display:<?= isset($single->description1) && !empty($single->description1) ? 'block' : 'none' ?>">
                            <div class="form-group quilleditor-div">
                              <label>Description 1</label>
                              <textarea class="myinput2 editordata hidden" id='' name="description1[]" placeholder="" rows="5"><?= isset($single->description1) ? $single->description1 : "" ?></textarea>
                              <div class="quilleditor">
                              <?= isset($single->description1) && !empty($single->description1) ? $single->description1 : "" ?>
                              </div>
                            </div>
                          </div> -->

                        <!-- <div class="col-md-4" id="descriptionDiv2-<?= $description_count ?>" style="display:<?= isset($single->description2) && !empty($single->description2) ? 'block' : 'none' ?>">
                            <div class="form-group quilleditor-div">
                              <label>Description 2</label>
                              <textarea class="myinput2 editordata hidden" id='' name="description2[]" placeholder="" rows="5"><?= isset($single->description2) ? $single->description2 : "" ?></textarea>
                              <div class="quilleditor">
                              <?= isset($single->description2) && !empty($single->description2) ? $single->description2 : "" ?>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4" id="descriptionDiv3-<?= $description_count ?>" style="display:<?= isset($single->description3) && !empty($single->description3) ? 'block' : 'none' ?>">
                            <div class="form-group quilleditor-div">
                              <label>Description 3</label>
                              <textarea class="myinput2 editordata hidden" id='' name="description3[]" placeholder="" rows="5"><?= isset($single->description3) && !empty($single->description3) ? $single->description3 : "" ?></textarea>
                              <div class="quilleditor">
                                <?= isset($single->description3) && !empty($single->description3) ? $single->description3 : "" ?>
                              </div>
                            </div>
                          </div> -->

                        <?php if (check_auth_permission(['content_block', 'content_block_add_new'])) { ?>
                          <!--                           
                          <div class="form-group">
                            <center>
                                <div class="col-md-12">
                                
                                  <button type="button" onclick="showdescdiv(<?= $description_count ?>)" id="btnshow-<?= $description_count ?>" class="btn btn-primary" >Add</button>
                                  <button type="button" onclick="hidedescdiv(<?= $description_count ?>)" id="btnhide-<?= $description_count ?>" class="btn btn-primary ml-3" >Remove</button>
                                </div>
                            </center>
                          </div> -->
                          <?php $description_count++; ?>
                        <?php }  ?>
                        <br>
                      <?php } else {
                      ?><input type="hidden" name="description[]" value="<?= $single->description ?>">
                      <?php } ?>
                    </div>
                    <br>
                    <div class="row">
                      <?php if (check_auth_permission('content_block')) { ?>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Sub-Title Text Color</label>
                            <input type="color" class="myinput2" name="content_title_color[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="<?= isset($single->content_title_color) ? $single->content_title_color : '' ?>" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Sub-Title Text Size</label><br>
                            <input type="text" class="myinput2 width-50px" name="content_title_font_size[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="<?= isset($single->content_title_font_size) ? $single->content_title_font_size : '' ?>" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="title_font_size">Sub-Title Text Font</label>
                            <select class="myinput2" name="content_title_font_family[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?>>
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singleff) { ?>
                                  <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= isset($single->content_title_font_family) ? ($single->content_title_font_family == $singleff->id ? 'selected' : '') : ''; ?>><?= $singleff->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Description Read More Text Color</label>
                            <input type="color" class="myinput2" name="content_desc_color[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->content_desc_color ?>" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Description Read More Text Size</label><br>
                            <input type="text" class="myinput2 width-50px" name="content_desc_font_size[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="<?= $single->content_desc_font_size ?>" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="title_font_size">Description Read More Font</label>
                            <select class="myinput2" name="content_desc_font_family[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?>>
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singleff) { ?>
                                  <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($single->content_desc_font_family) && ($single->content_desc_font_family == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="uploadImageDiv">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="new_content_image[]">
                            <div class="col-md-6 imgdiv" style="display:none">
                              <br>
                              <img src='' width="100%" class="imagefromgallerysrc">
                              <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" id="content_image<?= $content_count ?>" name="content_image[]" value="<?= isset($single->content_image) ? $single->content_image : '' ?>">
                        <?php if (isset($single->content_image) && !empty($single->content_image)) { ?>
                          <div class="col-md-2 content_image_div<?= $content_count ?>">
                            <img src='<?= base_url('assets/uploads/' . get_current_url() . $single->content_image) ?>' width="100%">
                            <button type="button" onclick="remove_content_image(<?= $content_count ?>)" class="btn btn-primary btnimgdel">X</button>
                          </div>
                        <?php } ?>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Content Image Size</label><br>
                            <input type="number" class="myinput2 width-50px" name="content_image_size[]" value="<?= isset($single->content_image_size) ? $single->content_image_size : '' ?>" placeholder="e.g 275">
                          </div>
                        </div>

                      <?php } else {
                      ?>
                        <input type="hidden" name="content_title_color[]" value="<?= $single->content_title_color ?>">
                        <input type="hidden" name="content_title_font_size[]" value="<?= $single->content_title_font_size ?>">
                        <input type="hidden" name="content_title_font_family[]" value="<?= $single->content_title_font_family ?>">
                        <input type="hidden" name="content_desc_color[]" value="<?= $single->content_desc_color ?>">
                        <input type="hidden" name="content_desc_font_size[]" value="<?= $single->content_desc_font_size ?>">
                        <input type="hidden" name="content_desc_font_family[]" value="<?= $single->content_desc_font_family ?>">
                        <input type="hidden" name="content_image[]" value="<?= isset($single->content_image) ? $single->content_image : '' ?>">
                        <input type="hidden" name="content_image_size[]" value="<?= isset($single->content_image_size) ? $single->content_image_size : '' ?>">
                      <?php } ?>



                      <div class="col-md-12"><br /></div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="bannertext">Action button active</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="action_button_active[<?= $content_count - 1 ?>]" <?= isset($single->action_button_active) && $single->action_button_active ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_discription">Action Button Name</label>
                          <input type="text" class="myinput2" name="action_button_discription[]" id="action_button_discription" value="<?= isset($single->action_button_discription) && $single->action_button_discription ?  $single->action_button_discription : '' ?>" placeholder="Type here...">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_discription_color">Action Button Text Color</label>
                          <input type="color" class="myinput2" name="action_button_discription_color[]" id="action_button_discription_color" value="<?= isset($single->action_button_discription_color) &&  $single->action_button_discription_color ? $single->action_button_discription_color : '' ?>" placeholder="#ffffff">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_bg_color">Action Button Color</label>
                          <input type="color" class="myinput2" name="action_button_bg_color[]" id="action_button_bg_color" value="<?= isset($single->action_button_bg_color) && $single->action_button_bg_color ? $single->action_button_bg_color : '' ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="action_button_link">Action Button Application</label>
                          <select class="myinput2 news_post_action_button<?= $content_count ?> action_button_selection" id="action_button_link" name="action_button_link[]">
                            <option value="link">Link</option>
                            <option value="call" <?= isset($single->action_button_link) && $single->action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                            <option value="sms" <?= isset($single->action_button_link) && $single->action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                            <option value="email" <?= isset($single->action_button_link) && $single->action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                            <option value="video" <?= isset($single->action_button_link) && $single->action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                            <option value="audioiconfeature" <?= isset($single->action_button_link) && $single->action_button_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio Icon Feature</option>
                            <option value="google_map" <?= isset($single->action_button_link) && $single->action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                            <option value="text_popup" <?= isset($single->action_button_link) && $single->action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                            <option value="address" <?= isset($single->action_button_link) && $single->action_button_link == "address" ? 'selected' : '' ?>>Address</option>
                            <option value="customforms" <?= isset($single->action_button_link) && $single->action_button_link ==  "customforms" ? 'selected' : '' ?>>Forms</option>
                            <?php foreach ($front_sections as $single2) { ?>
                              <option value="<?= $single2->slug ?>" <?= isset($single->action_button_link) && $single->action_button_link == $single2->slug ? 'selected' : '' ?>><?= $single2->name ?></option>
                            <?php } ?>
                          </select>
                          <div class="form-group action_fields phone_no_calls" style="<?= $single->action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                            <label for="">Phone number for calls</label>
                            <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="<?= $single->action_button_phone_no_calls ?>">
                          </div>
                          <div class="form-group action_fields phone_no_sms" style="<?= $single->action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                            <label for="">Phone number for sms</label>
                            <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="<?= $single->action_button_phone_no_sms ?>">
                          </div>
                          <div class="form-group action_fields action_email" style="<?= $single->action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                            <label for="">Email</label>
                            <input type="text" class="myinput2" name="action_button_action_email[]" value="<?= $single->action_button_action_email ?>">
                          </div>
                          <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $single->action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                            <label>Popup Text </label>
                            <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"><?php echo $single->action_button_textpopup; ?></textarea>
                            <div class="quilleditor">
                              <?php echo $single->action_button_textpopup; ?>
                            </div>
                          </div>
                          <div class="form-group action_fields action_link" style="<?= $single->action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                            <input type="text" class="myinput2 news_post_link<?= $content_count ?>" name="action_button_link_text[]" id="news_post_link<?= $content_count ?>" value="<?= isset($single->action_button_link_text) && $single->action_button_link_text ? $single->action_button_link_text : '' ?>" placeholder="http://google.com">
                          </div>
                          <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $single->action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="form-group action_fields audio_icon_feature" name="cb_audio_icon_feature" style="<?= $single->action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                              <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                          </div>
                          <div class="row">
                            <?php if ($single->action_button_link == 'audioiconfeature' && $single->action_button_audio_icon_feature) {

                            ?>
                              <div class="col-md-10 imgdiv">
                                <h4><?= $single->action_button_audio_icon_feature ?></h4>
                                <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="review_post_right" data-id="<?= $single->id ?>" data-imgname="<?= $single->action_button_audio_icon_feature ?>">X</button>
                              </div>
                            <?php


                                                              } ?>
                          </div>
                          <div class="form-group action_fields video_upload" name="feature_action_video" style="<?= $single->action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                            <label for="customFile">Upload Video</label>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="cb_video_file[]" id="customFile" accept=".mp4">
                              <label class="custom-file-label" for="customFile">Upload Video</label>
                            </div>
                            @if(isset($single->cb_action_button_video) && $single->cb_action_button_video !='')
                            <div class=" position-relative d-flex cb_action_button_video_{{$single->id}}">
                              <video height="80" controls>
                                <source src="<?= isset($single->cb_action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($single->cb_action_button_video)) : '' ?>" type="video/mp4">
                              </video>
                              <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='cb_action_button_video' data-id="{{$single->id}}" data-file="{{$single->cb_action_button_video}}">X
                              </div>
                            </div>
                            @endif
                          </div>
                          <div class="form-group action_fields action_forms" style="<?= $single->action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                            <select class="myinput2" name="action_button_customforms[]" id="customforms<?= $content_count ?>">
                              <?php if (count($customForms) > 0) { ?>
                                <?php foreach ($customForms as $singlecf) { ?>
                                  <option value="<?= $singlecf->id ?>" <?= isset($single->action_button_custom_forms) && (int)$single->action_button_custom_forms == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group action_fields action_address" style="display:<?= isset($single->action_button_link) &&  $single->action_button_link  == "address"  ? 'block' : 'none' ?>">
                            <label for="addressbtn1">Select an Address</label>
                            <select name="action_button_address_id[]" class="myinput2">
                              <?php
                                                              foreach ($addresses as $address) {
                              ?>
                                <option value="<?= $address->id ?>" <?= isset($single->action_button_address_id) && $single->action_button_address_id == $address->id ? 'selected' : '' ?>><?= $address->address_title ?>
                          </div>
                        <?php
                                                              }
                        ?>
                        </select>
                        </div>
                        <div class="form-group action_fields action_map" style="<?= $single->action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                          <label for="address">Enter Address</label>
                          <input type="text" class="myinput2 " name="action_button_map_address[]" value="<?= isset($single->action_button_map_address) && $single->action_button_map_address ? $single->action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">

                      <hr style="border-top: 5px solid rgba(0,0,0,.1)">
                    </div>
                  </div>
            </div>
          <?php
                                                              $content_count++;
                                                            }  ?>
        <?php } else {  ?>
          <?php if (check_auth_permission(['content_block', 'content_block_add_new'])) { ?>
            <div class="single-cb">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub-Title</label>
                    <input type="text" class="myinput2" name="title[]" value="" placeholder="">
                    <input type="hidden" class="myinput2" name="content_block_inputs[]" value="1" placeholder="">
                  </div>
                </div>
                <div class="col-md-4 text-right">
                  <br>
                  <button type="button" title="Remove Content Block" class=" btn btn-primary btnremoverow">X</button>
                </div>
                <div class="col-md-4">
                </div>

              </div>

              <div class="row">
                <div class="col-md-4" id="descriptionDiv-<?= $description_count ?>">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="myinput2" id='' name="description[]" placeholder="" rows="5"></textarea>
                  </div>
                </div>

                <div class="col-md-4" id="descriptionDiv1-<?= $description_count ?>" style="display:none">
                  <div class="form-group">
                    <label>Description 1</label>
                    <textarea class="myinput2" id='' name="description1[]" placeholder="" rows="5"></textarea>
                  </div>
                </div>

                <div class="col-md-4" id="descriptionDiv2-<?= $description_count ?>" style="display:none">
                  <div class="form-group">
                    <label>Description 2</label>
                    <textarea class="myinput2" id='' name="description2[]" placeholder="" rows="5"></textarea>
                  </div>
                </div>

                <div class="col-md-4" id="descriptionDiv3-<?= $description_count ?>" style="display:none">
                  <div class="form-group">
                    <label>Description 3</label>
                    <textarea class="myinput2" id='' name="description3[]" placeholder="" rows="5"></textarea>
                  </div>
                </div>

                <?php if (check_auth_permission(['content_block', 'content_block_add_new'])) { ?>

                  <div class="form-group">
                    <center>
                      <div class="col-md-12">
                        <button type="button" onclick="showdescdiv(<?= $description_count ?>)" id="btnshow-<?= $description_count ?>" class="btn btn-primary">Add</button>
                        <button type="button" onclick="hidedescdiv(<?= $description_count ?>)" id="btnhide-<?= $description_count ?>" class="btn btn-primary ml-3">Remove</button>
                      </div>
                    </center>
                    <?php $description_count++; ?>
                  </div>
                <?php }  ?>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub-Title Text Color</label>
                    <input type="color" class="myinput2" name="content_title_color[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub-Title Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="content_title_font_size[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Sub-Title Text Font</label>
                    <select class="myinput2" name="content_title_font_family[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?>>
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Read More Text Color</label>
                    <input type="color" class="myinput2" name="content_desc_color[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Read More Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="content_desc_font_size[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?> value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Description Read More Text Font</label>
                    <select class="myinput2" name="content_desc_font_family[]" <?php if ($contentBlockSettings->use_generic) { ?> disabled <?php } ?>>
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="uploadImageDiv">
                    <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                    <input class="dataimage" type="hidden" name="new_content_image[]">
                    <div class="col-md-6 imgdiv" style="display:none">
                      <br>
                      <img src='' width="100%" class="imagefromgallerysrc">
                      <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="content_image[]" value="">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Content Image Size</label><br>
                    <input type="number" class="myinput2 width-50px" name="content_image_size[]" value="" placeholder="e.g 275">
                  </div>
                </div>
                <div class="col-md-12"><br /></div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Action button active</label><br>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch" name="action_button_active[<?= $content_count ?>]">
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="action_button_discription">Action Button Name</label>
                    <input type="text" class="myinput2" name="action_button_discription[]" id="action_button_discription" value="Find Out More" placeholder="Type here...">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="action_button_discription_color">Action Button Text Color</label>
                    <input type="color" class="myinput2" name="action_button_discription_color[]" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="action_button_bg_color">Action Button Color</label>
                    <input type="color" class="myinput2" name="action_button_bg_color[]" id="action_button_bg_color" value="#000000" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="action_button_link">Action Button Application</label>
                    <select class="myinput2 news_post_action_button<?= $content_count ?> action_button_selection" id="action_button_link" name="action_button_link[]">
                      <option value="link">Link</option>
                      <option value="call">Call</option>
                      <option value="sms">SMS</option>
                      <option value="email">Email</option>
                      <option value="video">Video</option>
                      <option value="audioiconfeature">Audio Icon Feature</option>
                      <option value="google_map">Map</option>
                      <option value="text_popup">Text Popup</option>
                      <option value="address">Address</option>
                      <option value="customforms">Forms</option>
                      <?php foreach ($front_sections as $single2) { ?>
                        <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group action_fields phone_no_calls" style="display:none">
                    <label for="">Phone number for calls</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="<?= $single->action_button_phone_no_calls ?>">
                  </div>
                  <div class="form-group action_fields phone_no_sms" style="display:none">
                    <label for="">Phone number for sms</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="<?= $single->action_button_phone_no_sms ?>">
                  </div>
                  <div class="form-group action_fields action_email" style="display:none">
                    <label for="">Email</label>
                    <input type="text" class="myinput2" name="action_button_action_email[]" value="<?= $single->action_button_action_email ?>">
                  </div>
                  <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                    <label>Popup Text </label>
                    <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"></textarea>
                    <div class="quilleditor"></div>
                  </div>
                  <div class="form-group action_fields action_link" style="display:block">
                    <input type="text" class="myinput2 news_post_link<?= $content_count ?>" name="action_button_link_text[]" id="news_post_link<?= $content_count ?>" value="" placeholder="http://google.com">
                  </div>
                  <div class="form-group action_fields action_forms" style="display:none">
                    <select style="display:none;" class="myinput2" name="action_button_customforms[]" id="customforms<?= $content_count ?>">
                      <?php if (count($customForms) > 0) { ?>
                        <?php foreach ($customForms as $single) { ?>
                          <option value="<?= $single->id ?>"><?= $single->title ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                    <label for="customFile">Upload Video</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="cb_video_file[]" id="customFile" accept=".mp4">
                      <label class="custom-file-label" for="customFile">Upload Video</label>
                    </div>
                    <div class="form-group action_fields audio_icon_feature" name="cb_audio_icon_feature" style="display:none">
                      <label for="customFile">Select File</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                        <label class="custom-file-label" for="customFile">Select File</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" style="display:none">
                    <label for="addressbtn1">Select an Address</label>
                    <select name="action_button_address_id[]" class="myinput2">
                      <?php
                      foreach ($addresses as $address) {
                      ?>
                        <option value="<?= $address->id ?>"><?= $address->address_title ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group action_fields action_map" style="display:none">
                    <label for="address">Enter Address</label>
                    <input type="text" class="myinput2 " name="action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                  </div>
                </div>
                <div class="col-md-12">
                  <hr style="border-top: 5px solid rgba(0,0,0,.1)">
                </div>
              </div>
            </div>
          <?php }  ?>
        <?php } ?>
          </div>
          <?php if (check_auth_permission(['content_block_add_new'])) { ?>
            <div class="row">
              <div class="col-md-2">
                <button type="button" class="btn btn-primary btnaddnewcontentblock">Add New</button>
              </div>
            </div>
          <?php }  ?>
        </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['content_block_timed_image'])) { ?>
    <div class="content2">
      <div class="row">
        <div class="col-md-12">
          <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
            <div class="d-flex align-items-center titlediv">
              <div class="title-2">Timed Image Settings</div>
              <div class="form-group  switchoverhead2">
                <label class="switch m-0">
                  <input type="checkbox" class="notificationswitch timeimagesswitch" name="enable_timed_content_block_image" <?= $timed_content_block_image->enable ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
          </div>

        </div>
      </div>
      <div class="editcontent2">
        <div class="timedimagediv">
          <div class="timedimages <?php //echo $timed_content_block_image->enable ? '' : 'hidden' 
                                  ?>">
            <br>
            <div class="row">
              <div class="col-md-4">
                <?php
                $start_time = new DateTime($timed_content_block_image->start_time, new DateTimeZone(getFrontDataTimeZone()));
                $end_time = new DateTime($timed_content_block_image->end_time, new DateTimeZone(getFrontDataTimeZone()));

                $days = json_decode($timed_content_block_image->days, true);
                ?>
                <div class="row nopadding">
                  <div class="col-md-6 nopadding">
                    <div class="form-group">
                      <label for="content_block_image_type">Type</label>
                      <select name="content_block_image_type" class="myinput2 timed_image_type" id="content_block_image_type">
                        <option value="days" <?= $timed_content_block_image->type == 'days' ? 'selected' : '' ?>>By Days</option>
                        <option value="timer" <?= $timed_content_block_image->type == 'timer' ? 'selected' : '' ?>>Timer</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 nopadding">
                    <div class="timed_type_divs timer_div" style="<?= $timed_content_block_image->type == 'timer' ? 'display:block;' : 'display:none;' ?>">
                      <div class="form-group">
                        <label for="content_block_image_timer">Timer</label>
                        <select name="content_block_image_timer" class="myinput2" id="content_block_image_timer">
                          <option value="15" <?= $timed_content_block_image->image_timer == '15' ? 'selected' : '' ?>>15 min</option>
                          <option value="30" <?= $timed_content_block_image->image_timer == '30' ? 'selected' : '' ?>>30 min</option>
                          <option value="60" <?= $timed_content_block_image->image_timer == '60' ? 'selected' : '' ?>>1 hour</option>

                          <option value="120" <?= $timed_content_block_image->image_timer == '120' ? 'selected' : '' ?>>2 hour</option>
                          <option value="240" <?= $timed_content_block_image->image_timer == '240' ? 'selected' : '' ?>>4 hour</option>
                          <option value="360" <?= $timed_content_block_image->image_timer == '360' ? 'selected' : '' ?>>6 hour</option>
                          <option value="480" <?= $timed_content_block_image->image_timer == '480' ? 'selected' : '' ?>>8 hour</option>
                          <option value="720" <?= $timed_content_block_image->image_timer == '720' ? 'selected' : '' ?>>12 hour</option>
                          <option value="1440" <?= $timed_content_block_image->image_timer == '1440' ? 'selected' : '' ?>>24 hour</option>
                          <option value="2880" <?= $timed_content_block_image->image_timer == '2880' ? 'selected' : '' ?>>48 hour</option>
                        </select>
                      </div>
                    </div>
                    <div class="timed_type_divs days_div" style="<?= $timed_content_block_image->type == 'days' ? 'display:block;' : 'display:none;' ?>">
                      <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" name="content_block_image_start_time" class="myinput2" id="date" value="<?php echo $start_time->format('H:i'); ?>">
                      </div>
                      <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" name="content_block_image_end_time" class="myinput2" id="time" value="<?php echo $end_time->format('H:i'); ?>">
                      </div>
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
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="uploadImageDiv">
                  <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                  <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                  <input class="dataimage" type="hidden" name="timed_content_block_image">

                  <div class="col-md-6 imgdiv" style="display:none">
                    <br>
                    <img src='' width="100%" class="imagefromgallerysrc">
                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                  </div>
                </div>
              </div>
              <?php if ($timed_content_block_image_file->file_name) { ?>
                <div class="col-md-2 timed_content_block_image_div">
                  <img src='<?= base_url('assets/uploads/' . get_current_url() . $timed_content_block_image_file->file_name) ?>' width="100%">
                  <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $timed_content_block_image_file->file_name ?>','timed_content_block_image','timed_content_block_image_div','images','0','true')">X</button>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php if (check_auth_permission('content_block_image')) { ?>
    <div class="contentblockdiv">
      <div class="content2">
        <div class="row">
          <div class="col-md-12">
            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
              <div class="title-2">Content Block Settings</div>
              <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
            </div>
          </div>
        </div>
        <div class="editcontent2">
          <div class="row">
            <div class="col-md-1 ">
              <div class="form-group">
                <label>Image Size</label><br>
                <input type="number" class="myinput2 width-60px" name="content_block_image_size" value="<?= $contentBlockSettings->block_image_size ?>" placeholder="e.g 275">
              </div>
              <div class="form-group">
                <label>Subimage Size</label><br>
                <input type="number" class="myinput2 width-60px" name="content_block_subimage_size" value="<?= $contentBlockSettings->block_subimage_size ?>" placeholder="e.g 275">
              </div>
            </div>
            <?php if ($contentBlockSettings->block_image) { ?>
              <div class="col-md-2 content_block_image_div">
                <img src='<?= base_url('assets/uploads/' . get_current_url() . $contentBlockSettings->block_image) ?>' width="100%">
                <button type="button" class="btn btn-primary" onclick="delete_front_image('<?= $contentBlockSettings->block_image ?>','block_image','content_block_image_div','content_block_settings','<?= $contentBlockSettings->id ?>')">X</button>
              </div>
            <?php } ?>
            <div class="col-md-3">
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
      </div>
    </div>
  <?php } ?>
  <br>
  <div class="row form-bottom make-sticky">
    <div class="col-md-12">
      <button type="submit" name="savecontentblock" class="btn btn-primary" value="save">Save</button>
      <button type="submit" name="savecontentblock" class="btn btn-primary" value="savereminders">Save & send reminder</button>
    </div>
  </div>
  </form>
  </div>
  </div>


<?php } ?>




<?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>

  <div class="contentdiv">
    <div class="btnedit openEditContent" id="title_banners_bluebar" data-top="title_banner_top" data-bottom="title_banner_bottom" data-tip_section="title_and_banners">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Title & Banners</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
          </div>
        </div>
      </div>
    </div>

    <div class="editcontent title-banner-container pt-10 pr-5px" style="position: relative;<?= isset($_GET['block']) && $_GET['block'] == 'title_banners_bluebar' ? 'display:block;' : '' ?>">
      <form action="{{url('updatetitlebanners')}}" method="post" enctype="multipart/form-data">
        @csrf
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <div class="row mb-17">
            <?php $title_banners_outline = get_outline_settings('title_banners_outline'); ?>
            <div class="col-md-12 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div for="" class="title-9 text-black mb-1">Banner Switching</div>
                <div for="" class="title-9 text-black mb-1 ml-25">Select Alt Tag value</div>
                <div class="form-group ml-55 text-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="title_banners_outline" <?php echo  $title_banners_outline->time != null ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34 text-center">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $title_banners_outline->outline_color ?>" placeholder="#000000" data-slug="title_banners_outline">
                </div>
              </div>
            </div>
          </div>
          <div class="myhr mb-16"></div>
        <?php } ?>
        <div id="title_banner_top"></div>
        <div class="d-flex">
          <div class="contentblockdiv">
            <div class="content2" id="title_banner_blog_block">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 blog_title">
                      <div class="title-2 tbt-title">Blog </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>
                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="blog_title" <?= $blog_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="blog_title">
                        <div class="title-2 h1tag <?= $blog_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $blog_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banner_text_input'])) { ?>
                      <div class="col-md-4" id="blog_title_text">
                        <div class="form-group">
                          <label>Blog Title</label>
                          <input type="text" class="myinput2" name="blog_title_text" value="<?= $blog_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="blog_title_font_size_web" value="<?= $blog_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="blog_title_font_size_mobile" value="<?= $blog_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Blog Title Font</label>
                          <select class="myinput2" name="blog_title_font">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $blog_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> Text Color</label>
                          <input type="color" class="myinput2" name="blog_title_color" value="<?= $blog_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group blog_title_banner_color" style="<?php echo $blog_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label> Banner Color</label>
                          <input type="color" class="myinput2" name="blog_title_background" value="<?= $blog_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch blog_bg_color title-banner-toggle" name="blog_title_setting" data-slug='blog_title' <?= $blog_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_contact_information">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 contact_boxes_title">
                      <div class="title-2 tbt-title">Contact Boxes </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>
                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="contact_info_block_title" <?= $contact_info_block_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="contact_info_block_title">
                        <div class="title-2 h1tag <?= $contact_info_block_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $contact_info_block_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Contact Boxes Title</label>
                          <input type="text" class="myinput2" name="contact_info_blocks_title_text" value="<?= $contact_info_block_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="contact_info_blocks_title_fontsize" value="<?= $contact_info_block_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="contact_info_blocks_title_fontsize_mobile" value="<?= $contact_info_block_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Contact Boxes Title Font</label>
                          <select class="myinput2" name="contact_info_blocks_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $contact_info_block_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text Color</label>
                          <input type="color" class="myinput2" name="contact_info_blocks_title_color" value="<?= $contact_info_block_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group contact_info_block_title_banner_color" style="<?php echo $contact_info_blocks_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="contact_info_blocks_title_block_color" value="<?= $contact_info_block_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch contact_info_blocks_bg_color title-banner-toggle" name="contact_info_block_title_setting" data-slug="contact_info_block_title" <?= $contact_info_blocks_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_content_block">
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="position-relative">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2 content_block_title">
                        <div class="title-2 tbt-title">Content Block </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                      </div>
                      <div class="form-group switchOverHeadCenter">
                        <div class="title-banner-toggle-container">
                          <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>
                          <label class="switch ml-2">
                            <input type="checkbox" class="notificationswitch titleEnable" data-slug="content_block_title" <?= $content_block_title->enable == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="tagswitch ml-10" data-slug="content_block_title">
                          <div class="title-2 h1tag <?= $content_block_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                          <div class="title-2 h3tag ml-2  <?= $content_block_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Content Block Title</label>
                          <input type="text" class="myinput2" name="contentblock_title" value="<?= $content_block_title->text ?>" placeholder="">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="contentblock_title_font_size" value="<?= $content_block_title->size_web ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="contentblock_title_font_size_mobile" value="<?= $content_block_title->size_mobile ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Content Block Title Font</label>
                          <select class="myinput2" name="contentblock_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $content_block_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> Text color</label>
                          <input type="color" class="myinput2" name="contentblock_title_color" value="<?= $content_block_title->color ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group content_block_title_banner_color" style="<?php echo $content_block_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="contentblock_title_block_color" value="<?= $content_block_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch contentblock_bg_color title-banner-toggle" name="content_block_title_setting" data-slug="content_block_title" <?= $content_block_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_contact_form">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 contact_forms_title">
                      <div class="title-2 tbt-title">Contact Forms </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="formsSettings" <?= $formsSettings->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="formsSettings">
                        <div class="title-2 h1tag <?= $formsSettings->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $formsSettings->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="contacttitlediv">
                    <?php if (count($contactFormTitle)) { ?>
                      <?php foreach ($contactFormTitle as $single) { ?>
                        <input type="hidden" class="myinput2" name="contacttitleid[]" value="<?= $single->id ?>">
                        <div class="row">
                          <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Contact Forms Title</label>
                                <input type="text" class="myinput2" name="contacttitle[]" value="<?= $single->text ?>" placeholder="Title">
                              </div>
                            </div>
                          <?php } else {
                          ?><input type="hidden" name="contacttitle[]" value="<?= $single->contacttitle ?>">
                          <?php } ?>
                          <?php if (check_auth_permission('title_banners')) { ?>

                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Text Size on Web</label><br>
                                <input type="text" class="myinput2 width-50px" name="contacttitlefontsize[]" value="<?= $single->size_web ?>" placeholder="15px">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Text Size on Mobile</label><br>
                                <input type="text" class="myinput2 width-50px" name="contacttitlefontsizemobile[]" value="<?= isset($single->size_mobile) ? $single->size_mobile : '' ?>" placeholder="e.g 15">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="title_font_size">Contact Forms Title Font</label>
                                <select class="myinput2" name="font_family[]">
                                  <?php if (count($font_family) > 0) { ?>
                                    <?php foreach ($font_family as $singleff) { ?>
                                      <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($single->fontfamily) && $single->fontfamily == $singleff->id) ? 'selected' : ''; ?>><?= $singleff->name ?></option>
                                    <?php } ?>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label> Text Color</label>
                                <input type="color" class="myinput2" name="contacttitlecolor[]" value="<?= $single->color ?>" placeholder="#000000">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group contact_forms_banner_color" style="<?php echo $single->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                                <label> Banner Color</label>
                                <input type="color" class="myinput2" name="contacttitleblockcolor[]" value="<?= $single->bg_color ?>" placeholder="#000000">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="bannertext">Banner to Match Theme Background Color</label><br>
                                <label class="switch">
                                  <input type="checkbox" class="notificationswitch contact_bg_color title-banner-toggle" data-slug="contact_forms" data-id="{{$single->id}}" name="contact_bg_color[]" <?= $single->enable_theme_bg == '1' ? 'checked' : '' ?>>
                                  <span class="slider round"></span>
                                </label>
                              </div>
                            </div>
                            <div class="col-md-1">
                              <br>
                              <button type="button" class="btn btn-primary btnremoverow">X</button>
                            </div>
                          <?php } else { ?>
                            <input type="hidden" name="contacttitlecolor[]" value="<?= $single->contacttitlecolor ?>">
                            <input type="hidden" name="contacttitleblockcolor[]" value="<?= $single->contacttitleblockcolor ?>">
                            <input type="hidden" name="contacttitlefontsize[]" value="<?= $single->contacttitlefontsize ?>">
                            <input type="hidden" name="contacttitlefontsizemobile[]" value="<?= $single->contacttitlefontsizemobile ?>">
                            <input type="hidden" name="font_family[]" value="<?= $single->font_family ?>">
                          <?php } ?>
                        </div>
                      <?php }  ?>
                    <?php } else {  ?>
                      <div class="row">
                        <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Title</label>
                              <input type="text" class="myinput2" name="contacttitle[]" value="" placeholder="Title">
                            </div>
                          </div>
                        <?php } ?>
                        <?php if (check_auth_permission('title_banners')) { ?>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Text Size on Web</label><br>
                              <input type="text" class="myinput2 width-50px" name="contacttitlefontsize[]" value="" placeholder="15px">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Title Size on Mobile</label><br>
                              <input type="text" class="myinput2 width-50px" name="contacttitlefontsizemobile[]" value="" placeholder="15px">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="title_font_size">Font family</label>
                              <select class="myinput2" name="font_family[]">
                                <?php if (count($font_family) > 0) { ?>
                                  <?php foreach ($font_family as $singleff) { ?>
                                    <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>"><?= $singleff->name ?></option>
                                  <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Text Color</label>
                              <input type="color" class="myinput2" name="contacttitlecolor[]" value="" placeholder="#000000">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group contact_form_2_banner_color">
                              <label>Banner Color</label>
                              <input type="color" class="myinput2" name="contacttitleblockcolor[]" value="" placeholder="#000000">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="bannertext">Banner to Match Theme Background Color</label><br>
                              <label class="switch">
                                <input type="checkbox" class="notificationswitch contact_bg_color title-banner-toggle" data-slug="contact_form_2" name="contact_bg_color[]" checked="">
                                <span class="slider round"></span>
                              </label>
                            </div>
                          </div>
                        <?php }  ?>
                      </div>
                    <?php }  ?>
                  </div>
                </div>
                <div class="contactformtitletrmplatediv" style="display:none;">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="myinput2" name="contacttitle[]" value="" placeholder="Title">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="contacttitlefontsize[]" value="" placeholder="15px">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="contacttitlefontsizemobile[]" value="" placeholder="15px">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Font family</label>
                        <select class="myinput2" name="font_family[]">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $singleff) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $singleff->id ?>"><?= $singleff->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="contacttitlecolor[]" value="" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group contact_form_3_banner_color">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="contacttitleblockcolor[]" value="" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch download_bg_color title-banner-toggle" data-slug="contact_form_3" name="contact_bg_color[]">
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <br>
                      <button type="button" class="btn btn-primary btnremoverow">X</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_download_section">
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="position-relative">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2 download_section_title">
                        <div class="title-2 tbt-title">Download Section </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                      </div>
                      <div class="form-group switchOverHeadCenter">
                        <div class="title-banner-toggle-container">
                          <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                          <label class="switch ml-2">
                            <input type="checkbox" class="notificationswitch titleEnable" data-slug="download_title" <?= $download_title->enable == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="tagswitch ml-10" data-slug="download_title">
                          <div class="title-2 h1tag <?= $download_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                          <div class="title-2 h3tag ml-2  <?= $download_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Download Section Title</label>
                          <input type="text" class="myinput2" name="download_title" value="<?= $download_title->text ?>" placeholder="">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="download_title_font_size" value="<?= $download_title->size_web ?>" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="download_title_font_size_mobile" value="<?= $download_title->size_mobile ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Download Section Title Font</label>
                          <select class="myinput2" name="download_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $download_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> Text Color</label>
                          <input type="color" class="myinput2" name="download_title_color" value="<?= $download_title->color ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group download_title_banner_color" style="<?php echo $download_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="download_title_block_color" value="<?= $download_title->bg_color ?>" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch download_bg_color title-banner-toggle" name="download_title_setting" data-slug="download_title" <?= $download_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_faq">
              <div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="position-relative">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2 faqs_title">
                        <div class="title-2 tbt-title">FAQs </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                      </div>
                      <div class="form-group switchOverHeadCenter">
                        <div class="title-banner-toggle-container">
                          <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                          <label class="switch ml-2">
                            <input type="checkbox" class="notificationswitch titleEnable" data-slug="faq_title" <?= $faq_title->enable == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="tagswitch ml-10" data-slug="faq_title">
                          <div class="title-2 h1tag <?= $faq_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                          <div class="title-2 h3tag ml-2  <?= $faq_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>FAQ Title</label>
                          <input type="text" class="myinput2" name="faq_title" value="<?= $faq_title->text ?>" placeholder="">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="faq_title_font_size" value="<?= $faq_title->size_web ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="faq_title_font_size_mobile" value="<?= $faq_title->size_mobile ?>" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">FAQ Title Font</label>
                          <select class="myinput2" name="faq_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $faq_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text color</label>
                          <input type="color" class="myinput2" name="faq_title_color" value="<?= $faq_title->color ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group faq_title_banner_color" style="<?php echo $faq_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="faq_title_back_color" value="<?= $faq_title->bg_color ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch faq_bg_color title-banner-toggle" name="faq_title_setting" data-slug="faq_title" <?= $faq_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="form_title_text">
              <?php $form_section_title = get_text_details('form_section_title'); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 forms_title">
                      <div class="title-2 tbt-title">Forms </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="form_section_title" <?= $form_section_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="form_section_title">
                        <div class="title-2 h1tag <?= $form_section_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $form_section_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-4" id="">
                    <div class="form-group">
                      <label>Form Title</label>
                      <input type="text" class="myinput2" name="form_text" value="<?= $form_section_title ? $form_section_title->text : '' ?>" placeholder="Title">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="form_text_size" value="<?= $form_section_title ? $form_section_title->size_web : '' ?>" placeholder="16">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="form_size_mobile" value="<?= $form_section_title ? $form_section_title->size_mobile : '' ?>" placeholder="16">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Text Font</label>
                      <select class="myinput2" name="form_text_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_section_title && $form_section_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Text Color</label>
                      <input type="color" class="myinput2" name="form_text_color" value="<?= $form_section_title ? $form_section_title->color : '' ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group form_section_title_banner_color" style="<?php echo $form_section_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                      <label>Banner Color</label>
                      <input type="color" class="myinput2" name="form_background_color" value="<?= $form_section_title ? $form_section_title->bg_color : '' ?>" placeholder="">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="bannertext">Banner to Match Theme Background Color</label><br>
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch form_bg_color title-banner-toggle" name="form_section_title_setting" data-slug="form_section_title" <?= $form_section_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_gallery_post">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 gallery_post_title">
                      <div class="title-2 tbt-title">Gallery Post </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="gallery_posts_title" <?= $gallery_posts_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="gallery_posts_title">
                        <div class="title-2 h1tag <?= $gallery_posts_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $gallery_posts_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gallery Posts Title</label>
                        <input type="text" class="myinput2" name="gallery_posts_title_text" value="<?= $gallery_posts_title->text ?>" placeholder="Title">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_posts_title_fontsize" value="<?= $gallery_posts_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_posts_title_fontsize_mobile" value="<?= $gallery_posts_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Gallery Posts Title Font</label>
                        <select class="myinput2" name="gallery_posts_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $gallery_posts_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="gallery_posts_title_color" value="<?= $gallery_posts_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group gallery_posts_title_banner_color" style="<?php echo $gallery_posts_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="gallery_posts_title_block_color" value="<?= $gallery_posts_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch gallery_posts_bg_color title-banner-toggle" name="gallery_posts_title_setting" data-slug="gallery_posts_title" <?= $gallery_posts_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <hr style="border-top: 5px solid rgba(0,0,0,.1)">
              </div>
            </div>
            <div class="content2" id="title_banner_gallery_slider">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 gallery_slider_title">
                      <div class="title-2 tbt-title">Gallery Slider </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="gallery_slider_title" <?= $gallery_slider_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="gallery_slider_title">
                        <div class="title-2 h1tag <?= $gallery_slider_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $gallery_slider_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gallery Slider Title</label>
                        <input type="text" class="myinput2" name="gallery_slider_title_text" value="<?= $gallery_slider_title->text ?>" placeholder="Title">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_slider_title_fontsize" value="<?= $gallery_slider_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_slider_title_fontsize_mobile" value="<?= $gallery_slider_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Gallery Slider Title Font</label>
                        <select class="myinput2" name="gallery_slider_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $gallery_slider_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="gallery_slider_title_color" value="<?= $gallery_slider_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group gallery_slider_title_banner_color" style="<?php echo $gallery_slider_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="gallery_slider_title_block_color" value="<?= $gallery_slider_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch gallery_slider_bg_color title-banner-toggle" name="gallery_slider_title_setting" data-slug="gallery_slider_title" <?= $gallery_slider_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <hr style="border-top: 5px solid rgba(0,0,0,.1)">
              </div>
            </div>
            <div class="content2" id="title_banner_gallery_tiles">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 gallery_tiles_title">
                      <div class="title-2 tbt-title">Gallery Tiles </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>
                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="gallery_tiles_title" <?= $gallery_tiles_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>

                      <div class="tagswitch ml-10" data-slug="gallery_tiles_title">
                        <div class="title-2 h1tag <?= $gallery_tiles_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $gallery_tiles_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gallery Tiles Title</label>
                        <input type="text" class="myinput2" name="gallery_tiles_title_text" value="<?= $gallery_tiles_title->text ?>" placeholder="Title">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_tiles_title_font_size" value="<?= $gallery_tiles_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_tiles_title_font_size_mobile" value="<?= $gallery_tiles_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Gallery Tiles Font</label>
                        <select class="myinput2" name="gallery_tiles_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $gallery_tiles_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="gallery_tiles_title_color" value="<?= $gallery_tiles_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group gallery_tiles_title_banner_color" style="<?php echo $gallery_tiles_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="gallery_tiles_title_background_color" value="<?= $gallery_tiles_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch gallery_tiles_bg_color title-banner-toggle" name="gallery_tiles_title_setting" data-slug="gallery_tiles_title" <?= $gallery_tiles_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_gallery_videos">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 gallery_videos_title">
                      <div class="title-2 tbt-title">Gallery Videos </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="gallery_videos_title" <?= $gallery_videos_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="gallery_videos_title">
                        <div class="title-2 h1tag <?= $gallery_videos_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $gallery_videos_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Gallery Videos Title</label>
                        <input type="text" class="myinput2" name="gallery_videos_title_text" value="<?= $gallery_videos_title->text ?>" placeholder="Title">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_videos_title_fontsize" value="<?= $gallery_videos_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="gallery_videos_title_fontsize_mobile" value="<?= $gallery_videos_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Gallery Videos Title Font</label>
                        <select class="myinput2" name="gallery_videos_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $gallery_videos_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Title Text Color</label>
                        <input type="color" class="myinput2" name="gallery_videos_title_color" value="<?= $gallery_videos_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group gallery_videos_title_banner_color" style="<?php echo $gallery_videos_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="gallery_videos_title_block_color" value="<?= $gallery_videos_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch gallery_videos_bg_color title-banner-toggle" name="gallery_videos_title_setting" data-slug="gallery_videos_title" <?= $gallery_videos_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <hr style="border-top: 5px solid rgba(0,0,0,.1)">
              </div>
            </div>
            <div class="content2" id="title_banner_hyperlinks">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 hyperlinks_title">
                      <div class="title-2 tbt-title">Hyperlinks </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>
                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="links_title" <?= $links_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="links_title">
                        <div class="title-2 h1tag <?= $links_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $links_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Hyperlinks Title</label>
                          <input type="text" class="myinput2" name="links_title" value="<?= $links_title->text ?>" placeholder="">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="links_title_font_size" value="<?= $links_title->size_web ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="links_title_font_size_mobile" value="<?= $links_title->size_mobile ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Hyperlinks Title Font</label>
                          <select class="myinput2" name="links_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $links_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> Text Color</label>
                          <input type="color" class="myinput2" name="links_title_color" value="<?= $links_title->color ?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group links_title_banner_color" style="<?php echo $links_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="links_title_back_color" value="<?= $links_title->bg_color ?>" placeholder="">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch links_bg_color title-banner-toggle" name="links_title_setting" data-slug="links_title" <?= $links_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_newsfeed">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 news_feed_title">
                      <div class="title-2 tbt-title">News Feed </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="news_feed_title" <?= $news_feed_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="news_feed_title">
                        <div class="title-2 h1tag <?= $news_feed_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $news_feed_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>News Feed Title</label>
                          <input type="text" class="myinput2" name="news_feed_title_text" value="<?= $news_feed_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="news_feed_title_fontsize" value="<?= $news_feed_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="news_feed_title_fontsize_mobile" value="<?= $news_feed_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">News Feed Title Font</label>
                          <select class="myinput2" name="news_feed_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $news_feed_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text Color</label>
                          <input type="color" class="myinput2" name="news_feed_title_color" value="<?= $news_feed_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group news_feed_title_banner_color" style="<?php echo $news_feed_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="news_feed_title_background_color" value="<?= $news_feed_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch news_feed_bg_color title-banner-toggle" name="news_feed_title_setting" data-slug="news_feed_title" <?= $news_feed_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_news_posts">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 news_post_title">
                      <div class="title-2 tbt-title">News Posts </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="news_posts_title" <?= $news_posts_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="news_posts_title">
                        <div class="title-2 h1tag <?= $news_posts_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $news_posts_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>News Posts Title</label>
                          <input type="text" class="myinput2" name="news_posts_title_text" value="<?= $news_posts_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="news_posts_title_fontsize" value="<?= $news_posts_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="news_posts_title_fontsize_mobile" value="<?= $news_posts_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">News Posts Title Font</label>
                          <select class="myinput2" name="news_posts_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $news_posts_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text Color</label>
                          <input type="color" class="myinput2" name="news_posts_title_color" value="<?= $news_posts_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group news_posts_title_banner_color" style="<?php echo $news_posts_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="news_posts_title_block_color" value="<?= $news_posts_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch news_posts_bg_color title-banner-toggle" name="news_posts_title_setting" data-slug="news_posts_title" <?= $news_posts_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_review_staff">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 reviews_staff_title">
                      <div class="title-2 tbt-title">Reviews Posting</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="reviews_staff_title" <?= $reviews_staff_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="reviews_staff_title">
                        <div class="title-2 h1tag <?= $reviews_staff_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $reviews_staff_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Reviews Posting Title</label>
                          <input type="text" class="myinput2" name="reviews_staff_title_text" value="<?= $reviews_staff_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="reviews_staff_title_fontsize" value="<?= $reviews_staff_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="reviews_staff_title_fontsize_mobile" value="<?= $reviews_staff_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Reviews Posting Title Font</label>
                          <select class="myinput2" name="reviews_staff_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $reviews_staff_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text Color</label>
                          <input type="color" class="myinput2" name="reviews_staff_title_color" value="<?= $reviews_staff_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group reviews_staff_title_banner_color" style="<?php echo $reviews_staff_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="reviews_staff_title_block_color" value="<?= $reviews_staff_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch reviews_staff_bg_color title-banner-toggle" name="reviews_staff_title_setting" data-slug="reviews_staff_title" <?= $reviews_staff_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="staff_products_promos_title">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 staff_products_promos_title">
                      <div class="title-2 tbt-title">Staff Products Promos</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="staff_products_promos_title" <?= $staff_products_promos_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="staff_products_promos_title">
                        <div class="title-2 h1tag <?= $staff_products_promos_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $staff_products_promos_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Staff Products Promos Title</label>
                          <input type="text" class="myinput2" name="staff_products_promos_title_text" value="<?= $staff_products_promos_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="staff_products_promos_title_fontsize" value="<?= $staff_products_promos_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="staff_products_promos_title_fontsize_mobile" value="<?= $staff_products_promos_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">Staff Products Promos Title Font</label>
                          <select class="myinput2" name="staff_products_promos_title_font_family">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $staff_products_promos_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label> Text Color</label>
                          <input type="color" class="myinput2" name="staff_products_promos_title_color" value="<?= $staff_products_promos_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group staff_products_promos_title_banner_color" style="<?php echo $staff_products_promos_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label> Banner Color</label>
                          <input type="color" class="myinput2" name="staff_products_promos_title_block_color" value="<?= $staff_products_promos_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch staff_products_promos_bg_color title-banner-toggle" name="staff_products_promos_title_setting" data-slug="staff_products_promos_title" <?= $staff_products_promos_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_rotating_schedule">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 schedule_rotating_title">
                      <div class="title-2 tbt-title">Schedule Rotating </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="schedule_title" <?= $schedule_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="schedule_title">
                        <div class="title-2 h1tag <?= $schedule_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $schedule_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Rotating Schedule Title</label>
                        <input type="text" class="myinput2" name="schedule_title_text" value="<?= $schedule_title->text ?>" placeholder="Title">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="schedule_title_fontsize" value="<?= $schedule_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="schedule_title_fontsize_mobile" value="<?= $schedule_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Rotating Schedule Title Font</label>
                        <select class="myinput2" name="schedule_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $schedule_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Text Color</label>
                        <input type="color" class="myinput2" name="schedule_title_color" value="<?= $schedule_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group schedule_title_banner" style="<?php echo $schedule_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label> Banner Color</label>
                        <input type="color" class="myinput2" name="schedule_title_block_color" value="<?= $schedule_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch schedule_bg_color title-banner-toggle" name="schedule_title_setting" data-slug="schedule_title" <?= $schedule_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_set_schedule">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 schedule_set_title">
                      <div class="title-2 tbt-title">Schedule Set </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="set_hours_title" <?= $set_hours_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="set_hours_title">
                        <div class="title-2 h1tag <?= $set_hours_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $set_hours_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Set Schedule Title</label>
                        <input type="text" class="myinput2" name="set_hours_title_text" value="<?= $set_hours_title->text ?>" placeholder="Header text">
                      </div>
                    </div>
                  <?php } ?>
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="set_hours_title_fontsize" value="<?= $set_hours_title->size_web ?>" placeholder="12px">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="set_hours_title_fontsize_mobile" value="<?= $set_hours_title->size_mobile ?>" placeholder="12px">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Set Schedule Title Font</label>
                        <select class="myinput2" name="set_hours_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $set_hours_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label> Text Color</label>
                        <input type="color" class="myinput2" name="set_hours_title_color" value="<?= $set_hours_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group set_hours_title_banner_color" style="<?php echo $set_hours_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                        <label> Banner color</label>
                        <input type="color" class="myinput2" name="set_hours_title_block_color" value="<?= $set_hours_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="bannertext">Banner to Match Theme Background Color</label><br>
                        <label class="switch">
                          <input type="checkbox" class="notificationswitch set_hours_bg_color title-banner-toggle" name="set_hours_title_setting" data-slug="set_hours_title" <?= $set_hours_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <hr style="border-top: 5px solid rgba(0,0,0,.1)">
              </div>
            </div>
            <div class="content2" id="title_banner_seo_block">
              <div class="row">
                <div class="col-md-12">
                  <div class="position-relative">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 seo_title">
                      <div class="title-2 tbt-title">SEO Block</div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                    <div class="form-group switchOverHeadCenter">
                      <div class="title-banner-toggle-container">
                        <label class="m-0"><span class="tbt-label">Hide/</span>Show</label>

                        <label class="switch ml-2">
                          <input type="checkbox" class="notificationswitch titleEnable" data-slug="seo_title" <?= $seo_title->enable == '1' ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <div class="tagswitch ml-10" data-slug="seo_title">
                        <div class="title-2 h1tag <?= $seo_title->tag == 'h1' ? 'active' : '' ?>" data-value="0">H1 Tag</div>
                        <div class="title-2 h3tag ml-2  <?= $seo_title->tag == 'h3' ? 'active' : '' ?>" data-value="1">H3 Tag</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div id="">
                  <div class="row">
                    <?php if (check_auth_permission(['title_banners', 'title_banner_text_input'])) { ?>
                      <div class="col-md-4" id="seo_title_text">
                        <div class="form-group">
                          <label>SEO Title</label>
                          <input type="text" class="myinput2" name="seo_title_text" value="<?= $seo_title->text ?>" placeholder="Title">
                        </div>
                      </div>
                    <?php } ?>
                    <?php if (check_auth_permission('title_banners')) { ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Web</label><br>
                          <input type="text" class="myinput2 width-50px" name="seo_title_font_size_web" value="<?= $seo_title->size_web ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Size on Mobile</label><br>
                          <input type="text" class="myinput2 width-50px" name="seo_title_font_size_mobile" value="<?= $seo_title->size_mobile ?>" placeholder="12">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="title_font_size">SEO Title Font</label>
                          <select class="myinput2" name="seo_title_font">
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $seo_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Text Color</label>
                          <input type="color" class="myinput2" name="seo_title_color" value="<?= $seo_title->color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group seo_title_banner_color" style="<?php echo $seo_title_setting->enable_theme_bg == '1' ? 'display:none' : ''; ?>">
                          <label>Banner Color</label>
                          <input type="color" class="myinput2" name="seo_title_background" value="<?= $seo_title->bg_color ?>" placeholder="#000000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Banner to Match Theme Background Color</label><br>
                          <label class="switch">
                            <input type="checkbox" class="notificationswitch seo_match_bg_color title-banner-toggle" name="seo_title_setting" data-slug="seo_title" <?= $seo_title_setting->enable_theme_bg == '1' ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>

                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2" id="title_banner_reset">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="title-2">Generic Settings</div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row" id="">
                  <?php if (check_auth_permission('title_banners')) { ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="title_font_size">Title Font</label>
                        <select class="myinput2" name="reset_title_font_family">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $reset_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="reset_title_fontsize" value="<?= $reset_title->size_web ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="reset_title_fontsize_mobile" value="<?= $reset_title->size_mobile ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="reset_title_color" value="<?= $reset_title->color ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Banner Color</label>
                        <input type="color" class="myinput2" name="reset_title_block_color" value="<?= $reset_title->bg_color ?>" placeholder="#000000">
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="row  mt-2">
                  <div class="col-md-12">
                    <button type="submit" name="reset_title_banners" class="btn btn-primary" value="save">Reset</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-bottom make-sticky">
              <div class="col-md-12">
                <button type="submit" name="save_titles_banners" class="btn btn-primary" value="save">Save</button>
                <button type="submit" name="save_titles_banners" class="btn btn-primary" value="savereminders">Save & send reminder</button>

              </div>
            </div>
            <div id="title_banner_bottom"></div>
          </div>
          <div class="titles-jump-div sticky-buttons-list">
            <div class="pb-2  pt-2 mb-1 jump-to-buttons make-jumto-sticky" align="center">
              <div data-value="title_banner_blog_block" class="title-jump-btns">Blog</div>
              <div class="d-lg-flex">
                <div data-value="title_banner_contact_information" class="title-jump-btns">Contact Box</div>
                <div data-value="title_banner_contact_form" class="title-jump-btns">Contact Forms</div>
              </div>
              <div data-value="title_banner_content_block" class="title-jump-btns">Content Block</div>
              <div data-value="title_banner_download_section" class="title-jump-btns">Downloads</div>
              <div data-value="title_banner_faq" class="title-jump-btns">FAQs</div>
              <div data-value="form_title_text" class="title-jump-btns">Form Links</div> <!-- (Hassan) Change name -->
              <div class="d-lg-flex">
                <div data-value="title_banner_gallery_tiles" class="title-jump-btns">Gallery Tiles</div>
                <div data-value="title_banner_gallery_slider" class="title-jump-btns">Gallery Slider</div>
              </div>
              <div class="d-lg-flex">
                <div data-value="title_banner_gallery_videos" class="title-jump-btns">Gallery Videos</div>
                <div data-value="title_banner_gallery_post" class="title-jump-btns">Gallery Posts</div>
              </div>
              <div data-value="title_banner_hyperlinks" class="title-jump-btns">Hyperlinks</div>
              <div data-value="title_banner_newsfeed" class="title-jump-btns">News Feed</div>
              <div data-value="title_banner_news_posts" class="title-jump-btns">News Posts</div>
              <div data-value="title_banner_review_staff" class="title-jump-btns">Reviews Posting</div>
              <div data-value="staff_products_promos_title" class="title-jump-btns">Staff Products Promos</div>
              <div class="d-lg-flex">
                <div data-value="title_banner_rotating_schedule" class="title-jump-btns">Schedule Rotating</div>
                <div data-value="title_banner_set_schedule" class="title-jump-btns">Schedule Set</div>
              </div>
              <div data-value="title_banner_seo_block" class="btn-jump title-jump-btns mb-6">SEO Block</div>
              <div align="center">
                <div data-value="title_banner_reset" class="title-jump-btns width-fit-content">Generic Settings</div>
              </div>
            </div>
          </div>
      </form>
    </div>
  </div>
  </div>

<?php } ?>
<?php if (check_auth_permission(['build_site_Content'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="build_site_content_bluebar" data-tip_section="build_site_Content">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">BuildSite Content</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
          </div>
        </div>
      </div>
    </div>

    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'build_site_content_bluebar' ? 'display:block;' : '' ?>">
      <div class="content2">
        <form action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Frontend Outlines</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-md-12 text-right">
                <div class="form-group align-all-right ">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?= $master_feature_settings->outline_color ?>" placeholder="#000000" data-slug="master_feature_settings">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Popup Alert</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="popup_alert">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'popup_alert'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$popup_alert_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Header Slider</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="header_slider">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'header_slider'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$header_slider_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Header Logo</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="header_logo">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'header_logo'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$header_logo_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Header Images</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="header_images">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'header_images'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$header_image_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Header Buttons</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="header_buttons">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'header_buttons'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$header_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Header Text</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="header_text">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'header_text'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$header_text_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Nav Bar</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="navbar">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'navbar'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$navbar_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Feature Toggle</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="feature_toggle">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'feature_toggle'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$feature_toggle_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Social Media</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="social_media">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'social_media'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$social_media_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Pulldown Menu</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="pull_down">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'pull_down'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$pull_down_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">News Feed</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="news_feed">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'news_feed'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$news_feed_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Gallery Video</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="gallery_video">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'gallery_video'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$gallery_video_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Content Block</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="content">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'content'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$content_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Contact Boxes</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="contact_box">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'contact'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$contact_box_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Contact Forms</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="contact_forms">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'contact_forms'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$contact_form_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Hyperlinks</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="hyperlinks">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'hyperlinks'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$hyperlinks_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Review Posting</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="reviews">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'reviews'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$reviews_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">FAQs</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="faqs">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'faqs'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$faq_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Seo Block</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="seo">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'seo'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$seo_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Download Files</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="download">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'download'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$download_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Blog</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="blog">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'blog'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$blog_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Forms</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="forms">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'forms'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$forms_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">News Posts</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="news_posts">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'news_posts'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$news_posts_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Staff Promo Code</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="staff_promo">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'staff_promo'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$staff_promo_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Gallery Tiles</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="tiles">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'tiles'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$tiles_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Footer</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="footer">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'footer'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$footer_buttons" customClass="popup-alert-buttons" />
              </div>
          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Gallery Slider</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-1">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="slider">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'content'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$slider_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Alert Banner</div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-2">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="alert_banner">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'alert_banner'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$alert_banner_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Set Schedule<Section></Section>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-4">
            <div class="row">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="set_schedule">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'set_schedule'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$set_schedule_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Rotating Schedule<Section></Section>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-5">
            <div class="row ml-4">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="rotating_schedule">
                <x-action-buttons :saveText="'Update Alert'" :featureSlug="'rotating_schedule'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$rotating_schedule_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" action="{{url('updateActionButton')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">Gallery Posts<Section></Section>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-6">
            <div class="row ml-4">
              <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button>
            </div>
              <div class="col-md-12 text-center duplicate-row">
                <input type="hidden" name="featureSlug" value="gallery_posts">
                <x-action-buttons :saveText="'Update Alert'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$gallery_posts_buttons" customClass="popup-alert-buttons" />
              </div>

          </div>
        </form>
      </div>
      <div class="content2">
        <form class="data-form" class="data-form" action="{{url('updateBusinessCoach')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="title-2">SA Business Coach Button<Section></Section>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 action-buttons-container" id="action-buttons-container-7">
            <div class="row">
              <!-- <button type="button" id="add-action-button" class="btn btn-primary">Add action button</button> -->
              <div class="col-md-12 sa-business">
                <!-- <div class="col-md-12 text-center"> -->
                <div class="col-md-4 col-xs-12">
                  <div class="form-group quilleditor-div action_fields  action_textpopup">
                    <label>enfohub News</label>
                    <textarea class="myinput2 editordata hidden" name="enfohub_news"><?php echo $news->text; ?></textarea>
                    <div class="quilleditor">
                      <?php echo $news->text; ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xs-12">
                  <div class="form-group quilleditor-div action_fields  action_textpopup">
                    <label>Welcome Message</label>
                    <textarea class="myinput2 editordata hidden" name="welcome_message"><?php echo $welcome->text; ?></textarea>
                    <div class="quilleditor"><?php echo $welcome->text; ?>
                    </div>
                  </div>
                </div>
                <div class="row form-bottom make-sticky">
                  <div class="col-md-12">
                    <button type="submit" name="savereviewsstaff" class="btn btn-primary" value="save">Save</button>
                    <button type="submit" name="savereviewsstaff" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                  </div>
                </div>
              </div>
                <!-- </div> -->
                <!-- <input type="hidden" name="featureSlug" value="gallery_posts"> -->
                <!-- <x-action-buttons :saveText="'Update Alert'" :resetText="'Reset'" :frontSections="$front_sections" :buttonName="$alert_popup_feature_action_button_text" :customForms="$customForms" :addresses="$addresses" :allButtons="$alert_banner_buttons" customClass="popup-alert-buttons"/> -->
        </form>

      </div>
    </div>
    <div class="col-md-12 editcontent2">
      <a href="<?= base_url('addbusinesscoachcategory') ?>"><button type="button" class="btn btn-sm btn-primary mb-4 mt-4">Add Category</button></a>
    </div>
    @foreach($categories as $key => $category)
    <div class="content4 editcontent2 buttons_sortable sort">
      <div class="staff_div" data-sectionid="{{ $category->id }}">
        <form class="data-form staff_div"  action="{{url('updateBusinessCoach')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn4">
                        <div class="title-2">{{ $category->name }}
                            <Section></Section>
                        </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                </div>
            </div>
            <div class="editcontent4 action-buttons-container" id="action-buttons-container-6">
                <div class="row">
                  <button type="button" id="add-action-button" class="btn btn-primary ml-3 mt-3">Add action button</button>
                </div>
                    <div class="col-md-12 text-center duplicate-row">
                        <input type="hidden" name="featureSlug[]" value="{{ $category->name }}">
                        @if($categories_buttons->contains('feature_slug', $category->name))
                            <?php $buttons = $categories_buttons; ?>
                        @else
                            <?php $buttons = null; ?>
                        @endif

                        <x-action-buttons 
                            :saveText="'Update Alert'" 
                            :featureSlug="$category->name" 
                            :resetText="'Reset'" 
                            :frontSections="$front_sections" 
                            :buttonName="$alert_popup_feature_action_button_text" 
                            :customForms="$customForms" 
                            :addresses="$addresses" 
                            :allButtons="$buttons" 
                            customClass="popup-alert-buttons" 
                        />
                    </div>
            </div>
        </form>
      </div>
    </div>
@endforeach
<!-- 
  </div>
  </div>

  </div>
  </div> -->


<?php } ?>

<div class="faqtrmplatediv" style="display:none;">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label>Question</label>
        <textarea class="myinput2" name="faq_question[]" cols="30" rows="3"></textarea>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Question Text Size</label><br>
        <input type="text" class="myinput2 width-50px" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_question_font_size[]" value="" placeholder="">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Question Text Color</label>
        <input type="color" class="myinput2" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_question_text_color[]" value="" placeholder="#000">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Question Font</label>
        <select class="myinput2" name="faq_question_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
          <?php if (count($font_family) > 0) { ?>
            <?php foreach ($font_family as $singlef) { ?>
              <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <br>
      <button type="button" class="btn btn-primary btnremoverow">X</button>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Answer</label>
        <textarea class="myinput2" name="faq_answer[]" id="" cols="30" rows="3"></textarea>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Answer Text Size</label><br>
        <input type="text" class="myinput2 width-50px" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_answer_font_size[]" value="" placeholder="">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Answer Text Color</label>
        <input type="color" class="myinput2" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?> name="faq_answer_text_color[]" value="" placeholder="#000">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Answer Font</label>
        <select class="myinput2" name="faq_answer_font_family[]" <?php if ($faqSettings->use_generic) { ?> disabled <?php } ?>>
          <?php if (count($font_family) > 0) { ?>
            <?php foreach ($font_family as $singlef) { ?>
              <option style="font-family: <?= $singlef->value ?>;" value="<?= $singlef->id ?>"><?= $singlef->name ?></option>
            <?php } ?>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="linktrmplatediv" style="display:none;">
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label>Link text</label>
        <input type="text" class="myinput2" name="linktext[]" value="" placeholder="">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Link</label>
        <input type="text" class="myinput2" name="link[]" value="" placeholder="">
      </div>
    </div>
    <div class="col-md-2">
      <br>
      <button type="button" class="btn btn-primary btnRemoveHyperLink">X</button>
    </div>
  </div>
</div>

<div class="contentblocktrmplatediv" style="display:none;">
  <div class="single-cb">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Sub-Title</label>
          <input type="text" class="myinput2" name="title[]" value="" placeholder="">
          <input type="hidden" class="myinput2" name="content_block_inputs[]" value="1" placeholder="">
        </div>
      </div>
      <div class="col-md-4 text-right">
        <br>
        <button type="button" title="Remove Content Block" class=" btn btn-primary btnremoverow">X</button>
      </div>
      <div class="col-md-4">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6" id="descriptionDiv-content_count_number2">
        <div class="form-group quilleditor-div">
          <label>Description</label>
          <textarea class="myinput2 editordata hidden" name="description[]"></textarea>
          <div class="quilleditor">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <div class=" mt-2">
              <div>
                <button type="button" class="btn btn-primary  show_read_more_block_content_count_number toggle_show_read_more" data-value="content_count_number">Add Read More text block</button>
              </div>
              <div class="pt-1 pb-1">
                <label>
                  Reduce unwanted text, visitor can select the text they wish to read by clicking on <u>Read More</u>.
                </label>
              </div>
            </div>
          </div>

        </div>
        <div class="read_more_content_content_count_number" style="display:none">
          <div class="row ">
            <div class="col-md-12">
              <div class="form-group">
                <label>Input text for a Read More option</label>
                <input type="text" class="myinput2" name="read_more_text[]" placeholder="Read More" value="Read more">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group quilleditor-div">
                <label>Other Description</label>
                <textarea class="myinput2 editordata hidden" name="read_more_desc[]"></textarea>
                <div class="quilleditor">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Input text for a Read Less option</label>
                <input type="text" class="myinput2" name="read_less_text[]" placeholder="Read Less" value="Read less">
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- <div class="col-md-4" id="descriptionDiv1-content_count_number2" style="display:none">
          <div class="form-group">
            <label>Description 1</label>
            <textarea class="myinput2 buildquilleditor2" id='' name="description1[]" placeholder="" rows="5"></textarea>
          </div>
        </div>

        <div class="col-md-4" id="descriptionDiv2-content_count_number2" style="display:none">
          <div class="form-group">
            <label>Description 2</label>
            <textarea class="myinput2 buildquilleditor3" id='' name="description2[]" placeholder="" rows="5"></textarea>
          </div>
        </div>

        <div class="col-md-4" id="descriptionDiv3-content_count_number2" style="display:none">
          <div class="form-group">
            <label>Description 3</label>
            <textarea class="myinput2 buildquilleditor4" id='' name="description3[]" placeholder="" rows="5"></textarea>
          </div>
        </div>

      <?php if (check_auth_permission(['content_block', 'content_block_add_new'])) { ?>
        
        <div class="form-group">
          <center>
          <div class="col-md-12">
            <button type="button" onclick="showdescdiv(content_count_number2)" id="btnshow-content_count_number2" class="btn btn-primary" >Add</button>
            <button type="button" onclick="hidedescdiv(content_count_number2)" id="btnhide-content_count_number2" class="btn btn-primary ml-3" >Remove</button>
          </div>
      </center>
     
        </div>
      <?php }  ?> -->
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Sub-Title Text Color</label>
          <input type="color" class="myinput2" name="content_title_color[]" value="" placeholder="">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Sub-Title Text Size</label><br>
          <input type="text" class="myinput2 width-50px" name="content_title_font_size[]" value="" placeholder="">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="title_font_size">Sub-Title Text Font</label>
          <select class="myinput2" name="content_title_font_family[]">
            <?php if (count($font_family) > 0) { ?>
              <?php foreach ($font_family as $single) { ?>
                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Description Read More Text Color</label>
          <input type="color" class="myinput2" name="content_desc_color[]" value="" placeholder="">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Description Read More Text Size</label><br>
          <input type="text" class="myinput2 width-50px" name="content_desc_font_size[]" value="" placeholder="">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="title_font_size">Description Read More Text Font</label>
          <select class="myinput2" name="content_desc_font_family[]">
            <?php if (count($font_family) > 0) { ?>
              <?php foreach ($font_family as $single) { ?>
                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="uploadImageDiv">
          <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
          <input type="hidden" name="imagefromgallery" class="imagefromgallery">
          <input class="dataimage" type="hidden" name="new_content_image[]">
          <div class="col-md-6 imgdiv" style="display:none">
            <br>
            <img src='' width="100%" class="imagefromgallerysrc">
            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Content Image Size</label><br>
          <input type="number" class="myinput2 width-50px" name="content_image_size[]" value="" placeholder="e.g 275">
        </div>
      </div>
      <div class="col-md-12"><br /></div>
      <div class="col-md-5">
        <div class="form-group">
          <label for="bannertext">Action button active</label><br>
          <label class="switch">
            <input type="checkbox" class="notificationswitch" name="action_button_active[content_count_number2]">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="action_button_discription">Action Button Name</label>
          <input type="text" class="myinput2" name="action_button_discription[]" id="action_button_discription" value="Find Out More" placeholder="Type here...">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="action_button_discription_color">Action Button Text Color</label>
          <input type="color" class="myinput2" name="action_button_discription_color[]" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="action_button_bg_color">Action Button Color</label>
          <input type="color" class="myinput2" name="action_button_bg_color[]" id="action_button_bg_color" value="#000000" placeholder="#000000">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="action_button_link">Action Button Application</label>
          <select class="myinput2 news_post_action_buttoncontent_count_number action_button_selection" id="action_button_link" name="action_button_link[]">
            <option value="link">Link</option>
            <option value="call">Call</option>
            <option value="sms">SMS</option>
            <option value="email">Email</option>
            <option value="video">Video</option>
            <option value="audioiconfeature">Audio Icon Feature</option>
            <option value="google_map">Map</option>
            <option value="text_popup">Text Popup</option>
            <option value="address">Address</option>
            <option value="customforms">Forms</option>
            <?php foreach ($front_sections as $single2) { ?>
              <option value="<?= $single2->slug ?>"><?= $single2->name ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group action_fields phone_no_calls" style="display:none">
          <label for="">Phone number for calls</label>
          <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="<?= $single->action_button_phone_no_calls ?>">
        </div>
        <div class="form-group action_fields phone_no_sms" style="display:none">
          <label for="">Phone number for sms</label>
          <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="<?= $single->action_button_phone_no_sms ?>">
        </div>
        <div class="form-group action_fields action_email" style="display:none">
          <label for="">Email</label>
          <input type="text" class="myinput2" name="action_button_action_email[]" value="<?= $single->action_button_action_email ?>">
        </div>
        <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
          <label>Popup Text </label>
          <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"></textarea>
          <div class="quilleditor"></div>
        </div>
        <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
          <label for="customFile">Upload Video</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="cb_video_file[]" id="customFile" accept=".mp4">
            <label class="custom-file-label" for="customFile">Upload Video</label>
          </div>
        </div>
        <div class="form-group action_fields audio_icon_feature" name="cb_audio_icon_feature" style="display:none">
          <label for="customFile">Select File</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
            <label class="custom-file-label" for="customFile">Select File</label>
          </div>
        </div>
        <div class="form-group action_fields action_link" style="display:block">
          <input type="text" class="myinput2 news_post_linkcontent_count_number" name="action_button_link_text[]" id="news_post_linkcontent_count_number" value="" placeholder="http://google.com">
        </div>
        <div class="form-group action_fields action_forms" style="display:none">
          <select class="myinput2" name="action_button_customforms[]" id="customformscontent_count_number">
            <?php if (count($customForms) > 0) { ?>
              <?php foreach ($customForms as $single) { ?>
                <option value="<?= $single->id ?>"><?= $single->title ?></option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="form-group" style="display:none">
          <label for="addressbtn1">Select an Address</label>
          <select name="action_button_address_id[]" class="myinput2">
            <?php
            foreach ($addresses as $address) {
            ?>
              <option value="<?= $address->id ?>"><?= $address->address_title ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group action_fields action_map" style="display:none">
          <label for="address">Enter Address</label>
          <input type="text" class="myinput2 " name="action_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
        </div>
      </div>
      <div class="col-md-12">
        <hr style="border-top: 5px solid rgba(0,0,0,.1)">
      </div>
    </div>
  </div>
</div>


<div id="mycropmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-content" style="width: 500px;left: 33%;">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalCenterTitle">Select Image</h5>
      <button type="button" class="close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="padding-10">
      <div class="image-wrapper myimgrcroperdiv">
        <img class="myimage-rcroper" src="https://demo.webhound.tech/assets/uploads/<?php echo get_current_url() ?>898417-09-2021.png">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-primary mybtncropsave">Save</button>
    </div>
  </div>

</div>

<script>
  $(document).ready(function() {

    <?php if (count($contentBlockLinks) > 0) { ?> <?php
                                                  $content_count = 1;
                                                  $description_count = 0;
                                                  foreach ($contentBlockLinks as $single) { ?>
        @if($single->read_more_text)
        $(".read_more_content_{{$content_count}}").show();
        @else
        $(".read_more_content_{{$content_count}}").hide();
        @endif

        $(document).on('click', '.show_read_more_block_{{$content_count}}', function() {
          $(".read_more_content_{{$content_count}}").toggle();
        });
    <?php
                                                    $content_count++;
                                                  }
                                                } ?>
    $(document).on('click', '.toggle_show_read_more', function() {
      var did = $(this).data('value');
      $(".read_more_content_" + did).toggle();

    });
    $('.title-banner-toggle').change(function() {
      var isChecked = $(this).prop('checked') ? 1 : 0;
      var id = $(this).data('id');
      var slug = $(this).data('slug');
      if ($(this).prop('checked')) {
        $('.' + slug + '_banner_color').hide();
      } else {
        $('.' + slug + '_banner_color').show();
      }
      $.ajax({
        type: 'POST',
        url: '/updateTitleSetting',
        data: {
          id: id,
          slug: slug,
          value: isChecked,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          console.log(response)
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    })
    $('.enableswitch').change(function() {
      var checkboxName = $(this).attr('name');
      var isChecked = $(this).prop('checked') ? 1 : 0;
      $.ajax({
        type: 'POST',
        url: '/frontSetting',
        data: {
          name: checkboxName,
          value: isChecked,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          console.log(response)
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });
  });


  <?php
  if (isset($block) && $block != "") {
  ?>

    var id = "<?= $block ?>";
    $('html, body').animate({
      scrollTop: $('#' + id).offset().top - 60
    }, 100);

    $('#' + id).stop(true, true).addClass("locator-bg");
    setTimeout(() => {
      $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
    }, 5000);

    $('.form-bottom').removeClass('make-sticky');
    $('#section-top-link').attr('href', '#');
    $('#section-bottom-link').attr('href', '#');
    $('.section-buttons').hide();

    $('#' + id).closest('.content').find('.editcontent').show('slow');
    $('#' + id).closest('.content').find('.form-bottom').addClass('make-sticky');
    var section_start = $('#' + id).data('top');
    var section_end = $('#' + id).data('bottom');
    if (typeof(section_start) != 'undefined') {
      $('#section-top-link').attr('href', '#' + section_start);
      $('#section-bottom-link').attr('href', '#' + section_end);
      $('.section-buttons').show();
    }

    var tip_section = $('#' + id).data('tip_section');

    if (typeof(tip_section) != 'undefined') {
      openTip(tip_section);
    }
  <?php
  }
  ?>
  var contentblocks = parseInt('<?= $description_count ?>');

  function check_action_button(index) {

    if ($('.news_post_action_button' + index).val() == 'link') {
      $('.news_post_link' + index).show();
      $("#address-list-" + index).hide();
      $('#customforms' + index).hide();
    } else if ($('.news_post_action_button' + index).val() == 'customforms') {
      $('.news_post_link' + index).hide();
      $("#address-list-" + index).hide();
      $('#customforms' + index).show();
    } else if ($('.news_post_action_button' + index).val() == 'google_map' || $('.news_post_action_button' + index).val() == 'address') {
      $("#address-list-" + index).show();
      $('.news_post_link' + index).hide();
      $('#customforms' + index).hide();
    } else {
      $('.news_post_link' + index).hide();
      $("#address-list-" + index).hide();
      $('#customforms' + index).hide();
    }

  }
  $(document).ready(function() {


    <?php
    for ($i = 0; $i < $content_count; $i++) {
    ?>
      if ($('.news_post_action_button<?= $i ?>').val() == 'link') {
        $('.news_post_link<?= $i ?>').show();
        $("#address-list-<?= $i ?>").hide();
        $('#customforms<?= $i ?>').hide();
      } else if ($('.news_post_action_button<?= $i ?>').val() == 'customforms') {
        $('#customforms<?= $i ?>').show();
        $('.news_post_link<?= $i ?>').hide();
        $("#address-list-<?= $i ?>").hide();
      } else if ($('.news_post_action_button<?= $i ?>').val() == 'google_map' || $('.news_post_action_button<?= $i ?>').val() == 'address') {
        $("#address-list-<?= $i ?>").show();
        $('.news_post_link<?= $i ?>').hide();
        $('#customforms<?= $i ?>').hide();
      } else {
        $('.news_post_link<?= $i ?>').hide();
        $("#address-list-<?= $i ?>").hide();
        $('#customforms<?= $i ?>').hide();
      }

      $(document).on('change', '.news_post_action_button<?= $i ?>', function() {
        if ($(this).val() == 'link') {
          $('.news_post_link<?= $i ?>').show();
          $("#address-list-<?= $i ?>").hide();
          $('#customforms<?= $i ?>').hide();
        } else if ($(this).val() == 'customforms') {
          $('#customforms<?= $i ?>').show();
          $('.news_post_link<?= $i ?>').hide();
          $("#address-list-<?= $i ?>").hide();
        } else if ($(this).val() == 'google_map' || $(this).val() == 'address') {
          $("#address-list-<?= $i ?>").show();
          $('.news_post_link<?= $i ?>').hide();
          $('#customforms<?= $i ?>').hide();
        } else {
          $('.news_post_link<?= $i ?>').hide();
          $("#address-list-<?= $i ?>").hide();
          $('#customforms<?= $i ?>').hide();
        }
      });
    <?php
    }
    ?>
    checkSeeTips(sub_sections);
    popupStatus();
    var is_disabled = isTipsDisabled('frontend');

    if (is_disabled) {
      $("input[name='tippopups']").prop('checked', true);
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
      $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
    }
  });

  $(document).on("click", ".remindertype_hyperlink", function() {
    var thisval = $(this).val();
    if (thisval == '1') {
      $(".datetimediv_hyperlink").hide();
      $(".timeinmin_hyperlink").show();
    } else {
      $(".datetimediv_hyperlink").show();
      $(".timeinmin_hyperlink").hide();
    }
  });
  $(document).on("click", ".remindertype_content_block", function() {
    var thisval = $(this).val();
    if (thisval == '1') {
      $(".datetimediv_content_block").hide();
      $(".timeinmin_content_block").show();
    } else {
      $(".datetimediv_content_block").show();
      $(".timeinmin_content_block").hide();
    }
  });

  function getFile2() {
    document.getElementById("headerimg").click();
  }

  function getFile() {
    document.getElementById("headerlogo").click();
  }

  function getFilegallery() {
    document.getElementById("gallery-photo-add").click();
  }

  $(document).on('click', '.btnaddnew', function() {
    $('.faqdiv').append($('.faqtrmplatediv').html());
  });
  $(document).on('click', '.btnaddnewlink', function() {
    $('.faqdiv').append($('.linktrmplatediv').html());
  });
  var content_count = parseInt("<?= ($content_count) ? $content_count : 2 ?>");

  $(document).on('click', '.btnaddnewcontentblock', function() {
    $('.allcontentblockdiv').append($('.contentblocktrmplatediv').html().replace(/content_count_number2/g, content_count - 1).replace(/content_count_number/g, content_count));

    content_count = content_count + 1;
    contentblocks++;
    // buildquilleditor('buildquilleditor1');
    // buildquilleditor('buildquilleditor2');
    // buildquilleditor('buildquilleditor3');
    // buildquilleditor('buildquilleditor4');

  });

  $(document).on('click', '.btnaddnewlinksection', function() {
    $('.sectionlinksdiv').append($('.linktrmplatediv').html());
  });

  $(document).on('click', '.btnaddnewformsection', function() {
    $('.sectionformsdiv').append($('.formslink_temp').html());
  });

  $(document).on('click', '.btngallerypostimg', function() {
    $(this).closest('.form-group').find('.gallerypostfile').click();
  });
  $(document).on('click', '.btnremovegallerypost', function() {
    $('.deletepost').val($('.deletepost').val() + $(this).data('postid') + ',');
    $(this).closest('.gallerysinglepost').remove();
  });

  $(document).on('click', '.btnRemoveHyperLink', function() {
    var this_id = $(this).data('id');
    if (this_id) {
      $('.deleteLinkTextID').val($('.deleteLinkTextID').val() + ',' + this_id);
    }
    $.ajax({
      url: '<?= base_url('delHyperlink'); ?>',
      type: "POST",
      data: {
        link_id: this_id,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
    $(this).closest('.single-cb').remove();
    $(this).closest('.row').remove();
  });
  $(document).on('click', '.btnremoverow', function() {
    contentblocks--;
    $(this).closest('.single-cb').remove();
    $(this).closest('.row').remove();
  });

  $(document).on('click', '.btnRemoveFormLink', function() {
    $(this).closest('.row').remove();
    var id = $(this).data('id');
    if (id) {
      $.ajax({
        url: '<?= base_url('delformlink'); ?>',
        type: "POST",
        data: {
          id: id,
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {}
      });
    }
  });

  $(document).on('click', '.btnremovereview', function() {
    var reviewid = $(this).data('reviewid');
    $(this).closest('.reviewdiv').remove();
    $.ajax({
      url: '<?= base_url('delreview'); ?>',
      type: "POST",
      data: {
        reviewid: reviewid,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });
  $(document).on('click', '.btnremovestaffproductspromos', function() {
    var id = $(this).data('staff_products_promos_id');
    $(this).closest('.staff_products_promos_div').remove();
    $.ajax({
      url: '<?= base_url('delrestaffproductspromos'); ?>',
      type: "POST",
      data: {
        id: id,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });
  $(document).on('click', '.btnremovefaq', function() {
    var faqid = $(this).data('faqid');
    $(this).closest('.singlefadiv').remove();
    $.ajax({
      url: '<?= base_url('delfaq'); ?>',
      type: "POST",
      data: {
        faqid: faqid,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });
  $(document).on('click', '.btnfiledel', function() {
    var imgname = $(this).data('imgname');
    $(this).closest('.imgdiv').remove();
    $.ajax({
      url: '<?= url('deletedownloadfile'); ?>',
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        imgname: imgname
      },
      success: function(data) {

      }
    });
  });
  $(document).on('click', '.btnaudiofiledel', function() {
    var imgname = $(this).data('imgname');
    $(this).closest('.imgdiv').remove();
    $.ajax({
      url: '<?= base_url('admin/frontend/delaudiofile'); ?>',
      type: "POST",
      data: {
        imgname: imgname
      },
      success: function(data) {}
    });
  });
  $(document).on('click', '.review_Staff_delete_btn', function() {
    $(this).parent().closest('.reviewdiv').find('.review_staff_image_upload_btn').show()
  });
  $(document).on('click', '.staff_products_promos_delete_btn', function() {
    $(this).parent().closest('.staff_products_promos_div').find('.staff_products_promos_image_upload_btn').show()
  });

  function remove_content_image(id) {
    $('#content_image' + id).val('');
    $('.content_image_div' + id).hide();
  }
  var div_id = 1000;

  function delete_review(div) {
    $('.' + div).remove();
  }

  function add_div() {
    div_id++;
    var review_html = ' <br/> <hr style="border-top: 5px solid rgba(0,0,0,.1)"></hr><div class="row reviewdiv">';

    <?php if (check_auth_permission(['review_staff', 'review_staff_delete'])) { ?>
      review_html += '<div class="col-md-3 col-xs-12 review_staff_image_upload_btn" style="display: block;"> <div class="uploadImageDiv"> <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>                          <input type="hidden" name="imagefromgallery[]" class="imagefromgallery"><input class="dataimage" type="hidden" name="userfile[]"><div class="col-md-6 imgdiv" style="display:none"><br>     <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>   </div> </div>  </div>';
    <?php
    } ?>
    <?php if (check_auth_permission(['review_staff', 'reviews_staff_text'])) {
    ?>
      review_html += '<div class="col-md-3 col-xs-12"><div class="form-group"><label>Description Text</label><textarea name="reviews_staff_text[]" class="myinput2" id="" cols="30" rows="4" style="height: 100px;"></textarea> </div></div>';
    <?php
    } ?>

    <?php if (check_auth_permission('review_staff')) { ?>

      review_html += '<div class="col-md-2 col-xs-12"> <div class="form-group"><label>Description Text size</label><br> <input type="text" class="myinput2 width-50px" name="reviews_text_size[]" value="" placeholder="16"> </div> </div> <div class="col-md-2 col-xs-12"> <div class="form-group">  <label>Description Text color</label> <input type="color" class="myinput2 myinput2 width-50px" name="reviews_text_color[]" value=""> </div> </div>';

      <?php if (check_auth_permission(['review_staff', 'review_staff_delete'])) { ?>

        review_html += '<div class="col-md-2 col-xs-4"><br><button type="button" class="btn btn-primary btnremovereview" onclick="delete_review_item(' + div_id + ')">Delete Review</button></div>';
      <?php } ?>

      review_html += '<div class="col-md-3 col-xs-12"></div><div class="col-md-3 col-xs-12"><div class="form-group"><label>Select Font</label><select class="myinput2" name="reviews_text_font[]">';
      <?php if (count($font_family) > 0) { ?>
        <?php foreach ($font_family as $singlef) { ?>

          review_html += '<option style="font-family: <?= str_replace("'", '', $singlef->value) ?>;" value="<?= $singlef->id ?>" ><?= $singlef->name ?></option>';
        <?php } ?>
      <?php } ?>

      review_html += '</select> </div></div> <div class="col-md-2 col-xs-12"><div class="form-group"> <label>Number of Stars/Ratig</label><br> <select class="myinput2 width-60px" name="reviews_stars[]">';

      <?php
      if (count($stars) > 0) { ?>
        <?php
        foreach ($stars as $star) { ?>
          review_html += '<option value="<?= $star ?>" ><?= $star ?></option>';
        <?php } ?>
      <?php } ?>

      review_html += '</select> </div> </div> <div class="col-md-2 col-xs-8"> <div class="form-group"> <label>Star color</label><br><input type="color" class="myinput2  width-60px" name="reviews_star_color[]" value=""> </div>   </div>';
    <?php
    } ?>


    review_html += '</div><br>';


    $(".reviews_staff").append(review_html);
  }

  function add_staff_product_div() {
    div_id++;
    var review_html = ' <br/> <div class="row staff_products_promos_div"><hr style="border-top: 5px solid rgba(0,0,0,.1)">';

    <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_delete'])) { ?>
      review_html += '<div class="col-md-3 col-xs-12 staff_products_promos_image_upload_btn" style="display: block;"> <div class="uploadImageDiv"> <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>                          <input type="hidden" name="imagefromgallery[]" class="imagefromgallery"><input class="dataimage" type="hidden" name="userfile[]"><div class="col-md-6 imgdiv" style="display:none"><br>     <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>   </div> </div>  </div>';
    <?php
    } ?>
    <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_text'])) {
    ?>
      review_html += '<div class="col-md-3 col-xs-12"><div class="form-group"><label>Description Text</label><textarea name="staff_products_promos_text[]" class="myinput2" id="" cols="30" rows="4"></textarea> </div></div>';
    <?php
    } ?>

    <?php if (check_auth_permission('staff_products_promos')) { ?>

      review_html += '<div class="col-md-3 col-xs-12"> <div class="form-group"><label>Description Text size</label><br> <input type="text" class="myinput2 width-50px" name="staff_products_promos_text_size[]" value="" placeholder="16"> </div> </div> <div class="col-md-3 col-xs-12"> <div class="form-group">  <label>Description Text color</label> <input type="color" class="myinput2" name="staff_products_promos_text_color[]" value=""> </div> </div><div class="col-md-3 col-xs-12"><div class="form-group"><label>Select Font</label><select class="myinput2" name="staff_products_promos_text_font[]">';
      <?php if (count($font_family) > 0) { ?>
        <?php foreach ($font_family as $singlef) { ?>

          review_html += '<option style="font-family: <?= str_replace("'", '', $singlef->value) ?>;" value="<?= $singlef->id ?>" ><?= $singlef->name ?></option>';
        <?php } ?>
      <?php } ?>

      review_html += '</select> </div></div> <div class="col-md-3 col-xs-12"><div class="form-group"> <label>Number of Stars/Ratig</label><br> <select class="myinput2 width-60px" name="staff_products_promos_stars[]">';

      <?php
      if (count($stars) > 0) { ?>
        <?php
        foreach ($stars as $star) { ?>
          review_html += '<option value="<?= $star ?>" ><?= $star ?></option>';
        <?php } ?>
      <?php } ?>

      review_html += '</select> </div> </div> <div class="col-md-3 col-xs-8"> <div class="form-group"> <label>Star color</label><input type="color" class="myinput2" name="staff_products_promos_text_star_color[]" value=""> </div>   </div>';
    <?php
    } ?>
    <?php if (check_auth_permission(['staff_products_promos', 'staff_products_promos_delete'])) { ?>

      review_html += '<div class="col-md-3 col-xs-4"><br><button type="button" class="btn btn-primary btnremovestaffproductspromos" onclick="delete_staff_products_promos_item(' + div_id + ')">Delete Staff Products Promos</button></div>';
    <?php } ?>

    review_html += '</div><br>';


    $(".staff_products_promos").append(review_html);
  }
</script>
<script src="<?php echo base_url() ?>/assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
  tinymce.init({
    selector: "textarea#editable",
    plugins: "preview powerpaste table casechange searchreplace autolink autosave save directionality advcode visualblocks visualchars image link media mediaembed template codesample charmap pagebreak nonbreaking anchor advlist lists checklist wordcount tinymcespellchecker a11ychecker help formatpainter permanentpen pageembed linkchecker emoticons export",
  });
</script>
<script>
  $(document).ready(function() {

    <?php

    ?>
  });


  function showdescdiv(id) {
    if ($('#descriptionDiv1-' + id + '').css('display') == 'none') {
      $('#descriptionDiv1-' + id + '').show();
      $('#btnhide-' + id + '').show();
    } else if ($('#descriptionDiv2-' + id + '').css('display') == 'none') {
      $('#descriptionDiv2-' + id + '').show();
      $('#btnhide-' + id + '').show();
    } else if ($('#descriptionDiv3-' + id + '').css('display') == 'none') {
      $('#descriptionDiv3-' + id + '').show();
      $('#btnhide-' + id + '').show();
    }
  }

  function hidedescdiv(id) {
    if ($('#descriptionDiv3-' + id + '').css('display') == 'block') {
      $('#descriptionDiv3-' + id + '').hide();
      $('#descriptionDiv3-' + id + '').find('textarea').val('');
      $('#descriptionDiv3-' + id + '').find('.ql-editor').html('');
      $('#descriptionDiv3-' + id + ' textarea').val('');
      $('#btnshow-' + id + '').show();
    } else if ($('#descriptionDiv2-' + id + '').css('display') == 'block') {
      $('#descriptionDiv2-' + id + '').hide();
      $('#descriptionDiv2-' + id + '').find('textarea').val('');
      $('#descriptionDiv2-' + id + '').find('.ql-editor').html('');
      $('#descriptionDiv2-' + id + ' textarea').val('');
      $('#btnshow-' + id + '').show();
    } else if ($('#descriptionDiv1-' + id + '').css('display') == 'block') {
      $('#descriptionDiv1-' + id + '').hide();
      $('#descriptionDiv1-' + id + '').find('textarea').val('');
      $('#descriptionDiv1-' + id + '').find('.ql-editor').html('');
      $('#descriptionDiv1-' + id + ' textarea').val('');
      $('#btnshow-' + id + '').show();
    }
  }
</script>

<!-- (Hassan) To display the selected file name in the input -->
<script>
  function updateFileName(input) {
    var fileName = input.files[0].name;
    var maxLength = 20;
    if (fileName.length > maxLength) {
      fileName = fileName.substring(0, maxLength) + '...';
    }
    var label = document.getElementById("fileLabel");
    label.innerText = fileName;
  }
</script>

<!-- (Hassan) Fields Validation If Submiting Empty Form -->
<script>
  function setupSiteNameFieldChangeHandler() {
    $('.siteNamefield').on('change', function(e) {
      console.log('asdasd');
      var selectedValue = $(this).val();
      var parentRow = $(this).closest('.row');
      var nameAttribute = $(this).attr('name');
      var indexMatch = nameAttribute.match(/\[(\d+)\]/);
      var index = indexMatch ? indexMatch[1] : null;
      var otherSiteNameDiv = parentRow.find('.other_site_name_' + index);
      var otherSiteNameField = parentRow.find('.other_site_name_value' + index);
      console.log(otherSiteNameField)
      if (selectedValue === 'Other') {
        if (otherSiteNameDiv.length > 0) {
          console.log(otherSiteNameField.val());
          console.log('more than 0');
          otherSiteNameDiv.show();
        } else {
          var otherSiteNameTextField = `
                    <div class="col-md-4 col-xs-12 other_site_name_` + index + `">
                      <div class="form-group">
                        <label>Other Site Name</label><br>
                        <input type="text" class="myinput2 other_site_name_value` + index + `" name="other_site_name[` + index + `]" value="" placeholder="Other Site Name">
                      </div>
                    </div>
            `;
          parentRow.append(otherSiteNameTextField);
        }
      } else {
        otherSiteNameField.val(''); // Clear the value
        otherSiteNameDiv.hide(); // Hide the text field
      }
    });
  }
  document.addEventListener('DOMContentLoaded', function() {
    // Event listener for add-action-button click
    document.querySelectorAll('#add-action-button').forEach(function(button) {
      button.addEventListener('click', function() {

        // Get the closest container and template
        var container = this.closest('.action-buttons-container');
        var template = container.querySelector('.action-button-template');

        if (!container || !template) {
          console.error('Container or template not found.');
          return;
        }

        // Clone the template
        var clone = template.cloneNode(true);
        clone.style.display = 'block'; // Ensure the cloned template is visible
        var deleteButton = clone.querySelector('#delete-button');
        if (deleteButton) {
            deleteButton.style.display = 'none';
        }
        // Clear the input values in the cloned template
        Array.from(clone.querySelectorAll('input')).forEach(input => {
          if (input.type !== 'hidden') input.value = '';
        });
        Array.from(clone.querySelectorAll('textarea')).forEach(textarea => textarea.value = '');

        // Calculate the new index based on the existing number of action button templates
        var index = container.querySelectorAll('.action-button-template').length;

        // Update the hidden input value with the new index
        var hiddenInput = clone.querySelector('input[type="hidden"][name="slug[]"]');
        if (hiddenInput) {
          var currentValue = hiddenInput.value;
          var baseValue = currentValue.substring(0, currentValue.lastIndexOf('_') + 1); // Get the base value without the index
          hiddenInput.value = baseValue + index; // Append the new index
        }

        // Append the cloned template to the container
        var wrapper = document.createElement('div');
        wrapper.id = 'action-buttons-container';
        wrapper.classList.add('col-md-12');
        wrapper.appendChild(clone);

        // Append the wrapper to the container
        container.appendChild(wrapper);
      });
    });
  });

  $(document).ready(function() {
    $('.sortablenewstable').sortable({
      cancel: ".btn-group,.input,.myinput2,.form-group",
      stop: function(event, ui) {
        var tableRows = $('.sortablenewstable').find('.reviewdiv');
        // console.log(tableRows);
        // return;
        var table = $('.sortablenewstable').closest('.table-responsive').attr('data-table');
        if ((window.innerWidth <= 768)) {
          $(".sortablenewstable").sortable("disable");
          $('.sortablenewstable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
          $('.sortablenewstable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
        }
        save_display_order(tableRows, 'review_staff');
      }
    });

    $('.staff_promo_sortable').sortable({
      cancel: ".btn-group,.input,.myinput2,.form-group",
      stop: function(event, ui) {
        var tableRows = $('.staff_promo_sortable').find('.staff_div');
        // var table = $('.staff_promo_sortable').closest('.table-responsive').attr('data-table');
        if ((window.innerWidth <= 768)) {
          $(".staff_promo_sortable").sortable("disable");
          $('.staff_promo_sortable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
          $('.staff_promo_sortable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
        }
        save_display_order(tableRows, 'staff_products_promos');
      }
    });


    $('.buttons_sortable').sortable({
        cancel: ".btn-group,.input,.myinput2,.form-group",
        stop: function(event, ui) {
            var tableRows = $('.buttons_sortable').find('.staff_div');
            // var table = $('.buttons_sortable').closest('.table-responsive').attr('data-table');
            
            if (window.innerWidth <= 768) {
                $(".buttons_sortable").sortable("disable");
                $('.buttons_sortable').closest('.content4').find('.btnSortableEnableDisabled').data('status', 'enable');
                $('.buttons_sortable').closest('.content4').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            
            save_display_order(tableRows, 'staff_products_promos');
        },
        update: function(event, ui) {
            var tableRows = $('.buttons_sortable').find('.staff_div');
            save_display_order(tableRows, 'staff_products_promos');
        }
    });

    if ((window.innerWidth <= 768)) {
      $(".sortablenewstable").sortable("disable");
      $(".staff_promo_sortable").sortable("disable");
      $(".buttons_sortable").sortable("disable");
    }


    setupSiteNameFieldChangeHandler();
    $('#updateDownloadForm').on('submit', function(e) {
      var fileInput = $('.download-files-add');
      var file = fileInput.val();
      var question = $('textarea[name="file_question1"]').val();
      var text = $('textarea[name="download_text1"]').val();
      var size = $('input[name="image_size"]').val();
      if (file && !question) {
        e.preventDefault(); // Prevent form submission
        alert('File question is required');
      } else if (file && !text) {
        e.preventDefault(); // Prevent form submission
        alert("Download text is required");
      } else if (file && !size) {
        e.preventDefault(); // Prevent form submission
        alert("Image size is required");
      } else if ((question || text || size) && !file) {
        e.preventDefault(); // Prevent form submission
        alert('File is required');
      }
    });
  });




  let review_site_i = parseInt('<?= $review_site_i + 1 ?>');
  var row = 3;

  function add_links_div() {
    var reviewSitesOptions =
      `
          <option value="Other" selected>Other</option>
          <?php if (count($review_sites) == 0) { ?>
            <option value="Yelp">Yelp</option>
            <option value="Google">Google</option>
          <?php }
          foreach ($review_sites as $review_site) : ?>
                <option value="<?= $review_site->review_site_name ?>"><?= $review_site->review_site_name ?></option>
            <?php endforeach; ?>
        `;
    var html_review_site = `
                    <div class="row review_counter_` + review_site_i + `">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Review site name</label>
                                <select class="myinput2 siteNamefield" name="review_site_name[` + row + `]">
                                    ` + reviewSitesOptions + `
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label>Review site link</label><br>
                                <input type="text" class="myinput2" name="review_site_link[` + row + `]" value="" placeholder="Review Site link">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <button type="button" class="btn btn-primary" style="margin-top:1.9rem;" onclick="delete_review('review_counter_` + review_site_i + `')">X</button>
                        </div>
                        <div class="col-md-4 col-xs-12 other_site_name_` + row + `">
                          <div class="form-group">
                            <label>Other Site Name</label><br>
                            <input type="text" class="myinput2 other_site_name_value` + row + `" name="other_site_name[` + row + `]" value="" placeholder="Other Site Name">
                          </div>
                        </div>
                    </div>
                    
                `;
    $(".dynamic_review_sites").append(html_review_site);
    row++;
    review_site_i++;
    setupSiteNameFieldChangeHandler();
  }
</script>
@endsection('content')