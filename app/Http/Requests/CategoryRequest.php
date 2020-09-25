<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //for validation of the unique rule, the input slug must be made before validation!!!
    protected function prepareForValidation()
    {

        if ($this->input('slug')) {
            $this->merge(['slug' => Str::slug($this->input('slug'))]);
        } else {
            $this->merge(['slug' => Str::slug($this->input('meta_title'))]);
        }
    }

    public function rules()
    {
        return [

            'name'          => 'required|min:5',
            'meta_title'    => 'required|min:5',
            //  by ignoring this category form unique rule we can update the category with the same slug
            //  route list -> uri ->  administrator/categories/{category} -> ($this->category)  !!!
            'slug'          => Rule::unique('categories', 'slug')->ignore($this->category),
            'meta_desc'     => 'required',
            'meta_keywords' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required'          => 'please enter a name',
            'meta_title.required'    => 'please enter a title',
            'meta_desc.required'     => 'please enter description',
            'meta_keywords.required' => 'please enter keywords',
            'slug.unique'            => 'This slug has been chosen please enter another category',
        ];
    }
}
