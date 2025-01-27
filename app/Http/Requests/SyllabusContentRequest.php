<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyllabusContentRequest extends FormRequest
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
        return $this->hasChapter == 'Y' ? $this->chapterRules() : $this->generalRules();
    }

    private function chapterRules(): array
    {
        return [
            'chapter_name' => 'required|max:255',
            'chapter_name.*' => 'required|max:255',
            'chapter_title' => 'required|max:255',
            'chapter_title.*' =>'required|max:255',
        ];
    }

    private function generalRules(): array
    {
        return [
            'faculty_id' => 'required|exists:degrees,id',
            'batch_id' => 'required|exists:batches,id',
            'batch_type_id' => 'required|exists:batch_types,id',
            'semester_id' => 'required|exists:year_semesters,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|max:255',
            'description' => 'required',
            'visibility' => 'required|in:public,private',
            'file' => 'nullable|max:1025',
        ];
    }

    public function messages()
    {
        return [
            'faculty_id.required'=>'Please select the faculty.',
            'faculty_id.exists'=>'Please select the valid faculty.',

            'batch_id.required'=>'Please select the batch.',
            'batch_id.exists'=>'Please select the valid batch.',


            'batch_type_id.required'=>'Please select the batch type.',
            'batch_type_id.exists'=>'Please select the valid batch type.',


            'semester_id.required'=>'Please select the semester/Year.',
            'semester_id.exists'=>'Please select the valid semester/Year.',


            'subject_id.required'=>'Please select the subject.',
            'subject_id.exists'=>'Please select the valid subject.',

            'title.required'=>'Please enter the title.',
            'description.required'=>'Please enter the description.',
            'visibility.required'=>'Please select the visibility.',
            'visibility.in'=>'Please select the valid visibility only.',

        ];
    }
}
