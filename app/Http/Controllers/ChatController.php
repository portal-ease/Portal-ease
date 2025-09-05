<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Portal;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portal $portal)
    {
        return view('chat.index' , compact('portal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Portal $portal)
    {
        $users = $portal->users;
        return view('chat.create', compact('portal', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Portal $portal)
    {
        $request->validate([
            'user1_id' => 'required',
            'user2_id' => 'required',
        ]);
        Chat::create([
            "user1_id" => $request->get('user1_id'),
            "user2_id" => $request->get('user2_id'),
            "portal_id" => $portal->id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Portal $portal, Chat $chat)
    {
        return view('chat.show', compact('chat', 'portal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
