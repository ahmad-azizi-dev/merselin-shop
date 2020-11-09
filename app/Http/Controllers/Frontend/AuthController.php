<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AuthenticateUserByPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpConfirmRequest;
use App\Models\LoginByPhoneToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Show the login page.
     *
     * @return Response
     */
    public function login()
    {
        // Store the url for redirect back to the same page after successful login.
        $this->storePreviousUrl();
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
     * Show the otp confirm page.
     *
     * @param LoginByPhoneToken $loginByPhone
     * @return string
     */
    public function otpConfirm(LoginByPhoneToken $loginByPhone)
    {
        return view('frontend.login.otp-confirm', [
            'phone_number' => $loginByPhone->phone_number,
        ]);
    }

    /**
     * Authenticate the user, using the given token.
     *
     * @param OtpConfirmRequest $confirmRequest
     * @return string
     */
    public function PostOtpConfirm(OtpConfirmRequest $confirmRequest)
    {
        if (!$loginToken = $this->checkToken($confirmRequest)) {    // token expired
            return redirect(route('frontendLogin'))->with([
                'expired' => trans('mainFrontend.ExpiredMessage', ['phoneNumber' => $confirmRequest->phone_number]),
            ]);
        }

        if ($loginToken == $confirmRequest->opt()) {                // token matched
            $this->loginUser($confirmRequest->phone_number);
            return redirect(($url = session('beforeLoginUrl')) ? $url : route('home'))
                ->with('SuccessfulLogin', trans('mainFrontend.SuccessfulLogin'));
        }

        // redirect back to otp-confirm page for getting OTP
        return back()->with([
            'wrongCode' => trans('mainFrontend.WrongCode'),
        ]);
    }

    /**
     * check the given token.
     *
     * @param OtpConfirmRequest $confirmRequest
     * @return string
     */
    protected function checkToken($confirmRequest)
    {
        $loginToken = LoginByPhoneToken::retrieveTokenByPhoneNumber($confirmRequest);

        // first check the expiration date
        if ($loginToken->created_at->addSecond(185)->greaterThan(now())) {
            return $loginToken->token;
            //   return $loginToken->token == $confirmRequest->opt();
        }
        return false;
    }


    /**
     * Login or register the user associated with a token.
     *
     * @param $phone_number
     * @return void
     */
    protected function loginUser($phone_number)
    {
        $user = User::retrieveUserByPhoneNumber($phone_number);

        if (!$user) {
            $user = User::create([
                'phone_number' => $phone_number,
                'name'         => 'not_set',
                'email'        => 'not_set-' . Str::random(60),
                'password'     => 'not_set',
            ]);
        }
        Auth::login($user, true);
    }

    /**
     * Log out the user.
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return back()->with('SuccessfulLogout', trans('mainFrontend.SuccessfulLogout'));
    }

    /**
     *  Store the before login url in the session. for redirect back to the same page after successful login.
     *
     * @return void
     */
    protected function storePreviousUrl()
    {
        if (!Str::contains($url = URL::previous(), ['otp-confirm', 'login']) & Str::contains($url, url('/'))) {
            session(['beforeLoginUrl' => $url]);
        }
    }

}
