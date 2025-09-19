<?php

namespace App\Http\Requests\BookRequest;

use App\Rules\CheckFile;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'author'      => 'required|string|max:255',
            'file'        => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx', // Only allow specific document types
                'max:20480',           // Maximum 20 MB
                new CheckFile,         // Custom validation rule
            ],
        ];
    }
}
