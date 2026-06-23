<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Collection;

class ChatService
{
    public function getConversations(User $user)
    {
        return $user->conversations()->get()->sortByDesc('updated_at');
    }

    public function getMessages(Conversation $conversation): Collection
    {
        return $conversation->messages()->get()->sortByDesc('updated_at');
    }
}
