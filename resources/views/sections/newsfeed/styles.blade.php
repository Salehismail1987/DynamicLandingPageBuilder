
<style>
  #news-feed-section::before {
    content: '';
    display: block;
    
    
    visibility: hidden;
  }

  .single-news{
    background: linear-gradient(90deg, <?php if($newsFeedSetting->newsfeed_bg_color){ echo $newsFeedSetting->newsfeed_bg_color ; }else{ echo 'rgb(46 45 56)';} ?> 0%, <?php if($newsFeedSetting->newsfeed_bg_color){ echo $newsFeedSetting->newsfeed_bg_color ; }else{ echo 'rgb(82,80,80,1)';} ?> 51%);
    border-radius: 1rem;
    padding: 0;
    margin-top:16px;
  }

  .news-title{
    /* background: linear-gradient(45deg, black, transparent); */
    /* padding: 1rem;/ */
    padding-top: 40px;
  }

  .news-desc{
    padding-top: 1.5rem !important;
  }

  .newsfeed-title {
    padding: 20px !important;
    text-align: center !important;
    line-height: 1;
    <?php if ($news_feed_title->color) { ?>color: <?= $news_feed_title->color ?> !important; <?php } ?>
    <?php if ($news_feed_title->bg_color) { ?>background: <?= $news_feed_title->bg_color ?> !important;<?php } ?>
    <?php if ($news_feed_title->size_web) { ?>font-size: <?= $news_feed_title->size_web ?>px;<?php } ?>
    <?php if ($news_feed_title->fontfamily) { ?>font-family: <?= getfontfamily($news_feed_title->fontfamily) ?> !important;<?php } ?>
  }
  <?php
  $class_desc_size = "";
  if ($generic_newsfeed_desc->size_mobile) {
    $class_desc_size = 'newsfeed-desc-size';
    ?>@media only screen and (max-width: 600px) {
      .newsfeed-desc-size_generic {
        <?= 'font-size:' .$generic_newsfeed_desc->size_mobile.'px !important;' ?>
      }
      .title_size_class_generic{
        <?= 'font-size:' .$generic_newsfeed_title->size_mobile.'px !important;' ?>
      }
      .news-title{
        padding-top:0px !important;
      }
    }
    <?php 
  }
  ?>
  .newsfeed-desc-size_generic {
        <?= 'font-size:' .$generic_newsfeed_desc->size_web.'px ;' ?>
      }
   .title_size_class_generic{
        <?= 'font-size:' .$generic_newsfeed_title->size_web.'px ;' ?>
      }
<?php
if ($generic_newsfeed_title->size_mobile) {
  ?>
  @media only screen and (max-width: 600px) {
    .newsfeed-title {
        padding: 3px !important;
      text-align: center !important;
      <?= 'font-size:' . ($generic_newsfeed_title->size_mobile ? $generic_newsfeed_title->size_mobile . 'px' : '18px') . ' !important;' ?>
    }

    .padding_class{
        padding:0.5rem !important;
    }
  }

    .padding_class{
        padding:1rem !important;
    }
  <?php
  }
  
  ?>
.equal::-webkit-scrollbar{ width :6px; }
#div-feed::-webkit-scrollbar {
  width: 0.8rem;
}
.equal::-webkit-scrollbar-track {
  box-shadow: inset 0 0 8px #a49f9f;
  background: linear-gradient(45deg, black, #222020c7);
}
.equal::-webkit-scrollbar-thumb {
  border-radius:2px;
  
  background:#a49f9f
}
#div-feed{
    height:580px !important;
  }
@media only screen and (max-width: 768px) {
  #div-feed{
    height:450px !important;
  }
}

#div-feed{
    
    justify-content: center !important;
                overflow-y: scroll !important;
}

#loadMore{
    margin-top:1rem;
}

.btn-loadmore{
    font-size:18px
}

#noMore{
    display:none;margin-top:1rem;
}



<?php 

if($news_feed_title_setting->enable_theme_bg =='1'){
    ?>
    .newsfeed-title{
        background-color:transparent !important;
        background:transparent !important;
    }
    <?php
}
?>
 .newsfeed-bg{
  <?php
    if(isset($_GET['editwebsite']) && $setting->section_enabled == 0 && $frontSectionSetting->all_feature_for_edit_website == 1)
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
          } elseif($newsFeedSetting->news_feed_bg && $newsFeedSetting->news_feed_override_bg=='1'){
            echo 'background:'.$newsFeedSetting->news_feed_bg.' !important';
          } else{ 
              echo 'transparent:';
          } 
          ?> 
    }

    #newsfeed  img{
      width: 100%;
  }
</style>