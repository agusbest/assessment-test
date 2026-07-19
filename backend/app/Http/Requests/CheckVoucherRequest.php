<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'flightNumber' => 'required|string|max:20',
            'date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'flightNumber.required' => 'Flight Number is required.',
            'date.required' => 'Flight Date is required.',
            'date.date' => 'Flight Date is invalid.',
        ];
    }
}
