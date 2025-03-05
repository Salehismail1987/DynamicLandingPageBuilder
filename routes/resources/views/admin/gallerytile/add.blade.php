@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD Gallery Tile</h1>
      <a href="{{ url('galleries?block=gallery_tiles_bluebar') }}" class="btn btn-info " >
          Back
      </a>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <!-- Form Basic -->
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">ADD Gallery Tile</h6>
            </div>
            <div class="card-body">
              <form role="form" method="post" enctype="multipart/form-data" action="<?= base_url('savegallerytile') ?>">
                @csrf
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
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Description Text Under Image</label>
                      <textarea rows="4" class="myinput2" name="description" style=" resize: none;"></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text Color</label>
                      <input type="color" class="myinput2" 
                      
                      <?php if($galleriesSettings->gallery_tiles_use_generic){ ?> disabled <?php } ?>
                      name="description_color" value="" placeholder="#000000">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Description Text size</label><br/>
                      <input type="number" class="myinput2 width-50px"
                      
                      <?php if($galleriesSettings->gallery_tiles_use_generic){ ?> disabled <?php } ?>
                      name="description_size" value="" placeholder="22">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="description_font">Description Text Font</label>
                      <select class="myinput2" name="description_font" id="description_font" 
                      <?php if($galleriesSettings->gallery_tiles_use_generic){ ?> disabled <?php } ?>>
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
                    <a href="<?= base_url('galleries?block=gallery_tiles_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                   
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection('content')