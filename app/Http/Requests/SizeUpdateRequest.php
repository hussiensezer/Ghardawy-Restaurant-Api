<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SizeUpdateRequest extends FormRequest
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
            'name_ar'     => ['required', Rule::unique('sizes', 'name->ar')->ignore($this->size)],
            'name_en'     => ['required', Rule::unique('sizes', 'name->en')->ignore($this->size)],
            'name_ru'     => ['required', Rule::unique('sizes', 'name->ru')->ignore($this->size)],
            'status'      => ['required','boolean'],
        ];
    }
}
