<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function create(Portal $portal)
    {
        return view('password.forgot-password', [
            'portal' => $portal,
        ]);
    }

    public function store(Portal $portal, Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ?
            back()->with('status', __($status))
            : back()->withInput()
                ->withErrors(['email' => __($status)]);
    }
}
