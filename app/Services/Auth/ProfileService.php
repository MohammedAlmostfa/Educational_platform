<?php

namespace App\Services\Auth;

use App\Models\Profile;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileService
 *
 * Service layer responsible for handling profile creation, updating, and retrieval
 * for the authenticated user.
 */
class ProfileService
{
    /**
     * Create a new profile for the authenticated user.
     *
     * - Updates user's name.
     * - Creates a new profile record.
     * - Optionally uploads and attaches a profile photo.
     *
     * @param array $data Input data for profile creation
     * @return array Response with status and message (in Arabic)
     */
    public function createProfile(array $data): array
    {
        $user = Auth::user();

        // Only create a profile if the user does not already have one
        if (!$user->profile) {
            DB::transaction(function () use ($user, $data) {
                // Update user's name
                $user->name = $data['name'];
                $user->save();

                // Create a new profile linked to the user
                Profile::create([
                    'birthday'   => $data['birthday'] ?? null,
                    'phone'      => $data['phone'],
                    'address'    => $data['address'],
                    'user_id'    => $user->id,
                    'governorate_id' => $data['governorate_id'] ?? null,
                ]);

            });

            return [
                'message' => 'تم إنشاء الملف الشخصي بنجاح.',
                'status'  => 200,
            ];
        }

        return [
            'message' => 'للمستخدم ملف شخصي موجود مسبقاً.',
            'status'  => 400,
        ];
    }

    /**
     * Update the profile of the authenticated user.
     *
     * - Updates user name if provided.
     * - Updates profile fields such as birthday, phone, address, etc.
     * - Replaces profile photo if provided.
     *
     * @param array $data Input data for profile update
     * @return array Response with status and message (in Arabic)
     */
    public function updateProfile(array $data): array
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Update user's name if provided
        if (!empty($data['name'])) {
            $user->name = $data['name'];
            $user->save();
        }

        // Update profile if it exists
        if ($profile) {
            DB::transaction(function () use ($profile, $user, $data) {
                // Update profile fields
                $profile->update([
                    'birthday'   => $data['birthday'] ?? $profile->birthday,
                    'phone'      => $data['phone'] ?? $profile->phone,
                    'address'    => $data['address'] ?? $profile->address,
                    'governorate_id' => $data['governorate_id'] ?? $profile->governorate_id,
                ]);

                // Update profile photo if provided
                if (!empty($data['photo'])) {
                    $user->storeMediaFile($data['photo'], 'users/photos', true);
                }
            });

            return [
                'message' => 'تم تحديث الملف الشخصي بنجاح.',
                'status'  => 200,
            ];
        }

        return [
            'message' => 'المستخدم لا يمتلك ملف شخصي لتحديثه.',
            'status'  => 404,
        ];
    }

    /**
     * Get the profile details of the authenticated user.
     *
     * - Loads profile and media relationships.
     * - Returns essential user information (id, name, email, etc.).
     * - Includes full URL for profile photo if available.
     *
     * @return array Response with user data (messages in Arabic)
     */
    public function getMe(): array
    {
        $user = Auth::user();
        $user->load('profile', 'media');

        $userData = [
            'id'       => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'phone'    => $user->profile?->phone,
            'address'  => $user->profile?->address,
            'governorate'  => $user->profile?->governorate?->name,
        ];

        return [
            'message' => 'تم استرجاع بيانات المستخدم بنجاح.',
            'status'  => 200,
            'data'    => $userData,
        ];
    }
}
