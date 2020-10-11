<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\AttributeGroup;
use Livewire\Component;

class CreateProducts extends Component
{

    public $categories = [];
    public $selectedCategories = [];
    public $attributeGroups = [];

    public function mount()
    {
        // filling the form after failed validation
        if (old('category')) {
            $this->selectedCategories = old('category');
            $this->getAttributeGroups();
        }
    }

    public function updatedSelectedCategories()
    {
        if ($this->selectedCategories) {
            $this->getAttributeGroups();
        }
    }

    public function render()
    {
        return view('livewire.admin.products.create-products');
    }

    private function getAttributeGroups()
    {
        $selectedCats = $this->selectedCategories;
        $this->attributeGroups = AttributeGroup::with('attributesValue', 'categories')
            ->whereHas('categories', function ($q) use ($selectedCats) {
                $q->whereIn('categories.id', $selectedCats);
            })->get();
    }

}
