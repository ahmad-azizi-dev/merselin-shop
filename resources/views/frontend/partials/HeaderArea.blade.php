<x-header>
    <!-- Logo Wrapper-->
    <div class="logo-wrapper"><a href="#"><img src="https://placehold.it/35x35" alt=""></a></div>
    <!-- Search Form-->
    <div class="top-search-form">
        <form action="#" method="">
            <input class="form-control" type="search" placeholder="@lang('mainFrontend.SearchForm')">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
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

@include('frontend.partials.SidebarWrapper')
