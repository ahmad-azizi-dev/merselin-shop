<?php

namespace App\Helpers;

use App\Models\LoginByPhoneToken;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticateUserByPhone
{
    use ValidatesRequests;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new AuthenticatesUserByPhone instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function invite()
    {
        $this->validateRequest()
            ->createToken()
            ->send();
        return $this->request->phoneNumber;
    }

    /**
     * Log in the user associated with a token.
     *
     * @param LoginToken $token
     * @return void
     */
    public function login(LoginToken $token)
    {
        Auth::login($token->user);
        $token->delete();
    }

    /**
     * Validate the request data.
     *
     * @return $this
     */
    protected function validateRequest()
    {
        $this->validate($this->request, [
            'phoneNumber' => 'required|min:10|max:11|regex:/^[0-9]*$/i'
        ]);
        return $this;
    }

    /**
     * Prepare a log in token for the user.
     *
     * @return LoginToken
     */
    protected function createToken()
    {
        return LoginByPhoneToken::generateFor($this->request->phoneNumber);
    }

}
