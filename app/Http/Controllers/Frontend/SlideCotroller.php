<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


class SlideCotroller extends Controller
{

    public function index()
    {
        return view('admin.slides.index');
    }
}
