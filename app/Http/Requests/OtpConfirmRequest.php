<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpConfirmRequest extends FormRequest
{

    protected $validate = 'string|size:1|required|regex:/^[0-9]/i';
    protected $otp = '';

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
            'otp1'         => $this->validate,
            'otp2'         => $this->validate,
            'otp3'         => $this->validate,
            'otp4'         => $this->validate,
            'otp5'         => $this->validate,
            'phone_number' => 'required|min:10|max:11|regex:/^[0-9]*$/i'
        ];
    }

    /**
     * Get the merged otp values.
     *
     * @return string
     */
    public function opt()
    {
        foreach ($this->only('otp1', 'otp2', 'otp3', 'otp4', 'otp5') as $value) {
            $this->otp .= $value;
        }
        return $this->otp;
    }
}
