@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD {{ $controller_name }}</h1>
      <a href="{{ url('quicksettings?block=newsfeed_bluebar') }}" class="btn btn-info " >
          Back
      </a>
      </div>

      <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('createnewsfeed') }}">
        @csrf
          <div class="row">
              <div class="col-lg-8">
                <!-- Form Basic -->
                <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">ADD <?= $controller_name ?></h6>
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
                        <div class="col-md-6 gallery_tile">
        
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>SubTitle Text </label>
                            <input type="text" class="myinput2" name="subtitle_text" value="{{old('subtitle_text')}}"/>
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
                                      <div class="inputcolor" style="background:{{old('subtitle_text_color')}}"></div>
                                      <input type="color" class="colorinput"  name="subtitle_text_color" id="bannertextcolor" value="{{old('subtitle_text_color')}}" placeholder="#000000">
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>SubTitle Text size Web</label><br/>
                            <input type="number" class="myinput2 width-50px"
                            
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                            name="subtitle_font_size_web" value="{{old('subtitle_font_size_web')}}" placeholder="22">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>SubTitle Text size Mobile</label><br/>
                            <input type="number" class="myinput2 width-50px"
                            
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                            name="subtitle_font_size_mobile" value="{{old('subtitle_font_size_mobile')}}" placeholder="22">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="description_font">SubTitle Text Font</label>
                            <select class="myinput2" name="subtitle_font_family" id="subtitle_font_family" 
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>>
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
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Description Text </label>
                            <textarea rows="4" class="myinput2 h-auto" name="desc_text">{{old('desc_text')}}</textarea>
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
                                      <div class="inputcolor" style="background:{{old('desc_text_color')}}"></div>
                                      <input type="color" class="colorinput"  name="desc_text_color" id="bannertextcolor" value="{{old('desc_text_color')}}" placeholder="#000000">
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Description Text size (Web)</label><br/>
                            <input type="number" class="myinput2 width-50px"
                            
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                            name="desc_font_size_web" value="{{old('desc_font_size_web')}}" placeholder="22">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Description Text size (Mobile)</label><br/>
                            <input type="number" class="myinput2 width-50px"
                            
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>
                            name="desc_font_size_mobile" value="{{old('desc_font_size_mobile')}}" placeholder="22">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="desc_font_family">Description Text Font</label>
                            <select class="myinput2" name="desc_font_family" id="desc_font_family" 
                            <?php if($is_generic_setting_on){ ?> disabled <?php } ?>>
                              <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $single) { ?>
                                  <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bannertext">Link Social Media Icons?</label><br>
                                <label class="switch">
                                <input type="checkbox" class="notificationswitch" name="link_social_media_icons" >
                                <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bannertext">Update Date Stamp at Saving?</label>
                                <label class="switch">
                                <input type="checkbox" class="notificationswitch" name="update_dates_on_saving" >
                                <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                      </div>
                          
                      <div class="row make-sticky">
                        <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
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
                                <input type="checkbox" class="notificationswitch action_button_active" name="action_button_active" >
                                <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="title">Button Text</label>
                            <input type="text" name="btn_text" class="myinput2" id="title" value="{{old('btn_text')}}">
                          </div>
                        </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="btn1link">Button 1 Link</label>
                              <select class="myinput2 header_btn1_section action_button_selection" name="btnsection">
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
                                <?php foreach ($front_sections as $single) { ?>
                                  <option value="<?= $single->slug ?>"><?= $single->name ?></option>
                                <?php } ?>
                              </select>

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
                                    <input type="text" class="myinput2 news_post_link" name="btn_link" id="news_post_link" value="" placeholder="http://google.com">
                                </div>
                                <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature"  style="display:none">
                                    <label for="customFile">Select File</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                            accept=".mp3">
                                        <label class="custom-file-label" for="customFile">Select File</label>
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
                                <div class="form-group action_fields action_forms" style="display:none;">
                                    <select class="myinput2 customforms" name="btnform">
                                        <?php if(count($custom_forms)>0){ ?>
                                        <?php foreach($custom_forms as $single){ ?>
                                            <option value="<?=$single->id?>"><?=$single->title?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class=" action_fields action_map" style="display:none">
                                  <div class="form-group " >
                                      <label for="address">Enter Address</label>
                                      <input type="text" class="myinput2 " name="btn_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                   </div>
                                </div>
                                <div class="form-group action_fields action_address" style="display:none;">
                                  <label for="addressbtn1">Select an Address</label>
                                  <select name="action_button_address_id" class="myinput2">
                                    <?php foreach($addresses as $address){ ?>
                                      <option value="<?=$address->id?>"><?=$address->address_title?></option>
                                    <?php } ?>
                                  </select>
                                </div>

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
                                      <div class="inputcolor" style="background:{{old('btn_text_color')}}"></div>
                                      <input type="color" class="colorinput"  name="btn_text_color" id="bannertextcolor" value="{{old('btn_text_color')}}" placeholder="#000000">
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
                                      <div class="inputcolor" style="background:{{old('btn_text_color')}}"></div>
                                      <input type="color" class="colorinput"  name="btn_bg" id="bannertextcolor" value="{{old('btn_bg')}}" placeholder="#000000">
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
          </div>
      </form>
  </div>
  <script>
    function check_selction(value){
      if(value =="address" || value == "google_map"){
        $("#btnlink").hide();
        $("#btncustomforms").hide();
        
      }else if(value == "link"){
        $("#btnlink").show();
        $("#btncustomforms").hide();
      }else if(value == "customforms"){
        $("#btncustomforms").show();
        $("#btnlink").hide();
      }else{
        $("#btnlink").hide();
        $("#address-list").hide();
        $("#btncustomforms").hide();
      }
    }
  </script>
@endsection('content')