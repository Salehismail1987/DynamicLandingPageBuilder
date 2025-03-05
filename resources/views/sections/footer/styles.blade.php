<style>
    .copyright {
        color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;
    }

    .address_for_map {
        text-align: left;
    }

    .footer-audio {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translate(-50%);
    }

    @media (max-width:654px) {
        .footer-audio {
            position: fixed;
            bottom: 0;
            left: 224px;
            transform: translate(-50%);
        }

        .audio-file-label {
            left: 412px;
        }
    }

    @media (max-width:644px) {
        .footer-audio {
            left: 200px;
        }

        .audio-file-label {
            left: 400px;
        }
    }

    @media (max-width:626px) {
        .footer-audio {
            left: 180px;
        }

        .audio-file-label {
            left: 410px;
        }
    }

    .selectedimgdiv {
        border: 4px solid #00A4FF !important;
    }

    .fa {
        font-size: 22px !important;
    }

    h4 {
        font-size: 14.5px;
    }

    .other-text h4 {
        font-weight: normal !important;
    }

    #popupalert img {
        max-width: 100%;
    }

    .footer-links {
        height: max-content;
        display: flex;
        margin-top: -22px;
        /* left: 365px; */
        padding-left: 6px;
        /* height: 75px; */
    }

    .alert-popup-desc img {
        width: 100%;
    }

    .footer-hr {
        border: 2px solid;
    }

    .footer_logo_div {
        bottom: 37px;
        top: 0px;
        height: max-content;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .footer_div {
        height: max-content !important;
    }


    @media (max-width: 766px) {
        #copyright-text {
            margin-top: unset !important;
        }
    }

    @media (max-width: 766px) {
        .icons-container {
            padding: 11px 1px 0px 4px !important;
        }
    }

    @media (max-width: 1199px) {
        .footer-links {
            <?php if (count($socialMedias) > 5) { ?>
            /* height: 99px; */
            /* left: 315px; */
            <?php } ?>
        }

        .icons-container {
            padding: 15px 1px 8px 4px !important;
        }

        .upper-footer-content {
            <?php if (count($socialMedias) > 5) { ?>margin-top: 23px;
            <?php } ?>
        }

        .social-media {
            <?php if (count($socialMedias) > 5) { ?>margin-top: 48px !important;
            <?php } ?>
        }
    }

    .social-media {
        margin-top: 10px;
    }

    .low {}

    @media (max-width: 768px) {
        .social-media {
            margin-top: unset !important;
        }

        .upper-footer-content {
            margin-top: unset !important;
        }

        .footer_div {
            height: max-content !important;
            margin-left: unset !important;
        }

        .footer_logo_div {
            height: max-content !important;
            display: block;
        }

        .low {}
    }

    .footer_div {
        bottom: 37px;
        /* margin-left: 85px; */
        top: 0px;
        height: 39px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .footer_div_last {
        bottom: 37px;
        top: 0px;
        height: 89px;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center;
    }

    .make-sticky {
        position: fixed;
        bottom: 30px;
        background: #E3F3FF;
        border-radius: 4px;
        padding: 10px;
        left: 12%;
        transform: translate(-38%);
        border-radius: 4px;
        z-index: 1;
        box-shadow: 0 0 10px #00000033;
        width: max-content;
        max-width: 100%;
    }


    input:checked+.glider {
        background-color: #407BFF;
    }

    input:checked+.slider {
        background-color: #407BFF;
    }

    input:checked+.glider:before {
        background-color: #fff;
    }

    input:checked+.slider:before {
        background-color: #fff;
    }

    input:checked+.glider:before {
        background-color: #fff;
    }

    .slider.round {
        border-radius: 34px;
        background-color: #407BFF;
    }

    .glider.round {
        border-radius: 34px;
        background-color: #407BFF;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #9f9f9f;
        box-shadow: 0px 0px 4px rgb(0 0 0 / 25%);
        -webkit-transition: .4s;
        transition: .4s;
    }

    .glider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #9f9f9f;
        box-shadow: 0px 0px 4px rgb(0 0 0 / 25%);
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    input:checked+.glider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .glider.round:before {
        border-radius: 50%;
    }

    .slider:before {

        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 3.5px;
        background-color: #D9D9D9;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .glider:before {

        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 3.5px;
        background-color: #fff;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .label-sort {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-size: 13px;
        line-height: 16px;
        color: #000000;
    }


    .switch {
        position: relative;
        display: inline-block;
        width: 53px;
        height: 24px;
        margin: 0;
    }

    .social_media_footer_container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-start;
        align-items: center;
    }

    .icons-container {
        padding: 20px 1px 0px 4px;
    }

    .social_media_footer_container a {
        height: 35px;
        width: 35px;
        text-align: center;
        margin-bottom: 2px;
    }

    .business-svg {
        display: flex;
        justify-content: center;
    }

    .service-svg {
        display: flex;
        justify-content: center;
    }

    .website-svg {
        display: flex;
        justify-content: center;
    }
    .business-svgs {
        display: flex;
        justify-content: center;
    }

    .service-svgs {
        display: flex;
        justify-content: center;
    }

    .website-svgs {
        display: flex;
        justify-content: center;
    }

    .like-box {
        margin-bottom: 20px;
    }

    #likes-dialog {
        margin-left: 149px;
        margin-top: 68px;
        /* border: 2px solid; */
        border-radius: 9px;
        border-color: #545556;
    }

    .submit-like-btn {
        padding: 5px 20px !important;
        background: black !important;
        border: 0px !important;
    }

    .leave-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
    }

    .read-comments-btn {
        padding: 5px 20px !important;
        background: #A8AEB4 !important;
        border: 0px !important;
    }

    .comments-btn-div {
        margin-top: 20px;
    }

    .comments-no {
        display: flex;
        justify-content: end;
        padding-right: 41px;
    }

    .likes-modal-header {
        color: #626262 !important;
        font-weight: 600 !important;
        /* font-size: 12px; */
        line-height: 14.52px;
        line-height: 2;
    }
    .italic{
        font-style: italic;
    }



    .engagement-fields {
        background: #F3F3F3;
        border: 0px;
    }

    #engagementCommentModalLabel {
        line-height: 19.36px;
        font-size: 16px;
        font-weight: 600;
    }

    #engagementCommentForm {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .like-comment-div {
        margin-bottom: 30px;
    }

    .custom-dialog {
        display: inline-block;
        /* Inline-block instead of flex */
        width: 450px;
        /* Custom width */
        max-width: 100%;
        /* Responsive */
        margin: 0 auto;
        /* Center horizontally */
        vertical-align: middle;
        /* Center vertically */
    }

    .modal-dialog-centered {
        display: table;
        /* Required for vertical centering */
        height: 100vh;
        margin: 12% auto;
    }

    .modal-dialog-centered:before {
        content: '';
        display: table-cell;
        vertical-align: middle;
    }

    .thank-you-popup .modal-dialog {
        max-width: 300px;
        /* Adjust based on your design */
    }

    .thank-you-popup svg {
        margin-bottom: 20px;
        /* Space between SVG and text */
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .thank-you-popup p {
        font-size: 18px;
        color: #333;
    }

    .modal-header {
        border-bottom: 0px;
    }

    #commentsModalLabel {
        text-align: center;
        font-size: 16px;
        color: black;
        line-height: 19.36px;
    }

    .comments-modal {
        width: 490px;
        margin: 0 auto;
    }

    .comment-item {
        margin-top: 16px;
    }

    .modal-footer {
        border-bottom: 0px;
        text-align: center;
    }

    .close-comment-list {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white !important;
    }

    .like-icon.selected {
        background-color: #f8d7da;
        border-radius: 10px;
    }
    .like-icon{
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
    }
    .like-modal-header{
        padding-left: 29px;
        margin-top: 25px;
    }
    .submit-comment-btn {
        padding: 5px 20px !important;
        background: #63676A !important;
        border: 0px !important;
        color: white;
    }

    .modal-footer {
        border-radius: 0px;
    }

    @media (max-width: 1070px) {
        #likes-dialog {
            margin-left: 88px !important;
        }
    }

    @media (max-width: 981px) {
        .submit-comment-btn {
            font-size: 11px;
        }

        .submit-like-btn {
            font-size: 11px;
        }

        .leave-comment-btn {
            font-size: 11px;
        }

        .read-comments-btn {
            font-size: 11px;
        }
    }

    @media (max-width: 600px) {
        #likes-dialog {
            margin: 0 auto !important;
        }
    }
    @media (max-width: 597px) {
        #likes-dialog {
            top: 25%;
        }

        .submit-comment-btn {
            font-size: 11px;
            color: white;
        }

        .submit-like-btn {
            font-size: 11px;
        }

        .leave-comment-btn {
            font-size: 11px;
        }

        .read-comments-btn {
            font-size: 11px;
        }
    }
    @media (max-width: 430px) {
        .comments-modal {
        width: 353px;
        margin: 0 auto;
        top: 15%;
    }
        #likes-dialog {
        width: 353px !important;
        margin: 0 auto;
        top: 15%;
    }
    }


</style>