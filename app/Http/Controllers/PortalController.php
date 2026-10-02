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

        return view('portal.show', [
            'portal' => $portal,
            'conversations' => $conversations,
            'user' => $user,
            'features' => $portal->features()->get()->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portal $portal)
    {
        return view('portal.edit', [
            'portal' => $portal,
            'features' => $portal->features()->get(),
        ]);
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
     * Update the features available in a portal.
     */
    public function updateFeatures(Portal $portal)
    {
        $enabledFeatures = request()->validate([
            'features' => ['nullable', 'array'],
            'features.*' => ['string', 'distinct'],
        ])['features'] ?? [];

        $portal->features()->get()->each(function ($feature) use ($enabledFeatures) {
            $feature->update([
                'enabled' => in_array($feature->feature, $enabledFeatures, true),
            ]);
        });

        return redirect()->route('portal.edit', $portal)->with('activeTab', 'features');
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
