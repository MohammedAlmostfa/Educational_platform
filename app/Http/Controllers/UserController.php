<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Resources\CourseResource;


/**
 * Class UserController
 *
 * Handles user-related operations such as retrieving items, ratings, saved items,
 * favorite users, and courses with their related tasks.
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $searchData = $request->input('search');
        $result = $this->userService->getUsers($searchData);
        return $result['status'] === 200
            ? self::success(UserResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }

    /**
     * Get the authenticated user's courses with tasks and related media.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserTasks(Request $request): JsonResponse
    {
        $searchData = $request->input('search');
        $result = $this->userService->getTasks($searchData);

        return $result['status'] === 200
            ? self::success(CourseResource::collection($result['data']), $result['message'], $result['status'])
            : self::error(null, $result['message'], $result['status']);
    }
}
