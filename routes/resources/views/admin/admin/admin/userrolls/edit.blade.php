@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('businessinfo?block=permissions')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          {{ session()->get('error') }}
        </div>
      @endif
      @if(session()->has('success'))
        <div class="alert alert-primary alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          {{ session()->get('success') }}
        </div>
      @endif
    <div class="row">
        <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">EDIT <?=$controller_name?></h6>
                </div>
                <div class="card-body">
                <form role="form" method="post" enctype="multipart/form-data" action="{{ url('updaterole/'.$role->id) }}">
                      @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="myinput2" id="name" value="{{$role->name}}" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="ranking">Ranking</label>
                        <input type="number" name="ranking" class="myinput2" id="name" value="{{$role->ranking}}">
                      </div>
                      <button type="submit" class="btn btn-primary">Save</button>
                      <a href="{{ url('businessinfo?block=permissions') }}"><button type="button" class="btn btn-default">Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>

@endsection('content')