<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\Auth\ForgetPasswordController;

//---------------------------//
// Public Auth Routes
//---------------------------//
Route::post('/login', [AuthController::class, 'login'])->name('authLogin');
Route::post('/login-with-google', [AuthController::class, 'loginwithGoogel'])->name('authLoginGoogle');
Route::post('/register', [AuthController::class, 'register'])->name('authRegister');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('authVerifyEmail');
Route::post('/resend-code', [AuthController::class, 'resendCode'])->name('authResendCode');

Route::post('/changePassword', [ForgetPasswordController::class, 'changePassword'])->name('passwordChange');
Route::post('/checkEmail', [ForgetPasswordController::class, 'checkEmail'])->name('passwordCheckEmail');
Route::post('/checkCode', [ForgetPasswordController::class, 'checkCode'])->name('passwordCheckCode');

Route::post('/refresh', [AuthController::class, 'refresh'])->name('authRefresh');

//---------------------------//
// Public Resources (index only)
//---------------------------//
Route::get('/articles', [ArticleController::class, 'index'])->name('articlesIndex');
Route::get('/courses', [CourseController::class, 'index'])->name('coursesIndex');
Route::get('/books', [BookController::class, 'index'])->name('booksIndex');
Route::get('/governorates', [GovernorateController::class, 'index'])->name('governoratesIndex');

//---------------------------//
// Authenticated Routes
//---------------------------//
Route::middleware(['auth:api', CheckPermission::class])->group(function () {

    //---------------------------//
    // User Profile
    //---------------------------//
    Route::get('/me', [ProfileController::class, 'getMe'])->name('profilesMe');
    Route::apiResource('profiles', ProfileController::class)->names([
        'index' => 'profilesIndex',
        'store' => 'profilesStore',
        'show' => 'profilesShow',
        'update' => 'profilesUpdate',
        'destroy' => 'profilesDestroy',
    ]);

    //---------------------------//
    // Ratings
    //---------------------------//
    Route::apiResource('ratings', RatingController::class)->names([
        'index' => 'ratingsIndex',
        'store' => 'ratingsStore',
        'show' => 'ratingsShow',
        'update' => 'ratingsUpdate',
        'destroy' => 'ratingsDestroy',
    ]);

    //---------------------------//
    // Course Enrollment
    //---------------------------//
    Route::post('courses/{courseId}/enrollment', [CourseEnrollmentController::class, 'store'])->name('coursesEnrollmentStore');
    Route::delete('courses/{courseId}/enrollment', [CourseEnrollmentController::class, 'delete'])->name('coursesEnrollmentDelete');
    Route::get('users/{userId}/courses', [CourseEnrollmentController::class, 'index'])->name('usersCoursesIndex');
    Route::put('users/{userId}/courses/{courseId}/status', [CourseEnrollmentController::class, 'update'])->name('usersCoursesUpdateStatus');
    Route::get('enrollments', [CourseEnrollmentController::class, 'index'])->name('enrollmentsIndex');
    Route::get('enrollments/{id}', [CourseEnrollmentController::class, 'show'])->name('enrollmentsShow');
    Route::get('courses/{courseId}/enrollments', [CourseEnrollmentController::class, 'courseEnrollments'])->name('coursesEnrollmentsIndex');
    Route::get('users/{userId}/enrollments', [CourseEnrollmentController::class, 'userEnrollments'])->name('usersEnrollmentsIndex');

    //---------------------------//
    // Articles (except index)
    //---------------------------//
    Route::apiResource('articles', ArticleController::class)
        ->except(['index'])
        ->names([
            'store' => 'articlesStore',
            'show' => 'articlesShow',
            'update' => 'articlesUpdate',
            'destroy' => 'articlesDestroy',
        ]);

    //---------------------------//
    // Books (except index)
    //---------------------------//
    Route::apiResource('books', BookController::class)
        ->except(['index'])
        ->names([
            'store' => 'booksStore',
            'show' => 'booksShow',
            'update' => 'booksUpdate',
            'destroy' => 'booksDestroy',
        ]);

    //---------------------------//
    // Courses (except index & show)
    //---------------------------//
    Route::apiResource('courses', CourseController::class)
        ->except(['index', 'show'])
        ->names([
            'store' => 'coursesStore',
            'update' => 'coursesUpdate',
            'destroy' => 'coursesDestroy',
        ]);
    Route::get('courses/tasks', [CourseController::class, 'getTaskWithTasks'])->name('coursesTasksIndex');
    Route::post('courses/{course}/video', [CourseController::class, 'addCourseVideo'])->name('coursesVideoStore');
    Route::delete('courses/{course}/video/{mediaId}', [CourseController::class, 'deleteCourseVideo'])->name('coursesVideoDelete');

    //---------------------------//
    // Auth Actions
    //---------------------------//
    Route::post('logout', [AuthController::class, 'logout'])->name('authLogout');

    //---------------------------//
    // Tasks
    //---------------------------//
    Route::apiResource('tasks', TaskController::class)
        ->except(['index'])
        ->names([
            'store' => 'tasksStore',
            'show' => 'tasksShow',
            'update' => 'tasksUpdate',
            'destroy' => 'tasksDestroy',
        ]);
    Route::get('user/tasks', [UserController::class, 'getUserTasks'])->name('userTasksIndex');
    Route::get('users', [UserController::class, 'index'])->name('usersIndex');

    Route::apiResource('certificates', CertificateController::class)->names([
        'index'   => 'certificatesIndex',
        'store'   => 'certificatesStore',
        'show'    => 'certificatesShow',
        'update'  => 'certificatesUpdate',
        'destroy' => 'certificatesDestroy',
    ]);

    // Route مخصص للحصول على شهادات المستخدم الحالي
    Route::get('my-certificates', [CertificateController::class, 'myCertificates'])->name('certificatesMy');
});
