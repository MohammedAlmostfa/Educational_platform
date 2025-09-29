<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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

            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'deadline_date' => 'nullable|date',
            'start_time'    => 'nullable|date_format:H:i',
            'end_time'      => 'nullable|date_format:H:i|after_or_equal:start_time',
            'file'          => 'nullable|file|mimes:pdf,doc,docx,jpg,png'
        ];
    }
}
