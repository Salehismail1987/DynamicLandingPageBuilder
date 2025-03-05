@extends('admin.layout.dashboard')
@section('content')
 
<script>
    var all_sections = ['blog','businessinfo','crm_controls','frontend','custom_forms_maker','gallaries','onestep_images','quick_settings','business_hours','settings'];
    var subsections = [
      "blog","blog_category",
      "social_media","business_info_section","timezones","business_contact_info", "permissions","user_types","addresses","alert_banner",
      "contacts","contact_groups","email_management","email_templates","crm_settings","contacts_fields","unsubscribe_contacts",
      "title_and_banners","content_block","download_files","custom_forms","hyperlinks","faqs","review_and_staff",
      "custom_forms","custom_form_settings","custom_forms_report",
      "gallery_post","gallery_tiles","gallery_video","gallery_slider","stored_image_gallery","image_gallery_categories",
      "step-buttons",
      "audio_files", "header_text", "header_images", "newsfeed", "news_posts", "popup_alert",
            "alert_banner", "action_buttons",
      "rotating_schedule","set_schedule",
      "pulldown_menu","feature_stack_order","alternate_wide_header","scripts_and_favicon","notifications","seo_block","seo_settings","contact_boxes","contact_forms","master_title_fonts","theme","step_setup"

    ];
    // var subsections = ['title_and_banners_tip','content_block_tip','download_files_tip','hyperlinks_tip','faqs_tip','review_and_staff_tip','step-buttons_tip','rotating_schedule_tip','set_schedule_tip','audio_files_tip','header_text_tip','header_images_tip','news_posts_tip','popup_alert_tip','alert_banner_tip','gallery_post_tip','gallery_tiles_tip','social_media_tip','business_info_section_tip','business_contact_info_tip','stored_image_gallery_tip','image_gallery_categories_tip','permissions_tip',"user_types_tip","pulldown_menu_tip","feature_stack_order_tip","timezones_tip","alternate_wide_header_tip","scripts_and_favicon_tip","notifications_tip","seo_block_tip","seo_settings_tip","contact_boxes_tip","contact_forms_tip","master_title_fonts_tip","theme_tip","action_buttons_tip","step_setup"]
</script>
<div id="content">
  <div class="d-sm-flex justify-content-between">
    <div>
      <div class="title-1 text-color-blue2 mb-8">Welcome !</div>
      <div class="title-6 text-color-blue2 mb-18">Where would you like to start?</div>
    </div>
  </div>
  
  <div class="row mb-37">
    <div class="col-xl-4 col-md-6 mb-4 mobile-only">
        <div class="card-body text-center bg-light-blue " id="dashboard_menu_open">
          
            <div class="title-6 mb-17 dashboard-tile-text">D</div>
            <div class="title-8 text-color-grey3">Dashboard</div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card-body text-center bg-light-blue ">
          <a target="_blank" href="https://wiki.enfohub.com/">
            <img src="{{url('assets')}}/admin2/img/wiki.png" alt="" width="" class="mb-17">
            <div class="title-8 text-color-grey3">Wiki Page, How To's</div>
          </a>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card-body text-center bg-light-blue ">
          <a target="_blank" href="https://wiki.enfohub.com/">
            <img src="{{url('assets')}}/admin2/img/trubleshooting.png" alt="" width="" class="mb-17">
            <div class="title-8 text-color-grey3" >Troubleshooting</div>
          </a>
      </div>
    </div>
    
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card-body text-center bg-light-blue ">
          <?php //if(!empty($support_form)){ echo 'href="#support_form" data-toggle="modal"';} else { echo 'href="#" data-toggle="modal"';}?>
          <a target="_blank" href="https://defaultwebsite.enfohub.com/?pop=11" >
            <img src="{{url('assets')}}/admin2/img/support.png" alt="" width="" class="mb-17">
            <div class="title-8 text-color-grey3" >Contact Support</div>
          </a>
      </div>
    </div>
  </div>
  <div class="title-1 text-color-blue2 mb-16">What’s New</div>
  <div class="row mb-37">
    <?php if(isset($superadminmessages) && count($superadminmessages)>0){?> 
      <?php $i=0; foreach($superadminmessages as $row){ ?>
        <div class="col-md-12">
          <div class="message-body"> 
            <?php
              $message = $row->message;
              //fidning and repalcing shortcodes
              $links = get_links($row->id); 
            
              foreach($links as $link){
                $link_replace = "<a href='".$link->link_href."'><b>".$link->link_text."</b></a>";
              
                $message = str_replace('['.$link->link_code.']', $link_replace, $message);
              }
            ?>
            <h6><?=nl2br($message)?></h6>
          </div>
        </div>
      <?php } ?>  
    <?php } ?>  
  </div>
</div>
    <!-- Modal Support Form -->
    <?php 
    if(!empty($support_form)){

      $support_form = $support_form[0];
      
    ?>  
      <div class="modal fade" id="support_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelSupportForm">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelSupportForm" style='<?= ($support_form->form_title_color) ? 'color:' . $support_form->form_title_color . ';' : '' ?><?= ($support_form->form_title_size) ? 'font-size:' . $support_form->form_title_size . 'px;' : '' ?><?= ($support_form->form_title_font_family) ? 'font-family:' . getfontfamily($support_form->form_title_font_family) . ';' : '' ?>'>
                        <?= $support_form->form_title ?>
                <?php 
                if($support_form->form_subtitle && $support_form->form_subtitle !=""){
                  ?>
                  
                    <div style='<?= ($support_form->form_subtitle_color) ? 'color:' . $support_form->form_subtitle_color . ';' : '' ?><?= ($support_form->form_subtitle_size) ? 'font-size:' . $support_form->form_subtitle_size . 'px;' : '' ?><?= ($support_form->form_subtitle_font_family) ? 'font-family:' . getfontfamily($support_form->form_subtitle_font_family) . ';' : '' ?>'>
                        <?= $support_form->form_subtitle ?></div>
                  <?php 
                }
                ?>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ url('admin/dashboard/contactform') }}" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
                    
                <div class="modal-body">
                
                  <div class="row">
                    <div class="col-md-12">
                    
                        <input type="hidden" name="formemail" value="<?= $support_form->form_email ?>">
                        <div class="form-row">

                          <?php if ($support_form->form_fields) { ?>
                            <?php $form_fields = json_decode($support_form->form_fields);
                            $i = 0; ?>
                            <?php foreach ($form_fields as $sngl) { ?>
                              <?php if ($sngl->fieldtype == 'text') { ?>
                                <div class="col-md-12 form-group">
                                  <input type="text" name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" <?= ($sngl->required) ? 'required' : '' ?> />
                                  <div class="validate"></div>
                                </div>
                              <?php } elseif ($sngl->fieldtype == 'textarea') { ?>
                                <div class="form-group col-md-12">
                                  <textarea class="myinput2 " name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" <?= ($sngl->required) ? 'required' : '' ?> placeholder="<?= $sngl->fieldname ?>"></textarea>
                                  <div class="validate"></div>
                                </div>
                              <?php } else { ?>
                                <div class="col-md-12 form-group">
                                  <input style="padding-bottom: 40px;" type="file" <?= ($sngl->required) ? 'required' : '' ?> name="field<?= $i ?>|<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="file" placeholder="<?= $sngl->fieldname ?>" />
                                </div>
                              <?php } ?>
                            <?php $i++;
                            } ?>
                          <?php } ?>
                        
                    
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  
                  <div class="text-center"><button class="btn btn-info" type="submit">Send Message</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php 
    }
    ?>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
          <a href="login.html" class="btn btn-primary">Logout</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
           
          </div>
        </div>
      </div>
    </div>
  </div>
        </div>
      </div>
      <script src="{{ url('assets/front/') }}/vendor/php-email-form/validate.js"></script>
<script>
  $(document).ready(function() {
    var is_all_set = localStorage.getItem('all_tips');
    if(is_all_set =="0"){
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
      $("input[name='tippopups']").attr('checked',true);
      $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
    }
  });
  
</script>
@endsection('content')