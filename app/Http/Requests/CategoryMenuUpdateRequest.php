<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryMenuUpdateRequest extends FormRequest
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
            'name_ar'       => ['required', Rule::unique('menu_categories', 'name->ar')->ignore($this->category)->where(function($q) {
                return $q->where('place_id', '=', $this->id );
            })],

            'name_en'       => ['required', Rule::unique('menu_categories', 'name->en')->ignore($this->category)->where(function($q) {
                return $q->where('place_id', '=', $this->id );
            })],

            'name_ru'       => ['required', Rule::unique('menu_categories', 'name->ru')->ignore($this->category)->where(function($q) {
                return $q->where('place_id', '=', $this->id );
            })],
            'status'        => ['required', 'boolean'],
            'sorting'       => ['required',Rule::unique('menu_categories', 'sort')->ignore($this->category)->where(function($q) {
                return $q->where('place_id', '=', $this->id);
            })],

            'image'         => [
                'sometimes',
                'nullable',
                'image',
                'mimes:' . config('setting.image.allow_extensions'),
                'max:' . config('setting.image.size')
            ],

        ];
    }
}
