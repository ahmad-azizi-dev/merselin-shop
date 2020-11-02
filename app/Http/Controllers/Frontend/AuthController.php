<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AuthenticateUserByPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpConfirmRequest;
use App\Models\LoginByPhoneToken;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the login page.
     *
     * @return Response
     */
    public function login()
    {
        return view('frontend.login.index');
    }

    /**
     * Handle the login form submission.
     *
     * @return string
     */
    public function postLoginNumber(AuthenticateUserByPhone $auth)
    {
        // redirect to otp-confirm page for getting OTP
        return redirect(route('otpConfirm', ['loginByPhone' => $auth->invite()]));
    }

    /**
     * Login the user, using the given token.
     *
     * @param Request $request
     * @return string
     */
    public function otpConfirm(LoginByPhoneToken $loginByPhone)
    {
        return view('frontend.login.otp-confirm', [
            'phone_number' => $loginByPhone->phone_number,
        ]);
    }

    public function PostOtpConfirm(OtpConfirmRequest $request)
    {
        dd($request->opt());

        return redirect(route('home'));
    }

}
