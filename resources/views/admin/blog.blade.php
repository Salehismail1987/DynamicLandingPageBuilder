@extends('admin.layout.dashboard')
@section('content')
 
<script>
  var sub_sections = ["blog","blog_category"];
</script>

<?php 
$block = isset($_GET['block']) ? $_GET['block']:'';
?>


<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center ">
        <div class="title-1 text-color-blue2"><?= $controller_name ?></div>
        <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-7 col-lg-6">
      <div class="row d-flex justify-content-around">
        <div class="col-4 title-2 mb-1" style="text-align: center;">Popup Alert</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Tip Popups</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Notifications</div>
    </div>
      <div class="row d-flex justify-content-around">
      <label class="myswitchdiv popupTool">
            <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
          </label>
          <label class="myswitchdiv">
            <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',subsections)">
            <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
          </label>
          <label class="myswitchdiv switch_disabled">
            <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
            <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
          </label>
      </div>
      <div class="row d-flex justify-content-around"> 
        <div class="col-4 col-sm-4 title-2 mb-1 popupOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1 tipOnOffStatus" style="text-align: center;">&nbsp;</div>
        <div class="col-4 col-sm-4 title-2 mb-1" style="text-align: center;">Controls in Settings</div>
      </div>
    </div>
          <div class="ml-4 ">
              <div class="dropdown-list-main-div">
                  <div class="dropdown-list">
                      <div class="title-3 text-color-grey listtxt">Feature Access</div>
                      <div>
                          <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
                      </div>
                  </div>
                  <div class="dropdown-list-div">
                      <ul>
                          <li data-value="blog_list">Blog</li>
                          <li data-value="blog_category">Blog Categories</li>
                      </ul>
                  </div>
              </div>
          </div>
    </div>
  </div>
  
  <?php if (check_auth_permission('blog')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="blog_list" data-tip_section="blog">
          <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex  align-items-center">
                  <div class="title-1 text-color-blue ">Blog</div>
              </div>
              <div class="d-flex  align-items-center">
                @if(check_feature_enable_disable('blogsection'))
                    <div class="enable-disable-feature-div">
                        <div class="title-4-400 text-color-green">Enabled</div>
                    </div>
                @else
                    <div class="enable-disable-feature-div">
                        <div class="title-4-400 text-color-red2">Disabled</div>
                    </div>
                @endif
                  <div class=" ml-20">
                      <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
                  </div>
              </div>
          </div>
      </div>


        <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='blog_list'?'display:block;':''?>">
          <?php if (check_auth_permission('blog')) { ?>
            <form action="{{url('blogsavegeneric')}}" method="post" enctype="multipart/form-data">
              @csrf
              <?php if (check_auth_permission(['build_site_Content'])) { ?>
                <div class="row mb-17">
                    <div class="col-md-3">
                  <div class="form-group d-flex">
                      <label class="">Override Background <br>Color in Settings, Theme</label>
                      <label class="switch ml-7">
                          <input type="checkbox" class="notificationswitch override_bg_enable content_block_override_bg" name="override_bg" data-slug="content_block_bg_picker"
                              <?php echo  $blogSettings->override_bg ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                      </label>
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group content_block_bg_picker" style="display:<?php echo  $blogSettings->override_bg ? 'block' : 'none' ?>">
                      <label>Feature's Background Color</label>
                      <input type="color" class="myinput2" name="bg_color" value="<?= $blogSettings->bg_color ?>">
                    </div>
                  </div>
                    <?php $blog_outline = get_outline_settings('blog_outline');?>
                    <!-- <div class="col-md-6 text-right">
                        <div class="mr-6vi">
                          <label class="title-5 text-black">Tutorial Website Controls</label>
                        </div>
                        <div class="align-all-right d-flex align-items-end">
                            <div class="form-group  d-flex align-items-center">
                                <div for="" class="title-9 text-black">Turn On Outline</div>
                                <label class="switch ml-7">
                                    <input type="checkbox" class="notificationswitch updateoutlineactive" name="outline_enable" data-slug="blog_outline"
                                        <?php echo  $blog_outline->time != null ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group ml-34">
                              <div for="" class="title-9 text-black">Tutorial Website <br>outline color</div>
                                <input type="color" class="myinput2 updateoutlinecolor" name="outline_color" value="<?php echo $blog_outline->outline_color ?>" placeholder="#000000" data-slug="blog_outline">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="myhr mb-16"></div>
              <?php } ?>
              <div class="row make-sticky">
                    <div class="col-md-12">
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="save">Save</button>
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                    </div>
              </div>
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2 generic-settings">
                      <div class="d-flex align-items-center">
                        <div class="title-2">Generic Settings</div>
                        <label class="switch ml-3">
                          <input type="checkbox" class="notificationswitch saveGeneric" data-table="blogSettings" name="use_generic_blog_settings" <?= $blogSettings->use_generic ? 'checked' : '' ?>>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="title_font_size">Blog title Font</label>
                        <select class="myinput2" name="blog_title_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($generic_blog_title->fontfamily) && $generic_blog_title->fontfamily == $single->id ? 'selected' : ''; ?>>
                                <?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog title Color</label>
                        <input type="color" class="myinput2" name="blog_title_color" value="<?= isset($generic_blog_title->color)? $generic_blog_title->color:''; ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blog_desc_font">Blog description Font</label> <!-- (Hassan) Spell whole -->
                        <select class="myinput2" name="blog_desc_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($blog_desc->fontfamily) && $blog_desc->fontfamily == $single->id ? 'selected' : ''; ?>>
                                <?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog description Color</label> <!-- (Hassan) Spell whole -->
                        <input type="color" class="myinput2" name="blog_desc_color" value="<?= isset($blog_desc->color)? $blog_desc->color:''; ?>" placeholder="#000000">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blog_desc_font">Blog category Font</label>
                        <select class="myinput2" name="blog_cate_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($blog_cate->fontfamily) && $blog_cate->fontfamily == $single->id ? 'selected' : ''; ?>>
                                <?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog category Color</label>
                        <input type="color" class="myinput2" name="blog_cate_color" value="<?= isset($blog_cate->color)? $blog_cate->color:''; ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blog_desc_font">Blog date Font</label>
                        <select class="myinput2" name="blog_date_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= isset($blog_date->fontfamily) && $blog_date->fontfamily == $single->id ? 'selected' : ''; ?>>
                                <?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog date Color</label>
                        <input type="color" class="myinput2" name="blog_date_color" value="<?= isset($blog_date->color)? $blog_date->color:''; ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title">Read more Button Text color</label>
                        <input type="color" name="read_more_button_color" class="myinput2" id="title" value="<?php echo $blogSettings->read_more_button_color;?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="title">Read more Button Background</label>
                        <input type="color" name="read_more_button_bg_color" class="myinput2" id="title" value="<?php echo $blogSettings->read_more_button_bg_color;?>">
                        </div>
                    </div>
                  </div>
                  
                  <div class="row make-sticky">
                    <div class="col-md-12">
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="save">Save</button>
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <form action="{{url('blogsavesettings')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="d-flex align-items-center">
                        <div class="title-2">Blog Settings</div>
                      </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="uploadImageDiv">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads" data-ratio="horizontal">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="blog_header_img">

                            <div class="imgdiv" style="display:none">
                                <br>
                                <img src='' width="100%" class="imagefromgallerysrc">
                                <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button> 
                            </div>
                        </div>
                      </div>
                          <?php
                          if ($blogSettings->blog_header_img) {
                          ?>
                              <div class="col-md-3 blog_img_div">
                                  <img src='<?= base_url('assets/uploads/' .get_current_url(). $blogSettings->blog_header_img) ?>' width="100%">
                                  <button type="button" class="btn btn-primary btnimgdel" onclick="delete_front_image('<?= $blogSettings->blog_header_img ?>','blog_header_img','blog_img_div','blog_settings',<?= $blogSettings->id ?>)">X</button>
                              </div>
                          <?php
                          }
                          ?>
                      <br>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="title_font_size">Blog Page Instructions</label>
                        <textarea name="blog_instruction" class="myinput2" rows="5"><?= $blog_instruction_details?$blog_instruction_details->text:'' ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Page Instructions Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="blog_instructions_size_web" value="<?= $blog_instruction_details?$blog_instruction_details->size_web:'' ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Page Instructions Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="blog_instructions_size_mobile" value="<?= $blog_instruction_details?$blog_instruction_details->size_mobile:'' ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Page Instructions Color</label>
                        <input type="color" class="myinput2" name="blog_instructions_color" value="<?= $blog_instruction_details?$blog_instruction_details->color:'' ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blog_instructions_font">Blog Page Instructions Font</label>
                        <select class="myinput2" name="blog_instructions_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $blog_instruction_details && $blog_instruction_details->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="title_font_size">Blog Home Page Instructions</label>
                        <textarea name="blog_page_instruction" class="myinput2" rows="5"><?= $blog_page_instruction_details?$blog_page_instruction_details->text:'' ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Home Page Instructions Size on Web</label><br>
                        <input type="text" class="myinput2 width-50px" name="blog_page_instructions_size_web" value="<?= $blog_page_instruction_details?$blog_page_instruction_details->size_web:'' ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Home Page Instructions Size on Mobile</label><br>
                        <input type="text" class="myinput2 width-50px" name="blog_page_instructions_size_mobile" value="<?= $blog_page_instruction_details?$blog_page_instruction_details->size_mobile:'' ?>" placeholder="12">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Blog Home Page Instructions Color</label>
                        <input type="color" class="myinput2" name="blog_page_instructions_color" value="<?= $blog_page_instruction_details?$blog_page_instruction_details->color:'' ?>" placeholder="#000000">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="blog_instructions_font">Blog Home Page Instructions Font</label>
                        <select class="myinput2" name="blog_page_instructions_font">
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $blog_page_instruction_details && $blog_page_instruction_details->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                
                  <div class="row make-sticky">
                    <div class="col-md-12">
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="save">Save</button>
                      <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          <?php } ?>
          
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2">Blogs</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-12">
                  <a href="<?=base_url('addblog')?>"><button type="button" class="btn btn-sm btn-primary">Add <?=$controller_name?></button></a>
                </div>
              </div>
              <div class="table-responsive">
                <table id="example" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Short Description</th>
                      <th>Date time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($blogs)>0)
                      <?php $i =1; ?>
                      @foreach ($blogs as $blog)
                          <tr>
                            <td><img src="{{get_blog_image($blog->image)}}" class="img-responsive center-block" width="50px"/></td>
                            <td>{{$blog->title}}</td>
                            <td>{{$blog->category_name}}</td>
                            <td>{{$blog->short_desc}}</td>
                            <td>{{date('m/d/Y',strtotime($blog->created_at))}}</td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action 
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" >
                                  <a class="dropdown-item" href="{{base_url('editblog/'.$blog->id)}}">Edit</a>
                                  <a class="dropdown-item" href="{{base_url('deleteblog/'.$blog->id)}}" onClick="return confirm(\'Are you sure delete this?\');">Delete</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php $i++; ?>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="7">No Record Found</td>
                    </tr>
                    @endif
                  </tbody>  
                  <tfoot class="thead-light">
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Short Description</th>
                      <th>Date time</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
          
                  <tbody>
          
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php if (check_auth_permission('blog-category')) {
    ?>
      <div class="contentdiv">
        <div class="btnedit openEditContent" id="blog_category" data-tip_section="blog_category">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Blog Category</div>
                </div>
                <div class="d-flex  align-items-center">
                  @if(check_feature_enable_disable('blogsection'))
                      <div class="enable-disable-feature-div">
                          <div class="title-4-400 text-color-green">Enabled</div>
                      </div>
                  @else
                      <div class="enable-disable-feature-div">
                          <div class="title-4-400 text-color-red2">Disabled</div>
                      </div>
                  @endif
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" class="setion-arrows" alt="" width="21px">
                    </div>
                </div>
            </div>
        </div>
        <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='blog_category'?'display:block;':''?>">
          <div class="row">
            <div class="col-md-12">
              <a href="<?=base_url('addblogcategory')?>"><button type="button" class="btn btn-sm btn-primary">Add Category</button></a>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                <tr>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>
      
              <tfoot class="thead-light">
                <tr>
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </tfoot>
      
              <tbody>
              <?php if(isset($blogcategory) && count($blogcategory)>0){?>
              <?php $i=1; foreach($blogcategory as $single){?>
                <tr>
                  <td><?=$single->title?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu" x-placement="bottom-start">
                        <a class="dropdown-item" href="<?=base_url('editblogcategory/'.$single->id)?>">Edit</a>
                        <a class="dropdown-item" href="<?=base_url('deleteblogcategory/'.$single->id)?>" onClick="return confirm(\'Are you sure delete this?\');">Delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php $i++; } ?>
              <?php }else{ ?>
                <tr>
                  <td colspan="3"> Not Record Found</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>
  <script>
  
  <?php if(isset($block) && $block !=""){  ?>

var id = "<?=$block?>";
    
    
      
        $('#'+id).closest('.content').find('.editcontent').show('slow');
        $('#'+id).closest('.content').find('.form-bottom').addClass('make-sticky');
        var section_start = $('#'+id).data('top');
        var section_end = $('#'+id).data('bottom');
        
        setTimeout(() => {
          $('html, body').animate({
        scrollTop: $('#' + id).offset().top - 60
      }, 100);
        }, 1000);
      
    
      $('#' + id).stop(true, true).addClass("locator-bg");
      setTimeout(() => {
        $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
      }, 5000);
        var tip_section = $('#'+id).data('tip_section');
       
        if (typeof(tip_section) != 'undefined') {
          openTip(tip_section);
        }
        <?php
  }
?>
  $(document).ready(function() {
     checkSeeTips(sub_sections);
     popupStatus();
     var is_disabled = isTipsDisabled('blog');
    
    if(is_disabled){
      
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
                $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
      $("input[name='tippopups']").prop('checked',true);  
    }
  });
  </script>
@endsection('content')