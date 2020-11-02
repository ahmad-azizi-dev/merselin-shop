<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.RegisterOrLogin')</title>
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
                           placeholder="@lang('mainFrontend.PhoneNumberPlaceholder')">
                </div>

                <button class="btn badge-success text-white btn-lg w-75" type="submit">
                    @lang('mainFrontend.Navbar-login')
                </button>

                @error('phoneNumber')
                <p class="text-danger">{{ $message }}</p>
                @enderror

            </form>
        </div>

        <!-- View As Guest-->
        <div class="view-as-guest mt-4">
            <a class="btn" href="{{ URL::previous() }}"> @lang('mainFrontend.ViewAsGuest')</a>
        </div>

    </x-login-wrapper>

    @push('script')
        <script src="{{asset('js/jquery.validate.min.js')}}"></script>
        @include('frontend.login.validate')
    @endpush

</x-frontend-layout>

