<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'shippmentMethod'    => ['required'],
            'shippmentAddressId' => ['required', 'numeric'],
            'payment_method'     => ['required', 'in:cards,cod,paypal'],
            'nameOnCard'         => ['required_if:payment_method,cards', 'string'],
            'cardNumber'         => ['required_if:payment_method,cards', 'numeric'],
            'expYear'            => ['required_if:payment_method,cards', 'numeric'],
            'expMonth'           => ['required_if:payment_method,cards', 'numeric'],
            'cvv'                => ['required_if:payment_method,cards', 'numeric'],
        ];
    }
}
