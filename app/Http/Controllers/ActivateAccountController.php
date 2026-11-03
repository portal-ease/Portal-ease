<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Models\Portal;
use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ActivateAccountController extends Controller
{
    public function __construct(private readonly PasswordService $passwordService) {}

    public function create(Portal $portal, Request $request, string $token)
    {
        return view('password.activate-account', [
            'portal' => $portal,
            'token' => $token,
            'request' => $request,
        ]);
    }

    public function store(Portal $portal, StorePasswordRequest $request)
    {
        $status = $this->passwordService->resetPassword($request->validated());

        if ($status === Password::PASSWORD_RESET) {
            User::query()->where('email', $request->validated('email'))->update([
                'email_verified_at' => now(),
            ]);
        }

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('portal.show', $portal)
                ->with('status', 'Your account has been activated successfully.')
            : back()->withInput()->withErrors(['email' => [__($status)]]);
    }
}
