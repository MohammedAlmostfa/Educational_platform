<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 *
 * Handles business logic related to users, including retrieving their courses with tasks and media.
 */
class UserService
{
    public function getUsers()
{
$users = User::select('id', 'email','name')
    ->with('profile','profile.governorate')
    ->get();

    return [
        'status'  => 200,
        'message' => 'تم استرجاع المستخدمين بنجاح',
        'data'    => $users
    ];
}

    /**
     * Get the authenticated user's courses along with tasks and related media.
     *
     * @param string|null $searchData Optional search keyword to filter courses
     * @return array
     */
    public function getTasks($searchData = null)
    {
        // Get the currently authenticated user
        $user = Auth::user();


        $courses = $user->courses()
            ->with([
                'media',       // Course media
                'videos',
                'tasks',       // Related tasks
                'tasks.media'  // Media for each task
            ])
            ->withAvg('ratings', 'rating')
            ->when(!empty($searchData), function ($query) use ($searchData) {
                $query->search($searchData); // Uses scopeSearch in Course model
            })
            ->get();

        return [
            'status'  => 200,
            'message' => 'تم استرجاع الدورات بنجاح',
            'data'    => $courses
        ];
    }
}
