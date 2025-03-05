<?php 
$setting = $frontSections->where('slug','galleryslider')->first();
if($gallery_slider_title->enable=='1' || isset($_GET['editwebsite']) || ($gallerySlider && ($gallerySliderCount) > 0)){ ?>
    @include('sections.galleryslider.styles')
    <div id="galleryslider">
        <?php if($gallery_slider_title->enable=='1'){ ?>
            <div class="position-relative title_banners_outline" >
            @if(isset($_GET['editwebsite']))
                <div class="">
                        <div class="d-flex align-items-center">
                            <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=gallery_slider_title'/>
                        </div>
                </div>
            @endif
                <<?= $gallery_slider_title->tag ?> class="titlefontfamily galleryslidertitle">
                    <?= $gallery_slider_title->text ?>
                </<?= $gallery_slider_title->tag ?>>
            </div>
        <?php } ?>
        <div class="position-relative gallery_slider_outline" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Gallery Slider' :buttons="isset($tutorial_action_buttons['slider']) ? $tutorial_action_buttons['slider']:'' " url='galleries?block=gallery_slider_bluebar' :status="$setting->section_enabled"/>
                    </div>
            </div>
        @endif
            <div class='gallery-slider-bg' >
                <div class="container slider-container" >
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-7">
                            <br>
                            <div id="myCarousel2" class="carousel slide" data-ride="carousel" <?php if($galleriesSettings->gallery_slider_autoplay=='0'){ ?>data-interval="false"<?php } ?>>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <?php if ($gallerySlider && ($gallerySliderCount) > 0) {
                                        $active = 'active'; ?>
                                        <?php foreach ($gallerySlider as $single) { ?>
                                            <div class="item <?php if ($active) {
                                                                    echo $active;
                                                                    $active = '';
                                                                } ?>">
                                            <div class="carousel-imgdiv">
                                                <img 
                                                    <?php 
                                                        if($is_app){
                                                            ?>
                                                            src="<?= url('assets/uploads/'.get_current_url() . $single->image) ?>"
                                                            <?php
                                                        }else{
                                                    ?>
                                                            class="lazyload img-slider" data-class="gallery_slider_image" data-src="<?= url('assets/uploads/' .get_current_url(). $single->image) ?>"
                                                    <?php 
                                                        }?>
                                                    alt="<?=$single->text?>" >
                                                    <a class="left carousel-control control-slider" href="#myCarousel2" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left ccleft"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control control-slider" href="#myCarousel2" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right ccright"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                <div class="carousel-caption" >
                                                     <div class="gallary_slider_description_text " id="gallary_slider_description_text<?= $single->id ?>"><?= nl2br(($single->text)) ?></div>
                                                 </div> 
                                                 
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- Left and right controls -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- do not remove sample-carosuel-images div. its used to calculate the highest text in the slider. Unless you find another solution -->
                        <div class="col-md-6 sample-carousel-images">
                            <?php if ($gallerySlider && ($gallerySliderCount) > 0) {
                                $active = 'active'; ?>
                                <?php foreach ($gallerySlider as $single) { ?>
                                    <div class="item <?php if ($active) {
                                                            echo $active;
                                                            $active = '';
                                                        } ?>">
                                        <img 
    
                                        <?php 
                                        if($is_app){
                                            ?>
                                            
                                            src="<?= url('assets/uploads/'.get_current_url() . $single->image) ?>"
                                        <?php
                                        }else{
                                            ?>class="lazyload" data-class="gallery_slider_image" data-src="<?= url('assets/uploads/'.get_current_url() . $single->image) ?>" 
                                        
                                            <?php 
                                        }?>
                                        alt="<?=$single->text?>" >
                                        <div class="carousel-caption" >
                                            <h6 class="gallary_slider_description_text " id="gallary_slider_description_text<?= $single->id ?>"><?= nl2br(($single->text)) ?></h6>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sections.galleryslider.scripts')

<?php } ?>