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
        while (in_array($productId, $cart['products'])) {
            $cart = $this->deleteIdFromProductsCart($cart, $productId);
        }
        $this->indexArrayAndSet($cart);
    }

    public function removeSingle(int $productId)
    {
        $this->indexArrayAndSet($this->deleteIdFromProductsCart($this->get(), $productId));
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

    public function getProducts()
    {
        return $this->get()['products'];
    }

    private function set($cart)
    {
        request()->session()->put('cart', $cart);
    }

    //find key and delete an element from products array
    private function deleteIdFromProductsCart($cart, $productId)
    {
        unset($cart['products'][array_search($productId, $cart['products'])]);
        return $cart;
    }

    //re-index array and set
    private function indexArrayAndSet($cart)
    {
        $cart['products'] = array_values($cart['products']);
        $this->set($cart);
    }
}
