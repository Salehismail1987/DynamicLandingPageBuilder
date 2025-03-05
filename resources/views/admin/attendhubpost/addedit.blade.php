@extends('admin.layout.dashboard')
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= strtoupper($formAction) ?> Event Form</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('attendhub?block=event_forms_list') }}" class="btn btn-info ">
                    Back
                </a>
            </li>
        </ol>
    </div>

    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('saveform')}}">
        @csrf
        <input type="hidden" name="formAction" value="{{$formAction}}">
        <input type="hidden" name="formid" value="{{isset($detail_info)?$detail_info->id:''}}">
        <input type="hidden" name="source" value="attendhub">
        <div class="row">
            <div class="col-lg-6">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><?= strtoupper($formAction) ?> Form</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label> <span class="ml-3" style="color: red;">This field can not be edited.</span>
                            <input type="text" name="title" class="myinput2" disabled id="title" value="<?php if (isset($detail_info)) echo $detail_info->title; ?>" placeholder="Title" required>
                            <input type="hidden" name="title" class="myinput2" id="title" value="<?php if (isset($detail_info)) echo $detail_info->title; ?>" placeholder="Title" required>
                           
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" name="subtitle" class="myinput2" id="subtitle" value="<?php if (isset($detail_info)) echo $detail_info->subtitle; ?>" placeholder="Subtitle">
                        </div>
                        <input type="hidden" name="formAction" value="<?php if (isset($formAction)) echo $formAction; ?>">
                        <input type="hidden" name="duplicateImge" value="<?php if (isset($detail_info) && $detail_info->image)  echo  $detail_info->image; ?>">
                        <div class="form-group">
                            <label for="descriptive">Descriptive Text</label>
                            <textarea name="descriptive" class="myinput2" id="descriptive" rows="4" required><?php if (isset($detail_info)) echo $detail_info->descriptive; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="footer_text_1">Footer text 1</label>
                            <input type="text" name="footer_text_1" class="myinput2" id="footer_text_1" value="<?php if (isset($detail_info)) echo $detail_info->footer_text_1; ?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="footer_text_2">Footer text 2</label>
                            <input type="text" name="footer_text_2" class="myinput2" id="footer_text_2" value="<?php if (isset($detail_info)) echo $detail_info->footer_text_2; ?>" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                    </div>
                    <div class="card-body">
                        <div class="uploadImageDiv">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="userfile">

                            <div class="col-md-6 imgdiv" style="display:none">
                                <br>
                                <img src='' width="100%" class="imagefromgallerysrc">
                                <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                            </div>
                        </div>
                        <center>
                            <?php
                            if (isset($detail_info) && $detail_info->image) {
                            ?>
                                <div class="col-md-6 blog_img_div">
                                    <img src='<?= base_url('assets/uploads/' . get_current_url() . $detail_info->image) ?>' width="100%">
                                    <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $detail_info->image ?>','image','blog_img_div','custom_forms',<?= $detail_info->id ?>)">X</button>
                                </div>
                            <?php
                            }
                            ?>
                        </center>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_size">Image Size</label>
                                    <input type="text" name="image_size" class="myinput2" id="image_size" value="<?php if (isset($detail_info)) echo $detail_info->image_size; ?>" placeholder="200">
                                    <label>Max Image Size (400px)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div style="position: absolute;" class=" ">
                            <div id="popUpRatingModal" tabindex="-1" aria-labelledby="popUpRatingModal"
                                class="modal fade " style="position: relative; width: 245px;"
                                aria-modal="true" role="dialog">
                                <div class="modal-dialog my-modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 pb-2 pl-2 pr-2">
                                                    <label class="title-8 mt-2">Reviews Filter Notes: <button type="button"
                                                            data-dismiss="modal" aria-label="Close" class="btn-close my-modal-close"> <i class="fa fa-close"></i></button></label> <br>
                                                    <label class="line-height-18px">
                                                        Select the min. rating desired (5 or 4)
                                                        <br> <br>
                                                        Customer reviews with min rating recieve popup to outside sites
                                                        <br> <br>
                                                        Outside review site links are inputted in the Review Filter feature in the Edit Frontend
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="enablesortingdiv">
                                    <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="bannertext">Turn on All</label>
                                    <br>
                                    <label for="bannertext"> Show all on form?</label>
                                    <br>
                                    <label class="switch">
                                        <input type="checkbox" name="" value="1" class="formcheckall" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="singlecontactform">

                            @php
                            $combinedItems = [];
                            if(isset($detail_info->fields))
                            {
                            $fields = json_decode($detail_info->fields, true); // Convert JSON to associative array
                            $fields = array_map("unserialize", array_unique(array_map("serialize", $fields)));
                            $fields = array_values($fields);
                            $buttons = $detail_info->actionButtons->sortBy('order')->toArray(); // Sort buttons by 'order'
                            // Add 'order' key to each field
                            foreach ($fields as $index => $field) {
                            $field['order'] = isset($field['order'])?$field['order']:''; // or use existing order if available
                            $field['type'] = 'field';
                            $combinedItems[] = $field;
                            }
                            }

                            if(isset($buttons))
                            {
                            // Add 'order' key to each button
                            foreach ($buttons as $index => $button) {
                            $button['order'] = $button['order']; // or use existing order if available
                            $button['type'] = 'button';
                            $combinedItems[] = $button;
                            }
                            }

                            // Sort combined items by 'order'
                            usort($combinedItems, function ($a, $b) {
                            return $a['order'] <=> $b['order'];
                                });
                                @endphp

                                <table class="w-100">
                                    <tbody class="confactformfielddiv">
                                        <?php $formFieldNumber = 0;
                                        $i = 0;
                                        if (isset($detail_info) && $detail_info->fields) { ?>
                                            
                                            <?php foreach ($combinedItems as $sngl) { 
                                                if($sngl['fieldname'] == 'hidden')
                                                { ?>
                                                    <input type="hidden" class="hidden text-class" value="event_form" type="hidden" name="hidden"> 
                                                <?php
                                                continue;
                                                }
                                                ?>
                                                @if ($sngl['type'] === 'field')
                                                <tr data-type="{{ $sngl['type'] }}" data-id="{{$detail_info->id}}" data-name="{{$sngl['fieldname']}}" data-fieldtype="{{$sngl['fieldtype']}}">
                                                    <td>
                                                        <div class="singlefield">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group"><label>Field Name</label>
                                                                        <input type="hidden" name="field_id[]" value="{{$i}}">
                                                                        <input type="text" class="myinput2 fieldname <?= $sngl['fieldtype'] == 'image' ? 'hidden' : '' ?>" name="fieldname[<?= $formFieldNumber ?>]" value="<?= $sngl['fieldname'] ?>" placeholder="Field name" <?php if ($detail_info->static_form == '1' && ( ($detail_info->id == '8' && $i < 3)||($detail_info->id == '7' && ($sngl['fieldname'] == 'Email') || ($sngl['fieldname'] == 'Full name') )) ) {
                                                                                                                                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                                                                                                                                } ?>>
                                                                    </div>
                                                                    <?php if ($i != 2 && $i != 6): ?>
                                                                    <div class="form-group"><label>Column Label</label>
                                                                        <input type="text" class="myinput2 fieldname <?= $sngl['fieldtype'] == 'image' ? 'hidden' : '' ?>" name="columnLabel[<?= $formFieldNumber ?>]" value="<?= $sngl['column_label'] ?? '' ?>" placeholder="Field name">
                                                                        </div>
                                                                        <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group"><label>Field type</label>
                                                                        <select class="myinput2 fieldtype" name="fieldtype[<?= $formFieldNumber ?>]" <?php if ($detail_info->static_form == '1' && ($detail_info->id == '8' && $i < 3)||($detail_info->id == '7' && ($sngl['fieldname'] == 'Email') || ($sngl['fieldname'] == 'Full name') )) {
                                                                                                                                                            echo 'disabled';
                                                                                                                                                        } ?> data-formfieldno="<?= $formFieldNumber ?>">
                                                                            <option value="text" <?= $sngl['fieldtype'] == 'text' ? 'selected' : '' ?>>Text</option>
                                                                            <option value="textarea" <?= $sngl['fieldtype'] == 'textarea' ? 'selected' : '' ?>>Text Area</option>
                                                                            <option value="radio" <?= $sngl['fieldtype'] == 'radio' ? 'selected' : '' ?>>Radio</option>
                                                                            <option value="checkbox" <?= $sngl['fieldtype'] == 'checkbox' ? 'selected' : '' ?>>Checkbox</option>
                                                                            <option value="select" <?= $sngl['fieldtype'] == 'select' ? 'selected' : '' ?>>Select</option>
                                                                            <option value="multiselect" <?= $sngl['fieldtype'] == 'multiselect' ? 'selected' : '' ?>>Multi-Select</option>
                                                                            <option value="date" <?= $sngl['fieldtype'] == 'date' ? 'selected' : '' ?>>Date</option>
                                                                            <option value="time" <?= $sngl['fieldtype'] == 'time' ? 'selected' : '' ?>>Time</option>
                                                                            <option value="file" <?= $sngl['fieldtype'] == 'file' ? 'selected' : '' ?>>File Upload</option>
                                                                            <option value="image" <?= $sngl['fieldtype'] == 'image' ? 'selected' : '' ?>>Image</option>
                                                                            <option value="5_star_min" <?= $sngl['fieldtype'] == '5_star_min' ? 'selected' : '' ?>>Review 5-Star min</option>
                                                                            <option value="4_star_min" <?= $sngl['fieldtype'] == '4_star_min' ? 'selected' : '' ?>>Review 4-Star min</option>
                                                                            <option value="comment_only" <?= $sngl['fieldtype'] == 'comment_only' ? 'selected' : '' ?>>Comment Only</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 d-flex">
                                                                    <div class="form-group formtoggle">
                                                                        <?php if ($detail_info->id != '7' && ($detail_info->id != '8' || $i >= 3)) { ?>
                                                                            <label for="bannertext"> Show all on form?</label>
                                                                            <br>
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="formenable[<?= $formFieldNumber ?>]" <?= isset($sngl['formenable']) && $sngl['formenable'] ? 'checked' : 'checked' ?> value="1">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group ml-3 requiredtoggle">
                                                                        <?php if ($detail_info->id != '7' && ($detail_info->id != '8' || $i >= 3)) { ?>
                                                                            <label for="bannertext"> Required field?</label>
                                                                            <br>
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="required[<?= $formFieldNumber ?>]" <?= $sngl['required'] ? 'checked' : '' ?> value="1">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        <?php } else { ?>
                                                                            <?= $sngl['required'] ? '<br><label for="bannertext">Required</label>' : '' ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group ml-3 responsetoggle">
                                                                        <?php if ($detail_info->id != '7' && ($detail_info->id != '8' || $i >= 3)) { ?>
                                                                            <label for="bannertext"> Response Report?</label>
                                                                            <br>
                                                                            <label class="switch">
                                                                                <input type="checkbox" name="show_response[<?= $formFieldNumber ?>]" <?= isset($sngl['show_response']) && $sngl['show_response'] ? 'checked' : '' ?> value="1">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php if (($detail_info->id != '7' && ($detail_info->id == '8' || $i >= 3))||($detail_info->id == '7' && ($sngl['fieldname'] != 'Email') && ($sngl['fieldname'] != 'Full name') )) { ?>
                                                                    <div class="col-md-1">
                                                                        <br>
                                                                        <button type="button" @if($disable_remove_button) disabled @endif class="btn btn-primary btnremovecantactformfield">X</button>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="subfieldsdiv">
                                                                <?php
                                                                $opfieldno = 0;
                                                              
                                                                if ($sngl['fieldtype'] == 'radio' || $sngl['fieldtype'] == 'checkbox' || $sngl['fieldtype'] == 'select' || $sngl['fieldtype'] == 'multiselect') { ?>
                                                                    <div class="subfields">
                                                                        <?php if (isset($sngl['options']) && is_array($sngl['options'])) {  ?>
                                                                            <?php foreach ($sngl['options'] as $singleop) { //print_r($singleop);
                                                                            ?>
                                                                                <div class="row">
                                                                                    <div class="col-md-1"></div>
                                                                                    <div class="col-md-2">
                                                                                        <div class="form-group">
                                                                                            <label for="bannertext"> Is this an Other Field?</label><br><label class="switch">
                                                                                                <input type="checkbox" name="otherfield[<?= $formFieldNumber ?>][<?= $opfieldno ?>]" value="1" <?= isset($singleop['otherfield']) && $singleop['otherfield'] == '1' ? 'checked' : '' ?>>
                                                                                                <span class="slider round"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <div class="form-group">
                                                                                            <label>Option name</label>
                                                                                            <input type="text" class="myinput2" name="oprtionname[<?= $formFieldNumber ?>][]" value="<?= isset($singleop['option_name']) ? $singleop['option_name'] : $singleop ?>" placeholder="Option name" <?php if ($detail_info->static_form == '1' && ($detail_info->id == '7' || $detail_info->id == '8' && $i < 3)) {
                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                } ?>>
                                                                                        </div>
                                                                                    </div>

                                                                                    <?php if ($detail_info->id != '7' && ($detail_info->id != '8' || $i >= 3)) { ?>
                                                                                        <div class="col-md-2">
                                                                                            <br>
                                                                                            <button type="button" class="btn btn-primary btnremovecantactformoption">X</button>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            <?php $opfieldno++;
                                                                            } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <?php if ($detail_info->id != '7' && ($detail_info->id != '8' || $i >= 3)) { ?>
                                                                        <button type="button" class="btn btn-primary btnaddnewoption" data-fieldid="<?= $formFieldNumber ?>" data-opfieldno="<?= $opfieldno ?>">Add New Option</button><br><br>
                                                                    <?php } ?>
                                                                <?php } else if ($sngl['fieldtype'] == 'image') { ?>
                                                                    <div class="uploadImageDiv">
                                                                        <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                                                        <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                                        <input class="dataimage" type="hidden" name="qimg[<?= $formFieldNumber ?>]">
                                                                        <input class="" type="hidden" name="image_name[<?= $formFieldNumber ?>]" value="<?= isset($sngl['image']) ? $sngl['image'] : '' ?>">
                                                                        <div class="col-md-6 imgdiv">
                                                                            <br>
                                                                            <img src="<?= isset($sngl->image) ? base_url('assets/uploads/' . get_current_url() . $sngl['image']) : '' ?>" width="100%" class="imagefromgallerysrc">
                                                                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Image Description</label>
                                                                        <textarea name="image_desc[<?= $formFieldNumber ?>]" class="myinput2 image_desc"><?= isset($sngl['image_desc']) ? $sngl['image_desc'] : '' ?></textarea>
                                                                    </div>
                                                                <?php } else if ($sngl['fieldtype'] == 'comment_only') { ?>
                                                                    <textarea name="comment_desc[<?= $formFieldNumber ?>]" class="myinput2" rows="3" placeholder="Desc...."><?= isset($sngl['comment_desc']) ? $sngl['comment_desc'] : '' ?></textarea>
                                                                <?php } else if ($sngl['fieldtype'] == '5_star_min') { ?>
                                                                    <div class="subfields">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label>Select your rating</label><br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="5">
                                                                                <label class="text-black">5-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="4">
                                                                                <label class="text-black">4-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="3">
                                                                                <label class="text-black">3-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="2">
                                                                                <label class="text-black">2-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="1">
                                                                                <label class="text-black">1-Star Rating</label>
                                                                            </div>

                                                                            <div class="col-md-12 mt-2">
                                                                                <label>Post your review</label><br>
                                                                                <textarea name="customer_review_text[<?= $formFieldNumber ?>]" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly>
                                                                        <?= isset($sngl->customer_review_text) ? $sngl->customer_review_text : '' ?>
                                                                        </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } else if ($sngl['fieldtype'] == '4_star_min') { ?>
                                                                    <div class="subfields">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <label>Select your rating</label><br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="5">
                                                                                <label class="text-black">5-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="4">
                                                                                <label class="text-black">4-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="3">
                                                                                <label class="text-black">3-Star Rating</label>
                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="2">
                                                                                <label class="text-black">2-Star Rating</label>

                                                                                <br>
                                                                                <input type="radio" disabled name="rating[<? $formFieldNumber ?>]" value="1">
                                                                                <label class="text-black">1-Star Rating</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <label>Post your review</label><br>
                                                                            <textarea name="customer_review_text[<?= $formFieldNumber ?>]" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly>
                                                                        <?= isset($sngl['customer_review_text']) ? $sngl['customer_review_text'] : '' ?>
                                                                        </textarea>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        <?php } ?>
                                                        </div>
                        </div>
                        <input class="formfieldno" type="hidden" name="formfieldno[]" value="<?= $formFieldNumber ?>">
                        </td>
                        </tr>
                        @elseif($sngl['type'] === 'button')

                        <tr data-type="{{ $sngl['type'] }}" data-id="{{$sngl['id']}}">
                            <td>
                                <input type="hidden" name="slug[]" value="{{$sngl['slug']}}">
                                <input type="hidden" name="btn_id[]" value="{{$sngl['id']}}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="action_button_discription">Action Button Name</label>
                                            <input type="text" class="myinput2" name="action_button_description[]" id="action_button_discription" value="{{$sngl['text']}}" placeholder="Type here...">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="action_button_discription_color">Action Button Text Color</label>
                                            <input type="color" class="myinput2" name="action_button_description_color[]" id="action_button_discription_color" value="{{isset($sngl['text_color']) ? $sngl['text_color'] : "#ffffff"}}" placeholder="#ffffff">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="action_button_bg_color">Action Button Color</label>
                                            <input type="color" class="myinput2" name="action_button_bg_color[]" id="action_button_bg_color" value="{{$sngl['bg_color']}}" placeholder="#000000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="action_button_link">Action Button Application</label>
                                            <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link" name="action_button_link[]">
                                                <option value="link" <?= $sngl['action_type'] == 'link' ? 'selected' : '' ?>>Link</option>
                                                <option value="call" <?= $sngl['action_type'] == 'call' ? 'selected' : '' ?>>Call</option>
                                                <option value="sms" <?= $sngl['action_type'] == 'sms' ? 'selected' : '' ?>>SMS</option>
                                                <option value="email" <?= $sngl['action_type'] == 'email' ? 'selected' : '' ?>>Email</option>
                                                <option value="address" <?= $sngl['action_type'] == 'address' ? 'selected' : '' ?>>Address</option>
                                                <option value="video" <?= $sngl['action_type'] == 'video' ? 'selected' : '' ?>>Video</option>
                                                <option value="audioiconfeature" <?= $sngl['action_type'] == 'audioiconfeature' ? 'selected' : '' ?>>Audio Icon Feature</option>
                                                <option value="google_map" <?= $sngl['action_type'] == 'google_map' ? 'selected' : '' ?>>Map</option>
                                                <option value="text_popup" <?= $sngl['action_type'] == 'text_popup' ? 'selected' : '' ?>>Text Popup</option>
                                                <option value="customforms" <?= $sngl['action_type'] == 'customforms' ? 'selected' : '' ?>>Forms</option>
                                                <option value="image_popup" <?= $sngl['action_type'] == 'image_popup' ? 'selected' : '' ?>>Image Popup</option>
                                                <!-- <?php foreach ($front_sections as $single) { ?>
                                                    <option value="<?= $single->slug ?>" <?= isset($detail_info->action_button_link) && $detail_info->action_button_link == $single->slug ? 'selected' : '' ?>><?= $single->name ?></option>
                                                <?php } ?> -->
                                            </select>
                                        </div>
                                        <div class="form-group action_fields image_upload" name="feature_action_video2" style="<?= $sngl['action_type'] == 'image_popup' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Upload Images</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="popup_action_images[]" id="customFile" accept=".jpg,.jpeg,.png" multiple>
                                                <label class="custom-file-label" for="customFile">Choose files</label>
                                            </div>
                                        </div>
                                        <div class="form-group action_fields phone_no_calls" style="<?= $sngl['action_type'] == 'call' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for calls</label>
                                            <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="{{$sngl['action_button_phone_no_calls']}}">
                                        </div>
                                        <div class="form-group action_fields phone_no_sms" style="<?= $sngl['action_type'] == 'sms' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Phone number for sms</label>
                                            <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="{{$sngl['action_button_phone_no_sms']}}">
                                        </div>

                                        <div class="form-group action_fields action_email" style="<?= $sngl['action_type'] == 'email' ? 'display:block' : 'display:none' ?>">
                                            <label for="">Email</label>
                                            <input type="text" class="myinput2" name="action_button_action_email[]" value="{{$sngl['action_button_action_email']}}">
                                        </div>
                                        <div class="form-group action_fields audio_icon_feature" name="audio_icon_feature" style="<?= $sngl['action_type'] == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                            <div class="row">
                                                <?php if (isset($sngl->action_button_link) && $detail_info->action_button_link == 'audioiconfeature' && $detail_info->action_button_audio_icon_feature) {

                                                ?>
                                                    <div class="col-md-10 imgdiv">
                                                        <h4><?= $sngl->action_button_audio_icon_feature ?></h4>
                                                        <button type="button" class="btn d-none btn-primary btnaudioiconfiledel" data-slug="blog_btn" data-id="<?= $detail_info->id ?>" data-imgname="<?= $detail_info->action_button_audio_icon_feature ?>">X</button>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="form-group action_fields action_link" style='<?= $sngl['action_type'] == 'link' ? 'display:block' : 'display:none' ?>'>
                                            <input type="text" class="myinput2 news_post_link" name="action_button_link_text[]" id="news_post_link" value="{{$sngl['link']}}" placeholder="http://google.com">
                                        </div>

                                        <div class=" action_fields action_map" style='display:none'>
                                            <div class="form-group ">
                                                <label for="address">Enter Address</label>
                                                <input type="text" class="myinput2 " name="action_button_map_address[]" value="<?= isset($detail_info->action_button_map_address) && $detail_info->action_button_map_address ? $detail_info->action_button_map_address : '' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                                            </div>
                                        </div>
                                        <div class="form-group action_fields video_upload" name="action_button_video1" style='<?= $sngl['action_type'] == 'video' ? 'display:block' : 'display:none' ?>'>
                                            <label for="customFile">Upload Video</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="action_button_video[]" id="customFile" accept=".mp4">
                                                <label class="custom-file-label" for="customFile">Upload Video</label>
                                            </div>
                                            @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                                            <div class=" position-relative d-flex gallery_post_action_button">
                                                <video height="80" controls>
                                                    <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/' . get_current_url() . ($detail_info->action_button_video)) : '' ?>" type="video/mp4">
                                                </video>
                                                <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='gallery_post_action_button' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group action_fields audio_upload" name="feature_action_audio" style="display:none">
                                            <label for="customFile">Select File</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="audio_file[]" id="customFile" accept=".mp3">
                                                <label class="custom-file-label" for="customFile">Select File</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php if (isset($detail_info->action_button_action_audio) && $detail_info->action_button_action_audio) {

                                            ?>
                                                <div class="col-md-10 imgdiv">
                                                    <h4><?= $detail_info->action_button_action_audio ?></h4>
                                                    <button type="button" class="btn btn-primary btnaudiofiledel" data-slug="gallery_post" data-id="<?= $detail_info->id ?>" data-imgname="<?= $detail_info->action_button_action_audio ?>">X</button>
                                                </div>
                                            <?php


                                                } ?>
                                        </div>
                                        <br>

                                        <div class="form-group action_fields action_address " id="address-list-1" style='<?= $sngl['action_type'] == 'address' ? 'display:block' : 'display:none' ?>'>
                                            <label>Select an Address</label>
                                            <select name="action_button_address_id" class="myinput2">
                                                <?php foreach ($addresses as $address) { ?>
                                                    <option value="<?= $address->id ?>"> <?= $address->address_title ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                                                        <br>
                                                                        <button type="button" @if($disable_remove_button) disabled @endif class="btn btn-primary btnremovecantactformfield remove-form-btn" data-id="{{$sngl['id']}}">X</button>
                                                                    </div>
                                    <div class="col-md-12 d-flex justify-content-end">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="form-group quilleditor-div action_fields  action_textpopup" style='<?= $sngl['action_type'] == 'text_popup' ? 'display:block' : 'display:none' ?>'>
                                                    <label>Popup Text </label>
                                                    <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"> <?php echo $sngl['action_button_textpopup']; ?></textarea>
                                                    <div class="quilleditor">
                                                        <?php echo $sngl['action_button_textpopup']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif


                    <?php $i++;
                                                if ($detail_info->id != '7' && ($detail_info->id != '8' || $i > 3)) {
                                                    $formFieldNumber++;
                                                }
                                            } ?>
                <?php } else { ?>
                    <tr>
                        <td>
                            <div class="singlefield">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group"><label>Field Name</label>
                                            <input type="hidden" name="field_id[<?= $formFieldNumber ?>]" value="0">
                                            <input type="text" class="myinput2 fieldname" name="fieldname[<?= $formFieldNumber ?>]" value="" placeholder="Field name">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"><label>Field type</label>
                                            <select class="myinput2 fieldtype" name="fieldtype[<?= $formFieldNumber ?>]" data-formfieldno="<?= $formFieldNumber ?>">
                                                <option value="text">Text</option>
                                                <option value="textarea">Text Area</option>
                                                <option value="radio">Radio</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="select">Select</option>
                                                <option value="multiselect">Multi-Select</option>
                                                <option value="date">Date</option>
                                                <option value="time">Time</option>
                                                <option value="file">File Upload</option>
                                                <option value="image">Image</option>
                                                <option value="5_star_min">Review 5-Star min</option>
                                                <option value="4_star_min">Review 4-Star min</option>
                                                <option value="comment_only">Comment Only</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex">
                                        <div class="form-group formtoggle">
                                            <label for="bannertext"> Show all on form?</label>
                                            <br>
                                            <label class="switch">
                                                <input type="checkbox" name="formenable[<?= $formFieldNumber ?>]" value="1" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="form-group ml-3 requiredtoggle">
                                            <label for="bannertext"> Required field?</label>
                                            <br>
                                            <label class="switch">
                                                <input type="checkbox" name="required[<?= $formFieldNumber ?>]" value="1">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="form-group ml-3 responsetoggle">
                                            <label for="bannertext"> Response Report?</label>
                                            <br>
                                            <label class="switch">
                                                <input type="checkbox" name="show_response[<?= $formFieldNumber ?>]" value="1">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <br>
                                        <button type="button" @if($disable_remove_button) disabled @endif class="btn btn-primary btnremovecantactformfield">X</button>
                                    </div>
                                </div>
                                <div class="subfieldsdiv"></div>
                            </div>
                            <input class="formfieldno" type="hidden" name="formfieldno[]" value="<?= $formFieldNumber ?>">
                        </td>
                    </tr>
                <?php } ?>


                </tbody>
                </table>
                <?php
                // EN-724 fixed
                // if($formAction=='add' || ($detail_info->static_form=='0' || $detail_info->id=='8')){
                if ($formAction == 'add' || ($detail_info->static_form == '0' || $detail_info->id == '8' || $detail_info->id == '7')) {
                ?>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btnaddnewcontactformfields" data-formid="1" data-formfieldno="<?= $formFieldNumber ?>">Add New Field</button>
                            <button type="button" class="btn btn-primary btnaddnewbutton" data-formid="1" data-formfieldno="<?= $formFieldNumber ?>">Add New Button</button>
                        </div>
                    </div> -->
                <?php } ?>
                    </div>

                </div>
            </div>
        </div>
        <div id="address-container" data-addresses='<?= json_encode($addresses) ?>'>
        </div>
</div>
<div class="row  make-sticky">
    <div class="col-lg-12">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= base_url('forms?block=custom_forms_list') ?>"><button type="button" class="btn btn-default">Cancel</button></a>
    </div>
</div>
</form>
</div>
<!--Row-->
</div>

<script>
    $(document).ready(function() {

                $('.remove-form-btn').on('click', function(){
            var dataId = $(this).data('id');
                $.ajax({
                  url: '<?= url('removeformbtn'); ?>',
                  type: "POST",
                  data: {
                    'id': dataId,
                    _token: "{{ csrf_token() }}",
                  },
                  success: function(data) {
                  }
                });
        });
        let slugCounter = $('input[name="slug[]"][type="hidden"]').length + 1;
        console.log(slugCounter);
        $(document).on('click', '.btnaddnewcontactformfields', function() {
            var formid = $(this).data('formid');
            var formfieldno = $(this).data('formfieldno');
            $(this).closest('.singlecontactform').find('.confactformfielddiv').append('<tr><td><div class="singlefield"><div class="row"><div class="col-md-5"> <div class="form-group"><label>Field Name</label><input type="hidden" name="field_id[]" value="' + formfieldno + '"><input type="text" class="myinput2 fieldname" name="fieldname[' + formfieldno + ']" value="" placeholder="Field name"></div></div><div class="col-md-2"><div class="form-group"><label>Field type</label><select class="myinput2 fieldtype" name="fieldtype[' + formfieldno + ']" data-formfieldno="' + formfieldno + '"><option value="text">Text</option><option value="textarea">Text Area</option><option value="radio">Radio</option><option value="checkbox">Checkbox</option><option value="select">Select</option><option value="multiselect">Multi-Select</option><option value="date">Date</option><option value="time">Time</option><option value="file">File Upload</option><option value="image">Image</option><option value="5_star_min" >Review 5-Star min</option><option value="4_star_min">Review 4-Star min</option><option value="comment_only">Comment Only</option></select></div></div> <div class="col-md-4 d-flex"><div class="form-group formtoggle"><label for="bannertext"> Show all on form?</label><br><label class="switch"><input type="checkbox" name="formenable[' + formfieldno + ']" value="1" checked><span class="slider round"></span></label> </div><div class="form-group ml-3 requiredtoggle"><label for="bannertext"> Required field?</label><br><label class="switch"><input type="checkbox" name="required[' + formfieldno + ']" value="1"><span class="slider round"></span></label></div><div class="form-group ml-3 responsetoggle"><label for="bannertext"> Response Report?</label><br><label class="switch"><input type="checkbox" name="show_response[' + formfieldno + ']" value="1" ><span class="slider round"></span> </label></div></div><div class="col-md-1"> <br><button type="button" class="btn btn-primary btnremovecantactformfield" >X</button></div></div><div class="subfieldsdiv"></div></div></td></tr>');
            $(this).data('formfieldno', formfieldno + 1);
        });
        $(document).on('click', '.btnaddnewbutton', function() {
            var addresses = <?= json_encode($addresses) ?>;
            var formfieldno = $(this).data('formfieldno');
            var slugValue = 'form_action_btn_' + slugCounter;
            var newRow = `
    <tr>
        <td>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="action_button_description">Action Button Name</label>
                        <input type="text" class="myinput2" name="action_button_description[]" id="action_button_description_` + formfieldno + `" value="" placeholder="Type here...">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="action_button_description_color">Action Button Text Color</label>
                        <input type="color" class="myinput2" name="action_button_description_color[]" id="action_button_description_color_` + formfieldno + `" value="#ffffff" placeholder="#ffffff">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="action_button_bg_color">Action Button Color</label>
                        <input type="color" class="myinput2" name="action_button_bg_color[]" id="action_button_bg_color_` + formfieldno + `" value="" placeholder="#000000">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="action_button_link">Action Button Application</label>
                        <select class="myinput2 news_post_action_button action_button_selection" id="action_button_link_` + formfieldno + `" name="action_button_link[]">
                            <option value="link">Link</option>
                            <option value="call">Call</option>
                            <option value="sms">SMS</option>
                            <option value="email">Email</option>
                            <option value="address">Address</option>
                            <option value="video">Video</option>
                            <option value="audioiconfeature">Audio Icon Feature</option>
                            <option value="google_map">Map</option>
                            <option value="text_popup">Text Popup</option>
                            <option value="customforms">Forms</option>
                            <option value="image_popup">Image Popup</option>
                        </select>
                    </div>
                    <div class="form-group action_fields image_upload" name="feature_action_video2" style="display:none">
                        <label for="customFile">Upload Images</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="popup_action_images[][]" id="customFile_` + formfieldno + `" accept=".jpg,.jpeg,.png" multiple>
                            <label class="custom-file-label" for="customFile_` + formfieldno + `">Choose files</label>
                        </div>
                    </div>
                    <div class="form-group action_fields phone_no_calls" style="display:none">
                        <label for="action_button_phone_no_calls_` + formfieldno + `">Phone number for calls</label>
                        <input type="text" class="myinput2" name="action_button_phone_no_calls[]" id="action_button_phone_no_calls_` + formfieldno + `" value="">
                    </div>

                    <div class="form-group action_fields phone_no_sms" style="display:none">
                        <label for="action_button_phone_no_sms_` + formfieldno + `">Phone number for sms</label>
                        <input type="text" class="myinput2" name="action_button_phone_no_sms[]" id="action_button_phone_no_sms_` + formfieldno + `" value="">
                    </div>

                    <div class="form-group action_fields action_email" style="display:none">
                        <label for="action_button_action_email_` + formfieldno + `">Email</label>
                        <input type="text" class="myinput2" name="action_button_action_email[]" id="action_button_action_email_` + formfieldno + `" value="">
                    </div>

<div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature" style="display:none">
    <label for="customFile_` + formfieldno + `">Select File</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile_` + formfieldno + `" accept=".mp3">
        <label class="custom-file-label" for="customFile_` + formfieldno + `">Select File</label>
    </div>
    <div class="row">
        <!-- Optional file display logic -->
    </div>
</div>

<div class="form-group action_fields action_link" style="display:block">
    <input type="text" class="myinput2 news_post_link" name="action_button_link_text[]" id="news_post_link_` + formfieldno + `" value="" placeholder="http://google.com">
</div>



<div class="action_fields action_map" style="display:none">
    <div class="form-group">
        <label for="action_button_map_address_` + formfieldno + `">Enter Address</label>
        <input type="text" class="myinput2" name="action_button_map_address[]" id="action_button_map_address_` + formfieldno + `" value="" placeholder="105 Krome Ave, Miami, FL, 3700 USA">
    </div>
</div>

<div class="form-group action_fields video_upload" name="action_button_video1" style="display:none">
    <label for="customFile_` + formfieldno + `">Upload Video</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="action_button_video[]" id="customFile_` + formfieldno + `" accept=".mp4">
        <label class="custom-file-label" for="customFile_` + formfieldno + `">Upload Video</label>
    </div>
    <!-- Optional video display logic -->
</div>

<div class="form-group action_fields audio_upload" name="feature_action_audio" style="display:none">
    <label for="customFile_` + formfieldno + `">Select File</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="audio_file[]" id="customFile_` + formfieldno + `" accept=".mp3">
        <label class="custom-file-label" for="customFile_` + formfieldno + `">Select File</label>
    </div>
    <!-- Optional audio display logic -->
</div>

<div class="form-group action_fields action_address" id="address-list-` + formfieldno + `" style="display:none">
    <label>Select an Address</label>
    <select name="action_button_address_id[]" class="myinput2">
        <!-- Populate with address options dynamically -->
    </select>
</div>
                     <div class="col-md-3">
                        <input type="hidden" name="slug[]" value="${slugValue}">
                    </div>
                    <!-- Add other action_fields here -->
                    <br>
                </div>
                <div class="col-md-12 d-flex justify-content-end editor-container-${slugValue}">
                                        <div class="col-md-6 col-sm-12">
                                        <div class="form-group quilleditor-div action_fields action_textpopup" style="display:none; float:right">
    <label for="action_button_textpopup">Popup Text</label>
    <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"></textarea>
    <div class="quilleditor" >
        <!-- Text for the Quill editor -->
    </div>
</div>
                                        </div>
                                        </div>
                 <div class="col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                                    </div>
            </div>
        </td>
    </tr>`;
            $(this).closest('.singlecontactform').find('.confactformfielddiv').append(newRow);
            $(this).data('formfieldno', formfieldno + 1);
            var addresses = JSON.parse(document.getElementById('address-container').dataset.addresses);

            var selectElement = document.querySelector('#address-list-' + formfieldno + ' select');
            // Clear existing options
            selectElement.innerHTML = "";

            // Populate select options dynamically
            addresses.forEach(function(address) {
                var option = document.createElement('option');
                option.value = address.id;
                option.textContent = address.address_title;
                selectElement.appendChild(option);
            });
            const fontSizeArr = ['8px', '9px', '10px', '12px', '14px', '16px', '18px' ,'20px', '24px', '32px', '42px', '54px', '68px', '84px', '98px'];
            var Font = Quill.import('formats/font');
    Font.whitelist = fontNames;
    Quill.register(Font, true);
    function getFontName(font) {
        return font.toLowerCase().replace(/\s/g, "_");
    }
    const Parchment = window.Quill.import("parchment");
    var lineheights = ['1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '2', '3', '4', '5'];
    const config = {
        scope: Parchment.Scope.BLOCK,
        whitelist: lineheights
    };
    var lineheightNames = lineheights.map(lineheight => getFontName(lineheight));

    var lineHtClass = new Parchment.Attributor.Class('lineheight', 'ql-line-height', config);
    var lineHtStyle = new Parchment.Attributor.Style('lineheight', 'line-height', config);

    var lineheightStyles = "";
    lineheights.forEach(function(lineheight) {
        var lineheightName = getFontName(lineheight);
        lineheightStyles += ".ql-lineheight .ql-picker-options .ql-picker-item[data-value='" + lineheightName + "']::before, .ql-lineheight .ql-picker-label[data-value='" + lineheightName + "']::before {" +
            "content: '" + lineheight + "' !important;" +
            "line-height: '" + lineheight + "' !important;" +
            "}" +
            ".ql-font-" + lineheightName + "{" +
            " line-height: '" + lineheight + "'f !important;" +
            "}";
    });
var Size = Quill.import('attributors/style/size');
Size.whitelist = fontSizeArr;
Quill.register(Size, true);
var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    //['blockquote', 'code-block'],

    //[{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
    [ //{ 'script': 'sub'},
        { 'script': 'super' }
    ], // superscript/subscript
    [{ 'indent': '-1' }, { 'indent': '+1' }], // outdent/indent
    //[{ 'direction': 'rtl' }],                         // text direction

    //[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [{ 'size': fontSizeArr }],

    [{ 'color': [] }, { 'background': [] }], // dropdown with defaults from theme
    [{ 'font': fontNames }],
    [{ 'align': [] }], // remove formatting button
    ['link', 'image', 'video','audio'],
    [{ 'lineheight': lineheightNames }],
];
var fontNames = fonts.map(font => getFontName(font));
var options = {
    modules: {
        toolbar: toolbarOptions,
        imageResize: {
            displaySize: true,
        },
        videoResize: {
            modules: ['Resize', 'DisplaySize', 'Toolbar']
        }
    },
    theme: 'snow'
};
const quillInstances = [];
$('.editor-container-'+slugValue+' .quilleditor').each(function(i, obj) {
    var quill = new Quill(obj, options);
    quillInstances.push(quill);
});

function buildquilleditor(element) {
    var quill = new Quill('.' + element, options);
    $('.' + element).removeClass(element);
}
            slugCounter++;
            $('input[type=color]').each(function() {
                var value = $(this).val();
                var name = $(this).attr('name');
                var classes = $(this).attr('class').split(' ')[1];
                var dataSlug = $(this).attr('data-slug');
                var classtoassign = classes ? classes : '';
                var datatoassign = dataSlug ? 'data-slug="' + dataSlug + '"' : '';

                if (!$(this).hasClass("colorinput") && $(this).attr('id') !== 'build-site-color') {
                    var html = '<div class="d-flex align-items-center color-main-div"><div> <img src="' + base_url + '/assets/admin2/img/dismiss-color.svg" alt="" width="" class="dismiss-color">  </div> <div class="ml-10"> <div class="inputcolordiv"> <div class="inputcolor" style="background:' + value + '"></div> <input type="color" class="colorinput ' + classtoassign + '"  name="' + name + '" value="' + value + '" placeholder="#000000" ' + datatoassign + '></div></div> </div>';
                    $(this).replaceWith(html);
                } else if ($(this).attr('id') == 'build-site-color') {
                    var html = '</div> <div class="ml-10"> <div class="inputcolordiv"> <div readonly id="no-show" class="inputcolor" style="background:' + value + '"></div> <input readonly type="color" class="colorinput ' + classtoassign + '"  name="' + name + '" value="' + value + '" placeholder="#000000" ' + datatoassign + '></div></div> </div>';
                    $(this).replaceWith(html);
                }
            });
        });
        $(document).on('click', '.btnremovecantactformfield', function() {
            $(this).closest('tr').remove();
        });
        $(document).on('click', '.btnremovecantactformoption', function() {
            $(this).closest('.row').remove();
        });
        $(document).on('click', '.formcheckall', function() {
            $('.formtoggle').find('input').prop('checked', $(this).prop('checked'));
            if ($(this).prop('checked')) {
                formcheck = "checked"
            } else {
                formcheck = ""
            }
        });
        $(document).on('click', '.btnaddnewoption', function() {
            var fieldid = $(this).data('fieldid');
            var opfieldno = $(this).data('opfieldno');
            $(this).data('opfieldno', opfieldno + 1);
            $(this).closest('.subfieldsdiv').find('.subfields').append('<div class="row"><div class="col-md-1"></div><div class="col-md-2"><div class="form-group"><label for="bannertext"> Is this an Other Field?</label><br><label class="switch"><input type="checkbox" name="otherfield[' + fieldid + '][' + opfieldno + ']" value="1" ><span class="slider round"></span></label></div></div><div class="col-md-5"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname[' + fieldid + '][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">X</button></div></div>');
        });
        $(document).on('change', '.fieldtype', function() {
            var formfieldno = $(this).data('formfieldno');
            $(this).closest('.singlefield').find('.fieldname').show();
            $(this).closest('.singlefield').find('.requiredtoggle').show();
            $(this).closest('.singlefield').find('.responsetoggle').show();
            $(this).closest('.singlefield').find('.fieldname').closest('div').find('label').html('Field Name');
            if ($(this).val() == 'radio' || $(this).val() == 'checkbox' || $(this).val() == 'select' || $(this).val() == 'multiselect') {
                $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row"><div class="col-md-1"></div><div class="col-md-2"><div class="form-group"><label for="bannertext"> Is this an Other Field?</label><br><label class="switch"><input type="checkbox" name="otherfield[' + formfieldno + '][0]" value="1" ><span class="slider round"></span></label></div></div><div class="col-md-5"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname[' + formfieldno + '][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">X</button></div></div></div><button type="button" class="btn btn-primary btnaddnewoption" data-fieldid="' + formfieldno + '"  data-opfieldno="1">Add New Option</button><br><br>');
            } else if ($(this).val() == 'image') {
                $(this).closest('.singlefield').find('.fieldname').hide();
                $(this).closest('.singlefield').find('.requiredtoggle').hide();
                $(this).closest('.singlefield').find('.responsetoggle').hide();
                $(this).closest('.singlefield').find('.responsetoggle').find('input').prop('checked', false);
                $(this).closest('.singlefield').find('.requiredtoggle').find('input').prop('checked', false);
                $(this).closest('.singlefield').find('.fieldname').closest('div').find('label').html('Image Upload');
                $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"><input class="dataimage" type="hidden" name="qimg[' + formfieldno + ']"><div class="col-md-6 imgdiv" style="display:none"><br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button> </div></div><div class="form-group"><label>Image Description</label><textarea name="image_desc[' + formfieldno + ']" class="myinput2 image_desc"></textarea></div>');
            } else if ($(this).val() == 'comment_only') {
                $(this).closest('.singlefield').find('.subfieldsdiv').html('<textarea name="comment_desc[' + formfieldno + ']" class="myinput2" rows="3" placeholder="Desc...."></textarea>');
            } else if ($(this).val() == '5_star_min') {
                $("#popUpRatingModal").modal('show')
                $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row">   <div class="col-md-12">  <label>Select your rating</label><br>  <input type="radio" name="rating[' + formfieldno + ']" value="5" disabled><label class="text-black">5-Star Rating</label><br> <input type="radio" name="rating[' + formfieldno + ']" value="4" disabled><label class="text-black">4-Star Rating</label><br><input type="radio" name="rating[' + formfieldno + ']" value="3" disabled><label class="text-black">3-Star Rating</label><br><input type="radio" name="rating[' + formfieldno + ']" value="2" disabled><label class="text-black">2-Star Rating</label><br> <input type="radio" name="rating[' + formfieldno + ']" value="1" disabled><label class="text-black">1-Star Rating</label> <br> <div class="col-md-12"><label>Post your review</label><br><textarea name="customer_review_text[' + formfieldno + ']" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly></textarea></div></div></div>');
            } else if ($(this).val() == '4_star_min') {
                $("#popUpRatingModal").modal('show')
                $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row">   <div class="col-md-12">  <label>Select your rating</label><br>  <input type="radio" name="rating[' + formfieldno + ']" value="5" disabled><label class="text-black">5-Star Rating</label><br> <input type="radio" name="rating[' + formfieldno + ']" value="4" disabled><label class="text-black">4-Star Rating</label><br><input type="radio" name="rating[' + formfieldno + ']" value="3" disabled><label class="text-black">3-Star Rating</label><br><input type="radio" name="rating[' + formfieldno + ']" value="2" disabled><label class="text-black">2-Star Rating</label><br> <input type="radio" name="rating[' + formfieldno + ']" value="1" disabled><label class="text-black">1-Star Rating</label> <br> <div class="col-md-12"><label>Post your review</label><br><textarea name="customer_review_text[' + formfieldno + ']" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly></textarea></div></div></div>');
            } else {
                $(this).closest('.singlefield').find('.subfieldsdiv').html('');
            }
        });

        $(document).on('click', '.ql-editor', function() {
            $(this).focus()
        });
    });

   window.onload = function() {
    const quills = document.querySelectorAll('.ql-editor');

        quills.forEach(editor => {
            $(editor).focus()
            console.log(editor,32423)
        });

    };
    // $('.sortabletable').sortable({
    //     cancel: ".btn-group,input,select,textarea",
    // });
    // $(function() {
    //     $(".sortabletable").sortable({
    //         // cancel: ".btn-group,input,select,textarea",
    //         update: function(event, ui) {
    //             var sortedItems = [];
    //             $('.sortabletable tr').each(function(index) {
    //                 var $item = $(this);
    //                 console.log($item);
    //                 sortedItems.push({
    //                     type: $item.data('type'),
    //                     fieldtype: $item.data('fieldtype'),
    //                     fieldname: $item.data('name'),
    //                     id: $item.data('id'),
    //                     order: index + 1
    //                 });
    //             });

    //             // Send sorted order to the server
    //             $.ajax({
    //                 url: '/save-sorted-order',
    //                 method: 'POST',
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     sortedItems: sortedItems
    //                 },
    //                 success: function(response) {

    //                 }
    //             });
    //         }
    //     });
    //     $("#sortable-items").disableSelection();
    // });
    if ((window.innerWidth <= 768)) {
        $(".sortabletable").sortable("disable");
    }
</script>
@endsection('content')
