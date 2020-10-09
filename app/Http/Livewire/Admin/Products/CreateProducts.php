<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\AttributeGroup;
use Livewire\Component;

class CreateProducts extends Component
{

    public $categories = [];

    public function render()
    {
        return view('livewire.admin.products.create-products');
    }

}
