<style>
  #faqsection::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }
  #faqsection{
    <?php
    if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
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

  .faqtitle {
    padding: 20px !important;
    text-align: center !important;
   
  }
  .faqs-bg-color{
    background: <?=$faqSettings->individual_background_color ? $faqSettings->individual_background_color . ' !important;' : '#000;'?>;
  }
  <?php

    if ($faqSettings->use_generic) {
      $question_font_family = 'font-family:' . ($generic_faq_question->fontfamily ? getfontfamily($generic_faq_question->fontfamily) . ' !important;' : ';');
      $question_color = 'color:' . ($generic_faq_question->color ? $generic_faq_question->color . ' !important;' : '#000;');
      $question_font_size = 'font-size:' . ($generic_faq_question->size_web ? $generic_faq_question->size_web . 'px !important;' : ';');

      $answer_font_family = 'font-family:' . ($generic_faq_answer->fontfamily ? getfontfamily($generic_faq_answer->fontfamily) . ' !important;' : ';');
      $answer_color = 'color:' . ($generic_faq_answer->color ? $generic_faq_answer->color . ' !important;' : '#000;');
      $answer_font_size = 'font-size:' . ($generic_faq_answer->size_web ? $generic_faq_answer->size_web . 'px !important;' : ';');
    ?>.faq-question {
    <?= $question_font_family ?>
  }

  .faq-question a {
    <?= $question_color ?><?= $question_font_size ?>
  }

  .faq-question i {
    <?= $question_color ?>
  }

  .faq-answer {
    <?= $answer_color ?>
  }

  .faq-answer p {
    text-align: justify;
    <?= $answer_font_family ?><?= $answer_font_size ?>
  }

  <?php
    } else {
      $i = 1;
      foreach ($faqs as $single) {
        $question_font_family = 'font-family:' . ($single->question_font_size ? getfontfamily($single->question_font_size) . ' !important;' : ';');
        $question_color = 'color:' . ($single->question_text_color ? $single->question_text_color . ' !important;' : '#000;');
        $question_font_size = 'font-size:' . ($single->faq_question_font_family ? $single->faq_question_font_family . 'px !important;' : ';');

        $answer_font_family = 'font-family:' . ($single->answer_font_family ? getfontfamily($single->answer_font_family) . ' !important;' : ';');
        $answer_color = 'color:' . ($single->answer_text_color ? $single->answer_text_color . ' !important;' : '#000;');
        $answer_font_size = 'font-size:' . ($single->answer_font_size ? $single->answer_font_size . 'px !important;' : ';');
  ?>#faq-question-<?= $i ?> {
    <?= $question_font_family ?>
  }

  #faq-question-<?= $i ?> a {
    <?= $question_color ?><?= $question_font_size ?>
  }

  #faq-question-<?= $i ?> i {
    <?= $question_color ?>
  }

  #faq-answer-<?= $i ?> {
    <?= $answer_color ?>
  }

  #faq-answer-<?= $i ?> p {
    text-align: justify;
    <?= $answer_font_family ?><?= $answer_font_size ?>
  }

  <?php
        $i++;
      }
    }
  ?>

<?php 
if($faq_title_setting->enable_theme_bg =='1'){
    ?>
    .faq_title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
</style>