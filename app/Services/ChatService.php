<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\User;

class ChatService
{
    public function getAllConversations(User $user)
    {
        return $user->conversations()->get()->sortByDesc('updated_at');
    }
}
