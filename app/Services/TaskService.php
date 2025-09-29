<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * Create a new task.
     *
     * This method creates a task record in the database.
     * If a 'file' is provided in the data, it will store the media file
     * associated with the task using the polymorphic media relationship.
     *
     * @param array $data
     * @return array
     */
    public function createTask($data)
    {
        // Create task record
        $task = Task::create($data);

        // Store media file if provided
        if (!empty($data['file'])) {
            // storeMediaFile is assumed to handle file storage and linking
            $task->storeMediaFile($data['file'], 'Task/files', true);
        }

        return [
            'status' => 200,
            'message' => 'تم انشاء تاسك بنجاح' // Task created successfully
        ];
    }

    /**
     * Update an existing task.
     *
     * This method updates task data.
     * If a 'file' is provided, it will replace the existing media file.
     *
     * @param Task $task
     * @param array $data
     * @return array
     */
    public function updateTask(Task $task, $data)
    {
        // Update task record
        $task->update($data);

        // Replace media file if a new one is provided
        if (!empty($data['file'])) {
            $task->storeMediaFile($data['file'], 'Task/files', true);
        }

        return [
            'status' => 200,
            'message' => 'تم تحديث التاسك بنجاح' // Task updated successfully
        ];
    }

    /**
     * Delete a task along with its associated media files.
     *
     * This method uses a database transaction to ensure that both the task
     * and its media are deleted atomically.
     *
     * @param Task $task
     * @return array
     */
    public function deleteTask(Task $task)
    {
        return DB::transaction(function () use ($task) {
            // Delete all related media files
            $task->deleteMedia($task->media); // fixed variable name

            // Delete media records from the database
            $task->media()->delete();

            // Delete the task record
            $task->delete();

            return [
                'status' => 200,
                'message' => 'تم حذف التاسك بنجاح' // Task deleted successfully
            ];
        });
    }
}
