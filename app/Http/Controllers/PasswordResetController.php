<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PasswordReset;
use App\Mail\PasswordRecoveryMail;

class PasswordResetController extends Controller
{
    public function forgotPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent.'], 200);
        }

        return response()->json(['message' => 'Failed to send password reset link.'], 400);
    }

    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $validated,
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password has been reset.'], 200);
        }

        return response()->json(['message' => 'Failed to reset password.'], 400);
    }
}
