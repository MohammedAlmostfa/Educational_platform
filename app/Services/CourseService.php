<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseService
 *
 * Handles all business logic related to Course management,
 * including creation, updating, deletion, and media handling.
 */
class CourseService
{
    /**
     * Retrieve all courses with optional search filtering.
     *
     * This method fetches all courses along with their media and ratings.
     * If a search query is provided, it applies the search scope from the Course model.
     *
     * @param string|null $searchData  Optional search term to filter courses.
     * @return array  API-style response containing course data and status.
     */
    public function getAllCourses($searchData)
    {
        $courses = Course::with(['media', 'ratings', 'ratings.user'])
            ->withAvg('ratings', 'rating')
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData); // Uses local scope in Course model
            })
            ->get();

        return [
            'status' => 200,
            'message' => 'تم استرجاع الدورات بنجاح', // Courses retrieved successfully
            'data' => $courses
        ];
    }

    /**
     * Retrieve all courses along with their related tasks and associated media.
     *
     * This method also loads average ratings and user info for each rating.
     * It supports optional search filtering via the model's scopeSearch.
     *
     * @param string|null $searchData  Optional search term.
     * @return array  API-style response with course and related task data.
     */
    public function getCourseWithTasks($searchData)
    {
        $courses = Course::with([
                'media',            // Course media
                'tasks',            // Course tasks
                'tasks.media',      // Task media
                'ratings',          // Course ratings
                'ratings.user',     // Users who rated
            ])
            ->withAvg('ratings', 'rating')
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData);
            })
            ->get();

        return [
            'status' => 200,
            'message' => 'تم استرجاع الدورات بنجاح', // Courses retrieved successfully
            'data' => $courses
        ];
    }

    /**
     * Create a new course and optionally attach a photo.
     *
     * Creates a new course record in the database and stores a photo
     * in the 'courses/photo' directory if provided.
     *
     * @param array $data  Validated course data (including optional photo).
     * @return array  API-style success message.
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
     * Update an existing course and optionally update its photo.
     *
     * Updates the main course record, and if a new photo is uploaded,
     * it replaces the existing media with the new one.
     *
     * @param \App\Models\Course $course  The course instance to update.
     * @param array $data  Updated course data (including optional new photo).
     * @return array  API-style success message.
     */
    public function updateCourse($course, $data)
    {
        $course->update($data);

        if (!empty($data['photo'])) {
            $course->storeMediaFile($data['photo'], 'courses/photo', true);
        }

        return [
            'status' => 200,
            'message' => 'تم تحديث الدورة بنجاح' // Course updated successfully
        ];
    }

    /**
     * Delete a course along with its associated media files.
     *
     * This operation runs inside a database transaction to ensure
     * both media and the course record are deleted atomically.
     *
     * @param \App\Models\Course $course  The course to delete.
     * @return array  API-style success message.
     */
    public function deleteCourse($course)
    {
        return DB::transaction(function () use ($course) {
            // Delete all related media
            $course->deleteMedia($course->media);
            $course->media()->delete();

            // Delete the course itself
            $course->delete();

            return [
                'status' => 200,
                'message' => 'تم حذف الدورة بنجاح' // Course deleted successfully
            ];
        });
    }

    /**
     * Add or replace the video for a specific course.
     *
     * If a video already exists, it will be replaced with the new one.
     *
     * @param \App\Models\Course $course  The target course.
     * @param array $data  Contains the uploaded video file.
     * @return array  API-style response.
     */
    public function AddCourseVidieo(Course $course, $data)
    {
        $course->storeMediaFile($data['video'], 'courses/video', true);

        return [
            'status' => 200,
            'message' => 'تمت إضافة الفيديو بنجاح', // Video added successfully
            'data' => null,
        ];
    }

    /**
     * Delete a specific video from the given course.
     *
     * Removes the selected video media record and deletes the file from storage.
     *
     * @param \App\Models\Course $course  The course containing the video.
     * @param int $mediaId  The ID of the media file to delete.
     * @return array  API-style response.
     */
    public function deleteCourseVidieo(Course $course, int $mediaId)
    {
        $media = $course->videos()->find($mediaId);

        if ($media) {
            $course->deleteMedia([$media]);
        }

        return [
            'status' => 200,
            'message' => 'تم حذف الفيديو بنجاح' // Video deleted successfully
        ];
    }
}
