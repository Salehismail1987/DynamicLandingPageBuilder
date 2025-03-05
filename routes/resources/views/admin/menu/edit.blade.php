@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">EDIT {{ $controller_name }}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ url('settings?block=pulldown_menu_bluebar') }}" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>
     <div class="row">
        <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">EDIT <?=$controller_name?></h6>
                </div>
                <div class="card-body">
                    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{url('updatemenu/'.$detail_info->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="myinput2" id="name" value="<?php echo $detail_info->name;?>" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Section</label>
                        <select name="section" class="myinput2 link_section_option action_button_selection" >
                            <option value="link" <?= $detail_info->link_type == 'link' ? 'selected' :'' ?>>Link</option>
                            <option value="call" <?= $detail_info->link_type == 'call' ? 'selected' :'' ?>>Call</option>
                            <option value="sms" <?= $detail_info->link_type == 'sms' ? 'selected' :'' ?>>SMS</option>
                            <option value="email" <?= $detail_info->link_type == 'email' ? 'selected' :'' ?>>Email</option>
                            <option value="video" <?= $detail_info->link_type == 'video' ? 'selected' :'' ?>>Video</option>
                            <option value="google_map" <?= $detail_info->link_type == 'google_map' ? 'selected' :'' ?>>Map</option>
                            <option value="text_popup" <?= $detail_info->link_type == 'text_popup' ? 'selected' :'' ?>>Text Popup</option>
                            <option value="address" <?= $detail_info->link_type == 'address' ? 'selected' :'' ?>>Address</option>
                            <option value="customforms" <?= $detail_info->link_type == "customforms" ? 'selected' : '' ?>>Forms</option>
                            <?php foreach($front_sections as $single){ ?>
                                    <option value="<?=$single->id?>" <?=$single->id==$detail_info->section?'selected':''?>><?=$single->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                        <div class="form-group action_fields phone_no_calls" style="<?= $detail_info->link_type == 'call' ? 'display:block' : 'display:none' ?>">
                            <label for="">Phone number for calls</label>
                            <input type="text" class="myinput2" name="action_button_phone_no_calls" value="<?= $detail_info->action_button_phone_no_calls ?>">
                        </div>
                        <div class="form-group action_fields phone_no_sms" style="<?= $detail_info->link_type == 'sms' ? 'display:block' : 'display:none' ?>">
                            <label for="">Phone number for sms</label>
                            <input type="text" class="myinput2" name="action_button_phone_no_sms" value="<?= $detail_info->action_button_phone_no_sms ?>">
                        </div>
                        <div class="form-group quilleditor-div action_fields  action_textpopup"  style="<?= $detail_info->link_type == 'text_popup' ? 'display:block' : 'display:none' ?>">
                            <label>Popup Text </label>
                            <textarea class="myinput2 editordata hidden" name="action_button_textpopup"><?php echo $detail_info->action_button_textpopup; ?></textarea>
                            <div class="quilleditor">
                            <?php echo $detail_info->action_button_textpopup; ?>
                            </div>
                        </div>
                        <div class="form-group action_fields action_email" style="<?= $detail_info->link_type == 'email' ? 'display:block' : 'display:none' ?>">
                            <label for="">Email</label>
                            <input type="text" class="myinput2" name="action_button_action_email" value="<?= $detail_info->action_button_action_email ?>">
                        </div>
                        <div class="form-group action_fields audio_icon_feature" name="headerbtn3_audio_icon_feature"  style="<?= $detail_info->link_type == 'audioiconfeature' ? 'display:block' : 'display:none' ?>">
                                <label for="customFile">Select File</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                        accept=".mp3">
                                    <label class="custom-file-label" for="customFile">Select File</label>
                                </div>
                                <div class="row">
                                <?php if ($detail_info->link_type == 'audioiconfeature' && $detail_info->action_button_audio_icon_feature) {
                                
                                    ?>
                                        <div class="col-md-10 imgdiv">
                                            <h4><?= $detail_info->action_button_audio_icon_feature ?></h4>
                                            <button type="button" class="btn d-none btn-primary btnaudioiconfiledel"
                                            data-slug="blog_btn"
                                            data-id="<?= $detail_info->id ?>"
                                                data-imgname="<?= $detail_info->action_button_audio_icon_feature ?>">X</button>
                                        </div>
                                    <?php 
                                } ?>
                                </div>
                            </div>
                        <div class="form-group action_fields action_link" style="<?= $detail_info->link_type == 'link' ? 'display:block' : 'display:none' ?>">
                            <input type="text" class="myinput2 news_post_link" name="link_url" id="news_post_link" value="<?= $detail_info->link_url ?>" placeholder="http://google.com">
                        </div>
                        <div class="form-group action_fields action_forms" style="<?= $detail_info->link_type == 'customforms' ? 'display:block' : 'display:none' ?>">
                            <select class="myinput2 customforms" name="custom_form">
                                <?php if(count($custom_forms)>0){ ?>
                                <?php foreach($custom_forms as $single){ ?>
                                    <option value="<?=$single->id?>" <?= $detail_info->custom_form == $single->id ? 'selected' : '' ?>><?=$single->title?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class=" action_fields action_map" style="<?= $detail_info->link_type == 'google_map' ? 'display:block' : 'display:none' ?>">
                            <div class="form-group " >
                                <label for="address">Enter Address</label>
                                <input type="text" class="myinput2 " name="map_address" value="<?= isset($detail_info->map_address) && $detail_info->map_address ? $detail_info->map_address :'' ?>" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                            </div>
                        </div>
                        <div class="form-group action_fields video_upload" name="action_button_video1"  style="<?= $detail_info->link_type == 'video' ? 'display:block' : 'display:none' ?>">
                              <label for="customFile">Upload Video</label>
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                      accept=".mp4">
                                  <label class="custom-file-label" for="customFile">Upload Video</label>
                              </div>
                              @if(isset($detail_info->action_button_video) && $detail_info->action_button_video !='')
                                  <div class=" position-relative d-flex menu_action_button">
                                  <video height="80" controls>
                                      <source src="<?= isset($detail_info->action_button_video) ? base_url('assets/uploads/'.get_current_url().($detail_info->action_button_video)  ):''?>" type="video/mp4" >
                                  </video>
                                  <div class="remove_video_action btn btn-primary  " title="Click to Remove" data-type='menu_action_button' data-id="{{$detail_info->id}}" data-file="{{$detail_info->action_button_video}}">X
                                  </div> 
                                  </div>
                              @endif
                          </div>
                        <div class="form-group action_fields action_address" style="display:<?= $detail_info->link_type == 'address'  ? 'block' : 'none' ?>">
                            <label>Select an Address</label>
                            <select name="address_id" class="myinput2">
                                <?php foreach($addresses as $address){ ?>
                                    <option value="<?= $address->id ?>" <?= $detail_info->address_id == $address->id ? 'selected' : '' ?>> <?= $address->address_title ?> </option>
                                <?php } ?>
                            </select> 
                        </div>
                    <div class="make-sticky">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('settings?block=pulldown_menu_bluebar') }}"><button type="button" class="btn btn-default">Cancel</button></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Row-->
</div>

<script>
   

//    if ($('.link_section_option').val() == 'email') {
//       $('#link-div').hide();
//       $("#address-list-div").hide();
//       $('.customforms').hide();
//       $('#email-div').show();
//     } if ($('.link_section_option').val() == 'link') {
//       $('#link-div').show();
//       $("#address-list-div").hide();
//       $('.customforms').hide();
//       $('#email-div').hide();
//     } else if ($('.link_section_option').val() == 'customforms') {
//       $('.customforms').show();
//       $('#link-div').hide();
//       $("#address-list-div").hide();
//       $('#email-div').hide();
//     } else if($('.link_section_option').val() == 'address' || $('.link_section_option').val() == 'google_map' ){
//       $('#link-div').hide();
//       $("#address-list-div").show();
//       $('.customforms').hide();
//       $('#email-div').hide();
//     }else{
//       $('#link-div').hide();
//       $("#address-list-div").hide();
//       $('.customforms').hide();
//       $('#email-div').hide();
//     }

//     $(document).ready(function() {
//       $(document).on('change', '.link_section_option', function() {
       
//         if ($('.link_section_option').val() == 'email') {
//           $('#link-div').hide();
//           $("#address-list-div").hide();
//           $('.customforms').hide();
//           $('#email-div').show();
//         } else if ($(this).val() == 'link') {
//           $('#link-div').show();
//           $("#address-list-div").hide();
//           $('.customforms').hide();
//           $('#email-div').hide();
//         } else if ($('.link_section_option').val() == 'customforms') {
//           $('.customforms').show();
//           $('#link-div').hide();
//           $("#address-list-div").hide();
//           $('#email-div').hide();
//         }  else if($(this).val() == 'address' || $(this).val() == 'google_map' ){
//           $('#link-div').hide();
//           $("#address-list-div").show();
//           $('.customforms').hide();
//           $('#email-div').hide();
//         }else{
//           $('#link-div').hide();
//           $("#address-list-div").hide();
//           $('.customforms').hide();
//           $('#email-div').hide();
//         }
//       });

//   });
</script>
@endsection('content')