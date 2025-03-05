@extends('admin.layout.dashboard')
@section('content')
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">ADD {{ $controller_name }}</h1>
      <a href="{{ url('settings?block=pulldown_menu_bluebar') }}" class="btn btn-info " >
          Back
      </a>
      </div>
      <div class="row">
      <div class="col-lg-6">
          <!-- Form Basic -->
          <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">ADD <?=$controller_name?></h6>
            </div>
            <div class="card-body">
              <form role="form" method="post" enctype="multipart/form-data" action="<?=base_url('savemenu')?>">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="myinput2" id="name" value="" placeholder="Name">
                </div>
                    <div class="form-group">
                      <label for="name">Section</label>
                        <select name="section" class="myinput2 link_section_option action_button_selection" >
                            <option value="link">Link to Outside Site</option>
                            <option value="call">Call</option>
                            <option value="sms">SMS Text</option>
                            <option value="email">Email</option>
                            <option value="address">Business Address</option>
                            <option value="customforms">Link to Form</option>
                            <option value="text_popup">Popup - Text</option>
                            <option value="video">Popup - Video</option>
                            <option value="address">Address</option>
                            <option value="google_map">Map</option>
                            <?php foreach($front_sections as $single){ ?>
                                    <option value="<?=$single->id?>"><?=$single->name?></option>
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
                    <div class="form-group quilleditor-div action_fields  action_textpopup"  style="display:none">
                        <label>Popup Text </label>
                        <textarea class="myinput2 editordata hidden" name="action_button_textpopup"></textarea>
                        <div class="quilleditor"></div>
                    </div>
                    <div class="form-group action_fields action_email" style="display:none;">
                        <label for="">Email</label>
                        <input type="text" class="myinput2" name="action_button_action_email" value="">
                    </div>
                    <div class="form-group action_fields audio_icon_feature" name="headerbtn2_audio_icon_feature"  style="display:none">
                        <label for="customFile">Select File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="action_button_audio_icon_feature" id="customFile"
                                accept=".mp3">
                            <label class="custom-file-label" for="customFile">Select File</label>
                        </div>
                        
                    </div>
                    <div class="form-group action_fields action_link" style="display:block;">
                        <input type="text" class="myinput2 news_post_link" name="link_url" id="news_post_link" value="" placeholder="http://google.com">
                    </div>
                    <div class="form-group action_fields video_upload" name="action_button_video"  style="display:none">
                        <label for="customFile">Upload Video</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="action_button_video" id="customFile"
                                accept=".mp4">
                            <label class="custom-file-label" for="customFile">Upload Video</label>
                        </div>
                    </div>
                    <div class="form-group action_fields action_forms" style="display:none;">
                        <select class="myinput2 customforms" name="custom_form">
                            <?php if(count($custom_forms)>0){ ?>
                            <?php foreach($custom_forms as $single){ ?>
                                <option value="<?=$single->id?>"><?=$single->title?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class=" action_fields action_map" style="display:none">
                        <div class="form-group " >
                            <label for="address">Enter Address</label>
                            <input type="text" class="myinput2 " name="map_address" value="" placeholder=" 105 Krome Ave, Miami, FL, 3700 USA">
                        </div>
                    </div>
                    <div class="form-group action_fields action_address" style="display:none;">
                      <label for="addressbtn1">Select an Address</label>
                      <select name="address_id" class="myinput2">
                      <?php 
                      foreach($addresses as $address){
                        ?>
                          <option value="<?=$address->id?>"><?=$address->address_title?></option>
                        <?php 
                      }
                      ?>
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
  <script>
     
    //  if ($('.link_section_option').val() == 'email') {
    //     $('#link-div').hide();
    //     $("#address-list-div").hide();
    //     $('.customforms').hide();
    //     $('#email-div').show();
    //   } else if ($('.link_section_option').val() == 'link') {
    //     $('#link-div').show();
    //     $("#address-list-div").hide();
    //     $('.customforms').hide();
    //     $('#email-div').hide();
    //   } else if ($('.link_section_option').val() == 'customforms') {
    //     $('.customforms').show();
    //     $('#link-div').hide();
    //     $("#address-list-div").hide();
    //     $('#email-div').hide();
    //   } else if($('.link_section_option').val() == 'address' || $('.link_section_option').val() == 'google_map' ){
    //     $('#link-div').hide();
    //     $("#address-list-div").show();
    //     $('.customforms').hide();
    //     $('#email-div').hide();
    //   }else{
    //     $('#link-div').hide();
    //     $("#address-list-div").hide();
    //     $('.customforms').hide();
    //     $('#email-div').hide();
    //   }
  
    //   $(document).ready(function() {
    //     $(document).on('change', '.link_section_option', function() {
         
    //       if ($('.link_section_option').val() == 'email') {
    //         $('#link-div').hide();
    //         $("#address-list-div").hide();
    //         $('.customforms').hide();
    //         $('#email-div').show();
    //       } else if ($(this).val() == 'link') {
    //         $('#link-div').show();
    //         $("#address-list-div").hide();
    //         $('.customforms').hide();
    //         $('#email-div').hide();
    //       } else if ($('.link_section_option').val() == 'customforms') {
    //         $('.customforms').show();
    //         $('#link-div').hide();
    //         $("#address-list-div").hide();
    //         $('#email-div').hide();
    //       }  else if($(this).val() == 'address' || $(this).val() == 'google_map' ){
    //         $('#link-div').hide();
    //         $("#address-list-div").show();
    //         $('.customforms').hide();
    //         $('#email-div').hide();
    //       }else{
    //         $('#link-div').hide();
    //         $("#address-list-div").hide();
    //         $('.customforms').hide();
    //         $('#email-div').hide();
    //       }
    //     });
  
    // });
  </script>
@endsection('content')