<style>
    
.copyright{
    color: <?= $footerSettings->footre_text_color ? $footerSettings->footre_text_color : '' ?>;
}
.address_for_map{
    text-align: left;
}
.footer-audio{
    position: fixed;bottom: 0;left: 50%;transform: translate(-50%);
}
.selectedimgdiv {
    border: 4px solid #00A4FF !important;
}

.fa {
    font-size:22px !important;
}
h4{
    font-size: 14.5px;
}
.other-text h4{
    font-weight:normal !important;
}
#popupalert img{
    max-width: 100%;
}
.footer-links{
    height: max-content;
    display: flex;
    margin-top: -22px;
    /* left: 365px; */
    padding-left: 6px;
    /* height: 75px; */
}
.alert-popup-desc img{
    width: 100%;
}
.footer-hr{
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
.footer_div{
    height: max-content !important;
}


@media (max-width: 766px) {
    #copyright-text{
        margin-top: unset !important;
    }
}
@media (max-width: 766px) {
    .icons-container{
    padding: 11px 1px 0px 4px !important;
}
}
@media (max-width: 1199px) {
    .footer-links{
        <?php if(count($socialMedias) > 5){ ?>
            /* height: 99px; */
            /* left: 315px; */
    <?php } ?>
    
    }
    .icons-container{
    padding: 15px 1px 8px 4px !important;
    }
    .upper-footer-content{
        <?php if(count($socialMedias) > 5){ ?>
            margin-top: 23px;
            <?php } ?>
    }
    .social-media{
        <?php if(count($socialMedias) > 5){ ?>
            margin-top: 48px !important;
            <?php } ?>
    }
}
.social-media{
    margin-top: 10px;
}
.low{

    }
@media (max-width: 768px) {
    .social-media{
        margin-top: unset !important;
    }
    .upper-footer-content{
        margin-top: unset !important;
    }
    .footer_div {
        height: max-content !important;
        margin-left: unset !important;
    }
    .footer_logo_div{
        height: max-content !important;
        display: block;
    }
    .low{

    }
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
.make-sticky{
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


input:checked+.slider {
    background-color: #407BFF;
}
    
input:checked+.slider:before {
    background-color: #fff;
}
.slider.round {
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

input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

.slider.round:before {
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

.label-sort {
    font-family: 'Inter';
    font-style: normal;
    font-weight: 500;
    font-size: 13px;
    line-height: 16px;
    color: #000000;
}


.switch{
    position: relative;
    display: inline-block;
    width: 53px;
    height: 24px;
    margin: 0;
}

.social_media_footer_container{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: center;
    justify-content: flex-start;
    align-items: center;
}

.icons-container{
    padding: 20px 1px 0px 4px;
}

.social_media_footer_container a {
    height: 35px;
    width: 35px;
    text-align: center;
    margin-bottom:2px;
}
</style>
