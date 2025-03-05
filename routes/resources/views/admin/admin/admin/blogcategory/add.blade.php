@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD {{ $controller_name }}</h1>
      <a href="{{ url('blog?block=blog_category') }}" class="btn btn-info " >
          Back
      </a>
      </div>

      <form  class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('saveblogcategory')}}">
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
                    <input type="text" name="title" class="myinput2" id="title" value="" placeholder="Title">
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row  make-sticky">
            <div class="col-lg-12">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('blog?block=blog_category')?>"><button type="button" class="btn btn-default">Cancel</button></a>
            </div>
        </div>
      </form>
  </div>
@endsection('content')