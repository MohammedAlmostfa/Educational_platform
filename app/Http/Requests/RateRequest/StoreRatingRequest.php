<?php

namespace App\Http\Requests\RateRequest;

use App\Models\Rating;
use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest to validate and authorize creating a course rating.
 */
class StoreRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * This uses the RatingPolicy 'store' method to ensure
     * only users enrolled in the course can rate it.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Create a temporary Rating instance with course_id from request
        $rating = new Rating([
            'course_id' => $this->input('course_id'),
        ]);

        // Check authorization via the RatingPolicy
        return $this->user()->can('store', $rating);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Rules:
     * - rating: required integer between 1 and 5
     * - comment: optional string up to 1000 characters
     * - course_id: required, must exist in courses table
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
    'rating' => 'required|numeric|min:1|max:5',

            'comment'   => 'nullable|string|max:1000',
            'course_id' => 'required|exists:courses,id',
        ];
    }
}
