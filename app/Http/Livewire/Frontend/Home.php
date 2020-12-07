<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    use CartTrait;

    protected $listeners = ['removeFromCart' => 'removeFromCart'];

    public $TopProducts = [];

    public function mount()
    {
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
        }
    }
}
