@extends('admin.layout.dashboard')
@section('content')

<script>
  var all_sections = ['blog', 'businessinfo', 'crm_controls', 'frontend', 'custom_forms_maker', 'gallaries', 'onestep_images', 'quick_settings', 'business_hours', 'settings'];
  var subsections = [
    "blog", "blog_category",
    "social_media", "business_info_section", "timezones", "business_contact_info", "permissions", "user_types", "addresses", "alert_banner",
    "contacts", "contact_groups", "email_management", "email_templates", "crm_settings", "contacts_fields", "unsubscribe_contacts",
    "title_and_banners", "content_block", "download_files", "custom_forms", "hyperlinks", "faqs", "review_and_staff",
    "custom_forms", "custom_form_settings", "custom_forms_report",
    "gallery_post", "gallery_tiles", "gallery_video", "gallery_slider", "stored_image_gallery", "image_gallery_categories",
    "step-buttons",
    "audio_files", "header_text", "header_images", "newsfeed", "news_posts", "popup_alert",
    "alert_banner", "action_buttons",
    "rotating_schedule", "set_schedule",
    "pulldown_menu", "feature_stack_order", "alternate_wide_header", "scripts_and_favicon", "notifications", "seo_block", "seo_settings", "contact_boxes", "contact_forms", "master_title_fonts", "theme", "step_setup"

  ];
  // var subsections = ['title_and_banners_tip','content_block_tip','download_files_tip','hyperlinks_tip','faqs_tip','review_and_staff_tip','step-buttons_tip','rotating_schedule_tip','set_schedule_tip','audio_files_tip','header_text_tip','header_images_tip','news_posts_tip','popup_alert_tip','alert_banner_tip','gallery_post_tip','gallery_tiles_tip','social_media_tip','business_info_section_tip','business_contact_info_tip','stored_image_gallery_tip','image_gallery_categories_tip','permissions_tip',"user_types_tip","pulldown_menu_tip","feature_stack_order_tip","timezones_tip","alternate_wide_header_tip","scripts_and_favicon_tip","notifications_tip","seo_block_tip","seo_settings_tip","contact_boxes_tip","contact_forms_tip","master_title_fonts_tip","theme_tip","action_buttons_tip","step_setup"]
</script>
<style>
  .custom-switch {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 20px;
  }

  .comments-container {
    max-height: 300px;
    /* You can adjust this based on your design */
    overflow-y: auto;
    /* Makes the container scrollable if content overflows */
    padding-right: 10px;
    /* Optional: add some padding to the right */
  }

  .form-group {
    display: flex;
    align-items: center;
    gap: 10px;
    /* Adjust the gap between the switch and the label if needed */
  }

  .custom-switch input:checked+.custom-slider {
    background-color: #ccc;

  }


  .custom-switch input:checked+.custom-slider:before {
    transform: translateX(18px);
    /* Move thumb to the right */
  }
</style>
<div id="content">
  <div class="d-sm-flex justify-content-between mb-3">
    <div class="col-md-4">
      <div class="title-1 text-color-blue2 mb-8">Welcome !</div>
      <div class="title-6 text-color-blue2 mb-18">Where would you like to start?</div>
    </div>
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
  </div>


  <div class="row mb-37">
    <div class="col-xl-4 col-md-6 mb-4 mobile-only">
      <div class="card-body text-center bg-light-blue " id="dashboard_menu_open">
        <div class="title-6 mb-17 dashboard-tile-text">D</div>
        <div class="title-8 text-color-grey3">Dashboard</div>
      </div>

    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4 clickable">
      <div class="card-body text-center bg-light-blue engagement">
        <a>
          <svg width="44" height="62" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.30388 0.859375C12.4159 0.859375 15.7484 4.19186 15.7484 8.30388C15.7484 11.7923 13.3489 14.7204 10.1114 15.5267L8.30388 18.6569L6.49636 15.5267C3.25892 14.7203 0.859375 11.7923 0.859375 8.30388C0.859375 4.19186 4.19435 0.859375 8.30388 0.859375ZM30.9784 38.759H43.1415V34.7518C43.1415 32.1574 41.0343 30.5082 38.3523 29.8018C36.4911 31.7189 33.8748 31.7189 32.0113 29.8018C29.6484 30.4254 27.7288 31.7823 27.3097 33.8748C29.2805 34.8248 30.8273 36.4277 30.9784 38.759ZM14.0431 43.1414H29.9601V39.1341C29.9601 36.5398 27.8529 34.8905 25.1709 34.1865C23.3098 36.1012 20.6935 36.1012 18.8299 34.1865C16.1503 34.8929 14.0431 36.5398 14.0431 39.1341V43.1414ZM0.859375 38.7591H13.0225C13.1734 36.4279 14.7203 34.8249 16.6935 33.8748C16.2721 31.7823 14.3549 30.4255 11.9896 29.8018C10.1284 31.719 7.51214 31.719 5.64859 29.8018C2.96897 30.5082 0.859375 32.1575 0.859375 34.7518V38.7591ZM35.183 30.2111C32.764 30.1672 31.1587 27.3951 31.1587 25.0857C31.1587 20.0261 39.2074 20.0261 39.2074 25.0857C39.2074 27.3951 37.602 30.1672 35.1831 30.2111H35.183ZM8.82037 30.2111C6.4014 30.1672 4.79359 27.3951 4.79359 25.0857C4.79359 20.0261 12.8447 20.0261 12.8447 25.0857C12.8447 27.3951 11.2368 30.1672 8.82037 30.2111ZM22.0017 34.5935C19.5828 34.5496 17.9774 31.7774 17.9774 29.4681C17.9774 24.4109 26.0261 24.4109 26.0261 29.4681C26.0261 31.7774 24.4182 34.5496 22.0017 34.5935ZM18.5743 14.5109C18.5573 14.2722 18.3502 14.0748 18.109 14.0748H16.5816C16.3283 14.0748 16.1164 14.2868 16.1164 14.5401L16.1188 21.9773C16.1188 22.2331 16.3234 22.4402 16.5816 22.4402L18.109 22.4426C18.3624 22.4426 18.5743 22.2307 18.5743 21.9773C18.5743 19.4926 18.4695 16.9859 18.5743 14.5109ZM25.9432 20.8348H25.3245C25.0394 20.8348 24.8081 20.6033 24.8081 20.3183C24.8081 20.0332 25.0395 19.8019 25.3245 19.8019H26.9615C27.7533 19.8019 27.7338 18.6106 26.9615 18.6106H25.651C25.3659 18.6106 25.137 18.3792 25.137 18.0966C25.137 17.8116 25.366 17.5801 25.651 17.5801H27.288C28.0797 17.5801 28.0626 16.389 27.288 16.389H25.9774C25.6949 16.389 25.4635 16.1575 25.4635 15.8725C25.4635 15.5874 25.6949 15.356 25.9774 15.356H27.288C28.0797 15.356 28.0626 14.1648 27.288 14.1648H25.3927C24.735 14.1648 24.2819 13.4924 24.5425 12.8811L25.5778 10.4499C25.931 9.59484 26.1674 8.54734 25.4463 8.01634C25.2612 7.87995 24.9664 7.72887 24.7983 7.74598C24.7228 7.75328 24.6351 7.83372 24.5913 7.91648L23.5195 10.5474C23.2564 11.1905 22.7887 11.6801 22.1553 11.9725C21.7461 12.1601 20.947 12.7787 20.3307 13.4389C19.9189 13.8799 19.6048 14.3061 19.6048 14.5546L19.6023 21.2293C19.6414 21.6752 19.8703 22.0308 20.36 22.0308L25.9433 22.0259C26.4622 22.0259 26.7424 21.3876 26.3624 21.0101C26.2552 20.9004 26.1066 20.8347 25.9433 20.8347L25.9432 20.8348ZM35.697 0.859375C39.809 0.859375 43.1415 4.19186 43.1415 8.30388C43.1415 11.7923 40.742 14.7204 37.5045 15.5267L35.697 18.6569L33.8895 15.5267C30.652 14.7203 28.2525 11.7923 28.2525 8.30388C28.2525 4.19186 31.585 0.859375 35.697 0.859375ZM35.697 5.3124C36.2159 4.58889 36.8662 4.21137 37.8261 4.21137C39.2852 4.21137 40.4716 5.39524 40.4716 6.85687C40.4716 8.04805 39.8967 9.21009 39.0368 10.3574C38.2061 11.4635 37.1342 12.5353 36.0624 13.6071C35.8602 13.8093 35.5338 13.8093 35.334 13.6071C34.2597 12.5352 33.1879 11.4634 32.3596 10.3574C31.4972 9.21009 30.9248 8.04805 30.9248 6.85687C30.9248 5.39524 32.1087 4.21137 33.5679 4.21137C34.5301 4.21137 35.1805 4.58898 35.697 5.3124ZM36.8834 5.52681C36.6178 5.73873 36.3913 6.08463 36.1574 6.55239C35.9698 6.93 35.429 6.93241 35.239 6.5548C34.8225 5.72404 34.4644 5.24176 33.5679 5.24176C32.6788 5.24176 31.9553 5.96527 31.9553 6.85678C31.9553 7.7947 32.4449 8.76176 33.1806 9.74102C33.8602 10.6472 34.7664 11.5802 35.697 12.5132C36.63 11.5802 37.5337 10.6472 38.2134 9.74102C41.1562 5.819 38.0112 4.62533 36.8834 5.52664V5.52681ZM5.45866 5.95066C5.17361 5.95066 4.94227 5.71923 4.94227 5.43426C4.94227 5.14929 5.1737 4.91786 5.45866 4.91786H11.1517C11.4367 4.91786 11.6657 5.14929 11.6657 5.43426C11.6657 5.71923 11.4366 5.95066 11.1517 5.95066H5.45866ZM5.45866 11.69C5.17361 11.69 4.94227 11.4586 4.94227 11.1735C4.94227 10.8885 5.1737 10.6595 5.45866 10.6595H11.1517C11.4367 10.6595 11.6657 10.8885 11.6657 11.1735C11.6657 11.4585 11.4366 11.69 11.1517 11.69H5.45866ZM5.45866 8.82028C5.17361 8.82028 4.94227 8.58885 4.94227 8.30388C4.94227 8.01891 5.1737 7.78989 5.45866 7.78989H11.1517C11.4367 7.78989 11.6657 8.01891 11.6657 8.30388C11.6657 8.58885 11.4366 8.82028 11.1517 8.82028H5.45866Z" fill="#767474" />
          </svg>

          <div class="title-8 text-color-grey3">Engagement</div>
        </a>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card-body text-center bg-light-blue ">
        <!-- <a target="_blank" href="https://wiki.enfohub.com/"> -->
        <svg width="44" height="62" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3984 40.6851V33.1469C18.157 33.177 15.8111 33.3771 13.5099 33.7909C14.7359 36.6567 17.0573 40.2747 20.3984 40.6851ZM28.0534 16.2326C28.0534 20.1279 13.9465 20.1279 13.9465 16.2326C13.9465 12.3373 17.1048 9.17941 21.0002 9.17941C24.8956 9.17941 28.0534 12.3373 28.0534 16.2326ZM17.7402 4.04077C17.7402 5.84125 19.1997 7.30073 21.0003 7.30073C22.8007 7.30073 24.2602 5.84125 24.2602 4.04077C24.2602 2.24081 22.8007 0.78125 21.0003 0.78125C19.1998 0.78125 17.7402 2.24081 17.7402 4.04077ZM26.5305 6.9782C26.5305 8.42883 27.7063 9.60454 29.1569 9.60454C30.6075 9.60454 31.7833 8.42874 31.7833 6.9782C31.7833 5.52809 30.6075 4.35221 29.1569 4.35221C27.7063 4.35221 26.5305 5.52801 26.5305 6.9782ZM14.6381 19.0461C13.5921 18.4448 12.7435 17.5385 12.7435 16.2326C12.7435 14.3939 13.345 12.6957 14.3617 11.3235C13.8784 11.1897 13.3694 11.1181 12.8435 11.1181C9.70523 11.1181 7.1608 13.6622 7.1608 16.8003C7.1608 18.7051 11.347 19.4535 14.6381 19.0461ZM34.8392 16.8004C34.8392 13.6623 32.2951 11.1181 29.1568 11.1181C28.631 11.1181 28.1218 11.1898 27.6385 11.3235C28.6551 12.6958 29.2565 14.3939 29.2565 16.2326C29.2565 17.5385 28.4079 18.4448 27.3619 19.0461C30.653 19.4535 34.8392 18.7051 34.8392 16.8004ZM10.2172 6.9782C10.2172 8.42883 11.393 9.60462 12.8436 9.60462C14.2941 9.60462 15.4699 8.42883 15.4699 6.9782C15.4699 5.52809 14.2941 4.35221 12.8436 4.35221C11.393 4.35221 10.2172 5.52809 10.2172 6.9782ZM7.04289 18.8916C4.4988 19.5226 0.375 19.015 0.375 17.3682C0.375 14.9871 2.30559 13.0567 4.68683 13.0567C5.43603 13.0567 6.14055 13.2479 6.7544 13.584C6.24608 14.5441 5.95776 15.6386 5.95776 16.8003C5.95767 17.6993 6.40755 18.3843 7.04289 18.8916ZM41.625 17.3682C41.625 19.015 37.5011 19.5225 34.9571 18.8915C35.5925 18.3842 36.0423 17.6992 36.0423 16.8003C36.0423 15.6386 35.7541 14.5442 35.2458 13.5841C35.8597 13.248 36.5642 13.0567 37.3135 13.0567C39.6947 13.0567 41.625 14.9871 41.625 17.3682ZM2.69402 9.91563C2.69402 11.0163 3.58623 11.9084 4.68683 11.9084C5.78743 11.9084 6.67955 11.0163 6.67955 9.91563C6.67955 8.81538 5.78743 7.92317 4.68683 7.92317C3.58623 7.92317 2.69402 8.81529 2.69402 9.91563ZM35.3207 9.91563C35.3207 11.0163 36.2129 11.9084 37.3135 11.9084C38.4141 11.9084 39.3062 11.0163 39.3062 9.91563C39.3062 8.81538 38.4141 7.92317 37.3135 7.92317C36.2129 7.92317 35.3207 8.81529 35.3207 9.91563ZM31.9902 22.0078C31.9286 26.0365 31.2498 29.777 30.1279 32.8965C32.2585 33.3673 34.2111 33.9994 35.9193 34.761C38.9686 31.3568 40.8697 26.9028 41.0142 22.0078H31.9902ZM35.0377 35.6847C32.0724 38.6003 28.203 40.5991 23.8885 41.2226C26.64 39.8501 28.5358 36.8081 29.689 34.0309C31.6524 34.4535 33.4533 35.0134 35.0377 35.6847ZM18.1115 41.2225C13.7967 40.599 9.92721 38.6 6.96194 35.6842C8.64081 34.9707 10.4506 34.4262 12.3096 34.0273C13.4629 36.8058 15.3588 39.8495 18.1115 41.2225ZM6.08048 34.7609C7.89788 33.9491 9.85958 33.336 11.8708 32.8928C10.7496 29.7741 10.0714 26.0348 10.0097 22.0078H0.985844C1.13022 26.9028 3.03133 31.3567 6.08048 34.7609ZM11.2131 22.0078H20.3984V31.9436C18.0155 31.9749 15.5123 32.1942 13.0581 32.6517C11.9487 29.6316 11.2751 25.9715 11.2131 22.0078ZM21.6016 22.0078H30.7869C30.7248 25.9727 30.0508 29.6338 28.9409 32.6545C26.6531 32.2261 24.1817 31.9772 21.6016 31.9436V22.0078ZM28.4889 33.7935C26.3396 33.405 24.0222 33.1791 21.6016 33.1469V40.6852C24.9419 40.2748 27.263 36.6585 28.4889 33.7935Z" fill="#767474" />
        </svg>


        <div class="title-8 text-color-grey3">Communityhub</div>
        </a>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card-body text-center bg-light-blue ">
        <?php
        ?>
        <a href="mailto:hello@enfohub.com">
          <img src="{{ url('assets/admin2/img/support.png') }}" alt="" width="" class="mb-17">
          <div class="title-8 text-color-grey3">Contact Support</div>
        </a>
      </div>
    </div>
  </div>
  <div class="title-1 text-color-blue2 mb-16">What’s New</div>
  <div class="row mb-37">
    <?php if (isset($superadminmessages) && count($superadminmessages) > 0) { ?>
      <?php $i = 0;
      foreach ($superadminmessages as $row) { ?>
        <div class="col-md-12 d-flex space-between mt-3">

          <div class="message-body">
            <?php
            $message = $row->message;
            //fidning and repalcing shortcodes
            $links = get_links($row->id);

            foreach ($links as $link) {
              $link_replace = "<a href='" . $link->link_href . "'><b>" . $link->link_text . "</b></a>";

              $message = str_replace('[' . $link->link_code . ']', $link_replace, $message);
            }
            ?>
            <h6><?= nl2br($message) ?></h6>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</div>
<!-- Modal Support Form -->
<?php
if (!empty($support_form)) {

  $support_form = $support_form[0];

?>
  <div class="modal fade" id="support_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelSupportForm">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelSupportForm" style='<?= ($support_form->form_title_color) ? 'color:' . $support_form->form_title_color . ';' : '' ?><?= ($support_form->form_title_size) ? 'font-size:' . $support_form->form_title_size . 'px;' : '' ?><?= ($support_form->form_title_font_family) ? 'font-family:' . getfontfamily($support_form->form_title_font_family) . ';' : '' ?>'>
            <?= $support_form->form_title ?>
            <?php
            if ($support_form->form_subtitle && $support_form->form_subtitle != "") {
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
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
<!-- Bootstrap Modal -->
<div class="modal fade" id="engagementModal" tabindex="-1" aria-labelledby="engagementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="col-12 br-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h5 class="modal-title mt-4" id="engagementModalLabel">Engagements</h5>
      </div>
      <div class="modal-body">
        <!-- Likes Section -->
        <div class="mb-1 mt-4 fw-bold pl-3">
          <div class="form-group custom-form-group">
            <label for="enableEngagement" class="toggle-label mb-0">Enable Engagement</label>
            <label class="custom-switch mb-0" id="toggle-container-{{isset($email_time->id) ? $email_time->id :''}}">
              <input type="checkbox" class="engagement-toggle" data-id="{{ isset($email_time->id) ? $email_time->id :'' }}" {{ isset($email_time->engagement_toggle) ? ( $email_time->engagement_toggle ? 'checked' : ''):'' }}>
              <span class="custom-slider round">
                <span class="thumb"></span>
              </span>
            </label>

            <label for="enableImageFeature" class="toggle-label mb-0">Enable Image Feature</label>
          </div>

          <text class="engagement-toggle-text">If the engagement feature is on, it will replace the image in alert banner and vice versa.</text>
        </div>
        <div class="mb-4 mt-2 fw-bold pl-3 pr-3 mb-3">
          <div class="blue-divider-line-2px mt-10px mb-10"></div>
        </div>
        <div class="mb-1 mt-4 fw-bold pl-3">

        </div>
        <div class="mb-1 mt-4 fw-bold pl-3">
        </div>
        <div class="mb-4 mt-4">
          <h6 class="fw-bold pl-3 mb-3"><svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M11.0156 0C10.2017 0 9.45542 0.25793 8.79765 0.766641C8.16703 1.25435 7.74718 1.87553 7.5 2.32723C7.25282 1.8755 6.83297 1.25435 6.20235 0.766641C5.54458 0.25793 4.79833 0 3.98438 0C1.71293 0 0 1.85792 0 4.3217C0 6.98344 2.137 8.80456 5.37214 11.5615C5.92151 12.0297 6.54422 12.5604 7.19145 13.1263C7.27676 13.2011 7.38633 13.2422 7.5 13.2422C7.61367 13.2422 7.72324 13.2011 7.80856 13.1264C8.45584 12.5603 9.07852 12.0296 9.62821 11.5612C12.863 8.80456 15 6.98344 15 4.3217C15 1.85792 13.2871 0 11.0156 0Z" fill="#3FA8F9" />
            </svg>
            <text>Likes</text>
          </h6>
          <div class="col-12 d-flex space-between mb-2">
            <div class=" business-box card-box">
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="align-svg-text"><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.6667 2.33206H11.3333V1.66537C11.3333 0.930031 10.7354 0.332031 10 0.332031H6C5.26466 0.332031 4.66666 0.93 4.66666 1.66537V2.33203H1.33334C0.597969 2.33206 0 2.93003 0 3.66537V5.66537C0 6.40075 0.597969 6.99872 1.33334 6.99872H6.66669V6.66537C6.66669 6.48112 6.81578 6.33203 7.00003 6.33203H9.00003C9.18428 6.33203 9.33337 6.48112 9.33337 6.66537V6.99872H14.6667C15.402 6.99872 16 6.40075 16 5.66537V3.66537C16 2.93003 15.402 2.33206 14.6667 2.33206ZM10 2.33206H6V1.66537H10V2.33206Z" fill="#3FA8F9" />
                    <path d="M15.8151 7.35942C15.7015 7.30311 15.5658 7.31614 15.4655 7.3923C15.2285 7.57167 14.9524 7.66639 14.6666 7.66639H9.33334V8.66639C9.33334 8.85064 9.18425 8.99973 9 8.99973H7C6.81575 8.99973 6.66666 8.85064 6.66666 8.66639V7.66639H1.33334C1.04753 7.66639 0.7715 7.57167 0.5345 7.3923C0.433906 7.31548 0.2985 7.30245 0.184875 7.35942C0.071625 7.41577 0 7.5313 0 7.65795V12.3331C0 13.0684 0.597969 13.6664 1.33334 13.6664H14.6667C15.402 13.6664 16 13.0685 16 12.3331V7.65795C16 7.5313 15.9284 7.41577 15.8151 7.35942Z" fill="#3FA8F9" />
                  </svg>
                  <text class="category-heading">Business</text>
                </div>
                <div class="main-count mt-1" data-likes="business" data-original="{{$engagements['total_likes']['business']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['total_likes']['business']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 24 hours</div>
                <div class="likes-data" data-likes="last_24_hours_business">{{$engagements['last_24_hours']['likes']['business']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 7 days</div>
                <div class="likes-data" data-likes="last_7_days_business">{{$engagements['last_7_days']['likes']['business']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 30 days</div>
                <div class="likes-data" data-likes="last_30_days_business">{{$engagements['last_30_days']['likes']['business']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 12 months</div>
                <div class="likes-data" data-likes="last_12_months_business">{{$engagements['last_12_months']['likes']['business']}}</div>
              </div>
            </div>
            <div class="  service-box card-box">
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="align-svg-text"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.46494 9.32439C5.92697 9.14989 5.41338 9.38451 4.95247 9.65136L3.06853 10.7421L4.46369 13.2073L4.81138 13.0065C4.87075 12.9724 4.93831 12.9655 4.99966 12.9819L8.70831 13.9748C9.17575 14.1001 9.61791 14.0435 10.0312 13.7891C11.7366 12.7418 13.4399 11.6911 15.144 10.6418C15.4032 10.4823 15.4368 10.0463 15.2832 9.79889C14.9445 9.25308 14.0062 9.70748 13.6164 9.93451L10.799 11.5755C10.5759 11.7054 10.3463 11.788 10.1081 11.828C9.87291 11.8675 9.63069 11.8648 9.37903 11.8245L9.04663 11.7706C9.03409 11.7686 9.02166 11.7668 9.00931 11.7638C8.37634 11.6337 7.76328 11.4358 7.14009 11.2689C7.00688 11.2333 6.92775 11.0964 6.96335 10.9632C6.99894 10.83 7.13581 10.7509 7.269 10.7865C7.87831 10.9497 8.48225 11.1459 9.09994 11.2736C9.41372 11.312 9.6726 11.213 9.75969 10.888C9.83869 10.5932 9.65278 10.3153 9.37428 10.2189C8.52819 10.064 7.70697 9.76711 7.06125 9.53367C6.8366 9.45248 6.63356 9.37908 6.46494 9.32439ZM9.78003 4.77392C9.92728 4.6267 10.1682 4.6267 10.3154 4.77392L10.6989 5.15748L11.7367 4.1197C11.8839 3.97248 12.1248 3.97248 12.2721 4.1197C12.4193 4.26692 12.4193 4.50783 12.2721 4.65505L10.974 5.95311C10.7863 6.1408 10.5353 6.06452 10.3688 5.89808L9.78 5.3093C9.63278 5.16205 9.63281 4.92114 9.78003 4.77392ZM14.4032 4.26855C14.3183 3.91177 14.1769 3.57092 13.9846 3.25867L14.2758 2.6028L13.5026 1.82958L12.8466 2.12095C12.5343 1.9287 12.1937 1.7873 11.8369 1.70239L11.5793 1.03289H10.4858L10.2281 1.70239C9.87138 1.7873 9.53069 1.9287 9.21847 2.12095L8.56241 1.82958L7.78919 2.60283L8.08053 3.25883C7.88825 3.57105 7.74684 3.9118 7.66197 4.26852L6.99253 4.5262V5.6197L7.66188 5.87733C7.74678 6.23411 7.88819 6.57495 8.0805 6.8872L7.78922 7.54305L8.56244 8.31627L9.2185 8.02489C9.53072 8.21714 9.87138 8.35855 10.2281 8.44342L10.4858 9.11292H11.5793L11.8369 8.44358C12.1937 8.3587 12.5345 8.21727 12.8468 8.02495L13.5026 8.31627L14.2758 7.54302L13.9845 6.88695C14.1767 6.57473 14.3181 6.23408 14.403 5.87736L15.0725 5.61967V4.52617L14.4032 4.26855ZM11.026 7.1818C9.84097 7.1818 8.88028 6.22111 8.88028 5.03605C8.88028 3.85095 9.84097 2.89027 11.026 2.89027C12.2111 2.89027 13.1718 3.85095 13.1718 5.03605C13.1718 6.22111 12.2111 7.1818 11.026 7.1818ZM4.67931 5.00527L5.02284 5.91005C5.03316 5.93723 5.05722 5.9547 5.08625 5.95611L6.05291 6.00323C6.11866 6.00642 6.14556 6.08927 6.09425 6.13048L5.33991 6.7368C5.31722 6.75502 5.30803 6.78327 5.31569 6.81136L5.56959 7.74527C5.58684 7.80877 5.51644 7.85995 5.46134 7.82392L4.6516 7.29386C4.62725 7.27792 4.59756 7.27792 4.57322 7.29386L3.7635 7.82392C3.70844 7.85995 3.638 7.8088 3.65525 7.74527L3.90916 6.81136C3.91678 6.7833 3.90763 6.75502 3.88494 6.7368L3.13059 6.13048C3.07928 6.08923 3.10619 6.00642 3.17194 6.00323L4.13859 5.95611C4.16766 5.9547 4.19169 5.93723 4.20203 5.91005L4.54553 5.00527C4.56872 4.94408 4.6561 4.94408 4.67931 5.00527ZM4.67931 0.666984L5.02281 1.57177C5.03316 1.59895 5.05719 1.61642 5.08625 1.61783L6.05288 1.66495C6.11863 1.66814 6.14553 1.75098 6.09422 1.7922L5.33988 2.39852C5.31722 2.41673 5.30803 2.44498 5.31566 2.47308L5.56956 3.40698C5.58684 3.47048 5.51641 3.52167 5.46131 3.48564L4.6516 2.95558C4.62725 2.93964 4.59753 2.93964 4.57322 2.95558L3.7635 3.48564C3.70844 3.5217 3.63797 3.47052 3.65525 3.40698L3.90916 2.47308C3.91678 2.44502 3.90759 2.41677 3.88494 2.39852L3.13059 1.7922C3.07928 1.75098 3.10622 1.66814 3.17194 1.66495L4.13859 1.61783C4.16766 1.61642 4.19169 1.59895 4.202 1.57177L4.54553 0.666984C4.56872 0.605797 4.65606 0.605797 4.67931 0.666984ZM4.51494 14.313L2.19097 10.2067C2.07859 10.0081 1.82422 9.93764 1.62566 10.05L0.835188 10.4974C0.636626 10.6098 0.566126 10.8641 0.678501 11.0627L3.0025 15.169C3.11488 15.3676 3.36925 15.4381 3.56781 15.3257L4.35828 14.8783C4.55678 14.766 4.62731 14.5115 4.51494 14.313ZM1.73972 11.3807C1.5855 11.4033 1.44219 11.2965 1.41963 11.1423C1.39709 10.9881 1.50381 10.8448 1.65806 10.8222C1.81228 10.7996 1.95559 10.9064 1.97816 11.0606C2.00069 11.2149 1.89394 11.3582 1.73972 11.3807Z" fill="#3FA8F9" />
                  </svg>
                  <text class="category-heading">Service</text>
                </div>
                <div class="main-count mt-1" data-likes="service" data-original="{{$engagements['total_likes']['service']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['total_likes']['service']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 24 hours</div>
                <div class="likes-data" data-likes="last_24_hours_service">{{$engagements['last_24_hours']['likes']['service']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 7 days</div>
                <div class="likes-data" data-likes="last_7_days_service">{{$engagements['last_7_days']['likes']['service']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 30 days</div>
                <div class="likes-data" data-likes="last_30_days_service">{{$engagements['last_30_days']['likes']['service']}}</div>
              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 12 months</div>
                <div class="likes-data" data-likes="last_12_months_service">{{$engagements['last_12_months']['likes']['service']}}</div>
              </div>
            </div>
            <div class=" website-box card-box">
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="align-svg-text">
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.6926 5C10.1651 2.55 9.04014 1 7.99964 1C6.95914 1 5.83414 2.55 5.30664 5H10.6926Z" fill="#3FA8F9" />
                    <path d="M5 8C4.99988 8.6689 5.04448 9.33705 5.1335 10H10.8665C10.9555 9.33705 11.0001 8.6689 11 8C11.0001 7.3311 10.9555 6.66295 10.8665 6H5.1335C5.04448 6.66295 4.99988 7.3311 5 8Z" fill="#3FA8F9" />
                    <path d="M5.30664 11C5.83414 13.45 6.95914 15 7.99964 15C9.04014 15 10.1651 13.45 10.6926 11H5.30664Z" fill="#3FA8F9" />
                    <path d="M11.7171 5.0005H14.8671C14.3938 3.92338 13.6746 2.97217 12.7673 2.22317C11.86 1.47416 10.7898 0.948213 9.64258 0.6875C10.5911 1.522 11.3351 3.065 11.7171 5.0005Z" fill="#3FA8F9" />
                    <path d="M15.2265 6H11.8765C11.959 6.66347 12.0002 7.33142 12 8C12 8.66859 11.9586 9.33654 11.876 10H15.226C15.5906 8.6916 15.5911 7.3084 15.2265 6Z" fill="#3FA8F9" />
                    <path d="M9.64258 15.313C10.79 15.0524 11.8604 14.5265 12.7679 13.7775C13.6754 13.0285 14.3947 12.0772 14.8681 11H11.7181C11.3351 12.9355 10.5911 14.4785 9.64258 15.313Z" fill="#3FA8F9" />
                    <path d="M4.28281 11H1.13281C1.60621 12.0772 2.3255 13.0285 3.23298 13.7775C4.14046 14.5265 5.21086 15.0524 6.35831 15.313C5.40881 14.4785 4.66481 12.9355 4.28281 11Z" fill="#3FA8F9" />
                    <path d="M6.35734 0.6875C5.20989 0.948071 4.13948 1.47396 3.232 2.22297C2.32452 2.97198 1.60523 3.92327 1.13184 5.0005H4.28184C4.66484 3.065 5.40884 1.522 6.35734 0.6875Z" fill="#3FA8F9" />
                    <path d="M4.00045 8C4.00039 7.33141 4.0418 6.66346 4.12445 6H0.774452C0.409818 7.3084 0.409818 8.6916 0.774452 10H4.12445C4.0418 9.33654 4.00039 8.66859 4.00045 8Z" fill="#3FA8F9" />
                  </svg>

                  <text class="category-heading">Website</text>
                </div>
                <div class="main-count mt-1" data-likes="website" data-original="{{$engagements['total_likes']['website']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['total_likes']['website']}}</div>

              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 24 hours</div>
                <div class="likes-data" data-likes="last_24_hours_website">{{$engagements['last_24_hours']['likes']['website']}}</div>

              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 7 days</div>
                <div class="likes-data" data-likes="last_7_days_website">{{$engagements['last_7_days']['likes']['website']}}</div>

              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 30 days</div>
                <div class="likes-data" data-likes="last_30_days_website">{{$engagements['last_30_days']['likes']['website']}}</div>

              </div>
              <div class="col-12 d-flex space-between pl-1 pr-1">
                <div class="sub-count">Last 12 months</div>
                <div class="likes-data" data-likes="last_12_months_website">{{$engagements['last_12_months']['likes']['website']}}</div>
              </div>
            </div>
          </div>

          <!-- Number of Visitors -->
          <div class="mb-4 mt-4 ">
            <h6 class="fw-bold pl-3 mb-3 align-svg-text"><svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.8348 7.00781H11.6748C11.793 7.33154 11.8576 7.68091 11.8576 8.04504V12.4293C11.8576 12.5811 11.8312 12.7269 11.7831 12.8624H13.701C14.4173 12.8624 15.0002 12.2796 15.0002 11.5632V9.17312C15.0002 7.97918 14.0288 7.00781 12.8348 7.00781Z" fill="#3FA8F9" />
                <path d="M3.14254 8.04504C3.14254 7.68088 3.20714 7.33154 3.32538 7.00781H2.16534C0.971369 7.00781 0 7.97918 0 9.17315V11.5632C0 12.2796 0.582804 12.8624 1.2992 12.8624H3.21704C3.16896 12.7268 3.14254 12.5811 3.14254 12.4293V8.04504Z" fill="#3FA8F9" />
                <path d="M8.82614 5.87891H6.17413C4.98016 5.87891 4.00879 6.85028 4.00879 8.04424V12.4285C4.00879 12.6677 4.20268 12.8616 4.44186 12.8616H10.5584C10.7976 12.8616 10.9915 12.6677 10.9915 12.4285V8.04424C10.9915 6.85028 10.0201 5.87891 8.82614 5.87891Z" fill="#3FA8F9" />
                <path d="M7.49959 0.136719C6.06369 0.136719 4.89551 1.3049 4.89551 2.74083C4.89551 3.71481 5.43308 4.56545 6.22697 5.01205C6.60352 5.22387 7.03764 5.34492 7.49959 5.34492C7.96155 5.34492 8.39567 5.22387 8.77222 5.01205C9.56614 4.56545 10.1037 3.71478 10.1037 2.74083C10.1037 1.30493 8.9355 0.136719 7.49959 0.136719Z" fill="#3FA8F9" />
                <path d="M2.92701 2.56641C1.85313 2.56641 0.979492 3.44004 0.979492 4.51392C0.979492 5.5878 1.85313 6.46143 2.92701 6.46143C3.19941 6.46143 3.4588 6.40501 3.69444 6.30358C4.10184 6.12818 4.43776 5.81769 4.64562 5.42878C4.79152 5.15582 4.87452 4.84442 4.87452 4.51392C4.87452 3.44007 4.00088 2.56641 2.92701 2.56641Z" fill="#3FA8F9" />
                <path d="M12.0725 2.56641C10.9986 2.56641 10.125 3.44004 10.125 4.51392C10.125 4.84445 10.208 5.15585 10.3539 5.42878C10.5618 5.81772 10.8977 6.12821 11.3051 6.30358C11.5407 6.40501 11.8001 6.46143 12.0725 6.46143C13.1464 6.46143 14.02 5.5878 14.02 4.51392C14.02 3.44004 13.1464 2.56641 12.0725 2.56641Z" fill="#3FA8F9" />
              </svg>
              Number of Visitors</h6>
              <span style="color: red;" class="pl-3 visitor-heading">Visitor count resets to zero daily, at 12:00 am</span>
            <div class="col-12 d-flex space-between mb-2">
              <div class=" business-box visitor-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 24 hours</div>
                  <div class="data-count mb-1" data-type="visitors" data-period="last_24" data-original="{{$engagements['last_24_hours']['visitors']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_24_hours']['visitors']}}</div>
                </div>
              </div>
              <div class="service-box visitor-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">
                    Last 7 days</div>
                  <div class="data-count mb-1" data-type="visitors" data-period="last_7" data-original="{{$engagements['last_7_days']['visitors']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_7_days']['visitors']}}</div>
                </div>
              </div>
              <div class=" website-box visitor-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 30 days</div>
                  <div class="data-count mb-1" data-type="visitors" data-period="last_30" data-original="{{$engagements['last_30_days']['visitors']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_30_days']['visitors']}}</div>
                </div>
              </div>
              <div class=" website-box visitor-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 12 months</div>
                  <div class="data-count mb-1" data-type="visitors" data-period="last_12" data-original="{{$engagements['last_12_months']['visitors']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_12_months']['visitors']}}</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Number of Clicks on Website -->
          <div class="mb-4">
            <h6 class="fw-bold pl-3 mb-3 align-svg-text"><svg width="9" height="13" viewBox="0 0 9 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.8914 6.07129C8.8914 5.62479 8.52618 5.24194 8.07954 5.24161C7.64496 5.24129 7.28993 5.5821 7.26759 6.01094C7.2672 6.01069 7.26682 6.01043 7.26644 6.0102V5.07238C7.26644 4.62379 6.90269 4.26011 6.45397 4.26011C6.00525 4.26011 5.6415 4.62379 5.6415 5.07238V4.09085C5.6415 3.64222 5.27775 3.27857 4.82903 3.27857C4.38031 3.27857 4.01656 3.64226 4.01656 4.09085V1.42556C4.01656 0.976935 3.65281 0.613281 3.2041 0.613281C2.75538 0.613281 2.39163 0.976935 2.39163 1.42556V6.9477L1.42499 5.98129C1.15429 5.71065 0.725858 5.67972 0.419095 5.90873C0.0976206 6.14867 0.0139346 6.59504 0.226979 6.93488C0.435313 7.26722 0.700089 7.72575 0.942653 8.15601C1.29211 8.77585 1.57272 9.4319 1.77579 10.1138C2.08057 11.1373 2.94547 12.8812 5.31201 12.9949C7.29198 13.0899 8.8914 11.3485 8.8914 9.35963C8.8914 9.33921 8.8914 6.07129 8.8914 6.07129Z" fill="#3FA8F9" />
              </svg>
              Number of Clicks on Website</h6>
              <span style="color: red;" class="pl-3 visitor-heading">Click count resets to zero daily, at 12:00 am</span>
            <div class="col-12 d-flex space-between mb-2">
              <div class="business-box clicks-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 24 hours</div>
                  <div class="data-count mb-1" data-type="clicks" data-period="last_24" data-original="{{$engagements['last_24_hours']['clicks']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_24_hours']['clicks']}}</div>
                </div>
              </div>
              <div class="  service-box clicks-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">
                    Last 7 days</div>
                  <div class="data-count mb-1" data-type="clicks" data-period="last_7" data-original="{{$engagements['last_7_days']['clicks']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_7_days']['clicks']}}</div>
                </div>
              </div>
              <div class=" website-box clicks-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 30 days</div>
                  <div class="data-count mb-1" data-type="clicks" data-period="last_30" data-original="{{$engagements['last_30_days']['clicks']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_30_days']['clicks']}}</div>
                </div>
              </div>
              <div class=" website-box clicks-box">
                <div class="col-12 d-flex flex-column space-between pl-1 pr-1">
                  <div class="visitor-heading">Last 12 months</div>
                  <div class="data-count mb-1" data-type="clicks" data-period="last_12" data-original="{{$engagements['last_12_months']['clicks']}}" contenteditable="{{ $notification_edit ? 'true' : 'false' }}">{{$engagements['last_12_months']['clicks']}}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="blue-divider-line-2px mt-10px mb-10"></div>
          <!-- Comments Section -->
          <div class="mb-4">
            <h6 class="fw-bold pl-3 mb-3">All Comments</h6>
            <div class="comments-container">
              @foreach($engagements['comments'] as $comment)
              <div class="mb-3  pb-2 pl-3 comment-{{$comment->id}} covered-border">
                <p class="mb-1">
                  {{$comment->comment}}. <br> <span class="text-muted italic">{{\Carbon\Carbon::parse($comment->created_at)->format('m-d-y h:iA')}} . Added by {{$comment->name ?? 'Not Disclosed'}}</span>
                </p>
                <div class="col-md-6 col-sm-12 col-xs-12 d-flex space-between p-0">
                  <div class="form-group m2-20">
                    <label class="switch">
                      <input type="checkbox" class="display-checkbox" data-id="{{$comment->id}}" @if($comment->display) checked @endif>
                      <span class="slider round"></span>
                    </label>
                    <label class="display-label" for="comment{{$comment->id}}">Display</label>
                  </div>

                  <!-- Remove Comment Logic -->
                  <div class="delete-comment" data-id="{{$comment->id}}">
                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M0.666667 10.6667C0.666667 11.4 1.26667 12 2 12H7.33333C8.06667 12 8.66667 11.4 8.66667 10.6667V2.66667H0.666667V10.6667ZM9.33333 0.666667H7L6.33333 0H3L2.33333 0.666667H0V2H9.33333V0.666667Z" fill="#3FA8F9" />
                    </svg>
                    <span class="remove-text clickable">Remove</span>
                  </div>

                  <!-- Pin/Unpin Comment Logic -->
                  @if($comment->pinned)
                  <div class="unpin-comment" data-id="{{$comment->id}}">
                    <svg class="pin" width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                      <path d="M8.25919 16C9.46149 14.7977 9.82135 13.0361 9.39187 11.3277L13.5687 7.15087L13.8636 7.44584C14.0983 7.68054 14.4166 7.81239 14.7485 7.81239C15.0805 7.81239 15.3988 7.68054 15.6335 7.44584C15.8682 7.21115 16 6.89284 16 6.56093C16 6.22903 15.8682 5.91071 15.6335 5.67602L10.324 0.366543C10.0893 0.131849 9.77098 0 9.43907 0C9.10716 0 8.78885 0.131849 8.55416 0.366543C8.31946 0.601236 8.18761 0.919549 8.18761 1.25146C8.18761 1.58336 8.31946 1.90167 8.55416 2.13637L8.84913 2.43134L4.67234 6.60813C2.96387 6.17865 1.2023 6.53851 0 7.74082L3.53965 11.2805L1.17988 13.6402C0.855416 13.9647 0.855416 14.4957 1.17988 14.8201C1.50435 15.1446 2.0353 15.1446 2.35977 14.8201L4.71953 12.4604L8.25919 16Z" fill="#3FA8F9" />
                    </svg>
                    <span class="pin-text clickable">Unpin Comment</span>
                  </div>
                  @else
                  <div class="pin-comment" data-id="{{$comment->id}}">
                    <svg class="pin" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="#ADADAD" xmlns="http://www.w3.org/2000/svg">
                      <path fill="#ADADAD" d="M8.25919 16C9.46149 14.7977 9.82135 13.0361 9.39187 11.3277L13.5687 7.15087L13.8636 7.44584C14.0983 7.68054 14.4166 7.81239 14.7485 7.81239C15.0805 7.81239 15.3988 7.68054 15.6335 7.44584C15.8682 7.21115 16 6.89284 16 6.56093C16 6.22903 15.8682 5.91071 15.6335 5.67602L10.324 0.366543C10.0893 0.131849 9.77098 0 9.43907 0C9.10716 0 8.78885 0.131849 8.55416 0.366543C8.31946 0.601236 8.18761 0.919549 8.18761 1.25146C8.18761 1.58336 8.31946 1.90167 8.55416 2.13637L8.84913 2.43134L4.67234 6.60813C2.96387 6.17865 1.2023 6.53851 0 7.74082L3.53965 11.2805L1.17988 13.6402C0.855416 13.9647 0.855416 14.4957 1.17988 14.8201C1.50435 15.1446 2.0353 15.1446 2.35977 14.8201L4.71953 12.4604L8.25919 16Z" fill="#3FA8F9" />
                    </svg>
                    <span class="pin-text clickable" style="color: #ADADAD;">Pin Comment</span>
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="blue-divider-line-2px mt-10px mb-10"></div>
          <!-- Notifications Section -->
          <div class="mb-4">
            <h6 class="fw-bold">Email for Notifications</h6>
            <span class="color-gry">Place a space & coma between addresses for multiple email addresses</span>
            <input type="text" id="emails" class="form-control bg-gray"
              value="{{ isset($email_time['emails']) ? implode(', ', $email_time['emails']) : '' }}"
              placeholder="Enter email">
          </div>

          <div class="mb-4">
            <h6 class="fw-bold">Notification Send Time</h6>
            <input type="time" id="time" class="form-control bg-gray"
              value="{{ isset($email_time['time']) && !empty($email_time['time']) ? \Carbon\Carbon::parse($email_time['time'])->format('H:i') : '20:00' }}">
          </div>


        </div>
        <!-- <div class="modal-footer"> -->
        <div class="col-12 text-center">
          <button id="save-modal-data" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
        </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>

<script src="{{ url('assets/front/') }}/vendor/php-email-form/validate.js"></script>
<script>
  $(document).ready(function() {
    // Function to fetch and update engagement data
    function updateEngagementData() {
      $.ajax({
        url: '/get-engagement-data', // The route to fetch the updated data
        type: 'GET',
        success: function(response) {
          // Update the likes, visitors, and clicks data in the modal
          updateModalData(response.engagements);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching data:', error);
        }
      });
    }

    // Function to update the modal data
    function updateModalData(engagements) {
      // Update likes for the categories
      $('[data-likes="business"]').text(engagements.total_likes.business);
      $('[data-likes="service"]').text(engagements.total_likes.service);
      $('[data-likes="website"]').text(engagements.total_likes.website);

      // Update the visitors data
      $('[data-type="visitors"][data-period="last_24"]').text(engagements.last_24_hours.visitors);
      $('[data-type="visitors"][data-period="last_7"]').text(engagements.last_7_days.visitors);
      $('[data-type="visitors"][data-period="last_30"]').text(engagements.last_30_days.visitors);
      $('[data-type="visitors"][data-period="last_12"]').text(engagements.last_12_months.visitors);

      // Update the clicks data
      $('[data-type="clicks"][data-period="last_24"]').text(engagements.last_24_hours.clicks);
      $('[data-type="clicks"][data-period="last_7"]').text(engagements.last_7_days.clicks);
      $('[data-type="clicks"][data-period="last_30"]').text(engagements.last_30_days.clicks);
      $('[data-type="clicks"][data-period="last_12"]').text(engagements.last_12_months.clicks);

      // Update the likes for each category within specific timeframes
      $('[data-likes="last_24_hours_business"]').text(engagements.last_24_hours.likes.business);
      $('[data-likes="last_24_hours_service"]').text(engagements.last_24_hours.likes.service);
      $('[data-likes="last_24_hours_website"]').text(engagements.last_24_hours.likes.website);

      $('[data-likes="last_7_days_business"]').text(engagements.last_7_days.likes.business);
      $('[data-likes="last_7_days_service"]').text(engagements.last_7_days.likes.service);
      $('[data-likes="last_7_days_website"]').text(engagements.last_7_days.likes.website);

      $('[data-likes="last_30_days_business"]').text(engagements.last_30_days.likes.business);
      $('[data-likes="last_30_days_service"]').text(engagements.last_30_days.likes.service);
      $('[data-likes="last_30_days_website"]').text(engagements.last_30_days.likes.website);

      $('[data-likes="last_12_months_business"]').text(engagements.last_12_months.likes.business);
      $('[data-likes="last_12_months_service"]').text(engagements.last_12_months.likes.service);
      $('[data-likes="last_12_months_website"]').text(engagements.last_12_months.likes.website);
    }

    // Call the function initially
    updateEngagementData();

    // Set an interval to update the data every 10 seconds
    setInterval(updateEngagementData, 10000); // 10000 milliseconds = 10 seconds



    $('.engagement-toggle').on('change', function() {
      const toggle = $(this);
      const id = toggle.data('id');
      const slider = toggle.siblings('.custom-slider'); // Find the slider sibling
      const isChecked = toggle.is(':checked') ? 1 : 0; // Determine toggle state
      console.log('Checked:', $(this).is(':checked'));
      $.ajax({
        url: '/update-engagement-toggle',
        type: 'POST',
        data: {
          id: id,
          engagement_toggle: isChecked,
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            // Update UI dynamically
            if (response.engagement_toggle == '1') {
              slider.css('background-color', '#ccc'); // Unchecked: background to gray
            } else {
              slider.css('background-color', '#2196F3'); // Checked: background to black
            }
          } else {
            alert('Failed to update the toggle. Please try again.');
          }
        },
        error: function() {
          alert('An error occurred while updating the toggle.');
        }
      });
    });
    $('.real-time-toggle').on('change', function() {
      const toggle = $(this);
      const id = toggle.data('id');
      const slider = toggle.siblings('.custom-slider'); // Find the slider sibling
      const isChecked = toggle.is(':checked') ? 1 : 0; // Determine toggle state
      console.log('Checked:', $(this).is(':checked'));
      $.ajax({
        url: '/update-real-time-engagement-toggle',
        type: 'POST',
        data: {
          id: id,
          real_time_toggle: isChecked,
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            // Update UI dynamically
            if (response.is_real_time == '1') {
              slider.css('background-color', '#ccc'); // Unchecked: background to gray
            } else {
              slider.css('background-color', '#2196F3'); // Checked: background to black
            }
          } else {
            alert('Failed to update the toggle. Please try again.');
          }
        },
        error: function() {
          alert('An error occurred while updating the toggle.');
        }
      });
    });




    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('open_modal') && urlParams.get('open_modal') === 'true') {
      // Open the modal
      $('#engagementModal').modal('show');
    }
    $('.main-count').on('keydown', function(e) {
      // Allow backspace, delete, and numbers only
      if (
        e.key === 'Backspace' ||
        e.key === 'Delete' ||
        e.key === '.' || // Allow decimal point
        (e.key >= '0' && e.key <= '9')
      ) {
        return true; // Allow the key press
      }

      // Prevent all other key presses
      e.preventDefault();
    });
    $('#save-modal-data').click(function() {
      let updatedData = {};
      let updatedPeriodData = {};
      let time = $('#time').val();
      let emails = $('#emails').val();

      // Split emails into an array, trim spaces
      let emailArray = emails ? emails.split(',').map(email => email.trim()) : [];
      $('#engagementModal').modal('hide');
      // Iterate through each editable div
      $('.main-count').each(function() {
        const key = $(this).data('likes'); // Get the key
        const originalValue = $(this).data('original'); // Get the original value
        const currentValue = +$(this).text().trim(); // Convert to number

        // Check if the value was changed
        if (originalValue !== currentValue) {
          updatedData[key] = currentValue; // Add to the update object
        }
      });

      $('.data-count').each(function() {
        const key = $(this).data('type'); // Get the key
        const period = $(this).data('period'); // Get the period (e.g., last_24)
        const originalValue = $(this).data('original'); // Get the original value
        const currentValue = +$(this).text().trim(); // Convert to number

        // Check if the value was changed
        if (originalValue !== currentValue) {
          // Initialize the key object if it doesn't exist
          if (!updatedPeriodData[key]) {
            updatedPeriodData[key] = {}; // Initialize it as an empty object
          }
          updatedPeriodData[key][period] = currentValue; // Update the specific period
        }
      });

      // Check if there are changes or if time/emails are being submitted
      if (
        Object.keys(updatedData).length > 0 ||
        Object.keys(updatedPeriodData).length > 0 ||
        time ||
        emails
      ) {


        $.ajax({
          url: '/update-engagements-data',
          method: 'POST',
          data: {
            engagements: updatedData,
            clicks_visitors: updatedPeriodData,
            time: time || null,
            emails: emailArray.length > 0 ? emailArray : null,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            alert('Data saved successfully!');
          },
          error: function(xhr) {
            alert('An error occurred while saving the data.');
            console.error(xhr.responseText);
          }
        });
      } else {
        alert('No changes to save.');
      }
    });




    $('.pin-comment, .unpin-comment').on('click', function() {
      var commentId = $(this).data('id');
      var action = $(this).hasClass('pin-comment') ? 'pin' : 'unpin';

      // Get the path inside the SVG of the clicked element
      var svg = $('[data-id="' + commentId + '"]').find('svg.pin');
      var svgPath = svg.find('path');

      // Send AJAX request to pin/unpin the comment
      $.ajax({
        url: '/comments/' + commentId + '/toggle-pin', // Route to handle pin/unpin
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // CSRF token for security
          action: action // Pass action (pin/unpin)
        },
        success: function(response) {
          // Update the button text and comment position
          if (action === 'pin') {
            // Move the comment to the pinned section
            $('[data-id="' + commentId + '"]').find('.pin-text').text('Unpin Comment');
            $('[data-id="' + commentId + '"]').find('.pin-text').css('color', '#3FA8F9');
            svgPath.attr('fill', '#3FA8F9'); // Change the fill color of the SVG path
            $('[data-id="' + commentId + '"]').removeClass('pin-comment').addClass('unpin-comment');
          } else {
            // Move the comment to the unpinned section
            $('[data-id="' + commentId + '"]').find('.pin-text').text('Pin Comment');
            $('[data-id="' + commentId + '"]').find('.pin-text').css('color', '#ADADAD');
            svgPath.attr('fill', '#ADADAD'); // Change the fill color of the SVG path
            $('[data-id="' + commentId + '"]').removeClass('unpin-comment').addClass('pin-comment');
          }
        },
        error: function(xhr) {
          alert('Error toggling pin state');
        }
      });
    });





    $('.delete-comment').on('click', function() {
      var commentId = $(this).data('id'); // Get the comment ID from the data-id attribute
      var commentClass = '.comment-' + commentId;
      // Confirm before deletion
      if (confirm('Are you sure you want to delete this comment?')) {
        // Send AJAX request to delete the comment
        $.ajax({
          url: '/comments/' + commentId, // Adjust this URL based on your route
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}', // CSRF token for security
          },
          success: function(response) {
            // On success, remove the comment from the DOM
            alert('Comment deleted successfully');
            // location.reload();
            $(commentClass).remove();
          },
          error: function(xhr) {
            alert('Failed to delete comment');
          }
        });
      }
    });
    $(".engagement").on("click", function() {
      $("#engagementModal").modal("show");
    });
    $('.display-checkbox').change(function() {
      var commentId = $(this).data('id'); // Get the comment ID
      var displayStatus = $(this).prop('checked'); // Get the checked status

      // Send AJAX request to update the display field
      $.ajax({
        url: '{{ route("comments.updateDisplay") }}', // Define your route here
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // CSRF token for security
          id: commentId,
          display: displayStatus
        },
        success: function(response) {},
        error: function(xhr, status, error) {
          // Handle any errors
          alert('Error updating display status.');
        }
      });
    });
    checkSeeTips();
    popupStatus();
    var is_all_set = localStorage.getItem('all_tips');
    if (is_all_set == "0") {
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
      $("input[name='tippopups']").attr('checked', true);
      $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
    }
  });
</script>
@endsection('content')