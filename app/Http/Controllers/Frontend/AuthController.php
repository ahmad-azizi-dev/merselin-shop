<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login()
    {
        return view('frontend.login.index');
    }

    public function postLoginNumber(Request $request)
    {
        return $request->phoneNumber;
    }
}
