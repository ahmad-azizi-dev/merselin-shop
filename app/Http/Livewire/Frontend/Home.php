<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public $TopProducts = [];
    public $cartProducts = [];

    public function mount()
    {
        $this->cartProducts = Cart::get()['products'];
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->cartProducts = Cart::get()['products'];
        $this->emit('productAdded', $this->cartTotal());

    }

    public function removeFromCart($productId)
    {
        Cart::remove($productId);
        $this->cartProducts = Cart::get()['products'];
        $this->emit('productRemoved', $this->cartTotal());
    }

    private function cartTotal()
    {
        return count(Cart::get()['products']);
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }
}
