<?php

namespace App\Http\Controllers;

use App\Services\ChatService;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService,
    ) {}

    public function index()
    {
        $user = auth()->user();

        if ($user) {
            $portal = $user->portal;

            $conversations = $this->chatService->getConversations($user);

            return view('conversation.index', compact('conversations', 'user', 'portal'));
        }

        return redirect()->back();
    }
}
