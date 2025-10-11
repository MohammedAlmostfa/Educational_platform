<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //---------------------------//
        // 1️⃣ Define all permissions (match route names)
        //---------------------------//
        $permissions = [
            // Auth
            'auth.login',
            'auth.login.google',
            'auth.register',
            'auth.logout',
            'auth.refresh',
            'auth.verify_email',
            'auth.resend_code',

            // Profiles
            'profiles.index',
            'profiles.store',
            'profiles.show',
            'profiles.update',
            'profiles.destroy',
            'profiles.me',

            // Ratings
            'ratings.index',
            'ratings.store',
            'ratings.show',
            'ratings.update',
            'ratings.destroy',

            // Courses
            'courses.index',
            'courses.store',
            'courses.update',
            'courses.destroy',
            'courses.tasks.index',
            'courses.video.store',
            'courses.video.delete',

            // Course Enrollment
            'courses.enrollment.store',
            'courses.enrollment.delete',
            'users.courses.index',
            'users.courses.update_status',
            'enrollments.index',
            'enrollments.show',
            'courses.enrollments.index',
            'users.enrollments.index',

            // Books
            'books.index',
            'books.store',
            'books.show',
            'books.update',
            'books.destroy',

            // Articles
            'articles.index',
            'articles.store',
            'articles.show',
            'articles.update',
            'articles.destroy',

            // Countries
            'countries.index',

            // Optional: Users / Roles / Reports
            'manage-users',
            'manage-roles',
            'view-reports',
        ];

        //---------------------------//
        // 2️⃣ Create permissions
        //---------------------------//
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        //---------------------------//
        // 3️⃣ Create roles
        //---------------------------//
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'api']
        );

        $userRole = Role::firstOrCreate(
            ['name' => 'user', 'guard_name' => 'api']
        );

        //---------------------------//
        // 4️⃣ Assign permissions to roles
        //---------------------------//
        // Admin gets ALL permissions
        $adminRole->syncPermissions($permissions);

        // User gets LIMITED permissions
        $userPermissions = [
            // Auth
            'auth.login',
            'auth.login.google',
            'auth.register',
            'auth.logout',
            'auth.refresh',
            'auth.verify_email',
            'auth.resend_code',

            // Profiles
            'profiles.index',
            'profiles.show',
            'profiles.update',
            'profiles.me',

            // Courses
            'courses.index',
            'courses.enrollment.store',
            'courses.enrollment.delete',
            'users.courses.index',
            'courses.enrollments.index',
            'users.enrollments.index',

            // Books
            'books.index',
            'books.show',

            // Articles
            'articles.index',
            'articles.show',

            // Ratings
            'ratings.store',
            'ratings.update',
            'ratings.destroy',

            // General
            'countries.index',
        ];

        $userRole->syncPermissions($userPermissions);
    }
}
