<?php 
  $setting = $frontSections->where('slug','blogsection')->first();
if($blog_title->enable=='1' || ($blogs && count($blogs)>0) || isset($_GET['editwebsite'])){ ?>
    @include('sections.blogsection.styles')
    
    <div id="blogsection" class="p-3 pt-4" style="">
      
    <?php if(isset($page) && $page=='list'){ ?>
      <?php if($blogSettings->blog_header_img){ ?>

        <?php if($blog_title->enable=='1'){ ?>
          <div class="position-relative title_banners_outline" >
          @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=blog_title' :status="$setting->section_enabled"/>
                    </div>
            </div>
        @endif
            <div class="blog-header-bg" style="">
           
            </div>
          </div>
        <?php } ?>
      <?php } ?>
      <?php }else{ ?>
        <?php if($blog_title->enable=='1'){ 
          ?>
          <div class="position-relative title_banners_outline" >
          @if(isset($_GET['editwebsite']))
            <div class="">
                    <div class="d-flex align-items-center">
                        <x-tutorial-action-buttons  title='Title & Banners' :buttons="isset($tutorial_action_buttons['title_banner']) ? $tutorial_action_buttons['title_banner']:'' " url='editfrontend?block=title_banners_bluebar&sb=blog_title' :status="$setting->section_enabled"/>
                    </div>
            </div>
        @endif
            <<?= $blog_title->tag ?> class="titlefontfamily blog-title-heading {{$blog_title->slug}} ">
              <?= $blog_title->text ?>
            </<?= $blog_title->tag ?>>
          </div>
        <?php } ?>
      <?php } ?>
      <div class="position-relative blog_outline blog-bg" >
      @if(isset($_GET['editwebsite']))
          <div class="">
                  <div class="d-flex align-items-center">
                      <x-tutorial-action-buttons  title='Blog' :buttons="isset($tutorial_action_buttons['blog']) ? $tutorial_action_buttons['blog']:'' " url='editfrontend?block=staff_products_promos_bluebar' :status="$setting->section_enabled"/>
                  </div>
          </div>
      @endif
        <?php if(isset($page) && $page=='list'){ ?>
          <br>
          <div class="container">
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                <form class="searchform" action="<?=url('blog-page')?>" method="post">
                @csrf
                  <div class="search-div">
                    <img src="assets/front/img/search.svg" alt="">
                    <input type="text" placeholder="Start search here" name="seachterm" class="form-control no-border seachterm" value="<?=(isset($seachterm) && $seachterm)?$seachterm:''?>">
                    <button type="button" class="btn btn-primary ml-1 btnsearch">
                      Search
                    </button>
                  </div>
                </form>
              </div>
            </div>
          <br>
            <?php if($blog_instruction){ ?>
                  <br>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="blog-instructions"><?=$blog_instruction->text?></div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <div class="row">
              <div class="col-md-12">
                <div class="blog-categories-div">
                  <a href="<?=url('blog-page')?>">
                    <div class="blog-categories <?=!session('blogcate')?'active':''?>">
                      All
                    </div>
                  </a>
                  <?php if (isset($categories) && count($categories) > 0) {
                    foreach ($categories as $single) { ?>
                      <a href="<?=url('blog-page?cate='.$single->id)?>">
                        <div class="blog-categories <?=session('blogcate')==$single->id?'active':''?>">
                          <?= $single->title?>
                        </div>
                      </a>
                  <?php }
                  }?>
                </div>
              </div>
            </div>
          </div>
        <?php }else{ 
                if($blog_page_instruction){ ?>
                  <br>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="blog-instructions-2"><?=$blog_page_instruction->text?></div>
                    </div>
                  </div>
                </div>
              <?php }
              } ?>
        <br>
        <div class="container">
          <div class="row">
            <?php if ($blogs ) { ?>
              <?php
              foreach ($blogs as $single) {
              
                if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
                  $class = 'col-md-6';
                } else {
                  $class = 'col-md-3';
                }
                $class = '';
              ?>
                <div class="<?= $class ?> col-sm-6 col-xs-6">
                  <img onclick="openTileImage('blogImage<?= $single->id ?>')" id="blogImage<?= $single->id ?>" class="lazyload" data-src="<?= get_blog_image($single->image) ?>" alt="" style="width:100%;cursor:pointer;border-radius: 10px 10px 0 0;" alt="<?=$single->short_desc?>">
                  <div class="d-flex justify-content-between pt-10">
                    <div class="blog-cate-size blog-cate-{{$single->id}}"  style=""><?=get_blog_category($single->category)?></div>
                    <div class="blog-date-size blog-date-{{$single->id}}"  style=""><?=date('m/d/Y',strtotime($single->created_at))?></div>
                  </div>
    
                  <div  class="blog-title-size  blog-title-{{$single->id}}"  style=""><?=$single->title?></div>
                  <p id="description_blogImage<?= $single->id ?>" class="blog-desc-size blog-desc-{{$single->id}}"  style=""><?= nl2br(($single->short_desc)) ?></p>
                  <a href="<?=url('blog-detail/'.$single->slug)?>">
                  <button type="button" class="btn  blog_readmore_btn_{{$single->id}}">Read More</button>
                  </a>
                  <br>
                  <br>
                </div>
              <?php
              } ?>
            <?php }else{ ?>
              <div class="text-center noblogfound">No Blogs Found</div>
            <?php } ?>
          </div>
          <?php if(isset($page) && $page=='list'){ ?>
            {!! $pagination->links() !!}
          <?php } ?>
        </div>
      </div>
      <br>
    </div>
    

    <div id="myModalTileimage1" class="tile_modal">
    
      <span class="close imgclose">&times;</span>
    
      <img class="tile_modal-content" id="img02" alt="">
    
      <div id="caption"></div>
    </div>
    
    @include('sections.blogsection.scripts')
<?php } ?>