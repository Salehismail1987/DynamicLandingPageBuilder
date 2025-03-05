@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ADD Gallery Post</h1>
    <a href="{{ url('galleries?block=gallery_post_bluebar') }}" class="btn btn-info ">
      Back
    </a>
  </div>
  <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('savegallerypost')}}">
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label>Gallery Post Title</label>
                  <input type="text" class="myinput2" name="gallery_post_title" value="" placeholder="Header text">
                </div>
              </div>
              <div class="col-md-4"></div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Title Text Color</label>
                  <input type="color" class="myinput2" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?> name="gallery_post_title_color" value="" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Title Text Size on Web</label><br />
                  <input type="text" class="myinput2 width-50px" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?> name="gallery_post_title_font_size" value="" placeholder="16">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="title_font_size">Gallery Post Title Font</label>
                  <select class="myinput2" name="font_family" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?>>
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
                  <label>Gallery Post Title Background color</label>
                  <input type="color" class="myinput2" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?> name="gallery_post_title_bcakground" value="" placeholder="#000000">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Title Text Size on Mobile</label><br />
                  <input type="text" class="myinput2 width-50px" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?> name="gallery_post_title_font_size_mobile" value="" placeholder="16">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Title Left Right</label><br>
                  <label><input type="radio" name="gallery_post_title_left_right" value="0" checked> Left </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <label><input type="radio" name="gallery_post_title_left_right" value="1"> Right </label>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Description Text Color</label>
                  <input type="color" class="myinput2" name="description_text_color" 
                  <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                  value="" placeholder="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Gallery Post Description Text Size</label><br />
                  <input type="text" class="myinput2 width-50px" name="gallery_post_desc_font_size" value="" placeholder="16" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?>>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title_font_size">Gallery Post Description Font</label>
                  <select class="myinput2" name="gallery_post_desc_font_family" <?php if ($galleriesSettings->gallery_post_use_generic) { ?> disabled <?php } ?>>
                    >
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
              <div class="col-md-4">
                <div class="form-group">
                  <label>Description Read More Text Color</label>
                  <input type="color" class="myinput2" name="read_more_content_color" 
                  <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                  value="<?= $single->read_more_content_color ?>" placeholder="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Description Read More Text Size</label><br>
                  <input type="text" class="myinput2 width-50px" name="read_more_content_font_size"  
                  <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                  value="<?= $single->read_more_content_font_size ?>" placeholder="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title_font_size">Description Read More Font</label>
                  <select class="myinput2" name="read_more_content_font_font_family"
                  <?php if($galleriesSettings->gallery_post_use_generic){?> disabled <?php } ?>
                  >
                    <?php if (count($font_family) > 0) { ?>
                      <?php foreach ($font_family as $singleff) { ?>
                        <option style="font-family: <?= $singleff->value ?>;" value="<?= $singleff->id ?>" <?= (isset($single->read_more_content_font_font_family) && ($single->read_more_content_font_font_family == $singleff->id) ? 'selected' : ''); ?>><?= $singleff->name ?></option>
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
                    <label>Gallery Post Description</label>
                    <textarea class="myinput2 editordata hidden" name="gallery_post_desc"></textarea>
                    <div class="quilleditor">

                    </div>
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
            <div class="myhr mb-16"></div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group quilleditor-div">
                    <label>Fixed Description Text</label>
                    <textarea class="myinput2 editordata hidden" name="gallery_post_fixed_description"></textarea>
                    <div class="quilleditor"></div>
                  </div>
                </div>
              </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Post Images Size</label><br />
                  <input type="number" class="myinput2 width-65px" name="post_image_size" value="" placeholder="e.g 275">
                </div>
              </div>
              <div class="col-md-12">
                <div class=" mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                  </div>
                  <div class="">
                    <?php $total = 1; ?>
                    <div class="row img-upload-container" style="margin-bottom: 15px;">
                      <div class="col-md-12" id="img-<?= $total ?>">
                        <div class="uploadImageDiv">
                          <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                          <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                          <input class="dataimage" type="hidden" name="userfile[]">

                          <div class="col-md-4 imgdiv" style="display:none">
                            <br>
                            <img src='' width="100%" class="imagefromgallerysrc">
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <center>
                          <button type="button" class="btn btn-info" onclick="addAnotherImage()">+ Upload Another Image</button>
                        </center>
                      </div>
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
                        <input type="checkbox" class="notificationswitch" name="action_button_active">
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
                        <option value="link">Link to Outside Site</option>
                        <option value="call">Call</option>
                        <option value="sms">SMS Text</option>
                        <option value="email">Email</option>
                        <option value="address">Business Address</option>
                        <option value="customforms">Link to Form</option>
                        <option value="image_popup">Popup - Image</option>
                        <option value="text_popup">Popup - Text</option>
                        <option value="video">Popup - Video</option>
                        <option value="audioiconfeature">Audio Icon Feature</option>
                        <option value="google_map">Map</option>
                        <option value="stripe">Stripe</option>
                        <?php foreach ($front_sections as $single) { ?>
                          <option value="<?= $single->slug ?>"><?= $single->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group action_fields image_upload" name="feature_action_video2" style="display: none;">
                      <label for="customFile">Upload Images</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                          <label class="custom-file-label" for="customFile">Choose files</label>
                      </div>
                      </div>  
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
                      <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                    </div>

                    <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature"  style="display:none">
                        <label for="customFile">Select File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                        </div>
                        
                    </div>
                    <div class="form-group action_fields action_forms" style="display:none;">
                      <select class="myinput2 customforms" name="action_button_customform">
                        <?php if (count($custom_forms) > 0) { ?>
                          <?php foreach ($custom_forms as $single) { ?>
                            <option value="<?= $single->id ?>"><?= $single->title ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group action_fields action_event_forms" style="display:none;">
                      <select class="myinput2 customforms" name="event_form_id">
                        <?php if (count($event_forms) > 0) { ?>
                          <?php foreach ($event_forms as $single) { ?>
                            <option value="<?= $single->id ?>"><?= $single->title ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group action_fields video_upload" name="action_button_video"  style="display:none">
                        <label for="customFile">Upload Video</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                accept=".mp4">
                            <label class="custom-file-label" for="customFile">Upload Video</label>
                        </div>
                    </div>

                    <div class=" action_fields action_map" style="display:none">
                        <div class="form-group " >
                            <label for="address">Enter Address</label>
                            <input type="text" class="myinput2 " name="action_button_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
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
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <div class="row make-sticky">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= base_url('galleries?block=gallery_post_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
      </div>
    </div>
  </form>
</div>
<script>
  var total = 2;

  function addAnotherImage() {
    var newupload = ' <div class="col-md-12" style="margin-top:10px;border-top:2px solid lightgrey;padding-top:10px" id="img-' + total + '" ><button type="button" class="btn btn-info" style="float:right" onclick="removeImageDiv(' + total + ')">Remove</button> <div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"> <input class="dataimage" type="hidden" name="userfile[]"> <div class="col-md-6 imgdiv" style="display:none"> <br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove" >X</button></div></div> </div>';
    $(".img-upload-container").append(newupload);
    total++;
  }

  function removeImageDiv(id) {

    if (id != "") {
      $("#img-" + id).remove();
      total--;
    }
  }
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
          $(placeToInsertImagePreview).append('<img width="100%" src="' + event.target.result + '"><br><br>');
        }
        reader.readAsDataURL(input.files[i]);
      }
    }
  };

  $(document).ready(function() {

    $(document).on("click", ".remove_desc", function() {
      $(this).closest('.desc_content').remove();
    });

    // if ($('.news_post_action_button').val() == 'link') {
    //   $('.news_post_link').show();
    //   $("#address-list-1").hide();
    //   $('.customforms').hide();
    // } else if ($('.news_post_action_button').val() == 'customforms') {
    //   $('.customforms').show();
    //   $('.news_post_link').hide();
    //   $("#address-list-1").hide();
    // } else if ($('.news_post_action_button').val() == 'google_map' || $('.news_post_action_button').val() == 'address') {
    //   $("#address-list-1").show();
    //   $('.news_post_link').hide();
    //   $('.customforms').hide();
    // } else {
    //   $('.news_post_link').hide();
    //   $("#address-list-1").hide();
    //   $('.customforms').hide();
    // }

    // $(document).on('change', '.news_post_action_button', function() {
    //   if ($(this).val() == 'link') {
    //     $('.news_post_link').show();
    //     $("#address-list-1").hide();
    //     $('.customforms').hide();
    //   } else if ($(this).val() == 'customforms') {
    //     $('.customforms').show();
    //     $('.news_post_link').hide();
    //     $("#address-list-1").hide();
    //   } else if ($(this).val() == 'google_map' || $(this).val() == 'address') {
    //     $("#address-list-1").show();
    //     $('.news_post_link').hide();
    //     $('.customforms').hide();
    //   } else {
    //     $('.news_post_link').hide();
    //     $("#address-list-1").hide();
    //     $('.customforms').hide();
    //   }
    // });
  });
  $(".read_more_content").hide();
    $(document).on('click','.show_read_more_block',function(){
      $(".read_more_content").toggle();
    });
</script>
@endsection('content')