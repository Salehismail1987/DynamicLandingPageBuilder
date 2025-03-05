<?php 
  $setting = $frontSections->where('slug','gallerytilesection')->first();
if($gallery_tiles_title->enable=='1' || isset($_GET['editwebsite']) || ($gallery_tiles && count($gallery_tiles->toArray()) > 0)){ ?>
    @include('sections.gallerytilesection.styles')
    
    
    <div id="gallerytilesection" class="p-3"  style="<?= $galleriesSettings->gallery_tiles_background ? 'background: ' . $galleriesSettings->gallery_tiles_background . ';' : '' ?>">
      <?php if($gallery_tiles_title->enable=='1'){ ?>
        <div class="position-relative title_banners_outline" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='galleries?block=gallery_tiles_bluebar'/>
                    </div>
            </div>
        @endif
          <<?= $gallery_tiles_title->tag ?> class="titlefontfamily gallery-tiles-title {{$gallery_tiles_title->slug}}">
            <?= $gallery_tiles_title->text ?>
          </<?= $gallery_tiles_title->tag ?>>
        </div>
      <?php } ?>
    
      <div class="position-relative gallery_tiles_outline" >
      @if(isset($_GET['editwebsite']))
        <div class="">
            <div class="d-flex align-items-center">
                <x-tutorial-action-buttons  title='Gallery Tiles' :buttons="isset($tutorial_action_buttons['tiles']) ? $tutorial_action_buttons['tiles']:'' " url='galleries?block=gallery_tiles_bluebar' :status="$setting->section_enabled"/>
            </div>
        </div>
        @endif
        <div class="gallery_tiles_bg" style="padding:70px;">
          <div class="container">
            <?php
            if ($gallery_tiles_subtitle->text) {
            ?>
              <h2 class="titlefontfamily gallery-tiles-subtitle {{$gallery_tiles_subtitle->slug}}">
                <?= $gallery_tiles_subtitle->text ?>
              </h2>
            <?php
            }
            ?>
            <div class="row equal" style="justify-content: center;">
              <?php if ($gallery_tiles && count($gallery_tiles->toArray()) > 0) { ?>
                <?php
                foreach ($gallery_tiles as $single) {
              
    
                  // list($width, $height) = getimagesize(FCPATH . ('assets/uploads/' . $single->image));
                  // if (($width - ($width * 30) / 100) > $height) {
                  if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                    $class = 'col-md-6';
                  } else {
                    $class = 'col-md-3';
                  }
                  $class = '';
                ?>
                  <div class="<?= $class ?> col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <?php
                    if ($single->image) { ?>
                      <img onclick="openTileImage('tileImage<?= $single->id ?>')" id="tileImage<?= $single->id ?>" class="lazyload" data-src="<?= url('assets/uploads/' .get_current_url(). $single->image) ?>"  alt="<?=$single->description?>">
                    <?php
                    }
                    ?>
                    <p id="description_tileImage<?= $single->id ?>" class="gallery_tiles_desc<?= $single->id?>"  ><?= nl2br(($single->description)) ?></p>
                  </div>
                <?php
                } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div id="myModalTileimage01" class="tile_modal">
    
      <span class="close imgclose">&times;</span>
    
      <img class="tile_modal-content" id="img002" alt="">
    
      <div id="caption"></div>
    </div>
    @include('sections.gallerytilesection.scripts')

<?php } ?>