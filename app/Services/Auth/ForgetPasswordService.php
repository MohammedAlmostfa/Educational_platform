<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\SendForgetPasswordCodeMail;

/**
 * Service for handling forget password workflow.
 */
class ForgetPasswordService
{
    /**
     * Check if the email exists and send a verification code.
     */
    public function checkEmail($email)
    {
        $key = 'resetPassword_' . $email;

        Cache::delete($key);

        $code = Cache::remember($key, 3600, fn() => random_int(1000, 9999));

        Mail::to($email)->send(new SendForgetPasswordCodeMail($code));

        return [
            'status' => 200,
            'message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني بنجاح.',
        ];
    }

    /**
     * Check if the provided code matches the cached code.
     */
    public function checkCode($email, $code)
    {
        $key = 'resetPassword_' . $email;

        if (!Cache::has($key)) {
            return [
                'status' => 400,
                'message' => 'انتهت صلاحية الكود، يرجى طلب كود جديد.',
            ];
        }

        $cached_code = Cache::get($key);

        if ($code != $cached_code) {
            return [
                'status' => 400,
                'message' => 'كود التحقق غير صحيح.',
            ];
        }

        return [
            'status' => 200,
            'message' => 'الكود صحيح.',
        ];
    }

    /**
     * Change the user's password.
     */
    public function changePassword($email, $password, $code)
    {
        $key = 'resetPassword_' . $email;

        if (!Cache::has($key)) {
            return [
                'status' => 400,
                'message' => 'انتهت صلاحية الكود، يرجى طلب كود جديد.',
            ];
        }

        $cached_code = Cache::get($key);

        if ($code != $cached_code) {
            return [
                'status' => 400,
                'message' => 'الكود المدخل غير صحيح.',
            ];
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'المستخدم غير موجود.',
            ];
        }

        $user->password = Hash::make($password);
        $user->save();

        Cache::delete($key);

        return [
            'status' => 200,
            'message' => 'تم تغيير كلمة المرور بنجاح.',
        ];
    }
}
