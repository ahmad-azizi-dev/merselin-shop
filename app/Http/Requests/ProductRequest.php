<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    //for validation of the unique rule, the input slug must be made before validation!!!
    protected function prepareForValidation()
    {
        if ($this->input('slug')) {
            $this->merge(['slug' => Str::slug($this->input('slug'))]);
        } else {
            $this->merge(['slug' => Str::slug($this->input('meta_title'))]);
        }

        if (!$this->input('sku')) {
            $this->merge(['sku' => $this->generateSKU()]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|min:5|max:255',
            'meta_title'    => 'required|min:5|max:255',
            //  by ignoring this product form unique rule we can update the product with the same slug or sku
            'slug'          => ['max:255', 'min:3', Rule::unique('products', 'slug')->ignore($this->product)],
            'sku'           => ['max:255', 'min:3', Rule::unique('products', 'sku')->ignore($this->product)],
            'status'        => 'required|numeric',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'brand_id'      => 'required|numeric',
            'meta_desc'     => 'nullable|min:5|max:255',
            'meta_keywords' => 'nullable|min:5|max:255',
            'category'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'         => 'please enter a name',
            'meta_title.required'    => 'please enter a title',
            'meta_keywords.required' => 'please enter keywords',
            'slug.unique'            => 'This slug has been chosen please enter another one',
            'sku.unique'             => 'This product SKU has been chosen please enter another one',
            'category.required'      => 'please select a category',
        ];
    }


    protected function generateSKU()
    {
        $number = mt_rand(100000, 999999);
        if ($this->checkSKU($number)) {
            return $this->generateSKU();
        }
        return (string)$number;
    }

    protected function checkSKU($number)
    {
        return Product::where('sku', $number)->exists();
    }
}
