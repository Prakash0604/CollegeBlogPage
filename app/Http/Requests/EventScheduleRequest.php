<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;  // You can add authorization logic if needed
    }

    public function rules()
    {
        return [
            'event_date_id' => 'required|exists:event_dates,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'event_date_id.required' => 'Event date ID is required.',
            'start_time.required' => 'Start time is required.',
            'end_time.required' => 'End time is required.',
            'end_time.after' => 'End time must be after the start time.',
            'description.max' => 'Description should not exceed 255 characters.',
        ];
    }
}
