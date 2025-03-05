<?php 
$contact_box_setting = $frontSections->where('slug','contact')->first();
$form1_setting = $frontSections->where('slug','contactForm1')->first();
if($contact_info_block_title->enable=='1' || $contactBoxSettings->enable_texting_box || $contactBoxSettings->enable_address_box || $contactBoxSettings->enable_email_box|| ($contactForms && count($contactForms)>0) || isset($_GET['editwebsite'])){ ?>
@include('sections.contact.styles')

<div id="contact">
  <section class="contact nopadding">
    <?php if($contact_info_block_title->enable=='1'){ ?>
      <div class="position-relative title_banners_outline" >
      @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=contact_boxes_title'/>
                    </div>
            </div>
        @endif
        <?php if ($contact_info_block_title->text) { ?>
            <<?= $contact_info_block_title->tag ?> class="titlefontfamily contact_info_blocks_title"><?= $contact_info_block_title->text ?></<?= $contact_info_block_title->tag ?>>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="position-relative contact_boxes_outline" >
    @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Contact Boxes' :buttons="isset($tutorial_action_buttons['contact_box']) ? $tutorial_action_buttons['contact_box']:'' " url='settings?block=contact_boxes_bluebar' :status="$contact_box_setting->section_enabled"/>
                    </div>
            </div>
    @endif
      <div class="container" data-aos="fade-up">
        <div class="row equal contact-equal" data-aos="fade-up" data-aos-delay="100" >
          <?php
          if ($contactBoxSettings->enable_address_box) {
          ?>
            <div class="col-lg-3 col-md-6  col-sm-6 col-xs-12 mb-10px" >
              <div class="info-box mb-4" >
                <i class="bx bx-map"></i>
                <h3 class="contact_box_title {{$contact_box_address_title->slug}}" style="
                    @if($contact_box_address_title->size_web) font-size:{{$contact_box_address_title->size_web.'px'}};@endif
                    @if($contact_box_address_title->color) color:{{$contact_box_address_title->color}};@endif" >
                  <?php if ($contact_box_address_title->text) {
                    echo $contact_box_address_title->text;
                  } else {
                    echo 'Our Address';
                  } ?></h3>
                <p class="contact-p" >
                  <?php if (!empty($contact_box_address_text_1->text) || !empty($contact_box_address_text_2->text) || !empty($contact_box_address_text_3->text)) {
                    echo '<a class="contact-p" href="http://maps.google.com/maps?q='.$contact_box_address_text_1->text . ' ' . $contact_box_address_text_2->text. ' ' . $contact_box_address_text_3->text.'" target="_blank">';
                    echo ($contact_box_address_text_1->text) ? $contact_box_address_text_1->text . ' <br> ' : '';
                    echo ($contact_box_address_text_2->text) ? $contact_box_address_text_2->text . ' <br> ' : '';
                    echo ($contact_box_address_text_3->text) ? $contact_box_address_text_3->text : '';
                    echo '</a>';
                  } else {
                    echo 'No Address Added';
                  } ?></p>
              </div>
            </div>
          <?php
          }
          ?>

          <?php
          if ($contactBoxSettings->enable_email_box) {
          ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-10px" >
                <a href="mailto:<?php if ($contact_box_email_text->text) {
                          echo $contact_box_email_text->text;
                        } else {
                          echo 'example@gmail.com';
                        } ?>">
                  <div class="info-box  mb-4" style="<?php echo ($contactBoxSettings->background_color) ? 'background: ' . $contactBoxSettings->background_color . ';' : ''; ?>">
                    <i class="bx bx-envelope"></i>
                    <h3 class="contact_box_title {{$contact_box_email_title->slug}}" style="
                     @if($contact_box_email_title->size_web) font-size:{{$contact_box_email_title->size_web.'px'}};@endif
                    @if($contact_box_email_title->color) color:{{$contact_box_email_title->color}};@endif">
                      <?php if ($contact_box_email_title->text) {
                        echo $contact_box_email_title->text;
                      } else {
                        echo 'Email Us';
                      } ?></h3>
                    <p><a class="nodecoration {{$contact_box_email_text->slug}}" href="mailto:<?php if ($contact_box_email_text->text) {
                          echo $contact_box_email_text->text;
                        } else {
                          echo 'example@gmail.com';
                        } ?>" ><?php if ($contact_box_email_text->text) {
                                            echo $contact_box_email_text->text;
                                          } else {
                                            echo 'example@gmail.com';
                                          } ?></a></p>
                  </div>
              </a>
            </div>
          <?php
          }
          ?>

          <?php
          if ($contactBoxSettings->enable_texting_box) {
          ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-10px" >
                <a href="sms:<?php if ($contact_box_sms_title->text) {
                                                            echo $contact_box_sms_title->text;
                                                          } else {
                                                            echo '123456789';
                                                          } ?>">
                  <div class="info-box box-bg mb-4" >
                    <i class="bx bx-message"></i>
                    <h3 class="contact_box_title {{$contact_box_sms_title->slug}}" style="
                    @if($contact_box_sms_title->size_web) font-size:{{$contact_box_sms_title->size_web.'px'}};@endif
                    @if($contact_box_sms_title->color) color:{{$contact_box_sms_title->color}};@endif">
                      <?php if ($contact_box_sms_title->text) {
                        echo $contact_box_sms_title->text;
                      } else {
                        echo 'Text us';
                      } ?></h3>
                    <p><a class="nodecoration {{$contact_box_sms_text->slug}}" href="sms:<?php if ($contact_box_sms_text->text) {
                                                            echo $contact_box_sms_text->text;
                                                          } else {
                                                            echo '123456789';
                                                          } ?>" style=''><?php 
                                                          if ($contact_box_sms_text->text) {
                                                            echo $contact_box_sms_text->text;
                                                          } else {
                                                            echo '123456789';
                                                          }
                                                        ?></a>
                    </p>
                  </div>
              </a>
            </div>
          <?php
          }
          ?>

          <?php
          if ($contactBoxSettings->enable_phone_box) {
          ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-10px" >
                <a href="tel:<?php if ($contact_box_phone_text->text) {
                                                            echo $contact_box_phone_text->text;
                                                          } else {
                                                            echo '123456789';
                                                          } ?>">
                  <div class="info-box box-bg mb-4" >
                    <i class="bx bx-phone-call"></i>
                    <h3 class="contact_box_title {{$contact_box_phone_title->slug}}" style="
                    @if($contact_box_phone_title->size_web) font-size:{{$contact_box_phone_title->size_web.'px'}};@endif
                    @if($contact_box_phone_title->color) color:{{$contact_box_phone_title->color}};@endif">
                      <?php if ($contact_box_phone_title->text) {
                        echo $contact_box_phone_title->text;
                      } else {
                        echo 'Call us';
                      } ?></h3>
                    <p><a class="nodecoration {{$contact_box_phone_text->slug}}" href="tel:<?php if ($contact_box_phone_text->text) {
                                                            echo $contact_box_phone_text->text;
                                                          } else {
                                                            echo '123456789';
                                                          } ?>" style=''><?php 
                                                          if ($contact_box_phone_text->text) {
                                                            echo $contact_box_phone_text->text;
                                                          } else {
                                                            echo 'Call us';
                                                          }
                                                        ?></a>
                    </p>
                  </div>
              </a>
            </div>
          <?php
          }
          ?>

        </div>
      </div>
    </div>
    <div class="position-relative contact_forms_outline" >
    @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Contact Forms' :buttons="isset($tutorial_action_buttons['contact_forms']) ? $tutorial_action_buttons['contact_forms']:'' " url='settings?block=contact_forms_bluebar' :status="$form1_setting->section_enabled"/>
                    </div>
            </div>
    @endif
      <div class="container" data-aos="fade-up">
      <?php if (count($contactFormTitle->toArray())>0) { ?>
        <div class="section-title">
          <!-- (Hassan) Check either form enabled or disbaled (Begin) -->
          <?php
            $is_contact_form_enabled = false;
            foreach($frontSections as $obj){
              
              if($obj->slug == 'contactForm1' || $obj->slug == 'contactForm2'){
                if((!isset($_GET['editwebsite']) && $obj->section_enabled) || 
                (isset($_GET['editwebsite']) && (
                        ($obj->section_enabled && !$frontSectionSetting->all_feature_enable_on_edit) 
                        || 
                        ($frontSectionSetting->all_feature_enable_on_edit == 1 && $obj->edit_section_enabled)
                    )
                )){
                  $is_contact_form_enabled = true;
                  break;
                }
              }
            }
          ?>
          <!-- Check either form enabled or disbaled (End) -->

          <!-- (Hassan) Adding flag to check if enabled then show content -->
          <?php if($is_contact_form_enabled){ ?> 
            <?php foreach ($contactFormTitle as $single) { ?>
              @if ($single->text && $formSettings->enable)
              <<?= $formSettings->tag ?> class="titlefontfamily hidden-xs contact-form-title-{{$single->id}}" >
                <?= $single->text ?> 
              </<?= $formSettings->tag ?>>
              @endif
              @if ($single->tag  && $formSettings->enable)
              <<?= $formSettings->tag ?> class="titlefontfamily visible-xs contact-form-text-{{$single->id}}" >
                <?= $single->text ?>
              </<?= $formSettings->tag ?>>
              @endif
            <?php } ?>
          <?php } ?>
        </div>
      <?php } ?>

      <div id="google_map">
        <?php $contactmaxid = 0;
        if ($contactForms && $contactFormsCount>0) { ?>
          <?php foreach ($contactForms as $single) {
             $is_form_enabled= false;
              foreach ($frontSections as $section) {
                  if ('contactForm' . $single->id == $section->slug && ((!isset($_GET['editwebsite']) && $section->section_enabled) || 
                  (isset($_GET['editwebsite']) && (
                          ($section->section_enabled && !$frontSectionSetting->all_feature_enable_on_edit) 
                          || 
                          ($frontSectionSetting->all_feature_enable_on_edit == 1 && $section->edit_section_enabled)
                      )
                  ))) {
                    $is_form_enabled=  true;
                    break;
                  }
              }
            
            if ( $is_form_enabled) {
              if ($single->form_status == '1') { ?>

                <div id="contactForm<?= $single->id ?>" class="contactForm">
                  <div class="clearfix">
                  <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <?php
                    $form_class = 'col-lg-6';
                    if ($single->show_map && !empty($single->form_google_map)) {
                    ?>
                      <div class="col-lg-6">
                        <?= $single->form_google_map ?>
                      </div>
                    <?php
                    } else {
                      $form_class = 'col-lg-12';
                    }
                    ?>

                    <div class="<?= $form_class ?>">
                      <form action="<?= base_url('contactform') ?>" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
                      @csrf
                        <<?= $formSettings->tag ?> class="titlefontfamily contact-fontfamily-{{$single->id}}" >
                          <?= $single->form_title ?></<?= $formSettings->tag ?>>
                        <input type="hidden" name="formemail" value="<?= $single->form_email ?>">
                        <div class="form-row">

                          <?php if ($single->form_fields) { ?>
                            <?php $form_fields = json_decode($single->form_fields);
                            $i = 0; ?>
                            <?php foreach ($form_fields as $sngl) { ?>
                              <?php if ($sngl->fieldtype == 'text') { ?>
                                <div class="col form-group">
                                  <input type="<?=strtolower($sngl->fieldname)=='email'?'email':'text'?>" name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" />
                                  <div class="validate"></div>
                                </div>
                              <?php } elseif ($sngl->fieldtype == 'textarea') { ?>
                                <div class="form-group">
                                  <textarea class="form-control" name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" placeholder="<?= $sngl->fieldname ?>"></textarea>
                                  <div class="validate"></div>
                                </div>
                              <?php } else { ?>
                                <div class="col form-group">
                                  <input style="padding-bottom: 40px;" type="file" <?= ($sngl->required) ? 'required' : '' ?> name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="form-control" id="file" placeholder="<?= $sngl->fieldname ?>" />
                                </div>
                              <?php } ?>
                            <?php $i++;
                            } ?>
                          <?php } ?>
                          <input type="hidden" name="phone_number" id="hidden-phone-number" />
                          <input type="hidden" name="otp" id="otp" />
                            <div class="col form-group d-flex mt-5 otp-div" style="display: none;">
                            
                            </div>

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
                          <div class="text-center"><button type="submit">Send Message</button></div>
                      </form>
                    </div>
                  </div>
                  </div>
                </div>
      </div>
      <br>
        <?php }
              }
            }
          } ?>
      </div>
    </div>


    </div>
  </section><!-- End Contact Section -->
</div>
@include('sections.contact.scripts')
<?php } ?>