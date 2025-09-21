<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

/**
 * Service class to handle all operations related to course ratings.
 *
 * Responsibilities:
 * - Create a new rating
 * - Update an existing rating
 * - Delete a rating
 */
class RatingService
{
    /**
     * Create a new rating for a course.
     *
     * @param array $data
     * @return array
     */
    public function createRating(array $data): array
    {
        $user = Auth::user();

        // Check if the user has already rated this course
        $existingRating = Rating::where('user_id', $user->id)
                                ->where('course_id', $data['course_id'])
                                ->first();

        if ($existingRating) {
            return [
                'status'  => 409,
                'message' => "لقد قمت بالتقييم من قبل.",
            ];
        }

        Rating::create([
            'user_id'   => $user->id,
            'course_id' => $data['course_id'],
            'rating'    => $data['rating'],
            'comment'   => $data['comment'] ?? null,
        ]);

        return [
            'status'  => 200,
            'message' => "تم إضافة التقييم بنجاح.",
        ];
    }

    /**
     * Update an existing rating.
     *
     * @param array $data
     * @param Rating $rating
     * @return array
     */
    public function updateRating(array $data, Rating $rating): array
    {
        $rating->update([
            'rating'  => $data['rating'],
            'comment' => $data['comment'] ?? $rating->comment,
        ]);

        return [
            'status'  => 200,
            'message' => "تم تحديث التقييم بنجاح.",
        ];
    }

    /**
     * Delete a rating.
     *
     * @param Rating $rating
     * @return array
     */
    public function deleteRating(Rating $rating): array
    {
        $rating->delete();

        return [
            'status'  => 200,
            'message' => "تم حذف التقييم بنجاح.",
        ];
    }
}
