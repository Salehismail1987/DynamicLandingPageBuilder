<?php 
$setting = $frontSections->where('slug','faqsection')->first();
if($faq_title->enable=='1' || isset($_GET['editwebsite']) || ($faqs && count($faqs)>0)){ ?>
@include('sections.faqsection.styles')
<div id="faqsection">
  <?php if($faq_title->enable=='1'){ ?>
    <div class="position-relative title_banners_outline" >
    @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=faqs_title'/>
                  </div>
          </div>
      @endif
      <<?= $faq_title->tag ?> class="titlefontfamily faqtitle {{$faq_title->slug}}">
        <?= $faq_title->text ?>
      </<?= $faq_title->tag ?>>
    </div>
  <?php } ?>
  <div class="position-relative faq_outline" >
  @if(isset($_GET['editwebsite']))
      <div class="">
              <div class="d-flex align-items-center">
                  <x-tutorial-action-buttons  title='FAQs' :buttons="isset($tutorial_action_buttons['faqs']) ? $tutorial_action_buttons['faqs']:'' " url='editfrontend?block=faqs_bluebar' :status="$setting->section_enabled"/>
              </div>
      </div>
  @endif
    <div style="background:<?=$faqSettings->background_color && $faqSettings->override_bg !== '0' && !(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1) ? $faqSettings->background_color . ' !important;' : '#000'?>">
      <br>
      <div class="container demo">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <?php $i = 1;
            foreach ($faqs as $single) { ?>
              <div class="panel-heading faqs-bg-color" role="tab" id="headingOne">
                <h4 class="titlefontfamily panel-title faq-question" id="faq-question-<?= $i ?>">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
                    <i class="more-less glyphicon glyphicon-plus"></i>
                    <?= nl2br(($single->question_text)) ?>
                  </a>
                </h4>
              </div>
              <div id="collapse<?= $i ?>" class="faqs-bg-color panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body faq-answer" id="faq-answer-<?= $i ?>">
                  <p class="answer"><?= nl2br(($single->answer_text)) ?></p>
                </div>
              </div>
            <?php $i++;
            } ?>
          </div>
        </div><!-- panel-group -->
      </div><!-- container -->
    </div>
  </div>
</div>

<?php } ?>