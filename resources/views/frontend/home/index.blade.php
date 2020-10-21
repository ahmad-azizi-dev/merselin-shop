@extends('frontend.layout.main')

@section('head')
    <meta name="description" content="---">
    <!-- Title-->
    <title>@lang('mainFrontend.title')</title>
@endsection


@section('content')

    <!-- Header Area-->
    @include('frontend.partials.HeaderArea')

    <div class="page-content-wrapper">

        <!-- Hero Slides-->
    @include('frontend.partials.HeroSlides')

    <!-- Product Categories-->
    @include('frontend.partials.ProductCategories')

    <!-- Flash Sale Slide-->
    @include('frontend.partials.FlashSaleSlide')

    <!-- Top Products-->
    @include('frontend.partials.TopProducts')

    <!-- Cool Facts Area-->
    @include('frontend.partials.CoolFactsArea')

    <!-- Weekly Best Sellers-->
    @include('frontend.partials.WeeklyBestSellers')

    <!-- Discount Coupon Card-->
    @include('frontend.partials.DiscountCouponCard')

    <!-- Night Mode View Card-->
        @include('frontend.partials.NightModeViewCard')

    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

@endsection


@section('script')

    <script src="{{asset('js/owl.carousel.min.js')}}"></script>

    @include('frontend.partials.AddToCartNotify')
@endsection



