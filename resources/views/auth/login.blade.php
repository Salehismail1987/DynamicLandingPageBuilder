
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link rel="apple-touch-icon" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-startup-image" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    
    
  <link href="{{ url('assets/admin2') }}/img/eh_logo.png" rel="icon">

  <title>Login</title>
  <link href="{{ url('assets/admin2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{ url('assets/admin2') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{ url('assets/admin2') }}/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address"  required  autofocus>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password" required>
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div>
                    @if(session()->has('error'))
                        <div class="alert alert-danger col-md-12 text-center">{{ session()->get('error') }}</div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success col-md-12 text-center">{{ session()->get('error') }}</div>
                    @endif
                    <div class="form-group">
                      <button class="btn btn-primary btn-block">Login</button>
                    </div>
                  </form>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="{{ url('assets/admin2') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url('assets/admin2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('assets/admin2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{ url('assets/admin2') }}/js/ruang-admin.min.js"></script>
</body>

</html>