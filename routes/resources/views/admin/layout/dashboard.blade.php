<!DOCTYPE html>
<html lang="en">

<head>
    <title>enfohub</title>
    <link href="{{ url('assets/admin2') }}/img/eh_logo.png" rel="icon">
    <!-- <link rel="icon" type="image/x-icon" href="{{url('assets/admin2/img/favicon.png')}}"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">  
  
      @if(check_for_nofollow_meta())
          <meta name="robots" content="noindex, follow " />
      @else   
          <meta name="robots" content="" />
      @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <link rel="apple-touch-icon" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
    <link rel="apple-touch-startup-image" href="{{ url('assets/uploads/'.get_current_url().'apple-touch-icon.png')}}">
  
    <link rel="stylesheet" href="{{ url('assets/admin2/css/dashboard-style.css')}}">
    <link rel="stylesheet" href="{{ url('assets/admin2/css/margins.css')}}">
    <link href="{{ url('assets/admin2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/admin2') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('assets/admin2/fonts/Inter/inter.css')}}">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ url('assets/admin2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/compressorjs/dist/compressor.min.js"></script>

    <link href=" {{ url('assets') }}/multiselect/jquery.multiselect.css" rel="stylesheet">
    <script src="{{ url('assets') }}/multiselect/jquery.multiselect.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="{{ url('assets') }}/timepicker/timepicker-bs4.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ url('assets/admin2/js/image-resize.min.js') }}"></script>
    <script src="{{ url('assets/admin2/js/video-resize.min.js') }}"></script>
    
    <link href='<?= url('assets/fonts/fonts.css'); ?>' rel='stylesheet'>


    <link href="<?= url('assets/'); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/toastmessage/style.css')}}" />
    <script src="{{ url('assets/toastmessage/cute-alert.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ url('assets/admin2/imgcroper_new') }}/rcrop.min.js"></script>
    <link href="{{ url('assets/admin2/imgcroper_new') }}/rcrop.min.css" media="screen" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="{{url('assets/admin2/js/function.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

    <script src="<?= url('assets/admin2/jquery.ui.touch-punch.min.js');?>"></script>

    <script>
        var base_url = '{{url('')}}';
        var countUnreadResponses = '0';
    </script>
</head>
<style>
.modal-action-buttons{
    padding: 9px 30px !important;
    width: 233px;
    height: 45px;
    border-radius: 5px;
}

.modal-action-buttons-secondary{
    padding: 9px 30px !important;
    width: 305px;
    height: 43px;
    border-radius: 5px !important;
}

#businesscoachmodal{
    margin-left: 9%;
}

.actions_modal{
    margin-left: 8%;
    margin-top: 3%;
}

.otp-input {
    width: 40px;
    height: 40px;
    text-align: center;
    font-size: 18px;
    margin-right: 10px;
}
.otp-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

</style>
<body class="">
    <header class="header cp1 header-fixed pb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-12 d-flex align-items-center">
                    <div class="vertical-middle pb-17">
                        <img src="{{url('assets')}}/admin2/img/iconbar.png" width="29px" id="sidebarCollapse">
                        <img src="{{url('assets')}}/admin2/img/logo.png" width="109px" class="ml-20">
                   
                    </div>
                    <div class="display-table header_name_container ml-4">
                        <div class="vertical-middle pb-17">
                            @if(getHeaderDisplayName())
                                <span class="header_display_name">
                                    {{getHeaderDisplayName()}}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-10 col-9 display-table">
                    {{-- <div class="vertical-middle pb-17">
                        <div class="position-relative">
                            <input type="text" class="form-control myinput" placeholder="Search in the admin panel">
                            <img src="{{url('assets')}}/admin2/img/search.png" width="18px" class="icon-top-left">
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-3 col-md-5 col-sm-2 col-9 display-table" align="">
                        <div class="dropdown">
                            <div class="dropdown-toggle no-after" data-toggle="dropdown">
                                <div class="d-flex align-items-center justify-content-end form-response-main-div pb-17">
                                    <div class="title-7-new text-center text-white count-response-read-div countUnreadResponses">4</div>
                                    <div class="title-7-new text-color-red ml-8 labelUnreadResponses">Form Responses</div>
                                    <div class="ml-5px">
                                        <img src="{{url('assets')}}/admin2/img/arrow-down-red.png" alt="" class="imgUnreadResponses">
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu width-max-content response-popup" aria-labelledby="dropdownMenuButton">
                                <div  class="head-res-table-div">
                                    <table class="head-res-table">
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-1 col-sm-7 col-3 display-table" align="right">
                    <div class="vertical-middle pb-17">
                        <div class="dropdown width-145px">
                            <div class="profile-icon dropdown-toggle no-after" data-toggle="dropdown">
                                <div class="profile-img-div">
                                    <?php 
                                        $full_name = Auth::user()->name;
                                        if(strpos($full_name,' ')){
                                            $full_name = explode(' ',$full_name);
                                            $full_name = substr( $full_name[0], 0, 1 ).substr( $full_name[1], 0, 1 );
                                        }
                                    ?>
                                    <?=strtoupper( substr( $full_name, 0, 2 ) )?>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{ url('signout') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="content-body">
        <div class="wrapper">
            <nav id="sidebar">
                <diV class="sidebardiv">
                @if (false)
                    <div class="sidebar-header">
                        <div class="title-1 text-color-blue">Admin</div>
                    </div>
                @endif
                    <ul class="list-unstyled components">
                        <li class="@if($controller == 'dashboard'){{'active'}}@endif">
                            <a href="{{ url('dashboard') }}">Welcome page</a>
                        </li>
                        <li class="@if($controller == 'quicksettings' || $controller == 'newsfeed' || $controller == 'frontend' || $controller == 'onestepbutton' || $controller == 'galleries' || $controller == 'scheduling' || $controller == 'blog'){{'active'}}@endif">
                            <a href="#websiteSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Edit Website</a>
                            <ul class="collapse list-unstyled submenu  @if($controller == 'quicksettings' || $controller == 'newsfeed' || $controller == 'frontend' || $controller == 'onestepbutton' || $controller == 'galleries' || $controller == 'scheduling' || $controller == 'blog'){{'show'}}@endif" id="websiteSubmenu">
                            @if (check_auth_permission([
                                'alert_banner', 'alert_banner_text',
                                'header_block','header_slider','header_logo','header_image_title','header_image','header_image_description','header_slider_upload_image','header_block_timed_images',
                                'address_at_header','header_text','header_phone_text','header_address_street','header_address_location','header_address_comment','header_address_title',
                                'audio_files','auto_play','audio_repeat','select_audio',
                                'popup_alert', 'popup_active', 'popup_alert_title', 'popup_alert_message', 'popup_image', 'popup_timed_image',
                                'news_posts', 'add_news_post', 'news_post_actions',
                                'news_feed',
                                'header_action_buttons'
                                ]))
                                <li class="@if($controller == 'quicksettings' || $controller == 'newsfeed'){{'active'}}@endif">
                                    <a href="{{ url('quicksettings') }}">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.078 1.82512e-06C11.372 1.82512e-06 11.635 0.183 11.734 0.456996L12.4399 2.41397C12.6929 2.47697 12.9099 2.53997 13.0939 2.60597C13.2949 2.67797 13.5539 2.78697 13.8739 2.93597L15.5178 2.06598C15.652 1.99488 15.8056 1.96922 15.9556 1.99284C16.1056 2.01646 16.244 2.08809 16.3498 2.19698L17.7958 3.69196C17.9877 3.89095 18.0417 4.18195 17.9337 4.43595L17.1628 6.24293C17.2908 6.47792 17.3928 6.67892 17.4708 6.84692C17.5548 7.02992 17.6588 7.28191 17.7828 7.60691L19.5797 8.3769C19.8497 8.4919 20.0167 8.7619 19.9987 9.05089L19.8667 11.1259C19.8577 11.2607 19.8093 11.3899 19.7275 11.4974C19.6457 11.605 19.5342 11.6861 19.4067 11.7309L17.7048 12.3359C17.6558 12.5709 17.6048 12.7718 17.5508 12.9418C17.4637 13.2044 17.3642 13.4627 17.2528 13.7158L18.1077 15.6058C18.1681 15.7386 18.1843 15.8872 18.1541 16.0299C18.1239 16.1726 18.0488 16.3019 17.9397 16.3988L16.3138 17.8508C16.2067 17.946 16.0731 18.0062 15.9308 18.0234C15.7886 18.0405 15.6445 18.0138 15.5178 17.9468L13.8419 17.0588C13.5797 17.1976 13.3092 17.3202 13.0319 17.4258L12.2999 17.6998L11.65 19.4998C11.6018 19.6316 11.5149 19.7458 11.4007 19.8273C11.2865 19.9089 11.1503 19.954 11.01 19.9568L9.11005 19.9998C8.96602 20.0035 8.82436 19.9626 8.70456 19.8825C8.58475 19.8025 8.49271 19.6873 8.44108 19.5528L7.6751 17.5258C7.41376 17.4365 7.155 17.3398 6.89913 17.2358C6.68985 17.1452 6.48374 17.0475 6.28115 16.9428L4.38122 17.7548C4.25603 17.8082 4.11801 17.8241 3.98397 17.8004C3.84993 17.7768 3.72564 17.7148 3.62624 17.6218L2.22029 16.3028C2.11562 16.205 2.04433 16.0768 2.01651 15.9363C1.9887 15.7958 2.00576 15.6501 2.0653 15.5198L2.88227 13.7398C2.77362 13.529 2.67288 13.3142 2.58028 13.0958C2.47218 12.8286 2.37214 12.5581 2.28029 12.2849L0.49035 11.7399C0.344856 11.6959 0.217954 11.6051 0.129353 11.4816C0.0407512 11.3581 -0.00459114 11.2088 0.000367456 11.0569L0.070365 9.13589C0.0753474 9.01056 0.1145 8.88897 0.183589 8.78427C0.252678 8.67958 0.349074 8.59577 0.462351 8.5419L2.34029 7.63991C2.42728 7.32091 2.50328 7.07292 2.57028 6.89192C2.66462 6.65017 2.76938 6.41261 2.88427 6.17993L2.0703 4.45995C2.00852 4.32933 1.98977 4.18249 2.01672 4.04054C2.04367 3.89859 2.11494 3.76884 2.22029 3.66996L3.62424 2.34397C3.72266 2.25115 3.8458 2.18874 3.97886 2.16426C4.11191 2.13977 4.2492 2.15426 4.37422 2.20598L6.27215 2.98997C6.48214 2.84997 6.67214 2.73697 6.84413 2.64597C7.04912 2.53697 7.32311 2.42297 7.6681 2.29997L8.32808 0.458996C8.37687 0.324266 8.46606 0.207881 8.58346 0.125731C8.70087 0.0435821 8.84077 -0.000326247 8.98406 1.82512e-06H11.078ZM10.024 7.01892C8.35708 7.01892 7.00612 8.3539 7.00612 10.0019C7.00612 11.6499 8.35708 12.9858 10.024 12.9858C11.69 12.9858 13.0409 11.6499 13.0409 10.0019C13.0409 8.3539 11.691 7.01892 10.024 7.01892Z" fill="#ADADAD"/>
                                        </svg>
                                        <span>Quick Editing</span></a>
                                </li>
                                @endif
                                @if (check_auth_permission(['step_buttons' ]))
                                <li class="@if($controller == 'onestepbutton'){{'active'}}@endif">
                                    <a href="{{url('onestepbutton')}}">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.5 14.25C10.8142 14.25 11.9345 13.7867 12.8611 12.8601C13.787 11.9342 14.25 10.8142 14.25 9.5C14.25 8.18583 13.787 7.06547 12.8611 6.1389C11.9345 5.21297 10.8142 4.75 9.5 4.75C8.18583 4.75 7.06578 5.21297 6.13985 6.1389C5.21328 7.06547 4.75 8.18583 4.75 9.5C4.75 10.8142 5.21328 11.9342 6.13985 12.8601C7.06578 13.7867 8.18583 14.25 9.5 14.25ZM9.5 19C8.18583 19 6.95083 18.7505 5.795 18.2514C4.63917 17.753 3.63375 17.0763 2.77875 16.2213C1.92375 15.3663 1.24703 14.3608 0.7486 13.205C0.249533 12.0492 0 10.8142 0 9.5C0 8.18583 0.249533 6.95083 0.7486 5.795C1.24703 4.63917 1.92375 3.63375 2.77875 2.77875C3.63375 1.92375 4.63917 1.24672 5.795 0.74765C6.95083 0.249217 8.18583 0 9.5 0C10.8142 0 12.0492 0.249217 13.205 0.74765C14.3608 1.24672 15.3663 1.92375 16.2213 2.77875C17.0763 3.63375 17.753 4.63917 18.2514 5.795C18.7505 6.95083 19 8.18583 19 9.5C19 10.8142 18.7505 12.0492 18.2514 13.205C17.753 14.3608 17.0763 15.3663 16.2213 16.2213C15.3663 17.0763 14.3608 17.753 13.205 18.2514C12.0492 18.7505 10.8142 19 9.5 19ZM9.5 17.1C11.6217 17.1 13.4187 16.3637 14.8912 14.8912C16.3637 13.4187 17.1 11.6217 17.1 9.5C17.1 7.37833 16.3637 5.58125 14.8912 4.10875C13.4187 2.63625 11.6217 1.9 9.5 1.9C7.37833 1.9 5.58125 2.63625 4.10875 4.10875C2.63625 5.58125 1.9 7.37833 1.9 9.5C1.9 11.6217 2.63625 13.4187 4.10875 14.8912C5.58125 16.3637 7.37833 17.1 9.5 17.1Z" fill="#ADADAD"/>
                                        </svg>

                                        <span>1-Step Buttons </span>
                                    </a>
                                </li>
                                @endif
                                @if (check_auth_permission([
                                    'set_hours', 'set_hours_time_settings', 'set_hours_image', 'set_hours_timed_image', 
                                    'rotating_schedule', 'rotating_hours_time_settings'
                                    ]))
                                <li class="@if($controller == 'scheduling'){{'active'}}@endif">
                                    <a href="{{url('scheduling')}}">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 10.8C9.178 10.8 9.35201 10.7472 9.50001 10.6483C9.64802 10.5494 9.76337 10.4089 9.83149 10.2444C9.89961 10.08 9.91743 9.899 9.88271 9.72442C9.84798 9.54984 9.76226 9.38947 9.6364 9.2636C9.51053 9.13774 9.35016 9.05202 9.17558 9.01729C9.001 8.98257 8.82004 9.00039 8.65558 9.06851C8.49113 9.13663 8.35057 9.25198 8.25168 9.39999C8.15278 9.54799 8.1 9.722 8.1 9.9C8.1 10.1387 8.19482 10.3676 8.3636 10.5364C8.53239 10.7052 8.7613 10.8 9 10.8ZM13.5 10.8C13.678 10.8 13.852 10.7472 14 10.6483C14.148 10.5494 14.2634 10.4089 14.3315 10.2444C14.3996 10.08 14.4174 9.899 14.3827 9.72442C14.348 9.54984 14.2623 9.38947 14.1364 9.2636C14.0105 9.13774 13.8502 9.05202 13.6756 9.01729C13.501 8.98257 13.32 9.00039 13.1556 9.06851C12.9911 9.13663 12.8506 9.25198 12.7517 9.39999C12.6528 9.54799 12.6 9.722 12.6 9.9C12.6 10.1387 12.6948 10.3676 12.8636 10.5364C13.0324 10.7052 13.2613 10.8 13.5 10.8ZM9 14.4C9.178 14.4 9.35201 14.3472 9.50001 14.2483C9.64802 14.1494 9.76337 14.0089 9.83149 13.8444C9.89961 13.68 9.91743 13.499 9.88271 13.3244C9.84798 13.1498 9.76226 12.9895 9.6364 12.8636C9.51053 12.7377 9.35016 12.652 9.17558 12.6173C9.001 12.5826 8.82004 12.6004 8.65558 12.6685C8.49113 12.7366 8.35057 12.852 8.25168 13C8.15278 13.148 8.1 13.322 8.1 13.5C8.1 13.7387 8.19482 13.9676 8.3636 14.1364C8.53239 14.3052 8.7613 14.4 9 14.4ZM13.5 14.4C13.678 14.4 13.852 14.3472 14 14.2483C14.148 14.1494 14.2634 14.0089 14.3315 13.8444C14.3996 13.68 14.4174 13.499 14.3827 13.3244C14.348 13.1498 14.2623 12.9895 14.1364 12.8636C14.0105 12.7377 13.8502 12.652 13.6756 12.6173C13.501 12.5826 13.32 12.6004 13.1556 12.6685C12.9911 12.7366 12.8506 12.852 12.7517 13C12.6528 13.148 12.6 13.322 12.6 13.5C12.6 13.7387 12.6948 13.9676 12.8636 14.1364C13.0324 14.3052 13.2613 14.4 13.5 14.4ZM4.5 10.8C4.678 10.8 4.85201 10.7472 5.00001 10.6483C5.14802 10.5494 5.26337 10.4089 5.33149 10.2444C5.39961 10.08 5.41743 9.899 5.38271 9.72442C5.34798 9.54984 5.26226 9.38947 5.1364 9.2636C5.01053 9.13774 4.85016 9.05202 4.67558 9.01729C4.501 8.98257 4.32004 9.00039 4.15558 9.06851C3.99113 9.13663 3.85057 9.25198 3.75168 9.39999C3.65278 9.54799 3.6 9.722 3.6 9.9C3.6 10.1387 3.69482 10.3676 3.8636 10.5364C4.03239 10.7052 4.2613 10.8 4.5 10.8ZM15.3 1.8H14.4V0.9C14.4 0.661305 14.3052 0.432387 14.1364 0.263604C13.9676 0.0948211 13.7387 0 13.5 0C13.2613 0 13.0324 0.0948211 12.8636 0.263604C12.6948 0.432387 12.6 0.661305 12.6 0.9V1.8H5.4V0.9C5.4 0.661305 5.30518 0.432387 5.1364 0.263604C4.96761 0.0948211 4.73869 0 4.5 0C4.2613 0 4.03239 0.0948211 3.8636 0.263604C3.69482 0.432387 3.6 0.661305 3.6 0.9V1.8H2.7C1.98392 1.8 1.29716 2.08446 0.790812 2.59081C0.284464 3.09716 0 3.78392 0 4.5V15.3C0 16.0161 0.284464 16.7028 0.790812 17.2092C1.29716 17.7155 1.98392 18 2.7 18H15.3C16.0161 18 16.7028 17.7155 17.2092 17.2092C17.7155 16.7028 18 16.0161 18 15.3V4.5C18 3.78392 17.7155 3.09716 17.2092 2.59081C16.7028 2.08446 16.0161 1.8 15.3 1.8ZM16.2 15.3C16.2 15.5387 16.1052 15.7676 15.9364 15.9364C15.7676 16.1052 15.5387 16.2 15.3 16.2H2.7C2.46131 16.2 2.23239 16.1052 2.0636 15.9364C1.89482 15.7676 1.8 15.5387 1.8 15.3V7.2H16.2V15.3ZM16.2 5.4H1.8V4.5C1.8 4.2613 1.89482 4.03239 2.0636 3.8636C2.23239 3.69482 2.46131 3.6 2.7 3.6H15.3C15.5387 3.6 15.7676 3.69482 15.9364 3.8636C16.1052 4.03239 16.2 4.2613 16.2 4.5V5.4ZM4.5 14.4C4.678 14.4 4.85201 14.3472 5.00001 14.2483C5.14802 14.1494 5.26337 14.0089 5.33149 13.8444C5.39961 13.68 5.41743 13.499 5.38271 13.3244C5.34798 13.1498 5.26226 12.9895 5.1364 12.8636C5.01053 12.7377 4.85016 12.652 4.67558 12.6173C4.501 12.5826 4.32004 12.6004 4.15558 12.6685C3.99113 12.7366 3.85057 12.852 3.75168 13C3.65278 13.148 3.6 13.322 3.6 13.5C3.6 13.7387 3.69482 13.9676 3.8636 14.1364C4.03239 14.3052 4.2613 14.4 4.5 14.4Z" fill="#ADADAD"/>
                                        </svg>
                                        <span>Business Hours</span>
                                    </a>
                                </li>
                                @endif
                                @if (check_auth_permission([
                                'gallery_post', 'gallery_post_add_new', 'gallery_post_edit_delete',
                                'gallery_slider', 'gallery_slider_add_new', 'gallery_slider_edit_delete',
                                'gallery_video', 'gallery_video_add_new', 'gallery_video_eidt_delete',
                                'gallery_tiles', 'gallery_tile_add_new', 'gallery_tile_edit_delete',
                                'stored_image_gallery', 'image_gallery_category'
                                ]))
                                <li class="@if($controller == 'galleries'){{'active'}}@endif">
                                    <a href="{{url('galleries')}}">
                                        <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.7078 1.76887C16.7078 1.61261 16.6491 1.46275 16.5446 1.35226C16.4402 1.24176 16.2985 1.17969 16.1508 1.17969H3.89871C3.75101 1.17969 3.60936 1.24176 3.50491 1.35226C3.40047 1.46275 3.3418 1.61261 3.3418 1.76887V2.35805H16.7078V1.76887Z" fill="#ADADAD"/>
                                            <path d="M17.8212 4.12434C17.8212 3.96808 17.7625 3.81822 17.658 3.70772C17.5536 3.59723 17.4119 3.53516 17.2642 3.53516H2.78445C2.63675 3.53516 2.4951 3.59723 2.39066 3.70772C2.28621 3.81822 2.22754 3.96808 2.22754 4.12434V4.71352H17.8212V4.12434Z" fill="#ADADAD"/>
                                            <path d="M17.8876 5.89062H2.16028C1.8826 5.89063 1.61629 6.00732 1.41994 6.21505C1.22359 6.42278 1.11328 6.70452 1.11328 6.99829V17.745C1.11328 18.0388 1.22359 18.3205 1.41994 18.5282C1.61629 18.7359 1.8826 18.8526 2.16028 18.8526H17.8876C18.1652 18.8526 18.4316 18.7359 18.6279 18.5282C18.8243 18.3205 18.9346 18.0388 18.9346 17.745V6.99829C18.9346 6.70452 18.8243 6.42278 18.6279 6.21505C18.4316 6.00732 18.1652 5.89062 17.8876 5.89062ZM4.76664 7.9233C5.09709 7.9233 5.42011 8.02697 5.69486 8.22119C5.96961 8.41541 6.18376 8.69146 6.31021 9.01444C6.43667 9.33742 6.46975 9.69281 6.40529 10.0357C6.34082 10.3786 6.1817 10.6935 5.94804 10.9407C5.71438 11.1879 5.41668 11.3562 5.09259 11.4244C4.7685 11.4926 4.43257 11.4576 4.12728 11.3239C3.82199 11.1901 3.56105 10.9635 3.37747 10.6728C3.19389 10.3822 3.0959 10.0404 3.0959 9.69085C3.0959 9.22207 3.27192 8.77249 3.58525 8.44101C3.89857 8.10953 4.32353 7.9233 4.76664 7.9233ZM16.7069 16.4959H3.34094L7.49553 12.0947C7.56959 12.017 7.66967 11.9734 7.77399 11.9734C7.8783 11.9734 7.97838 12.017 8.05244 12.0947L10.1019 14.2629L12.9254 11.1933C12.9995 11.1156 13.0996 11.0719 13.2039 11.0719C13.3082 11.0719 13.4083 11.1156 13.4824 11.1933L16.7069 14.6046V16.4959Z" fill="#ADADAD"/>
                                        </svg>
                                        <span>Galleries</span>
                                    </a>
                                </li>
                                @endif
                                @if (check_auth_permission([
                                'review_staff','reviews_staff_text','review_staff_add_new','review_staff_delete',
                                'faqs','question_input','answer_input','faq_add_new',
                                'hyperlinks','hyperlink_image','hyperlink_text','hyperlink_link_option','hyperlink_add_new','hyperlink_timed_image',
                                'download_files', 'downloads_file_question','download_text','downloads_add_new',
                                'content_block', 'content_block_image', 'content_block_subtitle_text_input', 'content_block_add_new','content_block_description','content_block_timed_image',
                                'title_banners','title_banner_text_input',
                                'formssection', 
                                'build_site_Content'
                                ]))
                                <li class="@if($controller == 'frontend'){{'active'}}@endif">
                                    <a href="{{url('editfrontend')}}">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.15625 17.8125C4.94361 17.8125 5.69872 17.4997 6.25547 16.943C6.81222 16.3862 7.125 15.6311 7.125 14.8438C7.125 14.0564 6.81222 13.3013 6.25547 12.7445C5.69872 12.1878 4.94361 11.875 4.15625 11.875C3.36889 11.875 2.61378 12.1878 2.05703 12.7445C1.50028 13.3013 1.1875 14.0564 1.1875 14.8438C1.1875 15.6311 1.50028 16.3862 2.05703 16.943C2.61378 17.4997 3.36889 17.8125 4.15625 17.8125ZM14.8438 7.125C15.6311 7.125 16.3862 6.81222 16.943 6.25547C17.4997 5.69872 17.8125 4.94361 17.8125 4.15625C17.8125 3.36889 17.4997 2.61378 16.943 2.05703C16.3862 1.50028 15.6311 1.1875 14.8438 1.1875C14.0564 1.1875 13.3013 1.50028 12.7445 2.05703C12.1878 2.61378 11.875 3.36889 11.875 4.15625C11.875 4.94361 12.1878 5.69872 12.7445 6.25547C13.3013 6.81222 14.0564 7.125 14.8438 7.125ZM14.8438 17.8125C14.0564 17.8125 13.3013 17.4997 12.7445 16.943C12.1878 16.3862 11.875 15.6311 11.875 14.8438C11.875 14.0564 12.1878 13.3013 12.7445 12.7445C13.3013 12.1878 14.0564 11.875 14.8438 11.875C15.6311 11.875 16.3862 12.1878 16.943 12.7445C17.4997 13.3013 17.8125 14.0564 17.8125 14.8438C17.8125 15.6311 17.4997 16.3862 16.943 16.943C16.3862 17.4997 15.6311 17.8125 14.8438 17.8125ZM19 4.15625C19 5.25856 18.5621 6.31571 17.7827 7.09516C17.0032 7.87461 15.9461 8.3125 14.8438 8.3125C13.7414 8.3125 12.6843 7.87461 11.9048 7.09516C11.1254 6.31571 10.6875 5.25856 10.6875 4.15625C10.6875 3.05394 11.1254 1.99679 11.9048 1.21734C12.6843 0.437889 13.7414 0 14.8438 0C15.9461 0 17.0032 0.437889 17.7827 1.21734C18.5621 1.99679 19 3.05394 19 4.15625ZM8.3125 14.8438C8.3125 15.9461 7.87461 17.0032 7.09516 17.7827C6.31571 18.5621 5.25856 19 4.15625 19C3.05394 19 1.99679 18.5621 1.21734 17.7827C0.437889 17.0032 0 15.9461 0 14.8438C0 13.7414 0.437889 12.6843 1.21734 11.9048C1.99679 11.1254 3.05394 10.6875 4.15625 10.6875C5.25856 10.6875 6.31571 11.1254 7.09516 11.9048C7.87461 12.6843 8.3125 13.7414 8.3125 14.8438ZM14.8438 19C15.9461 19 17.0032 18.5621 17.7827 17.7827C18.5621 17.0032 19 15.9461 19 14.8438C19 13.7414 18.5621 12.6843 17.7827 11.9048C17.0032 11.1254 15.9461 10.6875 14.8438 10.6875C13.7414 10.6875 12.6843 11.1254 11.9048 11.9048C11.1254 12.6843 10.6875 13.7414 10.6875 14.8438C10.6875 15.9461 11.1254 17.0032 11.9048 17.7827C12.6843 18.5621 13.7414 19 14.8438 19ZM4.15625 5.9375C3.92233 5.9375 3.69071 5.89143 3.4746 5.80191C3.25848 5.71239 3.06212 5.58119 2.89672 5.41578C2.73131 5.25038 2.60011 5.05402 2.51059 4.8379C2.42107 4.62179 2.375 4.39017 2.375 4.15625C2.375 3.92233 2.42107 3.69071 2.51059 3.4746C2.60011 3.25848 2.73131 3.06212 2.89672 2.89672C3.06212 2.73131 3.25848 2.60011 3.4746 2.51059C3.69071 2.42107 3.92233 2.375 4.15625 2.375C4.62867 2.375 5.08174 2.56267 5.41578 2.89672C5.74983 3.23077 5.9375 3.68383 5.9375 4.15625C5.9375 4.62867 5.74983 5.08174 5.41578 5.41578C5.08174 5.74983 4.62867 5.9375 4.15625 5.9375ZM4.15625 8.3125C5.25856 8.3125 6.31571 7.87461 7.09516 7.09516C7.87461 6.31571 8.3125 5.25856 8.3125 4.15625C8.3125 3.05394 7.87461 1.99679 7.09516 1.21734C6.31571 0.437889 5.25856 0 4.15625 0C3.05394 0 1.99679 0.437889 1.21734 1.21734C0.437889 1.99679 0 3.05394 0 4.15625C0 5.25856 0.437889 6.31571 1.21734 7.09516C1.99679 7.87461 3.05394 8.3125 4.15625 8.3125Z" fill="#ADADAD"/>
                                        </svg>

                                        <span>Edit Frontend</span>
                                    </a>
                                </li>
                                @endif
                                @if (check_auth_permission(['blog', 'blog-category']))
                                <li class="@if($controller == 'blog'){{'active'}}@endif">
                                    <a href="{{url('blog')}}">
                                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.27778 13.2222H10.5556C10.8546 13.2222 11.1055 13.1316 11.3082 12.9502C11.5101 12.7695 11.6111 12.5454 11.6111 12.2778C11.6111 12.0102 11.5101 11.7857 11.3082 11.6044C11.1055 11.4237 10.8546 11.3333 10.5556 11.3333H5.27778C4.9787 11.3333 4.72783 11.4237 4.52517 11.6044C4.3232 11.7857 4.22222 12.0102 4.22222 12.2778C4.22222 12.5454 4.3232 12.7695 4.52517 12.9502C4.72783 13.1316 4.9787 13.2222 5.27778 13.2222ZM5.27778 9.44444H13.7222C14.0213 9.44444 14.2718 9.35378 14.4738 9.17244C14.6764 8.99174 14.7778 8.76759 14.7778 8.5C14.7778 8.23241 14.6764 8.00794 14.4738 7.82661C14.2718 7.64591 14.0213 7.55556 13.7222 7.55556H5.27778C4.9787 7.55556 4.72783 7.64591 4.52517 7.82661C4.3232 8.00794 4.22222 8.23241 4.22222 8.5C4.22222 8.76759 4.3232 8.99174 4.52517 9.17244C4.72783 9.35378 4.9787 9.44444 5.27778 9.44444ZM5.27778 5.66667H13.7222C14.0213 5.66667 14.2718 5.576 14.4738 5.39467C14.6764 5.21396 14.7778 4.98981 14.7778 4.72222C14.7778 4.45463 14.6764 4.23017 14.4738 4.04883C14.2718 3.86813 14.0213 3.77778 13.7222 3.77778H5.27778C4.9787 3.77778 4.72783 3.86813 4.52517 4.04883C4.3232 4.23017 4.22222 4.45463 4.22222 4.72222C4.22222 4.98981 4.3232 5.21396 4.52517 5.39467C4.72783 5.576 4.9787 5.66667 5.27778 5.66667ZM2.11111 17C1.53056 17 1.03339 16.8152 0.619611 16.4456C0.206537 16.0754 0 15.6306 0 15.1111V1.88889C0 1.36944 0.206537 0.924611 0.619611 0.554389C1.03339 0.184796 1.53056 0 2.11111 0H16.8889C17.4694 0 17.9666 0.184796 18.3804 0.554389C18.7935 0.924611 19 1.36944 19 1.88889V15.1111C19 15.6306 18.7935 16.0754 18.3804 16.4456C17.9666 16.8152 17.4694 17 16.8889 17H2.11111ZM2.11111 15.1111H16.8889V1.88889H2.11111V15.1111ZM2.11111 15.1111V1.88889V15.1111Z" fill="#ADADAD"/>
                                        </svg>
                                        <span>Blog</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        
                        @if (check_auth_permission(['email_marketing', 'contacts', 'contact_groups','crm_settings','unsubscribed_contacts','contacts_fields' ]))
                        <li class="@if($controller == 'CRM' || $controller == 'forms'){{'active'}}@endif">
                            <a href="#toolsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Tools</a>
                            <ul class="collapse list-unstyled submenu @if($controller == 'CRM' || $controller == 'forms'){{'show'}}@endif" id="toolsSubmenu">
                            
                            @if (check_auth_permission(['email_marketing', 'contacts', 'contact_groups','crm_settings','unsubscribed_contacts','contacts_fields' ]))
                                <li class="@if($controller == 'CRM'){{'active'}}@endif">
                                    <a href="{{ url('crmcontrols') }}">
                                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.8639 8.67675C21.089 8.21962 21.2723 7.59863 21.0772 6.96517C20.8503 6.23108 20.225 5.74329 19.2157 5.51712L12.8153 4.07962L6.27961 0.388125C6.20882 0.347875 5.57258 0 4.87736 0C4.35912 0 3.91258 0.18975 3.58493 0.547208C3.27907 0.881667 3.09573 1.34646 3.03764 1.93104C2.97751 1.92714 2.91728 1.92522 2.85703 1.92529C1.86865 1.92529 1.3613 2.36229 1.10898 2.72933C0.718714 3.29667 0.669703 4.06429 0.96286 5.01208L3.3671 12.7918L3.59491 19.5318C3.63485 20.7029 4.24748 21.9621 5.49907 21.9631C5.73868 21.9631 5.98645 21.9142 6.2433 21.8193C6.541 22.3522 7.0783 23 7.93508 23C8.53954 23 9.13675 22.6579 9.71035 21.9813L14.3482 16.5217L20.5045 12.4171C20.6379 12.327 21.8151 11.5067 21.7733 10.281C21.7534 9.66575 21.4448 9.12908 20.8639 8.67675ZM7.09645 19.3258L4.98355 12.489L4.69675 4.01062L12.2535 5.70783L18.3989 9.17892L13.289 15.1963L7.09645 19.3258ZM18.8781 7.19708C19.3727 7.30825 19.5216 7.46446 19.5315 7.49704C19.5506 7.55742 19.5161 7.68487 19.4526 7.82671L17.9795 6.99487L18.8781 7.19708ZM4.87736 1.71733C5.12151 1.71733 5.42828 1.85629 5.51268 1.90229L7.0901 2.79258L4.64592 2.24346C4.65772 1.93392 4.71853 1.77963 4.75483 1.73937C4.76572 1.72883 4.8111 1.71733 4.87736 1.71733ZM2.50851 4.47925C2.33153 3.90904 2.4241 3.73846 2.42501 3.7375C2.44226 3.71258 2.57658 3.64263 2.85703 3.64263C2.93236 3.64263 3.00134 3.64742 3.05761 3.65317L3.15654 6.57608L2.50851 4.47925ZM5.22043 19.4695L5.19411 18.7048L5.66062 20.2132C5.60839 20.2316 5.55406 20.2425 5.49907 20.2457C5.36656 20.2457 5.23314 19.7666 5.22043 19.4695ZM8.50052 20.8342C8.12477 21.2779 7.9378 21.2827 7.93599 21.2827C7.88335 21.2827 7.76808 21.1562 7.6628 20.9789L9.31282 19.8787L8.50052 20.8342ZM19.6368 10.9643L18.3253 11.8392L19.8637 10.028C20.0897 10.1947 20.1478 10.3136 20.1487 10.3433C20.1542 10.4707 19.8882 10.7918 19.6368 10.9643Z" fill="#ADADAD"/>
                                            </svg>
                                        <span>CRM Center</span>
                                    </a>
                                </li>
                            @endif
                            @if (check_auth_permission(['form-list','form-reports','form-settings' ]))
                                <li class="@if($controller == 'forms'){{'active'}}@endif">
                                    <a href="{{url('forms')}}">
                                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.7744 2.21736V20.7826C21.7744 22.0299 20.8838 23 19.7494 23H2.79941C1.6791 22.9949 0.774414 22.0402 0.774414 20.7775V2.21736C0.774414 0.980361 1.65566 0 2.79941 0H19.7541C20.8791 0 21.7744 0.964963 21.7744 2.21736ZM20.026 20.7775V2.21736C20.026 2.06338 19.9041 1.91966 19.7541 1.91966H19.3182L14.1479 5.74872L11.2744 3.18746L8.40566 5.74872L3.23535 1.91453H2.79941C2.64941 1.91453 2.52754 2.05825 2.52754 2.21223V20.7775C2.52754 20.9315 2.64941 21.0752 2.79941 21.0752H19.7541C19.9041 21.0803 20.026 20.9366 20.026 20.7775ZM7.81504 7.90449V9.80362H4.36973V7.90449H7.81504ZM7.81504 11.7233V13.6378H4.36973V11.7233H7.81504ZM8.33535 4.16269L10.8666 1.91966H5.31191L8.33535 4.16269ZM18.1791 7.90449V9.80362H8.9916V7.90449H18.1791ZM18.1791 11.7233V13.6378H8.9916V11.7233H18.1791ZM14.2135 4.16269L17.2369 1.91966H11.6869L14.2135 4.16269ZM18.1791 15.5523V17.4669H13.5197V15.5523H18.1791Z" fill="#ADADAD"/>
                                        </svg>
                                        <span>Forms</span>
                                    </a>
                                </li>
                                @endif
                             
                            </ul>
                        </li>
                        @endif
                        @if(check_auth_permission([
                            'user_types', 'permissions', 'business_contact_info',
                            'addresses',
                            'social_media',
                            'business_info_section',
                            'timezones',
                            'action_buttons', 'action_button_text', 'action_button_link',
                            'theme',
                            'master_title_fonts',
                            'contact_forms',
                            'contact_form_settings',
                            'seo_settings',
                            'seo_block',
                            'master_notifications',
                            'scripts_favicons',
                            'alternate_wide_header',
                            'email_notifications',
                            'step_notifications',
                            'feature_stack_order',
                            'pulldown_menu',
                            'user_types',
                            'permissions',
                            'footer', 'footer_text', 'footer_link',
                            'step_setup'
                        ]) )
                        <li class="@if($controller == 'businessinfo' || $controller == 'settings'){{'active'}}@endif">
                            <a href="#settingsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Settings</a>
                            <ul class="collapse list-unstyled submenu @if($controller == 'businessinfo' || $controller == 'settings'){{'show'}}@endif" id="settingsSubmenu">
                                @if(check_auth_permission([
                                    'user_types', 'permissions', 'business_contact_info',
                                    'addresses',
                                    'social_media',
                                    'business_info_section',
                                    'timezones',
                                ]) )
                                    <li class="@if($controller == 'businessinfo'){{'active'}}@endif">
                                        <a href="{{url('businessinfo')}}">
                                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1832 1.53015C8.39383 1.53015 6.94327 2.88087 6.94327 4.54707C6.94327 6.21327 8.39383 7.56399 10.1832 7.56399C11.9726 7.56399 13.4231 6.21327 13.4231 4.54707C13.4231 2.88087 11.9726 1.53015 10.1832 1.53015ZM5.3881 4.54707C5.3881 2.0811 7.53494 0.0820312 10.1832 0.0820312C12.8315 0.0820312 14.9783 2.0811 14.9783 4.54707C14.9783 7.01304 12.8315 9.01211 10.1832 9.01211C7.53494 9.01211 5.3881 7.01304 5.3881 4.54707ZM0.366211 19.511C0.366211 14.4624 4.76144 10.3697 10.1832 10.3697C15.605 10.3697 20.0002 14.4624 20.0002 19.511C20.0002 19.9109 19.652 20.235 19.2226 20.235C18.7932 20.235 18.445 19.9109 18.445 19.511C18.445 15.6012 15.3127 12.3725 11.2573 11.8823L12.9351 16.9597C13.0108 17.1887 12.9599 17.4378 12.7991 17.625L10.7904 19.9631C10.6428 20.1348 10.4194 20.2348 10.1832 20.2348C9.94698 20.2348 9.72357 20.1348 9.57601 19.9631L7.56725 17.625C7.40648 17.4378 7.35556 17.1887 7.43125 16.9597L9.10908 11.8823C5.05368 12.3725 1.92138 15.6012 1.92138 19.511C1.92138 19.9109 1.57324 20.235 1.14379 20.235C0.714347 20.235 0.366211 19.9109 0.366211 19.511ZM10.1832 13.5558L9.03862 17.0195L10.1832 18.3517L11.3278 17.0195L10.1832 13.5558Z" fill="#ADADAD"/>
                                                </svg>

                                            <span>Business Info</span>
                                        </a>
                                    </li>
                                @endif
                               @if (check_auth_permission([
                                        'action_buttons', 'action_button_text', 'action_button_link',
                                        'theme',
                                        'master_title_fonts',
                                        'contact_forms',
                                        'contact_form_settings',
                                        'seo_settings',
                                        'seo_block',
                                        'master_notifications',
                                        'scripts_favicons',
                                        'alternate_wide_header',
                                        'email_notifications',
                                        'step_notifications',
                                        'feature_stack_order',
                                        'pulldown_menu',
                                        'user_types',
                                        'permissions',
                                        'footer', 'footer_text', 'footer_link',
                                        'step_setup'
                                    ]))
                                    <li class="@if($controller == 'settings'){{'active'}}@endif">
                                        <a href="{{url('settings')}}">
                                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_1340_11950" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="23" height="22">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.26653 2.4884C3.71106 2.01811 4.31397 1.75391 4.94263 1.75391H10.1715C10.6143 1.75391 10.9732 2.13363 10.9732 2.60204C10.9732 3.07046 10.6143 3.45018 10.1715 3.45018H4.94263C4.73921 3.45018 4.54413 3.53567 4.40029 3.68784C4.25645 3.84002 4.17564 4.04641 4.17564 4.26161V15.0304H19.3048V12.0062C19.3048 11.5378 19.6637 11.1581 20.1065 11.1581C20.5492 11.1581 20.9082 11.5378 20.9082 12.0062V15.8786C20.9082 16.347 20.5492 16.7267 20.1065 16.7267H3.37395C2.93119 16.7267 2.57227 16.347 2.57227 15.8786V4.26161C2.57227 3.59653 2.822 2.95868 3.26653 2.4884Z" fill="white"/>
                                                <path d="M1.28223 15.8828H22.1979V16.9892C22.1979 17.8695 21.8673 18.7137 21.279 19.3362C20.6906 19.9586 19.8926 20.3083 19.0605 20.3083H4.41958C3.5875 20.3083 2.7895 19.9586 2.20114 19.3362C1.61277 18.7137 1.28223 17.8695 1.28223 16.9892V15.8828Z" fill="white"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.480469 15.8794C0.480469 15.411 0.839397 15.0312 1.28216 15.0312H22.1978C22.6406 15.0312 22.9995 15.411 22.9995 15.8794V16.9858C22.9995 18.091 22.5845 19.151 21.8458 19.9325C21.1071 20.714 20.1052 21.153 19.0605 21.153H4.41951C3.37481 21.153 2.3729 20.714 1.63419 19.9325C0.895474 19.151 0.480469 18.091 0.480469 16.9858V15.8794ZM2.08385 16.7275V16.9858C2.08385 17.6411 2.32992 18.2696 2.76795 18.733C3.20597 19.1964 3.80005 19.4568 4.41951 19.4568H19.0605C19.6799 19.4568 20.274 19.1964 20.712 18.733C21.1501 18.2696 21.3961 17.6411 21.3961 16.9858V16.7275H2.08385Z" fill="white"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4915 4.55956C17.0679 4.55956 16.7245 4.92285 16.7245 5.37098C16.7245 5.81912 17.0679 6.18241 17.4915 6.18241C17.9151 6.18241 18.2584 5.81912 18.2584 5.37098C18.2584 4.92285 17.9151 4.55956 17.4915 4.55956ZM15.1211 5.37098C15.1211 3.98602 16.1823 2.86328 17.4915 2.86328C18.8006 2.86328 19.8618 3.98602 19.8618 5.37098C19.8618 6.75595 18.8006 7.87869 17.4915 7.87869C16.1823 7.87869 15.1211 6.75595 15.1211 5.37098Z" fill="white"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.4921 0.648438C17.9349 0.648438 18.2938 1.02816 18.2938 1.49658V3.70933C18.2938 3.80072 18.2801 3.88873 18.2548 3.9712C18.3097 3.90681 18.3749 3.8503 18.4497 3.80461L20.261 2.69823C20.6445 2.46402 21.1348 2.603 21.3561 3.00866C21.5775 3.41431 21.4462 3.93303 21.0627 4.16724L19.2514 5.27361C19.1766 5.31932 19.0977 5.35082 19.0175 5.36889C19.0977 5.38696 19.1766 5.41846 19.2514 5.46417L21.0627 6.57055C21.4462 6.80476 21.5775 7.32347 21.3561 7.72913C21.1348 8.13478 20.6445 8.27377 20.261 8.03955L18.4497 6.93318C18.3749 6.88749 18.3097 6.83097 18.2548 6.76658C18.2801 6.84906 18.2938 6.93707 18.2938 7.02846V9.24121C18.2938 9.70962 17.9349 10.0893 17.4921 10.0893C17.0493 10.0893 16.6904 9.70962 16.6904 9.24121V7.02846C16.6904 6.93707 16.7041 6.84906 16.7294 6.76658C16.6745 6.83097 16.6093 6.88749 16.5345 6.93318L14.7232 8.03955C14.3397 8.27377 13.8494 8.13478 13.6281 7.72913C13.4067 7.32347 13.538 6.80476 13.9215 6.57055L15.7328 5.46417C15.8076 5.41846 15.8865 5.38696 15.9667 5.36889C15.8865 5.35082 15.8076 5.31932 15.7328 5.27361L13.9215 4.16724C13.538 3.93303 13.4067 3.41431 13.6281 3.00866C13.8494 2.603 14.3397 2.46402 14.7232 2.69823L16.5345 3.80461C16.6093 3.8503 16.6745 3.90681 16.7294 3.9712C16.7041 3.88873 16.6904 3.80072 16.6904 3.70933V1.49658C16.6904 1.02816 17.0493 0.648438 17.4921 0.648438ZM16.8959 4.27631C16.9638 4.49708 16.9463 4.7463 16.8279 4.96319C16.7095 5.1801 16.5143 5.32076 16.2995 5.36889C16.5143 5.41702 16.7095 5.55768 16.8279 5.7746C16.9463 5.99149 16.9638 6.24071 16.8959 6.46147C17.0426 6.28886 17.2554 6.18032 17.4921 6.18032C17.7288 6.18032 17.9416 6.28886 18.0883 6.46147C18.0204 6.24071 18.0379 5.99149 18.1563 5.7746C18.2747 5.55768 18.4699 5.41702 18.6847 5.36889C18.4699 5.32076 18.2747 5.1801 18.1563 4.96319C18.0379 4.74629 18.0204 4.49708 18.0883 4.27631C17.9416 4.44892 17.7288 4.55747 17.4921 4.55747C17.2554 4.55747 17.0426 4.44892 16.8959 4.27631Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask0_1340_11950)">
                                                <path d="M-0.80957 -2.375H24.2892V24.178H-0.80957V-2.375Z" fill="#ADADAD"/>
                                                </g>
                                                </svg>


                                            <span>Settings</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if (check_auth_permission(['wiki_how_to' ]))
                        <li style="display: none;">
                            <a href="#wikiSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Wiki How-To</a>
                            <ul class="collapse list-unstyled submenu" id="wikiSubmenu">
                                
                                    <li>
                                        <a href="https://wiki.enfohub.com/" target="_blank">
                                            <svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M23 0H18.25L17.9 0.046729V0.514019C17.9 0.576324 17.9667 0.607477 18.1 0.607477C18.1333 0.638629 18.2 0.654206 18.3 0.654206L18.75 0.700935C19.1167 0.700935 19.4 0.794393 19.6 0.981308C19.7667 1.19938 19.7833 1.49533 19.65 1.86916L15.45 12.1495L15.3 12.1028L12.6 6.4486L12.65 6.35514L14.85 2.14953C15.0833 1.7134 15.3 1.37072 15.5 1.1215C15.6333 0.841121 15.95 0.685358 16.45 0.654206C16.55 0.654206 16.6 0.607477 16.6 0.514019V0.046729C14.8333 0.0155763 13.5667 0.0155763 12.8 0.046729V0.607477C12.8333 0.638629 12.8667 0.654206 12.9 0.654206L13.1 0.700935C13.5 0.700935 13.75 0.778816 13.85 0.934579C13.95 1.09034 13.9167 1.40187 13.75 1.86916L12.05 5.3271L10.55 2.1028V2.05607C10.1833 1.33956 10.0833 0.919003 10.25 0.794393C10.35 0.76324 10.4833 0.732087 10.65 0.700935L10.85 0.654206C10.95 0.654206 11 0.607477 11 0.514019V0.046729H6.9V0.514019C6.9 0.576324 7 0.638629 7.2 0.700935C7.53333 0.732087 7.75833 0.817757 7.875 0.957944C7.99167 1.09813 8.23333 1.54206 8.6 2.28972L9 3.13084L10.6 6.30841C10.7 6.58879 10.85 6.94704 11.05 7.38318L8.75 12.1028L8.6 12.0561C6.23333 6.88474 4.7 3.44237 4 1.72897C3.9 1.4486 3.85 1.24611 3.85 1.1215C3.85 0.841121 4.08333 0.700935 4.55 0.700935H5.25C5.48333 0.700935 5.6 0.638629 5.6 0.514019V0.0934579L5.4 0.046729H0.15L0 0.0934579V0.514019C0 0.576324 0.1 0.638629 0.3 0.700935C0.8 0.700935 1.16667 0.778816 1.4 0.934579C1.56667 1.15265 1.75 1.52648 1.95 2.05607C2.38333 3.08411 3.28333 5.10125 4.65 8.10748C6.01667 11.1137 6.93333 13.1776 7.4 14.2991C7.83333 15.2336 8.31667 15.2181 8.85 14.2523C9.58333 12.8193 10.5 10.9346 11.6 8.59813C11.8 9.06542 12.0833 9.71963 12.45 10.5607C12.8167 11.4019 13.1417 12.1417 13.425 12.7804C13.7083 13.419 13.9333 13.9097 14.1 14.2523C14.5667 15.2492 15.05 15.2492 15.55 14.2523L20.75 2.14953C20.95 1.68224 21.1833 1.32399 21.45 1.07477C21.75 0.825545 22.2167 0.685358 22.85 0.654206C22.95 0.654206 23 0.607477 23 0.514019V0Z" fill="#ADADAD"/>
                                            </svg>
                                            <span>Wiki (How To)</span>
                                        </a>
                                    </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="launch-website-div mb-20 bg-blue">
                        <img src="{{url('assets/admin2/img/www-white.png')}}" alt="">
                        <a href="{{ url('/home') }}" target="_blank" class="ml-10 text-white">Launch Website</a>
                    </diV>
                    <div class="launch-website-div">
                        <img src="{{url('assets/admin2/img/www.png')}}" alt="">
                        <a href="{{ url('/home?editwebsite=true') }}" target="_blank" class="ml-10 text-decoration-none">Tutorial Website</a>
                    </diV>
                    <div id="business_coach_btn" onclick="business()" class="launch-website-div mt-4">
                        <img src="{{url('assets/admin2/img/www.png')}}" alt="">
                        <a  target="_blank" class="ml-10 text-decoration-none" style="cursor: pointer;">Business Coach</a>
                    </diV>
                </diV>
            </nav>
            
            @if(session()->has('error'))
                <script>
                    //success,error,warning,info
                    cuteAlert({
                      type: "error",
                      title: "",
                      message: "{{ session()->get('error') }}",
                      buttonText: "Okay"
                    });
                    const toastContainer = document.querySelector(".alert-wrapper");

                    setTimeout(() => {
                    toastContainer.remove();
                    resolve();
                    }, 1500);
                    
                </script>
            @endif
            @if(session()->has('success'))
                <script>
                    //success,error,warning,info
                    cuteAlert({
                      type: "success",
                      title: "",
                      message: "{{ session()->get('success') }}",
                      buttonText: "Okay"
                    });
                    const toastContainer = document.querySelector(".alert-wrapper");

                    setTimeout(() => {
                    toastContainer.remove();
                    resolve();
                    }, 1500);
                </script>
            @endif
            @if($errors->any())
                
                <script>
                    //success,error,warning,info
                    cuteAlert({
                      type: "warning",
                      title: "",
                      message: "{{ implode('', $errors->all()) }}",
                      buttonText: "Okay"
                    });
                    const toastContainer = document.querySelector(".alert-wrapper");

                    setTimeout(() => {
                    toastContainer.remove();
                    resolve();
                    }, 1500);
                    
                </script>
            @endif
            @yield('content')
        </div>
    </div>
    </div>
</body>
<div class="actions_buttons_template" style="display:none">
    <div class="row action_button_single">
      <div class="col-md-12">
        <div class="form-group">
          <label for="bannertext">Action button active</label><br>
          <label class="switch">
            <input type="checkbox" class="notificationswitch" name="act_button_active[]" checked>
            <span class="slider round"></span>
          </label>
        </div>
        
        <button type="button" class="btn btn-primary remove_action_button float-right">Remove</button>
      </div>
    
      <div class="col-md-3">
        <div class="form-group">
          <label for="action_button_discription">Action Button Name</label>
          <input type="text" class="myinput2" name="act_button_discription[]" id="action_button_discription" value="" placeholder="Type here...">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="action_button_discription_color">Action Button Text Color</label>
          <input type="color" class="myinput2" name="act_button_discription_color[]" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="action_button_bg_color">Action Button Color</label>
          <input type="color" class="myinput2" name="act_button_bg_color[]" id="action_button_bg_color" value="#000000" placeholder="#000000">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="action_button_link">Action Button Application</label>
          <select class="myinput2 news_post_action_button action_button_selection" id="act_button_link" name="action_button_link[]">
            <option value="link">Link</option>
            <option value="call">Call</option> 
            <option value="sms">SMS</option>
            <option value="email">Email</option>
            <option value="address">Address</option>
            <option value="google_map">Map</option>
            <option value="customforms">Forms</option>
            <?php 
            $front_sections = getFrontSections();
            foreach ($front_sections as $single) { ?>
              <option value="<?= $single->slug ?>"><?= $single->name ?></option>
            <?php } ?>
          </select>
        </div>

        
        <div class="form-group action_fields phone_no_calls" style="display:none;">
          <label for="">Phone number for calls</label>
          <input type="text" class="myinput2" name="act_button_phone_no_calls[]" value="">
        </div>
        <div class="form-group action_fields phone_no_sms" style="display:none;">
            <label for="">Phone number for sms</label>
            <input type="text" class="myinput2" name="act_button_phone_no_sms[]" value="">
        </div>
        <div class="form-group action_fields action_email" style="display:none;">
            <label for="">Email</label>
            <input type="text" class="myinput2" name="act_button_action_email[]" value="">
        </div>

        <div class="form-group action_fields action_link" style="display:block;">
            <input type="text" class="myinput2 news_post_link" name="act_button_link_text[]" id="news_post_link" value="" placeholder="http://google.com">
        </div>

        <div class="form-group action_fields action_forms" style="display:none;">
            <select class="myinput2 customforms" name="act_button_customform[]">
                
                <?php
                $custom_forms  = getCustomForms();
                if(isset($custom_forms) && count($custom_forms)>0){ ?>
                <?php foreach($custom_forms as $single){ ?>
                    <option value="<?=$single->id?>"><?=$single->title?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class=" action_fields action_map" style="display:none">
                      <div class="form-group " >
                          <label for="address">Enter Address</label>
                          <input type="text" class="myinput2 " name="act_button_map_address[]" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                    </div>
        <div class="form-group action_fields action_address" style="display:none;">
          <label for="addressbtn1">Select an Address</label>
          <select name="act_button_address_id[]" class="myinput2">
            <?php 
            $addresses =getAddresses()?>

            <?php if(isset($addresses)){ foreach($addresses as $address){ ?>
              <option value="<?=$address->id?>"><?=$address->address_title?></option>
            <?php }} ?>
          </select>
        </div>

      </div>
    </div>
  </div>
<div class="modal fade" id="modalImagesforUploads" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg upload-image-modal" role="document">
        <div class="modal-content">
        <div class="chooseImagesteps step1">
            <div class="modal-header">
            <h5 class="modal-title">Choose Image Ratio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h3>Choose Image Ratio</h3> 
                    <div class="image_resolutions landscape">
                        <label class=" w-100 d-flex">
                            <input type="radio" class="image_resolution" name="image_resolution" value="0" checked> 
                            <div class="d-flex justify-content-between align-items-center ml-2 min-width-105">
                                <div>Landscape</div> 
                                <div>4:3</div>
                            </div>
                        </label>
                    </div>
                    <div class="image_resolutions portrait">
                        <label class=" w-100 d-flex">
                            <input type="radio" class="image_resolution" name="image_resolution" value="1"> 
                            <div class="d-flex justify-content-between align-items-center ml-2 min-width-105">
                                <div>Portrait</div> 
                                <div>3:4</div>
                            </div>
                        </label>
                    </div>
                    <div class="image_resolutions horizontal">
                        <label class=" w-100 d-flex">
                            <input type="radio" class="image_resolution" name="image_resolution" value="2"> 
                            <div class="d-flex justify-content-between align-items-center ml-2 min-width-105">
                                <div>Horizontal</div> 
                                <div>4:1.5</div>
                            </div>
                        </label>
                    </div>
                    <div class="image_resolutions squar">
                        <label class="w-100 d-flex">
                            <input type="radio" class="image_resolution" name="image_resolution" value="3"> 
                            <div class="d-flex justify-content-between align-items-center ml-2 min-width-105">
                                <div>Square</div> 
                                <div>4:4</div>
                            </div>
                        </label>
                    </div>
                    <div class="image_resolutions landscape_new">
                        <label class="w-100 d-flex">
                            <input type="radio" class="image_resolution" name="image_resolution" value="4"> 
                            <div class="d-flex justify-content-between align-items-center ml-2 min-width-105">
                                <div>Landscape</div> 
                                <div>4:2</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary chooseResolutionNext">Next</button>
            </div>
        </div>
        <div class="chooseImagesteps step2">
            <div class="modal-header">
            <h5 class="modal-title">Choose image option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <h3 class="text-center">Choose image option</h3>
                <div class="row" align="center">
                <div class="col-md-6">
                    <label type="button" for="image_resolution_field">
                    <img class="chooseimgdiv selectfromdevice img-thumbnail" style="max-width: 200px; max-height: 200px;" src="{{ url('assets/admin2/img/device.png') }}"></label>
                    <input type="file" name="image_resolution_field" onclick="this.value='';" id="image_resolution_field" class="image_resolution_field" hidden>

                    <!-- <div class="image_resolution_field_div" style="height: 0;">
                    <input class="image_resolution_field" type="hidden" name="image_resolution_field">
                    </div> -->
                    <h4 class="text-center">Choose from device</h4>
                </div>
                <div class="col-md-6">
                    <img class="chooseimgdiv selectfromgallery img-thumbnail" style="max-width: 200px; max-height: 200px;" src="{{ url('assets/admin2/img/gallery.png') }}">
                    <h4 class="text-center">Choose from gallery</h4>
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modale fade" id="modalImagesGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered upload-image-modal modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Select Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
            <ul class="nav nav-pills">
                <?php $active = 'active first-tab';
                if (isset($all_categories) && count($all_categories) > 0) { ?>
                <?php $i = 0;
                foreach ($all_categories as $row) {
                    $i++; ?>
                    <li class="nav-item"><a class="nav-link gallery-pils <?php echo $active;
                                                                        $active = ''; ?>" aria-current="page" href="javascript:void(0);" data-cat_id="<?= $row->id ?>"><?= $row->name ?></a></li>
                <?php } ?>
                <?php } ?>
            </ul>
            <br>
            <div class="row img-container-getImages">
            </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary chooseImageGalleryNext">Next</button>
        </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static">
    <!-- Modal content -->
    <div class="modal-dialog modal-dialog-centered upload-image-modal modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">select Image</h5>
          <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="img-crop-div">
          <div class="image-wrapper imgrcroperdiv">
            <img class="image-rcroper" src="https://demo.webhound.tech/assets/uploads/898417-09-2021.png" >
          </div>
        </div>
        <div class="modal-body allimgmodal">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btncropsave">Save</button>
        </div>
      </div>
    </div>
  </div>
  @if(Request::is('*editfrontend*'))
  @php
  $categories = $categories->chunk(2);
  @endphp
  @endif
  <div class="modal fade" id="businesscoachmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #E3F3FF !important;">
      <div class="modal-header">
        <h3 class="modal-title text-center bold" style="color: #006DC1; margin:auto;" id="exampleModalLabel">enfohub's Business Coaching Center</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
            <h4 class="text-center" style="color: black;">enfohub News:</h4>
            <p><?php echo $news->text ?></p>
        </div>
        <div class="col-md-12">
            <h4 class="text-center" style="color: black;">Welcome!</h4>
            <p><?php echo $welcome->text ?></p>
        </div>
        @foreach($categories as $chunk)
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-around mb-2">
            @foreach($chunk as $key => $category)
            
            @if(isset($category->name))
                    <button type="button" class="btn btn-primary no-radius open-btns-modal modal-action-buttons">{{$category->name}}</button>
                    @endif
                    @endforeach
                </div>
        </div>
    @endforeach
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
@foreach($chunkedGroupedButtons as $buttons)
@if(isset($buttons->first()[0]->feature_slug))

<div class="modal fade actions_modal" id="buttons_modal_{{ str_replace(' ', '', $buttons->first()[0]->feature_slug) }}"tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: #E3F3FF !important;">
            <div class="modal-header">
                <h5 class="modal-title text-center" style="color: #006DC1;margin:auto;" id="exampleModalLabel">{{$buttons->first()[0]->feature_slug}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($buttons as $button)
                <div class="row justify-content-center">
                    <div class="col-md-10 d-flex justify-content-around mb-2">
                        @foreach($button as $single)
                    <!-- <div style="text-align: left;"> -->
                    <?php if ($single->active == '0') {
                      $input_link = '#';
                      $target = '';
                      $audioclass = '';
                      $popupform = '';
                      $class='';
                      $data_target="";
                      $data_toggle='';
                      if ($single->action_type == 'link') {
                        $input_link = $single->link;
                        $target = "_blank";
                      } elseif ($single->action_type == 'customforms') {
                        $input_link = '#';
                        $target = "";

                        $popupform = 'data-toggle="modal" data-target="#modalcustomforms' . getCustomformEncodedID($single->custom_form_id) . '"';
                      } elseif ($single->action_type == "address") {

                        $address =  getaddress_info($single->address_id);

                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      } elseif($single->action_type == "audioiconfeature" ){
    
                        if ( $single->action_type == 'audio') {?>  
                          <div class="action-audio" >                                  
                                <audio class="hidden" id="newspostAudio_<?= $single->id ?>" controls>
                                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                    <source src="<?= url('assets/uploads/' .get_current_url(). $single->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                </audio>
                                </div>
                            <?php
                        }
                        $input_link = '#' . $single->action_button_audio_icon_feature;
                  
                      }elseif($single->action_type == "video" ){
                      
                        $input_link = get_blog_image($single->action_button_video);
                        // $target = "_blank";
                        $data_target="#video_modal";
                        $data_toggle='modal';
                      } elseif ($single->action_type == "google_map") {

                        $address_full = isset($single->map_address) ? $single->map_address : "";
                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                        $target = "_blank";
                      }elseif($single->action_type == 'text_popup'){
                            
                        $input_link = '#' . $single->action_type;
                        ?>
                        <div style="display:none" id="actNewsButtonText<?=$single->id?>">
                            <?php echo $single->action_button_textpopup;?>
                        </div>
                        <?php 
                    }
                     elseif ($single->action_type == 'call' || $single->action_type == 'sms' || $single->action_type == 'email') {


                        switch ($single->action_type) {
                          case 'sms':
                            $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_sms));
                            break;
                          case 'call':
                            $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $single->action_button_phone_no_calls));
                            break;
                          case 'email':
                            $input_link = 'mailto:' . $single->action_button_action_email;
                            break;
                        }
                      } elseif (is_numeric($single->section)) {
                        $section = getSectionDetail($single->section);
                        $banner_input_href = '#' . $section->slug;
                        if ($section->slug == 'audiofeature') {
                          $audioclass = '';
                        }
                      } else {
                        $input_link = '#' . $single->action_type;
                        if ($single->action_type == 'audiofeature') {
                          $audioclass = '';
                          ?><div class="action-audio" > <?php
                          if ( $single->action_button_audio) {?>                                    
                                        <audio class="hidden" id="{{$single->id}}_modal_audio" controls>
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio) ?>" type="audio/mp3">
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio) ?>" type="audio/ogg">
                                            <source src="<?= url('assets/uploads/'.get_current_url() . $single->action_button_audio) ?>" type="audio/mpeg">
                                        </audio>
                                        <?php
                                }
                                ?></div> <?php
                        }else{
                          $class = 'menuitem';
                        }
                      }
                    ?>
                      @if($single->action_type == "audioiconfeature" && isset($single->action_button_audio_icon_feature)) 
                          <span  onclick="playPauseAudio('newspostAudio_<?=$single->id ?>')" style="<?='color:' . ($single->post_desc_color ? $single->post_desc_color . ';' : '#000;');?>">
                            <span>
                              <i   class="fa fa-volume-up" style="margin-top:6px;"  aria-hidden="true"></i>
                            </span>
                            <a href="<?= $input_link ?>" 
                              style="" class="btn btn-default mb-1 text-bold new-action-btn post-action-{{$single->id}} " style=""><?= $single->action_button_discription ?></a>
                            <div style="margin-top: -5px;">Click to hear Text</div>
                            <a class="btn btn-primary dropdown-item tutorial-item new-action-btn post-action-{{ $single->id }}" style="border-radius:5px !important; display: flex; align-items: center; justify-content: center; position: relative; padding-left: 30px;" href="<?= $input_link ?>">
                    <span style="position: absolute; left: 10px;">
                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                    </span>
                    {{ $single->text }}
                </a>
                            <br>
                          </span>
                      @else 
                        <a href="<?= $input_link ?>" class="btn btn-primary no-radius modal-action-buttons-secondary mb-2"
                          id="<?= $single->id . 'category_action_button' ?>"
                          <?php if($single->action_type == 'text_popup'){ ?> 
                          onclick="openPopupText('actNewsButtonText<?=$single->id?>')" 
                          <?php }?>

                          <?php if($single->action_type == "video"){?> 
                              data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                              onclick="openVideo('<?= $single->id . 'category_action_button' ?>')" 
                          <?php }?>
                          
                          <?= isset($single->action_button_audio) && $single->action_button_audio != ""?'onclick=playPauseAudio("'.$single->id.'_modal_audio")':'' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default  mb-1 text-bold new-action-btn post-action-{{$single->id}} " style="">{{$single->text}}</a>
                          @if($single->action_type == "video")
                              <div style="margin-top: -4px;<?='color:' . ($single->post_desc_color ? $single->post_desc_color . ';' : '#000;');?>" class=""></div>
                          @endif
                      @endif
                      
                    <?php } ?>
                  <!-- </div> -->
                  @endforeach
                </div>
            </div>
                @endforeach
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
@endif
@endforeach
@include('sections.common.video-modal-action')
<?php if(count($customFormsAll->toArray())>0){ ?>
    <?php foreach($customFormsAll as $single){ ?>
        <div class="modal fade in" id="modalcustomforms<?=getCustomformEncodedID($single->encoded_id)?>" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="">
                    <div class="modal-body contact">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <br>
                        <form action="<?= url('customformsAction') ?>" method="post" enctype="multipart/form-data" role="form" class="php-email-form no-box-shadow p-0">
                            @csrf
                            <center>
                                <?php
                                if ($single->image) {
                                ?>
                                    <img src='<?= url('assets/uploads/' .get_current_url(). $single->image) ?>' width="<?=$single->image_size?$single->image_size.'px':''?>" class="img-responsive">
                                <?php
                                }
                                ?>
                            </center>
                            @if($single->id == 8)
                                @if(request()->optoutmail || request()->customemail || request()->emailId)
                                    <input type="hidden" name="optoutmail" value="<?=request()->optoutmail?>">
                                    <input type="hidden" name="emailId" value="<?=request()->emailId?>">
                                    <input type="hidden" name="customemail" value="<?=request()->customemail?>">
                                @endif
                            @endif
                            <input type="hidden" name="formid" value="<?=$single->id?>"  />
                            <br>
                                <div class="formtitle"><?=$single->title?></div>
                                <div class="formsubtitle"><?=$single->subtitle?></div>
                                <div class="text-center mb-10">We are automatically notified when a Form has been submitted</div>
                                <div class="formdescriptivetext"><?=$single->descriptive?></div>
                            <br>
                            <?php if ($single->fields) { ?>
                                <?php $form_fields = json_decode($single->fields);
                                $i = 0; ?>
                                <?php foreach ($form_fields as $sngl) { ?>
                                <?php if (isset($sngl->formenable) && $sngl->formenable == '1') { ?>
                                    <?php if ($sngl->fieldtype == 'text') { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="<?=strtolower($sngl->fieldname)=='email'?'email':'text'?>" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" <?= ($sngl->required) ? 'required' : '' ?>/>
                                        <div class="validate"></div>
                                        </div>
                                    <?php } elseif ($sngl->fieldtype == 'radio') { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <div class="row">
                                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                                <div class="col-md-12">
                                                    <input type="radio" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" <?php echo $checked; $checked='';?> value="<?=strtolower((isset($singleop->option_name)?$singleop->option_name:$singleop))?>" class="inputchange" data-otherfield="<?=isset($singleop->otherfield) && $singleop->otherfield=='1'?'1':''?>"/> <?=(isset($singleop->option_name)?$singleop->option_name:$singleop)?><br>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div>
                                        </div>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }elseif ($sngl->fieldtype == 'checkbox') { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <div class="row">
                                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                                <div class="col-md-12">
                                                    <label><input type="checkbox" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]"  value="<?=strtolower((isset($singleop->option_name)?$singleop->option_name:$singleop))?>" class="chkinputchange" data-otherfield="<?=isset($singleop->otherfield) && $singleop->otherfield=='1'?'1':''?>"/> <?=(isset($singleop->option_name)?$singleop->option_name:$singleop)?></label><br>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div>
                                        </div>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }elseif ($sngl->fieldtype == 'select') { ?>
                                        <div class="col form-group">
                                            <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                            <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control selinputchange">
                                                <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                                    <option value="<?=strtolower((isset($singleop->option_name)?$singleop->option_name:$singleop))?>" data-otherfield="<?=isset($singleop->otherfield) && $singleop->otherfield=='1'?'1':''?>"> <?=(isset($singleop->option_name)?$singleop->option_name:$singleop)?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }elseif ($sngl->fieldtype == 'multiselect') { ?>
                                        <div class="col form-group">
                                            <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                            <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control selinputchange multiselectlist" multiple>
                                                <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                                    <option value="<?=strtolower((isset($singleop->option_name)?$singleop->option_name:$singleop))?>" data-otherfield="<?=isset($singleop->otherfield) && $singleop->otherfield=='1'?'1':''?>"> <?=(isset($singleop->option_name)?$singleop->option_name:$singleop)?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }elseif ($sngl->fieldtype == 'date') { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="date" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" <?= ($sngl->required) ? 'required' : '' ?> value="{{date('Y/m/d')}}"/>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }elseif ($sngl->fieldtype == 'time') { ?>
                                        <div class="col form-group position-reletive">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control newtime" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" <?= ($sngl->required) ? 'required' : '' ?>/>
                                        
                                        <i class="fa fa-clock-o top-right" aria-hidden="true"></i>
                                        <input type="time" class="ontimechange timepicker" onclick="this.showPicker()">
                                        <div class="validate"></div>
                                        </div>
                                    <?php } elseif ($sngl->fieldtype == 'textarea') { ?>
                                        <div class="form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <textarea class="form-control" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" placeholder="<?= $sngl->fieldname ?>" <?= ($sngl->required) ? 'required' : '' ?>></textarea>
                                        <div class="validate"></div>
                                        </div>
                                    <?php }  elseif ($sngl->fieldtype == 'file')  { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?>:</b></label>
                                        <input style="padding-bottom: 40px;" type="file" <?= ($sngl->required) ? 'required' : '' ?> name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control" id="file" placeholder="<?= $sngl->fieldname ?>" />
                                        </div>
                                    <?php }  elseif ($sngl->fieldtype == 'image')  { ?>
                                        <div class="col form-group">
                                            <center>
                                                <img src="<?=isset($sngl->image)?url('assets/uploads/'.get_current_url().$sngl->image):''?>" width="100%"  class="img-responsive mb-10"> 
                                                <p><?=$sngl->image_desc?></p>
                                            </center>
                                        </div>
                                    <?php }  elseif ($sngl->fieldtype == 'comment_only')  { ?>
                                        <div class="col form-group">
                                        <label><b><?=$sngl->fieldname?>:</b></label>
                                        <p><?=isset($sngl->comment_desc)?$sngl->comment_desc:''?></p>
                                        </div>
                                    <?php } elseif ($sngl->fieldtype == '5_star_min' || $sngl->fieldtype == '4_star_min') { ?>
                                        <div  class=" rating_type_<?=$single->id?>" data-value="{{$sngl->fieldtype}}"></div>
                                        <div class="form-group">
                                            <label><b>Select your rating <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                            <input type="radio" name="rating" class='rating'  value="5" <?= ($sngl->required) ? 'required' : '' ?> >
                                            <label class="text-black">5-Star Rating</label>
                                            <br>
                                            <input type="radio" name="rating" value="4" >
                                            <label class="text-black">4-Star Rating</label>
                                            <br>
                                            <input type="radio" name="rating" value="3" >
                                            <label class="text-black">3-Star Rating</label>
                                            <br>
                                            <input type="radio" name="rating" value="2" >
                                            <label class="text-black">2-Star Rating</label>
                                            <br>
                                            <input type="radio" name="rating" value="1" >
                                            <label class="text-black">1-Star Rating</label>
                                            <div class="validate"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <textarea class="form-control review_to_copy" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" placeholder="<?= $sngl->fieldname ?>" <?= ($sngl->required) ? 'required' : '' ?>></textarea>
                                        <div class="validate"></div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php $i++;
                                } ?>
                            <?php } ?>
                       
                          <?php 
                          if($siteSettings->is_captcha_enable){
                            ?>
                              <div class="col form-group" align="center">
                                <div class="dcatcha">
                                    <div class="numberspls">
                                        <span class="numberspls-hidden">
                                            <?=$num1." + "?> 
                                        </span>
                                        <?=$num2." + ".$num3?> 
                                    </div> 
                                    <div> = </div>
                                    <div> <input type="number" name="captchares" class="form-control" style="width:100px"></div>
                                </div>
                              </div>
                            <?php 
                            }
                          ?>
                          <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                          </div>
                          <div class="text-center"><button type="submit" class="btn btn-primary btn-save">Save</button></div>
                            <br>
                          
                            <div class="cf_footer_text_1"><?=$single->footer_text_1?></div>
                            <center>
                                <?php
                                    if(isJson($form_logo->file_name)){
                                    $image = json_decode($form_logo->file_name);
                                    foreach($image as $singleimage){ ?>
                                            <img src='<?= url('assets/uploads/'.get_current_url() . $singleimage->img) ?>' width="50%"  class="img-responsive mb-10 img-max-width">
                                            <p><?=$singleimage->desc?></p>
                                    <?php } }else{ ?>
                                            <img src='<?= url('assets/uploads/'.get_current_url() . $form_logo->file_name) ?>' width="50%"  class="img-responsive mb-10 img-max-width">
                                        
                                    <?php } ?>
                                <br>
                            </center>
                            <div class="cf_footer_text_2"><?=$single->footer_text_2?></div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<script>
    function business()
{
    $('#businesscoachmodal').modal('show'); // Show the modal
}
    $(document).ready(function() {
        $('.countUnreadResponses').html(countUnreadResponses);
        getCountUnreadResponses();
        function getCountUnreadResponses(){
            $.ajax({
                url: '{{ url('getunreadresponses') }}',
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    $('.head-res-table').html(data.html);
                    $('.countUnreadResponses').html(data.total_res);
                    if(data.total_res>0){
                        $('.count-response-read-div').css('background','#FF0000');
                        $('.labelUnreadResponses').css('color','arrow-down-blue.png');
                        $('.imgUnreadResponses').attr('src',base_url+'/assets/admin2/img/arrow-down-red.png');
                    }else{
                        $('.count-response-read-div').css('background','#3FA8F9');
                        $('.labelUnreadResponses').css('color','#3FA8F9');
                        $('.imgUnreadResponses').attr('src',base_url+'/assets/admin2/img/arrow-down-blue.png');
                    }
                }
            });
        }
        
        $(document).on('click', '.btnSortableEnableDisabled', function() {
            var status = $(this).data('status');
            if(status=='enable'){
                $(this).closest('.editcontent2, .card-body, .editcontent').find(".ui-sortable").sortable("enable");
                $(this).data('status','disable');
                $(this).html('Disabled Sorting');
            }else{
                $(this).closest('.editcontent2, .card-body, .editcontent').find(".ui-sortable").sortable("disable");
                $(this).data('status','enable');
                $(this).html('Enable Sorting');
            }
        });
        $(document).on("click",".openuserformedit",function() {
            var id = $(this).data('id');
            window.location.replace("{{url('detailuserform')}}/"+id+'?block=custom_user_forms');
        });
        <?php if(isset($_GET['sb']) && $_GET['sb'] !=""){  ?>
            $(".<?=$_GET['sb']?>").closest('.content2').find('.editcontent2').show();
            setTimeout(() => {
                $('html, body').animate({
                    scrollTop: $(".<?=$_GET['sb']?>").offset().top - 80
                }, 100);
            }, 2500);
        <?php } ?>
    });
    currentAudio = null;
        let temp_id = null;
        function playPauseAudio(id)
        {
            if (currentAudio) {
                currentAudio.pause();
            }
         
            if(currentAudio && temp_id == id)
            {
                currentAudio.pause();
                currentAudio = null;
                temp_id = null;
                $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                playstatus = '0';
                return;
            }
            var aud = document.getElementById(id);
            setTimeout(
            function() 
            {
                $('#popupalert').modal('hide');
            }, 400);
            var playPromise= null;
            setTimeout(
            function() 
            {
                 playPromise = aud.play();
            },300);
            if (playPromise && playPromise !== undefined) {
                playPromise.then(_ => {
                })
                .catch(error => {
                });
            }
          
            currentAudio = aud;
            temp_id = id;
            $('.playmuteaudio').attr('src', '<?= url('assets/front/img/volumn.jpg') ?>');

            aud.onended = function() {
                $('.playmuteaudio').attr('src', '<?= url('assets/front/img/muted.jpg') ?>');
                playstatus = '0';
            };
            
        }
    var fonts = ["Open Sans Condensed", <?php if(count($font_family) > 0){ foreach ($font_family as $single) { if($single->value!="'Open Sans Condensed', sans-serif"){ echo '"'.$single->value.'",';}}}?>];
</script>
</html>