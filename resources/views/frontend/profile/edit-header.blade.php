<x-header>
    <!-- Back Button-->
    <div class="back-button">
        <a href="{{($url = session('previousProfileUrl')) ? $url : route('profile') }}">
            <i class="lni lni-arrow-right"></i>
        </a>
    </div>
    <!-- Page Title-->
    <div class="page-heading">
        <h6 class="mb-0">{{__('mainFrontend.Edit').' '.__('mainFrontend.Profile')}}</h6>
    </div>
@guest
    <!-- Navbar -->
        <div class="d-flex flex-wrap">
            <a href="{{route('frontendLogin')}}"> <i class="lni lni-user "></i> @lang('mainFrontend.Navbar-login')
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
