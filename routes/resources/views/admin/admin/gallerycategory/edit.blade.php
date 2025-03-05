@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT Image Category</h1>
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
                  <h6 class="m-0 font-weight-bold text-primary">EDIT Image Category</h6>
              </div>
              <div class="card-body">
                  <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('updategallerycategory')?>">
                  @csrf
                  
            <input type="hidden" name="record_id" value="<?=$detail_info->id?>">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Name of New Image Category</label>
                        <input type="text" class="myinput2" name="name" value="<?php echo $detail_info->name;?>" placeholder="Category name">
                      </div>
                    </div>
                  </div>
                  <div class="row make-sticky">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?=base_url('galleries?block=image_gallery_categories')?>"><button type="button" class="btn btn-default">Cancel</button></a>
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