<?php

namespace App\Http\Requests\BookRequest;

use App\Rules\CheckFile;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'author'      => 'sometimes|required|string|max:255',
            'file'        => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:20480',
                new CheckFile,
            ],
        ];
    }
}
