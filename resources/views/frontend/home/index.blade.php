<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.title')</title>
        @livewireStyles
    @endpush


<!-- Header Area-->
    @include('frontend.partials.HeaderArea')

    <div class="page-content-wrapper mb-3">

        <!-- Hero Slides-->
    @include('frontend.partials.HeroSlides')

    <!-- Product Categories-->
    @include('frontend.partials.ProductCategories',['title'=>trans('mainFrontend.ProductCategories')])

    <!-- Flash Sale Slide-->
        @include('frontend.partials.FlashSaleSlide')

    </div>

    @livewire('frontend.home', ['TopProducts' => $TopProducts,
    'cartProducts' => $cartProducts ])

    <div class="page-content-wrapper">

        <!-- Discount Coupon Card-->
    @include('frontend.partials.DiscountCouponCard')

    <!-- Night Mode View Card-->
        @include('frontend.partials.NightModeViewCard')

    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')


    @push('script')
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        @livewireScripts
		@include('frontend.partials.cart-modal-script')
        @include('frontend.partials.AddToCartNotify')
    @endpush

</x-frontend-layout>

