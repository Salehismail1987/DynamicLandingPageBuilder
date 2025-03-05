@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD Gallery Video</h1>
      <a href="{{ url('galleries?block=gallery_video_bluebar') }}" class="btn btn-info " >
          Back
      </a>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <!-- Form Basic -->
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">ADD Gallery Video</h6>
            </div>
            <div class="card-body">
              <form role="form" class="data-form" method="post" enctype="multipart/form-data" action="<?= base_url('savegalleryvideo') ?>">
                @csrf
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="bannertext">Auto play</label><br>
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch" name="video_auto_play">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="bannertext">Video repeat</label><br>
                      <label class="switch">
                        <input type="checkbox" class="notificationswitch" name="video_repeat">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="customFile">Select Video</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="userfile" id="customFile" accept=".mp4" required>
                        <label class="custom-file-label" for="customFile">Select Video</label>
                      </div>
                      <!--<p>Image Size has to be excat width 1000px and height 660px</p>-->
                    </div>
                  </div>
                  <div class="col-md-6 gallery_slider">
    
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label>Video Image<label>
                  </div>
                </div>
                <div class="row " style="margin-bottom: 20px;" >
                  <div class="col-md-12" >
                    <div class="uploadImageDiv">
                        
                      <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                      <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                      <input class="dataimage" type="hidden" name="video_image">
    
                      <div class="col-md-4 imgdiv" style="display:none">
                        <br>
                        <img src='' width="100%" class="imagefromgallerysrc">
                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                      </div>
                    </div>
                  </div>
                  
                </div
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Sub-Title</label>
                      <input type="text" class="myinput2" name="gallery_slider_text" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Sub-Title Text Color</label>
                      <input type="color" class="myinput2"
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_slider_text_color" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Video Sub-Title Background Color</label>
                      <input type="color" class="myinput2" 
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_slider_text_background_color" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="title_font_size">Video Sub-Title Font</label>
                      <select class="myinput2" name="font_family"
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      >
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
                      <label>Video Sub-Title Text Size</label><br>
                      <input type="text" class="myinput2  width-50px" 
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_slider_text_fontsize" value="" placeholder="">
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
                      <label>Description Text Size</label><br>
                      <input type="text" class="myinput2 width-50px" 
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_slider_desc_fontsize" value="" placeholder="">
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
                  <div class="col-md-12">
                    <div class="form-group quilleditor-div">
                      <label>Description</label>
                      <textarea class="myinput2 editordata hidden" name="gallery_slider_desc"><?php echo old('gallery_slider_desc'); ?></textarea>
                      <div class="quilleditor">
                          <?php echo old('gallery_slider_desc');?>
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
                        <input type="text" class="myinput2" name="read_more_text" placeholder="Read More" value="<?=old('read_more_text')?old('read_more_text'):'Read more'?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">  
                    <div class="col-md-12">
                      <div class="form-group quilleditor-div">
                        <label>Post Description Text</label>
                        <textarea class="myinput2 editordata hidden" name="read_more_desc"><?php echo old('read_more_desc'); ?></textarea>
                          <div class="quilleditor">
                              <?php echo old('read_more_desc');?>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Input text for a Read Less option</label>
                        <input type="text" class="myinput2" name="read_less_text" placeholder="Read Less" value="<?=old('read_less_text')?old('read_less_text'):'Read less'?>">
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
                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
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
                      name="gallery_slider_desc_2_fontsize" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Text Under Video Text Color</label>
                      <input type="color" class="myinput2" 
                      <?php if($galleriesSettings->gallery_video_use_generic){ ?> disabled <?php } ?>
                      name="gallery_video_description_2_color" value="" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Text Under Video</label>
                      <textarea class="myinput2" rows="2" name="gallery_slider_desc_2" placeholder=""></textarea>
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
                            <input type="checkbox" class="notificationswitch" name="action_button_active" checked>
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
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
                            <option value="google_map">Map</option>
                            <option value="address">Address</option>
                            <option value="customforms">Forms</option>
                            <?php foreach ($front_sections as $single) { ?>
                              <option value="<?= $single->slug ?>"><?= $single->name ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        
                        <div class="form-group action_fields phone_no_calls" style="display:none;">
                          <label for="">Phone number for calls</label>
                          <input type="text" class="myinput2" name="action_button_phone_no_calls" value="">
                        </div>
                        <div class="form-group action_fields phone_no_sms" style="display:none;">
                            <label for="">Phone number for sms</label>
                            <input type="text" class="myinput2" name="action_button_phone_no_sms" value="">
                        </div>
                        <div class="form-group action_fields action_email" style="display:none;">
                            <label for="">Email</label>
                            <input type="text" class="myinput2" name="action_button_action_email" value="">
                        </div>

                        <div class="form-group action_fields action_link" style="display:block;">
                            <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                        </div>

                        <div class="form-group action_fields action_forms" style="display:none;">
                            <select class="myinput2 customforms" name="action_button_customform">
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
                                <input type="text" class="myinput2 " name="action_button_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
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
                </div>
              </div>
                <div class="row make-sticky">
                  <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?= base_url('galleries?block=gallery_video_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                   
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('#customFile').on('change', function() {
      imagesPreview(this, '.gallery_slider');
    });
  
    var imagesPreview = function(input, placeToInsertImagePreview) {
      if (input.files) {
        var filesAmount = input.files.length;
        //$(placeToInsertImagePreview).empty();
        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();
          reader.onload = function(event) {
            $(placeToInsertImagePreview).append('<video width="inherit" style="width:inherit" controls><source  src="' + event.target.result + '"></source></video>');
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };

  //   function check_selction(value){
    
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

  $(".read_more_content").hide();
    $(document).on('click','.show_read_more_block',function(){
      $(".read_more_content").toggle();
    });
  </script>
@endsection('content')