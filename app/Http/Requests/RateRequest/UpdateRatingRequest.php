<?php

namespace App\Http\Requests\RateRequest;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequest to validate and authorize updating a course rating.
 */
class UpdateRatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Uses the RatingPolicy 'update' method to ensure
     * only the creator of the rating can update it.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = $this->user();

        // Get the rating instance from the route parameter
        $rating = $this->route('rating');

        // Check if the user can update this rating
        return $user->can('update', $rating);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Rules:
     * - rating: optional integer between 1 and 5
     * - comment: optional string up to 1000 characters
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rating'  => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
    }
}
