<div class="top-products-area clearfix py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">@lang('mainFrontend.TopProducts')</h6>
            <a class="btn btn-primary btn-sm" href="#">@lang('mainFrontend.ViewAll')</a>
        </div>
        <div class="row g-3">
            <!-- Single Top Product Card-->
            @foreach($TopProducts as $product)
                <x-product :product=$product :cartProducts=$cartProducts></x-product>
            @endforeach
        </div>
    </div>
</div>
