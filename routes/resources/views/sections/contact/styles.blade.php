
<style>
  #contact::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }
  .contact_boxes_outline{
    <?php
    if(isset($_GET['editwebsite']) && $contact_box_setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }
          } 
          ?> 
  }
  .contact_forms_outline{
    <?php
    if(isset($_GET['editwebsite']) && $form1_setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }
          } 
          ?> 
  }
  .contactForm::before {
    content: '';
    display: block;
    height: 20px;
    visibility: hidden;
  }
  @media only screen and (max-width: 600px) {
  #google_map{
    margin-top:-100px;
  }
}

  #google_map::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  @media only screen and (max-width: 600px) {
    #google_map::before {
      height: 100px;
    }
  }

  .contact .info-box h3 {
    color:none;
    font-size: none;
  }
  .contact_box_title {
    <?php if ($contactBoxSettings->fontfamily) {
      echo 'font-family:' . getfontfamily($contactBoxSettings->fontfamily) . ' !important;';
    }

    ?>
  }

  .contact_info_blocks_title {
    line-height: initial;
    padding: 20px !important;
    text-align: center !important;
    <?php echo 'color:' . ($contact_info_block_title->color ? $contact_info_block_title->color : '#000') . ' !important;';
    echo 'font-size:' . ($contact_info_block_title->size_web ? $contact_info_block_title->size_web . 'px' : '18px') . ' !important;';
    echo 'background:' . ($contact_info_block_title->bg_color ? $contact_info_block_title->bg_color : '#fff') . ' !important;';
    echo 'font-family:' . ($contact_info_block_title->fontfamily ? getfontfamily($contact_info_block_title->fontfamily) : '#fff') . ' !important;';
    ?>
  }

  <?php if ($contact_info_block_title->size_mobile) {
  ?>@media only screen and (max-width: 600px) {
    .contact_info_blocks_title {
      text-align: center !important;
      <?= 'font-size:' . ($contact_info_block_title->size_mobile ? $contact_info_block_title->size_mobile . 'px' : '18px') . ' !important;' ?>
    }
  }

  <?php
  }

  ?>

  .contact-equal{
    margin-bottom: 20px;justify-content:center;padding-top:1rem
  }

  .mb-10px{
    margin-bottom:10px
  }

  .info-box{
    <?php echo ($contactBoxSettings->background_color) ? 'background: ' . $contactBoxSettings->background_color . ';' : ''; ?>
  }

  .contact_box_title{
    <?php if ($contact_box_address_title->color) {
    echo 'color:' . $contact_box_address_title->color . ';';
    } ?><?= !empty($contact_box_address_title->size_web) ? 'font-size:' . $contact_box_address_title->size_web . 'px;' : '' ?>
  }
  .contact-p{
    <?php if ($contact_box_address_text_1->color) {
                  echo 'color:' . $contact_box_address_text_1->color . ';'; } ?>
  }

  <?php foreach ($contactForms as $single) {

    ?>
    .contact-fontfamily-{{$single->id}}{
        margin-bottom: 10px !important;
        <?= ($single->form_title_color) ? 'color:' . $single->form_title_color . ';' : '' ?><?= ($single->form_title_size) ? 'font-size:' . $single->form_title_size . 'px;' : '' ?><?= ($single->form_title_font_family) ? 'font-family:' . getfontfamily($single->form_title_font_family) . ';' : '' ?>
    }
    <?php 
  }?>

<?php foreach ($contactFormTitle as $single) { ?>
    .contact-form-title-{{$single->id}}{
        font-weight: bold;padding:20px;text-align:center;
        <?= $single->color ? 'color:' . $single->color . ';' : '' ?>
        <?= $single->size_web ? 'font-size:' . $single->size_web . 'px;' : '' ?>
        <?php 
        if($single->enable_theme_bg =='1'){

          ?>
          background:transparent !important;
          <?php 
        }else{
          ?>
            <?= $single->bg_color ? 'background:' . $single->bg_color . ';' : '' ?>
          <?php
      }
      ?>
    
        <?= $single->fontfamily ? 'font-family:' . getfontfamily($single->fontfamily) . ';' : '' ?>line-height: initial;
    }
    .contact-form-text-{{$single->id}}{
        font-weight: bold;padding:20px;text-align:center;
        <?= $single->color ? 'color:' . $single->color . ';' : '' ?>
        <?= $single->size_web? 'font-size:' . $single->size_web. 'px;' : '' ?>
        <?= $single->bg_color ? 'background:' . $single->bg_color . ';' : '' ?>
        <?= $single->fontfamily ? 'font-family:' . getfontfamily($single->fontfamily) . ';' : '' ?>line-height: initial;
    }
<?php 
}
?>
.box-bg{
    <?php echo ($contactBoxSettings->background_color) ? 'background: ' . $contactBoxSettings->background_color . ';' : ''; ?>
}

.phone-link{
    <?php if ($contact_box_phone_text->color) { ?>color:<?= $contact_box_phone_text->color ?><?php } ?>
}



<?php 
if($contact_info_blocks_title_setting->enable_theme_bg =='1'){
    ?>
    .contact_info_blocks_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>

</style>