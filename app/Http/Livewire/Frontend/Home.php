<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use App\Http\Livewire\Frontend\Traits\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    use CartTrait;
    use Wishlist;

    protected $listeners = ['removeFromCart' => 'removeFromCart', 'removeFromWishlist' => 'removeFromWishlist'];

    public $TopProducts = [];

    public function mount()
    {
        $this->initializeWishlist();
        $this->getEagerProducts();
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }

    private function getEagerProducts()
    {
        if (Auth::check()) {
            $this->getProductsData();
            $this->getWishlistProductsData();
        }
    }
}
