<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Models\Portal;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    private PasswordService $passwordService;
    public function __construct(PasswordService $passwordService)
    {
       $this->passwordService = $passwordService;
    }

    public function create(Portal $portal, Request $request, string $token)
    {
        return view('password.reset-password', [
            'portal' => $portal,
            'token' => $token,
            'request' => $request,
        ]);
    }

    public function store(Portal $portal, StorePasswordRequest $request)
    {
        $data = $request->validated();

        $status = $this->passwordService->resetPassword($data);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('portal.show', ['portal' => $portal])
                ->with('status', 'Your password has been reset successfully.')
            : back()->withInput()
                ->withErrors(['email' => [__($status)]]);
    }
}
