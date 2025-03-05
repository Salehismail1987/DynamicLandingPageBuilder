<div id="action-buttons-container">
    @if($allButtons && $allButtons->count() > 0)
    @foreach($allButtons as $index => $button)
    <div class="col-md-12 d-flex action-button-template">
        <div class="col-md-3">
            <div class="form-group">
                <label for="action_button_discription">Action Button Name</label>
                <input type="text" class="myinput2" name="action_button_discription[]" id="action_button_discription" value="{{ $button->text }}" placeholder="Type here...">
            </div>
        </div>
        <input type="hidden" name="slug[]" value="{{$button->slug}}">

        <div class="col-md-3">
            <div class="form-group">
                <label for="action_button_link">Action Button Application</label>
                <select class="myinput2 news_post_action_buttoncontent_count_number action_button_selection_learning" id="action_button_link" name="action_button_link[]">
                    <option value="link" {{ $button->action_type == 'link' ? 'selected' : '' }}>Link</option>
                    <option value="call" {{ $button->action_type == 'call' ? 'selected' : '' }}>Call</option>
                    <option value="sms" {{ $button->action_type == 'sms' ? 'selected' : '' }}>SMS</option>
                    <option value="email" {{ $button->action_type == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="video" {{ $button->action_type == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="audioiconfeature" {{ $button->action_type == 'audioiconfeature' ? 'selected' : '' }}>Audio Icon Feature</option>
                    <option value="google_map" {{ $button->action_type == 'google_map' ? 'selected' : '' }}>Map</option>
                    <option value="text_popup" {{ $button->action_type == 'text_popup' ? 'selected' : '' }}>Text Popup</option>
                    <option value="address" {{ $button->action_type == 'address' ? 'selected' : '' }}>Address</option>
                    <option value="customforms" {{ $button->action_type == 'customforms' ? 'selected' : '' }}>Forms</option>
                    @foreach ($frontSections as $single2)
                    <option value="{{ $single2->slug }}" {{ $button->action_type == $single2->slug ? 'selected' : '' }}>{{ $single2->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group action_fields action_link" style="display: {{ $button->action_type == 'link' ? 'block' : 'none' }};">
                <label for="news_post_linkcontent_count_number">Link</label>
                <input type="text" class="myinput2 news_post_linkcontent_count_number" name="action_button_link_text[]" id="news_post_linkcontent_count_number" value="{{$button->link}}" placeholder="http://google.com">
            </div>
            <div class="form-group action_fields phone_no_calls" style="display: {{ $button->action_type == 'call' ? 'block' : 'none' }};">
                <label for="">Phone number for calls</label>
                <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="{{$button->action_button_phone_no_calls}}">
            </div>
            <div class="form-group action_fields phone_no_sms" style="display: {{ $button->action_type == 'sms' ? 'block' : 'none' }};">
                <label for="">Phone number for sms</label>
                <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="{{$button->action_button_phone_no_sms}}">
            </div>
            <div class="form-group action_fields action_email" style="display: {{ $button->action_type == 'email' ? 'block' : 'none' }};">
                <label for="">Email</label>
                <input type="text" class="myinput2" name="action_button_action_email[]" value="{{$button->action_button_action_email}}">
            </div>
            <div class="form-group quilleditor-div action_fields action_textpopup" style="display: {{ $button->action_type == 'text_popup' ? 'block' : 'none' }};">
                <label>Popup Text </label>
                <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"><?php echo $button->action_button_textpopup; ?></textarea>
                <div class="quilleditor"><?php echo $button->action_button_textpopup; ?></div>
            </div>
            <div class="form-group action_fields video_upload" name="feature_action_video" style="display: {{ $button->action_type == 'video' ? 'block' : 'none' }};">
                <label for="customFile">Upload Video</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="action_video[]" id="customFile" accept=".mp4">
                    <label class="custom-file-label" for="customFile">Upload Video</label>
                </div>
            </div>
            <div class="form-group action_fields audio_icon_feature" name="cb_audio_icon_feature" style="display: {{ $button->action_type == 'audioiconfeature' ? 'block' : 'none' }};">
                <label for="customFile">Select File</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                    <label class="custom-file-label" for="customFile">Select File</label>
                </div>
            </div>
            <div class="form-group action_fields audio_upload" name="feature_action_audio" style="display: {{ $button->action_type == 'audiofeature' ? 'block' : 'none' }};">
            <label for="customFile">Select File</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="action_button_audio[]" id="customFile" accept=".mp3">
                <label class="custom-file-label" for="customFile">Select File</label>
            </div>
            </div>
            <div class="form-group action_fields action_forms" style="display: {{ $button->action_type == 'customforms' ? 'block' : 'none' }};">
            <label for="action_button_customforms">Forms</label>
                <select class="myinput2" name="action_button_customforms[]" id="customformscontent_count_number">
                    @if (count($customForms) > 0)
                    @foreach ($customForms as $single)
                    <option value="{{ $single->id }}">{{ $single->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group action_fields action_address" style="display: {{ $button->action_type == 'address' ? 'block' : 'none' }};">
                <label for="addressbtn1">Select an Address</label>
                <select name="action_button_address_id[]" class="myinput2">
                    @foreach ($addresses as $address)
                    <option value="{{ $address->id }}" {{ $button->address_id ==  $address->id ? 'selected' : '' }}>{{ $address->address_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group action_fields action_map" style="display: {{ $button->action_type == 'google_map' ? 'block' : 'none' }};">
                <label for="address">Enter Address</label>
                <input type="text" class="myinput2" name="action_button_map_address[]" value="{{$button->map_address}}" placeholder="105 Krome Ave, Miami, FL, 3700 USA">
            </div>
        </div>
        <div class="col-md-3" id="delete-button">
            <div class="form-group mt-3">
            <a href="{{ route('deleteActionButton', ['id' => $button->id]) }}" class="btn btn-primary btnremovereview mt-3" onclick="return confirm('Are you sure you want to delete this button?')">Delete Button</a>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-md-12 d-flex action-button-template">
        <div class="col-md-4">
            <div class="form-group">
                <label for="action_button_discription">Action Button Name</label>
                <input type="text" class="myinput2" name="action_button_discription[]" id="action_button_discription" value="" placeholder="Type here...">
            </div>
        </div>
        <input type="hidden" name="slug[]" value="{{$featureSlug}}_0">

        <div class="col-md-4">
            <div class="form-group">
                <label for="action_button_link">Action Button Application</label>
                <select class="myinput2 news_post_action_buttoncontent_count_number action_button_selection_learning" id="action_button_link" name="action_button_link[]">
                    <option value="link">Link</option>
                    <option value="call">Call</option>
                    <option value="sms">SMS</option>
                    <option value="email">Email</option>
                    <option value="video">Video</option>
                    <option value="audioiconfeature">Audio Icon Feature</option>
                    <option value="google_map">Map</option>
                    <option value="text_popup">Text Popup</option>
                    <option value="address">Address</option>
                    <option value="customforms">Forms</option>
                    @foreach ($frontSections as $single2)
                    <option value="{{ $single2->slug }}">{{ $single2->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group action_fields action_link" style="display:block">
                <label for="news_post_linkcontent_count_number">Link</label>
                <input type="text" class="myinput2 news_post_linkcontent_count_number" name="action_button_link_text[]" id="news_post_linkcontent_count_number" value="" placeholder="http://google.com">
            </div>
            <div class="form-group action_fields phone_no_calls" style="display:none">
                <label for="">Phone number for calls</label>
                <input type="text" class="myinput2" name="action_button_phone_no_calls[]" value="">
            </div>
            <div class="form-group action_fields phone_no_sms" style="display:none">
                <label for="">Phone number for sms</label>
                <input type="text" class="myinput2" name="action_button_phone_no_sms[]" value="">
            </div>
            <div class="form-group action_fields action_email" style="display:none">
                <label for="">Email</label>
                <input type="text" class="myinput2" name="action_button_action_email[]" value="">
            </div>
            <div class="form-group quilleditor-div action_fields action_textpopup" style="display:none">
                <label>Popup Text </label>
                <textarea class="myinput2 editordata hidden" name="action_button_textpopup[]"></textarea>
                <div class="quilleditor"></div>
            </div>
            <div class="form-group action_fields video_upload" name="feature_action_video" style="display:none">
                <label for="customFile">Upload Video</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="action_video[]" id="customFile" accept=".mp4">
                    <label class="custom-file-label" for="customFile">Upload Video</label>
                </div>
            </div>
            <div class="form-group action_fields audio_upload" name="feature_action_audio" style="display:none">
            <label for="customFile">Select File</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="action_button_audio[]" id="customFile" accept=".mp3">
                <label class="custom-file-label" for="customFile">Select File</label>
            </div>
            </div>
            <div class="form-group action_fields audio_icon_feature" name="cb_audio_icon_feature" style="display:none">
                <label for="customFile">Select File</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="action_button_audio_icon_feature[]" id="customFile" accept=".mp3">
                    <label class="custom-file-label" for="customFile">Select File</label>
                </div>
            </div>
            <div class="form-group action_fields action_forms" style="display:none">
            <label for="action_button_customforms">Forms</label>
                <select class="myinput2" name="action_button_customforms[]" id="customformscontent_count_number">
                    @if (count($customForms) > 0)
                    @foreach ($customForms as $single)
                    <option value="{{ $single->id }}">{{ $single->title }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group" style="display:none">
                <label for="addressbtn1">Select an Address</label>
                <select name="action_button_address_id[]" class="myinput2">
                    @foreach ($addresses as $address)
                    <option value="{{ $address->id }}">{{ $address->address_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group action_fields action_map" style="display:none">
                <label for="address">Enter Address</label>
                <input type="text" class="myinput2" name="action_button_map_address[]" value="" placeholder="105 Krome Ave, Miami, FL, 3700 USA">
            </div>
        </div>
    </div>
    @endif
</div>
<div class="row make-sticky">
    <div class="col-md-12">
        <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="save">Save</button>
        <button type="submit" name="save_generic_blog_settings" class="btn btn-primary" value="savereminders">Save & send reminder</button>
    </div>
</div>