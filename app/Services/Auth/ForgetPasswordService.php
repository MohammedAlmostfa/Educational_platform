<?php

namespace App\Services\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\SendForgetPasswordCodeMail;

class ForgetPasswordService
{
    /**
     * Check if the email exists and send a verification code.
     *
     * @param string $email The email address to send the code to.
     * @return array An array containing the status and message.
     */
    public function checkEmail($email)
    {
        try {
            $key = 'resetPassword_' . $email;

            Cache::delete($key);

            $code = Cache::remember($key, 3600, function () {
                return random_int(1000, 9999);
            });

            Mail::to($email)->send(new SendForgetPasswordCodeMail($code));

            return [
                'status' => 200,
                'message' => ['تم إرسال كود التحقق إلى بريدك الإلكتروني بنجاح.'],
            ];
        } catch (Exception $e) {
            Log::error("Error in checkEmail: " . $e->getMessage());

            return [
                'status' => 500,
                'message' => ['حدث خطأ أثناء إرسال كود التحقق، حاول لاحقاً.'],
            ];
        }
    }

    /**
     * Check if the provided code matches the cached code.
     *
     * @param string $email The email address associated with the code.
     * @param string $code The code to verify.
     * @return array An array containing the status and message.
     */
    public function checkCode($email, $code)
    {
        try {
            $key = 'resetPassword_' . $email;

            if (!Cache::has($key)) {
                return [
                    'status' => 400,
                    'message' => ['انتهت صلاحية الكود، يرجى طلب كود جديد.'],
                ];
            }

            $cached_code = Cache::get($key);

            if ($code != $cached_code) {
                return [
                    'status' => 400,
                    'message' => ['كود التحقق غير صحيح.'],
                ];
            }

            return [
                'status' => 200,
                'message' => ['الكود صحيح.'],
            ];
        } catch (Exception $e) {
            Log::error("Error in checkCode: " . $e->getMessage());

            return [
                'status' => 500,
                'message' => ['حدث خطأ أثناء التحقق من الكود، حاول لاحقاً.'],
            ];
        }
    }

    /**
     * Change the user's password.
     *
     * @param array $data An array containing the email, code, and new password.
     * @return array An array containing the status and message.
     */
    public function changePassword($email, $password, $code)
    {
        try {
            $key = 'resetPassword_' . $email;

            if (!Cache::has($key)) {
                return [
                    'status' => 400,
                    'message' => ['انتهت صلاحية الكود، يرجى طلب كود جديد.'],
                ];
            }

            $cached_code = Cache::get($key);

            if ($code != $cached_code) {
                return [
                    'status' => 400,
                    'message' => ['الكود المدخل غير صحيح.'],
                ];
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                return [
                    'status' => 404,
                    'message' => ['المستخدم غير موجود.'],
                ];
            }

            $user->password = Hash::make($password);
            $user->save();

            Cache::delete($key);

            return [
                'status' => 200,
                'message' => ['تم تغيير كلمة المرور بنجاح.'],
            ];
        } catch (Exception $e) {
            Log::error("Error in changePassword: " . $e->getMessage());

            return [
                'status' => 500,
                'message' => ['حدث خطأ أثناء تغيير كلمة المرور، حاول لاحقاً.'],
            ];
        }
    }
}
