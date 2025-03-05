@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('businessinfo?block=user_types')?>" class="btn btn-info " >
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
                    <form role="form" method="post" enctype="multipart/form-data" action="{{ url('updateuser/'.$admin_info->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="myinput2" id="name" value="{{ $admin_info->name }}" placeholder="Name">
                        @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="myinput2" id="exampleInputEmail1" value="{{$admin_info->email }}" aria-describedby="emailHelp" placeholder="Enter email"  readonly
                          onfocus="this.removeAttribute('readonly');">
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="text" name="password" value="{{ base64_decode_password($admin_info->kptoken) }}" class="myinput2" id="exampleInputPassword1"  placeholder="Password"  readonly
                          onfocus="this.removeAttribute('readonly');" required>
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="roletype">Role Type</label>
                        <select class="myinput2" name="roletype">
                            <?php if($userRolls && count($userRolls)>0){ ?>
                            <?php foreach($userRolls as $single){ ?>
                                  <?php if(Auth::user()->admin_type == '1' ||$single->ranking > getUserRollRank()){ ?>
                                    <option value="<?=$single->id?>" <?php echo $admin_info->user_role==$single->id?'selected':'';?>><?=$single->name?></option>
                                <?php } ?>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="userfile" id="customFile">
                        <label class="custom-file-label" for="customFile">Select Profile</label>
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('businessinfo?block=user_types')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>

@endsection('content')