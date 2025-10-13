<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CourseResource;
use App\Http\Requests\courseRequest\StoreCourseRequest;
use App\Http\Requests\courseRequest\UpdateCourseRequest;
use App\Http\Requests\courseRequest\StoreCourseVideoRequest;

/**
 * Class CourseController
 *
 * This controller handles all endpoints related to courses:
 * - Listing, creating, updating, and deleting courses.
 * - Managing media (photos and videos) for each course.
 *
 * @package App\Http\Controllers
 */
class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    protected CourseService $courseService;

    /**
     * Inject the CourseService dependency.
     *
     * @param CourseService $courseService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display all available courses with optional search filtering.
     *
     * Retrieves all courses along with their media and ratings.
     * Optionally filters results based on a search query string.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $searchData = $request->input('search');
        $result = $this->courseService->getAllCourses($searchData);

        return $result['status'] === 200
            ? self::success(CourseResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Display all courses with their associated tasks.
     *
     * Each course includes its tasks, task media, and ratings.
     * Can be filtered using an optional search query.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTaskWithTasks(Request $request): JsonResponse
    {
        $searchData = $request->input('search');
        $result = $this->courseService->getCourseWithTasks($searchData);

        return $result['status'] === 200
            ? self::success(CourseResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Store a newly created course in the database.
     *
     * Accepts validated request data and optionally stores a photo.
     *
     * @param StoreCourseRequest $request
     * @return JsonResponse
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->courseService->createCourse($validated);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update the specified course.
     *
     * Updates both course details and optionally its associated photo.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return JsonResponse
     */
    public function update(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->courseService->updateCourse($course, $validated);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove a specific course from the system.
     *
     * This action deletes the course and all its related media.
     *
     * @param Course $course
     * @return JsonResponse
     */
    public function destroy(Course $course): JsonResponse
    {
        $result = $this->courseService->deleteCourse($course);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Add or replace a course video.
     *
     * This method uploads a new video file and associates it with the given course.
     * If a video already exists, it can be replaced.
     *
     * @param StoreCourseVideoRequest $request
     * @param Course $course
     * @return JsonResponse
     */
    public function addCourseVideo(StoreCourseVideoRequest $request, Course $course): JsonResponse
    {
        $validated = $request->validated();
        $result = $this->courseService->AddCourseVidieo($course, $validated);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Delete a specific video from a course.
     *
     * @param Course $course
     * @param int $mediaId
     * @return JsonResponse
     */
    public function DeleteCourseVidieo(Course $course, int $mediaId): JsonResponse
    {
        $result = $this->courseService->deleteCourseVidieo($course, $mediaId);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
