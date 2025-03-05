@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('blog?block=blog_list')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
      
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('updateblog/'.$record_id)}}">
      @csrf
      <div class="row">
          <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">EDIT <?=$controller_name?></h6>
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" name="title" class="myinput2" id="title" value="<?php echo $detail_info->title;?>" placeholder="Title">
                      </div>
                      <div class="form-group">
                      <label for="title">Category</label>
                      <select type="text" name="category" class="myinput2" >
                          <?php if(isset($blogcategory) && count($blogcategory)>0){?>
                          <?php foreach($blogcategory as $single){?>
                              <option value="<?=$single->id?>" <?= isset($detail_info->category) && $detail_info->category == $single->id ? 'selected' : ''; ?>><?=$single->title?></option>
                          <?php } ?>
                          <?php } ?>
                      </select>
                      </div>
                      <div class="form-group">
                          <label for="title">Keywords</label>
                          <input type="text" name="keywords" class="myinput2" id="title" value="<?php  echo $detail_info->keywords;?>" placeholder="example, etc">
                      </div>
                      <div class="form-group">
                          <label for="title">Meta Description</label>
                          <input type="text" name="meta_desc" required class="myinput2" id="title" value="<?php echo $detail_info->meta_desc;?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label for="title">Webpage's Short Description</label>
                          <textarea name="short_desc" rows="5" class="myinput2"><?php echo $detail_info->short_desc;?></textarea>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Blog Image</h6>
                  </div>
                  <div class="card-body">
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
                      <center>
                          <?php
                          if ($detail_info->image) {
                          ?>
                              <div class="col-md-6 blog_img_div">
                                  <img src='<?= base_url('assets/uploads/' .get_current_url(). $detail_info->image) ?>' width="100%">
                                  <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->image ?>','image','blog_img_div','blogs',<?= $detail_info->id ?>)">X</button>
                              </div>
                          <?php
                          }
                          ?>
                      </center>
                  <br>
                  <div class="row">

                      <div class="col-lg-3">
                      <div class="form-group">
                          <label for="title">Title color</label>
                          <input type="color" name="title_color" class="myinput2" id="title" value="<?php echo $detail_info->title_color;?>" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                      </div>
                      </div>
                      <div class="col-lg-5">
                      <div class="form-group">
                          <label for="title">Title Font</label>
                          <select class="myinput2" name="title_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                          <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($detail_info->title_font) && $detail_info->title_font == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                          <?php } ?>
                          </select>
                      </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3">
                      <div class="form-group">
                          <label for="title">Desc color</label>
                          <input type="color" name="desc_color" class="myinput2" id="title" value="<?php echo $detail_info->desc_color;?>" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                      </div>
                      </div>
                      <div class="col-lg-5">
                      <div class="form-group">
                          <label for="title">Desc Font</label>
                          <select class="myinput2" name="desc_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                          <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($detail_info->desc_font) && $detail_info->desc_font == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                          <?php } ?>
                          </select>
                      </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3">
                      <div class="form-group">
                          <label for="title">Category color</label>
                          <input type="color" name="category_color" class="myinput2" id="title" value="<?php echo $detail_info->category_color;?>" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                      </div>
                      </div>
                      <div class="col-lg-5">
                      <div class="form-group">
                          <label for="title">Category Font</label>
                          <select class="myinput2" name="category_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                          <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($detail_info->category_font) && $detail_info->category_font == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                          <?php } ?>
                          </select>
                      </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-3">
                      <div class="form-group">
                          <label for="title">Date color</label>
                          <input type="color" name="date_color" class="myinput2" id="title" value="<?php echo $detail_info->date_color;?>" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                      </div>
                      </div>
                      <div class="col-lg-5">
                      <div class="form-group">
                          <label for="title">Date Font</label>
                          <select class="myinput2" name="date_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                          <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($detail_info->date_font) && $detail_info->date_font == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                              <?php } ?>
                          <?php } ?>
                          </select>
                      </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="title">Read more Button Text color</label>
                        <input type="color" name="read_more_button_color" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?> class="myinput2" id="title" value="<?php echo $detail_info->read_more_button_color;?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                        <label for="title">Read more Button Background</label>
                        <input type="color" name="read_more_button_bg_color" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?> class="myinput2" id="title" value="<?php echo $detail_info->read_more_button_bg_color;?>">
                        </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Button Style</h6>
              </div>
              <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="bannertext">Action button active</label><br>
                        <label class="switch">
                        <input type="checkbox" class="notificationswitch action_button_active" name="action_button_active" @if($detail_info->action_button_active) checked @endif >
                        <span class="slider round"></span>
                        </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="form-group">
                      <label for="title">Button Text</label>
                      <input type="text" name="btn_text" class="myinput2" id="title" value="<?php echo $detail_info->btn_text;?>">
                  </div>
                  </div>
                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="action_button_link">Action Button Application</label>
                      <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="btn_link">
                        <option value="link" <?= $detail_info->btn_link == 'link' ? 'selected' : '' ?>>Link</option>
                        <option value="call" <?= $detail_info->btn_link == 'call' ? 'selected' : '' ?>>Call</option>
                        <option value="sms" <?= $detail_info->btn_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                        <option value="email" <?= $detail_info->btn_link == 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="address" <?= $detail_info->btn_link == 'address' ? 'selected' : '' ?>>Address</option>
                        <option value="video" <?= $detail_info->btn_link == 'video' ? 'selected' : '' ?>>Video</option>
                        <option value="audioiconfeature" <?= $detail_info->btn_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio Icon Feature</option>
                        <option value="google_map" <?= $detail_info->btn_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                        <option value="text_popup" <?= $detail_info->btn_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                        <option value="customforms" <?= $detail_info->btn_link == 'customforms' ? 'selected' : '' ?>>Forms</option>
                        <?php foreach ($front_sections as $single) { ?>
                          <option value="<?= $single->slug ?>" <?= $detail_info->btn_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->btn_link == 'call' ? 'display:block' : 'display:none' ?>">
                      <label for="">Phone number for calls</label>
                      <input type="text" class="myinput2" name="action_button_phone_no_calls" value="<?= $detail_info->action_button_phone_no_calls ?>">
                    </div>
                    <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->btn_link == 'sms' ? 'display:block' : 'display:none' ?>">
                      <label for="">Phone number for sms</label>
                      <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                    </div>

                    <div class="form-group quilleditor-div action_fields  action_textpopup"  style="<?= $detail_info->btn_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                        <label>Popup Text </label>
                        <textarea class="myinput2 editordata hidden" name="action_button_textpopup"><?php echo $detail_info->action_button_textpopup; ?></textarea>
                        <div class="quilleditor">
                        <?php echo $detail_info->action_button_textpopup; ?>
                        </div>
                    </div>
                    <div class="form-group action_fields action_email" style="<?= $detail_info->btn_link == 'email' ? 'display:block' : 'display:none' ?>">
                      <label for="">Email</label>
                      <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                    </div>
                    <div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature"  style="<?= $detail_info->btn_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                            <label for="customFile">Select File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                    accept=".mp3">
                                <label class="custom-file-label" for="customFile">Select File</label>
                            </div>
                            <div class="row">
                            <?php if ($detail_info->btn_link == 'audioiconfeature' && $detail_info->action_button_audio_icon_feature) {
                            
                                ?>
                                    <div class="col-md-10 imgdiv">
                                        <h4><?= $detail_info->action_button_audio_icon_feature ?></h4>
                                        <button type="button" class="btn d-none btn-primary btnaudioiconfiledel"
                                        data-slug="blog_btn"
                                        data-id="<?= $detail_info->id ?>"
                                            data-imgname="<?= $detail_info->action_button_audio_icon_feature ?>">X</button>
                                    </div>
                                <?php 
                            } ?>
                            </div>
                        </div>
                    <div class="form-group action_fields action_link" style="<?= $detail_info->btn_link == 'link' ? 'display:block' : 'display:none' ?>">
                        <label for="title">Button link</label>
                        <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="<?= $detail_info->action_button_link_text ?>" placeholder="http://google.com">
                    </div>
                    <div class="form-group action_fields video_upload" name="action_button_video2"  style="<?= $detail_info->btn_link == 'video' ? 'display:block' : 'display:none' ?>">
                      <label for="customFile">Upload Video</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                              accept=".mp4">
                          <label class="custom-file-label" for="customFile">Upload Video</label>
                      </div>
                      @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                          <div class=" position-relative d-flex blog_action_video">
                          <video height="80" controls>
                              <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/'.get_current_url().($detail_info->action_button_video)  ):''?>" type="video/mp4" >
                          </video>
                          <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='blog_action_video' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                          </div> 
                          </div>
                      @endif
                  </div>
                    <div class="form-group action_fields action_forms" style="<?= $detail_info->btn_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                        <label for="title">Select Form</label>
                        <select class="myinput2 customforms" name="action_button_customform">
                        <?php if (count($custom_forms) > 0) { ?>
                          <?php foreach ($custom_forms as $single) { ?>
                            <option value="<?= $single->id ?>" <?= $detail_info->action_button_customform == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group action_fields audio_upload" name="feature_action_audio"  style="<?= $detail_info->btn_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                        <label for="customFile">Select File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="audio_file[]" id="customFile"
                                accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                        </div>
                    </div>
                    <div class=" action_fields action_map" style="<?= $detail_info->btn_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                        <div class="form-group " >
                            <label for="address">Enter Address</label>
                            <input type="text" class="myinput2 " name="action_button_map_address" value="<?= isset($detail_info->action_button_map_address) && $detail_info->action_button_map_address ? $detail_info->action_button_map_address :'' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                    </div>
                    <div class="form-group action_fields action_address " id="address-list-1" style="display:<?= $detail_info->btn_link == 'address' ? 'block' : 'none' ?>">
                      <label>Select an Address</label>
                      <select name="action_button_address_id" class="myinput2">
                        <?php foreach ($addresses as $address) { ?>
                          <option value="<?= $address->id ?>" <?= $detail_info->action_button_address_id == $address->id ? 'selected' : '' ?>> <?= $address->address_title ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3">
                  <div class="form-group">
                      <label for="title">Button Text color</label>
                      <input type="color" name="btn_text_color" class="myinput2" id="title" value="<?php echo $detail_info->btn_text_color;?>">
                  </div>
                  </div>
                  <div class="col-lg-4">
                  <div class="form-group">
                      <label for="title">Button Background</label>
                      <input type="color" name="btn_bg" class="myinput2" id="title" value="<?php echo $detail_info->btn_bg;?>">
                  </div>
                  </div>
                  <div class="col-lg-5">
                  <div class="form-group">
                      <label for="title">Title Font</label>
                      <select class="myinput2" name="btn_text_font">
                      <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($detail_info->btn_text_font) && $detail_info->btn_text_font == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                          <?php } ?>
                      <?php } ?>
                      </select>
                  </div>
                  </div>
                
              </div>
              </div>
          </div>
          </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Description</h6>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group quilleditor-div">
                              <label for="title">Description</label>
                              <textarea name="description" cols="40" rows="10" class="myinput2 editordata hidden"></textarea>
                                  <div class="quilleditor">
                                      <?php echo $detail_info->description;?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row  make-sticky">
          <div class="col-lg-12">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url($controller.'?block=blog_list')?>"><button type="button" class="btn btn-default">Cancel</button></a>
          </div>
      </div>
  </form>
</div>
    <!--Row-->
</div>
@endsection('content')