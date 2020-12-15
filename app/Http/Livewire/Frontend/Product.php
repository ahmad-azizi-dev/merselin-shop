<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use App\Http\Livewire\Frontend\Traits\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    use CartTrait;
    use Wishlist;

    public $product = [];
    public $currentUrl = [];
    protected $listeners = ['removeFromCart' => 'removeFromCart', 'removeFromWishlist' => 'removeFromWishlist'];

    public function mount()
    {
        $this->initializeWishlist();
        $this->authCheckAndLoading();
    }

    public function render()
    {
        return view('livewire.frontend.product');
    }

    protected function getEagerProducts()
    {
        $this->getProductsData();
        $this->getWishlistProductsData();
    }

    protected function getEagerProductGuest()
    {
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
}
