@include('blog-page.header.html')
@include('blog-page.styles')

@include('blog-detail.styles')
<style>
     .related-articles{
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 29px;
    }
#blogsection::before {
  content: '';
  display: block;
  
  
  visibility: hidden;
}
</style>
<div id="blogsection" class="p-3 pt-4" style="margin-top: 10px;">
  
<div class="blog-header-bg" style="">
  
    </div>
  
  <br>
  <div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php if ($blog ) { ?>
                <div class="row"> 
                    <div class="com-md-12">
                        <<?= $blog->tag?$blog->tag:'p' ?> class="titlefontfamily blog-title-heading blog-title-<?=$blog->id?>  bg-none " style="font-size:34px !important">
                        <?= $blog->title ?>
                        
                        </<?= $blog->tag?$blog->tag:'p'  ?>>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <img onclick="openImage('blogImage<?= $blog->id ?>')" id="blogImage<?= $blog->id ?>" class="lazyload" data-src="<?= get_blog_image($blog->image) ?>" alt="" style="width:100%;cursor:pointer;border-radius: 10px 10px 0 0;" alt="<?=$blog->short_desc?>">
                    </div>
                   <div class="col-md-1"></div>
                </div>
                    <div class="d-flex justify-content-between pt-10">
                    <div class="blog-cate-size blog-cate-{{$blog->id}}" ><?=get_blog_category($blog->category)?></div>
                    <div class="blog-date-size blog-date-{{$blog->id}}"  ><?=date('m/d/Y',strtotime($blog->created_at))?></div>
                    </div>

                    <p id="description_blogImage<?= $blog->id ?>" class="blog-desc-size otherblog-desc-{{$blog->id}} blog-desc-{{$blog->id}}"  ><?= nl2br(($blog->short_desc)) ?></p>
                    <div class="blog-description blog-desc-size blog-desc-{{$blog->id}}">
                        <?=$blog->description?>
                    </div>
                    <?php if($blog->btn_text!=''){ ?>
                        
                    <?php } 
                    if (isset($blog->action_button_active) && $blog->action_button_active == '1') {
                        $input_link = '#';
                        $target = '';
                        $popupform='';
                        $audioclass='';
                        $data_toggle='';
                        $data_target='';
                        if ($blog->btn_link == 'link') {
                            $input_link = $blog->action_button_link_text;
                            $target = "_blank";
                        
                        }elseif ($blog->btn_link == 'customforms') {
                            $input_link = '#';
                            $target = "";
                            
                            $popupform = 'data-toggle="modal" data-target="#modalcustomforms'.getCustomformEncodedID($blog->action_button_customform).'"';

                        }elseif( $blog->btn_link == "google_map"){

                            $address_full = isset($blog->action_button_map_address ) ? $blog->action_button_map_address: "";
                            $input_link = "http://maps.google.com/maps?q=".$address_full;
                            $target = "_blank";
                        
                        }elseif($blog->btn_link == "address" ){

                            $address =  getaddress_info($blog->action_button_address_id);
                    
                            $address_full = isset($address->street ) ? $address->street.', '.$address->city.' '.$address->zip_code.', '.$address->state. ' '.$address->country: "";
                            $input_link = "http://maps.google.com/maps?q=".$address_full;
                            $target = "_blank";
                        
                        }elseif($blog->btn_link == "audioiconfeature" ){
    
                            if ( $blog->action_button_audio_icon_feature) {?>  
                              <div class="action-audio" >                                  
                                    <audio class="hidden" id="blogAudio_<?= $blog->id ?>" controls>
                                        <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_audio_icon_feature) ?>" type="audio/mp3">
                                        <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_audio_icon_feature) ?>" type="audio/ogg">
                                        <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_audio_icon_feature) ?>" type="audio/mpeg">
                                    </audio>
                                    </div>
                                <?php
                            }
                            $input_link = '#' . $blog->action_button_audio_icon_feature;
                      
                          }elseif($blog->btn_link == "video" ){
    
                      
                            $input_link = get_blog_image($blog->action_button_video);
                            // $target = "_blank";
                            $data_target="#video_modal";
                            $data_toggle='modal';
                        }elseif($blog->btn_link == 'text_popup'){
                            
                            $input_link = '#' . $blog->btn_link;
                            ?>
                            <div style="display:none" id="blogButton<?=$blog->id?>"><?php echo $blog->action_button_textpopup;?></div>
                            <?php 
                        }elseif ($blog->btn_link == 'call' || $blog->btn_link == 'sms' || $blog->btn_link == 'email') {


                        switch ($blog->btn_link) {
                        
                            case 'sms':
                                $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $blog->action_button_phone_no_sms));
                                break;
                            case 'call':
                                $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $blog->action_button_phone_no_calls));
                                break;
                            case 'email':
                                $input_link = 'mailto:' . $blog->action_button_action_email;
                                break;
                        }
                        } else {
                            $input_link = '#' . $blog->btn_link;
                            
                            if($blog->btn_link=='audiofeature'){
                                $audioclass='playAudio';
                                ?><div class="action-audio" > <?php
                                
                                if ($blog->action_button_action_audio) {?>                                    
                                                <audio class="hidden" id="blogAudio" controls>
                                                    <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_action_audio) ?>" type="audio/mp3">
                                                    <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_action_audio) ?>" type="audio/ogg">
                                                    <source src="<?= url('assets/uploads/'.get_current_url() . $blog->action_button_action_audio) ?>" type="audio/mpeg">
                                                </audio>
                                                </div>
                                            <?php
                                        }
                            }else{
                                $input_link= url('home').$input_link;
                                $target="_blank";
                            }
                        }
                    ?>
                     @if($blog->btn_link == "audioiconfeature" && isset($blog->action_button_audio_icon_feature)) 
                          <span  onclick="playPauseAudio('blogAudio_<?=$blog->id ?>')" class="blog-desc-{{$blog->id}}">
                            <span>
                              <i   class="fa fa-volume-up blog-desc-size blog-desc-icon-{{$blog->id}}" style="margin-top:6px;"  aria-hidden="true"></i>
                            </span>
                            <a href="<?= $input_link ?>" 
                               class="btn {{$audioclass}} " style="<?php echo 'color:' . ($blog->btn_text_color ? $blog->btn_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($blog->btn_bg ? $blog->btn_bg . ';' : '#fff;'); ?><?php echo 'font-family:' . ($blog->btn_text_font ? getfontfamily($blog->btn_text_font) . ';' : ';'); ?>"><?=$blog->btn_text?></a>
                            <div style="margin-top: 0px;">Click to hear Text</div>
                            <br>
                          </span>
                      @else 
                        <a href="<?= $input_link ?>"  
                            id="<?= $blog->id . 'blogbtn' ?>"
                            <?php if($blog->btn_link == 'text_popup'){?> onclick="openPopupText('blogButton<?=$blog->id?>')" <?php }?>
                            <?php if($blog->btn_link == "video"){?>     data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>" onclick="openVideo('<?= $blog->id . 'blogbtn' ?>')" <?php }?>
                        class="btn {{$audioclass}}"  <?=$popupform?> target="<?= $target ?>" style="<?php echo 'color:' . ($blog->btn_text_color ? $blog->btn_text_color . ';' : '#000;'); ?><?php echo 'background:' . ($blog->btn_bg ? $blog->btn_bg . ';' : '#fff;'); ?><?php echo 'font-family:' . ($blog->btn_text_font ? getfontfamily($blog->btn_text_font) . ';' : ';'); ?>"><?=$blog->btn_text?></a>
                        @if($blog->btn_link == "video")
                        <div style="margin-top: 0px;" class="blog-desc-size blog-desc-icon-{{$blog->id}}">Click to watch video</div>
                        @endif
                      @endif
                        
                    <?php } ?>
                <?php
               ?>
            <?php }else{ ?>
                <div class="text-center noblogfound">No Blogs Found</div>
            <?php } ?>
        </div>
        <div class="col-md-4">
        <div class="related-articles">Related Articles</div>
            <br>
            <?php if ($latestblog && count($latestblog->toArray()) > 0) { ?>
                <?php
                foreach ($latestblog as $single) {
             
                ?>
                <div class="">
                    <div class="d-flex justify-content-between">
                    <div class="blog-cate-size otherblog-cate-{{$single->id}}" ><?=get_blog_category($single->category)?></div>
                    </div>
                    <div  class="blog-title-size otherblog-title-{{$single->id}}"  ><?=$single->title?></div>
                    <p id="description_blogImage<?= $single->id ?>" class="blog-desc-size otherblog-desc-{{$single->id}}"  ><?= nl2br(htmlentities($single->short_desc)) ?></p>
                    <div align="center">
                        <a href="<?=url('blog-detail/'.$single->slug)?>">
                        <button type="button" class="btn blog_readmore_btn_<?=$single->id?>">Read More</button>
                        </a>
                    </div>
                    <hr>
                    <br>
                </div>
                <?php
                } ?>
            <?php } ?>
        </div>
    </div>
    <?php if(isset($page) && $page=='list'){ ?>
      {!! $pagination->links() !!}
    <?php } ?>
  </div>
  <br>
</div>

@include('sections.common.video-modal-action')
<div id="myModalTile" class="tile_modal">

  <span class="close">&times;</span>

  <img class="tile_modal-content" id="img01" alt="">

  <div id="caption"></div>
</div>

@include('sections.blogsection.scripts')
@include('blog-page.footer.html')
@include('sections.popupforms.html')
@include('blog-page.scripts')
