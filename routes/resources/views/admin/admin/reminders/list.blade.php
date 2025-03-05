@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=$controller_name?></h1>
    <ol class="breadcrumb">
        <li>
            <button onclick="history.go(-1)" class="btn btn-info back-btn" >
                Back
            </button>
        </li>
    </ol>
    </div>

    <div class="row">
    <div class="col-lg-12 mb-4">
            <div class="row">
              <div class="col-md-12">
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                    id="#modalCenter" class="btn btn-sm btn-primary btnaddreminder">Add <?=$controller_name?></button>
              </div>
            </div>
            <br>
     
       
        <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?=$controller_name?></h6>
        </div>
        
        <div class="row" style="    padding: 10px;">
            <?php $items= $listing->items();  if($items){?>
                <?php $i=0; foreach($items as $row){ ?>
                <div class="col-md-4 mb-4 reminderdiv">
                    <div class="singlereminder">
                        <div class="editdiv">
                            <i class="fa fa-pencil btneditreminder" data-id="<?=$row->id?>"  data-toggle="modal" data-target="#exampleModalCenter" id="#modalCenter"></i>
                            <i class="fa fa-trash btndelreminder" data-id="<?=$row->id?>"></i>
                        </div>
                        <label><?=$row->title?></label><br>
                        <label><?=$row->message?></label><br>
                        <?php if($row->type=='1'){ 
                            $utc = getTimeZone($siteSettings->timezone);
                            $now = new DateTime("now", new DateTimeZone("$utc"));
                            $future_date = new DateTime($row->datetime,new DateTimeZone("$utc"));
                            //echo $now->format('m-d H:i:s').' - ';
                            if($now<$future_date){
                                $interval = $future_date->diff($now);
                                $interval = $interval->format("%a days, %h hours, %i minutes");
                            }else{
                                 $interval = "0 days, 0 hours, 0 minutes";
                            }
                        ?>
                            <label><?=$interval?></label>
                        <?php }else{ ?>
                            <label><?=$row->datetime?></label>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php }else{ ?>
            <h3>No record found</h3>
        <?php } ?>
        </div>
        <div class='row'>
            <div class="col-md-12" align='center'>
                @if($listing)
                    {{ $listing->links() }}
                @endif
            </div>
        </div>
        <div class="card-footer"></div>
        </div>
    </div>
    </div>
    <!--Row-->
</div>
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Add Reminder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modalcontent">
            
        </div>
      </div>
    </div>
  </div>
<script>
    $( document ).ready(function() {
        $(document).on("click",".btnaddreminder", function(){
            $.ajax({
                url: '<?=url('reminders/add')?>',
                type: "POST",
                data:{ _token: "{{ csrf_token() }}"},
                success: function(data){
                  $('.modalcontent').html(data);
                }
            });
        });
        $(document).on("click",".btneditreminder", function(){
            var id = $(this).data('id');
            $.ajax({
                url: '<?=url('reminders/edit')?>'+'/'+id,
                type: "POST",
                data:{ _token: "{{ csrf_token() }}"},
                success: function(data){
                  $('.modalcontent').html(data);
                }
            });
        });
        $(document).on("click",".btndelreminder", function(){
            var id = $(this).data('id');
            if(!(confirm('Are You sure?'))){
                return;
            }
            $(this).closest('.reminderdiv').remove();
            $.ajax({
                url: '<?=url('reminders/delete')?>'+'/'+id,
                type: "POST",
                data:{ _token: "{{ csrf_token() }}"},
                success: function(data){
                    
                }
            });
        });
    });
</script>
@endsection('content')