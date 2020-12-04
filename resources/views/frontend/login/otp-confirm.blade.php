<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>@lang('mainFrontend.RegisterOrLogin')</title>
    @endpush

<!-- Login Wrapper Area-->
    <x-login-wrapper>

        <div class="text-left px-4 mt-4">
            <h6 class="mb-1 text-white">@lang('mainFrontend.ConfirmPhoneNumber')</h6>
            <p class="text-white mb-2">
                @lang('mainFrontend.EnterCode')
            </p>
            <div class="mb-2 text-warning text-center">
                {{$phone_number}}
            </div>
        </div>
        <!-- OTP Verify Form-->
        <div class="otp-verify-form mt-3 px-4">
            <form action="{{route('postOtpConfirm')}}" method="post" id="otpConfirmForm">
                @csrf
                <div class="d-flex justify-content-between mb-2 ltr">
                    <input name="otp1" class="form-control" type="number" placeholder="-" maxlength="1">
                    <input name="otp2" class="form-control" type="number" placeholder="-" maxlength="1">
                    <input name="otp3" class="form-control" type="number" placeholder="-" maxlength="1">
                    <input name="otp4" class="form-control" type="number" placeholder="-" maxlength="1">
                    <input name="otp5" class="form-control" type="number" placeholder="-" maxlength="1">
                </div>

                <div class="text-warning mb-3">
                    <span id="clock"></span>
                </div>

                <input type="hidden" name="phone_number" value="{{$phone_number}}">
                <button id="submit" class="btn badge-warning btn-lg w-75 mb-2" type="submit">
                    @lang('mainFrontend.Confirm')
                </button>

                <a id="again" class="btn badge-danger btn-lg w-75 mb-2 d-none" href="{{route('frontendLogin')}}">
                    @lang('mainFrontend.TryAgain')
                </a>

                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <p class="text-danger ltr">{{ $error }}</p>
                    @endforeach
                @endif
                @if(Session::has('wrongCode'))
                    <span class="error text-danger d-block ltr">{{Session('wrongCode')}}</span>
                @endif
            </form>

            <!-- Term & Privacy Info-->
            <div class="login-meta-data px-4">
                <p class="mt-4 mb-0">
                    <a href="{{route('frontendLogin')}}"> @lang('mainFrontend.ChangePhoneNumber') </a>
                </p>
            </div>
        </div>

    </x-login-wrapper>

    @push('script')
        <script src="{{asset('js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('js/jquery.autotab.min.js')}}"></script>
        <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
        @include('frontend.login.otp-confirm-validator')
        <script>

                @if(Session::has('wrongCode'))
            var date = new Date(localStorage.getItem('expiredDate'));
                @else
            var date = new Date();
            date.setMinutes(date.getMinutes() + 3);
            localStorage.setItem('expiredDate', date);
            @endif

            $('#clock').countdown(date)
                .on('update.countdown', function (event) {
                    var format = '%M:%S';
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('@lang('mainFrontend.Expired')' + '&#128577;')
                        .parent().addClass('text-danger');
                    $('#submit').addClass('d-none');
                    $('#again').removeClass('d-none');
                });

            $('input').autotab();

            @if(Session::has('wrongCode'))
            $("body").append("<div class='add2cart-notification-login animated fadeIn bg-danger'> {{Session('wrongCode'),}} </div>");
            $(".add2cart-notification-login").delay(6000).fadeOut();
            @endif

        </script>
    @endpush

</x-frontend-layout>

