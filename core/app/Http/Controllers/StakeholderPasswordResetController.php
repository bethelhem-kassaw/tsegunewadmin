<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Facades\Password;

class StakeholderPasswordResetController extends Controller
{

        // use App\Http\Controllers\SendsPasswordResetEmails;

        public function broker()
        {
            return Password::broker('stakeholders');
        }

        public function showLinkRequestForm()
        {
            return view('filament.pages.forgot-password');
        }

        // public function showResetForm(Request $request, $token = null)
        // {
        //     return view('stakeholder.auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
        // }

        public function sendResetLinkEmail(Request $request)
        {
            // $request->validate(['email' => 'required|email']);

            $status = Password::broker('stakeholders')->sendResetLink(
                $request->only('michaelgetachew5@gmail.com')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }

    //     public function showResetForm(Request $request, $token = null)
    // {
    //     return view('filament.pages.forgot-password', [
    //         'token' => $token,
    //         'email' => $request->email,
    //     ]);
    // }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('stakeholders')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('stakeholder.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}
