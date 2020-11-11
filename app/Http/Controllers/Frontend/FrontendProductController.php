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
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->storeBeforeProductUrl();
        return view('frontend.show-product.index', [
            'cartProducts' => Cart::getProducts(),
            'product'      => Product::with(['attributeValues', 'categories'])->whereSlug($slug)->firstorfail()
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
