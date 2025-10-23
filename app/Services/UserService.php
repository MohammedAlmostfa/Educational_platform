<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 *
 * 💡 Description:
 * This service layer handles all user-related business logic
 * — such as retrieving user lists, their enrolled courses, tasks, and related media.
 *
 * It helps keep controllers clean and reusable by encapsulating logic here.
 */
class UserService
{
    /**
     * Retrieve all users along with their profiles and governorate information.
     *
     * @return array<string, mixed> Standard API response format
     *
     */
    public function getUsers(): array
    {
        // Fetch users with related profile and governorate info
        $users = User::select('id', 'email', 'name')
            ->with(['profile', 'profile.governorate'])
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع المستخدمين بنجاح',
            'data'    => $users,
        ];
    }

    /**
     * Retrieve all courses of the authenticated user,
     * including related media, videos, tasks, and task media.
     *
     * Optionally applies a search filter via Course::scopeSearch().
     *
     * @param string|null $searchData Search keyword (optional)
     * @return array<string, mixed> Standard API response format
     */
    public function getTasks(?string $searchData = null): array
    {
        // Get the authenticated user (via JWT or session)
        $user = Auth::user();

        // Fetch user's enrolled courses (status = 2 → active/approved)
        $courses = $user->courses()
            ->with([
                'media',       // Course images
                'videos',      // Course videos
                'tasks',       // Tasks under each course
                'tasks.media', // Media files under each task
            ])
            ->wherePivot('status', 2)
            ->withAvg('ratings', 'rating') // Calculate average course rating
            ->when(!empty($searchData), function ($query) use ($searchData) {
                // Apply search scope (searches title or instructor name)
                $query->search($searchData);
            })
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع الدورات بنجاح',
            'data'    => $courses,
        ];
    }

    /**
     * Retrieve all course enrollments for the authenticated user,
     * including pivot data (status, created_at) and average rating.
     *
     * Optionally applies a search filter.
     *
     * @param string|null $searchData Search keyword (optional)
     * @return array<string, mixed> Standard API response format
     */
    public function getMyCourseEnrollments(?string $searchData = null): array
    {
        // Get the authenticated user
        $user = Auth::user();

        // Retrieve enrolled courses with pivot data and rating averages
        $courses = $user->courses()
            ->with(['media']) // Load course images
            ->withPivot('status', 'created_at') // Include pivot columns
            ->withAvg('ratings', 'rating')      // Include average rating
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData); // Filter by search term
            })
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع طلبات التقدم الى الدورات بنجاح',
            'data'    => $courses,
        ];
    }
}
