<?php

namespace App\Livewire;

use App\Models\Conversation;
use Livewire\Component;

class ChatWindow extends Component
{
    public ?Conversation $conversation = null;
    public $otherUsers = [];
    protected $listeners = ['conversationSelected' => 'loadConversation'];

    public function loadConversation($conversationId): void
    {
        $this->conversation = Conversation::find($conversationId);
        $this->otherUsers = $this->conversation->users->where('id', '!=', auth()->id());
    }
    public function render()
    {
        return view('livewire.chat-window');
    }
}
