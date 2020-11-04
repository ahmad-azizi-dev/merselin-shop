@auth
    <!-- Sidenav Black Overlay-->
    <div class="sidenav-black-overlay"></div>
    <!-- Side Nav Wrapper-->
    <div class="suha-sidenav-wrapper" id="sidenavWrapper">
        <!-- Sidenav Profile-->
        <div class="sidenav-profile">
            <div class="user-profile"><img src="{{asset('img/personal.png')}}" alt="user img"></div>
            <div class="user-info">
                <p class="mb-0 mt-4">
                    @lang('mainFrontend.UserName')
                </p>
                <p class="mb-0 mt-0 text-warning">
                    {{($name=auth()->user()->name)=='not_set' ? trans('mainFrontend.NotSet') : $name}}
                </p>
                <p class="mb-0 mt-2"> @lang('mainFrontend.PhoneNumber')</p>
                <p class="mb-2 mt-0">0{{auth()->user()->phone_number}}</p>

            </div>
        </div>
        <!-- Sidenav Nav-->
        <ul class="sidenav-nav pl-0 mt-2">
            <li><a href="#"><i class="lni lni-user"></i>@lang('mainFrontend.Profile')</a></li>
            <li><a href="#"><i class="lni lni-alarm lni-tada-effect">
                    </i>@lang('mainFrontend.Notifications')
                    <span class="ml-2 badge badge-warning">3</span>
                </a>
            </li>
            <li class="suha-dropdown-menu">
                <a href="#"><i class="lni lni-cart-full"></i>
                    @lang('mainFrontend.FooterNav-cart')
                </a>
                <ul>
                    <li><a href="#">---</a></li>
                    <li><a href="#">---</a></li>
                    <li><a href="#">---</a></li>
                    <li><a href="#">---</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="lni lni-investment"></i> @lang('mainFrontend.PurchaseHistory')</a></li>
            <li class="suha-dropdown-menu">
                <a href="#"><i class="lni lni-heart"></i>
                    @lang('mainFrontend.FooterNav-heart')
                </a>
                <ul>
                    <li><a href="#">----</a></li>
                    <li><a href="#">----</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="lni lni-cog"></i> @lang('mainFrontend.FooterNav-settings')</a>
            </li>

            <form id="logout-form" action="{{ route('frontendLogout') }}" method="POST" class="d-none">
                @csrf
            </form>

            <li>
                <a class="dropdown-item" href="{{ route('frontendLogout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="lni lni-power-switch"></i>
                    @lang('mainFrontend.Exit')
                </a>
            </li>
        </ul>
        <!-- Go Back Button-->
        <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-right"></i></div>
    </div>
@endauth
