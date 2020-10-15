<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index', [
            'categories'        => Category::whereParent_id('0')->get(),
            'FlashSaleProducts' => Product::with(['medias'])->whereNotNull('discount_price')->get(),
            'TopProducts'       => Product::with(['medias'])->get(),
        ]);
    }
}
