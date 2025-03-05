<!-- resources/views/components/modal.blade.php -->
<style>
    .text-justify {
        text-align: justify;
    }
</style>
<div class="modal fade in" style="overflow-y: auto;z-index:9999;" id="dynamicModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="">
            <div class="modal-body contact">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <br>
                <form action="<?= url('customformsAction') ?>" id="form<?= getCustomformEncodedID($single->encoded_id) ?>" method="post" enctype="multipart/form-data" role="form" class="custom-form php-email-form-popup no-box-shadow p-0">
                    @csrf
                    <center>
                        <?php
                        if ($single->image) {
                        ?>
                            <img src='<?= url('assets/uploads/' . get_current_url() . $single->image) ?>' width="<?= $single->image_size ? $single->image_size . 'px' : '' ?>" class="img-responsive">
                        <?php
                        }
                        ?>
                    </center>
                    @if($single->id == 8)
                    @if(request()->optoutmail || request()->customemail || request()->emailId)
                    <input type="hidden" name="optoutmail" value="<?= request()->optoutmail ?>">
                    <input type="hidden" name="emailId" value="<?= request()->emailId ?>">
                    <input type="hidden" name="customemail" value="<?= request()->customemail ?>">
                    @endif
                    @endif

                    <input type="hidden" name="formid" value="<?= $single->id ?>" />
                    <br>
                    <div class="formtitle"><?= $single->title ?></div>
                    <div class="formsubtitle"><?= $single->subtitle ?></div>
                    <div class="text-center mb-10">We are automatically notified when a Form has been submitted</div>
                    <div class="formdescriptivetext"><?= nl2br($single->descriptive) ?></div>
                    <br>
                    @php
                    // Initialize the combinedItems array before adding fields and buttons
                    $combinedItems = [];
                    $fields = json_decode($single->fields, true); // Convert JSON to associative array
                    $fields = array_map("unserialize", array_unique(array_map("serialize", $fields)));
                    $fields = array_values($fields);
                    $buttons = $single->actionButtons->sortBy('order')->toArray(); // Sort buttons by 'order'

                    // Add 'order' key to each field
                    foreach ($fields as $field) {
                    $field['order'] = isset($field['order']) ? $field['order'] : ''; // Use existing order if available
                    $field['type'] = 'field';
                    $combinedItems[] = $field;
                    }

                    // Add 'order' key to each button
                    foreach ($buttons as $button) {
                    $button['order'] = $button['order']; // Use existing order if available
                    $button['type'] = 'button';
                    $combinedItems[] = $button;
                    }

                    // Sort combined items by 'order'
                    usort($combinedItems, function ($a, $b) {
                    return $a['order'] <=> $b['order'];
                        });
                        @endphp
                        @foreach($combinedItems as $item)
                        <?php if ($item['type'] == 'field') { ?>
                            <?php $form_fields = json_decode($single->fields);
                            $i = 0; ?>
                            <?php if (isset($item['formenable']) && $item['formenable'] == '1') { ?>
                                <?php if ($item['fieldtype'] == 'text') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="<?= strtolower($item['fieldname']) == 'email' ? 'email' : 'text' ?>" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" class="form-control" id="name" placeholder="<?= $item['fieldname'] ?>" data-rule="<?= ($item['required']) ? 'required' : '' ?>" <?= ($item['required']) ? 'required' : '' ?> />
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'radio') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <div class="row">
                                            <?php $checked = 'checked';
                                            foreach ($item['options'] as $singleop) { ?>
                                                <div class="col-md-12">
                                                    <input type="radio" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" <?php echo $checked;
                                                                                                                                                $checked = ''; ?> value="<?= strtolower((isset($singleop['option_name']) ? $singleop['option_name'] : $singleop)) ?>" class="inputchange" data-otherfield="<?= isset($singleop['otherfield']) && $singleop['otherfield'] == '1' ? '1' : '' ?>" /> <?= (isset($singleop['option_name']) ? $singleop['option_name'] : $singleop) ?><br>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div> 
                                        </div>
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'checkbox') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <div class="row">
                                            <?php $checked = 'checked';
                                            foreach ($item['options'] as $singleop) { ?>
                                                <div class="col-md-12">
                                                    <label><input type="checkbox" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" value="<?= strtolower((isset($singleop['option_name']) ? $singleop['option_name'] : $singleop)) ?>" class="chkinputchange" data-otherfield="<?= isset($singleop['otherfield']) && $singleop['otherfield'] == '1' ? '1' : '' ?>" /> <?= (isset($singleop['option_name']) ? $singleop['option_name'] : $singleop) ?></label><br>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-12">
                                                <input type="text" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                            </div> 
                                        </div>
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'hidden') { ?>
                                   <input type="hidden" name="hidden" value="event_form">
                                <?php }
                                
                                elseif ($item['fieldtype'] == 'select') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <select name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control selinputchange">
                                            <?php $checked = 'checked';
                                            foreach ($item['options'] as $singleop) { ?>
                                                <option value="<?= strtolower((isset($singleop['option_name']) ? $singleop['option_name'] : $singleop)) ?>" data-otherfield="<?= isset($singleop['otherfield']) && $singleop['otherfield'] == '1' ? '1' : '' ?>"> <?= (isset($singleop['option_name']) ? $singleop['option_name'] : $singleop) ?></option>
                                            <?php } ?>
                                        </select>
                                       <div class="col-md-12">
                                            <input type="text" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                        </div> 
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'multiselect') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <select name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control selinputchange multiselectlist" multiple>
                                            <?php $checked = 'checked';
                                            foreach ($item['options'] as $singleop) { ?>
                                                <option value="<?= strtolower((isset($singleop['option_name']) ? $singleop['option_name'] : $singleop)) ?>" data-otherfield="<?= isset($singleop['otherfield']) && $singleop['otherfield'] == '1' ? '1' : '' ?>"> <?= (isset($singleop['option_name']) ? $singleop['option_name'] : $singleop) ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="col-md-12">
                                            <input type="text" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>[]" class="form-control textinput" id="name" placeholder="Write">
                                        </div>
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'date') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="date" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" class="form-control" id="name" placeholder="<?= $item['fieldname'] ?>" data-rule="<?= ($item['required']) ? 'required' : '' ?>" <?= ($item['required']) ? 'required' : '' ?> value="{{date('Y/m/d')}}" />
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'time') { ?>
                                    <div class="col form-group position-reletive">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="text" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" class="form-control newtime" id="name" placeholder="<?= $item['fieldname'] ?>" data-rule="<?= ($item['required']) ? 'required' : '' ?>" <?= ($item['required']) ? 'required' : '' ?> />

                                        <i class="fa fa-clock-o top-right" aria-hidden="true"></i>
                                        <input type="time" class="ontimechange timepicker" onclick="this.showPicker()">
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'textarea') { ?>
                                    <div class="form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <textarea class="form-control" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" rows="5" data-rule="<?= ($item['required']) ? 'required' : '' ?>" placeholder="<?= $item['fieldname'] ?>" <?= ($item['required']) ? 'required' : '' ?>></textarea>
                                        <div class="validate"></div>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'file') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?>:</b></label>
                                        <input style="padding-bottom: 40px;" type="file" <?= ($item['required']) ? 'required' : '' ?> name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" class="form-control" id="file" placeholder="<?= $item['fieldname'] ?>" />
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'image') { ?>
                                    <div class="col form-group">
                                        <center>
                                            <img src="<?= isset($item['image']) ? url('assets/uploads/' . get_current_url() . $item['image']) : '' ?>" width="100%" class="img-responsive mb-10">
                                            <p><?= $item['image_desc'] ?></p>
                                        </center>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == 'comment_only') { ?>
                                    <div class="col form-group">
                                        <label><b><?= $item['fieldname'] ?>:</b></label>
                                        <p class="text-justify"><?= isset($item['comment_desc']) ? $item['comment_desc'] : '' ?></p>
                                    </div>
                                <?php } elseif ($item['fieldtype'] == '5_star_min' || $item['fieldtype'] == '4_star_min') { ?>
                                    <div class=" rating_type_<?= $single->id ?>" data-value="{{$item['fieldtype']}}"></div>
                                    <div class="form-group">
                                        <label><b>Select your rating <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <input type="radio" name="rating" class='rating' value="5" <?= ($item['required']) ? 'required' : '' ?>>
                                        <label class="text-black">5-Star Rating</label>
                                        <br>
                                        <input type="radio" name="rating" value="4">
                                        <label class="text-black">4-Star Rating</label>
                                        <br>
                                        <input type="radio" name="rating" value="3">
                                        <label class="text-black">3-Star Rating</label>
                                        <br>
                                        <input type="radio" name="rating" value="2">
                                        <label class="text-black">2-Star Rating</label>
                                        <br>
                                        <input type="radio" name="rating" value="1">
                                        <label class="text-black">1-Star Rating</label>
                                        <div class="validate"></div>
                                    </div>

                                    <div class="form-group">
                                        <label><b><?= $item['fieldname'] ?> <?= ($item['required']) ? '<span class="text-red">*</span>' : '' ?></b></label><br>
                                        <textarea class="form-control review_to_copy" name="<?= strtolower(str_replace(' ', '_', $item['fieldname'])) ?>" rows="5" data-rule="<?= ($item['required']) ? 'required' : '' ?>" placeholder="<?= $item['fieldname'] ?>" <?= ($item['required']) ? 'required' : '' ?>></textarea>
                                        <div class="validate"></div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php $i++;
                            ?>
                        <?php } elseif ($item['type'] == 'button') { ?>
                            <div style="text-align: left;">
                                <?php if (isset($item['active']) && $button['active'] == '1') {
                                    $input_link = '#';
                                    $popupform = '';
                                    $target = '';
                                    $audioclass = '';
                                    $data_target = "";
                                    $data_toggle = '';
                                    $class = '';
                                    if ($item['action_type'] == 'link') {
                                        $input_link = $item['link'];
                                        $target = "_blank";
                                    } elseif ($item['action_type'] == 'customforms') {
                                        $input_link = '#';
                                        $target = "";

                                        $popupform = 'data-toggle="modal" data-is_custom_modal="YES" data-target="#modalcustomforms' . getCustomformEncodedID(isset($item['custom_form_id']) ? $item['custom_form_id'] : '') . '"';
                                    } elseif ($item['action_type'] == "video") {

                                        $input_link = get_blog_image($item['action_button_video']);
                                        // $target = "_blank";
                                        $data_target = "#video_modal";
                                        $data_toggle = 'modal';
                                    } elseif ($item['action_type'] == "google_map") {

                                        $address_full = isset($item['map_address']) ? $item['map_address'] : "";
                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                        $target = "_blank";
                                    } elseif ($item['action_type'] == "audioiconfeature") {
                                        if ($item['action_button_audio_icon_feature']) { ?>
                                            <div class="action-audio">
                                                <audio class="hidden" id="gallpostAudio_<?= $item['id'] ?>" controls>
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_audio_icon_feature']) ?>" type="audio/mp3">
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_audio_icon_feature']) ?>" type="audio/ogg">
                                                    <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_audio_icon_feature']) ?>" type="audio/mpeg">
                                                </audio>
                                            </div>
                                        <?php
                                        }
                                        $input_link = '#' . $item['action_button_audio_icon_feature'];
                                    } elseif ($item['action_type'] == "address") {
                                        $address =  getaddress_info($item['address_id']);

                                        $address_full = isset($address->street) ? $address->street . ', ' . $address->city . ' ' . $address->zip_code . ', ' . $address->state . ' ' . $address->country : "";
                                        $input_link = "http://maps.google.com/maps?q=" . $address_full;
                                        $target = "_blank";
                                    } elseif ($item['action_type'] == 'text_popup') {

                                        $input_link = '#' . $item['action_type'];
                                        ?>
                                        <div style="display:none" id="actPostPopupText<?= $item['id'] ?>">
                                            <?php echo $item['action_button_textpopup']; ?>
                                        </div>
                                        <?php
                                    } elseif ($item['action_type'] == 'call' || $item['action_type'] == 'sms' || $item['action_type'] == 'email') {


                                        switch ($item['action_type']) {

                                            case 'sms':
                                                $input_link = 'sms:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $item['action_button_phone_no_sms']));
                                                break;
                                            case 'call':
                                                $input_link = 'tel:' . str_replace(array('-', ' ', '(', ')', '_'), '', str_replace(' ', '', $item['action_button_phone_no_calls']));
                                                break;
                                            case 'email':
                                                $input_link = 'mailto:' . $item['action_button_action_email'];
                                                break;
                                        }
                                    } else {
                                        if ($item['action_type'] == 'audiofeature') {
                                            $audioclass = '';
                                        ?><div class="action-audio"> <?php
                                                                                if (isset($item['action_button_action_audio'])) { ?>
                                                    <audio class="hidden" id="galleryPostAudio" controls>
                                                        <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_action_audio']) ?>" type="audio/mp3">
                                                        <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_action_audio']) ?>" type="audio/ogg">
                                                        <source src="<?= url('assets/uploads/' . get_current_url() . $item['action_button_action_audio']) ?>" type="audio/mpeg">
                                                    </audio>
                                            </div>
                                <?php
                                                                                }
                                                                            } else {
                                                                                $class = 'menuitem';
                                                                            }
                                                                        }
                                ?>
                                @if(isset($item['action_type']) && $item['action_type'] == "audioiconfeature" && isset($item['action_button_audio_icon_feature']))
                                <span class="" onclick="playPauseAudio('gallpostAudio_<?= $item['id'] ?>')">
                                    <a href="<?= $input_link ?>"
                                        style="" class="btn btn-default text-bold gallery-post-action-button-{{$item['id']}} new-action-btn btn-adjustable form-action-button-{{$item['id']}} {{$audioclass}} " style=""><span style="position:absolute;left:10px;">
                                            <i class="fa fa-volume-up"></i></span>
                                        <span class="text"><?= $item['text'] ?></span></a>
                                    <!-- <div class="info-text">Click to hear Text</div> -->
                                    <br>
                                </span>
                                @else
                                <a href="<?= $input_link ?>"
                                    id="<?= $item['id'] . 'video' ?>"

                                    <?php if ($item['action_type'] == 'text_popup') { ?>
                                    onclick="openPopupText('actPostPopupText<?= $item['id'] ?>')"
                                    <?php } ?>
                                    <?php if ($item['action_type'] == "image_popup") { ?> onclick="openSlider(<?= htmlspecialchars($item['popup_images']) ?>, '<?= url('assets/uploads/' . get_current_url()) ?>');" <?php } ?>
                                    <?php if ($item['action_type'] == "video") { ?>
                                    data-toggle="<?= $data_toggle ?>" data-target="<?= $data_target ?>"
                                    onclick="openVideo('<?= $item['id'] . 'video' ?>')" <?php } ?>


                                    <?= isset($item['action_button_action_audio']) ? 'onclick=playPauseAudio("galleryPostAudio")' : '' ?> target="<?= $target ?>" <?= $popupform ?> class="btn btn-default text-bold new-action-btn gallery-post-action-button-{{$item['id']}} {{$class}} {{$audioclass}}"><?= $item['text'] ?></a>
                                @if(isset($item['action_button_link']) && $item['action_button_link'] == "video")
                                <div style="margin-top: -4px;" class="descpostgall_icon_<?= $item['id'] ?>">Click to watch video</div>
                                @endif
                                @endif
                            <?php } ?>
                            </div>
                        <?php } ?>
                        @endforeach

                        <input type="hidden" name="otp" id="otp" />
                        <?php
                        if ($siteSettings->is_captcha_enable) {
                        ?>
                            <div class="col form-group" align="center">
                                <div class="dcatcha">
                                    <div class="numberspls">
                                        <span class="numberspls-hidden">
                                            <?= $num1 . " + " ?>
                                        </span>
                                        <?= $num2 . " + " . $num3 ?>
                                    </div>
                                    <div> = </div>
                                    <div> <input type="number" name="captchares" class="form-control" style="width:100px"></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">

                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-primary btn-save">Submit</button></div>
                        <br>

                        <div class="cf_footer_text_1"><?= $single->footer_text_1 ?></div>
                        <center>
                            <?php
                            if($is_attendance == 'true')
                            { ?>
                                <img src='<?= url('assets/uploads/attendance_form_footer_img.png') ?>' width="50%" class="img-responsive mb-10 img-max-width">
                                <?php
                            }else
                            {
                                if (isJson($form_logo->file_name)) {
                                    $image = json_decode($form_logo->file_name);
                                    foreach ($image as $singleimage) { ?>
                                        <img src='<?= url('assets/uploads/' . get_current_url() . $singleimage->img) ?>' width="50%" class="img-responsive mb-10 img-max-width">
                                        <p><?= $singleimage->desc ?></p>
                                    <?php }
                                } else { ?>
                                    <img src='<?= url('assets/uploads/' . get_current_url() . $form_logo->file_name) ?>' width="50%" class="img-responsive mb-10 img-max-width">

                            <?php } }?>
                            <br>
                        </center>
                        <div class="cf_footer_text_2"><?= $single->footer_text_2 ?></div>

                </form>
            </div>
        </div>
    </div>
</div>