@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
      
    <form role="form" method="post" enctype="multipart/form-data" action="<?php echo url('updatenewsfeed/' . $detail_info->id) ?>">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">EDIT <?= $controller_name ?></h6>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="uploadImageDiv">
                                    <button type="button" class="btn btn-primary btnuploadimagenew" data-multiply_width="3" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                    <input class="dataimage" type="hidden" name="tile_image">

                                    <div class="col-md-6 imgdiv" style="display:none">
                                        <br>
                                        <img src='' width="100%" class="imagefromgallerysrc">
                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($detail_info->feed_image) {
                            ?>
                                <div class="col-md-6 gallery_tile_div">
                                    <img src='<?= url('assets/uploads/'.get_current_url() . $detail_info->feed_image) ?>' width="100%">
                                    <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->feed_image ?>','feed_image','gallery_tile_div','news_feeds',<?= $detail_info->id ?>)">X</button>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>SubTitle Text </label>
                                <input type="text" class="myinput2" name="subtitle_text" value="<?php echo $detail_info->subtitle_text; ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>SubTitle Text Color</label>
                                    <div class="d-flex align-items-center color-main-div <?php if($is_generic_setting_on){ ?> disabled <?php } ?>">
                                        <div>
                                            <img src="{{url('assets')}}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:{{$detail_info->subtitle_text_color}}"></div>
                                                <input type="color" class="colorinput"  name="subtitle_text_color" id="bannertextcolor" value="{{$detail_info->subtitle_text_color}}" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>SubTitle Text size Web</label>
                                <input type="number" class="myinput2 width-50px"
                                
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                                name="subtitle_font_size_web" value="<?php echo $detail_info->subtitle_font_size_web; ?>" placeholder="22">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>SubTitle Text size Mobile</label>
                                <input type="number" class="myinput2 width-50px"
                                
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                                name="subtitle_font_size_mobile" value="<?php echo $detail_info->subtitle_font_size_mobile; ?>" placeholder="22">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="description_font">SubTitle Text Font</label>
                                <select class="myinput2" name="subtitle_font_family" id="subtitle_font_family" 
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>>
                                    <?php if (count($font_family) > 0) { ?>
                                    <?php foreach ($font_family as $single) { ?>
                                        <option 
                                        <?php if($single->id == $detail_info->subtitle_font_family) { ?> selected<?php } ?>
                                        style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Description Text </label>
                                <textarea rows="4" class="myinput2" name="desc_text"><?php echo $detail_info->desc_text; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Description Text Color</label>
                                    <div class="d-flex align-items-center color-main-div <?php if($is_generic_setting_on){ ?> disabled <?php } ?>">
                                        <div>
                                            <img src="{{url('assets')}}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                                        </div>
                                        <div class="ml-10">
                                            <div class="inputcolordiv">
                                                <div class="inputcolor" style="background:{{$detail_info->desc_text_color}}"></div>
                                                <input type="color" class="colorinput"  name="desc_text_color" id="bannertextcolor" value="{{$detail_info->desc_text_color}}" placeholder="#000000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Description Text size (Web)</label>
                                <input type="number" class="myinput2 width-50px"
                                
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                                name="desc_font_size_web" value="<?php echo $detail_info->desc_font_size_web; ?>" placeholder="22">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label>Description Text size (Mobile)</label>
                                <input type="number" class="myinput2 width-50px"
                                
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                                name="desc_font_size_mobile" value="<?php echo $detail_info->desc_font_size_mobile; ?>" placeholder="22">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="desc_font_family">Description Text Font</label>
                                <select class="myinput2" name="desc_font_family" id="desc_font_family" 
                                <?php if($is_generic_setting_on){ ?> disabled <?php } ?>>
                                    <?php if (count($font_family) > 0) { ?>
                                    <?php foreach ($font_family as $single) { ?>
                                        <option
                                        <?php if($single->id == $detail_info->desc_font_family) { ?> selected<?php } ?>
                                        style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bannertext">Link Social Media Icons?</label><br>
                                    <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="link_social_media_icons" <?php echo $detail_info->link_social_media_icons ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bannertext">Update Date Stamp at Saving?</label>
                                    <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="update_dates_on_saving" <?php echo $detail_info->update_dates_on_saving ? 'checked' : '' ?> >
                                    <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row make-sticky">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo url('send_notification/' . $detail_info->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i>Save & Send Teaser Notification</a>
                                <a href="<?= url('quicksettings?block=newsfeed_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
            
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Button Style</h6>
            </div>
              <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="bannertext">Action button active</label><br>
                        <label class="switch">
                        <input type="checkbox" class="notificationswitch action_button_active" name="action_button_active" <?= $detail_info->action_button_active ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="title">Button Text</label>
                    <input type="text" name="btn_text" class="myinput2" id="title" value="<?php echo $detail_info->btn_text;?>">
                  </div>
                </div>
                  <div class="col-md-12">
                    
                  <div class="form-group">
                      <label for="btn3link">Button 3 Link</label>
                      <select class="myinput2 header_btn3_section action_button_selection" name="btnsection" onchange="check_selction(this.value)">
                        <option value="link">Link</option>
                        <option value="call" <?= $detail_info->btn_section == 'call' ? 'selected' : '' ?>>Call</option>
                        <option value="sms" <?= $detail_info->btn_section == 'sms' ? 'selected' : '' ?>>SMS</option>
                        <option value="email" <?= $detail_info->btn_section == 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="address" <?= $detail_info->btn_section == 'address' ? 'selected' :'' ?>>Address</option>
                        <option value="google_map" <?= $detail_info->btn_section == 'google_map' ? 'selected' : '' ?>>Map</option>
                        <option value="customforms" <?= $detail_info->btn_section == "customforms" ? 'selected' : '' ?>>Forms</option>
                        
                        <?php foreach ($front_sections as $single) { ?>
                          <option value="<?= $single->slug ?>" <?= $detail_info->btn_section == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    
                            
                    <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->btn_section == 'call' ? 'display:block' : 'display:none' ?>">
                      <label for="">Phone number for calls</label>
                      <input type="text" class="myinput2" name="action_button_phone_no_calls" value="<?= $detail_info->action_button_phone_no_calls ?>">
                    </div>
                    <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->btn_section == 'sms' ? 'display:block' : 'display:none' ?>">
                        <label for="">Phone number for sms</label>
                        <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                    </div>
                    <div class="form-group action_fields action_email" style="<?= $detail_info->btn_section == 'email' ? 'display:block' : 'display:none' ?>">
                        <label for="">Email</label>
                        <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                    </div>
                    
                    <div class="form-group action_fields action_link" style="<?= $detail_info->btn_section == 'link' ? 'display:block' : 'display:none' ?>">
                        <input type="text" class="myinput2 btn_link" name="btn_link" id="btn_link" value="<?= $detail_info->btn_link ?>" placeholder="http://google.com">
                    </div>
                    <div class="form-group action_fields action_forms" style="<?= $detail_info->btn_section == 'customforms' ? 'display:block' : 'display:none' ?>">
                        <select class="myinput2 customforms" name="btnform">
                            <?php if(count($custom_forms)>0){ ?>
                            <?php foreach($custom_forms as $single){ ?>
                                <option value="<?=$single->id?>" <?= $detail_info->btnform == $single->id ? 'selected' : '' ?>><?=$single->title?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" action_fields action_map" style="<?= $detail_info->btn_section == 'google_map' ? 'display:block' : 'display:none' ?>">
                            <div class="form-group " >
                                <label for="address">Enter Address</label>
                                <input type="text" class="myinput2 " name="btn_map_address" value="<?= isset($detail_info->btn_map_address) && $detail_info->btn_map_address ? $detail_info->btn_map_address :'' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                            </div>
                        </div>
                    <div class="form-group action_fields action_address" style="<?=  $detail_info->btn_section == 'address' ? 'display:block' : 'display:none' ?>">
                        <label for="addressbtn1">Select an Address</label>
                        <select name="action_button_address_id" class="myinput2">
                        <?php foreach($addresses as $address){ ?>
                            <option value="<?=$address->id?>" <?= $detail_info->action_button_address_id == $address->id ? 'selected' : '' ?>><?=$address->address_title?></option>
                        <?php } ?>
                        </select>
                    </div>

                  </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="title">Button Text color</label>
                    <div class="d-flex align-items-center color-main-div <?php if($is_generic_setting_on){ ?> disabled <?php } ?>">
                        <div>
                            <img src="{{url('assets')}}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                        </div>
                        <div class="ml-10">
                            <div class="inputcolordiv">
                                <div class="inputcolor" style="background:{{$detail_info->btn_text_color}}"></div>
                                <input type="color" class="colorinput"  name="btn_text_color" id="bannertextcolor" value="{{$detail_info->btn_text_color}}" placeholder="#000000">
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="title">Button Background</label>
                    <div class="d-flex align-items-center color-main-div <?php if($is_generic_setting_on){ ?> disabled <?php } ?>">
                        <div>
                            <img src="{{url('assets')}}/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">
                        </div>
                        <div class="ml-10">
                            <div class="inputcolordiv">
                                <div class="inputcolor" style="background:{{$detail_info->btn_bg}}"></div>
                                <input type="color" class="colorinput"  name="btn_bg" id="bannertextcolor" value="{{$detail_info->btn_bg}}" placeholder="#000000">
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
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
    <!--Row-->
    </form>
</div>
    <!--Row-->
</div>
<script>
//   check_selction($('.header_btn3_section').val());
//   function check_selction(value){
//     if(value =="address" || value == "google_map"){
//       $("#btnlink").hide();
//       $("#btncustomforms").hide();
//     }else if(value == "link"){
//       $("#btnlink").show();
//       $("#btncustomforms").hide();
//     }else if(value == "customforms"){
//       $("#btncustomforms").show();
//       $("#btnlink").hide();
//     }else{
//       $("#btnlink").hide();
//       $("#address-list").hide();
//       $("#btncustomforms").hide();
//     }
//   }
</script>
@endsection('content')