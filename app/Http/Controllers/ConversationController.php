<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use App\Services\ChatService;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService,
    ) {}

    public function index(Portal $portal)
    {
        $user = auth()->user();

        if ($user) {
            $conversations = $this->chatService->getConversations($user);

            return view('conversation.index', compact('conversations', 'user'));
        }

        return redirect()->back();
    }
}
