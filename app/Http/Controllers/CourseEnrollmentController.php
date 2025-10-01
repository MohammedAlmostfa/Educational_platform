<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\CourseEnrollmentService;
use App\Http\Requests\CourseEnrollmentRequest\StoreCourseEnrollmentRequest;
use App\Http\Requests\CourseEnrollmentRequest\UpdateCourseEnrollmentRequest;
use App\Http\Resources\CourseEnrollmentResource;
use Illuminate\Support\Facades\Gate;

/**
 * Class CourseEnrollmentController
 *
 * This controller handles API endpoints related to course enrollments.
 * It uses CourseEnrollmentService to perform all business logic.
 *
 * Available actions:
 * - index: List all course enrollments (with optional status filter)
 * - store: Enroll the authenticated user in a course
 * - update: Update a user's enrollment status
 * - delete: Remove a user's enrollment from a course
 *
 * @package App\Http\Controllers
 */
class CourseEnrollmentController extends Controller
{
    /**
     * @var CourseEnrollmentService
     */
    protected $courseEnrollment;

    /**
     * Constructor
     *
     * @param CourseEnrollmentService $courseEnrollment
     */
    public function __construct(CourseEnrollmentService $courseEnrollment)
    {
        $this->courseEnrollment = $courseEnrollment;
    }

    /**
     * List all course enrollments with optional status filtering.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $status = $request->input('status'); // Optional status filter
        $result = $this->courseEnrollment->getCourseEnrollments($status);

        return $result['status'] === 200
            ? self::success($result['data'], $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Enroll the authenticated user in a course.
     *
     * @param int $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($courseId)
    {
        $result = $this->courseEnrollment->createCourseEnrollment($courseId);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update a user's course enrollment status.
     *
     * @param UpdateCourseEnrollmentRequest $request
     * @param int $userId
     * @param int $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCourseEnrollmentRequest $request, $userId, $courseId)
    {
        $data = $request->validated();
        $result = $this->courseEnrollment->updateCourseCompletion($userId, $courseId, $data);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Delete the authenticated user's enrollment from a course.
     *
     * @param int $courseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($courseId)
    {
        $result = $this->courseEnrollment->deleteCourseEnrollment($courseId);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    // Optional: Uncomment if you want a method to get all courses for a specific user
    // public function getUserCourses($userId)
    // {
    //     $result = $this->courseEnrollment->getUserCourses($userId);
    //     return $result['status'] === 200
    //         ? self::success($result['data'], $result['message'], $result['status'])
    //         : self::error(null, $result['message'], $result['status']);
    // }
}
