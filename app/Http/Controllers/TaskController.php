<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest\StoreTaskRequest;
use App\Http\Requests\TaskRequest\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * @var TaskService
     * Service to handle task-related operations.
     */
    protected $taskService;

    /**
     * Inject the TaskService into the controller.
     *
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();
        // Pass validated data to the service to create the rating
        $result = $this->taskService->createTask($validated);

        // Return JSON response based on result
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }




    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();
        // Pass validated data to the service to create the rating
        $result = $this->taskService->updateTask($task, $validated);

        // Return JSON response based on result
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        // Pass validated data to the service to create the rating
        $result = $this->taskService->deleteTask($task);

        // Return JSON response based on result
        return $result['status'] === 200
            ? self::success(null, $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
