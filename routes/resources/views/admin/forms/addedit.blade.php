@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=strtoupper($formAction)?> Form</h1>
    <ol class="breadcrumb">
        <li>
          <a href="{{ url('forms?block=custom_forms_list') }}" class="btn btn-info " >
              Back
          </a>
        </li>
    </ol>
    </div>
      
    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('saveform')}}">
        @csrf
      <input type="hidden" name="formAction" value="{{$formAction}}">
      <input type="hidden" name="formid" value="{{isset($detail_info)?$detail_info->id:''}}">
      <div class="row">
          <div class="col-lg-6">
              <!-- Form Basic -->
              <div class="card mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary"><?=strtoupper($formAction)?> Form</h6>
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" name="title" class="myinput2" id="title" value="<?php if(isset($detail_info)) echo $detail_info->title;?>" placeholder="Title" required>
                      </div>
                      <div class="form-group">
                          <label for="subtitle">Subtitle</label>
                          <input type="text" name="subtitle" class="myinput2" id="subtitle" value="<?php if(isset($detail_info)) echo $detail_info->subtitle;?>" placeholder="Subtitle" required>
                      </div>
                      <input type="hidden" name="formAction" value="<?php if(isset($formAction)) echo $formAction;?>">
                      <input type="hidden" name="duplicateImge" value="<?php if (isset($detail_info) && $detail_info->image)  echo  $detail_info->image;?>">
                      <div class="form-group">
                          <label for="descriptive">Descriptive Text</label>
                          <textarea name="descriptive" class="myinput2" id="descriptive" rows="4" required><?php if(isset($detail_info)) echo $detail_info->descriptive;?></textarea>
                      </div>
                      <div class="form-group">
                          <label for="footer_text_1">Footer text 1</label>
                          <input type="text" name="footer_text_1" class="myinput2" id="footer_text_1" value="<?php if(isset($detail_info)) echo $detail_info->footer_text_1;?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label for="footer_text_2">Footer text 2</label>
                          <input type="text" name="footer_text_2" class="myinput2" id="footer_text_2" value="<?php if(isset($detail_info)) echo $detail_info->footer_text_2;?>" placeholder="">
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
                                  <img src='<?= base_url('assets/uploads/' .get_current_url(). $detail_info->image) ?>' width="100%">
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
                      <input type="text" name="image_size" class="myinput2" id="image_size" value="<?php if(isset($detail_info)) echo $detail_info->image_size;?>" placeholder="200">
                      <label>Max Image Size (500px)</label>
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
                <div  style="position: absolute;" class=" ">
                    <div  id="popUpRatingModal" tabindex="-1" aria-labelledby="popUpRatingModal"
                        class="modal fade " style="position: relative; width: 245px;"
                        aria-modal="true" role="dialog">
                        <div  class="modal-dialog my-modal-lg">
                            <div  class="modal-content">
                                <div  class="modal-body">
                                    <div  class="row">
                                        <div  class="col-md-12 pb-2 pl-2 pr-2">
                                            <label class="title-8 mt-2">Reviews Filter Notes:  <button  type="button"
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
                    
                    
                      <table class="w-100">
                          <tbody class="confactformfielddiv sortabletable">
                              <?php $formFieldNumber = 0;$i=0;
                              if (isset($detail_info) && $detail_info->fields) { ?>
                                  <?php $form_fields = json_decode($detail_info->fields); ?>
                                  <?php foreach ($form_fields as $sngl) { ?>
                                      <tr>
                                          <td>
                                              <div class="singlefield">
                                                  <div class="row">
                                                      <div class="col-md-5">
                                                          <div class="form-group"><label>Field Name</label>
                                                                <input type="hidden" name="field_id[]" value="{{$i}}">
                                                              <input type="text" class="myinput2 fieldname <?=$sngl->fieldtype == 'image'?'hidden':''?>" name="fieldname[<?= $formFieldNumber ?>]" value="<?=$sngl->fieldname?>" placeholder="Field name" <?php if($detail_info->static_form=='1' && ($detail_info->id=='7'|| $detail_info->id=='8' && $i<3)){echo 'disabled';}?>>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-2">
                                                          <div class="form-group"><label>Field type</label>
                                                              <select class="myinput2 fieldtype" name="fieldtype[<?= $formFieldNumber ?>]" <?php if($detail_info->static_form=='1' && ($detail_info->id=='7'|| $detail_info->id=='8' && $i<3)){echo 'disabled';}?> data-formfieldno="<?= $formFieldNumber ?>">
                                                                  <option value="text" <?= $sngl->fieldtype == 'text' ? 'selected' : '' ?>>Text</option>
                                                                  <option value="textarea" <?= $sngl->fieldtype == 'textarea' ? 'selected' : '' ?>>Text Area</option>
                                                                  <option value="radio" <?= $sngl->fieldtype == 'radio' ? 'selected' : '' ?>>Radio</option>
                                                                  <option value="checkbox" <?= $sngl->fieldtype == 'checkbox' ? 'selected' : '' ?>>Checkbox</option>
                                                                  <option value="select" <?= $sngl->fieldtype == 'select' ? 'selected' : '' ?>>Select</option>
                                                                  <option value="multiselect" <?= $sngl->fieldtype == 'multiselect' ? 'selected' : '' ?>>Multi-Select</option>
                                                                  <option value="date" <?= $sngl->fieldtype == 'date' ? 'selected' : '' ?>>Date</option>
                                                                  <option value="time" <?= $sngl->fieldtype == 'time' ? 'selected' : '' ?>>Time</option>
                                                                  <option value="file" <?= $sngl->fieldtype == 'file' ? 'selected' : '' ?>>File Upload</option>
                                                                  <option value="image" <?= $sngl->fieldtype == 'image' ? 'selected' : '' ?>>Image</option>
                                                                  <option value="5_star_min" <?= $sngl->fieldtype == '5_star_min' ? 'selected' : '' ?>>Review 5-Star min</option>
                                                                  <option value="4_star_min" <?= $sngl->fieldtype == '4_star_min' ? 'selected' : '' ?>>Review 4-Star min</option>
                                                                  <option value="comment_only" <?= $sngl->fieldtype == 'comment_only' ? 'selected' : '' ?>>Comment Only</option>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-4 d-flex">
                                                        <div class="form-group formtoggle">
                                                            <?php if($detail_info->id!='7' && ($detail_info->id!='8' || $i>=3)){ ?>
                                                            <label for="bannertext"> Show all on form?</label>
                                                            <br>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="formenable[<?= $formFieldNumber ?>]" <?= isset($sngl->formenable) && $sngl->formenable ? 'checked' : 'checked' ?> value="1" >
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            <?php } ?>
                                                        </div>
                                                          <div class="form-group ml-3 requiredtoggle">
                                                              <?php if($detail_info->id!='7' && ($detail_info->id!='8' || $i>=3)){ ?>
                                                              <label for="bannertext"> Required field?</label>
                                                              <br>
                                                                  <label class="switch">
                                                                      <input type="checkbox" name="required[<?= $formFieldNumber ?>]" <?= $sngl->required ? 'checked' : '' ?> value="1" >
                                                                      <span class="slider round"></span>
                                                                  </label>
                                                              <?php }else{ ?>
                                                                  <?= $sngl->required ? '<br><label for="bannertext">Required</label>' : '' ?>
                                                              <?php } ?>
                                                          </div>
                                                          <div class="form-group ml-3 responsetoggle">
                                                              <?php if($detail_info->id!='7' && ($detail_info->id!='8' || $i>=3)){ ?>
                                                              <label for="bannertext"> Response Report?</label>
                                                              <br>
                                                                  <label class="switch">
                                                                      <input type="checkbox" name="show_response[<?= $formFieldNumber ?>]" <?= isset($sngl->show_response) && $sngl->show_response ? 'checked' : '' ?> value="1" >
                                                                      <span class="slider round"></span>
                                                                  </label>
                                                              <?php } ?>
                                                          </div>
                                                      </div>
                                                      <?php if($detail_info->id!='7' && ($detail_info->id=='8' || $i>=3)){ ?>
                                                      <div class="col-md-1">
                                                          <br>
                                                          <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
                                                      </div>
                                                      <?php } ?>
                                                  </div>
                                                  <div class="subfieldsdiv">
                                                      <?php 
                                                              $opfieldno = 0;
                                                              if($sngl->fieldtype == 'radio' || $sngl->fieldtype == 'checkbox' || $sngl->fieldtype == 'select' || $sngl->fieldtype == 'multiselect'){ ?>
                                                          <div class="subfields">
                                                              <?php if(isset($sngl->options) && is_array($sngl->options)){  ?>
                                                                  <?php foreach($sngl->options as $singleop){ //print_r($singleop);?>
                                                                      <div class="row">
                                                                          <div class="col-md-1"></div>
                                                                          <div class="col-md-2">
                                                                              <div class="form-group">
                                                                                  <label for="bannertext"> Is this an Other Field?</label><br><label class="switch">
                                                                                      <input type="checkbox" name="otherfield[<?=$formFieldNumber?>][<?=$opfieldno?>]" value="1" <?=isset($singleop->otherfield) && $singleop->otherfield=='1'?'checked':''?>>
                                                                                      <span class="slider round"></span>
                                                                                  </label>
                                                                              </div>
                                                                          </div>
                                                                          <div class="col-md-5">
                                                                              <div class="form-group">
                                                                                  <label>Option name</label>
                                                                                  <input type="text" class="myinput2" name="oprtionname[<?=$formFieldNumber?>][]" value="<?=isset($singleop->option_name)?$singleop->option_name:$singleop?>" placeholder="Option name" <?php if($detail_info->static_form=='1' && ($detail_info->id=='7'|| $detail_info->id=='8' && $i<3)){echo 'disabled';}?>>
                                                                              </div>
                                                                          </div>
                                                                         
                                                                          <?php if($detail_info->id!='7' && ($detail_info->id!='8' || $i>=3)){ ?>
                                                                              <div class="col-md-2">
                                                                                  <br> 
                                                                                  <button type="button" class="btn btn-primary btnremovecantactformoption">X</button>
                                                                              </div>
                                                                          <?php } ?>
                                                                      </div>
                                                                  <?php $opfieldno++; } ?>
                                                              <?php } ?>
                                                          </div>
                                                          <?php if($detail_info->id!='7' && ($detail_info->id!='8' || $i>=3)){ ?>
                                                              <button type="button" class="btn btn-primary btnaddnewoption" data-fieldid="<?=$formFieldNumber?>" data-opfieldno="<?=$opfieldno?>">Add New Option</button><br><br>
                                                          <?php } ?> 
                                                      <?php }else if($sngl->fieldtype == 'image'){ ?>
                                                          <div class="uploadImageDiv">
                                                              <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                                              <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                              <input class="dataimage" type="hidden" name="qimg[<?=$formFieldNumber?>]">
                                                              <input class="" type="hidden" name="image_name[<?=$formFieldNumber?>]" value="<?=isset($sngl->image)?$sngl->image:''?>">
                                                              <div class="col-md-6 imgdiv">
                                                                  <br> 
                                                                  <img src="<?=isset($sngl->image)?base_url('assets/uploads/'.get_current_url().$sngl->image):''?>" width="100%" class="imagefromgallerysrc"> 
                                                                  <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button> 
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Image Description</label>
                                                              <textarea name="image_desc[<?=$formFieldNumber?>]" class="myinput2 image_desc"><?=isset($sngl->image_desc)?$sngl->image_desc:''?></textarea>
                                                          </div>
                                                      <?php }else if($sngl->fieldtype == 'comment_only'){ ?>
                                                            <textarea name="comment_desc[<?=$formFieldNumber?>]" class="myinput2" rows="3" placeholder="Desc...."><?=isset($sngl->comment_desc)?$sngl->comment_desc:''?></textarea>
                                                      <?php }else if($sngl->fieldtype == '5_star_min'){ ?>
                                                            <div class="subfields">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Select your rating</label><br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="5">
                                                                            <label class="text-black">5-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="4">
                                                                            <label class="text-black">4-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="3">
                                                                            <label class="text-black">3-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="2">
                                                                            <label class="text-black">2-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="1">
                                                                            <label class="text-black">1-Star Rating</label>
                                                                    </div>
                                                                   
                                                                    <div class="col-md-12 mt-2">
                                                                        <label>Post your review</label><br>
                                                                        <textarea name="customer_review_text[<?=$formFieldNumber?>]" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly>
                                                                        <?=isset($sngl->customer_review_text)?$sngl->customer_review_text:''?>
                                                                        </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                      <?php }else if($sngl->fieldtype == '4_star_min'){ ?>
                                                            <div class="subfields">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Select your rating</label><br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="5">
                                                                            <label class="text-black">5-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="4">
                                                                            <label class="text-black">4-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="3">
                                                                            <label class="text-black">3-Star Rating</label>
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="2">
                                                                            <label class="text-black">2-Star Rating</label>
                                                                       
                                                                        <br>
                                                                            <input type="radio" disabled name="rating[<?$formFieldNumber?>]" value="1">
                                                                            <label class="text-black">1-Star Rating</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 mt-2">
                                                                        <label>Post your review</label><br>
                                                                        <textarea name="customer_review_text[<?=$formFieldNumber?>]" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly>
                                                                        <?=isset($sngl->customer_review_text)?$sngl->customer_review_text:''?>
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
                                  <?php $i++; if($detail_info->id!='7' && ($detail_info->id!='8' || $i>3)){ $formFieldNumber++;}} ?>
                              <?php }else{ ?>
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
                                                <option value="text" >Text</option>
                                                <option value="textarea">Text Area</option>
                                                <option value="radio">Radio</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="select">Select</option>
                                                <option value="multiselect">Multi-Select</option>
                                                <option value="date">Date</option>
                                                <option value="time">Time</option>
                                                <option value="file">File Upload</option>
                                                <option value="image">Image</option>
                                                <option value="5_star_min" >Review 5-Star min</option>
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
                                                    <input type="checkbox" name="formenable[<?= $formFieldNumber ?>]" value="1" checked >
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
                                                      <input type="checkbox" name="show_response[<?= $formFieldNumber ?>]" value="1" >
                                                      <span class="slider round"></span>
                                                  </label>
                                              </div>
                                          </div>
                                          <div class="col-md-1">
                                            <br>
                                            <button type="button" class="btn btn-primary btnremovecantactformfield">X</button>
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
                            if($formAction=='add' || ($detail_info->static_form=='0' || $detail_info->id=='8' || $detail_info->id=='7')){    
                        ?>
                          <div class="row">
                              <div class="col-md-12">
                              <button type="button" class="btn btn-primary btnaddnewcontactformfields" data-formid="1" data-formfieldno="<?= $formFieldNumber?>">Add New Field</button>
                              </div>
                          </div>
                      <?php } ?>
                  </div>
                          
                  </div>
              </div>
          </div>
      </div>
      <div class="row  make-sticky">
          <div class="col-lg-12">
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="<?=base_url('forms?block=custom_forms_list')?>"><button type="button" class="btn btn-default">Cancel</button></a>
          </div>
      </div>
  </form>
</div>
    <!--Row-->
</div>

<script>
  $(document).ready(function() {
    $(document).on('click', '.btnaddnewcontactformfields', function() {
      var formid = $(this).data('formid');
      var formfieldno = $(this).data('formfieldno');
      $(this).closest('.singlecontactform').find('.confactformfielddiv').append('<tr><td><div class="singlefield"><div class="row"><div class="col-md-5"> <div class="form-group"><label>Field Name</label><input type="hidden" name="field_id[]" value="'+formfieldno+'"><input type="text" class="myinput2 fieldname" name="fieldname['+formfieldno+']" value="" placeholder="Field name"></div></div><div class="col-md-2"><div class="form-group"><label>Field type</label><select class="myinput2 fieldtype" name="fieldtype['+formfieldno+']" data-formfieldno="'+formfieldno+'"><option value="text">Text</option><option value="textarea">Text Area</option><option value="radio">Radio</option><option value="checkbox">Checkbox</option><option value="select">Select</option><option value="multiselect">Multi-Select</option><option value="date">Date</option><option value="time">Time</option><option value="file">File Upload</option><option value="image">Image</option><option value="5_star_min" >Review 5-Star min</option><option value="4_star_min">Review 4-Star min</option><option value="comment_only">Comment Only</option></select></div></div> <div class="col-md-4 d-flex"><div class="form-group formtoggle"><label for="bannertext"> Show all on form?</label><br><label class="switch"><input type="checkbox" name="formenable['+formfieldno+']" value="1" checked><span class="slider round"></span></label> </div><div class="form-group ml-3 requiredtoggle"><label for="bannertext"> Required field?</label><br><label class="switch"><input type="checkbox" name="required[' + formfieldno + ']" value="1"><span class="slider round"></span></label></div><div class="form-group ml-3 responsetoggle"><label for="bannertext"> Response Report?</label><br><label class="switch"><input type="checkbox" name="show_response['+formfieldno+']" value="1" ><span class="slider round"></span> </label></div></div><div class="col-md-1"> <br><button type="button" class="btn btn-primary btnremovecantactformfield" >X</button></div></div><div class="subfieldsdiv"></div></div></td></tr>');
      $(this).data('formfieldno', formfieldno + 1);
    });
    $(document).on('click', '.btnremovecantactformfield', function() {
      $(this).closest('tr').remove();
    });  
    $(document).on('click', '.btnremovecantactformoption', function() {
      $(this).closest('.row').remove();
    }); 
    $(document).on('click', '.formcheckall', function() {
      $('.formtoggle').find('input').prop('checked',$(this).prop('checked'));
      if($(this).prop('checked')){
        formcheck = "checked"
      }else{
        formcheck = ""
      }
    }); 
    $(document).on('click', '.btnaddnewoption', function() {
      var fieldid = $(this).data('fieldid');
      var opfieldno = $(this).data('opfieldno');
      $(this).data('opfieldno', opfieldno + 1);
      $(this).closest('.subfieldsdiv').find('.subfields').append('<div class="row"><div class="col-md-1"></div><div class="col-md-2"><div class="form-group"><label for="bannertext"> Is this an Other Field?</label><br><label class="switch"><input type="checkbox" name="otherfield['+fieldid+']['+opfieldno+']" value="1" ><span class="slider round"></span></label></div></div><div class="col-md-5"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname['+fieldid+'][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">X</button></div></div>');
    });  
    $(document).on('change', '.fieldtype', function() {
      var formfieldno = $(this).data('formfieldno');
      $(this).closest('.singlefield').find('.fieldname').show();
      $(this).closest('.singlefield').find('.requiredtoggle').show();
      $(this).closest('.singlefield').find('.responsetoggle').show();
      $(this).closest('.singlefield').find('.fieldname').closest('div').find('label').html('Field Name');
      if($(this).val()=='radio' || $(this).val()=='checkbox' || $(this).val()=='select' || $(this).val()=='multiselect'){
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row"><div class="col-md-1"></div><div class="col-md-2"><div class="form-group"><label for="bannertext"> Is this an Other Field?</label><br><label class="switch"><input type="checkbox" name="otherfield['+formfieldno+'][0]" value="1" ><span class="slider round"></span></label></div></div><div class="col-md-5"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname['+formfieldno+'][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">X</button></div></div></div><button type="button" class="btn btn-primary btnaddnewoption" data-fieldid="'+formfieldno+'"  data-opfieldno="1">Add New Option</button><br><br>');
      }else  if($(this).val()=='image'){
        $(this).closest('.singlefield').find('.fieldname').hide();
        $(this).closest('.singlefield').find('.requiredtoggle').hide();
        $(this).closest('.singlefield').find('.responsetoggle').hide();
        $(this).closest('.singlefield').find('.responsetoggle').find('input').prop('checked',false);
        $(this).closest('.singlefield').find('.requiredtoggle').find('input').prop('checked',false);
      $(this).closest('.singlefield').find('.fieldname').closest('div').find('label').html('Image Upload');
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"><input class="dataimage" type="hidden" name="qimg['+formfieldno+']"><div class="col-md-6 imgdiv" style="display:none"><br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button> </div></div><div class="form-group"><label>Image Description</label><textarea name="image_desc['+formfieldno+']" class="myinput2 image_desc"></textarea></div>');
      }else if($(this).val()=='comment_only'){
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<textarea name="comment_desc['+formfieldno+']" class="myinput2" rows="3" placeholder="Desc...."></textarea>');
      }else if($(this).val()=='5_star_min'){
        $("#popUpRatingModal").modal('show')
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row">   <div class="col-md-12">  <label>Select your rating</label><br>  <input type="radio" name="rating['+formfieldno+']" value="5" disabled><label class="text-black">5-Star Rating</label><br> <input type="radio" name="rating['+formfieldno+']" value="4" disabled><label class="text-black">4-Star Rating</label><br><input type="radio" name="rating['+formfieldno+']" value="3" disabled><label class="text-black">3-Star Rating</label><br><input type="radio" name="rating['+formfieldno+']" value="2" disabled><label class="text-black">2-Star Rating</label><br> <input type="radio" name="rating['+formfieldno+']" value="1" disabled><label class="text-black">1-Star Rating</label> <br> <div class="col-md-12"><label>Post your review</label><br><textarea name="customer_review_text['+formfieldno+']" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly></textarea></div></div></div>');
      }else if($(this).val()=='4_star_min'){
        $("#popUpRatingModal").modal('show')
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row">   <div class="col-md-12">  <label>Select your rating</label><br>  <input type="radio" name="rating['+formfieldno+']" value="5" disabled><label class="text-black">5-Star Rating</label><br> <input type="radio" name="rating['+formfieldno+']" value="4" disabled><label class="text-black">4-Star Rating</label><br><input type="radio" name="rating['+formfieldno+']" value="3" disabled><label class="text-black">3-Star Rating</label><br><input type="radio" name="rating['+formfieldno+']" value="2" disabled><label class="text-black">2-Star Rating</label><br> <input type="radio" name="rating['+formfieldno+']" value="1" disabled><label class="text-black">1-Star Rating</label> <br> <div class="col-md-12"><label>Post your review</label><br><textarea name="customer_review_text['+formfieldno+']" class="myinput2" rows="5" placeholder="Write a review" style="height:auto" readonly></textarea></div></div></div>');
      }else {
        $(this).closest('.singlefield').find('.subfieldsdiv').html('');
      }
    });  
  });  
  
 
    $('.sortabletable').sortable({
        cancel:".btn-group,input,select,textarea",
    });
    if ((window.innerWidth <= 768)) {
        $(".sortabletable").sortable("disable");
    }
</script>
@endsection('content')