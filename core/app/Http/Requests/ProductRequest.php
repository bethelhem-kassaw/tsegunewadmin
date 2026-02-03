<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'nullable',
            'main_category_id' => 'nullable|integer',
            'sub_category_id'  => 'nullable|integer',  
            'priceMin'         => 'nullable|integer',
            'priceMax'         => 'nullable|integer',
        ];
    }
}
