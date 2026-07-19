<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GenerateVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'id' => 'required|string|max:50',
            'flightNumber' => 'required|string|max:20',
            'date' => 'required|date',
            'aircraft' => [
                'required',
                Rule::in([
                    'ATR',
                    'Airbus 320',
                    'Boeing 737 Max'
                ])
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Crew Name is required.',
            'id.required' => 'Crew ID is required.',
            'flightNumber.required' => 'Flight Number is required.',
            'date.required' => 'Flight Date is required.',
            'aircraft.required' => 'Aircraft Type is required.',
            'aircraft.in' => 'Invalid Aircraft Type.',
        ];
    }
}
