<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use App\Models\User;
use App\Services\ChatService;
use App\Services\FileStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortalController extends Controller
{
    private FileStorageService $storageService;

    private ChatService $chatService;

    public function __construct(FileStorageService $storageService, ChatService $chatService)
    {
        $this->storageService = $storageService;
        $this->chatService = $chatService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'branding_color' => 'required',
            'logo' => 'required|image',
        ]);
        $portal = Portal::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'branding_color' => $request->get('branding_color'),
        ]);
        $user = User::create([
            'name' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'portal_id' => $portal->id,
        ]);

        $this->storageService->storePortalLogo($request->file('logo'), $portal->name);

        $user->assignRole('service_provider');
        $user->assignRole('admin');
        Auth::login($user);

        return redirect()->route('portal.verify', $portal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal)
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::id())->first();

            $conversations = $this->chatService->getConversations($user);

            return view('portal.show', compact('portal', 'user', 'conversations'));
        } else {
            $user = null;

            return view('portal.show', compact('portal', 'user'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal)
    {
        return view('portal.edit', compact('portal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portal $portal)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'branding_color' => 'required',
        ]);
        $oldName = $portal->name;

        $portal->update([
            'name' => $request->name,
            'email' => $request->email,
            'branding_color' => $request->branding_color,
        ]);

        if ($request->hasFile('logo')) {
            $this->storageService->storePortalLogo(
                $request->file('logo'),
                $request->get('name')
            );
        }

        if ($oldName !== $request->get('name')) {
            $this->storageService->renamePortalLogo(
                $oldName,
                $request->get('name')
            );
        }

        return redirect()->route('portal.edit', compact('portal'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portal $portal)
    {
        $portal->delete();

        return redirect()->route('portal.index');
    }

    public function verify(Portal $portal)
    {
        Auth::user()->sendEmailVerificationNotification();

        return view('portal.verify');
    }
}
