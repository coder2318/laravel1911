<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'weight' => 'required|numeric:max:3',
            'status' => 'nullable',
            'category_id' => 'required',
            'image' => 'nullable|file:size:5000',
            'images' => 'nullable'

        ];
    }
}
