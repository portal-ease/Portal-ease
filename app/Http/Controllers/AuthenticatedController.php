<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedController extends Controller
{
    public function store()
    {
        $credentials = request()->only('email', 'password');
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!User::where('email', $credentials['email'])->exists()) {
            return back()->withErrors(['email' => 'Email is not correct or not found'])->withInput();
        }
        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['password' => 'Password is incorrect'])->withInput();
        }
        return redirect()->back();
    }


    public function destroy()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
