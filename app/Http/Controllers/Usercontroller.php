<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRatingResource;
use App\Models\User;
use App\Services\UserService;
use App\Http\Resources\ItemResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 *
 * Handles user-related operations such as retrieving items, ratings, saved items, and favorite users.
 */
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
