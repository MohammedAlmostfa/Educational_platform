<?php

namespace App\Http\Requests\courseRequest;

use App\Rules\CheckFile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'instructor' => 'sometimes|required|string|max:255',
            'duration' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            'photo' => [
                'nullable',
                'mimetypes:image/jpeg,image/png,image/gif,image/webp',
                'max:5120',
                new CheckFile
            ],
            // --- IGNORE ---
        ];
    }
}
