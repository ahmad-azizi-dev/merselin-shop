<div class="weekly-best-seller-area py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="pl-1">@lang('mainFrontend.WeeklyBestSellers')</h6>
            <a class="btn btn-success btn-sm" href="#"> @lang('mainFrontend.ViewAll') </a>
        </div>
        <div class="row g-3">
            <!-- Single Weekly Product Card-->
            @include('frontend.partials.product-list',['products'=>$TopProducts])
        </div>
    </div>
</div>
