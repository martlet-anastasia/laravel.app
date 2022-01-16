<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'filled|min:3',
            'price' => 'filled|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.filled' => 'Field `Name` must be filled',
            'name.min' => 'Min length for name is 3',
            'price.filled' => 'Field `Price`  must be filled',
            'price.integer' => 'Price must be integer higher than 0',
            'price.min' => 'Price must be integer higher than 0'

        ];
    }
}
