<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\CourseEnrollmentService;
use App\Http\Requests\CourseEnrollmentRequest\StoreCourseEnrollmentRequest;
use App\Http\Requests\CourseEnrollmentRequest\UpdateCourseEnrollmentRequest;
use Illuminate\Support\Facades\Gate;

class CourseEnrollmentController extends Controller
{
    protected $courseEnrollment;
    public function __construct(CourseEnrollmentService $courseEnrollment)
    {
        $this->courseEnrollment = $courseEnrollment;
    }


    public function store( $courseId)
    {

        $result = $this->courseEnrollment->createCourseEnrollment($courseId);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    // public function getUserCourses($userId)
    // {
    //     $result = $this->courseEnrollment->getUserCourses($userId);
    //     return $result['status'] === 200
    //         ? self::success($result['data'], $result['message'], $result['status'])
    //         : self::error(null, $result['message'], $result['status']);
    // }
    public function update(UpdateCourseEnrollmentRequest $request, $userId, $courseId)
    {
        $data = $request->all();
        $result = $this->courseEnrollment->updateCourseCompletion($userId, $courseId, $data);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
    public function delete($courseId)
    {
        $result = $this->courseEnrollment->deleteCourseEnrollment($courseId);
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
