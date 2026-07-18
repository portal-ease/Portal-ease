<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portal $portal)
    {
        return view('user.index', compact('portal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Portal $portal)
    {
        return view('user.create', compact('portal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'portal_id' => 'required|integer|exists:portals,id',
            'role' => 'required',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'portal_id' => $validated['portal_id'],
        ]);
        if ($validated['role'] == 'service_provider') {
            $user->assignRole('service_provider');
        } elseif ($validated['role'] == 'client') {
            $user->assignRole('client');
        }
        Auth::login($user);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, User $user)
    {
        $conversationP2p = Conversation::query()->first();

        return view('user.show', compact('user', 'portal', 'conversationP2p'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal, User $user)
    {
        return view('user.edit', compact('user', 'portal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);
        foreach ($user->getRoleNames() as $role) {
            $user->removeRole($role);
        }
        $user->assignRole($request->get('role'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portal $portal, User $user)
    {
        $user->delete();

        return redirect('/');
    }

    public function notification(Portal $portal)
    {
        return view('notification.index', compact('portal'));
    }

    public function editProfilePicture(Request $request, Portal $portal, User $user)
    {
        $request->validate([
            'file' => 'required|image',
        ]);
        $file = $request->file('file');
        $filename = $user->name.$user->id.'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('profile-pictures', $filename, 'public');
        File::create([
            'filename' => $filename,
            'mime_type' => $request->file('file')->getClientMimeType(),
            'path' => $path,
            'visibility' => true,
        ]);

        return redirect()->back();
    }
}
