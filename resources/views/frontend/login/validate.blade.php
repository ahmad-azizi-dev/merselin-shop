<script type="text/javascript">
    var submit = true;

    if (!$("#phone_number").val()) {
        $("div.captcha").hide();
        submit = false;
    }

    function dropdownCaptcha() {
        $("div.captcha").fadeIn(700);
        submit = true;
    }

    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                if (submit) form.submit();
                dropdownCaptcha();
            }
        });
        $('#loginForm').validate({
            rules: {
                phoneNumber: {
                    required: true,
                    normalizer: function (value) {
                        if (value.length < 12)
                            if (value = parseInt(value, 10)) {
                                return $.trim(value);
                            }
                        return value;
                    },
                    number: true,
                    minlength: 10,
                    maxlength: 10,
                    min: 9000000000, //should change in some countries
                },
                CountryCodes: {
                    required: true,
                    min: 98, //should change in some countries
                },
                captcha: {
                    required: true,
                    minlength: 2,
                    maxlength: 3,
                },
            },
            messages: {
                phoneNumber: {
                    required: "@lang('mainFrontend.RequiredPhoneNumber')",
                    number: "@lang('mainFrontend.CorrectPhoneNumber')",
                    minlength: "@lang('mainFrontend.CorrectPhoneNumber')",
                    maxlength: "@lang('mainFrontend.CorrectPhoneNumber')",
                    min: "@lang('mainFrontend.CorrectPhoneNumber')",
                },
                CountryCodes: {
                    required: "@lang('mainFrontend.RequiredPhoneNumber')",
                    min: "@lang('mainFrontend.CorrectCountryCodes')",
                },
                captcha: {
                    required: "@lang('mainFrontend.RequiredCode')",
                    minlength: "@lang('mainFrontend.CorrectCode')",
                    maxlength: "@lang('mainFrontend.CorrectCode')",
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger d-block');
                element.closest('#loginForm').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('text-warning');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('text-warning');
            }
        });
    });
</script>
