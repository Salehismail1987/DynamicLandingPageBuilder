<?php 
$setting = $frontSections->where('slug','linkssection')->first();
if($links_title->enable=='1' || isset($_GET['editwebsite']) || ($hyperLinks && count($hyperLinks->toArray())>0)){ ?>
@include('sections.linkssection.styles') 
  
<div id="linkssection">
  <?php if($links_title->enable=='1'){ ?>
    <div class="position-relative title_banners_outline" >
    @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_blueba&sb=hyperlinks_title'/>
                  </div>
          </div>
      @endif
      <<?= $links_title->tag ?> class="titlefontfamily linkstitle {{$links_title->slug}}">
        <?= $links_title->text ?>
      </<?= $links_title->tag ?>>
    </div>
  <?php } ?>
    <div class="position-relative hyperlinks_outline" >
    @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Hyperlinks' :buttons="isset($tutorial_action_buttons['hyperlinks']) ? $tutorial_action_buttons['hyperlinks']:'' " url='editfrontend?block=hyperlinks_bluebar' :status="$setting->section_enabled"/>
                    </div>
            </div>
    @endif
      <div class="container-fluid links-bg-color" >
        <div class="row nopadding  pt-20">

                  <?php 
                  $content_class = 'col-md-6 col-md-offset-4';
                  if (show_timed_image($timed_hyperlink_image_setting->enable, $timed_hyperlink_image->file_name, $timed_hyperlink_image_setting->start_time, $timed_hyperlink_image_setting->end_time, $timed_hyperlink_image_setting->days,'enable_timed_hyperlink_image','timed_images',1,$timed_hyperlink_image_setting->type)) {
                    $content_class = "col-md-5";
                    ?>
                        <div class="col-md-7 nopadding">
                          <div class="mb-20">
                            <img class="lazyload" data-src="<?= url('assets/uploads/').get_current_url() .'/'. $timed_hyperlink_image->file_name ?>" width="<?=($hyperLinksSettings->link_image_size) ? $hyperLinksSettings->link_image_size.'px' : '50%'?>" style="max-width: 100%;" alt="<?=$links_title->text?>">
                          </div>
                        </div>
                        <?php
                    } else {
                      if ($hyperLinksSettings->link_image) {
                        $content_class = "col-md-5"; ?>
                        <div class="col-md-7 nopadding">
                          <div class="mb-20">
                            <img class="lazyload" data-src="<?= url('assets/uploads/').get_current_url() .'/'. $hyperLinksSettings->link_image ?>" width="<?=($hyperLinksSettings->link_image_size) ? $hyperLinksSettings->link_image_size.'px' : '50%'?>" style="max-width: 100%;" alt="<?=$links_title->text?>">
                          </div>
                        </div>
                      <?php }
                    } ?>

          <?php  ?>

            <div class="<?=$content_class?>" align="center" style="display: grid;"> 
              <div class=" align-md-all-center">
                <?php if ($hyperLinks && count($hyperLinks->toArray())>0) {
                  ?>               
                      <?php foreach ($hyperLinks as $single) { ?>
                      <div class="row">
                        <div class="@if ($hyperLinksSettings->show_links)  col-5 col-md-5 @else col-12 col-md-12 @endif text-left LSlinks no-underline">
                          <a target="_blank" class="LSlinks no-underline" href="<?= $single->link ?>">@if (!$hyperLinksSettings->show_links) <u> @endif<?= nl2br($single->link_text) ?>@if (!$hyperLinksSettings->show_links) </u> @endif</a>
                        </div>
                        @if($hyperLinksSettings->show_links)
                        <div class="col-7 col-md-7 text-left LSlinksLinks">
                          <?php if ($hyperLinksSettings->show_links) {  ?>
                            <a target="_blank" class="LSlinksLinks " href="<?= $single->link ?>"><?=$single->link ?></a>
                          <?php } ?>
                        </div>
                        @endif
                    </div>
                  <?php } ?>
                <?php } ?>
            </div>
            </div>
        </div>
        <br>
      </div>
    </div>
</div>
<?php } ?>