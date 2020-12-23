<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginByPhoneToken;

class LoginByPhoneTokenController extends Controller
{
    public function index(){
        return view('admin.login-by-phone-token.index');
    }
}
