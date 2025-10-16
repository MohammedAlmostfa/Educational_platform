<?php

namespace App\Http\Requests\CertificateRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'title'       => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'user_id'     => 'sometimes|nullable|exists:users,id',
            'certificate_number' => 'nullable|integer|unique:certificates,certificate_number',
            'course_id'   => 'sometimes|nullable|exists:courses,id',
            'date'        => 'sometimes|nullable|date',
            'file'        => 'sometimes|nullable|file|mimes:pdf,jpg,png|max:2048',
        ];
    }
}
