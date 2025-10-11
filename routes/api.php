<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Middleware\CheckPermission;

//---------------------------//
// Public Auth Routes
//---------------------------//
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login-with-google', [AuthController::class, 'loginwithGoogel'])->name('auth.login.google');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('auth.verify_email');
Route::post('/resend-code', [AuthController::class, 'resendCode'])->name('auth.resend_code');

Route::post('/change-password', [ForgetPasswordController::class, 'changePassword'])->name('password.change');
Route::post('/check-email', [ForgetPasswordController::class, 'checkEmail'])->name('password.check_email');
Route::post('/check-code', [ForgetPasswordController::class, 'checkCode'])->name('password.check_code');

Route::post('/refresh', [AuthController::class, 'refresh'])->name('auth.refresh');

//---------------------------//
// Public Resources (index only)
//---------------------------//
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/governorates', [GovernorateController::class, 'index'])->name('governorates.index');

//---------------------------//
// Authenticated Routes
//---------------------------//
Route::middleware(['auth:api', CheckPermission::class])->group(function () {

    //---------------------------//
    // User Profile
    //---------------------------//
    Route::get('/me', [ProfileController::class, 'getMe'])->name('profiles.me');
    Route::apiResource('profiles', ProfileController::class)->names([
        'index' => 'profiles.index',
        'store' => 'profiles.store',
        'show' => 'profiles.show',
        'update' => 'profiles.update',
        'destroy' => 'profiles.destroy',
    ]);

    //---------------------------//
    // Ratings
    //---------------------------//
    Route::apiResource('ratings', RatingController::class)->names([
        'index' => 'ratings.index',
        'store' => 'ratings.store',
        'show' => 'ratings.show',
        'update' => 'ratings.update',
        'destroy' => 'ratings.destroy',
    ]);

    //---------------------------//
    // Course Enrollment
    //---------------------------//
    Route::post('courses/{courseId}/enroll', [CourseEnrollmentController::class, 'store'])->name('courses.enrollment.store');
    Route::delete('courses/{courseId}/enroll', [CourseEnrollmentController::class, 'delete'])->name('courses.enrollment.delete');
    Route::get('users/{userId}/courses', [CourseEnrollmentController::class, 'index'])->name('users.courses.index');
    Route::put('users/{userId}/courses/{courseId}/status', [CourseEnrollmentController::class, 'update'])->name('users.courses.update_status');
    Route::get('enrollments', [CourseEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('enrollments/{id}', [CourseEnrollmentController::class, 'show'])->name('enrollments.show');
    Route::get('courses/{courseId}/enrollments', [CourseEnrollmentController::class, 'courseEnrollments'])->name('courses.enrollments.index');
    Route::get('users/{userId}/enrollments', [CourseEnrollmentController::class, 'userEnrollments'])->name('users.enrollments.index');

    //---------------------------//
    // Articles (except index)
    //---------------------------//
    Route::apiResource('articles', ArticleController::class)
        ->except(['index'])
        ->names([
            'store' => 'articles.store',
            'show' => 'articles.show',
            'update' => 'articles.update',
            'destroy' => 'articles.destroy',
        ]);

    //---------------------------//
    // Books (except index)
    //---------------------------//
    Route::apiResource('books', BookController::class)
        ->except(['index'])
        ->names([
            'store' => 'books.store',
            'show' => 'books.show',
            'update' => 'books.update',
            'destroy' => 'books.destroy',
        ]);

    //---------------------------//
    // Courses (except index & show)
    //---------------------------//
    Route::apiResource('courses', CourseController::class)
        ->except(['index', 'show'])
        ->names([
            'store' => 'courses.store',
            'update' => 'courses.update',
            'destroy' => 'courses.destroy',
        ]);
    Route::get('courses/tasks', [CourseController::class, 'getTaskWithTasks'])->name('courses.tasks.index');
    Route::post('courses/{course}/video', [CourseController::class, 'addCourseVideo'])->name('courses.video.store');
    Route::delete('courses/{course}/video/{mediaId}', [CourseController::class, 'deleteCourseVideo'])->name('courses.video.delete');

    //---------------------------//
    // Auth Actions
    //---------------------------//
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    //---------------------------//
    // Tasks
    //---------------------------//
    Route::apiResource('tasks', TaskController::class)
        ->except(['index'])
        ->names([
            'store' => 'tasks.store',
            'show' => 'tasks.show',
            'update' => 'tasks.update',
            'destroy' => 'tasks.destroy',
        ]);
    Route::get('user/tasks', [UserController::class, 'getUserTasks'])->name('user.tasks.index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

});
