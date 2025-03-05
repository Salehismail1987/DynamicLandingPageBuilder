@extends('admin.layout.dashboard')
@section('content')

<script>
  var sub_sections = ["contacts","contact_groups","email_management","email_templates","crm_settings","contacts_fields","unsubscribe_contacts"];
</script>

<?php 
$block = isset($_GET['block']) ? $_GET['block']:'';
?>
<div id="content">

  <div class="fixJumButtons mb-18">
    <div class=" d-sm-flex justify-content-between align-items-center ">
        <div class="title-1 text-color-blue2">CRM Center</div>
        <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
          @if (check_auth_permission('toggle_option'))
            <div>
              <div class="d-flex align-items-center">
                <div>
                    <div class="form-group m-0 text-center"> 
                      <div class="title-2 mb-1 tipOnOffStatus">&nbsp;</div>
                        <div class="title-2 mb-1">Tips</div>
                        <label class="myswitchdiv">
                          <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('crm_controls',sub_sections)">
                          <img src="{{url('assets/admin2/img/tips.png')}}" alt="">
                        </label>
                      
                    </div>
                </div>
                <div class="ml-4">
                    <div class="form-group m-0 text-center">
                      <div class="title-2 mb-1">Controls in Settings</div>
                        <div class="title-2 mb-1">Notifications</div>
              
                        <label class="myswitchdiv switch_disabled">
                          <input type="checkbox" class="myswitch" name="alltipspopup" data-module="notification_crm_controls"
                          <?= $notificationSettings->notification_switch ? 'checked' : '' ?>>
                          <img src="{{url('assets/admin2/img/notification.png')}}" alt="">
                        </label>
                    </div>
                </div>
              </div>
            </div>
            @endif
            <div class="ml-17 ">
                <div class="dropdown-list-main-div">
                    <div class="dropdown-list">
                        <div class="title-3 text-color-grey listtxt">CRM Controls</div>
                        <div>
                            <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="10px">
                        </div>
                    </div>
                    <div class="dropdown-list-div">
                        <ul>    
                            @if (check_auth_permission(['email_marketing']))
                              <li data-value="email_management">Email Management </li>
                            @endif
                            @if (check_auth_permission(['contacts']))
                              <li data-value="contacts">Contacts </li>
                            @endif
                            @if (check_auth_permission(['contact_groups']))
                              <li data-value="contact_groups">Contact Groups </li>
                            @endif
                            @if (check_auth_permission(['unsubscribed_contacts']))
                              <li data-value="unsubscontacts">Opt’d Out </li>
                            @endif
                            @if (check_auth_permission(['crm_settings']))
                              <li data-value="settings">CRM Settings </li>
                            @endif
                            @if (check_auth_permission(['contacts_fields']))
                              <li data-value="contacts_fields">Contact Fields </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
            
                
        </div>
      
       
    </div>
   
  </div>
 
  <!-- Email Management -->
  @if (check_auth_permission(['email_marketing']))
    <?php
 
    if (session()->get('email_message') ) { ?>
      <div id="message" class="alert alert-primary alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <?= session()->get('email_message') ?>

      </div>
    <?php session()->forget('email_message'); } ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="email_management" data-top="email_management_top" data-bottom="email_management_bottom" data-tip_section="email_management">
            
          <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Email Management</div>
                </div>
                <div class="d-flex  align-items-center">
                    
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
                    </div>
                </div>
            </div>

        </div>
        

        <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='email_management'?'display:block;':''?>">
          <form action="{{url('saveCRMSettings')}}"  method="post" enctype="multipart/form-data">
            @csrf
              <div class="content2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                      <div class="d-flex align-items-center">
                        <div class="title-2">Email Template <span class="text-color-blue ml-5">Email templates accessed in Email Posts, click +Add New</span></div>
                      </div>
                      <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                    </div>
                  </div>
                </div>
                <div class="editcontent2">
                  <div class="row">
                    <div class="col-md-12">
                      <a href="{{url('newEmailTemplate')}}" class="btn btn-primary btn-sm mb-2"> <i class="fa fa-plus"></i> Add New</a>
                      <div class="table-responsive">
                        <table id="emailtemplateTable" class="table align-items-center table-flush">
                          <thead class="thead-light">
                            <tr>
                              <th><input name="select_all" value="1" type="checkbox"></th>
                              <th> Images </th>
                              <th>Teaser Title</th>
                              <th>Content Title</th>
                              <th>Notes</th>
                              <th> 
                                <div class="btn-group mb-2">
                                  <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu" x-placement="bottom-start">
                                    <a class="dropdown-item" href="javascript:void(0);"  onclick="DeleteMultipleEmailTemplate()">Delete</a>
                                  </div>
                                </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody class='sort_email_template'>
                            <?php if (count($email_tempaltes) > 0) { ?>
                              <?php $i = 0;
                              foreach ($email_tempaltes as $row) {
                                $i++; ?>
                                <tr id="newsSectionDiv<?= $row->id ?>" class="newssections" data-sectionid="<?= $row->id ?>"
                                onclick="showNewsFeedActionModal(<?=$row->id?>)"
                                >
                                <td><input type="checkbox" value=" <?= $row->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
                                  <td> 
                                    <?php if ($row->email_image) { ?>
                                        <img src="<?= url('assets/uploads/' .get_current_url(). $row->email_image) ?>" width="100px">
                                        <?php  }  ?> 
                                  </td>
                                  <td> <?= $row->teaser_title; ?></td>
                                  <td> <?= $row->content_title; ?></td>
                                  <td> <?= $row->notes; ?></td>
                                  <td>
                                    <div class="btn-group">
                                      <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu" x-placement="bottom-start">
                                        <a class="dropdown-item" href="<?php echo url('editEmailTemplate/' . $row->id . '/'); ?>" >Edit</a>
                                        <a class="dropdown-item" href="<?php echo url('deleteEmailTemplate/' . $row->id . '/?block=email_management'); ?>" onclick="return confirm('Are You Sure?');">Delete</a>
                                        <a class="dropdown-item" href="<?php echo url('duplicateEmailTemplate/' . $row->id . '/'); ?>"> Duplicate</a> 
                                      </div>
                                    </div>
                                  </td>
                                    
                                </tr>
                              <?php }
                            } else { ?>
                              <tr>
                                <td colspan="3" class="text-center"> No record Found </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                        <br>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Test Email Address</div>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="btn2color">Email Address</label>
                        <input type="email"  class="myinput2" name="testEmailAddress" id="testEmailAddress" value="<?= isset($crm_settings->test_email_address) ? $crm_settings->test_email_address: "" ?>" placeholder=" ">
                      </div>
                    </div>
                </div>
                <div class="form-bottom make-sticky" >
                  <div class="col-md-12" align="center">
                      <button  type="submit" name="save_test_email_address" class="btn btn-primary" value="save">Save</button>       
                  </div>
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2 sfactive">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Email Posts</div>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-12">
                    <a href="{{url('newEmailPost')}}" class="btn btn-primary btn-sm mb-2"> <i class="fa fa-plus"></i> Add New</a>
                    <div class="table-responsive">
                      <table id="emailpostTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th>
                            <th> Images </th>
                            <th>Teaser Title</th>
                            <th>Content Title</th>
                            <th>Notes</th>
                            <th>Send Emails</th>
                            <th> 
                              <div class="btn-group mb-2">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a class="dropdown-item" href="javascript:void(0);"  onclick="DeleteMultipleEmailPost()">Delete</a>
                                </div>
                              </div>
                            </th>
                          </tr>
                        </thead>
                        <tbody class='sort_email_posts'>
                          <?php if (count($email_posts) > 0) { ?>
                            <?php $i = 0;
                            foreach ($email_posts as $row) {
                              $i++; ?>
                              <tr id="newsSectionDiv<?= $row->id ?>" class="newssections" data-sectionid="<?= $row->id ?>"
                              onclick="showNewsFeedActionModal(<?=$row->id?>)"
                              >
                              <td><input type="checkbox" value=" <?= $row->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
                                <td> 
                                  <?php if ($row->email_image) { ?>
                                      <img src="<?= url('assets/uploads/' .get_current_url(). $row->email_image) ?>" width="100px">
                                      <?php  }  ?> 
                                </td>
                                <td> <?= $row->teaser_title; ?></td>
                                <td> <?= $row->content_title; ?></td>
                                <td> <?= $row->notes; ?></td>
                                
                                <td>
                                  <a href="<?php echo url('emailMarketing/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i> Send Emails</a>
                                </td>
                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start">
                                      <a class="dropdown-item" href="<?php echo url('editEmailPost/' . $row->id . '/'); ?>" >Edit</a>
                                      <a class="dropdown-item" href="<?php echo url('deleteEmailPost/' . $row->id . '/?block=email_management'); ?>" onclick="return confirm('Are You Sure?');">Delete</a>
                                      <a class="dropdown-item" href="<?php echo url('duplicateEmailPost/' . $row->id . '/'); ?>"> Duplicate</a> 
                                    </div>
                                  </div>
                                  <div class="modal  fade" id="newsFeedModal<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Email Posts Action</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <center>
                                          <?php if (check_auth_permission('email_posts') || check_auth_permission('email_post_actions')) { ?>
                                            <a href="<?php echo url('editEmailPost/' . $row->id . '/'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo url('deleteEmailPost/' . $row->id . '/?block=email_management'); ?>" class="btn btn-sm btn-primary" onclick="return confirm('Are You Sure?');"><i class="fa fa-trash-o"></i> Delete</a>
                                            <br/>
                                            <a class="btn btn-sm btn-primary" href="<?php echo url('duplicateEmailPost/' . $row->id . '/'); ?>"> Duplicate</a>
                                            <?php } ?>
                                          </center>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                  
                              </tr>
                            <?php }
                          } else { ?>
                            <tr>
                              <td colspan="3" class="text-center"> No record Found </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <br>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Scheduled Emails</div>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive tableHeadSticky"> <!-- (Hassan) Make header sticky -->
                      <table id="emailmanageTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                          <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th> <!-- (Hassan) Add Checkbox -->
                            <th> Email Template </th>
                            <th>Scheduled Date & Time</th>
                            <th>Contact Group</th>
                            <th>Status</th>
                            <th> 
                              <div class="btn-group mb-2">
                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a class="dropdown-item" href="javascript:void(0);"  onclick="DeleteMultipleSchedules()">Delete</a>
                                </div>
                              </div>
                            </th>
                          </tr>
                        </thead>
                        <?php if (count($scheduled_emails) > 0) { ?>
                          <?php $i = 0;
                          foreach ($scheduled_emails as $row) {
                              $email_template = get_emailtemplate_data($row->email_template_id);
                              $group_name = "Master Group";
                              if($row->contact_group_id != "all"){
                                if(is_numeric($row->contact_group_id)){
                                    $contact_group = get_contact_group_by_id($row->contact_group_id);
                                    $group_name = $contact_group && isset($contact_group->group_name) ? $contact_group->group_name :"";
                                }else{
                                  $group_name = $row->contact_group_id;
                                }
                              }
                              
                          $i++; ?>
                          <tr >
                              <td><input type="checkbox" value=" <?= $row->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td> <!-- (Hassan) Add Checkbox -->
                              <td>
                              <?php if(isset($email_template->teaser_title)){
                                  echo $email_template->teaser_title;
                              }
                              ?>
                              </td>                        
                              <td> <?= date('m/d/Y H:i:s',strtotime($row->schedule_datetime)); ?></td>
                              <td> <?= $group_name; ?></td>   
                              
                              <td>
                                  <?php 
                                      if($row->is_done){
                                          ?>
                                          <div class="badge badge-finished" style="font-size:14px">Finished</div>
                                          
                                      
                                  <?php }else{
                                          echo '<div class="badge badge-warning" style="font-size:14px">Pending</div>';
                                      }
                                  ?>
                              </td>          
                              <td>      
                                  <?php if (check_auth_permission('email_posts') || check_auth_permission('email_post_actions')) { ?>
                                      <div class="btn-group">
                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                          <a class="dropdown-item" href="<?php echo url('emailMarketing/' . $row->email_template_id . '/'); ?>"> Resend</a>
                                          <a class="dropdown-item" href="<?php echo url('deleteSchedule/' . $row->id . '/'); ?>" onclick="return confirm('Are You Sure?');"></i> Delete</a>
                                        </div>
                                      </div>
                                  <?php } ?>
                              </td>
                          </tr>
                          <?php 
                          }
                      }
                      ?>
                      </table>
                      </div>
                      <br> <!-- (Hassan) Delete schedules at a time button section -->
                  </div>
                </div>
              </div>
            </div>
          </form>
          
        </div>
    </div>
  @endif
  <!-- Contacts -->
  @if(check_auth_permission(['contacts']))
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="contacts" data-top="contacts_top" data-bottom="contacts_bottom" data-tip_section="contacts">
            
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Contacts</div>
          </div>
          <div class="d-flex  align-items-center">
              
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
              </div>
          </div>
        </div>  

      </div> 
      <div class="editcontent contacts-block" style="<?=isset($_GET['block']) && $_GET['block']=='contacts'?'display:block;':''?>">
              
        <div class="row">
          <div class="col-md-12">
            <h5 class='subsection-banner-title'>Contacts</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label for="bannertext" >Automatically create subscribers from new Responses.</label>
            <br>
            <label class="switch">
                <input type="checkbox" name="required" class="subscribe_to_contact" <?= $crm_settings->subscribe_to_contact ? 'checked' : '' ?> value="1" >
                <span class="slider round"></span>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label class="label-sort" for="sort">Sort By</label><br>
              <select name="sortby" id="sortby" class="myinput2">
                <option value='default'>-----Select------</option>
                <option value='name'>Contact Name</option>
                <option value='email_address'>Email</option>
                <option value='subscribed'>Subscribed</option>
                <option value='unsubscribed'>Unsubscribed</option>
              </select>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
              <label class="label-sort" for="search_term">Search</label>
              <input type="text" class="myinput2 search_term" name="search_term" id="search_term" value="" placeholder="Search Name, email etc">
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
              <br>
              <div class="mb-10"></div>
              <button class="btn btn-sm btn-info btnsearch btn-search-contact" style="">Search</button>
          </div>
        </div>
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <a href="<?php echo url('addViewContact'); ?>" class="btn mt-2 mb-2 btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</a>
        </div>
        <div>
          
          <a href="{{url('assets/sample_files/Emaillists_Sample_File.xlsx')}}" target="_blank" class="btn btn-primary mb-10">Sample File</a>
          <form method="post" id="import_form" enctype="multipart/form-data">
            @csrf
                  <input type="button" name="import" value="Choose file for Import To DB" class="btn btn-primary btnImportContacts" />
                  <input type="file" name="file" id="file" required accept=".xls, .xlsx" class="fileImportContacts d-none" /></p>
          </form>
        </div>
      </div>
        <div class="row mb-2">
          <div class="col-md-12 ">
            <div class="d-flex float-right">
              <div>Display</div>
              <select class="form-control title-8 per_page ml-1 mr-1">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>              
              </select>
              <div style="min-width: max-content;">records per page</div>
            </div>
           
          </div>
        </div>
        <div class="table-responsive tableHeadSticky"> <!-- (Hassan) Assign custom sticky header Class and remove inline styling -->
          <table id='emaillistTable' class="table align-items-center table-flush" >
            <thead class="thead-light">
              <tr>
              <th><input name="select_all" value="1" type="checkbox"></th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>Subscribed</th>
                <th>
                  <div class="btn-group">
                    <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                      <a class="dropdown-item" href="javascript:void(0);"  onclick="DeleteMultipleContacts()">Delete</a>
                      <a class="dropdown-item" href="javascript:void(0);"  onclick="ExportToExcel()">Export to Excel</a>
                      {{-- <a class="dropdown-item" href="javascript:void(0);"  onclick="()">Opt'd Out</a> --}}
                      <a class="dropdown-item" href="javascript:void(0);"  onclick="contactsToSubscribe()">Subscribe</a>
                      <a class="dropdown-item" href="javascript:void(0);"  onclick="contactsToUnSubscribe()">Unsubscribe</a>
                    </div>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody class="contactsdata">
            </tbody>
          </table>
        </div>
        <br>
        <div class="pagination_data"></div>
      </div>
    </div>
  @endif
  <!-- Contact Groups -->  
  @if(check_auth_permission(['contact_groups'])) 
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="contact_groups" data-top="contact_groups_top" data-bottom="contact_groups_bottom" data-tip_section="contact_groups">
          
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Contact Groups</div>
          </div>
          <div class="d-flex  align-items-center">
              
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
              </div>
          </div>
        </div> 
      </div> 
      <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='contact_groups'?'display:block;':''?>">
        <form action="{{url('saveContactGroup')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="btn2color">Group (Category) Name</label>
                <!-- (Hassan) Change the name of input field -->
                <input type="text" required class="myinput2" name="group_name" id="group_name" value="" placeholder="Create New Group">
              </div>
            </div>
          
          </div>
      
          <div class="row form-bottom">
            <div class="col-md-12">
              <button type="submit" name="save_contact_group" class="btn btn-primary" value="save">Save</button>
            </div>
          </div>
        </form>
        <br/>
        <div class="table-responsive"  style="max-height:400px">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Group Name</th>
                <th>Emails Added</th>
                <th>Assign Emails</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody >
              <?php if (count($contact_groups) > 0) { ?>
                <?php $i = 0;
                foreach ($contact_groups as $row) {
                  $i++; ?>
                  <tr >
                    <td> <?= $row->group_name; ?></td>
                    <td>
                      <?=  get_total_emails_group($row->id);?>
                    </td>
                    <td>
                      <a href="<?php echo url('assignEmails'); ?>/{{$row->id}}" class="btn btn-sm btn-primary" ><i class="fa fa-check"></i> Assign Emails</a>
                    </td>
                    <td>
                    
                     
                      <?php if (check_auth_permission('contact_groups') || check_auth_permission('contact_group_actions')) { ?>
                        <div class="btn-group">
                            <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start">
                              <a  href="#" onclick="showEditGroupModal(<?=$row->id?>)" class="dropdown-item">Edit</a>
                              <a href="<?php echo url('deleteContactGroup'); ?>/{{$row->id}}" class="dropdown-item" onclick="return confirm('Are You Sure?');">Delete</a>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="modal  fade" id="contactGroup<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Contact Group</h5>
                                <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="<?php echo url('updateContactGroup')?>/<?=$row->id?>" method="post" enctype="multipart/form-data">
                                @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="btn2color">Group (Category) Name</label>
                                        <input type="text" required class="myinput2" name="group_name" id="group_name" value="<?php echo $row->group_name ?>" placeholder="Example Group">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mt-2 ">
                                    <div class="col-md-12">
                                      <input type="hidden" name="update_id" value="<?=$row->id?>" />
                                      <button type="submit" name="save_contact_group" class="btn btn-primary" value="save">Save</button>
                                    </div>
                                  </div>
                              
                                </form>
                              </div>
                            </div>
                          </div>
                      </div>
                    </td>
                  </tr>
                <?php 
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>                  
    </div> 
  @endif
  <!-- Optout Emails -->
  @if(check_auth_permission(['unsubscribed_contacts'])) 
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="unsubscontacts" data-top="unsubscribe_contacts_top" data-bottom="unsubscribe_contacts_bottom" data-tip_section="unsubscribe_contacts">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Opt’d Out</div>
          </div>
          <div class="d-flex  align-items-center">
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
              </div>
          </div>
        </div> 
      </div> 
      <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='unsubscontacts'?'display:block;':''?>">
        <div class="table-responsive tableHeadSticky"> <!-- (Hassan) Make header sticky -->
          <table id='emailunsubTable' class="table align-items-center table-flush" >
                <?php $heading = true;
                    if(count($unsubscontacts)>0){ ?>
                    <?php foreach($unsubscontacts as $single){ ?>
                        <?php $form_feilds = json_decode($single->fields_data, true) ?> <!-- (Hassan) Add true -->
                        <?php
                      
                        $i=0;if($heading){?>
                            <thead class="thead-light">
                                <tr>
                                    <th><input name="select_all" value="1" type="checkbox"></th> <!-- (Hassan) Add Checkbox -->
                                    <th>Customer Name</th>
                                    <th>Customer Phone #</th>
                                    <th>Customer Email</th>
                                    <th>Date</th>
                                    <th>
                                      <div class="btn-group mb-2">
                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                          <a class="dropdown-item" href="javascript:void(0);"  onclick="DeleteMultipleUnsub()">Delete</a>
                                          <a class="dropdown-item" href="javascript:void(0);"  onclick="MoveMultipleOptdToIn()">Opt's In</a>
                                        </div>
                                      </div>
                                    </th>
                                </tr>
                            </thead>
                        <?php $heading = false;} ?>
                        <tbody>
                            <tr>
                                <td>
                                  <input type="checkbox" value=" <?= $single->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" />
                                </td> <!-- (Hassan) Add Checkbox -->
                                  <td>
                                    <?php echo isset($form_feilds['Full Name'])?$form_feilds['Full Name']: ''; ?>
                                  </td>
                                  <td>
                                    <?php echo isset($form_feilds['Email'])?$form_feilds['Email']: ''; ?>
                                  </td>
                                  <td>
                                    <?php echo isset($form_feilds['Phone Number'])?$form_feilds['Phone Number']:''; ?>
                                  </td>
                                  <td><?php echo date('m/d/Y',strtotime($single->datetime))?></td>
                                  
                                  <td> <!-- Add option dropdown buttons -->
                                    <div class="btn-group">
                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start"> <!-- (Hassan) Add CRUD -->
                                          <a  href="<?php echo url('moveSingleOptdToIn')?>/<?=$single->id?>" class="dropdown-item">Opt'd In</a>
                                          <a  href="#" onclick="showEditOPTDModal(<?=$single->id?>)" class="dropdown-item">Edit</a>
                                          <div class="modal  fade" id="optdOut<?=$single->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Opt'd Out</h5>
                                                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <form action="<?php echo url('updateOptdOut')?>/<?=$single->id?>" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label for="btn2color">Full Name</label>
                                                            <input type="text" required class="myinput2" name="full_name" id="full_name" value="<?php echo isset($form_feilds['Full Name'])?$form_feilds['Full Name']: ''; ?>" placeholder="Example Name">
                                                          </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label for="btn2color">Email</label>
                                                            <input type="email" required class="myinput2" name="email" id="email" value="<?php echo isset($form_feilds['Email'])?$form_feilds['Email']: ''; ?>" placeholder="Example Email">
                                                          </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label for="btn2color">Phone Number</label>
                                                            <input type="number" required class="myinput2" name="phone" id="phone" value="<?php echo isset($form_feilds['Phone Number'])?$form_feilds['Phone Number']:''; ?>" placeholder="Example Phone">
                                                          </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label for="btn2color">Date Time</label>
                                                            <input type="date" required class="myinput2" name="datetime" id="datetime" value="<?php 
                                                              $date = date('Y-m-d', strtotime($single->datetime));
                                                              echo $date; 
                                                            ?>" placeholder="Example Phone">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="row mt-2 ">
                                                        <div class="col-md-12">
                                                          <input type="hidden" name="update_id" value="<?=$single->id?>" />
                                                          <button type="submit" name="save_optd_out" class="btn btn-primary" value="save">Save</button>
                                                        </div>
                                                      </div>
                                                  
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                          <a href="<?=url('deleteUnsub/'.$single->id)?>" class="dropdown-item" onclick="return confirm('Are you sure delete this?');">Delete</a>
                                        </div>
                                    </div>
                                  </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                <?php } ?>
          </table>
        </div>
        <br> <!-- (Hassan) Delete Unsubs at a time button section -->
      </div>                  
    </div> 
  @endif
 <!-- CRM Settings -->
 @if(check_auth_permission(['crm_settings']))
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="crm_settings" data-top="crm_settings_top" data-bottom="crm_settings_bottom" data-tip_section="crm_settings">
          
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex  align-items-center">
                <div class="title-1 text-color-blue ">CRM Settings</div>
            </div>
            <div class="d-flex  align-items-center">
                
                <div class=" ml-20">
                    <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
                </div>
            </div>
        </div>

      </div>
      

      <div class="editcontent mb-13" style="<?=isset($_GET['block']) && $_GET['block']=='crm_settings'?'display:block;':''?>">
        <form  action="{{url('saveCRMSettings')}}"  method="post" enctype="multipart/form-data" >
          @csrf
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2">From Email Settings</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="email_marketing_from_name">From Name </label>
                    <input type="text"  class="myinput2" name="email_marketing_from_name" id="email_marketing_from_name" value="<?=$crm_settings->email_marketing_from_name?>" placeholder="Sample Email ">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="email_marketing_from_email">From Email</label>
                    <input type="text"  class="myinput2" name="email_marketing_from_email" id="email_marketing_from_email" value="<?=$crm_settings->email_marketing_from_email?>" placeholder="Sample Email ">
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="email_marketing_reply_to">Reply To Email</label>
                    <input type="email"  class="myinput2" name="email_marketing_reply_to" id="email_marketing_reply_to" value="<?=$crm_settings->email_marketing_reply_to?>" placeholder="Reply-to Email ">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="optout_email_address">Opt-Out Link Email Address</label>
                    <input type="email"  class="myinput2" name="optout_email_address" id="optout_email_address" value="<?=$crm_settings->optout_email_address?>" placeholder="Email Address">
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="content2">
              <div class="row">
                <div class="col-md-12">
                  <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                    <div class="d-flex align-items-center">
                      <div class="title-2">Standard Text Properties</div>
                    </div>
                    <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                  </div>
                </div>
              </div>
              <div class="editcontent2"> 
                <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="logo_title_font_family">Logo Title Font</label>
                        <select  class="myinput2" name="logo_title_font_family" id="logo_title_font_family" >
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="logo_title_text_size">Logo Title Text Size</label><br>
                        <input type="text"  class="myinput2 width-50px" name="logo_title_text_size" id="logo_title_text_size" value="<?=$generic_title->size_web?>" placeholder="24 ">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="logo_title_text_color">Logo Title Text Color</label>
                        <input type="color"  class="myinput2" name="logo_title_text_color" id="logo_title_text_color" value="<?=$generic_title->color?>" placeholder="#ffff ">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="content_title_font_family">Content Title Font</label>
                        <select  class="myinput2" name="content_title_font_family" id="content_title_font_family" >
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_content_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="content_title_text_size">Content Title Text Size</label><br>
                        <input type="text"  class="myinput2 width-50px" name="content_title_text_size" id="content_title_text_size" value="<?=$generic_content_title->size_web?>" placeholder="24 ">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="content_title_text_color">Content Title Text Color</label>
                        <input type="color"  class="myinput2" name="content_title_text_color" id="content_title_text_color" value="<?=$generic_content_title->color?>" placeholder="#ffff ">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subtitle_font_family">Sub-Title Font</label>
                        <select  class="myinput2" name="subtitle_font_family" id="subtitle_font_family" >
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_subtitle->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subtitle_text_size">Sub-Title Text Size</label><br>
                        <input type="text"  class="myinput2 width-50px" name="subtitle_text_size" id="subtitle_text_size" value="<?=$generic_subtitle->size_web?>" placeholder="24 ">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="subtitle_text_color">Sub-Title Text Color</label>
                        <input type="color"  class="myinput2" name="subtitle_text_color" id="subtitle_text_color" value="<?=$generic_subtitle->color?>" placeholder="#ffff ">
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email_image_desciption_font_family"> Description Font</label>
                        <select  class="myinput2" name="email_image_desciption_font_family" id="email_image_desciption_font_family" >
                          <?php if (count($font_family) > 0) { ?>
                            <?php foreach ($font_family as $single) { ?>
                              <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $generic_description->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                            <?php } ?>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email_image_desciption_text_size"> Description Text Size</label><br>
                        <input type="text"  class="myinput2 width-50px" name="email_image_desciption_text_size" id="email_image_desciption_text_size" value="<?=$generic_description->size_web?>" placeholder="24" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email_image_desciption_text_color"> Description Text Color</label>
                        <input type="color" required class="myinput2" name="email_image_desciption_text_color" id="email_image_desciption_text_color" value="<?=$generic_description->color?>" placeholder="#fff">
                      </div>
                    </div>


                    
                  </div>
                </div>
              </div>
              <div class="row form-bottom">
                <div class="col-md-12">
                  <button type="submit" name="save_crm_settings" class="btn btn-primary" value="save">Save</button>
                </div>
              </div>
            </div>
        </form>
  </div>
  @endif
  
  <!-- Contact Fields -->
  @if(check_auth_permission(['contacts_fields'])) 
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="contacts_fields" data-top="contacts_fields_top" data-bottom="contacts_fields_bottom" data-tip_section="contacts_fields">
          
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
              <div class="title-1 text-color-blue ">Contact Fields</div>
          </div>
          <div class="d-flex  align-items-center">
              
              <div class=" ml-20">
                  <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" width="21px" class="">
              </div>
          </div>
        </div> 
      </div> 
      <div class="editcontent" style="<?=isset($_GET['block']) && $_GET['block']=='contacts_fields'?'display:block;':''?>">
      <div class="row">
              <div class="col-md-12">
                <h5 class="subsection-banner-title">Contacts Fields</h5>
              </div>
            </div>
            <form action="{{url('saveContactField')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="singlecontactform">
                    <table class="w-100">
                      <tbody class="confactformfielddiv sortabletable">
                      <?php $formFieldNumber = 0;$i=0;
                      if ($contact_database->fields) { ?>
                          <?php $form_fields = json_decode($contact_database->fields); ?>
                          <?php foreach ($form_fields as $sngl) { ?>
                            <tr style="border-bottom:6px solid #E3F3FF;">
                                <td style="padding-bottom:10px;padding-top:10px">
                                  <div class="singlefield">
                                      <div class="row">
                                          <div class="col-md-5">
                                              <div class="form-group"><label>Field name</label>
                                              <input type="text" class="myinput2" name="fieldname[]" value="<?=$sngl->fieldname?>" placeholder="Field name" <?php if($i<2){echo 'disabled';}?>>
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group"><label>Field type</label>
                                                  <select class="myinput2 fieldtype" name="fieldtype[]" <?php if($i<2){echo 'disabled';}?> data-formfieldno="<?= $formFieldNumber ?>">
                                                      <option value="text" <?= $sngl->fieldtype == 'text' ? 'selected' : '' ?>>Text</option>
                                                      <option value="textarea" <?= $sngl->fieldtype == 'textarea' ? 'selected' : '' ?>>Text Area</option>
                                                      <option value="radio" <?= $sngl->fieldtype == 'radio' ? 'selected' : '' ?>>Radio</option>
                                                      <option value="checkbox" <?= $sngl->fieldtype == 'checkbox' ? 'selected' : '' ?>>Checkbox</option>
                                                      <option value="select" <?= $sngl->fieldtype == 'select' ? 'selected' : '' ?>>Select</option>
                                                      <option value="multiselect" <?= $sngl->fieldtype == 'multiselect' ? 'selected' : '' ?>>Multi-Select</option>
                                                      <option value="date" <?= $sngl->fieldtype == 'date' ? 'selected' : '' ?>>Date</option>
                                                      <option value="time" <?= $sngl->fieldtype == 'time' ? 'selected' : '' ?>>Time</option>
                                                      <option value="file" <?= $sngl->fieldtype == 'file' ? 'selected' : '' ?>>File Upload</option>
                                                      <option value="image" <?= $sngl->fieldtype == 'image' ? 'selected' : '' ?>>Image</option>
                                                      <option value="comment_only" <?= $sngl->fieldtype == 'comment_only' ? 'selected' : '' ?>>Comment Only</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-4 d-flex">
                                              <div class="form-group">
                                          <?php if($i>=2){ ?>
                                              <label for="bannertext" > Required field?</label>
                                              <br>
                                                  <label class="switch">
                                                      <input type="checkbox" name="required[<?= $formFieldNumber ?>]" <?= $sngl->required ? 'checked' : '' ?> value="1" >
                                                      <span class="slider round"></span>
                                                  </label>
                                              <?php }else{ ?>
                                                  <?= $sngl->required ? '<br><label for="bannertext" style="color:#FF0000;">Required</label>' : '' ?>
                                              <?php } ?>
                                              </div>
                                              <div class="form-group ml-3">
                                              <?php if($i>=2){ ?>
                                              <label for="bannertext"> Search?</label>
                                              <br>
                                                  <label class="switch">
                                                      <input type="checkbox" name="search[<?= $formFieldNumber ?>]" <?= isset($sngl->search) && $sngl->search ? 'checked' : '' ?> value="1" >
                                                      <span class="slider round"></span>
                                                  </label>
                                              <?php } ?>
                                              </div>
                                              <div class="form-group ml-3">
                                                  <?php if($i>=2){ ?>
                                                  <label for="bannertext"> Show all on form?</label>
                                                  <br>
                                                      <label class="switch">
                                                          <input type="checkbox" name="formenable[<?= $formFieldNumber ?>]" <?= isset($sngl->formenable) && $sngl->formenable ? 'checked' : '' ?> value="1" >
                                                          <span class="slider round"></span>
                                                      </label>
                                                  <?php } ?>
                                              </div>
                                              <div class="form-group ml-3">
                                                  <?php if($i>=2){ ?>
                                                  <label for="bannertext"> Response Report?</label>
                                                  <br>
                                                      <label class="switch">
                                                          <input type="checkbox" name="show_response[<?= $formFieldNumber ?>]" <?= isset($sngl->show_response) && $sngl->show_response ? 'checked' : '' ?> value="1" >
                                                          <span class="slider round"></span>
                                                      </label>
                                                  <?php } ?>
                                              </div>
                                          </div>
                                          <?php if($i>=2){ ?>
                                          <div class="col-md-1">
                                              <br>
                                              <button type="button" class="btn btn-primary btnremovecantactformfield">Cancel</button>
                                          </div>
                                          <?php } ?>
                                      </div>
                                      <div class="subfieldsdiv">
                                      <?php if($sngl->fieldtype == 'radio' || $sngl->fieldtype == 'checkbox' || $sngl->fieldtype == 'select' || $sngl->fieldtype == 'multiselect'){ ?>
                                              <div class="subfields">
                                                  <?php if(isset($sngl->options)){ ?>
                                                  <?php foreach($sngl->options as $singleop){ ?>
                                                      <div class="row">
                                                          <div class="col-md-1"></div>
                                                          <div class="col-md-9">
                                                              <div class="form-group">
                                                                  <label>Option name</label
                                                                  ><input type="text" class="myinput2" name="oprtionname[<?=$formFieldNumber?>][]" value="<?=$singleop?>" placeholder="Option name">
                                                              </div>
                                                          </div>
                                                          <?php if($i>=2){ ?>
                                                              <div class="col-md-2">
                                                                  <br> 
                                                                  <button type="button" class="btn btn-primary btnremovecantactformoption">Cancel</button>
                                                              </div>
                                                          <?php } ?>
                                                      </div>
                                                  <?php } ?>
                                                  <?php } ?>
                                              </div>
                                              <?php if($i>=2){ ?>
                                                  <button type="button" class=" mt-2  btn btn-primary btnaddnewoption" data-fieldid="<?=$formFieldNumber?>"><i class="fa fa-plus"></i> Add New Option</button><br><br>
                                              <?php } ?>
                                              <?php }else if($sngl->fieldtype == 'image'){ ?>
                                                  <div class="uploadImageDiv">
                                                      <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                                                      <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                                                      <input class="dataimage" type="hidden" name="qimg[<?=$formFieldNumber?>]">
                                                      <input class="" type="hidden" name="image_name[<?=$formFieldNumber?>]" value="<?=isset($sngl->image)?$sngl->image:''?>">
                                                      <div class="col-md-6 imgdiv">
                                                          <br> 
                                                          <img src="<?=isset($sngl->image)?base_url('assets/uploads/'.get_current_url().$sngl->image):''?>" width="100%" class="imagefromgallerysrc"> 
                                                          <button type="button" class="btn btn-primary btnimgdel btnimgremove">Cancel</button> 
                                                      </div>
                                                  </div>
                                                  <textarea name="image_desc[<?=$formFieldNumber?>]" class="myinput2 image_desc"><?=isset($sngl->image_desc)?$sngl->image_desc:''?></textarea>
                                              <?php }else if($sngl->fieldtype == 'comment_only'){ ?>
                                                  <input type="date" name="comment_date[<?=$formFieldNumber?>]" class="myinput2" value="<?=isset($sngl->duedate)?$sngl->duedate:''?>">
                                              <?php } ?>
                                      </div>
                                  </div>
                                  <input class="formfieldno" type="hidden" name="formfieldno[]" value="<?= $formFieldNumber ?>">
                                </td>
                              </tr>
                          <?php $i++;if($i>2){$formFieldNumber++;}} ?>
                      <?php } ?>
                      </div>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                        <button type="button" class="btn btn-primary btnaddnewcontactformfields mt-2 " data-formid="1" data-formfieldno="<?= $formFieldNumber ?>"><i class="fa fa-plus"></i> Add New Field</button>
                        </div>
                    </div>
                  </div>
              <div class="row form-bottom make-sticky">
                <div class="col-md-12">
                  <button type="submit" name="save_contact_database" class="btn btn-primary" value="save">Save</button>
                </div>
              </div>
            </form>
      </div>                  
    </div> 
  @endif

</div>
<div class="modal fade" id="actionNewsPostModal" tabindex="-1" role="dialog" aria-labelledby="actionNewsPostModalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
</div>
<script>
  var   page=1;
  var perPage=5;
  getcotacts('default');
// Ajax post
  $("#sortby").change(function(event) {
    var type = $(this).val();
    getcotacts(type);
  });
  $(".btnsearch").click(function(event) {
    var type = $("#sortby").val();
    getcotacts(type);
  });
  $(document).on('click', '.subscribed_switch', function() {
    var id = $(this).data('row-id');
    var checked = 0;
    if($(this).prop('checked')==true){
      checked = 1;
    }
    $.ajax({
      url: '<?= url('subscribedSwitch'); ?>',
      type: "POST",
      data: {
        'id': id,
        _token: "{{ csrf_token() }}",
        'checked': checked
      },
      success: function(data) {
      }
    });
  });
  $(document).on('click', '.subscribe_to_contact', function() {
    var checked = 0;
    if($(this).prop('checked')==true){
      checked = 1;
    }
    $.ajax({
      url: '<?= url('updatesubscribetocontact'); ?>',
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        'checked': checked
      },
      success: function(data) {
      }
    });
  });
  function getcotacts(type,url=''){
    var search_term = $('.search_term').val();
    url =url? url:"{{ url('getContacts')}}";
      $.ajax({
          type: "POST",
          url: url,
          data: {
          perPage:perPage,
          page:page, _token: "{{ csrf_token() }}",type: type,search_term:search_term},
          error: function (res) {
        },
        success: function(res) {
          if(res.toString().includes('-------------')){
          
            res= res.toString().split('-------------');
            $('.contactsdata').html(res[0]);
            $('.pagination_data').html(res[1]);
          }else{
            $('.contactsdata').html(res);
          }
         
        }
      });
  } 
 

  /* (Hassan) Make it reusable for every table have check boxes */
  $("input[name='select_all']").on('change', function(e){
  var table_id = $(this).closest('table').attr('id');
  var dataTable = document.getElementById(table_id);
  var checkItAll = dataTable.querySelector('input[name="select_all"]');
  var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
  
    if (checkItAll.checked) {
      inputs.forEach(function(input) {
        input.checked = true;
      });  
    }else{
        inputs.forEach(function(input) {
        input.checked = false;
      });  
    }
  });

  function contactsToSubscribe(){
    var rows = [];
    var dataTable = document.getElementById('emaillistTable');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if(inputs){
      inputs.forEach(function(input) {
      if(input.checked == true){
        rows.push($(input).val());
      }
    });
    }
    console.log(rows);
    if(rows!=""){
      $.ajax({
          type: "post",
          url: "<?php echo url('contactsToSubscribe'); ?>" ,
          data: {_token: "{{ csrf_token() }}",rows: rows},
          error: function (res) {
          },
          success: function(res) {
            window.location.href="crmcontrols?block=contacts";
          }
      });
    }else{
      alert("No Rows Selected");
    }
  }
  function contactsToUnSubscribe(){
    var rows = [];
    var dataTable = document.getElementById('emaillistTable');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if(inputs){
      inputs.forEach(function(input) {
      if(input.checked == true){
        rows.push($(input).val());
      }
    });
    }
    console.log(rows);
    if(rows!=""){
      $.ajax({
          type: "post",
          url: "<?php echo url('contactsToUnSubscribe'); ?>" ,
          data: {_token: "{{ csrf_token() }}",rows: rows},
          error: function (res) {
          },
          success: function(res) {
            window.location.href="crmcontrols?block=contacts";
          }
      });
    }else{
      alert("No Rows Selected");
    }
  }

  function DeleteMultipleContacts(){
    var rows = [];
    var dataTable = document.getElementById('emaillistTable');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if(inputs){
      inputs.forEach(function(input) {
      if(input.checked == true){
        rows.push($(input).val());
      }
    });
    }
    console.log(rows);
    if(rows!=""){
      $.ajax({
          type: "post",
          url: "<?php echo url('deleteMultipleContacts'); ?>" ,
          data: {_token: "{{ csrf_token() }}",rows: rows},
          error: function (res) {
          },
          success: function(res) {
            window.location.href="crmcontrols?block=contacts";
          }
      });
    }else{
      alert("No Rows Selected");
    }
  }
  function DeleteMultipleEmailTemplate(){
    var rows = [];
    var dataTable = document.getElementById('emailtemplateTable');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if(inputs){
      inputs.forEach(function(input) {
      if(input.checked == true){
        rows.push($(input).val());
      }
    });
    }
    console.log(rows);
    if(rows!=""){
      $.ajax({
          type: "post",
          url: "<?php echo url('deleteMultipleEmailTemplate'); ?>" ,
          data: {_token: "{{ csrf_token() }}",rows: rows},
          error: function (res) {
          },
          success: function(res) {
            window.location.href="crmcontrols?block=email_management";
          }
      });
    }else{
      alert("No Rows Selected");
    }
  }
  function DeleteMultipleEmailPost(){
    var rows = [];
    var dataTable = document.getElementById('emailpostTable');
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if(inputs){
      inputs.forEach(function(input) {
      if(input.checked == true){
        rows.push($(input).val());
      }
    });
    }
    console.log(rows);
    if(rows!=""){
      $.ajax({
          type: "post",
          url: "<?php echo url('deleteMultipleEmailPost'); ?>" ,
          data: {_token: "{{ csrf_token() }}",rows: rows},
          error: function (res) {
          },
          success: function(res) {
            window.location.href="crmcontrols?block=email_management";
          }
      });
    }else{
      alert("No Rows Selected");
    }
  }
  
  /* (Hassan) Delete schedule email list */
  function DeleteMultipleSchedules(){
      var rows = [];
      var dataTable = document.getElementById('emailmanageTable');
      var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
      if(inputs){
        inputs.forEach(function(input) {
        if(input.checked == true){
          rows.push($(input).val());
        }
      });
      }
      console.log(rows);
      if(rows!=""){
        $.ajax({
            type: "post",
            url: "<?php echo url('deleteMultipleSchedules'); ?>" ,
            data: {_token: "{{ csrf_token() }}",rows: rows},
            error: function (res) {
            },
            success: function(res) {
              window.location.href="crmcontrols?block=email_management";
            }
        });
      }else{
        alert("No Rows Selected");
      }
    }

  /* (Hassan) Delete Unsubs list */
  function DeleteMultipleUnsub(){
      var rows = [];
      var dataTable = document.getElementById('emailunsubTable');
      var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
      if(inputs){
        inputs.forEach(function(input) {
        if(input.checked == true){
          rows.push($(input).val());
        }
      });
      }
      console.log(rows);
      if(rows!=""){
        $.ajax({
            type: "post",
            url: "<?php echo url('deleteMultipleUnsubs'); ?>" ,
            data: {_token: "{{ csrf_token() }}",rows: rows},
            error: function (res) {
            },
            success: function(res) {
              window.location.href="crmcontrols?block=unsubscontacts";
            }
        });
      }else{
        alert("No Rows Selected");
      }
    }

    /* (Hassan) Move back opt's In */
    function MoveMultipleOptdToIn(){
      var rows = [];
      var dataTable = document.getElementById('emailunsubTable');
      var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
      if(inputs){
        inputs.forEach(function(input) {
        if(input.checked == true){
          rows.push($(input).val());
        }
      });
      }
      console.log(rows);
      if(rows!=""){
        console.log('here we send  selected ids to move back into opt in ');
        $.ajax({
            type: "post",
            url: "<?php echo url('moveMultipleOptdToIn'); ?>" ,
            data: {_token: "{{ csrf_token() }}",rows: rows},
            error: function (res) {
            },
            success: function(res) {
              window.location.href="crmcontrols?block=unsubscribe_contacts";
            }
        });
      }else{
        alert("No Rows Selected");
      }
    }

    function ExportToExcel(){
      var rows = [];
      var dataTable = document.getElementById('emaillistTable');
      var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
      if(inputs){
        inputs.forEach(function(input) {
        if(input.checked == true){
          rows.push($(input).val());
        }
      });
      }
      console.log(rows);
      if(rows!=""){
        /* (Hassan) Remove the ajax request and add windo event */
        window.open('exportContactToExcel?rows='+ encodeURIComponent(rows.join(',')), '_blank');
      }else{
        alert("No Rows Selected");
      }
  }
  $('.btnImportContacts').on('click', function(event){
    $('.fileImportContacts').trigger("click");
  });
  $('.fileImportContacts').on('change', function(event){
    $('#import_form').submit();
  });
  $('#import_form').on('submit', function(event){
    event.preventDefault();
      $.ajax({
        url:"<?php echo url('contacts/importToDB'); ?>",
        method:"post",
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          alert("Data Imported to Database Successfully");
          window.location="<?php echo url('crmcontrols?block=contacts'); ?>";
        }
      });
  });

  $(".per_page").on('change',function(e){
    perPage = e.target.value;
    page=1;
    getcotacts('default')
  });

  $('body').on('click','.pagination a',function(e){
    
    e.preventDefault();
      var url = $(this).attr('href');
      var url2 = "{{url('getContacts')}}?page=";
       page = url.toString().replace(url2,'');

      getcotacts('default')
  });

 <?php 
  
  if(isset($block) && $block !=""){
    ?>
  
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

  function  showNewsActionModal(id){
     $("#actionNewsPostModal").html( $('#newsPostModal'+id).html());
    $("#actionNewsPostModal").modal('show');
    
  }

  function check_selction(id,value){
    
    if(value =="address" || value == "google_map"){
      
      $("#address-list-"+id).show();
      $("#btn"+id+"link").hide();
      $("#btn"+id+"customforms").hide();

    }else if(value == "link"){

      $("#btn"+id+"link").show();
      $("#address-list-"+id).hide();
      $("#btn"+id+"customforms").hide();

    }else if(value == "customforms"){

      $("#btn"+id+"customforms").show();
      $("#btn"+id+"link").hide();
      $("#address-list-"+id).hide();

    }else{

      $("#btn"+id+"link").hide();
      $("#address-list-"+id).hide();
      $("#btn"+id+"customforms").hide();
      $("#address-list-"+id).val('');
    }
  }
</script>
<script>
  function getFile() {
    document.getElementById("headerimg").click();
  }

  function getFile2() {
    document.getElementById("headerimg2").click();
  }

  function showEditGroupModal(id){
    
    $("#actionNewsPostModal").html( $('#contactGroup'+id).html());
    $("#actionNewsPostModal").modal('show');
  }

  /* (Hassan) Show opt'd Out Modal */
  function showEditOPTDModal(id){
    $("#actionNewsPostModal").html( $('#optdOut'+id).html());
    $("#actionNewsPostModal").modal('show');
  }

  $(document).ready(function() {
    checkSeeTips(sub_sections);
    
    var is_disabled = isTipsDisabled('crm_controls');
    if(is_disabled){
      
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
                $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
      $("input[name='tippopups']").prop('checked',true);
    }
    
    $(document).on('change', '.alert_banner_action_button_link', function() {
      if ($(this).val() == 'link') {
        $('#banner_link_2').show();
      } else {
        $('#banner_link_2').hide();
      }
    });

  });
  $(document).ready(function() {
    @if(check_auth_permission(['contacts_fields'])) 
      $(document).on('click', '.btnaddnewcontactformfields', function() {
        var formid = $(this).data('formid');
        var formfieldno = $(this).data('formfieldno');
        $(this).closest('.singlecontactform').find('.confactformfielddiv').append('<tr><td><div class="singlefield"><div class="row"><div class="col-md-5"> <div class="form-group"><label>Field name</label><input type="text" class="myinput2" name="fieldname[]" value="" placeholder="Field name"></div></div><div class="col-md-2"><div class="form-group"><label>Field type</label><select class="myinput2 fieldtype" name="fieldtype[]" data-formfieldno="'+formfieldno+'"><option value="text">Text</option><option value="textarea">Text Area</option><option value="radio">Radio</option><option value="checkbox">Checkbox</option><option value="select">Select</option><option value="multiselect">Multi-Select</option><option value="date">Date</option><option value="time">Time</option><option value="file">File Upload</option><option value="image">Image</option><option value="comment_only">Comment Only</option></select></div></div> <div class="col-md-4 d-flex"><div class="form-group"><label for="bannertext"> Required field?</label><br><label class="switch"><input type="checkbox" name="required[' + formfieldno + ']" value="1"><span class="slider round"></span></label></div><div class="form-group ml-3"><label for="bannertext"> Search?</label><br><label class="switch"><input type="checkbox" name="search[<?= $formFieldNumber ?>]" <?= isset($sngl->search) && $sngl->search ? 'checked' : '' ?> value="1" ><span class="slider round"></span></label></div><div class="form-group ml-3"><label for="bannertext"> Show all on form?</label><br><label class="switch"><input type="checkbox" name="formenable['+formfieldno+']" checked value="1" ><span class="slider round"></span> </label></div><div class="form-group ml-3"><label for="bannertext"> Response Report?</label><br><label class="switch"><input type="checkbox" name="show_response['+formfieldno+']" value="1" ><span class="slider round"></span></label></div></div><div class="col-md-1"> <br><button type="button" class="btn btn-primary btnremovecantactformfield" >Cancel</button></div></div><div class="subfieldsdiv"></div></div></td></tr>');
        $(this).data('formfieldno', formfieldno + 1);
      });
    @endif
    $(document).on('click', '.btnremovecantactformfield', function() {
      $(this).closest('tr').remove(); 
    });  
    $(document).on('click', '.btnremovecantactformoption', function() {
      $(this).closest('.row').remove();
    });  
    $(document).on('click', '.btnaddnewoption', function() {
      var fieldid = $(this).data('fieldid');
      $(this).closest('.subfieldsdiv').find('.subfields').append('<div class="row"><div class="col-md-1"></div><div class="col-md-9"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname['+fieldid+'][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">Cancel</button></div></div>');
    });  
    $(document).on('change', '.fieldtype', function() {
      var formfieldno = $(this).data('formfieldno');
      if($(this).val()=='radio' || $(this).val()=='checkbox' || $(this).val()=='select' || $(this).val()=='multiselect'){
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="subfields"><div class="row"><div class="col-md-1"></div><div class="col-md-9"><div class="form-group"><label>Option name</label><input type="text" class="myinput2" name="oprtionname['+formfieldno+'][]" value="" placeholder="Option name"></div></div><div class="col-md-2"><br> <button type="button" class="btn btn-primary btnremovecantactformoption">Cancel</button></div></div></div><button type="button" class="btn btn-primary btnaddnewoption" data-fieldid="'+formfieldno+'"><i class="fa fa-plus"></i> Add New Option</button><br><br>');
      }else  if($(this).val()=='image'){
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"><input class="dataimage" type="hidden" name="qimg['+formfieldno+']"><div class="col-md-6 imgdiv" style="display:none"><br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove">Cancel</button> </div></div><textarea name="image_desc['+formfieldno+']" class="myinput2 image_desc"></textarea>');
      }else if($(this).val()=='comment_only'){
        $(this).closest('.singlefield').find('.subfieldsdiv').html('<input type="date" name="comment_date['+formfieldno+']" class="myinput2">');
      }else {
        $(this).closest('.singlefield').find('.subfieldsdiv').html('');
      }
    });  
  });  
  


</script>

@endsection('content')