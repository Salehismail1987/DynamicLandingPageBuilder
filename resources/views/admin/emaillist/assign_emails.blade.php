@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assign Emails</h1>
        <a href="{{ url('crmcontrols?block=contact_groups') }}" class="btn btn-info " >
            Back
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
              
                <div class="card-body">
                    <div class="row" >
                        <div class=" col-md-12"  >
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between;padding:0px !important;">
                                <h6 class="m-0 font-weight-bold text-primary">Assign Contacts to a Contact Group</h6>
                            </div>
                            <form role="form" method="post" enctype="multipart/form-data" >
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-3">
                                        <label for="name">Search by Name</label>
                                        <input type="text" class="myinput2" name="contact" id="contact" value="" placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">Search by Email</label>
                                        <input type="text" class="myinput2" name="email" id="email" value="" placeholder="Enter Email Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Custom Search</label>
                                        <input type="text" class="myinput2" name="custome_search" id="custome_search" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            </br>
                            <center class="mb-2 mt-1">
                                <button type="button" class="btn btn-info" onclick="search()">Search</button>
                                <button type="button" class="btn btn-info" onclick="refresh()">Refresh</button>
                            </center>
                        </div>
                    </div></br>
                        <div class="table-responsive tableHeadSticky"> <!-- (Hassan) Assign custom sticky header Class and remove inline styling -->
                            <table id='emaillistTable' class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                <th><input name="select_all" value="1" type="checkbox"></th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <!-- <th>Gender</th>
                                    <th>Age</th>
                                    <th>City</th> -->
                                </tr>
                                </thead>
                                <tbody id="emaillistTableData">
                                
                                </tbody>
                            </table>
                            </br>
                        </div>
                        </div>
                            <center>
                                    <button type="button" class="btn btn-info" onclick="assignEmailToGroup()">Assign Emails</button>
                                    <a href="<?=url('crmcontrols?block=contact_groups')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                            <center>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-md-12"  style="padding:0px">
                                <p>Note:<br>
                                    Click one or more Check Boxes to Select Contacts.
                                </p>
                                <p>
                                    To Search, Type the Name, Email, City, or Age Limit and Click on Search the Results will Appear in the Table.
                                </p>
                                <p>
                                    For Age Search One Must have to Input Both Upper and Lower Limit.
                                </p>
                                <p>
                                    After Selection Click on Submit Button to Assign Selected Contacts to Group.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
var dataTable = document.getElementById('emaillistTable');
var checkItAll = dataTable.querySelector('input[name="select_all"]');

    function assignEmailToGroup(){
var tableBody = document.getElementById('emaillistTableData');
var inputs = tableBody.querySelectorAll('tbody>tr>td>input');
        var rows = [];
      if(inputs){
        inputs.forEach(function(input) {
        if(input.checked == true){
          rows.push($(input).val());
        }
      });
      }
        var full_url = document.URL;
        var url_array = full_url.split('/');
        var last_segment = url_array[url_array.length-1];
        console.log(rows);
        $.ajax({
            type: "post",
            url: "<?php echo url('assignEmailsAjax'); ?>/"+last_segment,
            data: {rows: rows,  _token: "{{ csrf_token() }}"},
            error: function (res) {
                alert("error");
            },
            success: function(res) {
                window.location="{{url('/')}}/crmcontrols?sec=contact_groups" ;
            }
        });
    };

$(document).ready(function () {
    $.ajax({
        type: "post",
        data:{'groupid':'<?=$catID?>', _token: "{{ csrf_token() }}"},
        url: "<?php echo url('getDataFromDB'); ?>",
        success: function(data) {
           
            $('#emaillistTableData').append(data);
         
        }  
    });
            });

            function refresh(){
                $.ajax({
        type: "post",
        data:{'groupid':'<?=$catID?>', _token: "{{ csrf_token() }}"},
        url: "<?php echo url('getDataFromDB'); ?>",
        success: function(data) {
            $('#emaillistTableData').html(data);
           
    }
    });
            }
            
         


checkItAll.addEventListener('change', function() {
var tableBody = document.getElementById('emaillistTableData');
var inputs = tableBody.querySelectorAll('tbody>tr>td>input');
  if (checkItAll.checked) {
    inputs.forEach(function(input) {
      input.checked = true;
    });  
      all = "all";
  }else{
      inputs.forEach(function(input) {
      input.checked = false;
    });  
      all = "";
  }
});

    function search(){
    var contact = $("#contact").val();
    var email = $("#email").val();
    var custome_search = $("#custome_search").val();

        if(contact!=""){
            $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "<?php echo url('getContactData'); ?>",
                        data: {contact:contact, _token: "{{ csrf_token() }}"},
                        error: function (data) {
                    },
                        success: function(data) {
                            _html = '</table>';
                            document.getElementById('emaillistTableData').innerHTML = _html;
                            $.each(data, function(key, value){
                            var html = '<tr>';
                            html += '<td><input type="checkbox" value="'+ value.id +'" id="checkrow" name="checkrow" multiple="true" /></td>';
                            html += '<td>'+ value.name +'</td>';
                            html += '<td>'+ value.email_address +'</td>';
                            // html += '<td>'+ value.gender +'</td>';
                            // html += '<td>'+ value.age +'</td>';
                            // html += '<td>'+ value.city +'</td>';
                            $('#emaillistTableData').append(html);
                        })
                        }
                    });
        }
        else if(email!=""){
            $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "<?php echo url('getEmailData'); ?>",
                        data: {email:email, _token: "{{ csrf_token() }}"},
                        error: function (data) {
                    },
                        success: function(data) {
                            _html = '</table>';
                            document.getElementById('emaillistTableData').innerHTML = _html;
                            $.each(data, function(key, value){
                            var html = '<tr>';
                            html += '<td><input type="checkbox" value="'+ value.id +'" id="checkrow" name="checkrow" multiple="true" /></td>';
                            html += '<td>'+ value.name +'</td>';
                            html += '<td>'+ value.email_address +'</td>';
                            // html += '<td>'+ value.gender +'</td>';
                            // html += '<td>'+ value.age +'</td>';
                            // html += '<td>'+ value.city +'</td>';
                            $('#emaillistTableData').append(html);
                        })
                        }
                    });
                }
        else if(custome_search!=""){
            $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "<?php echo url('getCustomeSearchData'); ?>",
                        data: {custome_search:custome_search ,_token: "{{ csrf_token() }}"},
                        error: function (data) {
                    },
                        success: function(data) {
                            _html = '</table>';
                            document.getElementById('emaillistTableData').innerHTML = _html;
                            $.each(data, function(key, value){
                            var html = '<tr>';
                            html += '<td><input type="checkbox" value="'+ value.id +'" id="checkrow" name="checkrow" multiple="true" /></td>';
                            html += '<td>'+ value.name +'</td>';
                            html += '<td>'+ value.email_address +'</td>';
                            // html += '<td>'+ value.gender +'</td>';
                            // html += '<td>'+ value.age +'</td>';
                            // html += '<td>'+ value.city +'</td>';
                            $('#emaillistTableData').append(html);
                        })
                        }
                    });
        }
}
</script>
@endsection('content')
