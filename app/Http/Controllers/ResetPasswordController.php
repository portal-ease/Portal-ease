<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function create(Portal $portal, Request $request, string $token)
    {
        return view('password.reset-password', [
            'portal' => $portal,
            'token' => $token,
            'request' => $request,
        ]);
    }

    public function store(Portal $portal, Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $status = Password::reset(
            [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('portal.show', ['portal' => $portal])
                ->with('status', 'Your password has been reset successfully.')
            : back()->withInput()
                ->withErrors(['email' => [__($status)]]);
    }
}
