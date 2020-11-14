<script>

    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                form.submit();
            }
        });
        $('#profileForm').validate({
            rules: {
                name: {
                    required: true,
                    rangelength: [6, 100],
                },
                email: {
                    required: false,
                    email: true,
                    rangelength: [6, 100],
                },
                shipping_address: {
                    required: true,
                    rangelength: [30, 255],
                },
            },
            messages: {
                name: {
                    required: "@lang('mainFrontend.RequiredName')",
                    rangelength: "@lang('mainFrontend.ValidName')",
                },
                email: {
                    email: "@lang('mainFrontend.ValidEmail')",
                    rangelength: "@lang('mainFrontend.ValidEmail')",
                },
                shipping_address: {
                    required: "@lang('mainFrontend.RequiredShippingAddress')",
                    rangelength: "@lang('mainFrontend.ValidShippingAddress')",
                },
            },
            groups: {
                profileForm: "name email shipping_address"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('text-danger validation-error-message');
                element.closest('#profileForm').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

</script>
