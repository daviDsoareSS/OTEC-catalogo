<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Mail;
use Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
class ForgotPasswordController extends Controller
{

    public function showForgotPasswordForm() {
        return view('adm.forgot.forgot-password-recovery');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', trans($status))
            : back()->withErrors(['email' => trans($status)]);
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('adm.forgot.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.show')->with('status', trans($status))
            : back()->withErrors(['email' => trans($status)]);
    }
}
