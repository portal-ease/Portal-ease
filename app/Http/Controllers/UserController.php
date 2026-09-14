<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use App\Services\FileStorageService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private FileStorageService $fileStorageService;

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

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
    public function store(Portal $portal, Request $request)
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

        return redirect()->route('portal.user.index', compact('portal'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, User $user)
    {
        $conversationP2p = Conversation::query()->first();

        return view('user.show', compact('portal', 'user', 'conversationP2p'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal, User $user)
    {
        $file = File::where('filename', $user->name.$user->id.'.jpg')->first();

        $roles = Role::all();

        return view('user.edit', compact('portal', 'user', 'file', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portal $portal, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $user->fill([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

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

        $this->fileStorageService->storeUserProfilePicture($user, $request->file('file'));

        return redirect()->back();
    }
}
