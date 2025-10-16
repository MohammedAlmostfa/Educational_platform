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
            'authLogin',
            'authLoginGoogle',
            'authRegister',
            'authLogout',
            'authRefresh',
            'authVerifyEmail',
            'authResendCode',

            // Profiles
            'profilesIndex',
            'profilesStore',
            'profilesShow',
            'profilesUpdate',
            'profilesDestroy',
            'profilesMe',

            // Ratings
            'ratingsIndex',
            'ratingsStore',
            'ratingsShow',
            'ratingsUpdate',
            'ratingsDestroy',

            // Courses
            'coursesStore',
            'coursesUpdate',
            'coursesDestroy',
            'coursesTasksIndex',
            'coursesVideoStore',
            'coursesVideoDelete',

            // Course Enrollment
            'coursesEnrollmentStore',
            'coursesEnrollmentDelete',
            'usersCoursesIndex',
            'usersCoursesUpdateStatus',
            'enrollmentsIndex',
            'enrollmentsShow',
            'coursesEnrollmentsIndex',
            'usersEnrollmentsIndex',

            // Books
            'booksIndex',
            'booksStore',
            'booksShow',
            'booksUpdate',
            'booksDestroy',

            // Articles
            'articlesIndex',
            'articlesStore',
            'articlesShow',
            'articlesUpdate',
            'articlesDestroy',

            // Tasks
            'tasksStore',
            'tasksShow',
            'tasksUpdate',
            'tasksDestroy',
            'userTasksIndex',

            // Users
            'usersIndex',

            // Governorates
            'governoratesIndex',

            // Certificates
            'certificatesIndex',
            'certificatesStore',
            'certificatesShow',
            'certificatesUpdate',
            'certificatesDestroy',
            'certificatesMy',
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
            'authLogin',
            'authLoginGoogle',
            'authRegister',
            'authLogout',
            'authRefresh',
            'authVerifyEmail',
            'authResendCode',

            // Profiles
            'profilesIndex',
            'profilesShow',
            'profilesUpdate',
            'profilesMe',

            // Courses
            'coursesEnrollmentStore',
            'coursesEnrollmentDelete',
            'usersCoursesIndex',
            'coursesEnrollmentsIndex',
            'usersEnrollmentsIndex',
            'coursesTasksIndex',

            // Books
            'booksIndex',
            'booksShow',

            // Articles
            'articlesIndex',
            'articlesShow',

            // Ratings
            'ratingsStore',
            'ratingsUpdate',
            'ratingsDestroy',

            // Tasks
            'userTasksIndex',

            // Governorates
            'governoratesIndex',

            // Certificates
            'certificatesMy',
        ];

        $userRole->syncPermissions($userPermissions);
    }
}
