@extends('admin.layout.dashboard')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ADD Contact</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Add Email List</h6>
                </div>
                <div class="card-body">
                    <form class="data-form" role="form" method="post" enctype="multipart/form-data" action="{{ url('createContact') }}">
                        @csrf
                        <?php if ($contact_database->fields) { ?>
                        <?php $form_fields = json_decode($contact_database->fields);
                        $i = 0; ?>
                        <?php foreach ($form_fields as $sngl) { ?>
                        <?php if ($sngl->fieldtype == 'radio') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?></label><br>
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <input type="radio" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" <?php echo $checked; $checked='';?> value="<?=strtolower($singleop)?>" <?=old(strtolower(str_replace(' ', '_', $sngl->fieldname)))==strtolower($singleop)?'checked':''?>/> <?=$singleop?><br>
                            <?php } ?>
                            <div class="validate"></div>
                            </div>
                        <?php } elseif ($sngl->fieldtype == 'checkbox') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?></label><br>
                            <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                <input type="checkbox" 
                                name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" <?php echo $checked; $checked='';?> 
                                value="<?=$singleop?>" /> <?=$singleop?><br>
                            <?php } ?>
                            <div class="validate"></div>
                            </div>
                        <?php }elseif ($sngl->fieldtype == 'multiselect') { ?>
                            <div class="form-group">
                                <label><?=$sngl->fieldname?></label><br>
                                <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="myinput2 inputchange" multiple>
                                    <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                        <option value="<?=strtolower($singleop)?>"> <?=$singleop?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php }elseif ($sngl->fieldtype == 'select') { ?>
                            <div class="form-group">
                                <label><?=$sngl->fieldname?></label><br>
                                <select name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>[]" class="myinput2 inputchange">
                                    <?php $checked='checked';foreach($sngl->options as $singleop){ ?>
                                        <option value="<?=strtolower($singleop)?>"> <?=$singleop?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } elseif ($sngl->fieldtype == 'textarea') { ?> 
                            <div class="form-group">
                            <label for=""><?=$sngl->fieldname?></label>
                            <textarea class="myinput2" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" rows="5" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" placeholder="<?= $sngl->fieldname ?>"><?=old(strtolower(str_replace(' ', '_', $sngl->fieldname)))?></textarea>
                            <div class="validate"></div>
                            </div>
                        <?php }elseif ($sngl->fieldtype == 'date') { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></label><br>
                            <input type="date" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" <?= ($sngl->required) ? 'required' : '' ?>/>
                            <div class="validate"></div>
                            </div>
                        <?php }  elseif ($sngl->fieldtype == 'file')  { ?>
                            <div class="form-group">
                            <label><?=$sngl->fieldname?> <?= ($sngl->required) ? '<span class="text-red">*</span>' : '' ?></label><br>
                            <input style="padding-bottom: 40px;" type="file" <?= ($sngl->required) ? 'required' : '' ?> name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" class="myinput2" id="file" placeholder="<?= $sngl->fieldname ?>" />
                            </div>
                        <?php }else{ ?>
                            <div class="form-group">
                                <label for=""><?=$sngl->fieldname?></label>
                            <input type="<?=strtolower($sngl->fieldname)=='email'?'email':'text'?>" name="<?= strtolower(str_replace(' ', '_', $sngl->fieldname)) ?>" value="<?=old(strtolower(str_replace(' ', '_', $sngl->fieldname)))?>" class="myinput2" id="name" placeholder="<?= $sngl->fieldname ?>" data-rule="<?= ($sngl->required) ? 'required' : '' ?>" />
                            <div class="validate"></div>
                            </div>
                        <?php }
                            $i++;
                        } ?>
                        <?php } ?>
                        <div class="form-group ">
                            <label for="bannertext">Subscribed?</label><br>
                            <label class="switch">
                            <input type="checkbox" class="notificationswitch" name="subscribed">
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
