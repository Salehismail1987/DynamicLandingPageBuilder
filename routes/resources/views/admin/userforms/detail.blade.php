@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Response Detail</h1>
            <ol class="breadcrumb">
                <li>
                <a href="#" onclick="window.history.back();" class="btn btn-info " >
                    Back
                </a>
                </li>
            </ol>
        </div>
        
        <div class="card mb-4 card-border">
            <div class="card-body card-body-padding-border">
              <div class="d-flex justify-content-between align-items-center">
                <div class="">
                  <div class="subheading">Response cannot be edited</div>
                  <h3 class="text-black m-0"><?=$formdata->form_name?></h3>
                </div>
                @if (false)
                    <button type="button" class="btn btn-sm btn-primary mb-10" data-toggle="modal" data-target="#modalcustomforms<?=getCustomformEncodedID($formdata->form_id)?>">Open Form</button>
                @endif
            </div>
          </div>
        </div>
        <?php if($formdata){ ?>
            <?php $form_feilds = json_decode($formdata->fields_data) ?>
              <?php if($form_feilds){ ?>
                <?php foreach($form_feilds as $key=>$value){ ?>
                      <?php if($key!='files' && $key!='Otp'){ ?>
                      <div class="card mb-4">
                          <div class="card-body card-body-padding-border">
                            <div class="mb-10"><b class=""><?=str_replace('_',' ',$key)?></b></div>
                            <div class="underline">
                              <?php 
                              if(is_array($value)){
                                foreach($value as $sg){
                                  if (DateTime::createFromFormat('Y-m-d', $sg) !== false) {
                                    echo date('m/d/Y',strtotime($sg));
                                  }else{
                                    print_r($sg);
                                  }
                                }
                              }else{
                                
                                if (DateTime::createFromFormat('Y-m-d', $value) !== false) {
                                  echo date('m/d/Y',strtotime($value));
                                }else{
                                  print_r($value);
                                }
                              }
                              ?>
                            </div>
                        </div>
                      </div>
                <?php } ?>
              <?php } ?>
            <?php } ?>
        <?php } ?>
              
        <?php if(isset($form_feilds->files)){ ?>
              <?php if($formdata){ ?>
                  <?php $form_feilds = json_decode($formdata->fields_data) ?>
                  <?php foreach($form_feilds->files as $key=>$value){ ?>
                  <div class="card mb-4">
                    <div class="card-body card-body-padding-border 2">
                      <div class="row">
                        <div class="col-md-12">
                        <b class=""><?= preg_replace('/\d+$/', '', str_replace('_', ' ', $key)) ?></b>
                          <a href="<?=base_url('assets/uploads').'/'.get_current_url().$value?>" target="_blank"><?=base_url('assets/uploads').'/'.$value?></a>
                          <a href="<?=base_url('assets/uploads/').'/'.get_current_url().$value?>" class="btn btn-sm btn-primary" download>Download</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
            <?php }else{ ?>
                  <div class="card mb-4">
                    <div class="card-body card-body-padding-border 2">
                      <div class="row">
                        <div class="col-md-12">
                          <h3 class="text-center">No Record Found</h3>
                        </div>
                      </div>
                    </div>
                  </div>
            <?php } ?>
        <?php } ?>
              
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on("change",".inputchange",function() {
            var value = $(this).val();
            if(value=='other'){
                $(this).closest('.form-group').find('.textinput').show('slow');
            }else{
                $(this).closest('.form-group').find('.textinput').hide('slow');
            }
        });
        $(document).on("change",".newtime",function() {
            $(".ontimechange").trigger('click');
        });
        $(document).on("change",".ontimechange",function() {
            var value = $(this).val();
            var timeSplit = value.split(':'),
                hours,
                minutes,
                meridian;
            hours = timeSplit[0];
            minutes = timeSplit[1];
            if (hours > 12) {
                meridian = 'PM';
                hours -= 12;
            } else if (hours < 12) {
                meridian = 'AM';
                if (hours == 0) {
                hours = 12;
                }
            } else {
                meridian = 'PM';
            }
            if(hours<10){
                hours = hours.toString().replace(/^0+/, '');
            }
            $('.newtime').val(hours + ':' + minutes + ' ' + meridian);
        });
    });
</script>
@endsection('content')