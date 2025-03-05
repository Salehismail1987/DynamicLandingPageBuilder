@extends('admin.layout.dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Send Teaser Notification</h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>" class="btn btn-info " >
                Back
            </a>
        </li>
    </ol>
    </div>

   
    <div class="row">
        <div class="col-lg-10">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Group Emails</h3>
                    <h6 class="m-0 font-weight-bold text-primary">Send Emails, Groups Include Only Subscribers</h6>
                </div>
                <div class="card-body">
                    <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data" action="<?php echo url('send_notification/'.$newsfeed_id)?>">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title_text">Teaser Title Text</label>
                                    <input type="text" class="form-control" name="teaser_title_text" id="teaser_title_text" placeholder="Enter Title Text..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select_group">Select Receiving Contact Group</label>
                                    <select class="form-control" name="select_group" id="selected_group">
                                        <option value="test">Test Email</option>
                                        <option value="all">Master Group</option>
                                        <?php
                                        if(isset($contact_groups)){
                                            foreach($contact_groups as $group){
                                            ?>
                                                <option value="<?php echo $group->id?>"><?=$group->group_name?></option>                                                
                                            <?php 
                                            }
                                        } 
                                        ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                        <input type="hidden" name="non_subscribers" value='1'>  
                        <br>   
                    <button type="submit" name="send_email" class="btn btn-primary">Send</button>
                    <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Group Emails</h3>
                    <h6 class="m-0 font-weight-bold text-primary">Send Emails, Groups, Includes Subscribers & Non-Subscribers</h6>
                </div>
                <div class="card-body">
                    <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data" action="<?php echo url('send_notification/'.$newsfeed_id)?>">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title_text">Teaser Title Text</label>
                                    <input type="text" class="form-control" name="teaser_title_text" id="teaser_title_text" placeholder="Enter Title Text..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select_group">Select Receiving Contact Group</label>
                                    <select class="form-control" name="select_group" id="selected_group">
                                        <option value="test">Test Email</option>
                                        <option value="all">Master Group</option>
                                        <?php
                                        if(isset($contact_groups)){
                                            foreach($contact_groups as $group){
                                            ?>
                                                <option value="<?php echo $group->id?>"><?=$group->group_name?></option>                                                
                                            <?php 
                                            }
                                        } 
                                        ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                        <br>   
                    <button type="submit"  name="send_email" class="btn btn-primary">Send</button>
                    <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
                    <h6 class="m-0 font-weight-bold text-primary">Send Emails, Individual Contacts, Includes Only Subscribers</h6>
                </div>
                <div class="card-body">
                    <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data" action="<?php echo url('send_notification/'.$newsfeed_id)?>">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title_text">Teaser Title Text</label>
                                    <input type="text" class="form-control" name="teaser_title_text" id="teaser_title_text" placeholder="Enter Title Text..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select_group">Select Receiving Contact</label>
                                    <select class="form-control" name="select_contact[]" id="selected_contact" multiple>
                                        <option value="test">Test Email</option>
                                        <option value="all">Master Group</option>
                                        <?php
                                        if(isset($email_lists_Subscribers)){
                                            foreach($email_lists_Subscribers as $email_list){
                                            ?>
                                                <option value="<?php echo $email_list->id?>"><?=$email_list->name?></option>                                                
                                            <?php 
                                            }
                                        } 
                                        ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                        <br>           
                        <button type="submit" name="send_email" class="btn btn-primary">Send</button>
                        <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
                    <h6 class="m-0 font-weight-bold text-primary">Send Emails, Individual Contacts, Includes Subscribers & Non-Subscribers</h6>
                </div>
                <div class="card-body">
                    <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data" action="<?php echo url('send_notification/'.$newsfeed_id)?>">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title_text">Teaser Title Text</label>
                                    <input type="text" class="form-control" name="teaser_title_text" id="teaser_title_text" placeholder="Enter Title Text..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select_group">Select Receiving Contact</label>
                                    <select class="form-control" name="select_contact[]" id="selected_contact2" multiple>
                                        <option value="test">Test Email</option>
                                        <?php
                                        if(isset($contact_groups)){
                                            foreach($email_lists as $email_list){
                                            ?>
                                                <option value="<?php echo $email_list->id?>"><?=$email_list->name?></option>                                                
                                            <?php 
                                            }
                                        } 
                                        ?>
                                    </select>
                                </div>
                             </div>
                        </div>
                        <input type="hidden" name="non_subscribers" value='1'> 
                        <br>   
                        <button type="submit" name="send_email" class="btn btn-primary">Send</button>
                        <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary">Individual Emails</h3>
                    <h6 class="m-0 font-weight-bold text-primary">One-Time message from an email address not in contacts</h6>
                </div>
                <div class="card-body">
                    <form role="form" id="bulk_emails_form" method="post" enctype="multipart/form-data" action="<?php echo url('send_notification/'.$newsfeed_id)?>">
                    @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title_text">Teaser Title Text</label>
                                    <input type="text" class="form-control" name="teaser_title_text" id="teaser_title_text" placeholder="Enter Title Text..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="teaser_title">Select Receiving Contacts</label>
                                    <input type="email" class="form-control customemail" name="custom_email" placeholder="Enter email address" required>
                                </div>
                             </div>
                        </div>
                        <br>   
                        <input type="hidden" name="select_contact" value='1'>        
                        <button type="submit" name="send_email" class="btn btn-primary">Send</button>
                        <a href="<?=url('quicksettings?block=newsfeed_bluebar')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>
<script>

$(document).ready(function() {
    $('#selected_contact').select2(
        {
            placeholder: 'Click to Search & Select',
            allowClear: true
        }
    );
    $('#selected_contact2').select2(
        {
            placeholder: 'Click to Search & Select',
            allowClear: true
        }
    );
});

</script>
@endsection('content')