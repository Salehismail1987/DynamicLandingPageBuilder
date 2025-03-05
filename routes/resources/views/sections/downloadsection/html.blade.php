<?php 
  $setting = $frontSections->where('slug','downloadsection')->first();
if($download_title->enable=='1' || isset($_GET['editwebsite']) || ($downloadFiles && count($downloadFiles)>0)){ ?>
    @include('sections.downloadsection.styles')
    
        <div id="downloadsection">
            <?php if($download_title->enable=='1'){ ?>
                <div class="position-relative title_banners_outline" >
                @if(isset($_GET['editwebsite']))
                    <div class="">
                            <div class="d-flex align-items-center">
                                <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=download_section_title'/>
                            </div>
                    </div>
                @endif
                    <<?= $download_title->tag ?> class="titlefontfamily downloadtitle {{$download_title->slug}}">
                        <?=$download_title->text?>
                    </<?= $download_title->tag ?>>
                </div>
            <?php } ?>
            <div class="position-relative downloads_feature_bg download_files_outline" >
                <br>
                @if(isset($_GET['editwebsite']))
                    <div class="">
                            <div class="d-flex align-items-center">
                                <x-tutorial-action-buttons  title='Download Files' :buttons="isset($tutorial_action_buttons['download']) ? $tutorial_action_buttons['download']:'' " url='editfrontend?block=download_files_bluebar' :status="$setting->section_enabled"/>
                            </div>
                    </div>
                @endif
                <div class="container text-lg-left text-md-center">
          
                    <?php foreach($downloadFiles as $single){ ?>
                        <div class="row mb-10 download-section">
                            <!-- (Hassan) Adding condition to view left and right image (Begin) -->
                            @if($single->image_position == 'right')
                            <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                    <h3 class="downlaodquestion "><?= nl2br(($single->file_question)) ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                    <a target="_blank" href="<?=base_url('assets/uploads/'.get_current_url().$single->file)?>" class="downlaodtext"><?=isset($single->download_text) ? nl2br(($single->download_text)) : 'Download'?>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a target="_blank" href="<?=base_url('assets/uploads/'.get_current_url().$single->file)?>" class="downlaodtext">
                                    <div class="d-inline-block">
                                        <img class="download-image" src="<?= base_url('assets/uploads/'.get_current_url(). $single->file) ?>"  style="<?= !isset($single->image_size)  ? 'width:100% ' : 'width:'. $single->image_size . '; height:'.$single->image_size ?>">                   
                                    </div>                                                              
                                </a>
                            </div>
                            @elseif($single->image_position == 'left')
                            <div class="col-md-3" >
                                <a target="_blank" href="<?=base_url('assets/uploads/'.get_current_url().$single->file)?>" class="downlaodtext">
                                    <div class="d-inline-block">

                                        <img class="download-image" src="<?= base_url('assets/uploads/'.get_current_url(). $single->file) ?>" style="<?= !isset($single->image_size)  ? 'width:100% ' : 'width:'. $single->image_size . '; height:'.$single->image_size ?>">                    
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                    <h3 class="downlaodquestion "><?= nl2br(($single->file_question)) ?></h3>
                                </div>
                            </div>
                            <div class="col-md-4 display-table">
                                <div class="vertical-middle">
                                    <a target="_blank" href="<?=base_url('assets/uploads/'.get_current_url().$single->file)?>" class="downlaodtext"><?=isset($single->download_text) ? nl2br(($single->download_text)) : 'Download'?>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <!-- Adding condition to view left and right image (End) -->
                        </div>
                    <?php } ?>
                  </div>
            </div>
        </div>
        
    
    @include('sections.downloadsection.scripts')
<?php } ?>