<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Portal;
use App\Models\User;
use App\Notifications\DocumentShared;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portal $portal)
    {
        $user = auth()->user();

        return view('file.index', compact('user', 'portal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Portal $portal)
    {
        return view('file.create', compact('portal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'name' => 'required',
            'user' => 'required',
            'visibility' => 'required',
        ]);
        $user = User::where('id', $request->get('user'))->first();
        if ($request->get('visibility') == 'true') {
            $visibility = true;
        } else {
            $visibility = false;
        }
        $user->notify(new DocumentShared(Auth::user()->name, $request->file('file')->getClientOriginalName()));
        $path = $request->file('file')->store('files');
        $file = File::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'mime_type' => $request->file('file')->getClientMimeType(),
            'path' => $path,
            'visibility' => $visibility,
        ]);

        $user->files()->attach($file->id);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, File $file)
    {
        return view('file.show', compact('file', 'portal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }

    public function download(Portal $portal, File $file)
    {
        return Storage::download($file->path, $file->filename);
    }
}
