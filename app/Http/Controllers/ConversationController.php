<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Services\ChatService;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService,
    )
    {}

    public function index()
    {
        $user = auth()->user();

        if ($user) {
            return view('livewire.chat', $this->chatService->getAllConversations($user));
        }
        return redirect()->back();
    }
}
