<?php

namespace App\Http\Requests\EventManagement;

use Illuminate\Foundation\Http\FormRequest;

class EventManagementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // If you want to allow only authenticated users to create or update events, you can check that
        return auth()->check(); // This allows only authenticated users to make the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Define the validation rules here

            // Assuming you're validating fields like 'name', 'event_date', 'location', etc.
            'name' => 'required|string|max:255',  // Event name must be a string and required
            'event_date' => 'required|date|after:today',  // Event date must be a valid date and in the future
            'location' => 'required|string|max:255',  // Event location must be a string and required
            'description' => 'nullable|string|max:1000',  // Event description is optional but should not exceed 1000 characters
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Event image is optional but must be a valid image type
        ];
    }
}
