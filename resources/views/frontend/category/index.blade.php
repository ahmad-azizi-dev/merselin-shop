<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.CategoriesTitle') {{$thisCategory->name}}</title>
        @livewireStyles
    @endpush
    
<!-- Header Area-->
    @include('frontend.partials.HeaderArea')

    <div class="page-content-wrapper mb-3">
        <!-- Catagory Single Image-->
        <div class="catagory-single-img" style="background-image: url('https://placehold.it/1920x310')"></div>

        <!-- Product Categories-->
        @include('frontend.partials.ProductCategories',['title'=>trans('mainFrontend.SubCategories')])
    </div>

    @livewire('frontend.category', ['thisCategory' => $thisCategory,
    'cartProducts' => $cartProducts ])

    <div class="page-content-wrapper">
        <!-- Night Mode View Card-->
        @include('frontend.partials.NightModeViewCard')

    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        @livewireScripts
        @include('frontend.partials.cart-modal-script')
        @include('frontend.partials.AddToCartNotify')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.sent', (message, component) => {
                    $("#paginate-loading").addClass("paginate-loading");
                })
                Livewire.hook('message.processed', (message, component) => {
                    $("#paginate-loading").removeClass("paginate-loading");
                })
            });
        </script>
    @endpush

</x-frontend-layout>

