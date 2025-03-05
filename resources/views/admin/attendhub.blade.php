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

    .truncate-3-lines {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Limits text to 3 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-height: 5.5em;
        /* Adjust the max height for 3 lines based on your font size */
        line-height: 1.5em;
    }
</style>
<?php
$block = isset($_GET['block']) ? $_GET['block'] : '';
?>

<div id="content">
    <div class="fixJumButtons mb-18">
        <div class="d-sm-flex justify-content-between align-items-center">
            <div class="title-1 text-color-blue2">Attenhub</div>
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
                        <div class="title-1 text-color-blue ">Attenhub Posts</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        <div class=" ml-20">
                            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'custom_forms_list' || isset($_GET['formlist'])) || isset($_GET['event_list_per_page']) ? 'display:block;' : '' ?>">
                <div class="row">

                    <div class="col-sm-6 enablesortingdiv" align="right">
                        <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-md-4">
                        <div class="title-2">Use Generic Settings</div>
                        <div class="form-group  ml-3 switchoverhead2">
                            <label class="switch m-0">
                                <input type="checkbox" id="genericSettingsSwitch" class="is-generic timeimagesswitch" <?= isset($generic_settings->is_generic) && $generic_settings->is_generic ? 'checked' : '' ?> name="is_generic">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="myhr mb-16"></div>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('/saveAttendhubPostorder') ?>">
                        @csrf
                        <div class="row  make-sticky">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                        <div class="content2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                        <div class="d-flex align-items-center">
                                            <div class="title-2">Attenhub Post</div>
                                        </div>
                                        <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                                    </div>
                                </div>
                            </div>
                            <div class="editcontent2">
                                <!-- (Hassan) Page Limmiter (Begin) -->
                                <div class="form-group d-flex justify-content-end align-items-center m-3">
                                    <div>
                                        Display
                                    </div>
                                    <div class="mx-1">
                                        <form action="{{ url('attendhub') }}" method="GET">
                                            <select class="form-control form-control-sm" name="event_list_per_page" id="event_list_per_page" onchange="this.form.submit()">
                                                <option value="5" {{ $events->perPage() == 5 ? 'selected' : '' }}>5</option>
                                                <option value="10" {{ $events->perPage() == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ $events->perPage() == 25 ? 'selected' : '' }}>25</option>
                                                <option value="100" {{ $events->perPage() == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div>
                                        records per page
                                    </div>
                                </div>
                                <!-- Page Limmiter (End) -->
                                <div class="table-responsive">
                                    <table id="eventPostTable" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width:44px;"><input name="select_all" value="1" type="checkbox"></th>
                                                <th style="width: 130px;">
                                                    Dispay Events
                                                    <!-- <label style="display: block; text-align: center;">
                                                        <span style="font-family:-apple-system,BlinkMacSystemFont,i;font-size:16px;color: #495057; display: block; margin-bottom: 5px;">Display Event</span>
                                                        <label class="switch">
                                                            <input type="checkbox" id="selectAllEvents" class="majorSwitchEvent" name="action_button_active">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </label> -->
                                                </th>
                                                <th>Title</th>
                                                <th style="width: 180px;">Event Date</th>
                                                <th style="width: 180px;">Event Day</th>
                                                <th style="min-width: 120px;">Post Description</th>
                                                <th style="min-width: 160px;">Count</th>
                                                <th style="width: 100px;">
                                                    <div class="btn-group mb-2">
                                                        <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start">
                                                            <a style="padding:0.25rem 0.5rem;" class="dropdown-item btnMultipleDeleteForms" href="javascript:void(0);">Delete</a>
                                                        </div>

                                                    </div>
                                </div>
                                </th>
                                </tr>



                                </thead>
                                <tbody class="sortabletableevent" data-table="attendhub_posts">
                                    <tr>
                                        <td colspan="7">
                                            <div class="col-sm-10 p-0">
                                                <a href="{{url('addattendhubpost')}}">
                                                    <button type="button" class="btn btn-sm btn-primary">+ Add Event</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                    $eventDisplayArray = [];
                                    @endphp
                                    @if(isset($events) && count($events) > 0)
                                    <?php $i = 1; ?>
                                    @foreach ($events as $event)
                                    @php
                                    $eventDisplayArray[$event->id] = $event->display;
                                    @endphp
                                    <tr class="eventsRow" data-sectionid="<?= $event->id ?>">
                                        <td><input type="checkbox" value="{{ $event->id }}" class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
                                        <td style="width:126px;">
                                            <input type="hidden" name="attendhubPosts[]" value="{{$event->id}}">
                                            <div>
                                                <label class="switch ml-7">
                                                    <input type="hidden" name="minor_event_switch[{{$event->id}}]" value="0">
                                                    <input type="checkbox" class="minorEventSwitch" <?= ($event->display) ? 'checked' : '' ?> data-id='{{$event->id}}' value="1" name="minor_event_switch[{{$event->id}}]" data-slug="header_block_bg_picker">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        @php
                                        $attendence = getAttendence($event->id);
                                        @endphp
                                        <td>{{$event->sub_title}}</td>

                                        <!-- Displaying all dates in separate columns -->
                                        <td>
                                            @foreach($event->attenhubDates as $date)
                                            @if($date->event_date)
                                            <div>{{ date('m-d-Y', strtotime($date->event_date)) }}</div>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($event->attenhubDates as $date)
                                            <div>{{ $date->event_day }}</div>
                                            @endforeach
                                        </td>

                                        <!-- Displaying all times in separate columns -->

                                        <td class="truncate-3-lines">{{ Str::limit(strip_tags($event->post_description), 90, '...') }}</td>

                                        <td>
                                            <div class="d-flex space-between">
                                                <div class="d-flex flex-column">
                                                    <span>Yes</span>
                                                    <span>Maybe</span>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span>{{ ($attendence['count_yes']['count'] ?? 0) + ($attendence['count_yes']['guests'] ?? 0) }}</span>
                                                    <span>{{ ($attendence['count_maybe']['count'] ?? 0) + ($attendence['count_maybe']['guests'] ?? 0) }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="btn-group mb-1">
                                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a style="padding:0.25rem 0.5rem;" class="dropdown-item" href="{{base_url('editevent/'.$event->id)}}">Edit</a>
                                                    <a style="padding:0.25rem 0.5rem;" class="dropdown-item btnDeleteSingleEvent" data-id="{{$event->id}}">Delete</a>
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
                </form>
            </div>
        </div>
</div>
<?php } ?>
<?php if (check_auth_permission('form-list')) { ?>
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="attendhub_post_generic_settings" data-tip_section="custom_forms">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Generic Settings</div>
                </div>
                <div class="d-flex  align-items-center">
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
                    </div>
                </div>
            </div>
        </div>
        <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'attendhub_post_generic_settings' || isset($_GET['formlist'])) || isset($_GET['event_list_per_page']) ? 'display:block;' : '' ?>">
            <form role="form" method="post" enctype="multipart/form-data" action="<?= base_url('/saveeventpostgenericsettings') ?>">
                @csrf
                <div class="content2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                <div class="d-flex align-items-center">
                                    <div class="title-2">Generic Settings</div>
                                </div>
                                <img src="{{url('assets')}}/admin2/img/arrow-down-grey.png" alt="" width="12px" class="">
                            </div>
                        </div>
                    </div>
                    <div class="editcontent2">
                        <div class="row" id="title_banner_blog_block">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size" class="bold-text">Attenhub Post Title Font</label>
                                            <select class="myinput2" name="font_family">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;"
                                                            value="<?= $single->id ?>"
                                                            <?= (isset($generic_settings->sub_title_font) && $generic_settings->sub_title_font && $generic_settings && $generic_settings->sub_title_font == $single->id) || (isset($generic_settings->sub_title_font) && !$generic_settings->sub_title_font && $single->id == 51) ? 'selected' : ''; ?>>
                                                            <?= $single->name ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bold-text">Text Size-Mobile</label><br>
                                            <input type="text"
                                                class="myinput2 width-50px"
                                                name="title_text_size_mobile"
                                                value="{{ optional($generic_settings)->title_text_size_mobile ?? 28 }}"
                                                placeholder="18">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bold-text">Text Size-Web</label><br>
                                            <input type="text" class="myinput2 width-50px" name="title_text_size_web" value="{{ optional($generic_settings)->title_text_size_web ?? 22}}" placeholder="18">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Text Color</label>
                                            <input type="color" class="myinput2" name="title_text_color" value="{{ optional($generic_settings)->title_text_color ?? '#000000' }}" placeholder="#000000">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size">Attenhub Post Attendence Counter, Date & Time Font</label>
                                            <select class="myinput2" name="counter_date_time_fonts">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;"
                                                            value="<?= $single->id ?>"
                                                            <?= (isset($generic_settings->counter_date_time_fonts) && $generic_settings->counter_date_time_fonts == $single->id) || (!isset($generic_settings->counter_date_time_fonts) && $single->id == 1) ? 'selected' : ''; ?>>
                                                            <?= $single->name ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attenhub Post Attendence Counter, Date & Time Font Size</label><br>
                                            <input type="text" class="myinput2 width-50px" name="counter_date_time_font_size" value="{{$generic_settings->counter_date_time_font_size ?? '16'}}" placeholder="16">
                                        </div>
                                    </div>


                                </div>
                                <br>
                                <div class="myhr mb-16"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title_font_size" class="bold-text">Description Font</label>
                                            <select class="myinput2" name="description_font">
                                                <?php if (count($font_family) > 0) { ?>
                                                    <?php foreach ($font_family as $single) { ?>
                                                        <option style="font-family: <?= $single->value ?>;"
                                                            value="<?= $single->id ?>"
                                                            <?= ($generic_settings && $generic_settings->description_font == $single->id) || (!$generic_settings || !$generic_settings->description_font && $single->id == 1) ? 'selected' : ''; ?>>
                                                            <?= $single->name ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bold-text">Description Text Size Reduced-Mobile</label><br>
                                            <input type="text" class="myinput2 width-50px" name="desc_text_size_mobile" value="{{optional($generic_settings)->desc_text_size_mobile ?? '12'}}" placeholder="18">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bold-text">Description Text Size Web</label><br>
                                            <input type="text" class="myinput2 width-50px" name="desc_size_web" value="{{optional($generic_settings)->desc_size_web ?? '16'}}" placeholder="18">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Feature Background Color</label>
                                            <input type="color" class="myinput2" name="feature_bg_color" value="{{optional($generic_settings)->feature_bg_color ?? '#dedede'}}" placeholder="#000000">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Description Text Color</label>
                                            <input type="color" class="myinput2" name="desc_text_color" value="{{optional($generic_settings)->desc_text_color}}" placeholder="#000000">

                                        </div>
                                    </div>


                                </div>
                                <div class="row  make-sticky">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            <div class="form-group d-flex justify-content-end align-items-center m-3">
                <div>
                    Display
                </div>
                <div class="mx-1">
                    <form action="{{ url('attendhub') }}" method="GET">
                        <select class="form-control form-control-sm" name="response_list_per_page" id="response_list_per_page" onchange="this.form.submit()">
                            <option value="5" {{ $event_responses->perPage() == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $event_responses->perPage() == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $event_responses->perPage() == 25 ? 'selected' : '' }}>25</option>
                            <option value="100" {{ $event_responses->perPage() == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
                <div>
                    records per page
                </div>
            </div>
            <?php if (isset($_GET['response_list_per_page'])) {
                // Retrieve the value of 'response_list_per_page' from the query string
                $perPage = $_GET['response_list_per_page'];
            } else {
                // Default value if 'response_list_per_page' is not set
                $perPage = 10;
            }
            ?>
            <?php if (count($event_responses) > 0) { ?>
                <div class="table-responsive" data-table="custom_forms">
                    <table class="w-100">
                        <tbody class="sortableformsresponses">
                            <?php foreach ($event_responses as $singleform) { ?>
                                <?php $formfieldsdata = get_custom_form_data($singleform->form_id); ?>
                                <?php $formfields = json_decode($formfieldsdata->fields); ?>
                                <?php $formdata = get_custom_user_form_data($singleform->form_id, $perPage); ?>
                                <?php $dataunseen = get_custom_user_form_unseen($singleform->form_id); ?>
                                <tr class="formResponseSections" data-sectionid="<?= $singleform->id ?>">
                                    <td>
                                        <div class="content2">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="grey-div d-flex justify-content-between align-items-center editbtn2">
                                                        <!-- Title on the left -->
                                                        <div class="title-2"><?= getFormTitle($singleform->form_id) ?></div>

                                                        <!-- Toggle switch and delete button on the right -->
                                                        <div class="d-flex align-items-center">
                                                            <!-- Display label and switch inline -->


                                                            <!-- Delete button -->
                                                            <div class="btn-group mb-1">
                                                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu delete-group" data-group="{{$singleform->form_id}}" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                                    <a class="dropdown-item">Delete</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="editcontent2 tr-vetical-middle">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center mb-10">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 enablesortingdiv" align="right">
                                                        <button type="button" class="btn btn-sm btn-primary btnSortableEnableDisabled" data-status="enable">Enable Sorting</button>
                                                    </div>
                                                </div>
                                                <div class="table-responsive" data-subtable="custom_user_forms" style="max-height:400px"> <!-- (Hassan) Form name -->
                                                    <table id="<?= $dataunseen ? 'custom-form-table-' . $singleform->id : 'example-' . $singleform->id ?>" class="table align-items-center table-flush dataTable" width="100%" cellspacing="0">
                                                        <?php if ($formdata) {
                                                            $fieldsshow = array();
                                                            $form_business_field_name = $customForms->where('id', $singleform->form_id)->first();

                                                            if ($form_business_field_name) {

                                                                $fieldsArray = json_decode($form_business_field_name->fields, true);
                                                                $fieldsArray = array_map("unserialize", array_unique(array_map("serialize", $fieldsArray)));
                                                                $fieldsArray = array_values($fieldsArray);
                                                                // Get the second field name
                                                                $fieldsArray = array_filter($fieldsArray, function ($item) {
                                                                    return $item['fieldname'] !== 'hidden';
                                                                });

                                                                // Re-index the array to start from 0
                                                                $fieldsArray = array_values($fieldsArray);
                                                                // dd($data);
                                                                $c1 = $fieldsArray[0]['column_label'] ?? $fieldsArray[0]['fieldname'] ?? 'Name';
                                                                $c2 = $fieldsArray[1]['column_label'] ?? $fieldsArray[1]['fieldname'] ?? 'Business';
                                                                $c3 = $fieldsArray[3]['column_label'] ?? $fieldsArray[3]['fieldname'] ?? 'Yes/Maybe';
                                                                $new = $fieldsArray[4]['column_label'] ?? $fieldsArray[4]['fieldname'] ?? 'Are you new?';
                                                                $c4 = $fieldsArray[5]['column_label'] ?? $fieldsArray[5]['fieldname'] ?? 'Guest No';
                                                                $c5 = $fieldsArray[6]['column_label'] ?? $fieldsArray[6]['fieldname'] ?? 'Comments';
                                                        ?>
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th><input name="select_all" value="1" type="checkbox"></th>
                                                                        <th>{{$c1}}</th>
                                                                        <th>{{$c2}}</th>
                                                                        <th>{{$c3}}</th>
                                                                        <th>{{$c4}}</th>
                                                                        <th>{{$c5}}</th>
                                                                        <th>{{$new}}</th>
                                                                        <th>Display</th>
                                                                        <th>
                                                                            <div class="btn-group mb-1">
                                                                                <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    Action
                                                                                </button>
                                                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                                                    <a class="dropdown-item" href="javascript:void(0);" onClick="deleteChecked();">Delete Selected</a>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="sortablesingleformsresponses">
                                                                    <?php foreach ($formdata as $key => $single) { ?>
                                                                        <?php $form_feilds = json_decode($single->fields_data, true);

                                                                        if (array_key_exists("Hidden", $form_feilds)) {
                                                                            $form_feilds = array_filter($form_feilds, function ($item) {
                                                                                return $item !== 'event_form';
                                                                            });

                                                                            $form_feilds = array_values($form_feilds);
                                                                        }
                                                                        // dd($form_feilds);
                                                                        // Re-index the array to start from 0
                                                                        $form_feilds_unfied = array();
                                                                        if ($form_feilds) {
                                                                            foreach ($form_feilds as $key => $value) {
                                                                                $form_feilds_unfied[strtolower($key)] = $value;
                                                                            }
                                                                            $keys = array_keys($form_feilds);
                                                                            if (isset($keys[5])) { // 4 because of 0-based index
                                                                                $firstFieldName = $keys[1]; // Access the 5th field name
                                                                            } else {
                                                                                $firstFieldName = 'Business'; // Default value if not enough fields
                                                                            }
                                                                            if (isset($keys[5])) { // 4 because of 0-based index
                                                                                $fifthFieldName = $keys[5]; // Access the 5th field name
                                                                            } else {
                                                                                $fifthFieldName = 'Will You Bring Guest(s), If So, Indicate How Many?'; // Default value if not enough fields
                                                                            }
                                                                            if (isset($keys[3])) { // 4 because of 0-based index
                                                                                $thirdFieldName = $keys[3]; // Access the 5th field name
                                                                            } else {
                                                                                $thirdFieldName = 'Will you be attending the event?'; // Default value if not enough fields
                                                                            }
                                                                            // dd($form_feilds[$thirdFieldName]);
                                                                            $form_feilds_unfied['guest'] = $form_feilds[$fifthFieldName];
                                                                            $form_feilds_unfied['will you be attending the event?'] = $form_feilds[$thirdFieldName];
                                                                            $form_feilds_unfied['business name'] = $form_feilds[$firstFieldName];
                                                                            $form_feilds_unfied = array_values($form_feilds_unfied);
                                                                        }
                                                                        ?>
                                                                        <tr class="singleformResponseSections" data-sectionid="{{$single->id}}">
                                                                            <td><input type="checkbox" value=" <?= $single->id; ?> " class="checkrow" id="checkrow" name="checkrow" multiple="true" /></td>
                                                                            <td>
                                                                                {{ $form_feilds_unfied[0] ?? 'N/A' }} <!-- Assuming 'name' is a field -->
                                                                            </td>

                                                                            <!-- Business Field -->
                                                                            <td>
                                                                                {{ $form_feilds_unfied[1] ?? 'N/A' }} <!-- Assuming 'business' is a field -->
                                                                            </td>

                                                                            <!-- Yes/Maybe Field -->
                                                                            <td>
                                                                                @php
                                                                                // Extract "Yes/No/Maybe" part from the field with line breaks
                                                                                $yesMaybeField = $form_feilds_unfied[3] ?? 'N/A';
                                                                                $yesMaybeParts = explode('<br>', trim($yesMaybeField, '<br>'));
                                                                                @endphp

                                                                                <!-- Display each part of 'Yes/Maybe' -->

                                                                                {{ strip_tags($yesMaybeParts[0]) }}

                                                                            </td>

                                                                            <!-- Guest Field -->
                                                                            <td>
                                                                                {{ !empty($form_feilds_unfied[5]) ? $form_feilds_unfied[5] : '' }}
                                                                            </td>

                                                                            <!-- Comment Field -->
                                                                            @if(isset($form_feilds_unfied[6]) && $form_feilds_unfied[6] != "" )
                                                                            <div style="display:none" id="text_popup{{ $single->id }}">
                                                                                {{ $form_feilds_unfied[6] }}

                                                                            </div>
                                                                            @endif
                                                                            <td data-comment="@if(isset($form_feilds_unfied[6]))
                                                                                {{ $form_feilds_unfied[6] }}@endif">
                                                                                <svg width="16" height="16" viewBox="0 0 16 16" @if(isset($form_feilds_unfied[6]) && $form_feilds_unfied[6] !="" )
                                                                                    onclick="updateComment('{{ $single->id }}','{{$form_feilds_unfied[6]}}')"
                                                                                    @endif fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path d="M10.5949 2.03286C11.0422 1.58544 11.649 1.33405 12.2817 1.33398C12.9143 1.33392 13.5211 1.5852 13.9686 2.03253C14.416 2.47986 14.6674 3.08661 14.6674 3.71929C14.6675 4.35198 14.4162 4.95877 13.9689 5.40619L13.3742 6.00153L10.0009 2.62753L10.5949 2.03286ZM9.29422 3.33486L2.62755 10.0009C2.35675 10.2717 2.16636 10.6123 2.07755 10.9849L1.34755 14.0529C1.32779 14.136 1.32964 14.2227 1.35294 14.3049C1.37623 14.3871 1.42019 14.4619 1.48063 14.5223C1.54106 14.5827 1.61595 14.6266 1.69816 14.6498C1.78036 14.673 1.86714 14.6747 1.95022 14.6549L5.01755 13.9242C5.39035 13.8355 5.73121 13.6451 6.00222 13.3742L12.6676 6.70819L9.29422 3.33486Z" fill="#626262" />
                                                                                </svg>

                                                                                <svg @if(isset($form_feilds_unfied[6]) && $form_feilds_unfied[6] !="" )
                                                                                    onclick="openPopupText('text_popup{{ $single->id }}')"
                                                                                    @endif class="comment-svg" width="27" height="24" viewBox="0 0 27 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                    <g filter="url(#filter0_d_13202_38862)">
                                                                                        <ellipse cx="13.5" cy="8" rx="9.5" ry="8" fill="{{ (isset($form_feilds_unfied[6])&& $form_feilds_unfied[6] != '') ? '#3FA8F9' : '#ADADAD' }}" />
                                                                                    </g>
                                                                                    <path d="M13.5 13.5397C13.1517 13.5397 12.8536 13.4373 12.6057 13.2326C12.3575 13.0276 12.2333 12.7812 12.2333 12.4935H14.7667C14.7667 12.7812 14.6427 13.0276 14.3949 13.2326C14.1466 13.4373 13.8483 13.5397 13.5 13.5397ZM10.9667 11.9704V10.9243H16.0333V11.9704H10.9667ZM11.125 10.4012C10.3967 10.0438 9.81886 9.56428 9.39157 8.96274C8.96386 8.3612 8.75 7.70736 8.75 7.0012C8.75 5.91146 9.21191 4.98526 10.1357 4.22262C11.0591 3.45962 12.1806 3.07812 13.5 3.07812C14.8194 3.07812 15.9409 3.45962 16.8643 4.22262C17.7881 4.98526 18.25 5.91146 18.25 7.0012C18.25 7.70736 18.0364 8.3612 17.6091 8.96274C17.1814 9.56428 16.6033 10.0438 15.875 10.4012H11.125Z" fill="white" />
                                                                                    <defs>
                                                                                        <filter id="filter0_d_13202_38862" x="0" y="0" width="27" height="24" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                                                            <feOffset dy="4" />
                                                                                            <feGaussianBlur stdDeviation="2" />
                                                                                            <feComposite in2="hardAlpha" operator="out" />
                                                                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_13202_38862" />
                                                                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_13202_38862" result="shape" />
                                                                                        </filter>
                                                                                    </defs>
                                                                                </svg>
                                                                            </td>
                                                                            <td>
                                                                                {{ isset($form_feilds_unfied[4]) ? strip_tags($form_feilds_unfied[4]) : '' }}
                                                                            </td>



                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <label class="switch">
                                                                                        <input type="checkbox" class="displayswitch" data-group="{{$singleform->form_id}}" name="action_button_active" data-id="{{$single->id}}" <?= $single->display ? 'checked' : '' ?>>
                                                                                        <span class="slider round"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="btn-group mb-1">
                                                                                    <button type="button" class="dropdown-toggle mydropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        Action
                                                                                    </button>
                                                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                                                        <a class="dropdown-item" href="{{base_url('editattenhubform/'.$single->id)}}">Edit</a>
                                                                                        <a href="<?= base_url('detailuserform/' . $single->id) ?>" class="dropdown-item">Detail</a>
                                                                                        <a class="dropdown-item" href="javascript:void(0);" onClick="deleteSingle(<?= $single->id; ?>);">Delete</a>
                                                                                        

                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            <?php } else { ?>
                                                                <h3 class="text-center">No Record Found</h3>
                                                            <?php }
                                                        } else { ?>
                                                            <h3 class="text-center">No Record Found</h3> <?php } ?>
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
    <div class="contentdiv">
        <div class="btnedit openEditContent" id="custom_forms_list" data-tip_section="custom_forms">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex  align-items-center">
                    <div class="title-1 text-color-blue ">Events Form Maker</div>
                </div>
                <div class="d-flex  align-items-center">
                    <div class=" ml-20">
                        <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
                    </div>
                </div>
            </div>
        </div>
        <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'event_forms_list' || isset($_GET['formlist'])) || isset($_GET['form_list_per_page']) ? 'display:block;' : '' ?>">
            <div class="row">

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
                                                <a class="dropdown-item" onclick="deleteCheckedForm();" href="javascript:void(0);">Delete</a>
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
                                            <label class="switch switchToggleForm ml-7">
                                                <input
                                                    type="checkbox"
                                                    data-event-id='{{$customForm->event_id}}'
                                                    class="notificationswitch toggleForm"
                                                    <?= ($customForm->active) ? 'checked' : '' ?>
                                                    data-id='{{$customForm->id}}'
                                                    name="header_block_override_bg"
                                                    data-slug="header_block_bg_picker"
                                                    @if(isset($eventDisplayArray[$customForm->event_id]) && $eventDisplayArray[$customForm->event_id] == 0)
                                                disabled
                                                @endif
                                                >

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
                                                <a class="dropdown-item" href="{{base_url('editeventform/'.$customForm->id)}}">Edit</a>
                                                <!-- <a class="dropdown-item" href="{{base_url('duplicateform/'.$customForm->id)}}">Duplicate</a> -->
                                                @if($customForm->id != 7 && $customForm->id !=8)
                                                <a class="dropdown-item" onClick="deleteSingleform(<?= $customForm->id; ?>);">Delete</a>
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
                    <!-- <div class="row  make-sticky">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Save order</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
    <?php if (check_auth_permission('attenhub-notification-settings')) { ?>
        <div class="contentdiv">
            <div class="btnedit openEditContent" id="custom_forms_settings" data-tip_section="custom_form_settings">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex  align-items-center">
                        <div class="title-1 text-color-blue ">Notifications Settings</div>
                    </div>
                    <div class="d-flex  align-items-center">
                        <div class=" ml-20">
                            <img src="{{url('assets')}}/admin2/img/arrow-right-big.png" alt="" class="setion-arrows" width="21px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="editcontent" style="<?= (isset($_GET['block']) && $_GET['block'] == 'custom_forms_settings') ? 'display:block;' : '' ?>">

                <form action="{{url('saveattenhubemails')}}" method="post" enctype="multipart/form-data">
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
                                            <textarea class="myinput2" name="attenhub_notification_emails" rows="1" placeholder="example@gmail.com,example2@gmail.com........"><?= $customFormsSettings->attenhub_notification_emails ?></textarea>
                                        </div>
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
<div id="updateCommentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="exampleModalLabelSupportForm">Edit Comment</h5>
                <form action="{{ url('update-attenhub-form-response-comment') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="commentText">Comment</label>
                        <input type="hidden" id="attenhub_response_id" value="" name="attenhub_response_id">
                        <textarea id="commentText" name="comment" class="form-control" rows="5" placeholder="Edit your comment here..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Trigger Button -->

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeModal" aria-label="Close">&times;</button>
                <h5 class="modal-title" id="myModalLabel">Action Disabled</h5>
            </div>
            <div class="modal-body">
                <p>In order to turn the form on, you need to Activate the Attenhub Post.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="closeModalFooter">Close</button>
            </div>
        </div>
    </div>
</div>




<script>
    function updateComment(id, comment) {
        $('#updateCommentModal').modal('show');
        $('#commentText').val(comment);
        $('#attenhub_response_id').val(id);
    }

    function deleteSingle(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this response?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('<?= base_url('delete-individual-response') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            id: [id]
                        }) // Send the ID to delete
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error deleting item: ' + data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the item.',
                            'error'
                        );
                    });
            }
        });
    }


    function deleteSingleform(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete Event Form.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3FA8F9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('<?= base_url('delete-individual-form') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            id: [id]
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The item has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error deleting item: ' + data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the item.',
                            'error'
                        );
                    });
            }
        });
    }



    function deleteCheckedForm() {
        const checkboxes = document.querySelectorAll('.checkrow:checked');
        const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (ids.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No rows selected',
                text: 'Please select rows for deletion.',
                confirmButtonColor: '#3FA8F9',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this Event Form.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3FA8F9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete them!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('<?= base_url('delete-event-forms') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            ids: ids
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The selected items have been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page to reflect changes
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error deleting items: ' + data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting items.',
                            'error'
                        );
                    });
            }
        });
    }


    function deleteChecked() {
        const checkboxes = document.querySelectorAll('.checkrow:checked');
        const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

        if (ids.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'No Rows Selected',
                text: 'Please select rows to delete.',
                confirmButtonColor: '#3FA8F9',
                confirmButtonText: 'OK'
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'Deleting these items will also delete related Event Form and Event Post.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3FA8F9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete them!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('<?= base_url('delete-multiple-responses') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            ids: ids
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'The selected items have been deleted.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page after deletion
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the items. Please try again.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'There was an issue processing your request.',
                            'error'
                        );
                    });
            }
        });
    }


    document.getElementById('event_list_per_page').addEventListener('change', function() {
        let selectedValue = this.value;
        let url = new URL(window.location.href); // Get current URL
        url.searchParams.set('event_list_per_page', selectedValue); // Update query string
        window.location.href = url.toString(); // Redirect to the new URL
    });
    document.getElementById('response_list_per_page').addEventListener('change', function() {
        let selectedValue = this.value;
        let url = new URL(window.location.href); // Get current URL
        url.searchParams.set('response_list_per_page', selectedValue); // Update query string
        window.location.href = url.toString(); // Redirect to the new URL
    });
    document.getElementById('form_list_per_page').addEventListener('change', function() {
        let selectedValue = this.value;
        let url = new URL(window.location.href); // Get current URL
        url.searchParams.set('form_list_per_page', selectedValue); // Update query string
        window.location.href = url.toString(); // Redirect to the new URL
    });
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
        $('#closeModal').click(function() {
        $('#myModal').hide();  // Hide the modal
    });

    // Close the modal when the close button in the footer is clicked
    $('#closeModalFooter').click(function() {
        $('#myModal').hide();  // Hide the modal
    });

    // Close the modal when clicking outside the modal (optional, but often needed for better UX)
    $(window).click(function(event) {
        if ($(event.target).is('#myModal')) {
            $('#myModal').hide();  // Close modal if clicked outside of it
        }
    });
        $('.sortabletableevent').sortable({
            stop: function(event, ui) {
                var tableRows = $('.sortabletableevent').closest('.table-responsive').find('.eventsRow');
                var table = $('.sortabletableevent').data('table');
                if ((window.innerWidth <= 768)) {
                    $(".sortabletableevent").sortable("disable");
                    $('.sortabletableevent').closest('.editcontent').find('.btnSortableEnableDisabled').data('status', 'enable');
                    $('.sortabletableevent').closest('.editcontent').find('.btnSortableEnableDisabled').html('Enable Sorting');
                }
                save_display_order(tableRows, table, 'display_order');
            }
        });
        $('.minorEventSwitch').change(function() {
            var eventId = $(this).data('id'); // Get the event ID from data-id attribute
            var isChecked = $(this).is(':checked') ? 1 : 0; // Determine the value to save (1 for checked, 0 for unchecked)

            // Send AJAX request to update the state of the minor switch
            $.ajax({
                url: 'enable-single-event', // Replace with your actual endpoint for updating switch
                method: 'POST',
                data: {
                    id: eventId,
                    display: isChecked,
                    _token: '{{ csrf_token() }}' // Include CSRF token for protection
                },
                success: function(response) {
                    if (!isChecked) { // If the switch was turned off
                        // Find other switches with the same data-event-id
                        $('.notificationswitch.toggleForm').each(function() {
                            if ($(this).data('event-id') === eventId) {
                                $(this).prop('checked', false); // Turn off the matching switch
                                $(this).trigger('change'); // Trigger its change event for toggleForm
                            }
                        });
                    } else { // If the switch was turned OFF
                        // Find other switches with the same data-event-id and turn them off
                        $('.notificationswitch.toggleForm').each(function() {
                            if ($(this).data('event-id') === eventId) {
                                $(this).prop('checked', false); // Turn off the matching switch
                                $(this).prop('disabled', true); // Disable the matching switch
                                $(this).trigger('change'); // Trigger its change event for toggleForm
                            }
                        });
                    }
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('.dropdown-item#displayOnFrontendMinor').click(function() {
            var eventId = $(this).data('id'); // Get the event ID from data-id attribute
            // Send AJAX request to update the state of the minor switch
            $.ajax({
                url: 'enable-single-event', // Replace with your actual endpoint for updating switch
                method: 'POST',
                data: {
                    id: eventId,
                    display: 1,
                    _token: '{{ csrf_token() }}' // Include CSRF token for protection
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });

        function checkAllMinorSwitches() {
            var allChecked = true;
            $('.minorEventSwitch').each(function() {
                if (!$(this).is(':checked')) {
                    allChecked = false;
                    return false; // Exit the loop if any is unchecked
                }
            });

            // If all are checked, switch on the majorSwitchEvent
            if (allChecked) {
                $('#selectAllEvents').prop('checked', true);
            } else {
                $('#selectAllEvents').prop('checked', false);
            }
        }

        // Call the function on page load
        checkAllMinorSwitches();

        // Optionally, you can also update the majorSwitchEvent when individual checkboxes are toggled
        $('.minorEventSwitch').on('change', function() {
            checkAllMinorSwitches();
        });
        $('#displayOnFrontend').click(function() {
            // Array to hold selected event IDs
            var selectedIds = [];

            // Get all checked checkboxes in this specific table
            $('.checkrow:checked').each(function() {
                selectedIds.push($(this).val()); // Get the event ID from the 'value' attribute
            });

            if (selectedIds.length === 0) {
                alert('Please select at least one event to display on the frontend.');
                return; // Exit if no checkboxes are checked
            }

            // Send AJAX request to update the display status for selected events
            $.ajax({
                url: '/enable-multiple-events', // Replace with your actual endpoint
                method: 'POST',
                data: {
                    data: {
                        ids: selectedIds, // Send selected IDs
                        selectAll: 1 // Send the state of the major switch (1 or 0)
                    },
                    _token: '{{ csrf_token() }}' // Include CSRF token for protection
                },
                success: function(response) {
                    console.log(response.message); // Handle success
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('.dropdown-item#displayResponseOnFrontend').click(function() {
            // Array to hold selected event IDs
            var selectedIds = [];

            // Get all checked checkboxes in this specific table
            $('.checkrow:checked').each(function() {
                selectedIds.push($(this).val()); // Get the event ID from the 'value' attribute
            });

            if (selectedIds.length === 0) {
                alert('Please select at least one event to display on the frontend.');
                return; // Exit if no checkboxes are checked
            }

            // Send AJAX request to update the display status for selected events
            $.ajax({
                url: 'enable-multiple-responses', // Replace with your actual endpoint
                method: 'POST',
                data: {
                    data: {
                        ids: selectedIds, // Send selected IDs
                        selectAll: 1 // Send the state of the major switch (1 or 0)
                    },
                    _token: '{{ csrf_token() }}' // Include CSRF token for protection
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('.dropdown-item#displaySingleResponseOnFrontend').click(function() {
            // Array to hold selected event IDs
            var responseId = $(this).closest('tr').data('sectionid');
            $.ajax({
                url: 'enable-single-response', // Replace with your actual endpoint
                method: 'POST',
                data: {
                    id: responseId,
                    display: 1,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('.dropdown-item#dontDisplaySingleResponseOnFrontend').click(function() {
            // Array to hold selected event IDs
            var responseId = $(this).closest('tr').data('sectionid');
            $.ajax({
                url: 'disable-single-response', // Replace with your actual endpoint
                method: 'POST',
                data: {
                    id: responseId,
                    display: 0,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('#dontDisplayResponseOnFrontend').click(function() {
            // Array to hold selected event IDs
            var selectedIds = [];

            // Get all checked checkboxes in this specific table
            $('.checkrow:checked').each(function() {
                selectedIds.push($(this).val()); // Get the event ID from the 'value' attribute
            });

            if (selectedIds.length === 0) {
                alert('Please select at least one event to display on the frontend.');
                return; // Exit if no checkboxes are checked
            }

            // Send AJAX request to update the display status for selected events
            $.ajax({
                url: 'disable-multiple-responses', // Replace with your actual endpoint
                method: 'POST',
                data: {
                    data: {
                        ids: selectedIds, // Send selected IDs
                        selectAll: 0 // Send the state of the major switch (1 or 0)
                    },
                    _token: '{{ csrf_token() }}' // Include CSRF token for protection
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr.responseText); // Handle error
                }
            });
        });
        $('#selectAllEvents').change(function() {
            // Get the checked status
            var isChecked = $(this).is(':checked');
            var selectedIds = [];
            // Gather the IDs of all checked minor switches
            $('.checkrow:checked').each(function() {
                selectedIds.push($(this).val()); // Get the event ID from the 'value' attribute
            });
            // Send the AJAX request if there are checked records
            if (selectedIds.length > 0) {
                $.ajax({
                    url: '/enable-multiple-events', // The URL where you handle enabling
                    method: 'POST',
                    data: {
                        data: {
                            ids: selectedIds,
                            selectAll: isChecked
                        }, // Send the array of IDs
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Handle success response
                        location.reload();
                    },
                    error: function(error) {
                        // Handle error response
                        console.error('Error:', error);
                    }
                });
            }
        });

        $('#genericSettingsSwitch').change(function() {
            // Get the new state of the checkbox
            var isGeneric = $(this).is(':checked') ? 1 : 0;

            // Send the AJAX request
            $.ajax({
                url: '/is-generic', // Replace with your URL
                type: 'POST',
                data: {
                    is_generic: isGeneric,
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function(response) {
                    // Optionally handle success response
                    console.log(response.message); // Show success message
                },
                error: function(xhr) {
                    // Optionally handle error response
                    console.error(xhr.responseText); // Show error message
                }
            });
        });

        // Close the modal when the 'x' is clicked
        $('.close').click(function() {
            $('#commentModal').fadeOut(); // Hide modal
        });

        // Close the modal when clicking outside of it
        $(window).click(function(event) {
            if (event.target.id === "commentModal") {
                $('#commentModal').fadeOut(); // Hide modal
            }
        });


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
        $(document).on('click', '.form-group .switchToggleForm', function(event) {
        // Check if the checkbox inside the label is disabled
        var checkbox = $(this).find('input[type="checkbox"]');
        if (checkbox.prop('disabled')) {
            // If the checkbox is disabled, show the popup
            event.preventDefault(); // Prevent the default action (toggle)
            $('#myModal').show();
        } else {
            // If the checkbox is enabled, proceed as usual
            console.log("Checkbox is enabled, performing the action...");
            // You can continue with your logic for the enabled checkbox here.
        }
    });


        $('.toggleForm').on('change', function() {
            // Check if the checkbox is disabled


            var check_value = $(this).prop('checked') == true ? '1' : '0';
            var id = $(this).data('id');
            var table = $(this).data('table');

            $.ajax({
                url: base_url + '/toggleForm',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    'check_value': check_value
                },
                success: function(data) {
                    // Handle success, if needed
                }
            });
        });


        $(document).on('click', '.btnMultipleDeleteForms', function() {
            var rows = [];
            var dataTable = document.getElementById('eventPostTable');
            var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
            if (inputs) {
                inputs.forEach(function(input) {
                    if (input.checked == true) {
                        rows.push($(input).val());
                    }
                });
            }

            if (rows.length > 0) {
                // Use SweetAlert for confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete all related responses and the Event Form.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3FA8F9',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    width: '300px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "<?php echo url('deleteMultipleEventPosts'); ?>",
                            data: {
                                _token: "{{ csrf_token() }}",
                                rows: rows
                            },
                            error: function(res) {
                                Swal.fire('Error', 'Something went wrong!', 'error');
                            },
                            success: function(res) {
                                Swal.fire('Deleted!', 'The rows have been deleted.', 'success').then(() => {
                                    window.location.href = "attendhub";
                                });
                            }
                        });
                    }
                });
            } else {
                // Show SweetAlert if no rows are selected
                Swal.fire({
                    title: 'No Rows Selected',
                    text: 'Please select at least one row to delete.',
                    icon: 'info',
                    confirmButtonColor: '#3FA8F9', // Customize the button color
                    confirmButtonText: 'OK' // Optionally customize the button text
                });
            }
        });
        $(document).on('click', '.btnDeleteSingleEvent', function() {
            var rows = [];
            rows.push($(this).data('id'));

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the selected event and related responses and Event Form.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3FA8F9',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (rows != "") {
                        $.ajax({
                            type: "post",
                            url: "<?php echo url('deleteMultipleEventPosts'); ?>",
                            data: {
                                _token: "{{ csrf_token() }}",
                                rows: rows
                            },
                            success: function(res) {
                                Swal.fire(
                                    'Deleted!',
                                    'The event has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.href = "attendhub"; // Reload or redirect after deletion
                                });
                            },
                            error: function(res) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the event.',
                                    'error'
                                );
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'No Rows Selected',
                            text: 'Please select at least one row to delete.',
                            icon: 'info',
                            confirmButtonColor: '#3FA8F9', // Customize the button color
                            confirmButtonText: 'OK' // Optionally customize the button text
                        });
                    }
                }
            });
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


        function DeleteMultiplePosts() {
            var rows = [];
            var dataTable = document.getElementById('emailtemplateTable');
            var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
            if (inputs) {
                inputs.forEach(function(input) {
                    if (input.checked == true) {
                        rows.push($(input).val());
                    }
                });
            }
            console.log(rows);
            return false;
            if (rows != "") {
                $.ajax({
                    type: "post",
                    url: "<?php echo url('deleteMultipleEmailTemplate'); ?>",
                    data: {
                        _token: "{{ csrf_token() }}",
                        rows: rows
                    },
                    error: function(res) {},
                    success: function(res) {
                        window.location.href = "crmcontrols?block=email_management";
                    }
                });
            } else {
                alert("No Rows Selected");
            }
        }

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

        $('.delete-action').click(function() {
            var id = $(this).data('id');

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: 'delete-individual-response', // Your endpoint for deleting an individual item
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Optionally, remove the item's row from the UI
                        $(this).closest('.form-group').remove();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        // Handle group delete button click
        $('.delete-group').click(function() {
            var group = $(this).data('group');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Deleting all responses will delete the relevant Event Form and Event Post.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3FA8F9',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/delete-group-response', // Your endpoint for deleting a group of items
                        type: 'POST',
                        data: {
                            group: group,
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.form-group[data-group="' + group + '"]').remove();
                                Swal.fire(
                                    'Deleted!',
                                    'All items in the group have been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload(); // Reload the page after deletion
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                            console.log(response);
                            // Optionally, remove all items in the group from the UI

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the group. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        function initializeMajorSwitches() {
            // Loop through each unique group
            $('.majorSwitch').each(function() {
                var group = $(this).data('group'); // Get the group number
                // Check if all display switches in this group are checked
                var allChecked = $('.displayswitch[data-group="' + group + '"]:checked').length === $('.displayswitch[data-group="' + group + '"]').length;
                // Set the major switch state
                $(this).prop('checked', allChecked);
            });
        }

        // Call the function to initialize major switches on page load
        initializeMajorSwitches();
        $(document).ready(function() {
            $('.isNewSwitch').change(function() {
                var isChecked = $(this).is(':checked');
                var formId = $(this).data('id');


                $.ajax({
                    url: '/update-new-status', // Your endpoint to handle the update
                    type: 'POST',
                    data: {
                        id: formId,
                        display: isChecked ? 1 : 0, // Send 1 for checked and 0 for unchecked
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Handle success (optional)
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error (optional)
                        console.error(error);
                    }
                });
            });

            function updateDisplaySwitches(majorSwitch) {
                var group = $(majorSwitch).data('group'); // Get the group number of the major switch
                var isChecked = $(majorSwitch).is(':checked');

                // Set individual display switches based on major switch state
                $('.displayswitch[data-group="' + group + '"]').prop('checked', isChecked).trigger('change'); // Trigger change event for each
            }
            // Check the state of individual switches on page load
            $('.majorSwitch').change(function() {
                updateDisplaySwitches(this); // Update display switches for this major switch

                // Update display status in the database for all switches in this group
                var group = $(this).data('group');
                var isChecked = $(this).is(':checked');

                $('.displayswitch[data-group="' + group + '"]').each(function() {
                    var formId = $(this).data('id');

                    $.ajax({
                        url: '/update-form-visibility', // Your endpoint to handle the update
                        type: 'POST',
                        data: {
                            id: formId,
                            display: isChecked ? 1 : 0, // Send 1 for checked and 0 for unchecked
                            _token: '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
            $('.displayswitch').change(function() {
                var isChecked = $(this).is(':checked');
                var formId = $(this).data('id');

                $.ajax({
                    url: '/update-form-visibility', // Your endpoint to handle the update
                    type: 'POST',
                    data: {
                        id: formId,
                        display: isChecked ? 1 : 0, // Send 1 for checked and 0 for unchecked
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Handle success (optional)
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error (optional)
                        console.error(error);
                    }
                });
            });
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