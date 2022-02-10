<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name_ar'       => ['required', 'unique:categories,name->ar'],
            'name_en'       => ['required', 'unique:categories,name->en'],
            'name_ru'       => ['required', 'unique:categories,name->ru'],
            'slug'          => ['required', 'unique:categories,slug'],
            'seo'           => ['required'],
            'meta_desc'     => ['required'],
            'icon_category' =>
            [
            'required',
            'image',
            'mimes:'        . config('setting.image.allow_extensions'),
            'max:'          . config('setting.image.size')
            ],
            'sorting'       => ['required', 'unique:categories,sorting'],
            'status'        => ['required', 'boolean'],
        ];
    }
}
