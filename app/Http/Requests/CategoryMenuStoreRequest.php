<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryMenuStoreRequest extends FormRequest
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
            'name_ar'       => ['required', Rule::unique('menu_categories', 'name->ar')->where(function($q) {
                            return $q->where('place_id', '=', $this->id );
            })],

            'name_en'       => ['required', Rule::unique('menu_categories', 'name->en')->where(function($q) {
                            return $q->where('place_id', '=', $this->id );
            })],

            'name_ru'       => ['required', Rule::unique('menu_categories', 'name->ru')->where(function($q) {
                            return $q->where('place_id', '=', $this->id );
            })],
            'status'        => ['required', 'boolean'],
            'sorting'       => ['required',Rule::unique('menu_categories', 'sort')->where(function($q) {
                            return $q->where('place_id', '=', $this->id);
            })],
            'icon_category' => [
                'required',
                'image',
                'mimes:' . config('setting.image.allow_extensions'),
                'max:' . config('setting.image.size')
            ],

        ];
    }
}
