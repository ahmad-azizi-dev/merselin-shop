<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeRequest extends FormRequest
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

            //  by ignoring this attribute form unique rule we can update the attribute with the same title
            //  route list -> uri ->  administrator/attributes-group/{attributes_group} -> ($this->attributes_group)  !!!
            'title' => ['required', 'max:255', 'min:3', Rule::unique('attributesgroup', 'title')->ignore($this->attributes_group)],

            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'title.required' => 'please enter a title',
            'type.required'  => 'please select an attribute type',
            'title.unique'   => 'This title has been chosen please enter another attribute title',
        ];
    }
}
