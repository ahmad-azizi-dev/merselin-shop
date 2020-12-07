<x-frontend-layout>

    @push('head')
        <meta name="description" content="cart">
        <!-- Title-->
        <title>{{ __('product.title') . $product->title }} </title>
        @livewireStyles
        <link href="{{asset('css/simple-lightbox.css')}}" rel="stylesheet"/>
    @endpush

<!-- Header Area-->
    <x-header>
        <!-- Back Button-->
        <div class="back-button">
            <a href="{{($url = session('beforeProductUrl')) ? $url : route('home') }}">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">@lang('product.title')</h6>
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

    <div class="page-content-wrapper mb-0">
        @include('frontend.show-product.productData')
    </div>

    @livewire('frontend.product', ['cartProducts' => $cartProducts,
    'product' => $product, 'currentUrl' => URL::current()])

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('js/simple-lightbox.jquery.min.js')}}"></script>
        <script>
            var gallery = $('a.z1').simpleLightbox({
                // image preloading
                preloading: false,
                // RTL mode
                rtl: true,
                // width / height ratios
                widthRatio: 1,
                heightRatio: 1,
                // show an alert if image was not found
                alertError: false,
                // adds class to html element if lightbox is open
                htmlClass: 'product-magnifier',
                // closes the lightbox when clicking outside
                docClose: false,
                // swipe up or down to close gallery
                swipeClose: false,
                // whether to uniqualize images
                uniqueImages: false,
            });
        </script>
        @livewireScripts
        @include('frontend.partials.cart-modal-script')
        @include('frontend.partials.AddToCartNotify')

    @endpush

</x-frontend-layout>




