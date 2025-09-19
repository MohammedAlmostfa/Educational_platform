<?php

namespace App\Http\Requests\ProfileRequest;

use App\Rules\CheckFile;
use App\Rules\CheckPhoto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255',

            'birthday' => 'nullable|date|before:-13 years',
            'phone' => 'required',
            'address' => 'required',
            'longitude' => 'nullable|',
            'latitude' => 'nullable|',
            'photo' => [
                'nullable',
                'mimetypes:image/jpeg,image/png,image/gif,image/webp',
                'max:5120',
                new CheckFile
            ],
        ];
    }

    /**
     * Handle a failed validation attempt.
     * This method is called when validation fails.
     * Logs failed attempts and throws validation exception.
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     *
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status'  => 'error',
            'message' => 'Validation failed.',
            'errors'  => $validator->errors(),
        ], 422));
    }
}
