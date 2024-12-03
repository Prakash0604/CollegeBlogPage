<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|min:3',
            'description'=>'required',
            'type'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'Please enter the title',
            'title.min'=>'Title should contain at least 3 character',
            'description.required'=>'Please enter the description',
            'type.required'=>'Please Select the type'
        ];
    }
}
