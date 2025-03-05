

<?php 
  $setting = $frontSections->where('slug','seoBlock')->first();
  if ($seo_title->enable=='1' || $seo_title->text || $seo_block_text_color->text || $seoSettings->seo_block_text) { ?>
    @include('sections.seoBlock.styles')
<div id="seoBlock">
  <?php  if($seo_title->enable=='1'){ ?>
    <div class="position-relative title_banners_outline" >
    @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=seo_title'/>
                  </div>
          </div>
      @endif
      <?php if ($seo_title->text) { ?>
      <<?= $seo_title->tag?> class="titlefontfamily seoTitle {{$seo_title->slug}}" >
        <?= $seo_title->text?>
      </<?= $seo_title->tag?>>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="position-relative seo_block_outline" >
  @if(isset($_GET['editwebsite']))
      <div class="">
              <div class="d-flex align-items-center">
                  <x-tutorial-action-buttons  title='SEO Block' :buttons="isset($tutorial_action_buttons['seo']) ? $tutorial_action_buttons['seo']:'' " url='settings?block=seo_block_bluebar' :status="$setting->section_enabled"/>
              </div>
      </div>
  @endif
    <?php if ($seo_block_text_color->text || $seoSettings->seo_block_text) { ?>
      <div class="seo_block_bg">
        <div class="container {{$seo_block_text_color->slug}}">
          @if(false)
          <!-- <h1 class="seoBlocktitle"><?= nl2br($seo_block_text_color->text) ?></h1> -->
          @endif
          <br>
          <?= nl2br($seoSettings->seo_block_text) ?> 
          <br>
        </div><!-- panel-group -->
    
      </div>
    <?php } ?>
  </div>
  </div><!-- container -->
</div>
  <?php } ?>