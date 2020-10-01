<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
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

    public function rules()
    {
        return [

            //  by ignoring this brand form unique rule we can update the brand with the same title
            //  route list -> uri ->  administrator/brands/{brand} -> ($this->brand)  !!!
            'title' => ['required', 'max:255', 'min:3', Rule::unique('brands', 'title')->ignore($this->brand)],

            'description' => 'required|min:3|max:255',
            'media_id'    => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required'       => 'please enter a title',
            'description.required' => 'please enter a description',
            'title.unique'         => 'This brand has been chosen! please enter another brand title',
            'media_id.required'    => 'please upload a photo or enter a photo ID',
        ];
    }
}
