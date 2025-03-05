@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ADD Email Post</h1>
        <a href="{{ url('crmcontrols?block=email_management') }}" class="btn btn-info ">
            Back
        </a>
    </div>
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('createNewEmailPost') }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="teaser_title">Email Template</label>
                        <select class="myinput2 selecttemplate" name="selecttemplate">
                            <option value="">Select Template</option>
                            <?php if (count($email_stater_templates)) { ?>
                                <?php foreach ($email_stater_templates as $single) { ?>
                                    <option value="<?= $single->id ?>"><?= $single->content_title ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="teaser_title">Teaser Title</label>
                        <input type="text" required class="myinput2" name="teaser_title" id="teaser_title" value="" placeholder="Sample Email ">
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="content_title">Content Title</label>
                        <input type="text" required class="myinput2" name="content_title" id="content_title" value="" placeholder="Title ">
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class='col-md-12'>
                            <div class="form-seperator"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="logo_image">Upload Logo Image</label>
                            <div class="logo_img_div"></div>
                            <input type="hidden" class="logo_image_path" name="logo_image_path" value="">
                            <div class="uploadImageDiv">
                                <button type="button" class="btn btn-primary btnuploadimagenew" style="float:right" data-toggle="modal" data-target="#modalImagesforUploads">Upload Logo</button>
                                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                <input class="dataimage logo_image" type="hidden" name="logo_image">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_size">Image Size</label>
                                        <input type="number" name="image_size" class="myinput2" id="image_size" value=" " placeholder="100">
                                        <!-- <label>Max Image Size (500px)</label> -->
                                    </div>
                                </div>
                                <div class="col-md-6 imgdiv" style="display:none">
                                    <br>
                                    <img src='' width="100%" class="imagefromgallerysrc">
                                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bannertext">Is Content Title Justified Centered?</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch is_content_title_justified_center" name="is_content_title_justified_center">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="logo_text">Logo Text</label>
                                <input type="text" class="myinput2" name="logo_text" id="logo_text" value="" placeholder="Text Logo ">
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <label for="logo_image">Upload Email Image</label>
                            <div class="email_image_div"></div>
                            <input type="hidden" class="email_image_path" name="email_image_path" value="">

                            <div class="uploadImageDiv">
                                <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload Image</button>
                                <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                <input class="dataimage email_image" type="hidden" name="email_image">

                                <div class="col-md-6 imgdiv" style="display:none">
                                    <br>
                                    <img src='' width="100%" class="imagefromgallerysrc">
                                    <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group quilleditor-div">
                                <label for="logo_text">Message Body (Text Block)</label>
                                <textarea rows="4" class="myinput2 editordata hidden" style="display:none" name="description_text" placeholder="Describe this email. "></textarea>
                                <div class="quilleditor" id="description_text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class='col-md-12'>
                            <div class="form-seperator"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subtitle">Sub-Title</label>
                                <input type="text" required class="myinput2" name="subtitle" id="subtitle" value="" placeholder="Sub-Title ">
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="logo_text">Admin's Note</label>
                                <textarea rows="4" class="myinput2" name="note" id="note" placeholder="Note "></textarea>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bannertext">Is Sub Title Justified Centered?</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch is_sub_title_justified_center" name="is_sub_title_justified_center">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bannertext">Is Description Text Jusitfied?</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch is_email_description_center" name="is_email_description_center">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="bannertext">Link Social Media Icons?</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch link_social_media_icons" name="link_social_media_icons">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php $total = 1; ?>
                    <div class="row mt-3">
                        <div class="col-md-5 img-upload-container-above" style="margin-bottom: 15px;">
                            <div class="col-md-12" id="img-<?= $total ?>">
                                <div class="uploadImageDiv">
                                    <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">+Image above footer</button>
                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                    <input class="dataimage" type="hidden" name="userfileabovefooter[]">

                                    <div class="col-md-10 imgdiv" style="display:none">
                                        <br>
                                        <img src='' width="100%" class="imagefromgallerysrc">
                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5 img-upload-container-below" style="margin-bottom: 15px;">
                            <div class="col-md-12" id="img-<?= $total ?>">
                                <div class="uploadImageDiv">
                                    <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">+Image below footer</button>
                                    <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                    <input class="dataimage" type="hidden" name="userfilebelowfooter[]">

                                    <div class="col-md-10 imgdiv" style="display:none">
                                        <br>
                                        <img src='' width="100%" class="imagefromgallerysrc">
                                        <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="button" class="btn btn-info" onclick="addAnotherImage()">+ Upload More Images</button>
                            </center>
                        </div>
                    </div>
                    <br>
                    <div class="content2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                    <div class="title-2">Text Properties</div>
                                    <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt=""
                                        width="12px" class="">
                                </div>
                            </div>
                        </div>
                        <div class="editcontent2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="bannertext">Override Generic Settings?</label><br>
                                        <label class="switch">
                                            <input type="checkbox" title="If turned on, below settings will override the generic settings." class="notificationswitch override_generic_settings" id="override_generic_settings" name="override_generic_settings">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-properties">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="logo_title_font_family">Logo Title Font</label>
                                        <select class="myinput2" name="logo_title_font_family" id="logo_title_font_family">
                                            <?php if (count($font_family) > 0) { ?>
                                                <?php foreach ($font_family as $single) { ?>
                                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="logo_title_text_size">Logo Title Text Size</label><br />
                                        <input type="text" class="myinput2 width-50px" name="logo_title_text_size" id="logo_title_text_size" value="" placeholder="24 ">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="logo_title_text_color">Logo Title Text Color</label>
                                        <input type="color" class="myinput2" name="logo_title_text_color" id="logo_title_text_color" value="" placeholder="#ffff ">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="content_title_font_family">Content Title Font</label>
                                        <select class="myinput2" name="content_title_font_family" id="content_title_font_family">
                                            <?php if (count($font_family) > 0) { ?>
                                                <?php foreach ($font_family as $single) { ?>
                                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="content_title_text_size">Content Title Text Size</label><br />
                                        <input type="text" class="myinput2 width-50px" name="content_title_text_size" id="content_title_text_size" value="" placeholder="24 ">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="content_title_text_color">Content Title Text Color</label>
                                        <input type="color" class="myinput2" name="content_title_text_color" id="content_title_text_color" value="" placeholder="#ffff ">
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subtitle_font_family">Sub-Title Font</label>
                                        <select class="myinput2" name="subtitle_font_family" id="subtitle_font_family">
                                            <?php if (count($font_family) > 0) { ?>
                                                <?php foreach ($font_family as $single) { ?>
                                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subtitle_text_size">Sub-Title Text Size</label><br />
                                        <input type="text" class="myinput2 width-50px" name="subtitle_text_size" id="subtitle_text_size" value="" placeholder="24 ">
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="subtitle_text_color">Sub-Title Text Color</label>
                                        <input type="color" class="myinput2" name="subtitle_text_color" id="subtitle_text_color" value="" placeholder="#ffff ">
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email_image_desciption_font_family">Description Font</label>
                                        <select class="myinput2" name="email_image_desciption_font_family" id="email_image_desciption_font_family">
                                            <?php if (count($font_family) > 0) { ?>
                                                <?php foreach ($font_family as $single) { ?>
                                                    <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"><?= $single->name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email_image_desciption_text_size">Description Text Size</label><br />
                                        <input type="text" class="myinput2 width-50px" name="email_image_desciption_text_size" id="email_image_desciption_text_size" value="" placeholder="24">
                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email_image_desciption_text_color">Description Text Color</label>
                                        <input type="color" required class="myinput2" name="email_image_desciption_text_color" id="email_image_desciption_text_color" value="" placeholder="#fff">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="preheader_text">Prehead Email Text
                                            <span style="font-weight:normal;margin-left:10px;font-size:12px;">
                                                (This is the text seen by reciptients after the email's Subject Title)
                                            </span>
                                        </label>
                                        <p id="preheader_text_message" class="text-danger">
                                            At least 100 characters are recommended. Current characters:<span id="current_chars"></span>
                                        </p>
                                        <textarea rows="3" class="myinput2 preheader_text" name="preheader_text" id="preheader_text" placeholder="Enter prehead text"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                    <div class="title-2">Action Button Settings</div>
                                    <img src="{{ url('assets') }}/admin2/img/arrow-down-grey.png" alt=""
                                        width="12px" class="">
                                </div>
                            </div>
                        </div>
                        <div class="editcontent2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_discription">Action Button Name</label>
                                        <input type="text" class="myinput2" name="action_button_discription" id="action_button_discription" value="" placeholder="Type here...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bannertext">Action button active</label><br>
                                        <label class="switch">
                                            <input type="checkbox" class="notificationswitch action_button_active" name="action_button_active">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_discription_color">Action Button Text Color</label>
                                        <input type="color" class="myinput2" name="action_button_discription_color" id="action_button_discription_color" value="#ffffff" placeholder="#ffffff">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_bg_color">Action Button Color</label>
                                        <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="#000000" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                    <div class="form-group action_fields phone_no_sms" style="display:none;">
                                        <label for="">Phone number for sms</label>
                                        <input type="text" class="myinput2" name="action_button_phone_no_sms" value="">
                                    </div>
                                    <div class="form-group action_fields action_email" style="display:none;">
                                        <label for="">Email</label>
                                        <input type="text" class="myinput2" name="action_button_action_email" value="">
                                    </div>

                                    <div class="form-group action_fields action_link" style="display:block;">
                                        <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="" placeholder="http://google.com">
                                    </div>

                                    <div class="form-group action_fields action_forms" style="display:none;">
                                        <select class="myinput2 customforms" name="action_button_customform">
                                            <?php if (count($custom_forms) > 0) { ?>
                                                <?php foreach ($custom_forms as $single) { ?>
                                                    <option value="<?= $single->id ?>"><?= $single->title ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields action_event_forms" style="display:none">
                                            <select class="myinput2" name="action_button_event_form" id="customforms">
                                              <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $singlecf) { ?>
                                                  <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                                                <?php } ?>
                                              <?php } ?>
                                            </select>
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
                                            <?php foreach ($addresses as $address) { ?>
                                                <option value="<?= $address->id ?>"><?= $address->address_title ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group action_fields video_upload" name="action_button_video1" style="display:none">
                                        <label for="customFile">Upload Video</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                                accept=".mp4">
                                            <label class="custom-file-label" for="customFile">Upload Video</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_discription">Action Button Name</label>
                                        <input type="text" class="myinput2" name="action_button_discription_2" id="action_button_discription_2" value="" placeholder="Type here...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bannertext">Action button active</label><br>
                                        <label class="switch">
                                            <input type="checkbox" class="notificationswitch action_button_active_2" name="action_button_active_2">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_discription_color_2">Action Button Text Color</label>
                                        <input type="color" class="myinput2" name="action_button_discription_color_2" id="action_button_discription_color_2" value="#ffffff" placeholder="#ffffff">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_bg_color_2">Action Button Color</label>
                                        <input type="color" class="myinput2" name="action_button_bg_color_2" id="action_button_bg_color_2" value="#000000" placeholder="#000000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="action_button_link_2">Action Button Application</label>
                                        <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link_2" name="action_button_link_2">
                                            <option value="link">Link to Outside Site</option>
                                            <option value="call">Call</option>
                                            <option value="sms">SMS Text</option>
                                            <option value="email">Email</option>
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

                                        <div class="form-group action_fields phone_no_calls" style="display:none;">
                                            <label for="">Phone number for calls</label>
                                            <input type="text" class="myinput2" name="action_button_phone_no_calls_2" value="">
                                        </div>
                                        <div class="form-group action_fields phone_no_sms" style="display:none;">
                                            <label for="">Phone number for sms</label>
                                            <input type="text" class="myinput2" name="action_button_phone_no_sms_2" value="">
                                        </div>
                                        <div class="form-group action_fields action_email" style="display:none;">
                                            <label for="">Email</label>
                                            <input type="text" class="myinput2" name="action_button_action_email_2" value="">
                                        </div>

                                        <div class="form-group action_fields action_link" style="display:block;">
                                            <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link_2" value="" placeholder="http://google.com">
                                        </div>

                                        <div class="form-group action_fields video_upload" name="action_button_video2" style="display:none">
                                            <label for="customFile">Upload Video</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="action_button_video_2" id="customFile"
                                                    accept=".mp4">
                                                <label class="custom-file-label" for="customFile">Upload Video</label>
                                            </div>
                                        </div>

                                        <div class="form-group action_fields action_forms" style="display:none;">
                                            <select class="myinput2 customforms" name="action_button_customform_2">
                                                <?php if (count($custom_forms) > 0) { ?>
                                                    <?php foreach ($custom_forms as $single) { ?>
                                                        <option value="<?= $single->id ?>"><?= $single->title ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group action_fields action_event_forms" style="display:none">
                                            <select class="myinput2" name="action_button_event_form2" id="customforms">
                                              <?php if (count($event_forms) > 0) { ?>
                                                <?php foreach ($event_forms as $singlecf) { ?>
                                                  <option value="<?= $singlecf->id ?>"><?= $singlecf->title ?></option>
                                                <?php } ?>
                                              <?php } ?>
                                            </select>
                                        </div>
                                        <div class=" action_fields action_map" style="display:none">
                                            <div class="form-group ">
                                                <label for="address">Enter Address</label>
                                                <input type="text" class="myinput2 " name="action_button_map_address_2" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                            </div>
                                        </div>
                                        <div class="form-group action_fields action_address" style="display:none;">
                                            <label for="addressbtn1">Select an Address</label>
                                            <select name="action_button_address_id_2" class="myinput2">
                                                <?php
                                                foreach ($addresses as $address) {
                                                ?>
                                                    <option value="<?= $address->id ?>"><?= $address->address_title ?>
                                        </div>
                                    <?php
                                                }
                                    ?>
                                    </select>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="row make-sticky">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?= url('crmcontrols') ?>?block=email_management"><button type="button" class="btn btn-default">Cancel</button></a>
                    </div>
                </div>



            </div>
    </form>
</div>

<script>
    if ($("#override_generic_settings").prop('checked') == true) {
        $(".text-properties :input").prop("disabled", false);
    } else {
        $(".text-properties :input").prop("disabled", true);
    }
    $(document).on('change', '.selecttemplate', function() {
        var value = $(this).val();
        $.ajax({
            url: '<?= url('getEmailTemplate'); ?>',
            type: "POST",
            dataType: 'JSON',
            data: {
                temp_id: value,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                $('#teaser_title').val(data.teaser_title);
                $('#content_title').val(data.content_title);
                $('#logo_text').val(data.logo_text);
                $('#description_text').find('.ql-editor').html(data.description_text);
                $('#subtitle').val(data.subtitle);
                $('#note').val(data.notes);
                $('#logo_title_font_family').val(data.logo_title_font_family);
                $('#logo_title_text_size').val(data.logo_title_text_size);
                $('#logo_title_text_color').val(data.logo_title_text_color);
                $('#content_title_font_family').val(data.content_title_font_family);
                $('#content_title_text_size').val(data.content_title_text_size);
                $('#content_title_text_color').val(data.content_title_text_color);
                $('#subtitle_font_family').val(data.subtitle_font_family);
                $('#subtitle_text_size').val(data.subtitle_text_size);
                $('#subtitle_text_color').val(data.subtitle_text_color);
                $('#email_image_desciption_font_family').val(data.email_image_desciption_font_family);
                $('#email_image_desciption_text_size').val(data.email_image_desciption_text_size);
                $('#email_image_desciption_text_color').val(data.email_image_desciption_text_color);
                $('#preheader_text').val(data.preheader_text);
                $('#action_button_discription').val(data.action_button_discription);
                $('#action_button_discription_color').val(data.action_button_discription_color);
                $('#action_button_bg_color').val(data.action_button_bg_color);
                $('#action_button_link').val(data.action_button_link);
                $('#news_post_link').val(data.news_post_link);
                $('#action_button_customform').val(data.action_button_customform);
                $('#action_button_discription_2').val(data.action_button_discription_2);
                $('#action_button_discription_color_2').val(data.action_button_discription_color_2);
                $('#action_button_bg_color_2').val(data.action_button_bg_color_2);
                $('#action_button_link_2').val(data.action_button_link_2);
                $('#news_post_link_2').val(data.news_post_link_2);
                $('#action_button_customform_2').val(data.action_button_customform_2);

                if (data.action_button_link == 'customforms') {
                    $('#customforms').show();
                    $('#news_post_link').hide();
                    $('#customforms').val(data.action_button_customform);
                } else if (data.action_button_link == 'link') {
                    $('#customforms').hide();
                    $('#news_post_link').show();
                    $('#news_post_link').val(data.action_button_link_text);
                } else {
                    $('#customforms').hide();
                    $('#news_post_link').hide();
                }

                if (data.action_button_link_2 == 'customforms') {
                    $('#customforms2').show();
                    $('#news_post_link_2').hide();
                    $('#customforms2').val(data.action_button_customform_2);
                } else if (data.action_button_link_2 == 'link') {
                    $('#customforms2').hide();
                    $('#news_post_link_2').show();
                    $('#news_post_link_2').val(data.action_button_link_text_2);
                } else {
                    $('#customforms2').hide();
                    $('#news_post_link_2').hide();
                }

                if (data.is_content_title_justified_center == '1') {
                    $('.is_content_title_justified_center').prop('checked', true);
                }

                if (data.is_sub_title_justified_center == '1') {
                    $('.is_sub_title_justified_center').prop('checked', true);
                }

                if (data.is_email_description_center == '1') {
                    $('.is_email_description_center').prop('checked', true);
                }

                if (data.link_social_media_icons == '1') {
                    $('.link_social_media_icons').prop('checked', true);
                }

                if (data.link_social_media_icons == '1') {
                    $('.link_social_media_icons').prop('checked', true);
                }
                if (data.override_generic_settings == '1') {
                    $('.override_generic_settings').prop('checked', true);
                }
                if (data.action_button_active == '1') {
                    $('.action_button_active').prop('checked', true);
                }
                if (data.action_button_active_2 == '1') {
                    $('.action_button_active_2').prop('checked', true);
                }

                if (data.logo_image) {
                    var img_path = "<?= url('assets/uploads') ?>/" + data.logo_image;
                    $('.logo_image_path').val(img_path);
                    $('.logo_img_div').html('<div class="col-md-6 gallery_tile_div2 imgdiv"><img src="' + img_path + '" width="100%"><button type="button" class="btn btn-primary btnimgdel">X</button><input type="hidden" name="gallery_images[]" value="' + img_path + '"></div><br/>');
                    $('.logo_image').val('');
                    $('.logo_image').closest('.uploadImageDiv').find('.imgdiv').html('');
                }
                if (data.email_image) {
                    var img_path = "<?= url('assets/uploads') ?>/" + data.email_image;
                    $('.email_image_path').val(img_path);
                    $('.email_image_div').html('<div class="col-md-6 gallery_tile_div2 imgdiv"><img src="' + img_path + '" width="100%"><button type="button" class="btn btn-primary btnimgdel">X</button><input type="hidden" name="gallery_images[]" value="' + img_path + '"></div><br/>');
                    $('.email_image').val('');
                    $('.email_image').closest('.uploadImageDiv').find('.imgdiv').html('');
                }
                if (data.images.length > 0) {
                    data.images.forEach(function(item) {
                        var img_path = "<?= url('assets/uploads') ?>/" + item.image;
                        $('.gallery_images').append('<div class="col-md-12 imgdiv"><img src="' + img_path + '" width="100%"><button type="button" class="btn btn-primary btnimgdel">X</button><input type="hidden" name="gallery_images[]" value="' + img_path + '"></div><br>');
                    });
                }
            }
        });
    });

    $(document).on('change', '.logo_image', function() {
        $('.logo_image_path').val('');
        $('.logo_img_div').html('');
    });
    $(document).on('change', '.email_image', function() {
        $('.email_image_path').val('');
        $('.email_image_div').html('');
    });

    $(document).on('change', '#override_generic_settings', function() {

        if ($(this).prop('checked') == true) {
            $(".text-properties :input").prop("disabled", false);
        } else {
            $(".text-properties :input").prop("disabled", true);
        }
    });
    $(document).on('change', '.news_post_action_button', function() {
        if ($(this).val() == 'link') {
            $(this).closest('.form-group').find('.news_post_link').show();
            $(this).closest('.form-group').find('.customforms').hide();
            $(this).closest('.form-group').find('.action_address').hide();
        } else if ($(this).val() == 'customforms') {
            $(this).closest('.form-group').find('.customforms').show();
            $(this).closest('.form-group').find('.action_address').hide();
            $(this).closest('.form-group').find('.news_post_link').hide();
        } else if ($(this).val() == 'google_map' || $(this).val() == 'address') {
            $(this).closest('.form-group').find('.customforms').hide();
            $(this).closest('.form-group').find('.news_post_link').hide();
            $(this).closest('.form-group').find('.action_address').show();
        } else {
            $(this).closest('.form-group').find('.news_post_link').hide();
            $(this).closest('.form-group').find('.customforms').hide();
            $(this).closest('.form-group').find('.action_address').hide();
        }
    });

    $(document).on('click', '.btnimgdel', function() {
        $(this).closest('.uploadImageDiv').find('.dataimage').val('');
        $(this).closest('.imgdiv').html('');
    });
    $("#preheader_text_message").hide();
    $("#current_chars").html($(".preheader_text").val().length);
    $(document).on('input', '.preheader_text', function() {
        if ($(this).val() && $(this).val().length < 100) {
            $("#preheader_text_message").show();
            $("#current_chars").html($(this).val().length);
        } else {
            $("#preheader_text_message").hide();
            $("#current_chars").html($(this).val().length);
        }
    });


    var total = 2;

    function addAnotherImage() {
        var newupload = ' <div class="col-md-12" style="margin-top:10px;border-top:2px solid lightgrey;padding-top:10px" id="img-' + total + '" ><button type="button" class="btn btn-info" style="float:right" onclick="removeImageDiv(' + total + ')">Remove</button> <div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">+Image below footer</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"> <input class="dataimage" type="hidden" name="userfilebelowfooter[]"> <div class="col-md-10 imgdiv" style="display:none"> <br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove" >X</button></div></div> </div>';
        $(".img-upload-container-below").append(newupload);
        total++;
        var newupload = ' <div class="col-md-12" style="margin-top:10px;border-top:2px solid lightgrey;padding-top:10px" id="img-' + total + '" ><button type="button" class="btn btn-info" style="float:right" onclick="removeImageDiv(' + total + ')">Remove</button> <div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">+Image above footer</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"> <input class="dataimage" type="hidden" name="userfileabovefooter[]"> <div class="col-md-10 imgdiv" style="display:none"> <br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove" >X</button></div></div> </div>';
        $(".img-upload-container-above").append(newupload);
        total++;
    }

    $('#customFile').on('change', function() {
        imagesPreview(this, '.email_template_images');
    });

    function removeImageDiv(id) {

        if (id != "") {
            $("#img-" + id).remove();
            total--;
        }
    }
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            //$(placeToInsertImagePreview).empty();
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $(placeToInsertImagePreview).append('<img width="100%" src="' + event.target.result + '"><br><br>');
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
</script>
@endsection('content')