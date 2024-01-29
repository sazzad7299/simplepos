<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1', // At least one sale product is required
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|numeric|min:1', // Quantity must be at least 1
            'items.*.discount' => 'required|numeric|between:0,100',
            'items.*.total' => 'required|numeric|min:1',
            'customer' => 'required|string',
            'subtotal' => 'required|numeric|min:1',
            'invoiceDiscount' => 'required|numeric|between:0,100000000',
        ];
    }
}
