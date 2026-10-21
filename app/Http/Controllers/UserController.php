<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Portal;
use App\Models\User;
use App\Services\ChatService;
use App\Services\FileStorageService;
use App\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(
        private readonly FileStorageService $fileStorageService,
        private readonly ChatService $chatService,
        private readonly UserService $userService
    ) {}

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
    public function store(Portal $portal, StoreUserRequest $request)
    {
        $this->userService->create($request->validated());

        return redirect()->route('portal.user.index', compact('portal'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, User $user)
    {
        $conversationP2p = $this->chatService->getP2pConversation($user);

        return view('user.show', compact('portal', 'user', 'conversationP2p'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal, User $user)
    {
        $roles = Role::all();

        return view('user.edit', compact('portal', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, Portal $portal, User $user)
    {
        $this->userService->update($user, $request->validated());

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

    public function editProfilePicture(FileRequest $request, Portal $portal, User $user)
    {
        $validated = $request->validated();

        $this->fileStorageService->storeUserProfilePicture($user, $validated->file('file'));

        return redirect()->back();
    }
}
