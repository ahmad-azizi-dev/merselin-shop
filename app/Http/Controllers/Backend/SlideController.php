<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


class SlideController extends Controller
{

    public function index()
    {
        return view('admin.slides.index');
    }
}
