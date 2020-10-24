@extends('frontend.layout.main')

@section('head')
    <meta name="description" content="cart">
    <!-- Title-->
    <title>@lang('mainFrontend.FooterNav-cart')</title>
    @livewireStyles
@endsection

@section('content')

    <!-- Header Area-->
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between">
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
        </div>
    </div>

    <div class="page-content-wrapper">
        @livewire('frontend.cart', ['cartProducts' => $cartProducts ])
    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

@endsection

@section('script')

    @livewireScripts

    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>

    <script>
        //  Counter Up
        if ($.fn.counterUp) {
            $('.counter').counterUp({
                delay: 100,
                time: 1000
            });
        }
    </script>

    @include('frontend.cart.AddToCartNotify')

@endsection



