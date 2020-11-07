<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart;
use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    public $product = [];
    public $cartProducts = [];
    public $eagerProducts = [];
    public $productCountValues = [];
    public $currentUrl = [];

    public function mount()
    {
        $this->authCheckAndLoading();
    }

    public function addToCart(int $productId)
    {
        Cart::add(ProductModel::where('id', $productId)->first());
        $this->cartProducts = Cart::get()['products'];
        $this->authCheckAndLoading();
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId, $removeType = 'all')
    {
        $this->typeCheckAndRemove($productId, $removeType);
        $this->cartProducts = Cart::get()['products'];
        $this->authCheckAndLoading();
        $this->emit('productRemoved', $this->cartTotal());
    }

    protected function cartTotal()
    {
        return count(array_unique($this->cartProducts));
    }

    protected function getEagerProducts()
    {
        $this->eagerProducts = ProductModel::with('medias')->whereIn('id', $this->cartProducts)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
    }

    protected function getEagerProductGuest()
    {
        $this->eagerProducts = ProductModel::with('medias')->whereId($this->product->id)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
    }

    protected function authCheckAndLoading()
    {
        if (Auth::check()) {
            $this->getEagerProducts();
        } else {
            $this->getEagerProductGuest();
        }
    }

    protected function typeCheckAndRemove($productId, $removeType)
    {
        if ($removeType == 'all') {
            Cart::remove($productId);
        } else {
            Cart::removeSingle($productId);
        }
    }

    public function render()
    {
        return view('livewire.frontend.product');
    }
}
