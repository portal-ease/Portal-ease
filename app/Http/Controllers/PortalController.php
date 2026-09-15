<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePortalRequest;
use App\Models\Portal;
use App\Models\User;
use App\Services\ChatService;
use App\Services\FileStorageService;
use App\Services\PortalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function __construct(
        private readonly FileStorageService $storageService,
        private readonly ChatService $chatService,
        private readonly PortalService $portalService,
    )
    {}

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
    public function store(StorePortalRequest $request)
    {
        $portal = $this->portalService->create($request->validated(), $request->file('logo'));

        return redirect()->route('portal.verify', $portal);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal)
    {
        $user = Auth::user();

        if (!$user){
            return view('portal.show', [
                'portal' => $portal,
                'user' => null,
            ]);
        }

        $conversations = $this->chatService->getConversations($user);

        return view('portal.show', compact('portal', 'user', 'conversations'));
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
