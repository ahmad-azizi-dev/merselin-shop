<x-footer>

    <li class="active">
        <a href="{{Request::routeIs('home')?'#':route('home')}}">
            <i class="lni lni-home"></i>
            @lang('mainFrontend.FooterNav-home')
        </a>
    </li>
    <li><a href="#"><i class="lni lni-whatsapp"></i>@lang('mainFrontend.FooterNav-message')</a></li>
    <li><a href="#"><i class="lni lni-heart"></i>@lang('mainFrontend.FooterNav-heart')</a></li>
    <li>
        <a href="{{Request::routeIs('cart')?'#':route('cart')}}">
            <i id="lniCart" class="lni
                           {{ ($totalCart= count(array_unique($cartProducts)) ) ? 'lni-cart-full lni-tada-effect' : 'lni-cart' }} ">
            </i>@lang('mainFrontend.FooterNav-cart')
            <span id="Cart" class="text-danger">
                {{ $totalCart ? '('. $totalCart .')' : '' }}
            </span>
        </a>
    </li>
    <li><a href="#"><i class="lni lni-cog"></i>@lang('mainFrontend.FooterNav-settings')</a></li>

</x-footer>

@push('script')
    @if(Session::has('SuccessfulLogin'))
        <script>
            $("body").append("<div class='notification-login animated fadeIn'> {{Session('SuccessfulLogin')}} </div>");
            $(".notification-login").delay(6000).fadeOut();
        </script>
    @elseif(Session::has('SuccessfulLogout'))
        <script>
            $("body").append("<div class='notification-login animated fadeIn bg-danger'> {{Session('SuccessfulLogout')}} </div>");
            $(".notification-login").delay(6000).fadeOut();
        </script>
    @elseif(Session::has('SuccessProfileEdit'))
        <script>
            $("body").append("<div class='notification-login animated fadeIn bg-warning'> {{Session('SuccessProfileEdit')}} </div>");
            $(".notification-login").delay(6000).fadeOut();
        </script>
    @endif
@endpush
