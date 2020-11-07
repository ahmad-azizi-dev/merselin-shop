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
        $this->getEagerProducts();
    }

    public function addToCart(int $productId)
    {
        Cart::add(Product::where('id', $productId)->first());
        $this->cartProducts = Cart::get()['products'];
        $this->getEagerProducts();
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId)
    {
        Cart::remove($productId);
        $this->cartProducts = Cart::get()['products'];
        $this->getEagerProducts();
        $this->emit('productRemoved', $this->cartTotal());
    }

    private function cartTotal()
    {
        return count(array_unique($this->cartProducts));
    }

    private function getEagerProducts()
    {
        if (Auth::check()) {
            $this->eagerProducts = Product::with('medias')->whereIn('id', $this->cartProducts)->get();
            $this->productCountValues = array_count_values($this->cartProducts);
        }
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }
}
