<?php

namespace App\Http\Requests\CourseRequest;

use App\Rules\CheckFile;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users (or customize logic here)
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
            'video' => [
                'required', // must be present
                'file',
      'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-matroska,video/webm',
                new CheckFile, // your custom validation rule
            ],
        ];
    }


}



