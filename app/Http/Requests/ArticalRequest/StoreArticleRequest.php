<?php

namespace App\Http\Requests\ArticalRequest;

use App\Rules\CheckFile;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_at' => 'nullable|date',
            'photo' => [
                'nullable',
                'mimetypes:image/jpeg,image/png,image/gif,image/webp',
                'max:5120',
                new CheckFile
            ],


        ];
    }
}
