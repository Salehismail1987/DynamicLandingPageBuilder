@extends('admin.layout.dashboard')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />
@php
$eventId = request()->segment(2);
@endphp
<style>
    .addnewdate svg {
        margin-right: 5px;
        /* Adjust the value to control the space */
    }
    .remove-btn{
        margin-top: 18px;
    }
    .date-time-fields{
        display: flex;
        justify-content: space-between;
        max-width: 100%;
    }
</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Attenhub Post</h1>
        <a href="{{ url('attendhub?block=event_post') }}" class="btn btn-info ">
            Back
        </a>
    </div>
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('editattendhubpost/' . $eventId) }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-upload-container">
                        <div class="uploadImageDiv">
                            <div class="upload-file-div display-table  btnuploadimagenew mb-2" data-toggle="modal" data-target="#modalImagesforUploads">
                                <div class="vertical-middle">
                                    <div class="title-5 text-color-grey2 text-center">Upload Image Here</div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary upload-fake ml-3" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <button type="button" class="btn btn-info" onclick="addAnotherImage()">+ Upload More Images</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="userfile[]">
                            <div class="col-md-6 imgdiv" style="display:none">
                                <br>
                                <img src='' width="100%" class="imagefromgallerysrc">
                                <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <?php if ($event_images) { ?>
                            <?php foreach ($event_images as $image) { ?>
                                <div class="col-md-4 imgdiv event_image-{{$image->id}}">
                                    <img src='<?= base_url("assets/uploads/" . get_current_url() . $image->image) ?>' width="100%">
                                    <button type="button" class="btn btn-primary btnimgdel" onclick="delete_event_image('<?= $image->id ?>')" data-imgid="<?= $image->id ?>">X</button>
                                </div>
                                <br>
                            <?php }
                        } else { ?>
                            <div class="col-md-12 ">
                                <h3>No images Found </h3>
                            </div>
                        <?php } ?>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Attenhub Title</label><span class="ml-2" style="color: red;">(Form is created automatically)</span>
                        <input type="text" class="myinput2" disabled name="sub_title" value="{{$event->sub_title}}" placeholder="Title Text">
                        <span style="color: red;">This field can not be edited.</span>
                    </div>
                    <div class="form-group quilleditor-div">
                        <label for="title">Description</label>
                        <textarea name="post_description" cols="40" rows="10" class="myinput2 editordata hidden"></textarea>
                        <div class="quilleditor">
                            <?php echo $event->post_description; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 p-0">
                        <div class="form-group">
                            <label for="image_size">Post Image Size</label>
                            <input type="number" name="image_size" class="myinput2" id="image_size" value="{{$event->image_size}}" placeholder="100">
                            <!-- <label>Max Image Size (500px)</label> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="date-fields-container">
                    @if(count($event->attenhubDates) > 0)
                    @foreach($event->attenhubDates as $data)
                    <div class="row date-time-fields">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image_size">Event Date</label>
                                <input type="date" class="myinput2" name="event_date[]" value="{{ $data->event_date }}" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>Event Day</label>
                                    <input type="text" class="myinput2" name="event_day[]" value="{{ $data->event_day }}" placeholder="Event Day">
                                </div>

                            </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="time_range">Start Time</label>
                                <input type="time" name="from_time[]" class="myinput2" value="{{ $data->from_time }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="time_range">End Time</label>
                                <input type="time" name="to_time[]" class="myinput2" value="{{ $data->to_time }}">
                            </div>
                        </div>
                        <!-- Add a remove button for each pre-populated row -->
                        <div class="col-md-1 remove-btn d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                        </div>

                    </div>
                    @endforeach
                    @else
                    <div class="row date-time-fields">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="image_size">Event Date</label>
                                <input type="date" class="myinput2" name="event_date[]" value="" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="time_range">Start Time</label>
                                <input type="time" name="from_time[]" class="myinput2" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="time_range">End Time</label>
                                <input type="time" name="to_time[]" class="myinput2" value="">
                            </div>
                        </div>
                        <!-- Add a remove button for each pre-populated row -->
                        <div class="col-md-1 remove-btn d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                        </div>

                    </div>
                    @endif

                    <!-- Button to add new rows -->
                    <div class="col-md-4 pl-0">
                        <button type="button" class="btn btn-primary addnewdate" data-formid="1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                                <g clip-path="url(#clip0_12_944)">
                                    <path d="M5.23535 1V10" stroke="white" stroke-width="2" stroke-linecap="round" />
                                    <path d="M10 5.76562H1" stroke="white" stroke-width="2" stroke-linecap="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_12_944">
                                        <rect width="11" height="11" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Add Another Day
                        </button>
                    </div>
                </div>


            </div>
            <hr class="myhr" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title_font_size">Attenhub Post Title Font</label>
                        <select class="myinput2" name="font_family">
                            <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $single) { ?>
                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($event->font_family) && $event->font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title_font_size">Attend Counter, Date & Time Font</label>
                        <select class="myinput2" name="counter_date_time_fonts">
                            <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $single) { ?>
                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($event->font_family) && $event->counter_date_time_fonts == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 attendance_counter">

                    <div class="form-group">
                        <label for="bannertext">Attend & Guest Counter</label><br>
                        <label class="switch">
                            <input type="checkbox" class="notificationswitch" <?= $event->display_counter ? 'checked' : '' ?> name="display_counter">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="post_title_color" value="{{$event->post_title_color}}" placeholder="#000000">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Attenhub Post Title Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="post_title_size_web" value="{{$event->post_title_size_web}}" placeholder="16">
                    </div>
                </div>
                <!-- <div class="col-md-4 d-flex flex-column"> -->
                <!-- <div class="mb-2 text-center">
                        <h5>Counter Date & Time text</h5>
                    </div> -->
                <!-- <div class="d-flex"> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Counter & Time Text Size - Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="counter_date_time_font_size" value="{{$event->counter_date_time_font_size}}" placeholder="16">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Counter & Time Text Size - Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="post_title_size_mobile" value="{{$event->post_title_size_mobile}}" placeholder="16">
                    </div>
                </div>
                <!-- </div> -->
                <!-- </div> -->
            </div>
            <div class="row">


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
                <div class="editcontent2 ">
                    <div class="action_button_container">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bannertext">Action Button active</label><br>
                                        <label class="switch">
                                            <input type="checkbox" class="notificationswitch" name="action_button_active" <?= $event->action_button_active ? 'checked' : '' ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="action_button_discription">Action Button Name</label>
                                        <input type="text" class="myinput2" name="action_button_description" id="action_button_discription" value="{{$event->action_button_description}}" placeholder="Type here...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_description_color">Action Button Text Color</label>
                                        <input type="color" class="myinput2" name="action_button_description_color" id="action_button_description_color" value="{{$event->action_button_description_color}}" placeholder="#ffffff">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_bg_color">Action Button Color</label>
                                        <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="{{$event->action_button_bg_color}}" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_link">Action Button Application</label>
                                        <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="action_button_link">
                                            <option value="link">Link to Outside Site</option>
                                            <option value="call" <?= isset($event->action_button_link) && $event->action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                            <option value="sms" <?= isset($event->action_button_link) && $event->action_button_link == 'sms' ? 'selected' : '' ?>>SMS Text</option>
                                            <option value="email" <?= isset($event->action_button_link) && $event->action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                            <option value="address" <?= isset($event->action_button_link) && $event->action_button_link == 'address' ? 'selected' : '' ?>>Business Address</option>
                                            <option value="customforms" <?= isset($event->action_button_link) && $event->action_button_link == 'customforms' ? 'selected' : '' ?>>Link to Form</option>
                                            <option value="image_popup" <?= isset($event->action_button_link) && $event->action_button_link == 'image_popup' ? 'selected' : '' ?>>Popup - Image</option>
                                            <option value="text_popup" <?= isset($event->action_button_link) && $event->action_button_link == 'text_popup' ? 'selected' : '' ?>>Popup - Text</option>
                                            <option value="video" <?= isset($event->action_button_link) && $event->action_button_link == 'video' ? 'selected' : '' ?>>Popup - Video</option>
                                            <option value="stripe" <?= isset($event->action_button_link) && $event->action_button_link == 'stripe' ? 'selected' : '' ?>>Poppup - Payment</option>
                                            <option value="audioiconfeature" <?= isset($event->action_button_link) && $event->action_button_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio File with Icon</option>
                                            <option value="google_map" <?= isset($event->action_button_link) && $event->action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                            <?php foreach ($front_sections as $single) { ?>
                                                <option value="<?= $single->slug ?>" <?= $event->action_button_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="form-group action_fields phone_no_calls" style="<?= $event->action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Phone number for calls</label>
                                        <input type="text" class="myinput2" name="action_button_phone_no_calls" value="{{$event->action_button_phone_no_calls}}">
                                    </div>
                                    <div class="form-group action_fields image_upload" style="<?= $event->action_button_link == 'image_popup' ? 'display:block' : 'display:none' ?>" name="feature_action_video2">
                                        <label for="customFile">Upload Images</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                            <label class="custom-file-label" for="customFile">Choose files</label>
                                        </div>
                                    </div>
                                    <div class="form-group action_fields phone_no_sms" style="<?= $event->action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Phone number for sms</label>
                                        <input type="text" class="myinput2" name="action_button_phone_no_sms" value="{{$event->action_button_phone_no_sms}}">
                                    </div>
                                    <div class="form-group action_fields action_email" style="<?= $event->action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                        <label for="">Email</label>
                                        <input type="text" class="myinput2" name="action_button_action_email" value="{{$event->action_button_link}}">
                                    </div>
                                    <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature" style="<?= $event->action_button_link == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                        <label for="customFile">Select File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                                accept=".mp3">
                                            <label class="custom-file-label" for="customFile">Select File</label>
                                        </div>

                                    </div>
                                    <div class="form-group action_fields action_forms" style="<?= $event->action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                        <select class="myinput2 customforms" name="action_button_customform">
                                            <?php if (count($customForms) > 0) { ?>
                                                <?php foreach ($customForms as $single) { ?>
                                                    <option value="<?= $single->id ?>" <?= $event->action_button_customform == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields action_event_forms" style="<?= $event->action_button_link == 'attendhub' ? 'display:block' : 'display:none' ?>">
                                        <select class="myinput2 customforms" name="event_form_id">
                                            <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $single) { ?>
                                                    <option value="<?= $single->id ?>" <?= $event->event_form_id == $single->id ? 'selected' : '' ?>><?= $single->sub_title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields action_link" style="<?= $event->action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                        <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="{{$event->action_button_link_text}}" placeholder="http://google.com">
                                    </div>
                                    <div class="form-group action_fields video_upload" name="action_button_video" style="<?= $event->action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                        <label for="customFile">Upload Video</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                                accept=".mp4">
                                            <label class="custom-file-label" for="customFile">Upload Video</label>
                                        </div>
                                    </div>
                                    <div class=" action_fields action_map" style="<?= $event->action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                        <div class="form-group ">
                                            <label for="address">Enter Address</label>
                                            <input type="text" class="myinput2 " name="action_button_map_address" value="{{$event->action_button_map_address}}" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                        </div>
                                    </div>
                                    <div class="form-group action_fields action_address" style="<?= $event->action_button_link == 'address' ? 'display:block' : 'display:none' ?>">
                                        <label for="addressbtn1">Select an Address</label>
                                        <select name="action_button_address_id" class="myinput2">

                                        </select>
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <div class="col-md-6 col-sm-12 p-0">
                                    <div class="form-group">
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="<?= $event->action_button_link == 'text_popup' ? 'display:block' : 'display:none' ?>">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="action_button_textpopup"></textarea>
                                            <div class="quilleditor"><?php echo $event->action_button_textpopup; ?></div>
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
                    <a href="<?= base_url('quicksettings?block=news_posts_bluebar') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                </div>
            </div>



        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        // Function to add new date/time fields on button click
        $('.addnewdate').on('click', function() {
            // Clone the last row in the date-fields-container
            var newFields = $('.date-time-fields:last').clone();

            // Clear the values of the cloned row
            newFields.find('input').val('');

            // Remove any existing "Remove" button in the cloned row
            newFields.find('.btnremovecantactformfield').closest('.col-md-1').remove();

            // Append a new "Remove" button only to the cloned row
            newFields.append(`
            <div class="col-md-1 remove-btn d-flex align-items-center justify-content-center">
                <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
            </div>
        `);

            // Append the new row to the container
            $('#date-fields-container').append(newFields);
        });

        // Function to remove a row when "Remove" button is clicked
        $(document).on('click', '.btnremovecantactformfield', function() {
            $(this).closest('.row').remove();
        });
    });



    $(".read_more_content").hide();
    $(document).on('click', '.show_read_more_block', function() {
        $(".read_more_content").toggle();
    });
    var total = 2;

    function addAnotherImage() {
        var newupload = ' <div class="col-md-12" style="margin-top:10px;border-top:2px solid lightgrey;padding-top:10px" id="img-' + total + '" ><button type="button" class="btn btn-info" style="float:right" onclick="removeImageDiv(' + total + ')">Remove</button> <div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"> <input class="dataimage" type="hidden" name="userfile[]"> <div class="col-md-6 imgdiv" style="display:none"> <br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove" >X</button></div></div> </div>';
        $(".img-upload-container").append(newupload);
        total++;
    }

    // function check_selction(value){

    //   if(value =="address" || value == "google_map"){

    //     $("#address-list-"+id).show();
    //     $("#news_post_link").hide();
    //     $("#btncustomforms").hide();

    //   }else if(value == "link"){

    //     $("#news_post_link").show();
    //     $("#address-list-"+id).hide();
    //     $("#btncustomforms").hide();

    //   }else if(value == "customforms"){

    //     $("#btncustomforms").show();
    //     $("#news_post_link").hide();
    //     $("#address-list-"+id).hide();

    //   }else{

    //     $("#news_post_link").hide();
    //     $("#address-list-"+id).hide();
    //     $("#btncustomforms").hide();
    //     $("#address-list-"+id).val('');
    //   }
    // }
</script>
@endsection('content')