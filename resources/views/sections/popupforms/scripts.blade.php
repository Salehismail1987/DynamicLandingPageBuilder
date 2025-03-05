<?php
// Initialize variables for pop and cd values
$popValue = '';
$cdValue = '';
$email = '';
// Check if 'pop' parameter is set
if (isset($_GET['popup'])) {
    $popValue = rtrim($_GET['popup'], '/');

    // Check if 'pop' equals 8
    if ($_GET['popup'] == 8) {
        $optOutId = get_opt_out_form_id();
        $popValue = $optOutId->encoded_id;
    } else {
        $popValue = $_GET['popup'];
    }
}

// Check if 'cd' parameter is set
if (isset($_GET['key'])) {
    $cdValue = $_GET['key'];
}
if (isset($_GET['customemail'])) {
    $email = $_GET['customemail'];
}
?>

<script>
    $(document).ready(function() {
        // Show modal if 'pop' value is available
        <?php if ($popValue): ?>
            var pop = '<?= $popValue ?>';
            var cd = <?= $cdValue ? "'$cdValue'" : 'null' ?>;
            var email = <?= $email ? "'$email'" : 'null' ?>;
            var base_url = "{{ url('/') }}";
            $.ajax({
                url: base_url + '/unsubscribeform',
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': pop,
                    'email': email,
                    'key': cd,
                },
                success: function(response) {
                    $('#dynamicModal').remove();
                    $('body').append(response.modal);
                    $('#dynamicModal').modal('show');
                    $('#dynamicModal').on('hidden.bs.modal', function() {
                        $('#dynamicModal').remove(); // Remove modal from DOM
                        $('.modal-backdrop').remove(); // Remove the backdrop if it exists
                        $('body').removeClass('modal-open'); // Remove class if present
                        $('body').css('padding-right', ''); // Reset padding
                    });
                    $('form.php-email-form-popup').submit(function(e) {
                        e.preventDefault();
                        var retryCount = 0; // Initialize retry count
                        currentForm = $(this).closest('form');
                        // Show location modal to ask for permission
                        $('#location-modal').show();

                        // Click event for the "Ok, Got it" button
                        $('#allow-location').click(function() {
                            $('#location-modal').hide()
                            // Retry location request when user clicks "Ok, Got it"
                            //requestLocation();
                        });
                        $('.location-modal').click(function() {
                            $('#location-modal').hide()
                            // Retry location request when user clicks "Ok, Got it"
                        });

                        // Click event to close the failed modal
                        $('#got-it').click(function() {
                            $('#failed-modal').hide();
                            $('.modal').modal('hide');
                        });

                        function requestLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                            } else {
                                alert("Geolocation is not supported by this browser.");
                            }
                        }

                        function successCallback(position) {
                            $('#location-modal').hide();
                            var latitude = position.coords.latitude;
                            var longitude = position.coords.longitude;

                            // Check if coordinates are within the US
                            if (isWithinUS(latitude, longitude)) {
                                processForm();
                            } else {
                                $('#failed-modal').show();
                                console.log('failed');
                            }
                        }

                        function errorCallback(error) {
                            console.error("Error getting location: " + error.message);
                            if (error.code === error.PERMISSION_DENIED) {
                                retryCount++;
                                $('#location-modal').show();
                            } else {
                                $('#location-modal').show();

                            }
                        }

                        function isWithinUS(lat, lon) {
                            const US_BOUNDS = {
                                latMin: 24.396308, // Southern boundary
                                latMax: 49.384358, // Northern boundary
                                lonMin: -125.0, // Western boundary
                                lonMax: -66.93457 // Eastern boundary
                            };

                            const PAKISTAN_BOUNDS = {
                                latMin: 23.694776, // Southern boundary
                                latMax: 37.084107, // Northern boundary
                                lonMin: 60.872972, // Western boundary
                                lonMax: 77.823171 // Eastern boundary
                            };

                            const withinUS = lat >= US_BOUNDS.latMin &&
                                lat <= US_BOUNDS.latMax &&
                                lon >= US_BOUNDS.lonMin &&
                                lon <= US_BOUNDS.lonMax;

                            const withinPakistan = lat >= PAKISTAN_BOUNDS.latMin &&
                                lat <= PAKISTAN_BOUNDS.latMax &&
                                lon >= PAKISTAN_BOUNDS.lonMin &&
                                lon <= PAKISTAN_BOUNDS.lonMax;

                            return withinUS || withinPakistan;
                        }

                        function processForm() {
                            console.log('Processing form...');
                            currentForm.find('#hidden-phone-number').val(sessionStorage.getItem('phone'));
                            currentForm.find('#otp').val(sessionStorage.getItem('otp'));

                            var f = currentForm.find('.form-group'),
                                ferror = false,
                                emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                            f.children('input').each(function() {
                                var i = $(this);
                                var rule = i.attr('data-rule');

                                if (rule !== undefined) {
                                    var ierror = false;
                                    var pos = rule.indexOf(':', 0);
                                    if (pos >= 0) {
                                        var exp = rule.substr(pos + 1, rule.length);
                                        rule = rule.substr(0, pos);
                                    } else {
                                        rule = rule.substr(pos + 1, rule.length);
                                    }

                                    switch (rule) {
                                        case 'required':
                                            if (i.val() === '') {
                                                ferror = ierror = true;
                                            }
                                            break;

                                        case 'minlen':
                                            if (i.val().length < parseInt(exp)) {
                                                ferror = ierror = true;
                                            }
                                            break;

                                        case 'email':
                                            if (!emailExp.test(i.val())) {
                                                ferror = ierror = true;
                                            }
                                            break;

                                        case 'checked':
                                            if (!i.is(':checked')) {
                                                ferror = ierror = true;
                                            }
                                            break;

                                        case 'regexp':
                                            exp = new RegExp(exp);
                                            if (!exp.test(i.val())) {
                                                ferror = ierror = true;
                                            }
                                            break;
                                    }
                                    i.next('.validate').html((ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
                                }
                            });

                            f.children('textarea').each(function() {
                                var i = $(this);
                                var rule = i.attr('data-rule');

                                if (rule !== undefined) {
                                    var ierror = false;
                                    var pos = rule.indexOf(':', 0);
                                    if (pos >= 0) {
                                        var exp = rule.substr(pos + 1, rule.length);
                                        rule = rule.substr(0, pos);
                                    } else {
                                        rule = rule.substr(pos + 1, rule.length);
                                    }

                                    switch (rule) {
                                        case 'required':
                                            if (i.val() === '') {
                                                ferror = ierror = true;
                                            }
                                            break;

                                        case 'minlen':
                                            if (i.val().length < parseInt(exp)) {
                                                ferror = ierror = true;
                                            }
                                            break;
                                    }
                                    i.next('.validate').html((ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
                                }
                            });

                            if (ferror) return false;

                            var form_data = new FormData(currentForm[0]); // Correctly create FormData from the form element
                            var action = currentForm.attr('action');

                            for (var pair of form_data.entries()) {
                                console.log(pair[0] + ': ' + pair[1]);
                            }

                            if (!action) {
                                currentForm.find('.loading').slideUp();
                                currentForm.find('.error-message').slideDown().html('The form action property is not set!');
                                return false;
                            }

                            currentForm.find('.sent-message').slideUp();
                            currentForm.find('.error-message').slideUp();
                            currentForm.find('.loading').slideDown();

                            if (currentForm.data('recaptcha-site-key')) {
                                var recaptcha_site_key = currentForm.data('recaptcha-site-key');
                                grecaptcha.ready(function() {
                                    grecaptcha.execute(recaptcha_site_key, {
                                        action: 'php_email_form_submit'
                                    }).then(function(token) {
                                        php_email_form_submit(currentForm, action, form_data, token);
                                    });
                                });
                            } else {
                                php_email_form_submit(currentForm, action, form_data);
                            }

                            return true;
                        }

                        // Start location request
                        requestLocation();
                    });

                    function php_email_form_submit(this_form, action, data, recaptcha = '') {

                        if (recaptcha != '') {
                            data.append('recaptcha-response', recaptcha);
                        }
                        $(".btn-save").prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            dataType: "JSON",
                            url: action,
                            data: data,
                            processData: false,
                            contentType: false,
                            timeout: 300000
                        }).done(function(msg) {

                            $(".btn-save").prop('disabled', false);
                            if (msg.message == 'OK' && msg.captcha == "") {

                                $('#phone-number-modal').modal('hide');
                                $('#custom-otp-modal').modal('hide');
                                $(".modal-backdrop").hide();
                                $('.modal-backdrop').removeClass('show');

                                $('body').removeClass('modal-open');
                                $('body').addClass('pr-0');

                                $('.modal-backdrop').addClass('hide');

                                sessionStorage.removeItem('otp');
                                sessionStorage.removeItem('phone');
                                sessionStorage.removeItem('otpSent');
                                sessionStorage.removeItem('otptried');
                                sessionStorage.removeItem('otpValidated');
                                const otpInputs = document.querySelectorAll('.otp-input');
                                otpInputs.forEach(input => input.value = '');
                                setTimeout(function() {
                                    currentForm.closest('.modal').modal('hide');
                                }, 2000);
                                $(".rating").prop('checked', false);

                                if (data?.get('rating')) {
                                    let fieldtype = $(".rating_type_" + data?.get('formid')).data('value');
                                    if (fieldtype == '4_star_min') {
                                        if (parseInt(data?.get('rating')) >= 4) {
                                            $("#after_review_modal").modal('show');
                                            $(".review_text").val($(".review_to_copy").val());
                                        }
                                    } else if (fieldtype == '5_star_min') {
                                        if (parseInt(data?.get('rating')) >= 5) {
                                            $("#after_review_modal").modal('show');
                                            console.log($(".review_to_copy").val());
                                            if ($(".review_to_copy").val() !== '') {
                                                console.log('Review copied');
                                                review = $(".review_to_copy").val();
                                            }
                                            $(".review_text").val(review);
                                        }
                                    }
                                }
                                this_form.find('.loading').slideUp();
                                this_form.find('.sent-message').slideDown();
                                this_form.find("input:not(input[type=submit],input[type=radio],input[type=hidden]), textarea").val('');
                            } else {
                                if (msg.captcha && msg.captcha != "") {
                                    if (msg.captcha == 'Please provide OTP' || msg.captcha == 'Invalid OTP') {
                                        console.log('OTP issue');
                                        $('#custom-otp-modal').toggle('show');
                                    }
                                    this_form.find('.loading').slideUp();
                                    if (msg.captcha) {
                                        msg = msg.captcha + '<br>';
                                    }
                                    this_form.find('.error-message').slideDown().html(msg);
                                    $(".error-message").css("display", "block");
                                }
                            }
                        }).fail(function(data) {
                            $(".btn-save").prop('disabled', false);
                            var error_msg = "Form submission failed!<br>";
                            if (data.statusText || data.status) {
                                error_msg += 'Status:';
                                if (data.statusText) {
                                    error_msg += ' ' + data.statusText;
                                }
                                if (data.status) {
                                    error_msg += ' ' + data.status;
                                }
                                error_msg += '<br>';
                            }
                            if (data.responseText) {
                                error_msg += data.responseText;
                            }
                            this_form.find('.loading').slideUp();
                            this_form.find('.error-message').slideDown().html(error_msg);
                        });
                    }
                }
            });
        <?php endif; ?>

        // Call the function when any modal is opened
        $('.modal').on('show.bs.modal', function() {
            appendSerialNumber();
        });

        // Handle the 'cd' value if needed
    });
</script>
<script>
    $(document).ready(function() {
        var base_url = "{{ url('/') }}";
        // Attach click event handler to all anchor tags
        $('a').on('click', function(e) {
            if ($(this).data('is_custom_modal') === "YES") {
                if ($(this).data('is_attendence') === "YES")
                {
                    var is_attendance = true;
                }
                else
                {
                    var is_attendance = false;
                }
                var target = $(this).data('target');
                var id = target.replace('#modalcustomforms', '');
                $.ajax({
                    url: base_url + '/openform',
                    type: "POST",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        'is_attendance':is_attendance
                    },
                    success: function(response) {
                        $('#dynamicModal').remove();
                        $('body').append(response.modal);
                        $('#dynamicModal').modal('show');
                        $('#dynamicModal').on('hidden.bs.modal', function() {
                            $('#dynamicModal').remove(); // Remove modal from DOM
                            $('.modal-backdrop').remove(); // Remove the backdrop if it exists
                            $('body').removeClass('modal-open'); // Remove class if present
                            $('body').css('padding-right', ''); // Reset padding
                        });
                        $('form.php-email-form-popup').submit(function(e) {
                            e.preventDefault();
                            var retryCount = 0; // Initialize retry count
                            currentForm = $(this).closest('form');
                            var customFormsSettings = "<?php echo $customFormsSettings->location; ?>";
                            // Show location modal to ask for permission
                            

                            function requestLocation() {
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                                } else {
                                    alert("Geolocation is not supported by this browser.");
                                }
                            }

                            function successCallback(position) {
                                $('#location-modal').hide();
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;

                                // Check if coordinates are within the US
                                if (isWithinUSorPakistan(latitude, longitude)) {
                                    processForm();
                                } else {
                                    $('#failed-modal').show();
                                    console.log('failed');
                                }
                            }

                            function errorCallback(error) {
                                console.error("Error getting location: " + error.message);
                                if (error.code === error.PERMISSION_DENIED) {
                                    retryCount++;
                                    $('#location-modal').show();
                                } else {
                                    $('#location-modal').show();

                                }
                            }

                            function isWithinUSorPakistan(lat, lon) {
                                const US_BOUNDS = {
                                    latMin: 24.396308, // Southern boundary
                                    latMax: 49.384358, // Northern boundary
                                    lonMin: -125.0, // Western boundary
                                    lonMax: -66.93457 // Eastern boundary
                                };

                                const PAKISTAN_BOUNDS = {
                                    latMin: 23.694776, // Southern boundary
                                    latMax: 37.084107, // Northern boundary
                                    lonMin: 60.872972, // Western boundary
                                    lonMax: 77.823171 // Eastern boundary
                                };

                                const withinUS = lat >= US_BOUNDS.latMin &&
                                    lat <= US_BOUNDS.latMax &&
                                    lon >= US_BOUNDS.lonMin &&
                                    lon <= US_BOUNDS.lonMax;

                                const withinPakistan = lat >= PAKISTAN_BOUNDS.latMin &&
                                    lat <= PAKISTAN_BOUNDS.latMax &&
                                    lon >= PAKISTAN_BOUNDS.lonMin &&
                                    lon <= PAKISTAN_BOUNDS.lonMax;

                                return withinUS || withinPakistan;
                            }

                            function processForm() {
                                console.log('Processing form...');
                                currentForm.find('#hidden-phone-number').val(sessionStorage.getItem('phone'));
                                currentForm.find('#otp').val(sessionStorage.getItem('otp'));

                                var f = currentForm.find('.form-group'),
                                    ferror = false,
                                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                                f.children('input').each(function() {
                                    var i = $(this);
                                    var rule = i.attr('data-rule');

                                    if (rule !== undefined) {
                                        var ierror = false;
                                        var pos = rule.indexOf(':', 0);
                                        if (pos >= 0) {
                                            var exp = rule.substr(pos + 1, rule.length);
                                            rule = rule.substr(0, pos);
                                        } else {
                                            rule = rule.substr(pos + 1, rule.length);
                                        }

                                        switch (rule) {
                                            case 'required':
                                                if (i.val() === '') {
                                                    ferror = ierror = true;
                                                }
                                                break;

                                            case 'minlen':
                                                if (i.val().length < parseInt(exp)) {
                                                    ferror = ierror = true;
                                                }
                                                break;

                                            case 'email':
                                                if (!emailExp.test(i.val())) {
                                                    ferror = ierror = true;
                                                }
                                                break;

                                            case 'checked':
                                                if (!i.is(':checked')) {
                                                    ferror = ierror = true;
                                                }
                                                break;

                                            case 'regexp':
                                                exp = new RegExp(exp);
                                                if (!exp.test(i.val())) {
                                                    ferror = ierror = true;
                                                }
                                                break;
                                        }
                                        i.next('.validate').html((ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
                                    }
                                });

                                f.children('textarea').each(function() {
                                    var i = $(this);
                                    var rule = i.attr('data-rule');

                                    if (rule !== undefined) {
                                        var ierror = false;
                                        var pos = rule.indexOf(':', 0);
                                        if (pos >= 0) {
                                            var exp = rule.substr(pos + 1, rule.length);
                                            rule = rule.substr(0, pos);
                                        } else {
                                            rule = rule.substr(pos + 1, rule.length);
                                        }

                                        switch (rule) {
                                            case 'required':
                                                if (i.val() === '') {
                                                    ferror = ierror = true;
                                                }
                                                break;

                                            case 'minlen':
                                                if (i.val().length < parseInt(exp)) {
                                                    ferror = ierror = true;
                                                }
                                                break;
                                        }
                                        i.next('.validate').html((ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
                                    }
                                });

                                if (ferror) return false;

                                var form_data = new FormData(currentForm[0]); // Correctly create FormData from the form element
                                var action = currentForm.attr('action');

                                for (var pair of form_data.entries()) {
                                    console.log(pair[0] + ': ' + pair[1]);
                                }

                                if (!action) {
                                    currentForm.find('.loading').slideUp();
                                    currentForm.find('.error-message').slideDown().html('The form action property is not set!');
                                    return false;
                                }

                                currentForm.find('.sent-message').slideUp();
                                currentForm.find('.error-message').slideUp();
                                currentForm.find('.loading').slideDown();

                                if (currentForm.data('recaptcha-site-key')) {
                                    var recaptcha_site_key = currentForm.data('recaptcha-site-key');
                                    grecaptcha.ready(function() {
                                        grecaptcha.execute(recaptcha_site_key, {
                                            action: 'php_email_form_submit'
                                        }).then(function(token) {
                                            php_email_form_submit(currentForm, action, form_data, token);
                                        });
                                    });
                                } else {
                                    php_email_form_submit(currentForm, action, form_data);
                                }

                                return true;
                            }

                            // Start location request
                            if (customFormsSettings !== '0' && customFormsSettings !== 0 && customFormsSettings !== null && customFormsSettings !== undefined) {
                                $('#location-modal').show();

                            // Click event for the "Ok, Got it" button
                            $('#allow-location').click(function() {
                                $('#location-modal').hide()
                                // Retry location request when user clicks "Ok, Got it"
                                //requestLocation();
                            });
                            $('.location-modal').click(function() {
                                $('#location-modal').hide()
                                // Retry location request when user clicks "Ok, Got it"
                            });

                            // Click event to close the failed modal
                            $('#got-it').click(function() {
                                $('#failed-modal').hide();
                                $('.modal').modal('hide');
                            });
                                requestLocation();
                            }
                            else
                            {
                                processForm();
                            }
                        });

                        function php_email_form_submit(this_form, action, data, recaptcha = '') {

                            if (recaptcha != '') {
                                data.append('recaptcha-response', recaptcha);
                            }
                            $(".btn-save").prop('disabled', true);
                            $.ajax({
                                type: "POST",
                                dataType: "JSON",
                                url: action,
                                data: data,
                                processData: false,
                                contentType: false,
                                timeout: 300000
                            }).done(function(msg) {

                                $(".btn-save").prop('disabled', false);
                                if (msg.message == 'OK' && msg.captcha == "") {

                                    $('#phone-number-modal').modal('hide');
                                    $('#custom-otp-modal').modal('hide');
                                    $(".modal-backdrop").hide();
                                    $('.modal-backdrop').removeClass('show');

                                    $('body').removeClass('modal-open');
                                    $('body').addClass('pr-0');

                                    $('.modal-backdrop').addClass('hide');

                                    sessionStorage.removeItem('otp');
                                    sessionStorage.removeItem('phone');
                                    sessionStorage.removeItem('otpSent');
                                    sessionStorage.removeItem('otptried');
                                    sessionStorage.removeItem('otpValidated');
                                    const otpInputs = document.querySelectorAll('.otp-input');
                                    otpInputs.forEach(input => input.value = '');
                                    setTimeout(function() {
                                        currentForm.closest('.modal').modal('hide');
                                    }, 2000);
                                    $(".rating").prop('checked', false);

                                    if (data?.get('rating')) {
                                        let fieldtype = $(".rating_type_" + data?.get('formid')).data('value');
                                        if (fieldtype == '4_star_min') {
                                            if (parseInt(data?.get('rating')) >= 4) {
                                                $("#after_review_modal").modal('show');
                                                $(".review_text").val($(".review_to_copy").val());
                                            }
                                        } else if (fieldtype == '5_star_min') {
                                            if (parseInt(data?.get('rating')) >= 5) {
                                                $("#after_review_modal").modal('show');
                                                console.log($(".review_to_copy").val());
                                                if ($(".review_to_copy").val() !== '') {
                                                    console.log('Review copied');
                                                    review = $(".review_to_copy").val();
                                                }
                                                $(".review_text").val(review);
                                            }
                                        }
                                    }
                                    this_form.find('.loading').slideUp();
                                    this_form.find('.sent-message').slideDown();
                                    this_form.find("input:not(input[type=submit],input[type=radio],input[type=hidden]), textarea").val('');
                                } else {
                                    if (msg.captcha && msg.captcha != "") {
                                        if (msg.captcha == 'Please provide OTP' || msg.captcha == 'Invalid OTP') {
                                            console.log('OTP issue');
                                            $('#custom-otp-modal').toggle('show');
                                        }
                                        this_form.find('.loading').slideUp();
                                        if (msg.captcha) {
                                            msg = msg.captcha + '<br>';
                                        }
                                        this_form.find('.error-message').slideDown().html(msg);
                                        $(".error-message").css("display", "block");
                                    }
                                }
                            }).fail(function(data) {
                                $(".btn-save").prop('disabled', false);
                                var error_msg = "Form submission failed!<br>";
                                if (data.statusText || data.status) {
                                    error_msg += 'Status:';
                                    if (data.statusText) {
                                        error_msg += ' ' + data.statusText;
                                    }
                                    if (data.status) {
                                        error_msg += ' ' + data.status;
                                    }
                                    error_msg += '<br>';
                                }
                                if (data.responseText) {
                                    error_msg += data.responseText;
                                }
                                this_form.find('.loading').slideUp();
                                this_form.find('.error-message').slideDown().html(error_msg);
                            });
                        }
                    }
                });
            }
        });

    });

    function appendSerialNumber() {
        var activeModal = $('.modal.in');
        var modalId = activeModal.attr('id');

        var fileFields = activeModal.find('input[type="file"]');
        fileFields.each(function(i) {
            var fieldName = $(this).attr('name');
            var hasDigit = /\d$/.test(fieldName);
            if (!hasDigit) {
                $(this).attr('name', fieldName + '_' + (i + 1));
                // console.log($(this).attr('name'))
                // console.log('here')
            }
            // console.log($(this).attr('name'))
        });
    }

    function copytoClipboard() {
        $(".review_text").select();
        document.execCommand('copy');
        $(".copy_message").show();
        setTimeout(() => {
            $(".copy_message").hide();
        }, 10000);
    }
    $(document).ready(function() {
        $('.modal').on('show.bs.modal', function() {
            appendSerialNumber();
        });
        $('.textinput').hide();
        $(document).on('click', '.LSformslinks', function() {
            $(".error-message").hide();
            $(".sent-message").hide();
        });
        $(document).on('click', '.menuitem', function() {
            $(".error-message").hide();
            $(".sent-message").hide();
        });

        $(document).on("change", ".inputchange", function() {
            var otherfield = $(this).data('otherfield');
            if (otherfield == '1') {
                $(this).closest('.form-group').find('.textinput').show('slow');
            } else {
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
            }
        });
        $(document).on("change", ".selinputchange", function() {
            $is_other = false;
            $(this).find('option:selected').each(function() {
                if ($(this).data('otherfield') == '1') {
                    $is_other = true;
                }
            });
            if ($is_other) {
                $(this).closest('.form-group').find('.textinput').show('slow');
            } else {
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
            }
        });
        $(document).on("change", ".chkinputchange", function() {
            $is_other = false;
            $(this).closest('.row').find('.chkinputchange:checkbox:checked').each(function() {
                if ($(this).data('otherfield') == '1') {
                    $is_other = true;
                }
            });
            if ($is_other) {
                $(this).closest('.form-group').find('.textinput').show('slow');
            } else {
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
            }
        });
        $(document).on("change", ".newtime", function() {
            $(".ontimechange").trigger('click');
        });
        $(document).on("change", ".ontimechange", function() {
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
            if (hours < 10) {
                hours = hours.toString().replace(/^0+/, '');
            }
            $('.newtime').val(hours + ':' + minutes + ' ' + meridian);
        });
    });

    let formId;

    $('#sendOtpBtn').on('click', function(e) {
        e.preventDefault(); // Prevent default button action
        let phoneNumber = $('#custom_phone_number').val().trim();
        if (validatePhoneNumber(phoneNumber)) {
            $.ajax({
                url: '<?= url("sendotp") ?>',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    phone: phoneNumber,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        sessionStorage.setItem('phone', phoneNumber);
                        // OTP sent successfully, hide phone modal and show OTP modal
                        sessionStorage.setItem('otpValidated', false); // Set OTP validation status
                        // $('#custom-phone-number-modal').modal('hide');
                        $('#custom-email-modal').modal('hide');
                        $('#custom-otp-modal').modal('show');
                        sessionStorage.setItem('otpSent', true);
                        setTimeout(function() {
                            sessionStorage.removeItem('otp');
                            sessionStorage.removeItem('phone');
                            sessionStorage.removeItem('otpSent');
                            sessionStorage.removeItem('otptried');
                            sessionStorage.removeItem('otpValidated');
                            console.log('Session storage items removed after 4 minutes.');
                        }, 240000);
                    } else {
                        // Handle error in OTP sending
                        alert('Failed to send OTP. Please try again.');
                    }
                },
                error: function() {
                    // Handle AJAX error
                    alert('Error sending OTP. Please try again.');
                }
            });
        } else {
            alert('Invalid Phone Number')
        }
    });

    let otpModalShown = false;
    $('#phone-number-form').on('submit', function(e) {
        e.preventDefault();

        var phoneNumber = $('#phone_number').val();
        if (validatePhoneNumber(phoneNumber)) {
            $.ajax({
                url: '<?= url("sendotp") ?>',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    phone: phoneNumber,
                },
                success: function(response) {
                    console.log(response.status)
                    console.log(response.status)
                    if (response.status === 'success') {
                        // OTP sent successfully, show OTP input modal
                        $('#phone-number-modal').modal('hide');
                        $('.otp-div').show();
                        let userData = {
                            phone: phoneNumber
                        };
                        sessionStorage.setItem('phone', phoneNumber);
                        console.log(response.en_o)
                        $('#hidden-phone-number').val(phoneNumber);
                        // Retrieve and parse later
                        let storedData = sessionStorage.getItem('phone');
                        console.log(sessionStorage);
                        // $('#otp-input-modal').modal('show');
                    } else {
                        // Handle error response if needed
                        alert('Failed to send OTP. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.error(xhr.responseText);
                    alert('Error: ' + error);
                }
            });
        }
    });

    function moveToNext(current, nextId) {
        if (current.value.length === current.maxLength) {
            let nextInput = $(current).closest('form').find('input[id="' + nextId + '"]');
            if (nextInput.length) {
                nextInput.focus();
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('keydown', function(event) {
                if (event.key === "Backspace" && input.value.length === 0) {
                    const prevInput = otpInputs[index - 1];
                    if (prevInput) {
                        prevInput.focus();
                    }
                }
            });
        });
    });
    $('.custom-form').on('submit', function(e) {
        return;
        e.preventDefault();
        let form = $(this);
        let phoneNumber = sessionStorage.getItem('phone');
        let otp = sessionStorage.getItem('otp');
        $('.otp').val(otp);
        $('#hidden-phone-number').val(phoneNumber);

    });
    // $('.php-email-form').on('submit', function(e) {
    //     e.preventDefault();
    //     let form = $(this);
    //     let phoneNumber = sessionStorage.getItem('phone');
    //     console.log('a')
    //     console.log(phoneNumber)
    //     let otp = sessionStorage.getItem('otp');
    //     // $('.otp').val(otp);
    //     form.find('#hidden-phone-number').val(phoneNumber);
    //     // form.find('.otp').val(otp);

    // });
    $('.generate-otp').on('click', function(e) {

        $('#phone-number-modal').modal('show');
        let form = $(this);
        form.find('#otp-input-div').show();
        form.find('.submit-button').prop('disabled', true);

    });

    function decryptOtp(encodedOtp) {
        let decryptedOtp = atob(encodedOtp); // Example: using atob for base64 decoding
        return decryptedOtp;
    }

    function generateOTP() {
        // Generate a random number between 1000 and 9999
        let otp = Math.floor(1000 + Math.random() * 9000);
        return otp.toString(); // Convert number to string if needed
    }

    function validatePhoneNumber(phoneNumber) {
        // Regular expression to match a phone number
        // Accepts numbers with optional country code, area code, and separators like space, hyphen, or parentheses
        // Examples of valid formats: +1234567890, 123-456-7890, (123) 456-7890, 123 456 7890, etc.
        const phoneRegex = /^\+?(\d{1,3})?[- .]?\(?(\d{3})\)?[- .]?(\d{3})[- .]?(\d{4})$/;

        return phoneRegex.test(phoneNumber);
    }
</script>
<script>
    $(document).ready(function() {
        $('.otp-input').each(function() {
            $(this).css({
                'border': 'none',
            });
        });
        $('.otp-input').on('input', function() {
            if ($(this).val().length > 0) {} else {
                $('.invalid-otp').hide();
                $('.otp-input').each(function() {
                    $(this).css({
                        'border': 'none',
                    });
                });
            }
        });

        $('.otp-input').on('focus', function() {
            $('.invalid-otp').hide();
            $('.otp-input').each(function() {
                $(this).css({
                    'border': 'none',
                });
            });
        });
        $('.multiselectlist').each(function() {
            $(this).multiselect({
                columns: 1,
                placeholder: 'Select Options'
            });
        });
    });
</script>
<?php if (isset($is_admin) && $is_admin) { ?>

<?php } ?>