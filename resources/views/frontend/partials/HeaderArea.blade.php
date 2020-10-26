<x-header>
    <!-- Logo Wrapper-->
    <div class="logo-wrapper"><a href="home.html"><img src="https://placehold.it/35x35" alt=""></a></div>
    <!-- Search Form-->
    <div class="top-search-form">
        <form action="#" method="">
            <input class="form-control" type="search" placeholder="@lang('mainFrontend.SearchForm')">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- Navbar -->
    <div class="d-flex flex-wrap">
        <a href="{{route('login')}}"> <i class="lni lni-user "></i> @lang('mainFrontend.Navbar-login')
        </a>
    </div>

</x-header>
