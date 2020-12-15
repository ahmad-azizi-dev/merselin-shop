<x-frontend-layout>

    @push('head')
        <meta name="description" content="cart">
        <!-- Title-->
        <title>@lang('mainFrontend.FooterNav-cart')</title>
        @livewireStyles
    @endpush

<!-- Header Area-->
    <x-header>
        <!-- Back Button-->
        <div class="back-button">
            <a href="{{($url = session('beforeCartUrl')) ? $url : route('home') }}">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">@lang('mainFrontend.FooterNav-cart')</h6>
        </div>
    @guest
        <!-- Navbar -->
            <div class="d-flex flex-wrap">
                <a href="{{route('frontendLogin')}}">
                    <i class="lni lni-user "></i> @lang('mainFrontend.Navbar-login')
                </a>
            </div>
    @endguest

    @auth
        <!-- Navbar Toggler-->
            <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler">
                <span></span>
                <span></span>
                <span></span>
            </div>
        @endauth

    </x-header>

    @livewire('frontend.cart', ['cartProducts' => $cartProducts ])

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')

        @livewireScripts

        <script src="{{asset('js/waypoints.min.js')}}"></script>
        <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('js/jquery.validate.min.js')}}"></script>
        <script>
            @include('frontend.partials.counterUp')

            $(document).ready(function () {
                $.validator.setDefaults({
                    submitHandler: function () {
                        Livewire.emit('checkCoupon')
                    }
                });
                $('#coupon').validate({
                    rules: {
                        couponCode: {
                            required: true,
                            rangelength: [5, 10],
                        },
                    },
                    messages: {
                        couponCode: {
                            required: "@lang('product.requiredCoupon')",
                            rangelength: "@lang('mainFrontend.CorrectCode')",
                        },
                    },
                    errorElement: 'p',
                    errorPlacement: function (error, element) {
                        error.addClass('text-danger my-1 ml-1');
                        $('#couponCode-error').html(error);
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
		@include('frontend.partials.modal-script')
        @include('frontend.cart.cartNotify')

    @endpush

</x-frontend-layout>




