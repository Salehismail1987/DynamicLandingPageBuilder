
<style>
    
    .my-nav-bar{
        padding: 0;
        width: fit-content;
        margin-left: auto;
        @if ($navBarSettings->stick_to_top=='1')
            position: fixed;
            z-index: 100;
            width: 100%;
            text-align: right;
            right:0;
            /* top: 72px;   */
        @endif

    }
    .my-nav-bar ul{
        padding: 0;
        margin: 0;
    }
    .my-nav-bar ul li{
        display: inline;
    }
    .my-nav-bar ul li a{
        margin: 0;
        font-size: 20px;
        <?= $navBarSettings->font_family ? 'font-family:' . getfontfamily($navBarSettings->font_family) . ';' : '' ?>
        <?= $navBarSettings->text_color ? 'color:' .$navBarSettings->text_color. ';' : '' ?>
        @if ($navBarSettings->enable_banner=='1')
            <?= $navBarSettings->banner_color ? 'background:' .$navBarSettings->banner_color. ';' : '' ?>
        @endif
    }
    .my-nav-bar ul li a{
        /* border-radius:5px; */
        padding: 5px 15px;
    }
    @foreach ($navBarItems as $navBarItem)
        @if ($navBarItem->enable_banner=='1')
            .my-nav-bar-item-{{$navBarItem->id}}{
                <?= $navBarSettings->banner_color ? 'background:' .$navBarSettings->banner_color. ';' : '' ?>
            }
        @endif
    @endforeach
    @foreach ($navBarItems as $navBarItem)
        .my-nav-bar-item-{{$navBarItem->id}}{
            @if ($navBarItem->use_default_text_color=='0')
                <?= $navBarItem->color ? 'color:' .$navBarItem->color. '!important;' : '' ?>
            @endif
        }
    @endforeach
    .headerdiv{
        box-shadow: none;
        <?php
        if(isset($_GET['editwebsite']) && $header_setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }?>
         <?php 
          } elseif($headerImages->header_background_color && $headerImages->header_block_override_bg=='1'){
            echo 'background:'.$headerImages->header_background_color.' !important';
          }
          else
          {
            echo 'background:transparent;';
          }
          ?>   
    }
    .header-bg{
        <?php if ($headerImages->header_background_color && $headerImages->header_block_override_bg =='1') {
            echo 'background:' . $headerImages->header_background_color . ';';
        } ?>
    }
    #hero{
        <?php
        if(isset($_GET['editwebsite']) && $header_setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }?>
         <?php 
          } 
          else
          {
            echo 'background:transparent;';
          }
          ?>   
    }
    .header-bg{
        <?php if ($headerImages->header_background_color && $headerImages->header_block_override_bg =='1') {
            echo 'background:' . $headerImages->header_background_color . ';';
        } ?>
    }
    .header-bg-2{
        overflow-y: scroll !important;
    
    }
    <?php
    if ($step_image = check_step_image('Header Logo')) {
    ?>
        .header-logo-p{
            padding-bottom: 0;
            text-align:center;
            color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;
            font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;
            <?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>
        }
    <?php 
    }?>
    <?php
    if ($step_image = check_step_image('Header Image Title')) {
    ?>
        .haeder-image-title-p{
            padding-bottom: 0;text-align:center;color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;<?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>
        }
    <?php 
    }
    ?>

    <?php
    if ($step_image = check_step_image('Header Slider')) {
    ?>
        <?php
        if (!empty($step_image['text'])) {
        ?>
            .header-slider-p{
                padding-bottom: 0;text-align:center;color:<?= $step_image['color'] ? $step_image['color'] : '#000000' ?>;font-size:<?= $step_image['size'] ? $step_image['size'] . 'px' : '18px' ?>;<?= $step_image['font'] ? 'font-family:' . getfontfamily($step_image['font']) . ';' : '' ?>
            }
        <?php 
        }
        ?>
    <?php 
    }
    ?>
    .header-slider-img{
        width: 100% !important;
        margin: auto !important;
    }
    .frame {
        margin: auto;
        width: 60%;
    }
    .caption{
        <?php if ($header_slider_text->size_web) {
            echo 'font-size: '.$header_slider_text->size_web.'px !important;';
        }?>
        <?php if ($header_slider_text->color) {
            echo 'color: '.$header_slider_text->color.'!important;';
        }?>
        <?php if ($header_slider_text->fontfamily) {
            echo 'font-family: '.getfontfamily($header_slider_text->fontfamily).'!important;';
        }?>;
     line-height:1.1;
      font-weight:bold;
    }


        @media only screen and (max-width: 600px) {
            .caption{
                <?php if ($header_slider_text->size_mobile) {
                    echo 'font-size: '.$header_slider_text->size_mobile.'px !important;';
                }else{
                    echo 'font-size: 18px !important;';
                }?>
            }
            .frame {
                width: 100% !important;
            }

            .frame  img{
                width: 100%  !important;
            }
        }
    

    
    /* Top left text */
    .top-left-text {
      position: absolute;
      top: 8px;
      left: 9%;
      padding-left: 2%;
      width: 43%;
    height: 43%;
    text-align: left !important;
    }
    
    /* Top right text */
    .top-right-text {
      position: absolute;
      top: 8px;
      right: 9%;
      width: 43%;
       height: 43%;
       padding-right: 2%;
       text-align:right !important;
    }
    
    /* Bottom right text */
    .bottom-right-text {
      position: absolute;
      bottom: 8px;
      right: 9%;
      width: 43%;
      padding-right: 2%;
      height: 43%;
      align-items: flex-end;
    display: flex;
    text-align:right !important;
    }

     /* Bottom left text */
     .bottom-left-text {
      position: absolute;
      bottom: 8px;
      left: 9%;
      width: 43%;
      height: 43%;
      padding-left: 2%;
      align-items: flex-end;
        display: flex;
        text-align:left !important;
    }
    
    /* Centered text */
    .centered-text {
    text-align:center !important;
      position: absolute;
      top:50%;
      width:80%;
      left:50%;
      transform: translate(-50%, -50%);
    }
    
    /* Top Center Text */
    .top-center-text{
        text-align:center !important;
        position:absolute;
        top: 8px;
        left:9%;
        right:9%;
    }

    /* Bottom Center Text */
    .bottom-center-text{
        text-align:center !important;
        position:absolute;
        bottom: 8px;
        left:9%;
        right:9%;
    }
   
    .item {
      position: relative;
      text-align:center;
    }

    /* width */
    #hero::-webkit-scrollbar {
        margin: 15px 0px;
        max-height: 500px;

        <?php if ($headerImages->header_scrollbar_width) {
            echo 'width:' . $headerImages->header_scrollbar_width . 'px;';
        } else {
            echo 'width:' . '10px;';
        }

        ?>
    }

    /* Track */
    #hero::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
    }

    /* Handle */
    #hero::-webkit-scrollbar-thumb {
        border-radius: 10px;

        <?php if ($headerImages->header_scrollbar_color) {
            echo 'background:' . $headerImages->header_scrollbar_color . ';';
        } else {
            echo "background: #e2dc12;";
        }

        ?>
    }

    /* Handle on hover */
    #hero::-webkit-scrollbar-thumb:hover {
        <?php if ($headerImages->header_scrollbar_color) {
            echo 'background:' . $headerImages->header_scrollbar_color . ';';
        } else {
            echo "background: #fffb81;";
        }

        ?>
    }

    /* #hero::-webkit-scrollbar-track-piece:end {
    background: transparent;
    margin-bottom: 40px; 
  }

  #hero::-webkit-scrollbar-track-piece:start {
      background: transparent;
      margin-top: 40px;
  } */

    @media only screen and (min-width: 600px) and (max-width: 1200px) {
        .main_header_second_image {
            max-width: 210px !important;
        }
    }

    .header-slider-video::-webkit-media-controls {
        display: none;
    }
    
    .header-slider-video{
        opacity: 0.7;
    }

    .toprightdivaudio{
        position: absolute;
        right: 10px;
        top: 40px;
        z-index: 1;
        border-radius: 20px;
    }

    .toprightdivaudio img{
        border-radius: 20px;
    }

    
    .social-media-container{
            margin-top:20px;display: flex;flex-direction: row;flex-wrap: wrap; align-content: center; justify-content: center; align-items: center; padding-bottom: 10px;
        }
        .social-media-container a{
                height:42px;
                width:42px;
            }  
    @media only screen and (max-width: 600px) {
            .toprightdivaudio{
                position: absolute;
                right: 5px;
                top: 5px;
                z-index: 1;
                border-radius: 20px;
            }

            .social-media-container a{
                height:40px;
                width:40px;
            }  
        }
        .headerdiv{
                width: auto !important;
        }
        @media  only screen and (max-width: 768px){
            .headerdiv{
                width: 100% !important;
                position: absolute !important;
            }

            #hero.d-flex{
                display: block !important;
            }
        }
        .header-slider-background{
    <?php
    if(isset($_GET['editwebsite']) && $slider_setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
         {
           if($siteSettings->site_background_theme == 0)
           {
             echo "background:white !important;";
           }
           else
           {
             echo "background:black !important;";
           }?>
         <?php 
          } elseif($headerImages->header_slider_background){
            echo 'background:'.$headerImages->header_slider_background.' !important';
          }
          ?>   
        }
     
</style>