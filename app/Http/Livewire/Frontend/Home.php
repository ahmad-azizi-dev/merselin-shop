<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    use cartTrait;

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
