<div class="row">
    <div class="col-lg-12">
              <!-- Form Basic -->
                  <form role="form" method="post" enctype="multipart/form-data" action="<?=url('reminders/edit/'.$row_id)?>">
                  @csrf  
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" id="title" value="<?php echo $detail_info->title;?>" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea name="message" class="form-control" id="message" rows="5" required><?php echo $detail_info->message;?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Type</label><br>
                      <label><input type="radio" class="remindertype" name="type" value="0" <?php if($detail_info->type=='0'){ echo 'checked';}?>> Date time</label><br>
                      <label><input type="radio" class="remindertype" name="type" value="1" <?php if($detail_info->type=='1'){ echo 'checked';}?>> Manually</label><br>
                    </div>
                    <div class="row nopadding datetimediv">
                        <div class="col-md-6 nopadding">
                            <div class="form-group">
                              <label for="date">Date</label>
                              <input type="date" name="date" class="form-control" id="date" value="<?php echo date('Y-m-d',strtotime($detail_info->datetime));?>">
                            </div>
                        </div>
                        <div class="col-md-6 nopadding">
                            <div class="form-group">
                              <label for="time">Time</label>
                              <input type="time" name="time" class="form-control" id="time" value="<?php echo date('H:i:s',strtotime($detail_info->datetime));?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group timeinmin">
                      <label for="timeinmin">Time in minutes </label>
                      <input type="number" name="timeinmin" class="form-control" id="timeinmin" value="<?php 
                            date_default_timezone_set(getTimeZone($siteSettings->timezone));
                          $start = strtotime(date('H:i:s'));
                          $stop = strtotime(date('H:i:s',strtotime($detail_info->datetime)));
                          if($start<$stop){
                              $diff = ($stop - $start); //Diff in seconds
                              echo intval($diff/60);
                          }else{
                            echo '0';
                          }?>">
                    </div>
                    <div class="row nopadding">
                        <div class="col-md-12 nopadding" align="center">
                            <button type="submit" name='edit-reminder' class="btn btn-primary">Save</button>
                        </div>
                    </div>
                  </form>
            </div>
    </div>
    <!--Row-->
<script>
    $( document ).ready(function() {
        <?php if($detail_info->type=='1'){ ?>
                $('.datetimediv').hide();
                $('.timeinmin').show();
        <?php }else{ ?>
                $('.datetimediv').show();
                $('.timeinmin').hide();
        <?php } ?>
        $(document).on("click",".remindertype", function(){
            var thisval = $(this).val();
            if(thisval=='1'){
                $('.datetimediv').hide();
                $('.timeinmin').show();
            }else{
                $('.datetimediv').show();
                $('.timeinmin').hide();
            }
        });
    });
</script>