<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FrontendProductController extends Controller
{
    /**
     * Show the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->storeBeforeProductUrl();
        return view('frontend.show-product.index', [
            'cartProducts' => Cart::get()['products'],
            'product'      => Product::with(['attributeValues', 'brand', 'categories', 'medias'])->whereSlug($slug)->first()
        ]);
    }

    /**
     *  Store the before product url in the session.
     */
    protected function storeBeforeProductUrl()
    {
        if (!Str::contains($url = URL::previous(), ['otp-confirm', 'logout', 'product', 'login']) & Str::contains($url, url('/'))) {
            session(['beforeProductUrl' => $url]);
        }
    }

}
