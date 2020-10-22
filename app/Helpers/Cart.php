<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Product $product)
    {
        $cart = $this->get();
        array_push($cart['products'], $product->id);
        $this->set($cart);
    }

    public function remove(int $productId)
    {
        $cart = $this->get();
        //find key and delete an element from products array
        unset($cart['products'][array_search($productId, $cart['products']) ]);
        $this->set($cart);
    }

    public function clear()
    {
        $this->set($this->empty());
    }

    private function empty()
    {
        return [
            'products' => [],
        ];
    }

    public function get()
    {
        return request()->session()->get('cart');
    }

    private function set($cart)
    {
        request()->session()->put('cart', $cart);
    }
}
