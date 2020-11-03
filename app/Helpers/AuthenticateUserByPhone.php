<?php

namespace App\Helpers;

use App\Models\LoginByPhoneToken;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


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

    /**
     * Send a sign in token to the user phone.
     */
    public function invite()
    {
        $this->validateRequest()
            ->createToken()
            ->send();
        return $this->request->phoneNumber;
    }


    /**
     * Validate the request data.
     *
     * @return $this
     * @throws ValidationException
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
     * @return LoginByPhoneToken
     */
    protected function createToken()
    {
        return LoginByPhoneToken::generateFor($this->request->phoneNumber);
    }

}
