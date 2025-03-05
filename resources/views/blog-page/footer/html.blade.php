
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
                            <a href='' class="btn btn-default text-bold" target="" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?=getCustomformEncodedID($home_data_extended->feature_customforms)?>" style="margin-bottom: 10px;<?= $home_data_extended->feature_action_button_desc_color ? 'color:' . $home_data_extended->feature_action_button_desc_color . ';' : '' ?> <?= $home_data_extended->feature_action_button_background_desc_color ? 'background:' . $home_data_extended->feature_action_button_background_desc_color . ';' : '' ?>"><?= $home_data_extended->feature_action_button_desc ?></a><br>
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
<div class="modal fade likesModal" id="likesModal" tabindex="-1" role="dialog" aria-labelledby="likesModal">
    <div class="modal-dialog" id="likes-dialog" role="document" style="width:450px">
        <div class="modal-content">
        <div class="modal-header likes-modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="likes-modal-header">You can give us a Like & leave a comment too</h5>
        </div>
            <div class="col-md-12 like-elements d-flex flex-column p-0">
                <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 likes-container like-box p-0">
                        <div class="like-icon col-md-4">

                            <div class="business-svg text-center d-flex space-around" data-category="business"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Business</text>
                            </div>
                        </div>
                        <div class="like-icon col-md-4">

                            <div class="service-svg text-center" data-category="service"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Service</text>
                            </div>
                        </div>
                        <div class="like-icon col-md-4">

                            <div class="website-svg text-center" data-category="website"><svg class="ch-clr" width="24" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="black" d="M11.0156 0.878906C10.2017 0.878906 9.45542 1.13684 8.79765 1.64555C8.16703 2.13325 7.74718 2.75443 7.5 3.20613C7.25282 2.7544 6.83297 2.13325 6.20235 1.64555C5.54458 1.13684 4.79833 0.878906 3.98438 0.878906C1.71293 0.878906 0 2.73683 0 5.20061C0 7.86234 2.137 9.68347 5.37214 12.4404C5.92151 12.9086 6.54422 13.4393 7.19145 14.0053C7.27676 14.08 7.38633 14.1211 7.5 14.1211C7.61367 14.1211 7.72324 14.08 7.80856 14.0053C8.45584 13.4392 9.07852 12.9086 9.62821 12.4401C12.863 9.68347 15 7.86234 15 5.20061C15 2.73683 13.2871 0.878906 11.0156 0.878906Z" fill="white" />
                                </svg><text>Website</text>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 text-center">
                        <button type="button" class="mybtn-primary submit-like-btn">Submit a Like</button>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 comments-btn-div p-0">
                        <div class="col-md-6 col-xs-6 p-0 text-center"> <button type="button" id="openCommentModal" class="mybtn-primary leave-comment-btn">Leave a comment</button>
                        </div>
                        <div class="col-md-6 col-xs-6 p-0 text-center"> <button type="button" class="mybtn-primary read-comments-btn">Read Comments</button>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 comments-no">
                        {{ countComments() ?? 0 }} comments
                    </div>
                </div>
                <ul id="modal-product-prices"></ul>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="engagementCommentModal" tabindex="-1" role="dialog" aria-labelledby="engagementCommentModalLabel">
    <div class="modal-dialog custom-modal" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                
            </div> -->
            <div class="modal-body">
                <h5 class="modal-title text-center" id="engagementCommentModalLabel">Leave a Comment</h5>
                <form id="engagementCommentForm">
                    <div class="form-group">
                        <label for="name">Name (Optional)</label>
                        <input type="text" class="form-control engagement-fields" id="user_name" name="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group like-comment-div">
                        <label for="comment">Comment</label>
                        <textarea class="form-control engagement-fields" id="comment" name="comment" rows="4" placeholder="Enter your comment" required></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="mybtn-primary submit-comment-btn">Submit Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="thank-you-popup modal fade" id="thankYouModal" tabindex="-1" role="dialog" aria-labelledby="thankYouModalLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <!-- Your SVG icon -->
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_13560_39402)">
                        <path d="M25.0307 0C24.183 0 23.3647 0.271988 22.6906 0.763969C22.0165 0.271988 21.1982 0 20.3505 0C18.1616 0 16.3809 1.78078 16.3809 3.96966C16.3809 8.3793 22.112 10.8862 22.3559 10.9907C22.5696 11.0823 22.8115 11.0823 23.0253 10.9907C23.2692 10.8862 29.0004 8.37936 29.0004 3.96966C29.0004 1.78078 27.2196 0 25.0307 0Z" fill="black" />
                        <path d="M20.5924 15.4718H16.3722L16.7107 12.765C16.9529 10.8221 15.4372 9.10156 13.476 9.10156C13.1642 9.10156 12.8775 9.27233 12.729 9.54653L8.53362 17.2918H7.15918V27.1812H7.7777L9.34891 28.7525C9.50818 28.9118 9.72432 29.0013 9.94964 29.0013H19.7524C21.3401 29.0013 22.6746 27.8119 22.8565 26.2346C22.8565 26.2346 23.6964 18.9544 23.6964 18.9543C23.91 17.0997 22.4583 15.4718 20.5924 15.4718Z" fill="black" />
                        <path d="M4.61055 16.3789H0.849609C0.380398 16.3789 0 16.7593 0 17.2285V27.2388C0 27.708 0.380398 28.0884 0.849609 28.0884H4.61055C5.07976 28.0884 5.46016 27.708 5.46016 27.2388V17.2285C5.46016 16.7593 5.07981 16.3789 4.61055 16.3789Z" fill="black" />
                    </g>
                    <defs>
                        <clipPath id="clip0_13560_39402">
                            <rect width="29" height="29" fill="white" />
                        </clipPath>
                    </defs>
                </svg>

                <p>Thank you for your input!</p>
            </div>
        </div>
    </div>
</div>
<!-- Comments Modal -->
<div id="commentsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel">
    <div class="modal-dialog modal-lg comments-modal" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="commentsModalLabel">All Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="comments-list" style="max-height: 400px; overflow-y: auto;">

                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="mybtn-primary close-comment-list" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- <footer id="footer" style="<?php if ($footerSettings->footre_back_color) { ?>background:<?= $footerSettings->footre_back_color ?><?php } ?>;"> -->

<div class="footer-top position-relative footer_outline" style="margin-top: -83px;">
    <div class="footer-box row" style="margin-top: 100px !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 col-sm-12 footer-links " style="background-color: white;">
                    <div class="col-md-5 col-sm-7 icons-container" style="max-width:max-content;">
                        <!-- <div class="row"> -->
                        <div class="col-md-12 col-sm-9 social_media_footer_container p-0">

                            <?php if ($socialMedias) {
                                $header_socialmedia = ($socialMedias); ?>
                                <?php foreach ($header_socialmedia as $single) { ?>

                                    <a target="_blank" href="<?= $single->link ?>" class="sicialmediaicon">
                                        @if(geticons($single->icon_id) == 'fa fa-twitter')
                                        <svg xmlns="http://www.w3.org/2000/svg" height="18px" width="18px" viewBox="-30 -50 512 512" fill="<?php if ($social_media_icon->color) {
                                                                                                                                                echo $social_media_icon->color;
                                                                                                                                            } ?>">
                                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                        </svg>
                                        @else
                                        <i style="font-size:17px !important;" class="fa-icon <?= geticons($single->icon_id) ?>"></i>
                                        @endif
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- <div class="col-md-3 col-md-3 social-media" style="padding: 0px;">
                        <h4 href="https://enfohub.com/" style="color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><a href="https://enfohub.com/"><?= $footerSettings->footer_text_1 ? $footerSettings->footer_text_1 : '' ?></a></h4>
                                </h4>
                           
                        </div> -->
                    </div>

                    <div class="container other-text col-lg-7 col-sm-5 upper-footer-content p-0">
                        <!-- <div class="mt-2"> -->
                        
                        <h4 href="https://enfohub.com/" id="copyright-text" style="font-size:14.5px;margin-top:24px;color: <?= $header_image_title_text->color ? $header_image_title_text->color : '' ?>;"><a class="header_phone_title" style="font-size:14.5px;margin-top:24px;color: <?= $header_image_title_text->color ? $header_image_title_text->color : '' ?>;" href="https://enfohub.com/"><?php echo $footerSettings->copy_right_text ? $footerSettings->copy_right_text : '&copy; ' . date("Y") ?></a>
                            <?php if ($footerSettings->footer_text) { ?>
                                <a href="<?= $footerSettings->footre_text_link ? $footerSettings->footre_text_link : '#' ?>" style="color: <?= $header_image_title_text->color ? $header_image_title_text->color : '' ?>;"><?= $footerSettings->footer_text . ' -' ?></a>
                                <?php } ?><?php echo $footerSettings->footer_text_2 ? $footerSettings->footer_text_2 : '' ?>
                        </h4>
                        <?php if (false && $businessInfo->address_for_map) { ?>
                            <h4 class="address_for_map" style="color: <?= $header_image_title_text->color ? $header_image_title_text->color : '' ?>;"><?= $businessInfo->address_for_map ?></h4>
                        <?php } ?>

                        <!-- </div> -->
                    </div>
                </div>
                <div class="row low">
                    <div class="col-md-4 col-sm-12 footer_logo_div">
                        <h4 style="font-size:14.5px;color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;"><a style="color:#656262;" href="https://enfohub.com/">This website was built using the<br>
                                <span style="display:inline-block; height: 26px;"></span>
                                <strong style="font-weight: 900;font-size:15.5px">enfohub</strong>
                                Website Builder App</a></h4>
                    </div>
                    <div class="col-md-8 col-sm-12 footer_div">
                        <h4 style="text-align: justify;"><a style="color:#656262;" href="https://enfohub.com/">The enfohub Website Builder is designed specifically for Small Businesses. It offers an advanced, user-friendly platform with integrated business tools. New customers receive an App Manager for personalized coaching on Website usage, Marketing strategies, and other Small Business essentials. Our Learning Centers enable you to learn independently and at your own pace.
                                <br>
                                <br>
                                enfohub: It's more than just a website! Get our Free Task Manager from your App store. </a></h4>
                    </div>


                </div>
            </div>
            <div class="col-md-12 col-sm-12 footer_div_last">

            </div>
        </div>
    </div>
    <div class="container py-4 ">

    </div>
    <!-- </footer> -->
    <!-- End Footer -->
</div>

<!-- <div class="container py-4 " >
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
</div> -->
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
<script>

        document.addEventListener('DOMContentLoaded', function() {
        $('#popupalert').on('click', function(event) {
            if (!$(event.target).is('button')) {
                // Close the modal
                $(this).hide(); // Example for closing the modal, adjust as per your modal logic
            }
        });
            const bannerTextColor = getComputedStyle(document.querySelector('.alertbannertext > a')).color;
        document.querySelector('.footer_logo_div a').style.color = bannerTextColor;
        document.querySelector('.footer_div a').style.color = bannerTextColor;
        var footerOutline = document.querySelector('.footer_outline');

        if (footerOutline) {
            // Traverse up the DOM to find the first parent with the class 'container'
            var parentElement = footerOutline;
            while (parentElement) {
                parentElement = parentElement.parentElement;
                if (parentElement && parentElement.classList.contains('container')) {
                    parentElement.style.marginBottom = '100px';
                    console.log(parentElement);
                    break;
                }
            }
        }
        // Get the background color of the header class
        // var headerDiv = document.querySelector('.headerdiv');

        // // Get the background color of the header
        // var headerBackgroundColor = getComputedStyle(headerDiv).backgroundColor;

        // // Check if the background color is transparent
        // if (headerBackgroundColor === 'rgba(0, 0, 0, 0)' || headerBackgroundColor === 'transparent') {
        //     // Get the background color of the body
        //     var headerBackgroundColor = getComputedStyle(document.body).backgroundColor;

        //     // Log or use the body's background color
        //     console.log('Header background is transparent. Body background color:', headerBackgroundColor);
        // } else {
        //     // Log or use the header's background color
        //     console.log('Header background color:', headerBackgroundColor);
        // }
        const alertBannerBackgroundColor = getComputedStyle(document.querySelector('#header')).backgroundColor;
        // const headerPhoneNumberColor = getComputedStyle(document.querySelector('.header_phone_text')).color;

        // Apply the background color to the footer
        // document.querySelector('.footer-links').style.backgroundColor = headerBackgroundColor;
        document.querySelector('.footer-box').style.backgroundColor = alertBannerBackgroundColor;
        const upper_footer = document.querySelector('.upper-footer-content');
        const h4Tags = upper_footer.querySelectorAll('h4');
        h4Tags.forEach(function(h4) {
            // h4.style.setProperty('color', headerPhoneNumberColor, 'important');
            // const aTags = h4.querySelectorAll('a');
            // aTags.forEach(function(a) {
            //     a.style.setProperty('color', headerPhoneNumberColor, 'important');
            // });
        });
        const alertBannerTextColor = getComputedStyle(document.querySelector('.alertbannertext > a')).color;
        document.querySelector('.footer_logo_div a').style.color = alertBannerTextColor;
        document.querySelector('.footer_div a').style.color = alertBannerTextColor;


    });
    
</script>