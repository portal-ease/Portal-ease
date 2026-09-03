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
            'request' => $request,
            'token' => $token,
        ]);
    }

    public function store(Portal $portal, Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'token'
            ),
            function ($user, $password) {
                $user->update([
                    'password' => Hash::make($password),
                ]);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('portal.index')
                ->with('status', 'Your password has been reset successfully.')
            : back()->withInput()
                ->withErrors(['email' => [__($status)]]);
    }
}
