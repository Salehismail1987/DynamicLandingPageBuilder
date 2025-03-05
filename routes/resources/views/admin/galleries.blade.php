@extends('admin.layout.dashboard')
@section('content')

<script>
  var sub_sections = ["gallery_post", "gallery_tiles", "gallery_video", "gallery_slider", "stored_image_gallery", "image_gallery_categories"];
</script>


<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>

<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2"><?= $controller_name ?></div>
      <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
        <!-- <div class="d-flex justify-content-center align-items-center"> -->
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
        <!-- </div> -->
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
                <?php if (check_auth_permission(['gallery_post'])) { ?>
                  <li data-value="gallery_post_bluebar">Gallery Post</li>
                <?php } ?>
                <?php if (check_auth_permission(['gallery_slider'])) { ?>
                  <li data-value="gallery_slider_bluebar">Gallery Slider</li>
                <?php } ?>
                <?php if (check_auth_permission(['gallery_video'])) { ?>
                  <li data-value="gallery_video_bluebar">Gallery Video</li>
                <?php } ?>
                <?php if (check_auth_permission(['gallery_tiles'])) { ?>
                  <li data-value="gallery_tiles_bluebar">Gallery Tiles</li>
                <?php } ?>
                <?php if (check_auth_permission(['image_gallery_category'])) { ?>
                  <li data-value="image_gallery_categories">Image Categories</li>
                <?php } ?>
                <?php if (check_auth_permission(['stored_image_gallery'])) { ?>
                  <li data-value="stored_image_gallery">Stored Image</li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (check_auth_permission(['gallery_post', 'gallery_post_add_new', 'gallery_post_edit_delete'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="gallery_post_bluebar" data-tip_section="gallery_post">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Gallery Post</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('gallerypostsection'))
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

      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'gallery_post_bluebar' ? 'display:block;' : '' ?>">
        <form action="{{url('savegenericpostsettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
          @csrf
          <?php if (check_auth_permission(['build_site_Content'])) { ?>

            <div class="row mb-17">
              <div class="col-md-3">
                <div class="form-group  d-flex">
                  <label>Override Background <br>Color in Settings, Theme</label>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch override_bg_enable gallery_posts_override_bg" name="gallery_posts_override_bg" data-slug="gallery_posts_bg_picker" <?php echo  $galleriesSettings->gallery_posts_override_bg ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group gallery_posts_bg_picker" style="display:<?php echo  $galleriesSettings->gallery_posts_override_bg ? 'block' : 'none' ?>">
                  <label>Feature Background Color</label>
                  <div class="d-flex align-items-center color-main-div">
                    <div>
                      <img src="{{ url('assets') }}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                    </div>
                    <div class="ml-10">
                      <div class="inputcolordiv">
                        <div class="inputcolor" style="background:<?= $galleriesSettings->gallery_post_background ?>">
                        </div>
                        <input type="color" class="colorinput" name="gallery_post_background" id="bannertextcolor" value="<?= $galleriesSettings->gallery_post_background ?>" placeholder="#000000">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php $gallery_post_outline = get_outline_settings('gallery_post_outline'); ?>
              <!-- <div class="col-md-6 text-right">
                  <div class="mr-6vi">
                      <label class="title-5 text-black">Tutorial Website Controls</label>
                  </div>
                  <div class="align-all-right d-flex align-items-end">
                      <div class="form-group  d-flex align-items-center">
                          <div for="" class="title-9 text-black">Turn On Outline</div>
                          <label class="switch ml-7">
                              <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="gallery_post_outline"
                                  <?php echo  $gallery_post_outline->time != null ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                          </label>
                      </div>
                      <div class="form-group ml-34">
                        <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                          <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $gallery_post_outline->outline_color ?>" placeholder="#000000" data-slug="gallery_post_outline">
                      </div>
                  </div>
              </div> -->
            </div>
            <div class="row form-bottom">
              <div class="col-md-12">
                <button type="submit" name="save_generic_gallery_post_settings" class="btn btn-primary" value="save">Save</button>
                <button type="submit" name="save_generic_gallery_post_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
              </div>
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?>
          <?php if (check_auth_permission('gallery_post')) {  ?>

            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Use Generic Settings?</div>
                      <label class="switch ml-3">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="galleriesSettings" data-column="gallery_post_use_generic" name="use_generic_gallery_post_setting" <?= $galleriesSettings->gallery_post_use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bannertext">Autoplay</label><br>
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch" name="gallery_post_autoplay" <?= $galleriesSettings->gallery_post_autoplay ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Post Title Font</label>
                      <select class="myinput2" name="generic_gallery_post_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_post_title->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Title Text Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_post_title_color" value="<?php echo $generic_gallery_post_title->color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Text Block Background Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_post_title_bcakground" value="<?php echo $generic_gallery_post_title->bg_color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Title Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_post_title_font_size" value="<?php echo $generic_gallery_post_title->size_web; ?>" placeholder="16px">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Title Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_post_title_font_size_mobile" value="<?php echo $generic_gallery_post_title->size_mobile; ?>" placeholder="16px">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Description Text Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_post_description_color" value="<?php echo $generic_gallery_post_desc->color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Post Description Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_post_desc_font_size" value="<?php echo $generic_gallery_post_desc->size_web; ?>" placeholder="16px">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Post Description Font</label>
                      <select class="myinput2" name="generic_gallery_post_desc_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_post_desc->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Slider Arrow Color</label>
                      <input type="color" class="myinput2" name="gallery_posts_arrow_color" value="<?php echo $galleriesSettings->gallery_posts_arrow_color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Slider Arrow Background Color</label>
                      <input type="color" class="myinput2" name="gallery_posts_arrow_bg_color" value="<?php echo $galleriesSettings->gallery_posts_arrow_bg_color; ?>" placeholder="#000000">
                    </div>
                  </div>
                </div>
                <div class="row form-bottom">
                  <div class="col-md-12">
                    <button type="submit" name="save_generic_gallery_post_settings" class="btn btn-primary" value="save">Save</button>
                    <button type="submit" name="save_generic_gallery_post_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </form>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Gallery Posts</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-sm-6">
                <?php if (check_auth_permission(['gallery_post_add_new'])) { ?>
                  <a href="<?= base_url('addgallerypost') ?>"><button type="button" class="btn btn-sm btn-primary">Add gallery post</button></a>
                <?php } ?>
              </div>
              <div class="col-sm-6 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <br>
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gallery Post</h6>
              </div>
              <div class="table-responsive" data-table="gallery_posts">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Post Title</th>
                      <th class="hide-mobile">Post Description</th>
                      <?php if (check_auth_permission(['gallery_post_edit_delete'])) { ?>
                        <th> Action </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody class="sortablegalleryposttable">
                    <?php if (count($galleryPost) > 0) { ?>
                      <?php $i = 0;
                      foreach ($galleryPost as $row) {
                        $i++; ?>
                        <tr id="galleryPostDiv<?= $row->id ?>" class="gallerypostsections" data-sectionid="<?= $row->id ?>" onclick="showGalleryPostActionModal(<?= $row->id ?>)">
                          <td>
                            <div class="limit-text">
                              <?= $row->post_title ?>
                            </div>
                          </td>
                          <td class="hide-mobile">
                            <div>

                              <div class="limit-text">
                                <?php
                                $post_desc = strip_tags($row->post_desc);
                                ?>
                                <?= str_replace('color:', '', substr($post_desc, 0, 200)) ?> </div>
                            </div>
                          </td>
                          <?php if (check_auth_permission(['gallery_post_edit_delete'])) { ?>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">

                                  <a class="dropdown-item" href="<?php echo base_url('editgallerypost/' . $row->id); ?>">Edit</a>
                                  <a class="dropdown-item" href="<?php echo base_url('deletegallerypost/' . $row->id); ?>" onclick="return confirm('Are You Sure?');">Delete</a>

                                </div>
                              </div>
                              <div class="modal fade" id="galleryPostModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Gallery Posts Action</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">


                                      <center>
                                        <?php if (check_auth_permission(['gallery_post', 'gallery_post_edit_delete'])) { ?>
                                          <a href="<?php echo base_url('admin/gallerypost/edit/' . $row->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                                          &nbsp;&nbsp;&nbsp;
                                          <a href="<?php echo base_url('admin/gallerypost/delete/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');">Delete</a>

                                        <?php } ?>
                                      </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="3" class="text-center"> No record Found </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['gallery_slider', 'gallery_slider_add_new', 'gallery_slider_edit_delete'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="gallery_slider_bluebar" data-tip_section="gallery_slider">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Gallery Slider</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('galleryslider'))
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

      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'gallery_slider_bluebar' ? 'display:block;' : '' ?>">
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <form action="{{url('savegenericslidersettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
            @csrf

            <div class="row mb-17">
              <div class="col-md-3">
                <div class="form-group d-flex">
                  <label>Override Background <br>Color in Settings, Theme</label>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch override_bg_enable gallery_slider_override_bg" name="gallery_slider_override_bg" data-slug="gallery_slider_bg_picker" <?php echo  $galleriesSettings->gallery_slider_override_bg ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group gallery_slider_bg_picker" style="display:<?php echo  $galleriesSettings->gallery_slider_override_bg ? 'block' : 'none' ?>">
                  <label for="gallery_slider_background">Gallery Slider Background Color</label>
                  <input type="color" class="myinput2" name="gallery_slider_background" id="gallery_slider_background" value="<?= $galleriesSettings->gallery_slider_background ?>" placeholder="#000000">
                </div>
              </div>
              <?php $gallery_slider_outline = get_outline_settings('gallery_slider_outline'); ?>
              <!-- <div class="col-md-6 text-right">
                  <div class="mr-6vi">
                      <label class="title-5 text-black">Tutorial Website Controls</label>
                  </div>
                  <div class="align-all-right d-flex align-items-end">
                      <div class="form-group  d-flex align-items-center">
                          <div for="" class="title-9 text-black">Turn On Outline</div>
                          <label class="switch ml-7">
                              <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="gallery_slider_outline"
                                  <?php echo  $gallery_slider_outline->time != null ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                          </label>
                      </div>
                      <div class="form-group ml-34">
                        <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                          <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $gallery_slider_outline->outline_color ?>" placeholder="#000000" data-slug="gallery_slider_outline">
                      </div>
                  </div>
              </div> -->
            </div>

            <div class="row form-bottom">
              <div class="col-md-12">
                <button type="submit" name="save_generic_gallery_slider_settings" class="btn btn-primary" value="save">Save</button>

              </div>
            </div>
            <!-- </form> -->
            <div class="myhr mb-16"></div>
          <?php } ?>
          <?php if (check_auth_permission('gallery_slider')) { ?>
            <!-- <form action="{{url('savegenericslidersettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;"> -->
            @csrf

            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Use Generic Settings?</div>
                      <label class="switch ml-3">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="galleriesSettings" data-column="gallery_slider_use_generic" name="use_generic_gallery_slider_setting" <?= $galleriesSettings->gallery_slider_use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bannertext">Autoplay</label><br>
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch" name="gallery_slider_autoplay" <?= $galleriesSettings->gallery_slider_autoplay ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_slider_desc_color" value="<?php echo $generic_gallery_slider_text->color; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Block Background Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_slider_desc_background_color" value="<?php echo $generic_gallery_slider_text->bg_color; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text Size on Web</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_slider_desc_fontsize" value="<?php echo $generic_gallery_slider_text->size_web; ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text Size on Mobile</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_slider_desc_fontsize_mobile" value="<?php echo $generic_gallery_slider_text->size_mobile; ?>" placeholder="18">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Description Font</label>
                      <select class="myinput2" name="generic_gallery_slider_desc_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_slider_text->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>


                </div>

                <div class="row form-bottom">
                  <div class="col-md-12">
                    <button type="submit" name="save_generic_gallery_slider_settings" class="btn btn-primary" value="save">Save</button>
                    <button type="submit" name="save_generic_gallery_slider_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>

        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Gallery Slider</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-sm-3">
                <?php if (check_auth_permission(['gallery_slider_add_new'])) { ?>
                  <a href="<?= base_url('addgalleryslider') ?>"><button type="button" class="btn btn-sm btn-primary">Add gallery slider</button></a>
                <?php } ?>
              </div>
              <div class="col-sm-3">
                <div class="ml-2">
                  <div class="form-group">
                    <label for="bannertext">New Sliders on Top /First</label><br>
                    <label class="switch">
                      <input type="checkbox" class="notificationswitch gallery_slider_new_posts_top" name="gallery_slider_new_posts_top" <?= $galleriesSettings->gallery_slider_new_posts_top ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gallery Slider</h6>
              </div>
              <div class="table-responsive" data-table="gallery_sliders">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Image</th>
                      <th class="hide-mobile">Description</th>
                      <?php if (check_auth_permission(['gallery_post_edit_delete'])) { ?>
                        <th> Action </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody class="sortableslidertable">
                    <?php if (count($gallerySlider) > 0) { ?>
                      <?php $i = 0;
                      foreach ($gallerySlider as $row) {
                        $i++; ?>
                        <tr class="imgdiv<?= $row->id ?> galleryslidersections" data-sectionid="<?= $row->id ?>" onclick="showGallerySliderActionModal(<?= $row->id ?>)">
                          <td>
                            <?php if ($row->image) { ?>
                              <img src='<?= base_url('assets/uploads/' . get_current_url() . $row->image) ?>' class="table-images">
                            <?php  } ?>
                          </td>
                          <td class="hide-mobile">
                            <div class="limit-text">
                              <?= substr($row->text, 0, 200) ?> </div>
                          </td>
                          <?php if (check_auth_permission(['gallery_slider', 'gallery_slider_edit_delete'])) { ?>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a class="dropdown-item" href="<?php echo base_url('editgalleryslider/' . $row->id); ?>">Edit</a>
                                  <a class="dropdown-item" href="<?php echo base_url('deletegalleryslider/' . $row->id); ?>" onclick="return confirm('Are You Sure?');">Delete</a>
                                </div>
                              </div>
                            </td>
                          <?php } ?>

                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="3" class="text-center"> No record Found </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['gallery_video', 'gallery_video_add_new', 'gallery_video_eidt_delete'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="gallery_video_bluebar" data-tip_section="gallery_video">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Gallery Video</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('videosection'))
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

      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'gallery_video_bluebar' ? 'display:block;' : '' ?>">
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <form action="{{url('savegenericvideosettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
            @csrf
            <div class="row mb-17">
              <div class="col-md-3">
                <div class="form-group d-flex">
                  <label>Override Background <br>Color in Settings, Theme</label>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch override_bg_enable gallery_video_override_bg" name="gallery_video_override_bg" data-slug="gallery_video_bg_picker" <?php echo  $galleriesSettings->gallery_video_override_bg ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group gallery_video_bg_picker" style="display:<?php echo  $galleriesSettings->gallery_video_override_bg ? 'block' : 'none' ?>">
                  <label for="gallery_video_back_color">Gallery Video Feature Background color</label>
                  <input type="color" class="myinput2" name="gallery_video_back_color" id="gallery_video_back_color" value="<?= $galleriesSettings->gallery_video_background ?>" placeholder="#000000">
                </div>
              </div>
              <?php $gallery_video_outline = get_outline_settings('gallery_video_outline'); ?>
              <!-- <div class="col-md-6 text-right">
                <div class="mr-6vi">
                    <label class="title-5 text-black">Tutorial Website Controls</label>
                </div>
                <div class="align-all-right d-flex align-items-end">
                    <div class="form-group  d-flex align-items-center">
                        <div for="" class="title-9 text-black">Turn On Outline</div>
                        <label class="switch ml-7">
                            <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="gallery_video_outline"
                                <?php echo  $gallery_video_outline->time != null ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="form-group ml-34">
                      <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                        <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $gallery_video_outline->outline_color ?>" placeholder="#000000" data-slug="gallery_video_outline">
                    </div>
                </div>
            </div> -->
            </div>
            <div class="row form-bottom">
              <div class="col-md-12">
                <button type="submit" name="save_generic_gallery_video_settings" class="btn btn-primary" value="save">Save</button>
              </div>
            </div>
            <div class="myhr mb-16"></div>
          <?php } ?>
          <?php if (check_auth_permission('gallery_video')) { ?>


            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Use Generic Settings?</div>
                      <label class="switch ml-3">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="galleriesSettings" data-column="gallery_video_use_generic" name="use_generic_gallery_video_setting" <?= $galleriesSettings->gallery_video_use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Video Sub-Title Text Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_video_title_color" value="<?php echo $generic_gallery_video_subtitle->color; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Video Sub-Title Block Background Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_video_title_background" value="<?php echo $generic_gallery_video_subtitle->bg_color; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Video Sub-Title Font</label>
                      <select class="myinput2" name="generic_gallery_video_title_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_video_subtitle->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Video Sub-Title Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_video_title_size" value="<?php echo $generic_gallery_video_subtitle->size_web; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Video Description Font</label>
                      <select class="myinput2" name="generic_gallery_video_desc_font_family">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_video_desc->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Video Description Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_video_desc_size" value="<?php echo $generic_gallery_video_desc->size_web; ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Video Description Text Color</label><br>
                      <input type="color" class="myinput2 width-50px" name="generic_gallery_video_desc_color" value="<?php echo $generic_gallery_video_desc->color; ?>" placeholder="">
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Video Size</label><br>
                      <input type="number" min="0" class="myinput2 width-65px" name="gallery_video_size" value="<?php echo $galleriesSettings->gallery_video_size; ?>" placeholder="400">
                    </div>
                  </div>

                </div>
                <div class="row form-bottom">
                  <div class="col-md-12">
                    <button type="submit" name="save_generic_gallery_video_settings" class="btn btn-primary" value="save">Save</button>
                    <button type="submit" name="save_generic_gallery_video_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Gallery Video</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-sm-6">
                <?php if (check_auth_permission(['gallery_video_add_new'])) { ?>
                  <a href="<?= base_url('addgalleryvideo') ?>"><button type="button" class="btn btn-sm btn-primary">Add gallery video</button></a>
                <?php } ?>
              </div>
              <div class="col-sm-6 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <br>
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gallery Video</h6>
              </div>
              <div class="table-responsive" data-table="gallery_videos">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th class="hide-mobile">Video</th>
                      <th>Title</th>
                      <th class="hide-mobile">Description</th>
                      <?php if (check_auth_permission(['gallery_video_eidt_delete'])) { ?>
                        <th> Action </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody class="sortablegalleryvideostable">
                    <?php if (count($galleryVideo) > 0) { ?>
                      <?php $i = 0;
                      foreach ($galleryVideo as $row) {
                        $i++; ?>
                        <tr class="galleryvideossections" data-sectionid="<?= $row->id ?>" onclick="showGalleryVideoActionModal(<?= $row->id ?>)">
                          <td class="hide-mobile">
                            <video class="table-images">
                              <source src="<?= base_url("assets/uploads/" . get_current_url() . $row->video) ?>" type="video/mp4">
                              <source src="movie.ogg" type="video/ogg">
                            </video>
                          </td>
                          <td>
                            <div class="limit-text">
                              <?= $row->text ?>
                            </div>
                          </td>
                          <td class="hide-mobile">
                            <div class="limit-text">
                              <?= substr($row->desc, 0, 200) ?> </div>
                          </td>
                          <?php if (check_auth_permission(['gallery_video', 'gallery_video_eidt_delete'])) { ?>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a class="dropdown-item" href="<?php echo base_url('editgalleryvideo/' . $row->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                                  <a class="dropdown-item" href="<?php echo base_url('deletegalleryvideo/' . $row->id); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');">Delete</a>
                                </div>
                              </div>
                              <div class="modal fade" id="galleryVideoModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Gallery Video Action</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <center>
                                        <?php if (check_auth_permission(['gallery_video', 'gallery_video_eidt_delete'])) { ?><a href="<?php echo base_url('admin/galleryvideos/edit/' . $row->id); ?>" class="btn btn-sm btn-primary">Edit</a>

                                          &nbsp;
                                          &nbsp;
                                          &nbsp;
                                          <a href="<?php echo base_url('admin/galleryvideos/delete/' . $row->id); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');">
                                            Delete</a><?php } ?>
                                      </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="3" class="text-center"> No record Found </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php if (check_auth_permission(['gallery_tiles', 'gallery_tile_add_new', 'gallery_tile_edit_delete'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="gallery_tiles_bluebar" data-tip_section="gallery_tiles">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Gallery Tiles</div>
          </div>
          <div class="d-flex  align-items-center">
            @if(check_feature_enable_disable('gallerytilesection'))
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
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'gallery_tiles_bluebar' ? 'display:block;' : '' ?>">
        <?php if (check_auth_permission(['build_site_Content'])) { ?>
          <form action="{{url('savegenerictilesettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
            @csrf
            <div class="row mb-17">
              <div class="col-md-3">
                <div class="form-group d-flex">
                  <label>Override Background <br>Color in Settings, Theme</label>
                  <label class="switch ml-7">
                    <input type="checkbox" class="notificationswitch override_bg_enable gallery_tiles_override_bg" name="gallery_tiles_override_bg" data-slug="gallery_tiles_bg_picker" <?php echo  $galleriesSettings->gallery_tiles_override_bg ? 'checked' : '' ?>>
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group gallery_tiles_bg_picker" style="display:<?php echo  $galleriesSettings->gallery_tiles_override_bg ? 'block' : 'none' ?>">
                  <label for="gallery_tiles_background_color">Gallery Tiles Background color</label>
                  <input type="color" class="myinput2" name="gallery_tiles_background_color" id="gallery_tiles_background_color" value="<?= $galleriesSettings->gallery_tiles_background ?>" placeholder="#000000">
                </div>
              </div>
              <?php $gallery_tiles_outline = get_outline_settings('gallery_tiles_outline'); ?>
              <!-- <div class="col-md-6 text-right">
                  <div class="mr-6vi">
                      <label class="title-5 text-black">Tutorial Website Controls</label>
                  </div>
                  <div class="align-all-right d-flex align-items-end">
                      <div class="form-group  d-flex align-items-center">
                          <div for="" class="title-9 text-black">Turn On Outline</div>
                          <label class="switch ml-7">
                              <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="gallery_tiles_outline"
                                  <?php echo  $gallery_tiles_outline->time != null ? 'checked' : '' ?>>
                              <span class="slider round"></span>
                          </label>
                      </div>
                      <div class="form-group ml-34">
                        <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                          <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $gallery_tiles_outline->outline_color ?>" placeholder="#000000" data-slug="gallery_tiles_outline">
                      </div>
                  </div>
              </div> -->
            </div>
            <div class="row form-bottom">
              <div class="col-md-12">
                <button type="submit" name="saveGalleryTilesSetting" class="btn btn-primary" value="save">Save</button>
              </div>
            </div>
          </form>
          <div class="myhr mb-16"></div>
        <?php } ?>
        <?php if (check_auth_permission('gallery_tiles')) { ?>
          <form action="{{url('savegenerictilesettings')}}" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">
            @csrf
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Use Generic Settings?</div>
                      <label class="switch ml-3">
                        <input type="checkbox" class="notificationswitch saveGeneric" data-table="galleriesSettings" data-column="gallery_tiles_use_generic" name="use_generic_gallery_tiles_settings" <?= $galleriesSettings->gallery_tiles_use_generic ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                      </label>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Tiles Font</label>
                      <select class="myinput2" name="generic_gallery_tiles_desc_font">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_gallery_tiles_text->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Tiles Text Color</label>
                      <input type="color" class="myinput2" name="generic_gallery_tiles_desc_color" value="<?= $generic_gallery_tiles_text->color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Tiles Text Size (Web)</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_tiles_desc_size" value="<?= $generic_gallery_tiles_text->size_web; ?>" placeholder="16">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gallery Tiles Text Size (Mobile)</label><br>
                      <input type="text" class="myinput2 width-50px" name="generic_gallery_tiles_desc_size_mobile" value="<?= $generic_gallery_tiles_text->size_mobile; ?>" placeholder="16">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Tiles Sub Title</label>
                      <input type="text" class="myinput2" name="gallery_tiles_subtitle" value="<?= $gallery_tiles_subtitle->text; ?>" placeholder="Gallery Tiles SubTitle">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="title_font_size">Gallery Tiles Sub-Title Font Family</label>
                      <select class="myinput2" name="gallery_tiles_subtitle_font">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $gallery_tiles_subtitle->fontfamily == $single->id ? 'selected' : ''; ?>>
                              <?= $single->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Tiles Sub-Title Color</label>
                      <input type="color" class="myinput2" name="gallery_tiles_subtitle_color" value="<?= $gallery_tiles_subtitle->color; ?>" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gallery Tiles Sub-Title font size</label><br>
                      <input type="text" class="myinput2 width-50px" name="gallery_tiles_subtitle_size" value="<?= $gallery_tiles_subtitle->size_web; ?>" placeholder="16px">
                    </div>
                  </div>
                </div>

                <div class="row form-bottom">
                  <div class="col-md-12">
                    <button type="submit" name="saveGalleryTilesSetting" class="btn btn-primary" value="save">Save</button>
                    <button type="submit" name="saveGalleryTilesSetting" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php } ?>
        <div class="content2">
          <div class="row">
            <div class="col-md-12">
              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                <div class="d-flex align-items-center">
                  <div class="title-2">Gallery Tiles</div>
                </div>
                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
              </div>
            </div>
          </div>
          <div class="editcontent2">
            <div class="row">
              <div class="col-sm-6">
                <?php if (check_auth_permission(['gallery_tile_add_new'])) { ?>
                  <a href="<?= base_url('addgallerytile') ?>"><button type="button" class="btn btn-sm btn-primary">Add gallery tile</button></a>
                <?php } ?>
              </div>
              <div class="col-sm-6 enablesortingdiv" align="right">
                <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
              </div>
            </div>
            <br>
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gallery Tiles <small>(Drag images to sort)</small></h6>
              </div>
              <?php $useragent = $_SERVER['HTTP_USER_AGENT'];
              $user_agent = (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))); ?>
              <div class="table-responsive" data-table="gallery_tiles">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>Image</th>
                      <th class="hide-mobile">Description</th>
                      <?php if (check_auth_permission(['gallery_tile_edit_delete'])) { ?>
                        <th> Action </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody class="sortablegallerytiletable">
                    <?php if (count($galleryTiles) > 0) { ?>
                      <?php $i = 0;
                      foreach ($galleryTiles as $row) {
                        $i++; ?>
                        <tr class="imgdiv<?= $row->id ?> gallerytilesections" data-sectionid="<?= $row->id ?>" <?php //if($user_agent){ 
                                                                                                                ?> onclick="showGalleryTileActionModal(<?= $row->id ?>)" <?php //} 
                                                                                                                                                                                                ?>>
                          <td><?php
                              if ($row->image) {
                              ?><img src='<?= base_url('assets/uploads/' . get_current_url() . $row->image) ?>' width="100"><?php
                                                                                                                        }
                                                                                                                          ?></td>
                          <td class="hide-mobile">
                            <div class="limit-text">
                              <?= substr($row->description, 0, 200) ?> </div>

                          </td>
                          <?php //if(!$user_agent){ 
                          ?>
                          <?php if (check_auth_permission(['gallery_tile_edit_delete'])) { ?>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a class="dropdown-item" href="<?php echo base_url('editgallerytile/' . $row->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                                  <a class="dropdown-item" href="<?php echo base_url('deletegallerytile/' . $row->id); ?>" class="btn btn-sm btn-primary">Delete</a>
                                </div>
                              </div>
                              <?php //} 
                              ?>
                            </td>
                            <div class="modal fade" id="galleryTileModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Gallery Tiles Action</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <center>
                                      <?php if (check_auth_permission(['gallery_tiles', 'gallery_tile_edit_delete'])) { ?><a href="<?php echo base_url('admin/GalleryTile/edit/' . $row->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <button onClick="delete_tile(<?= $row->id ?>)" class="btn btn-sm btn-primary">
                                          Delete</button><?php } ?>
                                    </center>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="3" class="text-center"> No record Found </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <br>
                <div class="col-md-12">
                  <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gallery_tiles_order" id="gallery_tiles_order" value="">
                    <button type="submit" name="saveGallaryTileOrder" class="btn btn-primary" value="saveGallaryTileOrder">Save Stack Order</button>
                  </form>
                </div>
                <br>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission('image_gallery_category')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="image_gallery_categories" data-tip_section="image_gallery_categories">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Image Categories</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>

      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'image_gallery_categories' ? 'display:block;' : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <a href="<?= base_url('addgallerycategory') ?>"><button type="button" class="btn btn-sm btn-primary">Add Image Category</button></a>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Image Categories</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Title</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                <?php if (count($imageCategories) > 0) { ?>
                  <?php $i = 0;
                  foreach ($imageCategories as $row) {
                    $i++; ?>
                    <tr>
                      <td><?= $row->name ?></td>
                      <td>

                        <div class="btn-group">
                          <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start">
                            <a class="dropdown-item" href="<?php echo base_url('editgallerycategory/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a class="dropdown-item" href="<?php echo base_url('deletegallerycategory/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');">Delete</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php }
                } else { ?>
                  <tr>
                    <td colspan="3" class="text-center"> No record Found </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
          <div class="row ">
            <div class="col-md-12 ">

            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php if (check_auth_permission('stored_image_gallery')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="stored_image_gallery" data-tip_section="stored_image_gallery">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Stored Image</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px" class="">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= isset($_GET['block']) && $_GET['block'] == 'stored_image_gallery' ? 'display:block;' : '' ?>">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-sm btn-primary" onclick="addimage()" data-toggle="modal" data-target="#exampleModalCenter" id="#modalImageUploads">Add Images</button>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div>
              <h6 class="mb-2 font-weight-bold text-primary">Image</h6>
              <div>Select the Category to add an
                new image</div>
            </div>
          </div>
          <div class="card-body">
            <ul class="nav nav-pills">
              <?php $active = 'active first-tab';
              if (count($imageCategories) > 0) { ?>
                <?php $i = 0;
                foreach ($imageCategories as $row) {
                  $i++; ?>
                  <li class="nav-item"><a class="nav-link gallery-pils <?php echo $active;
                                                                        $active = ''; ?>" aria-current="page" href="javascript:void(0);" data-cat_id="<?= $row->id ?>"><?= $row->name ?></a></li>
                <?php } ?>
              <?php } ?>
            </ul>
            <br>
            <div class="row img-container img-container-getImages">

            </div>
          </div>
          <div class="card-footer"></div>
        </div>
        <div class="row ">
          <div class="col-md-12 ">

          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Drop files here to upload</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="form-group">
              <label>Select Category</label>
              <select class="form-control selectcategory" id="image-upload-dropdown">
                <option value=''>Select</option>
                <?php if (count($all_categories) > 0) { ?>
                  <?php foreach ($all_categories as $row) { ?>
                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
              <br>
              <div class="form-group gallery-image-form">
                <form action="<?= base_url('imageUpload') ?>" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST" style="width: 100%;">
                  @csrf
                  <input type="hidden" class="hiddencategory" name="cate_id">
                  <div class="col-md-12">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary buttonUpload" data-dismiss="modal">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

  <script src="<?= base_url('assets/admin2/jquery.ui.touch-punch.min.js'); ?>"></script>
  <script>
    <?php if (isset($block) && $block != "") { ?>

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

    function showGallerySliderActionModal(id) {
      $("#actionNewsPostModal").html($('#gallerySliderModal' + id).html());
      $("#actionNewsPostModal").modal('show');
    }

    function showGalleryVideoActionModal(id) {
      $("#actionNewsPostModal").html($('#galleryVideoModal' + id).html());
      $("#actionNewsPostModal").modal('show');
    }

    function showGalleryTileActionModal(id) {
      $("#actionNewsPostModal").html($('#galleryTileModal' + id).html());
      $("#actionNewsPostModal").modal('show');
    }

    function showGalleryPostActionModal(id) {
      $("#actionNewsPostModal").html($('#galleryPostModal' + id).html());
      $("#actionNewsPostModal").modal('show');

    }
    $(document).ready(function() {

      checkSeeTips(sub_sections);
      popupStatus();
      var is_disabled = isTipsDisabled('gallaries');
      if (is_disabled) {
        $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
        $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
        $("input[name='tippopups']").prop('checked', true);

      }
      $('.sortablegalleryposttable')
        .sortable({
          cancel: ".btn-group",
          stop: function(event, ui) {
            var tableRows = $('.sortablegalleryposttable').closest('.table-responsive').find('.gallerypostsections');
            var table = $('.sortablegalleryposttable').closest('.table-responsive').data('table');
            if ((window.innerWidth <= 768)) {
              $(".sortablegalleryposttable").sortable("disable");
              $('.sortablegalleryposttable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
              $('.sortablegalleryposttable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
          }
        });
      $('.sortableslidertable')
        .sortable({
          revert: true,
          cancel: ".btn-group",
          connectWith: ".sortableslidertable",
          stop: function(event, ui) {
            var tableRows = $('.sortableslidertable').closest('.table-responsive').find('.galleryslidersections');
            var table = $('.sortableslidertable').closest('.table-responsive').data('table');
            if ((window.innerWidth <= 768)) {
              $(".sortableslidertable").sortable("disable");
              $('.sortableslidertable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
              $('.sortableslidertable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
          }
        });
      $('.sortablegalleryvideostable')
        .sortable({
          revert: true,
          cancel: ".btn-group",
          connectWith: ".sortablegalleryvideostable",
          stop: function(event, ui) {
            var tableRows = $('.sortablegalleryvideostable').closest('.table-responsive').find('.galleryvideossections');
            var table = $('.sortablegalleryvideostable').closest('.table-responsive').data('table');
            if ((window.innerWidth <= 768)) {
              $(".sortablegalleryvideostable").sortable("disable");
              $('.sortablegalleryvideostable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
              $('.sortablegalleryvideostable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
          }
        });
      $('.sortablegallerytiletable')
        .sortable({
          revert: true,
          cancel: ".btn-group",
          stop: function(event, ui) {
            var tableRows = $('.sortablegallerytiletable').closest('.table-responsive').find('.gallerytilesections');
            var table = $('.sortablegallerytiletable').closest('.table-responsive').data('table');
            if ((window.innerWidth <= 768)) {
              $(".sortablegallerytiletable").sortable("disable");
              $('.sortablegallerytiletable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
              $('.sortablegallerytiletable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
            }
            save_display_order(tableRows, table);
          }
        });

      if ((window.innerWidth <= 768)) {
        $(".sortablegalleryposttable").sortable("disable");
        $(".sortableslidertable").sortable("disable");
        $(".sortablegalleryvideostable").sortable("disable");
        $(".sortablegallerytiletable").sortable("disable");
      }

    });

    function updateOrder() {
      var order = '';
      console.log('hel');
      $('.gallerytilesections').each(function() {
        order = order + $(this).data('sectionid') + ',';
      });
      $('#gallery_tiles_order').val(order);
    }

    function delete_slider(id) {
      $.ajax({
        url: '<?= base_url('admin/galleryslider/delete/'); ?>' + id,
        type: "GET",
        success: function(data) {
          $('.imgdiv' + id).remove();
        }
      });
    }

    function delete_tile(id) {
      $.ajax({
        url: '<?= base_url('admin/GalleryTile/delete/'); ?>' + id,
        type: "GET",
        success: function(data) {
          $('.imgdiv' + id).remove();
        }
      });
    }

    function delete_post(id) {

      if (confirm("Are you sure you want to delete this?")) {
        $.ajax({
          url: '<?= base_url('admin/gallerypost/delete/'); ?>' + id,
          type: "GET",
          success: function(data) {
            $('#galleryPostDiv' + id).remove();
          }
        });
      } else {
        return false;
      }

    }
  </script>

  <script>
    Dropzone.options.imageUpload = {
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      init: function() {
        this.on("error", function(file, response) {
          console.log(response)
          this.removeFile(this.files[0])
          cuteAlert({
            type: "success",
            title: "",
            message: "Category is required",
            buttonText: "Okay"
          });
          const toastContainer = document.querySelector(".alert-wrapper");

          setTimeout(() => {
            toastContainer.remove();
            resolve();
          }, 2500);
        });
        this.on("complete", function(file) {
          if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

            getCateImages($('.gallery-pils.active'));

          }
        });




      }
    };
  </script>
  <script>
    $(document).ready(function() {

      $(document).on('click', '.buttonUpload', function() {
        $(".hiddencategory").val('');
        $("#image-upload-dropdown").val('');
      });

      $('.hiddencategory').val($('.selectcategory').val());
      $(document).on('change', '.selectcategory', function() {
        $('.hiddencategory').val($(this).val());
      });

      $(document).on('click', '.btnimgdel', function() {
        var imgid = $(this).data('imgid');
        $(this).closest('.imgdiv').remove();
        $.ajax({
          url: '<?= base_url('delgalleryimage'); ?>',
          type: "POST",
          data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'imgid': imgid
          },
          success: function(data) {}
        });
      });

      $('#exampleModalCenter').on('hidden.bs.modal', function(e) {
        getCateImages($('.gallery-pils.active'));
        Dropzone.forElement('#image-upload').removeAllFiles(true);
        // $('#image-upload-dropdown').val('');
      });
    });
  </script>
  @endsection('content')