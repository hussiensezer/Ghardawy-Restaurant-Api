<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuStoreRequest extends FormRequest
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
            'name_ar'           => ['required', Rule::unique('menus','name->ar')->where(function($q){
                                return $q->where('place_id' , '=', $this->id);
            })],

            'name_en'           => ['required', Rule::unique('menus' , 'name->en')->where(function ($q) {
                                return $q->where('place_id', '=', $this->id);
            })],

            'name_ru'           => ['required', Rule::unique('menus' , 'name->ru')->where(function ($q) {
                                return $q->where('place_id', '=', $this->id);
            })],

            'description_ar'    => ['required'],
            'description_en'    => ['required'],
            'description_ru'    => ['required'],

            'image'             =>
            [
                'required',
                'image',
                'mimes:' . config('setting.image.allow_extensions'),
                'max:' . config('setting.image.size')
            ],
            'sizes.*.size'              => ['required', 'exists:sizes,id'],
            'sizes.*.price'             => ['required', 'regex:/^[0-9]+$/'],


        ];
    }
}
