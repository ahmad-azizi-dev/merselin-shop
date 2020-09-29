<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
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

            'title'             => ['required', 'max:255'],
            'attributeGroup_id' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required'             => 'please enter a value',
            'title.max'                  => 'the value must be less than 255 character',
            'attributeGroup_id.required' => 'please select an attribute Group',
        ];
    }
}
