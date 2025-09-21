<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Middleware\CheckPermission;

//---------------------------//
// Public Auth Routes
//---------------------------//

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/loginwithGoogel', [AuthController::class, 'loginwithGoogel'])->name('auth.login.google');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::post('/verify-email', [AuthController::class, 'verify'])->name('auth.verify_email');
Route::post('/resendCode', [AuthController::class, 'resendCode'])->name('auth.resend_code');

Route::post('/changePassword', [ForgetPasswordController::class, 'changePassword'])->name('password.change');
Route::post('/checkEmail', [ForgetPasswordController::class, 'checkEmail'])->name('password.check_email');
Route::post('/checkCode', [ForgetPasswordController::class, 'checkCode'])->name('password.check_code');


//---------------------------//
// Authenticated Routes
//---------------------------//
Route::middleware('auth:api',CheckPermission::class)->group(function () {

    // User info
    Route::get('me', [ProfileController::class, 'getme'])->name('profiles.me');

    //---------------------------//
    // Profiles
    //---------------------------//
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
    Route::post('courses/{courseId}/enrollment', [CourseEnrollmentController::class, 'store'])
        ->name('courses.enrollment.store'); // Enroll user in course
    Route::delete('courses/{courseId}/enrollment', [CourseEnrollmentController::class, 'delete'])
        ->name('courses.enrollment.delete'); // Remove user from course
    Route::get('users/{userId}/courses', [CourseEnrollmentController::class, 'index'])
        ->name('users.courses.index'); // List all courses for a user
    Route::put('users/{userId}/courses/{courseId}/status', [CourseEnrollmentController::class, 'update'])
        ->name('users.courses.update_status'); // Update user course status
        Route::get('countries', [CountryController::class, "index"])->name('countries.index');

    //---------------------------//
    // Articles
    //---------------------------//
    Route::apiResource('articles', ArticleController::class)->names([
        'index' => 'articles.index',
        'store' => 'articles.store',
        'show' => 'articles.show',
        'update' => 'articles.update',
        'destroy' => 'articles.destroy',
    ]);

    //---------------------------//
    // Books
    //---------------------------//
    Route::apiResource('books', BookController::class)->names([
        'index' => 'books.index',
        'store' => 'books.store',
        'show' => 'books.show',
        'update' => 'books.update',
        'destroy' => 'books.destroy',
    ]);

    //---------------------------//
    // Courses
    //---------------------------//
    Route::apiResource('courses', CourseController::class)->names([
        'index' => 'courses.index',
        'store' => 'courses.store',
        'show' => 'courses.show',
        'update' => 'courses.update',
        'destroy' => 'courses.destroy',
    ]);

    //---------------------------//
    // Auth Actions
    //---------------------------//
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
});
