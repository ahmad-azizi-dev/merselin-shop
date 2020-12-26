<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home.index', [
            'categories'        => Category::whereParent_id('0')->get(),
            'FlashSaleProducts' => Product::whereNotNull('discount_price')->get(),
            'TopProducts'       => Product::get(),
            'cartProducts'      => Cart::getProducts(),
            'slides'            => Slide::whereNotIn('priority', [0])->orderBy('priority', 'asc')->get(),
        ]);
    }
}
