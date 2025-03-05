@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT Gallery Slider</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('galleries?block=gallery_slider_bluebar')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
      
    <div class="row">
      <div class="col-lg-8">
          <!-- Form Basic -->
          <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">EDIT Gallery Slider</h6>
              </div>
              <div class="card-body">
                  <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updategalleryslider') ?>">
                    @csrf
                      <div class="row">
                          <div class="col-md-12">
                              <div class="uploadImageDiv">
                                  <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                  <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                  <input type="hidden" name="record_id" value="{{$detail_info->id}}">
                                  <input class="dataimage" type="hidden" name="userfile">

                                  <div class="col-md-6 imgdiv" style="display:none">
                                      <br>
                                      <img src='' width="100%" class="imagefromgallerysrc">
                                      <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                  </div>
                              </div>
                          </div>
                          <?php
                          if ($detail_info->image) {
                          ?>
                              <div class="col-md-6 gallery_slider_div">
                                  <img src='<?= base_url('assets/uploads/'.get_current_url() . $detail_info->image) ?>' width="100%">
                                  <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->image ?>','image','gallery_slider_div','gallery_sliders',<?= $detail_info->id ?>)">X</button>
                              </div>
                          <?php
                          }
                          ?>

                      </div>
                      <br>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Description</label>
                                  <textarea rows="4" class="myinput2" name="gallery_slider_text"><?php echo $detail_info->text; ?></textarea>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Description Color</label>
                                  <input type="color" class="myinput2" 
                                  <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                                  name="gallery_slider_text_color" value="<?php echo $detail_info->text_color; ?>" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Description Background Color</label>
                                  <input type="color" class="myinput2" 
                                  <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                                  name="gallery_slider_text_background_color" value="<?php echo $detail_info->back_color; ?>" placeholder="">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Description Font size Web</label><br/>
                                  <input type="text" class="myinput2 width-50px" 
                                  <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                                  name="gallery_slider_text_fontsize" value="<?php echo $detail_info->text_fontsize; ?>" placeholder="18">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Description Font size Mobile</label><br/>
                                  <input type="text" class="myinput2 width-50px"
                                  <?php if($galleriesSettings->gallery_slider_use_generic){ ?> disabled <?php } ?>
                                  name="gallery_slider_text_fontsize_mobile" value="<?php echo $detail_info->text_fontsize_mobile; ?>" placeholder="18">
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
                                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                          <?php } ?>
                                      <?php } ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row make-sticky">
                          <div class="col-md-12">   <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?= base_url('galleries?block=gallery_slider_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                           
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
@endsection('content')