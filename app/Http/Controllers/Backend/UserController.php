<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }
}
