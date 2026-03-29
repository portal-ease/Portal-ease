<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\json;

class PortalController extends Controller
{
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
            "name" => "required",
            "email" => "required",
            "username" => "required",
            "password" => "required",
            "branding_color" => "required",
            "logo" => "required|image",
        ]);
        $portal = Portal::create([
            "name" => $request->get("name"),
            "email" => $request->get("email"),
            "branding_color" => $request->get("branding_color"),
        ]);
        $user = User::create([
            'name' => $request->get("username"),
            'email' => $request->get("email"),
            'password' => bcrypt($request->get('password')),
            'portal_id' => $portal->id,
        ]);
        $file = $request->file('logo');
        $filename = $portal->name . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('profile-pictures', $filename, 'public');
        File::create([
            "filename" => $filename,
            "mime_type" => $request->file("logo")->getClientMimeType(),
            "path" => $path,
            "visibility" => true,
        ]);
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
        if (Auth::check())
        {
            $user = User::where('id', Auth::id())->first();
            return view('portal.show', compact('portal', 'user'));
        }
        else{
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
            "name" => "required",
            "email" => "required",
            "branding_color" => "required",
        ]);

        $extensions = ['jpg', 'png'];
        $oldFileName = null;

        // Detect existing file
        foreach ($extensions as $ext) {
            $filePath = "profile-pictures/{$portal->name}.{$ext}";
            if (Storage::disk('public')->exists($filePath)) {
                $oldFileName = "{$portal->name}.{$ext}";
                break;
            }
        }

        $newFileName = $request->name . ".jpg"; // Always rename to jpg

        // Move file if found
        if ($oldFileName) {
            Storage::disk('public')->move(
                "profile-pictures/{$oldFileName}",
                "profile-pictures/{$newFileName}"
            );
        }

        // Update file record
        $file = File::whereIn('filename', [
            "{$portal->name}.jpg",
            "{$portal->name}.png",
        ])->first();

        if ($file) {
            $file->update(['filename' => $newFileName]);
        }

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
        return view('portal.verify', compact('portal'));
    }
}
