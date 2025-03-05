<?php 
  $setting = $frontSections->where('slug','formssection')->first();
if($form_section_title->enable=='1' || isset($_GET['editwebsite']) || $formsLinks && count($formsLinks->toArray()) || $form_section_img && $form_section_img->file_name){ ?>
@include('sections.formssection.styles')

<?php 
//if ($home_data->forms_links) {
  ?>
  

<div id="formssection">
  <?php if($form_section_title->enable=='1'){ ?>
    <div class="position-relative title_banners_outline" >
    @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=forms_title'/>
                  </div>
          </div>
      @endif
      <<?= $form_section_title->tag ?> class="titlefontfamily formstitle">
        <?= $form_section_title?$form_section_title->text:'' ?>
      </<?= $form_section_title->tag ?>>
    </div>
  <?php } ?>
  <?php 
      $backDashboard = '';
      if(isset($_GET['editwebsite'])){
        $backDashboard = '
                        <div class="back-dashboard-div">
                            <a href="'.url('editfrontend?block=forms_feature').'" target="_blank">
                                <div class="col-md-12 d-flex flex-column">
                                    <div class="col-md-12 title-2">Forms</div>';
                    if($setting->section_enabled == 0)
                        $backDashboard .= '<div class="col-md-12 title-2" style="color:red;">Disabled</div>';
                    $backDashboard .= '
                                </div>
                                <img src="'.url('assets/uploads/'.get_current_url().'edit-round.png').'" class="edit-icon">
                            </a>
                        </div>';
      }
  ?>
  <div class="position-relative forms_outline" >
    <div class="forms_feature_bg">
    @if(isset($_GET['editwebsite']))
        <div class="">
                <div class="d-flex align-items-center">
                    <x-tutorial-action-buttons  title='Forms Links' :buttons="isset($tutorial_action_buttons['forms']) ? $tutorial_action_buttons['forms']:'' " url='editfrontend?block=forms_feature' :status="$setting->section_enabled"/>
                </div>
        </div>
    @endif
      <div class="container-fluid text-center" style="">
        <div class="row nopadding">

        <?php 
        $content_class = 'col-md-12';
          if ($form_section_img && $form_section_img->file_name) {
              $content_class = "col-md-5"; ?>
              <div class="col-md-6 nopadding pt-30">
                <img class="lazyload" data-src="<?= url('assets/uploads/'.get_current_url(). $form_section_img->file_name)  ?>" width="<?=($form_section_img->max_width) ? $form_section_img->max_width.'px' : '50%'?>" style="max-width: 100%;" alt="">
              </div>
            <?php } ?>

          <?php  ?>

          <div class="<?=$content_class?> nopadding">
            <br>
            <div class="form_desc">
              <?= $formsSettings->form_section_desc ?>
            </div>
            <br>
            <div style="display: grid;<?=$formsSettings->form_column=='1'?'grid-template-columns: auto auto;':''?>">
              <?php if ($formsLinks && count($formsLinks->toArray())) {
            ?>
                <?php foreach ($formsLinks as $single) { ?>
                    @if(nl2br($single->link_text))
                        <a  class="LSformslinks" href="#" data-toggle="modal" data-target="#modalcustomforms<?=getCustomformEncodedID($single->link_forms)?>"><?= nl2br($single->link_text) ?></a>
                    @endif
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</div>
<?php
//}
?>
@include('sections.formssection.scripts')
<?php } ?>