<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'fullname'     => 'required|string',
            'phone'        => 'required|numeric',
            'email'        => 'nullable|string',
            'country_id'   => 'required',
            'city_id'      => 'required|numeric',
            'posta_number' => 'nullable',
            'postal_code'  => 'required',
            'sub_city_id'  => 'required',
            'addressLine1' => 'nullable',
            'addressLine2' => 'nullable',
        ];
    }
}
