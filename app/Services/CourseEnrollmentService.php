<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Class CourseEnrollmentService
 *
 * This service handles the management of course enrollments.
 * It provides methods for:
 * 1. Retrieving course enrollments (with optional status filtering and date sorting)
 * 2. Enrolling the authenticated user into a course
 * 3. Updating the enrollment status of a user
 * 4. Deleting a course enrollment for a user
 *
 * @package App\Services
 */
class CourseEnrollmentService
{
    /**
     * Get a list of all course enrollments with optional status filtering.
     *
     * @param string|null $statusFilter Optional filter by enrollment status
     * @return array Returns an array with the enrollment data, status code, and a message
     */
    public function getCourseEnrollments($statusFilter)
    {
        // Load all courses with their associated users
        $courses = Course::with('users')->get();

        $enrollments = [];
        foreach ($courses as $course) {
            foreach ($course->users as $user) {
                // Skip users that do not match the status filter
                if ($statusFilter && $user->pivot->status != $statusFilter) {
                    continue;
                }

                // Prepare enrollment data
                $enrollments[] = [
                    'user_id'     => $user->id,
                    'user_name'   => $user->name,
                    'email'       => $user->email,
                    'course_id'   => $course->id,
                    'course_name' => $course->title,
                    'status'      => $user->pivot->status,
                    'enrolled_at' => $user->pivot->created_at,
                ];
            }
        }

        // Sort enrollments by date (newest first)
        $enrollments = collect($enrollments)->sortByDesc('enrolled_at')->values()->all();

        return [
            'data'    => $enrollments,
            'status'  => 200,
            'message' => 'تم جلب المشتركين بالدورات بنجاح',
        ];
    }

    /**
     * Enroll the currently authenticated user in a specific course.
     *
     * @param int $courseId The ID of the course to enroll in
     * @return array Returns an array with the operation status and message
     */
    public function createCourseEnrollment(int $courseId): array
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // Check if the user is already enrolled in this course
        $alreadyEnrolled = $user->courses()
            ->where('course_id', $courseId)
            ->exists();

        if ($alreadyEnrolled) {
            return [
                'status'  => 400,
                'message' => 'أنت مشترك في هذه الدورة مسبقاً',
            ];
        }

        // Attach the course to the user
        $user->courses()->attach($courseId);

        return [
            'status'  => 200,
            'message' => 'تم تقديم طلب الاشتراك في الدورة بنجاح بانتظار تاكيد الادارة عغلى الاشرتاك واكمال الاجراءات ',
        ];
    }

    /**
     * Update the enrollment status of a specific user for a given course.
     *
     * This can be used to set statuses such as:
     * - in-progress
     * - completed
     * - paused
     *
     * @param int $userId The ID of the user
     * @param int $courseId The ID of the course
     * @param array $data Array containing the 'status' key
     * @return array Returns an array with the operation status and message
     */
    public function updateCourseCompletion(int $userId, int $courseId, array $data): array
    {
        $user = User::findOrFail($userId);

        // Update the pivot table with the new status
        $user->courses()->updateExistingPivot($courseId, [
            'status' => $data['status'] ?? 'in-progress', // Default to in-progress if not provided
        ]);

        return [
            'status'  => 200,
            'message' => 'تم تحديث حالة الاشتراك بنجاح',
        ];
    }

    /**
     * Delete a course enrollment for the currently authenticated user.
     *
     * Ensures that the enrollment is active before allowing deletion.
     *
     * @param int $courseId The ID of the course to remove enrollment from
     * @return array Returns an array with the operation status and message
     */
    public function deleteCourseEnrollment(int $courseId): array
    {
        $user = Auth::user();

        // Retrieve the user's enrollment for this course
        $userCourse = $user->courses()->where('course_id', $courseId)->first();

        if (!$userCourse) {
            return [
                'status'  => 400,
                'message' => 'أنت غير مشترك في هذه الدورة',
            ];
        }

        // Access pivot table data to check enrollment status
        $pivot = $userCourse->pivot;

        // Prevent deletion if the enrollment is not active
        if ($pivot->status != "1") {
            return [
                'status'  => 400,
                'message' => 'لا يمكن إلغاء الاشتراك في الدورة لأنها غير مفعّلة',
            ];
        }

        // Detach the course from the user
        $user->courses()->detach($courseId);

        return [
            'status'  => 200,
            'message' => 'تم إلغاء الاشتراك من الدورة بنجاح',
        ];
    }
}
