<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
            'full_name'=>'required|string',
            'is_registered'=>'nullable|in:approved,pending',
            'email'=>['required','email',Rule::unique('students')->ignore($this->id)],
            'address'=>'required|string',
            'contact'=>'required|numeric|min:7',
            'image'=>'nullable|mimes:png,jpg',
            'dob'=>'required|date',
            'gender'=>'required|in:male,female,others',
            'batch_id'=>'nullable|exists:batches,id',
            'batch_type_id'=>'nullable|exists:batch_types,id',
            'year_semester_id'=>'nullable|exists:year_semesters,id'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'=>'Please enter the full name.',
            'email.required'=>'Please enter the email.',
            'email.email'=>'Please enter valid email!',
            'email.unique'=>'Email Already exists',
            'address.required'=>'Please enter the address.',
            'contact.required'=>'Please enter the contact number.',
            'contact.numeric'=>'Please enter valid contact number.',
            'contact.min'=>'Please enter at least 7 digits number.',
            'image.mimes'=>'Please enter valid image only.eg: jpg,png',
            'dob.required'=>'Please enter the date of birth.',
            'dob.date'=>'Please enter valid date!',
            'gender.required'=>'Please select the gender.',
            'gender.in'=>'Please select valid gender only!',
            'batch_id.exists'=>'Please select valid batch only!',
            'batch_type_id.exists'=>'Please select valid type only!',
            'year_semester_id.exists'=>'Please select valid Year/Semester only!',
        ];
    }
}
