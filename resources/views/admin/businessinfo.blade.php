@extends('admin.layout.dashboard')
@section('content')
 
<script>
  var sub_sections = ["social_media","business_info_section","timezones","business_contact_info", "permissions","user_types","addresses","alert_banner"];
</script>



<?php 
$block = isset($_GET['block']) ? $_GET['block']:'';
?>
<div id="content">
  
  @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      {{ session()->get('error') }}
    </div>
  @endif
  @if(session()->has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
      {{ session()->get('success') }}
    </div>
  @endif
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center ">
        <div class="title-1 text-color-blue2">Business</div>
          <div class="d-md-flex d-lg-flex justify-content-center align-items-center">
          <div class="col-md-7 col-lg-5">
      <div class="row d-flex justify-content-around">
        <div class="col-4 title-2 mb-1" style="text-align: center;">Popup Alert</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Tip Popups</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Notifications</div>
    </div>
      <div class="row d-flex justify-content-around">
      <label class="myswitchdiv popupTool">
            <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
          </label>
          <label class="myswitchdiv">
            <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',subsections)">
            <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
          </label>
          <label class="myswitchdiv switch_disabled">
            <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
          </label>
      </div>
      <div class="row d-flex justify-content-around"> 
        <div class="col-4 col-sm-4 title-2 mb-1 popupOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1 tipOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Controls in Settings</div>
      </div>
    </div>
            <div class="ml-17 ">
                <div class="dropdown-list-main-div">
                    <div class="dropdown-list">
                        <div class="title-3 text-color-grey listtxt">Social Media</div>
                        <div>
                            <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
                        </div>
                    </div>
                    <div class="dropdown-list-div">
                        <ul>
                            <li data-value="alert_banner_bluebar">Business Info</li>
                            <!-- <li data-value="contact_info">Contact Info</li> -->
                            <li data-value="manager_recommendations">Recommendations</li>
                            <li data-value="social_media">Social Media</li>
                            <li data-value="addresses">Addresses</li>
                            <li data-value="timezones">T/zone</li>
                            <li data-value="user_types">Users</li>
                            <li data-value="permissions">Permissions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  @if (check_auth_permission(['business_info_section']) || check_auth_permission(['business_contact_info']))
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="alert_banner_bluebar" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="business_info_section">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue "><?= $controller_name ?></div>
                </div>
                <div class="d-flex  align-items-center">
                    
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='business_info'?'display:block;':''?>">
          <form action="{{url('updatebusinessinfo')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="business_name">Business name</label>
                  <input type="text" class="myinput2" name="business_name" id="business_name" value="<?= $businessInfo->business_name ?>" placeholder="Bisniess name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="business_phoneno">Business Phone Number</label>
                  <input type="text" class="myinput2" name="business_phoneno" id="business_phoneno" value="<?= $businessInfo->business_phoneno ?>" placeholder="+123456789">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_address">Business Address</label>
                  <input type="text" class="myinput2" name="contact_address" id="contact_address" value="<?= $businessInfo->contact_address ?>" placeholder="Contact Address">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="business_email">Business Email</label>
                  <input type="text" class="myinput2" name="business_email" id="business_email" value="<?= $businessInfo->contact_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="business_text_sms">Business Text (SMS)</label>
                  <input type="text" class="myinput2" name="business_text_sms" id="business_text_sms" value="<?= $businessInfo->business_text_sms ?>" placeholder="Business text (SMS)">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="business_owner_name">Business Owner Name</label>
                  <input type="text" class="myinput2" name="business_owner_name" id="business_owner_name" value="<?= $businessInfo->business_owner_name ?>" placeholder="Business owner name">
                </div>
              </div>
            </div>
             
              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_name">Business Contact Name</label>
                  <input type="text" class="myinput2" name="contact_name" id="contact_name" value="<?= $businessInfo->contact_name ?>" placeholder="Contact Name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_title">Business Contact Title</label>
                  <input type="text" class="myinput2" name="contact_title" id="contact_title" value="<?= $businessInfo->contact_title ?>" placeholder="Contact Title">
                </div>
              </div> -->
              <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_name">Contact Name</label>
                  <input type="text" class="myinput2" name="contact_name" id="contact_name" value="<?= $contactInfo->contact_name ?>" placeholder="Contact Name">
                </div>
              </div>
            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_phoneno">Contact Phone Number</label>
                  <input type="text" class="myinput2" name="contact_phoneno" id="contact_phoneno" value="<?= $contactInfo->contact_phoneno ?>" placeholder="+123456789">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_email">Contact Email</label>
                  <input type="text" class="myinput2" name="contact_email" id="contact_email" value="<?= $contactInfo->contact_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
            </div>

             <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="product_info">Product info</label>
                  <input type="text" class="myinput2" name="product_info" id="product_info" value="<?= $businessInfo->product_info ?>" placeholder="Product info">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="product_info">Header Display Name</label>
                  <input type="text" class="myinput2" name="header_display_name" id="header_display_name" value="<?= $businessInfo->header_display_name ?>" placeholder="Display Name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="referral_customer_number">Referral/Customer Number</label>
                  <input type="text" class="myinput2" name="referral_customer_number" id="referral_customer_number" value="<?= $businessInfo->referral_customer_number ?>" placeholder="Referral/Customer number">
                </div>
              </div>
            </div>
            <div class="row form-bottom make-sticky">
              <div class="col-md-12">
                <button type="submit" name="savebusniessinfo" class="btn btn-primary" value="save">Save</button>
                <button type="submit" name="savebusniessinfo" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                
              </div>
            </div>
          </form>
        </div>
    </div>
  @endif
  <!-- @if (check_auth_permission(['business_contact_info']))
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="contact_info"  data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="business_contact_info">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Contact Info</div>
                </div>
                <div class="d-flex  align-items-center">
                    
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                    </div>
                </div>
            </div>
        </div>
        <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='contact_info'?'display:block;':''?>">
          <form action="{{url('updatecontactinfo')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_name">Contact Name</label>
                  <input type="text" class="myinput2" name="contact_name" id="contact_name" value="<?= $contactInfo->contact_name ?>" placeholder="Contact Name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_email">Contact Email</label>
                  <input type="text" class="myinput2" name="contact_email" id="contact_email" value="<?= $contactInfo->contact_email ?>" placeholder="example@gmail.com">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contact_phoneno">Contact Phone Number</label>
                  <input type="text" class="myinput2" name="contact_phoneno" id="contact_phoneno" value="<?= $contactInfo->contact_phoneno ?>" placeholder="+123456789">
                </div>
              </div>
            </div>
            <div class="row form-bottom make-sticky">
              <div class="col-md-12">
                <button type="submit" name="savebusniesscontactinfo" class="btn btn-primary" value="save">Save</button>
                <button type="submit" name="savebusniesscontactinfo" class="btn btn-primary" value="savereminders">Save & send reminder</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  @endif -->
  @if (check_auth_permission(['business_info_section']))
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="manager_recommendations" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="business_info_section">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">App Manager Recommendations</div>
                </div>
                <div class="d-flex  align-items-center">
                    
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='manager_recommendations'?'display:block;':''?>">
          <form action="{{url('updaterecommendations')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bannertext">App Manager Name</label>
                  <input type="text" class="myinput2" name="manager_name" value="<?= $businessInfo->manager_name ?>" placeholder="Enter Name">
                </div>
              </div>

              <div class="col-md-4">
              <div class="form-group">
                  <label for="bannertext">App Manager Email</label>
                  <input type="text" class="myinput2" name="manager_email" value="<?= $businessInfo->manager_email ?>" placeholder="Enter Email">
                </div>
              </div>

              <div class="col-md-4">
              <div class="form-group">
                  <label for="bannertext">App Manager Mobile Number</label>
                  <input type="text" class="myinput2" name="mobile_number" value="<?= $businessInfo->manager_number ?>" placeholder="Enter Number">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="product_info">General Comments Based on Business Type & Opportunities</label>
                    <textarea rows="6" class="myinput2 p-2" name="recommendations_for_business_type" id="recommendations_for_business_type" placeholder="Enter comments"><?= $businessInfo->recommendations_for_business_type ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="product_info">Recommendations for Website & Marketing</label>
                  <textarea rows="6" class="myinput2 p-2" name="recommendations_for_website_marketing" id="recommendations_for_website_marketing" placeholder="Enter comments"><?= $businessInfo->recommendations_for_website_marketing ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="product_info">Recommendations regarding Social Media - Marketing</label>
                    <textarea rows="6" class="myinput2 p-2" name="recommendations_for_socialmedia_marketing" id="recommendations_for_socialmedia_marketing" placeholder="Enter comments"><?= $businessInfo->recommendations_for_socialmedia_marketing ?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="product_info">Other Vital Recommendations for Marketing and Business Exposure</label>
                  <textarea rows="6" class="myinput2 p-2" name="recommendations_for_marketing_and_business_exposure" id="recommendations_for_marketing_and_business_exposure" placeholder="Enter comments"><?= $businessInfo->recommendations_for_marketing_and_business_exposure ?></textarea>
                </div>
              </div>
            </div>
            <div class="row form-bottom make-sticky">
              <div class="col-md-12">
                <button type="submit" name="savebusniessinfo" class="btn btn-primary" value="save">Save</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  @endif
  @if (check_auth_permission(['social_media']))
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="social_media" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="social_media">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex  align-items-center">
                  <div class="title-1 text-color-blue ">Social Media</div>
              </div>
              <div class="d-flex  align-items-center">
                  
                  <div class=" ml-20">
                      <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                  </div>
              </div>
          </div>
      </div>
      <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='social_media'?'display:block;':''?>">
        <form action="{{url('updatesocialmedia')}}" method="post" enctype="multipart/form-data">
          @csrf
   
          <input type="hidden" name="delids" class="delids" value=""> 
          <?php $socialIcon = get_text_details('social_media_icon');?>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="social_icon_color">Icon color</label>
                <input type="color" class="myinput2" name="social_icon_color" id="social_icon_color" value="<?= $socialIcon->color ?>">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="social_icon_block_color">Icon block color</label>
                <input type="color" class="myinput2" name="social_icon_block_color" id="social_icon_block_color" value="<?= $socialIcon->bg_color ?>">
              </div>
            </div>
          </div>
          <div class="socialmediadiv">
            <?php if (count($socialMedia)>0) { ?>
              <?php foreach ($socialMedia as $single) { ?>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Header social media Icon</label>
                      <select class="myinput2" name="header_socialmedia[]">
                        <?php foreach ($icons as $singleico) { ?>
                          <option value="{{ $singleico->id }}" {{ $singleico->id == $single->icon_id ? 'selected' : '' }}>{{ $singleico->name }}</option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Header social media link</label>
                      <input type="text" class="myinput2" name="header_socialmedia_link[]" value="{{ $single->link }}" placeholder="https://facebook.com">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <br>
                    <input type="hidden" name="socialmediaid[]" value="{{$single->id}}"> 
                    <button type="button" class="btn btn-primary btnremoverow" data-id="{{$single->id}}">X</button>
                  </div>
                </div>
              <?php }  ?>
            <?php } else {  ?>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Header social media Icon</label>
                    <select class="myinput2" name="header_socialmedia[]">
                      <?php foreach ($icons as $singleico) { ?>
                        <option value="<?= $singleico->id ?>"><?= $singleico->name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Header social media link</label>
                    <input type="text" class="myinput2" name="header_socialmedia_link[]" value="" placeholder="https://facebook.com">
                  </div>
                </div>
              </div>
            <?php }  ?>
          </div>
          <div class="row">
            <div class="col-md-2">
              <button type="button" class="btn btn-primary btnaddnew">Add New</button>
            </div>
          </div>
          <br>
          <div class="row form-bottom make-sticky">
            <div class="col-md-12">
              <button type="submit" name="savesocialmedia" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="savesocialmedia" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
      </form>
      </div>
    </div>
  @endif
  <?php 
   $address_index = 0;  
  if (check_auth_permission(['addresses'])) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="addresses" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="addresses">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex  align-items-center">
                <div class="title-1 text-color-blue ">Address</div>
            </div>
            <div class="d-flex  align-items-center">
                
                <div class=" ml-20">
                    <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                </div>
            </div>
        </div>
    </div>
    <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='addresses'?'display:block;':''?>">
      <form action="{{url('updateaddress')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="delids" class="delids" value=""> 
        <div class="address_container">
          <?php 
          if(isset($addresses)){
            $count = 0;
            foreach($addresses as $address){
             
            ?>
              <div class="row" id="address_<?php echo  $address_index = $address_index+1;?>">
              <input type="hidden" name="old_address_id[]" value="<?=$address->id?>">
              <?php 
              if($count>0){
                ?>
                <div class="col-md-12">                    
                  <hr style="border-top: 5px solid rgba(0,0,0,.1)"></div>
                <?php
              }
              $count++;
              ?>
                <div class="col-md-3"> 
                  <div class="form-group">
                    <label>Address Title</label>
                    <input type="text" required class="myinput2" name="old_address_title[]"  placeholder="Address # 1 " value="<?=$address->address_title?>">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Street Address</label>
                      <input type="street" required class="myinput2" name="old_street[]"  placeholder="ABC #123 Street " value="<?=$address->street?>">
                    </div>
                  </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>City</label>
                    <input type="city" required class="myinput2" name="old_city[]"  placeholder="Brooklyn" value="<?=$address->city?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>ZipCode</label>
                    <input type="zip" required class="myinput2" name="old_zip_code[]"  placeholder="133112" value="<?=$address->zip_code?>">
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" required class="myinput2" name="old_state[]"  placeholder="New York" value="<?=$address->state?>">
                  </div>
                </div>
                
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" required class="myinput2" name="old_country[]"  placeholder="USA" value="<?=$address->country?>">
                  </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                    <button class="btn btn-info btnremoverow" type="button" data-id="<?=$address->id?>">X</button>
                  </div>
                </div>
                
              </div>
            <?php 
            }
          }
          ?>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn-info btn " onclick="new_address_div()">
              + Add More
            </button>
          </div>
        </div>
        <div class="row form-bottom make-sticky">
          <div class="col-md-12">
            <button type="submit" name="save_addresses" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="save_addresses" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php } ?>
  <?php if (check_auth_permission(['timezones'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="timezones" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="timezones">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex  align-items-center">
                  <div class="title-1 text-color-blue ">Time Zone</div>
              </div>
              <div class="d-flex  align-items-center">
                  
                  <div class=" ml-20">
                      <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                  </div>
              </div>
          </div>
      </div>
      <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='timezones'?'display:block;':''?>">
        <form action="{{url('updatetimezone')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Time Zone</label>
                <select class="myinput2" name="timezone">
                  <?php if (count($timeZones) > 0) { ?>
                    <?php foreach ($timeZones as $single) { ?>
                      <option value="<?= $single->id ?>" <?= $siteSettings->timezone == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <br>
          <div class="row form-bottom make-sticky">
            <div class="col-md-12">
              <button type="submit" name="save_timezone" class="btn btn-primary" value="save">Save</button>
              <button type="submit" name="save_timezone" class="btn btn-primary" value="savereminders">Save & send reminder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['user_types'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="user_types" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="user_types">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex  align-items-center">
                  <div class="title-1 text-color-blue ">Users</div>
              </div>
              <div class="d-flex  align-items-center">
                  
                  <div class=" ml-20">
                      <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                  </div>
              </div>
          </div>
      </div>
      <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='user_types'?'display:block;':''?>">
        <a href="{{ url('adduser') }}">
          <button type="button" class="btn btn-sm btn-primary">Add Admin user</button>
        </a>

        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role Type</th>
                <th> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($admin_users) > 0) { ?>
                <?php $i = 0;
                foreach ($admin_users as $row) { 
                  if(Auth::user()->admin_type == '1' || $row->get_user_role->ranking > getUserRollRank() || $row->id == Auth::user()->id){
                  $i++; ?>
                  <tr>
                    <td>
                      @if(isset($row->photo) && $row->photo )
                        <img src='{{ url("assets/uploads/") }}{{get_current_url().$row->photo}}' width="50" height="50">
                      @endif
                    
                    </td> 
                    <td><?= $row->name ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo isset($row->get_user_role)?$row->get_user_role->name:''; ?></td>
                    <?php if (Auth::user()->admin_type == '1' || $row->user_role > Auth::user()->user_role || $row->id == Auth::user()->id) { ?>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start">
                            <a class="dropdown-item" href="{{ url('edituser/' . $row->id . '/') }}">Edit</a>
                            <a class="dropdown-item" href="{{ url('deleteuser/' . $row->id . '/') }}" onclick="return confirm('Are You Sure?');">Delete</a>
                          </div>
                        </div>
                      </td>
                    <?php } ?>
                  </tr>
                <?php } }
              } else { ?>
                <tr>
                  <td colspan="3" class="text-center"> No record Found </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        
        </div>
      </div>
    </div>
  <?php } ?>
  <?php if (check_auth_permission(['permissions'])) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="permissions" data-top="alert_banner_top" data-bottom="alert_banner_bottom" data-tip_section="permissions">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex  align-items-center">
                  <div class="title-1 text-color-blue ">Permissions & Roles</div>
              </div>
              <div class="d-flex  align-items-center">
                  
                  <div class=" ml-20">
                      <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                  </div>
              </div>
          </div>
      </div>
      <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='permissions'?'display:block;':''?>">
        <a href="{{ url('addusersrole') }}"><button type="button" class="btn btn-sm btn-primary">Add User Type</button></a>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($userRolls) > 0) { ?>
                    <?php $i = 1;
                    foreach ($userRolls as $row) {  ?>
                      <?php if (Auth::user()->admin_type == '1' || $row->ranking > getUserRollRank()) { ?>
                      <tr>
                        <td><?= $row->name ?></td>
                        <td>
                          <?php if ($row->ranking != '1') { ?>
                            <a class="btn btn-primary" href="{{ url('editpermissions/' . $row->id) }}">Permissions </a>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($row->ranking != '1') { ?>
                          <div class="btn-group">
                            <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a class="dropdown-item" href="{{ url('editusersrole/' . $row->id . '/') }}">Edit</a>
                              <a class="dropdown-item" href="{{ url('deleteusersrole/' . $row->id . '/') }}" onclick="return confirm('Are You Sure?');">Delete</a>
                            </div>
                          </div>
                        <?php } ?>
                        </td>
                      </tr>
                    <?php $i++; } }
                  } else { ?>
                    <tr>
                      <td colspan="3" class="text-center"> No record Found </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
      </div>
    </div>
  <?php } ?>

</div>

<div class="socialmediatrmplatediv" style="display:none;">
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label>Header social media Icon</label>

        <select class="myinput2" name="header_socialmedia[]">
          <?php foreach ($icons as $singleico) { ?>
            <option value="<?= $singleico->id ?>"><?= $singleico->name ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Header social media link</label>
        <input type="text" class="myinput2" name="header_socialmedia_link[]" value="" placeholder="https://facebook.com">
      </div>
    </div>
    <div class="col-md-2">
      <br>
      <button type="button" class="btn btn-primary btnremoverow">X</button>
    </div>
  </div>
</div>



<script>

<?php 
  
  if(isset($block) && $block !=""){
    ?>
  
  var id = "<?=$block?>";
      
      
        
          $('#'+id).closest('.content').find('.editcontent').show('slow');
          $('#'+id).closest('.content').find('.form-bottom').addClass('make-sticky');
          var section_start = $('#'+id).data('top');
          var section_end = $('#'+id).data('bottom');
          
          setTimeout(() => {
            $('html, body').animate({
          scrollTop: $('#' + id).offset().top - 60
        }, 100);
          }, 1000);
        
      
        $('#' + id).stop(true, true).addClass("locator-bg");
        setTimeout(() => {
          $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
        }, 5000);
          var tip_section = $('#'+id).data('tip_section');
         
          if (typeof(tip_section) != 'undefined') {
            openTip(tip_section);
          }
          <?php
    }
  ?>
  var index_address = <?= $address_index; ?>;
  function  new_address_div(){

    index_address++;
    var html=  ' <div class="row" id="address_'+index_address+'"> <div class="col-md-12">                    <hr style="border-top: 5px solid rgba(0,0,0,.1)"></div><div class="col-md-3"> <div class="form-group"><label>Address Title</label><input type="text" required class="myinput2" name="address_title[]" value="" placeholder="Address # 1 "></div></div><div class="col-md-6"> <div class="form-group"><label>Street Address</label><input type="text" required class="myinput2" name="street[]" value="" placeholder="ABC #123 Street "></div>  </div>  <div class="col-md-3">           <div class="form-group">    <label>City</label> <input type="text" required class="myinput2" name="city[]" value="" placeholder="Brooklyn">      </div>  </div> <div class="col-md-3"> <div class="form-group"> <label>ZipCode</label> <input type="text" required class="myinput2" name="zip_code[]" value="" placeholder="133112"> </div> </div><div class="col-md-3"><div class="form-group"> <label>State</label> <input type="text" required class="myinput2" name="state[]" value="" placeholder="New York"> </div> </div><div class="col-md-3"><div class="form-group"><label>Country</label>  <input type="text" required class="myinput2" name="country[]" value="" placeholder="USA">  </div></div> <div class="col-md-1"><div class="form-group"><button class="btn btn-info" type="button" onclick="remove_address('+index_address+')">X</button></div></div></div>';

    $(".address_container").append(html);

  }
  $(document).ready(function() {
     checkSeeTips(sub_sections);
     popupStatus();
     var is_disabled = isTipsDisabled('businessinfo');
    
    if(is_disabled){
      
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
                $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
      $("input[name='tippopups']").prop('checked',true);  
    }
  });

  $(document).on('click', '.btnaddnew', function() {
    $('.socialmediadiv').append($('.socialmediatrmplatediv').html());
  });

  $(document).on('click', '.btnremoverow', function() {
    var id = $(this).data('id');
    var val = $(this).closest('form').find('.delids').val();
    $(this).closest('form').find('.delids').val(val+","+id);
    $(this).closest('.row').remove();
  });
</script>
@endsection('content')