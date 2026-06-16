<?php

namespace App\Livewire;

use App\Models\Conversation;
use App\Models\Portal;
use Livewire\Component;

class ChatWindow extends Component
{
    public ?Conversation $conversation = null;
    public $otherUsers = [];
    public ?Portal $portal = null;

    protected $listeners = [
        'conversationSelected' => 'loadConversation'
    ];

    public function mount(): void
    {
        if ($this->conversation) {
            $this->loadUsers();
        }
    }

    protected function loadUsers(): void
    {
        $this->otherUsers = $this->conversation
            ->users()
            ->where('users.id', '!=', auth()->id())
            ->get();

        $this->portal = $this->otherUsers->first()?->portal;
    }

    public function loadConversation($conversationId): void
    {
        $this->conversation = Conversation::find($conversationId);

        if ($this->conversation) {
            $this->loadUsers();
        }
    }

    public function render()
    {
        return view('livewire.chat-window');
    }
}
