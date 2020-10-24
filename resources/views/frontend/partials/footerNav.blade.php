<div class="footer-nav-area" id="footerNav">
    <div class="container h-100 px-0">
        <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between pl-0">
                <li class="active">
                    <a href="{{URL::current()==route('home')?'#':route('home')}}">
                        <i class="lni lni-home"></i>
                        @lang('mainFrontend.FooterNav-home')
                    </a>
                </li>
                <li><a href="#"><i class="lni lni-life-ring"></i>@lang('mainFrontend.FooterNav-message')</a></li>
                <li><a href="#"><i class="lni lni-heart"></i>@lang('mainFrontend.FooterNav-heart')</a></li>
                <li>
                    <a href="{{URL::current()==route('cart')?'#':route('cart')}}">
                        <i id="lniCart" class="lni
                           {{ ($totalCart= count(array_unique($cartProducts)) ) ? 'lni-cart-full' : 'lni-cart' }} ">
                        </i>@lang('mainFrontend.FooterNav-cart')
                        <span id="Cart" class="text-danger">
                            {{ $totalCart ? '('. $totalCart .')' : '' }}
                        </span>
                    </a>
                </li>
                <li><a href="#"><i class="lni lni-cog"></i>@lang('mainFrontend.FooterNav-settings')</a></li>
            </ul>
        </div>
    </div>
</div>
