<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CaptionUpdateRequest extends FormRequest
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
            'email'     => ['required', Rule::unique('captions', 'email')->ignore($this->caption)],
            'password'  => ['sometimes', 'nullable','min:6','max:12'],
            'status'    => ['required', 'boolean'],
            'online'    => ['required', 'boolean'],
        ];
    }
}
