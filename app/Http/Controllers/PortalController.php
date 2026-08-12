<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use App\Services\FileStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortalController extends Controller
{
    private FileStorageService $storageService;

    public function __construct(FileStorageService $storageService){
        $this->storageService = $storageService;
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

            return view('portal.show', compact('portal', 'user'));
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

        $this->storageService->renamePortalLogo($portal->name, $request->input('name'));

        $portal->update($request->all());

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

        return view('portal.verify', compact('portal'));
    }
}
