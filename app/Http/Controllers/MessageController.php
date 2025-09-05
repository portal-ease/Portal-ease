<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Portal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Notifications\NewMessage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Portal $portal, Chat $chat)
    {
        $request->validate([
            'content' => 'required',
        ]);
        Message::create([
            "content" => $request->get('content'),
            "chat_id" => $chat->id,
            "user_id" => Auth::id(),
            "is_deleted" => false,
        ]);
        foreach ([$chat->user1 , $chat->user2 ] as $user) {
            if ($user->id != Auth::id()) {
                $user->notify(new NewMessage(Auth::user()->name));
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
