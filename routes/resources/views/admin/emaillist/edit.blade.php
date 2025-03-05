@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Contact</h1>
    <a href="{{ url('crmcontrols?block=contacts') }}" class="btn btn-info " >
        Back
    </a>
    </div>
    <div class="row">
      
      <div class="col-lg-6">
          @if($errors->has('email'))
              <div class="alert alert-danger">{{ $errors->first('email') }}</div>
              <br/>
          @endif
          <!-- Form Basic -->
          <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Email List</h6>
              </div>
              <div class="card-body">
                <form role="form" method="post" enctype="multipart/form-data" action="<?php echo  url('updateContact') ?>/{{$catID}}">
                @csrf
                    <div class="form-group">
                        <label for="name">Contact Name</label>
                        <input type="text" name="name" class="myinput2" id="name" value="<?php if($errors->any()) echo old('name'); else echo $detail_info->name;?>" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" required class="myinput2" id="email_address" value="<?php if($errors->any()) echo old('email_address'); else echo $detail_info->email_address;?>" placeholder="Email">
                    </div>
                    <?php $userdata = array();
                      $userdatatmp = json_decode($detail_info->fields,true);
                      if(is_array($userdatatmp)){
                        foreach($userdatatmp as $key=>$single){
                          $userdata[strtolower(str_replace(' ', '_', $key))] = $single;
                        }
                      }
                    ?>
                      <?php if ($contact_database->fields) { ?>
                        <?php $form_fields = json_decode($contact_database->fields);
                        $i = 0; ?>
                        <?php foreach ($form_fields as $sngl) { if($i<2){$i++;continue;}?>
                        <?php if ($sngl->fieldtype == 'text') { ?>
                            <div class="form-group">
                              <label for=""><?=$sngl->fieldname?></label>
                            <input type="text" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>"  class="myinput2" id="name" value="<?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))])?$userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]:''?>" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" />
                            <div class="validate"></div>
                            </div>
                        <?php } elseif ($sngl->fieldtype == 'radio') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?></label><br>
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <input type="radio" 
                                name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" <?php echo $checked; $checked='';?> 
                                value="<?=$singleop?>" <?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]) && $userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]==strtolower($singleop)?'checked':''?>/> <?=$singleop?><br>
                            <?php } ?>
                            <div class="validate"></div>
                            </div>
                        <?php } elseif ($sngl->fieldtype == 'checkbox') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?></label><br>
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <input type="checkbox" 
                                name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" <?php echo $checked; $checked='';?> 
                                value="<?=$singleop?>" <?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]) && $userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]==strtolower($singleop)?'checked':''?>/> <?=$singleop?><br>
                            <?php } ?>
                            <div class="validate"></div>
                            </div>
                        <?php }elseif ($sngl->fieldtype == 'multiselect') { ?>
                            <div class="form-group">
                                <label><?=$sngl->fieldname?></label><br>
                                <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="myinput2 inputchange" multiple>
                                    <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                        <option value="<?=strtolower($singleop)?>" <?=(isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]) && is_array($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]) && in_array(strtolower($singleop),$userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]))?'selected':''?>> <?=$singleop?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }elseif ($sngl->fieldtype == 'select') { ?>
                            <div class="form-group">
                                <label><?=$sngl->fieldname?></label><br>
                                <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2 inputchange">
                                    <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                        <option value="<?=strtolower($singleop)?>" <?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]) && $userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]==strtolower($singleop)?'selected':''?>> <?=$singleop?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } elseif ($sngl->fieldtype == 'textarea') { ?>
                            <div class="form-group">
                            <label for=""><?=$sngl->fieldname?></label>
                            <textarea class="myinput2" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" placeholder="<?= $sngl->fieldname ?>"><?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))])?$userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]:''?></textarea>
                            <div class="validate"></div>
                            </div>
                        
                          <?php }elseif ($sngl->fieldtype == 'date') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></label><br>
                            <input type="date" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" value="<?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))])?$userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]:''?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" <?= ($sngl->required) ? 'required' : '' ?>/>
                            <div class="validate"></div>
                            </div>
                        <?php }  elseif ($sngl->fieldtype == 'file')  { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></label><br>
                            <input style="padding-bottom: 40px;" type="file" <?= ($sngl->required) ? 'required' : '' ?> name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="file" placeholder="<?= $sngl->fieldname ?>" />
                            </div>
                            <?php if(isset($userdata['files'][strtolower(str_replace(' ', '_', $sngl->fieldname))])) { ?>
                              <img src="<?=url('assets/uploads/').get_current_url().'/'.$userdata['files'][strtolower(str_replace(' ', '_', $sngl->fieldname))]?>" width="100%">
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="form-group">
                              <label for=""><?=$sngl->fieldname?></label>
                            <input type="<?=strtolower($sngl->fieldname)=='email'?'email':'text'?>" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" value="<?=isset($userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))])?$userdata[strtolower(str_replace(' ', '_', $sngl->fieldname))]:''?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" />
                            <div class="validate"></div>
                            </div>
                        <?php } $i++;
                        } ?>
                      <?php } ?>
                    <div class="form-group ">
                        <label for="bannertext">Subscribed?</label><br>
                        <label class="switch">
                        <input type="checkbox" class="notificationswitch" name="subscribed" <?php echo $detail_info->subscribed ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                        </label>
                    </div>
                    <?php $total = 1;?>
          
                    <div class="row make-sticky">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="<?=url('crmcontrols?block=contacts')?>"><button type="button" class="btn btn-default">Cancel</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    
    var total  = 2;
    function addAnotherImage(){
      var newupload = ' <div class="col-md-12" style="margin-top:10px;border-top:2px solid lightgrey;padding-top:10px" id="img-'+total+'" ><button type="button" class="btn btn-info" style="float:right" onclick="removeImageDiv('+total+')">Remove</button> <div class="uploadImageDiv"><button type="button" class="btn btn-primary btnuploadimagenew" data-toggle="modal" data-target="#modalImagesforUploads">Upload image</button><input type="hidden" name="imagefromgallery" class="imagefromgallery"> <input class="dataimage" type="hidden" name="userfile[]"> <div class="col-md-6 imgdiv" style="display:none"> <br> <img src="" width="100%" class="imagefromgallerysrc"> <button type="button" class="btn btn-primary btnimgdel btnimgremove" >X</button></div></div> </div>';
      $(".img-upload-container").append(newupload);
      total++;
    }
  
    function removeImageDiv(id){
  
  if(id !=""){
    $("#img-"+id).remove();
    total--;
  }
  }
  
  $(document).on('click', '.btnimgdel', function() {
      var imgid = $(this).data('imgid');
      $(this).closest('.imgdiv').remove();
      $.ajax({
        url: '<?= url('delContactimage'); ?>',
        type: "POST",
        data: {
          'imgid': imgid,
          _token: "{{ csrf_token() }}"
        },
        success: function(data) {}
      });
    });
  
    $('#customFile').on('change', function() {
      imagesPreview(this, '.email_template_images');
    });
  
    var imagesPreview = function(input, placeToInsertImagePreview) {
      if (input.files) {
        var filesAmount = input.files.length;
        //$(placeToInsertImagePreview).empty();
        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();
          reader.onload = function(event) {
            $(placeToInsertImagePreview).append('<img width="100%" src="' + event.target.result + '"><br><br>');
          }
          reader.readAsDataURL(input.files[i]);
        }
      }
    };
    </script>
@endsection('content')