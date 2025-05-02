<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // allow all for now
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ];
    }
}

