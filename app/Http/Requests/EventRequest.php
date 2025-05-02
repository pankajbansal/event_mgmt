<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow all users (or implement auth logic if needed)
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date|before_or_equal:end_time',
            'end_time' => 'required|date|after_or_equal:start_time',
        ];
    }
}
