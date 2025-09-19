<?php

namespace App\Services;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

/**
 * Service to handle all operations related to course ratings.
 */
class RatingService
{
    public function createRating(array $data)
    {
        $user = Auth::user();

        // Prevent duplicate rating for the same course
        $rate = Rating::where('user_id', $user->id)
                      ->where('course_id', $data['course_id'])
                      ->first();

        if ($rate) {
            return [
                'status' => 409,
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
            'status' => 200,
            'message' => "تم إضافة التقييم بنجاح.",
        ];
    }

    public function updateRating(array $data, Rating $rate)
    {
        $rate->update([
            'rating'  => $data['rating'],
            'comment' => $data['comment'] ?? $rate->comment,
        ]);

        return [
            'status' => 200,
            'message' => "تم تحديث التقييم بنجاح.",
        ];
    }

    public function deleteRating(Rating $rate)
    {
        $rate->delete();

        return [
            'status' => 200,
            'message' => "تم حذف التقييم بنجاح.",
        ];
    }
}
