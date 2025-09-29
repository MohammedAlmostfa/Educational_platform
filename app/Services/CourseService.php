<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseService
{
    /**
     * Retrieve all courses with optional search filtering.
     *
     * This method fetches courses along with their related media and average ratings.
     * It can filter courses based on search data.
     *
     * @param string|null $searchData
     * @return array
     */
    public function getAllCourses($searchData)
    {
        $courses = Course::with(['media','ratings','ratings.user'])
            ->withAvg('ratings', 'rating')
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData); // Uses scopeSearch in Course model
            })
            ->get();

        return [
            'status' => 200,
            'message' => 'تم استرجاع الدورات بنجاح', // Courses retrieved successfully
            'data' => $courses
        ];
    }

    /**
     * Retrieve all courses along with their tasks and associated media.
     *
     * Each course will include its media, tasks, and each task's media.
     * Can also filter courses based on search criteria.
     *
     * @param string|null $searchData
     * @return array
     */
    public function getTaskWithTasks($searchData)
    {
        $courses = Course::with([
                'media',       // Course media
                'tasks',       // Related tasks
                'tasks.media'  // Media for each task
            ])
            ->withAvg('ratings', 'rating')
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData); // Scope search in the Course model
            })
            ->get();

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
     * If a 'photo' file is provided, it will store it as course media.
     *
     * @param array $data
     * @return array
     */
    public function createCourse($data)
    {
        // Create the course record
        $course = Course::create($data);

        // Store the media file if provided
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
     * Updates the course data and optionally replaces the course photo.
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
     * Delete a course along with its media.
     *
     * Uses a database transaction to ensure all related media and the course itself
     * are deleted safely.
     *
     * @param \App\Models\Course $course
     * @return array
     */
    public function deleteCourse($course)
    {
        return DB::transaction(function () use ($course) {
            // Delete all media files related to the course
            $course->deleteMedia($course->media);
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
