<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventDateRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // You can add authorization logic if needed
    }

    public function rules()
    {
        return [
            'event_id' => 'required|exists:events,id',
            'event_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'event_id.required' => 'Event ID is required.',
            'event_date.required' => 'Event date is required.',
            'event_date.after' => 'Event date must be today or a future date.',
        ];
    }
}
