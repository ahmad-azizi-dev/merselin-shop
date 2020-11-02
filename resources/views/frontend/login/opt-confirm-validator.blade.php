<script>
    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                form.submit();
            }
        });

        const validations = {
            required: true,
            number: true,
        };
        const validationMessages = {
            required: "@lang('mainFrontend.RequiredCode')",
            number: "@lang('mainFrontend.CorrectCode')",
        };

        $('#otpConfirmForm').validate({
            rules: {
                otp1: validations,
                otp2: validations,
                otp3: validations,
                otp4: validations,
                otp5: validations,
            },
            messages: {
                otp1: validationMessages,
                otp2: validationMessages,
                otp3: validationMessages,
                otp4: validationMessages,
                otp5: validationMessages,
            },
            groups: {
                opt: "otp1 otp2 otp3 otp4 otp5"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger d-block');
                element.closest('#otpConfirmForm').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('text-danger');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('text-danger');
            }
        });
    });
</script>
