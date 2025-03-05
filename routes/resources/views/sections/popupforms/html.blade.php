@include('sections.popupforms.styles')

<link href="<?= url('assets/multiselect/jquery.multiselect.css'); ?>" rel="stylesheet">
    <script src="<?= url('assets/multiselect/jquery.multiselect.js'); ?>"></script>
<?php $form_logo = $custom_form_logo; ?> 
<style>
    .formtitlereview{
        color: black;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        font-family: 'Arial';
    }

    .formtitlereview2{
        color: black;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        font-family: 'Arial';
    }

    .review-normal-text{
        font-size: 13px;
        margin-top: 10px;
    }

    .bg-review-modal{
        background: #e7f3fb;
        border-radius: 6px;
    }
    .mt-20px{
        margin-top:20px !important;
    }

    .review_white_div{
        background:white;
        padding: 12px;
    }

    .text-blue-review{
        color: #3FA8F9;
        font-size: 13px !important;
        font-weight: bolder !important;
        font-family: 'Arial';
    }
    .text-black-class{
        font-size: 12px;
        font-family: 'Arial';
        color: black;
        padding-top: 3px;
    }
    .normal-review-font{
        font-size: 12px;
        font-family: 'Arial';
    }

    .site-review-font{
        font-size: 14px;
        font-family: 'Arial';
    }

    .btn-primary-review {
        background: #3FA8F9 !important;
    }

    .btn-primary-review.btn.focus, .btn-primary-review.btn:focus, .btn-primary-review.btn:hover {
        color: white !important;
    }
    .review_text{
        background: inherit !important;
        font-size: 13px;
        color: #565656;
        font-family: 'Arial';
    }
    .mb-2px{
        margin-bottom: 4px;
    }

    .otp-input {
        width: 41px !important;
        height: 33px !important;
        text-align: center;
        font-size: 14px;
        margin-right: 10px;
    }
    .otp-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
    
</style>

<div class="modal fade in" id="after_review_modal" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-body contact bg-review-modal">
            <button type="button" class="close" style="z-index:22 !important;" data-dismiss="modal">&times;</button>
                <div class="row">
                    <div class="col-md-12 p-3">
                        <div class="formtitlereview" style="">
                        Please share your review on other plateforms
                        </div>
                        <div class="text-center review-normal-text mb-10 mt-2">You can easily copy & paste your review to other sites too!</div>
                        <div class="mt-20px review_white_div text-align-left">
                            <div class="text-blue-review">
                                Here's how you can do it:
                            </div>
                            <div class="text-black-class"> 
                                <p><b>1.Copy Your Review,</b> click on the 'copy icon' to copy your review to your clipboard.</p>
                                <p><b>2.Paste your review </b> on these platforms by clicking the links below. No need to rewrite it!</p>
                            </div>
                        </div>
                    
                        <div class="text-center">
                            <br>
                            <p class="text-black-class">
                                That's it! you can return and select another link to easily post on more review sites!
                            </p>
                            <br>
                            <div class="formtitlereview2" style="">
                                Thank you for review & support!
                            </div>
                            <br>
                            <button type="button" onclick="copytoClipboard()" class="btn btn-primary-review text-align-center text-white">Copy Review to clipboard</button>
                            <div class="label label-info btn-primary-review copy_message" style="display:none">Review Copied!</div>
                            <br>  <br>
                            <p class="normal-review-font text-center" style="display:contents">Paste your review to</p>
                            <br>
                        @php 
                        $colors = ['black','green','red','purple','orange','brown'];
                        $i= 0;
                        @endphp 

                            @if(getReviewSitesLinks())
                            <div class="col-md-12" style="margin-left:12%;">
                                @foreach(getReviewSitesLinks() as $link)
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-2" style="display:contents;">
                                @if(strpos($link->review_site_link, 'yelp') !== false)
                                    <img width="45px" src='<?= base_url('assets/uploads/' .get_current_url(). 'yelp-logo-274.png') ?>'>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-left" >
                                        <a class="site-review-font" href="{{$link->review_site_link}}" target="_blank"
                                        style="display: flex;flex-direction: column;justify-content: center;text-decoration:underline;color:<?php echo isset($colors[$i]) ? $colors[$i]: $colors[array_rand($colors,1)] ?>">
                                            {{$link->review_site_name}}
                                        </a>
                                    </div>
                                @elseif(strpos($link->review_site_link, 'google') !== false)
                                    <img width="45px" src='<?= base_url('assets/uploads/' .get_current_url(). 'google-logo-icon-png-transparent-background-osteopathy-16.png') ?>'>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-left" >
                                        <a class="site-review-font" href="{{$link->review_site_link}}" target="_blank"
                                        style="display: flex;flex-direction: column;justify-content: center;text-decoration:underline;color:<?php echo isset($colors[$i]) ? $colors[$i]: $colors[array_rand($colors,1)] ?>">
                                            {{$link->review_site_name}}
                                        </a>
                                    </div>
                                @else
                                <img width="45px" style="display:none;" src='<?= base_url('assets/uploads/' .get_current_url(). 'google-logo-icon-png-transparent-background-osteopathy-16.png') ?>'>
                                </div>
                                    <div class="col-md-6 d-flex justify-content-left"  style="margin-left:9%;">
                                        <a class="site-review-font" href="{{$link->review_site_link}}" target="_blank"
                                        style="display: flex;flex-direction: column;justify-content: center;text-decoration:underline;color:<?php echo isset($colors[$i]) ? $colors[$i]: $colors[array_rand($colors,1)] ?>">
                                            {{$link->review_site_name}}
                                        </a>
                                    </div>
                                @endif
                                    
                                </div>
                                    <br>

                                    @php $i++;@endphp 
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="">
                            <label class="mb-2px formtitlereview2"><b>Your review</b></label>
                            <textarea class="form-control review_text" rows="5" ></textarea>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(count($customFormsAll->toArray())>0){ ?>
    <?php foreach($customFormsAll as $single){ ?>
        <div class="modal fade in" style="overflow-y: auto;" id="modalcustomforms<?=getCustomformEncodedID($single->encoded_id)?>" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="">
                    <div class="modal-body contact">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <br>
                        <form action="<?= url('customformsAction') ?>" id="form<?=getCustomformEncodedID($single->encoded_id)?>" method="post" enctype="multipart/form-data" role="form" class="custom-form php-email-form no-box-shadow p-0">
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
                                <div class="formdescriptivetext"><?=nl2br($single->descriptive)?></div>
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
                            <input type="hidden" name="phone_number" id="hidden-phone-number" />
                            <input type="hidden" name="otp" id="otp" />
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

<div class="modal fade in custom-otp-modal" id="custom-otp-modal" tabindex="-1" role="dialog" aria-labelledby="customOtpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-otp-modal-header">
                <h5 class="modal-title custom-otp-modal-title" id="customOtpModalLabel">Enter OTP</h5>
                <button type="button" class="close custom-otp-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body custom-otp-modal-body">
                <p class="custom-otp-modal-text">Enter the 4 digits OTP you received on the provided number</p>
                <form id="custom-otp-form">
                    <div class="otp-input-container">
                        <input type="text" name="otp[]" class="otp-input" maxlength="1" id="otp-1" oninput="moveToNext(this, 'otp-2')" >
                        <input type="text" name="otp[]" class="otp-input" maxlength="1" id="otp-2" oninput="moveToNext(this, 'otp-3')" >
                        <input type="text" name="otp[]" class="otp-input" maxlength="1" id="otp-3" oninput="moveToNext(this, 'otp-4')" >
                        <input type="text" name="otp[]" class="otp-input" maxlength="1" id="otp-4" oninput="moveToNext(this, 'otp-4')" >
                    </div>
                    <div class="text-center">
                        <button type="submit" style="width: 135px;height: 36px;" class="btn btn-primary custom-otp-submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Phone Number Modal -->
<div class="modal fade in custom-phone-number-modal" id="custom-phone-number-modal" tabindex="-1" role="dialog" aria-labelledby="customPhoneNumberModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="height:240px;width: 600px;" role="document">
        <div class="modal-content">
            @csrf
            <div class="modal-header custom-modal-header">
                <h5 class="modal-title custom-modal-title" id="customPhoneNumberModalLabel">Enter Phone Number</h5>
                <button type="button" class="close custom-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body custom-modal-body">
                <p class="custom-modal-text">An OTP will be sent to the number entered below</p>
                <form id="custom-phone-number-form">
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <div class="input-group custom-input-group">
                            <div class="input-group-prepend custom-input-group-prepend d-flex justify-content-space-around">
                                <span class="input-group-text custom-input-group-text">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_2_676)">
                                            <mask id="mask0_2_676" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="19" height="18">
                                                <path d="M9.81812 18C14.7887 18 18.8181 13.9706 18.8181 9C18.8181 4.02944 14.7887 0 9.81812 0C4.84755 0 0.818115 4.02944 0.818115 9C0.818115 13.9706 4.84755 18 9.81812 18Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_2_676)">
                                                <path d="M9.81812 0H18.8181V2.25L17.6931 3.375L18.8181 4.5V6.75L17.6931 7.875L18.8181 9V11.25L17.6931 12.375L18.8181 13.5V15.75L9.81812 16.875L0.818115 15.75V13.5L1.94312 12.375L0.818115 11.25V9L9.81812 0Z" fill="#EEEEEE"/>
                                                <path d="M8.69312 2.25H18.8181V4.5H8.69312V2.25ZM8.69312 6.75H18.8181V9H9.81812L8.69312 6.75ZM0.818115 11.25H18.8181V13.5H0.818115V11.25ZM0.818115 15.75H18.8181V18H0.818115V15.75Z" fill="#D80027"/>
                                                <path d="M0.818115 0H9.81812V9H0.818115V0Z" fill="#0052B4"/>
                                                <path d="M7.39233 8.54297L9.39624 7.10156H6.9353L8.93921 8.54297L8.16577 6.1875L7.39233 8.54297ZM4.54468 8.54297L6.54858 7.10156H4.08765L6.09155 8.54297L5.31812 6.1875L4.54468 8.54297ZM1.69702 8.54297L3.70093 7.10156H1.23999L3.2439 8.54297L2.47046 6.1875L1.69702 8.54297ZM7.39233 5.69531L9.39624 4.25391H6.9353L8.93921 5.69531L8.16577 3.33984L7.39233 5.69531ZM4.54468 5.69531L6.54858 4.25391H4.08765L6.09155 5.69531L5.31812 3.33984L4.54468 5.69531ZM1.69702 5.69531L3.70093 4.25391H1.23999L3.2439 5.69531L2.47046 3.33984L1.69702 5.69531ZM7.39233 2.8125L9.39624 1.37109H6.9353L8.93921 2.8125L8.16577 0.457031L7.39233 2.8125ZM4.54468 2.8125L6.54858 1.37109H4.08765L6.09155 2.8125L5.31812 0.457031L4.54468 2.8125ZM1.69702 2.8125L3.70093 1.37109H1.23999L3.2439 2.8125L2.47046 0.457031L1.69702 2.8125Z" fill="#EEEEEE"/>
                                            </g>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_2_676">
                                                <rect width="18" height="18" fill="white" transform="translate(0.818115)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                                <span>US +1</span>
                            </div>
                            <input type="text" class="form-control custom-form-control" id="custom_phone_number" name="phone_number" placeholder="XXX XXX XXXX" maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required>
                        </div>
                    </div>
                </div>
                <div class="text-center otp-save">
                    <button type="submit" id="sendOtpBtn" style="width: 135px;height: 36px;" class="btn btn-primary btn-block custom-submit-btn">Send OTP</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('sections.popupforms.scripts')