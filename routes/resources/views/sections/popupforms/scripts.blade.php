<?php if(isset($_GET['pop'])){  $popValue = rtrim($_GET['pop'], '/'); 
if($_GET['pop'] == 8)
{
    $optOutId = get_opt_out_form_id();
    $popValue = $optOutId->encoded_id;
}
?>
    <script>
       
        $(document).ready(function() {
           $('#modalcustomforms<?=$popValue ?>').modal('show');
           $('#modalcustomforms<?=$popValue ?>').css('display','block');


    // Call the function when any modal is opened
    $('.modal').on('show.bs.modal', function() {
        appendSerialNumber();
    });
         
        });
    </script>
<?php } ?>
<script>
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
    function copytoClipboard(){
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
        $(document).on('click','.LSformslinks',function() {
            $(".error-message").hide();
            $(".sent-message").hide();
        });
        $(document).on('click','.menuitem',function() {
            $(".error-message").hide();
            $(".sent-message").hide();
        });
        
        $(document).on("change",".inputchange",function() {
            var otherfield = $(this).data('otherfield');
            if(otherfield=='1'){
                $(this).closest('.form-group').find('.textinput').show('slow');
            }else{
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
            }
        });
        $(document).on("change",".selinputchange",function() {
            $is_other = false;
            $(this).find('option:selected').each(function() {
                if($(this).data('otherfield')=='1'){
                    $is_other = true;
                }
            });
            if($is_other){
                $(this).closest('.form-group').find('.textinput').show('slow');
            }else{
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
            }
        });
        $(document).on("change",".chkinputchange",function() {
            $is_other = false;
            $(this).closest('.row').find('.chkinputchange:checkbox:checked').each(function() {
                if($(this).data('otherfield')=='1'){
                    $is_other = true;
                }
            });
            if($is_other){
                $(this).closest('.form-group').find('.textinput').show('slow');
            }else{
                $(this).closest('.form-group').find('.textinput').hide('slow');
                $(this).closest('.form-group').find('.textinput').val('');
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

    let currentForm;
    let formId;
    $('#sendOtpBtn').on('click', function (e) {
            e.preventDefault(); // Prevent default button action
            let phoneNumber = $('#custom_phone_number').val().trim();
            if(validatePhoneNumber(phoneNumber))
            {
                $.ajax({
                    url: '<?= url("sendotp") ?>', 
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            phone: phoneNumber,
                        },
                    success: function (response) {
                        if (response.status == 'success') {
                            sessionStorage.setItem('phone', phoneNumber);
                            // OTP sent successfully, hide phone modal and show OTP modal
                            sessionStorage.setItem('otpValidated', false); // Set OTP validation status
                            $('#custom-phone-number-modal').modal('hide');
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
                    error: function () {
                        // Handle AJAX error
                        alert('Error sending OTP. Please try again.');
                    }
                });
            }
            else
            {
                alert('Invalid Phone Number')
            }
        });

    let otpModalShown = false;
    $('#phone-number-form').on('submit', function(e) {
            e.preventDefault();

            var phoneNumber = $('#phone_number').val();
            if(validatePhoneNumber(phoneNumber))
            {
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
                            let userData = { phone: phoneNumber };
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
// function setSessionStorage() {
//                 sessionStorage.setItem('otp', false);
//                 sessionStorage.setItem('phone', '');
//                 sessionStorage.setItem('otpSent', false);
//                 sessionStorage.setItem('otptried', false);
//                 sessionStorage.setItem('otpValidated', false);
//             console.log('Items have been set in session storage.');
//         }
        $('.custom-otp-submit-btn').on('click', function (e) {
    e.preventDefault(); // Prevent default button action

    // Get OTP input values
    let otpInput = [
        $('#otp-1').val().trim(),
        $('#otp-2').val().trim(),
        $('#otp-3').val().trim(),
        $('#otp-4').val().trim()
    ].join('');

    let storedOtp = sessionStorage.getItem('otp'); // Retrieve stored OTP

    // Ensure the OTP input is valid before proceeding
    if (otpInput.length !== 4) {
        alert('Please enter the complete OTP.');
        return;
    }

    // Make the AJAX call to verify the OTP
    $.ajax({
        url: '<?= url("verifyotp") ?>', 
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            phone: sessionStorage.getItem('phone'),
            otp: otpInput, // Use the collected OTP input
        },
        success: function (response) {
            if (response.status) {
                sessionStorage.setItem('otp',otpInput)
                // OTP sent successfully, hide phone modal and show OTP modal
                sessionStorage.setItem('otpValidated', true); // Set OTP validation status
                $('#custom-phone-number-modal').modal('hide');
                $('#custom-otp-modal').modal('hide');
                currentForm.submit();
                // currentForm.submit();

                console.log(currentForm);
                // sessionStorage.setItem('otpSent', true);
            } else {
                // Handle error in OTP sending
                alert('Invalid OTP');
            }
        },
        error: function () {
            // Handle AJAX error
            alert('Error sending OTP. Please try again.');
        }
    });
});



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
        $('.multiselectlist').each(function(){
            $(this).multiselect({
                columns: 1,
                placeholder: 'Select Options'
            });
        });
    });
</script>
<?php if(isset($is_admin) && $is_admin){ ?>
    <script src="<?= url('assets/front/'); ?>/vendor/php-email-form/validate.js"></script>
<?php } ?>