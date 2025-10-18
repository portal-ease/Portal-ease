<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Portal;
use App\Models\User;
use Livewire\Component;

class ChatSidebar extends Component
{
    public $conversations = [];
    public Portal $portal;
    public Conversation $activeConversation;

    public function mount(User $user)
    {
        $this->conversations = $user->conversations;
        $this->portal = $user->portal;
    }
    public function render()
    {
        return view('livewire.chat-sidebar');
    }
    public function conversationSelected(Conversation $conversation)
    {
        $this->activeConversation = $conversation;
        $this->dispatch('conversationSelected', $conversation->id);
    }
}
