<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Events\Registered;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Service class to handle user authentication and registration
 */
class AuthService
{
    /**
     * Generate a unified response structure.
     */
    private function respond($message = null, $status = 200, $data = [])
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    /**
     * Register a new user and send verification code.
     */
    public function register($data)
    {
        $userDataKey = 'user_data_' . $data['email'];
        $verifkey = 'verification_code_' . $data['email'];

        if (Cache::has($userDataKey)) {
            return $this->respond('هذا البريد مستخدم مسبقاً.', 400);
        }


        Cache::put($userDataKey, $data, 3600);

        if (Cache::has($verifkey)) {
            return $this->respond('تم إرسال كود التحقق مسبقاً.', 400);
        }

        // خزّن الكود
        $code = Cache::remember($verifkey, 3600, fn() => random_int(1000, 9999));

        try {
            // جرب إرسال الإيميل
            event(new Registered($data, $verifkey));
        } catch (\Exception $e) {
            // إذا فشل الإرسال، احذف الـ Cache
            Cache::forget($userDataKey);
            Cache::forget($verifkey);

            return $this->respond('حدث خطأ أثناء إرسال كود التحقق. حاول مرة أخرى.', 500);
        }

        return $this->respond('تم إرسال كود التحقق بنجاح.', 201, ['email' => $data['email']]);
    }

    /**
     * Verify account and create user.
     */
    public function verficationacount($data)
    {
        $userDataKey = 'user_data_' . $data['email'];
        $userData = Cache::get($userDataKey);

        if (!$userData) {
            return $this->respond('لم تقم بالتسجيل بعد.', 404);
        }

        $verifkey = 'verification_code_' . $data['email'];
        $cachedCode = Cache::get($verifkey);

        if ((string)$cachedCode === (string)$data['code']) {
            if (User::where('email', $userData['email'])->exists()) {
                return $this->respond('هذا البريد مستخدم مسبقاً.', 400);
            }

            $user = null;
            DB::transaction(function () use ($userData, &$user) {
                $user = User::create([
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                    'email_verified_at' => now(),
                ]);

                $user->assignRole('user');
            });


            $token = JWTAuth::fromUser($user);

            Cache::forget($verifkey);
            Cache::forget($userDataKey);

            return $this->respond('تم تأكيد البريد وإنشاء الحساب بنجاح.', 200, ['token' => $token]);
        }

        return $this->respond('كود التحقق غير صحيح.', 400);
    }

    /**
     * Resend verification code.
     */
    public function resendCode($data)
    {
        $verifkey = 'verification_code_' . $data['email'];

        if (Cache::has($verifkey)) {
            Cache::forget($verifkey);
        }

        $code = Cache::remember($verifkey, 3600, fn() => random_int(1000, 9999));

        event(new Registered($data, $verifkey));

        return $this->respond('تم إعادة إرسال كود التحقق بنجاح.', 200);
    }

    /**
     * Login user and return JWT token.
     */
    public function login($credentials)
    {
        if (!$token = auth('api')->attempt($credentials)) {
            return $this->respond('بيانات الدخول غير صحيحة.', 401);
        }

        return $this->respond('تم تسجيل الدخول بنجاح.', 201, [
            'token' => $token,
            'type' => 'bearer',
        ]);
    }

    /**
     * Logout authenticated user.
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->respond('تم تسجيل الخروج بنجاح.', 200);
    }

    /**
     * Refresh JWT token for authenticated user.
     */
    public function refresh()
    {
        $newToken = JWTAuth::parseToken()->refresh();
        $user = auth('api')->user();

        return $this->respond('تم تجديد التوكن بنجاح.', 200, [
            'token' => $newToken,
            'user' => $user,
        ]);
    }
}
