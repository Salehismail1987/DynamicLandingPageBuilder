
<?php /*if ($home_data->popupactive == '1' && ($home_data->popupshowalways || !$this->session->userdata('firstarival'))) {
    $this->session->set_userdata('firstarival', '1'); ?>
    <div class="modal fade" id="popupalert" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="<?= $home_data->popup_background_color ? 'background:' . $home_data->popup_background_color . ';' : '' ?>">
                <div class="modal-body" style="text-align: center;">
                    <div class="titlefontfamily text-bold" style="<?php if ($home_data->popup_title_font_family) { ?>font-family:<?= getfontfamily($home_data->popup_title_font_family) ?> <?php } ?>;<?= $home_data->popup_title_color ? 'color:' . $home_data->popup_title_color . ';' : '' ?><?= $home_data->popup_title_fontsize ? 'font-size:' . $home_data->popup_title_fontsize . 'px;' : '' ?>">
                        <?= nl2br($home_data->popupalerttitle) ?>
                    </div>
                    <div class="popup_image">
                        <?php
                        if ($step_image = check_step_image('Popup Alert Image')) {
                            ?>
                            <div class="vertical-center">
                                <div class="outer">
                                    <div class="middle">
                                        <div class="inner">
                                            <img class="lazyload" data-src="<?= base_url('assets/uploads/') . $step_image['image'] ?>" style="max-width: 100%; width:70%;" alt="<?= !empty($step_image['text']) ? $step_image['text'] : $home_data->popupalerttitle ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            if (!empty($step_image['text'])) {
                                ?>
                                <p style="padding-bottom:0;color:<?=$step_image['color']? $step_image['color'] : '#000000'?>;font-size:<?=$step_image['size']? $step_image['size'].'px' : '18px'?>;<?=$step_image['font']? 'font-family:'.getfontfamily($step_image['font']).';' : ''?>">
                                    <?=nl2br($step_image['text'])?>
                                </p>
                                <?php
                            }
                            ?>
                            <?php
                        }elseif (show_timed_image($timed_images->enable_timed_popup_image, $timed_images->timed_popup_image, $timed_images->popup_image_start_time, $timed_images->popup_image_end_time,$timed_images->popup_image_days,  'enable_timed_popup_image', 'timed_images', 1)) {
                        ?>
                            <div class="vertical-center">
                                <div class="outer">
                                    <div class="middle">
                                        <div class="inner">
                                            <img class="lazyload" data-src="<?= base_url('assets/uploads/') . $timed_images->timed_popup_image ?>" style="max-width: 100%; width:70%;" alt="<?=$home_data->popupalerttitle?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            if ($home_data_extended->popup_image) { ?>
                                <div class="vertical-center">
                                    <div class="outer">
                                        <div class="middle">
                                            <div class="inner">
                                                <img class="lazyload" data-src="<?= base_url('assets/uploads/') . $home_data_extended->popup_image ?>" style="max-width: 100%; width:70%;" alt="<?=$home_data->popupalerttitle?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                    <p style="padding-bottom:0px;font-size: 18px;<?= $home_data->popup_text_color ? 'color:' . $home_data->popup_text_color . ';' : '' ?>"><?= nl2br($home_data->popupalert) ?></p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <?php if ($home_data_extended->featureActionButton == '1') {
                        if ($home_data_extended->feature_action_button_link == 'call' || $home_data_extended->feature_action_button_link == 'sms' || $home_data_extended->feature_action_button_link == 'email') {
                            switch ($home_data_extended->feature_action_button_link) {
                                case 'sms':
                                    $input_href = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $home_data->header_phone_text));
                                    break;
                                case 'call':
                                    $input_href = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $home_data->header_text_7_phone));
                                    break;
                                case 'email':
                                    $input_href = 'mailto:' . $home_data->contact_form_email;
                                    break;
                            }
                        }elseif($home_data_extended->feature_action_button_link == "address"  || $home_data_extended->feature_action_button_link == "google_map"){

                            $address =  getaddress_info($home_data_extended->feature_action_button_address);
                         
                             $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                             $input_href = "http://maps.google.com/maps?q=".$address_full;
                             $target = "_blank";
                         } else {
                            $input_href = '#' . $home_data_extended->feature_action_button_link;
                        }
                    ?>

                    <?php 
                        if($home_data_extended->feature_action_button_link == "address"  || $home_data_extended->feature_action_button_link == "google_map"){
                            ?>
                            <a href='<?= $input_href ?>' class="btn btn-default text-bold" target="<?=$target?>" style="margin-bottom: 10px;<?= $home_data_extended->feature_action_button_desc_color ? 'color:' . $home_data_extended->feature_action_button_desc_color . ';' : '' ?> <?= $home_data_extended->feature_action_button_background_desc_color ? 'background:' . $home_data_extended->feature_action_button_background_desc_color . ';' : '' ?>"><?= $home_data_extended->feature_action_button_desc ?></a><br>
                            <?php 
                        }elseif($home_data_extended->feature_action_button_link == "customforms"){
                            ?>
                            <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-target="#modalcustomforms<?=getCustomformEncodedID($home_data_extended->feature_customforms)?>" style="margin-bottom: 10px;<?= $home_data_extended->feature_action_button_desc_color ? 'color:' . $home_data_extended->feature_action_button_desc_color . ';' : '' ?> <?= $home_data_extended->feature_action_button_background_desc_color ? 'background:' . $home_data_extended->feature_action_button_background_desc_color . ';' : '' ?>"><?= $home_data_extended->feature_action_button_desc ?></a><br>
                            <?php 
                        }else{
                            ?>  
                            <button type="button" onclick="location.href='<?= $input_href ?>';" class="btn btn-default text-bold" data-dismiss="modal" style="margin-bottom: 10px;<?= $home_data_extended->feature_action_button_desc_color ? 'color:' . $home_data_extended->feature_action_button_desc_color . ';' : '' ?> <?= $home_data_extended->feature_action_button_background_desc_color ? 'background:' . $home_data_extended->feature_action_button_background_desc_color . ';' : '' ?>"><?= $home_data_extended->feature_action_button_desc ?></button><br>
                            <?php 
                        }
                    ?>
                       
                    <?php } ?>
                    <?php if ($home_data->newactionbuttonactive == '1') { ?>
                        <a target="_blank" href="<?= $home_data->new_action_button_link ?>" class="btn btn-default text-bold new-action-btn" style="margin-bottom: 10px;<?= $home_data->new_action_button_desc_color ? 'color:' . $home_data->new_action_button_desc_color . ';' : '' ?> <?= $home_data->new_action_button_background_desc_color ? 'background:' . $home_data->new_action_button_background_desc_color . ';' : '' ?>"><?= $home_data->new_action_button_desc ?></a><br>
                    <?php } ?>
                    <?php if ($home_data->terminate_action_button_activate == '1') { ?>
                        <button type="button" onclick="location.href='https://google.com';" class="btn btn-default text-bold" data-dismiss="modal" style="<?= $home_data->terminate_action_button_color ? 'color:' . $home_data->terminate_action_button_color . ';' : '' ?> <?= $home_data->terminate_action_button_background_color ? 'background:' . $home_data->terminate_action_button_background_color . ';' : '' ?>"><?= $home_data->terminate_action_button_desc ?></button>
                    <?php } ?>
                    <?php if ($home_data->proceedactionbuttonactive == '1') { ?>
                        <button type="button" class="btn btn-default text-bold" data-dismiss="modal" style="<?= $home_data->proceed_action_button_desc_color ? 'color:' . $home_data->proceed_action_button_desc_color . ';' : '' ?> <?= $home_data->proceed_action_button_background_desc_color ? 'background:' . $home_data->proceed_action_button_background_desc_color . ';' : '' ?>"><?= $home_data->proceed_action_button_desc ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } */ ?>

@include('blog-page.footer.styles')
<footer id="footer" style="<?php if ($footerSettings->footre_back_color) { ?>background:<?= $footerSettings->footre_back_color ?><?php } ?>;">

<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-links">
                <h4 style="color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><?= $footerSettings->footer_text_1 ? $footerSettings->footer_text_1 : ''?></h4>
                <div class="mt-3">

                    <?php if ($socialMedias) {
                        $header_socialmedia = ($socialMedias); ?>
                        <?php foreach ($header_socialmedia as $single) { ?>
                            
                            <a target="_blank" href="<?= $single->link ?>" class="sicialmediaicon">
                             
                                @if(geticons($single->icon_id) == 'fa fa-twitter')
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" width="20px" viewBox="-30 -50 512 512" fill="<?php if ($social_media_icon->color) { echo $social_media_icon->color; }?>"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                @else
                                    <i style="font-size:22px;" class="fa-icon <?= geticons($single->icon_id) ?>" ></i>
                                @endif
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container py-4 " >
    <div class="">
        <h4>
            <?php echo $footerSettings->copy_right_text ? $footerSettings->copy_right_text : '&copy; '.date("Y") ?>
            <?php if ($footerSettings->footer_text) { ?>
                <a href="<?= $footerSettings->footre_text_link ? $footerSettings->footre_text_link : '#' ?>"><?= $footerSettings->footer_text ?></a>
            <?php } ?>
        </h4>
        <h4><?php echo $footerSettings->footer_text_2 ? $footerSettings->footer_text_2 : '' ?></h4>
        <?php if (false && $businessInfo->address_for_map) { ?>
            <h4 class="address_for_map" ><?= $businessInfo->address_for_map ?></h4>
        <?php } ?>
    </div>
</div>
</footer><!-- End Footer -->

<?php

if (audio_enabled($frontSections)) {
?>
<div class="footer-audio" >
    <?php if ($audioFiles->audio_files && json_decode($audioFiles->audio_files)) {
        $audio_files = json_decode($audioFiles->audio_files); ?>
        <?php foreach ($audio_files as $single) {
            
            
            if(isset($single->title) && !empty($single)){ ?>
                <audio id="myAudio_header" controls <?php if ($audioFiles->audio_auto_play == '1') {
                                                    echo 'autoplay';
                                                } ?> <?php if ($audioFiles->audio_repeat == '1') {
                                                            echo 'loop';
                                                        } ?>>
                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->file) ?>" type="audio/mp3">
                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->file) ?>" type="audio/ogg">
                    <source src="<?= url('assets/uploads/'.get_current_url() . $single->file) ?>" type="audio/mpeg">
                </audio>
            <?php break;
             }
             
        } ?>
        <div class="bottomrightdiv">
            <img class="lazyload" onchange="playPauseAudio('myAudio_header')" data-src="<?= ($audioFiles->audio_auto_play) ? url('assets/front/img/volumn.jpg') : url('assets/front/img/muted.jpg') ?>" width="40px" height="40px" alt="">
        </div>
    <?php } ?>

</div>

<?php } ?>


<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?= url('assets/front/'); ?>/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/php-email-form/validate.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/counterup/counterup.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/venobox/venobox.min.js"></script>
<script src="<?= url('assets/front/'); ?>/vendor/aos/aos.js"></script>

<script src="<?= url('assets/front/'); ?>/vendor/slick-carousel/slick/slick.min.js"></script>


<!-- Template Main JS File -->
<script src="<?= url('assets/front/'); ?>/js/main.js"></script>