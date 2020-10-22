<div>
    <!-- loading-->
    <div wire:loading class="preloader2">
        <div class="preloader3">
            <div class="spinner-grow text-secondary"></div>
            <div class="text-primary">@lang('mainFrontend.Preloader')</div>
        </div>
    </div>

    <!-- Top Products-->
@include('frontend.partials.TopProducts')

<!-- Cool Facts Area-->
@include('frontend.partials.CoolFactsArea')

<!-- Weekly Best Sellers-->
    @include('frontend.partials.WeeklyBestSellers')

</div>
