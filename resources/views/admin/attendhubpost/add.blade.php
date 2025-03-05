@extends('admin.layout.dashboard')
@section('content')
<style>
    .addnewdate svg {
        margin-right: 5px;
        /* Adjust the value to control the space */
    }

    .date-time-fields {
        display: flex;
        justify-content: space-between;
        max-width: 100%;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css" />
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Attenhub Post</h1>
        <a href="{{ url('attendhub?block=event_post') }}" class="btn btn-info">
            Back
        </a>
    </div>
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('createattendhubpost') }}">
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

                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                    <input class="dataimage" type="hidden" name="userfile[]">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Attenhub Title</label><span class="ml-2" style="color: red;">(Form is created automatically)</span>
                        <input type="text" class="myinput2" name="sub_title" value="" placeholder="Title Text">
                        <span  style="color: red;">This field is required to continue - and once saved can not be edited.</span>
                    </div>
                    <div class="form-group quilleditor-div">
                        <label for="title">Description</label>
                        <textarea name="post_description" cols="40" rows="10" class="myinput2 editordata hidden"></textarea>
                        <div class="quilleditor">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2 p-0">
                        <div class="form-group">
                            <label for="image_size">Post Image Size</label>
                            <input type="number" name="image_size" class="myinput2" id="image_size" value="400" placeholder="100">
                            <!-- <label>Max Image Size (500px)</label> -->
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div id="date-fields-container" class="w-100">
                        <!-- The row with date/time fields (this row has the 'original-row' class) -->
                        <div class="row date-time-fields original-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="image_size">Event Date</label>
                                    <input type="date" class="myinput2" name="event_date[]" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Event Day</label>
                                    <input type="text" class="myinput2" name="event_day[]" value="" placeholder="Event Day">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_range">From</label>
                                    <input type="time" name="from_time[]" class="myinput2" value="12:00">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="time_range">To</label>
                                    <input type="time" name="to_time[]" class="myinput2" value="01:00">
                                </div>
                            </div>
                            <!-- The remove button will be dynamically added to cloned rows -->
                        </div>
                    </div>
                    <div class="col-md-4 pl-0">
                        <button type="button" class="btn btn-primary addnewdate" data-formid="1"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                                <g clip-path="url(#clip0_12_944)">
                                    <path d="M5.23535 1V10" stroke="white" stroke-width="2" stroke-linecap="round" />
                                    <path d="M10 5.76562H1" stroke="white" stroke-width="2" stroke-linecap="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_12_944">
                                        <rect width="11" height="11" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>Add Another Day</button>
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
                                <option value="" disabled selected>Select a font</option> <!-- Placeholder -->
                                <?php foreach ($font_family as $single) { ?>
                                    <option style="font-family: <?= $single->value ?>;" <?= ($single->id == '51') ? 'selected' : '' ?> value="<?= $single->id ?>"><?= $single->name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title_font_size">Attend Counter, Date & Time Font</label>
                        <select class="myinput2" name="counter_date_time_fonts">
                            <option value="" disabled selected>Select a font</option> <!-- Placeholder -->
                            <?php if (count($font_family) > 0) { ?>
                                <?php foreach ($font_family as $single) { ?>
                                    <option style="font-family: <?= $single->value ?>;" <?= ($single->id == '1') ? 'selected' : '' ?> value="<?= $single->id ?>"><?= $single->name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 attendance_counter">

                    <div class="form-group">
                        <label for="bannertext">Attend & Guest Counter</label><br>
                        <label class="switch">
                            <input type="checkbox" class="notificationswitch" checked name="display_counter">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Text Color</label>
                        <input type="color" class="myinput2" name="post_title_color" value="" placeholder="#000000">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Attenhub Post Title Text Size</label><br>
                        <input type="text" class="myinput2 width-50px" name="post_title_size_web" value="24" placeholder="16">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Counter & Time Text Size - Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="counter_date_time_font_size" value="16" placeholder="16">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Counter & Time Text Size - Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="post_title_size_mobile" value="12" placeholder="16">
                    </div>
                </div>
            </div>
            <hr class="myhr" />
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
                                            <input type="checkbox" class="notificationswitch" name="action_button_active">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="action_button_discription">Action Button Name</label>
                                        <input type="text" class="myinput2" name="action_button_description" id="action_button_discription" value="" placeholder="Action Button Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_discription_color">Action Button Text Color</label>
                                        <input type="color" class="myinput2" name="action_button_discription_color" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_bg_color">Action Button Color</label>
                                        <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="#000000" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="action_button_link">Action Button Application</label>
                                        <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="action_button_link">
                                            <option value="link">Link to Outside Site</option>
                                            <option value="call">Call</option>
                                            <option value="sms">SMS Text</option>
                                            <option value="email">Email</option>
                                            <option value="address">Business Address</option>
                                            <option value="customforms">Link to Form</option>
                                            <option value="image_popup">Popup - Image</option>
                                            <option value="text_popup">Popup - Text</option>
                                            <option value="video">Popup - Video</option>
                                            <option value="stripe">Popup - Payment</option>
                                            <option value="audioiconfeature">Audio File with Icon</option>
                                            <option value="google_map">Map</option>
                                            <?php foreach ($front_sections as $single) { ?>
                                                <option value="<?= $single->slug ?>"><?= $single->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="form-group action_fields phone_no_calls" style="display:none;">
                                        <label for="">Phone number for calls</label>
                                        <input type="text" class="myinput2" name="action_button_phone_no_calls" value="">
                                    </div>
                                    <div class="form-group action_fields image_upload" style="display:none;" name="feature_action_video2">
                                        <label for="customFile">Upload Images</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                            <label class="custom-file-label" for="customFile">Choose files</label>
                                        </div>
                                    </div>
                                    <div class="form-group action_fields phone_no_sms" style="display:none;">
                                        <label for="">Phone number for sms</label>
                                        <input type="text" class="myinput2" name="action_button_phone_no_sms" value="">
                                    </div>
                                    <div class="form-group action_fields action_email" style="display:none;">
                                        <label for="">Email</label>
                                        <input type="text" class="myinput2" name="action_button_action_email" value="">
                                    </div>
                                    <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature" style="display:none">
                                        <label for="customFile">Select File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                                accept=".mp3">
                                            <label class="custom-file-label" for="customFile">Select File</label>
                                        </div>

                                    </div>
                                    <div class="form-group action_fields action_forms" style="display:none">
                                        <select class="myinput2 customforms" name="action_button_customform">
                                            <?php if (count($customForms) > 0) { ?>
                                                <?php foreach ($customForms as $single) { ?>
                                                    <option value="<?= $single->id ?>"><?= $single->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields action_event_forms" style="display:none">
                                        <select class="myinput2 customforms" name="event_form_id">
                                            <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $single) { ?>
                                                    <option value="<?= $single->id ?>"><?= $single->sub_title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields action_link" style="display:block;">
                                        <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                                    </div>
                                    <div class="form-group action_fields video_upload" name="action_button_video" style="display:none">
                                        <label for="customFile">Upload Video</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                                accept=".mp4">
                                            <label class="custom-file-label" for="customFile">Upload Video</label>
                                        </div>
                                    </div>
                                    <div class=" action_fields action_map" style="display:none">
                                        <div class="form-group ">
                                            <label for="address">Enter Address</label>
                                            <input type="text" class="myinput2 " name="action_button_map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                        </div>
                                    </div>
                                    <div class="form-group action_fields action_address" style="display:none;">
                                        <label for="addressbtn1">Select an Address</label>
                                        <select name="action_button_address_id" class="myinput2">

                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 d-flex justify-content-end">
                                <div class="col-md-6 col-sm-12 p-0">
                                    <div class="form-group">
                                        <div class="form-group quilleditor-div action_fields  action_textpopup" style="display:none">
                                            <label>Popup Text </label>
                                            <textarea class="myinput2 editordata hidden" name="action_button_textpopup"></textarea>
                                            <div class="quilleditor"></div>
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
        // When the 'Add New Date' button is clicked
        $('.addnewdate').on('click', function() {
            // Clone the first set of date/time fields and append it
            var newFields = $('.date-time-fields.original-row').clone();

            // Remove the 'original-row' class from the cloned row
            newFields.removeClass('original-row');

            // Clear the values in the cloned fields so they are empty
            newFields.find('input').val('');

            // Append the cloned fields to the container
            $('#date-fields-container').append(newFields);

            // Add the "Remove" button to the cloned row
            newFields.append(`
                <div class="col-md-1">
                    <br>
                    <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                </div>
            `);
        });

        // When the 'Remove' button is clicked for a specific row
        $(document).on('click', '.btnremovecantactformfield', function() {
            // Ensure that the clicked 'Remove' button is within a dynamically added row
            var row = $(this).closest('.row');

            // Only remove the row if it's not the original one
            if (!row.hasClass('original-row')) {
                row.remove();
            }
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