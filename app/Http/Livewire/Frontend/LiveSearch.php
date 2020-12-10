<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class LiveSearch extends Component
{
    public $products = [];
    public $categories = [];
    protected $listeners = ['updateSearch' => 'updateSearch'];

    public function render()
    {
        return view('livewire.frontend.live-search');
    }

    public function updateSearch($search)
    {
        $this->products = Product::where('title', 'LIKE', "%$search%")->whereStatus(1)->orderByDesc('created_at')->take(4)->get();
        $this->categories = Category::where('name', 'LIKE', "%$search%")->take(4)->get();
    }
}
