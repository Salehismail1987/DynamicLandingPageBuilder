@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Email Post</h1>
        <a href="{{ url('crmcontrols?block=email_management') }}" class="btn btn-info ">
            Back
        </a>
    </div>
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('updateEmailPost') }}/{{$edit_id}}">
        @csrf
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="teaser_title">Teaser Title</label>
                        <input type="text" required class="myinput2" name="teaser_title" id="teaser_title" value="<?= $detail_info->teaser_title ?>" placeholder="Sample Email ">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="content_title">Content Title</label>
                        <input type="text" required class="myinput2" name="content_title" id="content_title" value="<?= $detail_info->content_title ?>" placeholder="Title ">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="logo_text">Logo Text</label>
                        <input type="text" class="myinput2" name="logo_text" id="logo_text" value="<?= $detail_info->logo_text ?>" placeholder="Text Logo ">
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class="form-seperator"></div>
                </div>


                <div class="col-md-4">
                    <label for="logo_image">Upload Logo Image</label>
                    <?php
                    if ($detail_info->logo_image) {
                    ?>
                        <div class="col-md-6 gallery_tile_div2">
                            <img src='<?= url('assets/uploads/' . get_current_url() . $detail_info->logo_image) ?>' width="100%">
                            <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->logo_image ?>','logo_image','gallery_tile_div2','email_posts',<?= $detail_info->id ?>)">X</button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image_size">Image Size</label>
                                <input type="number" name="image_size" class="myinput2" id="image_size" value="{{$detail_info->image_size}}" placeholder="100">
                                <!-- <label>Max Image Size (500px)</label> -->
                            </div>
                        </div>
                        <br />
                    <?php
                    }
                    ?>
                    <div class="uploadImageDiv">
                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload Logo</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="logo_image">

                        <div class="col-md-6 imgdiv" style="display:none">
                            <br>
                            <img src='' width="100%" class="imagefromgallerysrc">
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="bannertext">Is Content Title Justified Centered?</label><br>
                        <label class="switch">
                            <input type="checkbox" class="titleSwitch" name="is_content_title_justified_center" <?php echo $detail_info->is_content_title_justified_center ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <br />
                    <label for="logo_image">Upload Email Image</label>
                    <?php
                    if ($detail_info->email_image) {
                    ?>
                        <div class="col-md-6 gallery_tile_div">
                            <img src='<?= url('assets/uploads/' . get_current_url() . $detail_info->email_image) ?>' width="100%">
                            <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->email_image ?>','email_image','gallery_tile_div','email_posts',<?= $detail_info->id ?>)">X</button>
                        </div>
                    <?php
                    }
                    ?>
                    <br />

                    <div class="uploadImageDiv">
                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload Image</button>
                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                        <input class="dataimage" type="hidden" name="email_image">

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
                        <textarea rows="4" class="myinput2 editordata hidden" style="display:none" name="description_text" id="description_text" placeholder="Describe this email. "><?= $detail_info->description_text ?></textarea>
                        <div class="quilleditor">
                            <?= $detail_info->description_text ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mb-3">
                <div class='col-md-12'>
                    <div class="form-seperator"></div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subtitle">Sub-Title</label>
                        <input type="text" required class="myinput2" name="subtitle" id="subtitle" value="<?= $detail_info->subtitle ?>" placeholder="Sub-Title ">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="notes">Admin's Note</label>
                        <textarea rows="4" class="myinput2" name="notes" id="notes" placeholder="Note "><?= $detail_info->notes ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bannertext">Is Sub Title Justified Centered?</label><br>
                        <label class="switch">
                            <input type="checkbox" class="titleSwitch" name="is_sub_title_justified_center" <?php echo $detail_info->is_sub_title_justified_center ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bannertext">Is Description Text jusitfied?</label><br>
                        <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="is_email_description_center" <?php echo $detail_info->is_email_description_center ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bannertext">Link Social Media Icons?</label><br>
                        <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="link_social_media_icons" <?php echo $detail_info->link_social_media_icons ? 'checked' : '' ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
            <?php $total = 1; ?>
            <div class="row mt-3">
                <div class="col-md-6 img-upload-container-above" style="margin-bottom: 15px;">
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
                <div class="col-md-6 img-upload-container-below" style="margin-bottom: 15px;">
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
                <div class="row">
                    <?php if ($images) { ?>
                        <?php foreach ($images as $image) { ?>
                            <div class="col-md-4 imgdiv">
                                <img src='<?= base_url("assets/uploads/" . get_current_url() . $image->image) ?>' width="100%">
                                <button type="button" class="btn btn-primary btnimgdel" onclick="delEmailPostImage($image->id)" data-imgid="<?= $image->id ?>">X</button>
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
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <button type="button" class="btn btn-info" onclick="addAnotherImage()">+ Upload Another Image</button>
                    </center>
                </div>
            </div>
            <br />
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
                                    <input type="checkbox" title="If turned onn, below settings will override the generic settings." class="notificationswitch" id="override_generic_settings" name="override_generic_settings" <?php echo $detail_info->override_generic_settings ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row text-properties">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logo_title_font_family">Logo Title Font</label>
                                <select class="myinput2" name="logo_title_font_family" id="logo_title_font_family">
                                    <?php if (count($font_family) > 0) { ?>
                                        <?php foreach ($font_family as $single) { ?>
                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->logo_title_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logo_title_text_size">Logo Title Text Size</label><br />
                                <input type="text" class="myinput2 width-50px" name="logo_title_text_size" id="logo_title_text_size" value="<?= $detail_info->logo_title_text_size ?>" placeholder="24 ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logo_title_text_color">Logo Title Text Color</label>
                                <input type="color" class="myinput2" name="logo_title_text_color" id="logo_title_text_color" value="<?= $detail_info->logo_title_text_color ?>" placeholder="#ffff ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_title_font_family">Content Title Font</label>
                                <select class="myinput2" name="content_title_font_family" id="content_title_font_family">
                                    <?php if (count($font_family) > 0) { ?>
                                        <?php foreach ($font_family as $single) { ?>
                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>"
                                                <?= $detail_info->content_title_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_title_text_size">Content Title Text Size</label><br />
                                <input type="text" class="myinput2 width-50px" name="content_title_text_size" id="content_title_text_size" value="<?= $detail_info->content_title_text_size ?>" placeholder="24 ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_title_text_color">Content Title Text Color</label>
                                <input type="color" class="myinput2" name="content_title_text_color" id="content_title_text_color" value="<?= $detail_info->content_title_text_color ?>" placeholder="#ffff ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subtitle_font_family">Sub-Title Font</label>
                                <select class="myinput2" name="subtitle_font_family" id="subtitle_font_family">
                                    <?php if (count($font_family) > 0) { ?>
                                        <?php foreach ($font_family as $single) { ?>
                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->subtitle_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subtitle_text_size">Sub-Title Text Size</label><br />
                                <input type="text" class="myinput2 width-50px" name="subtitle_text_size" id="subtitle_text_size" value="<?= $detail_info->subtitle_text_size ?>" placeholder="24 ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subtitle_text_color">Sub-Title Text Color</label>
                                <input type="color" class="myinput2" name="subtitle_text_color" id="subtitle_text_color" value="<?= $detail_info->subtitle_text_color ?>" placeholder="#ffff ">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_image_desciption_font_family">Description Font</label>
                                <select class="myinput2" name="email_image_desciption_font_family" id="email_image_desciption_font_family">
                                    <?php if (count($font_family) > 0) { ?>
                                        <?php foreach ($font_family as $single) { ?>
                                            <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $detail_info->email_image_desciption_font_family == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_image_desciption_text_size">Description Text Size</label><br />
                                <input type="text" class="myinput2 width-50px" name="email_image_desciption_text_size" id="email_image_desciption_text_size" value="<?= $detail_info->email_image_desciption_text_size ?>" placeholder="24">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_image_desciption_text_color">Description Text Color</label>
                                <input type="color" required class="myinput2" name="email_image_desciption_text_color" id="email_image_desciption_text_color" value="<?= $detail_info->email_image_desciption_text_color ?>" placeholder="#fff">
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
                                <textarea rows="3" class="myinput2 preheader_text" name="preheader_text" id="preheader_text" placeholder="Enter prehead text"><?= $detail_info->preheader_text ?></textarea>
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
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="bannertext">Action button active</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="action_button_active" <?= $detail_info->action_button_active ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_discription">Action Button Name</label>
                                <input type="text" class="myinput2" name="action_button_discription" id="action_button_discription" value="<?= $detail_info->action_button_discription ?>" placeholder="Type here...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_discription_color">Action Button Text Color</label>
                                <input type="color" class="myinput2" name="action_button_discription_color" id="action_button_discription_color" value="<?= $detail_info->action_button_discription_color ?>" placeholder="#ffffff">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_bg_color">Action Button Color</label>
                                <input type="color" class="myinput2" name="action_button_bg_color" id="action_button_bg_color" value="<?= $detail_info->action_button_bg_color ?>" placeholder="#000000">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_link">Action Button Application</label>
                                <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="action_button_link">
                                    <option value="link" <?= $detail_info->action_button_link == 'link' ? 'selected' : '' ?>>Link to Outside Site</option>
                                    <option value="call" <?= $detail_info->action_button_link == 'call' ? 'selected' : '' ?>>Call</option>
                                    <option value="sms" <?= $detail_info->action_button_link == 'sms' ? 'selected' : '' ?>>SMS Text</option>
                                    <option value="email" <?= $detail_info->action_button_link == 'email' ? 'selected' : '' ?>>Email</option>
                                    <option value="address" <?= $detail_info->action_button_link == 'address' ? 'selected' : '' ?>>Business Address</option>
                                    <option value="customforms" <?= $detail_info->action_button_link == 'customforms' ? 'selected' : '' ?>>Link to Form</option>
                                    <option value="image_popup" <?= $detail_info->action_button_link == 'image_popup' ? 'selected' : '' ?>>Popup - Image</option>
                                    <option value="text_popup" <?= $detail_info->action_button_link == 'text_popup' ? 'selected' : '' ?>>Popup - Text</option>
                                    <option value="video" <?= $detail_info->action_button_link == 'video' ? 'selected' : '' ?>>Popup - Video</option>
                                    <option value="stripe" <?= $detail_info->action_button_link == 'stripe' ? 'selected' : '' ?>>Popup - Payment</option>
                                    <option value="audioiconfeature" <?= $detail_info->action_button_link == 'audioiconfeature' ? 'selected' : '' ?>>Audio File with Icon</option>
                                    <option value="google_map" <?= $detail_info->action_button_link == 'google_map' ? 'selected' : '' ?>>Map</option>
                                    <?php foreach ($front_sections as $single) { ?>
                                        <option value="<?= $single->slug ?>" <?= $detail_info->action_button_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->action_button_link == 'call' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for calls</label>
                                <input type="text" class="myinput2" name="action_button_phone_no_calls" value="<?= $detail_info->action_button_phone_no_calls ?>">
                            </div>
                            <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->action_button_link == 'sms' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for sms</label>
                                <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                            </div>
                            <div class="form-group action_fields action_email" style="<?= $detail_info->action_button_link == 'email' ? 'display:block' : 'display:none' ?>">
                                <label for="">Email</label>
                                <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                            </div>

                            <div class="form-group action_fields action_link" style="<?= $detail_info->action_button_link == 'link' ? 'display:block' : 'display:none' ?>">
                                <input type="text" class="myinput2 news_post_link" name="action_button_link_text" id="news_post_link" value="<?= $detail_info->action_button_link_text ?>" placeholder="http://google.com">
                            </div>
                            <div class="form-group action_fields action_forms" style="<?= $detail_info->action_button_link == 'customforms' ? 'display:block' : 'display:none' ?>">
                                <select class="myinput2 customforms" name="action_button_customform">
                                    <?php if (count($custom_forms) > 0) { ?>
                                        <?php foreach ($custom_forms as $single) { ?>
                                            <option value="<?= $single->id ?>" <?= $detail_info->action_button_customform == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields action_event_forms" style="<?= $detail_info->action_button_link == 'attendhub' ? 'display:block' : 'display:none' ?>">
                                <select class="myinput2" name="action_button_event_form" id="customforms">
                                    <?php if (count($event_forms) > 0) { ?>
                                        <?php foreach ($event_forms as $singlecf) { ?>
                                            <option value="<?= $singlecf->id ?>" <?= isset($detail_info->action_button_event_form) && $detail_info->action_button_event_form == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields video_upload" name="action_button_video1" style="<?= $detail_info->action_button_link == 'video' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Upload Video</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                        accept=".mp4">
                                    <label class="custom-file-label" for="customFile">Upload Video</label>
                                </div>
                                @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                                <div class=" position-relative d-flex email_post_action_button_1">
                                    <video height="80" controls>
                                        <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($detail_info->action_button_video)) : '' ?>" type="video/mp4">
                                    </video>
                                    <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='email_post_action_button_1' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class=" action_fields action_map" style="<?= $detail_info->action_button_link == 'google_map' ? 'display:block' : 'display:none' ?>">
                                <div class="form-group ">
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="action_button_map_address" value="<?= isset($detail_info->action_button_map_address) && $detail_info->action_button_map_address ? $detail_info->action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                </div>
                            </div>
                            <div class="form-group action_fields action_address" style="<?= $detail_info->action_button_link == 'address'  ? 'display:block' : 'display:none' ?>">
                                <label>Select an Address</label>
                                <select name="action_button_address_id" class="myinput2">
                                    <?php foreach ($addresses as $address) { ?>
                                        <option value="<?= $address->id ?>" <?= $detail_info->action_button_address_id == $address->id ? 'selected' : '' ?>> <?= $address->address_title ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="bannertext">Action button active</label><br>
                                <label class="switch">
                                    <input type="checkbox" class="notificationswitch" name="action_button_active_2" <?= $detail_info->action_button_active_2 ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_discription_2">Action Button Name</label>
                                <input type="text" class="myinput2" name="action_button_discription_2" id="action_button_discription_2" value="<?= $detail_info->action_button_discription_2 ?>" placeholder="Type here...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_discription_color_2">Action Button Text Color</label>
                                <input type="color" class="myinput2" name="action_button_discription_color_2" id="action_button_discription_color_2" value="<?= $detail_info->action_button_discription_color_2 ?>" placeholder="#ffffff">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_bg_color_2">Action Button Color</label>
                                <input type="color" class="myinput2" name="action_button_bg_color_2" id="action_button_bg_color_2" value="<?= $detail_info->action_button_bg_color_2 ?>" placeholder="#000000">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="action_button_link_2">Action Button Application</label>
                                <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link_2" name="action_button_link_2">
                                    <option value="link" <?= $detail_info->action_button_link_2 == 'link' ? 'selected' : '' ?>>Link to Outside Site</option>
                                    <option value="call" <?= $detail_info->action_button_link_2 == 'call' ? 'selected' : '' ?>>Call</option>
                                    <option value="sms" <?= $detail_info->action_button_link_2 == 'sms' ? 'selected' : '' ?>>SMS Text</option>
                                    <option value="email" <?= $detail_info->action_button_link_2 == 'email' ? 'selected' : '' ?>>Email</option>
                                    <option value="address" <?= $detail_info->action_button_link_2 == 'address' ? 'selected' : '' ?>>Business Address</option>
                                    <option value="customforms" <?= $detail_info->action_button_link_2 == 'customforms' ? 'selected' : '' ?>>Link to Form</option>
                                    <option value="image_popup" <?= $detail_info->action_button_link_2 == 'image_popup' ? 'selected' : '' ?>>Popup - Image</option>
                                    <option value="text_popup" <?= $detail_info->action_button_link_2 == 'text_popup' ? 'selected' : '' ?>>Popup - Text</option>
                                    <option value="video" <?= $detail_info->action_button_link_2 == 'video' ? 'selected' : '' ?>>Popup - Video</option>
                                    <option value="stripe" <?= $detail_info->action_button_link_2 == 'stripe' ? 'selected' : '' ?>>Popup - Payment</option>
                                    <option value="audioiconfeature" <?= $detail_info->action_button_link_2 == 'audioiconfeature' ? 'selected' : '' ?>>Audio File with Icon</option>
                                    <option value="google_map" <?= $detail_info->action_button_link_2 == 'google_map' ? 'selected' : '' ?>>Map</option>
                                    <?php foreach ($front_sections as $single) { ?>
                                        <option value="<?= $single->slug ?>" <?= $detail_info->action_button_link_2 == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->action_button_link_2 == 'call' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for calls</label>
                                <input type="text" class="myinput2" name="action_button_phone_no_calls_2" value="<?= $detail_info->action_button_phone_no_calls_2 ?>">
                            </div>
                            <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->action_button_link_2 == 'sms' ? 'display:block' : 'display:none' ?>">
                                <label for="">Phone number for sms</label>
                                <input type="text" class="myinput2" name="action_button_phone_no_sms_2" value="<?= $detail_info->action_button_phone_no_sms_2 ?>">
                            </div>
                            <div class="form-group action_fields action_email" style="<?= $detail_info->action_button_link_2 == 'email' ? 'display:block' : 'display:none' ?>">
                                <label for="">Email</label>
                                <input type="text" class="myinput2" name="action_button_action_email_2" value="<?= $detail_info->action_button_action_email_2 ?>">
                            </div>

                            <div class="form-group action_fields action_link" style="<?= $detail_info->action_button_link_2 == 'link' ? 'display:block' : 'display:none' ?>">
                                <input type="text" class="myinput2 news_post_link" name="action_button_link_text_2" id="news_post_link" value="<?= $detail_info->action_button_link_text_2 ?>" placeholder="http://google.com">
                            </div>
                            <div class="form-group action_fields action_forms" style="<?= $detail_info->action_button_link_2 == 'customforms' ? 'display:block' : 'display:none' ?>">
                                <select class="myinput2 customforms" name="action_button_customform_2">
                                    <?php if (count($custom_forms) > 0) { ?>
                                        <?php foreach ($custom_forms as $single) { ?>
                                            <option value="<?= $single->id ?>" <?= $detail_info->action_button_customform_2 == $single->id ? 'selected' : '' ?>><?= $single->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields action_event_forms" style="<?= $detail_info->action_button_link_2 == 'attendhub' ? 'display:block' : 'display:none' ?>">
                                <select class="myinput2" name="action_button_event_form2" id="customforms">
                                    <?php if (count($event_forms) > 0) { ?>
                                        <?php foreach ($event_forms as $singlecf) { ?>
                                            <option value="<?= $singlecf->id ?>" <?= isset($detail_info->action_button_event_form2) && $detail_info->action_button_event_form2 == $singlecf->id ? 'selected' : '' ?>><?= $singlecf->title ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group action_fields video_upload" name="action_button_video2" style="<?= $detail_info->action_button_link_2 == 'video' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Upload Video</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="action_button_video_2" id="customFile"
                                        accept=".mp4">
                                    <label class="custom-file-label" for="customFile">Upload Video</label>
                                </div>
                                @if(isset($detail_info->action_button_video_2) && $detail_info->action_button_video_2 !='')
                                <div class=" position-relative d-flex email_post_action_button_2">
                                    <video height="80" controls>
                                        <source src="<?= isset($detail_info->action_button_video_2) ? base_url('assets/uploads/' . get_current_url() . ($detail_info->action_button_video_2)) : '' ?>" type="video/mp4">
                                    </video>
                                    <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='email_post_action_button_2' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video_2}}">X
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class=" action_fields action_map" style="<?= $detail_info->action_button_link_2 == 'google_map' ? 'display:block' : 'display:none' ?>">
                                <div class="form-group ">
                                    <label for="address">Enter Address</label>
                                    <input type="text" class="myinput2 " name="action_button_map_address_2" value="<?= isset($detail_info->action_button_map_address_2) && $detail_info->action_button_map_address_2 ? $detail_info->action_button_map_address_2 : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                </div>
                            </div>
                            <div class="form-group" style="display:<?= $detail_info->action_button_link_2 == 'address'  ? 'block' : 'none' ?>">
                                <label>Select an Address</label>
                                <select name="action_button_address_id_2" class="myinput2">
                                    <?php foreach ($addresses as $address) { ?>
                                        <option value="<?= $address->id ?>" <?= $detail_info->action_button_address_id_2 == $address->id ? 'selected' : '' ?>> <?= $address->address_title ?> </option>
                                    <?php } ?>
                                </select>
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

    $("#preheader_text_message").hide();
    $("#current_chars").html($(".preheader_text").val().length);
    if ('<?= $detail_info->preheader_text ?>' != "" && '<?= $detail_info->preheader_text ?>'.length < 100) {
        $("#preheader_text_message").show();
        $("#current_chars").html('<?= $detail_info->preheader_text ?>'.length);
    }
    $(document).on('input', '.preheader_text', function() {
        if ($(this).val() && $(this).val().length < 100) {
            $("#preheader_text_message").show();
            $("#current_chars").html($(this).val().length);
        } else {
            $("#preheader_text_message").hide();
            $("#current_chars").html($(this).val().length);
        }
    });

    $(document).ready(function() {
        checkSeeTips(sub_sections);
        var is_disabled = isTipsDisabled('edit_email_template');

        if (is_disabled) {
            $("input[name='tippopups']").prop('checked', true);
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

    function removeImageDiv(id) {

        if (id != "") {
            $("#img-" + id).remove();
            total--;
        }
    }

    $(document).on('click', '.btnimgdel', function() {
        var imgid = $(this).data('imgid');
        $(this).closest('.imgdiv').remove();
        if (imgid) {
            $.ajax({
                url: '<?= url('admin/emailpost/delimage'); ?>',
                type: "POST",
                data: {
                    'imgid': imgid,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {}
            });
        }
    });

    $('#customFile').on('change', function() {
        imagesPreview(this, '.news_feed_images');
    });

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