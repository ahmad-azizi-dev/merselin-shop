<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\AuthenticateUserByPhone;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpConfirmRequest;
use App\Models\LoginByPhoneToken;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     * Show the login page.
     *
     * @return View
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
     * @param AuthenticateUserByPhone $auth
     * @return RedirectResponse
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
     * @return View
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
     * @return RedirectResponse
     */
    public function postOtpConfirm(OtpConfirmRequest $confirmRequest)
    {
        if (!$loginToken = $this->checkToken($confirmRequest)) {    // token expired
            return redirect(route('frontendLogin'))->with($this->message('expired', $confirmRequest->phone_number));
        }
        if ($loginToken == $confirmRequest->opt()) {                // token matched
            $this->loginUser($confirmRequest->phone_number);
            return redirect($this->beforeLoginUrl())->with($this->message('SuccessfulLogin'));
        }
      //  dd($this->message('wrongCode'));
        return back()->with($this->message('wrongCode'));       // redirect back to otp-confirm page for getting OTP
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
     * The appropriate message.
     *
     * @param $key
     * @param null $phone_number
     * @return array
     */
    protected function message($key, $phone_number = null)
    {
        switch ($key) {
            case 'expired':
                return ['expired' => trans('mainFrontend.ExpiredMessage', ['phoneNumber' => $phone_number])];
            case 'SuccessfulLogin':
                return ['SuccessfulLogin' => trans('mainFrontend.SuccessfulLogin')];
            case 'wrongCode':
                return ['wrongCode' => trans('mainFrontend.WrongCode')];
        }
    }

    /**
     * Get the before login url form session if exist.
     *
     * @return string
     */
    protected function beforeLoginUrl()
    {
        return ($url = session('beforeLoginUrl')) ? $url : route('home');
    }

    /**
     * check the given token.
     *
     * @param OtpConfirmRequest $confirmRequest
     * @return string|boolean
     */
    protected function checkToken(OtpConfirmRequest $confirmRequest)
    {
        $loginToken = LoginByPhoneToken::retrieveTokenByPhoneNumber($confirmRequest);

        // first check the expiration date
        if ($loginToken->created_at->addSecond(185)->greaterThan(now())) {
            return $loginToken->token;
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
        if (!$user = User::retrieveUserByPhoneNumber($phone_number)) {
            $user = $this->createUser($phone_number);
        }
        Auth::login($user, true);
    }

    /**
     * Create a user with the validated given phone number.
     *
     * @param $phone_number
     * @return User
     */
    protected function createUser($phone_number)
    {
        return User::create([
            'phone_number' => $phone_number,
            'name'         => 'not_set',
            'email'        => 'not_set-' . Str::random(40),
            'password'     => 'not_set',
        ]);
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
