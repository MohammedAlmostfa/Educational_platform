<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CourseResource;
use App\Http\Requests\courseRequest\StoreCourseRequest;
use App\Http\Requests\courseRequest\CourseFilterRequest;
use App\Http\Requests\courseRequest\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    protected $courseService;

    /**
     * CourseController constructor.
     *
     * @param CourseService $courseService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of courses with pagination.
     *
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

    public function getTaskWithTasks(Request $request): JsonResponse
    {
  $searchData = $request->input('search');
        $result = $this->courseService->getTaskWithTasks($searchData);

        return $result['status'] === 200
          ? self::success(CourseResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
    /**
     * Store a newly created course in storage.
     *
     * @param StoreCourseRequest $request
     * @return JsonResponse
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Corrected the double $ issue
        $result = $this->courseService->createCourse($validated);

        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Update the specified course in storage.
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
     * Remove the specified course from storage.
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
}
