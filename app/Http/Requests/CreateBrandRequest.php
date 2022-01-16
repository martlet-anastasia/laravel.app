<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBrandRequest extends FormRequest
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
//        if(is_object($this->brand)) {
//            $id = $this->brand->id;
//        } else {
//            $this->brand;
//        }

        $id = (is_object($this->brand) ? $this->brand->id : $this->brand) ?? null;
        return [
            'name' => [
                'required',
                'min:3',
                'max:150',
                'unique:brand,name,'.$id,
                Rule::unique('brands', 'name')->ignore('id')
                ],
                'logo' => [
                    Rule::requiredIf(function () {
                    return $this->brand ?? null;
                })
            ]
        ];
    }

    public function messages() {
        return [
            'name.min' => 'Минимум 3 символа',
            'name.email' => 'Неверный email',
            'name.unique' => 'Такое имя уже занято'
        ];
    }
}
