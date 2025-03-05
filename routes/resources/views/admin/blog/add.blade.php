@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD {{ $controller_name }}</h1>
      <a href="{{ url('blog?block=blog_list') }}" class="btn btn-info " >
          Back
      </a>
      </div>

      <form  class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('saveblog')}}">
        @csrf
        <div class="row">
          <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">ADD <?=$controller_name?></h6>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="myinput2" id="title" value="{{old('title')}}" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="title">Category</label>
                    <select type="text" name="category" class="myinput2" >
                      <?php if(isset($blogcategory) && count($blogcategory)>0){?>
                        <?php foreach($blogcategory as $single){?>
                          <option value="<?=$single->id?>" @if(old('category') && old('category') == $single->id) selected @endif><?=$single->title?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="title">Keywords</label>
                    <input type="text" name="keywords" class="myinput2" id="title" value="{{old('keywords')}}" placeholder="example, etc">
                  </div>
                  <div class="form-group">
                    <label for="title">Meta Description</label>
                    <input type="text" name="meta_desc" class="myinput2" id="title" value="{{old('meta_desc')}}" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="title">Webpage's Short Description</label>
                      <textarea name="short_desc" rows="5" class="myinput2" required>{{old('short_desc')}}</textarea>
                  </div>
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
          <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?=$controller_name?> Style</h6>
              </div>
                <div class="card-body">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="title">Title color</label>
                      <input type="color" name="title_color" class="myinput2" id="title" value="{{old('title_color')}}" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="title">Title Font</label>
                      <select class="myinput2" name="title_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" @if(old('title_font') && old('title_font')==$single->id) selected @endif value="<?= $single->id ?>"><?= $single->name ?></option>
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
                      <input type="color" name="desc_color" class="myinput2" id="title" value="{{old('desc_color')}}" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="title">Desc Font</label>
                      <select class="myinput2" name="desc_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;"  @if(old('desc_font') && old('desc_font')==$single->id) selected @endif value="<?= $single->id ?>"><?= $single->name ?></option>
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
                      <input type="color" name="category_color" class="myinput2" id="title" value="" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="title">Category Font</label>
                      <select class="myinput2" name="category_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;"  @if(old('category_font') && old('category_font')==$single->id) selected @endif value="<?= $single->id ?>"><?= $single->name ?></option>
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
                      <input type="color" name="date_color" class="myinput2" id="title" value="{{old('date_color')}}" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="title">Date Font</label>
                      <select class="myinput2" name="date_font" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?>>
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" @if(old('date_font') && old('date_font')==$single->id) selected @endif value="<?= $single->id ?>"><?= $single->name ?></option>
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
                      <input type="color" name="read_more_button_color" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?> class="myinput2" id="title" value="{{old('read_more_button_color')}}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="title">Read more Button Background</label>
                      <input type="color" name="read_more_button_bg_color" <?php if($blogSettings->use_generic_settings){?> disabled <?php } ?> class="myinput2" id="title" value="{{old('read_more_button_bg_color')}}">
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
                        <input type="checkbox" class="notificationswitch action_button_active" name="action_button_active" @if(old('action_button_active')) checked @endif >
                        <span class="slider round"></span>
                        </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="title">Button Text</label>
                      <input type="text" name="btn_text" class="myinput2" id="title" value="{{old('btn_text')}}">
                    </div>
                  </div>
                  <div class="col-lg-6">
                   
                    <div class="form-group">
                      <label for="action_button_link">Action Button Application</label>
                      <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="btn_link">
                        <option value="link" @if(old('btn_link') =='link') selected @endif>Link</option>
                        <option value="call"  @if(old('btn_link') =='call') selected @endif>Call</option>
                        <option value="sms"  @if(old('btn_link') =='sms') selected @endif>SMS</option>
                        <option value="email"  @if(old('btn_link') =='email') selected @endif>Email</option>
                        <option value="audioiconfeature"  @if(old('btn_link') =='audioiconfeature') selected @endif>Audio Icon Feature</option>
                        <option value="google_map"  @if(old('btn_link') =='google_map') selected @endif>Map</option>
                        <option value="text_popup"  @if(old('btn_link') =='text_popup') selected @endif>Text Popup</option>
                        <option value="video"  @if(old('btn_link') =='video') selected @endif>Video</option>
                        <option value="address"  @if(old('btn_link') =='address') selected @endif>Address</option>
                        <option value="customforms"  @if(old('btn_link') =='customforms') selected @endif>Forms</option>
                        <?php foreach ($front_sections as $single) { ?>
                          <option value="<?= $single->slug ?>" @if(old('btn_link') == $single->slug) selected @endif><?= $single->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group action_fields phone_no_calls" style="display:none;">
                      <label for="">Phone number for calls</label>
                      <input type="text" class="myinput2" name="action_button_phone_no_calls" value="">
                    </div>
                    <div class="form-group action_fields phone_no_sms" style="display:none;">
                      <label for="">Phone number for sms</label>
                      <input type="text" class="myinput2" name="action_button_phone_no_sms" value="">
                    </div>
                    <div class="form-group quilleditor-div action_fields  action_textpopup"  style="display:none">
                        <label>Popup Text </label>
                        <textarea class="myinput2 editordata hidden" name="action_button_textpopup"></textarea>
                        <div class="quilleditor"></div>
                    </div>
                    <div class="form-group action_fields action_email" style="display:none;">
                      <label for="">Email</label>
                      <input type="text" class="myinput2" name="action_button_action_email" value="">
                    </div>

                    <div class="form-group action_fields action_link" style="display:block;">
                      <label for="title">Button Link</label>
                      <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                    </div>

                    <div class="form-group action_fields action_forms" style="display:none;">
                      <label for="title">Select Form</label>
                      <select class="myinput2 customforms" name="action_button_customform">
                        <?php if (count($custom_forms) > 0) { ?>
                          <?php foreach ($custom_forms as $single) { ?>
                            <option value="<?= $single->id ?>"><?= $single->title ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class=" action_fields action_map" style="display:none">
                        <div class="form-group " >
                            <label for="address">Enter Address</label>
                            <input type="text" class="myinput2 " name="action_button_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                    </div>
                    <div class="form-group action_fields video_upload" name="action_button_video1"  style="display:none">
                      <label for="customFile">Upload Video</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                              accept=".mp4">
                          <label class="custom-file-label" for="customFile">Upload Video</label>
                      </div>
                    </div>
                    <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature"  style="display:none">
                        <label for="customFile">Select File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                        </div>
                        
                    </div>
                    <div class="form-group action_fields action_address" id="address-list-1" style="display:none;">
                      <label for="addressbtn1">Select an Address</label>
                      <select name="action_button_address_id" class="myinput2">
                        <?php
                        foreach ($addresses as $address) {
                        ?>
                          <option value="<?= $address->id ?>"><?= $address->address_title ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="title">Button Text color</label>
                      <input type="color" name="btn_text_color" class="myinput2" id="title" value="{{old('btn_text_color')}}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label for="title">Button Background</label>
                      <input type="color" name="btn_bg" class="myinput2" id="title" value="{{old('btn_bg')}}">
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label for="title">Title Font</label>
                      <select class="myinput2" name="btn_text_font">
                        <?php if (count($font_family) > 0) { ?>
                          <?php foreach ($font_family as $single) { ?>
                            <option style="font-family: <?= $single->value ?>;" @if(old('btn_text_font') && old('btn_text_font')==$single->id) selected @endif value="<?= $single->id ?>"><?= $single->name ?></option>
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
            <!-- Form Basic -->
            <div class="card mb-4">
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="form-group quilleditor-div ">
                            <label for="title">Description</label>
                            <textarea name="description" cols="40" rows="10" class="myinput2 editordata hidden"></textarea>
                            <div class="quilleditor">
                            <?php echo old('description');?>
                            </div>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="row  make-sticky">
                      <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?=base_url($controller.'?block=blog_list')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
  </div>
@endsection('content')