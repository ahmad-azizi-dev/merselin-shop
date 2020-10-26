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
            <a href="{{ URL::previous() }}">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">@lang('mainFrontend.FooterNav-cart')</h6>
        </div>
        <!-- Navbar -->
        <div class="d-flex flex-wrap">
            <a href="{{route('login')}}">
                <i class="lni lni-user "></i> @lang('mainFrontend.Navbar-login')
            </a>
        </div>
    </x-header>

    <div class="page-content-wrapper">
        @livewire('frontend.cart', ['cartProducts' => $cartProducts ])
    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')

        @livewireScripts

        <script src="{{asset('js/waypoints.min.js')}}"></script>
        <script src="{{asset('js/jquery.counterup.min.js')}}"></script>

        <script>
            @include('frontend.partials.counterUp')
        </script>
        @include('frontend.cart.AddToCartNotify')

    @endpush

</x-frontend-layout>




