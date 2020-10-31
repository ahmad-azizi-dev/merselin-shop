<script type="text/javascript">
    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                form.submit();
            }
        });
        $('#quickForm').validate({
            rules: {
                phoneNumber: {
                    required: true,
                    normalizer: function (value) {
                        if (value = parseInt(value, 10)) {
                            return $.trim(value);
                        }
                        return null;
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
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger d-block');
                element.closest('#quickForm').append(error);
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
