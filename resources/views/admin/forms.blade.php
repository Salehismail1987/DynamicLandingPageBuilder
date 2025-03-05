@extends('admin.layout.dashboard')
@section('content')

<script>
  var sub_sections = ["custom_forms", "custom_form_settings", "custom_forms_report"];
</script>

<style>
  .carrot {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: -3px;
    vertical-align: middle;
    border-top: 4px solid #000000;
    border-right: 4px solid transparent;
    border-bottom: 0 dotted;
    border-left: 4px solid transparent;
    content: "";
  }
</style>
<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>

<div id="content">
  <div class="fixJumButtons mb-18">
    <div class="d-sm-flex justify-content-between align-items-center">
      <div class="title-1 text-color-blue2"><?= $controller_name ?></div>
      <div class="d-md-flex d-lg-flex justify-content-end align-items-center">
        <div class="d-flex justify-content-center align-items-center">
          <div>
            <div class="d-flex justify-content-center align-items-center">
              <div class="mr-4 mt-4">
                <div class="form-group m-0 text-center">
                  <div class="title-2 mb-1">Popup Alert</div>
                  <label class="myswitchdiv popupTool">
                    <input type="checkbox" class="notificationswitch myswitch updatepopup" name="popup_active" data-module="notification_quick_setting" <?= $alert_popup_setting->popup_active ? 'checked' : '' ?>>
                    <img src="{{ url('assets/admin2/img/pop-up.svg') }}" alt="">
                  </label>
                  <div class="title-2 mb-1 popupOnOffStatus">&nbsp;</div>
                </div>
              </div>
              <div class="mt-4">
                <div class="form-group m-0 text-center">
                  <div class="title-2 mb-1">Tip Popups</div>
                  <label class="myswitchdiv">
                    <input type="checkbox" class="myswitch" name="tippopups" onchange="toggleSectionTips('quick_settings',subsections)">
                    <img src="{{ url('assets/admin2/img/tips.png') }}" alt="">
                  </label>
                  <div class="title-2 mb-1 tipOnOffStatus">&nbsp;</div>
                </div>
              </div>

              <div class="ml-4 mt-4">
                <div class="form-group m-0 text-center">
                  <div class="title-2 mb-1">Notifications</div>
                  <label class="myswitchdiv switch_disabled">
                    <input type="checkbox" class="notificationswitch myswitch" name="alltipspopup" data-module="notification_quick_setting" <?= $notificationSettings->notification_switch || $notificationSettings->quick_settings_notifications ? 'checked' : '' ?>>
                    <img src="{{ url('assets/admin2/img/notification.png') }}" alt="">
                  </label>
                </div>
                <div class="title-2 mb-1">Controls in Settings</div>
              </div>
            </div>
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
                <?php if (check_auth_permission('form-list')) { ?>
                  <li data-value="custom_forms_list">Form Maker</li>
                <?php } ?>
                <?php if (check_auth_permission('form-reports')) { ?>
                  <li data-value="blog_category">Responses</li>
                <?php } ?>
                <?php if (check_auth_permission('form-settings')) { ?>
                  <li data-value="blog_category">Settings</li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (check_auth_permission('form-list')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="custom_forms_list" data-tip_section="custom_forms">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Form Maker</div>
          </div>
          <div class="d-flex  align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'custom_forms_list' || isset($_GET['formlist'])) || isset($_GET['form_list_per_page']) ? 'display:block;' : '' ?>">
        <div class="row">
          <div class="col-sm-6">
            <a href="{{url('addform')}}"><button type="button" class="btn btn-sm btn-primary">Add Form</button></a>
          </div>
          <div class="col-sm-6 enablesortingdiv" align="right">
            <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
          </div>
        </div>
        <div class="table-responsive">

          <!-- (Hassan) Page Limmiter (Begin) -->
          <div class="form-group d-flex justify-content-end align-items-center m-3">
            <div>
              Display
            </div>
            <div class="mx-1">
    <form action="{{ url()->current() }}" method="GET">
        <select class="form-control form-control-sm" name="form_list_per_page" id="form_list_per_page" 
                onchange="console.log('Form is submitting...'); this.form.submit();">
            <option value="5" {{ request('form_list_per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('form_list_per_page') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('form_list_per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="100" {{ request('form_list_per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
    </form>
</div>

            <div>
              records per page
            </div>
          </div>
          <!-- Page Limmiter (End) -->

          <form role="form" method="post" enctype="multipart/form-data" action="<?= base_url('/saveformorder') ?>">
            @csrf
            <div class="table-responsive">
              <table id="example" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                  <tr>
                    <th><input name="select_all" value="1" type="checkbox"></th>
                    <th>Off/On</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th style="min-width: 130px;">Date</th>
                    <th>
                      <div class="btn-group mb-2">
                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start">
                          <a class="dropdown-item btnMultipleDeleteForms" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody class="sortabletable">
                  @if(isset($customForms) && count($customForms)>0)
                  <?php $i = 1; ?>
                  @foreach ($customForms as $customForm)
                  <tr>
                    <td><input type="checkbox" value=" <?= $customForm->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
                    <td>
                      <div class="form-group d-flex">
                        <label class="switch ml-7">
                          <input type="checkbox" class="notificationswitch override_bg_enable toggleForm" <?= ($customForm->active) ? 'checked' : '' ?> data-id='{{$customForm->id}}' name="header_block_override_bg" data-slug="header_block_bg_picker">
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </td>
                    <td><img src="{{get_blog_image($customForm->image)}}" class="img-responsive center-block" width="50px" /><input type="hidden" name="forms[]" value="{{$customForm->id}}"></td>
                    <td>{{$customForm->title}}</td>
                    <td>{{$customForm->subtitle}}</td>
                    <td>{{date('m-d-Y',strtotime($customForm->created_at))}}</td>
                    <td>
                      <div class="btn-group mb-1">
                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                          <a class="dropdown-item" href="{{base_url('editform/'.$customForm->id)}}">Edit</a>
                          <a class="dropdown-item" href="{{base_url('duplicateform/'.$customForm->id)}}">Duplicate</a>
                          @if($customForm->id != 7 && $customForm->id !=8)
                          <a class="dropdown-item" href="{{base_url('deleteform/'.$customForm->id)}}" onClick="return confirm('Are you sure delete this?');">Delete</a>
                          @endif
                          <a class="dropdown-item btncopyurl" href="javascript:void(0);" data-url="{{base_url('?popup='.$customForm->encoded_id)}}">Copy URL</a>
                          @if(false)
                          <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms{{getCustomformEncodedID($customForm->id)}}">Open Form</a>
                          @endif
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php $i++; ?>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6">No Record Found</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
            <div>
              {{ $customForms->appends(['form_list_per_page' => $customForms->perPage()])->links('') }} <!-- (Hassan) Append -->
            </div>
            <div class="row  make-sticky">
              <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Save order</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php if (check_auth_permission('form-reports')) { ?>
    <div class="contentdiv">
      <div class="btnedit openEditContent" id="custom_forms_responses_list" data-tip_section="custom_forms_report">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex  align-items-center">
            <div class="title-1 text-color-blue ">Responses</div>
          </div>
          <div class="d-flex align-items-center">
            <div class=" ml-20">
              <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
            </div>
          </div>
        </div>
      </div>
      <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'custom_forms_responses_list') ? 'display:block;' : '' ?>">
        <div class="row">
          <div class="col-sm-12 enablesortingdiv" align="right">
            <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
          </div>
        </div>
        <?php if (count($customFormsAll) > 0) { ?>
          <div class="table-responsive" data-table="custom_forms">
            <table class="w-100">
              <tbody class="sortableformsresponses">
                <?php foreach ($customFormsAll as $singleform) { 
                
                  ?>
                  <?php $formfieldsdata = get_custom_form_data($singleform->id); ?>
                  <?php $formfields = json_decode($formfieldsdata->fields); ?>
                  <?php $formdata = get_custom_user_form_data($singleform->id, 0,0); ?>
                  <?php $dataunseen = get_custom_user_form_unseen($singleform->id); ?>
                  <tr class="formResponseSections" data-sectionid="<?= $singleform->id ?>">
                    <td>
                      <div class="content2">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                              <div class="d-flex align-items-center">
                                <div class="title-2 <?= $dataunseen ? 'hasunseen' : '' ?>"><?= $singleform->title ?></div>
                              </div>
                              <div>
                                <span style="margin-right:10px;color:#626262;" class="title-2">
                                  <?php $formdt = json_decode($formdata);
      
                                    ?>
                                  <?php if ( count($formdata) > 0) { ?>
                                    {{count($formdata)}}
                                  <?php } else { ?>
                                    0
                                  <?php } ?> - Responses
                                </span>
                                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="editcontent2 tr-vetical-middle">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="d-flex align-items-center mb-10">
                                <div class="response-read response-read-not mr-2"></div>
                                <div class="title-5 text-black">Red dot indicates unread response</div>
                              </div>
                            </div>
                            <div class="col-sm-6 enablesortingdiv" align="right">
                              <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                            </div>
                          </div>
                          <div class="table-responsive" data-subtable="custom_user_forms" style="max-height:400px"> <!-- (Hassan) Form name -->
                            <table id="<?= $dataunseen ? 'custom-form-table-' . $singleform->id : 'example-' . $singleform->id ?>" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                              <?php if ($formdata) {
                                $fieldsshow = array(); ?>
                                <thead class="thead-light">
                                  <tr>
                                    <th><input name="select_all" value="1" type="checkbox"></th>
                                    <th></th>

                                    <?php if ($formfields && is_array($formfields) && count($formfields) > 0) { //print_r($formfields);
                                    ?>
                                      <?php foreach ($formfields as $singleheading) { ?>
                                        <?php if (isset($singleheading->show_response) && $singleheading->show_response == '1') {
                                          $fieldsshow[] = strtolower($singleheading->fieldname); ?>
                                          <th><?= $singleheading->fieldname ?></th>
                                        <?php } ?>
                                      <?php } ?>
                                    <?php } ?>
                                    <th>Date of Response</th>
                                    <th>
                                      <div class="btn-group mb-2">
                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start">
                                          <a class="dropdown-item btnMultipleDelete" href="javascript:void(0);">Delete</a>
                                          <a class="dropdown-item btnMultipleMoveToFolder" href="javascript:void(0);">Move</a>
                                          <a class="dropdown-item btnMultipleRead" href="javascript:void(0);">Read</a>
                                          <a class="dropdown-item btnMultipleUnRead" href="javascript:void(0);">Unread</a>
                                          <a class="dropdown-item" href="javascript:void(0);" onClick="exportFormResponse('',this)">Export Response</a>
                                        </div>
                                      </div>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody class="sortablesingleformsresponses">
                                  <?php foreach ($formdata as $single) { 
                                      // if($singleform->title == 'enfohub, Reviews for Small Businesses')
                                      // {
                                      //  dd($formdata->items());
                                      // }
                                    if($single->in_folder != 0)
                                    {
                                      continue;
                                    }

                                    ?>
                                    <?php $form_feilds = json_decode($single->fields_data, true);
                                    $form_feilds_unfied = array();
                                    if ($form_feilds) {
                                      foreach ($form_feilds as $key => $value) {
                                        $form_feilds_unfied[strtolower($key)] = $value;
                                      }
                                    }
                                    ?>
                                    <tr class="singleformResponseSections" data-sectionid="{{$single->id}}">

                                      <td><input type="checkbox" value=" <?= $single->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>



                                      <td>
                                        <div class="response-read @if ($single->seen=='0') response-read-not @endif"></div>
                                      </td>
                                      <?php foreach ($fieldsshow as $key) {
                                      ?>
                                        <td style="line-break: anywhere;">
                                          <?php if (isset($form_feilds_unfied[strtolower($key)])) { ?>
                                            <?php
                                            if (is_array($form_feilds_unfied[strtolower($key)])) {
                                              foreach ($form_feilds_unfied[strtolower($key)] as $sg) {

                                                if (!validateTime($sg) && isDate($sg) && $sg != '01-01-1970') {

                                                  echo date('m-d-Y', strtotime($sg)) . '<br>';
                                                } elseif (validateTime($sg) && $sg != '01-01-1970') {

                                                  echo date('h:i a', strtotime($sg)) . '<br>';
                                                } else {
                                                  $sg = strlen($sg) > 100 ? substr($sg, 0, 100) . '...' : $sg;
                                                  echo $sg;
                                                }
                                              }
                                            } else {
                                              $fs = ($form_feilds_unfied[strtolower($key)]);
                                              if (!validateTime($fs) && isDate($fs) && $fs != '01-01-1970') {

                                                echo date('m-d-Y', strtotime($fs)) . '<br>';
                                              } elseif (validateTime($fs) && $fs != '01-01-1970') {

                                                echo date('h:i a', strtotime($fs)) . '<br>';
                                              } else {
                                                $fs = strlen($fs) > 100 ? substr($fs, 0, 100) . '...' : $fs;
                                                echo $fs;
                                              }
                                            }
                                            ?>
                                        </td>
                                      <?php } ?>
                    </td>
                  <?php } ?>
                  <td>
                    <?php
                                    if ($single->date_time) {
                                      echo date('m-d-Y', strtotime($single->date_time));
                                    } else {
                                      echo date('m-d-Y', strtotime($single->created_at . '-7 hours'));
                                    }
                    ?>
                  </td>
                  <td>
                    <div class="btn-group mb-1 responses-action">
                      <button type="button" class="dropdown-toggle mydropdown toggle-btn{{$single->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu response-div{{$single->id}}" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                        @if(false)
                        <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($single->form_id) ?>">Open Form</a><br>
                        @endif
                        <a href="<?= base_url('edituserform/' . $single->id . '?block=custom_user_forms') ?>" class="dropdown-item">Edit</a>
                        <a href="<?= base_url('detailuserform/' . $single->id . '?block=custom_user_forms') ?>" class="dropdown-item">Detail</a>
                        <a href="#" class="dropdown-item"
                          id="{{base_url('deleteuserform/'.$single->id.'?block=custom_user_forms')}}"
                          onClick="confirmDelete(this.id)">Delete</a>
                        <a href="javascript:void(0);" class="dropdown-item btnMoveToFolder" data-toggle="modal" data-target="#moveToFolder" data-response-id="{{$single->id}}">Move</a>
                        @if ($single->seen=='0')
                        <a href="<?= base_url('readuserform/' . $single->id . '?block=custom_user_forms') ?>" class="dropdown-item">Read</a>
                        @else
                        <a href="<?= base_url('unreaduserform/' . $single->id . '?block=custom_user_forms') ?>" class="dropdown-item">Unread</a>
                        @endif
                        <a class="dropdown-item" href="javascript:void(0);" onClick="exportFormResponse({{$single->id}},this)">Export Response</a>

                        <!-- <div class="dropdown-item" onclick="exportFormResponse('{{$single->id}}')" > -->
                        <div class="dropdown-item" onclick="showDropDown('{{$single->id}}')">
                          <span class="carrot"></span> Make Content
                        </div>
                        <?php // if($singleform->id=='7'){ 
                        ?>
                        <div class="to-show-response{{$single->id}} ml-3" style="display:block">
                          <a class="dropdown-item" href="<?= base_url('addtocontacts/' . $single->id . '?block=custom_user_forms&type=Subscriber') ?>">Subscriber</a>
                          <a class="dropdown-item" href="<?= base_url('addtocontacts/' . $single->id . '?block=custom_user_forms&type=Non-Subscriber') ?>">Non-Subscriber</a>
                          <div>
                            <?php //} 
                            ?>
                          </div>
                        </div>
                  </td>
                  </tr>
                <?php } ?>
              </tbody>
            <?php } else { ?>
              <h3 class="text-center">No Record Found</h3>
            <?php } ?>
            </table>
          </div>
      </div>
    </div>
    </td>
    </tr>
  <?php } ?>
  </tbody>
  </table>
</div>
<?php } else { ?>
  <h3 class="text-center">No Forms to show</h3>
<?php } ?>
</div>
</div>
<?php } ?>

<?php if (check_auth_permission('form-reports')) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="responsive_folders" data-tip_section="custom_form_settings">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Response Folders</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'responsive_folders') ? 'display:block;' : '' ?>">
      <div class="row mb-10">
        <div class="col-md-12">
          <a href="{{url('addfolder')}}"><button type="button" class="btn btn-sm btn-primary">Add Folder</button></a>
        </div>
      </div>
      <div class="table-responsive">
        <table id="example" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($response_folders) && count($response_folders)>0)
            <?php $i = 1; ?>
            @foreach ($response_folders as $response_folder)
            <tr>
              <td>{{$response_folder->title}}</td>
              <td>
                <div class="btn-group mb-1">
                  <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                  </button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                    <a class="dropdown-item" href="{{base_url('editfolder/'.$response_folder->id)}}">Edit</a>
                    <a class="dropdown-item" href="#" id="{{base_url('deletefolder/'.$response_folder->id)}}" onClick="confirmDelete(this.id);">Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            @else
            <tr>
              <td colspan="6">No Record Found</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @if(isset($response_folders) && count($response_folders)>0)
  <?php $i = 1; ?>
  @foreach ($response_folders as $response_folder)
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="{{cleanString($response_folder->title)}}" data-tip_section="custom_forms_report">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">{{$response_folder->title}}</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == cleanString($response_folder->title)) ? 'display:block;' : '' ?>">
      <?php foreach ($customFormsAll as $singleform) { 
        
        ?>
        <?php $formfieldsdata = get_custom_form_data($singleform->id); ?>
        <?php $formfields = json_decode($formfieldsdata->fields); ?>
        <?php $formdata = get_custom_user_form_data($singleform->id,0, $response_folder->id);
        ?>
        <?php if (count($formdata) > 0) { ?>
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2 <?= $dataunseen ? 'hasunseen' : '' ?>"><?= $singleform->title ?></div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2 tr-vetical-middle">
              <div class="d-flex align-items-center mb-10">
                <div class="response-read response-read-not mr-2"></div>
                <div class="title-5 text-black">Red dot indicates unread response</div>
              </div>
              <div class="table-responsive" data-subtable="custom_user_forms" style="max-height:400px"> <!-- (Hassan) Form name -->
                <table id="example" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                  <?php if ($formdata) {
                    $fieldsshow = array(); ?>
                    <thead class="thead-light">
                      <tr>
                        <th></th>
                        <?php
                        if ($formfields && is_array($formfields) && count($formfields) > 0) { //print_r($formfields);
                        ?>
                          <?php foreach ($formfields as $singleheading) { ?>
                            <?php if (isset($singleheading->show_response) && $singleheading->show_response == '1') {
                              $fieldsshow[] = strtolower($singleheading->fieldname); ?>
                              <th><?= $singleheading->fieldname ?></th>
                            <?php } ?>
                          <?php } ?>
                        <?php } ?>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="">
                      <?php foreach ($formdata as $single) { 
                        if($response_folder->id != $single->in_folder)
                        {
                          
                          continue;
                        }
           
                        ?>
                        <?php $form_feilds = json_decode($single->fields_data, true);
                        $form_feilds_unfied = array();
                        if ($form_feilds) {
                          foreach ($form_feilds as $key => $value) {
                            $form_feilds_unfied[strtolower($key)] = $value;
                          }
                        }

                        ?>
                        <tr class="singleformResponseSections" data-sectionid="{{$single->id}}">
                          <td>
                            <div class="response-read @if ($single->seen=='0') response-read-not @endif">

                            </div>
                          </td>
                          <?php foreach ($fieldsshow as $key) { ?>
                            <td>
                              <?php

                              if (isset($form_feilds_unfied[strtolower($key)])) { ?>
                                <?php
                                if (is_array($form_feilds_unfied[strtolower($key)])) {
                                  foreach ($form_feilds_unfied[strtolower($key)] as $sg) {
                                    if (!validateTime($sg) && isDate($sg) && $sg != '01-01-1970') {

                                      echo date('m-d-Y', strtotime($sg)) . '<br>';
                                    } elseif (validateTime($sg) && $sg != '01-01-1970') {

                                      echo date('h:i a', strtotime($sg)) . '<br>';
                                    } else {

                                      echo $sg . '<br>';
                                    }
                                  }
                                } else {
                                  $fs = ($form_feilds_unfied[strtolower($key)]);
                                  if (!validateTime($fs) && isDate($fs) && $fs != '01-01-1970') {

                                    echo date('m-d-Y', strtotime($fs)) . '<br>';
                                  } elseif (validateTime($fs) && $fs != '01-01-1970') {

                                    echo date('h:i a', strtotime($fs)) . '<br>';
                                  } else {
                                    echo $fs;
                                  }
                                }
                                ?>
                            </td>
                          <?php } ?>
                          </td>
                        <?php } ?>
                        <td>
                          <?php
                          if ($single->date_time && $single->date_time != '') {
                            echo date('m-d-Y', strtotime($single->date_time));
                          } else {
                            echo date('m-d-Y', strtotime($single->created_at . '-7 hours'));
                          }
                          ?>
                        </td>
                        <td>
                          <div class="btn-group mb-1">
                            <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                              @if(false)
                              <a href="javascript:void(0);" class="dropdown-item" data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms<?= getCustomformEncodedID($single->form_id) ?>">Open Form</a><br>
                              @endif
                              <a href="<?= base_url('edituserform/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item">Edit</a>
                              <a href="<?= base_url('detailuserform/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item">Detail</a>
                              <a href="javascript:void(0);" class="dropdown-item btnMoveToFolder" data-toggle="modal" data-target="#moveToFolder" data-response-id="{{$single->id}}">Move</a>
                              <a href="#" id="<?= base_url('deleteuserform/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item" onClick="confirmDelete(this.id)">Delete</a>
                              @if ($single->seen=='0')
                              <a href="<?= base_url('readuserform/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item">Read</a>
                              @else
                              <a href="<?= base_url('unreaduserform/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item">Unread</a>
                              @endif
                              <?php if ($singleform->id == '7') { ?>
                                <a href="<?= base_url('addtocontacts/' . $single->id . '?block=' . cleanString($response_folder->title)) ?>" class="dropdown-item" onclick="return confirm('Are you sure?')">Add to contacts</a>
                              <?php } ?>
                            </div>
                          </div>
                        </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  <?php } else { ?>
                    <h3 class="text-center">No Record Found</h3>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  @endforeach
  @else
  @endif
<?php } ?>
<?php if (check_auth_permission('form-settings')) { ?>
  <div class="contentdiv">
    <div class="btnedit openEditContent" id="custom_forms_settings" data-tip_section="custom_form_settings">
      <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex  align-items-center">
          <div class="title-1 text-color-blue ">Settings</div>
        </div>
        <div class="d-flex  align-items-center">
          <div class=" ml-20">
            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
          </div>
        </div>
      </div>
    </div>
    <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'custom_forms_settings') ? 'display:block;' : '' ?>">

      <form action="{{url('saveformsettings')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div id="title_banner_blog_block">
          <div class="content2">
            <div class="row">
              <div class="col-md-12">
                <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                  <div class="d-flex align-items-center">
                    <div class="title-2">Email Notifications Addresses</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row" id="title_banner_blog_block">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Multiple Addresses seprated by comma</label>
                    <textarea class="myinput2" name="form_multiple_emails" rows="1" placeholder="example@gmail.com,example2@gmail.com........"><?= $customFormsSettings->form_multiple_emails ?></textarea>
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
                    <div class="title-2">Location</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row" id="title_banner_blog_block">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="bannertext"> Active Location</label>
                    <br>
                    <label class="switch">
                      <input type="checkbox" name="location" <?= $customFormsSettings->location ? 'checked' : '' ?>>
                      <span class="slider round"></span>
                    </label>
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
                    <div class="title-2">Form Title</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Title Size on Web</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_title_size_web" value="<?= $form_title ? $form_title->size_web : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Title Size on Mobile</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_title_size_mobile" value="<?= $form_title ? $form_title->size_mobile : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Title Color</label>
                    <input type="color" class="myinput2" name="form_title_color" value="<?= $form_title ? $form_title->color : '' ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="form_title_font">Form Title Font</label>
                    <select class="myinput2" name="form_title_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_title && $form_title->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Form Sub-Title</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Sub-Title Size on Web</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_subtitle_size_web" value="<?= $form_subtitle ? $form_subtitle->size_web : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Sub-Title Size on Mobile</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_subtitle_size_mobile" value="<?= $form_subtitle ? $form_subtitle->size_mobile : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Sub-Title Color</label>
                    <input type="color" class="myinput2" name="form_subtitle_color" value="<?= $form_subtitle ? $form_subtitle->color : '' ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="form_subtitle_font">Form Sub-Title Font</label>
                    <select class="myinput2" name="form_subtitle_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_subtitle && $form_subtitle->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Form Descriptive Text</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Web</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_descriptive_size_web" value="<?= $form_descriptive_text ? $form_descriptive_text->size_web : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Mobile</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_descriptive_size_mobile" value="<?= $form_descriptive_text ? $form_descriptive_text->size_mobile : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Color</label>
                    <input type="color" class="myinput2" name="form_descriptive_color" value="<?= $form_descriptive_text ? $form_descriptive_text->color : '' ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="form_descriptive_font">Form Descriptive Text Font</label>
                    <select class="myinput2" name="form_descriptive_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_descriptive_text && $form_descriptive_text->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Form Footer Text 1</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Web</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_footer_text_1_size_web" value="<?= $form_footer_text_1 ? $form_footer_text_1->size_web : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Mobile</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_footer_text_1_size_mobile" value="<?= $form_footer_text_1 ? $form_footer_text_1->size_mobile : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Color</label>
                    <input type="color" class="myinput2" name="form_footer_text_1_color" value="<?= $form_footer_text_1 ? $form_footer_text_1->color : '' ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="form_descriptive_font">Form Descriptive Text Font</label>
                    <select class="myinput2" name="form_footer_text_1_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_footer_text_1 && $form_footer_text_1->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Form Footer Text 2</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Web</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_footer_text_2_size_web" value="<?= $form_footer_text_2 ? $form_footer_text_2->size_web : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Size on Mobile</label><br>
                    <input type="text" class="myinput2 width-50px" name="form_footer_text_2_size_mobile" value="<?= $form_footer_text_2 ? $form_footer_text_2->size_mobile : '' ?>" placeholder="12">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Form Descriptive Text Color</label>
                    <input type="color" class="myinput2" name="form_footer_text_2_color" value="<?= $form_footer_text_2 ? $form_footer_text_2->color : '' ?>" placeholder="#000000">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="form_descriptive_font">Form Descriptive Text Font</label>
                    <select class="myinput2" name="form_footer_text_2_font">
                      <?php if (count($font_family) > 0) { ?>
                        <?php foreach ($font_family as $single) { ?>
                          <option style="font-family: <?= $single->value ?>;" value="<?= $single->id ?>" <?= $form_footer_text_2 && $form_footer_text_2->fontfamily == $single->id ? 'selected' : ''; ?>><?= $single->name ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
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
                    <div class="title-2">Image</div>
                  </div>
                  <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                </div>
              </div>
            </div>
            <div class="editcontent2">
              <div class="row">
                <div class="col-md-4 mb-10">
                  <label for="form_descriptive_font">Image Max size (Max 500px)</label><br>
                  <input type="number" min="1" max="500" class="myinput2 width-50px" name="maxwidth" placrholder="" value="<?= $form_logo ? $form_logo->max_width : '' ?>">
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <?php
                    if (isJson($form_logo->file_name)) {
                      $image = json_decode($form_logo->file_name);
                      foreach ($image as $single) { ?>
                        <div class="col-md-4 imgdiv">
                          <img src='<?= base_url('assets/uploads/' . get_current_url() . $single->img) ?>' width="100%">
                          <button type="button" class="btn btn-primary btnimgdel btndelimgclick" data-img_slug="custom_form_logo" data-img_name="<?= $single->img ?>">X</button>
                          <br><br>
                          <label for="" class="text-left">Image Description</label>
                          <textarea rows="" cols="3" name="description[]" class="myinput2 mb-10"><?= isset($single->desc) ? $single->desc : '' ?></textarea>
                        </div>
                      <?php }
                    } else {
                      ?>
                      <div class="col-md-6 imgdiv">
                        <img src='<?= base_url('assets/uploads/' . get_current_url() . $form_logo->image) ?>' width="100%">
                        <button type="button" class="btn btn-primary btnimgdel btndelimgclick" data-img_slug="custom_form_logo" data-img_name="<?= $form_logo->image ?>">X</button>
                        <br><br>
                        <label for="">Image Description</label>
                        <textarea rows="" cols="3" name="description[]" class="myinput2 mb-10"></textarea>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                  <br>
                  <div class="img-upload-container">
                    <?php if (false) { ?>
                      <div class="uploadImageDiv">
                        <div class="row">
                          <div class="col-md-4">
                            <button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button>
                            <input type="hidden" name="imagefromgallery" class="imagefromgallery">
                            <input class="dataimage" type="hidden" name="userfile[]">
                          </div>
                          <div class="col-md-4 imgdiv" style="display:none">
                            <br>
                            <img src='' width="100%" class="imagefromgallerysrc">
                            <button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button>
                          </div>
                          <div class="col-md-4">
                            <label for="">Image Description</label>
                            <textarea rows="" cols="3" name="description[]" class="myinput2"></textarea>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>

                  <center>
                    <button type="button" class="btn btn-info addAnotherImage">+ Upload More Images</button>
                  </center>

                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row form-bottom make-sticky">
          <div class="col-md-12">
            <button type="submit" name="save_forms_settings" class="btn btn-primary" value="save">Save</button>
            <button type="submit" name="save_forms_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
<?php } ?>
<div id="moveToFolder" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <br>
        <h5 class="modal-title" id="exampleModalLabelSupportForm">Select Folder to move</h5>
        <br>
        <form action="{{url('movetofolder')}}" method="post">
          @csrf
          <input type="hidden" name="response_id" class="response_id">
          <input type="hidden" name="response_ids[]" class="response_ids">
          <select name="response_folders" id="" class="form-control">
            @if(isset($response_folders) && count($response_folders)>0)
            @foreach ($response_folders as $response_folder)
            <option value="{{ $response_folder->id}}">{{ $response_folder->title}}</option>
            @endforeach
            @endif
          </select>
          <br>
          <div class="row">
            <div class="col-lg-12" align='center'>
              <button type="submit" class="btn btn-primary">Save</button>
              <a href="javascript:void(0);"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
  <?php if (isset($block) && $block != "") { ?>
    var id = "<?= $block ?>";
    $('#' + id).closest('.content').find('.editcontent').show('slow');
    $('#' + id).closest('.content').find('.form-bottom').addClass('make-sticky');
    var section_start = $('#' + id).data('top');
    var section_end = $('#' + id).data('bottom');
    setTimeout(() => {
      $('html, body').animate({
        scrollTop: $('#' + id).offset().top - 60
      }, 100);
    }, 1000);

    $('#' + id).stop(true, true).addClass("locator-bg");
    setTimeout(() => {
      $('#' + id).stop(true, true).removeClass("locator-bg", 1000);
    }, 5000);
    var tip_section = $('#' + id).data('tip_section');

    if (typeof(tip_section) != 'undefined') {
      openTip(tip_section);
    }
  <?php
  }
  ?>

  $(document).ready(function() {



    var is_disabled = isTipsDisabled('custom_forms_maker');
    checkSeeTips(sub_sections);
    popupStatus();
    if (is_disabled) {
      $("input[name='tippopups']").prop('checked', true);
      $("input[name='tippopups']").closest('.myswitchdiv').addClass('checked');
      $("input[name='tippopups']").closest('.myswitchdiv').find('.myswitch').prop('checked', true);
    }
    $('.sortabletable').sortable({
      stop: function(event, ui) {
        if ((window.innerWidth <= 768)) {
          $(".sortabletable").sortable("disable");
          $('.sortabletable').closest('.editcontent2').find('.btnSortableEnableDisabled').data('status', 'enable');
          $('.sortabletable').closest('.editcontent2').find('.btnSortableEnableDisabled').html('Enable Sorting');
        }
      }
    });

    if ((window.innerWidth <= 768)) {
      $(".sortabletable").sortable("disable");
    }

    // var isorted = true;
    // $(document).mousemove(function(e){
    //     if($('.sortabletable').html() && isorted){

    //         if ((window.innerWidth <= 768)) {
    //           $('.sortabletable').sortable({
    //             delay: 2000,
    //             scroll:true,
    //           });
    //         }else{

    //           $('.sortabletable').sortable();
    //         }
    //         isorted = false;
    //     }
    // });




    $(document).on('click', '.btnMultipleDelete', function() {
      swal({
          title: "Confirm",
          text: "Are you sure delete this? ",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var rows = [];
            var inputs = $(this).closest('tbody').find('input');
            if (inputs) {
              inputs.each(function() {
                if ($(this).prop('checked') == true) {
                  rows.push($(this).val());
                }
              });
            }
            console.log(rows);
            if (rows != "") {
              $.ajax({
                type: "post",
                url: "<?php echo url('deletemultipleuserform'); ?>",
                data: {
                  _token: "{{ csrf_token() }}",
                  rows: rows
                },
                error: function(res) {},
                success: function(res) {
                  window.location.href = "forms?block=custom_forms_responses_list";
                }
              });
            } else {
              alert("No Rows Selected");

            }
          } else {

          }
        });

    });

    $('.toggleForm').on('change', function() {
      var check_value = $(this).prop('checked') == true ? '1' : '0';
      var id = $(this).data('id');
      var table = $(this).data('table');
      console.log(check_value);
      console.log(id);
      $.ajax({
        url: base_url + '/toggleForm',
        type: "POST",
        data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'id': id,
          'check_value': check_value
        },
        success: function(data) {}
      });
    });

    $(document).on('click', '.btnMultipleDeleteForms', function() {
      if (confirm('Are you sure delete this?')) {
        var rows = [];
        var inputs = $(this).closest('table').find('tbody').find('input');
        if (inputs) {
          inputs.each(function() {
            if ($(this).prop('checked') == true) {
              rows.push($(this).val());
            }
          });
        }
        console.log(rows);
        if (rows != "") {
          $.ajax({
            type: "post",
            url: "<?php echo url('deletemultipleform'); ?>",
            data: {
              _token: "{{ csrf_token() }}",
              rows: rows
            },
            error: function(res) {},
            success: function(res) {
              window.location.href = "forms?block=custom_forms_list";
            }
          });
        } else {
          alert("No Rows Selected");
        }
      }
    });



    $(document).on('click', '.btnMultipleRead', function() {
      var rows = [];
      var inputs = $(this).closest('tbody').find('input');
      if (inputs) {
        inputs.each(function() {
          if ($(this).prop('checked') == true) {
            rows.push($(this).val());
          }
        });
      }
      console.log(rows);
      if (rows != "") {
        $.ajax({
          type: "post",
          url: "<?php echo url('readmultipleuserform'); ?>",
          data: {
            _token: "{{ csrf_token() }}",
            rows: rows,
            seen: '1'
          },
          error: function(res) {},
          success: function(res) {
            window.location.href = "forms?block=custom_forms_responses_list";
          }
        });
      } else {
        alert("No Rows Selected");
      }
    });


    $(document).on('click', '.btnMultipleUnRead', function() {
      var rows = [];
      var inputs = $(this).closest('tbody').find('input');
      if (inputs) {
        inputs.each(function() {
          if ($(this).prop('checked') == true) {
            rows.push($(this).val());
          }
        });
      }
      console.log(rows);
      if (rows != "") {
        $.ajax({
          type: "post",
          url: "<?php echo url('readmultipleuserform'); ?>",
          data: {
            _token: "{{ csrf_token() }}",
            rows: rows,
            seen: '0'
          },
          error: function(res) {},
          success: function(res) {
            window.location.href = "forms?block=custom_forms_responses_list";
          }
        });
      } else {
        alert("No Rows Selected");
      }
    });


    $(document).on('click', '.btnMoveToFolder', function() {
      var response_id = $(this).data('response-id');
      $('.response_id').val(response_id);
      $('.response_ids').val(response_id);
    });

    $(document).on('click', '.btnMultipleMoveToFolder', function() {
      var rows = [];
      var inputs = $(this).closest('tbody').find('input');
      if (inputs) {
        inputs.each(function() {
          if ($(this).prop('checked') == true) {
            rows.push($(this).val());
          }
        });
      }
      $('.response_ids').val(rows);
      if (rows.length > 0) {
        $('#moveToFolder').modal('show');
      } else {
        cuteAlert({
          type: "error",
          title: "",
          message: "Select atleast one responce to move",
          buttonText: "Okay"
        });
      }
    });

    $("input[name='select_all']").on('change', function(e) {
      var table_id = $(this).closest('table').attr('id');
      var dataTable = document.getElementById(table_id);
      var checkItAll = dataTable.querySelector('input[name="select_all"]');
      var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
      if (checkItAll.checked) {
        inputs.forEach(function(input) {
          input.checked = true;
        });
      } else {
        inputs.forEach(function(input) {
          input.checked = false;
        });
      }
    });

    $(document).on('click', '.btncopyurl', function() {
      var url = $(this).data('url');
      var text = $(this).html();
      var thisbutton = $(this);
      $(this).html('Url Copied');
      navigator.clipboard.writeText(url);
      setTimeout(function() {
        thisbutton.html(text);
      }, 5000);
    });
  });
</script>


<script>
  $(document).ready(function() {


    $('.sortableformsresponses').sortable({
      stop: function(event, ui) {
        var tableRows = $('.sortableformsresponses').closest('.table-responsive').find('.formResponseSections');
        var table = $('.sortableformsresponses').closest('.table-responsive').data('table');
        if ((window.innerWidth <= 768)) {
          $(".sortableformsresponses").sortable("disable");
          $('.sortableformsresponses').closest('.editcontent').find('.btnSortableEnableDisabled').data('status', 'enable');
          $('.sortableformsresponses').closest('.editcontent').find('.btnSortableEnableDisabled').html('Enable Sorting');
        }
        save_display_order(tableRows, table, 'response_display_order');
      }
    });
    $('.sortablesingleformsresponses').sortable({
      stop: function(event, ui) {
        var tableRows = $(this).closest('table').find('.singleformResponseSections');
        var table = 'custom_user_forms';
        if ((window.innerWidth <= 768)) {
          $(".sortablesingleformsresponses").sortable("disable");
          $('.sortablesingleformsresponses').closest('.editcontent').find('.btnSortableEnableDisabled').data('status', 'enable');
          $('.sortablesingleformsresponses').closest('.editcontent').find('.btnSortableEnableDisabled').html('Enable Sorting');
        }
        save_display_order(tableRows, table, 'display_order');
      }
    });

    if ((window.innerWidth <= 768)) {
      $(".sortableformsresponses").sortable("disable");
      $(".sortablesingleformsresponses").sortable("disable");
    }

    $(document).on('click', '.btndelimgclick', function() {
      var img_slug = $(this).data('img_slug');
      var img_name = $(this).data('img_name');
      $(this).closest('.imgdiv').remove();
      $.ajax({
        url: '<?= base_url('delimage'); ?>',
        type: "POST",
        data: {
          '_token': $('meta[name="csrf-token"]').attr('content'),
          'img_slug': img_slug,
          'img_name': img_name
        },
        success: function(data) {}
      });
    });
    $(document).on('click', '.addAnotherImage', function() {
      var newupload = '<div class="uploadImageDiv"><div class="row"><div class="col-md-4"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"><input class="dataimage" type="hidden" name="userfile[]"></div><div class="col-md-4 imgdiv" style="display:none"><br><img src="" width="100%" class="imagefromgallerysrc"><button type="button" class="btn btn-primary btnimgdel btnimgremove">X</button></div><div class="col-md-4"><label for="">Image Description</label><textarea rows="" cols="3" name="description[]" class="myinput2"></textarea></div></div></div>';
      $(".img-upload-container").append(newupload);
    });

  });

  function confirmDelete(data) {
    if (!data) {
      return;
    }
    swal({
        title: "Confirm",
        text: "Are you sure delete this? ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location.href = data;
        } else {

        }
      });
  }

  function exportFormResponse(formId, table) {
    var rows = [];
    var tableId = $(table).closest('table').attr('id');
    console.log(tableId);
    var dataTable = document.getElementById(tableId);
    var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
    if (inputs) {
      inputs.forEach(function(input) {
        if (input.checked == true) {
          rows.push($(input).val());
        }
      });
    }
    console.log(rows);
    // return;
    // return;
    if (rows != "") {
      /* (Hassan) Remove the ajax request and add windo event */
      window.open('exportformresponse?rows=' + encodeURIComponent(rows.join(',')), '_blank');
    } else if (formId) {
      window.open('exportformresponse?rows=' + encodeURIComponent(formId), '_blank');
    } else {
      alert("No Rows Selected");
    }
  }
</script>

<!-- (Hassan) Prevent closing form list while applying page limit -->
<!-- <script>
  $(document).ready(function(){
    var url = new URL(window.location.href);
    var searchParams = new URLSearchParams(url.search);
    if (searchParams.has("form_list_per_page")) {
      $('#custom_forms_list.openEditContent').click();
    }
  });
</script> -->
@endsection('content')