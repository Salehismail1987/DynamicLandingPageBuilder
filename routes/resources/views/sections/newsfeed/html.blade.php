<?php 
$setting = $frontSections->where('slug','newsfeed')->first();
if($news_feed_title->enable=='1' || isset($_GET['editwebsite']) || (count($news_feeds->toArray())>0)){ ?>
    @include('sections.newsfeed.styles')
    <div id="newsfeed" class="p-3">
        <?php if($news_feed_title->enable=='1'){ ?>
            <div class="position-relative title_banners_outline">
            @if(isset($_GET['editwebsite']))
                <div class="">
                        <div class="d-flex align-items-center">
                            <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=news_feed_title'/>
                        </div>
                </div>
            @endif
                <<?= $news_feed_title->tag ?> class="titlefontfamily newsfeed-title">
                    <?= $news_feed_title->text ?>
                   
                </<?= $news_feed_title->tag ?>>
            </div>
        <?php } ?>
        <div class="position-relative news_feed_outline" >
        @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='News Feed' :buttons="isset($tutorial_action_buttons['news_feed']) ? $tutorial_action_buttons['news_feed']:'' " url='quicksettings?block=newsfeed_bluebar&sb=news_feed' :status="$setting->section_enabled"/>
                    </div>
            </div>
        @endif
            <div class="newsfeed-bg">
                <div class="container " >
                    <div >
                        <div id="div-feed" class="row equal feed-div" style="">
                        <div id="feed-container" style="">
                        
                        </div>
                        <?php 
                            if(count($news_feeds->toArray())>0){
                                ?>
                                <div class="row " id="loadMore" style="">
                                    <div class="col-md-12">
                                        <center>
                                                <button style="" type="button" class="btn btn-default btn-loadmore" onclick="loadmore()" value="loadmore" >Load More</button>
                                                <input type="hidden" name="limit" id="limit" value="5"/>
                                                <input type="hidden" name="offset" id="offset" value="10"/>
                                        </center>    
                                    </div>
                                </div>
                                <div class="row " id="noMore" style="">
                                    <div class="col-md-12">
                                        <center>
                                            <h4>
                                            End of News Feed ...
                                            </h4>
                                        </center>
                                    </div>
                                </div>
                                <?php 
                            }else{
                            ?>
                                <div class="col-md-12">
                                        <center>
                                            <h4>
                                            Nothing to show in News Feed
                                            </h4>
                                        </center>
                                    </div>
                            <?php
                            }
                        ?>
                        </div>
                        
                    </div>
                
                </div>
            </div>
        </div>
    </div>
    @include('sections.newsfeed.scripts')
<?php } ?>