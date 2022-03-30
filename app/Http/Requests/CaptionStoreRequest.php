<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaptionStoreRequest extends FormRequest
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
            'name'      => 'required',
            'phone'     => ['required', 'unique:captions,phone' , 'regex:/^[0-9]+$/','min:10', 'max:20'],
            'email'     => ['required', 'unique:captions,email'],
            'password'  => ['required', 'confirmed','min:6','max:12'],
            'status'    => ['required', 'boolean'],
        ];
    }
}
