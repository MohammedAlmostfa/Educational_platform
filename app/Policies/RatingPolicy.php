<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Rating;

class RatingPolicy
{
    /**
     * Determine if the user can create a rating for a course.
     *
     * Only users who are enrolled in the course can create a rating.
     *
     * @param User $user
     * @param Rating $rating
     * @return bool
     */
    public function store(User $user, Rating $rating): bool
    {
        return $user->courses()
                    ->where('course_id', $rating->course_id)
                    ->exists();
    }

    /**
     * Determine if the user can update a rating.
     *
     * Only the creator of the rating can update it.
     *
     * @param User $user
     * @param Rating $rating
     * @return bool
     */
    public function update(User $user, Rating $rating): bool
    {
        return $user->id === $rating->user_id;
    }

    /**
     * Determine if the user can delete a rating.
     *
     * Only the creator of the rating can delete it.
     *
     * @param User $user
     * @param Rating $rating
     * @return bool
     */
    public function delete(User $user, Rating $rating): bool
    {
        return $user->id === $rating->user_id;
    }
}
