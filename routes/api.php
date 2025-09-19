<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ForgetPasswordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// User login
Route::post('/login', [AuthController::class, 'login']); // Handles user login
Route::post('/loginwithGoogel', [AuthController::class, 'loginwithGoogel']); // Handles login via Google OAuth

// User registration
Route::post('/register', [AuthController::class, 'register']); // Handles user registration

// User logout
Route::post('logout', [AuthController::class, 'logout']); // Logs out the authenticated user

// Refresh JWT token
Route::post('refresh', [AuthController::class, 'refresh']); // Refreshes the JWT token

// Email verification routes
Route::post('/verify-email', [AuthController::class, 'verify']); // Verifies user's email
Route::post('/resendCode', [AuthController::class, 'resendCode']); // Resends the verification code
// Change password routes
Route::post('/changePassword', [ForgetPasswordController::class, 'changePassword']); // Handles password change
Route::post('/checkEmail', [ForgetPasswordController::class, 'checkEmail']); // Checks if the email exists for password reset
Route::post('/checkCode', [ForgetPasswordController::class, 'checkCode']); // Verifies a password reset code


Route::middleware('auth:api')->group(function () {
Route::apiResource('/profiles',ProfileController::class);
Route::apiResource('ratings', RatingController::class); // Manages course ratings
Route::get('me', [ProfileController::class, 'getme']); // Retrieves the authenticated user's profile
});

Route::get('countries', [CountryController::class, "index"]);
Route::apiResource('books',BookController::class);
Route::apiResource('articles', ArticleController::class);
Route::apiResource('courses', CourseController::class);
