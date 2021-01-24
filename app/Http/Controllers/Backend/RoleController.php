<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.index');
    }
}
