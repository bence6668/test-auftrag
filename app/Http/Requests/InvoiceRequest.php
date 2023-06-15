<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
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
            'order_number' => ['required', 'max:255'],
            'date' => ['required', 'date'],
            'notice' => ['nullable'],
            'address_id' => ['required', Rule::exists('addresses', 'id')],
            'items' => ['required'],
            'items.*.title' => ['required'],
            'items.*.price' => ['required'],
            'items.*.discount' => ['nullable'],
            'items.*.price_with_discount' => ['required'],
            'items.*.tax' => ['required'],
            'items.*.qty' => ['required'],
        ];
    }
}
