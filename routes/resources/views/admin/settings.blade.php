@extends('admin.layout.dashboard')
@section('content')

<script>
  var sub_sections = ["pulldown_menu", "feature_stack_order", "alternate_wide_header", "scripts_and_favicon", "notifications", "seo_block", "seo_settings", "contact_boxes", "contact_forms", "master_title_fonts", "theme", "step_setup"];
</script>

<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>

<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2"><?= $controller_name ?></div>
      <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
        <div class="col-md-7 col-lg-6">
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
        <div class="ml-4 ">
          <div class="dropdown-list-main-div">
            <div class="dropdown-list">
              <div class="title-3 text-color-grey listtxt">Feature Access</div>
              <div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
              </div>
            </div>
            <div class="dropdown-list-div">
              <ul>
                <?php if (check_auth_permission(['step_setup'])) { ?>
                  <li data-value="step_steup_bluebar">1-Step</li>
                <?php } ?>
                <?php if (check_auth_permission(['theme'])) { ?>
                  <li data-value="Theme_bluebar">Theme</li>
                <?php } ?>
                <?php if (check_auth_permission(['master_title_fonts'])) { ?>
                  <li data-value="master_title_fonts_bluebar">Fonts</li>
                <?php } ?>
                <?php if (check_auth_permission(['contact_forms'])) { ?>
                  <li data-value="contact_forms_bluebar">Contact Forms</li>
                <?php } ?>
                <?php if (check_auth_permission(['contact_form_settings'])) { ?>
                  <li data-value="contact_boxes_bluebar">Contact Boxes</li>
                <?php } ?>
                <?php if (check_auth_permission(['seo_settings'])) { ?>
                  <li data-value="seo_settings_bluebar">SEO Sets</li>
                <?php } ?>
                <?php if (check_auth_permission(['seo_block'])) { ?>
                  <li data-value="seo_block_bluebar">SEO Block</li>
                <?php } ?>
                <?php if (check_auth_permission(['master_notifications', 'email_notifications'])) { ?>
                  <li data-value="master_notifications_bluebar">Notifications</li>
                <?php } ?>
                <?php if (check_auth_permission(['scripts_favicons'])) { ?>
                  <li data-value="scripts_favicons_bluebar">Scrpt/Fav</li>
                <?php } ?>
                <?php if (check_auth_permission(['alternate_wide_header'])) { ?>
                  <li data-value="alternate_wide_header_bluebar">HDR Layouts</li>
                <?php } ?>
                <?php if (check_auth_permission(['feature_stack_order'])) { ?>
                  <li data-value="feature_stack_order_bluebar">Stack Order</li>
                <?php } ?>
                <?php if (check_auth_permission(['pulldown_menu'])) { ?>
                  <li data-value="pulldown_menu_bluebar">Pulldown</li>
                <?php } ?>
                <?php if (check_auth_permission(['footer', 'footer_text', 'footer_link'])) { ?>
                  <li data-value="footer_bluebar">Footer</li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (check_auth_permission('step_setup')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="step_steup_bluebar" data-tip_section="step_setup">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">1-Step Setup</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'step_steup_bluebar' ? 'display:block;' : '' ?>">
        <button id="add_new_oneStepImage_btn" type="button" class="btn btn-primary mb-2">+Add Image only</button>
        <button id="add_new_oneStepImage_text_btn" type="button" class="btn btn-primary mb-2">+Add Image & Text only</button>
        <form action="{{url('saveonestepimage')}}" method="post" enctype="multipart/form-data" novalidate>
          @csrf
          <?php
          $locations = array(
            "No Image" => 'No Image',
            "Popup Alert Image" => 'Popup Alert Image',
            "Set Hours Image" => 'Set Schedule Image',
            "Rotating Schedule (Master) Image" => 'Rotating Schedule (Master) Image',
            "Header Image Title" => 'Header Image Title',
            "Header Logo" => 'Header Logo',
            "News Post Image 1" => 'News Post Image 1',
            "News Post Image 2" => 'News Post Image 2',
            "News Post Image 3" => 'News Post Image 3',
            "Header Slider" => 'Header Slider',
            "Content Block" => 'Content Block'
          );

          $extra_times = array(
            '120' => '2h',
            '240' => '4h',
            '360' => '6h',
            '480' => '8h',
            '1440' => '24h',
            '2880' => '48h',
          );
          if (count($one_step_images) > 0) {
            $i = 0;
            foreach ($one_step_images as $step_image) {
              $i++;

              $one_step_button_first_image = get_image_by_id($step_image->first_image_id);

              $one_step_button_second_image = get_image_by_id($step_image->second_image_id);

          ?>
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="d-flex align-items-center">
                        <div class="title-2">Step Images {{ $i }}</div>
                      </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div id="one-step-content<?= $step_image->id ?>">
                    <input type="hidden" name="old_text_enabled[<?= $step_image->id ?>]" id="text_enabled<?= $step_image->id ?>" value="<?= $step_image->text_enabled ?>">
                    <div class="row align-items-center">
                      <div class="col-md-6" id="new_category<?= $step_image->id ?>" style="display:none">
                        <div class="form-group">
                          <label for="bannertext">Enter New Category</label>
                          <input type="text" class="myinput2" name="old_category[<?= $step_image->id ?>]" value="" id="bannertext" placeholder="Enter Category">
                        </div>
                      </div>
                      <div class="col-md-6" id="old_category<?= $step_image->id ?>">
                        <div class="form-group">
                          <label for="category">Category</label>
                          <select class="myinput2 category" name="old_category[<?= $step_image->id ?>]" required>
                            <?php
                            if (count($one_step_categories) > 0) {
                              foreach ($one_step_categories as $category) {
                            ?>
                                <option <?= $step_image->category == $category->category ? 'selected' : '' ?> value="<?= $category->category ?>"><?= $category->category ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button data-step_id='<?= $step_image->id ?>' type="button" class="btn btn-primary mb-2 add_new_category_btn">Add New Category</button>
                      </div>
                    </div>
                    <div class="row">

                      <div class="col-md-3">
                        <label for="">Select Image A</label>
                        <div class="image-container">
                          <div class="uploadImageDiv mr-2">
                            <button type="button" class="btn btn-primary btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">Select Image A</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="old_first_image[<?= $step_image->id ?>]">

                            <div class="col-md-6 imgdiv" style="display:<?php echo  $one_step_button_first_image ? 'block' : 'none'; ?>">
                              <br>
                              @if($one_step_button_second_image)
                              <img src='<?= url('assets/uploads/') .get_current_url(). '/' . $one_step_button_first_image->file_name ?>' width="150" class="imagefromgallerysrc mb-2">
                              @else
                              <img src='' width="150" class="imagefromgallerysrc mb-2">
                              @endif
                              <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Name</label>
                          <input type="text" class="myinput2" name="old_name[<?= $step_image->id ?>]" value="<?= $step_image->name ?>" placeholder="Enter Name">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="first_image_location">Select Image A Location</label>
                          <select class="myinput2 first_image_location" name="old_first_image_location[<?= $step_image->id ?>]">
                            <?php
                            foreach ($locations as $location => $value) {
                            ?>
                              <option <?= $step_image->first_image_location == $location ? 'selected' : '' ?> value="<?= $location ?>"><?= $value ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <button type="button" class="btn btn-primary remove-one-step-image" data-one-step="<?= $step_image->id ?>">X</button>
                        <label class="ml-1">Delete 1-Step Button </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="">Select Image B</label>
                        <div class="uploadImageDiv">
                          <button type="button" class="btn btn-primary btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">Select Image B</button>
                          <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                          <input class="dataimage" type="hidden" name="old_second_image[<?= $step_image->id ?>]">

                          <div class="col-md-6 imgdiv" style="display:<?php echo $one_step_button_second_image ? 'block' : 'none'; ?>">
                            <br>
                            @if($one_step_button_second_image)
                            <img src='<?= url('assets/uploads/') .get_current_url(). '/' . $one_step_button_second_image->file_name ?>' width="150" class="imagefromgallerysrc  mb-2">
                            @else
                            <img src='' width="150" class="imagefromgallerysrc  mb-2">
                            @endif
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="second_image_location">Select Image B Location</label>
                          <select class="myinput2 second_image_location" name="old_second_image_location[<?= $step_image->id ?>]">
                            <?php
                            foreach ($locations as $location => $value) {
                            ?>
                              <option <?= $step_image->second_image_location == $location ? 'selected' : '' ?> value="<?= $location ?>"><?= $value ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="first_duration">Select Duration 1</label><br>
                          <select class="myinput2 width-60px" name="old_first_duration[<?= $step_image->id ?>]" id="first_duration">
                            <?php
                            for ($duration = 5; $duration <= 60; $duration += 5) {
                            ?>
                              <option <?= $step_image->first_duration == $duration ? 'selected' : '' ?> value="<?= $duration ?>"><?= $duration ?></option>
                            <?php
                            }

                            foreach ($extra_times as $min => $hour) {
                            ?>
                              <option <?= $step_image->first_duration == $min ? 'selected' : '' ?> value="<?= $min ?>"><?= $hour ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="second_duration">Select Duration 2</label><br>
                          <select class="myinput2 width-60px" name="old_second_duration[<?= $step_image->id ?>]" id="second_duration">
                            <?php
                            for ($duration = 5; $duration <= 60; $duration += 5) {
                            ?>
                              <option <?= $step_image->second_duration == $duration ? 'selected' : '' ?> value="<?= $duration ?>"><?= $duration ?></option>
                            <?php
                            }
                            foreach ($extra_times as $min => $hour) {
                            ?>
                              <option <?= $step_image->second_duration == $min ? 'selected' : '' ?> value="<?= $min ?>"><?= $hour ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext<?= $step_image->id ?>">Conditions</label>
                          <!-- <input type="text" class="myinput2" name="old_conditions[<?= $step_image->id ?>]" value="<?= $step_image->conditions ?>" id="bannertext<?= $step_image->id ?>" placeholder="Enter Conditions"> -->
                          <textarea class="myinput2" name="old_conditions[<?= $step_image->id ?>]" id="bannertext<?= $step_image->id ?>" rows="3" placeholder="Enter Conditions"><?= $step_image->conditions ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="coditionColor<?= $step_image->id ?>">Conditions Text Color</label>
                          <input type="color" class="myinput2" name="old_conditions_color[<?= $step_image->id ?>]" value="<?= $step_image->conditions_color ?>" id="coditionColor<?= $step_image->id ?>" placeholder="#000">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="buttonsColor<?= $step_image->id ?>">Button Color</label>
                          <input type="color" class="myinput2" name="old_default_button_color[<?= $step_image->id ?>]" value="<?= $step_image->default_button_color ?>" id="buttonsColor<?= $step_image->id ?>" placeholder="#00A4FF">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="buttonsTextColor<?= $step_image->id ?>">Button Text Color</label>
                          <input type="color" class="myinput2" name="old_default_button_text_color[<?= $step_image->id ?>]" value="<?= $step_image->default_button_text_color ?>" id="buttonsTextColor<?= $step_image->id ?>" placeholder="#000">
                        </div>
                      </div>
                    </div>
                    <?php if ($step_image->text_enabled) {
                      $old_first_image_text_A = get_text_details('one_step_button_first_text_' . $step_image->id);
                    ?>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="first_image_text<?= $step_image->id ?>">Text Image A</label>
                            <textarea class="myinput2" name="old_first_image_text[<?= $step_image->id ?>]" id="first_image_text<?= $step_image->id ?>" rows="3" placeholder="Enter Text"><?= $old_first_image_text_A->text ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="first_image_text_color<?= $step_image->id ?>">Text Image A Color</label>
                            <input type="color" class="myinput2" name="old_first_image_text_color[<?= $step_image->id ?>]" value="<?= $old_first_image_text_A->color ?>" id="first_image_text_color<?= $step_image->id ?>" placeholder="#000000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="first_image_text_size<?= $step_image->id ?>">Text Image A Size</label><br>
                            <input type="number" class="myinput2 width-50px" name="old_first_image_text_size[<?= $step_image->id ?>]" value="<?= $old_first_image_text_A->size_web ?>" id="first_image_text_size<?= $step_image->id ?>" placeholder="18">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="first_image_text_font<?= $step_image->id ?>">Text Image A Font</label>
                            <select class="myinput2" name="old_first_image_text_font[<?= $step_image->id ?>]" id="first_image_text_font<?= $step_image->id ?>">
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singlefont) { ?>
                                  <option style="font-family: <?= $singlefont->value ?>;" value="<?= $singlefont->id ?>" <?= $old_first_image_text_A->fontfamily == $singlefont->id ? 'selected' : '' ?>><?= $singlefont->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <?php
                        $old_second_image_text_B = get_text_details('one_step_button_second_text_' . $step_image->id);
                        ?>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="second_image_text<?= $step_image->id ?>">Text Image B</label>
                            <textarea class="myinput2" name="old_second_image_text[<?= $step_image->id ?>]" id="second_image_text<?= $step_image->id ?>" rows="3" placeholder="Enter Text"><?= $old_second_image_text_B->text ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="second_image_text_color<?= $step_image->id ?>">Text Image B Color</label>
                            <input type="color" class="myinput2" name="old_second_image_text_color[<?= $step_image->id ?>]" value="<?= $old_second_image_text_B->color ?>" id="second_image_text_color<?= $step_image->id ?>" placeholder="#000000">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="second_image_text_size<?= $step_image->id ?>">Text Image B Size</label><br>
                            <input type="number" class="myinput2 width-50px" name="old_second_image_text_size[<?= $step_image->id ?>]" value="<?= $old_second_image_text_B->size_web ?>" id="second_image_text_size<?= $step_image->id ?>" placeholder="18">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="second_image_text_font<?= $step_image->id ?>">Text Image B Font</label>
                            <select class="myinput2" name="old_second_image_text_font[<?= $step_image->id ?>]" id="second_image_text_font<?= $step_image->id ?>">
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singlefont) { ?>
                                  <option style="font-family: <?= $singlefont->value ?>;" value="<?= $singlefont->id ?>" <?= $old_second_image_text_B->fontfamily == $singlefont->id ? 'selected' : '' ?>><?= $singlefont->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    <?php
                    } ?>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
          <div class="add_new_oneStepImage" id="add_new_oneStepImage" style="display: none;">
            <input type="hidden" name="add_new_step_image" id="add_new_step_image" value="0">
            <input type="hidden" name="text_enabled" id="text_enabled" value="0">
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="d-flex align-items-center">
                      <div class="title-2">New Image</div>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row align-items-center">
                  <div class="col-md-6" id="new_category0" style="display:none">
                    <div class="form-group">
                      <label for="bannertext">Enter New Category</span></label>
                      <input type="text" class="myinput2" name="category" id="bannertext" placeholder="Enter Category">
                    </div>
                  </div>
                  <div class="col-md-6" id="old_category0">
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select class="myinput2 category" name="category" required>
                        <?php
                        if (is_array($one_step_categories) && count($one_step_categories) > 0) {
                          foreach ($one_step_categories as $category) {
                        ?>
                            <option value="<?= $category->category ?>"><?= $category->category ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <button data-step_id='0' type="button" class="btn btn-primary mb-2 add_new_category_btn">Add New Category</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Select Image A</label>
                    <div class="image-container">
                      <div class="uploadImageDiv mr-2">
                        <button type="button" class="btn btn-primary btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">Select Image A</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="first_image">

                        <div class="col-md-6 imgdiv" style="display:none">
                          <br>
                          <img src='' width="200" class="imagefromgallerysrc">
                          <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="bannertext">Name</label>
                      <input type="text" class="myinput2" name="name" value="" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_image_location">Select Image A Location</label>
                      <select class="myinput2 first_image_location" name="first_image_location">
                        <?php
                        foreach ($locations as $location => $value) {
                        ?>
                          <option value="<?= $location ?>"><?= $value ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Select Image B</label>
                    <div class="uploadImageDiv">
                      <button type="button" class="btn btn-primary btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">Select Image B</button>
                      <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                      <input class="dataimage" type="hidden" name="second_image">

                      <div class="col-md-6 imgdiv" style="display:none">
                        <br>
                        <img src='' width="100%" class="imagefromgallerysrc">
                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_image_location">Select Image B Location</label>
                      <select class="myinput2 second_image_location" name="second_image_location">
                        <?php
                        foreach ($locations as $location => $value) {
                        ?>
                          <option value="<?= $location ?>"><?= $value ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_duration">Select Duration 1</label><br>
                      <select class="myinput2 width-60px" name="first_duration" id="first_duration">
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
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_duration">Select Duration 2</label><br>
                      <select class="myinput2 width-60px" name="second_duration" id="second_duration">
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
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="conditions">Conditions</label>
                      <textarea class="myinput2" name="conditions" id="conditions" rows="3" placeholder="Enter Conditions"></textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="coditionColor">Conditions Text Color</label>
                      <input type="color" class="myinput2" name="conditions_color" value="#000000" id="coditionColor" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="buttonsColor">Button Color</label>
                      <input type="color" class="myinput2" name="default_button_color" value="#00A4FF" id="buttonsColor" placeholder="#00A4FF">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="buttonsTextColor">Button Text Color</label>
                      <input type="color" class="myinput2" name="default_button_text_color" value="#ffffff" id="buttonsTextColor" placeholder="#ffffff">
                    </div>
                  </div>
                </div>
                <div class="row" id="text_enabled_div" style="display: none;">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_image_text">Text Image A</label>
                      <textarea class="myinput2" name="first_image_text" id="first_image_text" rows="3" placeholder="Enter Text"></textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_image_text_color">Text Image A Color</label>
                      <input type="color" class="myinput2" name="first_image_text_color" value="#000000" id="first_image_text_color" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_image_text_size">Text Image A Size</label><br>
                      <input type="number" class="myinput2 width-50px" name="first_image_text_size" value="18" id="first_image_text_size" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="first_image_text_font">Text Image A Font</label>
                      <select class="myinput2" name="first_image_text_font" id="first_image_text_font">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_image_text">Text Image B</label>
                      <textarea class="myinput2" name="second_image_text" id="second_image_text" rows="3" placeholder="Enter Text"></textarea>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_image_text_color">Text Image B Color</label>
                      <input type="color" class="myinput2" name="second_image_text_color" value="#000000" id="second_image_text_color" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_image_text_size">Text Image B Size</label><br>
                      <input type="number" class="myinput2 width-50px" name="second_image_text_size" value="18" id="second_image_text_size" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="second_image_text_font">Text Image B Font</label>
                      <select class="myinput2" name="second_image_text_font" id="second_image_text_font">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="saveOneStepImage" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="saveOneStepImage" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('theme')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="Theme_bluebar" data-tip_section="theme">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Theme</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'Theme_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savetheme')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="btn1text">Site Background Theme</label><br>
                <label><input type="radio" name="site_background_theme" value="0" <?php if ($siteSettings->site_background_theme == '0') {
                                                                                    echo 'checked';
                                                                                  } ?>> Dark Theme</label><br>
                <label><input type="radio" name="site_background_theme" value="1" <?php if ($siteSettings->site_background_theme == '1') {
                                                                                    echo 'checked';
                                                                                  } ?>> Light Theme</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="site_background_color">Site Background color</label>
                <input type="color" class="myinput2" name="site_background_color" id="site_background_color" value="<?= $siteSettings->site_background_color ?>" placeholder="#000000">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="btn1text">Site Trim</label><br>
                <label><input type="radio" name="site_trim" value="0" <?php if ($siteSettings->site_trim == '0') {
                                                                        echo 'checked';
                                                                      } ?>> Off </label><br>
                <label><input type="radio" name="site_trim" value="1" <?php if ($siteSettings->site_trim == '1') {
                                                                        echo 'checked';
                                                                      } ?>> On </label>
              </div>
            </div>
          </div>
          <br>
          <div class="row make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savesitesetting" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savesitesetting" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('master_title_fonts')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="master_title_fonts_bluebar" data-tip_section="master_title_fonts">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Font Master</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'master_title_fonts_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savefontmaster')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="title_font_color">Titles Text Color</label>
                <input type="color" class="myinput2" name="title_font_color" id="title_font_color" value="<?= $master_title->color ?>" placeholder="#000000">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="title_font_size_web">Titles Text size (Web)</label><br>
                <input type="text" class="myinput2 width-50px" name="title_font_size_web" id="title_font_size_web" value="<?= $master_title->size_web ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="title_font_size_mobile">Titles Text size (Mobile)</label><br>
                <input type="text" class="myinput2 width-50px" name="title_font_size_mobile" id="title_font_size_mobile" value="<?= $master_title->size_mobile ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="title_font_size">Titles Font</label>
                <select class="myinput2" name="title_font_family">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $master_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="subtitle_text_color">Sub-Titles Text Color</label>
                <input type="color" class="myinput2" name="subtitle_text_color" id="subtitle_text_color" value="<?= $master_subtitle->color ?>" placeholder="#000000">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="subtitle_text_size_web">Sub-Titles Text size (Web)</label><br>
                <input type="text" class="myinput2 width-50px" name="subtitle_text_size_web" id="subtitle_text_size_web" value="<?= $master_subtitle->size_web ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="subtitle_text_size_mobile">Sub-Titles Text size (Mobile)</label><br>
                <input type="text" class="myinput2 width-50px" name="subtitle_text_size_mobile" id="subtitle_text_size_mobile" value="<?= $master_subtitle->size_mobile ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="subtitle_font_family">Sub-Titles Font</label>
                <select class="myinput2" name="subtitle_font_family">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $master_subtitle->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="other_font_color">Other Text Color</label>
                <input type="color" class="myinput2" name="other_font_color" id="other_font_color" value="<?= $master_other_font->color ?>" placeholder="#000000">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="other_font_size_web">Other Text size (Web)</label><br>
                <input type="text" class="myinput2 width-50px" name="other_font_size_web" id="other_font_size_web" value="<?= $master_other_font->size_web ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="other_font_size_mobile">Other Text size (Mobile)</label><br>
                <input type="text" class="myinput2 width-50px" name="other_font_size_mobile" id="other_font_size_mobile" value="<?= $master_other_font->size_mobile ?>" placeholder="16px">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="other_font_family">Other Text Font</label>
                <select class="myinput2" name="other_font_family">
                  <?php if (count($font_family) > 0) { ?>
                    <?php foreach ($font_family as $single) { ?>
                      <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $master_other_font->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <button type="submit" name="savefontsettings" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savefontsettings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('contact_forms')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="contact_forms_bluebar" data-tip_section="contact_forms">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Contact Forms</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('contactForm1') || check_feature_enable_disable('contactForm2') || check_feature_enable_disable('contactForm3'))
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
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'contact_forms_bluebar' ? 'display:block;' : '' ?>">
        <!-- <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <div class="row mb-17">
            <?php $contact_forms_outline = get_outline_settings('contact_forms_outline'); ?>
            <div class="col-md-12 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="contact_forms_outline" <?php echo  $contact_forms_outline->time != null ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $contact_forms_outline->outline_color ?>" placeholder="#000000" data-slug="contact_forms_outline">
                </div>
              </div>
            </div>
          </div>
          <div class="myhr mb-16"></div>
        <?php } ?> -->
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Captcha Settings</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="bannertext"> Is Captcha Enabled?</label>
                  <br>
                  <label class="switch">
                    <input type="checkbox" class="show_map save_captcha" name="is_captcha_enable" <?= $siteSettings->is_captcha_enable ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <form action="{{url('savecontactform')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="contactforms">

            <?php
            if ($contact_forms && count($contact_forms)) {
              $i = 0; ?>
              <?php foreach ($contact_forms as $single) {
                $i++; ?>
                <div class="content2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                        <div class="d-flex align-items-center">
                          <div class="title-2">Form {{ $single->id }}</div>
                        </div>
                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                      </div>
                    </div>
                  </div>
                  <div class="editcontent2">
                    <div class="singlecontactform">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="bannertext"> Active Form</label>
                            <br>
                            <label class="switch">
                              <input type="checkbox" name="formstatus[<?= $single->id ?>]" <?= $single->form_status ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="bannertext"> Show Map</label>
                            <br>
                            <label class="switch">
                              <input type="checkbox" class="show_map" name="showmap[<?= $single->id ?>]" <?= $single->show_map ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <br>
                          <a href="{{url('/settings/remove_cf/'.$single->id)}}"><button type="button" class="btn btn-primary btnremovecontactform" data-formid="<?= $single->id ?>">X</button></a>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Form Title</label>
                            <input class="gallerypostid formid" type="hidden" name="formid[]" value="<?= $single->id ?>">
                            <input type="text" class="myinput2" name="form_title[]" value="<?= $single->form_title ?>" placeholder="Form Title">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Form Title Text Color</label>
                            <input type="color" class="myinput2" name="form_title_color[]" value="<?= isset($single->form_title_color) ? $single->form_title_color : '' ?>">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Form Title Text Size</label><br>
                            <input type="number" class="myinput2 width-50px" name="form_title_size[]" value="<?= $single->form_title_size ?>" placeholder="16">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="title_font_size">Form Title Font</label>
                            <select class="myinput2" name="form_title_font_family[]">
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $singlefont) { ?>
                                  <option style="font-family: <?= $singlefont->value ?>;" value="<?= $singlefont->id ?>" <?= $single->form_title_font_family == $singlefont->id ? 'selected' : ''; ?>><?= $singlefont->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Send Message To (Email Address)</label>
                            <input type="text" class="myinput2" name="formemail[]" value="<?= $single->form_email ?>" placeholder="example@gmail.com">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="btn2color">Map Script (From Google Map Generator)</label>
                            <a href="https://google-map-generator.com/" class="ml-5" target="_blank">Click here to access the Google Map Generator page</a>
                            <textarea class="myinput2" name="form_google_map[]" id="btn2color" cols="30" rows="3" placeholder="<iframe>......"><?= $single->form_google_map ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="confactformfielddiv">
                        <?php $formFieldNumber = 0;
                        if ($single->form_fields) { ?>
                          <?php $form_fields = json_decode($single->form_fields); ?>
                          <?php foreach ($form_fields as $sngl) { ?>
                            <div class="row">
                              <div class="col-md-3">
                                <div class="form-group"><label>Field name</label>
                                  <input type="text" class="myinput2" name="fieldname[<?= $single->id ?>][]" value="<?= $sngl->fieldname ?>" placeholder="Field name">
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group"><label>Field type</label>
                                  <select class="myinput2" name="fieldtype[<?= $single->id ?>][]">
                                    <option value="text" <?= $sngl->fieldtype == 'text' ? 'selected' : '' ?>>Text</option>
                                    <option value="textarea" <?= $sngl->fieldtype == 'textarea' ? 'selected' : '' ?>>Text Area</option>
                                    <option value="file" <?= $sngl->fieldtype == 'file' ? 'selected' : '' ?>>File Upload</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-1">
                                <div class="form-group">
                                  <label for="bannertext"> Required?</label>
                                  <br>
                                  <label class="switch">
                                    <input type="checkbox" name="required[<?= $single->id ?>][<?= $formFieldNumber++ ?>]" <?= $sngl->required ? 'checked' : '' ?> value="1">
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <br>
                                <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                              </div>
                            </div>
                          <?php } ?>
                        <?php } ?>
                        <input class="formfieldno" type="hidden" name="formfieldno[]" value="<?= $formFieldNumber ?>">
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-primary btnaddnewcontactformfields" data-formid="<?= $single->id ?>" data-formfieldno="<?= $formFieldNumber ?>">Add New Field</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            } ?>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6 " style="font-size:12px">
              <p>
                <span><b>Note:</b> Maximum 3 Contact Forms Allowed</span>
              </p>
              <button @if($contact_forms && count($contact_forms)>=3) disabled @endif type="button" class="btn btn-primary @if($contact_forms && count($contact_forms)<3) btnaddnewcontactform @endif">Add New Form</button>
            </div>
          </div>
          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="savecontactform" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savecontactform" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('contact_form_settings')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="contact_boxes_bluebar" data-tip_section="contact_boxes">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Contact Boxes</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('contact') )
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
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'contact_boxes_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savecontactbox')}}" method="post" enctype="multipart/form-data">
          @csrf
          <!-- <?php if (check_auth_permission(['build_site_Content'])) { ?>
            <div class="row mb-17">
              <?php $contact_boxes_outline = get_outline_settings('contact_boxes_outline'); ?>
              <div class="col-md-12 text-right">
                <div class="mr-6vi">
                  <label class="title-5 text-black">Tutorial Website Controls</label>
                </div>
                <div class="align-all-right d-flex align-items-end">
                  <div class="form-group  d-flex align-items-center">
                    <div for="" class="title-9 text-black">Turn On Outline</div>
                    <label class="switch ml-7">
                      <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="contact_boxes_outline" <?php echo  $contact_boxes_outline->time != null ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                  <div class="form-group ml-34">
                    <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                    <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $contact_boxes_outline->outline_color ?>" placeholder="#000000" data-slug="contact_boxes_outline">
                  </div>
                </div>
              </div>
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?> -->
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2">Text Settings</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Boxes Background color</label>
                    <input type="color" class="myinput2" name="contact_box_background_color" id="btn2color" value="<?= $contactBoxSettings->background_color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="title_font_size">Contact Boxes Font</label>
                    <select class="myinput2" name="contact_form_box_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $contactBoxSettings->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Text (SMS)</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="bannertext">Enable (SMS) Texting Box?</label><br>
                    <label class="switch">
                      <input type="checkbox" class="enable_texting_box" name="enable_texting_box" <?= $contactBoxSettings->enable_texting_box ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Contact Box (SMS) Texting Title</label>
                    <input type="text" class="myinput2" name="contact_form_phonr_text_title" id="bannertext" value="<?= $contact_box_sms_title->text ?>" placeholder="Contact Form phone text Title">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box (SMS) Texting Title Text color</label>
                    <input type="color" class="myinput2" name="contact_form_phone_text_title_color" id="btn2color" value="<?= $contact_box_sms_title->color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box (SMS) Texting Title Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="contact_form_phone_text_title_size" value="<?= $contact_box_sms_title->size_web ?>" placeholder="18">
                  </div>
                </div>

              </div>
              <div class="row">

                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Contact Box (SMS) Text Number</label>
                    <input type="text" class="myinput2" name="contact_form_phone_text" id="bannertext" value="<?= $contact_box_sms_text->text ?>" placeholder="Contact Form phone">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box (SMS) Text color</label>
                    <input type="color" class="myinput2" name="contact_form_phone_text_color" id="btn2color" value="<?= $contact_box_sms_text->color ?>" placeholder="#000000">
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
                    <div class="title-2"> Phone Box</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="bannertext">Enable Phone Box?</label><br>
                    <label class="switch">
                      <input type="checkbox" class="enable_phone_box" name="enable_phone_box" <?= $contactBoxSettings->enable_phone_box ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Phone Number Title</label>
                    <input type="text" class="myinput2" name="contact_form_phone_title" id="bannertext" value="<?= $contact_box_phone_title->text ?>" placeholder="Header phone Title">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Phone Number Title Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_phone_title_color" id="btn2color" value="<?= $contact_box_phone_title->color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Phone Number Title Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="contact_form_phone_title_size" value="<?= $contact_box_phone_title->size_web ?>" placeholder="18">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Phone Number</label>
                    <input type="text" class="myinput2" name="contact_form_text_7_phone" id="bannertext" value="<?= $contact_box_phone_text->text ?>" placeholder="Contact Form phone">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Phone Number Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_text_7_phone_color" id="btn2color" value="<?= $contact_box_phone_text->color ?>" placeholder="#000000">
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
                    <div class="title-2"> Email Box</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="bannertext">Enable Email Box?</label><br>
                    <label class="switch">
                      <input type="checkbox" class="enable_email_box" name="enable_email_box" <?= $contactBoxSettings->enable_email_box ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Contact Box Email Title Text</label>
                    <input type="text" class="myinput2" name="contact_form_email_title" value="<?= $contact_box_email_title->text ?>" placeholder="Title">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Contact Box Email Title Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_email_titlecolor" value="<?= $contact_box_email_title->color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Email Title Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="contact_form_email_titlesize" value="<?= $contact_box_email_title->size_web ?>" placeholder="18">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Contact Box Email Address</label>
                    <input type="text" class="myinput2" name="contact_form_email" value="<?= $contact_box_email_text->text ?>" placeholder="Email Address">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Contact Box Email Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_emailcolor" value="<?= $contact_box_email_text->color ?>" placeholder="#000000">
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
                    <div class="title-2"> Address Box</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="bannertext">Enable Address Box?</label><br>
                    <label class="switch">
                      <input type="checkbox" class="enable_address_box" name="enable_address_box" <?= $contactBoxSettings->enable_address_box ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Address Title</label>
                    <input type="text" class="myinput2" name="contact_form_address_title" id="bannertext" value="<?= $contact_box_address_title->text ?>" placeholder="Contact Form text">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Address Title Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_address_title_color" id="btn2color" value="<?= $contact_box_address_title->color ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Address Title Text Size</label><br>
                    <input type="text" class="myinput2 width-50px" name="contact_form_address_title_fontsize" id="btn2color" value="<?= $contact_box_address_title->size_web ?>" placeholder="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Address Line 1</label>
                    <input type="text" class="myinput2" name="contact_form_address1" id="bannertext" value="<?= $contact_box_address_text_1->text ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Address Line 2</label>
                    <input type="text" class="myinput2" name="contact_form_address2" id="bannertext" value="<?= $contact_box_address_text_2->text ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="bannertext">Contact Box Address Line 3</label>
                    <input type="text" class="myinput2" name="contact_form_address3" id="bannertext" value="<?= $contact_box_address_text_3->text ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="btn2color">Contact Box Address Text Color</label>
                    <input type="color" class="myinput2" name="contact_form_address_text_color2" id="btn2color" value="<?= $contact_box_address_text_1->color ?>" placeholder="#000000">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <br>
          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="savecontactform_setting" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savecontactform_setting" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('seo_settings')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="seo_settings_bluebar" data-tip_section="seo_settings">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">SEO Settings</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'seo_settings_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savemetadata')}}" method="post" enctype="multipart/form-data">
          @csrf
          <?php if (check_auth_permission(['build_site_Content'])) { ?>
            <div class="row mb-17">
              <?php $seo_settings_outline = get_outline_settings('seo_settings_outline'); ?>
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Google Search Title</label><label class="ml-2 text-red">(Recommended: 35 to 70 characters)</label>
                <input type="text" class="myinput2" name="google_search_title" value="<?= $seoSettings->google_search_title ?>" placeholder="Title">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Google Search Description</label><label class="ml-2 text-red">(Recommended: 70 to 320 characters)</label>
                <input type="text" class="myinput2" name="google_search_description" value="<?= $seoSettings->google_search_description ?>" placeholder="Description">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Metatag inputs</label>
                <input type="text" class="myinput2" name="metatag_inputs" value="<?= $seoSettings->metatag_inputs ?>" placeholder="example,example,etc">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Meta Language</label>
                <input type="text" class="myinput2" name="meta_language" value="<?= $seoSettings->meta_language ?>" placeholder="English,Spanish etc">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Metatag Robots</label>
                <input type="text" class="myinput2" name="metatag_robots" value="<?= $seoSettings->metatag_robots ?>" placeholder="index.noindex etc">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Meta Keywords</label>
                <input type="text" class="myinput2" name="meta_keywords" value="<?= $seoSettings->meta_keywords ?>" placeholder="example,example,etc">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Metatag Revisit After</label>
                <input type="text" class="myinput2" name="metatag_revisit_after" value="<?= $seoSettings->metatag_revisit_after ?>" placeholder="7 days">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Meta Author</label>
                <input type="text" class="myinput2" name="meta_author" value="<?= $seoSettings->meta_author ?>" placeholder="Author">
              </div>
            </div>
          </div>
          <br>
          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="savemetadata" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savemetadata" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('seo_block')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="seo_block_bluebar" data-tip_section="seo_block">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">SEO Block</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('seoBlock') )
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
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'seo_block_bluebar' ? 'display:block;' : '' ?>">
        <form class="data-form" action="{{url('saveSeoBlockSettings')}}" method="post" enctype="multipart/form-data">
          @csrf
          <?php if (check_auth_permission(['build_site_Content'])) { ?>
            <div class="row mb-17">
              <div class="col-md-3">
                <div class="form-group d-flex">
                    <label>Override Background <br>Color in Settings, Theme</label>
                    <label class="switch ml-7">
                        <input type="checkbox" class="notificationswitch override_bg_enable seo_block_override_bg" name="seo_block_override_bg" data-slug="seo_block_bg_picker"
                            <?php echo  $seoSettings->seo_block_override_bg ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                </div>
              </div>
              <div class="col-md-3 ">
                  <div class="form-group seo_block_bg_picker" style="display:<?php echo  $seoSettings->seo_block_override_bg ? 'block' : 'none' ?>">
                      
                      <label>Alert Banner Background Color</label>
                      <div class="d-flex align-items-center color-main-div">
                          <div>
                              <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg"
                                  alt="" width="" class="dismiss-color">
                          </div>
                          <div class="ml-10">
                              <div class="inputcolordiv">
                                  <div class="inputcolor"
                                      style="background:<?= $seoSettings->seo_block_background ?>"></div>
                                  <input type="color" class="colorinput"
                                      name="seo_block_background" id="bannerbackgroundcolor"
                                      value="<?= $seoSettings->seo_block_background ?>" placeholder="#000000">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <?php $seo_block_outline = get_outline_settings('seo_block_outline'); ?>
             
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group quilleditor-div ">
                <label>SEO Block Text</label>
                <textarea name="seo_block_text" class="myinput2 editordata hidden" rows="10"><?= $seoSettings->seo_block_text ?></textarea>
                <div class="quilleditor">
                  <?= $seoSettings->seo_block_text ?>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="saveSeoBlockSettings" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="saveSeoBlockSettings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['master_notifications', 'email_notifications'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="master_notifications_bluebar" data-tip_section="notifications">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Notifications</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'master_notifications_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savenotification')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <?php if (check_auth_permission('master_notifications')) { ?>
              <div class="col-md-12">
                <b>Note:</b> Add commas and spaces between multiple emails.
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Notifications (Global Setting)</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" name="notificationswitch" id="global_notification_switch" <?= $notificationSettings->notification_switch ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send (Global) Notification to (Email)</label>
                  <input type="text" class="myinput2" name="email_notification" value="<?= $notificationSettings->email_notification ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Activate Edit Quick Settings Notification</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="quick_settings_notifications" <?= $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Quick Settings Edit Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="quick_settings_notification_email" value="<?= $notificationSettings->quick_settings_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Activate 1-Step Buttons Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="step_notifications" <?= $notificationSettings->step_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8 ">
                <div class="form-group">
                  <label>Send 1-Step Button Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="step_notification_email" value="<?= $notificationSettings->step_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit Scheduling Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="scheduling_notifications" <?= $notificationSettings->scheduling_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Scheduling Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="scheduling_notification_email" value="<?= $notificationSettings->scheduling_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit Galleries Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="galleries_notifications" <?= $notificationSettings->galleries_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Galleries Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="galleries_notification_email" value="<?= $notificationSettings->galleries_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit Frontend Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="frontend_notifications" <?= $notificationSettings->frontend_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Frontend Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="frontend_notification_email" value="<?= $notificationSettings->frontend_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit Blog Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="blog_notifications" <?= $notificationSettings->blog_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Blog Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="blog_notification_email" value="<?= $notificationSettings->blog_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit CRM Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="crm_notifications" <?= $notificationSettings->crm_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit CRM Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="crm_notification_email" value="<?= $notificationSettings->crm_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Edit Form Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="form_notifications" <?= $notificationSettings->form_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Form Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="form_notification_email" value="<?= $notificationSettings->form_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Settings/Business info Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="settings_business_notifications" <?= $notificationSettings->settings_business_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Settings/Business Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="settings_business_notification_email" value="<?= $notificationSettings->settings_business_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <label for="bannertext">Active Settings/Settings info Notifications</label>
                <div class="form-group">
                  <label class="switch">
                    <input type="checkbox" class="notification_settings" name="settings_notifications" <?= $notificationSettings->settings_notifications ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Send Edit Settings/Settings Notifications to (Emails)</label>
                  <input type="text" class="myinput2" name="settings_notification_email" value="<?= $notificationSettings->settings_notification_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
            <?php } ?>
          </div>
          <br>

          <div class="row make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savenotification" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savenotification" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('scripts_favicons')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="scripts_favicons_bluebar" data-tip_section="scripts_and_favicon">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Scripts & Favicon</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'scripts_favicons_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savescripts')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="bannertext">Home Scripts (Multiple scripts)</label>
                <textarea type="text" class="myinput2" name="homescripts" id="bannertext" rows="10"><?= $siteSettings->home_scripts ?></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <?php if ($siteSettings->favicon) { ?>
              <div class="col-md-2">
                <div class="form-group fav-icon-container">
                  <label for="headerlogo">Favicon</label>
                  <img  src="<?= base_url('assets/uploads/' .get_current_url(). $siteSettings->favicon) ?>" width="100%">
                  <button type="button" class="btn btn-primary btnimgdel " onclick="removeFavIcon()">X</button>
                </div>
              </div>
            <?php } ?>
            <div class="col-md-4">
              <div class="form-group">
                <label for="headerlogo">Favicon</label>
                <div class="uploadImageDiv-favicon mr-2">
                  <!-- <button type="button" class="btn btn-primary btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">Select Image A</button> -->
                  <input type="file" name="faviconfile" onclick="this.value='';" onchange="loadFavIcon(event)" id="favicon" class="btn btn-primary favicon sample_input_favicon">
                  <input class="favicon-data-image" type="hidden" name="favicon">

                  <div class="col-md-6 imgdiv-favicon" style="display:none">
                    <br>
                    <img src='' width="200" class="imagefromgallerysrc-favicon">
                    <button type="button" class="btn btn-primary btnimgdel btnimgremove-favicon">X</button>
                  </div>
                </div>
                <!-- <input class="sample_input_favicon" type="hidden" name="favicon"> -->
              </div>
            </div>
          </div>
          <div class="row form-bottom make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savescripts" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savescripts" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('alternate_wide_header')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="alternate_wide_header_bluebar" data-tip_section="alternate_wide_header">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Header Layouts</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'alternate_wide_header_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savealternate')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Alternate Wide Header</label><br>
                <label class="switch">
                  <input type="checkbox" class="notificationswitch" name="alternate_horizontal" <?= $siteSettings->alternate_horizontal ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <button type="submit" name="savealternate" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savealternate" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('feature_stack_order')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="feature_stack_order_bluebar" data-tip_section="feature_stack_order">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Feature Stack Order</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'feature_stack_order_bluebar' ? 'display:block;' : '' ?>">

        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Enabled Features <span class="ml-5 mt-4">Drag and sort features in the stack order wanted on the website</span></div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 pl-2">
            <div class="row">
              <div class="col-sm-12 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12 form-group mt-3">
                <label class="">
                  Header slider can be turned off if Header Section is turned off
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <div class="d-flex  align-items-center mb-3">
                
                  <div class="title-1 text-color-blue ">On Published Website</div>
                </div>
                <div class="">
                  <div class="row sort_front_sections_table">
                    <?php if (count($front_sections) > 0) { ?>
                      <?php $i = 0;
                      foreach ($front_sections as $row) {
                        // if (!$row->section_enabled) {
                        //   continue;
                        // }
                        $i++; ?>
                        <div class="col-md-12 sections enable_sections" data-sectionid="<?= $row->id ?>">
                          <div class="">
                            <div class="row mb-2">
                              <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                  <div class="label-sort"><?= $row->name ?></div>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label class="switch">
                                    <input type="checkbox" class="enableswitch" id="<?= $row->name ?>" <?= $row->name == 'Header Section' ? 'onchange="toggleOnHeader(this)"' : '' ?> onchange="toggleRightFeature(this)" <?= $row->name == 'Header Slider' ? 'onchange="toggleSecondCheckbox(this)"' : '' ?> id="<?= $row->name ?>" name="enableswitch" <?= $row->section_enabled ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php }
                    } else { ?>
                      <div>
                        <div colspan="3" class="text-center"> No record Found </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="col-md-7">

                <div class="row">
                  <div class="col-md-6 p-0">
                    <!-- <div class="title-1 text-color-blue mb-3 ">On Tutorial Website only</div> -->

                    <!-- <div class="row">
                      <div class=" col-md-6 text-center">
                        <div class="label-sort label-sort-grey">Turn on<br> Enabled Features</div>
                      </div>
                      <div class="col-md-6 text-center">
                        <div class="label-sort label-sort-grey">Turn on<br> All Features</div>
                      </div>
                      <div class="col-md-12 text-center text-align-center d-flex justify-content-center">
                          <div class="form-group frontend">
                            <label class="switch">
                              <input type="checkbox" class="enableswitch_all_features" name="all_feature_for_edit_website" <?= $front_section_settings->all_feature_for_edit_website == 1 ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                      </div>
                    </div> -->
                    <!-- <div class="row sort_front_sections_table_edit_website">
                      <?php if (count($front_edit_sections) > 0) { ?>
                        <?php $i = 0;
                        foreach ($front_edit_sections as $row) {
                          $i++; ?>
                          <div class="col-md-12 sections_edit_frontend sections_edit_frontend_enable" data-sectionid="<?= $row->id ?>">
                            <div class="">
                              <div class="row mb-2">
                                <div class="col-md-5 display-table">
                                  <div class="vertical-middle">
                                    <div class="label-sort"><?= $row->name ?></div>
                                  </div>
                                </div>
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label class="switch">
                                      <input type="checkbox" class="enableswitch" id="<?= $row->name.'-right' ?>" name="enableswitch" <?= $row->edit_section_enabled ? 'checked' : '' ?>>
                                      <span class="slider round"></span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php }
                      } else { ?>
                        <div>
                          <div colspan="3" class="text-center"> No record Found </div>
                        </div>
                      <?php } ?>
                    </div> -->
                  </div>
                  <div class="col-md-6 pl-0">
                    <div class="">
                      <div class="label-sort text-center">Select which features are seen on the Tutorial Website</div>
                      <div class=" d-flex  text-center align-items-center" style="justify-content: space-evenly">
                        <div class="vertical-middle">
                          <div class="label-sort label-sort-grey">Enabled features only</div>
                        </div>
                        <div class="form-group frontend">
                          <label class="switch">
                            <input type="checkbox" class="enableswitch_all_features" name="all_feature_enable_on_edit" <?= $front_section_settings->all_feature_enable_on_edit == 1 ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="vertical-middle">
                          <div class="label-sort label-sort-grey">ALL features</div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <form action="{{url('updatemasteroutline')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="col-md-12 text-center">
                      <button type="button" name="action" class="btn btn-primary action_outlines {{outlinesActive()?'':'bg-disabled'}} {{outlinesActive()}} remove-outline-btn" value="remove_outlines">Remove all outlines</button>
                  <button type="button" name="action" class="btn btn-primary action_outlines {{outlinesActive()?'bg-disabled':''}} mt-1 active-outline-btn" value="activate_outlines">Activate all outlines</button>
                        <label class="mt-2">
                          Additional options & features can be used in Feature Stack Order, located in the Setting section.
                        </label>
                      </div>
                      <!--  <div class="col-md-2">                   
                            <div class=" d-flex  text-center align-items-center" style="justify-content: space-evenly">
                                <div class="vertical-middle">
                                  <div class="label-sort">Show All Features</div>
                                </div>
                                <div class="form-group frontend">
                                  <label class="switch">
                                    <input type="checkbox" class="enableswitch" name="active_feature_enable_on_edit" <?= $front_section_settings->active_feature_enable_on_edit == 1 ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                                <div class="vertical-middle">
                                  <div class="label-sort">Show Active Features Only</div>
                                </div>
                              </div>
                          </div> -->
                      <div class="col-md-12 text-left">
                        <div class="form-group mt-1 align-all-left ">
                          <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                          <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?= $master_feature_settings->outline_color ?>" placeholder="#000000" data-slug="master_feature_settings">
                        </div>
                      </div>
                    </form>
                    <br>

                  </div>
                
                </div>

              </div>
            </div>


          </div>
        </div>
        <!-- <div class="content2 d-non">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Disabled Features</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2 pl-2">
            <div class="row">
              <div class="col-sm-12 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                  <div class="title-1 text-color-blue ">On Published only</div>
                </div>
                <div class="">
                  <div class="row">
                    <?php if (count($front_sections) > 0) { ?>
                      <?php $i = 0;
                      foreach ($front_sections as $row) {
                        if ($row->section_enabled) {
                          continue;
                        }
                        $i++; ?>
                        <div class="col-md-12 sections" data-sectionid="<?= $row->id ?>">
                          <div class="">
                            <div class="row mb-2">
                              <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                  <div class="label-sort"><?= $row->name ?></div>
                                </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  <label class="switch">
                                    <input type="checkbox" class="enableswitch" name="enableswitch" id="<?= $row->name ?>" <?= $row->name == 'Header Section' ? 'onchange="toggleOnHeader(this)"' : '' ?> <?= $row->name == 'Header Slider' ? 'onchange="toggleOnSlider(this)"' : '' ?> <?= $row->section_enabled ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6"></div>
                      <?php }
                    } else { ?>
                      <div>
                        <div colspan="3" class="text-center"> No record Found </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row form-bottom">
          <div class="col-md-12">
            <button type="button" class="btn btn-sm btn-primary btnsave_front_sections">Save</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('pulldown_menu')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="pulldown_menu_bluebar" data-tip_section="pulldown_menu">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Pulldown Menu</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'pulldown_menu_bluebar' ? 'display:block;' : '' ?>">
        <!-- <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <div class="row mb-17">
            <?php $pulldown_menu_outline = get_outline_settings('pulldown_menu_outline'); ?>
            <div class="col-md-12 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="pulldown_menu_outline" <?php echo  $pulldown_menu_outline->time != null ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $pulldown_menu_outline->outline_color ?>" placeholder="#000000" data-slug="pulldown_menu_outline">
                </div>
              </div>
            </div>
          </div>
          <div class="myhr mb-16"></div>
        <?php } ?> -->
        <div class="row">
          <div class="col-sm-6">
            <a href="<?= base_url('addmenu') ?>"><button type="button" class="btn btn-sm btn-primary">Add Menu</button></a>
          </div>
          <div class="col-sm-6 enablesortingdiv" align="right">
            <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
          </div>
        </div>
        <br>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Name</th>
                <th>Section</th>
                <th> Action </th>
                <th></th>
              </tr>
            </thead>
            <tbody class="sortablemenutable">
              <?php if (count($front_menu) > 0) { ?>
                <?php $i = 0;
                foreach ($front_menu as $row) {
                  //if ($row->section_enabled || $row->link_type !="") {
                  $i++; ?>
                  @if(($row->link_type && $row->link_type != "")|| ($row->front_section && $row->front_section->section_enabled =='1'))
                  <tr class="menusections" data-sectionid="<?= $row->id ?>" onclick="showMenuPulldownActionModal(<?= $row->id ?>)" style="<?= $row->front_section && $row->front_section->section_enabled =='0'? 'background:lightgrey;':'';?>">
                    <td style="width:30%"  class="<?=$row->menu_enable == 0? 'text-menu-disabled':''?>"><?= $row->name ?></td>
                    <td style="width:30%" class="<?=$row->menu_enable == 0? 'text-menu-disabled':''?>"><?php echo $row->front_section && $row->front_section->name ? $row->front_section->name : ''; ?> <?php echo $row->link_type && $row->link_type != "" ? $row->link_type == 'customforms' ? 'Forms' : $row->link_type : ''; ?></td>
                    <td style="width:30%">
                      <a href="<?php echo base_url('editmenu/' . $row->id); ?>" class="btn btn-sm btn-primary <?=$row->menu_enable == 0? 'bg-menu-disabled':''?>"><i class="fa fa-pencil"></i> Edit</a>
                      
                      <div class="btn-group">
                        <button type="button" class="dropdown-toggle mydropdown btn btn-sm btn-primary menudropdownaction <?=$row->menu_enable == 0? 'bg-menu-disabled':''?>"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Remove
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
                          <a href="<?php echo base_url('deletemenu/' . $row->id); ?>" class="dropdown-item" onclick="return confirm('Are You Sure?');"> Delete</a>  
                          @if($row->menu_enable == 1)
                            <a class="dropdown-item" href="<?php echo base_url('disablemenu/' . $row->id); ?>">Disable</a>
                          @else 
                            <a class="dropdown-item" href="<?php echo base_url('enablemenu/' . $row->id); ?>">Enable</a>
                          @endif
                        </div>
                      </div>

                    </td>
                    <td>
                      @if($row->menu_enable == 1)
                        <span class="text-success">Enabled</span>
                      @else
                        <span class="text-danger">Disabled</span>
                      @endif
                    </td>
                  </tr>
                  @endif
                 
      <?php
                  //}
                }
              } else { ?>
      <tr>
        <td colspan="3" class="text-center"> No record Found </td>
      </tr>
    <?php } ?>
    </tbody>
    </table>
    <div class="row form-bottom">
      <div class="col-md-12">
        <button type="button" class="btn btn-sm btn-primary btnsavemenu">Save</button>
      </div>
    </div>
      </div>
    </div>
</div>
<?php } ?>
<?php if (check_auth_permission('nav_bar')) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="nav_bar_bluebar" data-tip_section="nav_bar">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Nav Bar</div>
          <div class="title-2 text-color-grey ml-2">Not seen on smartphones</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class="enable-disable-feature-div navBar-indecators navBar-indecator-enable" style="<?php echo  $navBarSettings->enable ? 'display: block;' : 'display: none;' ?>">
            <div class="title-4-400 text-color-green">Enabled</div>
          </div>
          <div class="enable-disable-feature-div navBar-indecators navBar-indecator-disable" style="<?php echo  !$navBarSettings->enable ? 'display: block;' : 'display: none;' ?>">
            <div class="title-4-400 text-color-red2">Disabled</div>
          </div>
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'nav_bar_bluebar' ? 'display:block;' : '' ?>">
      <?php if (check_auth_permission(['build_site_Content'])) { ?>
        <div class="row mb-17">
          <?php $nav_bar_outline = get_outline_settings('nav_bar_outline'); ?>
          <div class="col-md-12 text-right">
            <div class="mr-6vi">
              <label class="title-5 text-black">Tutorial WebsiteControls</label>
            </div>
            <div class="align-all-right d-flex align-items-end">
              <div class="form-group  d-flex align-items-center">
                <div for="" class="title-9 text-black">Turn On Outline</div>
                <label class="switch ml-7">
                  <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="nav_bar_outline" <?php echo  $nav_bar_outline->time != null ? 'checked' : '' ?>>
                  <span class="slider round"></span>
                </label>
              </div>
              <div class="form-group ml-34">
                <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $nav_bar_outline->outline_color ?>" placeholder="#000000" data-slug="nav_bar_outline">
              </div>
            </div>
          </div>
        </div>
        <div class="myhr mb-16"></div>
      <?php } ?>
      <div class="content2">
        <div class="row">
          <div class="col-md-12">
            <div class="grey-div d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <div class="title-2">Enable Nav Bar</div>
              </div>
            </div>
            <div class="position-relative switchoverhead3">
              <div class="switchbtns">
                <div class="form-group ml-20">
                  <label class="switch ml-2">
                    <input type="checkbox" class="notificationswitch showHideNavBar" name="nav_bar_enable" <?php echo  $navBarSettings->enable ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="editcontent2 pl-2" style="<?php echo  $navBarSettings->enable ? 'display: block;' : '' ?>">
          <form class="data-form" action="{{url('savenavbar')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Always Stick to Top</div>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch" name="nav_bar_stick_to_top" <?php echo  $navBarSettings->stick_to_top ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Text default color</div>
                  <input type="color" class="myinput2" name="nav_bar_text_color" value="<?php echo $navBarSettings->text_color ?>" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-30">
                  <label for="nav_bar_font_family mb-12">Font</label>
                  <select class="myinput2" name="nav_bar_font_family" id="nav_bar_font_family">
                    <?php if (count($font_family) > 0) { ?>
                      <?php foreach ($font_family as $singlefont) { ?>
                        <option style="font-family: <?= $singlefont->value ?>;" value="<?= $singlefont->id ?>" <?= $navBarSettings->font_family == $singlefont->id ? 'selected' : '' ?>><?= $singlefont->name ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Enable Nav Bar Banner</div>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch" name="nav_bar_enable_banner" <?php echo  $navBarSettings->enable_banner ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Nav Bar Banner Color</div>
                  <input type="color" class="myinput2" name="nav_bar_banner_color" value="<?php echo $navBarSettings->banner_color ?>" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Reset Button Text Color</div>
                  <div class="d-flex">
                    <label class="switch mt-1">
                      <input type="checkbox" class="notificationswitch" name="reset_button_text_color_enable" <?php echo  $navBarSettings->reset_button_text_color_enable ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                    <div class=" ml-2">
                      <input type="color" class="myinput2" name="reset_button_text_color" value="<?php echo $navBarSettings->reset_button_text_color ?>" placeholder="#000000">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="title-5 text-black">Nav Bar Buttons <span class="title-5-new">(max of 5, min 1)</span></div>
            <br>
            @foreach($navBarItems as $navBarItem)
            <div class="row">
              <input type="hidden" name="nav_bar_item[]" value="{{$navBarItem->id}}">
              <div class="col-md-2">
                <div class="d-flex">
                  <div class="form-group mb-30">
                    <div for="" class="title-9 text-black mb-12">Enable</div>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch" name="nav_bar_btn_enable[{{$navBarItem->id}}]" <?php echo  $navBarItem->enable ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>

                  <div class="form-group mb-30 ml-2">
                    <div for="" class="title-9 text-black mb-12">Use default text color</div>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch" name="nav_bar_use_default_text_color[{{$navBarItem->id}}]" <?php echo  $navBarItem->use_default_text_color ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Button {{$navBarItem->id}} text</div>
                  <input type="text" class="myinput2" name="nav_bar_btn_text[{{$navBarItem->id}}]" value="<?php echo $navBarItem->text ?>" placeholder="" maxlength="12">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Button {{$navBarItem->id}} Text Color</div>
                  <input type="color" class="myinput2" name="nav_bar_btn_text_color[{{$navBarItem->id}}]" value="<?php echo $navBarItem->color ?>" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Button {{$navBarItem->id}} Link</div>
                  <select name="section[{{$navBarItem->id}}]" class="myinput2 link_section_option action_button_selection">
                    <option value="link" <?= $navBarItem->link_type == 'link' ? 'selected' : '' ?>>Link</option>
                    <option value="call" <?= $navBarItem->link_type == 'call' ? 'selected' : '' ?>>Call</option> 
                    <option value="sms" <?= $navBarItem->link_type == 'sms' ? 'selected' : '' ?>>SMS</option> 
                    <option value="email" <?= $navBarItem->link_type == 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="text_popup" <?= $navBarItem->link_type == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                    <option value="google_map" <?= $navBarItem->link_type == 'google_map' ? 'selected' : '' ?>>Map</option>
                    <option value="video" <?= $navBarItem->link_type == 'video' ? 'selected' : '' ?>>Video</option>
                    <option value="address" <?= $navBarItem->link_type == 'address' ? 'selected' : '' ?>>Address</option>
                    <option value="customforms" <?= $navBarItem->link_type == "customforms" ? 'selected' : '' ?>>Forms</option>
                    <?php foreach ($front_sections as $single) { ?>
                      <option value="<?= $single->id ?>" <?= $single->id == $navBarItem->section ? 'selected' : '' ?>><?= $single->name ?></option>
                    <?php } ?>
                  </select>
                  <div class="form-group action_fields phone_no_calls" style="<?= $navBarItem->link_type == 'call' ? 'display:block' : 'display:none' ?>">
                    <label for="">Phone number for calls</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_calls[{{$navBarItem->id}}]" value="<?= $navBarItem->phone_no_call ?>">
                  </div>
                  <div class="form-group action_fields phone_no_sms" style="<?= $navBarItem->link_type == 'sms' ? 'display:block' : 'display:none' ?>">
                    <label for="">Phone number for sms</label>
                    <input type="text" class="myinput2" name="action_button_phone_no_sms[{{$navBarItem->id}}]" value="<?= $navBarItem->phone_no_sms ?>">
                  </div>
                  <div class="form-group quilleditor-div action_fields  action_textpopup"  style="<?= $navBarItem->link_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                      <label>Popup Text </label>
                      <textarea class="myinput2 editordata hidden" name="action_button_textpopup[{{$navBarItem->id}}]"><?php echo $navBarItem->action_button_textpopup; ?></textarea>
                      <div class="quilleditor">
                      <?php echo $navBarItem->action_button_textpopup; ?>
                      </div>
                  </div>
                  <div class="form-group action_fields action_email" style="<?= $navBarItem->link_type == 'email' ? 'display:block' : 'display:none' ?>">
                    <label for="">Email</label>
                    <input type="text" class="myinput2" name="action_button_action_email[{{$navBarItem->id}}]" value="<?= $navBarItem->email ?>">
                  </div>
                  <div class="form-group action_fields video_upload" name="navbar_btn_{{$navBarItem->id}}"  style="<?= $navBarItem->link_type == 'video' ? 'display:block' : 'display:none' ?>">
                      <label for="customFile">Upload Video</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="navbar_action_video[{{$navBarItem->id}}]" id="customFile"
                              accept=".mp4">
                          <label class="custom-file-label" for="customFile">Upload Video</label>
                      </div>
                      @if(isset($navBarItem->action_button_video) && $navBarItem->action_button_video !='')
                          <div class=" position-relative d-flex navbarbtnvideo{{$navBarItem->id}}">
                          <video height="80" controls>
                              <source src="<?= isset($navBarItem->action_button_video) ? base_url('assets/uploads/'.get_current_url().($navBarItem->action_button_video)  ):''?>" type="video/mp4" >
                          </video>
                          <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='navbarbtnvideo' data-id="{{$navBarItem->id}}" data-file="{{$navBarItem->action_button_video}}">X
                          </div> 
                          </div>
                      @endif
                  </div>
                  <div class="form-group action_fields action_link" style="<?= $navBarItem->link_type == 'link' ? 'display:block' : 'display:none' ?>">
                    <input type="text" class="myinput2 news_post_link" name="link_url[{{$navBarItem->id}}]" id="news_post_link" value="<?= $navBarItem->link_url ?>" placeholder="http://google.com">
                  </div>
                  <div class="form-group action_fields action_forms" style="<?= $navBarItem->link_type == 'customforms' ? 'display:block' : 'display:none' ?>">
                    <select class="myinput2 customforms" name="custom_form[{{$navBarItem->id}}]">
                      <?php if (count($custom_forms) > 0) { ?>
                        <?php foreach ($custom_forms as $single) { ?>
                          <option value="<?= $single->id ?>" <?= $navBarItem->custom_form == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class=" action_fields action_map" style="<?= $navBarItem->link_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                    <div class="form-group ">
                      <label for="address">Enter Address</label>
                      <input type="text" class="myinput2 " name="map_address[{{$navBarItem->id}}]" value="<?= isset($navBarItem->map_address) && $navBarItem->map_address ? $navBarItem->map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                    </div>
                  </div>
                  <div class="form-group action_fields action_address" style="display:<?= $navBarItem->link_type == 'address'  ? 'block' : 'none' ?>">
                    <label>Select an Address</label>
                    <select name="address_id[{{$navBarItem->id}}]" class="myinput2">
                      <?php foreach ($addresses as $address) { ?>
                        <option value="<?= $address->id ?>" <?= $navBarItem->address_id == $address->id ? 'selected' : '' ?>> <?= $address->address_title ?> </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group mb-30">
                  <div for="" class="title-9 text-black mb-12">Enable Nav Bar Banner</div>
                  <label class="switch">
                    <input type="checkbox" class="notificationswitch" name="nav_bar_items_enable_banner[{{$navBarItem->id}}]" <?php echo  $navBarItem->enable_banner ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            @endforeach
            <div class="row form-bottom">
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-primary btnsavenavbar">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?php if (check_auth_permission(['footer', 'footer_text', 'footer_link'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="footer_bluebar">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Footer</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'footer_bluebar' ? 'display:block;' : '' ?>">
      <form action="{{url('savefooter')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <div class="row mb-17">
            <?php $footer_outline = get_outline_settings('footer_outline'); ?>
            <div class="col-md-12 text-right">
              <div class="mr-6vi">
                <label class="title-5 text-black">Tutorial Website Controls</label>
              </div>
              <div class="align-all-right d-flex align-items-end">
                <div class="form-group  d-flex align-items-center">
                  <div for="" class="title-9 text-black">Turn On Outline</div>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="footer_outline" <?php echo  $footer_outline->time != null ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="form-group ml-34">
                  <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                  <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $footer_outline->outline_color ?>" placeholder="#000000" data-slug="footer_outline">
                </div>
              </div>
            </div>
          </div>
          <div class="myhr mb-16"></div>
        <?php } ?> -->
        <div class="row">
          <?php if (isSAOnly()) { ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Footer Text</label>
                <input type="text" class="myinput2" name="footertext" value="<?= $footerSettings->footer_text ?>" placeholder="Title">
              </div>
            </div>
          <?php } ?>
          <?php if (isSAOnly()) { ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Link</label>
                <input type="text" class="myinput2" name="footretextlink" value="<?= $footerSettings->footre_text_link ?>" placeholder="https://google.com">
              </div>
            </div>
          <?php } ?>
          <?php if (check_auth_permission('footer')) { ?>
            <div class="col-md-3">
              <div class="form-group">
                <label>Background color</label>
                <input type="color" class="myinput2" name="footrebackcolor" value="<?= $footerSettings->footre_back_color ?>" placeholder="#000000">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Text color</label>
                <input type="color" class="myinput2" name="footretextcolor" value="<?= $footerSettings->footre_text_color ?>" placeholder="#000000">
              </div>
            </div>
          <?php } ?>
        </div>
        <br>
      
        <div class="row">
          @if(isSAOnly())
            <div class="col-md-3">
              <div class="form-group">
                <label>Footer Text 1</label>
                <input type="text" class="myinput2" name="footer_text_1" value="<?= $footerSettings->footer_text_1 ?>" placeholder="Social Media Links">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Footer Text 2</label>
                <input type="text" class="myinput2" name="footer_text_3" value="<?= $footerSettings->footer_text_2 ?>" placeholder="We Donot Collect Cookies.">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Copyright Text</label>
                <input type="text" class="myinput2" name="copy_right_text" value="<?= $footerSettings->copy_right_text ?>" placeholder="© 2022">
              </div>
            </div>
          @endif
        </div>
        <br>
        <div class="row make-sticky">
          <div class="col-md-12">
            <button type="submit" name="savefooter" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="savefooter" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php } ?>

<div id="faviconModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static">
  <!-- Modal content -->
  <div class="modal-dialog modal-dialog-centered upload-image-modal modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Select Image</h5>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="image-wrapper imgrcroperdiv-favicon">
          <img class="image-rcroper-favicon" src="https://demo.webhound.tech/assets/uploads/<?php echo get_current_url() ?>898417-09-2021.png">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btncropsave-favicon">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="template_contactforms" style="display:none">

  <div class="content2 content2formno">
    <div class="row">
      <div class="col-md-12">
        <div class="grey-div d-flex justify-content-between align-items-center editbtn2 editbtn2formno">
          <div class="d-flex align-items-center">
            <div class="title-2">Form formno</div>
          </div>
          <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
        </div>
      </div>
    </div>
    <div class="editcontent2 editcontent2formno">
      <div class="singlecontactform">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="bannertext"> Active Form</label>
              <br>
              <label class="switch">
                <input type="checkbox" name="formstatus[]">
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bannertext"> Show Map</label>
              <br>
              <label class="switch">
                <input type="checkbox" class="show_map" name="showmap[]">
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-md-2">
            <br>
            <button type="button" class="btn btn-primary btnremovecontactform" onclick="removeCF('formno')">X</button></a>
          </div>
          <!-- <div class="col-md-2">
            <br>
            <button type="button" class="btn btn-primary btnremovegallerypost" data-formid="<?= $single->id ?>">X</button>
          </div> -->
          <div class="col-md-4">
            <div class="form-group">
              <label>Form Title</label>
              <input class="gallerypostid formid" type="hidden" name="formid[]" value="">
              <input type="text" class="myinput2" name="form_title[]" value="" placeholder="Form Title">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Form Title Text Color</label>
              <input type="color" class="myinput2" name="form_title_color[]" value="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Form Title Text Size</label><br>
              <input type="number" class="myinput2 width-50px" name="form_title_size[]" value="" placeholder="16">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="title_font_size">Form Title Font</label>
              <select class="myinput2" name="form_title_font_family[]">
                <?php if (count($font_family) > 0) { ?>
                  <?php foreach ($font_family as $singlefont) { ?>
                    <option style="font-family: <?= $singlefont->value ?>;" value="<?= $singlefont->id ?>"><?= $singlefont->name ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Send Message To (Email Address)</label>
              <input type="text" class="myinput2" name="formemail[]" value="" placeholder="example@gmail.com">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="btn2color">Map Script (From Google Map Generator)</label>
              <a href="https://google-map-generator.com/" class="ml-5" target="_blank">Click here to access the Google Map Generator page</a>
              <textarea class="myinput2" name="form_google_map[]" id="btn2color" cols="30" rows="3" placeholder="<iframe>......"></textarea>
            </div>
          </div>
        </div>
        <div class="confactformfielddiv">
          <?php $formFieldNumber = 0;
          ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group"><label>Field name</label>
                <input type="text" class="myinput2" name="fieldname[formno][]" value="" placeholder="Field name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group"><label>Field type</label>
                <select class="myinput2" name="fieldtype[formno][]">
                  <option value="text">Text</option>
                  <option value="textarea">Text Area</option>
                  <option value="file">File Upload</option>
                </select>
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for="bannertext"> Required?</label>
                <br>
                <label class="switch">
                  <input type="checkbox" name="required[formno][]" value="1">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-md-2">
              <br>
              <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
            </div>
          </div>

          <input class="formfieldno" type="hidden" name="formfieldno[]" value="0">
        </div>
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary btnaddnewcontactformfields" data-formid="formno" data-formfieldno="0">Add New Field</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function showMenuPulldownActionModal(id) {
    if ($(window).width() < 991) {
      $("#actionNewsPostModal").html($('#menuPulldownModal' + id).html());
      $("#actionNewsPostModal").modal('show');
    }
  }
  $(document).on('change', '.header_btn1_section', function() {
    if ($(this).val() == 'link') {
      $('.btn1link').show();
    } else {
      $('.btn1link').hide();
    }
  });
  $(document).on('change', '.header_btn2_section', function() {
    if ($(this).val() == 'link') {
      $('.btn2link').show();
    } else {
      $('.btn2link').hide();
    }
  });
  $(document).on('change', '.header_btn3_section', function() {
    if ($(this).val() == 'link') {
      $('.btn3link').show();
    } else {
      $('.btn3link').hide();
    }
  });


  $(document).on('change', '.save_captcha', function() {
    var checked = '0';
    if ($(this).prop('checked') == true) {
      checked = '1';
    }
    $.ajax({
      url: '<?= base_url('savecaptcha'); ?>',
      type: "POST",
      data: {
        checked: checked,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });



  $(document).on('click', '.btnaddnewcontactformfields', function() {
    var formid = $(this).data('formid');
    var formfieldno = $(this).data('formfieldno');
    $(this).closest('.singlecontactform').find('.confactformfielddiv').append('<div class="row"><div class="col-md-3"> <div class="form-group"><label>Field name</label><input type="text" class="myinput2" name="fieldname[' + formid + '][]" value="" placeholder="Field name"></div></div><div class="col-md-3"><div class="form-group"><label>Field type</label><select class="myinput2" name="fieldtype[' + formid + '][]"><option value="text">Text</option><option value="textarea">Text Area</option><option value="file">File Upload</option></select></div></div> <div class="col-md-1"><div class="form-group"><label for="bannertext"> Required?</label><br><label class="switch"><input type="checkbox" name="required[' + formid + '][' + formfieldno + ']" value="1"><span class="slider round"></span></label></div></div> <div class="col-md-2"> <br><button type="button" class="btn btn-primary btnremovecantactformfield" >X</button></div></div>');
    $(this).data('formfieldno', formfieldno + 1);
  });
  $(document).on('click', '.btnremovecantactformfield', function() {
    $(this).closest('.row').remove();
  });

  $(document).on('click', '.btnaddnewcontacttitle', function() {

    $('.contacttitlediv').append($('.contactformtitletrmplatediv').html());
  });
  let formno = parseInt("{{ count($contact_forms)}}");
  $(document).on('click', '.btnaddnewcontactform', function() {
    formno++;
    $('.template_contactforms').find('.btnaddnewcontactformfields').data('_formno_', formno);

    $('.contactforms').append($('.template_contactforms').html().replace(/formno/g, formno));
    $('.editbtn2' + formno).on('click', function(e) {

      if ($(this).closest('.content2' + formno).find('.editcontent2' + formno).is(':visible')) {
        $(this).closest('.content2' + formno).find('.editcontent2' + formno).hide('slow');
        $(this).find('img').attr('src', base_url + '/assets/admin2/img/arrow-down-grey.png');
        $(this).css('border', 'none');
      } else {
        $('.editcontent2' + formno).hide();
        $('.editbtn2' + formno).find('img').attr('src', base_url + '/assets/admin2/img/arrow-down-grey.png');
        $('.editbtn2' + formno).css('border', 'none');
        $(this).closest('.content2' + formno).find('.editcontent2' + formno).show('slow');
        $(this).find('img').attr('src', base_url + '/assets/admin2/img/arrow-up-blue.png');
        $(this).css('border', '0.5px solid #3FA8F9');
      }
    });
  });

  $(document).on('click', '.btnremoverow', function() {
    $(this).closest('.row').remove();
  });
</script>

<script>
  var loadFavIcon = function(event) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.imgrcroperdiv-favicon').empty();

      $('.imgrcroperdiv-favicon').html('<img class="image-rcroper-favicon" src="' + e.target.result + '">');
      $("#faviconModal").modal('show');
      $('.image-rcroper-favicon').rcrop({
        minSize: [200 / 3, 200 / 3],
        preserveAspectRatio: true,
        full: true,
        preview: {
          display: true,
          size: [200 / 5, 200 / 5],
        }
      });
    }
    reader.readAsDataURL(event.target.files[0]);
    // document.getElementById('modalImagesforUploads').style.display = 'none';

  };

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
  $(document).ready(function() {

    $('.enableswitch_all_features').change(function() {
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

    checkSeeTips(sub_sections);
    popupStatus();
    var is_disabled = isTipsDisabled('settings');

    if (is_disabled) {

      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
      $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
      $("input[name='tippopups']").prop('checked', true);

    }

    $(document).on('click', '.btncropsave-favicon', function() {
      var imageData = $('.image-rcroper-favicon').rcrop('getDataURL');
      $('.favicon-data-image').val(imageData);
      $('.uploadImageDiv-favicon').find('.imagefromgallerysrc-favicon').attr('src', imageData);
      $('.uploadImageDiv-favicon').find('.imgdiv-favicon').show();
      $("#faviconModal").modal('hide');
      $('.imgrcroperdiv-favicon').empty();
    });

    $(document).on('click', '.btnimgremove-favicon', function() {
      $(this).closest('.uploadImageDiv-favicon').find('.imgdiv-favicon').hide();
      $(this).closest('.uploadImageDiv-favicon').find('.imagefromgallerysrc-favicon').attr('src', '');
    });



    // $('.sample_input_favicon').awesomeCropper({
    //   width: 200,
    //   height: 200,
    //   debug: false
    // });

    $('#add_new_oneStepImage_btn').on('click', function() {
      $('#add_new_oneStepImage').fadeIn();
      $('#add_new_step_image').val(1);
      $('.add_new_oneStepImage').find('.editbtn2').trigger('click');
      $('html, body').animate({
        scrollTop: $("#add_new_oneStepImage").offset().top
      }, 1000);
    });
    $('#add_new_oneStepImage_text_btn').on('click', function() {
      $('#add_new_oneStepImage').fadeIn();
      $('#text_enabled_div').show();
      $('#add_new_step_image').val(1);
      $('#text_enabled').val(1);
      $('.add_new_oneStepImage').find('.editbtn2').trigger('click');
      $('html, body').animate({
        scrollTop: $("#add_new_oneStepImage").offset().top
      }, 1000);
    });

    $('.remove-one-step-image').on('click', function() {
      var image_id = $(this).data('one-step');
      $.ajax({
        url: '<?= url('admin/settings/remove_step_entry'); ?>',
        type: "POST",
        dataType: 'JSON',
        data: {
          'step_id': image_id,
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {
          $('#one-step-content' + image_id).remove();
          console.log(data)
        }
      });
    });
  });
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

<script src="<?= url('assets/admin2/jquery.ui.touch-punch.min.js'); ?>"></script>
<script>
  $('.sort_front_sections_table').sortable({
    cancel: ".btn-group",
    stop: function(event, ui) {
      if ((window.innerWidth <= 768)) {
        $(".sort_front_sections_table").sortable("disable");
        $('.sort_front_sections_table').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
        $('.sort_front_sections_table').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
      }
    }
  });
  if ((window.innerWidth <= 768)) {
    $(".sort_front_sections_table").sortable("disable");
  }

  $('.sort_front_sections_table_edit_website').sortable({
    cancel: ".btn-group",
    stop: function(event, ui) {
      if ((window.innerWidth <= 768)) {
        $(".sort_front_sections_table_edit_website").sortable("disable");
        $('.sort_front_sections_table_edit_website').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
        $('.sort_front_sections_table_edit_website').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
      }
    }
  });
  if ((window.innerWidth <= 768)) {
    $(".sort_front_sections_table_edit_website").sortable("disable");
  }

  $(document).on('click', '.btnsave_front_sections', function() {
    var order = '';
    var enable = {};
    $('.enable_sections').each(function() {
      order = order + $(this).data('sectionid') + ',';
    });
    console.log(order);
    $('.sections').each(function() {
      if ($(this).find('input.enableswitch').prop('checked') == true) {
        console.log('1'+ this);
        enable[$(this).data('sectionid')] = 1;
      } else {
        console.log('0'+ this);
        enable[$(this).data('sectionid')] = 0;
      }
    });

    var edit_order = '';
    var edit_enable = {};
    $('.sections_edit_frontend_enable').each(function() {
      edit_order = edit_order + $(this).data('sectionid') + ',';
    });
    $('.sections_edit_frontend').each(function() {
      if ($(this).find('input.enableswitch').prop('checked') == true) {
        edit_enable[$(this).data('sectionid')] = 1;
      } else {
        edit_enable[$(this).data('sectionid')] = 0;
      }
    });

    $.ajax({
      url: '<?= url('savesectionorder'); ?>',
      type: "POST",
      data: {
        'sectionorder': order,
        'enableorder': enable,
        'editsectionorder': edit_order,
        'editenableorder': edit_enable,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {
        cuteAlert({
          type: "success",
          title: "",
          message: 'Section order has been updated ',
          buttonText: "Okay"
        });
        const toastContainer = document.querySelector(".alert-wrapper");

        setTimeout(() => {

          window.location.href = '/settings?block=feature_stack_order_bluebar';
          toastContainer.remove();
          resolve();
        }, 1500);
      }
    });
  });
</script>

<script>
  $('.sortablemenutable').sortable({
    cancel: ".btn-group",
    stop: function(event, ui) {
      if ((window.innerWidth <= 768)) {
        $(".sortablemenutable").sortable("disable");
        $('.sortablemenutable').closest('.editcontent').find('.btnSortableEnableDisabled').data('status', 'enable');
        $('.sortablemenutable').closest('.editcontent').find('.btnSortableEnableDisabled').html('Enable Sorting');
      }
    }
  });
  if ((window.innerWidth <= 768)) {
    $(".sortablemenutable").sortable("disable");
  }

  function removeFavIcon(){
    $(".fav-icon-container").hide();
    $.ajax({
      url: '<?= url('removeFavIcon'); ?>',
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {
      }
    });
  }
  $(document).on('click', '.btnsavemenu', function() {
    var order = '';
    $('.menusections').each(function() {
      order = order + $(this).data('sectionid') + ',';
    });
    $.ajax({
      url: '<?= url('savemenuorder'); ?>',
      type: "POST",
      data: {
        'order': order,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {
        location.reload();
      }
    });
  });
  $(document).on('click', '.showHideNavBar', function() {
    $('.navBar-indecators').hide();
    var this_checked = true;
    if ($(this).prop('checked') == true) {
      $(this).closest('.content2').find('.editcontent2').show('slow');
      $('.navBar-indecator-enable').show();
      this_checked = true;
    } else {
      $(this).closest('.content2').find('.editcontent2').hide('slow');
      $('.navBar-indecator-disable').show();
      this_checked = false;
    }
    $.ajax({
      url: '<?= url('savenavbarenable'); ?>',
      type: "POST",
      data: {
        'nav_bar_enable': this_checked,
        _token: "{{ csrf_token() }}"
      },
      success: function(data) {}
    });
  });
  $(document).on('click', '.add_new_category_btn', function() {
    var step = $(this).data('step_id');
    $('#old_category' + step).hide();
    $('#old_category' + step).find('.category').attr('disabled', true);
    $('#new_category' + step).show();
    $('#new_category' + step).find('#bannertext').attr('required', true);
  });

  function removeCF(formno) {
    $(".content2" + formno).remove();
  }
</script>

@endsection('content')