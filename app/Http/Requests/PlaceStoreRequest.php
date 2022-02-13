<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceStoreRequest extends FormRequest
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
            'name_ar'       => 'required|unique:places,name->ar',
            'name_en'       => 'required|unique:places,name->en',
            'name_ru'       => 'required|unique:places,name->ru',
            'latitude'      => 'required|numeric|between:-90,90',
            'longitude'     => 'required|numeric|between:-180,180',
            'thumb'         =>
            [
                'required',
                'image',
                'mimes:'    . config('setting.image.allow_extensions'),
                'max:'      . config('setting.image.size')
            ],
            'banner'        =>
            [
                'required',
                'image',
                'mimes:'    . config('setting.image.allow_extensions'),
                'max:'      . config('setting.image.size')
            ],
            'category'      => 'required|exists:categories,id',
            'owner'         => 'required|exists:owners,id',
            'address'       => 'required',
            'phone'         => 'required|regex:/^[0-9]+$/',
            'working_hours' => 'required',
            'status'        => 'required|boolean',
            'tax'           => 'required|regex:/^[0-9]+$/',
            'fees'          => 'required|regex:/^[0-9]+$/',
            'delivers'      => 'required|regex:/^[0-9]+$/',

        ];
    }
}
