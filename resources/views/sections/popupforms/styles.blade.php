<?php $form_logo = $custom_form_logo; ?>

<?php $form_title = get_text_details('form_title'); ?>
<?php $form_subtitle = get_text_details('form_subtitle'); ?>
<?php $form_descriptive_text = get_text_details('form_descriptive_text'); ?>
<?php $custom_form_footer_text_1 = get_text_details('custom_form_footer_text_1'); ?>
<?php $custom_form_footer_text_2 = get_text_details('custom_form_footer_text_2'); ?>
<style>
    .invalid-otp{
        display: none;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Inter';
        color: #FD2020;
    }
    .custom-email-dialog {
        height: 240px;
        width: 600px;
        margin: auto;
        margin-top: 10%;
    }
    #location-modal .modal-dialog.custom-otp-dialog {
    width: -webkit-fill-available;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ensures full-height alignment */
}
    #success-modal .modal-dialog.custom-otp-dialog {
    width: -webkit-fill-available;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ensures full-height alignment */
}
    #failed-stripe-modal .modal-dialog.custom-otp-dialog {
    width: -webkit-fill-available;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ensures full-height alignment */
}

#location-modal .modal-content {
    width: auto; /* Allows the content to determine the width */
    max-width: 90%; /* Ensures the modal is responsive */
    margin: 0 auto; /* Centers the modal */
}
#success-modal .modal-content {
    min-width: 20%;
    width: auto; /* Allows the content to determine the width */
    max-width: 90%; /* Ensures the modal is responsive */
    margin: 0 auto; /* Centers the modal */
}
#failed-stripe-modal .modal-content {
    min-width: 20%;
    width: auto; /* Allows the content to determine the width */
    max-width: 90%; /* Ensures the modal is responsive */
    margin: 0 auto; /* Centers the modal */
}
    #failed-modal .modal-dialog.custom-otp-dialog {
    width: -webkit-fill-available;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh; /* Ensures full-height alignment */
}

#failed-modal .modal-content {
    width: auto; /* Allows the content to determine the width */
    max-width: 90%; /* Ensures the modal is responsive */
    margin: 0 auto; /* Centers the modal */
}
    @media only screen and (max-width: 430px) {
        .custom-email-dialog {
            height: 260px;
            width: 340px;
        }
        .custom-otp-dialog{
            height: 260px;
            width: 416px;
            margin-top: -16%;
        }
    }

    .img-max-width {
        <?php if ($form_logo && $form_logo->max_width) { ?>max-width: <?= $form_logo->max_width . 'px' ?>;
        <?php } ?>
    }

    .site-buttons {
        width: 261px;
        height: 45px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        /* Adjust padding as needed */
    }

    .site-buttons text {
        margin-left: -1.5rem;
        /* Space between the icon and text */
    }

    .yelp {
        background-color: #EB4335;
        border-color: #EB4335;
        margin-top: 4px;
    }

    .google {
        background-color: #4285F4;
        border-color: #4285F4;
        margin-top: 9px;
    }

    .trustpilot {
        background-color: #f1f1e8;
        border-color: #f1f1e8;
        margin-top: 9px;
    }

    .other {
        background-color: #40A9F9;
        border-color: #40A9F9;
        margin-top: 9px;

    }

    .fl {
        float: left;
    }

    .tpilot_text{
        color: black !important;
    }

    .custom-phone-number-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
    }

    .custom-modal-header {
        background-color: #f8f9fa;
        border-bottom: none;
        text-align: center;
    }

    .custom-modal-title {
        margin: 0 auto;
    }

    .custom-modal-close {
        position: absolute;
        right: 1rem;
        top: 1rem;
    }

    .custom-modal-body {
        text-align: center;
        padding: 20px;
    }

    .custom-modal-text {
        margin-bottom: 20px;
        color: #6c757d;
    }

    .custom-input-group {
        display: flex;
        align-items: center;
    }

    .btn-primary {
        background: #3FA8F9 !important;
    }

    .btn {
        font-family: 'Inter' !important;
        font-style: normal !important;
        font-weight: 400 !important;
        font-size: 13px !important;
        line-height: 16px !important;
        text-align: center !important;
        color: #FFFFFF;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1) !important;
        /* border-radius: 61px !important; */
        border: none !important;
        padding: 5px 27px !important;
        /* width: 135px;
    height: 36px; */
    }

    .custom-input-group-prepend {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border-right: none;
        border-radius: 0.25rem;
        padding-left: 10px;
        display: flex;
        justify-content: space-between;
        width: 20% !important;
        border-right: 1px solid #9d9999;
        padding-right: 4px;
    }

    #custom_phone_number {
        width: 80% !important;
    }

    .custom-input-group-text {
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border-right: none;
        border-radius: 0.25rem;
    }

    .custom-flag-icon {
        margin-right: 8px;
        width: 24px;
        height: auto;
        border-radius: 50%;
    }

    .custom-form-control {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .otp-save {
        top: 450px;
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .custom-input-group-prepend {
        background: #efefef !important;
        width: 75px !important;
    }

    #custom_phone_number {
        width: 200px !important;
        background: #efefef;
    }

    .custom-input-group {
        width: 275px;
        padding: 5px;
        border-radius: 5px;
        background: #efefef;
    }

    .custom-submit-btn {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 0.25rem;
    }

    .custom-otp-submit-btn {
        background: #3FA8F9 !important;
        border-radius: 61px !important;
        width: 135px !important;
        height: 36px !important;
    }

    .otp-input-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    /* CSS for custom OTP modal */
    .custom-otp-modal-header {
        border-bottom: none;
        text-align: center;
    }

    .custom-otp-modal-title {
        font-weight: bold;
        margin: 0 auto;
    }

    .custom-otp-modal-close {
        outline: none;
        border: none;
        background: none;
    }

    .custom-otp-modal-body {
        text-align: center;
        padding: 20px;
    }

    .custom-otp-modal-text {
        margin-bottom: 20px;
        color: #777777;
    }

    .otp-input {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background-color: #f5f5f5;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin: 0 5px;
    }

    .custom-otp-submit-btn {
        width: 100%;
        border-radius: 30px;
    }

    .custom-submit-btn:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .validate,
    .text-red {
        color: red;
    }

    .timepicker {
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 50px;
        opacity: 0;
    }

    .top-right {
        position: absolute;
        bottom: 12px;
        right: 20px;
    }

    .dcatcha {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .numberspls {
        background: #0000005c;
        padding: 10px;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
    }

    .numberspls-hidden {
        color: transparent;
    }

    .dcatcha * {
        margin-right: 10px;
    }

    .contact .php-email-form .error-message {
        display: none;
        color: #fff;
        background: #ed3c0d;
        text-align: left;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .sent-message {
        display: none;
        color: #fff;
        background: #18d26e;
        text-align: center;
        padding: 15px;
        font-weight: 600;
    }

    .contact .php-email-form .loading {
        display: none;
        background: #fff;
        text-align: center;
        padding: 15px;
    }

    .textinput {
        margin: 10px 0;
    }

    .formtitle {
        text-align: center;
        margin-bottom: 10px;
        <?php if ($form_title->size_web) {
            echo 'font-size: ' . $form_title->size_web . 'px !important;';
        } ?><?php if ($form_title->color) {
                echo 'color: ' . $form_title->color . '!important;';
            } ?><?php if ($form_title->fontfamily) {
                echo 'font-family: ' . getfontfamily($form_title->fontfamily) . '!important;';
            } ?>;
    }

    .formsubtitle {
        text-align: center;
        margin-bottom: 10px;
        <?php if ($form_subtitle->size_web) {
            echo 'font-size: ' . $form_subtitle->size_web . 'px !important;';
        } ?><?php if ($form_subtitle->color) {
                echo 'color: ' . $form_subtitle->color . '!important;';
            } ?><?php if ($form_subtitle->fontfamily) {
                echo 'font-family: ' . getfontfamily($form_subtitle->fontfamily) . '!important;';
            } ?>;
    }

    .formdescriptivetext {
        text-align: justify;
        margin-bottom: 10px;
        <?php if ($form_descriptive_text->size_web) {
            echo 'font-size: ' . $form_descriptive_text->size_web . 'px !important;';
        } ?><?php if ($form_descriptive_text->color) {
                echo 'color: ' . $form_descriptive_text->color . '!important;';
            } ?><?php if ($form_descriptive_text->fontfamily) {
                echo 'font-family: ' . getfontfamily($form_descriptive_text->fontfamily) . '!important;';
            } ?>;
    }

    .cf_footer_text_1 {
        text-align: center;
        margin-bottom: 10px;
        <?php if ($custom_form_footer_text_1->size_web) {
            echo 'font-size: ' . $custom_form_footer_text_1->size_web . 'px !important;';
        } ?><?php if ($custom_form_footer_text_1->color) {
                echo 'color: ' . $custom_form_footer_text_1->color . '!important;';
            } ?><?php if ($custom_form_footer_text_1->fontfamily) {
                echo 'font-family: ' . getfontfamily($custom_form_footer_text_1->fontfamily) . '!important;';
            } ?>;
    }

    .cf_footer_text_2 {
        text-align: center;
        margin-bottom: 10px;
        <?php if ($custom_form_footer_text_2->size_web) {
            echo 'font-size: ' . $custom_form_footer_text_2->size_web . 'px !important;';
        } ?><?php if ($custom_form_footer_text_2->color) {
                echo 'color: ' . $custom_form_footer_text_2->color . '!important;';
            } ?><?php if ($custom_form_footer_text_2->fontfamily) {
                echo 'font-family: ' . getfontfamily($custom_form_footer_text_2->fontfamily) . '!important;';
            } ?>;
    }

    @media only screen and (max-width: 600px) {
        .formtitle {
            <?php if ($form_title->size_mobile) {
                echo 'font-size: ' . $form_title->size_mobile . 'px !important;';
            } ?>
        }

        .formsubtitle {
            <?php if ($form_subtitle->size_mobile) {
                echo 'font-size: ' . $form_subtitle->size_mobile . 'px !important;';
            } ?>
        }

        .formdescriptivetext {
            <?php if ($form_descriptive_text->size_mobile) {
                echo 'font-size: ' . $form_descriptive_text->size_mobile . 'px !important;';
            } ?>
        }

        .cf_footer_text_1 {
            <?php if ($custom_form_footer_text_1->size_mobile) {
                echo 'font-size: ' . $custom_form_footer_text_1->size_mobile . 'px !important;';
            } ?>
        }

        .cf_footer_text_2 {
            <?php if ($custom_form_footer_text_2->size_mobile) {
                echo 'font-size: ' . $custom_form_footer_text_2->size_mobile . 'px !important;';
            } ?>
        }
    }
    <?php
    foreach ($customFormsAll as $single) {
        foreach($single->actionButtons as $single){
        // dd(isset($single->active));
        // if (isset($single->active) && $single->active == 1) {
        ?>
            .gallery-post-action-button-<?=$single->id?>{
                margin-bottom: 10px;
                <?= $single->text_color ? 'color:' . $single->text_color .'!important'. ';' : '' ?>
                 <?= $single->bg_color ? 'background:' . $single->bg_color.'!important' . ';' : '' ?>
            }
        <?php
        // } 
    }
}?>

    @media only screen and (max-width: 500px) {
        .img-max-width {
            max-width: 100%;
        }
    }
</style>