<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
            'name_ar'       => ['required', Rule::unique('categories', 'name->ar')->ignore($this->category)],
            'name_en'       => ['required', Rule::unique('categories', 'name->en')->ignore($this->category)],
            'name_ru'       => ['required', Rule::unique('categories', 'name->ru')->ignore($this->category)],
            'icon_category' =>
             [
                'sometimes',
                'nullable',
                'image',
                'mimes:'    . config('setting.image.allow_extensions'),
                'max:'      . config('setting.image.size')
            ],
            'status'        => ['required', 'boolean'],
            'slug'          => ['required', Rule::unique('categories', 'slug')->ignore($this->category)],
            'seo'           => ['required'],
            'meta_desc'     => ['required'],
            'sorting'       => ['required', Rule::unique('categories', 'sorting')->ignore($this->category)]
        ];
    }
}
