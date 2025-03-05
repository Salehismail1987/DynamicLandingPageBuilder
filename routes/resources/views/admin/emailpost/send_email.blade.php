@extends('admin.layout.dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Send Emails</h1>
      <a href="{{ url('crmcontrols?block=email_management') }}" class="btn btn-info " >
          Back
      </a>
      </div>
    <!-- Form Basic -->
    <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Group Emails</h3>
            <h6 class="m-0 font-weight-bold text-primary">Send Emails, Groups Include Only Subscribers</h6>
        </div>
        <div class="card-body">
            <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data"  action="{{ url('emailMarketing') }}/{{$email_template_id}}">
            @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="teaser_title">Select Receiving Contact Group</label>
                            <select name="select_group[]" id="selected_group" class="form_control col-md-12" multiple="true">
                                <option value="test">Test Email</option>
                                <option value="all">Master Group</option>
                                    <?php
                                    foreach($contact_groups as $group){
                                        $selected = "";
                                        // if(is_email_in_group($contact_group->id, $group->id)){
                                        //     $selected = "selected";
                                        // }
                                        
                                        ?>
                                        <option value="<?php echo $group->id?>"<?=$selected?> ><?=$group->group_name?></option>
                                        <?php 
                                    }
                                    ?>  
                                </select>
                        </div>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="select_type">Select When to Send Emails</label>
                            <select class="myinput2" onchange="check_type_compaign(this.value)" name="select_type" id="select_type">
                            
                                <option value="On the go">Send Immediately</option>    
                                <option value="Scheduled">Send per Schedule Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row"  id="schedule_time_div">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="schedule_date">Schedule Date</label>
                            <input type="date" class="myinput2" name="schedule_date" id="schedule_date">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_time">Schedule Time</label>
                            <input type="text" id="schedule_time" class="myinput2" name="schedule_time" autocomplete="off" />
                        </div>
                    </div>
                    
                    <input type="hidden" name="contact_type" value='Group'>
                </div>
                    <br/>
            
                    <button type="button" onclick="submitFormSchedule(0)" class="btn btn-primary">Save</button>
                <a href="<?=base_url('crmcontrols?block=email_management')?>"><button type="button" class="btn btn-default">Cancel</button></a>
            </form>
        </div>
    </div>

      <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Group Emails</h3>
            <h6 class="m-0 font-weight-bold text-primary">Send Emails, Groups, Includes Subscribers & Non-Subscribers</h6>
        </div>
        <div class="card-body">
            <form role="form" id="bulk_emails_form2" method="post" enctype="multipart/form-data"  action="{{ url('emailMarketing') }}/{{$email_template_id}}">
            @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="teaser_title">Select Receiving Contact Group</label>
                            <select name="select_group[]" id="select_group" class="form_control col-md-12" multiple="true">
                                <option value="test">Test Email</option>
                                <option value="all">Master Group</option>
                                    <?php 
                                    foreach($contact_groups as $group){
                                        $selected = "";
                                        // if(is_email_in_group($contact_group->id, $group->id)){
                                        //     $selected = "selected";
                                        // }
                                        
                                        ?>
                                        <option value="<?php echo $group->id?>"<?=$selected?> ><?=$group->group_name?></option>
                                        <?php 
                                    }
                                    ?>  
                                </select>
                        </div>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="select_type">Select When to Send Emails</label>
                            <select class="myinput2" onchange="check_type_compaign2(this.value)" name="select_type" id="select_type2">   
                                <option value="On the go">Send Immediately</option>
                                <option value="Scheduled">Send per Schedule Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row"  id="schedule_time_div2">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="schedule_date2">Schedule Date</label>
                            <input type="date" class="myinput2" name="schedule_date" id="schedule_date2">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_time2">Schedule Time</label>
                            <input type="text" id="schedule_time2" class="myinput2" name="schedule_time" autocomplete="off" />
                        </div>
                    </div>
                    <input type="hidden" name="non_subscribers" value='1'>
                    <input type="hidden" name="contact_type" value='Group'>
                </div>
                    <br/>
            
                    <button type="button" onclick="submitFormSchedule2(0)" class="btn btn-primary">Save</button>
            <a href="<?=base_url('crmcontrols?block=email_management')?>"><button type="button" class="btn btn-default">Cancel</button></a>
          
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
            <h6 class="m-0 font-weight-bold text-primary">Send Emails, Individual Contacts, Includes Only Subscribers</h6>
        </div>
        <div class="card-body">
            <form role="form" id="bulk_emails_form3" method="post" enctype="multipart/form-data"  action="{{ url('emailMarketing') }}/{{$email_template_id}}">
            @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="teaser_title">Select Receiving Contacts</label>
                            <select name="select_contact[]" id="selected_contact" class="form_control col-md-12" multiple="true">
                                <option value="test">Test Email</option>
                                    <?php 
                                    foreach($email_lists_Subscribers as $email_list){
                                        $selected = "";
                                        // if(is_email_in_group($contact_group->id, $email_list->id)){
                                        //     $selected = "selected";
                                        // }
                                        
                                        ?>
                                        <option value="<?php echo $email_list->id?>"<?=$selected?> ><?=$email_list->name?></option>
                                        <?php 
                                    }
                                    ?>  
                                </select>
                        </div>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="select_type">Select When to Send Emails</label>
                            <select class="myinput2" onchange="check_type_compaign3(this.value)" name="select_type" id="select_type3">   
                                <option value="On the go">Send Immediately</option>
                                <option value="Scheduled">Send per Schedule Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row"  id="schedule_time_div3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="schedule_date3">Schedule Date</label>
                            <input type="date" class="myinput2" name="schedule_date" id="schedule_date3">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_time3">Schedule Time</label>
                            <input type="text" id="schedule_time3" class="myinput2" name="schedule_time" autocomplete="off" />
                        </div>
                    </div>
                    <input type="hidden" name="contact_type" value='Contact'>
                </div>
                    <br/>
            
                    <button type="button" onclick="submitFormSchedule3(0)" class="btn btn-primary">Save</button>
            <a href="<?=base_url('crmcontrols?block=email_management')?>"><button type="button" class="btn btn-default">Cancel</button></a>
         
            </form>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
            <h6 class="m-0 font-weight-bold text-primary">Send Emails, Individual Contacts, Includes Subscribers & Non-Subscribers</h6>
        </div>
        <div class="card-body">
            <form role="form" id="bulk_emails_form4" method="post" enctype="multipart/form-data"  action="{{ url('emailMarketing') }}/{{$email_template_id}}">
            @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="teaser_title">Select Receiving Contacts</label>
                            <select name="select_contact[]" id="select_contact" class="form_control col-md-12" multiple="true">
                                <option value="test">Test Email</option>
                                    <?php 
                                    foreach($email_lists as $email_list){
                                        $selected = "";
                                        // if(is_email_in_group($contact_group->id, $email_list->id)){
                                        //     $selected = "selected";
                                        // }
                                        
                                        ?>
                                        <option value="<?php echo $email_list->id?>"<?=$selected?> ><?=$email_list->name?></option>
                                        <?php 
                                    }
                                    ?>  
                                </select>
                        </div>
                        </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="select_type">Select When to Send Emails</label>
                            <select class="myinput2" onchange="check_type_compaign4(this.value)" name="select_type" id="select_type4">   
                                <option value="On the go">Send Immediately</option>
                                <option value="Scheduled">Send per Schedule Time</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row"  id="schedule_time_div4">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="schedule_date4">Schedule Date</label>
                            <input type="date" class="myinput2" name="schedule_date" id="schedule_date4">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_time4">Schedule Time</label>
                            <input type="text" id="schedule_time4" class="myinput2" name="schedule_time" autocomplete="off" />
                        </div>
                    </div>
                    <input type="hidden" name="non_subscribers" value='1'>
                    <input type="hidden" name="contact_type" value='Contact'> 
                </div>
                    <br/>
            
            <button type="button" onclick="submitFormSchedule4(0)" class="btn btn-primary">Save</button>
            <a href="<?=base_url('crmcontrols?block=email_management')?>"><button type="button" class="btn btn-default">Cancel</button></a>
          
            </form>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
            <h6 class="m-0 font-weight-bold text-primary">One-Time message from an email address not in contacts</h6>
        </div>
        <div class="card-body">
            <form role="form" id="bulk_emails_form5" method="post" enctype="multipart/form-data" action="{{ url('emailMarketing') }}/{{$email_template_id}}">
            @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="teaser_title">Select Receiving Contacts <span style="font-size:12px;font-weight:bold">(Type email and press 'Enter' for multiple emails )</span></label>
                            <input type="text" onkeyup="parse();" type="text" id="tags_input" class="myinput2 customemail" name="select_contact" placeholder="Enter email addresses" required>
                        </div>
                        <div class="col-sm-6" id="tags">
	                    </div>
                        </div>
                        <input id = "csv_emails" type="hidden" name="csv_emails" value=''>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="select_type">Select When to Send Emails</label>
                            <select class="myinput2" onchange="check_type_compaign5(this.value)" name="select_type" id="select_type5">   
                                <option value="On the go">Send Immediately</option>
                                <option value="Scheduled">Send per Schedule Time</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row"  id="schedule_time_div5">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="schedule_date5">Schedule Date</label>
                            <input type="date" class="myinput2" name="schedule_date" id="schedule_date5">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="schedule_time5">Schedule Time</label>
                            <input type="text" id="schedule_time5" class="myinput2" name="schedule_time" autocomplete="off" />
                        </div>
                    </div>
                    <input type="hidden" name="non_subscribers" value='1'>
                    <input type="hidden" name="contact_type" value='Contact'>
                    <input type="hidden" name="custom_email" value='true'>
                </div>
                    <br/>
            
            <button type="button" onclick="submitFormSchedule5(0)" class="btn btn-primary">Save</button>
            <a href="<?=base_url('crmcontrols?block=email_management')?>"><button type="button" class="btn btn-default">Cancel</button></a>
         
            </form>
        </div>
    </div>
  </div>
  <script>
function submitFormSchedule(notification){
    $("#message_schedule").hide();
    if(notification=='1'){
        $("#bulk_emails_form").append('<input type="hidden" name="notification"  class="pushnotification" value="1">');
    }else{
        $(".pushnotification").remove();
    }
    if($("#select_type").val() == "Scheduled"){
        if($("#schedule_date").val() !="" && $("#schedule_time").val() !=""){
            $("#bulk_emails_form").submit();
        }else{
            $("#message_schedule").show();
        }
    }else{
        $("#bulk_emails_form").submit();
    }
}
check_type_compaign("On the go");
function check_type_compaign(type){
    if(type && type == "Scheduled"){
        $("#schedule_time_div").show();
    }else{
        $("#schedule_time_div").hide();
    }
}


function submitFormSchedule2(notification){
    $("#message_schedule2").hide();
    if(notification=='1'){
        $("#bulk_emails_form").append('<input type="hidden" name="notification"  class="pushnotification" value="1">');
    }else{
        $(".pushnotification").remove();
    }
    if($("#select_type2").val() == "Scheduled"){
        if($("#schedule_date2").val() !="" && $("#schedule_time2").val() !=""){
            $("#bulk_emails_form2").submit();
        }else{
            $("#message_schedule2").show();
        }
    }else{
        $("#bulk_emails_form2").submit();
    }
}

check_type_compaign2("On the go");
function check_type_compaign2(type){
    if(type && type == "Scheduled"){
        $("#schedule_time_div2").show();
    }else{
        $("#schedule_time_div2").hide();
    }
}



function submitFormSchedule3(notification){
    $("#message_schedule3").hide();
    if(notification=='1'){
        $("#bulk_emails_form").append('<input type="hidden" name="notification"  class="pushnotification" value="1">');
    }else{
        $(".pushnotification").remove();
    }
    if($("#select_type3").val() == "Scheduled"){
        if($("#schedule_date3").val() !="" && $("#schedule_time3").val() !=""){
            $("#bulk_emails_form3").submit();
        }else{
            $("#message_schedule3").show();
        }
    }else{
        $("#bulk_emails_form3").submit();
    }
}

check_type_compaign3("On the go");
function check_type_compaign3(type){
    if(type && type == "Scheduled"){
        $("#schedule_time_div3").show();
    }else{
        $("#schedule_time_div3").hide();
    }
}

function submitFormSchedule4(notification){
    $("#message_schedule4").hide();
    if(notification=='1'){
        $("#bulk_emails_form").append('<input type="hidden" name="notification"  class="pushnotification" value="1">');
    }else{
        $(".pushnotification").remove();
    }
    if($("#select_type4").val() == "Scheduled"){
        if($("#schedule_date4").val() !="" && $("#schedule_time4").val() !=""){
            $("#bulk_emails_form4").submit();
        }else{
            $("#message_schedule4").show();
        }
    }else{
        $("#bulk_emails_form4").submit();
    }
}

check_type_compaign4("On the go");
function check_type_compaign4(type){
    if(type && type == "Scheduled"){
        $("#schedule_time_div4").show();
    }else{
        $("#schedule_time_div4").hide();
    }
}

function submitFormSchedule5(notification){
    $("#message_schedule5").hide();
    if(notification=='1'){
        $("#bulk_emails_form").append('<input type="hidden" name="notification"  class="pushnotification" value="1">');
    }else{
        $(".pushnotification").remove();
    }
    var form = document.getElementById("bulk_emails_form5");
    
    // Create FormData object to easily retrieve form data
    var formData = new FormData(form);

    // Display form data (just for demonstration)
    for (var pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    // if(isEmail($(".customemail").val())){
        if($("#select_type5").val() == "Scheduled"){
            if($("#schedule_date5").val() !="" && $("#schedule_time5").val() !=""){
                $("#bulk_emails_form5").submit();
            }else{
                $("#message_schedule5").show();
            }
        }else{
            $("#bulk_emails_form5").submit();
        }
    // }else{
    //     $("#message_schedule5").show();
    // }
}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

check_type_compaign5("On the go");
function check_type_compaign5(type){
    if(type && type == "Scheduled"){
        $("#schedule_time_div5").show();
    }else{
        $("#schedule_time_div5").hide();
    }
}
$(document).ready(function() {
    $('#selected_group').select2(
        {
            placeholder: 'Click to Search & Select',
            allowClear: true
        }
    );
});
$(document).ready(function() {
    $('#select_group').select2(
        {
            placeholder: 'Click to Search & Select',
  allowClear: true
        }
    );
});
$(document).ready(function() {
    $('#selected_contact').select2(
        {
            placeholder: 'Click to Search & Select',
  allowClear: true
        }
    );
});
$(document).ready(function() {
        jQuery('#schedule_time, #schedule_time2, #schedule_time3, #schedule_time4, #schedule_time5').timepicker({});
    $('#select_contact').select2(
        {
            placeholder: 'Click to Search & Select',
  allowClear: true
        }
    );
});
</script>
@endsection('content')