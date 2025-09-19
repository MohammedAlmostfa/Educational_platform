<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseService
{
    /**
     * Retrieve all courses with pagination.
     *
     * This method fetches courses along with their related media.
     * It returns paginated results (10 per page by default).
     *
     * @return array
     */
    public function getAllCourses()
    {
        // Fetch courses with their related media
        $courses = Course::with('media')->paginate(10);

        return [
            'status' => 200,
            'message' => 'تم استرجاع الدورات بنجاح', // Courses retrieved successfully
            'data' => $courses
        ];
    }

    /**
     * Create a new course.
     *
     * This method creates a course record in the database.
     * If a 'photo' file is provided, it will store the media file.
     *
     * @param array $data
     * @return array
     */
    public function createCourse($data)
    {
        // Create course record
        $course = Course::create($data);

        // Store media file if provided
        if (!empty($data['photo'])) {
            $course->storeMediaFile($data['photo'], 'courses/photo', true);
        }

        return [
            'status' => 200,
            'message' => 'تم إنشاء الدورة بنجاح' // Course created successfully
        ];
    }

    /**
     * Update an existing course.
     *
     * This method updates course data.
     * If a 'photo' file is provided, it will replace the existing media file.
     *
     * @param \App\Models\Course $course
     * @param array $data
     * @return array
     */
    public function updateCourse($course, $data)
    {
        // Update course record
        $course->update($data);

        // Replace media file if a new one is provided
        if (!empty($data['photo'])) {
            $course->storeMediaFile($data['photo'], 'courses/photo', true);
        }

        return [
            'status' => 200,
            'message' => 'تم تحديث الدورة بنجاح' // Course updated successfully
        ];
    }

    /**
     * Delete a course.
     *
     * This method deletes the course along with all related media files
     * using a database transaction to ensure data integrity.
     *
     * @param \App\Models\Course $course
     * @return array
     */
    public function deleteCourse($course)
    {
        return DB::transaction(function () use ($course) {
            // Delete all related media files
            $course->media()->delete();

            // Delete the course record
            $course->delete();

            return [
                'status' => 200,
                'message' => 'تم حذف الدورة بنجاح' // Course deleted successfully
            ];
        });
    }
}
