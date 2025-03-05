@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD Gallery Slider</h1>
      <a href="{{ url('galleries?block=gallery_slider_bluebar') }}" class="btn btn-info " >
          Back
      </a>
      </div>
      <div class="col-lg-8">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">ADD Gallery Slider</h6>
          </div>
          <div class="card-body">
            <form role="form" method="post" enctype="multipart/form-data" action="{{url('savegalleryslider')}}">
              @csrf
              <div class="row">
                <div class="col-md-12">
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
                <div class="col-md-6 gallery_slider">
  
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea rows="4" class="myinput2" name="gallery_slider_text"></textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Color</label>
                    <input type="color" class="myinput2"
                    <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                     name="gallery_slider_text_color" value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Background Color</label>
                    <input type="color" class="myinput2"
                    <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                     name="gallery_slider_text_background_color" value="" placeholder="">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Font size Web</label><br/>
                    <input type="text" class="myinput2 width-50px" 
                    <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                    name="gallery_slider_text_fontsize" value="" placeholder="18">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description Font size Mobile</label><br/>
                    <input type="text" class="myinput2 width-50px" 
                    <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                    name="gallery_slider_text_fontsize_mobile" value="" placeholder="18">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title_font_size">Description Font family</label>
                    <select class="myinput2" name="font_family" 
                    <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
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
              <div class="row make-sticky">
                <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save</button>
                  <a href="<?= base_url('galleries?block=gallery_slider_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
            
                </div>
              </div>
            </form>
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
            $(placeToInsertImagePreview).append('<img width="100%" src="' + event.target.result + '">');
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };
  </script>
@endsection('content')