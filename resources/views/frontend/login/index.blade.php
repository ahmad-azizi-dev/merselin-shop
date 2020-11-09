<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.RegisterOrLogin')</title>
        @livewireStyles
    @endpush

<!-- Login Wrapper Area-->
    <x-login-wrapper>

        <div class="text-left px-4 mt-4">
            <h6 class="mb-2 text-white">
                <i class="lni lni-user text-warning mx-2"></i>
                @lang('mainFrontend.RegisterOrLogin')
            </h6>
            <p class="mb-1 text-white">@lang('mainFrontend.EnterPhoneNumber1')</p>
            <p class="mb-2 text-white">@lang('mainFrontend.EnterPhoneNumber2')</p>
        </div>
        <!-- OTP Send Form-->
        <div class="otp-form mt-4 mx-4">
            <form action="{{route('postLoginNumber')}}" method="post" id="loginForm" role="form">
                @csrf
                <div class="mb-4 d-flex">
                    <select class="form-select text-right" name="CountryCodes">
                        <option value="98">@lang('mainFrontend.CountryCodes')</option>
                        <option value="90">+90</option>
                        <option value="49">+49</option>
                        <option value="1">+1</option>
                    </select>

                    <input class="form-control pl-0" name="phoneNumber" id="phone_number" type="number"
                           placeholder="@lang('mainFrontend.PhoneNumberPlaceholder')" value="{{ old('phoneNumber') }}">
                </div>

                <div class="captcha">
                    <div class="mt-4 mb-2">
                        <livewire:captcha/>
                    </div>
                    <div class="form-control-sm px-0">
                        <input id="captcha" type="number" class="form-control captcha"
                               placeholder="@lang('mainFrontend.captchaPlaceholder')" name="captcha">
                    </div>
                </div>

                @foreach ($errors->all() as $message)
                    <p class="text-danger mt-0">{{ $message }}</p>
                @endforeach

                <button class="btn badge-success text-white btn-lg w-75 mt-4" type="submit">
                    @lang('mainFrontend.Navbar-login')
                </button>

            </form>
        </div>

        <!-- View As Guest-->
        <div class="view-as-guest mt-4">
            <a class="btn" href="{{($url = session('beforeLoginUrl')) ? $url : route('home') }}">
                @lang('mainFrontend.ViewAsGuest')
            </a>
        </div>

    </x-login-wrapper>

    @push('script')
        <script src="{{asset('js/jquery.validate.min.js')}}"></script>
        @include('frontend.login.validate')

        @if(Session::has('expired'))
            <script>
                $("body").append("<div class='add2cart-notification-login animated fadeIn bg-danger'> {{Session('expired')}} </div>");
                $(".add2cart-notification-login").delay(6000).fadeOut();
            </script>
        @endif

        @livewireScripts
    @endpush

</x-frontend-layout>

