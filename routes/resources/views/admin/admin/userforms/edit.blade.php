@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Response Edit</h1>
            <ol class="breadcrumb">
                <li>
                <a href="{{ url('forms?block='.((isset($block) && $block)? $block :'custom_forms_responses_list')) }}" class="btn btn-info " >
                    Back
                </a>
                </li>
            </ol>
        </div>
        <div class="card mb-4 card-border">
            <div class="card-body">
            <form action="<?= base_url('updateresponse?block='.((isset($block) && $block)? $block :'')) ?>" method="post" enctype="multipart/form-data" role="form" class="php-email-form no-box-shadow p-0">
                @csrf
                <input type="hidden" name="record_id" value="{{$formdata->id}}">
                <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h1 class="text-black m-0"><?=$formdata->form_name?></h1>
                </div>
                </div>
                <br><br>
                <?php $form_fields = json_decode($form_detail->fields);
                $feilds_data = json_decode($formdata->fields_data,true); 
                $feildsdata = array();
                
                
                if(is_array($feilds_data)){
                    foreach($feilds_data as $key=>$value){
                        if(is_array($value)){
                            foreach($value as $value2){
                                $feildsdata[strtolower($key)][] = trim($value2,'<br>');
                            }
                        }else{
                            $feildsdata[strtolower($key)] = trim($value,'<br>');
                        }
                    }
                }
                
                $i = 0; ?>
                <?php foreach ($form_fields as $sngl) { 
                $otherfield = true; ?>
                <?php if (isset($sngl->formenable) && $sngl->formenable == '1') { ?>
                    <?php if ($sngl->fieldtype == 'text') { ?>
                        <div class="col form-group mb-10">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <input type="<?=strtolower($sngl->fieldname)=='email'?'email':'text'?>" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" value="<?=isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>"/>
                        <div class="validate"></div>
                        </div>
                    <?php } elseif ($sngl->fieldtype == 'radio') { ?>
                        <div class="col form-group mb-10">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <div class="row">
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <?php if(is_array($singleop) || is_object($singleop)){ ?>
                                    <div class="col-md-12">
                                        <input type="radio" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" 
                                    <?php echo $checked; $checked='';?> value="<?=strtolower($singleop->option_name)?>" class="inputchange" 
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && trim($feildsdata[strtolower($sngl->fieldname)],'<br>')==strtolower($singleop->option_name)){
                                        echo 'checked';
                                        $otherfield = false;
                                        } ?>
                                        /> <?=$singleop->option_name?><br>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-md-12">
                                        <input type="radio" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" <?php echo $checked; $checked='';?> value="<?=strtolower($singleop)?>" class="inputchange" 
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && trim($feildsdata[strtolower($sngl->fieldname)],'<br>')==strtolower($singleop)){
                                        echo 'checked';
                                        $otherfield = false;
                                        } ?>
                                        /> <?=$singleop?><br>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="col-md-12">
                                <input type="radio" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" value="other" class="inputchange"  <?=$otherfield ?'checked':''?>/> Other<br>
                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>txto" class="myinput2 textinput" id="name" placeholder="Write" value="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>" style="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?'display:block;':'display:none;'?>">
                            </div>
                        </div>
                        <div class="validate"></div>
                        </div>
                    <?php }elseif ($sngl->fieldtype == 'checkbox') { ?>
                        <div class="col form-group mb-10">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <div class="row">
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <?php if(is_array($singleop) || is_object($singleop)){ ?>
                                    <div class="col-md-12">
                                        <label><input type="checkbox" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]"  value="<?=strtolower($singleop->option_name)?>" class="inputchange"   
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && in_array(strtolower($singleop->option_name),explode('<br>',$feildsdata[strtolower($sngl->fieldname)]))){
                                        echo 'checked';
                                        $otherfield = false;
                                        } ?>
                                        /> <?=$singleop->option_name?></label><br>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-md-12">
                                        <label><input type="checkbox" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]"  value="<?=strtolower($singleop)?>" class="inputchange"   
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && in_array(strtolower($singleop),explode('<br>',$feildsdata[strtolower($sngl->fieldname)]))){
                                        echo 'checked';
                                        $otherfield = false;
                                        } ?>
                                        /> <?=$singleop?></label><br>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="col-md-12">
                                <input type="checkbox" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" value="other" class="inputchange" <?=$otherfield ?'checked':''?>/> Other<br>
                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>txto" class="myinput2 textinput" id="name" placeholder="Write" value="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>" style="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?'display:block;':'display:none;'?>">
                            </div>
                        </div>
                        <div class="validate"></div>
                        </div>
                    <?php }elseif ($sngl->fieldtype == 'select') { ?>
                        <div class="col form-group mb-10">
                            <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                            <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2 inputchange">
                                <?php $checked='checked';foreach($sngl->options as $singleop){ //print_r($singleop);die();?>
                                    <?php if(is_array($singleop) || is_object($singleop)){ ?>
                                        <option value="<?=strtolower($singleop->option_name)?>" 
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && trim($feildsdata[strtolower($sngl->fieldname)],'<br>')==strtolower($singleop->option_name)){
                                        echo 'selected';
                                        $otherfield = false;
                                        } ?>
                                        > <?=$singleop->option_name?></option>
                                    <?php }else{ ?>
                                        <option value="<?=strtolower($singleop)?>" 
                                        <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && trim($feildsdata[strtolower($sngl->fieldname)],'<br>')==strtolower($singleop)){
                                        echo 'selected';
                                        $otherfield = false;
                                        } ?>
                                        > <?=$singleop?></option>
                                    <?php } ?>
                                <?php } ?>
                                <option value="other" <?=$otherfield ?'selected':''?>> Other</option>
                            </select>
                            <div class="col-md-12">
                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>txto" class="myinput2 textinput" id="name" placeholder="Write" value="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>" style="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?'display:block;':'display:none;'?>">
                            </div>
                        <div class="validate"></div>
                        </div>
                    <?php }elseif ($sngl->fieldtype == 'multiselect') { ?>
                        <div class="col form-group mb-10">
                            <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                            <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="myinput2 inputchange h-auto" multiple>
                                <?php $checked='checked'; foreach($sngl->options as $singleop){ ?>
                                    <?php if(is_array($singleop) || is_object($singleop)){ ?>
                                    <option value="<?=strtolower($singleop->option_name)?>" 
                                    <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && in_array(strtolower($singleop->option_name),explode('<br>',$feildsdata[strtolower($sngl->fieldname)]))){
                                        echo 'selected';
                                        $otherfield = false;
                                        } ?>
                                        > <?=$singleop->option_name?></option>
                                    <?php }else{ ?>
                                    <option value="<?=strtolower($singleop)?>" 
                                    <?php if(isset($feildsdata[strtolower($sngl->fieldname)]) && in_array(strtolower($singleop), is_array($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:explode('<br>',$feildsdata[strtolower($sngl->fieldname)]))){
                                        echo 'selected';
                                        $otherfield = false;
                                        } ?>
                                        > <?=$singleop?></option>
                                    <?php } ?>
                                <?php } ?>
                                <option value="other" <?=$otherfield ?'selected':''?>> Other</option>
                            </select>
                            <div class="col-md-12">
                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>txto" class="myinput2 textinput" id="name" placeholder="Write" value="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>" style="<?=$otherfield && isset($feildsdata[strtolower($sngl->fieldname)])?'display:block;':'display:none;'?>">
                            </div>
                        <div class="validate"></div>
                        </div>
                    <?php }elseif ($sngl->fieldtype == 'date') { ?>
                        <div class="col form-group mb-10">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <input type="date" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" value="<?=isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>"/>
                        <div class="validate"></div>
                        </div>
                    <?php }elseif ($sngl->fieldtype == 'time') { ?>
                        <div class="col form-group mb-10 position-reletive">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2 newtime" id="name" placeholder="<?= $sngl->fieldname ?>"  value="<?=isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>"/>
                        
                        <i class="fa fa-clock-o top-right" aria-hidden="true"></i>
                        <input type="time" class="ontimechange timepicker" onclick="this.showPicker()"  value="<?=isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?>">
                        <div class="validate"></div>
                        </div>
                    <?php } elseif ($sngl->fieldtype == 'textarea') { ?>
                        <div class="form-group mb-10">
                        <label><b><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                        <textarea class="myinput2" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" placeholder="<?= $sngl->fieldname ?>"> <?=isset($feildsdata[strtolower($sngl->fieldname)])?$feildsdata[strtolower($sngl->fieldname)]:''?></textarea>
                        <div class="validate"></div>
                        </div>
                    <?php }  elseif ($sngl->fieldtype == 'file')  { ?>
                        <div class="col form-group mb-10">
                            <label><b><?=$sngl->fieldname?></b></label><br>
                        <input type="file" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="" id="file" placeholder="<?= $sngl->fieldname ?>" />
                            <?php if(isset($feildsdata['files'][strtolower(str_replace(' ', '_', $sngl->fieldname))])){ ?>
                                <input type="hidden" name="old_<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" value="<?=$feildsdata['files'][strtolower(str_replace(' ', '_', $sngl->fieldname))]?>" />
                            <center>
                                <br>
                                <img src="<?=base_url('assets/uploads/'.get_current_url().$feildsdata['files'][strtolower(str_replace(' ', '_', $sngl->fieldname))])?>" width="50%"  class="img-responsive mb-10 img-max-width"> 
                            </center>
                            <?php } ?>
                        </div>
                    <?php }  elseif ($sngl->fieldtype == 'image')  { ?>
                        <div class="col form-group mb-10">
                            <center>
                                <img src="<?=isset($sngl->image)?base_url('assets/uploads/'.get_current_url().$sngl->image):''?>" width="50%"  class="img-responsive mb-10 img-max-width"> 
                                <p><?=$sngl->image_desc?></p>
                            </center>
                        </div>
                    <?php }  elseif ($sngl->fieldtype == 'comment_only')  { ?>
                        <div class="col form-group mb-10">
                        <label><b><?=$sngl->fieldname?>:</b></label>
                        <p><?=isset($sngl->comment_desc)?$sngl->comment_desc:''?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php $i++;
                } ?>
                
                <div class="row  make-sticky">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?=base_url($controller.'?block='.(isset($block)? $block :'custom_forms_responses_list'))?>"><button type="button" class="btn btn-default">Cancel</button></a>
                    </div>
                </div>
            </form>
        </div>
        </div>
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