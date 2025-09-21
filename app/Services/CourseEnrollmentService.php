<?php

namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Class CourseEnrollmentService
 *
 * This service handles the enrollment management for courses.
 * Features include:
 * 1. Enrolling a user in a course.
 * 2. Updating the enrollment status (e.g., in-progress, completed).
 * 3. Deleting a course enrollment.
 *
 * This class can be used by controllers to manage course-related operations in a clean and organized way.
 *
 * @package App\Services
 */
class CourseEnrollmentService
{
    /**
     * Enroll the authenticated user in a specific course.
     *
     * @param int $courseId The course ID
     * @return array Array containing the operation status and message
     */
    public function createCourseEnrollment(int $courseId): array
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        // Check if the user is already enrolled
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
            'message' => 'تم الاشتراك في الدورة بنجاح',
        ];
    }

    /**
     * Update the enrollment status of a user for a specific course.
     *
     * This method can be used to set status like:
     * - in-progress
     * - completed
     * - paused
     *
     * @param int $userId The user ID
     * @param int $courseId The course ID
     * @param array $data Array containing the status to update
     * @return array Array containing the operation status and message
     */
    public function updateCourseCompletion(int $userId, int $courseId, array $data): array
    {
        $user = User::findOrFail($userId);

        // Update the pivot table with the new status
        $user->courses()->updateExistingPivot($courseId, [
            'status' => $data['status'] ?? 'in-progress', // Default value if not provided
        ]);

        return [
            'status'  => 200,
            'message' => 'تم تحديث حالة الاشتراك بنجاح',
        ];
    }

    /**
     * Delete a course enrollment for a specific user.
     *
     * Checks first if the course is active before deleting the enrollment.
     *
     * @param array $data Array containing 'user_id' and 'course_id'
     * @return array Array containing the operation status and message
     */
    public function deleteCourseEnrollment(int $courseId): array
    {
        $user = Auth::user();

        // Get the course enrollment pivot
        $userCourse = $user->courses()->where('course_id', $courseId)->first();

        if (!$userCourse) {
            return [
                'status' => 400,
                'message' => 'أنت غير مشترك في هذه الدورة',
            ];
        }

        // Access the pivot table data
        $pivot = $userCourse->pivot;

        // Check status from pivot
        if ($pivot->status != "1") {
            Log::info("Course pivot status is not active. Status: " . $pivot->status);
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
