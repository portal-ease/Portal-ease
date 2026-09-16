<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePortalRequest;
use App\Http\Requests\UpdatePortalRequest;
use App\Models\Portal;
use App\Services\ChatService;
use App\Services\PortalService;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService,
        private readonly PortalService $portalService,
    ) {}

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

        if (! $user) {
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
        return view('portal.edit', $portal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortalRequest $request, Portal $portal)
    {
        $this->portalService->update($portal, $request->validated(), $request->file('logo'));

        return redirect()->route('portal.edit', $portal);
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
