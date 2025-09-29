<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set to true to allow all users to create tasks
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
            'course_id'     => 'required|exists:courses,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'deadline_date' => 'required|date',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after_or_equal:start_time',
            'file'          => 'required|file|mimes:pdf,doc,docx,jpg,png'
        ];
    }
}
