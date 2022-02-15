<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeStoreRequest extends FormRequest
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
            'name_ar'       => ['required', 'unique:sizes,name->ar'],
            'name_en'       => ['required', 'unique:sizes,name->en'],
            'name_ru'       => ['required', 'unique:sizes,name->ru'],
            'status'        => ['required', 'boolean']
        ];
    }
}
