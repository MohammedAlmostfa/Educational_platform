<?php

namespace App\Http\Requests\CertificateRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
      'certificate_number' => 'required|integer|unique:certificates,certificate_number',
            'user_id'     => 'required|exists:users,id',
            'course_id'   => 'required|exists:courses,id',
            'date'        => 'required|date',
            'file'        => 'required|file|mimes:pdf,jpg,png|max:2048',
        ];
    }
}
