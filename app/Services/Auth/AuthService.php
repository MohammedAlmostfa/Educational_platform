<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use App\Events\Registered;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Generate a unified response structure.
     *
     * @param string|null $message Response message
     * @param int $status HTTP status code
     * @param array $data Additional data
     * @return array
     */
    private function respond($message = null, $status = 200, $data = [])
    {
        return [
            'status' => $status,
            'message' => $message ? [$message] : [],
            'data' => $data,
        ];
    }

    /**
     * Register a new user.
     *
     * Stores the user data temporarily in cache and sends a verification code to the email.
     *
     * @param array $data User data: email, password
     * @return array Response with status, message, and email
     */
    public function register($data)
    {
        try {
            $userDataKey = 'user_data_' . $data['email'];

            // Prevent duplicate registration attempts
            if (Cache::has($userDataKey)) {
                return $this->respond('هذا البريد مستخدم مسبقاً.', 400);
            }

            // Store user data in cache for 1 hour
            Cache::put($userDataKey, $data, 3600);

            $verifkey = 'verification_code_' . $data['email'];

            if (Cache::has($verifkey)) {
                return $this->respond('تم إرسال كود التحقق مسبقاً.', 400);
            }

            // Generate a 4-digit verification code
            $code = Cache::remember($verifkey, 3600, function () {
                return random_int(1000, 9999);
            });

            // Trigger the Registered event to send verification email
            event(new Registered($data, $verifkey));

            return $this->respond('تم إرسال كود التحقق بنجاح.', 201, ['email' => $data['email']]);
        } catch (Exception $e) {
            Log::error('Error in registration: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء التسجيل، حاول لاحقاً.', 500);
        }
    }

    /**
     * Verify a user's account using the verification code.
     *
     * Checks if the code matches the cached code, creates the user in DB, and generates a JWT token.
     *
     * @param array $data Contains email and verification code
     * @return array Response with status, message, and token if successful
     */
    public function verficationacount($data)
    {
        try {
            $userDataKey = 'user_data_' . $data['email'];
            $userData = Cache::get($userDataKey);

            if (!$userData) {
                return $this->respond('لم تقم بالتسجيل بعد.', 404);
            }

            $verifkey = 'verification_code_' . $data['email'];
            $cachedCode = Cache::get($verifkey);

            // Compare verification code (strict type)
            if ($cachedCode === $data['code']) {

                // Prevent duplicate users
                if(User::where('email', $userData['email'])->exists()) {
                    return $this->respond('هذا البريد مستخدم مسبقاً.', 400);
                }

                // Create user and mark email as verified
                $user = User::create([
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                    'email_verified_at' => now(),
                ]);

                // Generate JWT token
                $token = JWTAuth::fromUser($user);

                // Clear cache
                Cache::forget($verifkey);
                Cache::forget($userDataKey);

                return $this->respond('تم تأكيد البريد وإنشاء الحساب بنجاح.', 200, ['token' => $token]);
            } else {
                return $this->respond('كود التحقق غير صحيح.', 400);
            }
        } catch (Exception $e) {
            Log::error('Error in verficationacount: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء التحقق، حاول لاحقاً.', 500);
        }
    }

    /**
     * Resend verification code to user's email.
     *
     * Generates a new code and triggers the Registered event.
     *
     * @param array $data Contains user's email
     * @return array Response with status and message
     */
    public function resendCode($data)
    {
        try {
            $verifkey = 'verification_code_' . $data['email'];

            // Remove previous code if exists
            if (Cache::has($verifkey)) {
                Cache::forget($verifkey);
            }

            // Generate new verification code
            $code = Cache::remember($verifkey, 3600, function () {
                return random_int(1000, 9999);
            });

            event(new Registered($data, $verifkey));

            return $this->respond('تم إعادة إرسال كود التحقق بنجاح.', 200);
        } catch (Exception $e) {
            Log::error('Error in resendCode: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء إعادة إرسال الكود، حاول لاحقاً.', 500);
        }
    }

    /**
     * Authenticate user and generate JWT token.
     *
     * @param array $credentials Email and password
     * @return array Response with status, message, and token
     */
    public function login($credentials)
    {
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return $this->respond('بيانات الدخول غير صحيحة.', 401);
            }

            $user = auth('api')->user();
            return $this->respond('تم تسجيل الدخول بنجاح.', 201, [
                'token' => $token,
                'type' => 'bearer',
                'user' => $user,
            ]);
        } catch (Exception $e) {
            Log::error('Error in login: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء تسجيل الدخول، حاول لاحقاً.', 500);
        }
    }

    /**
     * Logout authenticated user and invalidate JWT token.
     *
     * @return array Response with status and message
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->respond('تم تسجيل الخروج بنجاح.', 200);
        } catch (Exception $e) {
            Log::error('Error in logout: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء تسجيل الخروج، حاول لاحقاً.', 500);
        }
    }

    /**
     * Refresh JWT token for authenticated user.
     *
     * @return array Response with new token and user info
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::parseToken()->refresh();
            $user = auth('api')->user();

            return $this->respond('تم تجديد التوكن بنجاح.', 200, [
                'token' => $newToken,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            Log::error('Error in refresh: ' . $e->getMessage());
            return $this->respond('حدث خطأ أثناء تجديد التوكن، حاول لاحقاً.', 500);
        }
    }
}
