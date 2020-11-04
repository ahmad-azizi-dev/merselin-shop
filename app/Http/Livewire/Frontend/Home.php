<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $TopProducts = [];
    public $cartProducts = [];
    public $eagerProducts = [];
    public $productCountValues = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->getEagerProducts();
        }
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->cartProducts = Cart::get()['products'];
        if (Auth::check()) {
            $this->getEagerProducts();
        }
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId)
    {
        Cart::remove($productId);
        $this->cartProducts = Cart::get()['products'];
        if (Auth::check()) {
            $this->getEagerProducts();
        }
        $this->emit('productRemoved', $this->cartTotal());
    }

    private function cartTotal()
    {
        return count(array_unique(Cart::get()['products']));
    }

    private function getEagerProducts()
    {
        $this->eagerProducts = Product::with('medias')->whereIn('id', $this->cartProducts)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }
}
