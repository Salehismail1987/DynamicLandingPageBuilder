@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT Gallery Video</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('galleries?block=gallery_video_bluebar')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
      
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">EDIT <?=$controller_name?></h6>
                </div>
                <div class="card-body">
                    <form role="form" class="data-form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updategalleryvideo')?>">
                    @csrf
                    <input type="hidden" name="record_id" value="{{$detail_info->id}}">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Auto play</label><br>
                          <label class="switch">
                              <input type="checkbox" class="notificationswitch" name="video_auto_play" <?=$detail_info->video_auto_play?'checked':''?>>
                              <span class="slider round"></span>
                            </label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="bannertext">Video repeat</label><br>
                          <label class="switch">
                              <input type="checkbox" class="notificationswitch" name="video_repeat" <?=$detail_info->video_repeat?'checked':''?>>
                              <span class="slider round"></span>
                            </label>
                        </div>
                      </div>
                  </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customFile">Select Video</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="userfile" id="customFile" accept=".mp4">
                            <label class="custom-file-label" for="customFile">Select Video</label>
                          </div>
                          <!--<p>Image Size has to be excat width 1000px and height 660px</p>-->
                        </div>
                      </div>
                      <div class="col-md-6">
                            <video width="inherit" style="width:inherit" controls>
                              <source src="<?=base_url("assets/uploads/".get_current_url())?>" type="video/mp4">
                            </video>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Video Image<label><br>
                          <?php if($detail_info->video_image){  ?>
                                <div class="imgdiv">
                                <img src='<?= base_url("assets/uploads/".get_current_url().$detail_info->video_image) ?>' width="100%">
                                <button type="button" class="btn btn-primary btnimgdel" data-type='gallery_video' data-imgid="<?= $detail_info->id ?>">X</button>
                              </div>
                            <?php } ?>
                      </div>
                    </div>
                    <div class="row " style="margin-bottom: 15px;" >
                    

                      <div class="col-md-12"  >
                        
                        <div class="uploadImageDiv">
                          <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                          <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                          <input class="dataimage" type="hidden" name="video_image">

                          <div class="col-md-6 imgdiv" style="display:none">
                            <br>
                            <img src='' width="100%" class="imagefromgallerysrc">
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                          </div>
                        </div>
                      </div>
                      
                    </div
                    <br/>
                    <br>
                    <div class="row">
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Video Sub-Title</label>
                              <input type="text" class="myinput2" name="gallery_slider_text" value="<?php echo $detail_info->text;?>" placeholder="">
                            </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Video Sub-Title Text Color</label>
                              <input type="color" class="myinput2" 
                              <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                              name="gallery_slider_text_color" value="<?php echo $detail_info->text_color;?>" placeholder="">
                            </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Video Sub-Title Background Color</label>
                              <input type="color" class="myinput2" 
                              <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                              name="gallery_slider_text_background_color" value="<?php echo $detail_info->back_color;?>" placeholder="">
                            </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title_font_size">Video Sub-Title Font</label>
                          <select class="myinput2" name="font_family"
                          <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                          >
                              <?php if(count($font_family)>0){ ?>
                                  <?php foreach($font_family as $single){ ?>
                                        <option style="font-family: <?=$single->value?>;" value="<?=$single->id?>" <?=$detail_info->font_family==$single->id?'selected':'';?>><?=$single->name?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Video Sub-Title Text Size</label><br>
                              <input type="text" class="myinput2 width-50px" 
                              <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                              name="gallery_slider_text_fontsize" value="<?php echo $detail_info->title_fontsize;?>" placeholder="">
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title_font_size">Description Font</label>
                          <select class="myinput2" name="font_family_desc" 
                          <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                          >
                              <?php if(count($font_family)>0){ ?>
                                  <?php foreach($font_family as $single){ ?>
                                        <option style="font-family: <?=$single->value?>;" value="<?=$single->id?>" <?=$detail_info->font_family_desc==$single->id?'selected':'';?>><?=$single->name?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Description Text Size</label><br>
                              <input type="text" class="myinput2 width-50px" 
                              <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                              name="gallery_slider_desc_fontsize" value="<?php echo $detail_info->desc_fontsize;?>" placeholder="">
                            </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                              <label>Description Text Color</label>
                              <input type="color"
                              <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                              class="myinput2" name="gallery_video_description_color" value="<?php echo $detail_info->description_color;?>" placeholder="">
                            </div>
                      </div>
                      <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text Color</label>
                      <input type="color" class="myinput2" 
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_video_description_color" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Read More Text Color</label>
                      <input type="color" class="myinput2" name="read_more_content_color" 
                      <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                      value="<?= $detail_info->read_more_content_color ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Read More Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" name="read_more_content_font_size"  
                      <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                      value="<?= $detail_info->read_more_content_font_size ?>" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Description Read More Font</label>
                      <select class="myinput2" name="read_more_content_font_family"
                      <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                      >
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $singleff) { ?>
                            <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($detail_info->read_more_content_font_family) && ($detail_info->read_more_content_font_family == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                      <div class="col-md-12">
                            <div class="form-group quilleditor-div">
                              <label>Description</label>
                              <textarea class="myinput2 editordata hidden" name="gallery_slider_desc"><?php echo $detail_info->desc;?></textarea>
                              <div class="quilleditor">
                                <?php echo $detail_info->desc;?>
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
                            <input type="text" class="myinput2" name="read_more_text" placeholder="Read More" value="<?=$detail_info->read_more_text?$detail_info->read_more_text:'Read more'?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">  
                        <div class="col-md-12">
                          <div class="form-group quilleditor-div">
                            <label>Post Description Text</label>
                            <textarea class="myinput2 editordata hidden" name="read_more_desc"><?php echo $detail_info->read_more_desc; ?></textarea>
                              <div class="quilleditor">
                                  <?php echo $detail_info->read_more_desc;?>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Input text for a Read Less option</label>
                            <input type="text" class="myinput2" name="read_less_text" placeholder="Read Less" value="<?=$detail_info->read_less_text?$detail_info->read_less_text:'Read less'?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="title_font_size">Text Under Video Font</label>
                          <select class="myinput2" name="font_family_desc_2" 
                          <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                          >
                            <?php if (count($font_family) > 0) { ?>
                              <?php foreach ($font_family as $single) { ?>
                                <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?=$detail_info->font_family_desc_2==$single->id?'selected':'';?>><?= $single->name ?></option>
                              <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Under Video Text Size</label><br>
                          <input type="text" class="myinput2 width-50px" 
                          <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                          name="gallery_slider_desc_2_fontsize" value="<?php echo $detail_info->desc_2_fontsize;?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Text Under Video Text Color</label>
                          <input type="color" class="myinput2" 
                          <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                          name="gallery_video_description_2_color" value="<?php echo $detail_info->description_2_color;?>" placeholder="">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Text Under Video</label>
                          <textarea class="myinput2" rows="2" name="gallery_slider_desc_2" placeholder=""><?php echo $detail_info->desc_2;?></textarea>
                        </div>
                      </div>
                    </div>
                  
                    <!-- Action Button Settings -->
                    <div class="content2">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                  <div class="d-flex align-items-center">
                                      <div class="title-2">Action Button Settings</div>
                                  </div>
                                  <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt=""
                                      width="12px" class="">
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
                        <div class="row">
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
                              <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link"   name="action_button_link">
                                <option value="link">Link</option>
                                <option value="call" <?= $detail_info->action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                <option value="sms" <?= $detail_info->action_button_link == 'sms' ? 'selected' : '' ?>>SMS</option>
                                <option value="email" <?= $detail_info->action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                <option value="video" <?= $detail_info->action_button_link == 'video' ? 'selected' : '' ?>>Video</option>
                                <option value="audioiconfeature" <?= $detail_info->action_button_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio Icon Feature</option>
                                <option value="google_map" <?= $detail_info->action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                <option value="text_popup" <?= $detail_info->action_button_link == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                <option value="address" <?= $detail_info->action_button_link == 'address' ? 'selected' : '' ?>>Address</option>
                                    <option value="customforms" <?= $detail_info->action_button_link == "customforms" ? 'selected' : '' ?>>Forms</option>
                                <?php foreach ($front_sections as $single) { ?>
                                  <option value="<?= $single->slug ?>" <?= $detail_info->action_button_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                <?php } ?>
                              </select>
                            </div>

                            <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                              <label for="">Phone number for calls</label>
                              <input type="text" class="myinput2" name="action_button_phone_no_calls" value="<?= $detail_info->action_button_phone_no_calls ?>">
                            </div>
                            <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for sms</label>
                                <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                            </div>
                            <div class="form-group quilleditor-div action_fields  action_textpopup"  style="<?= $detail_info->action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                <label>Popup Text </label>
                                <textarea class="myinput2 editordata hidden" name="action_button_textpopup"><?php echo $detail_info->action_button_textpopup; ?></textarea>
                                <div class="quilleditor">
                                <?php echo $detail_info->action_button_textpopup; ?>
                                </div>
                            </div>
                            <div class="form-group action_fields action_email" style="<?= $detail_info->action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                <label for="">Email</label>
                                <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                            </div>
                            <div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature"  style="<?= $detail_info->action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Select File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                        accept=".mp3">
                                    <label class="custom-file-label" for="customFile">Select File</label>
                                </div>
                                <div class="row">
                                <?php if ($detail_info->action_button_link == 'audioiconfeature' && $detail_info->action_button_audio_icon_feature) {
                                
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
                            <div class="form-group action_fields video_upload" name="action_button_video1"  style="<?= $detail_info->action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                              <label for="customFile">Upload Video</label>
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                      accept=".mp4">
                                  <label class="custom-file-label" for="customFile">Upload Video</label>
                              </div>
                            
                              @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                                  <div class=" position-relative d-flex gallery_video_action_button">
                                  <video height="80" controls>
                                      <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/'.get_current_url().($detail_info->action_button_video)  ):''?>" type="video/mp4" >
                                  </video>
                                  <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='gallery_video_action_button' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                                  </div> 
                                  </div>
                              @endif
                          </div>
                            <div class="form-group action_fields action_link" style="<?= $detail_info->action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="<?= $detail_info->action_button_link_text ?>" placeholder="http://google.com">
                            </div>
                            <div class="form-group action_fields action_forms" style="<?= $detail_info->action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                <select class="myinput2 customforms" name="action_button_customform">
                                    <?php if(count($custom_forms)>0){ ?>
                                    <?php foreach($custom_forms as $single){ ?>
                                        <option value="<?=$single->id?>" <?= $detail_info->action_button_customform == $single->id ? 'selected' : '' ?>><?=$single->title?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class=" action_fields action_map" style="<?= $detail_info->action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                <div class="form-group " >
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="action_button_map_address" value="<?= isset($detail_info->action_button_map_address) && $detail_info->action_button_map_address ? $detail_info->action_button_map_address :'' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                </div>
                            </div>
                            <div class="form-group action_fields audio_upload" name="feature_action_audio" style="<?= $detail_info->action_button_link == 'audiofeature' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Select File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3">
                                    <label class="custom-file-label" for="customFile">Select File</label>
                                </div>
                            </div>
                            <div class="row">
                            <?php if ($detail_info->action_button_action_audio) {
                            
                                ?>
                                    <div class="col-md-10 imgdiv">
                                        <h4><?= $detail_info->action_button_action_audio ?></h4>
                                        <button type="button" class="btn btn-primary btnaudiofiledel"
                                        data-slug="gallery_video"
                                        data-id="<?= $detail_info->id ?>"
                                            data-imgname="<?= $detail_info->action_button_action_audio ?>">X</button>
                                    </div>
                                <?php 
                                
                        
                            } ?>
                        </div>
                        <br>
                            <div class="form-group action_fields action_address" style="<?= $detail_info->action_button_link == 'address' ? 'display:block' : 'display:none' ?>">
                                <label for="addressbtn1">Select an Address</label>
                                <select name="action_button_address_id" class="myinput2">
                                <?php foreach($addresses as $address){ ?>
                                    <option value="<?=$address->id?>" <?= $detail_info->action_button_address_id == $address->id ? 'selected' : '' ?>><?=$address->address_title?></option>
                                <?php } ?>
                                </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

         
                    <div class="row make-sticky">
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?=base_url('galleries?block=gallery_video_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                      </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Row-->
</div>
<script>
    $(document).on('click', '.btnaudiofiledel', function() {
            var imgname = $(this).data('imgname');
            var id = $(this).data('id');
            if($(this).data('slug'))
            {
                var slug = $(this).data('slug');
            }
            else
            {
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
  //  function check_selction(value){
    
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

  @if($detail_info->read_more_text)
    $(".read_more_content").show();
  @else 
    $(".read_more_content").hide();
  @endif

  $(document).on('click','.show_read_more_block',function(){
    $(".read_more_content").toggle();
  });

  $(document).on('click', '.btnimgdel', function() {
    var imgid = $(this).data('imgid');
    $(this).closest('.imgdiv').remove();
    $.ajax({
        url: '<?= url('delvideoimage'); ?>',
        type: "POST",
        data: {
          'imgid': imgid,
          _token: "{{ csrf_token() }}"
        },
      success: function(data) {}
    });
  });
</script>
@endsection('content')