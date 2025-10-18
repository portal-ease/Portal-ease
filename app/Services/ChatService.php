<?php

namespace App\Services;

use App\Models\Conversation;

class ChatService
{
    protected Conversation $conversation;

    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }
    public function setConversation(Conversation $conversation): void
    {
        $this->conversation = $conversation;
    }
    public static function forConversation(Conversation $conversation): ChatService
    {
        return new self($conversation);
    }
}
